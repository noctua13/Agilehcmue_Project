<?php

/**
 * PAYPAL API SERVICE TEST
 */

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
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

    public function thanhToan()
    {
        $productList = Session::get('Cart');
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
        

        /*$data = [
            [
                'name' => 'Vinataba',
                'quantity' => 1,
                'price' => 1.5,
                'sku' => '1'
            ],
            [
                'name' => 'Marlboro',
                'quantity' => 1,
                'price' => 1.6,
                'sku' => '2'
            ],
            [
                'name' => 'Esse',
                'quantity' => 1,
                'price' => 1.8,
                'sku' => '3'
            ]
        ];*/

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