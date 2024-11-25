<template>
    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><router-link to="/admin/customers">Customers</router-link></li>
                        <li class="breadcrumb-item active" aria-current="page">Overview</li>
                    </ol>
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h2 mb-md-0 text-white fw-light">Customers Details</h1>
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
                        <div class="card-body border-bottom">
                            <div class="card-body">
                                <div class="row align-items-center">
                                <div class="col-auto">
                                    <a href="#" class="avatar"><img src="/assets/img/xs/avatar1.jpg" alt="..." class="rounded-circle"></a>
                                </div>
                                <div class="col ml-n2">
                                    <h4 class="mb-1 fw-light">{{ customer.name }}</h4>
                                    <p>{{ customer.email }}</p>
                                    <p class="mb-0" v-if="customer.active == 'Y'"> <span class="badge bg-success">Active</span></p>
                                    <p class="mb-0" v-else> <span class="badge bg-danger">Inactive</span></p>

                                </div>
                                <div class="col-auto">
                                    <ul class="resume-box ps-0 pb-0 mb-0">
                                        <li>
                                            <div class="icon text-center">
                                            <i class="fa fa-mobile"></i>
                                            </div>
                                            <div class="fw-bold mb-0">Mobile</div>
                                            <span>{{ customer.mobile }}</span>
                                        </li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="row-title mt-3 mb-3">Profile Overview</h5>
            <div class="row g-3">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-12">
                    <div class="card mb-3">
                        <div class="card-body doctor-detail order-1 order-md-0">
                            <div class="mb-0 fw-bold">Customer Address</div>
                            <div class="d-flex flex-row flex-wrap align-items-center mb-3 mt-2">
                            </div>
                            <span>List of all the address customer added to our system.</span>
                            <ul class="resume-box ps-0 pb-0 mb-0">
                            <li v-for="address in addresses" :key="address.id">
                                <div class="icon text-center">
                                <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="fw-bold mb-0">Address</div>
                                <span>{{address.address_house}} {{address.address_street}} {{address.landmark}} , {{address.area}} {{address.city}} , {{address.pincode}}</span>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8 col-xl-7 col-lg-7 col-md-12">
                    <div class="card fieldset border border-muted">
                        <span class="fieldset-tile text-muted bg-body">Customer Cart</span>
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table align-middle card-table mb-0 myDataTable">
                                    <thead>
                                        <tr>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="cartItems.length == 0">
                                        <td colspan="3" class="text-center"> No record found </td>
                                        </tr>
                                        <tr v-for="cartItem in cartItems" :key="cartItem.id">
                                        <td>
                                            <span class="me-4 ms-2">{{ cartItem.name }}</span>
                                            <span class="badge bg-light text-dark">{{ cartItem.modelNumber }}</span> 
                                        </td>
                                        <td>{{ cartItem.updated_at }}</td>
                                        <td>{{ cartItem.qty }} unit</td>
                                        </tr>
                                    </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-3 mt-3 mb-5">
                <div class="card fieldset border border-muted">
                        <span class="fieldset-tile text-muted bg-body">Order History</span>
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table card-table mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Order No.</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Invoice</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="orderItems.length == 0">
                                        <td colspan="8" class="text-center"> No record found </td>
                                        </tr>
                                        <tr v-for="orderItem in orderItems" :key="orderItem.id">
                                            <td>{{ orderItem.order_date }}</td>
                                            <td>{{ orderItem.orderNumber }}</td>
                                            <td>{{ orderItem.name }} <span class="badge bg-light text-dark">{{ orderItem.modelNumber }}</span> </td>
                                            <td>{{ orderItem.qty }} unit</td>
                                            <td><div :style="{'width': '280px','white-space': 'pre-wrap'}">{{orderItem.address}} {{orderItem.address_street}} {{orderItem.landmark}} , {{orderItem.area}} {{orderItem.city}} , {{orderItem.pincode}}</div></td>
                                            <td><span class="badge bg-info" v-if="orderItem.status == 'Processing'">{{orderItem.status}}</span></td>
                                            <td>৳{{ orderItem.total }}</td>
                                            <td class="date status">
                                                Not Available
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end mt-2">
                            <li class="page-item" v-for="link in links" :key="link.label" v-bind:class="(link.active)?'active': (link.url == null)?'disabled':''">
                                <button class="page-link" @click="paginate(link.url)" v-html="link.label"></button>
                            </li>  
                        </ul>
                    </nav>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                customer: {},
                addresses : [],
                cartItems : [],
                orderItems : [],
                links :[],
            }
        },
        updated(){

        },
        created(){
            axios
                .get('/admin-api/fetch/customers/'+this.$route.params.id)
                .then(response => {
                    this.customer = response.data.details
                    this.cartItems = response.data.cart
                    this.addresses = response.data.address
                    this.orderItems = response.data.order.data;
                    this.links = response.data.order.links;
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
            }
        }
    }
</script>