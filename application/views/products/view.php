<style>
    .product-image {
        max-height: 400px;
        object-fit: cover;
    }
    .thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        cursor: pointer;
        opacity: 0.6;
        transition: opacity 0.3s ease;
    }
    .thumbnail:hover, .thumbnail.active {
        opacity: 1;
    }
</style>
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="row">
        <!-- Product Images -->
        <div class="col-md-6 mb-4">
            <img src="<?= base_url('uploads/product_images/') . $product['image'] ?>" alt="Product" class="img-fluid rounded mb-3 product-image" id="mainImage">
            <div class="d-flex justify-content-between">
                <img src="<?= base_url('uploads/product_images/') . $product['image'] ?>" alt="Thumbnail 1" class="thumbnail rounded active" onclick="changeImage(event, this.src)">
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2 class="mb-3"><?= $product['name'] ?></h2>
            <!-- <p class="text-muted mb-4">SKU: WH1000XM4</p> -->
            <div class="mb-3">
                <span class="h4 me-2">₹<?= number_format($product['sale_price'], 2) ?></span>
                <span class="text-muted"><s>₹<?= number_format($product['price'], 2) ?></s></span>
            </div>
            <div class="mb-3">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-half text-warning"></i>
                <span class="ms-2">4.5 (120 reviews)</span>
            </div>
            <p class="mb-4"><?= $product['description'] ?></p>
            <!-- <div class="mb-4">
                <h5>Color:</h5>
                <div class="btn-group" role="group" aria-label="Color selection">
                    <input type="radio" class="btn-check" name="color" id="black" autocomplete="off" checked>
                    <label class="btn btn-outline-dark" for="black">Black</label>
                    <input type="radio" class="btn-check" name="color" id="silver" autocomplete="off">
                    <label class="btn btn-outline-secondary" for="silver">Silver</label>
                    <input type="radio" class="btn-check" name="color" id="blue" autocomplete="off">
                    <label class="btn btn-outline-primary" for="blue">Blue</label>
                </div>
            </div> -->
            <div class="mb-4">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" class="form-control" id="quantity" value="1" min="1" style="width: 80px;">
            </div>
            <button class="btn btn-primary btn-lg mb-3 me-2 add-to-cart" data-id="<?= $product['id'] ?>>
                    <i class="bi bi-cart-plus"></i> Add to Cart
                </button>
            <button class="btn btn-outline-secondary btn-lg mb-3">
                    <i class="bi bi-heart"></i> Add to Wishlist
                </button>
            <!-- <div class="mt-4">
                <h5>Key Features:</h5>
                <ul>
                    <li>Industry-leading noise cancellation</li>
                    <li>30-hour battery life</li>
                    <li>Touch sensor controls</li>
                    <li>Speak-to-chat technology</li>
                </ul>
            </div> -->
        </div>
    </div>
</div>


<script>
    function changeImage(event, src) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
        event.target.classList.add('active');
    }

    $(document).on('click', '.add-to-cart', function(){
        let product_id = $(this).data('id');

        $.ajax({
            url: "<?= base_url('cart/add') ?>",
            type: "POST",
            data: { product_id: product_id },
            dataType: "json",
            success: function(res){
                if(res.success){
                    alert('Added to cart');
                    $('#cart-count').text(res.count);
                }
            }
        });
    });
</script>