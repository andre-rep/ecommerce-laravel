<div class="dashboard-menu">
    <div class="dashboard-menu-logo">
        <img src="{{asset('storage/image/dash-brand.svg')}}">
    </div>
    <div class="dashboard-menu-item">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="background-color:transparent;box-shadow:none;">
                        <i class="fas fa-shopping-bag" style="margin-right:15px;color:#0c63e4;"></i>
                        <span style="color:#000;">Produtos</span>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse in" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <a href="/dashboard/product-list">
                            Lista de Produtos
                        </a>
                    </div>
                    <div class="accordion-body">
                        <a href="/dashboard/product-categories">
                            Categorias e Marcas
                        </a>
                    </div>
                    <div class="accordion-body">
                        <a href="/dashboard/product-add">
                            Adicionar Produtos
                        </a>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne" style="background-color:transparent;box-shadow:none;">
                        <i class="fas fa-shopping-cart" style="margin-right:15px;color:#0c63e4;"></i>
                        <span style="color:#000;">Vendas</span>
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse in" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <a href="/dashboard/product-orders">
                            Ordens de Compra
                        </a>
                    </div>
                    <div class="accordion-body">
                        <a href="/dashboard/product-reviews">
                            Reviews dos Clientes
                        </a>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseOne" style="background-color:transparent;box-shadow:none;">
                        <i class="fas fa-user" style="margin-right:15px;color:#0c63e4;"></i>
                        <span style="color:#000;">Clientes</span>
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse in" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <a href="/dashboard/clients">
                            Lista de Clientes
                        </a>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseOne" style="background-color:transparent;box-shadow:none;">
                        <i class="fas fa-file" style="margin-right:15px;color:#0c63e4;"></i>
                        <span style="color:#000;">Páginas</span>
                    </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse in" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <a href="/dashboard/main-page">
                            Página Principal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>