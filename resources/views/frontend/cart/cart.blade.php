@extends('frontend.layout.main')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td class="cart_product">
                            <a href="{{asset('/product-details/'.$item->id)}}"><img src="{{asset('upload/product/'.$item->id_user.'/hinh2_'.$item->image)}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="{{asset('/product-details/'.$item->id)}}">{{$item->name}}</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>{{$item->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up"> + </a>
                                <input class="cart_quantity_input" id="{{$item->id}}" type="text" name="quantity" value="{{$item->qty}}" autocomplete="off" size="2">
                                <a class="cart_quantity_down"> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$59</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span id="cart-sub-total">$59</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>$61</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="{{url('/checkout')}}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const updateTotal = () => {
        let subTotal = 0;
        const totalE = document.querySelectorAll(".cart_total_price");
        totalE.forEach((item) => {
            let price = item.closest("tr").querySelector(".cart_price").textContent;
            price = price.replace("$", "");
            price = parseInt(price);
            let qty = item.closest("tr").querySelector(".cart_quantity_input").value;
            qty = parseInt(qty);
            let total = price * qty;
            subTotal += total;
            item.textContent = "$" + (price * qty);
        })

        document.getElementById("cart-sub-total").textContent = "$" + subTotal;
    }
    updateTotal();
    const handleQuantity = (e, type) => {
        const qtyInput = e.closest("div").querySelector("input");
        switch (type) {
            case 0: //up
                qtyInput.value++;
                break;
            case 1: //down
                if (qtyInput.value <= 1) {
                    alert('Không thể giảm số lượng sản phẩm thấp hơn 1')
                } else {
                    qtyInput.value--;
                }
                break;
        }
        $.ajax({
            type: 'POST',
            url: "{{url('/cart/update-quantity/ajax')}}",
            data: {
                id: qtyInput.getAttribute('id'),
                qty: qtyInput.value,
            },
            success: function(data) {
                updateTotal();
            }
        })


    }

    const up = document.querySelectorAll(".cart_quantity_up");
    const down = document.querySelectorAll(".cart_quantity_down");
    up.forEach((item) => {
        item.addEventListener('click', () => {
            handleQuantity(item, 0);
        })
    });
    down.forEach((item) => {
        item.addEventListener('click', () => {
            handleQuantity(item, 1);
        })
    });

    const del = document.querySelectorAll(".cart_quantity_delete");
    del.forEach((item) => {
        item.addEventListener("click", () => {
            $.ajax({
                type: 'POST',
                url: "{{url('/cart/delete/ajax')}}",
                data: {
                    id: item.closest("div").querySelector("input").getAttribute('id')
                },
                success: function(data) {
                    item.closest("tr").remove();
                    updateTotal();
                }
            })
        })
    })
</script>
@endsection