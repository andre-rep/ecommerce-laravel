<template>
    <div class="header-wrapper">
        <div class="header-logo">
            <a :href="assetMain">
                <img :src="assetLogo">
            </a>
        </div>
        <div class="header-search">
            <form id="searchForm" @submit.prevent="search">
                <input id="searchKeyword" type="text" placeholder="Procurar por Produtos, Marcas e Categorias">
                <button type="submit"></button>
            </form>
        </div>
        <div id="header-login-ctn" @mouseover="showHeaderLoginCtn" @mouseout="hideHeaderLoginCtn">
            <i class="fas fa-user"></i>
            <template v-if="authUser">
                <span>Olá, {{ userName }}</span>
                <div id="header-login-option">
                    <div class="header-login-user-id">
                        <span>{{ userName }}</span>
                    </div>
                    <div class="header-login-item">
                        <template v-if="userAccessLevel == 1">
                            <a :href="assetProfile">Perfil de Usuário</a>
                        </template>
                        <template v-else-if="userAccessLevel == 2">
                            <a :href="assetProductList">Painel de Controle</a>
                        </template>
                    </div>
                    <div class="header-login-item">
                        <button id="logout" @click="logout">Sair</button>
                    </div>
                </div>
            </template>
            <template v-else>
                <a :href="assetAuth">Criar / Entrar em uma conta</a>
            </template>
        </div>
        <div class="header-cart">
            <template v-if="authUser">
                <template v-if="userAccessLevel == 1">
                    <div class="header-cart-items" v-if="cartItems != 0">
                        <span>{{ cartItems }}</span>
                    </div>
                    <a :href="assetCart">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Carrinho</span>
                    </a>
                </template>
                <template v-if="userAccessLevel == 2">
                    <a href="#">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Carrinho</span>
                    </a>
                </template>
            </template>
            <template v-else>
                <a :href="assetAuth">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Carrinho</span>
                </a>
            </template>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'HeaderComponent',
        props: ['assetMain', 'assetLogo', 'assetProfile', 'assetProductList', 'assetAuth', 'assetCart', 'authUser', 'userName', 'userAccessLevel', 'cartItems'],
        data(){
            return {
                headerLoginOption:false
            }
        },
        methods:{
            showHeaderLoginCtn(){
                document.getElementById('header-login-option').style.display = 'block';
            },
            hideHeaderLoginCtn(){
                document.getElementById('header-login-option').style.display = 'none';
            },
            logout(){
                axios.post('/auth/logout', null,{
                
                })
                .then((response) => {
                    document.location.reload(true);
                })
            },
            search(){
                window.location.href = "http://localhost:8000/search?keyword=" + document.getElementById('searchKeyword').value;
            }
        }
    }
</script>
