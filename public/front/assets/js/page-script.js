$('.product-autocomplete').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "http://remedic.oakmis.com/search-product",
                dataType: "json",
                method: 'get',

                data: {
                    title: request.term,
                    type: 'data',
                    row_num: 1
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        console.log(item);
                        return {
                            label: item.name,
                            value: item.name,
                        }
                    }));
                }
            });
        },
        autoFocus: true,
        minLength: 0,
        select: function (event, ui) {
            // console.log(ui.item.label);
            $('.product-autocomplete').val(ui.item.name);
        }
});
$( function() {
    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 300000,
        values: [ 85000, 150000 ],
        slide: function( event, ui ) {
          $( "#amount").val( "৳" + ui.values[ 0 ] + " - ৳" + ui.values[ 1 ] );
        }
    });
    $( "#amount" ).val( "৳" + $( "#slider-range" ).slider( "values", 0 ) +
      " - ৳" + $( "#slider-range" ).slider( "values", 1 ) );
  });
  
function showCartFlyout(){
    $('#cart_success').modal('hide');
//    $(".flyoutCart").toggleClass("active");
    $('div#fc').removeClass('flyoutCart');
    $('div#fc').addClass(["flyoutCart","highlight"]);
//    $('#cart_success').modal('hide');
}
function addToCart(productid,qty,amcval){
    console.log(productid);
    $.ajax({
        url: "http://remedic.oakmis.com/cart",
        dataType: "json",
        method: 'post',
        data: {
           idProduct: productid,qty:qty,amc:amcval
        },
        success: function (data) {
            $('#shoppingcart').empty();
            $('#cartcounttotal').empty();
            $('#cartcounttotal').text(data.total_items);
            $('#subtotalcart').empty();
            $('#subtotalcart').text(data.subtotal);
            $('#distotalcart').empty();
            $('#distotalcart').text(data.discount);
            $('#totalamtcart').empty();
            $('#totalamtcart').text(data.totalamt);
            $.each(data.cart_items, function(key,value) {
                $('#shoppingcart').append('<div class="shopping-card">\n\
                        <a href="#" class="shopping-card__image"><img src="http://remedic.oakmis.com/storage/products/'+value.product.pic+'" alt="cart-product" /></a>\n\
                        <div class="shopping-card__content">\n\
                            <div class="shopping-card__content-top"><h5 class="product__title"><a href="#">'+value.product.title+'</a></h5><h5 class="product__price">৳ '+value.product.max_retail_price+'</h5></div>\n\
                            <div class="shopping-card__content-bottom"><div class="quantity__wrapper"><div class="quantity"><div><input class="prodid" type="hidden"  value="'+value.product.id+'"></div><button type="button" class="decressQuantity"><span class="bar"></span></button><input class="qnttinput" disabled name="qty" onchange="addToCart('+value.product.id+',1,N)" type="number"  value="'+value.qty+'" min="01" max="10" /><button type="button" class="incressQuantity"><span class="bar"></span></button></div><div class="stock__item">'+value.amc+'</div></div>\n\
                                <a href="http://remedic.oakmis.com/cart/'+value.product.id+'/delete" class="action__btn"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"xmlns="http://www.w3.org/2000/svg"><path d="M1.25 3.5H2.75M2.75 3.5H14.75M2.75 3.5V14C2.75 14.3978 2.90804 14.7794 3.18934 15.0607C3.47064 15.342 3.85218 15.5 4.25 15.5H11.75C12.1478 15.5 12.5294 15.342 12.8107 15.0607C13.092 14.7794 13.25 14.3978 13.25 14V3.5H2.75ZM5 3.5V2C5 1.60218 5.15804 1.22064 5.43934 0.93934C5.72064 0.658035 6.10218 0.5 6.5 0.5H9.5C9.89782 0.5 10.2794 0.658035 10.5607 0.93934C10.842 1.22064 11 1.60218 11 2V3.5M6.5 7.25V11.75M9.5 7.25V11.75" stroke="#667085" stroke-linecap="round" stroke-linejoin="round" /></svg><span>Delete</span></a>\n\
                            </div>\n\
                    </div></div>');
            });
           $('#checkout_btns').show(); 
           $('#cart_success').modal('show');
           $(".incressQuantity").on("click", function () {
                var prodid = $(this).closest("div").find(".prodid").val();
                var $qty = $(this).closest("div").find(".qnttinput");
                var currentVal = parseInt($qty.val(), 10);
                if (!isNaN(currentVal)) {
                    $qty.val(currentVal + 1);
                }
                var quantity = $qty.val();
                addToCart(prodid,quantity,'N');
            });
            $(".decressQuantity").on("click", function () {
                var prodid = $(this).closest("div").find(".prodid").val();
                var $qty = $(this).closest("div").find(".qnttinput");
                var currentVal = parseInt($qty.val(), 10);
                if (!isNaN(currentVal) && currentVal > 1) {
                    $qty.val(currentVal - 1);
                } else {
                    $(this).parents(".cart__action__btn").find(".cart__quantity").css("display", "none");
                }
                var quantity = $qty.val();
                addToCart(prodid,quantity,'N');
            });
        }
    });
  }
  
$(document).ready(function() {
    $.ajax({
        url: "http://remedic.oakmis.com/getcart",
        dataType: "json",
        method: 'GET',
        success: function (data) {
            $('#shoppingcart').empty();
            $('#cartcounttotal').empty();
            $('#cartcounttotal').text(data.total_items);
            $('#subtotalcart').empty();
            $('#subtotalcart').text(data.subtotal);
            $('#distotalcart').empty();
            $('#distotalcart').text(data.discount);
            $('#totalamtcart').empty();
            $('#totalamtcart').text(data.totalamt);
            $.each(data.cart_items, function(key,value) {
                $('#shoppingcart').append('<div class="shopping-card">\n\
                        <a href="#" class="shopping-card__image"><img src="http://remedic.oakmis.com/storage/products/'+value.product.pic+'" alt="cart-product" /></a>\n\
                        <div class="shopping-card__content">\n\
                            <div class="shopping-card__content-top"><h5 class="product__title"><a href="#">'+value.product.title+'</a></h5><h5 class="product__price">৳ '+value.product.max_retail_price+'</h5></div>\n\
                            <div class="shopping-card__content-bottom"><div class="quantity__wrapper"><div class="quantity"><div><input class="prodid" type="hidden"  value="'+value.product.id+'"></div><button type="button" class="decressQuantity"><span class="bar"></span></button><input class="qnttinput" disabled name="qty" type="number"  value="'+value.qty+'" min="01" max="10" /><button type="button" class="incressQuantity"><span class="bar"></span></button></div><div class="stock__item">'+value.amc+'</div></div>\n\
                                <a href="http://remedic.oakmis.com/cart/'+value.product.id+'/delete" class="action__btn"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"xmlns="http://www.w3.org/2000/svg"><path d="M1.25 3.5H2.75M2.75 3.5H14.75M2.75 3.5V14C2.75 14.3978 2.90804 14.7794 3.18934 15.0607C3.47064 15.342 3.85218 15.5 4.25 15.5H11.75C12.1478 15.5 12.5294 15.342 12.8107 15.0607C13.092 14.7794 13.25 14.3978 13.25 14V3.5H2.75ZM5 3.5V2C5 1.60218 5.15804 1.22064 5.43934 0.93934C5.72064 0.658035 6.10218 0.5 6.5 0.5H9.5C9.89782 0.5 10.2794 0.658035 10.5607 0.93934C10.842 1.22064 11 1.60218 11 2V3.5M6.5 7.25V11.75M9.5 7.25V11.75" stroke="#667085" stroke-linecap="round" stroke-linejoin="round" /></svg><span>Delete</span></a>\n\
                            </div>\n\
                    </div></div>');
            });
            $('#checkout_btns').show(); 
            $(".incressQuantity").on("click", function () {
                var prodid = $(this).closest("div").find(".prodid").val();
                var $qty = $(this).closest("div").find(".qnttinput");
                var currentVal = parseInt($qty.val(), 10);
                if (!isNaN(currentVal)) {
                    $qty.val(currentVal + 1);
                }
                var quantity = $qty.val();
                addToCart(prodid,quantity,'N');
            });
            $(".decressQuantity").on("click", function () {
                var prodid = $(this).closest("div").find(".prodid").val();
                var $qty = $(this).closest("div").find(".qnttinput");
                var currentVal = parseInt($qty.val(), 10);
                if (!isNaN(currentVal) && currentVal > 1) {
                    $qty.val(currentVal - 1);
                } else {
                    $(this).parents(".cart__action__btn").find(".cart__quantity").css("display", "none");
                }
                var quantity = $qty.val();
                addToCart(prodid,quantity,'N');
            });
        }
    });
});

function saveCartData(){
     var productid = $('#prdid').val();
     var quantity = $('#prdqty').val();
     var amc = $('#amccheck:checked').val();
    
     $.ajax({
        url: "http://remedic.oakmis.com/cart",
        dataType: "json",
        method: 'post',
        data: {
            idProduct: productid,qty:quantity,amc:amc
        },
        success: function (data) {
            $('#shoppingcart').empty();
            $('#cartcounttotal').empty();
            $('#cartcounttotal').text(data.total_items);
            $('#subtotalcart').empty();
            $('#subtotalcart').text(data.subtotal);
            $('#distotalcart').empty();
            $('#distotalcart').text(data.discount);
            $('#totalamtcart').empty();
            $('#totalamtcart').text(data.totalamt);
            $.each(data.cart_items, function(key,value) {
                console.log(value);
                $('#shoppingcart').append('<div class="shopping-card">\n\
                        <a href="#" class="shopping-card__image"><img src="http://remedic.oakmis.com/storage/products/'+value.product.pic+'" alt="cart-product" /></a>\n\
                        <div class="shopping-card__content">\n\
                            <div class="shopping-card__content-top"><h5 class="product__title"><a href="#">'+value.product.title+'</a></h5><h5 class="product__price">৳ '+value.product.max_retail_price+'</h5></div>\n\
                            <div class="shopping-card__content-bottom"><div class="quantity__wrapper"><div class="quantity"><div><input class="prodid" type="hidden"  value="'+value.product.id+'"></div><button type="button" class="decressQuantity"><span class="bar"></span></button><input class="qnttinput" disabled name="qty" onchange="addToCart('+value.product.id+',1,N)" type="number"  value="'+value.qty+'" min="01" max="10" /><button type="button" class="incressQuantity"><span class="bar"></span></button></div><div class="stock__item">'+value.amc+'</div></div>\n\
                                <a href="http://remedic.oakmis.com/cart/'+value.product.id+'/delete" class="action__btn"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"xmlns="http://www.w3.org/2000/svg"><path d="M1.25 3.5H2.75M2.75 3.5H14.75M2.75 3.5V14C2.75 14.3978 2.90804 14.7794 3.18934 15.0607C3.47064 15.342 3.85218 15.5 4.25 15.5H11.75C12.1478 15.5 12.5294 15.342 12.8107 15.0607C13.092 14.7794 13.25 14.3978 13.25 14V3.5H2.75ZM5 3.5V2C5 1.60218 5.15804 1.22064 5.43934 0.93934C5.72064 0.658035 6.10218 0.5 6.5 0.5H9.5C9.89782 0.5 10.2794 0.658035 10.5607 0.93934C10.842 1.22064 11 1.60218 11 2V3.5M6.5 7.25V11.75M9.5 7.25V11.75" stroke="#667085" stroke-linecap="round" stroke-linejoin="round" /></svg><span>Delete</span></a>\n\
                            </div>\n\
                    </div></div>');
            });
           $('#checkout_btns').show(); 
           $('#cart_success').modal('show');
           $(".incressQuantity").on("click", function () {
                var prodid = $(this).closest("div").find(".prodid").val();
                var $qty = $(this).closest("div").find(".qnttinput");
                var currentVal = parseInt($qty.val(), 10);
                if (!isNaN(currentVal)) {
                    $qty.val(currentVal + 1);
                }
                var quantity = $qty.val();
                addToCart(prodid,quantity,'N');
            });
            $(".decressQuantity").on("click", function () {
                var prodid = $(this).closest("div").find(".prodid").val();
                var $qty = $(this).closest("div").find(".qnttinput");
                var currentVal = parseInt($qty.val(), 10);
                if (!isNaN(currentVal) && currentVal > 1) {
                    $qty.val(currentVal - 1);
                } else {
                    $(this).parents(".cart__action__btn").find(".cart__quantity").css("display", "none");
                }
                var quantity = $qty.val();
                addToCart(prodid,quantity,'N');
            });
        }
    });
}

function showAddressForm(){
    $('#add-address').toggle();
}