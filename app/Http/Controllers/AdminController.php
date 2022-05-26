<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Senior;
use App\Models\User;
class AdminController extends Controller
{
    public function product(){
        return view('admin.product');
    }
    public function orders(){
        $orders=orders::all();
        foreach ($orders as $key =>$order){
            $order['senior']=senior::where('senior_id', $order->senior_fk)->first();
            $order['user']=user::where('user_id', $order->user_fk)->first();
            $orders[$key]=$order;

        }
        return view('admin.orders', compact('orders'));
    }

    public function uploadproduct(Request $request){
        
        $data=new product;
        $image=$request->file;

        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->file->move('productimage',$imagename);
        
        $data->image= $imagename;
        $data->title=$request->title;
        $data->price=$request->price;
        $data->description=$request->des;
        $data->subcategory_fk=$request->gridRadios;
        
 

        $data->save();
        return redirect()->back()->with('message','Produktas pridėtas sėkmingai');
    }

    public function showproduct(){
        $data=product::all();
        return view('admin.showproduct', compact('data'));
    }
    public function deleteproduct($id){
        $data=product::where('id',$id)->first();
        $data->product_status="Neaktyvi";
        $data->update();
        return redirect()->back()->with('message','Produktas deaktyvuotas sėkmingai');
    }
    
    public function updateorder($id){
        $data=orders::where('id',$id)->first();
        $data->status="Pristatytas";
        $data->update();
        return redirect()->back()->with('message','Užsakymo būsena pakeista');
    }

    public function updateview($id){
        $data=product::find($id);
        return view('admin.updateview', compact('data'));
    }
    public function updateproduct(Request $request, $id){

        $data=product::find($id);


        $image=$request->file;
            if($image){
                 $imagename=time().'.'.$image->getClientOriginalExtension();
                $request->file->move('productimage',$imagename);
                $data->image= $imagename;
                }
        $data->title=$request->title;
        $data->price=$request->price;
        
        
        $data->description=$request->des;

        $data->save();
        return redirect()->back()->with('message','Informacija atnaujinta sėkmingai');
    }
}   
