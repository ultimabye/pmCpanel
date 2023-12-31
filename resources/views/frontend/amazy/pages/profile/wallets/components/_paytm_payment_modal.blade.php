<div class="modal fade" id="PayTMModal" tabindex="-1" role="dialog" aria-labelledby="paytmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('wallet.pay_tm_payment') }}</h5>
                <button type="button" class="close " data-bs-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <div class="modal-body">
                <section class="send_query bg-white contact_form">
                    <form action="{{route('my-wallet.store')}}" class="p-0" method="POST" id="paytm_form">
                        @csrf
                        <input type="hidden" name="method" value="PayTm">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 mb_20">
                                <label for="name" class="mb-2">{{ __('common.name') }}<span class="text-danger">*</span></label>
                                <input type="text" class="primary_input4 form-control" placeholder="{{ __('common.name') }}" name="name" value="{{auth()->user()->first_name}}">
                                <span class="text-danger"></span>
                            </div>
                            <div class="col-xl-6 col-md-6 mb_20">
                                <label for="name" class="mb-2">{{ __('common.email') }}<span class="text-danger">*</span></label>
                                <input type="email" name="email" class="primary_input4 form-control" placeholder="{{ __('common.email') }}" value="{{auth()->user()->email}}">
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="row mb-20">
                            <div class="col-xl-6 col-md-6 mb_20">
                                <label for="name" class="mb-2">{{ __('common.mobile') }}<span class="text-danger">*</span></label>
                                <input type="text" class="primary_input4 form-control" placeholder="{{ __('common.mobile') }}" name="mobile" value="{{@old('mobile')}}">
                                <span class="text-danger" id="error_mobile"></span>
                            </div>
                            <div class="col-xl-6 col-md-6 mb_20">
                                <label for="name" class="mb-2">{{ __('common.amount') }}<span class="text-danger">*</span></label>
                                <input type="number" min="0" step="{{step_decimal()}}" value="{{ $recharge_amount }}" name="amount" class="primary_input4 form-control">
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="send_query_btn d-flex justify-content-between mt-4">
                            <button type="button" class="amaz_primary_btn gray_bg_btn text-nowrap" data-bs-dismiss="modal">{{ __('common.cancel') }}</button>
                            <button class="amaz_primary_btn style3 text-nowrap" type="submit" id="paytm_submit_btn" disabled>{{ __('wallet.continue_to_recharge') }}</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
