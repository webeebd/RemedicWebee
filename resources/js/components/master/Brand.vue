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
                        <h1 class="h2 mb-md-0 text-white fw-light">Brands</h1>
                        <div class="page-action">
                            <button class="btn d-none d-sm-inline-flex rounded-pill" type="button" @click="openCreatePannel()">
                                <span class="me-1 d-none d-lg-inline-block">Add Brand</span>
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
                            <h6 class="card-title mb-0">Brand Details</h6>
                            <small class="text-muted">Fill the details about the brand.</small>
                            </div> 
                        </div>
                        <form class="card-body">
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Name <sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg" v-model="brandParam.name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Manufacturer <sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg" v-model="brandParam.manufacturer">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Description <sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <textarea class="form-control" placeholder="Type description here.." rows="3" v-model="brandParam.description"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Slug <sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                    <input type="text" class="form-control form-control-lg" v-model="brandParam.slug">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Brand Logo</label>
                                <div class="col-md-9 col-sm-8">
                                    <input class="form-control" type="file" id="formFile" accept="image/*" @change="onFileChange"/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Status <sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <select class="form-control form-control-lg" v-model="brandParam.active">
                                    <option disabled value="">--- Select Status --</option>
                                    <option value="Y">Active</option>
                                    <option value="N">Inactive</option>
                                </select>
                                </div>
                            </div>
                            <div role="alert" class="alert alert-danger" v-bind:class="{ 'd-none' : message == '' }">{{ message }}</div>
                    
                        </form>
                        <div class="card-footer text-end" v-if="createPannel">
                            <button class="btn btn-lg btn-light me-2" type="reset" @click="closeCreatePannel()">Close</button>
                            <button class="btn btn-lg btn-primary" type="submit" :disabled="isCreating" @click="createBrand()" v-if="!brandParam.hasOwnProperty('id')">
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
                            <h6 class="card-title mb-0">Manage Brands</h6>
                            <small class="text-muted">Manage details about the product brand here.</small>
                            </div> 
                        </div>
                        <div class="card-body row-title mb-0">
                                <h5 class="fw-light mb-0">Brands
                                    <span class="fw-bold ms-2">({{ total }})</span>
                                </h5>
                                <div>
                                    <form class="input-group col-md-3 col-sm-4">
                                        <input type="text" class="form-control form-control" placeholder="Search here..." @input="searchUser($event)">
                                    </form>
                                </div>
                        </div>
                        <div class="card-body pt-0" v-if="brands.length > 0">
                            <table class="table align-middle card-table mb-0 roleTable">
                                <thead>
                                    <tr>
                                        <th>Brand ID</th>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Manufacturer</th>
                                        <th>Description</th>
                                        <th>Slug</th>
                                        <th>Modified</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="brand in brands" :key="brand.id">
                                        <td>
                                            BR0{{ brand.id }}
                                        </td>
                                        <td>
                                            <img v-bind:src="'/storage/brands/'+brand.thumbnail" width="50" height="50">
                                        </td>
                                        <td>{{ brand.name }} 
                                            <span class="badge bg-success" v-if="brand.active === 'Y'">Active</span>
                                            <span class="badge bg-danger" v-else>Inactive</span> 
                                        </td>
                                        <td>{{ brand.manufacturer }}</td>
                                        <td>{{ brand.description }}</td>
                                        <td>{{ brand.slug }}</td>
                                        <td>{{ brand.updated_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-link btn-sm text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Role"  @click="showEditDialog(brand)"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" @click="showDeleteAlert(brand.id)"><i class="fa fa-trash"></i></button>
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
                                <span class="text-muted">No brand to show here use below to create one.</span>
                            </div>
                            <button type="button" class="btn btn-white border lift" @click="openCreatePannel()">Create Brand</button>
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
                brandParam: {},
                image: null,
                message : "",
                total : 0,
                links :[],
                brands: [],
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
            this.brandParam.active = ''
            this.isCreating = true
            axios
                .get('/admin-api/brands')
                .then(response => {
                    this.brands = response.data.data;
                    this.links = response.data.links;
                    this.total = response.data.total;
                }).finally(() => {
                    this.isCreating = false
                });   
                   
        },
        methods : {
            onFileChange(event) {
                const files = event.target.files
                let filename = files[0].name
                const fileReader = new FileReader()
                fileReader.addEventListener('load', () => {
                    this.imageUrl = fileReader.result
                })
                fileReader.readAsDataURL(files[0])
                this.image = files[0]
            },
            searchUser(event){
                axios
                .get('/admin-api/brands?search='+event.target.value)
                .then(response => {
                    this.brands = response.data.data;
                    this.links = response.data.links;
                    this.total = response.data.total;
                    $('.roleTable').DataTable().destroy();
                });
            },
            paginate(url){
                axios
                .get(url)
                .then(response => {
                    this.brands = response.data.data;
                    this.links = response.data.links;
                    this.total = response.data.total;
                    $('.roleTable').DataTable().destroy();
                });
            },
            showDeleteAlert(id){
               Swal.fire({
                    title: 'Do you want to remove this brand?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Cancel',
                    denyButtonText: 'Delete',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isDenied) {
                       axios
                        .delete('/admin-api/brands/'+id)
                        .then(response => {
                            let i = this.brands.map(data => data.id).indexOf(id);
                            this.brands.splice(i, 1)
                            this.total = this.total - 1;
                            $('.roleTable').DataTable().destroy();
                        });
                    }
                })
            },
            showEditDialog(data){
                this.message = ""
                this.image = null
                this.isEditing = true
                this.brandParam.id = data.id;
                this.brandParam.name = data.name;
                this.brandParam.slug = data.slug;
                this.brandParam.manufacturer = data.manufacturer;
                this.brandParam.description = data.description;
                this.brandParam.active = data.active;
                this.createPannel = true
                window.scrollTo(0,0);
            },
            updateBrand(){
                this.isCreating = true
                var form = new FormData();
                form.set('name',this.brandParam.name);
                form.set('description',this.brandParam.description);
                form.set('manufacturer',this.brandParam.manufacturer);
                form.set('active',this.brandParam.active);
                form.set('slug',this.brandParam.slug);
                if(this.image != null)
                form.set('logo',this.image);
                axios
                    .post('/admin-api/brands/'+this.brandParam.id+'?_method=PUT', form)
                    .then((res) => {
                        let index = this.brands.map(data => data.id).indexOf(this.brandParam.id);
                        this.brands[index] = res.data
                        this.isCreating = false
                        this.createPannel = false
                        Swal.fire('Brand Updated', '', 'success')
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
                var form = new FormData();
                form.set('name',this.brandParam.name);
                form.set('description',this.brandParam.description);
                form.set('manufacturer',this.brandParam.manufacturer);
                form.set('active',this.brandParam.active);
                form.set('slug',this.brandParam.slug);
                form.set('logo',this.image);

                axios
                    .post('/admin-api/brands', form)
                    .then(response => {
                        this.brandParam = {}
                        this.brands.unshift( response.data )
                        this.createPannel = false
                        this.total = this.total + 1;
                        $('.roleTable').DataTable().destroy();
                        Swal.fire('Brand Created', '', 'success')
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
                this.brandParam = {}
                this.image = null
                this.brandParam.active = ''
                this.brandParam.idRole = ''
                this.createPannel = true
            },
            closeCreatePannel(){
                this.createPannel = false
            }
        }
    }
</script>