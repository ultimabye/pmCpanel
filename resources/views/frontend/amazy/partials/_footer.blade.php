@php
    $footer_content = \Modules\FooterSetting\Entities\FooterContent::first();
    $subscribeContent = \Modules\FrontendCMS\Entities\SubscribeContent::find(1);
   $about_section = Modules\FrontendCMS\Entities\HomePageSection::where('section_name','about_section')->first(); 
@endphp
@if(url()->current() == url('/'))
<div id="about_section" class="amaz_section section_spacing4 {{ ($about_section)? ($about_section->status == 0?'d-none':'') : ''}}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__title d-flex align-items-center gap-3 mb_20">
                    <h3 class="m-0 flex-fill">{{ app('general_setting')->footer_about_title }}</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="amaz_mazing_text">
                    @php echo app('general_setting')->footer_about_description; @endphp
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- FOOTER::START  -->
    <footer class="home_three_footer">
        <div class="main_footer_wrap">
            <div class="container">
                 <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 footer_links_50 ">
                        <div class="footer_widget" >
                            <ul class="footer_links">
                                @foreach($sectionWidgets->where('section','1') as $page)
                                    @if($page->pageData)
                                    @if(!isModuleActive('Lead') && $page->pageData->module == 'Lead')
                                        @continue
                                    @endif
                                    <li><a href="{{ url($page->pageData->slug) }}">{{$page->name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 footer_links_50 ">
                        <div class="footer_widget">
                            <ul class="footer_links">
                                @foreach($sectionWidgets->where('section','2') as $page)
                                    @if($page->pageData)
                                        @if(!isModuleActive('Lead') && $page->pageData->module == 'Lead')
                                            @continue
                                        @endif
                                        <li><a href="{{ url($page->pageData->slug) }}">{{$page->name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-md-6">
                        <div class="footer_widget" >
                            
                            <div class="apps_boxs">
                                @if($footer_content->show_play_store)
                                <a href="{{$footer_content->play_store}}" class="google_play_box d-flex align-items-center mb_10">
                                    <div class="icon">
                                        <img src="{{url('/')}}/public/frontend/amazy/img/amaz_icon/google_play.svg" alt="{{__('amazy.Google Play')}}" title="{{__('amazy.Google Play')}}">
                                    </div>
                                    <div class="google_play_text">
                                        <span>{{__('amazy.Get it on')}}</span>
                                        <h4 class="text-nowrap">{{__('amazy.Google Play')}}</h4>
                                    </div>
                                </a>
                                @endif
                                @if($footer_content->show_app_store)
                                <a href="{{$footer_content->app_store}}" class="google_play_box d-flex align-items-center">
                                    <div class="icon">
                                        <img src="{{url('/')}}/public/frontend/amazy/img/amaz_icon/apple_icon.svg" alt="{{__('amazy.Apple Store')}}"  title="{{__('amazy.Apple Store')}}">
                                    </div>
                                    <div class="google_play_text">
                                        <span>{{__('amazy.Get it on')}}</span>
                                        <h4 class="text-nowrap">{{__('amazy.Apple Store')}}</h4>
                                    </div>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <x-subscribe-component :subscribeContent="$subscribeContent"/>
                </div>
            </div>
        </div>
        <div class="copyright_area p-0">
            <div class="container">
                <div class="footer_border m-0"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="copy_right_text d-flex align-items-center gap_20 flex-wrap justify-content-between">
                            @php echo app('general_setting')->footer_copy_right; @endphp
                            <div class="footer_list_links">
                                @foreach($sectionWidgets->where('section','3') as $page)
                                    @if($page->pageData)
                                        @if(!isModuleActive('Lead') && $page->pageData->module == 'Lead')
                                            @continue
                                        @endif
                                        <a href="{{ url($page->pageData->slug) }}">{{$page->name}}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @if($footer_content->show_play_store && $footer_content->payment_image)
                    <div class="footer_border m-0"></div>
                    <div class="row">
                        <div class="col-12">
                            <div class="payment_imgs text-center ">
                                <img class="img-fluid" src="{{showImage($footer_content->payment_image)}}" alt="{{__('common.payment_method')}}" title="{{__('common.payment_method')}}">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </footer>
    <!-- FOOTER::END  -->
@include('frontend.amazy.auth.partials._login_modal')
<div id="cart_data_show_div">
    @include('frontend.amazy.partials._cart_details_submenu')
</div>
<div id="cart_success_modal_div">
    @include('frontend.amazy.partials._cart_success_modal')
</div>
<input type="hidden" id="login_check" value="@if(auth()->check()) 1 @else 0 @endif">
<div class="add-product-to-cart-using-modal">
    
</div>

@include('frontend.amazy.partials._modals')

<!-- UP_ICON  -->
<div id="back-top" style="display: none;">
    <a title="{{__('common.go_to_top')}}" href="#"><i class="ti-angle-up"></i></a>
</div>
<!--/ UP_ICON -->
<!-- facebook chat start -->
@php
    $messanger_data = \Modules\GeneralSetting\Entities\FacebookMessage::first();
@endphp
@if($messanger_data->status == 1)
    @php echo $messanger_data->code; @endphp
@endif
<!-- facebook chat end -->

@include('frontend.amazy.partials._script')
@stack('scripts')
@stack('wallet_scripts')

@if (Request::route()->uri() != 'customer-chat')
    {{-- chat start  --}}
        {{-- <div class="chat-caret d-flex align-items-center">
            <div class="chat-caret-left">
                <p class="text-white"><i class="fa fa-caret-up me-2"></i> Live Customer Support</p>
            </div>
            <div class="chat-caret-right">
                <div class="chat-caret-user">
                    <img src="{{asset('public/images/support-user')}}/1.png" alt="">
                </div>
                <div class="chat-caret-user">
                    <img src="{{asset('public/images/support-user')}}/2.png" alt="">
                </div>
                <div class="chat-caret-user">
                    <img src="{{asset('public/images/support-user')}}/3.png" alt="">
                </div>
                <div class="chat-caret-user">
                    <img src="{{asset('public/images/support-user')}}/4.png" alt="">
                </div>
            </div>
        </div>         --}}
        {{-- for single add single_vendor --}}
        {{-- <div class="chat-caret-details hide">
            <div class="chat-caret-header d-flex align-items-center justify-content-between">
                <div class="left d-flex align-items-center">
                    <button class="bg-transparent border-0 p-0 text-white" id="close"><i class="fa fa-times"></i></button>
                    <p class="text-white ms-2">Customer Support</p></div>
                <div class="right text-end text-white">
                    <button class="bg-transparent border-0 p-0 text-white"><i class="fa fa-bars"></i></button>
                </div>
            </div>
            <div class="chat-caret-body d-flex flex-wrap">                
                <div class="chat-caret-body-left">
                    <div class="chat-caret-info p-0 overflow-auto">
                        <a href="#" class="chat-list d-flex align-items-center">
                            <div class="chat-list-left d-flex align-items-center">
                                <div class="chat-list-user">
                                    <img src="{{asset('public/images')}}/chat-user/2.jpg" alt="">
                                </div>
                                <div class="chat-list-content">
                                    <strong class="d-block">Annette Black</strong>
                                    <p>Please let me know, How can i install this script very easily</p>
                                </div>
                            </div>
                            <div class="chat-list-right text-end">
                                <p class="text-primary">2:34 PM</p>
                                <div class="badge bg-primary text-white ms-auto">5</div>
                            </div>
                        </a>
                        <a href="#" class="chat-list d-flex align-items-center">
                            <div class="chat-list-left d-flex align-items-center">
                                <div class="chat-list-user">
                                    <img src="{{asset('public/images')}}/chat-user/2.jpg" alt="">
                                </div>
                                <div class="chat-list-content">
                                    <strong class="d-block">Annette Black</strong>
                                    <p>Please let me know, How can i install this script very easily</p>
                                </div>
                            </div>
                            <div class="chat-list-right text-end">
                                <p class="text-primary">2:34 PM</p>
                                <div class="badge bg-primary text-white ms-auto">5</div>
                            </div>
                        </a>
                        <a href="#" class="chat-list d-flex align-items-center">
                            <div class="chat-list-left d-flex align-items-center">
                                <div class="chat-list-user">
                                    <img src="{{asset('public/images')}}/chat-user/2.jpg" alt="">
                                </div>
                                <div class="chat-list-content">
                                    <strong class="d-block">Annette Black</strong>
                                    <p>Please let me know, How can i install this script very easily</p>
                                </div>
                            </div>
                            <div class="chat-list-right text-end">
                                <p class="text-primary">2:34 PM</p>
                                <div class="badge bg-primary text-white ms-auto">5</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="chat-caret-body-right">
                    <div class="chat-close bg-primary text-white d-md-none">
                        <i class="ti-close"></i>
                    </div>
                    <div class="chat-caret-info overflow-auto bg-white">
                        <div class="chat-receiver">
                            <div class="chat-receiver-img">
                                <img src="{{asset('public/images/support-user')}}/receiver.png" alt="">
                            </div>
                            <div class="chat-receiver-content">
                                <div class="chat-receiver-head d-flex align-items-center justify-content-between">
                                    <span><strong class="f_w_600 text-white">Janet</strong> -  Support Agent</span>
                                    <span>12:03 PM</span>
                                </div>
                                <p>That works- I was actually planning to get a smoothie anyways 👍</p>
                            </div>
                        </div>
                        <div class="chat-sender">
                            <p>That was actually planning</p>
                            <span class="date">12:03 PM</span>
                        </div>
                        <div class="chat-receiver">
                            <div class="chat-receiver-img">
                                <img src="{{asset('public/images/support-user')}}/receiver.png" alt="">
                            </div>
                            <div class="chat-receiver-content">
                                <div class="chat-receiver-head d-flex align-items-center justify-content-between">
                                    <span><strong class="f_w_600 text-white">Janet</strong> -  Support Agent</span>
                                    <span>12:03 PM</span>
                                </div>
                                <p>So i think now you understand well.</p>
                            </div>
                        </div>
                        <div class="chat-receiver">
                            <div class="chat-receiver-img">
                                <img src="{{asset('public/images/support-user')}}/receiver.png" alt="">
                            </div>
                            <div class="chat-receiver-content">
                                <div class="chat-receiver-head d-flex align-items-center justify-content-between">
                                    <span><strong class="f_w_600 text-white">Janet</strong> -  Support Agent</span>
                                    <span>12:03 PM</span>
                                </div>
                                <p>So i think now you understand well.</p>
                            </div>
                        </div>
                        <div class="chat-sender">
                            <p>All of the options for changing is the life</p>
                            <span class="date">12:03 PM</span>
                        </div>
                        <div class="chat-sender">
                            <p><i class="fa fa-image"></i><a href="#">Deserewg.pdf</a></p>
                            <span class="date">12:03 PM</span>
                        </div>
                    </div>                    
                    <div class="chat-footer d-flex align-items-center justify-content-between">
                        <button class="bg-transparent border-0 p-0"><i class="fa fa-microphone"></i></button>
                        <button class="bg-transparent border-0 p-0"><i class="fa fa-paperclip"></i></button>
                        <button class="bg-transparent border-0 p-0 me-0"><i class="fa fa-smile"></i></button>
                        <div class="form-box ml-auto position-relative">
                            <input type="text" class="form-control" placeholder="Type Here ....">
                            <button class="border-0">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.16641 5.2668L13.2414 2.90846C16.4164 1.85013 18.1414 3.58346 17.0914 6.75846L14.7331 13.8335C13.1497 18.5918 10.5497 18.5918 8.96641 13.8335L8.26641 11.7335L6.16641 11.0335C1.40807 9.45013 1.40807 6.85846 6.16641 5.2668Z" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.4248 11.3755L11.4081 8.38379" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                    
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-overlay w-100 h-100"></div> --}}
    {{-- chat end --}}    

    {{-- <script>
        
        if($(window).width() < 767){
           $(document).on('click', '.chat-list', function(e){
                e.stopPropagation();
                $('.chat-caret-body-right').fadeIn('fast');
                $('body').addClass('overflow-hidden')
           })
           $(document).on('click', '.chat-close', function(e){
                alert('work')
                $('.chat-caret-body-right').fadeOut('fast');
                $('body').removeClass('overflow-hidden');
           })
        } 
    </script> --}}
@endif

</body>

</html>