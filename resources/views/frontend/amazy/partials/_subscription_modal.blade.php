@php
$modal = false;
if(Session::get('ip') == NULL){
Session::put('ip',request()->ip());
$modal = true;
}
if($popupContent->status == 0){
    $modal = false;
}
@endphp

@if ($modal)
<!-- newsletter_form ::start  -->
<div class="d-none" id="subscriptionDiv">
    <div class="newsletter_form_wrapper newsletter_active" id="subscriptionModal">
        <div class="newsletter_form_inner">
            <div class="close_modal">
                <i class="ti-close"></i>
            </div>
            <div class="newsletter_form_thumb d-flex align-items-center justify-content-center">   
                <img src="{{showImage(@$popupContent->image)}}" alt="{{$popupContent->title}}" title="{{$popupContent->title}}" >
            </div>
            <div class="newsletter_form text-center">
                <h3>{{$popupContent->title}}</h3>
                <p>{{$popupContent->subtitle}}</p>
                <form action="" id="modalSubscriptionForm">
                    <div class="row">
                        <div class="col-12">
                            <input id="modalSubscription_email_id" placeholder="{{__('defaultTheme.enter_email_address')}}" class="primary_input3 mb_10" type="text" name="email">
                        </div>
                        <div class="col-lg-12 message_div_modal d-none"></div>
                        <div class="col-12">
                            <button class="amaz_primary_btn py-3 lh-1 rounded-3 w-100 text-center" id="modalSubscribeBtn">{{__('defaultTheme.subscribe')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- newsletter_form ::end  -->
@endif
