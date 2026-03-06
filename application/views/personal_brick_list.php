<!-- Shiv Web Developer -->
<?php
if ($privatebricks) {
    $brickCount = 1;
    foreach ($privatebricks as $bricks) {
        $brickFunding = $this->CommonModal->getSingleRowById('tbl_brick_funding', 'brick_id = ' . $bricks['id']);
?>
        <div class="project-row mt-md-3 rounded-0" style="border-left: 4px solid <?= brickColor($bricks['brick_type']) ?>">
            <span class="brickStatus bg-<?= ($bricks['brick_status'] == 'draft' ? 'warning' : 'success') ?> text-white text-capitalize">
                <?= ($bricks['brick_status'] == 'draft' ? 'Draft' : 'Live') ?>
            </span>
            <div class="project-cell" style="width:100px;"><?= $brickCount++ ?></div>
            <div class="project-cell">Brick: <?= $bricks['brick_title'] ?></div>
            <div class="project-cell">Company: <?= companyName($bricks['company_id']) ?></div>
            <div class="project-cell">Project: <?= projectName($bricks['project_id']) ?></div>
            <div class="project-cell">Type: <?= brickType($bricks['brick_type']) ?></div>
            <div class="project-cell text-center" style="padding: 2px;">
                <a href="<?= base_url('company/preview_brick?id=' . $bricks['id']) ?>" title="View Details">
                    <i class="bi bi-eye-fill eye-icon"></i>
                </a>
                <?php if ($bricks['user_id'] == sessionId('freelancer_id')) { ?>
                    <a href="<?= base_url('company/brick-delete?id=' . $bricks['id']) ?>" title="Delete Company" class="text-danger" onclick="return confirm('Are you sure you want to delete this brick?');">
                        <i class="bi bi-trash"></i>
                    </a>
                <?php } ?>
            </div>
        </div>

        <div class="project-grid project-grid-bottom-1 rounded-0 position-relative" style="border-left: 4px solid <?= brickColor($bricks['brick_type']) ?>">
            <?php if ($bricks['user_id'] == sessionId('freelancer_id')) { ?>
                <a href="<?= base_url('company/create-brick?id=' . $bricks['id']) ?>" title="Edit Details" class="brickEditButton">
                    <i class="bi bi-pencil"></i>
                </a>
            <?php } ?>
            <div class="project-cell" style="display: flex; align-items: center; justify-content: center; padding: 0;">
                <span class="project-dot green"></span>
            </div>
            <div class="project-cell">Reward: <?= $bricks['reward_disclosed'] ?></div>
            <div class="project-cell">Fund Required: <?= $brickFunding['fund_required'] ?></div>
            <div class="project-cell">Privacy : <span class="text-capitalize"><?= $bricks['brick_privacy'] ?></span></div>
            <div class="project-cell">Brick Id: <?= generateBrickId($bricks['id']) ?></div>
        </div>
<?php
    }
} else {
    echo '<div class="alert alert-info my-5">No Bricks Found</div>';
}
?>
<!-- Shiv Web Developer -->