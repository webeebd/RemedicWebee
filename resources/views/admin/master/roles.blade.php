@extends('layouts.app')
@section('content')
<div class="page-header pattern-bg">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12 mb-2">
            <ol class="breadcrumb mb-2">
               <li class="breadcrumb-item"><a href="{{url('admin/home')}}" class="">Dashboard</a></li>
               <li class="breadcrumb-item active" aria-current="page">Masters</li>
            </ol>
            <div class="d-flex justify-content-between align-items-center">
               <h1 class="h2 mb-md-0 text-white fw-light">Roles</h1>
               <div class="page-action">
                  @if(isset($role))
                  <a class="btn d-none d-sm-inline-flex rounded-pill" type="button" href="{{url('/admin/roles')}}">
                     <span class="me-1 d-none d-lg-inline-block">Create Role</span>
                     <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0V0Z" fill="white"></path>
                     </svg>
                 </a>
                 @else
                 <button class="btn d-none d-sm-inline-flex rounded-pill" type="button" onclick="showForm();">
                     <span class="me-1 d-none d-lg-inline-block">Create Role</span>
                     <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0V0Z" fill="white"></path>
                     </svg>
                  </button>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="page-body">
   <div class="container-fluid">
    <div class="row" id="catform" @if(isset($role) || $errors->any()) style="display:block;" @else style="display:none;" @endif>
                <div class="col-12" v-if="createPannel" style="margin-bottom: 10px;">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div>
                            <h6 class="card-title mb-0">Role Details</h6>
                            <small class="text-muted">Roles are used for access level control of the assigned user.</small>
                            </div> 
                        </div>
                        <div class="card-body">
                           @if(isset($role))
                           <form  action="{{route('roles.update',$role->id)}}" method="POST"  enctype="multipart/form-data">
                           @method('PUT')
                           @else
                           <form  action="{{url('admin/roles')}}" method="post" enctype="multipart/form-data">
                            @endif
                              @csrf
                              <input type="hidden" name="request_type" value="web">
                              <div class="row mb-3">
                                 <label class="col-md-3 col-sm-4 col-form-label">Role Title <sup class="text-danger">*</sup></label>
                                 <div class="col-md-9 col-sm-8">
                                    <input type="text" class="form-control form-control-lg" name="title" required  @if(isset($role))  value="{{$role->title}}" @else value="{{ old('title') }}" @endif/>
                                    @if ($errors->has('title'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('title') }}</strong>
                                    </label>
                                    @endif
                                 </div>
                              </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Role Description <sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <textarea class="form-control" name="description" rows="3" required>@if(isset($role))  {{$role->description}} @endif </textarea>
                                @if ($errors->has('description'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('description') }}</strong>
                                    </label>
                                    @endif  
                              </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Status <sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <select class="form-select" aria-label="Default select example" name="active" required @if(isset($role))  value="{{$role->active}}" @else value="{{ old('active') }}" @endif>
                                   <option value="" selected>--- Select Status --</option>
                                   <option value="Y" @if(isset($role) && $role->active == 'Y') selected="selected" @endif>Active</option>
                                    <option value="N" @if(isset($role) && $role->active == 'N') selected="selected" @endif>In Active</option>
                                </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Redirect to permission after save?</label>
                                <div class="form-check form-switch col-md-9 col-sm-8">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="redirect">
                                 <label class="form-check-label" for="flexSwitchCheckDefault">Yes</label>
                                 </div>
                            </div>

                            <div class="card-footer text-end" v-if="createPannel">
                            <a class="btn btn-lg btn-light" type="reset" onclick="closeForm()">Close</a>
                            <button class="btn btn-lg btn-primary" type="submit"> Save Changes</button>
							   </div>
                    </form>
                 </div>    
                </div>
            </div>
		</div>
      <div class="row">
         <!---->
		 
         <div class="col-12">
            <div class="card">
               <div class="card-header bg-transparent pb-0">
                  <div>
                     <h6 class="card-title mb-0">Manage Roles</h6>
                     <small class="text-muted">Roles are used for access level control of the assigned user.</small>
                  </div>
               </div>
               <div class="card-body row-title mb-0">
                  <h5 class="fw-light mb-0">Roles <span class="fw-bold ms-2" id="catcount"></span></h5>
               </div>
               <div class="card-body pt-0">
                  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                     <div class="row">
                        <div class="col-sm-12 col-md-6"></div>
                        <div class="col-sm-12 col-md-6"></div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <table class="table align-middle card-table mb-0 roleTable nowrap dataTable no-footer dtr-inline" id="DataTables_Table_0" style="width: 1302px;">
                              <thead>
                                 <tr>
                                    <th>ROLE ID</th>
                                    <th>NAME</th>
                                    <th>DESCRIPTION</th>
                                    <th>MODIFIED</th>
                                    <th>ACTION</th>
                                 </tr>
                              </thead>
                              <tbody id="databind">
							  
                                 
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12 col-md-5"></div>
                        <div class="col-sm-12 col-md-7"></div>
                     </div>
                  </div>
                  <nav aria-label="Page navigation">
                     <ul class="pagination justify-content-end mt-2" id="page_links">
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop
@section('script')
<script>
function showForm(){
	$('#catform').show();
}
function closeForm(){
	$('#catform').hide();
}
$(document).ready(function(){
	var search = '';
	$.ajax({
        url : "{{ url('admin-api/roles') }}",
        data : {'search' : search},
        type : 'GET',
        dataType : 'json',
        success : function(result){
            $('#catcount').append('('+result.total+')');
            $.each(result.data, function( index, value ) {
               var html = '<tr>\n\
                     <td>'+value['id']+'</td>\n\
                     <td>'+value['title']+ (value['active'] == 'Y' ? ' <span class="badge bg-success">Active</span>':' <span class="badge bg-danger">In-Active</span>')+'</td>\n\
                     <td>'+value['description']+'</td>\n\
                     <td>'+value['updated_at']+'</td>';
               if(value['id'] != 1)      
               html = html+'<td><a href="{{ url('admin/roles/') }}/'+value['id']+'/edit" class="btn btn-link btn-sm text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Role"><i class="fa fa-pencil"></i></a>  <button  class="btn btn-link btn-sm text-danger js-sweetalert" data-bs-toggle="tooltip"  data-id="'+value['id']+'" data-bs-placement="top" title="Delete" ><i class="fa fa-trash"></i></button></td>';
               else html = html+'<td></td>';
               html = html+'</tr>';
               $('#databind').append(html);
            });
            $.each(result.links, function( index, value ) {
               if(value['url'] == null)
               var links = '<li class="page-item disabled"><button class="page-link">'+value['label']+'</button></li>';
               else if(value['active'] == true)
               var links = '<li class="page-item active"><button class="page-link">'+value['label']+'</button></li>';
               else if(value['url'] != null)
               var links = '<li class="page-item"> <button class="page-link" onclick="location.href = '+value['url']+';">'+value['label']+'</button></li>';
               $('#page_links').append(links);
            });
        }
    });
});
$(document).on('click', '.js-sweetalert', function (e) {
	$.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var id = $(this).data('id');
	Swal.fire({
	  title: 'Are you sure?',
	  text: "You won't be able to revert this!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
	  if (result.isConfirmed) {
	   $.ajax({
			type: "DELETE",
			url: "{{url('/admin-api/roles/')}}" +"/"+id,
			data: {id:id},
         success: function(resultData) { 
            if(resultData == 'Role deleted!'){
               Swal.fire(
               'Deleted!',
               'Your file has been deleted.',
               'success'
               ),location.reload();
            }else{
               Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: resultData
               });
            }
         }
		});
		
	  }
	});
});
</script>
@stop