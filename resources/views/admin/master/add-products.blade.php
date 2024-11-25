@extends('layouts.app')
@section('content')
<div class="page-header pattern-bg">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12 mb-2">
            <ol class="breadcrumb mb-2">
               <li class="breadcrumb-item"><a href="{{url('admin/home')}}" class="">Dashboard</a></li>
               <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
            <div class="d-flex justify-content-between align-items-center">
                @if(isset($product))
               <h1 class="h2 mb-md-0 text-white fw-light">Edit Product</h1>
               @else
               <h1 class="h2 mb-md-0 text-white fw-light">Add New Product</h1>
               @endif
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
                            <h6 class="card-title mb-0">Product Details</h6>
                            <small class="text-muted">Note: Please enter the mandatory details.</small>
                            </div> 
                        </div>
                        <div class="card-body">

                                    @if(isset($product)) 
                                    <img src="@if($product->pic == null) /no_pic.png @else /storage/products/{{$product->pic}} @endif" width="100" height="100"/>
                                    @endif

                            @if(isset($product))
                           <form  action="{{route('products.update',$product->id)}}" method="POST"  enctype="multipart/form-data" class="row" id="product-form">
                           @method('PUT')
                           @else
                           <form  action="{{url('admin/products')}}" method="post" enctype="multipart/form-data" class="row" id="product-form">
                            @endif
                              @csrf
                                    
                                <div class="col-sm-4">
                                    <label class="col-form-label">Main Image<sup class="text-danger">*</sup></label>
                                        <input class="form-control" type="file" id="formFile" accept="image/*" name="featureImg">
                                        @if ($errors->has('featureImg'))
                                        <label id="minmaxlength-error" class="error" for="minmaxlength">
                                            <strong>{{ $errors->first('featureImg') }}</strong>
                                        </label>
                                        @endif     
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-form-label">Product Title<sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" name="title" required  @if(isset($product))  value="{{$product->title}}" @else value="{{ old('title') }}" @endif/>
                                        @if ($errors->has('title'))
                                        <label id="minmaxlength-error" class="error" for="minmaxlength">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </label>
                                        @endif
                                </div>

                                <div class="col-sm-4">
                                    <label class="col-form-label">Category</label>
                                    <select class="form-select" aria-label="Default select example" name="category_id" required @if(isset($product))  value="{{$product->category_id}}" @else value="{{ old('category_id') }}" @endif>
                                        <option value ="">Select category</option>
                                        @foreach($categories as $model)
                                        <option value="{{$model->id}}" @if(isset($product) && $product->category_id == $model->id) selected="selected" @else @if(old('category_id') == $model->id) selected="selected" @endif @endif>{{$model->name}}</option>
                                        @endforeach
                                    </select>
                                   
                                </div>
                                <div class="col-sm-4">
                                   <label class="col-form-label">Department</label>
                                    <select class="form-select" aria-label="Default select example" name="department" required @if(isset($product))  value="{{$product->department}}" @else value="{{ old('department') }}" @endif>
                                        <option>Select Department</option>
                                        @foreach($department as $model)
                                        <option value="{{$model->id}}" @if(isset($product) && $product->department_id == $model->id) selected="selected" @else @if(old('department') == $model->id) selected="selected" @endif @endif>{{$model->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                          
                                <div class="col-sm-4">
                                    <label class="col-form-label">Model number</label>
                                    <input type="text" class="form-control" name="modelNumber"  @if(isset($product))  value="{{$product->modelNumber}}" @else value="{{ old('modelNumber') }}" @endif/>  
                                </div>
                                <div class="col-sm-4">
                                   <label class="col-form-label">Brand</label>
                                    <select class="form-select" aria-label="Default select example" name="brand_id" required @if(isset($product))  value="{{$product->brand_id}}" @else value="{{ old('brand_id') }}" @endif>
                                    <option value ="">Select brand</option>
                                    @foreach($brands as $model)
                                    <option value="{{$model->id}}" @if(isset($product) && $product->brand_id == $model->id) selected="selected" @else @if(old('brand_id') == $model->id) selected="selected" @endif @endif>{{$model->name}}</option>
                                    @endforeach
                                    </select>
                                </div>

                            <div class="col-sm-4">
                                <label class="col-form-label">Generic Name</label>
                                <input type="text" class="form-control" required name="genericName"  @if(isset($product))  value="{{$product->genericName}}" @else value="{{ old('genericName') }}" @endif />
                                
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Manufacturer</label>
                                <input type="text" class="form-control" required name="manufacture"  @if(isset($product))  value="{{$product->manufacture}}" @else value="{{ old('manufacture') }}" @endif />
                             
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">SKU</label>
                                <input type="text" class="form-control" required name="skuc_code"  @if(isset($product))  value="{{$product->skuc_code}}" @else value="{{ old('skuc_code') }}" @endif />
                                
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">HSN</label>
                                <input type="text" class="form-control" name="hsn_code"  @if(isset($product))  value="{{$product->hsn_code}}" @else value="{{ old('hsn_code') }}" @endif />
                             
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Country of Origin</label>
                                <input type="text" class="form-control" name="country_origin"  @if(isset($product))  value="{{$product->country_origin}}" @else value="{{ old('country_origin') }}" @endif />
                               
                            </div>
                            <div class="col-sm-4">
                               <label class="col-form-label">Pack Size</label>
                                <input type="text" class="form-control" name="pack_size"  @if(isset($product))  value="{{$product->pack_size}}" @else value="{{ old('pack_size') }}" @endif />
                     
                            </div>
                            
                            <div class="col-sm-4">
                                <label class="col-form-label">Purchase Price</label>
                                <input type="text" class="form-control" onkeypress='return isNumberKey(event)' name="purchase_price" @if(isset($product))  value="{{$product->purchase_price}}" @else value="{{ old('purchase_price') }}" @endif />
                                                 

                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">MRP Price<sup class="text-danger">*</sup></label>
                                <input type="text" name="max_retail_price" id="mrp" class="form-control" onkeypress='return isNumberKey(event)' onblur="calculateDiscount()" @if(isset($product))  value="{{$product->max_retail_price}}" @else value="{{ old('max_retail_price') }}" @endif/>
                                @if ($errors->has('max_retail_price'))
                                        <label id="minmaxlength-error" class="error" for="minmaxlength">
                                            <strong>{{ $errors->first('max_retail_price') }}</strong>
                                        </label>
                                        @endif     
                            </div>

                            <div class="col-sm-4">
                                <label class="col-form-label">Tax%<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" onkeypress='return isNumberKey(event)' required name="tax_amount" @if(isset($product))  value="{{$product->tax_amount}}" @else value="{{ old('tax_amount') }}" @endif/>
                                @if ($errors->has('tax_amount'))
                                        <label id="minmaxlength-error" class="error" for="minmaxlength">
                                            <strong>{{ $errors->first('tax_amount') }}</strong>
                                        </label>
                                        @endif     
                            </div>
                            <div class="col-sm-2">
                                <label class="col-form-label">Discount Type</label>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="discount_type" id="flexRadioDefault1" checked="" value="A">
                                <label class="form-check-label" for="flexRadioDefault1">Flat</label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="discount_type" id="flexRadioDefault2" value="P">
                                <label class="form-check-label" for="flexRadioDefault2">Percentage</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label class="col-form-label">Discount</label>
                                <input type="text" class="form-control" id="discount"  onkeypress='return isNumberKey(event)' onblur="calculateDiscount()" name="pre_discount" @if(isset($product))  value="{{$product->pre_discount}}" @else value="{{ old('pre_discount') }}" @endif />
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Sell Price<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="price" onkeypress='return isNumberKey(event)' required name="sales_price" @if(isset($product))  value="{{$product->sales_price}}" @else value="{{ old('sales_price') }}" @endif />
                                @if ($errors->has('sales_price'))
                                        <label id="minmaxlength-error" class="error" for="minmaxlength">
                                            <strong>{{ $errors->first('sales_price') }}</strong>
                                        </label>
                                        @endif 
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Keywords</label>
                                <?php
                                $keywords = "";
                                if(isset($product)){
                                    if ($keywords != null) {
                                       foreach ($keywords as $key => $value) {
                                         if(count($keywords) == $key - 1 ){
                                            $keywords = $keywords.$value;
                                         }else{
                                            $keywords = $keywords.$value.',';
                                         }
                                       }
                                    }
                                }
                                ?>
                                <input type="text" class="form-control" required name="keypoints" @if(isset($product))  value="{{$keywords}}" @else value="{{ old('keypoints') }}" @endif />
                                <p class="text-danger">Add comma(,) for separation</p>
                            </div>
                            <div class="col-sm-2">
                                <label class="col-form-label">Minimum Buy Quantity</label>
                                <input type="text" class="form-control" onkeypress='return isNumberKey(event)' required name="minBuy" @if(isset($product))  value="{{$product->minBuy}}" @else value="{{ old('minBuy') }}" @endif />
                               
                            </div>
                            <div class="col-sm-2">
                                <label class="col-form-label">Maximum Buy Quantity</label>
                                <input type="text" class="form-control"  onkeypress='return isNumberKey(event)' required name="maxBuy" @if(isset($product))  value="{{$product->maxBuy}}" @else value="{{ old('maxBuy') }}" @endif />
                                
                            </div>
                            <div class="col-sm-2">
                                <label class="col-form-label">Stock Quantity</label>
                                <input type="text" class="form-control" onkeypress='return isNumberKey(event)' required name="stock" @if(isset($product))  value="{{$product->stock}}" @else value="{{ old('stock') }}" @endif />
                                
                            </div>
                            <div class="col-sm-2">
                                <label class="col-form-label">Stock Alert Quantity</label>
                                <input type="text" class="form-control" onkeypress='return isNumberKey(event)' required name="stockAlert" @if(isset($product))  value="{{$product->stockAlert}}" @else value="{{ old('stockAlert') }}" @endif />
                            </div>
                            <div class="col-sm-4">
                            <label class="col-form-label">AMC Plan</label>
                                <select class="form-select" aria-label="Default select example" name="amc_id" required @if(isset($product))  value="{{$product->amc_id}}" @else value="{{ old('amc_id') }}" @endif>
                                   <option selected value="">Select plan</option>
                                   @foreach($amc as $model)
                                        <option value="{{$model->id}}" @if(isset($product) && $product->amc_id == $model->id) selected="selected" @else @if(old('amc_id') == $model->id) selected="selected" @endif @endif>{{$model->name}}</option>
                                        @endforeach
                                       
                                </select>
                           </div>
                           <div class="col-sm-2">
                                <label class="col-form-label">Status <sup class="text-danger">*</sup></label>
                                <select class="form-select" aria-label="Default select example" name="active" required @if(isset($product))  value="{{$product->active}}" @else value="{{ old('active') }}" @endif>
                                   <option value="" selected>--- Select Status --</option>
                                   <option value="Y" @if(isset($product) && $product->active == 'Y') selected="selected" @endif>Active</option>
                                    <option value="N" @if(isset($product) && $product->active == 'N') selected="selected" @endif>In Active</option>
                                </select>
                                @if ($errors->has('active'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('active') }}</strong>
                                    </label>
                                    @endif 
                            </div>
                           <div class="col-sm-6">
                                  <label class="col-form-label">Short Description <sup class="text-danger">*</sup></label>
                                    <textarea class="form-control" name="short_description" placeholder="Type description here.." rows="3" required> @if(isset($product)){{$product->short_description}} @else{{ old('short_description') }}@endif </textarea>
                                   @if ($errors->has('short_description'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('short_description') }}</strong>
                                    </label>
                                    @endif  
                            </div>
                            <div class="col-sm-6">
                               <label class="col-form-label">Description <sup class="text-danger">*</sup></label>
                               <input type="hidden" name="description" id="description"/>
                               <textarea class="form-control summernote" id="description-field" placeholder="Type description here.." rows="3" required>@if(isset($product)){{$product->description}} @else{{ old('description') }}@endif</textarea>
                                   @if ($errors->has('description'))
                                    <label id="minmaxlength-error" class="error" for="minmaxlength">
                                          <strong>{{ $errors->first('description') }}</strong>
                                    </label>
                                    @endif  
                           </div>
                           <div class="col-sm-6">
                                <label class="col-form-label">Warranty Details</label>
                                <input type="hidden" name="warranty" id="warranty"/>
                                <textarea class="form-control summernote" id="warranty-field" rows="3" required>@if(isset($product)){{$product->warranty}} @else{{ old('warranty') }}@endif</textarea>
                            </div>
                            <div id="image-files" style="display:none;">

                            </div>                    
                            </form>
                            <form action="/admin-api/upload" enctype="multipart/form-data" class="dropzone" id="image-upload" style="margin-top:15px;margin-bottom:15px;">  
                                <div class="dz-message">
                                    <div class="drag-icon-cph"> <i class="fa fa-hand-o-up" style="font-size: 60px;"></i></div>
                                    <h3>Drop files here or click to upload.</h3>
                                    <div class="fallback" id="dz-error-message">
                                        <input name="file" type="file" multiple />
                                    </div>
                                </div>
                            </form>  
                            <div class="text-end">
                            <button class="btn btn-lg btn-primary" type="submit" onClick="addProduct()"> Save Changes</button>
							</div>
                </div>
            </div>
		</div>
</div>   
@stop
@section('script')
<script>
const files = [];
let myDropzone = Dropzone.options.imageUpload = {  
        maxFilesize:5,  
        maxFiles:5,
        addRemoveLinks :true,
        headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        acceptedFiles: ".jpeg,.jpg,.png",
        init: function() {
            this.on('success', function(file, response){
                files[file.upload.uuid] = response.id
            });
            this.on('removedfile', function(file, response){
                files[file.upload.uuid] = 0;
                console.log(files);
            });
        }
    };
    $(document).ready(function(){
        $('#description-field').summernote();
        $('#warranty-field').summernote();
        $('input[type=radio][name=discount_type]').on('change', function() {
            calculateDiscount();
        });
    });
    function addProduct(){
        var form = document.getElementById("product-form");
        $('#description').val($('#description-field').summernote('code'));
        $('#warranty').val($('#warranty-field').summernote('code'));
        $('#image-files').empty();
        for (var key in files){
            if(files[key] != 0){
                $('#image-files').append('<input name="media[]" value="'+files[key]+'" type="hidden" />')
            }
        }
        form.submit();
    }
    function calculateDiscount(){
        var mrp = $('#mrp').val();
        var discount = $('#discount').val();
        if(discount > 0){
            if($('input[name="discount_type"]:checked').val() !='A'){
                var total = mrp - (mrp * discount/100);
                $('#price').val(Number(total).toFixed(2));
            }else{
                var total = mrp - discount;
                $('#price').val(Number(total).toFixed(2));
            }
        }else{
            $('#price').val(Number(mrp).toFixed(2));
        }
    }
</script>
@stop