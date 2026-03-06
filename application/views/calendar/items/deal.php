<div class="timeline-output text-output">
    <div class="deal-info">
        <div class="deal-item">
            <span class="badge bg-primary me-1">Ask</span>
            <span><?= htmlspecialchars($item['deal_ask']) ?></span>
        </div>

        <div class="deal-item">
            <span class="badge bg-success me-1">Give</span>
            <span><?= htmlspecialchars($item['deal_give']) ?></span>
        </div>
    </div>
    <span class="edit-item">
        <i class="bi bi-pencil" title="Edit"></i>
    </span>
    <span class="delete-item">
        <i class="bi bi-trash delete-item" title="Delete"></i>
    </span>
</div>