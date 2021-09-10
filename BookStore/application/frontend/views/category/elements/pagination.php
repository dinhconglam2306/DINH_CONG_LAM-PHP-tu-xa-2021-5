<div class="theme-paggination-block">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-6 col-md-6 col-sm-12">
                <nav aria-label="Page navigation">
                    <nav>
                        <?= $this->pagination->showPaginationFrontEnd(); ?>
                    </nav>
                </nav>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="product-search-count-bottom">
                    <?= $this->pagination->showingItem(); ?>
                </div>
            </div>
        </div>
    </div>
</div>