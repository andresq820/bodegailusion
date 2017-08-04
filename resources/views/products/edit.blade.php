@extends('light_layout')

@section('title')
Edit Product
@endsection

@section('header')
Edit Product
@endsection

@section('content')
    @include('includes.info-box-error')

    <form action="{{ route('products.post.edit') }}" method="post" id="myEditForm" >
        <div class="form-group" id="edit">
            <label for="code">Code:</label>
            <input type="text" size="5" maxlength="5" minlength="3" class="form-control" name="code" id="code" value="{{ $product->code  }}" /> 
        </div>

        <div class="form-group" id="edit">
            <label for="description">Description:</label>
            <input type="text" class="form-control" name="description" id="description" value="{{ $product->description  }}" />     
        </div>

        <div class="form-group" id="edit">
            <label for="amount">Amount:</label>
            <input type="number" class="form-control" name="amount" id="amount" size="5" maxlength="5" value="{{ Request::old('amount')}}" {{ $errors->has('amount') ? 'class=has-amount' : '' }} value="{{ Request::old('amount') ? Request::old('amount') : isset($amount) ? $product->amount : '' }}" />
        </div>

        <div class="form-group" id="edit">
            <label for="newImage">Upload Image</label>
            <input type="file" class="form-control" name="newImage" id="newImage">
        </div>

        <div class="form-group" id="edit">
            <label for="type">Type:</label>
            <div class="radio">
                <label><input type="radio" name="type" value="in">In</label>
                <label><input type="radio" name="type" value="out">Out</label>
            </div>
        </div> 

        <div class="modal-footer">
            <a href="{{ route('dashboard') }}" class="btn btn-default" data-dismiss="modal">Close</a>
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}"/>
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        </div>                
    </form>
@endsection




 