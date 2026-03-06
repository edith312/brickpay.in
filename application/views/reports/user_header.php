<?php
// Expecting: $user (array with name, phone, email, dob, address, city, zipcode, user_image)
?>

<div class="user_table" style="margin-left: 2cm; margin-right: 2cm;">
    <table width="100%" cellpadding="6" cellspacing="0" border="0" style="margin-top: 10px;">
        <tr>
            <td width="85%" style="border:0;">
                <table width="100%" cellpadding="4" cellspacing="0" border="0">
                    <tr>
                        <td width="25%"><strong>Name</strong></td>
                        <td width="75%"><?= htmlspecialchars($user['name'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <td><strong>Phone</strong></td>
                        <td><?= htmlspecialchars($user['phone'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td><?= htmlspecialchars($user['email'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <td><strong>Date of Birth</strong></td>
                        <td><?= htmlspecialchars($user['dob'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td>
                            <?= htmlspecialchars($user['address'] ?? '-') ?>,
                            <?= htmlspecialchars($user['city'] ?? '-') ?>
                            <?= !empty($user['zipcode']) ? ' - ' . htmlspecialchars($user['zipcode']) : '' ?>
                        </td>
                    </tr>
                </table>
            </td>

            <td width="15%" style="border:0; padding-top:20px; vertical-align: top; text-align:center;">
                <?php if (!empty($user['user_image'])): ?>
                    <img 
                        src="<?= base_url('uploads/user_profile/' . $user['user_image']) ?>" 
                        width="80" 
                        height="80"
                        style="border-radius: 50%; object-fit: cover; border: 1px solid #ccc;">
                <?php else: ?>
                    <div style="width:80px; height:80px; border-radius:50%; border:1px solid #ccc; line-height:80px; text-align:center; font-size:10px; color:#777;">
                        No Photo
                    </div>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</div>
