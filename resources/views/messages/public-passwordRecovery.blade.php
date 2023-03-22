@extends('layouts.layout')

@section('content')
Insert new password for {{$email}}
<form id="recoverPassword" v-on:submit.prevent="onSubmit">
    @csrf
    <input type="password" id="password">
    <button type="submit">Recover</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var recoverPassword = new Vue({
        el:'#recoverPassword',
        methods:{
            onSubmit:function(event){
                const url = window.location.href;
                const password = document.getElementById('password').value;
                axios.post('http://localhost:8000/changePassword',{
                    url:url,
                    password:password
                })
                .then((response)=>{
                    console.log(response.data);
                });
            }
        }
    });
</script>
@endsection