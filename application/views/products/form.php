<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">

    <h3 class="mb-4">Add / Edit Product</h3>

    <form method="post" enctype="multipart/form-data" action="<?= base_url('products/save') ?>" class="p-2 rounded" style="background: #f0f4f7">

        <div class="row">

            <!-- LEFT SIDE -->
            <div class="col-md-8">

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="5" class="form-control"></textarea>
                </div>

                <!-- Price -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sale Price</label>
                        <input type="number" name="sale_price" class="form-control">
                    </div>
                </div>

                <!-- Stock -->
                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" value="0">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control"></textarea>
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
                            <option value="<?= $cat['id'] ?>">
                                <?= $cat['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <!-- Featured -->
                <div class="mb-3">
                    <label class="form-label">Featured</label>
                    <select name="is_featured" class="form-select">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>

                <!-- Sort Order -->
                <div class="mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="0">
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-100">
                    Save Product
                </button>

            </div>

        </div>

    </form>
</div>

<script>
    $('input[name="name"]').keyup(function(){
        let slug = $(this).val()
            .toLowerCase()
            .replace(/ /g,'-')
            .replace(/[^\w-]+/g,'');

        $('input[name="slug"]').val(slug);
    });
</script>