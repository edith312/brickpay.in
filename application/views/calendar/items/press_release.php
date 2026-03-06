<div class="SocialMediaFeedContainer">
    <?php foreach ($item['press_releases'] as $release) { ?>

        <div class="press_release_showcase">

            <!-- HEADER -->
            <div class="d-flex align-items-center gap-3 mb-2">

                <img
                    class="press_release_profile_pic"
                    src="<?= !empty($release['user']['user_image'])
                        ? base_url('uploads/user_profile/' . $release['user']['user_image'])
                        : base_url('assets/images/img/user.png'); ?>"
                    alt="User"
                >

                <div class="flex-grow-1">
                    <?php if (!empty($release['user']['name'])) { ?>

                        <div class="fw-semibold">
                            <?= $release['user']['name']; ?>
                        </div>

                    <?php } elseif (!empty($release['user']['email'])) { ?>

                        <div class="fw-semibold text-muted">
                            <?= $release['user']['email']; ?>
                        </div>

                    <?php } else { ?>

                        <div class="fw-semibold text-muted">
                            Anonymous
                        </div>

                    <?php } ?>
                </div>

                <a href="<?= base_url("$release[type]/press-release/$release[id]") ?>">
                    👁️
                </a>

                <div class="text-muted small">
                    <?= date('d M Y · h:i A', strtotime($release['created_date'])); ?>
                </div>

            </div>

            <!-- CONTEXT -->
            <div class="mb-2 text-muted small d-flex flex-column">

                <?php if (in_array($release['type'], ['company', 'project']) && !empty($release['company']['company_name'])) { ?>
                    <span class="ms-2">
                        Company: <strong><?= $release['company']['company_name']; ?></strong>
                    </span>
                <?php } ?>

                <?php if ($release['type'] === 'project' && !empty($release['project']['project_name'])) { ?>
                    <span class="ms-2">
                        Project: <strong><?= $release['project']['project_name']; ?></strong>
                    </span>
                <?php } ?>

            </div>

            <!-- CONTENT -->
            <p class="press_release_content">
                <?= nl2br($release['press_release']); ?>
            </p>

            <!-- FOOTER -->
            <div class="mt-2 small text-muted">
                ID: <?= $release['uniq_id']; ?>
                <span class="badge bg-light text-dark border">
                    <?= ucfirst($release['type']); ?>
                </span>
            </div>

        </div>

    <?php } ?>
</div> 