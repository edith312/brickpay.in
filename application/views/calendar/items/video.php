<div class="timeline-output video-output">

    <?php
        // Combine main video + additional videos
        $videos = [];

        // Main video (first one)
        if (!empty($item['id'])) {
            $videos[] = $item;
        }

        // Additional videos (skip duplicate of main)
        if (!empty($item['additional_videos']) && is_array($item['additional_videos'])) {
            foreach ($item['additional_videos'] as $v) {
                if ($v['id'] != $item['id']) {
                    $videos[] = $v;
                }
            }
        }
    ?>

    <?php if (!empty($videos)): ?>
        <?php foreach ($videos as $vid): ?>
            <div class="video-item d-flex align-items-center mb-2 me-2" data-video-id="<?= $vid['id'] ?>">

                <?php if (!empty($vid['videolink'])): ?>
                    <!-- VIDEO LINK -->
                    <i class="fa-solid fa-video me-1"></i>
                    <a href="<?= htmlspecialchars($vid['videolink']) ?>"
                    target="_blank"
                    rel="noopener">
                        <?= htmlspecialchars($vid['videolink']) ?>
                    </a>

                <?php elseif (!empty($vid['video'])): ?>
                    <!-- VIDEO FILE FROM SERVER -->
                    <video controls width="220">
                        <source src="<?= base_url("uploads/calendar_video/" . htmlspecialchars($vid['video'])) ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                <?php else: ?>
                    <span>No video available</span>
                <?php endif; ?>

                <div class="d-flex flex-column gap-2">
                    <span class="edit-item ms-2" data-video-id="<?= $vid['id'] ?>">
                        <i class="bi bi-pencil" title="Edit"></i>
                    </span>

                    <span class="delete-item ms-2" data-video-id="<?= $vid['id'] ?>">
                        <i class="bi bi-trash" title="Delete"></i>
                    </span>
                </div>

            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <span>No video available</span>
    <?php endif; ?>

</div>