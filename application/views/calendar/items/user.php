<?php
    $users = $item['users'] ?? [];
    $dialogue = $item['dialogue'] ?? [];
    $receivers = $item['receivers'] ?? [];
    ?>

    <div class="my_timeline py-4">
        
        <div class="timeline-users-wrapper">
            <div class="timeline-users d-flex align-items-center gap-4">
                <span class="my_timeline_line"></span>

                <?php foreach ($users as $user): ?>

                    <?php
                        $userId    = $user['id'] ?? $user['user_id'] ?? '';
                        $userName  = $user['name'] ?? $user['email'] ?? 'User';
                        $userImage = !empty($user['user_image'])
                            ? base_url('uploads/user_profile/' . $user['user_image'])
                            : base_url('uploads/user_profile/user.png');
                    ?>

                    <div class="timeline-user calendar-user"
                        draggable="true"
                        data-user-id="<?= (int)$userId ?>"
                        >

                        <a href="<?= base_url('company/user_preview?id=') . (int)$userId ?>"
                        class="d-flex flex-column align-items-center text-decoration-none text-dark">

                            <img src="<?= htmlspecialchars($userImage) ?>"
                                class="user-avatar calendar-user-avatar"
                                width="50"
                                height="50" />

                            <span class="calendar-user-name">
                                <?= htmlspecialchars($userName) ?>
                            </span>
                        </a>
                    </div>

                <?php endforeach; ?>
                

                <button class="btn btn-secondary rounded-circle edit-item" style="margin-bottom: 13px;"
                data-user-mode="sender"
                data-item-id="<?= (int)$item['id'] ?>"
                >
                    <i class="fa-solid fa-plus"></i>
                </button>

                <!-- Edit / Delete icons (same as JS) -->
                <div class="d-flex flex-column justify-content-center" style="margin-bottom: 12px;">
                    <span class="edit-item"
                    data-user-mode="sender"
                    data-item-id="<?= (int)$item['id'] ?>"
                    >
                        <i class="bi bi-pencil" title="Edit"></i>
                    </span>

                    <span class="delete-item">
                        <i class="bi bi-trash" title="Delete"></i>
                    </span>
                </div>
            </div>

            <!-- 🔥 Dialogues Section -->
             <div class="">
            <?php if (!empty($dialogue)): ?>
                <div class="timeline-dialogues ms-2 d-flex flex-column gap-1"
                    data-dialogue-id="<?= (int)($dialogue['id'] ?? 0) ?>">

                    <div class="dialogue-bubble p-2 rounded small">
                        <strong>:Dialogue</strong><br>
                        <?= nl2br(htmlspecialchars($dialogue['dialogue'])) ?>
                    </div>

                    <?php if ((int)$dialogue['dialogue_status'] === 1): ?>
                        <!-- ✅ Approved -->
                        <span class="badge bg-success align-self-start">Approved</span>

                    <?php elseif ((int)$dialogue['dialogue_status'] === 2): ?>
                        <!-- ❌ Rejected -->
                        <span class="badge bg-danger align-self-start">Rejected</span>

                    <?php else: ?>
                        <!-- ⏳ Pending -->
                        <div class="d-flex flex-row gap-1">
                            <button class="btn btn-sm btn-success rounded-circle dialogue_submit"
                                    data-id="<?= (int)$dialogue['id'] ?>">
                                <i class="fa-solid fa-check"></i>
                            </button>

                            <button class="btn btn-sm btn-danger rounded-circle dialogue_cancel"
                                    data-id="<?= (int)$dialogue['id'] ?>">
                                <i class="fa-solid fa-x"></i>
                            </button>

                            <span class="badge bg-info align-self-center ms-2">Pending</span>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endif; ?>
            </div>

            <div class="">
            <?php if (!empty($receivers)): ?>
                <div class="timeline-users d-flex align-items-center gap-4">
                    <span class="my_timeline_line"></span>

                    <?php foreach ($receivers as $user): ?>

                        <?php
                            $userId    = $user['id'] ?? $user['user_id'] ?? '';
                            $userName  = $user['name'] ?? $user['email'] ?? 'User';
                            $userImage = !empty($user['user_image'])
                                ? base_url('uploads/user_profile/' . $user['user_image'])
                                : base_url('uploads/user_profile/user.png');
                        ?>

                        <div class="timeline-user calendar-user"
                            draggable="true"
                            data-user-id="<?= (int)$userId ?>"
                            >

                            <a href="<?= base_url('company/user_preview?id=') . (int)$userId ?>"
                            class="d-flex flex-column align-items-center text-decoration-none text-dark">

                                <img src="<?= htmlspecialchars($userImage) ?>"
                                    class="user-avatar calendar-user-avatar"
                                    width="50"
                                    height="50" />

                                <span class="calendar-user-name">
                                    <?= htmlspecialchars($userName) ?>
                                </span>
                            </a>
                        </div>

                    <?php endforeach; ?>
                    

                    <button class="btn btn-secondary rounded-circle edit-item" style="margin-bottom: 13px;"
                    data-user-mode="receiver"
                    data-dialogue-id="<?= (int)$dialogue['id'] ?>"
                    >
                        <i class="fa-solid fa-plus"></i>
                    </button>

                    <!-- Edit / Delete icons (same as JS) -->
                    <div class="d-flex flex-column justify-content-center" style="margin-bottom: 12px;">
                        <span class="edit-item"
                        data-user-mode="receiver"
                        data-dialogue-id="<?= (int)$dialogue['id'] ?>"
                        >
                            <i class="bi bi-pencil" title="Edit"></i>
                        </span>

                        <span class="delete-item">
                            <i class="bi bi-trash" title="Delete"></i>
                        </span>
                    </div>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>