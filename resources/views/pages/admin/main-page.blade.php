@extends('layouts.adminLayout')
@section('content')
@include('includes.header')
    <section class="dashboard-ctn">
        <div class="dashboard">
            @include('includes.dashboard-menu')
            <div class="banner-ctn">
                <h2>Página Principal</h2>
                <div class="banner">
                    <h4>Banner</h4>
                    <div class="alert alert-primary" id="alert" role="alert" style="display:none;">
                        
                    </div>
                    <form id="addBanner" v-on:submit.prevent="onSubmit">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Escolha uma imagem nova</label>
                            <input class="form-control" type="file" id="bannerImage">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Texto Maior</label>
                            <input class="form-control" type="text" placeholder="Escreva aqui" id="bannerBgText">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Texto Menor</label>
                            <input class="form-control" type="text" placeholder="Escreva aqui" id="bannerSmText">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="bannerIsPromotion">
                            <label class="form-check-label" for="exampleCheck1">Promoção</label>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top:15px;">Atualizar</button>
                    </form>
                </div>
                <div class="gallery">
                    <h4>Galeria</h4>
                    <div class="alert alert-primary" id="alert" role="alert" style="display:none;margin-bottom:-30px;">
                        
                    </div>
                    <div class="gallery-image-wrapper">
                        <img id="galleryImagePreview" class="gallery-image">
                        <form id="addGalleryImage" class="add-gallery-image" v-on:submit.prevent="onSubmit">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Escolha uma imagem nova</label>
                                <input class="form-control" type="file" id="galleryImage" accept="image/*" onchange="previewImage(event)">
                            </div>
                            <div style="display:flex;justify-content:space-between;">
                                <div class="mb-3" style="width:280px;">
                                    <label for="formFile" class="form-label">Texto Maior</label>
                                    <input class="form-control" type="text" id="galleryBgText" placeholder="Escreva aqui">
                                </div>
                                <div class="mb-3" style="width:280px;">
                                    <label for="formFile" class="form-label">Texto Menor</label>
                                    <input class="form-control" type="text" id="gallerySmText" placeholder="Escreva aqui">
                                </div>
                            </div>
                            <div style="display:flex;justify-content:space-between;">
                                <div class="mb-3" style="width:280px;">
                                    <label for="formFile" class="form-label">Texto do botão</label>
                                    <input class="form-control" type="text" id="galleryBtnText" placeholder="Se existir um botão, adicionar o texto">
                                </div>
                                <div class="mb-3" style="width:280px;">
                                    <label for="formFile" class="form-label">Link do botão</label>
                                    <input class="form-control" type="text" id="galleryBtnLink" placeholder="Link para onde o botão leva">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-top:15px;">Adicionar</button>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                //These are for the menu
                document.getElementById('collapseSeven').classList.remove("in");
                document.getElementById('collapseSeven').classList.add("show");

                var addBanner = new Vue({
                    el:'#addBanner',
                    methods:{
                        onSubmit:function(event){
                            var formData = new FormData();
                            formData.append('bannerImage', document.getElementById('bannerImage').files[0]);
                            formData.append('bannerBgText', document.getElementById('bannerBgText').value);
                            formData.append('bannerSmText', document.getElementById('bannerSmText').value);
                            formData.append('bannerIsPromotion', document.getElementById('bannerIsPromotion').checked);
                            axios.post('/banner/insert/', formData,{
                                
                            })
                            .then((response) => {
                                document.getElementById('alert').style.display = "block";
                                document.getElementById('alert').innerHTML = response.data;
                            })
                        }
                    }
                });
                
                function previewImage(){
                    var reader =  new FileReader();
                    reader.onload = function(){
                        var output = document.getElementById('galleryImagePreview');
                        output.src = reader.result;
                    }
                    reader.readAsDataURL(event.target.files[0]);
                }

                var addGalleryImage = new Vue({
                    el:'#addGalleryImage',
                    methods:{
                        onSubmit:function(event){
                            var formData = new FormData();
                            formData.append('galleryImage', document.getElementById('galleryImage').files[0]);
                            formData.append('galleryBgText', document.getElementById('galleryBgText').value);
                            formData.append('gallerySmText', document.getElementById('gallerySmText').value);
                            formData.append('galleryBtnText', document.getElementById('galleryBtnText').value);
                            formData.append('galleryBtnLink', document.getElementById('galleryBtnLink').value);
                            axios.post('/gallery/insert/', formData,{
                                
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