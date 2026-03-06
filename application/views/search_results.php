<div id="companyList">
			<?php
				if ($getBricks) {
					$brickCount = 1;
					foreach ($getBricks as $bricks) {
						$brickFunding = $this->CommonModal->getSingleRowById('tbl_brick_funding', 'brick_id = ' . $bricks['id']);
				?>
						<div class="d-flex">
                            <div class="" style="width: 95%">
                            <div class="mt-md-5 rounded-0" style="border-left: 4px solid <?= brickColor($bricks['brick_type']) ?>">
                                <div class="project-row-one">
                                    <span class="brickStatus
                                        <?php
                                        if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] == NULL) {
                                            echo 'bg-markascompleted';
                                        } else if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] != NULL) {
                                            echo 'bg-artificialbrickartificial';
                                        } else if ($bricks['artificialdate'] != NULL) {
                                            echo 'bg-artificialbrick';
                                        } else { ?>
                                            bg-<?= ($bricks['brick_status'] == 'draft' ? 'warning' : 'primary') ?> text-white <?php } ?>  
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
                                        <div class="project-cell"><?= $brickCount++ ?></div>
                                        <div class="project-cell">Brick Title: <?= $bricks['brick_title'] ?></div>
                                        <div class="project-cell text-center px-1">
                                            <a href="<?= base_url('company/preview_brick?id=' . $bricks['id']) ?>" title="View Details">
                                                <i class="bi bi-eye-fill eye-icon"></i>
                                            </a>
                                        </div>
                                </div>
                                <div class="project-row-two border-top-0 border-bottom-0">
                                    <div class="project-cell" style="display: flex; align-items: center; justify-content: center; padding: 0; height: 100%;">
                                        <span class="project-dot green"></span>
                                    </div>
                                    <div class="project-cell">
                                        Project: <?= projectName($bricks['project_id']) ?></div>
                                    <div class="project-cell">Company: <?= companyName($bricks['company_id']) ?></div>
                                    <div class="project-cell">Brick Id: <?= generateBrickId($bricks['id']) ?></div>
                                    <div class="project-cell">Privacy : <span class="text-capitalize"><?= $bricks['brick_privacy'] ?></span></div>
                                    <?php if ($bricks['user_id'] == sessionId('freelancer_id')) {?>
                                            <a href="<?= base_url('company/create-brick?id=' . $bricks['id']) ?>" title="Edit Details" class="text-center">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                    <?php } else { ?>
                                            <div class="project-cell h-100"></div>
                                    <?php } ?>
                                </div>
                                <div class="project-row-three border-top-0">
                                    <div class="project-cell h-100"></div>
                                    <div class="project-cell">Step 1 - Fund Required: <span id="total_amount">
                                        <?php
                                            $cur_arr = explode('|',$bricks['currency_symbol']); 
                                            echo $cur_arr[1]; echo ' - '; echo $cur_arr[0];
                                        ?>
                                        <?= $bricksFunding['fund_required'] ?></span>
                                    </div>
                                    <div class="project-cell h-100">Step 2 - Reward: <?= $bricks['reward_disclosed'] ?></div>
                                    <div class="project-cell h-100">Step 3 - Completion Report:</div>
                                    <div class="project-cell h-100">Step 4 - Voting:</div>
                                    <div class="project-cell h-100 px-1 text-center">
                                        <?php
                                            if ($bricks['user_id'] == sessionId('freelancer_id')) {
                                            ?>
                                                <a href="<?= base_url('company/brick-trash?id=' . $bricks['id']) ?>" title="Delete Company" class="text-danger" onclick="return confirm('Are you sure you want to delete this brick?');">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="project-row-five border-top-0">
                                    <div class="project-cell h-100"></div>
                                    <div class="project-cell h-100">Step 1.1 - Type: <?= $bricksFunding['funding_type'] ?></div>
                                    <div class="project-cell h-100">Step 2.1 - Resources: </div>
                                    <div class="project-cell h-100">Step 3.1 - Updated Valuation:</div>
                                    <div class="project-cell h-100"></div>
                                    <div class="project-cell h-100 px-1 text-center">
                                        <a href="<?= base_url("Home/brick_pdf?brick_id=$bricks[id]")?>" >
                                            <i class="fa-solid fa-arrow-down"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="project-row-six border-top-0">
                                    <div class="project-cell h-100"></div>
                                    <div class="project-cell h-100">Step 1.12 - Network Marketing for Fund : <br> 11111</div>
                                    <div class="project-cell h-100">Step 2.12 - Network Marketing for Resources : <br> 11111</div>
                                    <div class="project-cell h-100">Step 3.12 -  :</div>
                                    <div class="project-cell h-100"></div>
                                    <div class="project-cell h-100"></div>
                                </div>
                                <div class="project-row-four border-top-0">
                                    <div class="project-cell h-100"></div>
                                    <div class="project-cell h-100">Currency: <?php
                                        $cur_arr = explode('|',$bricks['currency_symbol']); 
                                        echo $cur_arr[1]; echo ' - '; echo $cur_arr[0];
                                        ?></div>
                                    <div class="project-cell" style=""><?= brickType($bricks['brick_type']) ?></div>
                                    <div class="project-cell">Date: <span class="text-capitalize"><?= $bricks['create_date'] ?></span></div>
                                    <div class="project-cell"> Artificial Date: <span class="text-capitalize">
                                            <?php
                                            if ($bricks['artificialdate'] != NULL) { ?>
                                                <?= $bricks['artificialdate'] ?>

                                            <?php } else {
                                                echo '...';
                                            } ?>
                                        </span>
                                    </div>
                                    <div class="project-cell h-100"></div>
                                </div>
                            </div>
                            <div class="">
                                <?php
                                if ($bricks['brick_completed'] == 'completed') {
                                ?>
                                    <!-- <h6>Completed:</h6> -->
                                    <div class="progress">
                                        <div style="width: 100%; background-color: #ff6501 !important;" class="progress-bar"></div>
                                    </div>
                                    <small class="text-muted">Brick completed in <strong>100%</strong>. Remaining close the Brick.</small>

                                <?php } else { ?>
                                    <!-- <h6>Completed:</h6> -->
                                    <div class="progress">
                                        <div style="width: 60%;" class="progress-bar"></div>
                                    </div>
                                    <small class="text-muted">Brick completed in <strong>60%</strong>. Remaining close the Brick.</small>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="" style="width: 5%;">
                            <div class="form-group" style="margin-top:70px;">
                                <input type="checkbox" class="" name="mybookbricks[]" value="<?= $bricks['id'] ?>" placeholder="Check" style="height:26px; width:26px;" />
                            </div>
                        </div>
                        </div>
						<!-- <div class="project-grid project-grid-bottom-1 rounded-0 position-relative" style="border-left: 4px solid <?= brickColor($bricks['brick_type']) ?>">
							
							
							<div class="project-cell" style="width:30px;"></div>

						</div> -->
				<?php
					}
				} else {
					echo '<div class="alert alert-info my-5">No Bricks Found</div>';
				}
			?>

		</div>