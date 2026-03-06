<style>
    .press_release_showcase p {
		text-align: justify;
	}

	.press_release_showcase {
		border-bottom: 1px solid #ccc;
		padding-top: 10px;
	}

    .press_release_profile_pic{
		width: 30px;
		height: 30px;
		aspect-ratio: 1;
		object-fit: cover;
		border-radius: 50%;
	}
</style>
<div class="SocialMediaFeedContainer">
    <?php foreach ($press_releases as $release) { ?>

        <div class="press_release_showcase">

            <!-- HEADER -->
            <div class="d-flex align-items-center gap-3 mb-2">

                <img
                    class="press_release_profile_pic"
                    src="<?= !empty($release->user_image)
                        ? base_url('uploads/user_profile/' . $release->user_image)
                        : base_url('assets/images/img/user.png'); ?>"
                    alt="User"
                >

                <div class="flex-grow-1">
                    <?php if (!empty($release->name)) { ?>

                        <div class="fw-semibold">
                            <?= $release->name; ?>
                        </div>

                    <?php } elseif (!empty($release->email)) { ?>

                        <div class="fw-semibold text-muted">
                            <?= $release->email; ?>
                        </div>

                    <?php } else { ?>

                        <div class="fw-semibold text-muted">
                            Anonymous
                        </div>

                    <?php } ?>
                </div>

                <a href="<?= base_url("$release->type/press-release/$release->id") ?>">
                    👁️
                </a>

                <div class="text-muted small">
                    <?= date('d M Y · h:i A', strtotime($release->created_date)); ?>
                </div>

            </div>

            <!-- CONTEXT -->
            <div class="mb-2 text-muted small d-flex flex-column">

                <?php if (in_array($release->type, ['company', 'project']) && !empty($release->company_name)) { ?>
                    <span class="ms-2">
                        Company: <strong><?= $release->company_name; ?></strong>
                    </span>
                <?php } ?>

                <?php if ($release->type === 'project' && !empty($release->project_name)) { ?>
                    <span class="ms-2">
                        Project: <strong><?= $release->project_name; ?></strong>
                    </span>
                <?php } ?>

            </div>

            <!-- CONTENT -->
            <p class="press_release_content">
                <?= nl2br($release->press_release); ?>
            </p>

            <!-- FOOTER -->
            <div class="mt-2 small text-muted">
                ID: <?= $release->uniq_id; ?>
                <span class="badge bg-light text-dark border">
                    <?= ucfirst($release->type); ?>
                </span>
            </div>

        </div>

        <?php } ?>


</div>