<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File; 
use App\Product;
use App\Order;
use App\Ordercontent;

// use Mail;
use Session;
// use Twilio\Rest\Client;

class ProductController
{
	// //get a list of posts: get 8 latest posts
	// public function getPosts(Request $request) {
	// 	if ($request->has('id')) 
	// 	{
	// 		$posts = Post::select('id','title','excerpt','image','status','created_at')->where('category_id', $request->id)->take(8)->get(); 
	// 		return view('thanh.site.blogs', compact('posts'));
	// 	}
	// 	else
	// 	{
	// 		$posts = Post::select('id','title','excerpt','image','status','created_at')->orderBy('created_at', 'desc')->take(8)->get();
	// 		return view('site.blogs', compact('posts'));
	// 	}
	// }

	// //view post with "id" provided, get categories and 4 latest posts
	// public function viewPost($id) {
	// 	//get post with id provided
	// 	$post = Post::where('id', $id)->first();
	// 	//get 4 latest posts
	// 	$latestPosts = Post::orderBy('created_at', 'desc')->take(4)->get();
	// 	//get categories
	// 	$categories = Category::orderBy('created_at', 'desc')->take(4)->get();
	// 	return view('site.blog', compact('post', 'latestPosts', 'categories'));
	// }
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
	
	public function insertCart(Request $request) {
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
	//Only update individual product
	public function updateCart(Request $request) {
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
	
	public function destroyCart() 
	{
		if (Session::has('Cart')) Session::forget('Cart');
		return redirect()->route("cart");
	}
	
	// //chau's; submit an order into the database
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
		}
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

	public function viewProductAdmin($id) {
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

	public function getProductAdmin($id) {
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
	////////////////////////////////////
	//   IN THE WRONG CONTROLLER ATM  //
	////////////////////////////////////
	public function updateOrderStatus(Request $request)
	{
		$order = Order::where('id', $request->id)->first();
		$order->status = $request->status;
		$order->save();
		return back();
	}
	public function viewOrder($id) 
	{
		$orderdetail = Order::where('id', $id)->first();
		$ordercontents = Ordercontent::where('orderid', $id)->get();
		return view('admin.order-view', compact('orderdetail','ordercontents'));
	}
	public function viewOrderHistoryByID($id) 
	{
		$orders = Order::where('userid', $id)->get();
		return view('admin.order-history-by-id', compact('orders'));
	}

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