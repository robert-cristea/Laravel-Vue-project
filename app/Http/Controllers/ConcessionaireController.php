<?php

namespace App\Http\Controllers;


use Mail;
use App\Role;
use App\User;
use App\UserRole;
use App\UserConcessionaire;
use Illuminate\Http\Request;
use App\Http\Requests\UserConcessionaireRequest;


class ConcessionaireController extends Controller
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
       
	   	$concessionaires = User::where('role', 'concessionaire');
		
        if($request->get('filter_cols') == 'alpha_asc') {
            $concessionaires = $concessionaires->orderby('name','ASC');
        }elseif($request->get('filter_cols') == 'alpha_desc') {
            $concessionaires = $concessionaires->orderby('name','DESC');
        }else{
            $concessionaires = $concessionaires->orderby('id','DESC');
        }
        $name = '';
        if($request->get('name') != '') {
            $name = $request->get('name');
            $concessionaires = $concessionaires->where(function($q) use ($name) {
                $q->where('name', 'like', '%'.$name.'%');
            });
        }
		$concessionaires = $concessionaires->paginate($pageLength);

        $filter_cols = $request->get('filter_cols');
		

        return view('admin.concessionaires.index', compact('concessionaires', 'pageLength', 'name', 'filter_cols'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.concessionaires.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserConcessionaireRequest $request)
    {
        $validated = $request->validated();
        $data = $request->all();
        $role = Role::where('name', 'Concessionaire')->first();
        $password = $data['password'];
        $data['password'] = bcrypt($data['password']);
        $data['role'] = strtolower($role->name);
        $user = User::create($data);
        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);
        UserConcessionaire::create([
            'user_id' => $user->id,
            'person_in_charge' => $request->input('person_in_charge')
        ]);
        

        Mail::send('emails.create-concessionaire', ['user' => $user, 'password'=>$password ], function ($m) use ($user) {
            $m->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
 
            $m->to($user->email, $user->name)->subject('Sistem CFC : Pembukaan Akaun Konsesi');
        });

        return redirect()->route('concessionaires.index')->with('success', 'User Concessionaire created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $concessionaire = User::find($id);

        return view('admin.concessionaires.edit', compact('concessionaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserConcessionaireRequest $request, $id)
    {
        $validated = $request->validated();
        $data = $request->all();
        $password = "";
        $user = User::find($id);
        $concessionaire = UserConcessionaire::where('user_id', $id)->first();
        if (!empty($data['password'])) {
            $password = $data['password'];
            $data['password'] = bcrypt($data['password']);  
        }
        $user->update($data);
        if ($concessionaire) {
            $concessionaire->update([
                'person_in_charge' => $request->input('person_in_charge')
            ]);
        } else {
            UserConcessionaire::create([
                'user_id' => $user->id,
                'person_in_charge' => $request->input('person_in_charge')
            ]);
        }

        if($data['send_email']==1)
        {
            Mail::send('emails.create-concessionaire', ['user' => $user, 'password'=>$password ], function ($m) use ($user) {
                $m->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
    
                $m->to($user->email, $user->name)->subject('Sistem CFC : Pembukaan Akaun Konsesi');
            });
        }
        return redirect()->route('concessionaires.index')->with('success', 'User Concessionaire updated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $concessionaire = User::find($id);

        return view('admin.concessionaires.show', compact('concessionaire'));
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
        $user->user_concessionaire()->delete();
        $userrole->delete();
        $user->delete();
        
        return redirect()->back()->with('success', 'User Concessionaire deleted successfully.');
    }
}
