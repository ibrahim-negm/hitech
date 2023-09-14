@extends('admin.admin_master')
@section('title-content')معرض الصور - هاى تك للتقسيط@endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">معرض الصور</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.image') }}" style="font-family:'Cairo', sans-serif; font-size: small">معرض الصور</a>
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
                                <a href="" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal"
                                   data-target="#modal"> أضافة صور</a>

                            </div>
                            @include('alerts.success')
                            @include('alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th>اسم الخدمة</th>
                                            <th>عنوان الصورة</th>
                                            <th> الصورة</th>
                                            <th>تاريخ الصورة</th>
                                            <th width="20%">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($images as $key =>$row)
                                            <tr>
                                                <td>{{ $key +1}}</td>
                                                <td>
                                                    @if($row->service == null)
                                                        لا يوجد
                                                    @else
                                                        {{ $row->service->service_name }}
                                                    @endif

                                                </td>
                                                <td>{{ $row->image_name }}</td>
                                                <td><img src="{{ asset('upload/gallery/'.$row->image) }}" alt="" style="width: 100px; height: 60px"></td>
                                                <td>{{ date('F j, Y',strtotime($row->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/edit/gallery/'.$row->id)  }}" class="btn btn-sm btn-info">تعديل</a>
                                                    <a href="{{ url('admin/delete/gallery/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">حــذف</a>

                                                </td>



                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th>اسم الخدمة</th>
                                            <th>عنوان الصورة</th>
                                            <th> الصورة</th>
                                            <th>تاريخ الصورة</th>
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

                <!-- LARGE MODAL -->
                <div id="modal" class="modal fade">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content tx-size-sm">
                            <div class="modal-header pd-x-20" >
                                <h4 style="font-family:'Cairo', sans-serif; font-size: large"> أضافة صور جديدة</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.store_image') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body pd-20">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">اسم الخدمة<span class="text-danger"> * </span></label>
                                        <select class="form-control  @error('service_id') is-invalid @enderror" name="service_id"
                                                data-placeholder="اسم الخدمة" required>
                                            <option label="أختر الخدمة " selected="" disabled=""></option>
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}" >{{ $service->service_name }} </option>
                                            @endforeach
                                        </select>

                                        @error('service_id')
                                        <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong></span>
                                        @enderror


                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">عنوان الصور</label>
                                        <input type="text" class="form-control @error('image_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                               placeholder="عنوان الصور" name="image_name" required>

                                        @error('image_name')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الصور</label>
                                        <input type="file" multiple class="form-control @error('image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                name="image[]" required>
                                        <small>الصورة لاتتعدى 350 كيلو . عرض الصورة يفضل ان يكون 1000 والطول 674.</small>

                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>

                                    </div>


                                </div><!-- modal-body -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info pd-x-20" > اضف الصور</button>
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