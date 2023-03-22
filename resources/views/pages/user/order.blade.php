@extends('layouts.userLayout')
@section('content')
    @include('includes.header')
    <section class="user-edit-ctn">
        <input type="hidden" id="purchaseId" value="{{$purchaseId}}">
        <div class="user-edit">
            <div class="user-edit-menu">
                <div class="user-edit-profile-img" style="position:relative;">
                    @if($user->user_profile_image_url == '')
                        <img src="{{asset('storage/image/default-profile.png')}}" style="position:absolute;">    
                    @else
                        <img src="{{asset($user->user_profile_image_url)}}" style="position:absolute;">
                    @endif
                    <input type="file" id="image" style="position:absolute;width:100%;height:100%;opacity:0;cursor:pointer;">
                </div>
                <div class="user-edit-profile-name">
                    <span>{{Auth::user()->name}}</span>
                </div>
                <a href="{{asset('/user/edit-profile')}}" class="user-edit-menu-option">
                    <span>Perfil</span>
                </a>
                <a href="{{asset('/user/shopping-historic')}}" class="user-edit-menu-option" style="background-color:#e8e8e8;">
                    <span>Histórico de Compras</span>
                </a>
                <a href="{{asset('user/cart')}}" class="user-edit-menu-option">
                    <span>Carrinho</span>
                </a>
                <a href="#" class="user-edit-menu-option">
                    <span>Encerrar Conta</span>
                </a>
            </div>
            <div class="user-edit-content">
                <div class="user-edit-description">
                    <span>Pedido</span>
                    <span>Acompanhe o Pedido Feito</span>
                </div>
                <div class="user-edit-form" style="padding-left:10px;padding-right:10px;">
                    <div class="user-order-products-ctn">
                        <table class="user-order-products">
                            <thead class="user-order-products-thead">
                                <tr>
                                    <th scope="col">
                                        <span style="margin-left:30px;">Produto</span>
                                    </th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody class="order-products-tbody">
                                @foreach($products as $product)
                                    <tr style="height:40px;">
                                        <th scope="row" style="max-width:600px;display:flex;margin-right:-190px;">
                                            <span style="margin-left:15px;font-weight:600;">
                                                {{$product->product_name}}
                                            </span>
                                        </th>
                                        <td>
                                            R$ {{$product->product_price}}
                                        </td>
                                        <td>
                                            {{$product->purchase_product_quantity}}
                                        </td>
                                        <td>
                                           R$ {{$product->product_price * $product->purchase_product_quantity}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="user-order-changelog-ctn" style="margin-top:20px;padding-top:15px;padding-left:10px;">
                        @if($products[0]->purchase_status == 0)
                            <h5 style="margin-left:10px;margin-bottom:15px;">Registro de Atividades</h5>
                            <div class="user-order-changelog">
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border:1px solid rgb(255,83,83);width:20px;height:20px;background-color:rgb(255,83,83);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span>Compra feita, aguardando confirmação do vendedor</span>
                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-right:1px solid rgb(76,160,243);width:2px;height:100%;"></div>
                                </div>
                                <div>

                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border:1px solid rgb(76,160,243);width:20px;height:20px;background-color:rgb(76,160,243);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span style="color:#e8e8e8;">Confirmação da compra feita pelo vendedor</span>
                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-right:1px solid rgb(76,160,243);width:2px;height:100%;"></div>
                                </div>
                                <div>

                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border;1px solid rgb(101,103,125);width:20px;height:20px;background-color:rgb(101,103,125);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span style="color:#e8e8e8;">Pedido saiu para entrega</span>
                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-right:1px solid rgb(76,160,243);width:2px;height:100%;"></div>
                                </div>
                                <div>

                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border;1px solid rgb(101,103,125);width:20px;height:20px;background-color:rgb(94, 196, 103);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span style="color:#e8e8e8;">Pedido entregue</span>
                                </div>
                            </div>
                        @elseif($products[0]->purchase_status == 1)
                            <h5 style="margin-left:10px;margin-bottom:15px;">Registro de Atividades</h5>
                            <div class="user-order-changelog">
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border:1px solid rgb(255,83,83);width:20px;height:20px;background-color:rgb(255,83,83);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span>Compra feita, aguardando confirmação do vendedor</span>
                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-right:1px solid rgb(76,160,243);width:2px;height:100%;"></div>
                                </div>
                                <div>

                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border:1px solid rgb(76,160,243);width:20px;height:20px;background-color:rgb(76,160,243);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span>Confirmação da compra feita pelo vendedor</span>
                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-right:1px solid rgb(76,160,243);width:2px;height:100%;"></div>
                                </div>
                                <div>

                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border;1px solid rgb(101,103,125);width:20px;height:20px;background-color:rgb(101,103,125);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span style="color:#e8e8e8;">Pedido saiu para entrega</span>
                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-right:1px solid rgb(76,160,243);width:2px;height:100%;"></div>
                                </div>
                                <div>

                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border;1px solid rgb(101,103,125);width:20px;height:20px;background-color:rgb(94, 196, 103);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span style="color:#e8e8e8;">Pedido entregue</span>
                                </div>
                            </div>
                        @elseif($products[0]->purchase_status == 2)
                            <h5 style="margin-left:10px;margin-bottom:15px;">Registro de Atividades</h5>
                            <div class="user-order-changelog">
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border:1px solid rgb(255,83,83);width:20px;height:20px;background-color:rgb(255,83,83);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span>Compra feita, aguardando confirmação do vendedor</span>
                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-right:1px solid rgb(76,160,243);width:2px;height:100%;"></div>
                                </div>
                                <div>

                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border:1px solid rgb(76,160,243);width:20px;height:20px;background-color:rgb(76,160,243);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span>Confirmação da compra feita pelo vendedor</span>
                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-right:1px solid rgb(76,160,243);width:2px;height:100%;"></div>
                                </div>
                                <div>

                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border;1px solid rgb(101,103,125);width:20px;height:20px;background-color:rgb(101,103,125);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span>Pedido saiu para entrega</span>
                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-right:1px solid rgb(76,160,243);width:2px;height:100%;"></div>
                                </div>
                                <div>

                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border;1px solid rgb(101,103,125);width:20px;height:20px;background-color:rgb(94, 196, 103);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span style="color:#e8e8e8;">Pedido entregue</span>
                                </div>
                            </div>
                            @elseif($products[0]->purchase_status == 3)
                            <h5 style="margin-left:10px;margin-bottom:15px;">Registro de Atividades</h5>
                            <div class="user-order-changelog">
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border:1px solid rgb(255,83,83);width:20px;height:20px;background-color:rgb(255,83,83);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span>Compra feita, aguardando confirmação do vendedor</span>
                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-right:1px solid rgb(76,160,243);width:2px;height:100%;"></div>
                                </div>
                                <div>

                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border:1px solid rgb(76,160,243);width:20px;height:20px;background-color:rgb(76,160,243);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span>Confirmação da compra feita pelo vendedor</span>
                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-right:1px solid rgb(76,160,243);width:2px;height:100%;"></div>
                                </div>
                                <div>

                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border;1px solid rgb(101,103,125);width:20px;height:20px;background-color:rgb(101,103,125);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span>Pedido saiu para entrega</span>
                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-right:1px solid rgb(76,160,243);width:2px;height:100%;"></div>
                                </div>
                                <div>

                                </div>
                                <div style="display:flex;justify-content:center;">
                                    <div style="border-radius:50px;border;1px solid rgb(101,103,125);width:20px;height:20px;background-color:rgb(94, 196, 103);"></div>
                                </div>
                                <div style="display:flex;align-items:center;">
                                    <span>Pedido entregue</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if($products[0]->purchase_status == 3)
                        <div class="user-order-comment-ctn">
                            <h5>Deixe uma avaliação do pedido recebido!</h5>
                            <table class="user-order-comment-table">
                                <thead>
                                    <tr style="width:100%;">
                                        <th scope="col">
                                            <span style="margin-left:30px;">Produto</span>
                                        </th>
                                        <th scope="col">Avaliação</th>
                                        <th scope="col">Comentário (Opcional)</th>
                                        <th scope="col">Ação</th>
                                    </tr>
                                </thead>
                                <tbody style="width:100%;">
                                    @foreach($products as $product)
                                        @if($product->purchase_product_rate != null)
                                        <tr>
                                            <th>
                                                <a href="{{asset('/product/' . $product->product_url)}}">
                                                    <img src="{{asset($product->product_image_url)}}" style="max-height:80px;margin-left:20px;">
                                                </a>
                                            </th>
                                            <td>
                                                <div id="{{$product->product_id}}" class="product-rate">
                                                    Você já avaliou esse produto
                                                </div>
                                            </td>
                                            <td>
                                                
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                        @else
                                        <tr>
                                            <th>
                                                <img src="{{asset($product->product_image_url)}}" style="max-height:80px;margin-left:20px;">
                                            </th>
                                            <td>
                                                <div id="{{$product->product_id}}" class="product-rate">
                                                    <i class="fa fa-star" style="color:rgb(250,196,70)" id="1"></i>
                                                    <i class="fa fa-star" style="color:rgb(250,196,70)" id="2"></i>
                                                    <i class="fa fa-star" style="color:rgb(250,196,70)" id="3"></i>
                                                    <i class="fa fa-star" style="color:rgb(203,203,203)" id="4"></i>
                                                    <i class="fa fa-star" style="color:rgb(203,203,203)" id="5"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <textarea class="form-control comment" style="width:80%;resize:none;" id="{{$product->product_id}}"></textarea>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary send" id="{{$product->product_id}}">Enviar</button>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <script>
        //Elements to work with from the DOM
        var star = document.getElementsByClassName('fa-star');//Get all elements with a star
        var comment = document.getElementsByClassName('comment');//Get all elements with comment
        var productRate = document.getElementsByClassName('product-rate');//Get all elements of product rate 

        //Array to set all rate initial values
        var rateLength = productRate.length;
        var rate = {};
        for(var i=1; i<=rateLength; i++){
            rate[productRate[i-1].id] = 3;//Insert initially the value of 3 for all the rates
        }
        
        //Identify which star is being clicked to activate the changeStars method
        for(var i=0; i<star.length;i++){
            star[i].onclick = function(target){
                rate[this.parentElement.id] = this.id;//Change the rate clicked in the rate array
                //Change the stars according to the click
                for(var i=0; i<5; i++){
                    if(i<this.id){
                        this.parentElement.children[i].setAttribute("style", "color:rgb(250,196,70)");
                    }else{
                        this.parentElement.children[i].setAttribute("style", "color:rgb(203,203,203)");
                    }
                }
            }
        }

        //Retrieve rate and comment and send
        var send = document.getElementsByClassName('send');
        for(var i=0; i<send.length; i++){
            send[i].onclick = function(target){
                //retrieve rate
                console.log("the rate is: " + rate[this.id]);
                //retrieve comment
                for(var i=0; i<comment.length; i++){
                    if(comment[i].id == this.id){
                        console.log("the comment is: " + comment[i].value);
                        productComment = comment[i].value;
                    }
                }
                //Send comment and rate
                var formData = new FormData();
                formData.append('productId', this.id);
                formData.append('productRate', rate[this.id]);
                formData.append('productComment', productComment);
                formData.append('purchaseId', document.getElementById('purchaseId').value);
                axios.post('/purchase/rate/', formData,{
                
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