@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('modules/refund/css/seller.css'))}}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
@endsection
@section('mainContent')
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-8 student-details">
                <div class="white_box_50px box_shadow_white" id="printableArea">
                    <div class="row pb-30 border-bottom">
                        <div class="col-md-6 col-lg-6">
                            <div class="logo_div">
                                <img src="{{showImage(app('general_setting')->logo)}}" width="100px" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 text_posision">
                            <h4><a class="order_numder" href="{{route('order_manage.show_details_mine',$refund_detail->refund_request->order->packages->where('seller_id', getParentSellerId())->first()->id)}}" target="_blank">{{$refund_detail->refund_request->order->order_number}}</a></h4>
                        </div>
                    </div>
                    <div class="row mt-30">
                        <div class="col-md-6 col-lg-6">
                            <table class="table-borderless clone_line_table">
                                <tr>
                                    <td><strong>{{ __('refund.refund_related_info') }}</strong></td>
                                </tr>
                                <tr>
                                    <td>{{ __('common.status') }}</td>
                                    <td>: {{ $refund_detail->refund_request->CheckConfirmed }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('refund.request_sent') }}</td>
                                    <td>: {{ $refund_detail->refund_request->created_at->format('d-m-Y h:i:s A') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('refund.refund_method') }}</td>
                                    <td>: {{ strtoupper(str_replace("_"," ",$refund_detail->refund_request->refund_method)) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('refund.shipping_method') }}</td>
                                    <td>: {{ strtoupper(str_replace("_"," ",@$refund_detail->refund_request->shipping_gateway->method_name)) }}</td>
                                </tr>
                            </table>
                        </div>
                        @if ($refund_detail->refund_request->shipping_method == "courier")
                            <div class="col-md-6 col-lg-6">
                                <table class="table-borderless clone_line_table">
                                    <tr>
                                        <td><strong>{{ __('refund.pick_up_info') }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('refund.shipping_gateway') }}</td>
                                        <td>: {{ @$refund_detail->refund_request->shipping_method }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.name') }}</td>
                                        <td>: {{ @$refund_detail->refund_request->pick_up_address_customer->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.email') }}</td>
                                        <td>: {{ @$refund_detail->refund_request->pick_up_address_customer->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.phone') }}</td>
                                        <td>: {{getNumberTranslate(@$refund_detail->refund_request->pick_up_address_customer->phone) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.address') }}</td>
                                        <td>: {{ @$refund_detail->refund_request->pick_up_address_customer->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('refund.post_code') }}</td>
                                        <td>: {{ getNumberTranslate(@$refund_detail->refund_request->pick_up_address_customer->postal_code) }}</td>
                                    </tr>
                                </table>
                            </div>
                        @else
                            <div class="col-md-6 col-lg-6">
                                <table class="table-borderless clone_line_table">
                                    <tr>
                                        <td><strong>{{ __('refund.drop_of_info') }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('refund.shipping_gateway') }}</td>
                                        <td>: {{ @$refund_detail->refund_request->shipping_gateway->method_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.address') }}</td>
                                        <td>: {{ @$refund_detail->refund_request->drop_off_address }}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div class="row mt-30">
                        <div class="col-lg-12 mt-30">
                            <div class="box_header common_table_header">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('common.package') }}: {{ getNumberTranslate(@$refund_detail->order_package->package_code) }} <small>({{ @$refund_detail->process_refund->name }})</small></h3>
                                <ul class="d-flex float-right">
                                    <li> <strong>{{ (@$refund_detail->order_package->seller->SellerAccount->seller_shop_display_name) ? @$refund_detail->order_package->seller->SellerAccount->seller_shop_display_name : @$order_package->seller->first_name }}</strong> </li>
                                </ul>
                            </div>
                            <div class="QA_section QA_section_heading_custom check_box_table">
                                <div class="QA_table ">
                                    <!-- table-responsive -->
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th scope="col">{{ __('common.sl') }}</th>
                                                    <th scope="col">{{ __('common.photo') }}</th>
                                                    <th scope="col">{{ __('common.name') }}</th>
                                                    <th scope="col">{{ __('refund.return_qty') }}</th>
                                                    <th scope="col">{{ __('common.subtotal') }}</th>
                                                    <th scope="col">{{ __('refund.reason') }}</th>
                                            </tr>
                                            @foreach ($refund_detail->refund_products as $key => $package_product)
                                                <tr>
                                                    <td>{{ getNumberTranslate($key+1) }}</td>
                                                    <td>
                                                        <div class="product_img_div">
                                                            @if (@$package_product->seller_product_sku->sku->product->product_type == 1)
                                                                <img src="{{showImage(@$package_product->seller_product_sku->sku->product->thumbnail_image_source)}}" alt="#">
                                                            @else
                                                                <img src="{{showImage(@$package_product->seller_product_sku->sku->variant_image?@$package_product->seller_product_sku->sku->variant_image:@$package_product->seller_product_sku->sku->product->thumbnail_image_source)}}" alt="#">
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">{{ @$package_product->seller_product_sku->product->product_name }}</td>
                                                    <td class="text-nowrap">{{ getNumberTranslate($package_product->return_qty) }}</td>
                                                    <td class="text-nowrap">{{ single_price($package_product->return_amount) }}</td>
                                                    <td class="text-nowrap">{{ @$package_product->refund_reason->reason }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table-borderless clone_line_table ml-auto">
                                <tr>
                                    <td><strong>{{__('Refund Summary')}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="info_tbl">{{__('order.subtotal')}}</td>
                                    @php
                                        $subtotal = $refund_detail->refund_request->total_return_amount - $refund_detail->order_package->shipping_cost;
                                    @endphp
                                    <td>: {{single_price($subtotal)}}</td>
                                </tr>
                                <tr>
                                    <td class="info_tbl">{{__('common.shipping_charge')}}</td>
                                    <td>: {{single_price($refund_detail->order_package->shipping_cost)}}</td>
                                </tr>
                                @if($seller_commision > 0)
                                <tr>
                                    <td class="info_tbl">{{__('common.commision')}}</td>
                                    <td>: -{{single_price($seller_commision)}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="info_tbl">{{__('order.grand_total')}}</td>
                                    <td>: {{single_price($refund_detail->refund_request->total_return_amount - $seller_commision)}}</td>
                                </tr>
                                
                            </table>
                        </div>
                        
                    </div>
                    <div class="row mt-30">
                        <div class="col-md-12">
                            <h5>{{ __('refund.additional_info') }}</h5>
                            <p>{{ @$refund_detail->refund_request->additional_info }}</p>
                        </div>
                    </div>
                    @if($refund_detail->refund_request && $refund_detail->refund_request->refund_images)
                    <div class="col-12">
                        <div class="refund-images">
                            @foreach($refund_detail->refund_request->refund_images as $refund_images)
                                <div class="refund-image">
                                    <a href="{{showImage($refund_images->image)}}" data-fancybox="gallery">
                                    <img src="{{showImage($refund_images->image)}}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                </div>
            </div>
            @if (permissionCheck('refund.update_refund_detail_state_by_seller'))
                <div class="col-lg-4 student-details">
                    <form action="{{ route('refund.update_refund_detail_state_by_seller', $refund_detail->id) }}" method="post">
                        @csrf
                        <div class="row white_box p-25 ml-0 mr-0 box_shadow_white">
                            @if($refund_detail->refund_request->is_confirmed == 0)
                            <div class="col-lg-12">
                                <div class="primary_input">
                                    <label class="primary_selectlabel alert alert-warning">
                                        {{__('refund.status_is_changable_after_confirmed_the_refund_request')}}
                                    </label>
                                </div>
                            </div>
                            @endif
                            <div class="col-lg-12 p-0">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for=""> <strong>{{ __('refund.processing_state') }}</strong> </label>
                                    <select required class="primary_select mb-25" name="processing_state" id="processing_state" @if($refund_detail->refund_request->is_confirmed == 0 || $refund_detail->refund_request->is_confirmed == 2 || $refund_detail->processing_state == 3) disabled @endif>
                                        <option value="">{{ __('common.select')}}</option>
                                        @foreach ($processes as $key => $process)
                                            <option value="{{ $process->id }}" @if ($refund_detail->processing_state == $process->id) selected @endif>{{ $process->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 p-0">
                                <button class="primary_btn_2"><i class="ti-check"></i>{{ __('common.update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</section>
@push("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    setTimeout(function () {
        window.location.reload();
    }, 15000);
}
$('[data-fancybox="gallery"]').fancybox({
    buttons: [
        "slideShow",
        "thumbs",
        "zoom",
        "fullScreen",
        "share",
        "close"
    ],
    loop: false,
    protect: true
});
</script>
@endpush
@endsection
