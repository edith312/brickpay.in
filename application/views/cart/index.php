<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">

    <h3 class="mb-4">Shopping Cart (<?= $cart_count ?>)</h3>

    <?php if (!empty($cart)): ?>

        <?php foreach($cart as $item): ?>
            <div class="card mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <!-- Product -->
                    <div class="d-flex align-items-center">
                        <img src="<?= base_url('uploads/product_images/'.$item['image']) ?>" width="80" class="me-3">
                        <div>
                            <h5><?= $item['name'] ?></h5>
                            <p class="mb-0 text-muted">
                                ₹<?= number_format($item['price'], 2) ?>
                            </p>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div>
                        <input type="number" 
                               value="<?= $item['quantity'] ?>" 
                               min="1"
                               class="form-control update-qty"
                               data-id="<?= $item['id'] ?>"
                               style="width: 80px;">
                    </div>

                    <!-- Subtotal -->
                    <div>
                        <strong>
                            ₹<?= number_format($item['price'] * $item['quantity'], 2) ?>
                        </strong>
                    </div>

                    <!-- Remove -->
                    <button class="btn btn-danger remove-item" data-id="<?= $item['id'] ?>">
                        Remove
                    </button>

                </div>
            </div>
        <?php endforeach; ?>

        <!-- Total -->
        <div class="text-end mt-4">
            <h4>Total: ₹<?= number_format($total, 2) ?></h4>
            <button class="btn btn-success">Checkout</button>
        </div>

    <?php else: ?>

        <p>Your cart is empty.</p>

    <?php endif; ?>

</div>

<script>
    // Update quantity
    $(document).on('change', '.update-qty', function(){
        $.post("<?= base_url('cart/update') ?>", {
            id: $(this).data('id'),
            qty: $(this).val()
        }, function(){
            location.reload();
        });
    });

    // Remove item
    $(document).on('click', '.remove-item', function(){
        $.post("<?= base_url('cart/remove') ?>", {
            id: $(this).data('id')
        }, function(){
            location.reload();
        });
    });
</script>