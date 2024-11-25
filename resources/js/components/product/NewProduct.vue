<style>
@import url('https://fonts.googleapis.com/icon?family=Material+Icons');
</style>
<template>
    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><router-link to="/admin/home">Dashboard</router-link></li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
                    </ol>
                    <h1 class="h2 mb-md-0 text-white fw-light">Add New Product</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div>
                            <h6 class="card-title mb-0">Product Details:</h6>
                            <small class="text-muted"><u>Note:</u>  Please enter the mandatory details.</small>
                            </div> 
                        </div>
                        <form v-on:submit="addProduct">
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Main Image<sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                    <div class="image-input avatar xxl rounded-4" style="background-image: url(/assets/img/placeholder.jpeg)">
                                        <div class="avatar-wrapper rounded-4" style="background-image: url(/assets/img/placeholder.jpeg)">
                                        </div>
                                        <div class="file-input">
                                        <input type="file" class="form-control" name="file-input" id="file-input" accept="image/*" @change="onFileChange">
                                        <label for="file-input" class="fa fa-pencil shadow text-muted"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Product Name<sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg"  v-model="this.productParam.name"> 
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Product Title<sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg" v-model="productParam.title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Category</label>
                                <div class="col-md-3 col-sm-4">
                                    <select id="js-category-ajax" class="form-control"></select>
                                </div>

                                <label class="col-md-3 col-sm-4 col-form-label">Department</label>
                                <div class="col-md-3 col-sm-4">
                                    <select id="js-department-ajax" class="form-control"></select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Model Number<sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <input type="text" class="form-control form-control-lg" v-model="productParam.modelNumber">
                                </div>

                                <label class="col-md-3 col-sm-4 col-form-label">Brand<sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                    <select id="js-brand-ajax" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Generic Name</label>
                                <div class="col-md-3 col-sm-4">
                                <input type="text" class="form-control form-control-lg" v-model="productParam.genericName">
                                </div>

                                <label class="col-md-3 col-sm-4 col-form-label">Manufacturer</label>
                                <div class="col-md-3 col-sm-4">
                                    <input type="text" class="form-control form-control-lg" id="in-manufacturer" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">SKU</label>
                                <div class="col-md-3 col-sm-4">
                                <input type="text" class="form-control form-control-lg" v-model="productParam.skuc_code">
                                </div>

                                <label class="col-md-3 col-sm-4 col-form-label">HSN <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <input type="text" class="form-control form-control-lg" v-model="productParam.hsn_code">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Country of Origin</label>
                                <div class="col-md-3 col-sm-4">
                                <input type="text" class="form-control form-control-lg" v-model="productParam.country_origin">
                                </div>

                                <label class="col-md-3 col-sm-4 col-form-label">Pack Size</label>
                                <div class="col-md-3 col-sm-4">
                                <input type="text" class="form-control form-control-lg" v-model="productParam.pack_size">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="ccol-form-label">Short Description or Features <sup class="text-danger">*</sup></label>
                            </div>
                            <div class="row mb-3">
                                <textarea class="descriptionNote" v-model="productParam.short_description"></textarea>
                            </div>
                            <div class="row mb-3">
                                <label class="ccol-form-label">Description <sup class="text-danger">*</sup></label>
                            </div>
                            <div class="row mb-3"><textarea class="summernote" v-model="productParam.description"></textarea></div>
                            

                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Purchase Price <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <input type="number" class="form-control form-control-lg" maxlength="9" onkeypress='return isNumberKey(event)' v-model="productParam.purchase_price">
                                </div>

                                <label class="col-md-3 col-sm-4 col-form-label">Base Price <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <input type="number" class="form-control form-control-lg" maxlength="9" onkeypress='return isNumberKey(event)' v-model="productParam.max_retail_price">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Tax% <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <input type="number" class="form-control form-control-lg" maxlength="9" onkeypress='return isNumberKey(event)' v-model="productParam.tax_amount">
                                </div>

                                <label class="col-md-3 col-sm-4 col-form-label">Sell Price <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <input type="number" class="form-control form-control-lg" maxlength="9" onkeypress='return isNumberKey(event)' v-model="productParam.sales_price">
                                </div>
                            </div>

                            
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Keywords</label>
                                <div class="col-md-9 col-sm-8">
                                    <input type="text" class="form-control" v-model="productParam.keywords"/>
                                    <span style="color:red;">Add comma(,) for separation</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Minimum Buy Quantity <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <input type="number" class="form-control form-control-lg" maxlength="4" onkeypress='return isNumberKey(event)' v-model="productParam.minStock">
                                </div>

                                <label class="col-md-3 col-sm-4 col-form-label">Maximum Buy Quantity <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <input type="number" class="form-control form-control-lg" maxlength="4" onkeypress='return isNumberKey(event)' v-model="productParam.maxStock">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Stock Quantity <sup class="text-danger">*</sup></label>
                                <div class="col-md-3 col-sm-4">
                                <input type="number" class="form-control form-control-lg" maxlength="4" onkeypress='return isNumberKey(event)' v-model="productParam.stock">
                                </div>

                                <label class="col-md-3 col-sm-4 col-form-label">Stock Alert Quantity</label>
                                <div class="col-md-3 col-sm-4">
                                <input type="number" class="form-control form-control-lg" maxlength="4" onkeypress='return isNumberKey(event)' v-model="productParam.stockAlert">
                                </div>
                            </div>
                           
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">AMC Plan</label>
                                <div class="col-md-3 col-sm-4">
                                    <select id="js-amc-ajax" class="form-control"></select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Warranty Details</label>
                                <div class="col-md-6 col-sm-8">
                                    <textarea class="form-control" rows="3" readonly id="plan-description"></textarea>
                                </div>
                                <div class="col-md-3 col-sm-4">
                                <input type="text" class="form-control form-control-lg" readonly id="plan-duration">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="ccol-form-label">Product Images</label>
                            </div>
                            <vue-dropzone id="myVueDropzone"  url="/admin-api/dropzone" v-on:vdropzone-success="showSuccess" 
                            :headers=headerOption v-on:vdropzone-removed-file="removeFile">
                            </vue-dropzone>

                            <div role="alert" class="alert alert-danger mt-2" v-bind:class="{ 'd-none' : message == '' }">{{ message }}</div>
                            <div class="row mt-3">
                                <div class="col-12 text-end">
                                    <button class="btn btn-lg btn-primary" type="submit">Save Changes</button>
                                </div>
                            </div>
                            
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'

    export default {
        components: {
            vueDropzone: vue2Dropzone
        },  
        /*computed:{
            total: function() {
                var total = this.price + this.shipping - this.discount;
                return total-this.shipping<0?this.shipping:total;
            }
        },*/
        data(){
            return{
                htmlCode : '',
                message : "",
                idAmc : '',
                idBrand : '',
                idDepartment : '',
                idCategory : '',
                productParam: {},
                productImages : [],
                isCreating : false,
                image: null,
                headerOption: {
                    "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                }
            }  
        },
        created(){
            this.productParam.name = ''
            this.productParam.title = ''
            this.productParam.brand_id = ''
            this.productParam.modelNumber = ''
            this.productParam.hsn_code = ''
            this.productParam.short_description = ''
            this.productParam.description = ''
            this.productParam.purchase_price = ''
            this.productParam.sales_price = ''
            this.productParam.max_retail_price = ''
            this.productParam.tax_amount = ''
            this.productParam.minStock = ''
            this.productParam.maxStock = ''
            this.productParam.stock = ''
            this.productParam.amc_id = ''
            this.productParam.genericName = ''
            this.productParam.manufacture = ''
            this.productParam.skuc_code = ''
            this.productParam.pack_size = ''
            this.productParam.country_origin = ''
            this.productParam.keywords = ''
            this.productParam.stockAlert = ''

        },
        mounted(){
            self = this;
            $('.summernote').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['table', ['table']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
            });
            $('.descriptionNote').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
            });
            $('.note-editor .note-btn').on('click',function(){
                $(this).next().toggleClass("show");
            });
            $("button.close").click(function(){
                $('.note-modal').modal('hide');
                $('.link-dialog').modal('hide');
            })
            $(".image-input .form-control").on("change", function() {
                var e = URL.createObjectURL(this.files[0]);
                $(this).parent().parent().children(".avatar-wrapper")[0].style.background = "url(" + e + ") no-repeat"
            })
            function formatCategory(item) {
                if(!item.id){
                    return 'Select Category';   
                }else{
                    self.idCategory = item.id;
                    return item.text;
                }
            }
            $('#js-category-ajax').select2({
                placeholder: "Select Category",
                ajax: {
                    url: '/admin-api/fetch/categories',
                    dataType: 'json'
                    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                },
                formatSelection: format,
                formatResult: format,
                templateSelection : formatCategory
            });

            function formatDepartment(item) {
                if(!item.id){
                    return 'Select Department';   
                }else{
                    self.idDepartment = item.id;
                    return item.text;
                }
            }
            $('#js-department-ajax').select2({
                placeholder: "Select Department",
                ajax: {
                    url: '/admin-api/fetch/department',
                    dataType: 'json'
                    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                },
                formatSelection: format,
                formatResult: format,
                templateSelection : formatDepartment
            });

            function format(item) {
                return item.text;
            }
            function formatManufacture(item) {
                if(!item.id){
                    return 'Select Brand';   
                }else{
                    $('#in-manufacturer').val(item.tag);
                    self.idBrand = item.id;
                    return item.text;
                }
            }
            $('#js-brand-ajax').select2({
                placeholder: "Select Brand",
                ajax: {
                    url: '/admin-api/fetch/brand',
                    dataType: 'json'
                    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                },
                formatSelection: format,
                formatResult: format,
                templateSelection : formatManufacture
            });
            function formatPlans(item) {
                if(!item.id){
                    return 'Select AMC Plans';   
                }else{
                    self.idAmc = item.id
                    $('#plan-description').val(item.tag)
                    $('#plan-duration').val(item.duration+' '+item.unit)
                    return item.text;
                }
            }
            $('#js-amc-ajax').select2({
                placeholder: "Select AMC Plans",
                ajax: {
                    url: '/admin-api/fetch/amc/plans',
                    dataType: 'json'
                    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                },
                formatSelection: format,
                formatResult: format,
                templateSelection : formatPlans
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
            addProduct(e){
                e.preventDefault() // Prevent page from reloading.
                // console.log(this.name, this.price);
                this.isCreating = true
                var form = new FormData();
                form.set('name',this.productParam.name);
                form.set('title',this.productParam.title);
                form.set('brand_id',this.idBrand);
                form.set('amc_id',this.idAmc);
                form.set('category_id',this.idCategory);
                form.set('department_id',this.idDepartment);
                form.set('modelNumber',this.productParam.modelNumber);
                form.set('genericName',this.productParam.genericName);
                form.set('manufacture',this.productParam.manufacture);
                form.set('skuc_code',this.productParam.skuc_code);
                form.set('hsn_code',this.productParam.hsn_code);
                form.set('country_origin',this.productParam.country_origin);
                form.set('pack_size',this.productParam.pack_size);
                form.set('short_description',$('.summernote').summernote('code'));
                form.set('description',$('.descriptionNote').summernote('code'));
                form.set('purchase_price',this.productParam.purchase_price);
                form.set('sales_price',this.productParam.sales_price);
                form.set('max_retail_price',this.productParam.max_retail_price);
                form.set('tax_amount',this.productParam.tax_amount);
                form.set('keywords',this.productParam.keywords);
                form.set('minStock',this.productParam.minStock);
                form.set('maxStock',this.productParam.maxStock);
                form.set('stock',this.productParam.stock);
                form.set('stockAlert',this.productParam.stockAlert);
                form.set('productImages',this.productImages);
                if(this.image != null)
                form.set('featureImg',this.image);
                axios
                    .post('/admin-api/products', form)
                    .then(response => {
                        this.message = ''
                        Swal.fire('Product Created', '', 'success').then((result) => {
                        // Reload the Page
                            window.location = "/admin/products/"
                        });
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
            'removeFile': function (file) {
               var response = JSON.parse(file.xhr.response);
               this.productImages.splice(this.productImages.indexOf(response.id), 1);
            },
            'showSuccess': function (file) {
               var response = JSON.parse(file.xhr.response);
               this.productImages.push(response.id)
            }
        }
    }
</script>