@extends('layouts.adminLayout')
@section('content')
@include('includes.header')
    <section class="dashboard-ctn">
        <div class="dashboard">
            @include('includes.dashboard-menu')
            <div class="product-tags-ctn">
                <h2>Tags de Produtos</h2>
                <div class="alert alert-primary" id="alert" role="alert" style="display:none;">
                        
                </div>
                <div class="product-tags">
                    <form id="addTag" v-on:submit.prevent="onSubmit">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nome da tag</label>
                            <input class="form-control" id="tagsName" type="text" placeholder="Novo nome" aria-label="default input example">
                        </div>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </form>
                </div>
            </div>
            <script>
                //These are for the menu
                document.getElementById('collapseOne').classList.remove("in");
                document.getElementById('collapseOne').classList.add("show");

                var addProduct = new Vue({
                    el:'#addTag',
                    methods:{
                        onSubmit:function(event){
                            var formData = new FormData();
                            formData.append('tagsName', document.getElementById('tagsName').value);
                            axios.post('/tag/insert/', formData,{
                                
                            })
                            .then((response) => {
                                document.getElementById('alert').style.display = "block";
                                document.getElementById('alert').innerHTML = response.data;
                            })
                        }
                    }
                });
            </script>
        </div>
    </section>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection