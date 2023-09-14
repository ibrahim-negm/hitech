@extends('admin.admin_master')
@section('title-content')  تفاصيل الرسالة - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">تفاصيل الرسالة</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.message') }}" style="font-family:'Cairo', sans-serif; font-size: small"> رسائل العملاء </a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small"> رسالة  لـ  {{ $message->name}}
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
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header "> <strong>تفاصيل الرسالة</strong> </div>

                                                <div class="card-body table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th> إسم صاحب الرسالة : </th>
                                                            <td style="color: maroon"> {{ $message->name }} </td>
                                                        </tr>

                                                        <tr>
                                                            <th> رقم التليفون : </th>
                                                            <td style="color: maroon"> {{$message->phone }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th> البريد الالكترونى : </th>
                                                            <td style="color: maroon"> {{ $message->email }} </td>
                                                        </tr>


                                                        <tr>
                                                            <th> عنوان الرسالة : </th>
                                                            <td style="color: maroon">{{ $message->subject }} </td>
                                                        </tr>



                                                        <tr>
                                                            <th> موضوع الرسالة : </th>
                                                            <td style="color: orange">
                                                               {{ $message->message }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th> حالة الرسالة : </th>
                                                            <td style="color: maroon">

                                                                @if($message->status == 0 )
                                                                    <span class="badge badge-warning">جديد</span>
                                                                @elseif($message->status == 1)
                                                                    <span class="badge badge-primary">تم قرائته</span>
                                                                @else
                                                                    <span class="badge badge-success">تم الرد</span>
                                                                @endif
                                                                </td>
                                                        </tr>

                                                        <tr>
                                                            <th> التاريخ : </th>
                                                            <td style="color: maroon"> {{ date('F j,Y',strtotime($message->created_at)) }} </td>
                                                        </tr>

                                                    </table>


                                                </div>



                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header"><strong>الرد</strong> </div>
                                                <div class="card-body table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <form action="{{ route('sent.message',$message->id) }}" method="POST">
                                                                    @csrf
                                                                    <div class="modal-body pd-20">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">عنوان الرد<span class="text-danger"> * </span></label>
                                                                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                                           placeholder="عنوان الرد" name="subject"  value=" الرد على &nbsp;  {{ $message->subject }}" required>

                                                                                    @error('subject')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong></span>
                                                                                    @enderror

                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">تفاصيل الرد<span class="text-danger"> * </span></label>
                                                                                    <textarea type="text" class="form-control @error('message') is-invalid @enderror"  aria-describedby="emailHelp"
                                                                                              name="message" rows="6" required></textarea>

                                                                                    @error('message')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                      <strong>{{ $message }}</strong></span>
                                                                                    @enderror


                                                                                </div>
                                                                            </div>


                                                                        </div>

                                                                        <br>

                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-info pd-x-20" > أرسال الرد <i class="ft-thumbs-up position-right"></i></button>
                                                                            <button type="reset" class="btn btn-warning pd-x-20" > إعادة <i class="ft-refresh-cw position-right"></i></button>


                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>



                                    </div>
                                    <hr>
                                    <div class="row">

                                        <div class="card pd-20 pd-sm-40 col-lg-12">

                                            <div class="card-header "> <strong>تفاصيل الرد</strong> </div>

                                            <div class="card-body table-responsive">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th class="wd-5p">المرسل</th>
                                                        <th class="wd-25p">الرد</th>
                                                        <th class="wd-5p">التاريخ</th>


                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($replied as $row)
                                                    <tr>
                                                        <td>{{ $row->admin->name }}</td>
                                                        <td>{{ $row->message }}</td>
                                                        <td>{{ date('F j,Y',strtotime($row->created_at)) }}</td>

                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                            </div><!-- table-wrapper -->
                                        </div><!-- card -->


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