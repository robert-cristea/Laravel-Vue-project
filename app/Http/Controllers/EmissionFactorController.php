<?php

namespace App\Http\Controllers;

use App\EmissionFactor;
use App\Project;
use Illuminate\Support\MessageBag;

class EmissionFactorController extends Controller
{
    /**
     * Creates resource.
     * @return \Illuminate\Http\Response
     */
    public function post(MessageBag $messageBag)
    {
        try {
            $project = Project::findOrFail(request()->project_id);

            $data = request()->toArray();
            $data['project_id'] = $project->id;

            $ef = EmissionFactor::create($data);
            $ef->type = $data['type'];  // fixme is create failing with 'type' and SQLserver?
            $ef->save();

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
        EmissionFactor::findOrFail(request()->id)->delete();
    }
}
