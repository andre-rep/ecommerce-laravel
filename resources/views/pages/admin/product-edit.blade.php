@extends('layouts.adminLayout')
@section('content')
@include('includes.header')
    <section class="dashboard-ctn">
        <div class="dashboard">
            @include('includes.dashboard-menu')
            <div class="product-edit-ctn">
                <h2>Editar Produto</h2>
                <div class="product-edit">
                    <div class="product-edit-form-ctn">
                        <input type="hidden" id="currentProductName" value="{{$mainProduct[0]->product_name}}">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nome do produto</label>
                            <form id="updateName" style="display:flex;" v-on:submit.prevent="onSubmit">
                                <input type="text" class="form-control" id="newProductName" aria-describedby="emailHelp" style="margin-right:20px;color:#777" value="{{$mainProduct[0]->product_name}}">
                                <button type="submit" class="btn btn-primary">Atualizar</button>
                            </form>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Descrição do produto</label>
                            <form id="updateDescription" style="display:flex;" v-on:submit.prevent="onSubmit">
                                <textarea type="text" class="form-control" id="newProductDescription" aria-describedby="emailHelp" style="margin-right:20px;color:#777;">{{$mainProduct[0]->product_description}}</textarea>
                                <button type="submit" class="btn btn-primary" style="height:40px;">Atualizar</button>
                            </form>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Preço do produto</label>
                            <form id="updatePrice" style="display:flex;" v-on:submit.prevent="onSubmit">
                                <input type="text" class="form-control" id="currentProductPrice" aria-describedby="emailHelp" style="margin-right:20px;" placeholder="R${{$mainProduct[0]->product_price}}.00">
                                <button type="submit" class="btn btn-primary">Atualizar</button>
                            </form>
                        </div>
                        <div class="mb-3">
                            <form id="updateCategoryAndBrand" style="display:flex;" v-on:submit.prevent="onSubmit">
                                <div style="width:41%;margin-right:20px;">
                                    <label for="exampleInputEmail1" class="form-label">Categoria do produto</label>
                                    <select id="newProductCategory" onchange="changeProductCategory();" style="margin-right:20px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="height:50px;">
                                        @foreach($productsCategories as $productsCategory)
                                            <option value="{{$productsCategory->product_category_name}}" selected>{{$productsCategory->product_category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="width:41%;margin-right:20px;">
                                    <label for="formFileMultiple" class="form-label">Marca do produto</label>
                                    <select id="newProductBrand" class="form-select form-select-lg mb-3" style="margin-right:20px;" aria-label=".form-select-lg example" style="height:50px;">
                                            
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" style="height:40px;margin-top:32px;">Atualizar</button>
                            </form>
                        </div>
                        <div class="mb-3" style="margin-top:-12px;">
                            <label for="formFile" class="form-label">Adicionar imagens ao produto</label>
                            <form id="updateImage" style="display:flex;" v-on:submit.prevent="onSubmit">
                                <input class="form-control" type="file" id="image" accept="image/*" style="margin-right:20px;" onchange="loadImage(event);" multiple>
                                <button type="submit" class="btn btn-primary">Adicionar</button>
                            </form>
                        </div>
                        <div class="mb-3">
                            <div id="dvPreview"></div>
                        </div>
                    </div>
                    <div class="product-edit-image-ctn">
                        <h4 style="display:block;width:287px;margin-top:15px;">Imagem em destaque</h4>
                        <div class="product-edit-element">
                            <div class="product-edit-element-image">
                                <img src="{{asset($mainProduct[0]->product_image_url)}}">
                            </div>
                            <div class="product-edit-element-options">
                                <span id="productEditMainName">{{$mainProduct[0]->product_name}}</span>
                                <span>R${{$mainProduct[0]->product_price}}.00</span>
                                <span id="productEditMainDescription">{{$mainProduct[0]->product_description}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="product-edit-gallery-ctn">
                        <h4 style="display:block;width:287px;margin-top:15px;">Imagens secundárias</h4>
                        <div class="product-edit-gallery">
                            @for($i=0; $i<=sizeof($products)-1;$i++)
                                <div class="product-edit-element">
                                    <div class="product-edit-element-image" style="margin-top:10px;">
                                        <img src="{{asset($products[$i]->product_image_url)}}">
                                    </div>
                                    <div class="product-edit-element-options" style="flex-direction:row;justify-content:space-between;margin-top:20px;">
                                        <button class="contrastImage" value="{{$products[$i]->product_image_url}}">
                                            <i class="fas fa-pencil-alt"></i>Destacar
                                        </button>
                                        <button>
                                            <i class="fas fa-times-circle"></i>Deletar
                                        </button>
                                    </div>
                                </div>
                            @endfor    
                        </div>
                    </div>
                </div>
            </div>
            <script>
                //These values are for the menu
                document.getElementById('collapseOne').classList.remove("in");
                document.getElementById('collapseOne').classList.add("show");

                //Function to show the brands according to the category selected
                function changeProductCategory(){
                    var formDataCategory = new FormData();
                    formDataCategory.append('newProductCategory', document.getElementById('newProductCategory').value);
                    axios.post('/brands/retrieve/', formDataCategory,{
                        
                    })
                    .then((response) => {
                        var size = response.data[0].length;
                        var newProductBrand = document.getElementById('newProductBrand');
                        newProductBrand.innerHTML = '';
                        for(var i=0; i<=size-1; i++){
                            var option = document.createElement("option");
                            option.innerHTML = response.data[0][i]['product_brand_name'];
                            option.value = response.data[0][i]['product_brand_name'];
                            newProductBrand.appendChild(option);
                        }
                    })  
                }
                
                //Function to show new images previews when being added
                function loadImage(event){
                    var image = document.getElementById("image");
                    var dvPreview = document.getElementById("dvPreview");
                    dvPreview.innerHTML = "";
                    for(var i=0; i<image.files.length; i++){
                        var file = image.files[i];
                        var reader = new FileReader();
                        reader.onload = function(e){
                            var img = document.createElement("img");
                            img.height = "100";
                            img.width = "100";
                            img.src = e.target.result;
                            dvPreview.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                    }
                }

                //Load categories and brands info when the page loads
                changeProductCategory();

                //Put a  shorter version of the product name in the main image card
                var productEditMainName = document.getElementById('productEditMainName');
                var substring = productEditMainName.textContent.substring(0, 30);
                productEditMainName.innerHTML = substring;

                //Put a shorter version of the product description in the main image card
                var productEditMainDescription = document.getElementById('productEditMainDescription');
                var substring = productEditMainDescription.textContent.substring(0, 30);
                productEditMainDescription.innerHTML = substring;

                //Update product name
                var updateName = new Vue({
                    el:'#updateName',
                    methods:{
                        onSubmit:function(event){
                            var formData = new FormData();
                            formData.append('newProductName', document.getElementById('newProductName').value);
                            formData.append('currentProductName', document.getElementById('currentProductName').value);
                            axios.post('/product/update/', formData,{
                                headers:{
                                    'element':'name'
                                }
                            })
                            .then((response) => {
                                window.location.replace("/dashboard/product-edit/" + response.data);
                            })
                        }
                    }
                });

                //Update product description
                var updateDescription = new Vue({
                    el:'#updateDescription',
                    methods:{
                        onSubmit:function(event){
                            var formData = new FormData();
                            formData.append('newProductDescription', document.getElementById('newProductDescription').value);
                            formData.append('currentProductName', document.getElementById('currentProductName').value);
                            axios.post('/product/update/', formData,{
                                headers:{
                                    'element':'description'
                                }
                            })
                            .then((response) => {
                                document.location.reload(true);
                            })
                        }
                    }
                });

                //Update product price
                var updatePrice = new Vue({
                    el:'#updatePrice',
                    methods:{
                        onSubmit:function(event){
                            var formData = new FormData();
                            formData.append('currentProductPrice', document.getElementById('currentProductPrice').value);
                            formData.append('currentProductName', document.getElementById('currentProductName').value);
                            axios.post('/product/update/', formData,{
                                headers:{
                                    'element':'price'
                                }
                            })
                            .then((response) => {
                                document.location.reload(true);
                            })
                        }
                    }
                });

                //Update product category and brand
                var updateCategoryAndBrand = new Vue({
                    el:'#updateCategoryAndBrand',
                    methods:{
                        onSubmit:function(event){
                            var formData = new FormData();
                            formData.append('newProductBrand', document.getElementById('newProductBrand').value);
                            formData.append('newProductCategory', document.getElementById('newProductCategory').value);
                            formData.append('currentProductName', document.getElementById('currentProductName').value);
                            axios.post('/product/update/', formData,{
                                headers:{
                                    'element':'categoryAndBrand'
                                }
                            })
                            .then((response) => {
                                document.location.reload(true);
                            })
                        }
                    }
                });

                //Add images to the product
                var updateImage = new Vue({
                    el:'#updateImage',
                    methods:{
                        onSubmit:function(event){
                            var formData = new FormData();
                            formData.append('productName', document.getElementById('currentProductName').value);
                            for(var i=0; i<document.querySelector('#image').files.length; i++){
                                formData.append('file[' + i + ']', document.querySelector('#image').files[i]);
                            }
                            axios.post('/product/update/', formData,{
                                headers:{
                                    'element':'imageAdd'
                                }
                            })
                            .then((response) => {
                                document.location.reload(true);
                            })
                        }
                    }
                });

                //Alter the main image of the product among existing images
                var contrastImage = document.getElementsByClassName('contrastImage');
                for(var i=0; i<contrastImage.length; i++){
                    contrastImage[i].onclick = function(target){
                        var formData = new FormData();
                        formData.append('productName', document.getElementById('currentProductName').value);
                        formData.append('imageUrl', this.value);
                        axios.post('/product/update/', formData,{
                            headers:{
                                'element':'contrastImage'
                            }
                        })
                        .then((response) => {
                            document.location.reload(true);
                        })
                    }
                }
            </script>
        </div>
    </section>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection