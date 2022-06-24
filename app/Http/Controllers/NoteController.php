<?php

namespace App\Http\Controllers;

use App\Note;
use App\Project;
use Illuminate\Support\MessageBag;

class NoteController extends Controller
{
    /**
     * Creates resource.
     * @return \Illuminate\Http\Response
     */
    public function post(MessageBag $messageBag)
    {
        try {
            $project = Project::findOrFail(request()->project_id);

            Note::create([
                'note' => request()->note,
                'comment' => request()->comment,
                'project_id' => $project->id
            ]);

            return back()
                ->with('success', 'Note created successfully.');
        }
        catch(\Exception $e) {
            error_log($e->getMessage());
            $messageBag->add('token', $e->getMessage());
            return back();
        }
    }

    public function delete() {
        Note::findOrFail(request()->id)->delete();
    }
}
