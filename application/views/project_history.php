<style>
    .project-row {
        display: grid;
        grid-template-columns: 30px 1fr 1fr 1fr 1fr 50px;
        align-items: center;
        border: 1px solid #dce3e8;
        border-radius: 4px;
        color: #00a7cc;
        font-weight: 600;
        border-bottom: 0;
    }

    .project-cell {
        padding: 3px 10px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .project-cell.index {
        border-right: 1px solid #ccc;
        text-align: center;
    }

    .eye-icon {
        font-size: 18px;
        color: #00a7cc;
    }

    .project-grid-bottom-1 {
        grid-template-columns: 30px repeat(4, 1fr);
    }
</style>

<style>
    .project-row-one {
		position: relative;
		display: grid;
		grid-template-columns: auto 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		/* border-radius: 4px; */
		color: #00a7cc;
		font-weight: 600;
		border-bottom: 0;
	}

	.project-row-two {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		/* border-radius: 4px; */
		color: #00a7cc;
		font-weight: 600;
		border-bottom: 0;
	}

	.project-row-three {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		/* border-radius: 4px; */
		color: #00a7cc;
		font-weight: 600;
		border-bottom: 0;
	}

	.project-row-four {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		color: #00a7cc;
		font-weight: 600;
	}

	.project-row-five {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		color: #00a7cc;
		font-weight: 600;
	}
	.project-row-six {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		color: #00a7cc;
		font-weight: 600;
	}

	.project-cell {
		padding: 3px 10px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	.project-cell.index {
		border-right: 1px solid #ccc;
		text-align: center;
	}

	.eye-icon {
		font-size: 16px;
		color: #00a7cc;
    }

    #companyList{
        display: none;
    }
</style>
<!-- Shiv Web Developer -->
<?php include('includes/header.php') ?>
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="card border-0">
        <div class="card-body p-md-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Project Details</h4>
                <div class="d-flex align-items-center">
                    <a href="#" class="btn btn-warning me-2">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="#" class="btn btn-success me-2">
                        <i class="bi bi-person-plus me-1"></i> Follow
                    </a>
                    <a href="#" class="btn btn-primary me-2">
                        <i class="bi bi-download me-1"></i> Download Now
                    </a>

                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <span class="label-project-preview">Project Name:</span>
                    <span class="value"><?= $getProject['project_name']?></span>
                </div>
                <div class="col-md-4">
                    <span class="label-project-preview">Project Leader:</span>
                    <span class="value"><?= $getProject['project_leader']?></span>
                </div>
                <div class="col-md-4">
                    <span class="label-project-preview">Total Expected Team:</span>
                    <span class="value"><?= $getProject['team_range_to']?></span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <span class="label-project-preview">Total Number of Layers:</span>
                    <span class="value"><?= $getProject['layer_range_to'] ?></span>
                </div>
                <div class="col-md-4">
                    <span class="label-project-preview">Project Valuation:</span>
                    <span class="value"><?= $getProject['project_valuation'] ?></span>
                </div>
                <div class="col-md-4">
                    <span class="label-project-preview">Issued Shares:</span>
                    <span class="value"><?= $getProject['issued_shares'] ?></span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <span class="label-project-preview">Face Value:</span>
                    <span class="value"><?= $getProject['face_value']?></span>
                </div>
                <div class="col-md-4">
                    <span class="label-project-preview">Project Document / Policies:</span>
                    <span class="value"><a href="#">Download PDF</a></span>
                </div>
                <div class="col-md-4">
                    <span class="label-project-preview">Upload Your Pitch Deck:</span>
                    <span class="value"><a href="#">RealEstate_PitchDeck.pdf</a></span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <span class="label-project-preview">TAM:</span>
                    <span class="value"><?= $getProject['tam'] ?></span>
                </div>
                <div class="col-md-4">
                    <span class="label-project-preview">SAM:</span>
                    <span class="value"><?= $getProject['sam'] ?></span>
                </div>
                <div class="col-md-4">
                    <span class="label-project-preview">SOM:</span>
                    <span class="value"><?= $getProject['som'] ?></span>
                </div>
            </div>

            <div class="mb-3">
                <strong>Elevator Pitch:</strong>
                <div><?= $getProject['project_pitch']?></div>
            </div>

            <div class="mb-3">
                <strong>Mission:</strong>
                <div><?= $getProject['mission']?></div>
            </div>

            <div class="mb-3">
                <strong>Vision:</strong>
                <div><?= $getProject['vision']?></div>
            </div>


            <div class="row g-0">
                <p>
                    This project is under <?= $getCompany['company_name'] ?> company founded in 
                    <?= date('Y', strtotime($getCompany['founded_year'])) ?>. 
                    <?= $getCompany['company_name'] ?> has 
                    <?= $this->CommonModal->countRowsByCondition('projects', ['company_id' => $getCompany['id']]) ?> numbers of projects Active on your Portal.
                </p>
                <p>
                    This Project is started on <?= $getProject['project_start_date'] ?> year with 
                    <?= $getProject['project_valuation'] ?> project valuation currently project is at 
                    <?= $getProject['project_valuation'] ?> valuation with total 
                    <?= $this->CommonModal->countRowsByCondition('bricks', ['project_id' => $getProject['id']]) ?> 
                    Bricks. Would you like to see brick be out.
                </p>

                <div class="col-md-6 box">
                    <div class="p-2 border rounded text-center fw-bold">Silver Brick</div>
                    <div class="p-2 border rounded text-center fw-bold">Golden Brick</div>
                    <div class="p-2 border rounded text-center fw-bold">Platinum Brick</div>
                    <div class="p-2 border rounded text-center fw-bold">Diamond Brick</div>
                    <div class="p-2 border rounded text-center fw-bold">Bronze Brick</div>
                    <div class="p-2 border rounded text-center fw-bold">Silver Plus Brick</div>
                    <div class="p-2 border rounded text-center fw-bold">Golden Plus Brick</div>
                    <div class="p-2 border rounded text-center fw-bold">Platinum Plus Brick</div>
                </div>

                <div class="col-md-6 box">
                    <div class="p-2 border rounded text-center text-muted">5,000</div>
                    <div class="p-2 border rounded text-center text-muted">10,000</div>
                    <div class="p-2 border rounded text-center text-muted">20,000</div>
                    <div class="p-2 border rounded text-center text-muted">50,000</div>
                    <div class="p-2 border rounded text-center text-muted">3,000</div>
                    <div class="p-2 border rounded text-center text-muted">7,500</div>
                    <div class="p-2 border rounded text-center text-muted">15,000</div>
                    <div class="p-2 border rounded text-center text-muted">30,000</div>
                </div>

                <div class="col-md-12 d-flex justify-content-center align-items-center flex-wrap gap-0 mt-md-3 mb-md-3">
                    <button id="viewCompaniesBtn" type="button" class="btn btn-primary">View All Bricks</button>
                    <input type="text" class="form-control form-control-sm w-auto" placeholder="Search...">
                    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fa fa-filter me-1"></i> Filter Box
                    </button>
                </div>

                <div id="companyList">
                    <?php
                    if ($getBricks) {
                        $brickCount = 1;
                        foreach ($getBricks as $bricks) {
                            $brickFunding = $this->CommonModal->getSingleRowById('tbl_brick_funding', 'brick_id = ' . $bricks['id']);
                    ?>
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
                                <div class="project-row-three">
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
                                <div class="project-row-five">
                                    <div class="project-cell h-100"></div>
                                    <div class="project-cell h-100">Step 1.1 - Type: <?= $bricksFunding['funding_type'] ?></div>
                                    <div class="project-cell h-100">Step 2.1 - Resources: </div>
                                    <div class="project-cell h-100">Step 3.1 - Updated Valuation:</div>
                                    <div class="project-cell h-100"></div>
                                    <div class="project-cell h-100 px-1 text-center">
                                        <a href="">
                                            <i class="fa-solid fa-arrow-down"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="project-row-six">
                                    <div class="project-cell h-100"></div>
                                    <div class="project-cell h-100">Step 1.12 - Network Marketing for Fund : <br> 11111</div>
                                    <div class="project-cell h-100">Step 2.12 - Network Marketing for Resources : <br> 11111</div>
                                    <div class="project-cell h-100">Step 3.12 -  :</div>
                                    <div class="project-cell h-100"></div>
                                    <div class="project-cell h-100"></div>
                                </div>
                                <div class="project-row-four">
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

            </div>

        </div>
    </div>
</div>
<!-- Shiv Web Developer -->
<?php include('includes/footer-link.php') ?>
<script>
    document.getElementById("viewCompaniesBtn").addEventListener("click", function() {
        document.getElementById("companyList").style.display = "block";
    });
</script>