<?php if (!empty($users)): ?>
    <?php foreach ($users as $user): ?>
        <div class="col-md-12 p-2">
            <div class="team-member-card chat-user"
                 data-user-id="<?= $user['id'] ?>">

                <img src="<?= !empty($user['user_image'])
                                ? base_url('uploads/user_profile/' . $user['user_image'])
                                : base_url('assets/user-icon.png') ?>"
                    alt="Profile">

                <div class="team-member-info">
                    <h6><?= $user['name'] ?: 'No Name' ?></h6>
                    <div><strong>Email:</strong> <?= $user['email'] ?: 'N/A' ?></div>
                    <div><strong>Phone:</strong> <?= $user['phone'] ?: 'N/A' ?></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center text-muted">No chat users found</p>
<?php endif; ?>
