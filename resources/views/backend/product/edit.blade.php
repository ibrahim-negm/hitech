@extends('backend.layouts.admin_master')
@section('title-content')  تعديل منتج - هاى تك للتقسيط @endsection


@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large "> تعديل منتج</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.approved.status.products') }}" style="font-family:'Cairo', sans-serif; font-size: small ">المنتجات</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small "> تعديل منتج {{ $product->product_name}} </li>
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

                            <div class="card-header">

                                <h4 class="card-title" style="font-family:'Cairo', sans-serif; font-size: large; color: maroon ">تحديث البيانات</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-content collapse show">
                                @include('alerts.success')
                                @include('alerts.errors')
                                <div class="card-body card-dashboard">
                                    <form action="{{ route('admin.update.product_data',$product->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <span class="text-danger">*  هذه الحقول مطلوبة</span>
                                        <div class="modal-body pd-20">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> اسم المنتج <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder=" اسم المنتج " name="product_name" value="{{ $product->product_name }}" required>

                                                        @error('product_name')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">اسم الخدمة<span class="text-danger"> * </span></label>
                                                        <select class="form-control  @error('service_id') is-invalid @enderror" name="service_id"
                                                                data-placeholder="اسم الخدمة" required>
                                                            <option label="اسم الخدمة" selected="" disabled=""></option>
                                                            @foreach($services as $service)
                                                                <option value="{{$service->id}}" @if( $service->id == $product->service_id) selected @endif >{{ $service->service_name }} </option>
                                                            @endforeach
                                                        </select>

                                                        @error('service_id')
                                                        <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">  اسم القسم الرئيسى<span class="text-danger"> * </span></label>
                                                        <select class="form-control  @error('category_id') is-invalid @enderror" name="category_id"
                                                                data-placeholder="أختر القسم الرئيسى" required>
                                                            <option label="أختر القسم الرئيسى" selected="" disabled=""></option>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                        @if($category->id == $product->category_id) selected @endif >
                                                                    {{ $category->category_name }} </option>
                                                            @endforeach
                                                        </select>

                                                        @error('category_id')
                                                        <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> اسم القسم الفرعى<span class="text-danger"> * </span></label>
                                                        <select class="form-control  @error('subcategory_id') is-invalid @enderror"
                                                                data-placeholder="أختر القسم الفرعى" name="subcategory_id" required>
                                                            <option label="أختر القسم الفرعى" selected="" disabled=""></option>
                                                            @foreach($subCategories as $subcategory)
                                                                <option value=" {{ $subcategory->id }}"
                                                                        @if($subcategory->id == $product->subcategory_id) selected @endif>{{ $subcategory->subcategory_name }} </option>

                                                            @endforeach

                                                        </select>
                                                        @error('subcategory_id')
                                                        <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">اسم القسم الفرعى -> الفرعى</label>
                                                        <select class="form-control  @error('subsubcategory_id') is-invalid @enderror"
                                                                data-placeholder="اسم القسم الفرعى -> الفرعى" name="subsubcategory_id" >
                                                            <option label="اسم القسم الفرعى -> الفرعى" selected="" disabled=""></option>
                                                            @foreach($subsubCategories as $subsubcategory)
                                                                <option value=" {{ $subsubcategory->id }}"
                                                                        @if($subsubcategory->id == $product->subsubcategory_id) selected @endif>{{ $subsubcategory->subsubcategory_name }} </option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> اسم شركاء النجاح او التوكيل<span class="text-danger"> * </span></label>
                                                        <select class="form-control" name="brand_id" data-placeholder="اسم شركاء النجاح او التوكيل" required>
                                                            <option label="اسم شركاء النجاح" selected="" disabled=""></option>
                                                            @if(Auth::user()->permission->type == 3)
                                                                <option value="{{Auth::user()->brand->id }}" selected>{{ Auth::user()->brand->brand_name }} </option>

                                                            @else
                                                                @foreach($brands as $brand)
                                                                    <option value="{{ $brand->id }}"
                                                                            @if($brand->id == $product->brand_id) selected  @endif
                                                                    >{{ $brand->brand_name }} </option>
                                                                @endforeach
                                                           @endif
                                                        </select>
                                                        @error('brand_id')
                                                        <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong></span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">كمية المنتج <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control @error('product_quantity') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="كمية المنتج" name="product_quantity" required value="{{ $product->product_quantity }}">

                                                        @error('product_quantity')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                                <?php
                                                $default_sizes= array('3XL','2XL','XL','L','M','S','XS','XXS','1','2','3','4',
                                                    '5','6','7','8','9','10','11','12','13','14', '15','16','17','18','19','20','21','22','23','24',
                                                    '25','26','27','28','29','30','31','32','33','34', '35','36','37','38','39','40','41','42','43','44',
                                                    '45','46','47','48','3/4','4/5','5/6','6/7','7/8','8/9','9/10','10/11','11/12','12/13','13/14',
                                                    '1X','2X','3X','4X','5X','6X','7X','8X','9X','10X','11X','12X','6-9','9-12','12-18','18-24','2-3',
                                                    '3-4','4-5','5-6','6-7','7-8','8-9','9-10','10-11','11-12','12-13','13-14'
                                                    ,'90 X 195','100 X 190','100 X 195','110 X 195','120 X 190','120 X 195','120 X 200','140 X 195',
                                                    '150 X 195','150 X 200','160 X 190','160 X 195','160 X 200','170 X 195','170 X 200','180 X 195',
                                                    '180 X 200','200 X 200',
                                                );


                                                $Products_sizes = array();
                                                foreach(explode(',',$product->product_size) as $key =>$size){
                                                    $Products_sizes[]=$size;
                                                }
                                                ?>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">مقاس المنتج </label><br>
                                                        <select class="select2 form-control @error('product_size') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"  multiple="multiple" name="product_size[]" >

                                                            @foreach($default_sizes as $size)
                                                                <option value="{{$size}}" @if(in_array($size,$Products_sizes)) )  selected @endif>{{$size}}</option>
                                                            @endforeach

                                                        </select>



                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">سعر بيع المنتج <span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control @error('selling_price') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="سعر بيع المنتج" name="selling_price" value="{{ $product->selling_price }}" required>


                                                        @error('selling_price')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">سعر البيع بعد الخصم </label>
                                                        <input type="text" class="form-control @error('discount_price') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="سعر البيع بعد الخصم" name="discount_price" value="{{ $product->discount_price }}">

                                                        @error('discount_price')
                                                        <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong></span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">وزن المنتج </label>
                                                        <input type="text" class="form-control @error('product_capacity') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="وزن المنتج" name="product_capacity" value="{{ $product->product_capacity }}" >

                                                        @error('product_capacity')
                                                        <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> كود المنتج</label>
                                                        <input type="text" class="form-control @error('product_code') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="كود المنتج" name="product_code" value="{{$product->product_code}}">

                                                        @error('product_code')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">بلد الصناعة </label>
                                                        <input type="text" class="form-control @error('manufacture') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="بلد الصناعة " name="manufacture" value="{{$product->manufacture}}" >

                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">عدد مرات الزيارة </label>
                                                        <input type="text" class="form-control @error('viewed') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="عدد مرات الزيارة" name="viewed" value="{{$product->viewed}}">

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> نبذة مصغرة عن المنتج <span class="text-danger"> أقصى عدد للحروف 250 حرف </span></label>
                                                        <textarea type="text" class="form-control @error('product_short_detail') is-invalid @enderror"  aria-describedby="emailHelp"
                                                                  name="product_short_detail" rows="6">{{ $product->product_short_detail }}</textarea>

                                                        @error('product_short_detail')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">تفاصيل المنتج </label>
                                                        <textarea type="text" class="form-control @error('product_long_detail') is-invalid @enderror"  id="editor1" aria-describedby="emailHelp"
                                                                  name="product_long_detail" rows="6" >{{$product->product_long_detail}}</textarea>

                                                        @error('product_long_detail')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">الكلمات الاسترشادية <span class="text-danger"> *  هذا الحقل يقضل ان يكون به كلمات البحث الخاص بالمنتج والا تزيد عن ثلاث كلمات</span></label>
                                                        <input type="text" class="input-selectize @error('product_tags') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="product_tags[]"  value="{{ $product->product_tags }}" required>

                                                        @error('product_tags')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror


                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">الخامة</label>
                                                        <input type="text" class="form-control @error('product_material') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               placeholder="الخامة" name="product_material" value="{{ $product->product_material }}" >



                                                    </div>
                                                </div>

                                            <?php
                                            $default_colors= array('white','brown','beige','black','red','blue','grey','cyan','green','yellow','lemon','marine',
                                                'orange','bronze','sliver','gold','violet','turquoise','purple','pink','mint');


                                            $Products_colors = array();
                                            foreach(explode(',',$product->product_color) as $key =>$color){
                                                $Products_colors[]=$color;
                                            }
                                            ?>

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">لون المنتج  </label><br>
                                                        <select class="select2 form-control @error('product_color') is-invalid @enderror" id="exampleInputEmail1"
                                                                aria-describedby="emailHelp"  multiple="multiple" name="product_color[]">
                                                            @foreach($default_colors as $color)
                                                                <option value="{{$color}}" @if(in_array($color,$Products_colors)) )  selected @endif>{{$color}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                </div>
                                            </div>



                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-info pd-x-20" > تحديث بيانات منتج <i class="ft-thumbs-up position-right"></i></button>


                                            </div>


                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header">
                                <h4 class="card-title" style="font-family:'Cairo', sans-serif; font-size: large; color: maroon ">تحديث الصور </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form action="{{ route('admin.update.product_image',$product->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body pd-20">



                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">الصورة الرئيسية</label>
                                                        <input type="file" class="form-control @error('main_image') is-invalid @enderror" id="file" aria-describedby="emailHelp"
                                                               name="main_image" onchange="readURL(this);" >
                                                        <small>حجم الصورة لايزيد عن 500 كيلو .يفضل عرض الصورة ان تكون 900 والطول 1057.</small>
                                                        <br><br>
                                                            <img src="{{ asset('upload/products/'. $product->main_image ) }}" style="width: 150px; height: 175px" id="one">

                                                        @error('main_image')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                @foreach($product_images as $key => $image)
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">الصور الصغيرة</label>
                                                        <input type="file" class="form-control @error('thumbnail_images') is-invalid @enderror" id="file" aria-describedby="emailHelp"
                                                               name="thumbnail_images[{{ $image->id }}]" onchange="change{{$key}}(this);" >
                                                        <small>حجم الصورة لايزيد عن 500 كيلو .يفضل عرض الصورة ان تكون 900 والطول 1057.</small>
                                                        <br><br>

                                                                <img src="{{ asset('upload/products/'. $image->image ) }}" style="width: 150px; height: 175px"  id="image_{{$key}}"><br><br>
                                                                <a href="{{ route('admin.delete.product_image',$image->id) }}" class="btn btn-sm btn-danger" id="delete" title="حذف صورة"><i class="ft ft-trash-2"></i></a>

                                                            </div>



                                                        @error('thumbnail_images')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                        @enderror
                                                </div>
                                                    @endforeach



                                            </div>
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">أضافة صور صغيرة أخرى </label>
                                                    <input type="file" class="form-control @error('add_thumbnail_images') is-invalid @enderror"  aria-describedby="emailHelp"
                                                           name="add_thumbnail_images[]" onchange="readURL1(this);"  multiple>
                                                    <small>العدد الاقصى للصور 3. حجم الصورة لايزيد عن 500 كيلو .يفضل عرض الصورة ان تكون 900 والطول 1057.</small>

                                                    @error('add_thumbnail_images')
                                                    <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong></span>
                                                    @enderror

                                                    <br><br>
                                                    <div class="row">

                                                        <div class="col-lg-4"><img src="" id="one_1"></div>
                                                        <div class="col-lg-4"><img src="" id="two_2"></div>
                                                        <div class="col-lg-4"><img src="" id="three_3"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-info pd-x-20" > تحديث صور المنتج <i class="ft-thumbs-up position-right"></i></button>


                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->permission->type == 3)
                @else
                @if(count($product_installments) > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header">
                                <h4 class="card-title" style="font-family:'Cairo', sans-serif; font-size: large; color: maroon ">تحديث أقساط المنتج </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form action="{{ route('admin.update.product_installment',$product->id) }}" method="POST" >
                                        @csrf
                                        <div class="modal-body pd-20">

                                            @foreach($product_installments as $installment)
                                                <input  type="hidden" name="installments[{{ $installment->id }}]">
                                            @endforeach


                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> قسط على 6 اشهر</label>
                                                        <input type="text" class="form-control @error('months_6') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="months_6" value="6" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> مقدم القسط</label>
                                                        <input type="text" class="form-control @error('deposit_6') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="deposit_6" placeholder="مقدم القسط" value="{{ $product_installments[0]->deposit }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> القسط الشهرى</label>
                                                        <input type="text" class="form-control @error('installment_6') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="installment_6" placeholder="القسط الشهرى" value="{{ $product_installments[0]->installment }}">
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> قسط على 12 شهر</label>
                                                        <input type="text" class="form-control @error('months_12') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="months_12" value="12" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> مقدم القسط</label>
                                                        <input type="text" class="form-control @error('deposit_12') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="deposit_12" placeholder="مقدم القسط" value="{{ $product_installments[1]->deposit }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> القسط الشهرى</label>
                                                        <input type="text" class="form-control @error('installment_12') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="installment_12" placeholder="القسط الشهرى" value="{{ $product_installments[1]->installment }}">
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> قسط على 18 شهر</label>
                                                        <input type="text" class="form-control @error('months_18') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="months_18" value="18" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> مقدم القسط</label>
                                                        <input type="text" class="form-control @error('deposit_18') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="deposit_18" placeholder="مقدم القسط" value="{{ $product_installments[2]->deposit }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> القسط الشهرى</label>
                                                        <input type="text" class="form-control @error('installment_18') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="installment_18" placeholder="القسط الشهرى" value="{{ $product_installments[2]->installment }}">
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> قسط على 24 شهر</label>
                                                        <input type="text" class="form-control @error('months_24') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="months_24" value="24" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> مقدم القسط</label>
                                                        <input type="text" class="form-control @error('deposit_24') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="deposit_24" placeholder="مقدم القسط" value="{{ $product_installments[3]->deposit }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"> القسط الشهرى</label>
                                                        <input type="text" class="form-control @error('installment_24') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                               name="installment_24" placeholder="القسط الشهرى" value="{{ $product_installments[3]->installment }}">
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-info pd-x-20" > تحديث  أقساط المنتج <i class="ft-thumbs-up position-right"></i></button>


                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endif
            </section>


        </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('backend/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('backend/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/vendors/js/ui/headroom.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="{{ asset('backend/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/scripts/customizer.js') }}" type="text/javascript"></script>
    {{--<!-- END MODERN JS-->--}}
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('backend/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>


    <!-- END PAGE LEVEL JS-->

    <!-- to fetch all subcategories by category name -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('select[name="category_id"]').on('change',function(){
                var category_id = $(this).val();
                if (category_id) {

                    $.ajax({
                        url: "{{ url('/get/subcategory/') }}/"+category_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            var d =$('select[name="subcategory_id"]').empty();
                            var s =$('select[name="subsubcategory_id"]').empty();

                            $.each(data, function(key, value){

                                $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');

                            });
                        },
                    });

                }else{
                    alert('هذا القسم غير موجود');
                }

            });
        });

    </script>


    <!-- to fetch all sunsubcategories by subcategory name -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('select[name="subcategory_id"]').on('change',function(){
                var subcategory_id = $(this).val();
                if (subcategory_id) {

                    $.ajax({
                        url: "{{ url('/get/subsubcategory/') }}/"+subcategory_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            var d =$('select[name="subsubcategory_id"]').empty();

                            $.each(data, function(key, value){

                                $('select[name="subsubcategory_id"]').append('<option value="'+ value.id + '">' + value.subsubcategory_name + '</option>');

                            });
                        },
                    });

                }else{
                    alert('هذا القسم غير موجود');
                }

            });
        });

    </script>
{{--لاءضهار الصور الرئيسية عند تغيرها--}}
    <script type="text/javascript">
        function readURL(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(160);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

{{--//لاضهار الصور الصغيرة المحملة سابقا عند تغيرها --}}
    @foreach($product_images as $key => $image)
        <script type="text/javascript">
            function change{{$key}}(input){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image_{{$key}}')
                            .attr('src', e.target.result)
                            .width(150)
                            .height(160);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endforeach
{{--لاظهار الصور الجديدة الصغيرة--}}
    <script type="text/javascript">
        function readURL1(input){
            if (input.files && input.files[0]) {
                var reader_1 = new FileReader();
                reader_1.onload = function(e) {
                    $('#one_1')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(160);
                };
                reader_1.readAsDataURL(input.files[0]);
            }

            if (input.files && input.files[1]) {
                var reader_2 = new FileReader();
                reader_2.onload = function(e) {
                    $('#two_2')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(160);
                };
                reader_2.readAsDataURL(input.files[1]);
            }

            if (input.files && input.files[2]) {
                var reader_3 = new FileReader();
                reader_3.onload = function(e) {
                    $('#three_3')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(160);
                };
                reader_3.readAsDataURL(input.files[2]);
            }
        }
    </script>
@endsection