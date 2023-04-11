@extends('layouts.app')
@section('content')
    @include('includes.header')
    @include('includes.main-menu')
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
    @include('includes.offers')
    <!--<script>
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
    </script>-->
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection