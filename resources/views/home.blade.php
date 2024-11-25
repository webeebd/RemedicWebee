@extends('layouts.app')
@section('content')
@php 
   $authUser = Auth::user();
   $menuAccess = DB::table('role_permissions')->select('title')->join('permissions','role_permissions.idPermission','permissions.id')->where('slug','!=','/analytic')->where('idRole',$authUser->idRole)->where('role_permissions.active',"Y")->get()->pluck('title')->toArray();
@endphp
<div class="body-header sticky-md-top">
   <nav-component :access-role="{{ json_encode($menuAccess) }}"
   :auth-name="'{{ $authUser->name }}'" 
   :auth-email="'{{ $authUser->email }}'"></nav-component>
</div>    
<router-view />
@endsection
