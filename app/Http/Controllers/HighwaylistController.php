<?php

namespace App\Http\Controllers;

use App\HighwayList;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class HighwaylistController extends Controller
{
    public function index(Request $request)
    {

       
        $data = HighwayList::orderBy('id' , 'desc')->get();
        $highwayname = '';
        if($request->get('highwayname') != '') {
            $highwayname = $request->get('highwayname');
            $data = HighwayList::where(function($q) use ($highwayname) {
                $q->where('routename', 'like', '%'.$highwayname.'%');
            })->orderBy('id' , 'desc')->get();
        }
       
        //'data' => $data = HighwayList::orderBy('id')->orderBy('region')->get(),
        $data = [
            'data' => $data,
            'highwayname' => $highwayname,
            'concessionaire'  =>$concessionaires  = User::where('role', 'concessionaire')->get(),
            'error' => false,
        ];
        return view('admin.highwaylist.highwaylist', $data);
    }

    public function saveList(Request $request)
    {



//        dd($request->all());
        foreach ($request->input('route') as $key => $value) {

            $highway = new HighwayList;
            $highway->highwayname = $request->highwayname;
            $highway->routename = $value;
            $highway->region = $request->region;
            $highway->code = $request->code[$key];
            $highway->abbreviation = $request->abbreviation[$key];
            $highway->from = $request->from[$key];
            $highway->to = $request->to[$key];
            $highway->save();

        }



        $data = [
            'data' => $data = HighwayList::all(),
            'concessionaire'  =>$concessionaires  = User::where('role', 'concessionaire')->get(),
            'error' => false
        ];
        return redirect('admin/settings/highwaylist')->with('data', $data);
    }



    public function editHighway(Request $request)
    {
        try{


            $highway = HighwayList::where('highwayname',decrypt($request->con))
                ->where('region',decrypt($request->region))
                ->get();

            $data = [
                'data' => $data = $highway,
                'concessionaire'  =>$concessionaires  = User::where('role', 'concessionaire')->get(),
                'error' => false
            ];

            return view('admin.highwaylist.edit-highway', $data);
        }catch (\Exception $exception)
        {

            error_log($exception->getMessage());
        }



    }
    public function update(Request $request ,$id){

        try{
//            dd($request->all());
            foreach ($request->input('highway') as $key =>$highway)
            {

//                echo $request->route[$key];

                Project::where('concessionaire_name',decrypt($request->con))
                    ->where('region',decrypt($request->regions))
                    ->where('highway_name',$highway)
                    ->update([
                        'highway_name'=>$request->route[$key],

                    ]);
            }


//            dd('sds');
            $poject = Project::where('concessionaire_name',decrypt($request->con))
                ->where('region',decrypt($request->regions))
                ->update([
                    'concessionaire_name'=>$request->highwayname,
                    'region'=>$request->region
                ]);



            $highway = HighwayList::where('highwayname',decrypt($request->con))
                ->where('region',decrypt($request->regions))
                ->forcedelete();
            foreach ($request->input('route') as $key => $value) {

                $highway = new HighwayList;
                $highway->highwayname = $request->highwayname;
                $highway->routename = $value;
                $highway->region = $request->region;
                $highway->code = $request->code[$key];
                $highway->abbreviation = $request->abbreviation[$key];
                $highway->from = $request->from[$key];
                $highway->to = $request->to[$key];
                $highway->save();

            }
            $data = [
                'data' => $data = HighwayList::orderBy('region')->get(),
                'concessionaire'  =>$concessionaires  = User::where('role', 'concessionaire')->get(),
                'error' => false
            ];
        }catch (\Exception $exception)
        {

        }

//        return redirect((->with('data', $data);


//        return redirect()->route('highway-edit',['data'=>$data]);
        return redirect('admin/settings/highwaylist')->with('data', $data);
    }

    public function destroy($id)
    {
        $highway = HighwayList::findorFail($id)->delete();
        return redirect()->route('highwaylist.index');


    }
}
