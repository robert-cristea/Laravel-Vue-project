<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Support\Facades\Config;

class PdfUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfUploadPost()
    {
        $pdfPath = Config::get('app.pdf_path');

        request()->validate([
            'file' => 'required|max:10240',
        ]);
        $data = request()->all();

        try {
            $project = Project::findOrFail(request()->project_id);
            $extension = request()->file->getClientOriginalExtension();

            $pdfName = $project->id.'_'.$data['pdf_assessment_year'].'_'.$data['pdf_section'].'_'.time() . '.' . $extension;

            request()->file->move(public_path($pdfPath), $pdfName);

            return \Response::json(array('success' => true, 'file' => $pdfName));
        }
        catch(\Exception $e) {
            error_log("Errors uploading pdf: ".$e->getMessage());
            return back()
                ->with('errors', ['Error uploading pdf: '.$e->getMessage()]);
        }
    }

    public function pdfUploadWorkProgram() {
        $pdfPath = Config::get('app.pdf_path');

        request()->validate([
            'pdf' => 'required|max:10240',
        ]);

        try {
            $project = Project::findOrFail(request()->project_id);
            $extension = request()->pdf->getClientOriginalExtension();

            $pdfName = "work_program_".$project->id.'_'.time() . '.' . $extension;

            request()->pdf->move(public_path($pdfPath), $pdfName);

            $project->work_program = "/".$pdfPath.$pdfName;
            $project->save();

            return back()
                ->with('success', 'You have successfully upload image.')
                ->with('pdf', $pdfName);
        }
        catch(\Exception $e) {
            error_log("Errors uploading pdf: ".$e->getMessage());
            return back()
                ->with('errors', ['Error uploading pdf: '.$e->getMessage()]);
        }
    }
}
