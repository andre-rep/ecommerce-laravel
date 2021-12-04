@extends('layouts.adminLayout')
@section('content')
@include('includes.header')
    <section class="dashboard-ctn">
        <div class="dashboard">
            @include('includes.dashboard-menu')
            <div class="product-add-ctn">
                <h2>Adicionar Produto</h2>
                <div class="product-add">
                    <div class="alert alert-primary" id="alert" role="alert" style="display:none;">
                        
                    </div>
                    <form id="addProduct" method="post" action="/product/insert/" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nome do Produto</label>
                            <input type="text" class="form-control" name="productName" id="productName" aria-describedby="emailHelp" placeholder="Escreva aqui">
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Descrição</label>
                                <textarea class="form-control" name="productDescription" id="productDescription" rows="3" placeholder="Escreva aqui"></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Categoria</label>
                            <select id="productCategory" name="productCategory" onchange="change();" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="height:50px;">
                                @foreach($productsCategories as $productsCategory)
                                    <option value="{{$productsCategory->product_category_name}}" selected>{{$productsCategory->product_category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Marca</label>
                            <select id="productBrand" name="productBrand" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="height:50px;">
                                
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Imagens</label>
                            <input class="form-control" type="file" id="productImage" name="file[]" ref="file" multiple="multiple">
                        </div>
                        <label for="formFileMultiple" class="form-label">Preço</label>
                        <div class="mb-3" style="display:flex;flex-direction:row;">
                            <input type="text" class="form-control" name="productPrice" id="productPrice" aria-describedby="emailHelp" placeholder="Escreva aqui" style="width:150px;height:50px;">
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top:15px;">Criar Produto</button>
                    </form>
                </div>
            </div>
            <script>
                document.getElementById('collapseOne').classList.remove("in");
                document.getElementById('collapseOne').classList.add("show");
                
                var formDataCategory = new FormData();
                formDataCategory.append('newProductCategory', document.getElementById('productCategory').value);
                axios.post('/product/brands-retrieve/', formDataCategory,{
                    
                })
                .then((response) => {
                    var size = response.data[0].length;
                    for(var i=0; i<=size-1; i++){
                        //Change the brand select option to the ones related to the category selected
                        var productBrand = document.getElementById('productBrand');
                        var option = document.createElement("option");
                        option.innerHTML = response.data[0][i]['product_brand_name'];
                        option.value = response.data[0][i]['product_brand_name'];
                        productBrand.appendChild(option);
                    }
                })
                change();
                function change(){
                    var formDataCategory = new FormData();
                    formDataCategory.append('newProductCategory', document.getElementById('productCategory').value);
                    axios.post('/product/brands-retrieve/', formDataCategory,{
                        
                    })
                    .then((response) => {
                        var size = response.data[0].length;
                        var productBrand = document.getElementById('productBrand');
                        productBrand.innerHTML = '';
                        for(var i=0; i<=size-1; i++){
                            var option = document.createElement("option");
                            option.innerHTML = response.data[0][i]['product_brand_name'];
                            option.value = response.data[0][i]['product_brand_name'];
                            productBrand.appendChild(option);
                        }
                    })  
                }

                var addProduct = new Vue({
                    el:'#addProduct',
                    methods:{
                        onSubmit:function(event){
                            var formData = new FormData();
                            formData.append('productName', document.getElementById('productName').value);
                            formData.append('productDescription', document.getElementById('productDescription').value);
                            formData.append('productCategory', document.getElementById('productCategory').value);
                            formData.append('productBrand', document.getElementById('productBrand').value);
                            for(var i=0; i<document.querySelector('#productImage').files.length; i++){
                                formData.append('file[' + i + ']', document.querySelector('#productImage').files[i]);
                            }
                            formData.append('productPrice', document.getElementById('productPrice').value);
                            axios.post('/product/insert/', formData,{
                                
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