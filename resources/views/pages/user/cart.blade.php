@extends('layouts.userLayout')
@section('content')
    @include('includes.header')
    <div class="cart-ctn">
        <div class="cart">
            <div class="cart-header">
                <span>Seu Carrinho</span>
            </div>
            <table class="cart-products">
                <thead class="cart-products-thead">
                    <tr>
                        <th scope="col">
                            <span style="margin-left:30px;">Produto</span>
                        </th>
                        <th scope="col">Preço</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Total</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody class="cart-products-tbody">
                    @if($cartProducts != null)
                        @foreach($cartProducts as $key => $cartProduct)                            
                            @foreach($cartProduct as $cartProd)
                                <tr>
                                    <th scope="row">
                                        <a href="{{asset('/product/' . $cartProd['product_name'])}}" style="text-decoration:none;color:#000;display:flex;align-items:center;">
                                            <img src="{{asset($cartProd['product_image_url'])}}" style="height:60px;margin-left:30px;margin-right:20px;">
                                            <span style="width:500px;display:block;">{{$cartProd['product_name']}}</span>
                                        </a>
                                    </th>
                                    <td>R$ {{$cartProd['product_price']}}</td>
                                    <td>{{$cartProd['product_quantity']}}</td>
                                    <td>R$ {{$cartProd['product_total_price']}}</td>
                                    <td>
                                        <button class="productId cart-delete" value="{{$key}}">
                                            <i class="fas fa-trash-alt"></i>Deletar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @else
                        <tr>
                            <td style="width:250px;">
                                <span style="margin-left:30px;">O seu carrinho está vazio!</span>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="cart-totals-ctn">
        <div class="cart-totals-wrapper">
            <div class="cart-totals">
                <span>Total do Carrinho</span>
                <div class="cart-totals-table-ctn">
                    <table class="cart-totals-table">
                        <thead class="cart-totals-thead">
                            <tr>
                                <th style="background-color:#fcfcfc;border-right:1px solid #e8e8e8;">
                                    <span style="margin-left:20px;font-family:'Raleway',sans-serif;text-transform:uppercase;">Subtotal</span>
                                </th>
                                <th>
                                    @if($cartProducts != null)
                                        <span style="margin-left:20px;">R$ {{$cartTotal[0]}}.00</span>
                                    @else
                                        <span style="margin-left:20px;">R$ 0.00</span>
                                    @endif
                                </th>
                            </tr>
                        </thead>
                        <tbody class="cart-totals-tbody">
                            <tr>
                                <td style="background-color:#fcfcfc;height:338px;border-bottom:1px solid #e8e8e8;border-right:1px solid #e8e8e8;">
                                    <span style="margin-left:20px;text-transform:uppercase;font-family:'Raleway',sans-serif;">Envio</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#fcfcfc;height:53px;border-right:1px solid #e8e8e8;">
                                    <span style="margin-left:20px;text-transform:uppercase;font-family:'Raleway',sans-serif;">Total</span>
                                </td>
                                <td style="border-top:1px solid #e8e8e8;">
                                    @if($cartProducts != null)
                                        <span style="margin-left:20px;">R$ {{$cartTotal[0]}}.00</span>
                                    @else
                                        <span style="margin-left:20px;">R$ 0.00</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="{{asset('/checkout')}}">
                    @if($cartProducts != null)
                        <button id="cartButton">Ir para o Checkout de Compra</button>
                    @else
                        <button id="cartButton" style="background-color: #e8e8e8;" disabled>Ir para o Checkout de Compra</button>
                    @endif
                </a>
            </div>
        </div>
    </div>
    <script>
        var productId = document.getElementsByClassName('productId');
        for(var i=0; i<productId.length; i++){
            productId[i].onclick = function(target){
                var formData = new FormData();
                formData.append('productId', this.value);
                axios.post('/cart/delete/', formData,{
                    
                })
                .then((response) => {
                    document.location.reload(true);
                })
            }
        }
    </script>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection