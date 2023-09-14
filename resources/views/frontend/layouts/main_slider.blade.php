@php

    $sliders = \App\Models\Admin\Slider::where('status',1)->take(3)->get();

@endphp


<!-- Main Slider -->
<div class="rev-slider">
    <div id="rev_slider_1164_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="exploration-header" data-source="gallery" style="background-color:transparent;padding:0px;">
        <!-- START REVOLUTION SLIDER 5.4.1 fullscreen mode -->


                <!-- SLIDE  -->
                @if($sliders)
                @foreach($sliders as $key=>$slider)
                    <div data-index="rs-3204" data-transition="slideoververtical" data-slotamount="default"
                    data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default"
                    data-easeout="default" data-masterspeed="default"  data-thumb="{{asset($slider->image)}}"
                    data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="5000" data-fsslotamount="7"
                    data-saveperformance="off" >

                    <!-- MAIN IMAGE -->
                    <img src="{{asset($slider->image)}}" style="width: 100%; height: 100%"
                         alt="{{$slider->image}}"  data-lazyload="{{asset($slider->image)}}"
                         data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                         data-bgparallax="6" class="rev-slidebg" data-no-retina >

                    <!-- LAYER NR. 1 -->
            </div>
                @endforeach()
                @endif
    </div><!-- END REVOLUTION SLIDER -->
</div>
<!-- Main Slider -->

