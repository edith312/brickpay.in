<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <h4 class="text-center mb-5">Products</h4>
    <div class="row">
        <div class="col-12">
            <div class="text-end">
                <a class="btn btn-secondary" href="<?= base_url('products/add') ?>">Add New</a>
                <a class="btn btn-secondary" id="my_products">My Products</a>
            </div>
        </div>
    </div>
    <div id="products-container">

    </div>
</div>

<script>
    $(document).ready(function () {
        fetchProducts();
    })

    function fetchProducts(page = 0) {
        $.ajax({
            url: "<?= base_url('products/ajax_list') ?>",
            type: "POST",
            data: {
                'page' : page,
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

    function fetchMyProducts(page = 0) {
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

</script>