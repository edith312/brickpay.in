<ul class="department-list">
    <?php foreach ($departments as $d): ?>
        <li class="department-item">
            <div class="d-flex justify-content-between">
                <strong><?= htmlspecialchars($d['department_name']) ?></strong>
                <div class="add-team-member" data-dept-id="<?= $d['id'] ?>">
                    <div class="d-flex gap-2 align-items-center">
                        <input 
                            type="text" 
                            class="form-control form-control-sm member-search-input" 
                            placeholder="Search user by name/email"
                        >
                        <input type="hidden" class="selected-member-id">

                        <button class="btn btn-sm btn-primary add-member-btn">
                            +
                        </button>
                    </div>

                    <div class="member-suggestions list-group mt-1" style="display:none;"></div>
                </div>
            </div>
            <?php if (!empty($d['team'])): ?>
                <ul class="team-list">
                    <?php foreach ($d['team'] as $t): ?>
                        <li class="team-member">
                            <div class="d-flex align-items-center gap-2">
                                <?php if (!empty($t['freelancer']['user_image'])): ?>
                                    <img 
                                        src="<?= htmlspecialchars($t['freelancer']['avatar']) ?>" 
                                        alt="<?= htmlspecialchars($t['freelancer']['name']) ?>" 
                                        width="28" height="28" 
                                        style="border-radius:50%; object-fit:cover;"
                                    >
                                <?php endif; ?>

                                <span class="fw-semibold">
                                    <?= htmlspecialchars($t['freelancer']['name'] ?? 'Unknown User') ?>
                                </span>

                                <?php if (!empty($t['status'])): ?>
                                    <small class="text-muted">
                                        (<?= htmlspecialchars($t['status']) ?>)
                                    </small>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <ul>
                    <li class="text-muted">No team members added</li>
                </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>