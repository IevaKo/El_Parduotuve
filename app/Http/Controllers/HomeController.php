<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

use App\Models\User;

use App\Models\Product;

use App\Models\Cart_products;

use App\Models\Orders;

use App\Models\Senior;

use App\Models\Payment;

use App\Models\Order_products;

use App\Mail\OverLimit;





class HomeController extends Controller
{
    public function redirect()
    {
        $usertype=Auth::user()->type;
        if($usertype=='1'){
            return view('admin.home');
        }
        else if ($usertype=='0'){
            $data = product::paginate(1);
            $user=auth()->user();
           
            return view('user.home', compact('data',));

        }
        else{
            $data = product::paginate(1);
            $senior=auth()->seniors();
            $count=cart_products::where('senior_fk',$senior->senior_id)->count();

            return view('senior.home',compact('data','count'));

        }
    }

    public function index(){
        if(Auth::id()){
            return redirect('redirect');
        }
        else{
            $data = product::paginate(1);
            return view('user.home',compact('data'));
        }
        
    }
    public function search(Request $request){
        $search=$request->search;
        if($search==''){
            $data = product::paginate(1);
            return view('user.home',compact('data'));
        }
        $data=product::where('title','Like','%'.$search.'%')->get();

        return view('user.home', compact('data'));
    }
   
    
    public function showcart(Request $request){
        $senior_fk=$request->cookie('senior_id');
        $cart_products=cart_products::where('senior_fk',$senior_fk)->get();
        $count=cart_products::where('senior_fk',$senior_fk)->count();
        $products=Product::whereIn('id', $cart_products->pluck('product_fk'))->get(); 
        $result=[];
        foreach($cart_products as $cart_product){
            $result[]=[
            'product' => $products->where('id', $cart_product->product_fk)->first(),
            'count' => $cart_product->quantity,
            'cartproduct_id'=>$cart_product->cartproduct_id,
            ];
        }
        
        return view('senior.showcart',compact ('count','cart_products','products','result'));
    }
    public function deletecartproduct($cartproduct_id){
        $data=cart_products::find($cartproduct_id);
        $data->delete();
        return redirect()->back()->with('message','Prekė pašalinta iš krepšelio');
    }
    public function confirmorder(Request $request)
    {
        $user=auth()->user();
        $name=$user->name;
        $email=$user->email;
        $address=$user->address;
        foreach((array) $request->productname as $key=>$productname)
        {
            $order=new order;
            
            $order->product_name=$request->productname[$key];

            $order->price=$request->price[$key];
            
            $order->quantity=$request->quantity[$key];
            
            $order->name=$name;
            $order->email=$email;
            $order->address=$address;
            $order->status='Nepatvirtintas';
            $order->save();

        }
        DB::table('carts')->where('email',$email)->delete();
        return redirect()->back()->with('message','Užsakymas pateiktas');    
    }
    public function registerseniorform(){
        $data = product::paginate(1);
        return view('user.registerseniorform', compact('data'));
    }
    public function registersenior(Request $request){
        $request->validate([
            'login' => 'unique:seniors',
        ]);
        $seniors=new Senior();
        $user=auth()->user();
        $data = product::paginate(1);
        $seniors->login=$request->login;
        $seniors->address=$request->address;
        $seniors->senior_password=$request->password;
        $seniors->user_fk=$user->user_id;
       
        $seniors->save();
        return view('user.home',compact('data'))->with('message','Senjoras užregistruotas sėkmingai');
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
        $senior=Senior::where('login', $login)->first();
        $data = product::paginate(1);
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
    public function allproducts(Request $request){
        $senior_fk=$request->cookie('senior_id');
        $count=cart_products::where('senior_fk',$senior_fk)->count();
        return view('allproducts', compact ('count'));

    }


    public function seniorlogout(){
        
            $data = product::paginate(1);
            return view('user.home',compact('data'));
        
    }
    public function addcart(Request $request, $id){
        $data = product::paginate(1);
            $product=product::find($id);
            $cart_products= new cart_products;
            $cart_products->quantity=$request->quantity;
            $cart_products->product_fk=$product->id;
            $cart_products->senior_fk=$request->cookie('senior_id');
            $cart_products->save();
            
            return redirect()->to('/seniorhome')->with('message','Produktas pridėtas sėkmingai');
    }
    public function seniorhome(Request $request){
        $data = product::paginate(1);
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
        $data=senior::find($senior_id);
        $data->delete();
        
        return redirect()->back()->with('message','Senjoro paskyra ištrinta sėkmingai');
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
                Mail::to($user)->send(new OverLimit($senior->login));
            }
            else if($order->price>$senior->credit){
                $order->status='Neapmokėtas';
            }
            else {
                $senior->credit=$senior->credit-$order->price;
                $senior->update();
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
       

}
