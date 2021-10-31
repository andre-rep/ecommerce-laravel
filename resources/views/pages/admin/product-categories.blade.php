@extends('layouts.adminLayout')
@section('content')
@include('includes.header')
    <section class="dashboard-ctn">
        <div class="dashboard">
            @include('includes.dashboard-menu')
            <div class="product-categories-ctn">
                <h2>Categorias e Marcas</h2>
                <div class="product-categories">
                    <div class="product-categories-form">
                        <form id="addCategoryOrBrand" v-on:submit.prevent="onSubmit">
                            <h5>Adicionar</h5>
                            <div class="mb-3" style="display:flex;margin-top:20px;">
                                <div class="form-check" style="margin-right:15px;">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="categoryRadio" value="category" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Categoria
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="brandRadio" value="brand">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Marca
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3" id="categoryForm" style="display:none;">
                                <label for="formFileMultiple" class="form-label">Categoria</label>
                                <select id="category" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="height:50px;">
                                    @foreach($productsCategories as $productsCategory)
                                        <option value="{{$productsCategory->product_category_name}}" selected>{{$productsCategory->product_category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" placeholder="Adicionar Categoria ou Marca" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group" style="margin-bottom:15px;">
                                <label for="exampleFormControlTextarea1" style="margin-bottom:10px;">Descrição</label>
                                <textarea class="form-control" id="description" rows="3" placeholder="Opcional"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="createButton">Criar Categoria</button>
                        </form>
                    </div>
                    <div class="product-categories-brands-table">
                        <h4 id="categoryTitle">Categorias</h4>
                        <table class="product-categories-table" id="categoryTable">
                            <thead class="product-categories-thead">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody class="product-categories-tbody">
                                @foreach($productsCategories as $productsCategory)
                                    <tr>
                                        <th scope="row">{{$productsCategory->id}}</th>
                                        <td>
                                            <span id="{{$productsCategory->id}}" class="categoryName" contenteditable="true">{{$productsCategory->product_category_name}}</span>
                                        </td>
                                        @if($productsCategory->product_category_description == '')
                                            <td>
                                                <span id="{{$productsCategory->id}}" class="categoryDescription" contenteditable="true">Não há descrição</span>
                                            </td>
                                        @else
                                            <td>
                                                <span id="{{$productsCategory->id}}" class="categoryDescription" contenteditable="true">{{$productsCategory->product_category_description}}</span>
                                            </td>
                                        @endif
                                        <td>
                                            <button id="{{$productsCategory->id}}" class="btn btn-primary categoryButton">Atualizar</button>
                                        </td>
                                    </tr>    
                                @endforeach
                            </tbody>
                        </table>
                        <h4 id="brandTitle" style="display:none;">Marcas</h4>
                        <table class="product-brands-table" id="brandTable" style="display:none;">
                            <thead class="product-brands-thead">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody class="product-brands-tbody">
                                @foreach ($productsBrands as $productsBrand)
                                    <tr>
                                        <th scope="row">{{$productsBrand->id}}</th>
                                        <td>
                                            <span id="{{$productsBrand->id}}" class="brandName" contenteditable="true">{{$productsBrand->product_brand_name}}</span>
                                        </td>
                                        @if($productsBrand->product_brand_description == '')
                                            <td>
                                                <span id="{{$productsBrand->id}}" class="brandDescription" contenteditable="true">Não há descrição</span>
                                            </td>
                                        @else
                                            <td>
                                                <span id="{{$productsBrand->id}}" class="brandDescription" contenteditable="true">{{$productsBrand->product_brand_description}}</span>
                                            </td>
                                        @endif
                                        <td>
                                            <button id="{{$productsCategory->id}}" class="btn btn-primary brandButton">Atualizar</button>
                                        </td>
                                    </tr>    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <script>
                document.getElementById('collapseOne').classList.remove("in");
                document.getElementById('collapseOne').classList.add("show");

                //Elements to work with from the DOM
                var categoryButton = document.getElementsByClassName('categoryButton');
                var categoryName = document.getElementsByClassName('categoryName');
                var categoryDescription = document.getElementsByClassName('categoryDescription');

                var brandButton = document.getElementsByClassName('brandButton');
                var brandName = document.getElementsByClassName('brandName');
                var brandDescription = document.getElementsByClassName('brandDescription');
                
                //Update category name and or description
                for(var i=0; i<categoryButton.length; i++){
                    categoryButton[i].onclick = function(target){
                        for(var i=0; i<categoryName.length; i++){
                            if(categoryName[i].id == this.id){
                                categoryName = categoryName[i].textContent;
                            }
                        }
                        for(var i=0; i<categoryDescription.length; i++){
                            if(categoryDescription[i].id == this.id){
                                categoryDescription = categoryDescription[i].textContent;
                            }
                        }
                        //Send the request to update the values
                        var formData = new FormData();
                        formData.append('categoryName', categoryName);
                        formData.append('categoryDescription', categoryDescription);
                        formData.append('categoryId', this.id);
                        axios.post('/product/category-update/', formData, {

                        })
                        .then((response) => {
                            document.location.reload(true);
                        })
                    }
                }

                //Update brand name and or description
                for(var i=0; i<brandButton.length; i++){
                    brandButton[i].onclick = function(target){
                        for(var i=0; i<brandName.length; i++){
                            if(brandName[i].id == this.id){
                                brandName = brandName[i].textContent;
                            }
                        }
                        for(var i=0; i<brandDescription.length; i++){
                            if(brandDescription[i].id == this.id){
                                brandDescription = brandDescription[i].textContent;
                            }
                        }
                        //Send the request to update the values
                        var formData = new FormData();
                        formData.append('brandName', brandName);
                        formData.append('brandDescription', brandDescription);
                        formData.append('brandId', this.id);
                        axios.post('/product/brand-update/', formData, {
                            
                        })
                        .then((response) => {
                            document.location.reload(true);
                        })
                    }
                }

                //Add new category
                var addCategoryOrBrand = new Vue({
                    el:'#addCategoryOrBrand',
                    methods:{
                        onSubmit:function(event){
                            var formData = new FormData();
                            formData.append('name', document.getElementById('name').value);

                            if(document.getElementById('categoryRadio').checked){
                                formData.append('type', 'category');
                            }else if (document.getElementById('brandRadio').checked){
                                formData.append('category', document.getElementById('category').value);
                                formData.append('type', 'brand');
                            }
                            formData.append('description', document.getElementById('description').value);
                            axios.post('/product/insert-category-brand/', formData,{
                                
                            })
                            .then((response) => {
                                document.location.reload(true);
                            })
                        }
                    }
                });

                //Change the content of the page if 'Categoria' or 'Marca' radio button is clicked
                if(document.querySelector('input[name="flexRadioDefault"]')){
                    document.querySelectorAll('input[name="flexRadioDefault"]').forEach((elem) => {
                        elem.addEventListener("change", function (e){
                            if(e.target.value == "brand"){
                                document.getElementById('categoryForm').style.display = 'block';
                                document.getElementById('createButton').innerHTML = 'Criar Marca';

                                document.getElementById('brandTitle').style.display = 'block';
                                document.getElementById('brandTable').style.display = 'block';
                                document.getElementById('categoryTitle').style.display = 'none';
                                document.getElementById('categoryTable').style.display = 'none';
                            }else if(e.target.value == "category"){
                                document.getElementById('categoryForm').style.display = 'none';
                                document.getElementById('createButton').innerHTML = 'Criar Categoria';

                                document.getElementById('brandTitle').style.display = 'none';
                                document.getElementById('brandTable').style.display = 'none';
                                document.getElementById('categoryTitle').style.display = 'block';
                                document.getElementById('categoryTable').style.display = 'block';
                            }
                        });
                    })
                }
            </script>
        </div>
    </section>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection