<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;
    protected $fillable = [
        'concessionaire_name',
        'assessment_year',
        'report_period',
        'lanes',
        'region',
        'code',
        'abbreviation',
        'highway_name',
        'kilometer_from',
        'kilometer_to',
        'length',
        'planning_percentage',
        'construction_percentage',
        'existing_percentage',
        'construction_start',
        'construction_completion',
        'open_to_public',
        'settings',
        'construction_header',
        'construction_footer',
        'lanes',
        'section_verification',
        'section_pdf',
        'section_status',
        'section_comment',
        'status',
        'user_id',
        'status_val',
    ];

    const PATH_DELIMITER = '.';

    public function project_rows() 
    {
        return $this->hasMany('\App\ProjectRow', 'project_id');
    }

    public function notes() 
    {
        return $this->hasMany('\App\Note', 'project_id');
    }

    public function evaluators() 
    {
        return $this->hasMany('\App\ProjectEvaluator', 'project_id')
            ->join('evaluators', 'project_evaluators.evaluator_id', '=', 'evaluators.id')
            ->select('evaluators.*', 'project_evaluators.approver');
    }

    public function evaluatorsList()
    {
        return $this->hasMany(ProjectEvaluator::class);
    }

    public function emission_factors() 
    {
        return $this->hasMany('\App\EmissionFactor', 'project_id');
    }



    public function getProjectSettingsStructure() 
    {
        $structure = [null];
        // todo: mount years indexed from 0 onward
        // todo: keep in consideration the year when adding rows
        foreach($this->project_rows as $row) {
            $path = $this->getPath($row);
            foreach($row->project_row_items as $rowItem) {
                $row->public_id = (int)$row->public_id;
                if(count($path) == 4) {
                    if(!isset($structure[$path[0]])) {
                        $structure[$path[0]] = [null];
                    }
                    if(!isset($structure[$path[0]][$path[1]])) {
                        $structure[$path[0]][$path[1]] = [null];
                    }
                    if(!isset($structure[$path[0]][$path[1]][$path[2]][$path[3]])) {
                        $structure[$path[0]][$path[1]][$path[2]][$path[3]] = [];
                    }
                    $structure[$path[0]][$path[1]][$path[2]][$path[3]][$row->public_id][$rowItem->name] = $rowItem->value;
                }
                else if(count($path) == 3) {
                    if(!isset($structure[$path[0]])) {
                        $structure[$path[0]] = [null];
                    }
                    if(!isset($structure[$path[0]][$path[1]])) {
                        $structure[$path[0]][$path[1]] = [null];
                    }
                    if(!isset($structure[$path[0]][$path[1]][$path[2]])) {
                        $structure[$path[0]][$path[1]][$path[2]] = [];
                    }
                    $structure[$path[0]][$path[1]][$path[2]][$row->public_id][$rowItem->name] = $rowItem->value;
                }
                else if(count($path) == 2) {
                    if(!isset($structure[$path[0]])) {
                        $structure[$path[0]] = [null];
                    }
                    if(!isset($structure[$path[0]][$path[1]])) {
                        $structure[$path[0]][$path[1]] = [];
                    }
                    $structure[$path[0]][$path[1]][][$rowItem->name] = $rowItem->value;
                }
                else if(count($path) == 1) {
                    if(!isset($structure[$path[0]])) {
                        $structure[$path[0]] = [];
                    }
                    $structure[$path[0]][$row->public_id][$rowItem->name] = $rowItem->value;
                }
            }
        }
        return $structure;
    }

    public function cleanProject() 
    {
        $this->project_rows()->each(function($projectRow) {
            $projectRow->delete();
        });
    }

    public static function storeProjectStructure($data) 
    {
        $projectNavigation = Config::get('project_navigation');
        $projectId = $data['id'];
        $project = Project::findOrFail($projectId); /** @var Project $project */

        // $project->concessionaire_name = $data['name'];
        $project->award = $data['award'];
        $project->report_period = $data['report_period'];
        $project->settings = json_encode($data['settings']);
        $project->section_verification = json_encode(empty($data['section_verification']) ? self::initSectionVerification([], $projectNavigation) : $data['section_verification']);
        $project->section_pdf = json_encode(empty($data['section_pdf']) ? self::initSectionPdf([], $projectNavigation) : $data['section_pdf']);
        $project->section_status = json_encode(empty($data['section_status']) ? self::initSectionStatus([], $projectNavigation) : $data['section_status']);
        $project->section_comment = json_encode(empty($data['section_comment']) ? self::initSectionComment([], $projectNavigation) : $data['section_comment']);
        $project->construction_header = json_encode($data['construction_header']);
        $project->construction_footer = json_encode($data['construction_footer']);
        $project->construction_work_values = json_encode($data['construction_work_values']);
        $project->certified_1 = $data['certified_1'];
        $project->certified_2 = $data['certified_2'];
        $project->silver_1 = $data['silver_1'];
        $project->silver_2 = $data['silver_2'];
        $project->gold_1 = $data['gold_1'];
        $project->gold_2 = $data['gold_2'];
        $project->platinum_1 = $data['platinum_1'];
        $project->platinum_2 = $data['platinum_2'];
        $project->score_awards_totals = json_encode($data['score_awards_totals']);
        $project->save();
        $project->cleanProject();
        self::mustStoreSettingsRow($project->id, $data['settings']);
    }

    public static function initSectionVerification($verifications, $currentSection) {
        foreach($currentSection as $key => $stage) {
            $stages = $stage['stages'];
            $verifications[$key] = !empty($stages) ? self::initSectionVerification([], $stages) : false;
        }
        return $verifications;
    }

    public static function initSectionPdf($pdfs, $currentSection) {
        foreach($currentSection as $key => $stage) {
            $stages = $stage['stages'];
            $pdfs[$key] = !empty($stages) ? self::initSectionPdf([], $stages) : null;
        }
        return $pdfs;
    }

    public static function initSectionStatus($Status, $currentSection) {
        foreach($currentSection as $key => $st) {
            $sts = $st['stages'];
            $Status[$key] = !empty($sts) ? self::initSectionStatus([], $sts) : null;
        }
        return $Status;
    }


    public static function initSectionComment($comments, $currentSection) {
        foreach($currentSection as $key => $comment) {
            $comms = $comment['stages'];
            $comments[$key] = !empty($comms) ? self::initSectionComment([], $comms) : null;
        }
        return $comments;
    }

    private static function mustStoreSettingsRow($projectId, $data, $steps=array()) {
        foreach($data as $key => $value) {
            if(is_array($value) && !empty($value)) {
                $steps[] = $key;
                if(self::mustStoreSettingsRow($projectId, $value, $steps)) {
                    array_pop($steps);
                    self::storeRow($projectId, $value, $key, $steps);
                }
                else {
                    array_pop($steps);
                }
            }
            else {
                // leaf found, return
                if(!empty($value)) {
                    return true;
                }
            }
        }
        return false;
    }

    private static function storeRow($projectId, $data, $key, $steps) {
        $projectRow = ProjectRow::create([
            'public_id' => $key + 1,
            'path' => implode(self::PATH_DELIMITER, $steps),
            'project_id' => $projectId
        ]);

        foreach($data as $key => $value) {
            try {
                $row = [
                    'project_row_id' => $projectRow->id,
                    'name' => $key,
                    'value' => $value
                ];
                ProjectRowItem::create($row);
            }
            catch(\Exception $e) {
                error_log("Error creating new project row item with data ".print_r($row,true)
                    .": ".$e->getMessage());
            }
        }
    }

    private function getPath($row) {
        $path = explode(self::PATH_DELIMITER, $row->path);
        foreach($path as $key => $value) {
            $path[$key] = (int)$value;
        }
        return $path;
    }

    public function concessionaire()
    {
        return $this->belongsTo(User::class, 'concessionaire_name');
    }
}
