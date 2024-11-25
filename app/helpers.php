<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function checkActive($path, $active = 'active') {
    if (is_string($path)) {
        return request()->is($path) ? $active : '';
    }
    foreach ($path as $str) {
        if (checkActive($str) == $active)
            return $active;
    }
}

function categories_filter() {
    $categories = \App\Models\Categories::get()->pluck('name', 'name')->toArray();
    return $categories;
}

function categories() {
    $categories = \App\Models\Categories::get();
    return $categories;
}

function brand_filter() {
    $brands = \App\Models\Brands::get()->pluck('name', 'name')->toArray();
    return $brands;
}

function customerAddreses() {
    $addresses = \App\Models\CustomerAddress::where('idUser', '=', Auth::user()->id)->get();
    return $addresses;
}

function filters($key){
    $filters = DB::table('app_filter')->where('key',$key)->get()->toArray();
    return $filters;
}

function customerProfile() {
    $addresses = \App\Models\CustomerAddress::where('idUser', '=', Auth::user()->id)->get();
    return $addresses;
}

function fetchProducts($request) {
    $products = \App\Models\Products::join('categories', 'products.category_id', '=', 'categories.id')->select('products.slug', 'products.title as name', 'products.pic as imageUrl', 'max_retail_price as mrp', 'sales_price as price', 'pre_discount as discount', 'products.id','categories.name as category');
    if ($request->has('search') && $request->search != null) {
        $products = $products->where('title','LIKE', "%".$request->search. "%");
    } elseif($request->get('category') != null) {
        $category = \App\Models\Categories::where('name', '=', $request->get('category'))->first();
        if (!empty($category)) {
            $products = $products->where('category_id', $category->id);
        } else {
            $products = $products->where('category_id', $request->get('category'));
        }
    }

    if ($request->category != null) {
        $products = $products->where('category_id', $request->category);
    }

    if ($request->get('price') != null) {
        $products = $products->whereBetween('sales_price', [$request->get('min'), $request->get('max')]);
    }

    $products = $products->where('products.active',"Y");
    if ($request->get('sort') != null) {
        if($request->get('sort') == "high")
        $products = $products->orderBy('sales_price','DESC');
        if($request->get('sort') == "low")
        $products = $products->orderBy('sales_price','ASC');
        if($request->get('sort') == "discount")
        $products = $products->orderBy('pre_discount','DESC');
    }
    return $products->paginate();
}

function autoCompleteProducts($searchQuery) {
    $products = \App\Models\Products::select('title as name', 'slug')->where('title', 'LIKE', $searchQuery . '%')->orWhere('modelNumber', 'LIKE', '%' . $searchQuery . '%')->skip(0)->take(10)->get();
    return $products;
}

function homeBuilder() {
    $homeItems = array();
    $sections = \App\Models\MobileConfig::orderBy('position', 'ASC')->get();
    foreach ($sections as $section) {
        $home_section = $section;
        $dataItems = \App\Models\MobileConfigData::where('idSection', $section->section)->get();
        $home_items = array();
        foreach ($dataItems as $items) {
            if ($items->idProduct > 0) {
                if ($section->type == "products") {
                    $info = \App\Models\Products::select('slug', 'title as name', 'pic as imageUrl', 'max_retail_price as mrp', 'sales_price as price', 'pre_discount as discount', 'id')->where('id', $items->idProduct)->first();
                } else if ($section->type == "categories") {
                    $info = \App\Models\Categories::select('id', 'name', 'thumbnail as imageUrl')->where('id', $items->idProduct)->first();
                } else if ($section->type == "brands") {
                    $info = \App\Models\Brands::select('slug', 'name', 'thumbnail as imageUrl')->where('id', $items->idProduct)->first();
                }
                $info->background = $items->background;
                array_push($home_items, $info);
            } else {
                unset($items->idProduct);
                unset($items->idSection);
                array_push($home_items, $items);
            }
        }
        $home_section["data"] = $home_items;
        array_push($homeItems, $home_section);
    }
    return $homeItems;
}

function cartcount() {
    $user_loggedin = Auth::user();
    $cartcount = 0;
    if ($user_loggedin != null) {
        $cartcount = \App\Models\Cart::where('idUser', '=', $user_loggedin->id)->get()->count();
    } else {
        $cart = session()->get('cart');
        if (!empty($cart)) {
            foreach ($cart as $c) {
                $cartcount += $c['qty'];
            }
        }
    }

    return $cartcount;
}

function today_date() {
    return Carbon\Carbon::today()->format('d-m-Y');
}

function nextOrder() {
    $no = App\NoGenerator::firstOrCreate(['type' => 'order']);
    $no->increment('no', 1);
    return $no->no;
}

function nextBill() {
    $no = App\NoGenerator::firstOrCreate(['type' => 'bill']);
    $no->increment('no', 1);
    return $no->no;
}

function nextAmc() {
    $no = App\NoGenerator::firstOrCreate(['type' => 'amc']);
    $no->increment('no', 1);
    return $no->no;
}