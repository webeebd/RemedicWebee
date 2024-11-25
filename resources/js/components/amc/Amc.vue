<template>
    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><router-link to="/admin/home">Remedic</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">AMC Orders</li>
                </ol>
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h2 mb-md-0 text-white fw-light">AMC Management</h1>
                    <div class="page-action">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row g-2 row-deck">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                    <div class="card-body d-flex align-items-center p-xl-4 p-lg-3 p-2">
                        <div class="avatar lg rounded-circle no-thumbnail">
                            <i class="fa fa-folder-open fa-lg"></i>
                        </div>
                        <div class="flex-fill ms-3 text-truncate">
                        <div class="text-muted">Total AMC Orders</div>
                        <div><span class="h6 fw-bold">0</span></div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                    <div class="card-body d-flex align-items-center p-xl-4 p-lg-3 p-2">
                        <div class="avatar lg rounded-circle no-thumbnail">
                            <i class="fa fa-folder-open fa-lg"></i>
                        </div>
                        <div class="flex-fill ms-3 text-truncate">
                        <div class="text-muted">New Complaints</div>
                        <div><span class="h6 fw-bold">0</span></div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                    <div class="card-body d-flex align-items-center p-xl-4 p-lg-3 p-2">
                        <div class="avatar lg rounded-circle no-thumbnail">
                            <i class="fa fa-cogs fa-lg"></i>
                        </div>
                        <div class="flex-fill ms-3 text-truncate">
                        <div class="text-muted">In Progress</div>
                        <div><span class="h6 fw-bold">0</span></div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                    <div class="card-body d-flex align-items-center p-xl-4 p-lg-3 p-2">
                        <div class="avatar lg rounded-circle no-thumbnail">
                            <i class="fa fa-check-square-o fa-lg"></i>
                        </div>
                        <div class="flex-fill ms-3 text-truncate">
                        <div class="text-muted">Closed Complaints</div>
                        <div><span class="h6 fw-bold">0</span></div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row card mt-3 p-3">
                <div class="row-title col-12">
                    <p>
                        <h5 class="mb-0 mt-3">Complaint Orders</h5>
                        <span class="text-muted small">Based your preferences</span>
                    </p>
                    <div class="input-group" :style="{'width':'300px'}">
                            <input type="text" class="form-control" placeholder="Enter Order No." aria-describedby="project-search-addon" v-model="serachText" />
                            <button class="btn btn-primary" type="button" disabled v-if="isSearching">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </button>
                            <button class="btn btn-outline-secondary" type="button" @click="searchOrder()" v-else><i class="fa fa-search"></i></button>
                            <button class="btn btn-outline-secondary" type="button" @click="fetchOrder()"><i class="fa fa-times " aria-hidden="true" :style="{'margin-right':'5px'}"></i>Clear</button>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                            <th>Order No</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Product</th>
                            <th>AMC Name</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Last Update</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="supportItems.length == 0">
                                <td colspan="9" class="text-center"> No record found </td>
                            </tr>
                            <tr v-for="supportItem in supportItems" :key="supportItem.id">
                            <td class="w120">{{supportItem.amcNumber}}</td>
                            <td>{{ supportItem.username }}</td>
                            <td v-if="supportItem.type == 'offline'"><div :style="{'width': '280px','white-space': 'pre-wrap'}">{{supportItem.address}} {{supportItem.address_street}} {{supportItem.landmark}} , {{supportItem.area}} {{supportItem.city}} , {{supportItem.pincode}}</div></td>
                            <td>Not Applicable</td>
                            <td><div :style="{'width': '280px','white-space': 'pre-wrap'}">{{supportItem.title}}</div></td>
                            <td>{{ supportItem.amcName }}</td>
                            <td><b>৳{{ supportItem.total }}</b></td>
                            <td>
                                <span class="badge bg-primary" v-if="supportItem.status == 'New AMC Order'">New Order</span>
                                <span class="badge bg-success" v-if="supportItem.status == 'Completed AMC'">Completed</span>
                                <span class="badge bg-info" v-if="supportItem.status == 'In Progress AMC'">In Progress</span>
                            </td>
                            <td>{{ supportItem.order_date }}</td>
                            <td>
                                <a class="btn btn-outline-primary" @click="showOrderDetails(supportItem.id)">View Details</a>
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
            <div class="row mt-3 mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row-title col-12">
                                <p>
                                    <h5 class="mb-0 mt-3">AMC Orders </h5>
                                    <span class="text-muted small">Based your preferences</span>
                                </p>
                                
                                <div class="input-group" :style="{'width':'300px'}">
                                    <input type="text" class="form-control" placeholder="Enter Order No." aria-describedby="project-search-addon" v-model="serachText" />
                                    <button class="btn btn-primary" type="button" disabled v-if="isSearching">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    </button>
                                    <button class="btn btn-outline-secondary" type="button" @click="searchOrder()" v-else><i class="fa fa-search"></i></button>
                                    <button class="btn btn-outline-secondary" type="button" @click="fetchOrder()"><i class="fa fa-times " aria-hidden="true" :style="{'margin-right':'5px'}"></i>Clear</button>
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                    <th>Order No</th>
                                    <th>Name</th>
                                    <th>Product</th>
                                    <th>AMC Name</th>
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
                                    <td class="w120">{{orderItem.amcNumber}}</td>
                                    <td>{{ orderItem.username }}</td>
                                    <td><div :style="{'width': '280px','white-space': 'pre-wrap'}">{{orderItem.title}}</div></td>
                                    <td>{{ orderItem.amcName }}</td>
                                    <td><b>৳{{ orderItem.total }}</b></td>
                                    <td>
                                        <span class="badge bg-success" v-if="orderItem.status == 'Delivered'">Delivered</span>
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
    </div>
</template>

<script>
    export default {
        data(){
            return{
                total : 0,
                supportItems : [],
                orderItems : [],
                links : [],
                isSearching : false,
                serachText : '',
                newOrder : 0,
                claimOrder : 0,
            }  
        },
        created(){
            this.fetchOrder();
        },
        methods: {
            paginate(url){
                axios
                .get(url)
                .then(response => {
                    this.orderItems = response.data.order.data;
                    this.links = response.data.order.links;
                });   
            },
            fetchOrder(){
                this.serachText =''
                axios
                .get('/admin-api/amc/order')
                .then(response => {
                    this.orderItems = response.data.order.data;
                    this.links = response.data.order.links;
                    this.total = response.data.order.total;
                    var overview = response.data.overview;    
                    if(overview["Total AMC"] != null)
                    this.newOrder = overview["Total AMC"]
                    if(overview["Claimed AMC"] != null)
                    this.claimOrder = overview["Claimed AMC"]
                });
            },
            showOrderDetails(id){
                window.open( "/admin/amc-details/"+id,'_blank');
            },
            searchOrder(){
                if(this.serachText.length == 0){
                    Swal.fire('Please write order number to search.')
                    return;
                }

                this.isSearching = true
                axios
                .get('/admin-api/amc/order?search='+this.serachText)
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