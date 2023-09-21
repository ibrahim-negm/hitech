@extends('backend.layouts.admin_master')
@section('title-content') عرض التعليقات - هاى تك للتقسيط @endsection

@section('admin-content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block" style="font-family:'Cairo', sans-serif; font-size: large">عرض التعليقات</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="font-family:'Cairo', sans-serif; font-size: small">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.comment') }}" style="font-family:'Cairo', sans-serif; font-size: small"> التعليقات </a>
                            </li>
                            <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif; font-size: small"> تعليق على {{ $comment->post->post_title}}
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
                            <br>
                            @include('alerts.success')
                            @include('alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="card">
                                                <div class="card-header "> <strong>تفاصيل التعليق</strong> </div>

                                                <div class="card-body table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th> إسم صاحب التعليق : </th>
                                                            <td style="color: maroon"> {{ ($comment->user) ? $comment->user->name : 'غير معرف' }} </td>
                                                        </tr>

                                                        <tr>
                                                            <th> رقم التليفون : </th>
                                                            <td style="color: maroon"> {{ ($comment->user) ? $comment->user->phone : 'غير معرف' }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th> البريد الالكترونى : </th>
                                                            <td style="color: maroon"> {{ ($comment->user) ? $comment->user->email : 'غير معرف'}} </td>
                                                        </tr>


                                                        <tr>
                                                            <th> عنوان المنشور : </th>
                                                            <td style="color: maroon"> <a href=" {{ route('show.post',$comment->post->slug) }}" target="_blank">{{ $comment->post->post_title }} </a></td>

                                                        </tr>

                                                        <tr>
                                                            <th> وصف التعليق : </th>
                                                            <td>
                                                                <textarea name="" id="" cols="40"
                                                                          rows="10" style="word-wrap: break-word; color: maroon ;" disabled>{{ $comment->description }}</textarea>

                                                            </td>

                                                        </tr>

                                                        <tr>
                                                            <th> التاريخ : </th>
                                                            @php
                                                                $timestamp = strtotime($comment->created_at);
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
                                                <div class="card-header"><strong>صورة الخبر</strong> </div>
                                                <div class="card-body table-responsive">
                                                    <table class="table">
                                                        <tr>

                                                            <td>
                                                                <a href="{{ route('admin.show.post',$comment->post_id) }}">
                                                                <img src="{{ asset('upload/blog/'.$comment->post->post_image) }}"  style="width: 300px; height: 360px" alt="">
                                                                </a>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </div>

                                            </div>
                                        </div>


                                     </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">

                                                <div class="card-body table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <form action="{{ route('reply.comment',$comment->id) }}" method="POST">
                                                                    @csrf
                                                                    <div class="modal-body pd-20">

                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail1">تفاصيل الرد<span class="text-danger"> * </span></label>
                                                                                    <textarea type="text" class="form-control @error('description') is-invalid @enderror"  aria-describedby="emailHelp"
                                                                                              name="description" rows="6" required></textarea>

                                                                                    @error('description')
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header "> <strong>من قام بالرد</strong> </div>

                                                <div class="card-body table-responsive">
                                                    <table class="table table-striped table-bordered ">
                                                        <thead>
                                                        <tr>
                                                            <th class="wd-5p">المرسل</th>
                                                            <th >الرد</th>
                                                            <th class="wd-5p">التاريخ</th>
                                                            <th class="wd-5p">Actions</th>


                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($comment_replies as $row)
                                                            <tr>
                                                                <td class="wd-5p">{{ $row->admin->name }}</td>
                                                                <td  width="30%"><p style="word-wrap: break-word">{{ $row->description }} </p></td>
                                                                <td class="wd-5p">{{ date('F j, Y, g:i a',strtotime($row->created_at)) }}</td>
                                                                <td class="wd-5p">
                                                                    <a href="{{ url('admin/delete/comment_reply/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">حــذف</a>
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>

                                                </div><!-- table-wrapper -->


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