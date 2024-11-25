@extends('layouts.app')
@section('content')
<div class="modal fade" id="stockModal" tabindex="-1" aria-labelledby="stockModalTitle" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title" id="stockModalTitle">Stock In</h5>
		<button type="button" class="btn-close dismiss-dialog" data-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
   <form>
   <input type="hidden" class="form-control" id="productid">
                  <div class="row mb-3">
                    <label for="pname" class="col-sm-4 col-form-label">Product Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="pname" readonly>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="stock" class="col-sm-4 col-form-label">Bill Number</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="billNumber">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="stock" class="col-sm-4 col-form-label">Qty</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" id="stock">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="stock" class="col-sm-4 col-form-label">Supplier</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="supplier">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="stock" class="col-sm-4 col-form-label">Remarks</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="remarks">
                    </div>
                  </div>
                </form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary dismiss-dialog" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary save-items">Save</button>
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
               <h1 class="h2 mb-md-0 text-white fw-light">Inventory</h1>
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
                            <h6 class="card-title mb-0">Manage Inventory</h6>
                            <small class="text-muted">Product inventory are updated here.</small>
                            </div> 
                        </div>


                     <div id="apex-chart" style="height: 200px;padding:20px;"></div>
                     <br>
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
                                        <th>Stock</th>
                                        <th>Sold</th>
                                        <th>Last Sold</th>
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

$(document).ready(function(){
   $(".dismiss-dialog").on('click', function(event){
      $('#stockModal').modal('hide')
   });

   $("#search-data").on('paste input', function(){
    findProduct($("#search-data").val());
   });
   findProduct('');
   var options = {
      chart: {
         height: 350,
         type: 'line',
         toolbar: {
            show: false,
         },
      },
      colors: ['var(--chart-color1)'],
      series: [{
         name: 'Products',
         type: 'column',
         data: <?php echo json_encode($sale)?>
      }],
      labels: <?php echo json_encode($chartWeek)?>,
      yaxis: [{
         title: {
            text: 'Products Sale',
         },
      }]
   }
   var chart = new ApexCharts(document.querySelector("#apex-chart"), options);
   chart.render();
});
function findProduct(search){
	$.ajax({
        url : "{{ url('/admin-api/inventory') }}"+'?page=<?php if(isset($_GET['page'])) echo $_GET['page']; else echo 1;?>',
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
						<td>'+(value['stock'] == null ? '-' :value['stock'])+'</td>\n\
						<td>'+(value['sold'] == null ? '-' :value['sold'])+'</td>\n\
						<td>'+(value['last_sold'] == null ? '-' :value['last_sold'])+'</td>\n\
                        <td><button  class="btn btn-link btn-sm text-danger js-sweetalert" data-bs-toggle="tooltip"  data-product="'+value['title']+'" data-id="'+value['id']+'" data-bs-placement="top" title="Edit Stock" ><i class="fa fa-pencil"></i></button></td>\n\
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
   var id = $(this).data('id');
   $('#productid').val(id);
   $('#billNumber').val("")
   $('#remarks').val("")
   $('#supplier').val("")
   $('#stock').val("")
   $('#pname').val($(this).data('product'));
   $('#stockModal').modal('show')
});

$(document).on('click', '.save-items', function (e) {
   //
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var id = $('#productid').val();
    var bill = $('#billNumber').val();
    var remarks = $('#remarks').val();
    var supplier = $('#supplier').val();
    var qty = $('#stock').val();
    $.ajax({
			type: "POST",
			url: "{{url('/admin-api/inventory/')}}" +"/"+id,
			data: {bill:bill,remarks:remarks,supplier:supplier,qty:qty},
			success: function(resultData) { 
            if(resultData == 'Data Updated!'){
               Swal.fire(
               'Updated!',
               'Stock Updated.',
               'success'
               ),location.reload();
               $('#stockModal').modal('hide')
            }else{
               Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: resultData
               });
            }
         }
				   
		});
});
</script>
@stop
