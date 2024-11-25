<template>
    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><router-link to="/admin/home">Remedic</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">Orders</li>
                </ol>
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h2 mb-md-0 text-white fw-light">Order Management</h1>
                    <div class="page-action">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row g-2">
                <div class="col-12">
                    <div class="card overflow-hidden">
                        <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 10%" aria-valuenow="13" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="7" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3 col-sm-6">
                                    <div class="card p-3">
                                        <div class="text-muted text-uppercase"><i class="fa fa-circle me-2 text-danger"></i>New Orders</div>
                                        <div class="mt-1">
                                        <span class="fw-bold h4 mb-0">{{ newOrder }}</span>
                                        <span class="ms-1">0% <i class="fa fa-caret-up"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                <div class="card p-3">
                                    <div class="text-muted text-uppercase"><i class="fa fa-circle me-2 text-info"></i>In Progress</div>
                                    <div class="mt-1">
                                    <span class="fw-bold h4 mb-0">{{ progressOrder }}</span>
                                    <span class="ms-1">0% <i class="fa fa-caret-down"></i></span>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                <div class="card p-3">
                                    <div class="text-muted text-uppercase"><i class="fa fa-circle me-2 text-warning"></i>Shipped</div>
                                    <div class="mt-1">
                                    <span class="fw-bold h4 mb-0">{{ shippedOrder }}</span>
                                    <span class="ms-1">0% <i class="fa fa-caret-up"></i></span>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                <div class="card p-3">
                                    <div class="text-muted text-uppercase"><i class="fa fa-circle me-2 text-success"></i>Delivered</div>
                                    <div class="mt-1">
                                    <span class="fw-bold h4 mb-0">{{ completedOrder }}</span>
                                    <span class="ms-1">0% <i class="fa fa-caret-up"></i></span>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-xxl-9 col-lg-8 col-md-8">
                                <div class="form-floating">
                                    <input type="email" class="form-control" placeholder="Find Order No ..." v-model="serachText">
                                    <label>Find Order...</label>
                                </div>
                                </div>
                                <div class="col-xxl-3 col-lg-4 col-md-4">
                                <button class="btn btn-lg btn-primary" type="button" disabled v-if="isSearching">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Searching Order...
                                </button>
                                <button type="button" class="btn btn-lg btn-primary" @click="searchOrder()" v-else>Search</button>
                                <button :style="{'margin-left':'10px'}" type="button" class="btn btn-lg btn-primary" @click="fetchOrder()">Show All</button></div>
                            </div>
                            <div class="col-12 fs-6 mt-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="New" id="NewOrder" @change="checkFilter($event)">
                                <label class="form-check-label" for="NewOrder">New Order</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="Processing" id="InProgress" @change="checkFilter($event)">
                                <label class="form-check-label" for="InProgress">In Progress</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="Shipped" id="Shipped" @change="checkFilter($event)">
                                <label class="form-check-label" for="Shipped">Shipped</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="Delivered" id="Delivered" @change="checkFilter($event)">
                                <label class="form-check-label" for="Delivered">Delivered</label>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <h5 class="mb-0 mt-3">Showing {{total}} Orders</h5>
                        <span class="text-muted small">Based your preferences</span>
                    </div>
                    <div class="col-12 mt-3">
                    <div class="table-responsive">
                        <table class="table align-middle table-bordered mb-0 custom-table-2">
                        <thead>
                            <tr>
                            <th>Order No</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Last Update</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="orderItems.length == 0">
                                <td colspan="9" class="text-center"> No record found </td>
                            </tr>
                            <tr v-for="orderItem in orderItems" :key="orderItem.id">
                            <td class="w120">{{orderItem.orderNumber}}</td>
                            <td>{{ orderItem.username }}</td>
                            <td><div :style="{'width': '280px','white-space': 'pre-wrap'}">{{orderItem.address}} {{orderItem.address_street}} {{orderItem.landmark}} , {{orderItem.area}} {{orderItem.city}} , {{orderItem.pincode}}</div></td>
                            <td>{{ orderItem.name }}</td>
                            <td>{{ orderItem.qty }}</td>
                            <td><b>৳{{ orderItem.total }}</b></td>
                            <td>
                                <span class="badge bg-primary" v-if="orderItem.status == 'New Order'">New Order</span>
                                <span class="badge bg-warning" v-if="orderItem.status == 'Shipped'">Shipped</span>
                                <span class="badge bg-success" v-if="orderItem.status == 'Delivered'">Delivered</span>
                                <span class="badge bg-info" v-if="orderItem.status == 'In Progress'">In Progress</span>
                            </td>
                            <td>{{ orderItem.order_date }}</td>
                            <td>
                                <a class="btn btn-outline-primary" @click="showOrderDetails(orderItem.id)">View Details</a>
                            </td>
                            </tr>
                        </tbody>
                        </table>
                        <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end mt-3">
                            <li class="page-item" v-for="link in links" :key="link.label" v-bind:class="(link.active)?'active': (link.url == null)?'disabled':''">
                                <button class="page-link" @click="paginate(link.url)" v-html="link.label"></button>
                            </li>  
                        </ul>
                        </nav>
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
                orderItems : [],
                links :[],
                serachText : '',
                filters : [],
                total : 0,
                newOrder : 0,
                progressOrder : 0,
                shippedOrder : 0,
                completedOrder : 0,
                isSearching : false,
            }
        },
        created(){
            axios
                .get('/admin-api/orders')
                .then(response => {
                    this.orderItems = response.data.order.data;
                    this.links = response.data.order.links;
                    this.total = response.data.order.total;
                    var overview = response.data.overview;    
                    if(overview["New Order"] != null)
                    this.newOrder = overview["New Order"]
                    if(overview["In Progress"] != null)
                    this.progressOrder = overview["In Progress"]
                    if(overview["Shipped"] != null)
                    this.shippedOrder = overview["Shipped"]
                    if(overview["Delivered"] != null)
                    this.completedOrder = overview["Delivered"]
                });   
        },
        methods : {
            paginate(url){
                axios
                .get(url)
                .then(response => {
                    this.orderItems = response.data.order.data;
                    this.links = response.data.order.links;
                });   
            },
            fetchOrder(){
                axios
                .get('/admin-api/orders')
                .then(response => {
                    this.orderItems = response.data.order.data;
                    this.links = response.data.order.links;
                });   
                $('input[type=checkbox]').prop('checked',false);
                this.filters = [];
            },
            showOrderDetails(id){
                window.open( "/admin/order-details/"+id,'_blank');
            },
            checkFilter(e){
                let i = this.filters.indexOf(e.target.value);
                if(i == -1){
                    this.filters.push(e.target.value);
                }else this.filters.splice(i, 1);
                axios
                .get('/admin-api/orders?filter[]='+this.filters)
                .then(response => {
                    this.orderItems = response.data.order.data
                    this.links = response.data.order.links
                    this.total = response.data.order.total
                })
                .finally(() => {
                    this.isSearching = false
                });
            },
            searchOrder(){
                if(this.serachText.length == 0){
                    Swal.fire('Please write order number to search.')
                    return;
                }

                this.isSearching = true
                axios
                .get('/admin-api/orders?search='+this.serachText)
                .then(response => {
                    this.orderItems = response.data.order.data
                    this.links = response.data.order.links
                    this.total = response.data.order.total
                })
                .finally(() => {
                    this.isSearching = false
                });   
            }
        }
    }
</script>