@extends('layouts.userLayout')
@section('content')
    @include('includes.header')
    <div id="root"></div>
    <section class="main-menu-ctn">
        <div class="main-menu">
            <div class="main-menu-top">
                <div class="main-menu-categories">
                    <span>Categorias</span>
                </div>
                <div class="main-menu-options">
                    <div class="main-menu-options-links">
                        <a href="{{asset('search?filterByCategory[]=smartphone')}}">Smartphones</a>
                        <a href="{{asset('search?filterByCategory[]=tv')}}">Tv's</a>
                        <a href="{{asset('search?filterByCategory[]=notebook')}}">Notebooks</a>
                        <a href="{{asset('search?filterByCategory[]=tablet')}}">Tablets</a>
                        <a href="{{asset('search?filterByCategory[]=roteador')}}">Roteadores</a>
                        <a href="{{asset('search?filterByCategory[]=hd')}}">HD's</a>
                    </div>
                    <div class="main-menu-options-contact">
                        <span>Telefone:</span>
                        <span>(91) 9999-8888</span>
                    </div>
                </div>
            </div>
            <div class="main-menu-wrapper">
                <div class="main-menu-btn">
                    <a href="{{asset('search?filterByCategory[]=smartphone')}}"></a>
                    <i class="fas fa-mobile-alt"></i>
                    <span>Smartphones</span>
                </div>
                <div class="main-menu-btn">
                    <a href="{{asset('search?filterByCategory[]=tv')}}"></a>
                    <i class="fas fa-tv"></i>
                    <span>Tv's</span>
                </div>
                <div class="main-menu-btn">
                    <a href="{{asset('search?filterByCategory[]=notebook')}}"></a>
                    <i class="fas fa-laptop"></i>
                    <span>Notebooks</span>
                </div>
                <div class="main-menu-btn">
                    <a href="{{asset('search?filterByCategory[]=tablet')}}"></a>
                    <i class="fas fa-tablet-alt"></i>
                    <span>Tablets</span>
                </div>
                <div class="main-menu-btn">
                    <a href="{{asset('search?filterByCategory[]=roteador')}}"></a>
                    <i class="fas fa-wifi"></i>
                    <span>Roteadores</span>
                </div>
                <div class="main-menu-btn">
                    <a href="{{asset('search?filterByCategory[]=hd')}}"></a>
                    <i class="far fa-hdd"></i>
                    <span>HD's</span>
                </div>
                <div class="main-menu-btn">
                    <a href="{{asset('search?filterByCategory[]=processador')}}"></a>
                    <i class="fas fa-microchip"></i>
                    <span>Processadores</span>
                </div>
                <div class="main-menu-btn">
                    <a href="{{asset('search?filterByCategory[]=papelaria')}}"></a>
                    <i class="fas fa-paperclip"></i>
                    <span>Papelaria</span>
                </div>
                <div class="main-menu-btn">
                    <a href="{{asset('search?filterByCategory[]=sonorizacao')}}"></a>
                    <i class="fas fa-headphones-alt"></i>
                    <span>Sonorização</span>
                </div>
            </div>
            <div class="main-menu-carousel">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner" style="height:490px;">
                        {{$n = 0}}
                        @foreach($gallery as $image)
                            @if($n == 0)
                                <div class="carousel-item active main-carousel-item">
                            @else
                                <div class="carousel-item main-carousel-item">
                            @endif
                                <div class="main-carousel-info">
                                    <span>{{$image->carousel_image_bg_text}}</span>
                                    <span>{{$image->carousel_image_sm_text}}</span>
                                    <button>{{$image->carousel_image_btn_text}}</button>
                                </div>
                                <div class="main-carousel-shadow"></div>
                                <img src="{{asset($image->carousel_image_url)}}" class="d-block w-100" alt="...">
                            </div>
                            {{$n++}}
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section class="main-banner-ctn">
        <div class="main-banner">
            <img src="{{asset($banners->banner_image_url)}}" style="position:absolute;width:100%;height:100%;">
            <div class="main-banner-info">
                @if($banners->banner_is_promotion == 1)
                    <span>Oferta Especial!</span>
                @else
                    <span style="display:none;"></span>
                @endif
                <span>{{$banners->banner_bg_text}}</span>
                <span>{{$banners->banner_sm_text}}</span>
            </div>
        </div>
    </section>
    <section class="main-categories-ctn">
        <div class="main-categories">
            <div class="main-categories-header">
                <span>Categorias</span>
            </div>
            <div class="main-categories-body">
                <div class="main-category">
                    <a href="{{asset('search?filterByCategory[]=tv')}}"></a>
                    <i class="fas fa-tv"></i>
                    <span>Tv's</span>
                </div>
                <div class="main-category">
                    <a href="{{asset('search?filterByCategory[]=smartphone')}}"></a>
                    <i class="fas fa-mobile-alt"></i>
                    <span>Smartphones</span>
                </div>
                <div class="main-category">
                    <a href="{{asset('search?filterByCategory[]=notebook')}}"></a>
                    <i class="fas fa-laptop"></i>
                    <span>Notebooks</span>
                </div>
                <div class="main-category">
                    <a href="{{asset('search?filterByCategory[]=tablet')}}"></a>
                    <i class="fas fa-tablet-alt"></i>
                    <span>Tablets</span>
                </div>
                <div class="main-category">
                    <a href="{{asset('search?filterByCategory[]=roteador')}}"></a>
                    <i class="fas fa-wifi"></i>
                    <span>Roteadores</span>
                </div>
                <div class="main-category">
                    <a href="{{asset('search?filterByCategory[]=hd')}}"></a>
                    <i class="far fa-hdd"></i>
                    <span>HD's</span>
                </div>
                <div class="main-category">
                    <a href="{{asset('search?filterByCategory[]=processador')}}"></a>
                    <i class="fas fa-microchip"></i>
                    <span>Processadores</span>
                </div>
                <div class="main-category">
                    <a href="{{asset('search?filterByCategory[]=papelaria')}}"></a>
                    <i class="fas fa-paperclip"></i>
                    <span>Papelaria</span>
                </div>
                <div class="main-category">
                    <a href="{{asset('search?filterByCategory[]=sonorizacao')}}"></a>
                    <i class="fas fa-headphones-alt"></i>
                    <span>Sonorização</span>
                </div>
                <div class="main-category">
                    <a href="{{asset('search?filterByCategory[]=teclado')}}"></a>
                    <i class="far fa-keyboard"></i>
                    <span>Teclados</span>
                </div>
            </div>
        </div>
    </section>
    <section class="main-offers-ctn">
        <div class="main-offers">
            <div class="main-offers-header">
                <div class="main-offers-header-info">
                    <span>Produtos em destaque e ofertas</span>
                </div>
            </div>
            <div class="main-offers-body">
                <div class="splide" id="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <div class="main-offers-product">
                                    <a class="main-offers-product-link" href="http://localhost:8000/product/Notebook%20Gamer%20Dell%20G3%203500-U10P%2015.6%22%2010%C2%AA%20Gera%C3%A7%C3%A3o%20Intel%20Core%20i5%208GB%20256GB%20SSD%20NVIDIA%20GTX%201650%20Linux">
                                        
                                    </a>
                                    <div class="main-offers-product-image">
                                        <span class="main-offers-product-sale">Oferta</span>
                                        <img src="{{asset('image/notebook/dell/4.jpg')}}">
                                    </div>
                                    <div class="main-offers-product-desc-ctn">
                                        <div class="main-offers-product-description">
                                            <span class="product-name">Notebook Gamer Dell G3 3500-U10P 15.6" 10ª Geração Intel Core i5 8GB 256GB SSD NVIDIA GTX 1650 Linux</span>
                                            <span>R$5323.00</span>
                                            <div class="main-offers-product-rate">
                                                <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                <i class="fa fa-star" style="color:rgb(203,203,203)"></i>
                                                <i class="fa fa-star" style="color:rgb(203,203,203)"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="main-offers-product">
                                    <a class="main-offers-product-link" href="http://localhost:8000/product/Notebook%20VAIO%20Core%20i7-10510U%208GB%201TB%20Tela%2015.6%E2%80%9D%20Windows%2010%20FE15%20VJFE5211X-B0211H">
                                        
                                    </a>
                                    <div class="main-offers-product-image">
                                        <img src="{{asset('image/notebook/vaio/11.webp')}}">
                                    </div>
                                    <div class="main-offers-product-desc-ctn">
                                        <div class="main-offers-product-description">
                                            <span class="product-name">Notebook VAIO Core i7-10510U 8GB 1TB Tela 15.6” Windows 10 FE15 VJFE5211X-B0211H</span>
                                            <span>R$5099.00</span>
                                            <div class="main-offers-product-rate">
                                                <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                <i class="fa fa-star" style="color:rgb(203,203,203)"></i>
                                                <i class="fa fa-star" style="color:rgb(203,203,203)"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="main-offers-product">
                                    <a class="main-offers-product-link" href="http://localhost:8000/product/Notebook%20Samsung%20Chromebook%20Dual-Core%20N3060%202GB%20Ram%2016GB%20Tela%2011.6%20Chrome%20OS">
                                        
                                    </a>
                                    <div class="main-offers-product-image">
                                        <span class="main-offers-product-pinned">Mais Vendido</span>
                                        <img src="{{asset('image/notebook/samsung/4.webp')}}">
                                    </div>
                                    <div class="main-offers-product-desc-ctn">
                                        <div class="main-offers-product-description">
                                            <span class="product-name">Notebook Samsung Chromebook Dual-Core N3060 2GB Ram 16GB Tela 11.6 Chrome OS</span>
                                            <span>R$1997.00</span>
                                            <div class="main-offers-product-rate">
                                                <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                <i class="fa fa-star" style="color:rgb(203,203,203)"></i>
                                                <i class="fa fa-star" style="color:rgb(203,203,203)"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="main-offers-product">
                                    <a class="main-offers-product-link" href="http://localhost:8000/product/Smart%20TV%20LED%2050%22%20UHD%204K%20LG%2050UN7310PSC%20Wi-Fi,%20Bluetooth,%20HDR,%20Intelig%C3%AAncia%20Artificial%20ThinQ%20AI,%20Google%20Assistente,%20Alexa,%20Controle%20Smart%20Magic%20-%202020">
                                        
                                    </a>
                                    <div class="main-offers-product-image">
                                        <img src="{{asset('image/tv/lg/1.jpg')}}">
                                    </div>
                                    <div class="main-offers-product-desc-ctn">
                                        <div class="main-offers-product-description">
                                            <span class="product-name">Smart TV LED 50" UHD 4K LG 50UN7310PSC Wi-Fi, Bluetooth, HDR, Inteligência Artificial ThinQ AI, Google Assistente, Alexa, Controle Smart Magic - 2020</span>
                                            <span>R$2564.00</span>
                                            <div class="main-offers-product-rate">
                                                <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                <i class="fa fa-star" style="color:rgb(203,203,203)"></i>
                                                <i class="fa fa-star" style="color:rgb(203,203,203)"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="main-offers-product">
                                    <a class="main-offers-product-link" href="http://localhost:8000/product/iPhone%206s%20Apple%20com%203D%20Touch,%20iOS%2013,%20Sensor%20Touch%20ID,%20C%C3%A2mera%20iSight%2012MP,%20Wi-Fi,%204G,%20GPS,%20Bluetooth%20e%20NFC,%2032GB,%20Cinza%20Espacial,%20Tela%204,7%22">
                                        
                                    </a>
                                    <div class="main-offers-product-image">
                                        <img src="{{asset('image/smartphone/iphone/2.webp')}}">
                                    </div>
                                    <div class="main-offers-product-desc-ctn">
                                        <div class="main-offers-product-description">
                                            <span class="product-name">iPhone 6s Apple com 3D Touch, iOS 13, Sensor Touch ID, Câmera iSight 12MP, Wi-Fi, 4G, GPS, Bluetooth e NFC, 32GB, Cinza Espacial, Tela 4,7"</span>
                                            <span>R$2169.00</span>
                                            <div class="main-offers-product-rate">
                                                <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                <i class="fa fa-star" style="color:rgb(203,203,203)"></i>
                                                <i class="fa fa-star" style="color:rgb(203,203,203)"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        //Set the names of the offer products to a shorter version
        var productName = document.getElementsByClassName('product-name');
        var size = productName.length;
        for(var i=0; i<size; i++){
            var substring = productName[i].textContent.substring(0, 40);
            productName[i].innerHTML = substring + '...';
        }

        //Splide
        new Splide( '.splide', {
            type   : 'loop',
            perPage: 5,
            perMove: 1,
        } ).mount();
    </script>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection