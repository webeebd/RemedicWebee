<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Session;

class CustomerLoginController extends Controller {
    
    public $successStatus = 200;
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

    protected $redirectTo = '/profile';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    public function __construct() {
        $this->middleware('guest:web')->except('logout');
    }

    public function login(Request $request) {
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            if ($request->ajax()) {
                $this->saveCart();
                return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
            } elseif ($request->has('idFirebase')) {
                $user = Auth::guard('web')->user();
                $success['token'] = $user->createToken('MyApp')->accessToken;
                return response()->json(['success' => $success], $this->successStatus);
            } else {
                $this->saveCart();
                return redirect('/profile');
            }
        } else {
            if ($request->ajax()) {
                return response()->json(['error' => 'Unauthorised'], 401);
            } elseif ($request->has('idFirebase')) {
                return response()->json(['error' => 'Unauthorised'], 401);
            } else {
                flash('Check Your Credentials and Try Again.')->warning();
                return redirect()->back();
            }
        }
        // if unsuccessful, then redirect back to the login with the form data
    }

    public function logout(Request $request) {
        Auth::guard('web')->logout();

        //$request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/');
    }

    protected function guard() {
        return Auth::guard('web');
    }

    public function showLoginForm() {
        return view('front.login');
    }

    public function saveCart() {
        $cart = session()->get('cart');
        if (!empty($cart)) {
            foreach ($cart as $var) {
                $savecart = new \App\Models\Cart();
                $savecart->idProduct = $var['idProduct'];
                $savecart->qty = $var['qty'];
                if(isset($var['amc'])){
                    $savecart->amc = $var['amc'];
                }
                $savecart->idUser = Auth::user()->id;
                $savecart->save();
            }
            session::forget('cart');
            Session::save();
        }
    }
}
