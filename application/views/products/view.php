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
        <div class="col-12">
            <div class="text-end">
                <a class="btn btn-secondary" href="<?= base_url('company/product/add') ?>">Add New</a>
                <a class="btn btn-secondary" id="my_products">My Products <span class="badge bg-primary"><?= $my_product_count ?></span></a>
                <a class="btn btn-secondary" id="my_wishlist">My Wishlist <span class="badge bg-primary" id="wishlist-count"><?= $wishlist_count ?></span></a>
                <a class="btn btn-secondary" href="<?= base_url('cart') ?>">My Cart <span class="badge bg-primary"><?= $cart_count ?></span></a>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Product Images -->
        <!-- <div class="col-md-6 mb-4">
            <img src="<?= base_url('uploads/product_images/') . $product['image'] ?>" alt="Product" class="img-fluid rounded mb-3 product-image" id="mainImage">
            <div class="d-flex justify-content-between">
                <img src="<?= base_url('uploads/product_images/') . $product['image'] ?>" alt="Thumbnail 1" class="thumbnail rounded active" onclick="changeImage(event, this.src)">
            </div>
        </div> -->
        <div class="col-md-6 mb-4">

            <!-- MAIN IMAGE -->
            <?php 
                $mainImage = !empty($product_images) 
                    ? $product_images[0]['image'] 
                    : $product['image']; 
            ?>

            <img src="<?= base_url('uploads/product_images/' . $mainImage) ?>"
                class="img-fluid rounded mb-3 product-image"
                id="mainImage">

            <!-- THUMBNAILS -->
            <div class="d-flex flex-wrap gap-2">

                <!-- MAIN IMAGE AS FIRST -->
                <img src="<?= base_url('uploads/product_images/' . $product['image']) ?>"
                    class="thumbnail rounded active"
                    onclick="changeImage(event, this.src)">

                <!-- MULTIPLE IMAGES -->
                <?php if (!empty($product_images)): ?>
                    <?php foreach ($product_images as $img): ?>
                        <img src="<?= base_url('uploads/product_images/' . $img['image']) ?>"
                            class="thumbnail rounded"
                            onclick="changeImage(event, this.src)">
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h6 class="mb-3"><?= $cat_details['cat_name'] ?></h6>
            <h2 class="mb-3"><?= $product['name'] ?></h2>
            <!-- <p class="text-muted mb-4">SKU: WH1000XM4</p> -->
            <div class="mb-3">
                <span class="h4 me-2">₹<?= number_format($product['sale_price'], 2) ?></span>
                <span class="text-muted"><s>₹<?= number_format($product['price'], 2) ?></s></span>
            </div>
            <div class="mb-3">
                <?php for($i=1; $i<=5; $i++): ?>
                    <i class="bi <?= $i <= $avg_rating ? 'bi-star-fill text-warning' : 'bi-star' ?>"></i>
                <?php endfor; ?>
                <span class="ms-2">
                    <?= $avg_rating ?> (<?= $review_count ?> review<?= $review_count > 1 ? 's' : '' ?>)
                </span>
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
            <button class="btn btn-primary btn-lg mb-3 me-2 add-to-cart" data-id="<?= $product['id'] ?>">
                <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            <button class="btn btn-outline-secondary btn-lg mb-3 add-wishlist <?= $wishlist_status ? 'active' : '' ?>" 
                    data-id="<?= $product['id'] ?>">

                <i class="bi <?= $wishlist_status ? 'bi-heart-fill text-danger' : 'bi-heart' ?>"></i> 
                Add to Wishlist
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
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <h5>Rate this product:</h5>
                <div id="starRating">
                    <i class="bi bi-star" data-value="1"></i>
                    <i class="bi bi-star" data-value="2"></i>
                    <i class="bi bi-star" data-value="3"></i>
                    <i class="bi bi-star" data-value="4"></i>
                    <i class="bi bi-star" data-value="5"></i>
                </div>
            </div>
            <textarea class="form-control mb-3" id="reviewComment" placeholder="Write your review"></textarea>

            <button class="btn btn-success submit-review" data-id="<?= $product['id'] ?>">
                Submit Review
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h4>Customer Reviews</h4>
            
            <div id="reviewList">
                <?php foreach($reviews as $r): ?>
                    <?= $this->load->view('reviews/_single_review', ['review' => $r], true); ?>
                <?php endforeach; ?>
            </div>
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

    // $(document).on('click', '.add-wishlist', function (){
    //     let id = $(this).data('id');
    //     // console.log('this', $(this).data());
    //     $.ajax({
    //         url: "<?= base_url('wishlist/add_remove') ?>",
    //         type: "POST",
    //         data: { id: id },
    //         dataType: "json",
    //         success: function(res){
    //             if(res.success){
    //                if(res.msg.includes('added')){
    //                     icon.removeClass('bi-heart').addClass('bi-heart-fill text-danger');
    //                     btn.addClass('active');
    //                 } else {
    //                     icon.removeClass('bi-heart-fill text-danger').addClass('bi-heart');
    //                     btn.removeClass('active');
    //                 }
    //                 alert(res.msg);
    //             } else {
    //                 alert(res.msg);
    //             }
    //         },
    //         error: function(err) {
    //             console.log(err)
    //         }
    //     });
    // });

    $(document).on('click', '.add-wishlist', function (){
        let btn = $(this);
        let icon = btn.find('i');
        let id = btn.data('id');

        $.ajax({
            url: "<?= base_url('wishlist/add_remove') ?>",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function(res){

                if(res.success){

                    if(res.msg.includes('added')){
                        icon.removeClass('bi-heart')
                            .addClass('bi-heart-fill text-danger');
                        btn.addClass('active');

                        // increase count
                        let count = parseInt($('#wishlist-count').text());
                        $('#wishlist-count').text(count + 1);

                    } else {
                        icon.removeClass('bi-heart-fill text-danger')
                            .addClass('bi-heart');
                        btn.removeClass('active');

                        // decrease count
                        let count = parseInt($('#wishlist-count').text());
                        $('#wishlist-count').text(count - 1);
                    }
                        
                    alert(res.msg);
                }
            }
        });
    });

    let selectedRating = 0;

    $('#starRating i').on('click', function(){
        selectedRating = $(this).data('value');

        $('#starRating i').removeClass('bi-star-fill text-warning')
                        .addClass('bi-star');

        for(let i = 0; i < selectedRating; i++){
            $('#starRating i').eq(i)
                .removeClass('bi-star')
                .addClass('bi-star-fill text-warning');
        }
    });

    $(document).on('click', '.submit-review', function(){

        let product_id = $(this).data('id');
        let comment = $('#reviewComment').val();

        $.ajax({
            url: "<?= base_url('review/add_review') ?>",
            type: "POST",
            data: {
                product_id: product_id,
                rating: selectedRating,
                comment: comment
            },
            dataType: "json",
            success: function(res){

                if(res.success){

                    // 🔥 Add new review at top
                    $('#reviewList').prepend(res.html);

                    // Clear input
                    $('#reviewComment').val('');
                    selectedRating = 0;

                    // Reset stars
                    $('#starRating i')
                        .removeClass('bi-star-fill text-warning')
                        .addClass('bi-star');

                    alert(res.msg);
                }
            }
        });
    });
</script>