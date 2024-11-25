<template>
    <div class="modal fade" id="edit_shipment" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-vertical right-side modal-dialog-scrollable">
            <div class="modal-content">
                <div class="px-xl-4 modal-header">
                    <h5 class="modal-title">Shipment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="px-xl-4 modal-body custom_scroll">
                    <form class="card-body" :style="{'width' : '400px'}">
                        <div class="setting-more mb-4">
                            <div class="mb-2">
                                <label class="form-label small mb-0 p-1">Shipment Company</label>
                                <input id="font_url" type="text" class="form-control" placeholder="DHL" v-model="shipParam.shipment_partner">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small mb-0 p-1">Shipment Number</label>
                                <input id="font_family" type="text" class="form-control" placeholder="DR958958" v-model="shipParam.shipmentNumber">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small mb-0 p-1">Shipment Date</label>
                                <input id="font_family" type="text" class="form-control datepicker" placeholder="12-01-2022" v-model="shipParam.ship_date">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small mb-0 p-1">Tracking Url</label>
                                <input id="font_family" type="text" class="form-control" placeholder="https://e.com/958674" v-model="shipParam.shipment_link">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small mb-0 p-1">Helpline Number</label>
                                <input id="font_family" type="text" class="form-control" placeholder="" v-model="shipParam.shipment_detail">
                            </div>
                        </div>
                        
                     </form>    
                </div>
                <div class="px-xl-4 modal-footer d-flex justify-content-start text-center">
                    <div class="spinner-border text-primary" role="status" v-if="isUpdating">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    <button type="button" class="btn flex-fill btn-primary lift"  @click="updateShipment()">Save Changes</button>
                    <button type="button" class="btn flex-fill btn-white border lift" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
       </div>
    </div>
    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><router-link to="/admin/orders">Orders</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">Orders Details</li>
                </ol>
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h2 mb-md-0 text-white fw-light" v-if="orderItems.orderNumber == null">Fetching Order..</h1>
                    <h1 class="h2 mb-md-0 text-white fw-light" v-else>Order No : #{{orderItems.orderNumber}}</h1>
                    <div class="page-action">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body page-layout-1" v-if="!isFetching">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="app-social d-flex flex-nowrap align-items-start">
                        <div class="order-1 sticky-lg-top shadow-sm">
                            <ul class="nav nav-tabs menu-list list-unstyled mb-0 border-0" role="tablist">
                                <li class="text-uppercase text-muted"><small>Booking Information</small></li>
                                <hr/>
                                <li class="text-muted"><small>Booking No</small></li>
                                <li class="mb-3"><i class="fa fa-hashtag"></i><span><b>{{orderItems.billNumber}}</b></span></li>
                                <li class="text-muted"><small>Total Amount (৳)</small></li>
                                <li class="mb-3"><b>৳{{orderItems.totalAmount}}</b></li>
                                <li class="text-muted"><small>Booking Date</small></li>
                                <li class="mb-3"><b>{{orderItems.order_date}}</b></li>
                                <li class="divider mt-4 py-2 border-top text-uppercase text-muted">
                                    <small>Orders</small>
                                </li>
                                <li v-for="(value, key, index) in otherItems"><a class="m-link" href="/admin/order-details/{{key}}"><i class="fa fa-hashtag"></i><span>{{value}}</span></a></li>
                            </ul>
                        </div>
                        <div class="order-2 flex-grow-1 ps-md-3 ps-0">
                            <div class="card mb-4 overflow-hidden">
                                <div class="card-header">
                                    <h4 class="mb-0">Order Progress</h4>
                                    <button class="btn btn-sm d-block d-lg-none btn-primary social-list-toggle" type="button"><i class="fa fa-bars"></i></button>
                                </div>
                                <div class="card-body bg-body align-items-md-start align-items-center flex-column flex-md-row">
                                    <div class="progress-bar-wrapper">

                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-xxl-8 col-xl-8 col-lg-12">
                                    <div class="card mb-3">
                                       <div class="card-body">
                                        <h6 class="card-title d-flex justify-content-between align-items-center">Item Summary</h6>
                                        <table id="contact_list" class="table align-middle mb-0 card-table mt-4">
                                        <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Qty.</th>
                                            <th>Price</th>
                                            <th>Total Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody> 
                                            <tr>
                                                <td>{{ orderItems.title}}</td>
                                                <td>{{ orderItems.qty}} unit</td>
                                                <td>৳{{ orderItems.unit_price}}</td>
                                                <td>৳{{ orderItems.total}}</td>
                                            </tr>
                                        </tbody>
                                        </table>  
                                       </div>         
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h6 class="card-title mb-3">Delivery Information</h6>
                                            <ul class="list-unstyled mb-0">
                                                <li class="py-2"><span class="text-muted me-2 w120 d-inline-block"><small>Street Address 1</small>:</span>{{ orderItems.address}}</li>
                                            <li class="py-2"><span class="text-muted me-2 w120 d-inline-block"><small>Street Address 2</small>:</span>{{ orderItems.address_street}}</li>
                                            <li class="py-2"><span class="text-muted me-2 w120 d-inline-block"><small>Area</small>:</span>{{ orderItems.area}}</li>
                                            <li class="py-2"><span class="text-muted me-2 w120 d-inline-block"><small>City</small>:</span>{{ orderItems.city}}</li>
                                            <li class="py-2"><span class="text-muted me-2 w120 d-inline-block"><small>Landmark</small>:</span>{{ orderItems.landmark}}</li>
                                            <li class="py-2"><span class="text-muted me-2 w120 d-inline-block"><small>Pincode</small>:</span>{{ orderItems.pincode}}</li>
                                            </ul>
                                            <h6 class="card-title mb-3 mt-3">Personal  Information</h6>
                                            <ul class="list-unstyled mb-0">
                                            <li class="py-2"><span class="text-muted me-2 w90 d-inline-block"><small>Full Name</small>:</span>{{ orderItems.username}}</li>
                                            <li class="py-2"><span class="text-muted me-2 w90 d-inline-block"><small>E-mail</small>:</span>{{ orderItems.email}}</li>
                                            <li class="py-2"><span class="text-muted me-2 w90 d-inline-block"><small>Phone</small>:</span>{{ orderItems.mobile}}</li>
                                            <li class="py-2"><span class="text-muted me-2 w90 d-inline-block"><small>Note</small>:</span></li>
                                            </ul>
                                            <h6 class="card-title mb-3 mt-4">Shipment Information</h6>
                                            <ul class="list-unstyled mb-0">
                                            <li class="py-2"><span class="text-muted me-2 w120 d-inline-block"><small>Company</small>:</span> {{ orderItems.partner}}</li>
                                            <li class="py-2"><span class="text-muted me-2 w120 d-inline-block"><small>Shipment No</small>:</span>{{ orderItems.shipNo}}</li>
                                            <li class="py-2"><span class="text-muted me-2 w120 d-inline-block"><small>Tracking Url</small>:</span><a v-bind:href="orderItems.link" v-if="orderItems.link != 'NA'">{{ orderItems.link}}</a></li>
                                            <li class="py-2"><span class="text-muted me-2 w120 d-inline-block"><small>Shipment Date</small>:</span>{{ orderItems.shipDate}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-4 col-lg-12">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h6 class="card-title d-flex justify-content-between align-items-center">Order Status</h6>
                                            <div class="d-flex align-items-center my-4">
                                                <img class="avatar lg rounded" v-bind:src="'/storage/products/'+orderItems.pic" width="50" height="50">
                                                    <div class="flex-fill ms-3">
                                                        <div class="h6 mb-1">{{ orderItems.title}}</div>
                                                        <span class="badge bg-primary" v-if="orderItems.status == 'New Order'">New Order</span>
                                                        <span class="badge bg-warning" v-if="orderItems.status == 'Shipped'">Shipped</span>
                                                        <span class="badge bg-success" v-if="orderItems.status == 'Delivered'">Delivered</span>
                                                        <span class="badge bg-info" v-if="orderItems.status == 'In Progress'">In Progress</span>
                                                    </div>
                                            </div>
                                            <div class="d-flex" v-if="moveLabel != ''">
                                                <button @click="changeStatus()" class="btn mx-1 btn-light-primary flex-grow-1">{{moveLabel}}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title mb-3">Order Information</h6>
                                        <ul class="list-unstyled mb-0">
                                        <li class="py-2"><span class="text-muted me-2 w60 d-inline-block"><small>Date</small>:</span>{{orderItems.order_date}}</li>
                                        <li class="py-2"><span class="text-muted me-2 w60 d-inline-block"><small>Time</small>:</span>{{orderItems.time}}</li>
                                        <li class="py-2"><span class="text-muted me-2 w60 d-inline-block"><small>Subtotal</small>:</span>৳{{orderItems.subtotal}}</li>
                                        <li class="py-2"><span class="text-muted me-2 w60 d-inline-block"><small>Tax</small>:</span> ৳{{orderItems.tax}}</li>
                                        <li class="py-2"><span class="text-muted me-2 w60 d-inline-block"><small>Delivery Fee</small>:</span> ৳{{orderItems.delivery_charges}}</li>
                                        </ul>
                                    </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body p-4">
                                            <ul class="list-unstyled mb-0">
                                                <li><span class="text-muted me-2 w60 d-inline-block">Total:</span> <b>৳{{orderItems.total}}</b></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body text-center" v-else>
    <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status" >
        <span class="visually-hidden">Loading...</span>
    </div></div>
</template>

<script>
    export default {
        data(){
            return{
                orderItems : {},
                otherItems : [],
                orderStatus : [],
                shipParam : {},
                isProgress : false,
                isUpdating : false,
                nextStatus : '',
                message : '',
                currentStatus : '',
                moveLabel : "Process Order",
                isFetching : true,
            }
        },
        updated(){
            var self = this
            if(!this.isFetching && !this.isProgress)
            $(function() {
                self.isProgress = true;
                ProgressBar.singleStepAnimation = 1500;
                ProgressBar.init(
                    self.orderStatus,
                    self.currentStatus,
                    'progress-bar-wrapper'
                )
            })

            if(self.shipParam != null){
                $('.datepicker').datepicker("setValue", self.shipParam.ship_date);
            }else
            $('.datepicker').datepicker({dateFormat: 'dd-MM-yyyy'});
        },
        created(){
            axios
                .get('/admin-api/orders/'+this.$route.params.id)
                .then(response => {
                    this.otherItems = response.data.items
                    this.orderItems = response.data.order;
                    this.orderStatus = response.data.status;
                    this.currentStatus = response.data.current;
                    this.moveLabel = response.data.statusLabel
                    this.nextStatus = response.data.nextStatus
                    this.isFetching = false;
                });   
        },
        methods : {
            updateShipment(){
                this.isUpdating = true
                this.shipParam.ship_date = $('.datepicker').datepicker().val();
                this.shipParam.status = 'Shipped';
                if(this.shipParam.shipmentNumber == undefined || this.shipParam.shipment_partner == undefined){
                    this.isUpdating = false
                    Swal.fire('Shipment details are required', '', 'error')
                    return
                }
                axios
                    .patch('/admin-api/orders/'+this.$route.params.id, this.shipParam)
                    .then((res) => {
                        this.message = ''
                    })
                    .catch(err => {
                        this.isUpdating = false
                        var errorMessage = err.response.data
                        this.message = errorMessage.message
                        Swal.fire(this.message, '', 'error')
                    })
                    .finally(() => {
                                if(this.message == '')
                                window.location.reload();
                            }
                        );
            },
            changeStatus(){
                Swal.fire({
                    title: 'Do you want to change status of this order?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Yes',
                    denyButtonText:'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                       if(this.moveLabel == 'Ship Order')
                       $('#edit_shipment').modal('show');
                       else{
                        var dataParam = {}
                        dataParam.status = this.nextStatus
                        axios
                            .patch('/admin-api/orders/'+this.$route.params.id, dataParam)
                            .then((res) => {
                                this.message = ''
                            })
                            .catch(err => {
                                var errorMessage = err.response.data
                                this.message = errorMessage.message
                                Swal.fire(this.message, '', 'error')
                            })
                            .finally(() => {
                                if(this.message == '')
                                    window.location.reload();
                                }
                            );
                       }
                    }
                })
            }
        }
    }
</script>
<style>
ul.progress-bars {
    width: 100%;
    margin: 0;
    padding: 0;
    font-size: 0;
    list-style: none;
}

li.section {
    display: inline-block;
    padding-top: 45px;
    font-size: 13px;
    font-weight: bold;
    line-height: 16px;
    color: black;
    vertical-align: top;
    position: relative;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
}

li.section:before {
    content: "";
    position: absolute;
    top: 2px;
    left: calc(50% - 15px);
    z-index: 1;
    width: 30px;
    height: 30px;
    color: white;
    border: 2px solid white;
    border-radius: 17px;
    line-height: 30px;
    background: gray;
}
.status-bar {
    height: 2px;
    background: gray;
    position: relative;
    top: 20px;
    margin: 0 auto;
}
.current-status {
    height: 2px;
    width: 0;
    border-radius: 1px;
    background: mediumseagreen;
}

@keyframes changeBackground {
    from {background: gray}
    to {background: #2e2d6a}
}

li.section.visited:before {
    content: '\221A';
    animation: changeBackground .5s linear;
    animation-fill-mode: forwards;
}

li.section.visited.current:before {
    box-shadow: 0 0 0 2px mediumseagreen;
}
</style>