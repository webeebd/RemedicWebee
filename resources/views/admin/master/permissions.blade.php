@extends('layouts.app')
@section('content')
<div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><router-link to="/admin/home">Dashboard</router-link></li>
                        <li class="breadcrumb-item active" aria-current="page">Masters</li>
                    </ol>
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h2 mb-md-0 text-white fw-light">Permission</h1>
                        <div class="page-action">
                            <button class="btn d-none d-sm-inline-flex rounded-pill" type="button" onclick="location.href ='/admin/roles'">
                                <span class="me-1 d-none d-lg-inline-block">Create Role</span>
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0V0Z" fill="white"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form  action="{{url('admin/permissions')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-transparent pb-0">
                            <div>
                            <h6 class="card-title mb-0">Manage permissions</h6>
                            <small class="text-muted">Permissions are used for access level control of the roles.</small>
                            </div> 
                        </div>

                        @if(count($roles) == 0)
                        <div class="card-body col-12 text-center p-5"> 
                            <img src="/assets/img/no-data.svg" class="w120" alt="No Data">
                            <div class="mt-4 mb-3">
                                <span class="text-muted">Currently you have not create any roles to show here use below to create one.</span>
                            </div>
                            <button type="button" class="btn btn-white border lift" onclick="location.href ='/admin/roles'">Create Role</button>
                        </div>
                        @else
                        <div class="card-body table-responsive">
                            <div class="row-title mb-2">
                                <h5 class="fw-light mb-0">Permissions
                                    <span class="fw-bold ms-2">({{ count($permissions) }})</span>
                                    | Dashboard KPIs
                                    <span class="fw-bold ms-2">({{ count($analytics)}})</span>
                                </h5>
                                <div>
                                 <div class="input-group">
                                       <select class="form-select" onchange="onPermissionChange(this)" id="roles" name="idRole" required>
                                        <option value=""> -- Select a role-- </option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @if(isset($idRole)) <?php if($idRole == $role->id) echo 'selected';?> @endif>{{ $role->title }}</option>
                                        @endforeach
                                        </select>
                                        <button class="btn btn-outline-secondary" type="button" onclick="selectAll()"><i class="fa fa-check-circle"></i><span class="d-none d-md-inline-block ms-2">Mark All</span></button>
                                        <button class="btn btn-outline-secondary" type="button" onclick="unSelectAll()"><i class="fa fa-check-circle-o"></i><span class="d-none d-md-inline-block ms-2">Unmark All</span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <table class="table card-table mb-0 col-sm-6">
                              <tbody>
                                 <tr>
                                    <td colspan="2" class="fw-bold ms-2">
                                    Permissions
                                    </td>
                                 </tr>
                                 @foreach($permissions as $permission) 
                                 <tr>
                                       <td class="form-label">{{ $permission->title }}</td>
                                       <td>
                                          <div class="form-check">
                                          <input class="form-check-input" type="checkbox" name="permissions[]" value="{{$permission->id}}" @if (in_array($permission->id, $allowed)) checked @endif>
                                          </div>
                                       </td>
                                 </tr>
                                 @endforeach
                                 <tr>
                                    <td colspan="2" class="fw-bold ms-2">
                                    Dashboard KPIs
                                    </td>
                                 </tr>
                                 @foreach($analytics as $analytic) 
                                 <tr>
                                       <td class="form-label">{{ $analytic->title }}</td>
                                       <td>
                                          <div class="form-check">
                                          <input class="form-check-input" type="checkbox" name="kpi[]" value="{{$analytic->id}}"  @if (in_array($analytic->id, $allowed)) checked @endif>
                                          </div>
                                       </td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                            </div>
                            
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-lg btn-primary" type="submit"> Save Changes</button>
                        </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@stop
@section('script')
<script>
   function selectAll(){
      $('input[type=checkbox]').each(function() { this.checked = true; }); 
   }
   function unSelectAll(){
      $('input[type=checkbox]').each(function() { this.checked = false; }); 
   }
   function onPermissionChange(selectObject){
      var idRole = selectObject.value;
      window.location.href = "/admin/permissions/"+idRole;
   }
</script>
@stop