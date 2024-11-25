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
                        <h1 class="h2 mb-md-0 text-white fw-light">Products</h1>
                        <div class="page-action">
                            <button class="btn d-none d-sm-inline-flex rounded-pill" type="button" @click="openCreatePannel()">
                                <span class="me-1 d-none d-lg-inline-block">Add Product</span>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-transparent pb-0">
                            <div>
                            <h6 class="card-title mb-0">Manage Products</h6>
                            <small class="text-muted">Manage product details here.</small>
                            </div> 
                        </div>
                        <div class="card-body row-title mb-0">
                                <h5 class="fw-light mb-0">Products
                                    <span class="fw-bold ms-2">({{ total }})</span>
                                </h5>
                                <div>
                                    <form class="input-group col-md-3 col-sm-4">
                                        <input type="text" class="form-control form-control" placeholder="Search here..." @input="searchUser($event)">
                                    </form>
                                </div>
                        </div>
                        <div class="card-body pt-0" v-if="products.length > 0">
                            <table class="table align-middle card-table mb-0 productTable">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Details</th>
                                        <th>Category</th>
                                        <th>MRP</th>
                                        <th>Price</th>
                                        <th>Last Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in products" :key="product.id">
                                        <td>
                                            PRD0{{ product.id }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center p-xl-4 p-lg-3 p-2">
                                                <div class="avatar lg no-thumbnail">
                                                    <img v-bind:src="'/storage/products/'+product.pic" width="50" height="50">
                                                </div>
                                                <div class="flex-fill ms-3 text-truncate">
                                                <span>{{ product.title }}</span>
                                                <div><span class="text-muted">{{ product.brand }}</span></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ product.category }} 
                                            <span class="badge bg-success" v-if="product.active === 'Y'">Active</span>
                                            <span class="badge bg-danger" v-else>Inactive</span> 
                                        </td>
                                        <td>৳{{ product.max_retail_price }}</td>
                                        <td>৳{{ product.sales_price }}</td>
                                        <td>{{ product.updated_at }}</td>
                                        <td v-if="product.active === 'Y'">
                                            <button type="button" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Role"  @click="closeProduct(product.id)"><i class="fa fa-eye-slash"></i> </button>
                                            <button type="button" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" @click="showDeleteAlert(product.id)"><i class="fa fa-trash"></i></button>
                                        </td>
                                        <td v-else>
                                            <button type="button" class="btn btn-link btn-sm text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Role"  @click="publishProduct(product.id)"><i class="fa fa-eye"></i> </button>
                                            <button type="button" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" @click="showDeleteAlert(product.id)"><i class="fa fa-trash"></i></button>
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
                                <span class="text-muted">No product to show here use below to create one.</span>
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
                products: [],
            }
        },
        updated(){
            if(this.isCreating){
                $('.productTable').addClass('nowrap').dataTable({
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
            this.isCreating = true
            axios
                .get('/admin-api/products')
                .then(response => {
                    this.products = response.data.data;
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
                .get('/admin-api/products?search='+event.target.value)
                .then(response => {
                    this.products = response.data.data;
                    this.links = response.data.links;
                    this.total = response.data.total;
                    $('.productTable').DataTable().destroy();
                });
            },
            paginate(url){
                axios
                .get(url)
                .then(response => {
                    this.products = response.data.data;
                    this.links = response.data.links;
                    this.total = response.data.total;
                    $('.productTable').DataTable().destroy();
                });
            },
            closeProduct(id){
                Swal.fire({
                    title: 'Do you want to unpublish this product?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Cancel',
                    denyButtonText: 'Unpublish',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isDenied) {
                       axios
                        .get('/admin-api/products/unpublish/'+id)
                        .then(response => {
                            let index = this.products.map(data => data.id).indexOf(id);
                            this.products[index].active = 'N'
                        });
                    }
                })
            },
            publishProduct(id){
                Swal.fire({
                    title: 'Do you want to unpublish this product?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Publish',
                    denyButtonText: 'Cancel',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                       axios
                        .get('/admin-api/products/publish/'+id)
                        .then(response => {
                            let index = this.products.map(data => data.id).indexOf(id);
                            this.products[index].active = 'Y'
                        });
                    }
                })
            },
            showDeleteAlert(id){
               Swal.fire({
                    title: 'Do you want to remove this product?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Cancel',
                    denyButtonText: 'Delete',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isDenied) {
                       axios
                        .delete('/admin-api/products/'+id)
                        .then(response => {
                            let i = this.products.map(data => data.id).indexOf(id);
                            this.products.splice(i, 1)
                            this.total = this.total - 1;
                            $('.productTable').DataTable().destroy();
                        });
                    }
                })
            },
            openCreatePannel(){
                window.location = "/admin/add-products/"
            }
        }
    }
</script>