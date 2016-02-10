<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Lang;
use Cookie;
use Config;
use JWTAuth;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    /**
     * Return login view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin($userType)
    {
        return view('auth.login');
    }

    public function showLoginForm(Request $request)
    {
        return view('auth.login');
    }

    /**
     * Validate and Authenticate user login.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required', 'password' => 'required',
        ]);// Returns response with validation errors if any, and 422 Status Code (Unprocessable Entity)

        $credentials = $request->only('username', 'password');
        $email = array_pull($credentials,'username');
        $credentials['email'] = $email;

        try {
            if( ! $token = JWTAuth::attempt($credentials) ) { //Invalid credentials
                return response(array('msg'=>trans('auth.failed')),401)->header('Content-Type','application/json');
            }
        } catch(JWTException $ex) { //Something went wrong creation a JWT token
            return response(array('msg'=>trans('errors.token')),401)->header('Content-Type','application/json');
        } 


        return response(array('msg'=>trans('auth.success')),200)->header('Content-Type','application/json')->withCookie('token',$token,Config::get('jwt.ttl')); //Succesful authentication and JWT token creation
    }

    /**
     * Logout a user
     */
    public function logout(Request $request)
    {
        try {

            $token = Cookie::get('token');
        
            if( is_null($token) ) 
            {
                $token = JWTAuth::setRequest($request)->getToken();

                if( $token )
                {
                    JWTAuth::setToken($token)->invalidate();
                }
            }

            else
            {
                JWTAuth::setToken($token)->invalidate();
            }
        } catch(JWTException $ex) {
        
        } finally {
            return response([],200)->withCookie(Cookie::forget('token'));//Either way we should return this.
        }
    } 

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
