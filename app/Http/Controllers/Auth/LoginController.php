<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Roles;
use App\Models\Permissions;
use App\Models\RolePermissions;
use App\Http\Controllers\PermissionsController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        if(User::get()->count() == 0){
            $role = new Roles([
                'title' => 'Administrator',
                'description' => "Role has full control of the system.",
                'active' => 'Y',
            ]);
            $role->save();
            $systemAdmin = new User([
                'name' => 'Administrator',
                'email' => 'admin@a.com',
                'idRole' => $role->id,
                'active' => 'Y',
                'password' => 'abc@123'
            ]);
            $systemAdmin->save();

            $permissions = Permissions::all()->toArray();
            if(count($permissions) == 0)
            {
                $k=0;
                $t=0;    
                foreach(PermissionsController::$analyticsData as $analytic){
                    $analyticObj = new Permissions([
                        'title' => $analytic,
                        'slug' => '/analytic',
                        'description' => PermissionsController::$description[$t],
                        'active' => 'Y',
                    ]);
                    $analyticObj->save();
                    $permitObj = new RolePermissions([
                        'idRole' => $role->id,
                        'idPermission' => $analyticObj->id,
                        'active' => 'Y'
                    ]);
                    $permitObj->save();
                    $t++;
                }
                foreach(PermissionsController::$permissions as $permission){
                    $permissionObj = new Permissions([
                        'title' => $permission,
                        'slug' => PermissionsController::$permissionsUrl[$k],
                        'description' => "NA",
                        'active' => 'Y',
                    ]);
                    $k++;
                    $permissionObj->save();
                    $permitObj = new RolePermissions([
                        'idRole' => $role->id,
                        'idPermission' => $permissionObj->id,
                        'active' => 'Y'
                    ]);
                    $permitObj->save();
                }
            }
        }
       
        $this->middleware('guest')->except('logout');
    }

	public function showLoginForm(){
		return view('admin.login');
	}
	
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
		return redirect('admin/dashboard');
      /*  return new JsonResponse([
            'result' => 1,
            'message' => 'You are successfully logged in',
            'name' => $user->name 
        ], 200); */
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->boolean('remember')
        );
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        Auth::logout();
        return redirect('/admin/login');
    }

}
