@extends('admin.admin_master')
@section('title-content') السلايدر - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">السلايدر</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.slider') }}" style="font-family:'Cairo', sans-serif; font-size: small">السلايدر</a>
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
                                <a href="{{ route('admin.create.slider') }}" class="btn btn-sm btn-warning" style="float: right;" > أضافة سلايدر</a>

                            </div>
                            @include('alerts.success')
                            @include('alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                        <tr>
                                            <th width="5%">ID</th>

                                            <th width="10%"> الصورة</th>
                                            <th width="5%">الحالة</th>
                                            <th width="20%">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sliders as $key =>$slider)
                                            <tr>
                                                <td  width="5%">{{ $key +1}}</td>

                                                <td width="10%">

                                                        <img src="{{ asset($slider->image) }}" alt="" style="width: 100px; height: 60px">

                                                </td>
                                                <td width="5%">
                                                    @if($slider->status == 1)
                                                        <span class="badge badge-success"> فعال</span>
                                                    @else
                                                        <span class="badge badge-danger">غير فعال</span>
                                                    @endif
                                                </td>

                                                <td width="20%">
                                                    @if($slider->status == 1)
                                                        <a href="{{ route('admin.inactive.slider',$slider->id)  }}" class="btn btn-sm btn-danger" title="غير فعال"><i class="ft ft-thumbs-down"></i></a>
                                                    @else
                                                        <a href="{{ route('admin.active.slider',$slider->id)  }}" class="btn btn-sm btn-success"title="فعال"><i class="ft ft-thumbs-up"></i></a>
                                                    @endif
                                                    <a href="{{ url('admin/edit/slider/'.$slider->id)  }}" class="btn btn-sm btn-info">تعديل</a>
                                                    <a href="{{ url('admin/delete/slider/'.$slider->id) }}" class="btn btn-sm btn-danger" id="delete">حــذف</a>

                                                </td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th width="5%">ID</th>

                                            <th width="10%"> الصورة</th>
                                            <th width="5%">الحالة</th>
                                            <th width="20%">Action</th>


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