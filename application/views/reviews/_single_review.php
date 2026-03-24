<div class="border p-3 mb-2 review-item" data-user="<?= $review['user_id'] ?>">

    <div class="d-flex align-items-center mb-2">
        
        <!-- Profile Image -->
        <img src="<?= !empty($review['user_image']) 
            ? base_url('uploads/user_profile/'.$review['user_image']) 
            : base_url('assets/default-user.png') ?>" 
            width="40" height="40" class="rounded-circle me-2">

        <!-- Name -->
        <strong><?= $review['user_name'] ?? 'User' ?></strong>
    </div>

    <!-- Rating -->
    <div>
        <?php for($i=1; $i<=5; $i++): ?>
            <i class="bi <?= $i <= $review['rating'] ? 'bi-star-fill text-warning' : 'bi-star' ?>"></i>
        <?php endfor; ?>
    </div>

    <!-- Comment -->
    <p class="mb-0"><?= $review['comment'] ?></p>
</div>