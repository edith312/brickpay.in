<ul class="department-list">
    <?php foreach ($departments as $d): ?>
        <li class="department-item" data-dept-id="<?= $d['id'] ?>">
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <strong class="department_name"><?= htmlspecialchars($d['department_name']) ?></strong>
                    <i class="bi bi-pencil edit_department" title="edit department" role="button"></i>
                    <i class="bi bi-trash delete_department" title="delete department" role="button"></i>
                </div>
                <div class="add-team-member">
                    <div class="d-flex gap-2 align-items-center">
                        <input 
                            type="text" 
                            class="form-control form-control-sm member-search-input" 
                            placeholder="add user by name/email"
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
                        <li class="team-member" data-id="<?= $t['id'] ?>">
                            <div class="d-flex align-items-center gap-2 member-container">
                                <?php if (!empty($t['freelancer']['avatar'])): ?>
                                    <img 
                                        src="<?= htmlspecialchars(base_url('uploads/user_profile/') . $t['freelancer']['avatar']) ?>" 
                                        alt="<?= htmlspecialchars($t['freelancer']['name']) ?>" 
                                        width="28" height="28" 
                                        style="border-radius:50%; object-fit:cover;"
                                    >
                                <?php endif; ?>

                                <span class="fw-semibold" >
                                    <?= htmlspecialchars($t['freelancer']['name'] ?? 'Unknown User') ?>
                                </span>

                                <?php if (!empty($t['status'])): ?>
                                    <small class="text-muted">
                                        (<?= htmlspecialchars($t['status']) ?>)
                                    </small>
                                <?php endif; ?>
                                <i class="bi bi-pencil edit_member" title="edit member" role="button"></i>
                                <i class="bi bi-trash delete_member" title="delete member" role="button"></i>
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