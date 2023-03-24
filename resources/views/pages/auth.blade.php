@extends('layouts.publicLayout')
@include('includes.header')
@section('content')
    <auth-component csrf_token="{{ @csrf_token() }}"></auth-component>
    <!--
    <section class="auth">
        <div class="auth-wrapper">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-primary" id="alert" role="alert">
                        {{$error}}
                    </div>
                @endforeach
            @endif
        </div>
    </section>-->
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection