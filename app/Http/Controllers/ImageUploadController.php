<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Support\Facades\Config;

class ImageUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost()
    {
        $imagePath = Config::get('app.images_path');

        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $project = Project::findOrFail(request()->project_id);
            $extension = request()->image->getClientOriginalExtension();

            $imageName = $project->id.'_'.time() . '.' . $extension;

            // store image path in project
            request()->image->move(public_path($imagePath), $imageName);

            $project->image = "/".$imagePath.$imageName;
            $project->save();

            return back()
                ->with('success', 'You have successfully upload image.')
                ->with('image', $imageName);
        }
        catch(\Exception $e) {
            return back()
                ->with('errors', ['Error uploading image: '.$e->getMessage()]);
        }
    }
}
