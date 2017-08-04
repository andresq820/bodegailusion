@extends ('light_layout')

@section('title')
Dashboard
@endsection

@section('header')
Dashboard
@endsection

@section('content')
@include('includes.info-box-success')
<br>
<div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-9"></div>
                <div class="col-sm-3">
                   <a class="btn btn-primary" href="{{ route('products.get.create') }}">Add New Product</a>
                </div>    
            </div>
        </div>

        <div class="panel-body">               
            <div class="row">
                <div class="col-sm-9">
                    <div class="dataTables_length" id="dataTables-example_length">
                        <label>Show 
                            <select name="dataTables-example_length" aria-controls="dataTables-example" class="input-sm">
                                <option value="1">1</option>
                                <option value="3">3</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                            </select> Entries 
                        </label>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div id="dataTables-example_filter" class="dataTables_filter">
                           <input type="text" class="form-control input-sm" placeholder="Search..." aria-controls="dataTables-example" id="search" name="search"> 
                    </div>
                </div>
            </div><!--row 1-->

            <div class="row">
                <div class="col-sm-12">
                    <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                        <thead>
                            <tr role="row">
                                <th style="width: 50px;" >Action</th>
                                <th class="sorting" style="width: 50px;">Code</th>
                                <th class="sorting" style="width: 250px;" >Description</th>
                                <th class="sorting" style="width: 50px;" >In</th>
                                <th class="sorting" style="width: 50px;" >Out</th>
                                <th class="sorting" style="width: 50px;" >Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($products as $product)
                            <tr class="gradeA odd" role="row">
                                <td class="text-center" data-id="{{ $product->id }}">
                                <a href="{{ route('products.get.edit', ['product_id' => $product->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true" ></i></a>
                                <a href="{{ route('products.delete', ['product_id' => $product->id]) }}" onclick="return confirm('Are you sure you want to delete the selected product?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                <td class="text-center">{{ $product->code }}</td>
                                <td class="displayImage" ><img class="table_image" src="{{  route('product.image', ['image' => $product->image])  }}" alt="{{ $product->image }}">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{ $product->description }}</td>
                                <td class="text-center">{{ $product->in }}</td>
                                <td class="text-center">{{ $product->out }}</td>
                                <td class="text-center">{{ $product->in - $product->out}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--row 2-->

        </div><!--panel body-->
    </div><!--panel-->                  
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $("#search").on('keyup', function(){
        $search = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{ URL::to("search") }}',
            data: {},
            success: function(data){
                $('tbody').html(data);
            }
               
        });
    });
});
</script>
@endsection

