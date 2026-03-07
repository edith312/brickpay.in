<div class="timeline-output audio-output">

    <?php
        // Combine main audio + additional audios
        $audios = [];

        // Main audio
        if (!empty($item['id'])) {
            $audios[] = $item;
        }

        // Additional audios (skip duplicate of main)
        if (!empty($item['additional_audios']) && is_array($item['additional_audios'])) {
            foreach ($item['additional_audios'] as $a) {
                if ($a['id'] != $item['id']) {
                    $audios[] = $a;
                }
            }
        }
    ?>

    <?php if (!empty($audios)): ?>
        <?php foreach ($audios as $aud): ?>
            <div class="audio-item d-flex align-items-center mb-2 me-2" data-audio-id="<?= $aud['id'] ?>">

                <?php if (!empty($aud['audiolink'])): ?>

                    <!-- AUDIO LINK -->
                    <i class="fa-solid fa-music me-1"></i>
                    <a href="<?= htmlspecialchars($aud['audiolink']) ?>"
                       target="_blank"
                       rel="noopener">
                        <?= htmlspecialchars($aud['audiolink']) ?>
                    </a>

                <?php elseif (!empty($aud['audio'])): ?>

                    <!-- AUDIO FILE -->
                    <?php
                        $audioPath = base_url() . 'uploads/calendar_audio/' . htmlspecialchars($aud['audio']);
                        $ext = pathinfo($aud['audio'], PATHINFO_EXTENSION);

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

                    <span>No audio available</span>

                <?php endif; ?>

                <div class="d-flex flex-column gap-2">
                    <span class="edit-item ms-2" data-audio-id="<?= $aud['id'] ?>">
                        <i class="bi bi-pencil" title="Edit"></i>
                    </span>

                    <span class="delete-item ms-2" data-audio-id="<?= $aud['id'] ?>">
                        <i class="bi bi-trash" title="Delete"></i>
                    </span>
                </div>

            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <span>No audio available</span>
    <?php endif; ?>

</div>