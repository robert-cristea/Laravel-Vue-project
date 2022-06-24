<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\User;
use Socialite;
use Request;
use Validator;
use App\Keyword;
use App\ADService;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.sessions.login');
    }

    public function postLogin(Requests\LoginRequest $request)
    {
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
        
        if (!preg_match($regex, $request->email)) 
        {

            //check user data at active directory
            $AD_Result = ADService::AD_login( $request->email, $request->password );
            $AD_Result = json_decode($AD_Result);

            //for Admin and Auditor login
            $user = User::where('ad_username', $request->email)->first();   
            if ($AD_Result->result && $user) {
                //flash('Welcome to CFC.')->success();
                Auth::login($user);  
                $userId = Auth::id(); 
               
                $login_count = $user->login_count;
                $login_count = $login_count+1;
                User::where("id",$userId)->update(array("login_count"=>$login_count));

                if (Auth::user()->isAdmin()) {
                // echo "Here 1"; die;
                    return redirect()->to('/admin/projects');
                } else {
                // echo "Here 2"; die;
                    return redirect()->to('/admin/projects');
                }
            }


        }else if( User::login($request)){
            //for conssessionaire login
            $userId = Auth::id();
            $user_all = User::where("id",$userId)->first();
            $login_count = $user_all->login_count;
            $login_count = $login_count+1;
            User::where("id",$userId)->update(array("login_count"=>$login_count));

            return redirect()->to('/admin/projects');
        }
       // flash('Invalid Login Credentials')->error();
        
        return redirect()->back();
    }

    public function logOut()
    {
        Auth::logout();

        return redirect()->to('/login');
    }

    public function register()
    {
        $errors = array();
        $success = "";
        if (Request::isMethod('post')) {

            $rules = array(
                'password' => 'required',
                'password_confirmation' => 'required',
                'email'=>  'required',
                'first_name'=>  'required',
                'last_name'=>  'required',

            );

                $rules['password'] = 'confirmed|min:6';
                $rules['email']= 'required|unique:users,email';


            $validator = Validator::make(Request::all(),$rules);
            if($validator->fails()) {
                $errors = $validator->errors();
            }else{

                
                $user = new User();
                $user->name= Request::input('first_name')." ".Request::input('last_name');

                $user->email= Request::input('email');
                $user->password= bcrypt(Request::input('password'));

                $user->save();

                $success = "Registered Successfully";


                //echo "<pre>";print_r($request->all()); echo "</pre>"; die;
            }


        }
        return view('admin.sessions.register',array('success'=>$success,'errors'=>$errors));
    }



    /**
     * Redirect the user to the authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $provider_user = Socialite::driver($provider)->user();
        $user = $this->findUserByProviderOrCreate($provider, $provider_user);
        auth()->login($user);
        flash('Welcome to Laraspace.')->success();

        return redirect()->to('/admin');
    }

    private function findUserByProviderOrCreate($provider, $provider_user)
    {
        $user = User::where($provider . '_id', $provider_user->token)
            ->orWhere('email', $provider_user->email)
            ->first();
        if (!$user) {
            $user = User::create([
                'name' => $provider_user->name,
                'email' => $provider_user->email,
                $provider . '_id' => $provider_user->token
            ]);
        } else {
            // Update the token on each login request
            $user[$provider . '_id'] = $provider_user->token;
            $user->save();
        }

        return $user;
    }

    
}
