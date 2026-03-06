<div class="timeline-output audio-output">
    <i class="fa-solid fa-music me-1"></i>

    <?php if (!empty($item['audiolink'])): ?>

        <!-- AUDIO LINK -->
        <a href="<?= htmlspecialchars($item['audiolink']) ?>"
        target="_blank"
        rel="noopener">
            <?= htmlspecialchars($item['audiolink']) ?>
        </a>

    <?php elseif (!empty($item['audio'])): ?>

        <!-- AUDIO FILE -->
        <?php
            $audioPath = base_url() . 'uploads/calendar_audio/' . $item['audio'];
            $ext = pathinfo($item['audio'], PATHINFO_EXTENSION);

            $mimeMap = [
                'mp3' => 'audio/mpeg',
                'wav' => 'audio/wav',
                'ogg' => 'audio/ogg',
                'm4a' => 'audio/mp4',
            ];

            $mimeType = $mimeMap[strtolower($ext)] ?? 'audio/mpeg';
        ?>

        <audio controls>
            <source src="<?= $audioPath ?>" type="<?= $mimeType ?>">
            Your browser does not support the audio element.
        </audio>

    <?php else: ?>

        <span>Audio uploaded</span>

    <?php endif; ?>

    <span class="edit-item ms-2">
        <i class="bi bi-pencil" title="Edit"></i>
    </span>

    <span class="delete-item ms-2">
        <i class="bi bi-trash delete-item" title="Delete"></i>
    </span>
</div>