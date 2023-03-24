<template>
    <div>
        <section class="auth">
            <div class="auth-wrapper">
                <div id="wait" style="display:none;margin-bottom:10px;align-items:center;">
                    <img src="" style="width:25px;height:25px;margin-right:10px;">
                    <h5 style="margin-top:5px;">Aguarde..</h5>
                </div>
                <div class="sign-up" v-if="signUp">
                    <h3>Cadastre-se para continuar</h3>
                    <form id="sign-up-form" method="post" action="/auth/register">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome</label>
                            <input type="text" class="form-control" id="signUpName" name="name" aria-describedby="emailHelp" placeholder="Nome Completo" autocomplete="off" style="margin-top: 10px;">
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label for="exampleInputEmail1">Endereço de Email</label>
                            <input type="email" class="form-control" id="signUpEmail" name="email" aria-describedby="emailHelp" placeholder="Email do Usuário" autocomplete="off" style="margin-top: 10px;">
                            <small id="emailHelp" class="form-text text-muted" style="margin-top: 18px;display:block;">Ao se cadastrar, você confirma que leu e aceitou nosso aviso de usuário e política de privacidade.</small>
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label for="exampleInputPassword1">Criar Senha</label>
                            <input type="password" class="form-control" id="signUpPassword" name="password" placeholder="Senha do Usuário" style="margin-top: 10px;">
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 30px;width:100%;">Cadastrar</button>
                    </form>
                    <span style="display:block;text-align:center;margin-top: 40px;">Já tem uma conta? <a href="#" @click.prevent="toSignInPage">Faça Login</a></span>
                </div>
                <div class="sign-in" v-if="signIn">
                    <h3>Faça login para continuar</h3>
                        <form id="sign-in-form" method="post" action="/auth/login">
                            <input type="hidden" name="_token" :value="csrf_token">
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
                    <span style="display:block;text-align:center;margin-top: 40px;">Ainda não tem uma conta? <a href="#" @click.prevent="toSignUpPage">Cadastre-se</a></span>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        props: ['csrf_token'],
        data(){
            return {
                'signUp': false,
                'signIn': true
            }
        },
        methods:{
            toSignInPage(){
                this.signUp = false
                this.signIn = true
            },
            toSignUpPage(){
                this.signUp = true
                this.signIn = false
            }
        }
    }
</script>
