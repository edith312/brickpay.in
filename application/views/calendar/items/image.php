<div class="timeline-output image-output">

    <?php
        // Combine main image + additional images
        $images = [];

        // Main image (first one)
        if (!empty($item['id'])) {
            $images[] = $item;
        }

        // Additional images (skip duplicate of main)
        if (!empty($item['additional_images']) && is_array($item['additional_images'])) {
            foreach ($item['additional_images'] as $img) {
                if ($img['id'] != $item['id']) {
                    $images[] = $img;
                }
            }
        }
    ?>
    <?php if (!empty($images)): ?>
        <?php foreach ($images as $img): ?>
            <div class="image-item d-flex align-items-center mb-2 me-2" data-image-id="<?= $img['id'] ?>">

                <?php if (!empty($img['imagelink'])): ?>
                    <!-- IMAGE LINK -->
                    <div class="d-flex gap-1 align-items-start">
                        <a href="<?= htmlspecialchars($img['imagelink']) ?>">
                            <img 
                                src="<?= htmlspecialchars($img['imagelink']) ?>"
                                width="75"
                                height="75"
                                class="rounded border"
                                alt="Image"
                            >
                        </a>
                        <a href="" class="">
                            <i class="fa-solid fa-arrow-down"></i>
                        </a>
                    </div>

                <?php elseif (!empty($img['image'])): ?>
                    <!-- IMAGE FILE FROM SERVER -->
                    <div class="d-flex gap-1 align-items-center">
                        <a href="<?= base_url('uploads/calendar_image/' . htmlspecialchars($img['image'])) ?>">
                            <img 
                                src="<?= base_url('uploads/calendar_image/' . htmlspecialchars($img['image'])) ?>"
                                width="100"
                                height="100"
                                class="rounded border"
                                alt="Image"
                            >
                        </a>
                        <a href="<?= base_url('uploads/calendar_image/' . htmlspecialchars($img['image'])) ?>" 
                        download="<?= htmlspecialchars($img['image']) ?>">
                            <i class="fa-solid fa-arrow-down"></i>
                        </a>
                    </div>

                <?php else: ?>
                    <span>No image available</span>
                <?php endif; ?>
                <div class="d-flex flex-column gap-2">
                    <span class="edit-item ms-2" data-image-id="<?= $img['id'] ?>">
                        <i class="bi bi-pencil" title="Edit"></i>
                    </span>

                    <span class="delete-item ms-2" data-image-id="<?= $img['id'] ?>">
                        <i class="bi bi-trash" title="Delete"></i>
                    </span>
                </div>
                
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <span>No image available</span>
    <?php endif; ?>

</div>