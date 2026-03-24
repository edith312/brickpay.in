<div class="row">
    <?php foreach($products as $p) {?>
        <div class="col-lg-3 col-md-4 col-6">
            <div class="card position-relative">
                <a href="<?= base_url('company/product/') . $p['slug'] ?>">
                    <img src="<?= base_url('uploads/product_images/') . $p['image'] ?>" class="card-img-top object-fit-cover" alt="Product Image" style="height: 150px !important;">
                    <div class="card-body">
                        <h5 class="card-title text-dark"><?= limit_words($p['name'], 5) ?></h5>
                        <p class="card-text text-secondary"><?= limit_words($p['description'], 20) ?></p>
                        <div class="d-flex justify-content-between align-items-start g-3 align-items-xl-center flex-column flex-xl-row">
                            <span class="mb-0">₹<?= number_format($p['price'], 2) ?></span>
                            <div class="d-flex">
                                <?php for($i=1; $i<=5; $i++): ?>
                                    <i class="bi <?= $i <= round($p['avg_rating']) ? 'bi-star-fill text-warning' : 'bi-star' ?>"></i>
                                <?php endfor; ?>

                                <small class="text-muted ms-1">
                                    (<?= number_format($p['avg_rating'], 1) ?>)
                                </small>
                            </div>
                        </div>
                    </div>
                    </a>
                <div class="card-footer d-flex justify-content-between bg-light">
                    <button class="btn btn-primary btn-sm add-to-cart" data-id="<?= $p['id'] ?>">Add to Cart</button>
                    <button class="btn btn-outline-secondary btn-sm add-wishlist" data-id="<?= $p['id'] ?>"><i class="bi <?= $p['wishlist_status'] ? 'bi-heart-fill text-danger' : 'bi-heart' ?>"></i></button>
                </div>
                <?php if($p['user_id'] == sessionId('freelancer_id')) { ?>
                    <span class="edit-btn position-absolute top-0 pencil-icon text-primary" data-id="<?= $p['id'] ?>">
                        <i class="bi bi-pencil"></i>
                    </span>

                    <span class="delete-btn position-absolute top-0 text-danger end-0" data-id="<?= $p['id'] ?>">
                        <i class="bi bi-trash"></i>
                    </span>
                <?php } ?>
            </div>
        </div>
    <?php }?>
    <div class="col-12">
        
    </div>
</div>