<template>
    <section class="main-menu-ctn">
        <div class="main-menu">
            <div class="main-menu-top">
                <div class="main-menu-categories">
                    <span>Categorias</span>
                </div>
                <div class="main-menu-options">
                    <div class="main-menu-options-links">
                        <a :href="smartphoneLink">Smartphones</a>
                        <a :href="tvsLink">Tv's</a>
                        <a :href="notebooksLink">Notebooks</a>
                        <a :href="tabletsLink">Tablets</a>
                        <a :href="roteadoresLink">Roteadores</a>
                        <a :href="hdsLink">HD's</a>
                    </div>
                    <div class="main-menu-options-contact">
                        <span>Telefone:</span>
                        <span>(91) 9999-8888</span>
                    </div>
                </div>
            </div>
            <div class="main-menu-wrapper">
                <div class="main-menu-btn">
                    <a :href="smartphoneLink"></a>
                    <i class="fas fa-mobile-alt"></i>
                    <span>Smartphones</span>
                </div>
                <div class="main-menu-btn">
                    <a :href="tvsLink"></a>
                    <i class="fas fa-tv"></i>
                    <span>Tv's</span>
                </div>
                <div class="main-menu-btn">
                    <a :href="notebooksLink"></a>
                    <i class="fas fa-laptop"></i>
                    <span>Notebooks</span>
                </div>
                <div class="main-menu-btn">
                    <a :href="tabletsLink"></a>
                    <i class="fas fa-tablet-alt"></i>
                    <span>Tablets</span>
                </div>
                <div class="main-menu-btn">
                    <a :href="roteadoresLink"></a>
                    <i class="fas fa-wifi"></i>
                    <span>Roteadores</span>
                </div>
                <div class="main-menu-btn">
                    <a :href="hdsLink"></a>
                    <i class="far fa-hdd"></i>
                    <span>HD's</span>
                </div>
                <div class="main-menu-btn">
                    <a :href="processadorLink"></a>
                    <i class="fas fa-microchip"></i>
                    <span>Processadores</span>
                </div>
                <div class="main-menu-btn">
                    <a :href="papelariaLink"></a>
                    <i class="fas fa-paperclip"></i>
                    <span>Papelaria</span>
                </div>
                <div class="main-menu-btn">
                    <a :href="sonorizacaoLink"></a>
                    <i class="fas fa-headphones-alt"></i>
                    <span>Sonorização</span>
                </div>
            </div>
            <div class="main-menu-carousel">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner" style="height:490px;">
                        <!--<div class="carousel-item active main-carousel-item" :key="key" v-if="key == 1">-->
                        <div class="carousel-item active main-carousel-item">
                            <div class="main-carousel-info">
                                <span>{{galeria.carousel_image_bg_text}}</span>
                                <span>{{galeria.carousel_image_sm_text}}</span>
                                <a :href="galeria.carousel_image_btn_url">{{galeria.carousel_image_btn_text}}</a>
                            </div>
                            <div class="main-carousel-shadow"></div>
                            <img :src="galeria.carousel_image_url" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props:['smartphoneLink', 'tvsLink', 'notebooksLink', 'tabletsLink', 'roteadoresLink', 'hdsLink', 'processadorLink', 'papelariaLink', 'sonorizacaoLink', 'galeria'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
