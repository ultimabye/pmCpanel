<form action="{{ route('payment_gateway.configuration') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <input type="hidden" name="name" value="FlutterWave Configuration">
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <input type="hidden" name="types[]" value="FLW_PUBLIC_KEY">
                <label class="primary_input_label" for="">{{ __('payment_gatways.public_key') }}</label>
                <input name="FLW_PUBLIC_KEY" class="primary_input_field" value="{{ $gateway->perameter_1 }}"
                    placeholder="{{ __('payment_gatways.public_key') }}" type="text">
            </div>
        </div>
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <input type="hidden" name="types[]" value="FLW_SECRET_KEY">
                <label class="primary_input_label" for="">{{ __('payment_gatways.secret_key') }}</label>
                <input name="FLW_SECRET_KEY" class="primary_input_field" value="{{ $gateway->perameter_2 }}"
                    placeholder="{{ __('payment_gatways.secret_key') }}" type="text">
            </div>
        </div>
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <input type="hidden" name="types[]" value="FLW_SECRET_HASH">
                <label class="primary_input_label" for="">{{ __('payment_gatways.secret_hash') }}</label>
                <input name="FLW_SECRET_HASH" class="primary_input_field" value="{{ $gateway->perameter_3 }}"
                    placeholder="{{ __('payment_gatways.secret_hash') }}" type="text">
            </div>
        </div>
        <input type="hidden" name="id" value="{{ @$gateway->id }}">
        <input type="hidden" name="method_id" value="{{ @$gateway->method->id }}">
        @if(auth()->user()->role->type != 'seller')
            <div class="col-xl-8">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{__('payment_gatways.gateway_logo') }} ({{getNumberTranslate(400)}} X {{getNumberTranslate(166)}}){{__('common.px')}}</label>
                    <div class="primary_file_uploader">
                        <input class="primary-input" type="text" id="logoFlutterWave_file"
                            placeholder="{{ __('payment_gatways.gateway_logo') }}" readonly="" />
                        <button class="" type="button">
                            <label class="primary-btn small fix-gr-bg" for="logoFlutterWave">{{ __('product.Browse') }}
                            </label>
                            <input type="file" class="d-none" name="logo" accept="image/*" id="logoFlutterWave" />
                        </button>
                    </div>

                </div>
            </div>
            <div class="col-xl-4">
                <div class="logo_div">
                    @if (@$gateway->method->logo)
                    <img id="logoFlutterWaveDiv" class=""
                        src="{{showImage(@$gateway->method->logo) }}" alt="">
                    @else
                    <img id="logoFlutterWaveDiv" class="" src="{{ showImage('backend/img/default.png') }}"
                        alt="">
                    @endif
                </div>
            </div>
        @endif
        <div class="col-lg-12 text-center">
            <button class="primary_btn_2 mt-2"><i class="ti-check"></i>{{__("common.update")}} </button>
        </div>

        <div class="col-lg-12">
            <div class="alert alert-warning mt-30 text-center">
                {{__('payment_gatways.webhook_url') }}: {{url('/')}}/flutterwave/callback
            </div>
        </div>
    </div>
</form>
