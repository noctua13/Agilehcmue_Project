<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File; 
use App\Product;

// use Mail;
// use Session;
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
	public function getProducts() {
		$products = Product::select('id', 'name', 'description', 'image', 'price','stock','type')->orderBy('created_at', 'desc')->take(10)->get();
		$types = Product::select('type')->orderBy('created_at', 'desc')->take(10)->distinct()->get();
		return view('products', compact('products','types'));
	}
	
	
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
	
	// public function insertCart(Request $request) {
	// 	//get id and quantity sent from form
	// 	$id = $request->id;
	// 	$quantity = $request->quantity;
	// 	//initialize list of products in cart
	// 	$productList = array();
	// 	//get product detail from id
	// 	$productDetail = Product::where('id', $id)->first();

	// 	//if cart exists, add item into cart
	// 	if (Session::has('myCart')) 
	// 	{			
	// 		//store current cart into productList
	// 		$productList = Session::get('myCart');
	// 		//check if product already in cart
	// 		$isProductExist = false;
	// 		foreach($productList as &$product) 
	// 		{
	// 			if ($product['id'] == $id) 
	// 			{
	// 				$product['quantity'] = $product['quantity'] + $quantity;
	// 				$isProductExist = true;
	// 				break;
	// 			}
	// 		}
	// 		if (!$isProductExist) 
	// 		{
	// 		//if the product is not in the cart yet
	// 		//push new product into the cart
	// 		array_push($productList, array('id' => $id, 'title' => $productDetail->title, 'price' => $productDetail->price, 'description' => $productDetail->description, 'image' => $productDetail->image, 'quantity' => $quantity));
	// 		}
	// 	}
	// 	//if cart does not exist, create one and put this product in
	// 	else 
	// 	{
	// 		array_push($productList, array('id' => $id, 'title' => $productDetail->title, 'price' => $productDetail->price, 'image' => $productDetail->image, 'description' => $productDetail->description, 'quantity' => $quantity));
	// 	}
	// 	//replace current session with new cart
	// 	Session::forget('myCart');
	// 	Session::put('myCart', $productList);
	// 	return redirect()->route("thanh-products");
		
	// }
	
	// public function deleteCart(Request $request) {
	// 	$id = $request->id;
	// 	$productList = Session::get('myCart');
		
	// 	foreach($productList as $item => $value) 
	// 	{
	// 		if ($value['id'] == $id) 
	// 		{
	// 			unset($productList[$item]);
	// 			break;
	// 		}
	// 	}
	// 	Session::forget('myCart');
	// 	Session::put('myCart', $productList);
	// 	return redirect()->route("thanh-cart");
	// }
	
	// public function displayCart() {
	// 	$sum = 0;
	// 	if (Session::has('myCart')) 
	// 	{
	// 		$myCart = Session::get('myCart');
	// 		foreach($myCart as $item)
	// 		{
	// 			$rs= $item['price'];
	// 			$sum += $item['quantity'] * $rs;
	// 		}
	// 	}
	// 	return view('site.cart', compact('sum'));
	// }
	
	// public function updateCart(Request $request) {
	// 	$id = $request->id;
	// 	$quantity = $request->quantity;
	// 	$productList = Session::get('myCart');
		
	// 	foreach($productList as $item => &$value) 
	// 	{
	// 		if ($value['id'] == $id) 
	// 		{
	// 			$value['quantity'] = $quantity;
	// 			break;
	// 		}
	// 	}
		
	// 	Session::forget('myCart');
	// 	Session::put('myCart', $productList);
	// 	return redirect()->route("thanh-cart");
	// }
	
	// public function destroyCart() {
	// 	if (Session::has('myCart')) Session::forget('myCart');
	// 	return redirect()->route("thanh-cart");
	// }
	// //chau's; submit an order into the database
	// public function postOrder(Request $request){
		
	// 	$order = new Order();
	// 	$order->delivery_name = $request->name;
	// 	$order->delivery_email = $request->email;
	// 	$order->delivery_phone = $request->phone_number;
	// 	$order->verified = "false";
	// 	$order->delivery_address = $request->address;
	// 	$order->delivery_province = $request->city;
	// 	$order->delivery_district = $request->district;
	// 	$order->promotion = $request->discode;
	// 	$order->total = $request->totalprice;
	// 	$order->note = $request->note;
	// 	$order->save();
	// 	$productList = Session::get('myCart');
	// 	foreach ($productList as $key => $value) 
	// 	{
	// 		$proorderProduct = new OrderProduct();
	// 		$proorderProduct->order_id = $order->id;
	// 		$proorderProduct->product_id = $value['id'];
	// 		$proorderProduct->quantity = $value['quantity'];
	// 		$proorderProduct->price = $value['price'];
	// 		$proorderProduct->total = $value['quantity'] * $value['price'];
	// 		$proorderProduct->save();
	// 	}


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
 }

?>