@extends('layout.app')
@section('title')
    Home
@endsection

@section('content')
       @if(Session::has('success'))
        <div  class="alert alert-success">
            {{Session::get('success')}}
            {{Session::put('success','null')}}
            
        </div>
        
    @endif 
{{--<form action="{{url('/saveproduct')}}" method="POST" class="form-horizontal">--}}
    {!!Form::open(['action'=>'PagesController@saveproduct', 'method'=>'POST', 'class'=>'form-horizontal'])!!}
    

        {{csrf_field()}}

        
    <div class="form-group">
       {{--<label>Product</label>--}} 

        {{Form::label('', 'Product Name')}}
        {{Form::text('product_name', '', ['placeholder'=> 'Product Name', 'class'=> 'form-control'])}}
        {{--<input type="text" name="product_name" placeholder="Product Name" class="form-control" required>--}}
    </div>

    <div class="form-group">
        {{--<label>Product Price</label>--}}
        {{--<input type="text" name="product_price" placeholder="Product Price" class="form-control" required>--}}
    
        {{Form::label('', 'Product Price')}}
        {{Form::number('product_price', '', ['placeholder'=> 'Product Price', 'class'=> 'form-control'])}}
    </div>
    <div class="form-group">
       {{--}} <label>Product description</label>
        <textarea name="product_description" cols="30" rows="10" class="form-control" required></textarea>--}}
        {{Form::label('', 'Product Description')}}
        {{Form::textarea('product_description', '', ['placeholder'=> 'Product Description', 'class'=> 'form-control'])}}
        
    </div>
    {{--<input type="submit" value="Add Product" class="btn btn-primary">--}}
    {{Form::submit('Add Product',['class'=>'btn btn-primary'])}}
 {{-- </form>--}}
 {!!Form::close()!!}
  
@endsection
    