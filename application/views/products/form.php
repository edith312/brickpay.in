<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">

    <h3 class="mb-4">
        <?= isset($product) ? 'Edit Product' : 'Add Product' ?>
    </h3>

    <form method="post" enctype="multipart/form-data"
        action="<?= base_url('products/save') ?>"
        class="p-3 rounded"
        style="background: #f0f4f7">

        <!-- Hidden ID -->
        <input type="hidden" name="id" value="<?= isset($product) ? $product['id'] : '' ?>">

        <div class="row">

            <!-- LEFT SIDE -->
            <div class="col-md-8">

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control"
                        value="<?= isset($product) ? htmlspecialchars($product['name']) : '' ?>"
                        required>
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control"
                        value="<?= isset($product) ? $product['slug'] : '' ?>">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="5" class="form-control"><?= isset($product) ? htmlspecialchars($product['description']) : '' ?></textarea>
                </div>

                <!-- Price -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" class="form-control"
                            value="<?= isset($product) ? $product['price'] : '' ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sale Price</label>
                        <input type="number" name="sale_price" class="form-control"
                            value="<?= isset($product) ? $product['sale_price'] : '' ?>">
                    </div>
                </div>

                <!-- Stock -->
                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control"
                        value="<?= isset($product) ? $product['stock'] : 0 ?>">
                </div>

                <!-- Meta Title -->
                <div class="mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control"
                        value="<?= isset($product) ? htmlspecialchars($product['meta_title']) : '' ?>">
                </div>

                <!-- Meta Description -->
                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control"><?= isset($product) ? htmlspecialchars($product['meta_description']) : '' ?></textarea>
                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="col-md-4">

                <!-- Category -->
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"
                                <?= (isset($product) && $product['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                                <?= $cat['cat_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label class="form-label">Product Image</label>

                    <input type="file" name="images[]" multiple class="form-control mb-2" id="imageInput">
                    <div id="previewContainer" class="d-flex flex-wrap gap-2"></div>
                    <!-- Old Image Preview -->
                    <!-- <?php if (isset($product) && !empty($product['image'])): ?>
                        <img src="<?= base_url('uploads/product_images/' . $product['image']) ?>"
                             class="img-fluid rounded mb-2"
                             style="max-height: 150px;">
                    <?php endif; ?> -->
                    <?php if (isset($product_images) && !empty($product_images)): ?>
                        <div class="mb-3">
                            <label class="form-label">Product Gallery</label>

                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach ($product_images as $img): ?>
                                    <div style="position:relative;">
                                        <img src="<?= base_url('uploads/product_images/'.$img['image']) ?>"
                                            style="height:80px; width:80px; object-fit:cover;"
                                            class="rounded border">

                                        <!-- OPTIONAL DELETE BUTTON -->
                                        <button type="button"
                                            class="btn btn-danger btn-sm"
                                            style="position:absolute; top:0; right:0; padding:2px 6px;"
                                            onclick="deleteImage(<?= $img['id'] ?>)">
                                            ×
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- New Preview -->
                    <img id="previewImage" class="img-fluid rounded d-none" style="max-height:150px;">
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1"
                            <?= (isset($product) && $product['status'] == 1) ? 'selected' : '' ?>>
                            Active
                        </option>
                        <option value="0"
                            <?= (isset($product) && $product['status'] == 0) ? 'selected' : '' ?>>
                            Inactive
                        </option>
                    </select>
                </div>

                <!-- Featured -->
                <div class="mb-3">
                    <label class="form-label">Featured</label>
                    <select name="is_featured" class="form-select">
                        <option value="0"
                            <?= (isset($product) && $product['is_featured'] == 0) ? 'selected' : '' ?>>
                            No
                        </option>
                        <option value="1"
                            <?= (isset($product) && $product['is_featured'] == 1) ? 'selected' : '' ?>>
                            Yes
                        </option>
                    </select>
                </div>

                <!-- Sort Order -->
                <div class="mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control"
                        value="<?= isset($product) ? $product['sort_order'] : 0 ?>">
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-100">
                    <?= isset($product) ? 'Update Product' : 'Save Product' ?>
                </button>

            </div>

        </div>

    </form>
</div>

<!-- JS -->
<script>
    // 🔥 Slug auto-generate (only if slug empty or new product)
    $('input[name="name"]').keyup(function(){
        let slugInput = $('input[name="slug"]');

        if (slugInput.val() === '' || <?= isset($product) ? 'false' : 'true' ?>) {
            let slug = $(this).val()
                .toLowerCase()
                .trim()
                .replace(/ /g,'-')
                .replace(/[^\w-]+/g,'');

            slugInput.val(slug);
        }
    });

    // 🔥 Image preview

    $('#imageInput').change(function(){
        $('#previewContainer').html(''); // reset

        const files = this.files;

        if (files) {
            [...files].forEach(file => {
                const reader = new FileReader();

                reader.onload = function(e){
                    $('#previewContainer').append(`
                        <img src="${e.target.result}" 
                            class="rounded"
                            style="height:100px; width:100px; object-fit:cover;">
                    `);
                }

                reader.readAsDataURL(file);
            });
        }
    });

    function deleteImage(id) {
        if (!confirm('Delete this image?')) return;

        $.post("<?= base_url('products/delete_image') ?>", {id}, function(res){
            location.reload();
        });
    }
</script>