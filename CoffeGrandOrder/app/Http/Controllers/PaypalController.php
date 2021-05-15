<?php

/**
 * PAYPAL API SERVICE TEST
 */

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PaypalService as PayPalSvc;
use Session;

class PaypalController extends Controller
{

    private $paypalSvc;

    public function __construct(PayPalSvc $paypalSvc)
    {
        //parent::__construct();

        $this->paypalSvc = $paypalSvc;
    }

    public function thanhToan(Request $request)
    {
        //code from function POSTORDER
        /*$order = new Order();
        if (Auth::check()) 
        {
            $order->userid = Auth::user()->id;
        }
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->status = "pending";
        $order->address = $request->address;
        $order->deliverytype = $request->delivery;
        $sum = 0;

        $myCart = Session::get('Cart');
        foreach($myCart as $item)
        {
            $indivCost = $item['price'];
            $sum += $item['quantity'] * $indivCost;
        }
            $order->price = $sum;
        
        $date = date_create();

        $order->orderdate = $date;
        $order->save();
        $productList = Session::get('Cart');
        foreach ($productList as $key => $value) 
        {
            $proorderProduct = new Ordercontent();
            $proorderProduct->orderid = $order->id;
            $proorderProduct->productid = $value['id'];
            $proorderProduct->quantity = $value['quantity'];
            $proorderProduct->price = $value['price'];
           $proorderProduct->size = $value['size'];
           $proorderProduct->customizable = $value['customizable'];
            $proorderProduct->save();
       }*/
        //////////
        
        //code move -> paypal
        
        if ($productList == NULL){
            return redirect("../products.html");
        }
        //Create a array with some product within;
        $data = array();
        foreach ($productList as $value) 
        {
            $cost = (double)($value['price'] / 23000);
                $ele = [
                    'name' => $value['name'],
                    'quantity' => $value['quantity'],
                    'price' => $cost,
                    'sku' => $value['id']
                ];
                //echo $value['quantity'];
                array_push($data, $ele);
        }

        //description for transaction, miêu tả lại cái trans này dùng làm gì
        $transactionDescription = "Paypal payment";

        //Khởi tạo các đường dẫn khả dụng, cũng như các hàm phương thức có thể
        //được thực hiện
        $paypalCheckoutUrl = $this->paypalSvc
                                  // ->setCurrency('eur')
                                  ->setReturnUrl(url('paypal/status'))
                                  // ->setCancelUrl(url('paypal/status'))
                                  ->setItem($data)
                                  // ->setItem($data[0])
                                  // ->setItem($data[1])
                                  ->createPayment($transactionDescription);

        if ($paypalCheckoutUrl) {

            return redirect($paypalCheckoutUrl);
        } else {
            dd(['Error']);
        }
    }

    public function status()
    {
        $paymentStatus = $this->paypalSvc->getPaymentStatus();
        if ($paymentStatus == NULL){
				
            return redirect('../products.html');
        }
        Session::forget('Cart');
        return view('paymentPage')->with('idTrans',$paymentStatus->id);
        //return $paymentStatus;
    }

    public function paymentList()
    {
        $limit = 10;
        $offset = 0;

        $paymentList = $this->paypalSvc->getPaymentList($limit, $offset);

        dd($paymentList);
    }

    public function paymentDetail($paymentId)
    {
        $paymentDetails = $this->paypalSvc->getPaymentDetails($paymentId);

        dd($paymentDetails);
    }
}