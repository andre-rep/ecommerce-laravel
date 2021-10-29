@extends('layouts.adminLayout')
@section('content')
@include('includes.header')
    <section class="dashboard-ctn">
        <div class="dashboard">
            @include('includes.dashboard-menu')
            <div class="product-reviews-ctn">
                <h2>Reviews dos Clientes</h2>
                <div class="product-reviews">
                    <div class="product-reviews-header">
                        <form id="reviewSearchForm" style="display:flex;">
                            <input id="reviewSearchKeyword" class="form-control" type="text" placeholder="Pesquisar..." aria-label="default input example" style="margin-right:15px;">
                            <button class="btn btn-primary">Procurar</button>
                        </form>
                        <div class="product-orders-header-options">
                            <select id="visibilityOptions" class="form-select form-select-lg" aria-label=".form-select-lg example">
                                @if($chosenVisibility == '0')
                                    <option selected>Mostrar Todos</option>
                                @else
                                    <option>Mostrar Todos</option>
                                @endif
                                @if($chosenVisibility == 1)
                                    <option value="1" selected>Visíveis</option>
                                @else
                                    <option value="1">Visíveis</option>
                                @endif
                                @if($chosenVisibility == 2)
                                    <option value="2" selected>Ocultados</option>
                                @else
                                    <option value="2">Ocultados</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="product-reviews-body">
                        <table class="table">
                            <thead class="product-orders-thead">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Nome do Cliente</th>
                                    <th scope="col">Avaliação</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody class="product-orders-tbody">
                                @foreach($purchasesProducts as $purchasesProduct)
                                    <tr>
                                        <th scope="row" style="font-weight:400;">{{$purchasesProduct->id}}</th>
                                        <td style="font-weight:600;">
                                            <a href="{{asset('/product/' . $purchasesProduct->product_name)}}" style="text-decoration:none;color:black;">
                                                {{$purchasesProduct->product_name}}
                                            </a>
                                        </td>
                                        <td>
                                            <span>{{$purchasesProduct->name}}</span>
                                        </td>
                                        <td>
                                            <div class="main-novidades-product-rate">
                                                @for($i=0; $i<5; $i++)
                                                    @if($i < $purchasesProduct->purchase_product_rate)
                                                        <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                    @else
                                                        <i class="fa fa-star" style="color:rgb(203,203,203)"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </td>
                                        <td>
                                            {{$purchasesProduct->purchase_product_created_at}}
                                        </td>
                                        <td>
                                            @if($purchasesProduct->purchase_product_rate_comment_visibility == 1)
                                                <button id="{{$purchasesProduct->id}}" class="btn btn-warning hideButton" type="button">Ocultar</button>
                                            @else
                                                <button id="{{$purchasesProduct->id}}" class="btn btn-success hideButton" type="button">Exibir</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <script>
                //These values are for the menu
                document.getElementById('collapseThree').classList.remove("in");
                document.getElementById('collapseThree').classList.add("show");

                //Instantiate a method to work with url params
                const urlParams = new URLSearchParams(window.location.search);

                //Make search with keyword
                var reviewSearchForm = document.getElementById('reviewSearchForm');
                reviewSearchForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    //Delete the current value for the keyword that is contained in the url
                    urlParams.delete('keyword');

                    //Add the new value and redirect the page to another url
                    var reviewSearchKeyword = document.getElementById('reviewSearchKeyword').value;
                    urlParams.append('keyword', reviewSearchKeyword);
                    window.location.assign('http://localhost:8000/dashboard/product-reviews?' + urlParams.toString());
                });

                //Make search with visibility option
                var visibilityOptions = document.getElementById('visibilityOptions');
                visibilityOptions.addEventListener('change', () => {
                    //Just delete the visibilityOptions when selecting the 'Mostrar Todos' option
                    if(visibilityOptions.value == 'Mostrar Todos'){
                        urlParams.delete('visibilityOption');
                        window.location.assign('http://localhost:8000/dashboard/product-reviews?' + urlParams.toString());
                    }else{
                        //Delete the current value for the keyword that is contained in the url
                        urlParams.delete('visibilityOption');

                        //Add the new value and redirect the page to another url
                        urlParams.append('visibilityOption', visibilityOptions.value);
                        window.location.assign('http://localhost:8000/dashboard/product-reviews?' + urlParams.toString());
                    }
                });

                //Change the visibility of the comment
                var hideButton = document.getElementsByClassName('hideButton');
                for(var i=0; i<hideButton.length; i++){
                    hideButton[i].onclick = function(target){
                        var formData = new FormData();
                        formData.append('purchaseProductId', this.id);
                        if(this.textContent == 'Ocultar'){
                            formData.append('rateCommentVisibility', 2);
                        }else if(this.textContent == 'Exibir'){
                            formData.append('rateCommentVisibility', 1);
                        }
                        axios.post('/purchase/changeRateCommentVisibility/', formData,{

                        })
                        .then((response) => {
                            document.location.reload(true);
                        })
                    }
                }

            </script>
        </div>
    </section>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection