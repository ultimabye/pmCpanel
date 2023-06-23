<?php

namespace Modules\PaymentGateway\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repositories\OrderRepository;
use Modules\Wallet\Repositories\WalletRepository;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Account\Repositories\TransactionRepository;
use Modules\Account\Entities\Transaction;
use Modules\FrontendCMS\Entities\SubsciptionPaymentInfo;
use App\Traits\Accounts;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Modules\UserActivityLog\Traits\LogActivity;

class TabbyPaymentController extends Controller
{
    use Accounts;

    public function __construct()
    {
        $this->middleware('maintenance_mode');
    }  

    public function paymentProcess($data)
    {
        try {
            $credential = $this->getCredential();
            $currency_code = getCurrencyCode();
            $locale = app('general_setting')->language_code;
            if(\Session::has('locale')){
                $locale = \Session::get('locale');
            }
            if(auth()->check()){
                $locale = auth()->user()->lang_code;
            }
            $url = "https://api.tabby.ai/api/v2/checkout";
            $data = [
              "payment" => [
                    "amount" => $data['amount'], 
                    "currency" => $currency_code, 
                    // "currency" => "AED",
                    "buyer" => [
                       "phone" => auth()->user()->phone ?? "500000001",
                       "email" => auth()->user()->email ?? "card.success@tabby.ai", 
                       "name" => auth()->user()->first_name, 
                       "dob" => auth()->user()->date_of_birth 
                    ],  
                 ], 
              "lang" => $locale, 
              "merchant_code" => $credential->perameter_1, 
              "merchant_urls" => [
                    "success" => route('tabby.success'), 
                    "cancel" => route('tabby.canceled'), 
                    "failure" => route('tabby.failured')
                ], 
              "create_token" => false, 
              "token" => null 
           ]; 
            $response = Http::acceptJson()->withToken($credential->perameter_2)->post($url,$data);
            $response = json_decode($response);
            if ($response) {
                if ($response->configuration->available_products->installments[0]->web_url) {
                    return redirect()->to($response->configuration->available_products->installments[0]->web_url)->send();
                }
            }
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.operation_failed'));
            return redirect()->back();
        }
    }

    public function tabbySuccess(Request $request){
        $credential = $this->getCredential();
        $url = "https://api.tabby.ai/api/v2/payments/".$request->payment_id;
        $response = Http::acceptJson()->withToken($credential->perameter_2)->get($url);
        if (session()->has('wallet_recharge')) {
            $walletService = new WalletRepository;
            return $walletService->walletRecharge($response['amount'], $credential->method->id, $response['id']);
        }
        if (session()->has('order_payment')) {
            $amount = $response['amount'];
            $orderPaymentService = new OrderRepository;
            $order_payment = $orderPaymentService->orderPaymentDone($amount, $credential->method->id, $response['id'], (auth()->check())?auth()->user():null);
            if($order_payment == 'failed'){
                Toastr::error('Invalid Payment');
                return redirect(url('/checkout'));
            }
            $payment_id = $order_payment->id;
            $data['payment_id'] = encrypt($payment_id);
            $data['gateway_id'] = encrypt($credential->method->id);
            $data['step'] = 'complete_order';
            Toastr::success(__('common.payment_successfully'),__('common.success'));
            LogActivity::successLog('checkout payment successful.');
            return redirect()->route('frontend.checkout', $data);
        }
        if (session()->has('subscription_payment')) {
            $tnx_check = SubsciptionPaymentInfo::where('txn_id', $response['id'])->first();
            if($tnx_check){
                Toastr::error('Invalid Payment');
            }else{
                $defaultIncomeAccount = $this->defaultIncomeAccount();
                $seller_subscription = getParentSeller()->SellerSubscriptions;
                $transactionRepo = new TransactionRepository(new Transaction);
                $transaction = $transactionRepo->makeTransaction(getParentSeller()->first_name." - Subsriction Payment", "in", "Tabby", "subscription_payment", $defaultIncomeAccount, "Subscription Payment", $seller_subscription, $response['amount'], Carbon::now()->format('Y-m-d'), getParentSellerId(), null, null);
                $seller_subscription->update(['last_payment_date' => Carbon::now()->format('Y-m-d')]);
                SubsciptionPaymentInfo::create([
                    'transaction_id' => $transaction->id,
                    'txn_id' => $response['id'],
                    'seller_id' => getParentSellerId(),
                    'subscription_type' => getParentSeller()->sellerAccount->subscription_type,
                    'commission_type' => @$seller_subscription->pricing->name
                ]);
                session()->forget('subscription_payment');
                Toastr::success(__('common.payment_successfully'),__('common.success'));
                LogActivity::successLog('Subscription payment successful.');
            }
            return redirect()->route('seller.dashboard');
        }
        return redirect()->back();
    }
    public function tabbyFailed(Request $request){
        // $credential = $this->getCredential();
        // $url = "https://api.tabby.ai/api/v2/payments/".$request->payment_id;
        // $response = Http::acceptJson()->withToken($credential->perameter_2)->get($url);
        if (session()->has('wallet_recharge')) {
            if (auth()->user()->role->type == 'customer') {
                return redirect(url('wallet/customer/my-wallet-index'));
            } elseif (auth()->user()->role->type == 'seller') {
                return redirect(url('wallet/seller/my-wallet-index'));
            }elseif (auth()->user()->role->type == 'admin') {
                return redirect(url('wallet/admin/my-wallet-index'));
            }
            return redirect(url('/'));
        }elseif (session()->has('order_payment')) {
            return redirect(url('/checkout'));
        }elseif (session()->has('subscription_payment')) {
            return redirect()->route('seller.dashboard');
        }
        return redirect(url('/'));
    }
    public function tabbyCancel(Request $request){
        // $credential = $this->getCredential();
        // $url = "https://api.tabby.ai/api/v2/payments/".$request->payment_id;
        // $response = Http::acceptJson()->withToken($credential->perameter_2)->get($url);
        if (session()->has('wallet_recharge')) {
            if (auth()->user()->role->type == 'customer') {
                return redirect(url('wallet/customer/my-wallet-index'));
            } elseif (auth()->user()->role->type == 'seller') {
                return redirect(url('wallet/seller/my-wallet-index'));
            }elseif (auth()->user()->role->type == 'admin') {
                return redirect(url('wallet/admin/my-wallet-index'));
            }
            return redirect(url('/'));
        }elseif (session()->has('order_payment')) {
            return redirect(url('/checkout'));
        }elseif (session()->has('subscription_payment')) {
            return redirect()->route('seller.dashboard');
        }
        return redirect(url('/'));
    }
    private function getCredential(){
        $url = explode('?',url()->previous());
        if(isset($url[0]) && $url[0] == url('/checkout')){
            $is_checkout = true;
        }else{
            $is_checkout = false;
        }
        if(session()->has('order_payment') && app('general_setting')->seller_wise_payment && session()->has('seller_for_checkout') && $is_checkout){
            $credential = getPaymentInfoViaSellerId(session()->get('seller_for_checkout'), 'tabby');
        }else{
            $credential = getPaymentInfoViaSellerId(1, 'tabby');
        }
        return $credential;
    }
}