@extends('login_layout')

@section('content')

@if(count($errors) > 0)
    <section class="info-box fail">
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach
    </section>
@endif

@if(Session::has('fail'))
    <section class="info-box fail">
        {{ Session::get('fail') }}
    </section>
@endif

<form action="" method="post">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" placeholder="Email" value="{{ Request::old('email') }}">
    </div>
    
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <div class="footer">
    <button type="submit" class="btn btn-primary">Login</button>
    <input type="hidden" name="_token" value="{{ Session::token() }}"/>
    </div>
    
</form>
@endsection
