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
               <h1 class="h2 mb-md-0 text-white fw-light">Customers</h1>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="page-body">
   <div class="container-fluid">
    <div class="row" id="catform" style="display:none;">
                <div class="col-12" v-if="createPannel" style="margin-bottom: 10px;">                  
                </div>
            </div>
		</div>
      <div class="row">
         <!---->
		 
         <div class="col-12">
            <div class="card">
               <div class="card-header bg-transparent pb-0">
                  <div>
                     <h6 class="card-title mb-0">Manage Customers</h6>
                     <small class="text-muted">Customers records are managed from here.</small>
                  </div>
               </div>
               <div class="card-body row-title mb-0">
                  <h5 class="fw-light mb-0">Customers<span class="fw-bold ms-2" id="catcount"></span></h5>
                  <div>
                     <form class="input-group col-md-3 col-sm-4"><input type="text" class="form-control form-control" id="search-data" placeholder="Search here..."></form>
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
                                    <th>BUSINESS NAME</th>
                                    <th>MOBILE NO</th>
                                    <th>EMAIL</th>
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
	$('#catform').toggle();
}
$(document).ready(function(){
   $("#search-data").on('paste input', function(){
      findCustomer($("#search-data").val());
   });
   findCustomer('');
});
function findCustomer(search){
   $.ajax({
        url : "{{ url('admin-api/customers') }}",
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
                     <td><img src="'+( value['picture'] == null ? '/no_pic.png' : '/storage/customers/'+value['picture'])+'" width="50" height="50"/></td>\n\
                     <td>'+value['name']+'<br>'+(value['active'] == 'Y' ? ' <span class="badge bg-success">Active</span>':' <span class="badge bg-danger">In-Active</span>')+'</td>\n\
                     <td>'+(value['business_name'] == null ? '-' :value['business_name'])+'</td>\n\
                     <td>'+(value['mobile'] == null ? '-' :value['mobile'])+'</td>\n\
                     <td>'+(value['email'] == null ? '-' :value['email'])+'</td>\n\
                           <td><button  class="btn btn-link btn-sm text-danger js-details" data-bs-toggle="tooltip"  data-id="'+value['id']+'" data-bs-placement="top" >Manage Account</button></td>\n\
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
$(document).on('click', '.js-details', function (e) {
   var id = $(this).data('id');
   window.location.href= '/admin/customer/'+id
});
</script>
@stop