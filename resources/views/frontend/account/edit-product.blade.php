@extends('frontend.layout.main')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Account</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->


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
                <div class="blog-post-area">
                    <h2 class="title text-center">Update Product</h2>
                    <div class="signup-form">
                        <form action="{{url('/account/edit-product/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="name" value="{{$product->name}}" placeholder="Name" />
                            <input type="text" name="price" value="{{$product->price}}" placeholder="Price" />
                            <select name="id_category" class="form-control form-control-line">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" @selected($product->id_category==$category->id)>{{$category->name}}</option>
                                @endforeach
                            </select>
                            <select name="id_brand" class="form-control form-control-line">
                                @foreach($brands as $brand)
                                <option value="{{$brand->id}}" @selected($product->id_brand==$brand->id)>{{$brand->name}}</option>
                                @endforeach
                            </select>
                            <select name="saleSelect" id="saleSelect">
                                <option value="0">New</option>
                                <option value="1" @selected($product->sale>0)>Sale</option>
                            </select>
                            <div id="saleInput" style="{{ $product->sale > 0 ? 'display: block;' : 'display: none;' }}">
                                <input name="sale" value="{{$product->sale}}" type=" number" value="0" />
                                <i class="m-r-10 mdi mdi-percent"></i>
                            </div>
                            <input name="company" value="{{$product->company}}" type="text" placeholder="Company Profile" />
                            <input type="file" id="files" name="images[]" multiple>

                            @foreach($product->hinhanh as $item)
                            <div style="display: inline-block; padding-right: 20px;">
                                <img src="{{asset('upload/product/hinh2_'.$item)}}">
                                <input type="checkbox" name="hinhxoa[]" value="{{$item}}">
                            </div>

                            @endforeach
                            <textarea name="detail" placeholder="Detail" rows="6">{{$product->detail}}</textarea>
                            <button type="submit" class="btn btn-default">Update</button>
                        </form>
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <h4><i class="icon fa fa-check"></i>Thông báo</h4>
                            {{session('success')}}
                        </div>
                        @endif
                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <h4><i class="icon fa fa-check"></i>Thông báo</h4>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById("saleSelect").addEventListener("change", (e) => {
        const saleInput = document.getElementById("saleInput");
        if (e.target.value == 1) {
            saleInput.style.display = "block";
        } else {
            saleInput.style.display = "none";
        }
    });
    const files = document.getElementById('files');
    files.addEventListener("change", () => {
        if (files.files.length > 3) {
            alert('Không được nhập nhiều hơn 3 hình ảnh');
            files.value = '';
        }
    })
</script>

@endsection