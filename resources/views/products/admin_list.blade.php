@extends('light_layout')

@section('title')
Products List
@endsection

@section('header')
Products List
@endsection

@section('content')
<div class="row">
    @include('includes.info-box-success')
</div>

<div class="row">
   @foreach($products as $product)
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <img class="list_image" src="{{  route('product.image', ['image' => $product->image])  }}" alt="{{ $product->image }}">
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ $product->in - $product->out }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bg-primary">{{$product->description}}</div>      
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{ route('products.get.edit', ['product_id' => $product->id]) }}">Edit <i class="fa fa-pencil-square-o" aria-hidden="true" ></i></a>
                    <span class="pull-right"><a href="{{ route('products.delete', ['product_id' => $product->id]) }}" onclick="return confirm('Are you sure you want to delete the selected product?')">Delete <i class="fa fa-trash-o" aria-hidden="true"></i></a></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>
<!-- /.row -->
<div class="text-center">
    <nav>
        {!! $products->appends(['search' => $search])->links()  !!}
    </nav>
</div>
@endsection
