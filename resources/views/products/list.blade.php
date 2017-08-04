@extends('login_layout')

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
