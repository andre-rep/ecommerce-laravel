@extends('layouts.publicLayout')
@section('content')
    @include('includes.header')
    <section class="auth">
        <div class="auth-wrapper">
            <div class="alert alert-primary" id="alert" role="alert" style="display:none;">
                        
            </div>
            <div id="wait" style="display:none;margin-bottom:10px;align-items:center;">
                <img src="{{asset('image/wait.gif')}}" style="width:25px;height:25px;margin-right:10px;">
                <h5 style="margin-top:5px;">Aguarde..</h5>
            </div>
            <div class="sign-up">
                <h3>Cadastre-se para continuar</h3>
                <form id="sign-up-form" v-on:submit.prevent="onSubmit">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome</label>
                        <input type="text" class="form-control" id="signUpName" aria-describedby="emailHelp" placeholder="Nome Completo" autocomplete="off" style="margin-top: 10px;">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <label for="exampleInputEmail1">Endereço de Email</label>
                        <input type="email" class="form-control" id="signUpEmail" aria-describedby="emailHelp" placeholder="Email do Usuário" autocomplete="off" style="margin-top: 10px;">
                        <small id="emailHelp" class="form-text text-muted" style="margin-top: 18px;display:block;">Ao se cadastrar, você confirma que leu e aceitou nosso aviso de usuário e política de privacidade.</small>
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <label for="exampleInputPassword1">Criar Senha</label>
                        <input type="password" class="form-control" id="signUpPassword" placeholder="Senha do Usuário" style="margin-top: 10px;">
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top: 30px;width:100%;">Cadastrar</button>
                </form>
                <span style="display:block;text-align:center;margin-top: 40px;">Já tem uma conta? <a href="#" id="toSignInPage">Faça Login</a></span>
            </div>
            <div class="sign-in">
                <h3>Faça login para continuar</h3>
                <form id="sign-in-form" method="post" action="/auth/login">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Endereço de Email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" autocomplete="off" style="margin-top: 10px;">
                        <small id="emailHelp" class="form-text text-muted" style="margin-top: 15px;display:block;">Nós não compartilhamos suas informações pessoais com terceiros.</small>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="exampleInputPassword1">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Senha do Usuário" style="margin-top: 10px;">
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top: 30px;width:100%;">Fazer Login</button>
                </form>
                <span style="display:block;text-align:center;margin-top: 40px;">Ainda não tem uma conta? <a href="#" id="toSignUpPage">Cadastre-se</a></span>
            </div>
        </div>
    </section>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
    <script>
        document.getElementById('toSignUpPage').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementsByClassName('sign-up')[0].style.display = 'block';
            document.getElementsByClassName('sign-in')[0].style.display = 'none';
        });
        document.getElementById('toSignInPage').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementsByClassName('sign-in')[0].style.display = 'block';
            document.getElementsByClassName('sign-up')[0].style.display = 'none';
        });
        var signUpForm = new Vue({
            el:'#sign-up-form',
            methods:{
                onSubmit:function(event){
                    const name = document.getElementById('signUpName').value;
                    const email = document.getElementById('signUpEmail').value;
                    const password = document.getElementById('signUpPassword').value;
                    document.getElementById('wait').style.display = "flex";
                    axios.post('/auth/register', {
                        name:name,
                        email:email,
                        password:password
                    })
                    .then((response) => {
                        document.getElementById('wait').style.display = "none";
                        document.getElementById('alert').style.display = "block";
                        document.getElementById('alert').innerHTML = response.data;
                    });
                }
            }
        });
    </script>
@endsection