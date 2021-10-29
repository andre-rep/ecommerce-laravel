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
                    <span>{{$userName}}</span>
                </div>
                <a href="{{asset('/user/edit-profile')}}" class="user-edit-menu-option" style="background-color:#e8e8e8;">
                    <span>Perfil</span>
                </a>
                <a href="{{asset('/user/shopping-historic')}}" class="user-edit-menu-option">
                    <span>Histórico de Compras</span>
                </a>
                <a href="{{asset('/cart')}}" class="user-edit-menu-option">
                    <span>Carrinho</span>
                </a>
                <a href="#" class="user-edit-menu-option">
                    <span>Encerrar Conta</span>
                </a>
            </div>
            <div class="user-edit-content">
                <div class="user-edit-description">
                    <span>Perfil público</span>
                    <span>Edite suas informações pessoais</span>
                </div>
                <div class="user-edit-form-ctn">
                    <div class="user-edit-form-wrapper">
                        <form id="phone" v-on:submit.prevent="onSubmit">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="phoneNumber" aria-describedby="emailHelp" style="box-shadow:none;" placeholder="{{$users->user_phone}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </form>
                    </div>
                    <div class="user-edit-form-wrapper">
                        <form id="email" v-on:submit.prevent="onSubmit">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="text" class="form-control" id="emailAddress" aria-describedby="emailHelp" style="box-shadow:none;" placeholder="{{$users->email}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </form>
                    </div>
                    <div class="user-edit-form-wrapper">
                        <form id="address" v-on:submit.prevent="onSubmit" style="display:grid;">
                            @csrf
                            <div class="mb-3" style="width:95%;">
                                <label for="exampleInputEmail1" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="cep" aria-describedby="emailHelp" style="box-shadow:none;" placeholder="{{$users->user_address_cep}}">
                            </div>
                            <div class="mb-3" style="grid-column:2/3;">
                                <label for="exampleInputEmail1" class="form-label">Rua</label>
                                <input type="text" class="form-control" id="street" aria-describedby="emailHelp" style="box-shadow:none;" placeholder="{{$users->user_address_street}}">
                            </div>
                            <div class="mb-3" style="width:95%;">
                                <label for="exampleInputEmail1" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="neighbourhood" aria-describedby="emailHelp" style="box-shadow:none;" placeholder="{{$users->user_address_neighbourhood}}">
                            </div>
                            <div class="mb-3" style="grid-column:2/3;">
                                <label for="exampleInputEmail1" class="form-label">Número</label>
                                <input type="text" class="form-control" id="number" aria-describedby="emailHelp" style="box-shadow:none;" placeholder="{{$users->user_address_number}}">
                            </div>
                            <div class="mb-3" style="grid-column:1/3;">
                                <label for="exampleInputEmail1" class="form-label">Complemento</label>
                                <input type="text" class="form-control" id="complement" aria-describedby="emailHelp" style="box-shadow:none;" placeholder="{{$users->user_address_complement}}">
                            </div>
                            <button type="submit" class="btn btn-primary" style="width:88px;grid-column:1/2;">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
    <script>
        var phone = new Vue({
            el:'#phone',
            methods:{
                onSubmit:function(event){
                    var formData = new FormData();
                    formData.append('phoneNumber', document.getElementById('phoneNumber').value);
                    axios.post('/users/insertPhone/', formData,{
                        
                    })
                    .then((response) => {
                        document.location.reload(true);
                    })
                }
            }
        });
        var email = new Vue({
            el:'#email',
            methods:{
                onSubmit:function(event){
                    var formData = new FormData();
                    formData.append('emailAddress', document.getElementById('emailAddress').value);
                    axios.post('/users/insertEmail/', formData,{
                        
                    })
                    .then((response) => {
                        document.location.reload(true);
                    })
                }
            }
        });
        var address = new Vue({
            el:'#address',
            methods:{
                onSubmit:function(event){
                    var formData = new FormData();
                    formData.append('cep', document.getElementById('cep').value);
                    formData.append('street', document.getElementById('street').value);
                    formData.append('neighbourhood', document.getElementById('neighbourhood').value);
                    formData.append('number', document.getElementById('number').value);
                    formData.append('complement', document.getElementById('complement').value);
                    axios.post('/users/updateAddress/', formData,{
                        
                    })
                    .then((response) => {
                        document.location.reload(true);
                    })
                }
            }
        });
        document.getElementById('image').addEventListener('change', () =>{
            var formData = new FormData();
            formData.append('file', document.querySelector('#image').files[0]);
            axios.post('/users/insertProfileImage/', formData,{
                
            })
            .then((response) => {
                document.location.reload(true);
            })
        });
    </script>
@endsection