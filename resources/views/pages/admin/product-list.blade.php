@extends('layouts.adminLayout')
@section('content')
@include('includes.header')
    <section class="dashboard-ctn">
        <div class="dashboard">
            @include('includes.dashboard-menu')
            <div class="product-list-ctn">
                <h2>Lista de Produtos</h2>
                <div class="product-list">
                    <div class="product-list-header">
                        <form id="productListSearchForm" class="product-list-search" v-on:submit.prevent="onSubmit">
                            <input id="productListSearch" class="form-control" type="text" placeholder="Procurar..." aria-label="default input example">
                            <button type="submit" class="btn btn-primary" style="margin-left:5px;">Pesquisar</button>
                        </form>
                        <div class="product-list-options-ctn">
                            <select id="productCategory">
                                <option class="productCategoryOption" value="allCategories">Todas as Categorias</option>
                                @foreach($productsCategories as $productsCategory)
                                    @if($productsCategory->product_category_name == $chosenCategory[0])
                                        <option class="productCategoryOption" value="{{$productsCategory->product_category_name}}" selected>{{$productsCategory->product_category_name}}</option>    
                                    @else
                                        <option class="productCategoryOption" value="{{$productsCategory->product_category_name}}">{{$productsCategory->product_category_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <select id="productBrand">
                                <option class="productBrandOption" value="allBrands" selected>Todas as Marcas</option>
                                @foreach($productsBrands as $productsBrand)
                                    @if($productsBrand->product_brand_name == $chosenBrand[0])
                                        <option class="productBrandOption" value="{{$productsBrand->product_brand_name}}" selected>{{$productsBrand->product_brand_name}}</option>
                                    @else
                                        <option class="productBrandOption" value="{{$productsBrand->product_brand_name}}">{{$productsBrand->product_brand_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="product-list-body">
                        @foreach ($products as $product)
                            <div class="product-list-element">
                                <div class="product-list-element-image">
                                    <img src="{{asset($product->product_image_url)}}">
                                </div>
                                <div class="product-list-element-options">
                                    <span>{{$product->product_name}}</span>
                                    <span>R${{$product->product_price}}.00</span>
                                    <div class="product-list-element-input">
                                        <a href="{{asset('/dashboard/product-edit/'. $product->product_name)}}">
                                            <i class="fas fa-pencil-alt"></i>Editar
                                        </a>
                                        <button>
                                            <i class="fas fa-trash-alt"></i>Deletar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination-ctn">
                        <div class="pagination">
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
            </div>
            <script>
                //This is for the dashboard menu
                document.getElementById('collapseOne').classList.remove("in");
                document.getElementById('collapseOne').classList.add("show");

                //instantiate a method to work with url params
                const urlParams = new URLSearchParams(window.location.search);

                //Make the search by typing a keyword
                var productListSearchForm = new Vue({
                    el:'#productListSearchForm',
                    methods:{
                        onSubmit:function(event){
                            //Delete the current value for the keyword that is contained in the url
                            urlParams.delete('keyword');

                            //Add the new value and redirect the page to another url
                            var productListSearch = document.getElementById('productListSearch').value;
                            urlParams.append('keyword', productListSearch);
                            window.location.assign("http://localhost:8000/dashboard/product-list?" + urlParams.toString());
                        }
                    }
                });

                //Make the search by choosing a category
                var productCategory = document.getElementById('productCategory');
                productCategory.addEventListener('change', () => {
                    //Just delete the searchByCategory when selecting the 'Todas as Categorias' option
                    if(productCategory.value == 'allCategories'){
                        urlParams.delete('searchByCategory[]');
                        window.location.assign("http://localhost:8000/dashboard/product-list?" + urlParams.toString());
                    }else{
                        //Delete the current value for the productCategory that is contained in the url
                        urlParams.delete('searchByCategory[]');

                        //Add the new value and redirect the page to the another url
                        urlParams.append('searchByCategory[]', productCategory.value);
                        window.location.assign("http://localhost:8000/dashboard/product-list?" + urlParams.toString());
                    }
                });

                //Make the search by choosing the brand
                var productBrand = document.getElementById('productBrand');
                productBrand.addEventListener('change', () => {
                    if(productBrand.value == 'allBrands'){
                        urlParams.delete('searchByBrand[]');
                        window.location.assign("http://localhost:8000/dashboard/product-list?" + urlParams.toString());
                    }else{
                        //Delete the current value for the productBrand that is contained in the url
                        urlParams.delete('searchByBrand[]');

                        //Add the new value and redirect the page to the another url
                        urlParams.append('searchByBrand[]', productBrand.value);
                        console.log(productBrand);
                        window.location.assign("http://localhost:8000/dashboard/product-list?" + urlParams.toString());
                    }
                });
            </script>
        </div>
    </section>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection