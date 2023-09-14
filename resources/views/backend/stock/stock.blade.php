@extends('admin.admin_master')
@section('title-content') المخزن - هاى تك للتقسيط@endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">المخزن</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.stock') }}" style="font-family:'Cairo', sans-serif; font-size: small">المخزن</a>
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

                            @include('alerts.success')
                            @include('alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                        <tr>

                                            <th width="20%">اسم المنتج</th>
                                            <th width="15%" >القسم الرئيسى</th>
                                            <th width="10%">الصورة</th>
                                            <th width="10%">العدد</th>
                                            <th width="5%">الحالة</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $key=>$product)
                                            <tr>

                                                <td><a href="{{ route('admin.show.product',$product->id) }}">{{$product->product_name }}</a></td>
                                                <th>{{ $product->category->category_name }}</th>

                                                <td><a href="{{ route('admin.show.product',$product->id) }}"><img src="{{ asset('upload/products/'.$product->main_image) }}"  style="width: 90px; height: 100px" alt=""></a></td>

                                                <th> <span class=" badge badge-danger">{{  $product->product_quantity }}</span></th>
                                                <td>
                                                    @if($product->status == 1)
                                                        <span class="badge badge-success"> فعال</span>
                                                        @else
                                                        <span class="badge badge-danger">غير فعال</span>
                                                    @endif
                                                </td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>

                                            <th>اسم المنتج</th>
                                            <th>القسم الرئيسى</th>
                                            <th>الصورة</th>
                                            <th>العدد</th>
                                            <th>الحالة</th>


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