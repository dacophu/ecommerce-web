<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <h1>This is Test</h1>
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($data['body']['data'] as $item)
                <tr>
                    <td class="cart_description">
                        <h4><a href="{{asset('/product-details/'.$item->id)}}">{{$item->name}}</a></h4>
                    </td>
                    <td class="cart_price">
                        <p>{{$item->price}}</p>
                    </td>
                    <td class="cart_quantity">
                        <p>{{$item->qty}}</p>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">{{$item->total}}</p>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td colspan="2">
                        <table class="table table-condensed total-result">
                            <td>Total</td>
                            <td><span>{{$data['body']['total']}}</span></td>
                </tr>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
    </div>
</body>

</html>