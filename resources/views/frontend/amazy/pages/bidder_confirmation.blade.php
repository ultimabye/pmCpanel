@extends('frontend.amazy.layouts.app')
@section('title')
 {{'Bidder Confirmation'}}
@endsection
@section('content')

<div class="text-center container mt_30 mb_30">
    <h1>Winner of Auction</h1>
    <h3>Please confirm your order by clicking below button</h3>
</div>
<div class="container mt_30 mb_30 min-vh-50 text-center">
    <a href="{{route('auctionproducts.confirm.order',[$auction_id,$bid_id])}}" class="amaz_primary_btn min_200 style2 cursor_pointer" data-value="">{{__('defaultTheme.auction_confirmation')}}</a>
    {{-- <button id="auction_order_confirm" class="amaz_primary_btn min_200 style2 cursor_pointer" data-auction_id="{{$auction_id}}" data-bid_id="{{$bid_id}}">{{__('defaultTheme.auction_confirmation')}}</button> --}}
    <a href="{{route('auctionproducts.cancel.order',[$auction_id,$bid_id])}}" class="amaz_primary_btn min_200 style2 cursor_pointer" data-value="">{{__('defaultTheme.auction_cancel')}}</a>
</div>
@endsection

@push('scripts')
    <script>
        // (function($){

        //     "use strict";

        //     $(document).ready(function(){
        //         $(document).on('click', "#auction_order_confirm", function() {
        //             event.preventDefault();
        //             var auction_id = $(this).data('auction_id');
        //             var bid_id = $(this).data('bid_id');
        //             console.log(auction_id+"-----"+bid_id);
        //             $('#pre-loader').show();
        //                 $.post('{{ route('auctionproducts.confirm.order') }}', {_token:'{{ csrf_token() }}', auction_id:auction_id,bid_id:bid_id}, function(data){
        //                     // $(".add-product-to-cart-using-modal").html(data);
        //                     // $("#theme_modal").modal('show');
        //                     // $('.nc_select, .select_address, #product_short_list, #paginate_by').niceSelect();
        //                     // $("."+className).prop("disabled", false);
        //                     $('#pre-loader').hide();
        //                     console.log(data);
        //                     // addToCart($(this).attr('data-product-sku'),$(this).attr('data-seller'),min_qty,$(this).attr('data-base-price'),0,'product',prod_info)
        //                 });
        //         });
        //     });
        // })(jQuery);
    </script>
@endpush
