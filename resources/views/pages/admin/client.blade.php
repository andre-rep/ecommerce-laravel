@extends('layouts.adminLayout')
@section('content')
@include('includes.header')
    <section class="dashboard-ctn">
        <div class="dashboard">
            <input id="userEmail" type="hidden" value="{{$user->email}}">
            @include('includes.dashboard-menu')
            <div class="client-ctn">
                <div class="client">
                    <div class="client-card">
                        <div class="client-card-image">
                            @if($user->user_profile_image_url == '')
                                <img src="{{asset('storage/image/default-profile.png')}}" style="width:100%;">
                            @else
                                <img src="{{asset($user->user_profile_image_url)}}" style="width:100%;">
                            @endif
                        </div>
                        <div class="client-card-header"></div>
                        <div class="client-card-info-ctn">
                            <div>
                                <span style="font-size:25px;font-weight:500;">{{$user->name}}</span>
                                <span>Rua/Avenida/Alameda {{$user->user_address_street}}</span>
                            </div>
                            <select id="userStatus" class="form-select form-select-lg" aria-label=".form-select-lg example">
                                @if($user->user_status == 0)
                                    <option value="0" selected>Ativo</option>
                                @else
                                    <option value="0">Ativo</option>
                                @endif
                                @if($user->user_status == 1)
                                    <option value="1" selected>Desativado</option>
                                @else
                                    <option value="1">Desativado</option>
                                @endif
                            </select>
                        </div>
                        <div class="client-card-details-ctn">
                            <div class="client-card-details-incommings">
                                <span style="color:#7f858b;">Total de itens comprados:</span>
                                <span style="color:#00b55b;font-size:18px;font-weight:700;">{{$totalItemsPurchased}}</span>
                                <span style="color:#7f858b;">Valor Total</span>
                                <span style="color:#00b55b;font-size:18px;font-weight:700;">R$ {{$totalSpent}}</span>
                            </div>
                            <div class="client-card-details-contacts">
                                <span style="font-weight:700;">Contatos</span>
                                <span>{{$user->email}}</span>
                                @if($user->user_phone == '')
                                    <span>O usuário ainda não cadastrou número de telefone</span>
                                @else
                                    <span>{{$user->user_phone}}</span>
                                @endif
                            </div>
                            <div class="client-card-details-address">
                                <span style="font-weight:700;">Endereço</span>
                                @if($user->user_address_street == '')
                                    <span>O usuário ainda não cadastrou endereço</span>
                                @else
                                    <span>Rua/Avenida/Alameda {{$user->user_address_street}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                //These values are for the menu
                document.getElementById('collapseSix').classList.remove("in");
                document.getElementById('collapseSix').classList.add("show");

                //Change the client status
                var userStatus = document.getElementById('userStatus');
                userStatus.addEventListener('change', () => {
                    var formData = new FormData();
                    formData.append('userEmail', document.getElementById('userEmail').value);
                    formData.append('userStatus', userStatus.value);
                    axios.post('/users/alterUserStatus/', formData,{

                    })
                    .then((response) => {
                        document.location.reload(true);
                    })
                });
            </script>
        </div>
    </section>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection