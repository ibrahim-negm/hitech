@extends('admin.admin_master')
@section('title-content') الخدمات الرئيسية - هاى تك للتقسيط @endsection

@section('admin-content')

        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large ">الخدمات الرئيسية</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الصفحة الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.service') }}" style="font-family:'Cairo', sans-serif; font-size: small ">الخدمات الرئيسية</a>
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
                                    <a href="" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal"
                                    data-target="#modal"> أضافة خدمة</a>

                                </div>
                                @include('alerts.success')
                                @include('alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                            <tr>
                                                <th width="5%">ID</th>
                                                <th width="15%">  اسم الخدمة الرئيسى </th>
                                                <th width="15%">صورة الخدمة</th>
                                                <th width="30%">Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($services as $key => $service)
                                            <tr>
                                                <td>{{ $key +1}}</td>
                                                <th>{{ $service->service_name }}</th>
                                                <td><img src="{{ asset('upload/services/'.$service->service_image) }}" alt="" style="width: 100px; height: 100px"></td>
                                                <td>
                                                    <a href="{{ url('admin/edit/service/'.$service->id)  }}" class="btn btn-sm btn-info">تعديل</a>
                                                    <a href="{{ url('admin/delete/service/'.$service->id) }}" class="btn btn-sm btn-danger" id="delete">حــذف</a>

                                                </td>

                                            </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th width="5%">ID</th>
                                                <th width="15%">  اسم الخدمة الرئيسى </th>
                                                <th width="15%">صورة الخدمة</th>
                                                <th width="30%">Action</th>


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

                    <!-- LARGE MODAL -->
                    <div id="modal" class="modal fade">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content tx-size-sm">
                                <div class="modal-header pd-x-20">
                                    <h4 style="font-family:'Cairo', sans-serif; font-size: large">أضافة خدمة جديدة</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.store_service') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body pd-20">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">اسم الخدمة </label>
                                            <input type="text" class="form-control @error('service_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                   placeholder="اسم الخدمة" name="service_name" required>

                                            @error('service_name')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">صورة الخدمة</label>
                                            <input type="file" class="form-control @error('service_image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                  required name="service_image">
                                            <small> الصورة لا تتجاوز 350 كيلو - العرض يفضل ان يكون 700 والارتفاع 500</small>

                                            @error('service_image')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                        </div>


                                    </div><!-- modal-body -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info pd-x-20" >اضف خدمة</button>
                                        <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">خروج</button>

                                    </div>
                                </form>
                            </div>
                        </div><!-- modal-dialog -->
                    </div><!-- modal -->


                </section>


            </div>
        </div>


@endsection