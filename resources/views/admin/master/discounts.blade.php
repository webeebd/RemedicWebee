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
               <h1 class="h2 mb-md-0 text-white fw-light">Discounts</h1>
               <div class="page-action">
               @if(isset($discount))
				     <a class="btn d-none d-sm-inline-flex rounded-pill" type="button" href="{{url('/admin/discounts')}}">
                     <span class="me-1 d-none d-lg-inline-block">Create Discount </span>
                     <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0V0Z" fill="white"></path>
                     </svg>
                  </a>
                  @else
                  <button class="btn d-none d-sm-inline-flex rounded-pill" type="button" onclick="showForm();">
                     <span class="me-1 d-none d-lg-inline-block">Create Discount</span>
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
    <div class="row" id="catform" @if(isset($discount) || $errors->any()) style="display:block;" @else style="display:none;" @endif>
                <div class="col-12" v-if="createPannel" style="margin-bottom: 10px;">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div>
                            <h6 class="card-title mb-0"> Details</h6>
                            <small class="text-muted">Fill the details about the discount for the customer.</small>
                            </div> 
                        </div>
                        <div class="card-body">
                           @if(isset($discount))
                         <form  action="{{route('discounts.update',$discount->id)}}" method="POST"  enctype="multipart/form-data" class="row">
                           @method('PUT')
                           @else
                           <form  action="{{url('admin/discounts')}}" method="post" enctype="multipart/form-data" class="row">
                            @endif
                              @csrf
                              <input type="hidden" name="request_type" value="web">
                                 <div class="col-sm-4">
                                <label class="col-form-label">Coupon Name <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control "  name="name" required  @if(isset($discount))  value="{{$discount->name}}" @else value="{{ old('name') }}" @endif />
                                @if ($errors->has('name'))
                                <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('name') }}</strong>
                                    </label>
                                    @endif
                               </div>
                               <div class="col-sm-2">
                                <label class="col-form-label">Minimum Amount</label>
                                <input type="text" class="form-control" name="min_amount" @if(isset($discount))  onkeypress='return isNumberKey(event)' value="{{$discount->min_amount}}" @else value="{{ old('min_amount') }}" @endif>
                                @if ($errors->has('min_amount'))
                                <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('min_amount') }}</strong>
                                    </label>
                                    @endif 
                              </div>
                               <div class="col-sm-2">
                                <label class="col-form-label">Discount Type</label>
                                <select class="form-select" aria-label="Default select example" name="type" required @if(isset($discount))  value="{{$discount->type}}" @else value="{{ old('active') }}" @endif>
                                    <option value="A" @if(isset($discount) && $discount->active == 'A') selected="selected" @endif>Amount</option>
                                    <option value="P" @if(isset($discount) && $discount->active == 'P') selected="selected" @endif>Percentage</option>
                                 </select>
                                 @if ($errors->has('type'))
                                <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('type') }}</strong>
                                    </label>
                                    @endif 
                               </div>
                            <div class="col-sm-2">
                              <label class="col-form-label">Amount/Percentage<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control "required name="total" @if(isset($discount))  onkeypress='return isNumberKey(event)' value="{{$discount->total}}" @else value="{{ old('total') }}" @endif />
                                @if ($errors->has('total'))
                                <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('total') }}</strong>
                                    </label>
                                    @endif 
                              </div>                          
                            <div class="col-sm-2">
                                <label class="col-form-label">Status <sup class="text-danger">*</sup></label>
                                <select class="form-select" aria-label="Default select example" name="active" required @if(isset($discount))  value="{{$discount->active}}" @else value="{{ old('active') }}" @endif>
                                    <option value="" selected>--- Select Status --</option>
                                    <option value="Y" @if(isset($discount) && $discount->active == 'Y') selected="selected" @endif>Active</option>
                                    <option value="N" @if(isset($discount) && $discount->active == 'N') selected="selected" @endif>In Active</option>
                                 </select>
                                 @if ($errors->has('active'))
                                <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('active') }}</strong>
                                    </label>
                                    @endif 
                            </div>
                            <div class="col-sm-2" style="margin-top: 10px;">
                                <label class="col-form-label">Max Redeem Count</label>
                                <input type="text" class="form-control " name="max_redeem" @if(isset($discount))  onkeypress='return isNumberKey(event)' value="{{$discount->max_redeem}}" @else value="{{ old('max_redeem') }}" @endif  />
                                @if ($errors->has('max_redeem'))
                                <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('max_redeem') }}</strong>
                                    </label>
                                    @endif 
                              </div>  
                            <div class="col-sm-2" style="margin-top: 10px;">
                                <label class="col-form-label">Validity<sup class="text-danger">*</sup></label>
                                <input type="date" class="form-control " placeholder="Select date" name="expire_date" min="<?php echo date("Y-m-d"); ?>"  required @if(isset($discount))  value="{{ Carbon\Carbon::parse($discount->expire_date)->format('Y-m-d') }}" @else value="{{ old('expire_date') }}" @endif  />
                                @if ($errors->has('expire_date'))
                                <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('expire_date') }}</strong>
                                    </label>
                                    @endif 
                              </div>  
                            <div class="col-sm-4" style="margin-top: 10px;">
                                <label class="col-form-label">Category</label>
                                <select id="category"  class="form-select" name="idCategory"  @if(isset($discount))  value="{{$discount->idCategory}}" @else value="{{ old('idCategory') }}" @endif>
                                 <option selected value="">Select</option>
                                 @foreach($categories as $category)
                                 <option value="{{$category->id}}" @if(isset($discount) && $discount->idCategory == $category->id)selected="selected" @endif>{{$category->name}}</option>
                                @endforeach
                                </select>
                                @if ($errors->has('idCategory'))
                                <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('idCategory') }}</strong>
                                    </label>
                                    @endif 
                                </div>    
                                <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                 <label class="col-form-label">Description</label>
                                 <textarea class="form-control" placeholder="Type description here.." rows="3" name="description">@if(isset($discount)){{$discount->description}}@endif</textarea>
                                 @if ($errors->has('description'))
                                <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('description') }}</strong>
                                    </label>
                                    @endif 
                              </div> 
                                              
                             <div class="text-end">
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
                     <h6 class="card-title mb-0">Manage Discounts</h6>
                     <small class="text-muted">Manage discount or coupon across the order for customer.</small>
                  </div>
               </div>
               <div class="card-body row-title mb-0">
                  <h5 class="fw-light mb-0">Discounts<span class="fw-bold ms-2" id="catcount"></span></h5>
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
                           <table class="table align-middle card-table mb-0 discountTable nowrap dataTable no-footer dtr-inline" id="DataTables_Table_0" style="width: 1302px;">
                              <thead>
                                 <tr>
                                    <th></th>
                                    <th>COUPON</th>
                                    <th>AMOUNT</th>
                                    <th>MIN. AMOUNT</th>
                                    <th>VALID TILL</th>
                                    <th>MAX REDEEM</th>
                                    <th>CATEGORY</th>
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
                     <ul class="pagination justify-content-end mt-2"  id="page_links">
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
function isNumberKey(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode != 45 && charCode > 31
    && (charCode < 48 || charCode > 57))
     return false;

  return true;
}
function showForm(){
	$('#catform').show();
}
function closeForm(){
	$('#catform').hide();
}
$(document).ready(function(){
	$("#search-data").on('paste input', function(){
      findData($("#search-data").val());
   });

	findData('');
});
function findData(search){
	$.ajax({
        url : "{{ url('admin-api/discounts') }}",
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
						<td>'+value['name']+ (value['active'] == 'Y' ? ' <span class="badge bg-success">Active</span>':' <span class="badge bg-danger">In-Active</span>')+'</td>\n\
                  <td>'+value['total']+'-'+(value['type'] == 'A' ? 'Flat Discount' : '% OFF')+'</td>\n\
						<td>৳'+(value['min_amount'] == null ? '0': value['min_amount'])+'</td>\n\
                  <td>'+value['expire_date']+'</td>\n\
                  <td>'+(value['max_redeem'] == null ? 'Unlimited': value['max_redeem'])+'</td>\n\
                  <td>'+(value['category'] == null ? '-': value['category'])+'</td>\n\
					   <td><a href="{{ url('admin/discounts/') }}/'+value['id']+'/edit" class="btn btn-link btn-sm text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Role"><i class="fa fa-pencil"></i></a>  <button  class="btn btn-link btn-sm text-danger js-sweetalert" data-bs-toggle="tooltip"  data-id="'+value['id']+'" data-bs-placement="top" title="Delete" ><i class="fa fa-trash"></i></button></td>\n\
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
			url: "{{url('/admin-api/discounts/')}}" +"/"+id,
			data: {id:id},
			success: function(resultData) { 
            if(resultData == 'Data deleted!'){
               Swal.fire(
               'Deleted!',
               'Selected discount has been deleted.',
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