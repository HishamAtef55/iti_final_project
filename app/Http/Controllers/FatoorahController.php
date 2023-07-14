<?php

namespace App\Http\Controllers;

use App\Http\Services\FatoorahServices;
use App\Models\Order;
use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;
// use FatoorahServices;
use Illuminate\Http\Request as httpRequest;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FatoorahController extends Controller
{
    private $base_url;


    private $header;
    private $request_client;

    // private $fatoorahServices;
    public function __construct(Client $request_client)
    {
        // dd(env('fatoorah_token'));
        $this->request_client=$request_client;
        $this->base_url=env('fatoorah_base_url');
        $this->header=[
            'Content-Type'=>'application/json',
            'authorization'=>'Bearer ' . env('fatoorah_token')
        ];

    }
    public function payOrder($id){

        $order=Order::find($id);
        $user=User::find(Auth::id());

        $data=[
        'CustomerName' =>$user->name,
        'NotificationOption' => 'Lnk',
        'InvoiceValue' =>$order->total_price,
        'MobileCountryCode'  => '+20',
        'CustomerMobile'     =>$user->phone,
        'CustomerEmail'=> 'salimeslam55@gmail.com',
        'CallBackUrl'=> 'http://127.0.0.1:8000/api/call_back',
        'ErrorUrl' => 'http://127.0.0.1:8000/api/erorr',
        'Language' => 'en',
        'DisplayCurrencyIso' => 'Egp',

       ];

       $responce=$this->sendPayment($data);

       $link=$responce['Data']['InvoiceURL'];

       $InvoiceId=$responce['Data']['InvoiceId'];
       Transaction::create([
        'user_id'=>$user->id,
        'order_id'=>$id,
        'InvoiceId'=>$InvoiceId
       ]);
        return Redirect::to($link);

    }
    public function call_back(httpRequest $request){
        $paymentId=$request->paymentId;
        $data=[];
        $data['Key']=$paymentId;
        $data['KeyType']='paymentId';
        $status=$this->getPaymentStatus($data);
        $InvoiceId=$status['Data']['InvoiceId'];
        $transaction=Transaction::where('InvoiceId',$InvoiceId)->skip(0)->take(1)->get();
        $order_id=$transaction[0]->order_id;
       $order=Order::find($order_id);
       $order->update(['status' => 'paid']);
       $packages= $order->packages()->get();

       foreach ($packages as $package) {
           # code...
           $order->packages()->updateExistingPivot($package->id, [
            'start_date' => Carbon::now(),
            'status'=>'active'
           ]);
        }
      return redirect()->route('home') ;
    }
    public function error(httpRequest $request){
        $paymentId=$request->paymentId;
        $data=[];
        $data['Key']=$paymentId;
        $data['KeyType']='paymentId';
        $status=$this->getPaymentStatus($data);
        $InvoiceId=$status['Data']['InvoiceId'];
        $transaction=Transaction::where('InvoiceId',$InvoiceId)->skip(0)->take(1)->get();
        $order_id=$transaction[0]->order_id;
       $order=Order::find($order_id);
       $order->update(['status' => 'paid']);

      return redirect()->route('cart') ;
    }

    private function buildRequest($uri,$method,$data=[]){

        $request=new Request($method,$this->base_url.$uri,$this->header);
        if (!$data) {
            return false;
        }
        $response=$this->request_client->send($request,[
            'json'=>$data
        ]);
        if ($response->getStatusCode() !==200) {
            return false;
        }
        $response=json_decode($response->getBody(),true);
        return $response;
    }


    // private function parsePaymentData(){

    // }

    public function sendPayment($data){
       return $response=$this->buildRequest('v2/SendPayment','POST',$data);
    }
    public function getPaymentStatus($data){
        return $response=$this->buildRequest('v2/getPaymentStatus','POST',$data);
    }
}
