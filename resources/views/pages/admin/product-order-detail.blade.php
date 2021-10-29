@extends('layouts.adminLayout')
@section('content')
@include('includes.header')
    <section class="dashboard-ctn">
        <div class="dashboard">
            @include('includes.dashboard-menu')
            <div class="product-order-detail-ctn">
                <input type="hidden" id="orderId" value="{{$orderId}}">
                <h2 style="margin-bottom:20px;">Detalhes da Ordem de Compra</h2>
                <div class="product-order-detail">
                    <div class="product-order-detail-header">
                        <div class="product-order-detail-time">
                            <i class="far fa-calendar"></i>
                            <span>Wed, Aug 13, 2020, 4:34PM</span>
                            <span>Order ID: 3453012</span>
                        </div>
                        <div class="product-order-detail-status">
                            <form id="changeStatus" v-on:submit.prevent="onSubmit">
                                <select class="form-select form-select-lg" id="orderStatus" aria-label=".form-select-lg example">
                                    @if($purchases[0]->purchase_status == 0)
                                        <option value="0" selected>Aguardando Confirmação</option>
                                        <option value="1">Pedido Confirmado</option>
                                        <option value="2">Saiu para Entrega</option>
                                        <option value="3">Produto Entregue</option>
                                    @elseif($purchases[0]->purchase_status == 1)
                                        <option value="0">Aguardando Confirmação</option>
                                        <option value="1" selected>Pedido Confirmado</option>
                                        <option value="2">Saiu para Entrega</option>
                                        <option value="3">Produto Entregue</option>
                                    @elseif($purchases[0]->purchase_status == 2)
                                        <option value="0">Aguardando Confirmação</option>
                                        <option value="1">Pedido Confirmado</option>
                                        <option value="2" selected>Saiu para Entrega</option>
                                        <option value="3">Produto Entregue</option>
                                    @elseif($purchases[0]->purchase_status == 3)
                                        <option value="0">Aguardando Confirmação</option>
                                        <option value="1">Pedido Confirmado</option>
                                        <option value="2">Saiu para Entrega</option>
                                        <option value="3" selected>Produto Entregue</option>
                                    @endif
                                </select>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </form>
                        </div>
                    </div>
                    <div class="product-order-detail-info">
                        <div class="product-order-details-card">
                            <div>
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <span>Cliente</span>
                                <span>{{$purchases[0]->name}}</span>
                                <span>{{$purchases[0]->email}}</span>
                                <span>{{$purchases[0]->user_phone}}</span>
                                <a href="{{asset('/dashboard/client/' . $purchases[0]->email)}}">Ver Perfil</a>
                            </div>
                        </div>
                        <div class="product-order-details-card">
                            <div>
                                <i class="fas fa-truck"></i>
                            </div>
                            <div>
                                <span>Informações de Pedido</span>
                                <span>Método de Pagamento: Dinheiro ou Cartão</span>
                                @if($purchases[0]->purchase_status == 0)
                                    <span>Status: Aguardando Confirmação</span>
                                @elseif($purchases[0]->purchase_status == 1)
                                    <span>Status: Pedido Confirmado</span>
                                @elseif($purchases[0]->purchase_status == 2)
                                    <span>Status: Saiu para Entrega</span>
                                @elseif($purchases[0]->purchase_status == 3)
                                    <span>Status: Produto Entregue</span>
                                @endif
                                <a href="#">Download info</a>
                            </div>
                        </div>
                        <div class="product-order-details-card">
                            <div>
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <span>Enviar Para</span>
                                <span>Rua/Avenida/Alameda {{$purchases[0]->user_address_street}}</span>
                                <a href="#">View Profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="product-order-detail-abstract">
                        <div class="product-order-detail-table">
                            <table class="table">
                                <thead class="product-orders-thead">
                                    <tr>
                                        <th scope="col">Produto</th>
                                        <th scope="col">Preço Unitário</th>
                                        <th scope="col">Quantidade</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="product-orders-tbody">
                                    <input type="hidden" value="{{$total = 0}}">
                                    @foreach($purchases as $purchase)
                                        <tr>
                                            <th scope="row">
                                                <img src="{{ asset($purchase->product_image_url) }}" style="width:50px;">
                                                <a href="{{asset('/product/' . $purchase->product_name)}}">
                                                    <span style="font-weight:400">{{$purchase->product_name}}</span>
                                                </a>
                                            </th>
                                            <td>R${{$purchase->product_price}}.00</td>
                                            <td>{{$purchase->purchase_product_quantity}}</td>
                                            <td>
                                                <input type="hidden" value="{{$total = $total + ($purchase->product_price * $purchase->purchase_product_quantity)}}">
                                                R${{$purchase->product_price * $purchase->purchase_product_quantity}}.00
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="product-order-detail-value">
                                <div>
                                    <span>Subtotal:</span>
                                    <span>Custo de Envio:</span>
                                    <span>Valor Total:</span>
                                    <span style="color:#7f858b;">Status:</span>
                                </div>
                                <div>
                                    <span>R${{$total}}.00</span>
                                    <span>0.00</span>
                                    <span style="font-size:18px;font-weight:700;">R${{$total}}.00</span>
                                    @if($purchases[0]->purchase_status == 0)
                                        <span class="badge rounded-pill bg-danger">Aguardando Confirmação</span>
                                    @elseif($purchases[0]->purchase_status == 1)
                                        <span class="badge rounded-pill bg-warning">Pedido Confirmado</span>
                                    @elseif($purchases[0]->purchase_status == 2)
                                        <span class="badge rounded-pill bg-success">Saiu para Entrega</span>
                                    @elseif($purchases[0]->purchase_status == 3)
                                        <span class="badge rounded-pill bg-success">Produto Entregue</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="product-order-detail-payment">
                            <div class="product-order-detail-paycard">
                                <span style="font-weight:600;">Informação de Pagamento</span>
                                <div>
                                    <i class="fab fa-cc-mastercard"></i>
                                    <span>Master Card **** **** 4768</span>
                                </div>
                                <span>Business name: Grand Market LLC</span>
                                <span>Phone: +1 (800) 555-154-52</span>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        //These values are for the menu
        document.getElementById('collapseThree').classList.remove("in");
        document.getElementById('collapseThree').classList.add("show");
        
        var addProduct = new Vue({
            el:'#changeStatus',
            methods:{
                onSubmit:function(event){
                    var formData = new FormData();
                    formData.append('orderStatus', document.getElementById('orderStatus').value);
                    formData.append('orderId', document.getElementById('orderId').value);
                    axios.post('/puchase/changeStatus/', formData,{
                        
                    })
                    .then((response) => {
                        document.location.reload(true);
                    })
                }
            }
        });
    </script>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection