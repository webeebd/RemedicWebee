@extends('layouts.app')
@section('content')
<div class="page-header pattern-bg">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12 mb-2">
            <ol class="breadcrumb mb-2">
               <li class="breadcrumb-item"><a href="{{url('admin/home')}}" class="">Dashboard</a></li>
               <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
            <div class="d-flex justify-content-between align-items-center">
               <h1 class="h2 mb-md-0 text-white fw-light">Products</h1>
               <div class="page-action">
                <a class="btn d-none d-sm-inline-flex rounded-pill" type="button" href="{{url('/admin/products/create')}}">
                     <span class="me-1 d-none d-lg-inline-block">Add New Product</span>
                     <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0V0Z" fill="white"></path>
                     </svg>
                 </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-transparent pb-0">
                            <div>
                            <h6 class="card-title mb-0">Manage Products</h6>
                            <small class="text-muted">Manage product details here.</small>
                            </div> 
                        </div>
                        <div class="card-body row-title mb-0">
                                <h5 class="fw-light mb-0">Products
                                    <span class="fw-bold ms-2" id="catcount"></span>
                                </h5>
                                <div>
                                    <form class="input-group col-md-3 col-sm-4">
                                        <input type="text" class="form-control form-control" placeholder="Search here..." id="search-data">
                                    </form>
                                </div>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table align-middle card-table mb-0 productTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product Details</th>
                                        <th>Category</th>
                                        <th>MRP</th>
                                        <th>Price</th>
                                        <th>Last Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="databind">
                                    
                                </tbody>
                            </table>
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
   $("#search-data").on('paste input', function(){
    findProduct($("#search-data").val());
   });
   findProduct('');
});
function findProduct(search){
	$.ajax({
        url : "{{ url('/admin-api/products') }}"+'?page=<?php if(isset($_GET['page'])) echo $_GET['page']; else echo 1;?>',
        data : {'search' : search},
        type : 'GET',
        dataType : 'json',
        success : function(result){
            $('#catcount').empty();
            $('#databind').empty();
            $('#page_links').empty();

            $('#catcount').append('('+result.total+')');
			$.each(result.data, function( index, value ) {
			   $('#databind').append('<tr>\n\
						<td><img src="'+( value['pic'] == null ? '/no_pic.png' : '/storage/products/'+value['pic'])+'" width="50" height="50"/></td>\n\
						<td>'+value['title']+'<br>'+(value['active'] == 'Y' ? ' <span class="badge bg-success">Active</span>':' <span class="badge bg-danger">In-Active</span>')+'</td>\n\
						<td>'+(value['category'] == null ? '-' :value['category'])+'</td>\n\
						<td>৳'+(value['mrp'] == null ? '-' :value['mrp'])+'</td>\n\
						<td>৳'+(value['price'] == null ? '-' :value['price'])+'</td>\n\
						<td>'+value['updated_at']+'</td>\n\
                        <td><a href="{{ url('admin/products/') }}/'+value['id']+'/edit" class="btn btn-link btn-sm text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Role"><i class="fa fa-pencil"></i></a>  <button  class="btn btn-link btn-sm text-danger js-sweetalert" data-bs-toggle="tooltip"  data-id="'+value['id']+'" data-bs-placement="top" title="Unpublish" ><i class="fa fa-trash"></i></button></td>\n\
						</tr>');
			});
            $.each(result.links, function( index, value ) {
                  if(value['url'] == null)
                  var links = '<li class="page-item disabled"><button class="page-link">'+value['label']+'</button></li>';
                  else if(value['active'] == true)
                  var links = '<li class="page-item active"><button class="page-link">'+value['label']+'</button></li>';
                  else if(value['url'] != null){
                    let result = value['url'].replace("admin-api", "admin");
                    var link = "'"+result+"'";
                    var links = '<li class="page-item"> <button class="page-link" onClick="location.href = '+link+';">'+value['label']+'</button></li>';
                  }                  
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
	  text: "You can later publish it from update product",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, unpublish it!'
	}).then((result) => {
	  if (result.isConfirmed) {
	   $.ajax({
			type: "DELETE",
			url: "{{url('/admin-api/products/')}}" +"/"+id,
			data: {id:id},
			success: function(resultData) { 
            if(resultData == 'Data deleted!'){
               Swal.fire(
               'Deleted!',
               'Your product has been disabled.',
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