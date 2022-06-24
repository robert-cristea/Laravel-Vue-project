<?php

namespace App\Http\Controllers;

use App\User;
use App\UserRole;
use App\UserAuditor;
use App\UserConcessionaire;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();

        return view('admin.users.index')->with('users', $users);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.show')->with('user', $user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        flash('User Deleted')->success();

        return redirect()->back();
    }

    public function concessionaires()
    {
        $concessionaires  = UserConcessionaire::with(['user_meta', 'person_charge'])->get();

        return view('admin.users.concessionaires', compact('concessionaires'));
    }

    public function delete_concession($id){

            UserConcessionaire::where('id',$id)->delete();
            return redirect('/admin/concessionaires');
    }
    public function concession(Request $request,$id=null){

        if($request->isMethod('post')) {
            $all = $request->all();
            //echo "<pre>";print_r($all); die;
            if(!isset($all["concession_id"])){

                $is_user_exists = User::where("email",$all["email"])->first();
                if(empty($is_user_exists)){
                    $user = new User();
                    $user->name= $all["name"];
                    $user->phone_number = $all["phone_number"];
                    $user->fax = $all["fax"];

                    $user->registration_number = $all["registration_number"];
                    $user->website = $all["website"];
                     $user->address = $all["address"];



                    $user->email= $all["email"];
                    if(!empty($all["password"])){
                        $user->password= bcrypt($all["password"]);
                    }else{
                        $user->password= bcrypt("abcdefghij");
                    }
                    $user->save();
                   $is_user_exists =
                   $is_user_exists = User::where("email",$all["email"])->first();
                }else{
                    $p = array();
                    if(!empty($all["password"])){
                        $p["password"]= bcrypt($all["password"]);
                    }else{
                        $p["password"]= bcrypt("abcdefghij");
                    }
                    $p["phone_number"] = $all["phone_number"];
                    $p["fax"] = $all["fax"];

                    $p['registration_number'] = $all["registration_number"];
                    $p['website'] = $all["website"];
                    $p['address'] = $all["address"];

                    User::where('id',$is_user_exists->id)->update(
                        $p
                    );
                }

                $is_user_role_exists = UserRole::where("user_id",$is_user_exists->id)->where("role_id",2)->first();
                if(empty($is_user_role_exists)){
                    $user_role = new UserRole();
                    $user_role->user_id = $is_user_exists->id;
                    $user_role->role_id = 2;
                    $user_role->save();
                }
                $is_con_exists = UserConcessionaire::where("user_id",$is_user_exists->id)->where("person_in_charge",$all["person_in_charge"])->first();
                if(empty($is_con_exists)){
                    $uc = new UserConcessionaire();
                    $uc->user_id = $is_user_exists->id;
                    $uc->person_in_charge = $all["person_in_charge"];
                    $uc->save();
                }

            }else{
                $concession_id = $all['concession_id'];
                $user_concession = UserConcessionaire::where("id",$concession_id)->first();
                /*
                 * Lets see if the person in charge changed
                 */
                if($all['person_in_charge']!=$user_concession->person_in_charge){
                    //its means person in charge changed
                    UserConcessionaire::where('id',$concession_id)->update(array('person_in_charge'=>$all['person_in_charge']));
                    $user_concession = UserConcessionaire::where("id",$concession_id)->first();


                }
                $main_user_concession_id = $user_concession->user_id;
                $person_charge_id = $user_concession->person_in_charge;
                $mu = array();
                if(!empty($all['password'])){$mu['password']= bcrypt($all['password']);}
                $mu['name'] = $all['name'];
                $mu['phone_number'] = $all['phone_number'];
                $mu['fax'] = $all['fax'];
                $mu['registration_number'] = $all["registration_number"];
                $mu['website'] = $all["website"];
                $mu['address'] = $all["address"];
                User::where("id",$main_user_concession_id)->update($mu);




            }

            return response()
                ->json(array("s"=>1,"m"=>"Data Successfully added"));

        }
        $data = "";
        if($id!==null){
            $data  = UserConcessionaire::with(['user_meta','person_charge'])->where('id',$id)->first();
        }
        $users = User::get();
        return view('admin.users.concession',array('users'=>$users,'data'=>$data));

    }



    public function auditors(){
        $cons  = UserAuditor::with(['user_meta'])->get();

        return view('admin.users.auditors',array('cons'=>$cons));

    }
    public function delete_auditor($id){

        UserAuditor::where('id',$id)->delete();
        return redirect('/admin/auditors');
    }
    public function auditor(Request $request,$id=null){

        if($request->isMethod('post')) {
            $all = $request->all();
            //echo "<pre>";print_r($all); die;
            if(!isset($all["auditor_id"])){

                $is_user_exists = User::where("email",$all["email"])->first();
                if(empty($is_user_exists)){
                    $user = new User();
                    $user->name= $all["name"];
                    $user->phone_number = $all["phone_number"];
                    $user->fax = $all["fax"];
                    $user->address = $all["address"];



                    $user->email= $all["email"];
                    if(!empty($all["password"])){
                        $user->password= bcrypt($all["password"]);
                    }else{
                        $user->password= bcrypt("abcdefghij");
                    }
                    $user->save();
                    $is_user_exists =
                    $is_user_exists = User::where("email",$all["email"])->first();
                }else{
                    $p = array();
                    if(!empty($all["password"])){
                        $p["password"]= bcrypt($all["password"]);
                    }else{
                        $p["password"]= bcrypt("abcdefghij");
                    }
                    $p["phone_number"] = $all["phone_number"];
                    $p["fax"] = $all["fax"];
                    $p['address'] = $all["address"];


                    User::where('id',$is_user_exists->id)->update(
                        $p
                    );
                }

                $is_user_role_exists = UserRole::where("user_id",$is_user_exists->id)->where("role_id",3)->first();
                if(empty($is_user_role_exists)){
                    $user_role = new UserRole();
                    $user_role->user_id = $is_user_exists->id;
                    $user_role->role_id = 3;
                    $user_role->save();
                }
                $is_con_exists = UserAuditor::where("user_id",$is_user_exists->id)->first();
                if(empty($is_con_exists)){
                    $uc = new UserAuditor();
                    $uc->user_id = $is_user_exists->id;
                    if($all['status']=="male"){
                        $uc-> assigned  =1;
                    }else{
                        $uc-> submitted  =1;
                    }

                    $uc->save();
                }else{

                }

            }else{
                $concession_id = $all['auditor_id'];
                $user_concession = UserAuditor::where("id",$concession_id)->first();
                /*
                 * Lets see if the person in charge changed
                 */

                $main_user_concession_id = $user_concession->user_id;

                $mu = array();
                if(!empty($all['password'])){$mu['password']= bcrypt($all['password']);}
                $mu['name'] = $all['name'];
                $mu['phone_number'] = $all['phone_number'];
                $mu['fax'] = $all['fax'];
                $mu['address'] = $all["address"];

                User::where("id",$main_user_concession_id)->update($mu);




            }

            return response()
                ->json(array("s"=>1,"m"=>"Data Successfully added"));

        }
        $data = "";
        if($id!==null){
            $data  = UserAuditor::with(['user_meta'])->where('id',$id)->first();
        }
        $users = User::get();
        return view('admin.users.auditor',array('users'=>$users,'data'=>$data));

    }

    public function lister(){
        $all = User::get();
        echo count($all);
        foreach ($all as $user){
            echo $user->name.'<br>';
            echo $user->email.'<br>';

        }



    }
}
