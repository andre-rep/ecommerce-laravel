@extends('layouts.adminLayout')
@section('content')
@include('includes.header')
    <section class="dashboard-ctn">
        <div class="dashboard">
            @include('includes.dashboard-menu')
            <div class="product-transactions-ctn">
                <h2>Histórico de Transações</h2>
                <div class="product-transactions">
                    <div class="product-transactions-header">
                        <input class="form-control" type="text" placeholder="Procurar..." aria-label="default input example">
                        <div class="product-orders-header-options">
                            <select class="form-select form-select-lg" aria-label=".form-select-lg example">
                                <option selected>Método de Pagamento</option>
                                <option value="1">Master Card</option>
                                <option value="2">Visa Card</option>
                                <option value="3">Boleto</option>
                            </select>
                        </div>
                    </div>
                    <div class="product-transactions-body">
                        <table class="table">
                            <thead class="product-orders-thead">
                                <tr>
                                    <th scope="col">ID de Transação</th>
                                    <th scope="col">Valor Pago</th>
                                    <th scope="col">Método</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody class="product-orders-tbody">
                                <tr>
                                    <th scope="row">#456667</th>
                                    <td>$294.00</td>
                                    <td>
                                        <i class="fas fa-credit-card"></i>
                                        <span>Amex</span>
                                    </td>
                                    <td>16.12.2020, 14:21</td>
                                    <td>
                                        <button class="btn btn-primary" type="button">Detalhes</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">#134768</th>
                                    <td>$294.00</td>
                                    <td>
                                        <i class="fas fa-credit-card"></i>
                                        <span>Master Card</span>
                                    </td>
                                    <td>16.12.2020, 14:21</td>
                                    <td>
                                        <button class="btn btn-primary" type="button">Detalhes</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">#456667</th>
                                    <td>$294.00</td>
                                    <td>
                                        <i class="fas fa-credit-card"></i>
                                        <span>Boleto</span>
                                    </td>
                                    <td>16.12.2020, 14:21</td>
                                    <td>
                                        <button class="btn btn-primary" type="button">Detalhes</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">#456667</th>
                                    <td>$294.00</td>
                                    <td>
                                        <i class="fas fa-credit-card"></i>
                                        <span>Amex</span>
                                    </td>
                                    <td>16.12.2020, 14:21</td>
                                    <td>
                                        <button class="btn btn-primary" type="button">Detalhes</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">#456667</th>
                                    <td>$294.00</td>
                                    <td>
                                        <i class="fas fa-credit-card"></i>
                                        <span>Amex</span>
                                    </td>
                                    <td>16.12.2020, 14:21</td>
                                    <td>
                                        <button class="btn btn-primary" type="button">Detalhes</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">#456667</th>
                                    <td>$294.00</td>
                                    <td>
                                        <i class="fas fa-credit-card"></i>
                                        <span>Amex</span>
                                    </td>
                                    <td>16.12.2020, 14:21</td>
                                    <td>
                                        <button class="btn btn-primary" type="button">Detalhes</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">#456667</th>
                                    <td>$294.00</td>
                                    <td>
                                        <i class="fas fa-credit-card"></i>
                                        <span>Amex</span>
                                    </td>
                                    <td>16.12.2020, 14:21</td>
                                    <td>
                                        <button class="btn btn-primary" type="button">Detalhes</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">#456667</th>
                                    <td>$294.00</td>
                                    <td>
                                        <i class="fas fa-credit-card"></i>
                                        <span>Amex</span>
                                    </td>
                                    <td>16.12.2020, 14:21</td>
                                    <td>
                                        <button class="btn btn-primary" type="button">Detalhes</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">#456667</th>
                                    <td>$294.00</td>
                                    <td>
                                        <i class="fas fa-credit-card"></i>
                                        <span>Amex</span>
                                    </td>
                                    <td>16.12.2020, 14:21</td>
                                    <td>
                                        <button class="btn btn-primary" type="button">Detalhes</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">#456667</th>
                                    <td>$294.00</td>
                                    <td>
                                        <i class="fas fa-credit-card"></i>
                                        <span>Amex</span>
                                    </td>
                                    <td>16.12.2020, 14:21</td>
                                    <td>
                                        <button class="btn btn-primary" type="button">Detalhes</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <script>
                document.getElementById('collapseFour').classList.remove("in");
                document.getElementById('collapseFour').classList.add("show");
            </script>
        </div>
    </section>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection