@extends('admin.admin_master')
@section('title-content')  رسائل العملاء - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large ">رسائل العملاء </h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.message') }}" style="font-family:'Cairo', sans-serif; font-size: small ">رسائل العملاء</a>
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
                                    <a href="{{ route('admin.message') }}" class="btn btn-sm btn-blue-grey  ml-1" style="float: right;" > الكل</a>
                                    <a href="{{ route('admin.new.message') }}" class="btn btn-sm btn-warning  ml-1" style="float: right;" > رسائل جديدة</a>
                                    <a href="{{ route('admin.read.message') }}" class="btn btn-sm btn-primary  ml-1" style="float: right;" >رسائل تم قرائتها</a>
                                    <a href="{{ route('admin.reply.message') }}" class="btn btn-sm btn-success  mr-1 ml-1" style="float: right;">رسائل تم الرد عليها</a>

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
                                            <th>موضوع الرسالة</th>
                                            <th> البريد الالكترونى</th>
                                            <th>التليفون</th>
                                            <th>التاريخ</th>
                                            <th width="20%">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($messages as $key =>$row)
                                            <tr>

                                                <td>{{ $row->name }}
                                                    <br>
                                                    @if($row->status == 0 )
                                                    <span class="badge badge-warning">جديد</span>
                                                @elseif($row->status == 1)
                                                        <span class="badge badge-primary">تم قرائته</span>
                                                 @else
                                                        <span class="badge badge-success">تم الرد</span>
                                                    @endif
                                                </td>
                                                <td>{{str_limit($row->subject,$limit=50)}}</td>
                                                <th>{{ $row->email }}</th>
                                                <td>{{$row->phone}}</td>
                                                <td>{{date("F j, Y",strtotime($row->created_at))}}</td>
                                                <td>
                                                    <a href="{{ url('admin/show/message/'.$row->id) }}" class="btn btn-sm btn-info" >عرض</a>
                                                    <a href="{{ url('admin/delete/message/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">حــذف</a>

                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>

                                            <th>اسم المستخدم</th>
                                            <th>موضوع الرسالة</th>
                                            <th> البريد الالكترونى</th>
                                            <th>التليفون</th>
                                            <th>التاريخ</th>
                                            <th width="20%">Action</th>
                                        </tr>
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