<template>
    <div class="modal fade" id="modalLive" tabindex="-1" aria-modal="true" role="dialog" style="display: none;">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">AMC Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-primary">Description</p>
                    <p class="mt-2">{{descriptionData}}</p>
                    <p class="text-primary mt-2">Offerings</p>
                    <p class="mt-2" v-html="offeringData"></p>
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
                        <h1 class="h2 mb-md-0 text-white fw-light">AMC</h1>
                        <div class="page-action">
                            <button class="btn d-none d-sm-inline-flex rounded-pill" type="button" @click="openCreatePannel()">
                                <span class="me-1 d-none d-lg-inline-block">Add AMC</span>
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
                            <h6 class="card-title mb-0">AMC Details</h6>
                            <small class="text-muted">Fill the details about the amc your want to provide.</small>
                            </div> 
                        </div>
                        <form class="card-body">
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Name <sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg" v-model="amcParam.name">
                                </div>
                            </div>
                           <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Short Description <sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <textarea class="form-control" placeholder="Type description here.." rows="3" v-model="amcParam.description"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Duration <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-lg" v-model="amcParam.duration" maxlength="2" onkeypress='return isNumberKey(event)'>
                                        <select class="form-control form-control-lg" v-model="amcParam.unit">
                                            <option disabled value="">Select Unit</option>
                                            <option value="Days">Days</option>
                                            <option value="Month">Months</option>
                                            <option value="Year">Year</option>
                                        </select>
                                    </div>
                                </div>
                                <label class="col-md-3 col-sm-4 col-form-label">Price <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-text">৳</span>
                                        <input type="number" class="form-control form-control-lg" maxlength="9" onkeypress='return isNumberKey(event)' v-model="amcParam.price">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Offerings <sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                    <textarea class="summernote" v-model="amcParam.offerings"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Type <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <select class="form-control form-control-lg" v-model="amcParam.type">
                                    <option disabled value="">--- Select Type --</option>
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                </select>
                                </div>

                                <label class="col-md-3 col-sm-4 col-form-label">Status <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <select class="form-control form-control-lg" v-model="amcParam.active">
                                    <option disabled value="">--- Select Status --</option>
                                    <option value="Y">Active</option>
                                    <option value="N">Inactive</option>
                                </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Terms and Condition Link <sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg" v-model="amcParam.terms">
                                </div>
                            </div>
                            <div role="alert" class="alert alert-danger" v-bind:class="{ 'd-none' : message == '' }">{{ message }}</div>
                    
                        </form>
                        <div class="card-footer text-end" v-if="createPannel">
                            <button class="btn btn-lg btn-light me-2" type="reset" @click="closeCreatePannel()">Close</button>
                            <button class="btn btn-lg btn-primary" type="submit" :disabled="isCreating" @click="createBrand()" v-if="!amcParam.hasOwnProperty('id')">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-bind:class="{ 'd-none' : !isCreating }"></span> Save Changes</button>
                            <button class="btn btn-lg btn-primary" type="submit" :disabled="isCreating" @click="updateBrand()" v-else>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-bind:class="{ 'd-none' : !isCreating }"></span> Save Changes</button>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-transparent pb-0">
                            <div>
                            <h6 class="card-title mb-0">Manage AMC</h6>
                            <small class="text-muted">Manage details about the amc here.</small>
                            </div> 
                        </div>
                        <div class="card-body row-title mb-0">
                                <h5 class="fw-light mb-0">AMC
                                    <span class="fw-bold ms-2">({{ total }})</span>
                                </h5>
                                <div>
                                    <form class="input-group col-md-3 col-sm-4">
                                        <input type="text" class="form-control form-control" placeholder="Search here..." @input="searchUser($event)">
                                    </form>
                                </div>
                        </div>
                        <div class="card-body pt-0" v-if="amcs.length > 0">
                            <table class="table align-middle card-table mb-0 roleTable">
                                <thead>
                                    <tr>
                                        <th>AMC ID</th>
                                        <th>Name</th>
                                        <th>Duration</th>
                                        <th>Price</th>
                                        <th>Details</th>
                                        <th>Modified</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="amc in amcs" :key="amc.id">
                                        <td>
                                            AMC0{{ amc.id }}
                                        </td>
                                        <td>{{ amc.name }} 
                                            <span class="badge bg-success" v-if="amc.active === 'Y'">Active</span>
                                            <span class="badge bg-danger" v-else>Inactive</span> 
                                        </td>
                                        <td>{{ amc.duration }} {{ amc.unit }}</td>
                                        <td>৳{{ amc.price }} <span class="badge bg-info">{{amc.type}}</span></td>
                                        <td><a class="list-group-item btn btn-link btn-sm text-primary" @click="showDetails(amc)">View Details</a></td>
                                        <td>{{ amc.updated_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-link btn-sm text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Role"  @click="showEditDialog(amc)"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" @click="showDeleteAlert(amc.id)"><i class="fa fa-trash"></i></button>
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
                                <span class="text-muted">No AMC to show here use below to create one.</span>
                            </div>
                            <button type="button" class="btn btn-white border lift" @click="openCreatePannel()">Create AMC</button>
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
                amcParam: {},
                message : "",
                htmlCode : '',
                total : 0,
                descriptionData : '',
                offeringData : '',
                amcs: [],
                links :[],
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

            if(this.htmlCode.length > 0)
            $('.summernote').summernote('code',this.htmlCode);
            else $('.summernote').summernote();
            $('.note-editor .note-btn').on('click',function(){
                $(this).next().toggleClass("show");
            });
            $("button.close").click(function(){
                $('.note-modal').modal('hide');
                $('.link-dialog').modal('hide');
            })
        },
        created(){
            this.amcParam.active = ''
            this.amcParam.unit = ''
            this.isCreating = true
            axios
                .get('/admin-api/amcs')
                .then(response => {
                    this.amcs = response.data.data;
                    this.links = response.data.links;
                    this.total = response.data.total;
                }).finally(() => {
                    this.isCreating = false
                });   
                   
        },
        methods : {
            showDetails(dataSet){
                this.descriptionData = dataSet.description;
                this.offeringData = dataSet.offerings;
                $('#modalLive').modal('show');
            },
            searchUser(event){
                axios
                .get('/admin-api/amcs?search='+event.target.value)
                .then(response => {
                    this.amcs = response.data.data;
                    this.links = response.data.links;
                    this.total = response.data.total;
                    $('.roleTable').DataTable().destroy();
                });
            },
            paginate(url){
                axios
                .get(url)
                .then(response => {
                    this.amcs = response.data.data;
                    this.links = response.data.links;
                    this.total = response.data.total;
                    $('.roleTable').DataTable().destroy();
                });
            },
            showDeleteAlert(id){
               Swal.fire({
                    title: 'Do you want to remove this AMC?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Cancel',
                    denyButtonText: 'Delete',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isDenied) {
                       axios
                        .delete('/admin-api/amcs/'+id)
                        .then(response => {
                            let i = this.amcs.map(data => data.id).indexOf(id);
                            this.amcs.splice(i, 1)
                            this.total = this.total - 1;
                            $('.roleTable').DataTable().destroy();
                        });
                    }
                })
            },
            showEditDialog(data){
                this.message = ""
                this.isEditing = true
                this.amcParam.id = data.id;
                this.amcParam.name = data.name;
                this.amcParam.duration = data.duration;
                this.htmlCode = data.offerings
                this.amcParam.price = data.price;
                this.amcParam.type = data.type;
                this.amcParam.terms = data.terms;
                this.amcParam.description = data.description;
                this.amcParam.active = data.active;
                this.amcParam.unit = data.unit;
                this.createPannel = true
                window.scrollTo(0,0);
            },
            updateBrand(){
                this.isCreating = true
                this.amcParam.offerings = $('.summernote').summernote('code');
                axios
                    .post('/admin-api/amcs/'+this.amcParam.id+'?_method=PUT', this.amcParam)
                    .then((res) => {
                        let index = this.amcs.map(data => data.id).indexOf(this.amcParam.id);
                        this.amcs[index] = res.data
                        this.isCreating = false
                        this.createPannel = false
                        Swal.fire('AMC Updated', '', 'success')
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
            createBrand() {
                this.isCreating = true
                this.amcParam.offerings = $('.summernote').summernote('code');
                axios
                    .post('/admin-api/amcs', this.amcParam)
                    .then(response => {
                        this.amcParam = {}
                        this.amcs.unshift( response.data )
                        this.createPannel = false
                        this.total = this.total + 1;
                        $('.roleTable').DataTable().destroy();
                        Swal.fire('AMC Created', '', 'success')
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
                this.htmlCode = ''
                this.amcParam = {}
                this.amcParam.active = ''
                this.amcParam.unit = ''
                this.createPannel = true
            },
            closeCreatePannel(){
                this.createPannel = false
            }
        }
    }
</script>