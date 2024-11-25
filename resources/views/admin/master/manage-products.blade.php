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
               <h1 class="h2 mb-md-0 text-white fw-light">Products</h1>
               <div class="page-action">
                  <button class="btn d-none d-sm-inline-flex rounded-pill" type="button" onclick="showForm();">
                     <span class="me-1 d-none d-lg-inline-block">Add Product</span>
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
<div class="page-body">
   <div class="container-fluid">
    <div class="row" id="catform" style="display:none;">
                <div class="col-12" v-if="createPannel" style="margin-bottom: 10px;">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div>
                            <h6 class="card-title mb-0"> Products</h6>
                            <small class="text-muted">Note: Please enter the mandatory details..</small>
                            </div> 
                        </div>
                        <form class="card-body">
                        <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Main Image<sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                    <input class="form-control" type="file" id="formFile" accept="image/*">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Product Name<sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Product Title<sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <textarea class="form-control" placeholder="Type description here.." rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label form-inline">Category</label>
                                <div class="col-md-9 col-sm-8">
                                <select class="form-control form-control-lg">
                                    <option disabled value="">--- Select Category --</option>
                                    <option value="1">Category1</option>
                                    <option value="2">Category2</option>
                                </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Department<sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <select class="form-control form-control-lg">
                                    <option disabled value="">--- Select Department --</option>
                                    <option value="1">Dept.1</option>
                                    <option value="2">Dept.2</option>
                                </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Model Number<sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Brand<sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <select class="form-control form-control-lg">
                                    <option disabled value="">--- Select Brand --</option>
                                    <option value="1">Brand1</option>
                                    <option value="2">Brand2</option>
                                </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Generic Name</label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Manufacturer</label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">SKU</label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">HSN<sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Country of Origin</label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Pack Size</label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg" />
                                </div>
                            </div>
                            <div class="card-footer text-end" v-if="createPannel">
								<button class="btn btn-lg btn-light me-2" type="reset" @click="closeCreatePannel()">Close</button>
								<button class="btn btn-lg btn-primary" type="submit" :disabled="isCreating" @click="createCategory()" v-if="!categoryParam.hasOwnProperty('id')">
									<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-bind:class="{ 'd-none' : !isCreating }"></span> Save Changes</button>
								
							</div>
                    
                    </form>
                        
                </div>
            </div>
		</div>
      <div class="row">
         <!---->
		 
         <div class="col-12">
            <div class="card">
               <div class="card-header bg-transparent pb-0">
                  <div>
                     <h6 class="card-title mb-0">Manage Products</h6>
                     <small class="text-muted">Manage product details here.</small>
                  </div>
               </div>
               <div class="card-body row-title mb-0">
                  <h5 class="fw-light mb-0">Products<span class="fw-bold ms-2" id="catcount"></span></h5>
                  <div>
                     <form class="input-group col-md-3 col-sm-4"><input type="text" class="form-control form-control" placeholder="Search here..."></form>
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
                                    <th>PRODUCT ID</th>
                                    <th>PRODUCT DETAILS</th>
                                    <th>CATEGORY</th>
                                    <th>MRP</th>
                                    <th>PRICE</th>
                                    <th>LAST UPDATED</th>
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
                     <ul class="pagination justify-content-end mt-2">
                        <li class="page-item disabled"><button class="page-link">« Previous</button></li>
                        <li class="page-item active"><button class="page-link">1</button></li>
                        <li class="page-item disabled"><button class="page-link">Next »</button></li>
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
	$('#catform').toggle();
}
$(document).ready(function(){
	var search = '';
	$.ajax({
        url : "{{ url('admin-api/manage-products') }}",
        data : {'search' : search},
        type : 'GET',
        dataType : 'json',
        success : function(result){
            $('#catcount').append('('+result.total+')');
			$.each(result.data, function( index, value ) {
				console.log(value);
			   $('#databind').append('<tr>\n\
						<td>'+value['id']+'</td>\n\
						<td>'+value['details']+'</td>\n\
						<td>'+value['category']+'</td>\n\
						<td>'+value['mrp']+'</td>\n\
						<td>'+value['price']+'</td>\n\
						<td>'+value['updated_at']+'</td>\n\
                        <td>'+value['']+'</td>\n\
						</tr>');
			});
			
        }
    });
});
</script>
@stop