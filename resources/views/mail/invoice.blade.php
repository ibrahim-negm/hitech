<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div style="width:100%; background:#e9e9e9; padding:15px 0; direction: rtl; font-size: 16px;">

    <div style="width:70%; margin:20px auto; text-align: center;">
        <a href="{{url('/')}}" target="_blank"><img src="{{ asset('upload/logo_dark.png') }}" style="border:none; max-width: 100%;" /></a>
    </div>

    <div style="width:70%; margin:20px auto; text-align: center;">
        <h2>تم عملية أستعلامك بنجاح</h2>
    </div>

    <div style="width:70%; color: #333; background:#fff; margin:20px auto; padding:20px; border:4px solid #BB2B6F; border-radius: 10px; font-family: sans-serif, arial;">

        عزيزنا العميل,  {{$shipping->ship_name}}   <br>

    </div>

    <div style="margin-top: 20px; text-align: center; font-family: sans-serif; color: #999; font-size: 15px;">
        <div style="margin:0 auto; width:70%;">

            رقم الفاتورة الخاص باستعلامك : {{ $shipping->order_id }}<br>
            اجمالى استعلام  :{{ $order->total }} جنية<br>
            <p>
         شكراً لعملية استعلامك لمنتجاتنا! طلبك تحت التنفيذ وسوف يتم اكماله من الادارة فى غضون 3-6 ساعات. وسيتواصل معك فرع الشركة من المركز الرئيسى عن طريق التليفون او البريد الالكترونى لتاكيد على جدية الاستعلام المنتج الخاص بكم الى العنوان المرسل فى طلب الاستعلام
            </p>
            <p> عند تقييمك المنتج سيتم ارسال اميل اخر  بكود خصم مشتريات لك ولاصدقائك وعائلتك تقدر تستفاد بيه فى عملية استعلامك القادمة </p>
            <br>
            إذا اردت عدم استقبال رسائل أخرى فى المستقبل من الموقع من فضلك اضغط
            <a href="{{url('/delete/subscriber/'.$shipping->ship_email)}}" style="text-decoration: none; font-weight: bold; color:#487093" target="new">إلغاء خدمة الرسائل</a>.

            <br>

              جميع الحقوق محفوظة لدى شركة هاى  تك للتقسيط
            &copy;
            2021
        </div>
    </div>
</div>



</body>
</html>