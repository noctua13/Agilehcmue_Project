<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Order;
use App\Ordercontent;
use App\Services\PaypalService as PayPalSvc;

 use Mail;
use Session;
// use Twilio\Rest\Client;

class ProductController
{
	// //Store Contact content on the Contact table
	// public function createContact(Request $request) {
	// 	$this->validate($request, array(
 //          'fullname'=>'required',
 //          'email' => 'required|email',
 //          'body' => 'required|max:500',
 //        ));
	// 	$contact = new Contact();
	// 	$contact->fullname = $request->fullname;
	// 	$contact->email = $request->email;
	// 	$contact->body = $request->body;
	// 	$contact->save();
	// 	$data = array(
	//       'name'=>$request->fullname,
	//       'email'=>$request->email,
	//       'content'=>$request->body,
	//     );

	//     Mail::send('thanh.email.contact', $data, function($message){
	//       $message->to('chaunguyen999665@gmail.com', 'Admin')->subject("Test");
	//       $message->from('chaunguyen999665al@gmail.com', 'Edumate_Project');
	//     });
	//     //return redirect('chau/contact.html');
	//     Mail::send('thanh.email.contactUser', $data, function($messageEx) use ($data){
	//       $messageEx->to($data['email'], 'User')->subject("Testuser");
	//       $messageEx->from('chaunguyen999665al@gmail.com', 'Edumate_Project');
	//     });
	// 	return redirect('contact.html');
	// }
	public function getProductsForHome() {
			// $products = Product::select('name', 'description', 'image','id')->orderBy('created_at', 'desc')->take(3)->get();
			// //dd($products);
			// 
			$analize = DB::table('ordercontents')
			->select('productid', DB::raw('SUM(quantity)as sum'),'products.name','products.image','products.description')
			->join('products', 'ordercontents.productid', '=', 'products.id')
			->groupBy('ordercontents.productid','products.name','products.image','products.description')
            ->orderBy('ordercontents.productid','asc') 
            ->take(3)          
            ->get();
            return view('home', compact('analize'));	
			// $analize = Ordercontent::selectRaw('productid, sum(quantity) as sum')->groupBy('productid')->orderBy('productid','desc')->get();
			// dd($analize);

	}
	public function analize() {
			// $products = Product::select('name', 'description', 'image','id')->orderBy('created_at', 'desc')->take(3)->get();
			// //dd($products);
			// 
			$analize = DB::table('ordercontents')
				->select('productid', DB::raw('SUM(quantity)as sum'),'products.name','products.image','products.description')
				->join('products', 'ordercontents.productid', '=', 'products.id')
				->join('orders', 'ordercontents.orderid', '=', 'orders.id')
				->where('orders.status','delivered')
				->groupBy('ordercontents.productid','products.name','products.image','products.description')
	            ->orderBy('ordercontents.productid','asc')          
	            ->get();

			$analizeToday = DB::table('ordercontents')
				->select('productid', DB::raw('SUM(quantity)as sum'),'products.name','products.image','products.description')
				->join('products', 'ordercontents.productid', '=', 'products.id')
				->join('orders', 'ordercontents.orderid', '=', 'orders.id')
				->where('orders.status','delivered')
				->whereDay('orders.updated_at', '=', date('d'))->whereMonth('orders.updated_at', '=', date('m'))->whereYear('orders.updated_at', '=', date('Y'))
				->groupBy('ordercontents.productid','products.name','products.image','products.description')
	            ->orderBy('ordercontents.productid','asc')          
	            ->get();

            $analizeThisMonth = DB::table('ordercontents')
				->select('productid', DB::raw('SUM(quantity)as sum'),'products.name','products.image','products.description')
				->join('products', 'ordercontents.productid', '=', 'products.id')
				->join('orders', 'ordercontents.orderid', '=', 'orders.id')
				->where('orders.status','delivered')
				->whereMonth('orders.updated_at', '=', date('m'))->whereYear('orders.updated_at', '=', date('Y'))
				->groupBy('ordercontents.productid','products.name','products.image','products.description')
	            ->orderBy('ordercontents.productid','asc')          
	            ->get();

            $analizeThisYear = DB::table('ordercontents')
				->select('productid', DB::raw('SUM(quantity)as sum'),'products.name','products.image','products.description')
				->join('products', 'ordercontents.productid', '=', 'products.id')
				->join('orders', 'ordercontents.orderid', '=', 'orders.id')
				->where('orders.status','delivered')
				->whereYear('orders.updated_at', '=', date('Y'))
				->groupBy('ordercontents.productid','products.name','products.image','products.description')
	            ->orderBy('ordercontents.productid','asc')          
	            ->get();
	        $billMonthPerYear = DB::select("SELECT MONTH(updated_at) as time, COUNT(updated_at) as bill 
				from orders 
				WHERE YEAR(updated_at) = YEAR(CURRENT_DATE()) 
				GROUP BY time");
            $billWeekPerMonth = DB::select("SELECT b.week as week, IFNULL(a.bill, 0) as bill
				FROM (SELECT WEEK(updated_at) as week, COUNT(updated_at) as bill from orders WHERE MONTH(updated_at) = MONTH(CURRENT_DATE()) AND YEAR(updated_at) = YEAR(CURRENT_DATE()) GROUP BY WEEK(updated_at)) AS a
				RIGHT JOIN
				(SELECT WEEK(week_field) as week FROM ( SELECT MAKEDATE(YEAR(NOW()),1) + INTERVAL (MONTH(NOW())-1) MONTH + INTERVAL weeknum WEEK week_field FROM ( SELECT t*10+u weeknum FROM (SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A, (SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) B ORDER BY weeknum ) AA ) AAA WHERE MONTH(week_field) = MONTH(NOW())) AS b
				ON a.week = b.week");
            $billDayPerWeek = DB::select("SELECT b.time as time, IFNULL(a.bill, 0) as bill
				FROM 
				(SELECT DAY(updated_at) as time, COUNT(updated_at) as bill 
				from orders
				WHERE MONTH(updated_at) = MONTH(CURRENT_DATE()) AND YEAR(updated_at) = YEAR(CURRENT_DATE()) AND WEEK(updated_at) = WEEK(CURRENT_DATE())
				GROUP BY DAY(updated_at)) AS a
				RIGHT JOIN
				(SELECT DAY(date_field) as time
				FROM
				(
				    SELECT
				        MAKEDATE(YEAR(NOW()),1) +
				        INTERVAL (MONTH(NOW())-1) MONTH +
				        INTERVAL daynum DAY date_field
				    FROM
				    (
				        SELECT t*10+u daynum
				        FROM
				            (SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,
				            (SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
				            UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
				            UNION SELECT 8 UNION SELECT 9) B
				        ORDER BY daynum
				    ) AA
				) AAA
				WHERE MONTH(date_field) = MONTH(NOW()) AND WEEK(date_field) = WEEK(NOW())) AS b
				ON a.time = b.time
				ORDER BY time");
            return view('admin.analytics', compact('analize','analizeToday','analizeThisMonth','analizeThisYear','billMonthPerYear','billWeekPerMonth',"billDayPerWeek"));	
			// $analize = Ordercontent::selectRaw('productid, sum(quantity) as sum')->groupBy('productid')->orderBy('productid','desc')->get();
			// dd($analize);

	}
	// //Show some latest products
	public function getProducts(Request $request) {
		if ( isset($request->type)){
			$products = Product::select('id', 'name', 'description', 'image', 'price','stock')->where('type', $request->type)->orderBy('created_at', 'desc')->take(10)->get();
			$types = Product::select('type')->orderBy('created_at', 'desc')->take(10)->distinct()->get();
			$gettype=$request->type;
			return view('products', compact('products','types','gettype'));
		}
		else {
			$products = Product::select('id', 'name', 'description', 'image', 'price','stock')->orderBy('created_at', 'desc')->take(10)->get();
			$types = Product::select('type')->orderBy('created_at', 'desc')->take(10)->distinct()->get();
			$gettype="";
			return view('products', compact('products','types','gettype'));
		}
		
	}

	// public function getProductsWithType() {
	// 	$products = Product::select('id', 'name', 'description', 'image', 'price','stock','type')->where('type', $type)->orderBy('created_at', 'desc')->take(10)->get();
	// 	$types = Product::select('type')->orderBy('created_at', 'desc')->take(10)->distinct()->get();
	// 	//$type = $type;
	// 	return view('products', compact('products','types'));
	// }
	
	//Show product base on id
	public function viewProduct($id) {
	 	$product = Product::select('id', 'name', 'description', 'image', 'price','stock')->where('id', $id)->first();
	// 	$popularProducts = Product::select('id', 'title', 'slug', 'price', 'image')->orderBy('price', 'desc')->where('slug', '<>', $slug)->take(4)->get();
		
	// 	$comments = Comment::select('id', 'user_id', 'object', 'object_id', 'comment', 'rating')->where([['object_id', '=', $product->id], ['object', '=', 'product']]);
	// 	$commentsPlusAvatar = User::joinSub($comments, 'comments', function ($join) {
	// 		$join->on('users.id', '=', 'comments.user_id');/*, 'popularProducts', 'commentsPlusAvatar'*/
	// 	})->get();
	//dd($product); 
	 	return view('product', compact('product' ));
	}
	
	// //Store Comment on the Comment table
	// public function createComment(Request $request) {
	// 	$comment = new Comment();
	// 	$comment->comment = $request->comment;
	// 	$comment->user()->associate($request->user());
	// 	$comment->object = $request->object;
	// 	$comment->object_id = $request->id;
	// 	$comment->rating = $request->rating;
	// 	$comment->parent = $request->parent;
	// 	$comment->status = $request->status;
	// 	$comment->save();
		
	// 	return back();
	// }
	
	///////////////////////////////////////////////
	//     CART AND CHANGE ORDER MANAGEMENT      //
	///////////////////////////////////////////////
	
	//Insert an item into the cart
	public function insertCart(Request $request) 
	{
	//get id and quantity sent from form
	$id = $request->id;
	$quantity = $request->quantity;
	$size = $request->size;
	$customizable = $request->customizable;
	
	//initialize list of products in cart
	$productList = array();
	
	//get product detail from id
	$productDetail = Product::where('id', $id)->first();

	//if cart exists, add item into cart
	if (Session::has('Cart')) 
	{			
		//store current cart into productList
		$productList = Session::get('Cart');
		//check if product already in cart
		$isProductExist = false;
		foreach($productList as &$product) 
		{
			if ($product['id'] == $id && $product['size'] == $size && $product['customizable'] == $customizable) 
			{
				$product['quantity'] = $product['quantity'] + $quantity;
				$isProductExist = true;
				break;
			}
		}
		if (!$isProductExist) 
		{
		//if the product is not in the cart yet
		//push new product into the cart
		array_push($productList, array('id' => $id, 'name' => $productDetail->name, 'price' => $productDetail->price, 'size' => $size, 'customizable' => $customizable, 'quantity' => $quantity, 'image' => $productDetail->image));
		}
	}
	//if cart does not exist, create one and put this product in
	else 
	{
		array_push($productList, array('id' => $id, 'name' => $productDetail->name, 'price' => $productDetail->price, 'size' => $size, 'customizable' => $customizable, 'quantity' => $quantity, 'image' => $productDetail->image));
	}
	//replace current session with new cart
	Session::forget('Cart');
	Session::put('Cart', $productList);
	return redirect()->route("products");
	}
	//Insert an item into the existing order
	public function insertOrderCart(Request $request) {
	//get id and quantity sent from form
	$id = $request->id;
	$quantity = $request->quantity;
	$size = $request->size;
	$customizable = $request->customizable;
	
	//initialize list of products in cart
	$productList = array();
	
	//get product detail from id
	$productDetail = Product::where('id', $id)->first();

	//if cart exists, add item into cart
	if (Session::has('OrderCart')) 
	{			
		//store current cart into productList
		$productList = Session::get('OrderCart');
		//check if product already in cart
		$isProductExist = false;
		foreach($productList as &$product) 
		{
			if ($product['id'] == $id && $product['size'] == $size && $product['customizable'] == $customizable) 
			{
				$product['quantity'] = $product['quantity'] + $quantity;
				$isProductExist = true;
				break;
			}
		}
		if (!$isProductExist) 
		{
		//if the product is not in the cart yet
		//push new product into the cart
		array_push($productList, array('id' => $id, 'name' => $productDetail->name, 'price' => $productDetail->price, 'size' => $size, 'customizable' => $customizable, 'quantity' => $quantity, 'image' => $productDetail->image));
		}
	}
	//if cart does not exist, create one and put this product in
	else 
	{
		array_push($productList, array('id' => $id, 'name' => $productDetail->name, 'price' => $productDetail->price, 'size' => $size, 'customizable' => $customizable, 'quantity' => $quantity, 'image' => $productDetail->image));
	}
	//replace current session with new cart
	Session::forget('OrderCart');
	Session::put('OrderCart', $productList);
	return redirect()->route("products");
	}
	
	//Remove an item from the cart
	public function deleteCart(Request $request) {
		$id = $request->id;
		$size = $request->size;
		$customizable = $request->customizable;
		
		$productList = Session::get('Cart');
		
		foreach($productList as $item => $value) 
		{
			if ($value['id'] == $id && $value['size'] == $size && $value['customizable'] == $customizable) 
			{
				unset($productList[$item]);
				break;
			}
		}
		Session::forget('Cart');
		Session::put('Cart', $productList);
		return redirect()->route("cart");
	}
	//Remove an item from the cart of an order
	public function deleteOrderCart(Request $request) {
		$id = $request->id;
		$size = $request->size;
		$customizable = $request->customizable;
		
		$productList = Session::get('OrderCart');
		
		foreach($productList as $item => $value) 
		{
			if ($value['id'] == $id && $value['size'] == $size && $value['customizable'] == $customizable) 
			{
				unset($productList[$item]);
				break;
			}
		}
		Session::forget('OrderCart');
		Session::put('OrderCart', $productList);
		return view('admin.order-content-update');
	}
	
	//Display cart content
	public function displayCart() 
	{
		$sum = 0;
		if (Session::has('Cart')) 
		{
			$myCart = Session::get('Cart');
			foreach($myCart as $item)
			{
				$indivCost = $item['price'];
				$sum += $item['quantity'] * $indivCost;
			}
		}
		return view('cart', compact('sum'));
	}
	//Loading the cart content into the admin.order-content-update UI
	public function displayOrderCart($id) 
	{
		$ordercontents = Ordercontent::where('orderid', $id)->get();
		if ($ordercontents->isEmpty()) return redirect()->route("order-history-by-id", ['id' => Auth::user()->id]);
		
		if (Session::has('OrderCart')) Session::forget('OrderCart');
		if (Session::has('OrderCartID')) Session::forget('OrderCartID');
		
		$productList = array();
		
		foreach ($ordercontents as $ordercontent) 
		{
			$productDetail = Product::where('id', $ordercontent->productid)->first();
			array_push($productList, array('id' => $ordercontent->productid, 'name' => $productDetail->name, 'price' => $ordercontent->price, 'size' => $ordercontent->size, 'customizable' => $ordercontent->customizable, 'quantity' => $ordercontent->quantity, 'image' => $productDetail->image));
		}
		Session::put('OrderCart', $productList);
		Session::put('OrderCartID', $id);
		return view('admin.order-content-update');
	}
	
	//Update the content of an item inside the cart
	public function updateCart(Request $request) 
	{
		$id = $request->id;
		$size = $request->size;
		$customizable = $request->customizable;
		$quantity = $request->quantity;
		$productList = Session::get('Cart');
		
		foreach($productList as $item => &$value) 
		{
			if ($value['id'] == $id && $value['size'] == $size && $value['customizable'] == $customizable) 
			{
				$value['quantity'] = $quantity;
				break;
			}
		}
		
		Session::forget('Cart');
		Session::put('Cart', $productList);
		return redirect()->route("cart");
	}
	//Update the content of an item inside an order
	public function updateOrderCart(Request $request) 
	{
		$id = $request->id;
		$size = $request->size;
		$customizable = $request->customizable;
		$quantity = $request->quantity;
		$productList = Session::get('OrderCart');
		
		foreach($productList as $item => &$value) 
		{
			if ($value['id'] == $id && $value['size'] == $size && $value['customizable'] == $customizable) 
			{
				$value['quantity'] = $quantity;
				break;
			}
		}
		
		Session::forget('OrderCart');
		Session::put('OrderCart', $productList);
		return view('admin.order-content-update');
	}
	
	//Remove all items inside the cart
	public function destroyCart() 
	{
		if (Session::has('Cart')) Session::forget('Cart');
		return redirect()->route("cart");
	}
	//Cancel changing order's content
	public function destroyOrderCart() 
	{
		if (Session::has('OrderCart')) Session::forget('OrderCart');
		if (Session::has('OrderCartID')) Session::forget('OrderCartID');
		return redirect()->route("order-history-by-id", ['id' => Auth::user()->id]);
	}
	
	// chau's; submit an order into the database
	//insert an order into the database
	public function postOrder(Request $request)
	{
	 	$order = new Order();
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
		$productList = Session::get('Cart');
		if ($productList == NULL){
			return redirect("../products.html");
		}
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

		$orderStr = json_encode($productList, JSON_UNESCAPED_SLASHES);;
		$orderStr = str_replace('"'," ",$orderStr);
		$orderStr = str_replace('[{',"",$orderStr);
		$orderStr = str_replace('}]',"",$orderStr);
		$orderStr = str_replace('},{','</p></br><p>',$orderStr);
		$data = array(
	     'name'=>$request->name,
	     'email'=>$request->email,
	     'phone'=>$request->phone,
	     'address'=>$request->address,
	     'delivery'=>$request->delivery,
	     'order'=>$orderStr,
	    );

		Mail::send('email.contact', $data, function($message){
	      $message->to('chaunguyen999665@gmail.com', 'Admin')->subject("Test");
	      $message->from('chaunguyen999665al@gmail.com', 'Agile_Project');
	    });
	     
	    Mail::send('email.contactUser', $data, function($messageEx) use ($data){
	      $messageEx->to($data['email'], 'User')->subject("Testuser");
	      $messageEx->from('chaunguyen999665al@gmail.com', 'Agile_Project');
	    });
		$method = $request->method;
		//dd($productList);
		
	 	

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
		}


//////// check method = paypal /////////
		if ($method == "Paypal")
		{
			
			$paypal = new PayPalSvc();
			
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
			$paypalCheckoutUrl = $paypal
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
//////// end check method = Paypal /////////
		else{
			Session::forget('Cart');
			return redirect()->route('products');
		}
	}

	//update an order's content into the database
	public function postOrderCart(Request $request)
	{
	 	$order = Order::where('id', Session::get('OrderCartID'))->first();
		$myCart = Session::get('OrderCart');
		$sum = 0;
		foreach($myCart as $item)
		{
			$indivCost = $item['price'];
			$sum += $item['quantity'] * $indivCost;
		}
	 	$order->price = $sum;

	 	$order->save();
	 	$productList = Session::get('OrderCart');
		$deletedRows = Ordercontent::where('orderid', Session::get('OrderCartID'))->delete();
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
		}


		Session::forget('OrderCart');
		Session::forget('OrderCartID');
		
		return redirect()->route('dashboard');
	}


	// 	$data = $request->validate([
 //            'name' => ['required', 'string', 'max:255'],
 //            'phone_number' => ['required', 'numeric'],
 //            //'password' => ['required', 'string', 'min:8', 'confirmed'],
 //        ]);

 //        /* Get credentials from .env */
 //        $token = getenv("TWILIO_AUTH_TOKEN");
 //        $twilio_sid = getenv("TWILIO_SID");
 //        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");

 //        $twilio = new Client($twilio_sid, $token);

 //        $twilio->verify->v2->services($twilio_verify_sid)
 //            ->verifications
 //            ->create($data['phone_number'], "sms");

 //        // User::create([
 //        //     'name' => $data['name'],
 //        //     'phone' => $data['phone_number'],
 //        //     //'password' => Hash::make($data['password']),
 //        // ]);

	// 	return redirect()->route('verify')->with(['phone_number' => $data['phone_number']]
	// 	);

	// }
	// protected function verify(Request $request)
 //   {
 //       $data = $request->validate([
 //           'verification_code' => ['required', 'numeric'],
 //           'phone_number' => ['required', 'string'],
 //       ]);

 //       /* Get credentials from .env */
 //       $token = getenv("TWILIO_AUTH_TOKEN");
 //       $twilio_sid = getenv("TWILIO_SID");
 //       $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");

 //       $twilio = new Client($twilio_sid, $token);

 //       $verification = $twilio->verify->v2->services($twilio_verify_sid)
 //           ->verificationChecks
 //           ->create($data['verification_code'], array('to' => $data['phone_number']));

 //       if ($verification->valid) {
 //           $user = tap(Order::where('delivery_phone', $data['phone_number']))->update(['verified' => 'true']);
 //           /* Authenticate user */
 //           //Auth::login($user->first());
 //           return redirect()->route('thanh-checkout')->with(['message' => 'Phone number verified.']);
 //       }
 //       return back()->with(['phone_number' => $data['phone_number'], 'error' => 'Invalid verification code entered!']);
 //   }
	
	// public function displayOrders (Request $request) {
	// 	$listOrder = Order::where('customer_id', '=', auth()->user()->id)->get();
	// 	return view('middleware.thanh.orders', compact('listOrder'));
	// }
	// 
// 	public function displayOrder ($id) {
// 		//get the details of the order
// 		$orderDetail = Order::where('id', '=', $id)->get();
// 		//get the products tie with the order
// 		$orderContent = OrderProduct::where('proorder_id', '=', $id);
// 		$orderContentwithImages = Product::joinSub($orderContent, 'content', function ($join) {
// 			$join->on('products.id', '=', 'content.product_id');
// 		})->get();
// 		return view('middleware.thanh.order', compact('orderDetail', 'orderContentwithImages'));
// 	}
	
	//////////////////////////////////////////////
	//              MANAGE PRODUCT              //
	//////////////////////////////////////////////
	public function viewProductAdmin($id) 
	{
	 	$product = Product::where('id', $id)->first();
	 	return view('admin.product-view', compact('product' ));
	}
	public function createProduct(Request $request) 
	{
		$file = $request->imagetoupload;
		$filename = $file->getClientOriginalName();
		$file->move(public_path() . '/product-images/' , $filename);
		
		$product= new Product();
		$product->name = $request->name;
		$product->description = $request->description;
		$product->stock = $request->stock;
		$product->image = $filename;
		$product->price = $request->price;
		$product->type = $request->type;
		$product->save();
		return redirect('/product-list.html');
	}
	public function getProductAdmin($id) 
	{
	 	$product = Product::where('id', $id)->first();
	 	return view('admin.product-edit', compact('product' ));
	}
	public function updateProduct(Request $request) 
	{
		$product = Product::where('id', $request->id)->first();
		$product->name = $request->name;
		$product->description = $request->description;
		$product->stock = $request->stock;
		
		if ($request->hasFile('imagetoupload')) {
			//remove old image
			$image_path = public_path("product-images/{$product->image}");
			if (File::exists($image_path)) {
				File::delete($image_path);
			}
			//replace with new image
			$file = $request->imagetoupload;
			$filename = $file->getClientOriginalName();
			$file->move(public_path() . '/product-images/' , $filename);
			//replace with new image name
			$product->image = $filename;
		}
		
		$product->price = $request->price;
		$product->type = $request->type;
		$product->save();
		return redirect('/product-list.html');
	}
	public function deleteProduct(Request $request) 
	{
		$product = Product::where('id', $request->id)->first();
		$image_path = public_path("product-images/{$product->image}");
		if (File::exists($image_path)) {
			File::delete($image_path);
		}
		$product->delete();
		return redirect('/product-list.html');
	}
	//////////////////////////////////////////////
	//   IN THE WRONG CONTROLLER ATM but meh    //
	//////////////////////////////////////////////
	/* Get info of a specific order */
	public function getOrderAdmin($id) 
	{
	 	$order = Order::where('id', $id)->first();
	 	return view('admin.order-update', compact('order'));
	}
	/* Update the bill's content */
	public function updateOrder(Request $request)
	{
		$order = Order::where('id', $request->id)->first();
		$order->name = $request->name;
		$order->email = $request->email;
		$order->phone = $request->phone;
		$order->deliverytype = $request->delivery;
		$order->address = $request->address;
		$order->save();
		return redirect()->route("order-history-by-id", ['id' => Auth::user()->id]);
	}
	/* Update the order's status */
	public function updateOrderStatus(Request $request)
	{
		$order = Order::where('id', $request->id)->first();
		$order->status = $request->status;
		$order->save();
		return back();
	}

	//View all Orders
	public function viewOrder($id) 
	{
		$orderdetail = Order::where('id', $id)->first();
		$ordercontents = Ordercontent::where('orderid', $id)->get();
		return view('admin.order-view', compact('orderdetail','ordercontents'));
	}
	//View Orders of a specific user
	public function viewOrderHistoryByID($id) 
	{
		$orders = Order::where('userid', $id)->get();
		return view('admin.order-history-by-id', compact('orders'));
	}
	//View Orders under a filter
	public function viewOrderHistoryToday() 
	{
		$orders = Order::whereDay('updated_at', '=', date('d'))->whereMonth('updated_at', '=', date('m'))->whereYear('updated_at', '=', date('Y'))->where('status','delivered')->get();
		return view('admin.order-history-by-id', compact('orders'));
	}
	public function viewOrderHistoryThisMonth() 
	{
		$orders = Order::whereMonth('updated_at', '=', date('m'))->whereYear('updated_at', '=', date('Y'))->where('status','delivered')->get();
		return view('admin.order-history-by-id', compact('orders'));
	}
	public function viewOrderHistoryThisYear() 
	{
		$orders = Order::whereYear('updated_at', '=', date('Y'))->where('status','delivered')->get();
		return view('admin.order-history-by-id', compact('orders'));
	}
	public function viewOrderHistoryByStatus($status) 
	{
		$orders = Order::where('status', $status)->get();
		//dd($orders); 
		return view('admin.order-history-by-id', compact('orders'));
	}
	public function viewOrderHistoryByDate($date) 
	{
		$tm =explode("-", $date);
		$day = $tm[0];
		$month = $tm[1];
		$year = $tm[2];

		if($year==0) {
			if ($month==0){
				if($day == 0){
					$orders = Order::where('status','delivered')->get();
				}
				else{
					$orders = Order::whereDay('updated_at', '=',$day)->where('status','delivered')->get();
				}
			}
			else if ($day==0){
				$orders = Order::whereMonth('updated_at', '=', $month)->where('status','delivered')->get();
			}
			else {
				$orders = Order::whereDay('updated_at', '=',$day)->whereMonth('updated_at', '=', $month)->where('status','delivered')->get();
			}		
		}
		else if ($month==0){
			if($day == 0){
					$orders = Order::where('status','delivered')->whereYear('updated_at', '=', $year)->get();
				}
				else{
					$orders = Order::whereDay('updated_at', '=',$day)->where('status','delivered')->whereYear('updated_at', '=', $year)->get();
				}
		}
		else if ($day==0){
			$orders = Order::whereMonth('updated_at', '=', $month)->whereYear('updated_at', '=', $year)->where('status','delivered')->get();
		}
		else{
			$orders = Order::whereDay('updated_at', '=',$day)->whereMonth('updated_at', '=', $month)->whereYear('updated_at', '=', $year)->where('status','delivered')->get();
		}
		return view('admin.order-history-by-id', compact('orders'));
	}
	
 }

?>