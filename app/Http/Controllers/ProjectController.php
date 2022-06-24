<?php

namespace App\Http\Controllers;

use Mail;
use App\EmissionFactor;
use App\Evaluator;
use App\Keyword;
use App\KeywordItem;
use App\Project;
use App\ProjectEvaluator;
use App\HighwayList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\User;



class ProjectController extends Controller
{
    public function index(Request $request) {
        $pageLength = 10;
        $concessionaire_id = $auditor_id = $award = $status = $report_date = '';
        $mod = new Project();

        if (Auth::user()->role == 'auditor') {
            $auditor_evaluators = Auth::user()->evaluators()->distinct()->pluck('project_id')->toArray();
            $mod = $mod->whereIn('id', $auditor_evaluators);
        } else if (Auth::user()->role == 'concessionaire') {
            $mod = $mod->where('concessionaire_name', Auth::id());
        }

        if($request->get('concessionaire_id') != '') {
            $concessionaire_id = $request->get('concessionaire_id');
            $mod = $mod->where('concessionaire_name', $concessionaire_id);
        }
        if($request->get('auditor_id') != '') {
            $auditor_id = $request->get('auditor_id');
            $auditor = User::find($auditor_id);
            $auditor_evaluators = $auditor->evaluators()->distinct()->pluck('project_id')->toArray();
            $mod = $mod->whereIn('id', $auditor_evaluators);
        }
        if($request->get('award') != '') {
            $award = $request->get('award');
            $mod = $mod->where('award', $award)->where('status' , 'Complete');
        }
        if($request->get('status') != '') {
            $status = $request->get('status');
            $mod = $mod->where('status', $status);
        }
        if($request->get('report_date') != '') {
            $report_date = $request->get('report_date');
            $mod = $mod->where('open_to_public', $report_date);
        }

        if($request->get('pageLength') != '') {
            $pageLength = $request->get('pageLength');
        }

        $projects = $mod->orderBy('created_at', 'desc')->paginate($pageLength);

        return view('admin.project.list', compact('projects', 'concessionaire_id', 'auditor_id', 'award', 'status', 'report_date', 'pageLength'));
    }

    public function show($projectId) {

        $projectNavigation = Config::get('project_navigation');
        $project = Project::findOrFail($projectId);
        
        if($project->section_status==""){
            
            $sectionStatus[] = Project::initSectionStatus([], $projectNavigation);
            $project->section_status = json_encode($sectionStatus);
        }
        if($project->section_comment==""){
            $sectionComment[] = Project::initSectionComment([], $projectNavigation);
            $project->section_comment = json_encode($sectionComment);
        }
        
        $data = $this->getProjectForView($project);
        

        return view('admin.project.get', $data);
    }

    public function store(Request $request) {

        $data = $request->except('saveAsDraft','saveAsDraftScore','applyAssessment');
         //dd($request->all());
        if(!empty($data['id'])) {
            echo $id = $data['id'];
            $project = Project::find($id);
           
            $assessmentYears = array_merge([$data['assessment_year']], $request->get('assessment_years', []));
            $project->assessment_years = json_encode($assessmentYears);

            $sectionVerification = json_decode($project->section_verification, true);
            $sectionPdf = json_decode($project->section_pdf, true);
            $sectionStatus = json_decode($project->section_status, true);
            $sectionComment = json_decode($project->section_comment, true);
            if(empty($sectionVerification)) {
                $sectionVerification = [];
                $sectionPdf = [];
                $sectionStatus = [];
                $sectionComment = [];
            }
            $projectNavigation = Config::get('project_navigation');

                if(count($sectionVerification) < count($assessmentYears)) {
                    // if verifications are less than years, add a new verification section and a new pdf section
                    $sectionVerification[] = Project::initSectionVerification([], $projectNavigation);
                    $sectionPdf[] = Project::initSectionPdf([], $projectNavigation);
                    $sectionStatus[] = Project::initSectionStatus([], $projectNavigation);
                    $sectionComment[] = Project::initSectionComment([], $projectNavigation);
                    $project->section_verification = json_encode($sectionVerification);
                    $project->section_pdf = json_encode($sectionPdf);
                    $project->section_status = json_encode($sectionStatus);
                    $project->section_comment = json_encode($sectionComment);
                }
               

            if ($request->has('saveAsDraft'))
            {
                $data['status'] = '';
            }
            if ($request->has('saveAsDraftScore'))
            {
                $data['status'] = '';
            }
            if($request->has('applyAssessment'))
            {

                 $data['status_val'] = 1;
                 $data['status'] = 'Apply Assessment';

            }
            //  dd($data);


            $project->update($data);
            $concessionaire = User::find($project->concessionaire_name);
            if (Auth::user()->role!='auditor')
            {
                ProjectEvaluator::where('project_id', '=', $id)->delete();
                if(!empty($data['evaluators'])) {
                    foreach ($data['evaluators'] as $evaluator) {
                        ProjectEvaluator::firstOrCreate([
                            'project_id' => $id,
                            'evaluator_id' => $evaluator['id'],
                            'approver' => isset($evaluator['approver']) && $evaluator['approver'] == 'on' ? 1 : 0
                        ]);
                        
                        if(isset($evaluator['approver']))
                        {
                            $evaluator = User::find($evaluator['id']);
                            Mail::send('emails.assign-assesser', ['project' => $project, 'concessionaire'=> $concessionaire], function ($m) use ($evaluator) {
                                $m->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
                    
                                $m->to($evaluator->email, $evaluator->name)->subject('Sistem CFC : Penilaian Projek');
                            });
                        }
                    }
                }
            }

            if($request->has('applyAssessment')){
                Mail::send('emails.apply-assessment', ['project' => $project, 'concessionaire'=>$concessionaire], function ($m) use ($concessionaire) {
                    $m->from(env('MAIL_ADMIN_EMAIL_SENDER'), env('MAIL_FROM_NAME'));
                    $m->replyTo(env('MAIL_ADMIN_EMAIL_REPLY'), 'CFC Admin');
                    $m->to(env('MAIL_ADMIN_EMAIL_RECEVIER'), 'CFC Admin')->subject('Sistem CFC : Permohonan Penilaian Projek');
                });

            }

        } else {

            if (Auth::user()->role=='concessionaire') {
                $data['concessionaire_name'] = Auth::user()->id;
            } else {
                $data['concessionaire_name'] = 0;
            }

            $data['report_period'] = 1;
            $data['settings'] = '[]';
            // data structures stored 'as-is' because of a matter of time in json format
            $data['construction_header'] = '[]';
            $data['construction_footer'] = '[]';
            $data['construction_work_values'] = '[]';
            $data['assessment_years'] = '[]';
            $data['score_awards_totals'] = "[]";
            $data['status'] = '';
            if (Auth::user()->role=='concessionaire') {
                $data['user_id']=Auth::user()->id;
            } else {
                $data['user_id']=0;
            }
            


            $project = Project::create($data);
            $keywords = Keyword::getDataForProjectCreation(true);
            foreach($keywords as $key => $keyword) {
                foreach($keyword as $element) {
                    try {
                        $fillable = [
                            'category' => !empty($element['category']) ? $element['category'] : '',
                            'subcategory' => isset($element['subcategory']) ? $element['subcategory'] : $element['title'],
                            'factor' => isset($element['factor']) ? (float)$element['factor'] : (float)$element['distance'],
                            'unit' => $element['unit'],
                            'sources' => $element['sources'],
                            'type' => Keyword::$emissionFactorKeys[$key],
                            'project_id' => $project->id
                        ];
                        EmissionFactor::create($fillable);
                    }
                    catch(\Exception $e) {
                        error_log("Error creating emission factor for new project: ".$e->getMessage());
                    }
                }
            }
        }
        $data = $this->getProjectForView($project);

        if ($request->has('saveAsDraft') || $request->has('saveAsDraftScore') || $request->has('applyAssessment'))
        {
            return redirect()->route('projects.index');
        }
        return redirect('admin/projects/'.$project->id)->with('data', $data);
    }

    public function update(Request $request) {
        $requestData = $request->all();
        $postData = $requestData['data'];
        Project::storeProjectStructure($postData);
        return response()->json(['status' => 'OK']);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();
        flash('Project Deleted')->success('Project Deleted');

        return redirect()->back();
    }

    public function getAuditor()
    {
        $auditors  = User::where('role', 'auditor')->get();

        return \request()->json(200,$auditors);

    }


    /**
     * @param Request $request
     * @change  Assessment Status
     * In @param Request $request
     * get @project_id & @assessment_status
     */
    public  function assessmentStatus(Request $request)
    {

        try{


//            dd($request->all());

            if($request->assessment_status=='Approve Assessment')
            {
                $status_val=2;
            }
            if ($request->assessment_status=='Submit Assessment' )
            {
                $status_val=3;
            }
            if ($request->assessment_status=='Save As Draft')
            {
                $status_val=0;
            }
            if($request->assessment_status=='Complete')
            {
                $status_val=-1;
            }
            if ($request->assessment_status=='Reject Assessment')
            {
                $status_val=9;
            }
//            dd($status_val);

            Project::where('id',$request->project_id)
                ->update([
                    'status'=>$request->assessment_status,
                    'status_val'=>$status_val,
                    ]);
            
            $project = Project::find($request->project_id);
            $concessionaire = User::find($project->concessionaire_name);

            if($request->assessment_status=='Approve Assessment')
            {
                Mail::send('emails.approve-assessment', ['project' => $project, 'concessionaire' => $concessionaire], function ($m) use ($concessionaire) {
                    $m->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
         
                    $m->to($concessionaire->email, $concessionaire->name)->subject('Sistem CFC : Status Permohonan Penilaian Projek');
                });
            }
            if ($request->assessment_status=='Reject Assessment')
            {
                Mail::send('emails.reject-assessment', ['project' => $project, 'concessionaire' => $concessionaire], function ($m) use ($concessionaire) {
                    $m->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
         
                    $m->to($concessionaire->email, $concessionaire->name)->subject('Sistem CFC : Status Permohonan Penilaian Projek');
                });
            }
            if ($request->assessment_status=='Complete' )
            {
                 Mail::send('emails.submit-result', ['project' => $project, 'concessionaire' => $concessionaire], function ($m) use ($concessionaire) {
                    $m->from(env('MAIL_ADMIN_EMAIL_SENDER'), env('MAIL_FROM_NAME'));
                    $m->replyTo(env('MAIL_ADMIN_EMAIL_REPLY'), 'CFC Admin');
                    $m->to(env('MAIL_ADMIN_EMAIL_RECEVIER'), 'CFC Admin')->subject('Sistem CFC : Penghantaran Penilaian Projek oleh Penilai');
                });
            }
            if ($request->assessment_status=='Submit Assessment' )
            {
                 Mail::send('emails.submit-assessment', ['project' => $project, 'concessionaire' => $concessionaire], function ($m) use ($concessionaire) {
                    $m->from(env('MAIL_ADMIN_EMAIL_SENDER'), env('MAIL_FROM_NAME'));
                    $m->replyTo(env('MAIL_ADMIN_EMAIL_REPLY'), 'CFC Admin');
                    $m->to(env('MAIL_ADMIN_EMAIL_RECEVIER'), 'CFC Admin')->subject('Sistem CFC : Penghantaran Penilaian Projek oleh Konsesi');
                });

                return response()->json(['result' =>route('projects.index', ['id'=>$request->project_id, 'submittion_date'=>date('d/m/Y'),'submittion'=>'success'])]);
            }else{
                return response()->json(['result' =>route('projects.index')]);
            }
            
//            Project::where('status',$request->asses?sment_status);
        }catch (\Exception $e)
        {

            error_log("Error Added Status: ".$e->getMessage());

        }

    }

    public function deleteAssessmentYear(Request $request) {
        $yearToDelete = $request->get('delete');
        $project = Project::find($request->get('project_id'));
        if(empty($yearToDelete)) {
            throw new Exception();
        }
        $assessmentYears = json_decode($project->assessment_years);
        $settings = json_decode($project->settings, true);
        $sectionVerification = json_decode($project->section_verification, true);
        $sectionPdf = json_decode($project->section_pdf, true);
        $sectionStatus = json_decode($project->section_status, true);
        $sectionComment = json_decode($project->section_comment, true);
        $scoreAwardsTotals = json_decode($project->score_awards_totals, true);
        if($yearToDelete == $assessmentYears[0]) {
            throw new Exception("Unable to delete first assessment year");
        }
        foreach($assessmentYears as $key => $value) {
            if($key == $yearToDelete) {
                unset($assessmentYears[$key]);
                unset($settings[$key]);
                unset($sectionVerification[$key]);
                unset($sectionPdf[$key]);
                unset($sectionStatus[$key]);
                unset($sectionComment[$key]);
                foreach($scoreAwardsTotals as $scoreKey => $scoreValue) {
                    if($scoreValue['year'] == $value) {
                        unset($scoreAwardsTotals[$scoreKey]);
                        break 2;
                    }
                }
            }
        }
        $project->assessment_years = json_encode($assessmentYears);
        $project->settings = json_encode($settings);
        $project->section_verification = json_encode($sectionVerification);
        $project->section_pdf = json_encode($sectionPdf);
        $project->section_status = json_encode($sectionStatus);
        $project->section_comment = json_encode($sectionComment);
        $project->score_awards_totals = json_encode($scoreAwardsTotals);
        $project->save();

        return redirect('admin/projects/'.$project->id);
    }

    /**
     * @param Project $project
     * @return array
     */
    private function getProjectForView($project)
    {
        $evaluators = Evaluator::select(['id', 'name as title', 'id as option'])->get(['id', 'title', 'option'])->getDictionary();
        $data = Keyword::getGlobalData();
        $data['evaluators'] = $evaluators;
        $project->structure = json_encode($project->getProjectSettingsStructure());
        $projectNavigation = Config::get('project_navigation');
        if(!isset($project->section_verification)) {
            $project->section_verification = json_encode(Project::initSectionVerification([], $projectNavigation));
        }
        if(empty($project->section_pdf) || empty(json_decode($project->section_pdf))) {
            $project->section_pdf = json_encode(Project::initSectionPdf([], $projectNavigation));
        }
        if(empty($project->section_status) || empty(json_decode($project->section_status))) {
            $project->section_status = json_encode(Project::initSectionStatus([], $projectNavigation));
        }
        if(empty($project->section_comment) || empty(json_decode($project->section_comment))) {
            $project->section_comment = json_encode(Project::initSectionComment([], $projectNavigation));
        }
        if(empty($project->assessment_years)) {
            $project->assessment_years = [$project->assessment_year];
        }
        else {
            $project->assessment_years = json_decode($project->assessment_years);
        }
        if(empty($project->score_awards_totals)) {
            $project->score_awards_totals = "[]";
        }
       
        $highways = HighwayList::all();
        $con = HighwayList::select('highwayname')->groupBy('highwayname')->get();
        $data = [
            'sheet_structure' => Config::get('project_navigation'),
            'global_data' => $data,
            'project' => $project,
            'highwaylist' => $highways,
            'concessionaire'=>$con
        ];
        return $data;
    }
}
