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
               <h1 class="h2 mb-md-0 text-white fw-light">Brands</h1>
               <div class="page-action">
                  @if(isset($brand))
                  <a class="btn d-none d-sm-inline-flex rounded-pill" type="button" href="{{url('/admin/brands')}}">
                     <span class="me-1 d-none d-lg-inline-block">Add Brand</span>
                     <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0V0Z" fill="white"></path>
                     </svg>
                 </a>
                 @else
                 <button class="btn d-none d-sm-inline-flex rounded-pill" type="button" onclick="showForm();">
                     <span class="me-1 d-none d-lg-inline-block">Add Brand</span>
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
    <div class="row" id="catform" @if(isset($brand) || $errors->any()) style="display:block;" @else style="display:none;" @endif>
                  <div class="col-12" v-if="createPannel" style="margin-bottom: 10px;">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div>
                            <h6 class="card-title mb-0"> Details</h6>
                            <small class="text-muted">Fill the details about the brand.</small>
                            </div> 
                        </div>
                        @if(Session::has('message'))
                           <p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="margin:10px;">{{ Session::get('message') }}</p>
                        @endif
                        <div class="card-body">
                           @if(isset($brand))
                           <form  action="{{route('brands.update',$brand->id)}}" method="POST"  enctype="multipart/form-data" class="row">
                           @method('PUT')
                           @else
                           <form  action="{{url('admin/brands')}}" method="post" enctype="multipart/form-data" class="row">
                            @endif
                              @csrf
                              <input type="hidden" name="request_type" value="web">
                              <div class="col-sm-4">
                                 <label class="col-form-label">Name <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control " name="name" required  @if(isset($brand))  value="{{$brand->name}}" @else value="{{ old('name') }}" @endif/>
                                    @if ($errors->has('name'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('name') }}</strong>
                                    </label>
                                    @endif
                              </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Manufacturer</label>
                                <input type="text" class="form-control " name="manufacturer" @if(isset($brand))  value="{{$brand->manufacturer}}" @else value="{{ old('manufacturer') }}" @endif/>
         
                            </div>

                            <div class="col-sm-4">
                                <label class="col-form-label">Slug </label>
                                <input type="text" class="form-control " name="slug" @if(isset($brand))  value="{{$brand->slug}}" @else value="{{ old('slug') }}" @endif />
                                @if ($errors->has('slug'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('slug') }}</strong>
                                    </label>
                                    @endif 
              
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Description</label>
                                <textarea class="form-control" name="description" placeholder="Type description here.." rows="3" > @if(isset($brand)){{$brand->description}} @endif </textarea>
                                    @if ($errors->has('description'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('description') }}</strong>
                                    </label>
                                    @endif  
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Brand Logo</label>
                                    <input class="form-control" type="file" id="formFile" accept="image/*" name="logo">
                                    @if ($errors->has('logo'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('logo') }}</strong>
                                    </label>
                                    @endif  
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Status <sup class="text-danger">*</sup></label>
                                <select class="form-select" aria-label="Default select example" name="active" required @if(isset($brand))  value="{{$brand->active}}" @else value="{{ old('active') }}" @endif>
                                   <option value="" selected>--- Select Status --</option>
                                   <option value="Y" @if(isset($brand) && $brand->active == 'Y') selected="selected" @endif>Active</option>
                                    <option value="N" @if(isset($brand) && $brand->active == 'N') selected="selected" @endif>In Active</option>
                                </select>
                            </div>
                            <div class="text-end">
                            <a class="btn  btn-light" type="reset" onclick="closeForm()">Close</a>

                            <button class="btn  btn-primary" type="submit"> Save Changes</button>
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
                     <h6 class="card-title mb-0">Manage Brands</h6>
                     <small class="text-muted">Manage details about the brands here.</small>
                  </div>
               </div>
               <div class="card-body row-title mb-0">
                  <h5 class="fw-light mb-0">Brands <span class="fw-bold ms-2" id="catcount"></span></h5>
                  <div>
                     <form class="input-group col-md-3 col-sm-4"><input type="text" class="form-control form-control" placeholder="Search here..." id="search-brand"></form>
                  </div>
               </div>
               <div class="card-body pt-0">
                  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                     <div class="row">
                        <div class="col-sm-12 col-md-6"></div>
                        <div class="col-sm-12 col-md-6"></div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <table class="table align-middle card-table mb-0 brandTable nowrap dataTable no-footer dtr-inline" id="DataTables_Table_0" style="width: 1302px;">
                              <thead>
                                 <tr>
                                    <th></th>
                                    <th>LOGO</th>
                                    <th>NAME</th>
                                    <th>MANUFACTURER</th>
                                    <th>DESCRIPTION</th>
                                    <th>SLUG</th>
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
   $("#search-brand").on('paste input', function(){
      findBrand($("#search-brand").val());
   });
	findBrand('');
});
function findBrand(search){
   $.ajax({
        url : "{{ url('admin-api/brands') }}",
        data : {'search' : search},
        type : 'GET',
        dataType : 'json',
        success : function(result){
            $('#catcount').empty();
            $('#databind').empty();
            $('#page_links').empty();
            $('#catcount').append('('+result.total+')');
            var k=1;
			   $.each(result.data, function( index, value ) {
			   $('#databind').append('<tr>\n\
						<td>'+k+'</td>\n\
                  <td><img src="'+ (value['thumbnail'] == null ? '/no_pic.png' : '/storage/brands/'+value['thumbnail'])+'" width="50" height="50"></td>\n\
                  <td>'+value['name']+ (value['active'] == 'Y' ? ' <span class="badge bg-success">Active</span>':' <span class="badge bg-danger">In-Active</span>')+'</td>\n\
                  <td>'+(value['manufacturer'] == null ? '-' :value['manufacturer'])+'</td>\n\
						<td>'+(value['description'] == null ? '-' :value['description'])+'</td>\n\
						<td>'+(value['slug'] == null ? '-' : value['slug'])+'</td>\n\
						<td>'+value['updated_at']+'</td>\n\
				      <td><a href="{{ url('admin/brands/') }}/'+value['id']+'/edit" class="btn btn-link btn-sm text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Role"><i class="fa fa-pencil"></i></a>  <button  class="btn btn-link btn-sm text-danger js-sweetalert" data-bs-toggle="tooltip"  data-id="'+value['id']+'" data-bs-placement="top" title="Delete" ><i class="fa fa-trash"></i></button></td>\n\
						</tr>');
                  k++;
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
}
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
			url: "{{url('/admin-api/brands/')}}" +"/"+id,
			data: {id:id},
			success: function(resultData) { 
            if(resultData == 'Data deleted!'){
               Swal.fire(
               'Deleted!',
               'Your brand has been deleted.',
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