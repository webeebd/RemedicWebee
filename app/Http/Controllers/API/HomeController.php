<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerCart;
use Carbon\Carbon;
use Log;
use Cache;
use DB;

class HomeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $homebuilder = homeBuilder();
        $response = array(
            "home" => $homebuilder
        );
        return response()->json(['response' => $response]);
    }

    public function authentication(Request $request){
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('web')->user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;

            if(isset($request->idProduct)){
                if(count(json_decode($request->idProduct,true)) > 0)
                CustomerCart::whereIn('customer_cart.id',json_decode($request->idProduct,true))->update(
                    ['idUser' => $user->id]
                );
            }

            return response()->json(['response' => $success], 200);
        }else{
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function registration(Request $request){
        $rules = [
            'email' => 'unique:customers',
            'mobile' => 'unique:customers'
        ];
        $this->validate($request, $rules);
        $customer = new \App\Models\Customers();
        $customer->fill($request->all());
        $customer->active = 'Y';
        $customer->verified = 'N';
        $password = $request->password;
        $customer->password = bcrypt($password);
        $customer->save();
        return $this->authentication($request);
    }
}
