<div class="timeline-output docs-output">
    <i class="fa-solid fa-file-lines me-1"></i>

    <?php if (!empty($item['docslink'])): ?>

        <!-- DOCUMENT LINK -->
        <a href="<?= htmlspecialchars($item['docslink']) ?>"
        target="_blank"
        rel="noopener">
            <?= htmlspecialchars($item['docslink']) ?>
        </a>

    <?php elseif (!empty($item['docs'])): ?>

        <!-- DOCUMENT FILE -->
        <?php
            $docPath = base_url('uploads/calendar_docs/') . $item['docs'];
            $docName = basename($item['docs']);
        ?>

        <a href="<?= $docPath ?>" target="_blank" rel="noopener">
            <?= htmlspecialchars($docName) ?>
        </a>

    <?php else: ?>

        <span>Document uploaded</span>

    <?php endif; ?>

    <span class="edit-item ms-2">
        <i class="bi bi-pencil" title="Edit"></i>
    </span>

    <span class="delete-item ms-2">
        <i class="bi bi-trash delete-item" title="Delete"></i>
    </span>
</div>