
<!-- Footer -->
<footer class="site-footer style1">
    <!-- newsletter part -->
    <div class="dlab-newsletter">
        <div class="container">
            <div class="ft-contact wow fadeIn" data-wow-duration="2s" data-wow-delay="0.6s">
                <div class="ft-contact-bx">
                    <img src="{{ asset('frontend/images/icon/icon1.png') }}" alt="address"/>
                    <h4 class="title">عنوان</h4>
                    <p>المرحلة الخامسة - بجوار الملاعب المفتوحة
                        <br>
                        العرايشية - أمام دار مناسبات مسجد المطافى
                        <br>
                        شارع شبين الكوم - بجوار لابوار
                    </p>
                </div>
                <div class="ft-contact-bx">
                    <img src="{{ asset('frontend/images/icon/icon2.png') }}" alt="telephone"/>
                    <h4 class="title">هاتف</h4>
                    <p>  01093201573 - 01229994645
                         01020105750 - 01274623686
                         01003187133 - 01271389359
                         01283353900 - 01020902496


                    </p>
                </div>
                <div class="ft-contact-bx">
                    <img src="{{ asset('frontend/images/icon/icon3.png') }}" alt="email"/>
                    <h4 class="title">البريد الالكتروني</h4>
                    <p>{{ $settings->email }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- footer top part -->
    <div class="footer-top" style="background-image:url({{ asset('frontend/images/background/bg2.png') }}); background-size: contain;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="widget widget_about">
                        <h4 class="footer-title">عن الشركة</h4>
                        <p>
                            شركة خبرة 25 عام فى مجال بيع جميع ما يخص الاسرة المصرية من منتجات كهربائية ومنزليه ومفروشات وغيرها من المنتجات . تتميز الشركة فى سرعة الاجراءات وتنفيذ العملية الشرائية عن طريق التقسيط فى اقل وقت ممكن . بالاضافه الى جودة منتجاتها واسعارها التنافسية وده اللى ادى الانتشار للشركة.


                        </p>
                        <a href="{{route('about')}}" class="readmore">اقرأ أكثر</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="widget">
                        <h4 class="footer-title">رابط مفيد</h4>
                        <ul class="list-2">
                            <li><a href="{{route('about')}}">معلومات عنا</a></li>
                            <li><a href="{{ route('all.posts') }}">أخر الاخبار</a></li>
                            <li><a href="{{ route('main.home') }}#service">الخدمات</a></li>
                            <li><a href="{{route('privacy')}}">سياسة الخصوصية</a></li>
                            <li><a href="{{route('terms')}}">الشروط والاحكام </a></li>
                            <li><a href="{{route('faq')}}">مكتب المساعدة </a></li>
                            <li><a href="{{route('refund')}}">سياسة الاسترجاع </a></li>
                            <li><a href="{{ route('contact.us') }}">إتصل بنا</a></li>
                            <li><a href="{{ route('gallery') }}">معرض الصور</a></li>
                            <li><a href="{{ route('main.home') }}#team">فريق العمل</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="widget widget_subscribe">
                        <h4 class="footer-title">النشرة الإخبارية</h4>
                        <p>إذا كان لديك أية أسئلة. اشترك في النشرة الإخبارية لدينا للحصول على أحدث منتجاتنا.</p>
                        <form  action="{{ route('store.subscriber') }}" method="post">
                            @csrf
                            <div class="dzSubscribeMsg"></div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input name="email" required="required" class="form-control" placeholder="عنوان بريدك الإلكتروني" type="email">

                                    <div class="input-group-addon">
                                        <button name="submit" value="Submit" type="submit" class="site-button fa fa-paper-plane-o"></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom part -->
    <div class="footer-bottom footer-line">
        <div class="container">

            <div class="footer-bottom-in">
                <div class="footer-bottom-logo"><a href="{{ url('/') }}"><img src="{{ asset('upload/'.$settings->logo_dark) }}" alt="settings"/></a></div>

                <div class="footer-bottom-social">
                    <ul class="dlab-social-icon dez-border">
                        <li><a class="fa fa-facebook" href="{{ $settings->facebook }}"></a></li>
                        <li><a class="fa fa-whatsapp" href="{{ $settings->whatsup }}"></a></li>

                    </ul>
                </div>
            </div>

        </div>
    </div>
</footer>
<!-- Footer END -->
{{--<button class="scroltop style2 radius" type="button"><i class="fa fa-arrow-up"></i></button>--}}
<!-- Footer -->


