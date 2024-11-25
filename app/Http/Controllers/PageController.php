<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class PageController extends Controller {

    public function signupForm() {
        return view('front.signup-form');
    }

    public function signup(Request $request) {
//        dd($request->all());
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
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
        } elseif ($request->has('idFirebase')) {
            return response()->json(['success' => "SUCCESS"], 200);
        } else {
            return redirect('/');
        }
    }

    public function index() {
        $homebuilder = homeBuilder();
        return view('front.home', compact('homebuilder'));
    }

    public function about() {
//        return homeBuilder();
        return view('front.about');
    }

    public function contactUs() {
        return view('front.contact-us');
    }

    public function saveContactUs(Request $request) {
//        dd($request->all());
        $data = new \App\Models\ContactFormData();
        $data->fill($request->all());
        $data->save();
        Session::flash('message', 'Thank You For Connecting.We will get back to you soon.!');
        return redirect('contact-us');
    }

    public function shopPage(Request $request) {
        $products = fetchProducts($request);
        return view('front.shop', compact('products'));
    }

    public function privacyPolicy() {
        return view('front.privacy-policy');
    }

    public function termsConditions() {
        return view('front.terms-conditions');
    }

    public function productDetail($slug) {
//        dd($slug);
        $product = \App\Models\Products::where('slug', '=', $slug)->first();
        return view('front.product-details', compact('product'));
    }

    public function categoryDetail(Request $request ,$slug) {
        $category = \App\Models\Categories::where('slug', '=', $slug)->first();
        $products = fetchProducts($request);
        return view('front.shop', compact('category','products'));
    }

    public function searchProduct(Request $request) {
        $searchQuery = $request->title;
        return autoCompleteProducts($searchQuery);
    }

}
