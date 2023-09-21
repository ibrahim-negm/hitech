@extends('backend.layouts.admin_master')
@section('title-content') المنتجات - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">المنتجات</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.approved.status.products') }}" style="font-family:'Cairo', sans-serif; font-size: small">المنتجات</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small">عرض الكل
                            </li>
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
                                <div class="float-left"> <a href="{{ route('admin.create_product') }}" class="btn btn-sm btn-warning" style="float: right;"> اضافة منتج</a></div>
                                <div class="float-right">
                                    <a href="{{ route('admin.approved.status.products') }}" class="btn btn-sm btn-blue-grey  ml-1" style="float: right;" > منتجات مصدق عليها وفعالة</a>
                                    <a href="{{ route('admin.status.products') }}" class="btn btn-sm btn-info  ml-1" style="float: right;" > منتجات فعالة فقط</a>
                                   <a href="{{ route('admin.approved.products') }}" class="btn btn-sm btn-success  mr-1 ml-1" style="float: right;"> منتجات مصدق عليها فقط</a>
                                    <a href="{{ route('admin.none.approved.status.products') }}" class="btn btn-sm btn-danger  mr-1 ml-1" style="float: right;"> منتجات غير مصدق عليها وغير مفعلة </a>

                                </div>


                            </div>
                            @include('alerts.success')
                            @include('alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                        <tr>
                                            {{--<th width="5%">No</th>--}}
                                            <th width="5%">تصديق</th>
                                            <th width="15%">اسم المنتج</th>
                                            <th width="5%" >القسم الرئيسى</th>
                                            <th width="5%">الصورة</th>
                                            {{--<th width="5%">العدد</th>--}}
                                            <th width="5%">الحالة</th>
                                            <th width="30%">Action</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $key=>$product)
                                            <tr>
                                                {{--<td>{{$key +1 }}</td>--}}
                                                <td>
                                                    @if($product->approved == 1)
                                                        <a href="{{ route('admin.unapproved.product',$product->id)  }}" class="btn btn-sm btn-danger" title="غير مصدق"><i class="ft ft-arrow-down"></i></a>
                                                    @else
                                                        <a href="{{ route('admin.approved.product',$product->id)  }}" class="btn btn-sm btn-success"title="مصدق"><i class="ft ft-arrow-up"></i></a>
                                                    @endif
                                                </td>

                                                <td><a href="{{ route('product.details',$product->slug) }}" target="_blank">
                                                    {{$product->product_name}}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if( $product->category==null)
                                                        لايوجد
                                                    @else
                                                        {{ $product->category->category_name }}
                                                    @endif


                                                </td>

                                                <td><img src="{{ asset('upload/products/'.$product->main_image) }}"  style="width: 90px; height: 100px" alt=""></td>

                                                {{--<td>{{ $product->product_quantity }}</td>--}}
                                                <td>
                                                    @if($product->status == 1)
                                                        <span class="badge badge-success"> فعال</span>
                                                        @else
                                                        <span class="badge badge-danger">غير فعال</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.show.product',$product->id)  }}" class="btn btn-sm btn-warning"title="رؤية"><i class="ft ft-eye"></i></a>

                                                    @if($product->status == 1)
                                                        <a href="{{ route('admin.inactive.product',$product->id)  }}" class="btn btn-sm btn-danger" title="غير فعال"><i class="ft ft-thumbs-down"></i></a>
                                                    @else
                                                        <a href="{{ route('admin.active.product',$product->id)  }}" class="btn btn-sm btn-success"title="فعال"><i class="ft ft-thumbs-up"></i></a>
                                                    @endif
                                                    <a href="{{ route('admin.edit.product',$product->id)  }}" class="btn btn-sm btn-info"title="تعديل"><i class="ft ft-edit"></i></a>

                                                    <a href="{{ route('admin.delete.product',$product->id) }}" class="btn btn-sm btn-danger" id="delete" title="حذف"><i class="ft ft-trash-2"></i></a>

                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            {{--<th width="5%">No</th>--}}
                                            <th width="5%">تصديق</th>
                                            <th width="15%">اسم المنتج</th>
                                            <th width="5%" >القسم الرئيسى</th>


                                            <th width="5%">الصورة</th>
                                            {{--<th width="5%">العدد</th>--}}
                                            <th width="5%">الحالة</th>
                                            <th width="30%">Action</th>

                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ########## END: MAIN PANEL ########## -->

            </section>

        </div>
    </div>


@endsection