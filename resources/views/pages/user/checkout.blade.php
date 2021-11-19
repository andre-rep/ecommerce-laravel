@extends('layouts.userLayout')
@section('content')
    @include('includes.header')
        <div class="checkout-ctn">
            <form method="post" action="{{route('purchase/add')}}">
                @csrf
                <div class="checkout">
                    <div class="checkout-address">
                        <span>Informações e Endereço para Entrega</span>
                        <div style="display:flex;margin-top:35px;">
                            <div class="mb-3" style="margin-right:18px;width:50%;">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="name" value="{{strtok($user->name, ' ')}}" placeholder="{{strtok($user->name)}}" required>
                            </div>
                            <div class="mb-3" style="width:50%;">
                                <label for="sobrenome" class="form-label">Sobrenome</label>
                                <input type="text" class="form-control" name="surname" value="{{substr(strstr($user->name, ' '), 1)}}" placeholder="{{substr(strstr($user->name, ' '), 1)}}" required>
                            </div>
                        </div>
                        <div style="display:flex;">
                            <div class="mb-3" style="margin-right:18px;width:50%;">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="cep" onkeyup="consultAddress()" name="cep" value="{{$user->user_address_cep}}" required>
                            </div>
                            <div class="mb-3" style="width:50%;">
                                <label for="logradouro" class="form-label">Rua/Avenida/Alameda</label>
                                <input type="text" class="form-control" id="street" name="street" value="{{$user->user_address_street}}" required>
                            </div>
                        </div>
                        <div style="display:flex;">
                            <div class="mb-3" style="margin-right:18px;width:50%;">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="neighbourhood" name="neighbourhood" value="{{$user->user_address_neighbourhood}}" required>
                            </div>
                            <div class="mb-3" style="width:50%;">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" name="number" value="{{$user->user_address_number}}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" class="form-control" name="complement" value="{{$user->user_address_complement}}" placeholder="Endereço de Apartamento - Residencial / Bloco (opcional)">
                        </div>
                        <div style="display:flex;">
                            <div class="mb-3" style="margin-right:18px;width:50%;">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="{{$user->email}}" required>
                            </div>
                            <div class="mb-3" style="width:50%;">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control" name="phoneNumber" value="{{$user->user_phone}}" placeholder="{{$user->user_phone}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="checkout-details">
                        <span>O seu Pedido</span>
                        <div class="checkout-table-ctn">
                            <table class="checkout-table">
                                <thead class="checkout-table-thead">
                                    <tr>
                                        <th>
                                            <span style="margin-left:35px;">Produto</span>
                                        </th>
                                        <th>
                                            <span>Total</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="checkout-table-tbody">
                                @if($cartProducts != null)
                                    @foreach($cartProducts as $key => $cartProduct)                            
                                        @foreach($cartProduct as $cartProd)
                                            <tr style="height:55px;border-bottom:1px solid #e8e8e8;">
                                                <td style="margin-left:35px;display:block;max-width:400px;margin-right:-160px;margin-top:5px;margin-bottom:5px;">
                                                    <span>{{$cartProd['product_name']}}</span>
                                                </td>
                                                <td>
                                                    <span>R$ {{$cartProd['product_total_price']}}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    <tr style="height:55px;border-bottom:1px solid #e8e8e8;">
                                        <td>
                                            <span style="margin-left:35px;font-family:'Raleway', sans-serif;text-transform:uppercase;font-weight:600;font-size:14px;">Subtotal</span>
                                        </td>
                                        <td>
                                            <span>R$ {{$cartTotal[0]}}</span>
                                        </td>
                                    </tr>
                                    <tr style="height:55px;border-bottom:1px solid #e8e8e8;">
                                        <td>
                                            <span style="margin-left:35px;font-family:'Raleway', sans-serif;text-transform:uppercase;font-weight:600;font-size:14px;">Envio</span>
                                        </td>
                                        <td>
                                            <span>R$ 0</span>
                                        </td>
                                    </tr>
                                    <tr style="height:55px;border-bottom:1px solid #e8e8e8;">
                                        <td>
                                            <span style="margin-left:35px;font-family:'Raleway', sans-serif;text-transform:uppercase;font-weight:600;font-size:14px;">Total</span>
                                        </td>
                                        <td>
                                            <span>R$ {{$cartTotal[0]}}</span>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>
                                            <span style="margin-left:30px;">O seu carrinho está vazio!</span>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="checkout-payment-options-ctn">
                        <div class="checkout-payment-options">
                            <div class="checkout-payment-option">
                                <input type="radio" name="" id="" checked>
                                <span style="font-family:'Roboto', sans-serif;font-size:14px;">Pagar diretamente ao entregador.</span>
                            </div>
                        </div>
                        <div style="position:relative;height:100px;">
                            <button type="submit" class="checkout-button">Efetuar a Compra</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script>
            function consultAddress(){
                var searchValue = document.querySelector('#cep').value
                if(searchValue.length == 8){
                    axios.get('http://viacep.com.br/ws/' + searchValue + '/json/',{

                    }).then((response) => {
                        document.querySelector('#street').value = response.data.logradouro
                        document.querySelector('#neighbourhood').value = response.data.bairro
                    })   
                }
            }
        </script>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection