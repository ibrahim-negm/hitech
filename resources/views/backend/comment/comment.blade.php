@extends('admin.admin_master')
@section('title-content') تعليقات العملاء - هاى تك للتقسيط @endsection

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
                            <li class="breadcrumb-item"><a href="{{ route('admin.comment') }}" style="font-family:'Cairo', sans-serif; font-size: small ">تعليقات العملاء</a>
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
                                    <a href="{{ route('admin.comment') }}" class="btn btn-sm btn-blue-grey  ml-1" style="float: right;" > الكل</a>
                                    <a href="{{ route('admin.new.comment') }}" class="btn btn-sm btn-warning  ml-1" style="float: right;" > تعليق جديد</a>
                                    <a href="{{ route('admin.reply.comment') }}" class="btn btn-sm btn-primary  ml-1" style="float: right;" >تعليق تم الرد عليه</a>

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
                                            <th>عنوان الخبر</th>
                                            <th>التاريخ</th>
                                            <th width="20%">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($comments as $key =>$row)
                                            <tr>

                                                <td> {{ ($row->user) ?  $row->user->name  : 'لايوجد معلومات' }}
                                                    <br>
                                                    @if($row->status == 0 )
                                                        <span class="badge badge-warning">جديد</span>
                                                    @else
                                                        <span class="badge badge-primary">تم الرد</span>
                                                    @endif
                                                </td>
                                                <th>@if  ($row->user)  <a href=" {{ route('show.post',$row->post->slug) }}" target="_blank">
                                                        {{$row->user->email}} </a> @else  لايوجد معلومات @endif</th>
                                                 <td>@if($row->post) <a href=" {{ route('admin.show.post',$row->post_id) }} ">{{$row->post->post_title}} </a>@endif </td>

                                                @php
                                                $timestamp = strtotime($row->created_at);
                                                $date = date('F j, Y, g:i a',$timestamp)
                                                @endphp

                                                <td>@if($row->post){{$date}} @endif</td>
                                                <td>
                                                    <a href="{{ url('admin/show/comment/'.$row->id) }}" class="btn btn-sm btn-info" >عرض</a>
                                                    <a href="{{ url('admin/delete/comment/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">حــذف</a>

                                                </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                        <tr>

                                            <th>اسم المستخدم</th>
                                            <th>البريد الالكترونى</th>
                                            <th>عنوان الخبر</th>
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