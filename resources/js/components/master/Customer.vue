<template>
    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><router-link to="/admin/home">Dashboard</router-link></li>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-transparent pb-0">
                            <div>
                            <h6 class="card-title mb-0">Manage Customers</h6>
                            <small class="text-muted">Customer records are managed from here.</small>
                            </div> 
                        </div>
                        <div class="card-body row-title mb-0 pb-0">
                                <h5 class="fw-light mb-0">Customers
                                    <span class="fw-bold ms-2">({{ total }})</span>
                                </h5>
                                <div>
                                    <form class="input-group col-md-3 col-sm-4">
                                        <input type="text" class="form-control form-control" placeholder="Search here..." @input="searchUser($event)">
                                    </form>
                                </div>
                        </div>
                        <div class="card-body" v-if="customers.length > 0">
                            <table class="table align-middle card-table mb-0 roleTable">
                                <thead>
                                    <tr>
                                        <th>Customert ID</th>
                                        <th>Name</th>
                                        <th>Business Name</th>
                                        <th>Mobile No</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="customer in customers" :key="customer.id">
                                        <td>
                                           CRM-00{{ customer.id }}
                                        </td>
                                        <td>
                                           {{ customer.name }}
                                        </td>
                                        <td>{{ customer.business_name }}  
                                        </td>
                                        <td>{{ customer.mobile }}</td>
                                        <td>{{ customer.email }}</td>
                                        <td>
                                            <span class="badge bg-success" v-if="customer.active === 'Y'">Active</span>
                                            <span class="badge bg-danger" v-else>Inactive</span>
                                            <button type="button" class="btn btn-link btn-sm color-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Block/Unblock Account" @click="showDeleteAlert(customer)"><i class="fa fa-lock"></i></button> 
                                        </td>
                                        <td>
                                            <a class="btn btn-outline-primary" @click="showCustomerDetails(customer.id)">Manage Account</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-end mt-2">
                                    
                                    <li class="page-item" v-for="link in links" :key="link.label" v-bind:class="(link.active)?'active': (link.url == null)?'disabled':''">
                                        <button class="page-link" @click="paginate(link.url)" v-html="link.label"></button>
                                    </li>
                                   
                                </ul>
                            </nav>
                        </div>
                        <div class="card-body col-12 text-center p-5" v-else> 
                            <img src="/assets/img/no-data.svg" class="w120" alt="No Data">
                            <div class="mt-4 mb-3">
                                <span class="text-muted">Currently you have no customer to show here.</span>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                customers: [],
                total : 0,
                links :[],
                createPannel : false,
                isCreating : false,
                customerParam: {},
                message : "",
            }
        },
        updated(){
            if(this.isCreating){
                $('.roleTable').addClass('nowrap').dataTable({
                    responsive: true,
                    paging: false,
                    searching: false,
                    ordering: true,
                    info: false,
                    bDestroy :true,
                });
            }
        },
        created(){
            this.customerParam.active = ''
            this.isCreating = true
            axios
                .get('/admin-api/customers')
                .then(response => {
                    this.customers = response.data.data;
                    this.links = response.data.links;
                    this.total = response.data.total;
                }).finally(() => {
                        this.isCreating = false
                        }
                    );   
        },
        methods : {
            searchUser(event){
                axios
                .get('/admin-api/customers?search='+event.target.value)
                .then(response => {
                    this.customers = response.data.data;
                    this.links = response.data.links;
                    this.total = response.data.total;
                    $('.roleTable').DataTable().destroy();
                });
            },
            paginate(url){
                axios
                .get(url)
                .then(response => {
                    this.customers = response.data.data;
                    this.links = response.data.links;
                    this.total = response.data.total;
                    $('.roleTable').DataTable().destroy();
                });
            },
            showCustomerDetails(id){
                window.open( "/admin/customer-details/"+id,'_blank');
            },
            showDeleteAlert(customer){
               if(customer.active == 'Y'){
                Swal.fire({
                    title: 'Do you want to change status of this customer?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Cancel',
                    denyButtonText: 'Deactivate',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isDenied) {
                       axios
                        .delete('/admin-api/customers/'+customer.id)
                        .then(response => {
                            let index = this.customers.map(data => data.id).indexOf(customer.id);
                            this.customers[index].active = 'N'
                        });
                    }
                })
               }else{
                Swal.fire({
                    title: 'Do you want to change status of this customer?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Activate',
                    denyButtonText:'Cancel',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                       axios
                        .delete('/admin-api/customers/'+customer.id)
                        .then(response => {
                            let index = this.customers.map(data => data.id).indexOf(customer.id);
                            this.customers[index].active = 'Y'
                        });
                    }
                })
               }
               
            }
        }
    }
</script>