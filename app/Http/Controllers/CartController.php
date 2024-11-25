<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;

class CartController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user_loggedin = Auth::user();
        if ($user_loggedin != null) {
            $cart = \App\Models\Cart::where('idUser', '=', $user_loggedin->id)->get();
        } else {
            $cart = session()->get('cart');
        }
        return view('front.cart', compact('cart', 'user_loggedin'));
        
    }

    public function wishlist() {
        return view('front.wishlist');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
//        dd($request->all());
        $user_loggedin = Auth::user();
        if ($request->qty == null && $request->qty == 0) {
            $qty = 1;
        } else {
            $qty = $request->qty;
        }
        if ($user_loggedin != null) {
            $total_cart_items = 0;
            $subtotal = 0;
            $discount = 0;
            $cart_items = [];
            $cart = \App\Models\Cart::where('idProduct', '=', $request->idProduct)->where('idUser', '=', $user_loggedin->id)->first();
            if (!empty($cart)) {
                $cart->qty = $qty;
                if ($request->has('amc') && $request->amc == 'Y') {
                    $cartnew->amc = 'Y';
                }
                $cart->update();
            } else {
                $cartnew = new \App\Models\Cart();
                $cartnew->idProduct = $request->idProduct;
                $cartnew->qty = $qty;
                if ($request->has('amc') && $request->amc == 'Y') {
                    $cartnew->amc = 'Y';
                }
                $cartnew->idUser = $user_loggedin->id;
                $cartnew->save();
            }
            $cartitems = \App\Models\Cart::where('idUser', '=', $user_loggedin->id)->get();
            foreach ($cartitems as $c) {
                $product = \App\Models\Products::where('id', '=', $c->idProduct)->first();
                $total_cart_items += $c->qty;
                $cart_items[$c->idProduct]['qty'] = $c->qty;
                if ($c->amc == 'Y') {
                    $cart_items[$c->idProduct]['amc'] = 'AMC Included';
                } else {
                    $cart_items[$c->idProduct]['amc'] = '';
                }
                $cart_items[$c->idProduct]['product'] = $product;
                $subtotal += $product->sales_price * $c->qty;
                if ($product->pre_discount > 0) {
                    $discount += ($product->max_retail_price * $product->pre_discount / 100) * $qty;
                }
            }

            $totalamt = $subtotal - $discount;
            return response()->json(['success' => "SUCCESS", 'cart_items' => $cart_items, 'subtotal' => $subtotal, 'discount' => $discount, 'totalamt' => $totalamt, 'total_items' => $total_cart_items], 200, ['app-status' => 'success']);
        } else {
            return $this->saveSessioncart($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function saveSessioncart($request) {
        $cart_product_id = $request->idProduct;
        $total_cart_items = 0;
        $subtotal = 0;
        $discount = 0;
        $cart_items = [];
        if ($request->has('amc') && $request->amc == 'Y') {
            $amc = 'Y';
        } else {
            $amc = 'N';
        }
        if ($request->qty == null && $request->qty == 0) {
            $qty = 1;
        } else {
            $qty = $request->qty;
        }
        $cart = session()->get('cart');
        if (!$cart) {
            // if cart is empty then this the first product
            $cart = [
                $cart_product_id => [
                    "idProduct" => $request->idProduct,
                    "qty" => $qty,
                    "amc" => $amc
                ]
            ];
            session()->put('cart', $cart);
        } else if (isset($cart[$cart_product_id])) {
            // if cart not empty then check if this product exist then increment quantity
            $cart[$cart_product_id]['qty'] = $qty;
            $cart[$cart_product_id]['amc'] = $amc;
            session()->put('cart', $cart);
        } else {
            // if item not exist in cart then add to cart with quantity 
            $cart[$cart_product_id] = [
                "idProduct" => $request->idProduct,
                "qty" => $qty,
                "amc" => $amc
            ];
            session()->put('cart', $cart);
        }
        if (!empty($cart)) {
            foreach ($cart as $c) {
                $product = \App\Models\Products::where('id', '=', $c['idProduct'])->first();
                $total_cart_items += $c['qty'];
                $cart_items[$c['idProduct']]['qty'] = $c['qty'];
                if ($c['amc'] == 'Y') {
                    $cart_items[$c['idProduct']]['amc'] = 'AMC Included';
                } else {
                    $cart_items[$c['idProduct']]['amc'] = '';
                }
                $cart_items[$c['idProduct']]['product'] = $product;
                $subtotal += $product->sales_price * $c['qty'];
                if ($product->pre_discount > 0) {
                    $discount += ($product->max_retail_price * $product->pre_discount / 100) * $qty;
                }
            }
        }
        $totalamt = $subtotal - $discount;
        return response()->json(['success' => "SUCCESS", 'cart_items' => $cart_items, 'subtotal' => $subtotal, 'discount' => $discount, 'totalamt' => $totalamt, 'total_items' => $total_cart_items], 200, ['app-status' => 'success']);
    }

    public function deleteCartItem($idp) {
        $user_loggedin = Auth::user();
        if ($user_loggedin != null) {
            $cart = \App\Models\Cart::where('idUser', '=', $user_loggedin->id)->where('idProduct', '=', $idp)->first();
            $cart->delete();
        } else {
            $products = session()->get('cart'); // Second argument is a default value
//            dd($products);
            unset($products[$idp]);
            session()->put('cart', $products);
        }
        return redirect()->back();
    }

    public function getCartProduct() {
        $user_loggedin = Auth::user();
        $total_cart_items = 0;
        $subtotal = 0;
        $discount = 0;
        $cart_items = [];
        if ($user_loggedin != null) {
            $cartitems = \App\Models\Cart::where('idUser', '=', $user_loggedin->id)->get();
            foreach ($cartitems as $c) {
                $product = \App\Models\Products::where('id', '=', $c->idProduct)->first();
                $total_cart_items += $c->qty;
                $cart_items[$c->idProduct]['qty'] = $c->qty;
                if ($c->amc == 'Y') {
                    $cart_items[$c->idProduct]['amc'] = 'AMC Included';
                } else {
                    $cart_items[$c->idProduct]['amc'] = '';
                }
                $cart_items[$c->idProduct]['product'] = $product;
                $subtotal += $product->sales_price * $c->qty;
                if ($product->pre_discount > 0) {
                    $discount += ($product->max_retail_price * $product->pre_discount / 100) * $c->qty;
                }
            }

            $totalamt = $subtotal - $discount;
            return response()->json(['success' => "SUCCESS", 'cart_items' => $cart_items, 'subtotal' => $subtotal, 'discount' => $discount, 'totalamt' => $totalamt, 'total_items' => $total_cart_items], 200, ['app-status' => 'success']);
        } else {
            $cart = session()->get('cart');
            if (!empty($cart)) {
                foreach ($cart as $c) {
                    $product = \App\Models\Products::where('id', '=', $c['idProduct'])->first();
                    $total_cart_items += $c['qty'];
                    $cart_items[$c['idProduct']]['qty'] = $c['qty'];
                    if ($c['amc'] == 'Y') {
                        $cart_items[$c['idProduct']]['amc'] = 'AMC Included';
                    } else {
                        $cart_items[$c['idProduct']]['amc'] = '';
                    }
                    $cart_items[$c['idProduct']]['product'] = $product;
                    $subtotal += $product->sales_price * $c['qty'];
                    if ($product->pre_discount > 0) {
                        $discount += ($product->max_retail_price * $product->pre_discount / 100) * $c['qty'] ;
                    }
                }
            }
            $totalamt = $subtotal - $discount;
            return response()->json(['success' => "SUCCESS", 'cart_items' => $cart_items, 'subtotal' => $subtotal, 'discount' => $discount, 'totalamt' => $totalamt, 'total_items' => $total_cart_items], 200, ['app-status' => 'success']);
        }
    }

}
