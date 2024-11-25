<template>
    <div class="modal fade" id="modalLive" tabindex="-1" aria-modal="true" role="dialog" style="display: none;">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Discount Details - {{discountData.name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-primary"><u>Description</u></p>
                    <p class="mt-2">{{discountData.description}}</p>
                    <ul class="list-group list-group-custom mt-2">
                        <li class="list-group-item" v-for="modelCategory in modelCategories" :key="modelCategory">{{modelCategory}}</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><router-link to="/admin/home">Dashboard</router-link></li>
                        <li class="breadcrumb-item active" aria-current="page">Masters</li>
                    </ol>
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h2 mb-md-0 text-white fw-light">Discounts</h1>
                        <div class="page-action">
                            <button class="btn d-none d-sm-inline-flex rounded-pill" type="button" @click="openCreatePannel()">
                                <span class="me-1 d-none d-lg-inline-block">Create Discount</span>
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
            <div class="row">
                <div class="col-12" v-if="createPannel" style="margin-bottom: 10px;">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div>
                            <h6 class="card-title mb-0">Discount Details</h6>
                            <small class="text-muted">Fill out the details about the discount for customer.</small>
                            </div> 
                        </div>
                        <form class="card-body">
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Coupon Name <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <input type="text" class="form-control form-control-lg" v-model="discountParam.name" style="text-transform: uppercase">
                                </div>
                                <label class="col-md-3 col-sm-4 col-form-label">Minimum Amount <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <input type="text" class="form-control form-control-lg" maxlength="9" onkeypress='return isNumberKey(event)' v-model="discountParam.min_amount">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Description <sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                    <textarea class="form-control" placeholder="Type description here.." rows="3" v-model="discountParam.description"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Amount Type <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <select class="form-control form-control-lg" v-model="discountParam.unit">
                                    <option disabled value="">--- Select Type --</option>
                                    <option value="F">Flat</option>
                                    <option value="P">Percentage</option>
                                </select>
                                </div>

                                <label class="col-md-3 col-sm-4 col-form-label">Amount/Percentage <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                    <input type="number" class="form-control form-control-lg" maxlength="9" onkeypress='return isNumberKey(event)' v-model="discountParam.total">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Status <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <select class="form-control form-control-lg" v-model="discountParam.active">
                                    <option disabled value="">--- Select Status --</option>
                                    <option value="Y">Active</option>
                                    <option value="N">Inactive</option>
                                </select>
                                </div>
                                <label class="col-md-3 col-sm-4 col-form-label">Max Redeem Count <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                    <input type="number" class="form-control form-control-lg" maxlength="9" onkeypress='return isNumberKey(event)' v-model="discountParam.max_redeem">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Discount Type <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <select class="form-control form-control-lg" v-model="discountParam.type" @change="onChangeType($event)">
                                    <option disabled value="">--- Select Type --</option>
                                    <option value="Categories">Categories</option>
                                    <option value="Products">Products</option>
                                    <option value="All Transaction">All Transaction</option>
                                </select>
                                </div>

                                <label class="col-md-3 col-sm-4 col-form-label">Validity <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                    <input type="text" class="form-control form-control-lg datepicker" placeholder="Select date" v-model="discountParam.expire_date">  
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-sm-4 col-form-label">{{ discountParam.type }}</label>
                                <div class="form-check col-md-9 col-sm-8" style="padding-left: 35px;">
                                    <input class="form-check-input" type="checkbox" id="categorySelect" v-model="selectAll">
                                    <label class="form-check-label" for="flexCheckChecked">Select All </label>
                                </div>
                            </div>    

                            <div class="row" v-bind:class="{ 'd-none' : selectAll }">
                                <label class="col-md-3 col-sm-4 col-form-label"></label>
                                <div class="col-md-9 col-sm-8">
                                    <select class="form-control show-tick ms select2" multiple data-placeholder="Select"> 
                                        <option v-for="discountType in discountTypes" :key="discountType.id" :value="discountType.name">{{discountType.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div role="alert" class="alert alert-danger" v-bind:class="{ 'd-none' : message == '' }">{{ message }}</div>
                    
                        </form>
                        <div class="card-footer text-end" v-if="createPannel">
                            <button class="btn btn-lg btn-light me-2" type="reset" @click="closeCreatePannel()">Close</button>
                            <button class="btn btn-lg btn-primary" type="submit" :disabled="isCreating" @click="createUser()" v-if="!discountParam.hasOwnProperty('id')">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-bind:class="{ 'd-none' : !isCreating }"></span> Save Changes</button>
                            <button class="btn btn-lg btn-primary" type="submit" :disabled="isCreating" @click="updateUser()" v-else>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-bind:class="{ 'd-none' : !isCreating }"></span> Save Changes</button>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-transparent pb-0">
                            <div>
                            <h6 class="card-title mb-0">Manage Discounts</h6>
                            <small class="text-muted">Manage discount or coupon across the order for customer.</small>
                            </div> 
                        </div>
                        <div class="card-body" v-if="discounts.length > 0">
                            <div class="row-title mb-2">
                                <h5 class="fw-light mb-0">Discounts
                                    <span class="fw-bold ms-2">({{ total }})</span>
                                </h5>
                                <div>
                                    <form class="input-group col-md-3 col-sm-4">
                                        <input type="text" class="form-control form-control" placeholder="Search here..." @input="searchUser($event)">
                                    </form>
                                </div>
                            </div>
                           
                            <table class="table align-middle card-table mb-0 roleTable">
                                <thead>
                                    <tr>
                                        <th>Discount ID</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Valid till</th>
                                        <th>Modified</th>
                                        <th>Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="discount in discounts" :key="discount.id">
                                        <td>
                                            DS0{{ discount.id }}
                                        </td>
                                        <td>{{ discount.name }} 
                                            <span class="badge bg-success" v-if="discount.active === 'Y'">Active</span>
                                            <span class="badge bg-danger" v-else>Inactive</span> 
                                        </td>
                                        <td v-if="discount.unit == 'F'">৳{{ discount.total }} (min. ৳{{ discount.min_amount }})</td>
                                        <td v-else>{{ discount.total }}%  off (min. ৳{{ discount.min_amount }})</td>
                                        <td>{{ discount.expire_date }}</td>
                                        <td>{{ discount.updated_at }}</td>
                                        <td><a class="list-group-item btn btn-link btn-sm text-primary" @click="showDetails(discount)">View Details</a></td>
                                        <td>
                                            <button type="button" class="btn btn-link btn-sm text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Role"  @click="showEditDialog(discount)"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" @click="showDeleteAlert(discount.id)"><i class="fa fa-trash"></i></button>
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
                                <span class="text-muted">Currently you have not create any discount to show here use below to create one.</span>
                            </div>
                            <button type="button" class="btn btn-white border lift" @click="openCreatePannel()">Create Discount</button>
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
                createPannel : false,
                isCreating : false,
                discountParam: {},
                message : "",
                selectAll : false,
                selectedDiscount: [],
                total : 0,
                discountTypes : [],
                discounts: [],
                links :[],
                modelCategories : [],
                discountData : {},
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

            if(!$('.select2').select2()){
                $('.select2').select2();   
            }
            if(self.selectedDiscount.length > 0){
                $('.select2').val(self.selectedDiscount); 
                $('.select2').trigger('change');
            }

            if(this.createPannel)
            {
                $('.datepicker').datepicker("setValue", this.discountParam.expire_date);
                $('.datepicker').datepicker({
                        startDate: new Date() 
                    });
               console.log($('.datepicker').val());     
            }
            
        },
        created(){
            self = this;
            this.discountParam.active = ''
            this.isCreating = true
            this.discountParam.type = ''
            axios
                .get('/admin-api/discounts')
                .then(response => {
                    this.discounts = response.data.data;
                    this.links = response.data.links;
                    this.total = response.data.total;
                }).finally(() => {
                        this.isCreating = false
                        }
                    );    
        },
        methods : {
            showDetails(data){
                this.discountData = data
                this.modelCategories =  JSON.parse(data.logic)
                $('#modalLive').modal('show');
            },
            onChangeType(event){
                if(event.target.value == "All Transaction"){
                    this.selectAll = true
                }else{
                    this.selectAll = false
                    axios
                    .get('/admin-api/discounts/fetch/'+event.target.value)
                    .then(response => {
                        if(response.data.length > 0){
                            this.discountTypes = response.data;
                        }
                    });
                }
            },
            searchUser(event){
                axios
                .get('/admin-api/discounts?search='+event.target.value)
                .then(response => {
                    if(response.data.data.length > 0){
                        this.discounts = response.data.data;
                        this.links = response.data.links;
                        this.total = response.data.total;
                        $('.roleTable').DataTable().destroy();
                    }
                });
            },
            paginate(url){
                axios
                .get(url)
                .then(response => {
                    this.discounts = response.data.data;
                    this.links = response.data.links;
                    this.total = response.data.total;
                    $('.roleTable').DataTable().destroy();
                });
            },
            showDeleteAlert(id){
               Swal.fire({
                    title: 'Do you want to remove this discount?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Cancel',
                    denyButtonText: 'Delete',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isDenied) {
                       axios
                        .delete('/admin-api/discounts/'+id)
                        .then(response => {
                            let i = this.discounts.map(data => data.id).indexOf(id);
                            this.discounts.splice(i, 1)
                            this.total = this.total - 1;
                            $('.roleTable').DataTable().destroy();
                        });
                    }
                })
            },
            showEditDialog(data){
                this.message = ""
                this.isEditing = true
                this.discountParam.id = data.id;
                this.discountParam.name = data.name;
                this.discountParam.description = data.description;
                this.discountParam.expire_date = data.expire_date;
                this.discountParam.unit = data.unit;
                this.discountParam.min_amount = data.min_amount;
                this.discountParam.total = data.total;
                this.discountParam.max_redeem = data.max_redeem;
                if(data.type == "C"){
                    this.discountParam.type = "Categories";
                }else if(data.type == "P"){
                    this.discountParam.type = "Products";
                }else this.discountParam.type = "All Transaction";
                var logic = JSON.parse(data.logic)
                axios
                    .get('/admin-api/discounts/fetch/'+this.discountParam.type)
                    .then(response => {
                        if(response.data.length > 0){
                            this.discountTypes = response.data;
                        }
                    }).finally(() => {
                            if(logic[0] == "All")
                            this.selectAll = true
                            else this.selectAll = false
                        }
                    );
                if(!this.selectAll)    
                this.selectedDiscount = logic    
                this.discountParam.active = data.active;
                this.createPannel = true
                window.scrollTo(0,0);
            },
            updateUser(){
                this.isCreating = true
                if(this.selectAll)
                this.discountParam.logic = JSON.stringify(["All"]);
                else this.discountParam.logic = JSON.stringify($('.select2').val());
                this.discountParam.expire_date = $(".datepicker").val();
                axios
                    .patch('/admin-api/discounts/'+this.discountParam.id, this.discountParam)
                    .then((res) => {
                        let index = this.discounts.map(data => data.id).indexOf(this.discountParam.id);
                        this.discounts[index] = res.data
                        this.isCreating = false
                        this.createPannel = false
                        Swal.fire('Discount Updated', '', 'success')
                    })
                    .catch(err => {
                        var errorMessage = err.response.data
                        this.message = errorMessage.message
                    })
                    .finally(() => {
                        this.isCreating = false
                        }
                    );
            },
            createUser() {
                this.isCreating = true
                if(this.selectAll)
                this.discountParam.logic = JSON.stringify(["All"]);
                else this.discountParam.logic = JSON.stringify($('.select2').val());
                this.discountParam.expire_date = $(".datepicker").val();
                axios
                    .post('/admin-api/discounts', this.discountParam)
                    .then(response => {
                        this.discountParam = {}
                        this.discounts.unshift( response.data )
                        this.createPannel = false
                        this.total = this.total + 1;
                        $('.roleTable').DataTable().destroy();
                        Swal.fire('Discount Created', '', 'success')
                    })
                    .catch(error => {
                        var errorMessage = error.response.data
                        this.message = errorMessage.message
                    })
                    .finally(() => {
                        this.isCreating = false
                        }
                    )
            },
            scrollToTop() {
                window.scrollTo(0,0);
            },    
            openCreatePannel(){
                this.discountParam = {}
                this.discountParam.active = ''
                this.discountParam.type = ''
                this.discountParam.unit = ''
                this.createPannel = true
            },
            closeCreatePannel(){
                this.createPannel = false
            }
        }
    }
</script>