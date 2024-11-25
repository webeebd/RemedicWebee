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
                        <h1 class="h2 mb-md-0 text-white fw-light">Inventory</h1>
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
                    <div class="card pb-3" >
                        <div class="card-header bg-transparent pb-0">
                            <div>
                            <h6 class="card-title mb-0">Manage Inventory</h6>
                            <small class="text-muted">Manage inventory details here.</small>
                            </div> 
                        </div>

                        <div id="apex-chart" style="height: 280px;padding:20px;"></div>
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

                            <div class="col-12" v-for="product in products" :key="product.id">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center flex-column flex-md-row">
                                    <img class="w120 rounded-4 img-thumbnail" v-bind:src="'/storage/products/'+product.pic" alt="">
                                    <div class="media-body ms-0 ms-4 ms-xxl-5 text-md-start text-center w-100 mt-4 mt-md-0">
                                    <div class="row g-0 align-items-center">
                                    <div class="col-xxl-6 col-xl-5 col-lg-4 col-md-12 mb-3 mb-lg-0">
                                    <h6 class="mb-1">{{ product.title }}</h6>
                                    <div class="text-muted">{{ product.brand }}</div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 text-center">
                                    <ul class="list-unstyled d-flex mb-0 text-center text-md-start">
                                    <li class="flex-fill card py-2 px-3">
                                    <h6 class="mb-1">{{ product.stock }} unit</h6>
                                    <div class="text-muted">Inventory</div>
                                    <div class="progress mt-1" style="height: 1px;">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                                    </div>
                                    </li>
                                    <li class="flex-fill card py-2 px-3 mx-1">
                                    <h6 class="mb-1">0 unit</h6>
                                    <div class="text-muted">Sold</div>
                                    <div class="progress mt-1" style="height: 1px;">
                                    <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="91" aria-valuemin="0" aria-valuemax="100" style="width: 91%;"></div>
                                    </div>
                                    </li>
                                    <li class="flex-fill card py-2 px-3">
                                    <h6 class="mb-1">{{ product.stock }} unit</h6>
                                    <div class="text-muted">Unsold</div>
                                    <div class="progress mt-1" style="height: 1px;">
                                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"></div>
                                    </div>
                                    </li>
                                    </ul>
                                    </div>
                                    </div>
                                    </div>
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
        mounted(){
            $(document).ready(function(){
                var options = {
                    chart: {
                    height: 350,
                    type: 'line',
                    toolbar: {
                        show: false,
                    },
                    },
                    colors: ['var(--chart-color1)', 'var(--chart-color5)'],
                    series: [{
                    name: 'Products',
                    type: 'column',
                    data: [0, 0, 0, 0, 0, 0, 0]
                    }],
                    stroke: {
                    width: [0, 4]
                    },
                    labels: ['01 Dec 2022', '02 Dec 2022', '03 Dec 2022', '04 Dec 2022', '05 Dec 2022', '06 Dec 2022', '07 Dec 2022'],
                    xaxis: {
                    type: 'datetime'
                    },
                    yaxis: [{
                    title: {
                        text: 'Products Sale',
                    },
                    }]
                }
                var chart = new ApexCharts(document.querySelector("#apex-chart"), options);
                chart.render();
            });
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