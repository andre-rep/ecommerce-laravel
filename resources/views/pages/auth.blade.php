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
    <!--<script>
        /*document.getElementById('toSignUpPage').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementsByClassName('sign-up')[0].style.display = 'block';
            document.getElementsByClassName('sign-in')[0].style.display = 'none';
        });
        document.getElementById('toSignInPage').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementsByClassName('sign-in')[0].style.display = 'block';
            document.getElementsByClassName('sign-up')[0].style.display = 'none';
        });*/
    </script>-->
@endsection