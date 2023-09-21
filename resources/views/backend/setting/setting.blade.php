@extends('backend.layouts.admin_master')
@section('title-content')الاعدادات العامة للموقع - هاى تك للتقسيط  @endsection
<link href="{{ asset('backend/lib/summernote/summernote-bs4.css') }}" rel="stylesheet">
@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large ">الاعدادات العامة للموقع</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.setting') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الاعدادات العامة للموقع</a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
        @include('alerts.success')
        @include('alerts.errors')
            <!-- Zero configuration table -->
            <section id="configuration">
                <form action="{{ route('admin.update.setting') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header" style="padding-bottom: 1px;"> <span class="text-warning" style="font-family:'Cairo', sans-serif; font-size: large ">إعدادات الموقع</span></div>

                               <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                        <input type="hidden" name="id" value="{{$setting->id}}">
                                        <div class="modal-body pd-20">

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> اسم المتجر<span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control @error('shop_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="اسم المتجر" name="shop_name" value="{{ $setting->shop_name }}" required>

                                                        @error('shop_name')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">البريد الالكترونى<span class="text-danger"> * </span></label>
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="البريد الالكترونى" name="email" value="{{ $setting->email }}" required>

                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">التليفون<span class="text-danger"> * </span></label>
                                                        <textarea id="editor1" type="text" class="form-control @error('phone') is-invalid @enderror" id="summernote" aria-describedby="emailHelp"
                                                                  placeholder="التليفون" name="phone" value="" required>  {{ $setting->phone }}   </textarea>

                                                        @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">عنوان الشركة<span class="text-danger"> * </span></label>
                                                        <textarea id="editor2" type="text" class="form-control @error('address') is-invalid @enderror" id="summernote1" aria-describedby="emailHelp"
                                                                  placeholder="عنوان الشركة" name="address" required> {{ $setting->address }} </textarea>

                                                        @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> اللوجو الكبير</label>
                                                        <input type="file" class="form-control @error('logo_dark') is-invalid @enderror" id="file" aria-describedby="emailHelp"
                                                               name="logo_dark" onchange="readURL1(this);" >
                                                        <small> الصورة لا تتجاوز 100 كيلو - العرض يفضل ان يكون 258 والارتفاع 75</small>
                                                        <br><br>
                                                        <div class="text-center">
                                                        @if($setting->logo_dark)
                                                            <img src="{{ asset('upload/'.$setting->logo_dark ) }}" id="one">
                                                        @else
                                                            <img src="" id="one">
                                                        @endif
                                                        </div>
                                                        @error('logo_dark')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> اللوجو الصغير</label>
                                                        <input type="file" class="form-control @error('logo_light') is-invalid @enderror" id="file" aria-describedby="emailHelp"
                                                               name="logo_light" onchange="readURL2(this);" >
                                                        <small> الصورة لا تتجاوز 100 كيلو - العرض يفضل ان يكون 258 والارتفاع 75</small>
                                                        <br><br>
                                                        <div class="text-center">
                                                        @if($setting->logo_light)
                                                            <img src="{{ asset('upload/'.$setting->logo_light ) }}" id="two">
                                                        @else
                                                            <img src="" id="two">
                                                        @endif
                                                        </div>
                                                        @error('logo_light')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror

                                                    </div>
                                                </div>


                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">الشعار المصغر</label>
                                                        <input type="file" class="form-control @error('favicon') is-invalid @enderror" id="file" aria-describedby="emailHelp"
                                                               name="favicon" onchange="readURL3(this);" >
                                                        <small> الصورة لا تتجاوز 20 كيلو - العرض يفضل ان يكون 50 والارتفاع 50</small>
                                                        <br> <br>
                                                        <div class="text-center">
                                                        @if($setting->favicon)
                                                            <img src="{{ asset('upload/'.$setting->favicon ) }}" id="three">
                                                        @else
                                                            <img src="" id="three">
                                                        @endif
                                                        </div>
                                                        @error('favicon')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror

                                                    </div>
                                                </div>



                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">عدد الموظفين</label>
                                                        <input type="text" class="form-control @error('employees') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="employees" value="{{$setting->employees}}">

                                                        @error('employees')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">عدد المنتجات</label>
                                                        <input type="text" class="form-control @error('products') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="products" value="{{$setting->products}}">

                                                        @error('products')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">عدد العملاء </label>
                                                        <input type="text" class="form-control @error('clients') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="clients" value="{{$setting->clients}}">

                                                        @error('clients')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">عدد الفروع </label>
                                                        <input type="text" class="form-control @error('branches') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="branches" value="{{$setting->branches}}">

                                                        @error('branches')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>


                                            </div>


                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header" style="padding-bottom: 1px;"> <span class="text-warning" style="font-family:'Cairo', sans-serif; font-size: large ">صفحات التواصل</span></div>

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                        <div class="modal-body pd-20">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Facebook</label>
                                                        <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="Facebook" name="facebook" value="{{ $setting->facebook }}" required>

                                                        @error('facebook')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Twitter</label>
                                                        <input type="text" class="form-control @error('twitter') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="Twitter" name="twitter" value="{{ $setting->twitter }}" required>

                                                        @error('twitter')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Youtube</label>
                                                        <input type="text" class="form-control @error('youtube') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="Youtube" name="youtube" value="{{ $setting->youtube }}" required>

                                                        @error('youtube')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Instagram</label>
                                                        <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="Instagram" name="instagram" value="{{ $setting->instagram }}" required>

                                                        @error('instagram')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">حساب الواتس اب</label>
                                                        <input type="text" class="form-control @error('whatsup') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                name="whatsup" value="{{ $setting->whatsup }}" placeholder="like ->   https://wa.me/201224194220" required>

                                                        @error('whatsup')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>


                                        </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-header" style="padding-bottom: 1px;"> <span class="text-warning" style="font-family:'Cairo', sans-serif; font-size: large ">أعدادات المنتجات </span></div>

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <div class="modal-body pd-20">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">ضريبة القيمة المضافة</label>
                                                        <input type="text" class="form-control @error('vat') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="vat" name="vat" value="{{ $setting->vat }}" required>

                                                        @error('vat')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">  اسم المحافظة الرئيسية<span class="text-danger"> * </span></label>
                                                        <select class="form-control  @error('city_shipping') is-invalid @enderror" name="city_shipping"
                                                                data-placeholder="اسم المحافظة الرئيسية" required>
                                                            <option label="اسم المحافظة الرئيسية" selected="" disabled=""></option>
                                                            @foreach($governorates as $gov)
                                                                <option value="{{ $gov->id }}" @if($gov->id == $setting->city_shipping) selected @endif >{{ $gov->governorate }} </option>
                                                            @endforeach
                                                        </select>

                                                        @error('city_shipping')
                                                        <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">قيمة الشحن الافتراضية</label>
                                                        <input type="text" class="form-control @error('shipping_charge') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="shipping_charge" name="shipping_charge" value="{{ $setting->shipping_charge }}" required>

                                                        @error('shipping_charge')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">  تاريخ انتهاء صفقة اليوم&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>     &nbsp;التاريخ الحالى :

                                                        <span class="text-danger">{{ date('d-m-y',strtotime($setting->deal_timer)) }}</span>
                                                        <input type="date" class="form-control @error('youtube') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="deal_timer" name="deal_timer" >

                                                        @error('deal_timer')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>



                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20" > تحديث بيانات الموقع <i class="ft-thumbs-up position-right"></i></button>


                    </div>
                </form>
                <!-- LARGE MODAL -->



            </section>


        </div>
    </div>


    <script type="text/javascript">
        function readURL1(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(182)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script type="text/javascript">
        function readURL2(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#two')
                        .attr('src', e.target.result)
                        .width(182)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script type="text/javascript">
        function readURL3(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#three')
                        .attr('src', e.target.result)
                        .width(30)
                        .height(30);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>




@endsection