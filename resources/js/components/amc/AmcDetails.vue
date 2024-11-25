<template>
    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><router-link to="/admin/amc">AMC Orders</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">Orders Details</li>
                </ol>
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h2 mb-md-0 text-white fw-light">Order No #{{rawAmcDetails.amcNumber}}</h1>
                    <div class="page-action">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card overflow-hidden">
                    <div class="card-body bg-success text-light" v-if="expireDays > 20">
                        <span>Message : AMC is within the expiry limit. No action required</span>
                    </div>
                    <div class="card-body bg-warning text-primary" v-if="expireDays < 20 && expireDays >= 0">
                        <span>Warning : AMC is about to expiry. Inform customer to renew</span>
                    </div>
                    <div class="card-body bg-danger text-light" v-if="expireDays < 0">
                        <span>Expired : AMC is expired. Renewal is required as complaints cannot be generated.</span>
                    </div>
                    <div class="card-body row g-3">
                        <h4 class="fw-normal">Current subscription: <u>{{rawAmcDetails.amcName}}</u></h4>
                        <div class="d-flex align-items-center mb-3 mt-4">
                            <div class="me-3">
                                <img class="rounded" v-bind:src="'/storage/products/'+rawAmcDetails.pic" width="50" height="50" alt="avatar lg" title="" v-if="rawAmcDetails.pic != undefined">
                            </div>
                            <div class="media-body">
                                <h6 class="mb-0">{{rawAmcDetails.title}}</h6>
                                <p class="badge bg-light text-dark">{{rawAmcDetails.modelNumber}}</p>
                            </div>
                        </div>

                        <p class="fw-normal"><b><u>Package Includes :</u></b></p>
                        <p v-html="rawAmcDetails.offerings"></p>
                        <div class="col-xxl-8 col-xl-8 col-lg-12">
                            <table class="table table-sm table-bordered mb-0">
                                <tbody>
                                <tr>
                                    <th scope="row">Status: </th>
                                    <td><span class="badge bg-primary">Active</span></td>
                                </tr>
                                <tr>
                                    <th scope="row">Order Date:</th>
                                    <td>{{rawAmcDetails.order_date}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Plan Duration:</th>
                                    <td>{{rawAmcDetails.duration}} {{rawAmcDetails.unit}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Expiry Date:</th>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <th scope="row">Total Amount:</th>
                                    <td>৳{{rawAmcDetails.total}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-12">
                            <h6 class="card-title mb-3">Personal  Information</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="py-2"><span class="text-muted me-2 w90 d-inline-block"><small>Full Name</small>:</span>{{rawAmcDetails.username}}</li>
                                <li class="py-2"><span class="text-muted me-2 w90 d-inline-block"><small>E-mail</small>:</span>{{rawAmcDetails.email}}</li>
                                <li class="py-2"><span class="text-muted me-2 w90 d-inline-block"><small>Phone</small>:</span>{{rawAmcDetails.mobile}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="page-pricing.html" title="" class="btn btn-primary text-uppercase">Create Complaint</a>
                        <button type="button" class="btn btn-link text-danger">Cancel Order</button>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card fieldset border border-muted mt-3">
                <span class="fieldset-tile text-muted bg-body">AMC History</span>
                <div class="card">
                    <div class="card-body table-responsive p-0">
                    <table class="table card-table mb-0">
                        <thead>
                        <tr>
                            <th scope="col">Purchae Date</th>
                            <th scope="col">Product</th>
                            <th scope="col">AMC</th>
                            <th scope="col">Validity</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="4" class="text-center">No record found</td>
                        </tr>
                        </tbody>
                    </table>
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
                rawAmcDetails : [],
                expireDays : 0,
            }  
        },
        created(){
            this.fetchDetails()
        },
        methods: {
            fetchDetails(){
                axios
                .get('/admin-api/amc/order/'+this.$route.params.id)
                .then(response => {
                    this.rawAmcDetails = response.data.order;
                });
            }
        }
    }
</script>