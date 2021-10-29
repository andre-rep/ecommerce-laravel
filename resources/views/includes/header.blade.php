<header>
    <div class="header-wrapper">
        <div class="header-logo">
            <a href="{{asset('/')}}">
                <img src="{{asset('image/logo.png')}}">
            </a>
        </div>
        <div class="header-search">
            <form id="searchForm" v-on:submit.prevent="onSubmit">
                <input id="searchKeyword" type="text" placeholder="Procurar por Produtos, Marcas e Categorias">
                <button type="submit"></button>
            </form>
        </div>
        <div id="header-login-ctn">
            <i class="fas fa-user"></i>
            @if(Auth::user() != null)
                @if(Auth::user()->user_access_level == 1 || Auth::user()->user_access_level == 2)
                    <span>Olá, {{ strtok(Auth::user()->name, ' ') }}</span>
                    <div id="header-login-option">
                        <div class="header-login-user-id">
                            <span>{{strtok(Auth::user()->name, ' ')}}</span>
                        </div>
                        <div class="header-login-item">
                            @if(Auth::user()->user_access_level == 1)
                                <a href="{{asset('/user/edit-profile')}}">Perfil de Usuário</a>
                            @elseif(Auth::user()->user_access_level == 2)
                                <a href="{{asset('/dashboard/product-list')}}">Painel de Controle</a>
                            @endif
                        </div>
                        <div class="header-login-item">
                            <button id="logout">Sair</button>
                        </div>
                    </div>
                @endif
            @else
                <a href="{{asset('/auth')}}">Criar / Entrar em uma conta</a>
            @endif
        </div>
        <div class="header-cart">
            @if(Auth::user() != null)
                @if($cartItems != '0')
                    <div class="header-cart-items">
                        <span>{{$cartItems}}</span>
                    </div>
                @endif
                @if(Auth::user()->user_access_level == 1)
                    <a href="{{asset('/cart')}}">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Carrinho</span>
                    </a>
                @elseif(Auth::user()->user_access_level == 2)
                    <a href="#">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Carrinho</span>
                    </a>
                @endif
            @else
                <a href="{{asset('/auth')}}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Carrinho</span>
                </a>
            @endif
        </div>
    </div>
</header>
<script>
    //Make the search with keyword
    var searchForm = new Vue({
        el:'#searchForm',
        methods:{
            onSubmit:function(event){
                window.location.href = "http://localhost:8000/search?keyword=" + document.getElementById('searchKeyword').value;
            }
        }
    });

    //Allow logged in user to logout
    @if(Auth::user()->user_access_level == 1 || Auth::user()->user_access_level == 2)
        document.getElementById('header-login-ctn').addEventListener('mouseover', (e) =>{
            document.getElementById('header-login-option').style.display = 'block';
        });
        document.getElementById('header-login-ctn').addEventListener('mouseout', (e) =>{
            document.getElementById('header-login-option').style.display = 'none';
        });
        document.getElementById('logout').addEventListener('click', (e) =>{
            e.preventDefault();
            axios.post('http://localhost:8000/logout', null,{
                
            })
            .then((response) => {
                document.location.reload(true);
            })
        });
    @endif
</script>