<?php

namespace App\Http\Controllers;

use Mail;
use App\Role;
use App\User;
use App\UserRole;
use App\UserAuditor;
use App\ADService;
use Illuminate\Http\Request;
use App\Http\Requests\UserAuditorRequest;


class AuditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $pageLength = 10;
        if($request->get('pageLength') != '') {
            $pageLength = $request->get('pageLength');
        }

	   	$auditors = User::where('role', 'auditor');
		
        if($request->get('filter_cols') == 'alpha_asc') {
            $auditors = $auditors->orderby('name','ASC');
        }elseif($request->get('filter_cols') == 'alpha_desc') {
            $auditors = $auditors->orderby('name','DESC');
        }else{
            $auditors = $auditors->orderby('id','DESC');
        }
        $name = '';
        if($request->get('name') != '') {
            $name = $request->get('name');
            $auditors = $auditors->where(function($q) use ($name) {
                $q->where('name', 'like', '%'.$name.'%');
            });
        }
		$auditors = $auditors->paginate($pageLength);

        $filter_cols = $request->get('filter_cols'); 
		

        return view('admin.auditors.index', compact('auditors', 'name', 'filter_cols', 'pageLength'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.auditors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAuditorRequest $request)
    {
       
        $validated = $request->validated();
        $data = $request->all();
        $role = Role::where('name', 'auditor')->first();
        $password = $data['password'];
        $username = $data['email'];
        $data['password'] = bcrypt($data['password']);
        $data['role'] = strtolower($role->name);

        if (!empty($request['username'])) {
            $data['ad_username'] = $data['username'];
            $username = $data['username'];
            $password = " Same as Active Directory Password";
        }
        
        $user = User::create($data);
        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);
        UserAuditor::create([
            'user_id' => $user->id,
            'status' => 'ASSIGNED',
        ]);

        Mail::send('emails.create-auditor', ['user' => $user, 'username'=>$username, 'password'=>$password ], function ($m) use ($user) {
            $m->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
 
            $m->to($user->email, $user->name)->subject('Sistem CFC : Pembukaan Akaun Penilai');
        });

        return redirect()->route('auditors.index')->with('success', 'User Auditor created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auditor = User::find($id);

        return view('admin.auditors.edit', compact('auditor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserAuditorRequest $request, $id)
    {
        $validated = $request->validated();
        $data = $request->all();
        $username = $data['email'];
        
        $user = User::find($id);
        $auditor = UserAuditor::where('user_id', $id)->first();

        if (!empty($data['password'])) {
            $password = $data['password'];
            $data['password'] = bcrypt($data['password']);
        }
        if ($user->ad_username!="") 
        {
            //for Ad User
            $username = $user->ad_username;
            $password = " Same as Active Directory Password";
        }
        $user->update($data);
        if ($auditor) {
            // $auditor->update([
            //     'status' => $request->input('status')
            // ]);
        } else {
            UserAuditor::create([
                'user_id' => $user->id,
                'status' => 'ASSIGNED',
            ]);
        }

        if($data['send_email']==1)
        {
            Mail::send('emails.create-auditor', ['user' => $user, 'username'=>$username, 'password'=>$password ], function ($m) use ($user) {
                $m->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
     
                $m->to($user->email, $user->name)->subject('Sistem CFC : Pembukaan Akaun Penilai');
            });
        }

        return redirect()->route('auditors.index')->with('success', 'User Auditor updated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auditor = User::find($id);

        return view('admin.auditors.show', compact('auditor'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $userrole = UserRole::where('user_id', $id)->first();
        $user->user_auditor()->delete();
        $userrole->delete();
        $user->delete();
        
        return redirect()->back()->with('success', 'User Auditor deleted successfully.');
    }

    /**
     * Show the form for creating a new AD Auditor resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function adCreate()
     {
         return view('admin.auditors.adcreate');
     }
 
     /**
      * Search a username in Active directory.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
      public function adSearch(Request $request)
      {
          //check user data at active directory
          $result = ADService::AD_Search( $request->username );
          
          return $result;
      }
 
}
