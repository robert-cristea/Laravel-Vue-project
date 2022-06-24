<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\UserRole;
use App\ADService;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;



class AdminController extends Controller
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

		$admins = User::where('role', 'admin');
		
        if($request->get('filter_cols') == 'alpha_asc') {
            $admins = $admins->orderby('name','ASC');
        }elseif($request->get('filter_cols') == 'alpha_desc') {
            $admins = $admins->orderby('name','DESC');
        }else{
            $admins = $admins->orderby('id','DESC');
        }
        $name = '';
        if($request->get('name') != '') {
            $name = $request->get('name');
            $admins = $admins->where(function($q) use ($name) {
                $q->where('name', 'like', '%'.$name.'%');
            });
        }
		$admins = $admins->paginate($pageLength);
		
        $filter_cols = $request->get('filter_cols');

        return view('admin.admins.index', compact('admins', 'name','filter_cols','pageLength'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $validated = $request->validated();
        $data = $request->all();
        $role = Role::where('name', 'admin')->first();
        $data['password'] = bcrypt($data['password']);
        $data['role'] = strtolower($role->name);
        if (!empty($request['username'])) {
            $data['ad_username'] = $request['username'];
        }
        $user = User::create($data);
        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);
        
        return redirect()->route('admins.index')->with('success', 'User Admin created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = User::find($id);

        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        $validated = $request->validated();
        $data = $request->all();
        $user = User::find($id);
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);

        return redirect()->route('admins.index')->with('success', 'User Admin updated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = User::find($id);

        return view('admin.admins.show', compact('admin'));
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
        $userrole->delete();
        $user->delete();
        
        return redirect()->back()->with('success', 'User Admin deleted successfully.');
    }


    /**
     * Show the form for creating a new AD admin resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function adCreate()
     {
         return view('admin.admins.adcreate');
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
