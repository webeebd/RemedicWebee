@extends('layouts.app')
@section('content')
<div class="modal fade" id="amcModalCenter" tabindex="-1" aria-labelledby="amcModalCenterTitle" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="amcModalCenterTitle">AMC Details</h5>
         <button type="button" class="btn-close dismiss-dialog" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <p id="amc_details"></p>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-secondary dismiss-dialog" data-dismiss="modal">Close</button>
      </div>
   </div>
   </div>
</div>
<div class="page-header pattern-bg">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12 mb-2">
            <ol class="breadcrumb mb-2">
               <li class="breadcrumb-item"><a href="{{url('admin/home')}}" class="">Dashboard</a></li>
               <li class="breadcrumb-item active" aria-current="page">Masters</li>
            </ol>
            <div class="d-flex justify-content-between align-items-center">
               <h1 class="h2 mb-md-0 text-white fw-light">AMC</h1>
               <div class="page-action">
                  @if(isset($amcMaster))
                  <a class="btn d-none d-sm-inline-flex rounded-pill" type="button" href="{{url('/admin/amcs')}}">
                     <span class="me-1 d-none d-lg-inline-block">Manage AMC</span>
                     <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0V0Z" fill="white"></path>
                     </svg>
                 </a>
                 @else
                 <button class="btn d-none d-sm-inline-flex rounded-pill" type="button" onclick="showForm();">
                     <span class="me-1 d-none d-lg-inline-block">Manage AMC</span>
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
   <div class="row" id="catform" @if(isset($amcMaster) || $errors->any()) style="display:block;" @else style="display:none;" @endif>
                <div class="col-12" v-if="createPannel" style="margin-bottom: 10px;">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div>
                            <h6 class="card-title mb-0">AMC Details</h6>
                            <small class="text-muted">Fill the details about the amc your want to provide.</small>
                            </div> 
                        </div>
                        @if(Session::has('message'))
                           <p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="margin:10px;">{{ Session::get('message') }}</p>
                        @endif
                        <div class="card-body">
                          @if(isset($amcMaster))
                           <form  action="{{route('amc-master.update',$amcMaster->id)}}" method="POST"  enctype="multipart/form-data" class="row" onsubmit="prepareData();">
                           @method('PUT')
                           @else
                           <form  action="{{url('admin/amc-master')}}" method="post" enctype="multipart/form-data" class="row" onsubmit="prepareData();">
                            @endif
                              @csrf
                              <input type="hidden" name="request_type" value="web">
                              <div class="col-sm-4">
                                 <label class="col-form-label">Name <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control " name="name" required  @if(isset($amcMaster))  value="{{$amcMaster->name}}" @else value="{{ old('name') }}" @endif/>
                                    @if ($errors->has('name'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('name') }}</strong>
                                    </label>
                                    @endif
                           </div>

                           <div class="col-sm-4">
                                <label class="col-form-label">Price <sup class="text-danger">*</sup></label>
                                 <div class="input-group">
                                        <span class="input-group-text">৳</span>
                                        <input type="number" class="form-control " maxlength="9" onkeypress='return isNumberKey(event)' name="price" required @if(isset($amcMaster))  value="{{$amcMaster->price}}" @else value="{{ old('price') }}" @endif>
                                        @if ($errors->has('price'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('price') }}</strong>
                                    </label>
                                    @endif 
                                    </div>
                            </div>
                            <div class="col-sm-2">
                                <label class="col-form-label">Duration<sup class="text-danger">*</sup></label>
                                 <input type="text" class="form-control" name="duration" required onkeypress='return isNumberKey(event)' @if(isset($amcMaster))  value="{{$amcMaster->duration}}" @else value="{{ old('duration') }}" @endif/>
                                 @if ($errors->has('duration'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('duration') }}</strong>
                                    </label>
                                    @endif 
                              </div>
                            <div class="col-sm-2">
                                <label class="col-form-label">Duration Unit<sup class="text-danger">*</sup></label>
                                <select class="form-control" name="unit" required>
                                            <option value="">Select Unit</option>
                                            <option value="Days" @if(isset($amcMaster) && $amcMaster->unit == 'Days') selected="selected" @endif>Days</option>
                                            <option value="Month" @if(isset($amcMaster) && $amcMaster->unit == 'Month') selected="selected" @endif>Months</option>
                                            <option value="Year" @if(isset($amcMaster) && $amcMaster->unit == 'Year') selected="selected" @endif>Year</option>
                                    </select> 
                                    @if ($errors->has('unit'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('unit') }}</strong>
                                    </label>
                                    @endif 
                            </div>
                            <div class="col-sm-4">
                              <label class="col-form-label">Type <sup class="text-danger">*</sup></label>
                                <select class="form-control" name="type"required>
                                    <option value="">--- Select Type --</option>
                                    <option value="online" @if(isset($amcMaster) && $amcMaster->type == 'online') selected="selected" @endif>Online</option>
                                    <option value="offline" @if(isset($amcMaster) && $amcMaster->type == 'offline') selected="selected" @endif>Offline</option>
                                </select>
                                @if ($errors->has('type'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('type') }}</strong>
                                    </label>
                                    @endif 
                            </div>


                            <div class="col-sm-4">
                                <label class="col-form-label">Short Description</label>
                                <input type="text" class="form-control"  name="description" placeholder="Type description here.." value="@if(isset($amcMaster)){{$amcMaster->description}}@endif"/>
                                 @if ($errors->has('description'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('description') }}</strong>
                                    </label>
                                    @endif 
                            </div>

                            <div class="col-sm-4">
                                <label class="col-form-label">Status <sup class="text-danger">*</sup></label>
                                <select class="form-select" aria-label="Default select example" name="active" required @if(isset($amcMaster))  value="{{$amcMaster->active}}" @else value="{{ old('active') }}" @endif>
                                   <option value="" selected>--- Select Status --</option>
                                   <option value="Y" @if(isset($amcMaster) && $amcMaster->active == 'Y') selected="selected" @endif>Active</option>
                                    <option value="N" @if(isset($amcMaster) && $amcMaster->active == 'N') selected="selected" @endif>In Active</option>
                                </select>
                                @if ($errors->has('active'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('active') }}</strong>
                                    </label>
                                    @endif 
                            </div>
                            <div class="col-sm-8">
                                <label class="col-form-label">Offerings</label>
                                    <input type="hidden" name="offerings" id="offer_code"/>
                                    <input type="text" id="offer-data" class="form-control summernote" value="{{ old('offerings') }}" />
               
                            </div>
                            <div class="text-end" style="margin-top:20px;">
                            <a class="btn btn-light" type="reset" onclick="closeForm()">Close</a>
                            <button class="btn btn-primary" type="submit"> Save Changes</button>
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
                     <h6 class="card-title mb-0">Manage AMC</h6>
                     <small class="text-muted">Manage details about the amc here.</small>
                  </div>
               </div>
               <div class="card-body row-title mb-0">
                  <h5 class="fw-light mb-0">AMC <span class="fw-bold ms-2" id="catcount"></span></h5>
                  <div>
                     <form class="input-group col-md-3 col-sm-4"><input type="text" class="form-control form-control" placeholder="Search here..." id="search-data"></form>
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
                           <table class="table align-middle card-table mb-0 categoryTable nowrap dataTable no-footer dtr-inline" id="DataTables_Table_0" style="width: 1302px;">
                              <thead>
                                 <tr>
                                    <th></th>
                                    <th>NAME</th>
                                    <th>PRICE</th>
                                    <th>DURATION</th>
                                    <th>TYPE</th>
                                    <th>DETAILS</th>
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
function prepareData(){
   $("#offer_code").val($("#offer-data").summernote('code'));
   return true;
}
function viewOffers(e){
   $('#amc_details').html($(e).data('content'));
   $('#amcModalCenter').modal('show')
}
function isNumberKey(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode != 45 && charCode > 31
    && (charCode < 48 || charCode > 57))
     return false;

  return true;
}
$(document).ready(function(){
   $(".dismiss-dialog").on('click', function(event){
      $('#amcModalCenter').modal('hide')
   });
   $('#offer-data').summernote();
   @if(isset($amcMaster)) 
   @if($amcMaster->offerings != null)
   $("#offer-data").summernote('code',$.parseHTML('<?= $amcMaster->offerings ?>'));
   @endif 
   @endif 
   $("#search-data").on('paste input', function(){
      findAmc($("#search-data").val());
   });
	findAmc('');
});
function findAmc(search){
	$.ajax({
        url : "{{ url('admin-api/amc-master') }}",
        data : {'search' : search},
        type : 'GET',
        dataType : 'json',
        success : function(result){
         $('#catcount').empty();
            $('#databind').empty();
            $('#page_links').empty();
            $('#catcount').append('('+result.total+')');
            var k =1;
			$.each(result.data, function( index, value ) {
			   $('#databind').append('<tr>\n\
						<td>'+k+'</td>\n\
                  <td>'+value['name']+ (value['active'] == 'Y' ? ' <span class="badge bg-success">Active</span>':' <span class="badge bg-danger">In-Active</span>')+'</td>\n\
						<td>৳'+value['price']+'</td>\n\
						<td>'+value['duration']+' '+value['unit']+'</td>\n\
						<td>'+value['type']+'</td>\n\
						<td>'+(value['offerings'] == null ? '-' : '<button type="button" class="btn btn-primary" onClick="viewOffers(this)" data-content="'+value['offerings']+'">View Offerings</button>')+'</td>\n\
                  <td><a href="{{ url('admin/amc-master/') }}/'+value['id']+'/edit" class="btn btn-link btn-sm text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Role"><i class="fa fa-pencil"></i></a>  <button  class="btn btn-link btn-sm text-danger js-sweetalert" data-bs-toggle="tooltip"  data-id="'+value['id']+'" data-bs-placement="top" title="Delete" ><i class="fa fa-trash"></i></button></td>\n\
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
			url: "{{url('/admin-api/amc-master/')}}" +"/"+id,
			data: {id:id},
			success: function(resultData) { 
            if(resultData == 'Data deleted!'){
               Swal.fire(
               'Deleted!',
               'Your amc has been deleted.',
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