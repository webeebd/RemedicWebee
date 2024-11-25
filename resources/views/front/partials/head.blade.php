<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Remedic - Health </title>
    <meta name="description" content="" />
    <link rel="shortcut icon" href="{{asset('front/assets/images/favicon.png')}}" type="image/f-icon" />

    <!-- font awesome -->
    <link rel="stylesheet" href="{{asset('front/assets/css/all.min.css')}}" />
    <!-- bootstraph -->
    <link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css')}}" />
    <!-- Fancy Box -->
    <link rel="stylesheet" href="{{asset('front/assets/css/jquery.fancybox.min.css')}}" />
    <!-- swiper js -->
    <link rel="stylesheet" href="{{asset('front/assets/css/swiper-bundle.min.css')}}" />
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{asset('front/assets/css/nice-select.css')}}" />
    <!-- Countdown js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
          rel="Stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('front/assets/css/jquery.countdown.css')}}" />
    <!-- User's CSS Here -->
    <link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}" />
    <style>
        .category-sidebar__inner .accordion-button::after{
            content: none;
        }
        .ui-autocomplete { position: absolute; cursor: default;z-index:1000 !important;max-height: 250px; overflow-y: scroll;}  
        .flyoutCart.highlight {
            opacity: 1;
            visibility: visible;
            right: 0;
        }
        .flyoutCart.highlight .flyout__flip {
            right: 0;
            opacity: 1;
            visibility: visible;
        }
        .quantity .incressQuantity, .quantity .decressQuantity {
            cursor: pointer;
            background: transparent;
            height: 15px;
            width: 15px;
            border: none;
            outline: none;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            position: relative;
            color: currentColor;
        }
        .quantity .incressQuantity .bar, .quantity .decressQuantity .bar {
            position: absolute;
            top: 50%;
            height: 2px;
            width: 15px;
            background: currentColor;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            right: 0px;
            background-image: none;
            border-radius: 8px;
        }
        
        .quantity .incressQuantity .bar::before{
            content: "";
            position: absolute;
            top: 50%;
            height: 15px;
            width: 2px;
            background: currentColor;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            right: 6px;
            background-image: none;
            border-radius: 8px;
            -webkit-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
        }
    </style>
</head>