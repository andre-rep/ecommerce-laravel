@extends('layouts.userLayout')
@section('content')
    @include('includes.header')
        <section class="product-ctn">
            <div class="product">
                <div class="product-wrapper">
                    <input type="hidden" id="currentProductName" value="{{$mainProduct->product_name}}">
                    <div class="product-img-ctn">
                        <div class="product-img" id="product-img">
                            <img src="{{asset($mainProduct->product_image_url)}}" id="product-img-src">
                            <div class="product-resize">
                                <i class="fas fa-expand-alt"></i>
                            </div>
                        </div>
                        @if(sizeof($products) != 0)
                            <input type="hidden" id="product" value="{{$products}}">
                            <div class="product-img-sm-ctn" id="product-img-sm-ctn">
                                <button id="productPrev">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button id="productNext">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                                <div class="product-img-sm-wrapper" id="product-img-sm-wrapper">
                                    <div class="product-img-sm">
                                        <img src="{{asset($mainProduct->product_image_url)}}">
                                    </div>
                                    @for($i=0; $i<=sizeof($products)-1; $i++)
                                        <div class="product-img-sm">
                                            <img src="{{asset($products[$i]->product_image_url)}}">
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="product-desc-wrapper">
                        <span class="product-desc-title">{{$mainProduct->product_name}}</span>
                        <div class="product-desc-rate">
                            <span style="display:none;">{{$productRateAverage = 0}}</span>
                            @foreach($allRates as $allRate)
                                <span style="display:none;">{{$allRate->purchase_product_rate}}</span>
                                <span style="display:none;">{{$productRateAverage = $productRateAverage + $allRate->purchase_product_rate}}</span>
                            @endforeach
                            @if($productRateAverage != 0)
                                <span style="display:none;">{{$productRateAverage = $productRateAverage / $customersReviews}}</span>
                            @endif
                            @for($i=0; $i<5; $i++)
                                @if($i < $productRateAverage)
                                    <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                @else
                                    <i class="fa fa-star" style="color:rgb(203,203,203)"></i>
                                @endif
                            @endfor
                            @if($customersReviews == 1)
                                <span>({{$customersReviews}} Review de Usuários)</span>
                            @else
                                <span>({{$customersReviews}} Reviews de Usuários)</span>
                            @endif
                        </div>
                        <div class="product-desc-price">
                            <span>R${{$mainProduct->product_price}}.00</span>
                        </div>
                        <div class="product-description">
                            {{$mainProduct->product_description}}
                        </div>
                        <div class="product-desc-quantity">
                            <div class="product-desc-number" id="productQuantity">1</div>
                            <div class="product-desc-add" id="productQuantityAdd">+</div>
                            <div class="product-desc-minus" id="productQuantitySubtract">-</div>
                        </div>
                        <div class="product-add-cart-ctn">
                            <form id="addProductToCart" v-on:submit.prevent="onSubmit">
                                <button type="submit" class="product-add-cart">Adicionar ao Carrinho</button>
                            </form>
                            <button class="product-add-btn">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-review">
                    @if($customersReviews != 0)
                        <span class="product-review-title">Reviews para {{$mainProduct->product_name}}</span>
                    @else
                        <span class="product-review-title">Ainda não há nenhum review para esse produto</span>
                    @endif
                    @foreach($purchasesProducts as $purchasesProduct)
                        @if($purchasesProduct->purchase_product_rate_comment_visibility == 1)
                            <div class="product-review-item">
                                <div class="product-review-profile-img">
                                    @if($purchasesProduct->user_profile_image_url == '')
                                        <img src="{{asset('image/default-profile.png')}}">
                                    @else
                                        <img src="{{asset($purchasesProduct->user_profile_image_url)}}">
                                    @endif
                                </div>
                                <div class="product-review-desc-ctn">
                                    <div class="product-review-desc-header">
                                        <div class="product-review-desc-title">
                                            <span>{{$purchasesProduct->name}} - </span>
                                            <span>{{$purchasesProduct->purchases_product_created_at}}</span>
                                        </div>
                                        <div class="product-desc-rate">
                                            @for($i=0; $i<5; $i++)
                                                @if($i < $purchasesProduct->purchase_product_rate)
                                                    <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                                @else
                                                    <i class="fa fa-star" style="color:rgb(203,203,203)"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <span class="product-review-text">
                                        {{$purchasesProduct->purchase_product_comment}}
                                    </span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        <script>
            //Show the alternative images in the gallery if they exist
            if(document.getElementById('product')){
                var position = 0;
                document.getElementById('productPrev').addEventListener('click', ()=>{
                    if(position != 0){
                        position = position - 250;
                        document.getElementById('product-img-sm-wrapper').style.right = position + 'px';
                    }
                });
                document.getElementById('productNext').addEventListener('click', ()=>{
                    position = position + 250;
                    document.getElementById('product-img-sm-wrapper').style.right = position + 'px';
                });
                var image = document.getElementsByClassName('product-img-sm');
                for(var i=0; i<image.length; i++){
                    image[i].onclick = function(target){
                        //Choose what happens to the other elements
                        /*[].forEach.call(image, function(imag){
                            product.innerHTML = 'yay';
                        });*/
                        //Choose what happens to the clicked element
                        document.getElementById('product-img-src').remove();
                        var original = this.childNodes[0].nextElementSibling;
                        var cloned = original.cloneNode(true);
                        var productImg = document.getElementById('product-img').appendChild(cloned);
                        productImg.setAttribute('id', 'product-img-src');
                        
                        //Add the clicked image also to the modal
                        document.getElementById('modal-product-img-src').remove();
                        var modalOriginal = this.childNodes[0].nextElementSibling;
                        var modalCloned = modalOriginal.cloneNode(true);
                        var modalProductImg = document.getElementById('modal-product-img').appendChild(modalCloned);
                        modalProductImg.setAttribute('id', 'modal-product-img-src');
                        console.log(modalCloned);
                        //this.innerHTML = 'yay';
                    }
                }
            }

            //Show the alternative images in the modal gallery if they exist
            if(document.getElementById('modalProduct')){
                var modalPosition = 0;
                document.getElementById('modalProductPrev').addEventListener('click', ()=>{
                    if(modalPosition != 0){
                        modalPosition = modalPosition - 250;
                        document.getElementById('modal-product-img-sm-wrapper').style.right = modalPosition + 'px';
                    }
                });

                document.getElementById('modalProductNext').addEventListener('click', () => {
                    modalPosition = modalPosition + 250;
                    document.getElementById('modal-product-img-sm-wrapper').style.right = modalPosition + 'px';
                });

                var modalImage = document.getElementsByClassName('modal-product-img-sm');
                for(var i=0; i<modalImage.length; i++){
                    modalImage[i].onclick = function(target){
                        document.getElementById('modal-product-img-src').remove();
                        var modalOriginal = this.childNodes[0].nextElementSibling;
                        var modalCloned = modalOriginal.cloneNode(true);
                        var modalProductImg = document.getElementById('modal-product-img').appendChild(modalCloned);
                        modalProductImg.setAttribute('id', 'modal-product-img-src');
                    }
                }
            }

            //Change the quantity of products selected to buy
            document.getElementById('productQuantityAdd').addEventListener('click', () => {
                document.getElementById('productQuantity').innerHTML = parseInt(document.getElementById('productQuantity').textContent) + 1;
            });
            document.getElementById('productQuantitySubtract').addEventListener('click', () => {
                if(document.getElementById('productQuantity').textContent > 1){
                    document.getElementById('productQuantity').innerHTML = parseInt(document.getElementById('productQuantity').textContent) - 1;
                }
            });

            //Add product to cart
            var addProductToCart = new Vue({
                el:'#addProductToCart',
                methods:{
                    onSubmit:function(event){
                        var formData = new FormData();
                        formData.append('productName', document.getElementById('currentProductName').value);
                        formData.append('productQuantity', parseInt(document.getElementById('productQuantity').textContent));
                        axios.post('/cart/add/', formData,{
                            headers:{
                                
                            }
                        })
                        .then((response) => {
                            document.location.reload(true);
                        })
                    }
                }
            });

            //Closing the modal when clicking on exit button
            document.getElementsByClassName('product-modal-exit')[0].addEventListener('click', () => {
                document.getElementsByClassName('product-modal-wrapper')[0].setAttribute('style', 'display:none;');
            });

            //Open the modal when clicking on resizing button
            document.getElementsByClassName('product-resize')[0].addEventListener('click', () => {
                document.getElementsByClassName('product-modal-wrapper')[0].setAttribute('style', 'display:flex;');
            });
        </script>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection