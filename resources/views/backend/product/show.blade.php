@extends('admin.admin_master')
@section('title-content')عرض المنتج - هاى تك للتقسيط@endsection

@section('admin-content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large "> عرض منتج</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.approved.status.products') }}" style="font-family:'Cairo', sans-serif; font-size: small ">المنتجات</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small "> عرض منتج {{ $product-> product_name }} </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <!-- Zero configuration table -->
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                        <div class="modal-body pd-20">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon"> اسم المنتج</label><br>
                                                       <strong>{{ $product -> product_name }}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon"> كود المنتج</label><br>
                                                        <strong>
                                                            @if( $product -> product_code == null)
                                                                لايوجد
                                                            @else
                                                                {{ $product -> product_code }}

                                                            @endif

                                                        </strong>

                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" style="color: maroon">أسم الخدمة</label><br>
                                                    <strong>
                                                        @if( $product -> service == null)
                                                            لايوجد
                                                        @else
                                                            {{ $product -> service->service_name }}

                                                        @endif

                                                    </strong>

                                                </div>
                                            </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">  اسم القسم الرئيسى</label><br>
                                                             <strong>
                                                                 @if($product->category == null)
                                                                     لايوجد
                                                                 @else
                                                                     {{ $product->category->category_name }}

                                                                 @endif
                                                             </strong>

                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">اسم القسم الفرعى</label><br>
                                                        <strong>
                                                            @if($product->subcategory == null)
                                                                لايوجد
                                                            @else
                                                                {{ $product->subcategory->subcategory_name }}

                                                            @endif
                                                        </strong>


                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">اسم القسم الفرعى -> الفرعى</label><br>
                                                        <strong>
                                                            @if(empty($product->subsubcategory))
                                                                <strong> لايوجد </strong>
                                                            @else
                                                                <strong>{{ $product->subsubcategory->subsubcategory_name }}</strong>
                                                            @endif
                                                            </strong>


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">كمية المنتج </label><br>
                                                       <strong>{{ $product->product_quantity }}</strong>

                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">لون المنتج  </label><br>
                                                        <strong>
                                                            @if(empty($product->product_color))
                                                                <strong> لايوجد </strong>
                                                            @else
                                                                {{ $product->product_color }}
                                                            @endif
                                                        </strong>



                                                    </div>

                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">مقاس المنتج </label><br>
                                                        <strong>
                                                            @if(empty($product->product_size))
                                                                <strong> لايوجد </strong>
                                                            @else
                                                                @foreach(explode(',',$product->product_size) as $key =>$size)
                                                                    <span class="badge badge-info badge-lg">{{$size}}</span>
                                                                @endforeach
                                                            @endif
                                                        </strong>



                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">سعر بيع المنتج </label><br>
                                                          <strong>{{ $product->selling_price }}</strong>

                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">سعر البيع بعد الخصم </label><br>
                                                        <strong>
                                                            @if(empty($product->discount_price))
                                                                <strong> لايوجد </strong>
                                                            @else
                                                                <strong>{{ $product->discount_price }}</strong>
                                                            @endif
                                                        </strong>



                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">وزن المنتج </label><br>

                                                        <strong>
                                                            @if(empty($product->product_capacity))
                                                                لايوجد
                                                            @else
                                                               {{ $product->product_capacity }}
                                                            @endif
                                                        </strong>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">اسم الماركات العالمية</label><br>
                                                        <strong>
                                                            @if(empty($product->brand))
                                                                <strong> لايوجد </strong>
                                                            @else
                                                                <strong>{{ $product->brand->brand_name }}</strong>
                                                            @endif
                                                        </strong>


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">نبذة مختصرة عن المنتج</label><br>
                                                        @if(empty($product->product_short_detail))
                                                            <strong> لايوجد </strong>
                                                        @else
                                                         {{ $product->product_short_detail }}
                                                        @endif
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">تفاصيل المنتج </label><br>
                                                        @if(empty($product->product_long_detail))
                                                            <strong> لايوجد </strong>
                                                        @else
                                                            {!!  $product->product_long_detail !!}
                                                        @endif
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">الكلمات الاسترشادية </label><br>
                                                       <strong>{{ $product->product_tags }}</strong>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">الخامة</label><br>

                                                        <strong>
                                                            @if(empty($product->product_material))
                                                                لايوجد
                                                            @else
                                                             {{ $product->product_material }}
                                                            @endif
                                                        </strong>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">الصورة الرئيسية</label> <br>
                                                        @if($product->main_image)
                                                            <img src="{{ asset('upload/products/'. $product->main_image ) }}" style="width: 150px; height: 175px" >
                                                        @endif

                                                    </div>
                                                </div>
                                                @if(count($product_images)>0)
                                                @foreach($product_images as $image)
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="color: maroon">الصورةالصغيرة</label><br>
                                                        <img src="{{ asset('upload/products/'. $image->image ) }}"  style="width: 150px; height: 175px">

                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif

                                            </div>
                                            @if(count($product_installments)>0)
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" style="color: maroon">الاقساط</label><br>

                                                </div>
                                                <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> قسط على </label><br>
                                                        <strong>6 اشهر</strong>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> مقدم القسط</label><br>
                                                              <strong> {{ $product_installments[0]->deposit }} جنيه</strong>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> القسط الشهرى</label><br>
                                                        <strong>{{ $product_installments[0]->installment }} جنيه</strong>
                                                    </div>
                                                </div>


                                            </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> قسط على </label><br>
                                                            <strong>12 شهر</strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> مقدم القسط</label><br>
                                                            <strong> {{ $product_installments[1]->deposit }} جنيه</strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> القسط الشهرى</label><br>
                                                            <strong>{{ $product_installments[1]->installment }} جنيه</strong>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> قسط على </label><br>
                                                            <strong>18 شهر</strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> مقدم القسط</label><br>
                                                            <strong> {{ $product_installments[2]->deposit }} جنيه</strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> القسط الشهرى</label><br>
                                                            <strong>{{ $product_installments[2]->installment }} جنيه</strong>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> قسط على </label><br>
                                                            <strong>24 شهر</strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> مقدم القسط</label><br>
                                                            <strong> {{ $product_installments[3]->deposit }} جنيه</strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> القسط الشهرى</label><br>
                                                            <strong>{{ $product_installments[3]->installment }} جنيه</strong>
                                                        </div>
                                                    </div>


                                                </div>
                                            @endif

                                        </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- LARGE MODAL -->



            </section>


        </div>
    </div>

@endsection
