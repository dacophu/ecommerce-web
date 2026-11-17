@extends('frontend.layout.main')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Account</h2>
                    <div class="panel-group categ ory-products" id="accordian"><!--category-productsr-->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="#">account</a></h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="#">My product</a></h4>
                            </div>
                        </div>

                    </div><!--/category-products-->

                </div>
            </div>
            <div class="col-sm-9">
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">image</td>
                                <td class="description">name</td>
                                <td class="price">price</td>

                                <td class="total">action</td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img src="{{asset('upload/product/hinh2_'.$product->image)}}" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{$product->name}}</a></h4>

                                </td>
                                <td class="cart_price">
                                    <p>{{$product->price}}</p>
                                </td>

                                <td class="cart_total">
                                    <a href="{{url('/account/edit-product/'.$product->id)}}">edit</a>
                                    <a href="{{url('/account/delete-product/'.$product->id)}}">delete</a>
                                </td>

                            </tr>
                            @endforeach







                        </tbody>
                    </table>

                </div><a href="{{url('/account/add-product')}}">
                    <button type="submit" class="btn btn-primary">Add new product</button>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection