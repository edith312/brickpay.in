<div class="timeline-output other-output">
    <i class="fa-solid fa-link me-1"></i>
    <span><?= htmlspecialchars($item['otherlink']) ?></span>

    <?php if (!empty($item['time'])): ?>
        <small class="text-muted ms-2">
            (<?= htmlspecialchars($item['time']) ?>
            <?= htmlspecialchars($item['timeslot'] ?? '') ?>)
        </small>
    <?php endif; ?>

    <span class="edit-item">
        <i class="bi bi-pencil" title="Edit"></i>
    </span>
    <span class="delete-item">
        <i class="bi bi-trash delete-item" title="Delete"></i>
    </span>
</div>