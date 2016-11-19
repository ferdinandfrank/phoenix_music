@extends('layout')

@section('content')
    <div id="slider-container" class="slider-container rev_slider_wrapper">
        <div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"fullScreen":"on", "fullScreenAlignForce": "on"}'>
            <ul>
                <li data-transition="fade">
                    <img src="{{ asset('assets/images/background.jpg') }}" style="opacity:0.0;" data-bgrepeat="no-repeat" data-bgfit="cover" data-bgposition="center center">

                    <div class="tp-caption sfl fadeout fullscreenvideo tp-videolayer"
                         data-x="0"
                         data-y="0"
                         data-speed="600"
                         data-start="0"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power4.easeOut"
                         data-autoplay="true"
                         data-autoplayonlyfirsttime="false"
                         data-nextslideatend="true"
                         data-videowidth="100%"
                         data-videoheight="100%"
                         data-videopreload="meta"
                         data-videomp4="{{ asset('assets/video/intro.mp4') }}"
                         data-videocontrols="none"
                         data-forcecover="1"
                         data-forcerewind="on"
                         data-aspectratio="16:9"
                         data-volume="mute"
                         data-videoposter="{{ asset('assets/images/covers/slider_holder.jpg') }}">
                    </div>
                </li>
                <li data-transition="fade">
                    <img src="{{ asset('assets/images/background.jpg') }}" style="opacity:0.0;" data-bgrepeat="no-repeat" data-bgfit="cover" data-bgposition="center center">

                    <div class="tp-caption"
                         data-x="center"
                         data-y="center" data-voffset="-150"
                         data-start="0"
                         style="z-index: 5"
                         data-transform_in="y:[100%];s:500;"
                         data-transform_out="opacity:0;s:500;"><img src="{{ asset('assets/images/logos/logo_light.png') }}" alt="Phoenix Music" /></div>

                    <div class="tp-caption featured-label"
                         data-x="center"
                         data-y="center" data-voffset="0"
                         data-start="0"
                         style="z-index: 5"
                         data-transform_in="y:[100%];s:500;"
                         data-transform_out="opacity:0;s:500;">WELCOME TO PHOENIX MUSIC</div>

                    <div class="tp-caption bottom-label"
                         data-x="center"
                         data-y="center" data-voffset="50"
                         data-start="500"
                         data-transform_idle="o:1;"
                         data-transform_in="y:[100%];z:0;rZ:-35deg;sX:1;sY:1;skX:0;skY:0;s:600;e:Power4.easeInOut;"
                         data-transform_out="opacity:0;s:500;"
                         data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                         data-splitin="chars"
                         data-splitout="none"
                         data-responsive_offset="on"
                         style="font-size: 23px; line-height: 30px; z-index: 5"
                         data-elementdelay="0.05">Music For Motion Pictures And Motion Picture Advertising</div>
                </li>
                <li data-transition="fade">
                    <img src="{{ asset('assets/images/background.jpg') }}" style="opacity:0.0;" data-bgrepeat="no-repeat" data-bgfit="cover" data-bgposition="center center">

                    <div class="tp-caption"
                         data-x="center" data-hoffset="-150"
                         data-y="center" data-voffset="-95"
                         data-start="1000"
                         style="z-index: 5"
                         data-transform_in="x:[-300%];opacity:0;s:500;"><img src="{{ asset('assets/images/slide-title-border.png') }}" alt=""></div>

                    <div class="tp-caption top-label"
                         data-x="center" data-hoffset="0"
                         data-y="center" data-voffset="-95"
                         data-start="500"
                         style="z-index: 5"
                         data-transform_in="y:[-300%];opacity:0;s:500;">DO YOU NEED</div>

                    <div class="tp-caption"
                         data-x="center" data-hoffset="150"
                         data-y="center" data-voffset="-95"
                         data-start="1000"
                         style="z-index: 5"
                         data-transform_in="x:[300%];opacity:0;s:500;"><img src="{{ asset('assets/images/slide-title-border.png') }}" alt=""></div>

                    <div class="tp-caption main-label"
                         data-x="center" data-hoffset="0"
                         data-y="center" data-voffset="-45"
                         data-start="1500"
                         data-whitespace="nowrap"
                         data-transform_in="y:[100%];s:500;"
                         data-transform_out="opacity:0;s:500;"
                         style="z-index: 5"
                         data-mask_in="x:0px;y:0px;">EPIC MUSIC</div>

                    <div class="tp-caption bottom-label"
                         data-x="center" data-hoffset="0"
                         data-y="center" data-voffset="5"
                         data-start="2000"
                         style="z-index: 5"
                         data-transform_in="y:[100%];opacity:0;s:500;">FOR YOUR PROJECT?</div>

                    <a class="tp-caption btn btn-primary btn-slider-action"
                       data-hash
                       data-hash-offset="85"
                       href="library"
                       data-x="center" data-hoffset="0"
                       data-y="center" data-voffset="80"
                       data-start="2000"
                       data-whitespace="nowrap"
                       data-transform_in="y:[100%];s:500;"
                       data-transform_out="opacity:0;s:500;"
                       style="z-index: 5"
                       data-mask_in="x:0px;y:0px;">Check Our Library!</a>

                </li>
                <li data-transition="fade">
                    <img src="{{ asset('assets/images/background.jpg') }}" style="opacity:0.0;" data-bgrepeat="no-repeat" data-bgfit="cover" data-bgposition="center center">

                    <div class="tp-caption"
                         data-x="center"
                         data-y="center" data-voffset="-150"
                         data-start="0"
                         style="z-index: 5;"
                         data-transform_in="y:[100%];s:500;"
                         data-transform_out="opacity:0;s:500;"><img src="{{ asset('assets/images/logos/logo_audiojungle.png') }}" alt="AudioJungle" /></div>

                    <div class="tp-caption bottom-label"
                         data-x="center"
                         data-y="center" data-voffset="-50"
                         data-start="500"
                         data-transform_idle="o:1;"
                         data-transform_in="y:[100%];z:0;rZ:-35deg;sX:1;sY:1;skX:0;skY:0;s:600;e:Power4.easeInOut;"
                         data-transform_out="opacity:0;s:500;"
                         data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                         data-splitin="chars"
                         data-splitout="none"
                         data-responsive_offset="on"
                         style="font-size: 23px; line-height: 30px; z-index: 5"
                         data-elementdelay="0.05">Visit our AudioJungle portfolio for licensing epic tracks and sounds for your next project!</div>

                    <a class="tp-caption btn btn-primary btn-slider-action"
                       data-hash
                       data-hash-offset="85"
                       href="{{ \App\Utils\UrlGenerator::audiojungle(\App\Models\Settings::audiojungle()) }}"
                       data-x="center" data-hoffset="0"
                       data-y="center" data-voffset="50"
                       data-start="2000"
                       data-whitespace="nowrap"
                       data-transform_in="y:[100%];s:500;"
                       data-transform_out="opacity:0;s:500;"
                       style="z-index: 5"
                       data-mask_in="x:0px;y:0px;">Visit us on AudioJungle!</a>

                </li>
            </ul>
        </div>
    </div>
@stop