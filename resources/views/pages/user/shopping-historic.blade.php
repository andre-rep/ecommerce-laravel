@extends('layouts.userLayout')
@section('content')
    @include('includes.header')
    <section class="user-edit-ctn">
        <div class="user-edit">
            <div class="user-edit-menu">
                <div class="user-edit-profile-img" style="position:relative;">
                    @if($users->user_profile_image_url == '')
                        <img src="{{asset('image/default-profile.png')}}" style="position:absolute;">    
                    @else
                        <img src="{{asset($users->user_profile_image_url)}}" style="position:absolute;">
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
                    <span>Histórico de compras</span>
                    <span>Acompanhe as compras já realizadas por você</span>
                </div>
                <div class="user-edit-form">
                    <div class="user-historic-table-ctn">
                        <table class="user-historic-table">
                            <thead class="user-historic-table-thead">
                                <tr>
                                    <th>
                                        <span style="margin-left:25px;">Id do Pedido</span>
                                    </th>
                                    <th>
                                        <span>Status</span>
                                    </th>
                                    <th>
                                        <span>Data do Pedido</span>
                                    </th>
                                    <th>
                                        <span>Ação</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="user-historic-table-tbody">
                                @foreach($purchases as $purchase)
                                    <tr class="user-historic-element">
                                        <td>
                                            <span style="margin-left:25px;">
                                                {{$purchase->id}}
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                @if($purchase->purchase_status == 0)
                                                    Aguardando confirmação do vendedor
                                                @elseif($purchase->purchase_status == 1)
                                                    Pedido confirmado
                                                @elseif($purchase->purchase_status == 2)
                                                    Pedido saiu para entrega
                                                @else
                                                    Pedido entregue
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                {{$purchase->created_at}}
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <a href="{{asset('/user/order/' . $purchase->id)}}">Ver detalhes</a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection