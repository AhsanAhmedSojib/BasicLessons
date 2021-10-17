<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products=Product::orderBy('Product_name','desc')->paginate(3);
                             
        return view('products.services')->with('products',$products);
        //
        print('This is the Default function');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,['product_name'=>'required',
                                    'product_price'=>'required',
                                    'product_description'=>'required',
                                    'product_image'=>'image|nullable|max:1999']);
                        
  //      print('The image is'.$request->file('product_image'));



        $fileNamaWithExt = $request->file('product_image')->getClientOriginalName();

        print('<h1>This image is'.$fileNamaWithExt.'</h1>');
       echo '<pre></pre>';
        $filename = pathinfo($fileNamaWithExt, PATHINFO_FILENAME);
        print('<h1>The file name is'.$filename.'</h1>');
        echo '<pre></pre>';
        $ext = $request->fiel('product-image')->getClientOriginalExtension();
        print('<h1>The extention is'.$ext.'</h1>');

        $fileNameToStore= $filename.'_'.time().'.'.$ext;
        echo '<pre></pre>';
        print('<h1>'.$ext.'</h1>');
        

       /*  $product=new Product();
         $product->product_name=$request->input('product_name');
         $product->product_price=$request->product_price;
         $product->product_description=$request->product_description;
       /*  $product->save();
         
        Session::put('success','The '.$request->input('product_name').' product has been added successfully');

         return redirect('/products'); */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)

    {
        //
        /*  $product= DB::table('products')
                        ->where('id',$id)
                        ->first();*/
                        $product=Product::find($id);

                        return view('products.show')->with('product',$product);
                      /*  print('The product id is'.$id);*/
         
        print('This is the Show function');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product= Product::find($id);
        return view('products.editproduct')->with('product', $product);

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $product=Product::find($id);
        $product->product_name=$request->input('product_name');
        $product->product_price=$request->input('product_price');
        $product->product_description=$request->input('product_description');
        
        $product->update();

        Session::put('success','The '.$request->input('product_name').' has been Updated successfully');

         return redirect('/products');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product= Product::find($id);
        $product->delete();
        Session::put('success','The '.$product->product_name.'has been Deleted successfully');

        return redirect('/products');
    }
}
