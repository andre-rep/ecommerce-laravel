@extends('layouts.adminLayout')
@section('content')
@include('includes.header')
    <section class="dashboard-ctn">
        <div class="dashboard">
            @include('includes.dashboard-menu')
            <div class="product-orders-ctn">
                <h2>Ordens de Compra</h2>
                <div class="product-orders">
                    <div class="product-orders-header">
                        <form id="ordersSearch" style="display:flex;">
                            <input id="ordersKeyword" class="form-control" type="text" placeholder="Procurar pelo nome do cliente..." aria-label="default input example" style="margin-right:15px;width:250px;">
                            <button type="submit" class="btn btn-primary">Pesquisar</button>
                        </form>
                        <div class="product-orders-header-options">
                            <select id="orderStatus" class="form-select form-select-lg" aria-label=".form-select-lg example">
                                @if($chosenStatus == '')
                                    <option selected>Mostrar Todas</option>
                                @else
                                    <option>Mostrar Todas</option>
                                @endif
                                @if($chosenStatus == '0')
                                    <option value="0" selected>Aguardando Confirmação</option>
                                @else
                                    <option value="0">Aguardando Confirmação</option>
                                @endif
                                @if($chosenStatus == 1)
                                    <option value="1" selected>Pedido Confirmado</option>
                                @else
                                    <option value="1">Pedido Confirmado</option>
                                @endif
                                @if($chosenStatus == 2)
                                    <option value="2" selected>Saiu Para Entrega</option>
                                @else
                                    <option value="2">Saiu Para Entrega</option>
                                @endif
                                @if($chosenStatus == 3)
                                    <option value="3" selected>Produto Entregue</option>
                                @else
                                    <option value="3">Produto Entregue</option>
                                @endif
                            </select>
                            <select id="ordersPaginationOptions" class="form-select form-select-lg" aria-label=".form-select-lg example">
                                @if($chosenPagination == 20)
                                    <option value="20" selected>Mostrar 20</option>
                                @else
                                    <option value="20">Mostrar 20</option>
                                @endif
                                @if($chosenPagination == 30)
                                    <option value="30" selected>Mostrar 30</option>
                                @else
                                    <option value="30">Mostrar 30</option>
                                @endif
                                @if($chosenPagination == 40)
                                    <option value="40" selected>Mostrar 40</option>
                                @else
                                    <option value="40">Mostrar 40</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="product-orders-body">
                        <table class="table">
                            <thead class="product-orders-thead">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome do Cliente</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody class="product-orders-tbody">
                                @foreach ($purchases as $purchase)
                                <tr>
                                    <th scope="row">{{$purchase->purchase_id}}</th>
                                    <td>{{$purchase->name}}</td>
                                    <td>$948.55</td>
                                    <td>
                                        @if($purchase->purchase_status == 0)
                                            <span class="badge rounded-pill bg-danger">Aguardando Confirmação</span>
                                        @elseif($purchase->purchase_status == 1)
                                            <span class="badge rounded-pill bg-warning">Pedido Confirmado</span>
                                        @elseif($purchase->purchase_status == 2)
                                            <span class="badge rounded-pill bg-success">Saiu para Entrega</span>
                                        @elseif($purchase->purchase_status == 3)
                                            <span class="badge rounded-pill bg-success">Produto Entregue</span>
                                        @endif
                                    </td>
                                    <td>{{$purchase->purchase_created_at}}</td>
                                    <td>
                                        <a href="{{asset('/dashboard/product-order-detail/' . $purchase->purchase_id)}}"><button class="btn btn-primary" type="button">Ver Detalhes</button></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <script>
                //These are for the menu
                document.getElementById('collapseThree').classList.remove("in");
                document.getElementById('collapseThree').classList.add("show");

                //Instantiate a method to work with url params
                const urlParams = new URLSearchParams(window.location.search);
                
                //Make search with keyword
                var ordersSearch = document.getElementById('ordersSearch');
                ordersSearch.addEventListener('submit', (e) => {
                    e.preventDefault();
                    //Delete the current value for the keyword that is contained in the url
                    urlParams.delete('keyword');

                    //Add the new value and redirect the page to another url
                    var ordersKeyword = document.getElementById('ordersKeyword').value;
                    urlParams.append('keyword', ordersKeyword);
                    window.location.assign('http://localhost:8000/dashboard/product-orders?' + urlParams.toString());
                });

                //Make search with order status
                var orderStatus = document.getElementById('orderStatus');
                orderStatus.addEventListener('change', () => {
                    //Just delete the orderStatus when selecting the 'Status' option
                    if(orderStatus.value == 'Mostrar Todas'){
                        urlParams.delete('orderStatus');
                        window.location.assign('http://localhost:8000/dashboard/product-orders?' + urlParams.toString());
                    }else{
                        //Delete the current value for the orderStatus that is contained in the url
                        urlParams.delete('orderStatus');

                        //Add the new value and redirect the page to the another url
                        urlParams.append('orderStatus', orderStatus.value);
                        window.location.assign('http://localhost:8000/dashboard/product-orders?' + urlParams.toString());
                    }
                });

                //Make search with pagination
                var ordersPaginationOptions = document.getElementById('ordersPaginationOptions');
                ordersPaginationOptions.addEventListener('change', () => {
                    //Delete the current value for the ordersPaginationOptions that is contained in the url
                    urlParams.delete('paginate');

                    //Add the new value and redirect the page to the another url
                    urlParams.append('paginate', ordersPaginationOptions.value);
                    window.location.assign('http://localhost:8000/dashboard/product-orders?' + urlParams.toString());
                });
            </script>
        </div>
    </section>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection