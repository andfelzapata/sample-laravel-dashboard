<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Stores response message.
     *
     * @var string
     */
    private $message;

    /**
     * Stores status code for response.
     *
     * @var int
     */
    private $statusCode;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Return login view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin($userType)
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

        // Attempt authentication with username or email.
        if ($this->authenticate($credentials))
        {
            return response(array('msg' => $this->message), $this->statusCode) // 200 Status Code: Standard response for successful HTTP request
            ->header('Content-Type', 'application/json');
        }

        // Authenticate
        return response(array('msg' => $this->getFailedLoginMessage()), 401) // 400 Status Code: Forbidden, needs authentication
        ->header('Content-Type', 'application/json');

    }

    /**
     * Attempt authentication with username or email.
     *
     * @param $credentials
     *
     * @return bool
     */
    private function authenticate($credentials)
    {
        $username = $credentials['username'];

        if(! $this->accountActive($username) && $this->usernameExists($username) ) {

            $this->message = array("Your account is inactive");
            $this->statusCode = 422;
            return True;
        }

        $this->statusCode = 200;

        // Authenticate with username.
        if (Auth::attempt( ['username' => $credentials['username'], 'password' => $credentials['password']] )) {

            return True;
        }

        // Authenticate with email address.
        elseif (Auth::attempt(['email'=> $credentials['username'], 'password' => $credentials['password']] )) {

            return True;
        }

        return False;
    }

    /**
     * Check for usernmae existence.
     *
     * @param $username
     *
     * @return Bool
     */
    private function usernameExists($username) {

        return User::usernameExists($username);
    }

    /**
     * Check if user's account is active.
     *
     * @param $username
     *
     * @return Bool
     */
    private function accountActive($username)
    {
        return User::accountActive($username);
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
