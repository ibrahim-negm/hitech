@extends('backend.layouts.admin_master')
@section('title-content')  اراء العملاء - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large ">تعليقات العملاء </h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.review') }}" style="font-family:'Cairo', sans-serif; font-size: small "> أراء العملاء</a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small ">عرض الكل
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
                                <div class="float-right">
                                    <a href="{{ route('admin.review') }}" class="btn btn-sm btn-blue-grey  ml-1" style="float: right;" > الكل</a>
                                    <a href="{{ route('admin.new.review') }}" class="btn btn-sm btn-warning  ml-1" style="float: right;" > تقييم جديد</a>
                                    <a href="{{ route('admin.read.review') }}" class="btn btn-sm btn-primary  ml-1" style="float: right;" >تقييم تم قرائته</a>

                                </div>
                            </div>
                            <br>
                            @include('alerts.success')
                            @include('alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                        <tr>

                                            <th>اسم المستخدم</th>
                                            <th>البريد الالكترونى</th>
                                            <th> صورة المنتج</th>
                                            <th>التاريخ</th>
                                            <th width="20%">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($reviews as $key =>$row)
                                            <tr>

                                                <td>{{ ($row->user) ?  $row->user->name  : 'لايوجد معلومات' }}
                                                    <br>
                                                    @if($row->status == 0 )
                                                    <span class="badge badge-warning">جديد</span>
                                                    @else
                                                        <span class="badge badge-primary">تم قرائته</span>
                                                    @endif

                                                </td>
                                                <th>@if ($row->user && $row->product ) <a href="  {{ route('product.details',$row->product->slug) }} " target="_blank"> {{$row->user->email}}   </a> @else لا توجد معلومات @endif  </th>
                                                 <td>@if($row->product) <a href=" {{ route('admin.show.product',$row->product->id) }} "><img  src="{{ asset('upload/products/'.$row->product->main_image) }}" style="width: 85px ; height: 100px"> </a> @else لايوجد منتج @endif </td>

                                                @php
                                                $timestamp = strtotime($row->created_at);
                                                $date = date('F j, Y',$timestamp)
                                                @endphp

                                                <td>{{$date}} </td>
                                                <td>
                                                    <a href="{{ url('admin/show/review/'.$row->id) }}" class="btn btn-sm btn-info" >عرض</a>
                                                    <a href="{{ url('admin/delete/review/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">حــذف</a>

                                                </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                        <tr>

                                            <th>اسم المستخدم</th>
                                            <th>البريد الالكترونى</th>
                                            <th>عنوان المنشور</th>
                                            <th>التاريخ</th>
                                            <th width="20%">Action</th>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{--//  {{ $categories->links() }}--}}
            <!-- ########## END: MAIN PANEL ########## -->



            </section>


        </div>
    </div>


@endsection