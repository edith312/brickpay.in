<style>
    .pencil-icon{
        right: 20;
    }
</style>

<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <h4 class="text-center mb-5" id="page-title">Products</h4>
    <div class="row">
        <div class="col-12">
            <div class="text-end">
                <a class="btn btn-secondary" href="<?= base_url('company/product/add') ?>">Add New</a>
                <a class="btn btn-secondary" id="my_products">My Products <span class="badge bg-primary"><?= $my_product_count ?></span></a>
                <a class="btn btn-secondary" id="my_wishlist">My Wishlist <span class="badge bg-primary"><?= $wishlist_count ?></span></a>
                <a class="btn btn-secondary" href="<?= base_url('cart') ?>">My Cart <span class="badge bg-primary"><?= $cart_count ?></span></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <input type="text" name="search" id="search_product" class="form-control" placeholder="Search Products by Name">
        </div>
    </div>
    <div id="products-container">

    </div>
</div>

<script>
    $(document).ready(function () {
        fetchProducts();
        $('#search_product').on('keyup', searchHandler);
    })

    function fetchProducts(page = 0, query = '') {
        $.ajax({
            url: "<?= base_url('products/ajax_list') ?>",
            type: "POST",
            data: {
                'page' : page,
                'query': query
            },
            dataType: 'json',
            success: function (res) {
                if(res.success){
                    $('#products-container').empty();
                    $('#products-container').append(res.html);
                }
            },
            error: function (err) {
                console.error('error: ', err)
            }
        })
    }

    function fetchMyProducts(page = 0, query = '') {
        $.ajax({
            url: "<?= base_url('products/my_ajax_list') ?>",
            type: "POST",
            data: {
                'page' : page,
            },
            dataType: 'json',
            success: function (res) {
                if(res.success){
                    $('#products-container').empty();
                    $('#products-container').append(res.html);
                    $('#page-title').text('My Products')
                }
            },
            error: function (err) {
                console.error('error: ', err)
            }
        })
    }

    $(document).on('click', '#my_products', function() {
        fetchMyProducts(page = 0)
    })

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

    $(document).on('click', '.delete-btn', function (){
        let id = $(this).data('id');

        if (!confirm('Delete this product?')) return;

        $.ajax({
            url: "<?= base_url('products/delete') ?>",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function(res){
                if(res.success){
                    fetchProducts()
                } else {
                    alert('Delete failed');
                }
            }
        });
    });

    $(document).on('click', '.edit-btn', function (){
        let id = $(this).data('id');
        window.location.href = "<?= base_url('products/add/') ?>" + id;
    });

    $(document).on('click', '.add-wishlist', function (){
        let id = $(this).data('id');
        // console.log('this', $(this).data());
        $.ajax({
            url: "<?= base_url('wishlist/add_remove') ?>",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function(res){
                if(res.success){
                    fetchProducts();
                    alert(res.msg);
                } else {
                    alert(res.msg);
                }
            },
            error: function(err) {
                console.log(err)
            }
        });
    });

    $(document).on('click', '#my_wishlist', function () {

        $.ajax({
            url: "<?= base_url('wishlist/get') ?>",
            type: "GET",
            dataType: "json",
            success: function(res){
                if(res.success){
                    $('#products-container').empty();
                    $('#products-container').append(res.html);
                    $('#page-title').text('My Wishlist')
                } else {
                    
                }
            },
            error: function(err) {
                console.log(err)
            }
        });

    })

    $(document).on('click', '.page-item', function () {
        if($(this).hasClass('disabled')) exit();
        let page = $(this).data('id');
        console.log($(this).data())
        fetchProducts(page)
    })

    function debounce(func, delay) {
        let timer;
        return function () {
            let context = this;
            let args = arguments;

            clearTimeout(timer);
            timer = setTimeout(() => {
                func.apply(context, args);
            }, delay);
        };
    }

    const searchHandler = debounce(function () {
        let query = $('#search_product').val().trim();
        fetchProducts(0, query);
    }, 500); // 500ms delay
</script>