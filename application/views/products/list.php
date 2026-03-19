<div class="row">
    <?php foreach($products as $p) {?>
        <div class="col-4">
            <div class="card">
                <img src="<?= base_url('uploads/product_images/') . $p['image'] ?>" class="card-img-top " alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title"><?= $p['name'] ?></h5>
                    <p class="card-text"><?= $p['description'] ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 mb-0"><?= $p['price'] ?></span>
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
                <div class="card-footer d-flex justify-content-between bg-light">
                    <button class="btn btn-primary btn-sm">Add to Cart</button>
                    <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-heart"></i></button>
                </div>
            </div>
        </div>
    <?php }?>
    <div class="col-12">
        
    </div>
</div>