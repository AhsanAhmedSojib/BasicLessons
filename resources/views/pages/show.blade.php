@extends('layout.app')

@section('title')
    Services
@endsection

@section('content')
        <h1>Welcome to the services page</h1>
        <h2>Products Details</h2>
            
                <h1>{{$product->product_name}}</h1>
                <h4>${{$product->product_price}}</h4>
                <p>{{$product->product_description}}</p>
                <hr>
                <h4>Written at{{$product->created_at}}</h4>
                <hr>
                <a href="/edit/{{$product->id}}" class="btn btn-default">Edit</a>
                <a href="/delete/{{$product->id}}" class="btn btn-danger">Delete</a>
            

@endsection 