@extends('layouts.adminLayout')
@section('content')
@include('includes.header')
    <section class="dashboard-ctn">
        <div class="dashboard">
            @include('includes.dashboard-menu')
            <div class="clients-ctn">
                <h2>Lista de Clientes</h2>
                <div class="clients">
                    <div class="clients-orders-header">
                        <form id="clientsSearchForm" style="display:flex;">
                            <input id="clientsSearchKeyword" class="form-control" type="text" placeholder="Pesquisar..." aria-label="default input example" style="margin-right:15px;">
                            <button class="btn btn-primary">Procurar</button>
                        </form>
                        <div class="clients-orders-header-options">
                            <select id="userStatus" class="form-select form-select-lg" aria-label=".form-select-lg example">
                                @if($chosenStatus == 0)
                                    <option selected>Status</option>
                                @else
                                    <option>Status</option>
                                @endif
                                @if($chosenStatus == '0')
                                    <option value="0" selected>Ativo</option>
                                @else
                                    <option value="0">Ativo</option>
                                @endif
                                @if($chosenStatus == 1)
                                    <option value="1" selected>Desativado</option>
                                @else
                                    <option value="1">Desativado</option>
                                @endif
                            </select>
                            <select id="userPagination" class="form-select form-select-lg" aria-label=".form-select-lg example">
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
                    <div class="clients-orders-body">
                        <table class="table">
                            <thead class="clients-orders-thead">
                                <tr>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Registrado</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody class="clients-orders-tbody">
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">
                                            <div class="clients-list-profile">
                                                @if($user->user_profile_image_url == '')
                                                    <img src="{{asset('image/default-profile.png')}}" style="width:50px;border-radius:50px;">
                                                @else
                                                    <img src="{{asset($user->user_profile_image_url)}}" style="width:50px;border-radius:50px;">
                                                @endif
                                                <div>
                                                    <span style="font-weight:600;display:block;">{{$user->name}}</span>
                                                    <span style="font-weight:400;display:block;font-size:15px;color:#7f858b;">ID de Usuário: #{{$user->id}}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            {{$user->user_phone}}
                                        </td>
                                        <td>
                                            @if($user->user_status == 0)
                                                <span class="badge rounded-pill bg-success">Ativo</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">Desativado</span>
                                            @endif
                                        </td>
                                        <td>{{$user->user_created_at}}</td>
                                        <td>
                                            <a href="/dashboard/client/{{$user->email}}"><button type="submit" class="btn btn-primary">Ver Detalhes</button></a>
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
                document.getElementById('collapseSix').classList.remove("in");
                document.getElementById('collapseSix').classList.add("show");

                //Instantiate a method to work with url params
                const urlParams = new URLSearchParams(window.location.search);

                //Make the search with keyword
                var clientsSearchForm = document.getElementById('clientsSearchForm');
                clientsSearchForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    //Delete the current value for the keyword that is contained in the url
                    urlParams.delete('keyword');

                    //Add the value and redirect the page to another url
                    var clientsSearchKeyword = document.getElementById('clientsSearchKeyword').value;
                    urlParams.append('keyword', clientsSearchKeyword);
                    window.location.assign('http://localhost:8000/dashboard/clients?' + urlParams.toString());
                });

                //Make the search with user status
                var userStatus = document.getElementById('userStatus');
                userStatus.addEventListener('change', () => {
                    //Just delete the userStatus when selecting the 'Status' option
                    if(userStatus.value == 'Status'){
                        urlParams.delete('userStatus');
                        window.location.assign('http://localhost:8000/dashboard/clients?' + urlParams.toString());
                    }else{
                        //Delete the current value for the keyword that is contained in the url
                        urlParams.delete('userStatus');

                        //Add the new value and redirect the page to another url
                        urlParams.append('userStatus', userStatus.value);
                        window.location.assign('http://localhost:8000/dashboard/clients?' + urlParams.toString());
                    }
                });

                //Make search with pagination
                var userPagination = document.getElementById('userPagination');
                userPagination.addEventListener('change', () => {
                    //Delete the current value for the userPagination that is contained in the url
                    urlParams.delete('paginate');

                    //Add the new value and redirect the page to the another url
                    urlParams.append('paginate', userPagination.value);
                    window.location.assign('http://localhost:8000/dashboard/clients?' + urlParams.toString());
                });
            </script>
        </div>
    </section>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection