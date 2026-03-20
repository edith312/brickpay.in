<div class="row">
    <?php foreach($products as $p) {?>
        <div class="col-3">
            <div class="card">
                <a href="<?= base_url('company/product/') . $p['slug'] ?>">
                    <img src="<?= base_url('uploads/product_images/') . $p['image'] ?>" class="card-img-top " alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title text-dark"><?= limit_words($p['name'], 5) ?></h5>
                        <p class="card-text text-secondary"><?= limit_words($p['description'], 30) ?></p>
                        <div class="d-flex justify-content-between align-items-center flex-column flex-xl-row">
                            <span class="h5 mb-0"><p>₹<?= number_format($p['price'], 2) ?></p></span>
                            <div>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                <small class="text-muted">(4.5)</small>
                            </div>
                        </div>
                    </div>
                    </a>
                <div class="card-footer d-flex justify-content-between bg-light">
                    <button class="btn btn-primary btn-sm add-to-cart" data-id="<?= $p['id'] ?>">Add to Cart</button>
                    <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-heart"></i></button>
                </div>
            </div>
        </div>
    <?php }?>
    <div class="col-12">
        
    </div>
</div>