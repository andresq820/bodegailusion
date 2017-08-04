@extends('light_layout')

@section('title')
New Product
@endsection

@section('header')
New Product
@endsection

@section('content')
    @include('includes.info-box-error')

    <form action="{{ route('products.post.create') }}" method="post" id="myEditForm" enctype="multipart/form-data">
        <div class="form-group" id="edit">
            <label for="code">Code:</label>
            <input type="text" size="5" maxlength="5" minlength="3" class="form-control" name="code" id="code" value="{{ Request::old('code') }}"/> 
        </div>

        <div class="form-group" id="edit">
            <label for="description">Description:</label>
            <input type="text" class="form-control" name="description" id="description" value="{{ Request::old('description') }}" />     
        </div>

        <div class="form-group" id="edit">
            <label for="amount">Amount:</label>
            <input type="number" class="form-control" name="amount" id="amount" size="5" maxlength="5" value="{{ Request::old('amount') }}" />
        </div>

        <div class="form-group" id="edit">
            <label for="image">Upload Image</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>

        <div class="modal-footer">
            <a href="{{ route('dashboard') }}" class="btn btn-default" data-dismiss="modal">Close</a>
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
            <input type="hidden" name="product_id">
            <input type="hidden" name="_token" value="{{ Session::token() }}"/>
        </div>                
    </form>
@endsection




 