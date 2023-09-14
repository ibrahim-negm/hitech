@php
$id = Auth::id();

@endphp

@extends('frontend.layouts.master')

@section('title-content')  لوحة التحكم - هاى تك للتقسيط @endsection

@section('home-content')

    <div class="page-content bg-white">

        <div class="dlab-bnr-inr overlay-black-middle bg-pt" style="background-image:url( {{ asset('frontend/images/page_slider/slider.jpg') }} );">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h2 class="text-white">لوحة التحكم</h2>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
                            <li>لوحة التحكم</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>

        <div class="content-area">


            <div class="container">
                <div class="row">
                    <div class="col-md-4 ">
                        <div class="list-group">
                            <a href="#" class="list-group-item active">{{ __('site.account_details') }}</a>
                            <a href="{{ route('user.order') }}" class="list-group-item">{{ __('site.my_orders') }}</a>
                            <a href="{{ route('user.wishlist') }}" class="list-group-item">{{ __('site.my_wishlist') }}</a>
                            <a href="{{ route('user.subscriber') }}" class="list-group-item ">{{ __('site.newsletter') }}</a>
                            <a href="{{ route('user.address') }}" class="list-group-item">{{ __('site.my_addresses') }}</a>
                            <a href="{{ route('user.update.password') }}" class="list-group-item ">{{ __('site.change_password') }}</a>
                            <a href="{{ route('user.logout') }}" class="list-group-item ">{{ __('site.exit') }}</a>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <br>
                        <h2 class="mb-3">تفاصيل الحساب</h2>
                        <div class="row vert-margin">
                            <div class="col-sm-9">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>{{ __('site.personal_info') }}</h3>
                                        <img src="{{ (!empty( Auth::user()->profile_photo_path))
                                ? url('upload/frontend/users/'.Auth::user()->profile_photo_path)
                                : url('upload/avatar.png')}}" class="rounded-circle  height-150" alt="Card image" style="width:100px ; height: 100px; ">
                                        <p><b>الاسم بالكامل : </b> {{ Auth::user()->name }}<br>
                                            <b>البريد الالكترونى :</b> {{ Auth::user()->email }}<br>
                                            <b>التليفون :</b> @if( Auth::user()->phone){{ Auth::user()->phone }} @else غير موجود @endif</p>

                                        <div class="dlab-divider bg-gray tb10"><i class="icon-dot c-square"></i></div>

                                                            <div class="dlab-accordion toggle space" id="accordion7">
                                                                <div class="panel">
                                                                    <div class="acod-head">
                                                                        <h6 class="acod-title"> <a data-toggle="collapse" href="#collapseOne7" class="collapsed"> تحديث البيانات الشخصية</a> </h6>
                                                                    </div>
                                                                    <div id="collapseOne7" class="acod-body collapse">
                                                                        <div class="acod-content">
                                                                            <form class="comment-form" action="{{ route('user-profile.update',Auth::id()) }}" method="post" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="card-body">
                                                                                    <h3>تحديث بيانات الحساب</h3>

                                                                                    <div class="row mt-2">
                                                                                        <div class="col-sm-12">

                                                                                            <img src="{{ (!empty( Auth::user()->profile_photo_path))
                                                                                                ? url('upload/frontend/users/'.Auth::user()->profile_photo_path)
                                                                                                : url('upload/avatar.png')}}"
                                                                                                 class="rounded-circle  height-150" alt="Card image" style="width:100px ; height: 100px;" id="one">
                                                                                            <br>
                                                                                            <label class="text-uppercase">الصورة الشخصية :</label>
                                                                                            <div class="form-group">
                                                                                                <input type="file" class="form-control form-control--sm" name="profile_photo_path"  onchange="readURL(this);">

                                                                                                @error('profile_photo_path')
                                                                                                <span class="invalid-feedback" role="alert">
                                                                                                  <strong>{{ $message }}</strong></span>
                                                                                                @enderror

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mt-2">
                                                                                        <div class="col-sm-12">
                                                                                            <label class="text-uppercase">الاسم بالكامل : <span class="required"> *</span></label>
                                                                                            <div class="form-group">
                                                                                                <input type="text" class="form-control " name="name" value="{{ Auth::user()->name }}"
                                                                                                       placeholder="Full Name" required>

                                                                                                @error('name')
                                                                                                <span class="invalid-feedback" role="alert">
                                                                                                  <strong>{{ $message }}</strong></span>
                                                                                                @enderror

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>


                                                                                    <div class="row mt-2">
                                                                                        <div class="col-sm-12">
                                                                                            <label class="text-uppercase">البريد الالكترونى : <span class="required"> *</span></label>
                                                                                            <div class="form-group">
                                                                                                <input type="email" class="form-control " name="email" value="{{ Auth::user()->email }}"
                                                                                                       placeholder="email" required>

                                                                                                @error('email')
                                                                                                <span class="invalid-feedback" role="alert">
                                                                                                 <strong>{{ $message }}</strong></span>
                                                                                                @enderror

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mt-2">
                                                                                        <div class="col-sm-12">
                                                                                            <label class="text-uppercase">التليفون :</label>
                                                                                            <div class="form-group">
                                                                                                <input type="text" class="form-control " name="phone"
                                                                                                       value="@if( Auth::user()->phone){{ Auth::user()->phone }} @else Not Available @endif"
                                                                                                       placeholder="phone" >
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="mt-2">
                                                                                        <button type="submit"  class="btn btn-info">تحديث</button>
                                                                                        <button type="reset"  class="btn btn-danger" >إلغاء</button>

                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>





                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3 d-none" id="updateDetails">

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- END MAIN CONTENT -->

    <script type="text/javascript">
        function readURL(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>



@endsection

