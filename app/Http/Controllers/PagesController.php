<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Session;

class PagesController extends Controller
{
    //
    public function home(){
        return view('pages.index');
    }

    public function about(){
        return view('pages.about');
    }

    public function services(){
      /*  $products= DB::table('products')
                        ->get();*/ 
           
        $products=Product::orderBy('Product_name','desc')->paginate(3);
                             

        
        return view('pages.services')->with('products',$products);
    }
    public function show($id){
      /*  $product= DB::table('products')
                        ->where('id',$id)
                        ->first();*/
            $product=Product::find($id);

            return view('pages.show')->with('product',$product);
          /*  print('The product id is'.$id);*/
    }

    public function create(){
        return view('pages.create');
    }
    public function saveproduct(Request $request){
        $this->validate($request,['product_name'=>'required',
                                    'product_price'=>'required',
                                    'product_description'=>'required']);
         $product=new Product();
         $product->product_name=$request->input('product_name');
         $product->product_price=$request->product_price;
         $product->product_description=$request->product_description;
         $product->save();
         

        Session::put('success','The product has been added successfully');

         return redirect('/create');
         

        
    }
    public function editproduct($id){
        $product= Product::find($id);
        return view('pages.editproduct')->with('product', $product);
    }
    public function updateproduct(Request $request){
       
        $product=Product::find($request->input('id'));
        $product->product_name=$request->input('product_name');
        $product->product_price=$request->input('product_price');
        $product->product_description=$request->input('product_description');
        
        $product->update();

        Session::put('success','The '.$request->input('product_name').' has been Updated successfully');

         return redirect('/services');

    }
    public function deleteproduct($id){
        $product= Product::find($id);
        $product->delete();
        Session::put('success','The '.$product->product_name.'has been Deleted successfully');

        return redirect('/services');
    }

}
