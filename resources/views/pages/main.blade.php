@extends('layouts.app')
@section('content')
    @include('includes.header')
    @include('includes.main-menu')
    <main-component
        banner-image-url="{{asset($banners->banner_image_url)}}"
        banner-is-promotion="{{$banners->banner_is_promotion}}"
        banner-bg-text="{{$banners->banner_bg_text}}"
        banner-sm-text="{{$banners->banner_sm_text}}"
        tv-link="{{asset('search?filterByCategory[]=tv')}}"
        notebook-link="{{asset('search?filterByCategory[]=notebook')}}"
        tablet-link="{{asset('search?filterByCategory[]=tablet')}}"
        roteador-link="{{asset('search?filterByCategory[]=roteador')}}"
        hd-link="{{asset('search?filterByCategory[]=hd')}}"
        processador-link="{{asset('search?filterByCategory[]=processador')}}"
        papelaria-link="{{asset('search?filterByCategory[]=papelaria')}}"
        sonorizacao-link="{{asset('search?filterByCategory[]=sonorizacao')}}"
        teclado-link="{{asset('search?filterByCategory[]=teclado')}}"
    >
    </main-component>
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