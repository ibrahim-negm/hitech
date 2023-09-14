
<?php
$services = \App\Models\Admin\Service::all();
$categories = \App\Models\Admin\Category::all();
$subcategories =\App\Models\Admin\Subcategory::all();
$brands =\App\Models\Admin\Brand::all();
$coupons =\App\Models\Admin\Coupon::all();
$subscribers = \App\Models\Admin\Subscriber::all();
    if(\Illuminate\Support\Facades\Auth::user()->permission->company == 1){
       if (\Illuminate\Support\Facades\Auth::user()->brand){
           $brand_id = \Illuminate\Support\Facades\Auth::user()->brand->id;
       }
      $brand_id=null;
        $products = \App\Models\Admin\Product::where('brand_id',$brand_id)->get();
    }else{
        $products = \App\Models\Admin\Product::all();

    }
$sliders = \App\Models\Admin\Slider::all();
$advs = \App\Models\Admin\Adv::all();
$new_orders = \App\Models\Front\Order::where('status',1)->latest()->get();
$orders = \App\Models\Front\Order::whereIn('status',[1,2,3,4,5])->latest()->get();
$new_reviews= \App\Models\Front\Review::where('status',0)->latest()->get();
$reviews= \App\Models\Front\Review::latest()->get();
$new_messages = \App\Models\Front\Contact::where('status',0)->latest()->get();
$messages = \App\Models\Front\Contact::all();
$last_order = \App\Models\Front\Order::where('status',1)->latest()->first();
$last_reviews= \App\Models\Front\Review::latest()->first();
$user = \App\Models\User::all();
$admins = \App\Models\Admin::whereNotIn('id',[1])->get();
$employees = \App\Models\Admin\Employee::all();
$posts = \App\Models\Admin\Post::all();
$images= \App\Models\Admin\Image::all();
$comments= \App\Models\Front\Comment::all();
$new_comments= \App\Models\Front\Comment::where('status',0)->latest()->get();




?>
<!DOCTYPE html>
<html class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title> @yield('title-content') </title>
    <link rel="apple-touch-icon" href="{{ asset('backend/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
            rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/plugins/animate/animate.css') }}">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/icheck/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/selects/selectize.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/weather-icons/climacons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/fonts/meteocons/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/charts/morris.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/charts/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/charts/chartist-plugin-tooltip.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/toggle/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/toggle/switchery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/pages/chat-application.css') }}">

    <!-- END VENDOR CSS-->

    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/custom-rtl.css') }}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/plugins/forms/selectize/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/charts/jquery-jvectormap-2.0.3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/charts/morris.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/fonts/simple-line-icons/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/pages/timeline.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/cryptocoins/cryptocoins.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/extensions/datedropper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/extensions/timedropper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/flaticon.css') }}">



    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/style-rtl.css') }}">
    <!-- END Custom CSS-->
    <!-- Toaster Notification -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <!-- End Toaster Notification -->

    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">

    @include('admin.body.header')
</nav>

<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    @include('admin.body.sidebar')
</div>
<div class="app-content content">
   @yield('admin-content')
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
    @include('admin.body.footer')

<!-- BEGIN VENDOR JS-->
<script src="{{ asset('backend/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
<!-- BEGIN PAGE VENDOR JS-->

<script src="{{ asset('backend/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/js/charts/raphael-min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/js/charts/morris.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('backend/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('backend/data/jvector/visitor-data.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript"></script>

<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{ asset('backend/js/core/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/core/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/scripts/customizer.js') }}" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('backend/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/scripts/forms/select/form-selectize.js') }}" type="text/javascript"></script>

<script src="{{ asset('backend/js/scripts/tables/datatables/datatable-basic.js')}}"  type="text/javascript"></script>
<script src="{{ asset('backend//js/scripts/tables/datatables/datatable-advanced.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/js/scripts/pages/dashboard-sales.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->

<!--  Checkeditor LEVEL JS-->
<script src="{{ asset('backend/vendors/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('backend/vendors/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
<script src="{{ asset('backend/vendors/js/editor.js') }}"></script>
<!-- END Checkeditor LEVEL JS-->

<!-- Toaster Notification -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!--Sweet alert -->
<script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Toaster Notification -->
<script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
    switch(type) {
        case 'info':
            toastr.info(" {{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success(" {{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning(" {{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error(" {{ Session::get('message') }}");
            break;

    }
    @endif
</script>
<!-- End Toaster Notification -->
<!--Sweet alert -->
<script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
            title: "هل تريد حذف هذا  ",
            text: "مجرد ما يتم الضغط على موافق , سيتم حذفه نهائيا",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal("تم الاحتفاظ به مرة اخرى , شكراً");
                }
            });
    });
</script>
</body>
</html>