<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

use App\Models\Product;

use App\Models\Cart_products;

use App\Models\Orders;

use App\Models\Senior;

use App\Models\Payment;

use App\Models\Order_products;

use App\Models\Categories;

use App\Models\Subcategories;

use App\Mail\OverLimit;

use App\Mail\OverCredit;





class HomeController extends Controller
{
    public function redirect()
    {
        $usertype=Auth::user()->type;
        if($usertype=='1'){
            $data=product::all();
            return view('admin.showproduct', compact('data'));
        }
        else if ($usertype=='0'){
            $data = product::paginate(3);
            $user=auth()->user();
           
            return view('user.home', compact('data',));

        }
        else{
            $data = product::paginate(3);
            $senior=auth()->seniors();
            $count=cart_products::where('senior_fk',$senior->senior_id)->count();

            return view('senior.home',compact('data','count'));

        }
    }
    public function home(){
        $data = product::paginate(3); 
        return view('user.home', compact('data',));
    }


    public function about(){
       
        return view('user.about');
    }
    public function aboutsenior(Request $request){
        $senior_fk=$request->cookie('senior_id');
        $count=cart_products::where('senior_fk',$senior_fk)->count();
        return view('senior.about', compact('count'));
    }


    public function index(){
        if(Auth::id()){
            return redirect('redirect');
        }
        else{
            $data = product::paginate(3);
            return view('user.home',compact('data'));
        }
        
    }
    public function search(Request $request){
        $search=$request->search;
        $subcategories=subcategories::all();
        $categories=categories::all();
        if($search==''){
            $data = product::paginate(3);
            return view('user.allproductsuser',compact('data','subcategories','categories'));
        }
        $data=product::where('title','Like','%'.$search.'%')->get();

        return view('user.allproductsuser', compact('data','subcategories','categories'));
    }
    public function searchsenior(Request $request){
        $search=$request->search;
        $subcategories=subcategories::all();
        $categories=categories::all();
        $senior_fk=$request->cookie('senior_id');
        $count=cart_products::where('senior_fk',$senior_fk)->count();
        if($search==''){
            $data = product::paginate(3);
            return view('senior.allproducts',compact('data','subcategories','categories','count'));
        }
        $data=product::where('title','Like','%'.$search.'%')->get();

        return view('senior.allproducts', compact('data','subcategories','categories','count'));
    }
   
   
    
    public function showcart(Request $request){
        $senior_fk=$request->cookie('senior_id');
        $cart_products=cart_products::where('senior_fk',$senior_fk)->get();
        $count=cart_products::where('senior_fk',$senior_fk)->count();
        $products=Product::whereIn('id', $cart_products->pluck('product_fk'))->get(); 
        $price=0.00;
        $result=[];
        foreach($cart_products as $cart_product){
            $result[]=[
            'product' => $products->where('id', $cart_product->product_fk)->first(),
            'count' => $cart_product->quantity,
            'cartproduct_id'=>$cart_product->cartproduct_id,
            ];
            $products=Product::where('id', $cart_product->product_fk)->first();
            $price=$price+$cart_product->quantity*$products->price;
        }
        
        

        
        return view('senior.showcart',compact ('count','cart_products','products','result', 'price'));
    }
    public function deletecartproduct($cartproduct_id){
        $data=cart_products::find($cartproduct_id);
        $data->delete();
        return redirect()->back()->with('message','Prekė pašalinta iš krepšelio');
    }
    
    public function registerseniorform(){
        $data = product::paginate(3);
        return view('user.registerseniorform', compact('data'));
    }
    public function registersenior(Request $request){
        $request->validate([
            'login' => 'unique:seniors',
            
        ]);
        $data = product::paginate(3);
        if($request->password_confirmation==$request->password){
             $seniors=new Senior();
        $user=auth()->user();
        $data = product::paginate(3);
        $seniors->login=$request->login;
        $seniors->address=$request->address;
        $seniors->senior_password=Hash::make($request['password']);
        $seniors->user_fk=$user->user_id;
        
        $seniors->save();
        return view('user.home',compact('data'))->with('message','Senjoras užregistruotas sėkmingai');
        }
        else {
            return view('user.registerseniorform',compact('data'))->with('message','Slaptažodžiai nesutampa');
            
        }
        
        
    }

    public function loginchoice(){
        return view('user.loginchoice');
    }
    public function seniorloginform(){
        return view ('senior.seniorloginform');
    }
    public function seniorlogin(Request $request){
        $login=$request->login;
        $password=$request->password;
        $data = product::paginate(3);
        $senior=Senior::where('login', $login)->first();
        if(!$senior){
            return redirect()->back()->with('message','Klaidingas prisijungimo vardas arba slaptažodis.');
        }
        if($password==$senior->senior_password){   
            $senior_id=$senior->senior_id;
            $senior_fk=$request->cookie('senior_id');
            $count=cart_products::where('senior_fk',$senior_fk)->count();
            return response(view('senior.home', compact('data', 'count')))->cookie('senior_id', $senior_id, 180);
        }
        else {
            return redirect()->back()->with('message','Klaidingas prisijungimo vardas arba slaptažodis.');
        }
        
    }
    public function choosecategory(Request $request){
        $senior_fk=$request->cookie('senior_id');
        $count=cart_products::where('senior_fk',$senior_fk)->count();
        $categories=categories::all();
        
        return view('senior.choosecategory', compact('count', 'categories'));
    }
    public function choosesubcategory(Request $request, $category_id){
        $senior_fk=$request->cookie('senior_id');
        $count=cart_products::where('senior_fk',$senior_fk)->count();
        $subcategories=subcategories::where('category_fk', $category_id)->get();
        return view('senior.choosesubcategory', compact('count', 'subcategories'));
    }
    public function products(Request $request, $subcategory_id ){
        $senior_fk=$request->cookie('senior_id');
        $count=cart_products::where('senior_fk',$senior_fk)->count();
        $data=product::where('subcategory_fk',$subcategory_id)->get();
        $subcategory=subcategories::where('subcategory_id',$subcategory_id)->first();
        
        return view('senior.products', compact ('count','data','subcategory'));

    }
    public function allproducts(Request $request){
        $senior_fk=$request->cookie('senior_id');
        $count=cart_products::where('senior_fk',$senior_fk)->count();
        $data = product::paginate(3);
        $subcategory=subcategories::all();
        $subcategories=subcategories::all();
        $categories=categories::all();
        return view('senior.allproducts', compact ('count','data','subcategories','categories'));

    }
    public function allproductsuser(){
        $data = product::paginate(3);
        $subcategories=subcategories::all();
        $categories=categories::all();
        return view('user.allproductsuser', compact ('data','subcategories','categories'));
    }
    public function subcategoryuser($subcategory_id){
        $subcategories=subcategories::all();
        $categories=categories::all();
        $products=product::where('subcategory_fk',$subcategory_id)->get();
        $data = $products;
        return view('user.allproductsuser', compact ('data','subcategories','categories'));
        
    }
    public function subcategorysenior(Request $request, $subcategory_id){
        $subcategories=subcategories::all();
        $categories=categories::all();
        $products=product::where('subcategory_fk',$subcategory_id)->get();
        $data = $products;
        $senior_fk=$request->cookie('senior_id');
        $count=cart_products::where('senior_fk',$senior_fk)->count();
        return view('senior.allproducts', compact ('data','subcategories','categories', 'count'));
        
    }
    public function categorysenior(Request $request, $category_id){
        $subcategories=subcategories::all();
        $categories=categories::all();
        $senior_fk=$request->cookie('senior_id');
        $subcategory=subcategories::where('category_fk',$category_id)->get();
        $amount=[];
        $count=cart_products::where('senior_fk',$senior_fk)->count();
        foreach($subcategory as $subcategory){
            $amount[]=[
                $subcategory->subcategory_id,
            ];   
        }
        $products=product::where('subcategory_fk',$amount)->get();
        $data = $products;
        
        return view('senior.allproducts', compact ('data','subcategories','categories','count'));
        
    }
    public function categoryuser($category_id){
        $subcategories=subcategories::all();
        $categories=categories::all();
        $subcategory=subcategories::where('category_fk',$category_id)->get();
        $count=[];

        foreach($subcategory as $subcategory){
            $count[]=[
                $subcategory->subcategory_id,
            ];   
        }
        $products=product::where('subcategory_fk',$count)->get();
        $data = $products;
        return view('user.allproductsuser', compact ('data','subcategories','categories'));
        
    }

    public function seniorlogout(){
        
            $data = product::paginate(3);
            return view('user.home',compact('data'));
        
    }
    public function addcart(Request $request, $id){
        $data = product::paginate(3);
            $product=product::find($id);
            $cart_products= new cart_products;
            $cart_products->quantity=$request->quantity;
            $cart_products->product_fk=$product->id;
            $cart_products->senior_fk=$request->cookie('senior_id');
            $cart_products->save();
            
            return redirect()->back()->with('message','Produktas pridėtas sėkmingai');
    }
    public function seniorhome(Request $request){
        $data = product::paginate(3);
        $senior_fk=$request->cookie('senior_id');
        $count=cart_products::where('senior_fk',$senior_fk)->count();
        return view('senior.home',compact('data','count'));
    }
    public function showsenior(){
        $user=auth()->user();
        $seniors=senior::where('user_fk', $user->user_id)->get();
        
        return view('user.showsenior', compact('seniors'));
    }
    public function updateseniorform( $senior_id){
        $data=senior::find($senior_id);
        return view('user.updateseniorform',compact('data'));
    }
    public function updatesenior(Request $request, $senior_id){
        $data=senior::find($senior_id);

        $data->address=$request->address;
        $data->senior_limit=$request->limit;
        $data->save();
        $user=auth()->user();
        $seniors=senior::where('user_fk', $user->user_id)->get();
        return view('user.showsenior', compact('seniors'));

    }
   
    public function deletesenior($senior_id){
        $data=senior::where('senior_id',$senior_id)->first();
        $data->account_status="Neaktyvi";
        $data->update();
        
        return redirect()->back()->with('message','Senjoro paskyra deaktyvuota sėkmingai');
    }
       public function addcreditform($senior_id){
        $data=senior::find($senior_id);
           return view('user.addcreditform',compact('data'));
       }
       public function addcredit(Request $request, $senior_id){
           $data = senior::find($senior_id);
           $payment=new Payment();
           $money=$request->credit;
           $data->credit=$data->credit+$money;
           $data->save();
           $user=auth()->user();
           $payment->amount=$request->credit;
           $payment->payment_code=$request->payment_code;
           $payment->user_bill=$request->user_bill;
           $payment->user_fk=$user->user_id;
           $payment->senior_fk=$senior_id;
           $payment->save();
           return redirect()->back()->with('message','Senjoro kreditas papildytas sėkmingai');
       }
       public function changequantity(Request $request, $cartproduct_id){
        
       
            $cart_product=cart_products::where('cartproduct_id', $cartproduct_id)->first();
            
            $cart_product->update([
                'quantity'=>$request->quantity
                ]);
            
            return redirect('/showcart')->with('message','Kiekis pakeistas sėkmingai');
       }
       public function confirmcart(Request $request){
           $order=new Orders();
           $price=0.00;
           $senior_fk=$request->cookie('senior_id');
           $senior=senior::where('senior_id',$senior_fk)->first();
            $cart_products=cart_products::where('senior_fk',$senior_fk)->get();
            $order->senior_fk=$senior_fk;
            $order->user_fk=$senior->user_fk;
            $user=user::where('user_id',$senior->user_fk);
           
            foreach($cart_products as $cart_product){
                $products=Product::where('id', $cart_product->product_fk)->first();
               $price=$price+$cart_product->quantity*$products->price;
            }
            $order->price=$price;
            
            if($order->price>$senior->senior_limit){
                $order->status='Nepatvirtintas';
                Mail::to($user->first()->email)->send(new OverLimit($senior->login));
            }
            else if($order->price>$senior->credit){
                $order->status='Neapmokėtas';
                Mail::to($user->first()->email)->send(new OverCredit($senior->login));
            }
            else {
                $senior->credit=$senior->credit-$order->price;
                $senior->update();
                $order->status='Apmokėtas';
            }
            $order->save();
           
            foreach($cart_products as $cart_product){
                $order_product= new Order_products();
                $order_product->orderproduct_quantity=$cart_product->quantity;
                $order_product->product_fk=$cart_product->product_fk;
                $order_product->order_fk=$order->id;
                $order_product->save();
                
            }
            DB::table('cart_products')->where('senior_fk',$senior_fk)->delete();
            
            return redirect('/showcart')->with('message','Užsakymas pateiktas');

       }
       public function showseniororders($senior_id){
           
            $senior=senior::where('senior_id', $senior_id)->first();
            
           $orders=orders::where('senior_fk', $senior_id)->get();
           
           return view('user.showseniororders',compact ('senior','orders'));
       }
       public function showorder($id){
           $order_products=order_products::where('order_fk',$id)->get();
           
        $count=order_products::where('order_fk',$id)->get();
        $products=Product::whereIn('id', $order_products->pluck('product_fk'))->get(); 
        $result=[];
        foreach($order_products as $order_product){
            $result[]=[
            'product' => $products->where('id', $order_product->product_fk)->first(),
            'count' => $order_product->orderproduct_quantity,
            'orderproduct_id'=>$order_product->orderproduct_id,
            ];
        }
        
        return view('user.showorder',compact ('count','order_products','products','result'));
       }
       public function showorderandconfirm($id){
       
        $order_products=order_products::where('order_fk',$id)->get();
        
     $count=order_products::where('order_fk',$id)->get();
     $products=Product::whereIn('id', $order_products->pluck('product_fk'))->get(); 
     $result=[];
     foreach($order_products as $order_product){
         $result[]=[
         'product' => $products->where('id', $order_product->product_fk)->first(),
         'count' => $order_product->orderproduct_quantity,
         'orderproduct_id'=>$order_product->orderproduct_id,
         ];
     }
     $order_id=$id;
     
     return view('user.showorderandconfirm',compact ('count','order_products','products','result','order_id'));
    }
    public function deleteorderproduct($orderproduct_id){
        $data=order_products::find($orderproduct_id);
        $data->delete();
        return redirect()->back()->with('message','Prekė pašalinta iš krepšelio');
    }
    public function confirmorder($order_id){
        $order=Orders::where('id', $order_id)->first();
        
        $senior=Senior::where('senior_id', $order->senior_fk)->first();
        if ($senior->credit>$order->price){
            $senior->credit=$senior->credit-$order->price;
            $order->status="Apmokėtas";
        }
        else{
            $order->status="Neapmokėtas";
        }
        $senior->update();
        $order->update();
        $orders=orders::where('senior_fk', $senior->senior_id)->get();
        return view('user.showseniororders',compact ('senior','orders'));
    }
       

}
