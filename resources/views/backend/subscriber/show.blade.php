@extends('admin.admin_master')
@section('title-content')  ارسال نشرة - هاى تك للتقسيط  @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">ارسال نشرة</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.subscriber') }}" style="font-family:'Cairo', sans-serif; font-size: small"> المتابعيين </a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small"> ارسال نشرة
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <!-- Zero configuration table -->
            <section id="configuration">
                <form action="{{route('admin.send.to.subscriber')}}" method="POST">
                    @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <br>
                            @include('alerts.success')
                            @include('alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header"><strong>تفاصيل النشرة</strong> </div>
                                                <div class="card-body table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <td>


                                                                    <div class="modal-body pd-20">

                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">عنوان النشرة<span class="text-danger"> * </span></label>
                                                                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                                           placeholder="عنوان النشرة" name="subject"   required>

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
                                                                                    <label for="exampleInputEmail1">تفاصيل النشرة<span class="text-danger"> * </span></label>
                                                                                    <textarea type="text" class="form-control @error('message') is-invalid @enderror"  aria-describedby="emailHelp"
                                                                                              name="message" rows="6" required></textarea>

                                                                                    @error('message')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                      <strong>{{ $message }}</strong></span>
                                                                                    @enderror


                                                                                </div>
                                                                            </div>


                                                                        </div>

                                                                    </div>


                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                        <div class="row">
                                        <div class="col-md-8 offset-2">
                                            <div class="card">
                                               <table class="table table-striped table-bordered zero-configuration">
                                                    <thead>
                                                    <tr>
                                                        <th width="5%">ID</th>
                                                        <th>البريد الالكترونى</th>

                                                        <th width="20%">Action</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($subscribers as $key =>$subscriber)
                                                        <tr>
                                                            <td>{{ $key +1}}</td>
                                                            <td>{{ $subscriber->email }}</td>
                                                            <td>
                                                                <input type="checkbox" name="email[]" value=" {{ $subscriber->email }}">
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th width="5%">ID</th>
                                                        <th>البريد الالكترونى</th>

                                                        <th width="20%">Action</th>

                                                    </tr>
                                                    </tfoot>
                                                </table>
                                                <br>

                                                <button type="submit" class="btn btn-info pd-x-20" > أرسال النشرة <i class="ft-thumbs-up position-right"></i></button>

                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <!-- ########## END: MAIN PANEL ########## -->

            </section>

        </div>
    </div>


@endsection