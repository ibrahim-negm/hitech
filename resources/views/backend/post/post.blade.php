@extends('admin.admin_master')
@section('title-content') الاخبار - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">الاخبار</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.post') }}" style="font-family:'Cairo', sans-serif; font-size: small">الاخبار</a>
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
                                <a href="{{ route('admin.create_post') }}" class="btn btn-sm btn-warning" style="float: right;"> اضافة خبر</a>

                            </div>
                            @include('alerts.success')
                            @include('alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="15%">عنوان المنشور</th>
                                            <th width="10%">اسم الخدمة</th>
                                            <th width="5%">الصورة</th>
                                            <th width="5%">الحالة</th>
                                            <th width="30%">Action</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($posts as $key=>$post)
                                            <tr>
                                                <td>{{$key +1 }}</td>
                                                <td><a href="{{ route('show.post', $post->slug)}}" target="_blank">{{$post->post_title }}</a></td>


                                                <td>
                                                    @if( $post->service==null)
                                                        لايوجد
                                                    @else
                                                        {{ $post->service->service_name }}
                                                    @endif


                                                </td>

                                                <td><img src="{{ asset('upload/blog/'.$post->post_image) }}"  style="width: 90px; height: 100px" alt=""></td>


                                                <td>
                                                    @if($post->status == 1)
                                                        <span class="badge badge-success"> فعال</span>
                                                        @else
                                                        <span class="badge badge-danger">غير فعال</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.show.post',$post->id)  }}" class="btn btn-sm btn-warning"title="رؤية"><i class="ft ft-eye"></i></a>

                                                    @if($post->status == 1)
                                                        <a href="{{ route('admin.inactive.post',$post->id)  }}" class="btn btn-sm btn-danger" title="غير فعال"><i class="ft ft-thumbs-down"></i></a>
                                                    @else
                                                        <a href="{{ route('admin.active.post',$post->id)  }}" class="btn btn-sm btn-success"title="فعال"><i class="ft ft-thumbs-up"></i></a>
                                                    @endif
                                                    <a href="{{ route('admin.edit.post',$post->id)  }}" class="btn btn-sm btn-info"title="تعديل"><i class="ft ft-edit"></i></a>

                                                    <a href="{{ route('admin.delete.post',$post->id) }}" class="btn btn-sm btn-danger" id="delete" title="حذف"><i class="ft ft-trash-2"></i></a>

                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="15%">عنوان المنشور</th>
                                            <th width="10%">اسم الخدمة</th>
                                            <th width="5%">الصورة</th>
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