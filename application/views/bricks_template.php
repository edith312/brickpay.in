                                <div id="companyList">
                                    <?php
                                    if ($getBricks) {
                                        $brickCount = 1;
                                        foreach ($getBricks as $bricks) {
                                            $brickFunding = $this->CommonModal->getSingleRowById('tbl_brick_funding', 'brick_id = ' . $bricks['id']);
                                    ?>
                                            <div style="display: flex;">
                                                <div style="width:95%">


                                                    <div class="project-row mt-md-3 rounded-0" style="border-left: 4px solid <?= brickColor($bricks['brick_type']) ?>">
                                                        <span class="brickStatus 
						        <?php
                                            if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] == NULL) {
                                                echo 'bg-markascompleted';
                                            } else if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] != NULL) {
                                                echo 'bg-artificialbrickartificial';
                                            } else if ($bricks['artificialdate'] != NULL) {
                                                echo 'bg-artificialbrick';
                                            } else { ?>
                                            bg-<?= ($bricks['brick_status'] == 'draft' ? 'warning' : 'success') ?> text-white <?php } ?>  
                                            text-white  text-capitalize">
                                                            <?php
                                                            if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] == NULL) {
                                                                echo 'Completed';
                                                            } else if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] != NULL) {
                                                                echo 'Artificial Brick - Completed';
                                                            } else if ($bricks['artificialdate'] != NULL) {
                                                                echo 'Artificial Brick'; ?>
                                                                <?= ($bricks['brick_status'] == 'draft' ? 'Draft' : ' - Live'); ?>
                                                            <?php } else { ?>
                                                            <?= ($bricks['brick_status'] == 'draft' ? 'Draft' : 'Live');
                                                            } ?>
                                                        </span>
                                                        <div class="project-cell" style="width:100px;"><?= $brickCount++ ?></div>
                                                        <div class="project-cell">Brick: <?= $bricks['brick_title'] ?></div>
                                                        <div class="project-cell">Company: <?= companyName($bricks['company_id']) ?></div>
                                                        <div class="project-cell">
                                                            Project: <?= projectName($bricks['project_id']) ?></div>
                                                        <div class="project-cell">
                                                            Type: <?= brickType($bricks['brick_type']) ?></div>
                                                        <div class="project-cell text-center" style="padding: 2px;">
                                                            <a href="<?= base_url('company/preview_brick?id=' . $bricks['id']) ?>" target="_blank" title="View Details">
                                                                <i class="bi bi-eye-fill eye-icon"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="project-grid project-grid-bottom-1 rounded-0 position-relative" style="border-left: 4px solid <?= brickColor($bricks['brick_type']) ?>">
                                                        <div class="project-cell" style="display: flex; align-items: center; justify-content: center; padding: 0;">
                                                            <span class="project-dot green"></span>
                                                        </div>
                                                        <div class="project-cell">Reward: <?= $bricks['reward_disclosed'] ?></div>
                                                        <div class="project-cell">Fund Required: <?= $brickFunding['fund_required'] ?></div>
                                                        <div class="project-cell">Privacy : <span class="text-capitalize"><?= $bricks['brick_privacy'] ?></span></div>
                                                        <div class="project-cell">Brick Id: <?= generateBrickId($bricks['id']) ?></div>
                                                        <div class="project-cell" style="width:30px;"></div>
                                                        <div class="project-cell"> Date: <span class="text-capitalize"><?= $bricks['create_date'] ?></span></div>
                                                        <div class="project-cell" style="width:300px;"> Artificial Date: <span class="text-capitalize">
                                                                <?php
                                                                if ($bricks['artificialdate'] != NULL) { ?>
                                                                    <?= $bricks['artificialdate'] ?>
                                                                <?php } else {
                                                                    echo '...';
                                                                } ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width:5%">
                                                    <span class="edit-item">
                                                        <i class="bi bi-pencil" title="Edit"></i>
                                                    </span>
                                                    <span class="delete-item">
                                                        <i class="bi bi-trash delete-item" title="Delete"></i>
                                                    </span>
                                                </div>
                                            </div>

                                    <?php
                                        }
                                    } else {
                                        echo '<div class="alert alert-info my-5">No Bricks Found</div>';
                                    }
                                    ?>
                                </div>