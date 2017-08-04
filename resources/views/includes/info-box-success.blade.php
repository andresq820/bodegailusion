@if(Session::has('success'))
    <section class="info-box success">
        {{ Session::get('success') }}
    </section>
@endif