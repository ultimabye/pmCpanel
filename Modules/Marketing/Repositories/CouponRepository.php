<?php

namespace Modules\Marketing\Repositories;
use Carbon\Carbon;
use Modules\Marketing\Entities\Coupon;
use Modules\Marketing\Entities\CouponProduct;
use Modules\Seller\Entities\SellerProduct;

class CouponRepository {

    public function getAll(){
        $user = auth()->user();
        if($user->role->type == 'superadmin' || $user->role->type == 'admin' || $user->role->type == 'staff'){
            return Coupon::with('coupon_uses');
        }
        elseif($user->role->type == 'seller'){
            return Coupon::with('coupon_uses')->where('created_by',$user->id);
        }else{
            return [];
        }
    }
    public function getProduct(){

        $user = auth()->user();
        if($user->role->type == 'superadmin' || $user->role->type == 'admin' || $user->role->type == 'staff'){
            return SellerProduct::with('product', 'seller.role')->activeSeller()->get();
        }
        elseif($user->role->type == 'seller'){
            return SellerProduct::where('user_id',$user->id)->activeSeller()->get();
        }else{
            return [];
        }
    }
    public function store($data){
        $coupon = new Coupon();
        $data['title'] = $data['coupon_title'];
        $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d');
        $data['end_date'] = Carbon::parse($data['end_date'])->format('Y-m-d');
        $data['is_multiple_buy'] = isset($data['is_multiple'])?$data['is_multiple']:0;
        $coupon->fill($data)->save();
        if($data['coupon_type'] == 1){
            foreach($data['product_list'] as $product){
                CouponProduct::create([
                    'coupon_id' => $coupon->id,
                    'coupon_code' => $data['coupon_code'],
                    'product_id' => $product,
                ]);
            }
        }
        return true;
    }

    public function update($data){
        $coupon = Coupon::findOrFail($data['id']);
        $data['title'] = $data['coupon_title'];
        $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d');
        $data['end_date'] = Carbon::parse($data['end_date'])->format('Y-m-d');
        $data['is_multiple_buy'] = isset($data['is_multiple'])?$data['is_multiple']:0;
        $coupon->fill($data)->save();
        if($coupon->coupon_type == 1){
            $notselectpro = CouponProduct::where('coupon_id',$coupon->id)->whereNotIn('product_id',$data['product_list'])->pluck('id');
            CouponProduct::destroy($notselectpro);
            foreach($data['product_list'] as $key => $product){
                CouponProduct::where('coupon_id',$coupon->id)->updateOrCreate([
                    'coupon_id' => $coupon->id,
                    'coupon_code' => $data['coupon_code'],
                    'product_id' => $product,
                ]);
            }
        }
        return true;
    }

    public function editById($id){
        $seller_id = getParentSellerId();
        return Coupon::with(['products.product.seller','products.product.seller.role','products.product.product'])->where('id', $id)->where('created_by', $seller_id)->firstOrFail();
    }

    public function deleteById($id){
        $coupon = Coupon::findOrFail($id);
        if($coupon->coupon_type == 1){
            $products = $coupon->products->pluck('id');
            CouponProduct::destroy($products);
        }
        $coupon->delete();

        return true;
    }
}
