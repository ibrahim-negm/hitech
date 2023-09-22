@php
$seo =\App\Models\Admin\Seo::first();
$settings = \App\Models\Admin\Setting::first();
$lang= app()->getLocale();


@endphp

<!DOCTYPE html>
<html lang="{{$lang}}">
<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="{{$seo->meta_title}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="{{$seo->meta_description}}">
    <meta name="keywords" content="{{$seo->meta_tag}}">
    <meta name="author" content="{{$seo->meta_auth}}">
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:image" content="{{ asset('upload/'.$settings->favicon) }}" />
    <meta name="facebook-domain-verification" content="puua64hnq0lwlezrlmjqtckcval69d" />
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta_tags')
    <!-- SITE TITLE -->
    <title>@yield('title-content')</title>

    <!-- FAVICONS ICON -->
    <link rel="icon" href="{{ asset('upload/'.$settings->favicon) }}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('upload/'.$settings->favicon) }}" />
    {{--<!--[if lt IE 9]>--}}
    <!--<script src="{{ asset('frontend/js/html5shiv.min.js') }}"></script>-->
    <!--<script src="{{ asset('frontend/js/respond.min.js') }}"></script>-->
    {{--<![endif]-->--}}

    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/plugins.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    <link class="skin" rel="stylesheet" type="text/css" href="{{ asset('frontend/css/skin/skin-4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/templete.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/rtl.css') }}">

    {{--<!-- Google Font -->--}}
    {{--<style>--}}
        {{--@import url('https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Playfair+Display:400,400i,700,700i,900,900i|Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap');--}}
    {{--</style>--}}

    <!-- REVOLUTION SLIDER CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/revolution/revolution/css/revolution.min.css') }}">

    <!-- Toaster Notification -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <!-- End Toaster Notification -->
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="sweetalert2.min.css">
    <!-- End sweetalert2 -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$seo->google_analytics}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{$seo->google_analytics}}');
    </script>

    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '345704444151937');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=345704444151937&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Meta Pixel Code -->
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
    <!-- google QAuth -->
    <meta name="google-site-verification" content="TrVP1TusWFBHF0cmUzdfQ6hX62zqOFdlF0-UKYWzsT0" />
</head>

<body id="bg">
<div class="page-wraper">

<!-- START HEADER -->
@include('frontend.layouts.main_header')
<!-- END HEADER -->

    <div class="page-content bg-white">

    <!-- Slider -->
    @include('frontend.layouts.main_slider')
    <!-- Slider END -->


    <!-- END MAIN CONTENT -->
    @yield('home-content')
    <!-- END MAIN CONTENT -->

        <!-- Messenger Chat plugin Code -->
        <div id="fb-root"></div>

        <!-- Your Chat plugin code -->
        <div id="fb-customer-chat" class="fb-customerchat">
        </div>

        <script>
            var chatbox = document.getElementById('fb-customer-chat');
            chatbox.setAttribute("page_id", "1790644461159286");
            chatbox.setAttribute("attribution", "biz_inbox");
        </script>

        <!-- Your SDK code -->
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    xfbml            : true,
                    version          : 'v13.0'
                });
            };

            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = 'https://connect.facebook.net/ar_AR/sdk/xfbml.customerchat.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>





    </div>



<!-- START FOOTER -->
@include('frontend.layouts.main_footer')
<!-- END FOOTER -->
</div>

<!-- JAVASCRIPT FILES ========================================= -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script><!-- JQUERY.MIN JS -->
<script src="{{asset('frontend/plugins/wow/wow.js')}}"></script><!-- WOW JS -->
<script src="{{asset('frontend/plugins/bootstrap/js/popper.min.js')}}"></script><!-- BOOTSTRAP.MIN JS -->
<script src="{{asset('frontend/plugins/bootstrap/js/bootstrap.min.js')}}"></script><!-- BOOTSTRAP.MIN JS -->
<script src="{{asset('frontend/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script><!-- FORM JS -->
<script src="{{asset('frontend/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script><!-- FORM JS -->
<script src="{{asset('frontend/plugins/magnific-popup/magnific-popup.js')}}"></script><!-- MAGNIFIC POPUP JS -->
<script src="{{asset('frontend/plugins/counter/waypoints-min.js')}}"></script><!-- WAYPOINTS JS -->
<script src="{{asset('frontend/plugins/counter/counterup.min.js')}}"></script><!-- COUNTERUP JS -->
<script src="{{asset('frontend/plugins/imagesloaded/imagesloaded.js')}}"></script><!-- IMAGESLOADED -->
<script src="{{asset('frontend/plugins/masonry/masonry-3.1.4.js')}}"></script><!-- MASONRY -->
<script src="{{asset('frontend/plugins/masonry/masonry.filter.js')}}"></script><!-- MASONRY -->
<script src="{{asset('frontend/plugins/owl-carousel/owl.carousel.js')}}"></script><!-- OWL SLIDER -->
<script src="{{asset('frontend/plugins/lightgallery/js/lightgallery-all.min.js')}}"></script><!-- Lightgallery -->
<script src="{{asset('frontend/js/custom.js')}}"></script><!-- CUSTOM FUCTIONS  -->
<script src="{{asset('frontend/js/dz.carousel.min.js')}}"></script><!-- SORTCODE FUCTIONS  -->
<script src="{{asset('frontend/plugins/countdown/jquery.countdown.js')}}"></script><!-- COUNTDOWN FUCTIONS  -->
<script src="{{asset('frontend/js/dz.ajax.js')}}"></script><!-- CONTACT JS  -->
<script src="{{asset('frontend/js/jquery.lazy.min.js')}}"></script>
<script src="{{asset('frontend/plugins/rangeslider/rangeslider.js')}}" ></script><!-- Rangeslider -->

<!-- REVOLUTION JS FILES -->
<script src="{{asset('frontend/plugins/revolution/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{asset('frontend/plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
<!-- Slider revolution 5.0 Extensions  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="{{asset('frontend/plugins/revolution/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{asset('frontend/plugins/revolution/revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
<script src="{{asset('frontend/plugins/revolution/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script src="{{asset('frontend/plugins/revolution/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{asset('frontend/plugins/revolution/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{asset('frontend/plugins/revolution/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script src="{{asset('frontend/plugins/revolution/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{asset('frontend/plugins/revolution/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script src="{{asset('frontend/js/rev.slider.js')}}"></script>
<script>
    jQuery(document).ready(function() {
        'use strict';
        dz_rev_slider_2();
        $('.lazy').Lazy();
    });	/*ready*/
</script>


<!-- Toaster Notification -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!--Sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
<script type="text/javascript">

    $(document).ready(function(){
        $('.addwishlist').on('click', function(){
            var id = $(this).data('id');
            if (id) {
                $.ajax({
                    url: " {{ url('add/wishlist/') }}/"+id,
                    type:"GET",
                    datType:"json",
                    success:function(data){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'bottom-start',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        if ($.isEmptyObject(data.error)) {

                            Toast.fire({
                                icon: 'success',
                                title: data.success
                            })
                        }else{
                            Toast.fire({
                                icon: 'error',
                                title: data.error
                            })
                        }


                    },
                });

            }else{
                alert('danger');
            }
        });

    });


</script>


{{--لحذف المنتج بقائمة المنتجات المحفوظة--}}
<script type="text/javascript">

    $(document).ready(function(){
        $('.removewishlist').on('click', function(){
            var id = $(this).data('id');
            if (id) {
                $.ajax({
                    url: " {{ url('remove/wishlist/') }}/"+id,
                    type:"GET",
                    datType:"json",
                    success:function(data){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'bottom-start',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        if ($.isEmptyObject(data.error)) {

                            Toast.fire({
                                icon: 'success',
                                title: data.success
                            })
                        }else{
                            Toast.fire({
                                icon: 'error',
                                title: data.error
                            })
                        }


                    },
                });

            }else{
                alert('danger');
            }
        });

    });


</script>
</body>
</html>