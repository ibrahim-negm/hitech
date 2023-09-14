@extends('admin.admin_master')
@section('title-content')  عرض أراء العملاء - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">عرض المراجعة</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.review') }}" style="font-family:'Cairo', sans-serif; font-size: small"> أراء العملاء </a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small"> المراجعة على
                                @if($review->product)
                                {{ $review->product->product_name}}
                                @else
                                @endif
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

                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="card">
                                                <div class="card-header "> <strong>تفاصيل المراجعة</strong> </div>

                                                <div class="card-body table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th> إسم صاحب المراجعة : </th>
                                                            <td style="color: maroon"> {{ ($review->user) ?  $review->user->name : 'غير معرف'}} </td>
                                                        </tr>

                                                        <tr>
                                                            <th> رقم التليفون : </th>
                                                            <td style="color: maroon"> {{  ($review->user) ? $review->user->phone : 'غير معرف'}}</td>
                                                        </tr>

                                                        <tr>
                                                            <th> البريد الالكترونى : </th>
                                                            <td style="color: maroon"> {{  ($review->user) ? $review->user->email :  'غير معرف'}} </td>
                                                        </tr>


                                                        <tr>
                                                            <th> المنتج : </th>
                                                            <td style="color: maroon">
                                                                @if($review->product) <a href=" {{ route('product.details',$review->product->slug) }} " target="_blank"> {{ $review->product->product_name}} </a> @else لايوجد منتج @endif
                                                            </td>

                                                        </tr>

                                                        <tr>
                                                            <th> راى العميل : </th>
                                                            <td>
                                                                <textarea name="" id="" cols="40"
                                                                          rows="10" style="word-wrap: break-word; color: maroon ;" disabled>{{ $review->description }}</textarea>

                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <th> التقييم : </th>
                                                            <td style="color: orange">
                                                                @for($i=0; $i<$review->rate ; $i++)
                                                                    <i class="ft ft-star"></i>
                                                                @endfor


                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th> التاريخ : </th>
                                                            @php
                                                                $timestamp = strtotime($review->created_at);
                                                                $date = date('F j, Y, g:i a',$timestamp)
                                                            @endphp
                                                            <td style="color: maroon"> {{ $date }} </td>
                                                        </tr>

                                                    </table>


                                                </div>



                                            </div>
                                        </div>



                                        <div class="col-md-5">
                                            <div class="card">
                                                <div class="card-header"><strong>صورة المنتج</strong> </div>
                                                <div class="card-body table-responsive">
                                                    <table class="table">
                                                        <tr>

                                                            <td>

                                                                @if($review->product)  <img src="{{ asset('upload/products/'.$review->product->main_image) }}"  style="width: 300px; height: 360px" alt=""> @else لا توجد صورة @endif

                                                            </td>
                                                        </tr>

                                                    </table>
                                                </div>

                                            </div>
                                        </div>


                                     </div>


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