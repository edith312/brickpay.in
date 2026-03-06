<?php
// Expecting: $signature (URL/path), $footer (URL/path)
?>

<!-- Signature -->
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:20px; margin-left: 2cm;">
    <tr>
        <td style="border: 0;">
            <?php if (!empty($signature)): ?>
                <img src="<?= $signature ?>" width="30%" style="max-width: 180px;">
            <?php endif; ?>
        </td>
    </tr>
</table>

<!-- Thanks & Regards -->
<table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 30px; margin-left: 2cm;">
    <tr>
        <td width="40%" style="text-align: left; font-size: 12px; line-height: 1.5; border: 0;">
            <strong>Thanks &amp; Regards,</strong><br>
            <strong>Shubham Shah - Director</strong><br>
            <strong>Edith Robotics Solutions Pvt. Ltd.</strong>
        </td>
        <td width="60%" style="border: 0;"></td>
    </tr>
</table>

<!-- Footer Image -->
<table width="100%" cellpadding="0" cellspacing="0" style="margin-top:20px;">
    <tr>
        <td style="border: 0;">
            <?php if (!empty($footer)): ?>
                <img src="<?= $footer ?>" width="100%">
            <?php endif; ?>
        </td>
    </tr>
</table>
