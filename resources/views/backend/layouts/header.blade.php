
<div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="brand-logo" alt="modern admin logo" src="{{ asset('backend/images/logo/logo_thumbnail.png') }}">
                        <h3 class="brand-text">هاى تك للتقسيط </h3>
                    </a>
                </li>
                <li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">

                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">مرحباً,
                  <span class="user-name text-bold-700">{{ Auth::user()->name }}</span>
                </span>
                            <span class="avatar avatar-online">
                                <img src="{{ (!empty(  Auth::user()->profile_photo_path))
                                                                    ? url('upload/backend/users/'. Auth::user()->profile_photo_path)
                                                                     : url('upload/avatar.png')}}"
                                      alt="Card image"><i></i></span>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="ft-user"></i>تعديل الملف الشخصى</a>
                            <a class="dropdown-item" href="{{route('admin.change_password')}}"><i class="ft-lock"></i> تغير كلمة المرور</a>

                            <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="ft-power"></i> Logout</a>
                        </div>
                    </li>

                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i>
                            <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">
                               <?php
                                    $count = count($new_orders) + count($new_comments) + count($new_reviews)  ;
                                ?>
                                @if($count){{ $count }}@else 0 @endif
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0">
                                    <span class="grey darken-2">الاشعارات</span>
                                </h6>
                            </li>
                            <li class="scrollable-container media-list w-100">
                                @if($new_orders)
                                    @foreach($new_orders as $key=>$row)
                                        @if($key == 2)
                                            @break;
                                        @else
                                            <a href="{{ route('admin.show.order',$row->id) }}">
                                                <div class="media">
                                                    <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                                                    <div class="media-body">

                                                        <p class="notification-text font-small-3 text-muted">
                                                            {{($row->user != null) ? 'طلب استعلام جديد من  ' . $row->user->name :  'طلب استعلام جديد من شخص غير مسجل  '  }}

                                                        </p>
                                                        <small>
                                                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">{{ $row->created_at->diffForHumans()}}</time>
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                   @endforeach

                                @endif

                                    @if($new_comments)
                                        @foreach($new_comments as $key=>$row)
                                            @if($key == 2)
                                                @break;
                                            @else
                                                <a href="{{ route('admin.show.comment',$row->id) }}">
                                                    <div class="media">
                                                        <div class="media-left align-self-center"><i class="ft-user-check icon-bg-circle bg-warning"></i></div>
                                                        <div class="media-body">

                                                            <p class="notification-text font-small-3 text-muted">
                                                                {{($row->user != null) ? 'تعليق جديد من  ' . $row->user->name :  'تعليق جديد من شخص غير مسجل  '  }}

                                                            </p>
                                                            <small>
                                                                <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">{{ $row->created_at->diffForHumans()}}</time>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                        @endforeach

                                    @endif



                                @if($new_reviews)
                                        @foreach($new_reviews as $key=>$row)
                                            @if($key == 2)
                                                @break;
                                            @else
                                <a href="{{ url('admin/show/review/'.$row->id) }}">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="ft-star icon-bg-circle bg-red bg-darken-1"></i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading red darken-1">أخر تقييم جديد!</h6>
                                            <p class="notification-text font-small-3 text-muted">  أخر تقييم جديد من

                                                    {{ ($row->user) ? $row->user->name : 'غير معرف'}} .

                                              </p>
                                            <small>
                                                <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">{{ $row->created_at->diffForHumans()}}</time>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                                            @endif
                                        @endforeach
                              @endif

                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail">             </i>
                            <span class="badge badge-pill badge-default badge-primary badge-default badge-up badge-glow">@if($new_messages){{ count($new_messages) }}@else 0 @endif</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0">
                                    <span class="grey darken-2">رسائل العملاء</span>
                                </h6>
                                <span class="notification-tag badge badge-default badge-warning float-right m-0">@if($new_messages){{ count($new_messages) }} جديدة @endif  </span>
                            </li>
                            <li class="scrollable-container media-list w-100">
                             @if($new_messages)
                                @if(count($new_messages) == 0)
                                  <p class="text-center text-primary"> لا توجد رسائل جديدة</p>

                                @else
                                    @foreach($new_messages as $key=>$row)
                                        @if($key == 3)
                                            @break;
                                        @else
                                            <a href="{{ url('admin/show/message/'.$row->id) }}">
                                                <div class="media">
                                                    <div class="media-left">
                        <span class="avatar avatar-sm avatar-online rounded-circle">
                          <img src="{{ asset('upload/avatar.png') }}" alt="avatar"><i></i></span>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">{{str_limit($row->name,$limit=15)}}</h6>
                                                        <p class="notification-text font-small-3 text-muted">{{str_limit($row->subject,$limit=25)}}</p>
                                                        <small>
                                                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">{{date("F j, Y",strtotime($row->created_at))}}</time>
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                    @endforeach
                                @endif
                            @endif

                            </li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="{{ route('admin.message') }}">كل الرسائل</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

