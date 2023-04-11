<template>
    <div>
        <section class="main-banner-ctn">
            <div class="main-banner">
                <img :src="bannerImageUrl" style="position:absolute;width:100%;height:100%;">
                <div class="main-banner-info">
                    <span v-if="bannerIsPromotion == 1">Oferta Especial!</span>
                    <span v-else style="display:none;"></span>
                    <span>{{bannerBgText}}</span>
                    <span>{{bannerSmText}}</span>
                </div>
            </div>
        </section>
        <section class="main-categories-ctn">
            <div class="main-categories">
                <div class="main-categories-header">
                    <span>Categorias</span>
                </div>
                <div class="main-categories-body">
                    <div class="main-category">
                        <a :href="tvLink"></a>
                        <i class="fas fa-tv"></i>
                        <span>Tv's</span>
                    </div>
                    <div class="main-category">
                        <a :href="smartphoneLink"></a>
                        <i class="fas fa-mobile-alt"></i>
                        <span>Smartphones</span>
                    </div>
                    <div class="main-category">
                        <a :href="notebookLink"></a>
                        <i class="fas fa-laptop"></i>
                        <span>Notebooks</span>
                    </div>
                    <div class="main-category">
                        <a :href="tabletLink"></a>
                        <i class="fas fa-tablet-alt"></i>
                        <span>Tablets</span>
                    </div>
                    <div class="main-category">
                        <a :href="roteadorLink"></a>
                        <i class="fas fa-wifi"></i>
                        <span>Roteadores</span>
                    </div>
                    <div class="main-category">
                        <a :href="hdLink"></a>
                        <i class="far fa-hdd"></i>
                        <span>HD's</span>
                    </div>
                    <div class="main-category">
                        <a :href="processadorLink"></a>
                        <i class="fas fa-microchip"></i>
                        <span>Processadores</span>
                    </div>
                    <div class="main-category">
                        <a :href="papelariaLink"></a>
                        <i class="fas fa-paperclip"></i>
                        <span>Papelaria</span>
                    </div>
                    <div class="main-category">
                        <a :href="sonorizacaoLink"></a>
                        <i class="fas fa-headphones-alt"></i>
                        <span>Sonorização</span>
                    </div>
                    <div class="main-category">
                        <a :href="tecladoLink"></a>
                        <i class="far fa-keyboard"></i>
                        <span>Teclados</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        props: ['bannerImageUrl', 'bannerIsPromotion', 'bannerBgText', 'bannerSmText', 'tvLink', 'notebookLink', 'tabletLink', 'roteadorLink', 'hdLink', 'processadorLink', 'papelariaLink', 'sonorizacaoLink', 'tecladoLink']
    }
</script>
