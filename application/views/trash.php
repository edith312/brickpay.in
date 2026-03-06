<?php include('includes/header.php') ?>

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
    .project-row {
        display: grid;
        /* grid-template-columns: 30px 1fr 1fr 1fr 50px; */
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
</style>
<style>
    .bg-artificialbrick {
        background-color: silver;
        color: black !important;
    }

    .bg-artificialbrickartificial {
        background-color: #ebe306ff;
        /* font-weight: 700; */
        color: black !important;
    }

    .bg-markascompleted {
        background-color: #ff6501;
    }
</style>


<!-- Shiv Web Developer  -->

<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <?php
    if ($this->session->has_userdata('projectMsg')) {
        echo $this->session->userdata('projectMsg');
        $this->session->unset_userdata('projectMsg');
    }
    ?>
    <div class="card border-0">
        <div class="card-body p-md-4">
            <div class="container max-width-1470  d-flex gap-3 mt-md-3 align-items-start">
                <div class="w-100">
                    <h2> Trash </h2>
                    <hr />
                    <div> Trashed Bricks Automatic Delete After: <strong>30 Days</strong> </div>
                    <hr />
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div id="companyList">
                            <?php
                            if ($getBricks) {
                                $brickCount = 1;
                                foreach ($getBricks as $bricks) {
                                    $brickFunding = $this->CommonModal->getSingleRowById('tbl_brick_funding', 'brick_id = ' . $bricks['id']);
                            ?>
                                    <div style=" margin-top:30px;" class="mb-0"> <strong> Trashed Dated: </strong> <?= $bricks['trash_date']; ?> </div>
                                    <div class="project-row rounded-0" style="border-left: 4px solid <?= brickColor($bricks['brick_type']) ?>">
                                        <span class="brickStatus 
						<?php
                                    if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] == NULL) {
                                        echo 'bg-markascompleted';
                                    } else if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] != NULL) {
                                        echo 'bg-artificialbrickartificial';
                                    } else if ($bricks['artificialdate'] != NULL) {
                                        echo 'bg-artificialbrick';
                                    } else { ?>
							bg-<?= ($bricks['brick_status'] == 'trash' ? 'danger' : 'success') ?> text-white <?php } ?>  
							text-white  text-capitalize">
                                            <?php
                                            if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] == NULL) {
                                                echo 'Completed';
                                            } else if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] != NULL) {
                                                echo 'Artificial Brick - Completed';
                                            } else if ($bricks['artificialdate'] != NULL) {
                                                echo 'Artificial Brick'; ?>
                                                <?= ($bricks['brick_status'] == 'trash' ? 'Trash' : ' - Live'); ?>
                                            <?php } else { ?>
                                            <?= ($bricks['brick_status'] == 'trash' ? 'Trashed' : 'Deleted');
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

                                            <?php
                                            if ($bricks['trash_date']) {
                                                // Calculate days passed since trash_date
                                                $trashDate = strtotime($bricks['trash_date']);
                                                $currentDate = time();
                                                $daysPassed = ($currentDate - $trashDate) / (60 * 60 * 24); // days difference

                                                // Check if logged-in user owns the brick
                                                if ($bricks['user_id'] == sessionId('freelancer_id')) {
                                                    // If 30 days have passed since trash_date → show Restore button
                                                    if ($daysPassed >= 30) {
                                            ?>
                                                        <?php
                                                        redirect(base_url('company/brick-delete?id=') . $bricks['id']);
                                                        ?>
                                                    <?php } else { ?>
                                                        <a href="<?= base_url('company/brick-delete?id=' . $bricks['id']) ?>" title="Delete Company" class="text-danger" onclick="return confirm('Are you sure you want to delete this brick?');">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                            <?php };
                                                };
                                            }; ?>
                                        </div>
                                    </div>

                                    <div class="project-grid project-grid-bottom-1 rounded-0 position-relative" style="border-left: 4px solid <?= brickColor($bricks['brick_type']) ?>">
                                        <div class="project-cell">
                                            <?php
                                            if ($bricks['user_id'] == sessionId('freelancer_id')) {
                                            ?>
                                                <a href="<?= base_url('company/brick-restore?id=' . $bricks['id']) ?>" title="Restore Deleted Bricks" class="brickEditButton mx-2" onclick="return confirm('Are you sure you want to Restore this brick?');">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 6V3L8 7l4 4V8c2.76 0 5 2.24 5 5 0 1.65-.8 3.1-2.03 4.03l1.42 1.42A6.97 6.97 0 0 0 19 13c0-3.87-3.13-7-7-7zM6.03 8.97A6.97 6.97 0 0 0 5 13c0 3.87 3.13 7 7 7v3l4-4-4-4v3c-2.76 0-5-2.24-5-5 0-1.65.8-3.1 2.03-4.03L6.03 8.97z" />
                                                    </svg>

                                                </a>
                                            <?php } ?>
                                        </div>

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
                            <?php
                                }
                            } else {
                                // echo '<div class="alert alert-info my-5">No Bricks Found</div>';
                            }
                            ?>
                        </div>
                    </div>


                    <!-- THIS FUNCTONALITY FOR PROJECT TRASH SYSTEM SYSTEM -->
                    <div id="companyList" style="display: block;">
                        <?php if ($getProjects):
                            echo '<h5>Projects </h5>';
                            $i = 1;
                            foreach ($getProjects as $project):
                                $getCompany = $this->CommonModal->getSingleRowById('tbl_companies', ['id' => $project['company_id']]);
                        ?>
                                <div class="project-row">
                                    <div class="project-cell index" style="width:100px; text-align: left !important; padding:5px;"><?= $i++; ?></div>
                                    <div class="project-cell"><?= $project['project_name'] ?></div>
                                    <div class="project-cell">Project Leader: <?= $project['project_leader'] ?></div>
                                    <div class="project-cell">Company: <?= $getCompany['company_name'] ?></div>
                                    <div class="project-cell" style="padding: 2px; width:60px;">
                                        <?php
                                        if ($project['user_id'] == sessionId('freelancer_id')) {
                                        ?>
                                            <a href="<?= base_url('company/project-restore?id=' . $project['id']) ?>" title="Restore Deleted Project" class="brickEditButton" onclick="return confirm('Are you sure you want to Restore this Project?');">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 6V3L8 7l4 4V8c2.76 0 5 2.24 5 5 0 1.65-.8 3.1-2.03 4.03l1.42 1.42A6.97 6.97 0 0 0 19 13c0-3.87-3.13-7-7-7zM6.03 8.97A6.97 6.97 0 0 0 5 13c0 3.87 3.13 7 7 7v3l4-4-4-4v3c-2.76 0-5-2.24-5-5 0-1.65.8-3.1 2.03-4.03L6.03 8.97z" />
                                                </svg>
                                            </a>
                                        <?php } ?>

                                        <a href="<?= base_url('company/project-profile-preview?id=' . $project['id']) ?>" title="View Details" class="p-1">
                                            <i class="bi bi-eye-fill eye-icon"></i>
                                        </a>
                                        <?php
                                        if ($project['trash_date']) {
                                            // Calculate days passed since trash_date
                                            $trashDateProject = strtotime($project['trash_date']);
                                            $currentDate = time();
                                            $daysPassed = ($currentDate - $trashDateProject) / (60 * 60 * 24); // days difference

                                            // Check if logged-in user owns the brick
                                            if ($project['user_id'] == sessionId('freelancer_id')) {
                                                // If 30 days have passed since trash_date → show Restore button
                                                if ($daysPassed >= 30) {
                                        ?>
                                                    <?php
                                                    redirect(base_url('company/project-delete?id=') . $project['id']);
                                                    ?>
                                                <?php } else { ?>
                                                    <!-- <a href="<? //= base_url('company/project-delete?id=' . $project['id']) 
                                                                    ?>" title="Delete Project" class="text-danger" onclick="return confirm('Are you sure you want to delete this Project?');">
                                                        <i class="bi bi-trash"></i>
                                                    </a> -->
                                        <?php };
                                            };
                                        }; ?>


                                    </div>
                                </div>

                                <div class="project-grid project-grid-bottom mb-4">
                                    <div class="project-cell" style="display: flex; align-items: center; justify-content: center; padding: 0;">
                                        <span class="project-dot green"></span>
                                    </div>

                                    <div class="project-cell">TAM: <?= $project['tam'] ?></div>
                                    <div class="project-cell">SAM: <?= $project['sam'] ?></div>
                                    <div class="project-cell">SOM: <?= $project['som'] ?></div>
                                    <div class="project-cell">Project Valuation: <?= $project['project_valuation'] ?></div>
                                    <div class="project-cell">Created: <?= convertDatedmy($project['created_at']) ?></div>
                                </div>
                        <?php endforeach;
                        endif; ?>

                    </div>

                    <!-- THIS FUNCTONALITY FOR PROJECT TRASH SYSTEM  END -->



                    <!-- COMPANY TRASH FUNCTIONALITY START -->

                    <div id="companyList" style="display: block;">
                        <?php if ($getCompanies):
                            $i = 1;
                            foreach ($getCompanies as $company):
                                // echo 'Company Deleted Date';
                        ?>
                                <div style=" margin-top:30px; margin-bottom: 0px;" class="mb-0"> <strong> Trashed Dated: </strong> <?= $company['trash_date']; ?> </div>
                                <div class="project-row">
                                    <div class="project-cell index"><?= $i++; ?></div>
                                    <div class="project-cell"><?= $company['company_name'] ?? 'No Name' ?></div>
                                    <div class="project-cell">Total Bricks: 0</div>
                                    <div class="project-cell">Country: <?= $company['location'] ?></div>
                                    <div class="project-cell text-center" style="padding: 2px;">
                                        <a href="<?= base_url('company/company-preview?id=' . $company['id']) ?>" title="View Details">
                                            <i class="bi bi-eye-fill eye-icon"></i>
                                        </a>
                                        <!-- <a href="<?= base_url('company/company-delete?id=' . $company['id']) ?>" title="Delete Company" class="text-danger" onclick="return confirm('Are you sure you want to delete this company?');">
                                            <i class="bi bi-trash"></i>
                                        </a> -->
                                        <?php
                                        if ($company['user_id'] == sessionId('freelancer_id')) {
                                        ?>
                                            <a href="<?= base_url('company/company-restore?id=' . $company['id']) ?>" title="Restore Deleted Company" class="brickEditButton mx-5" onclick="return confirm('Are you sure you want to Restore this Company?');">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 6V3L8 7l4 4V8c2.76 0 5 2.24 5 5 0 1.65-.8 3.1-2.03 4.03l1.42 1.42A6.97 6.97 0 0 0 19 13c0-3.87-3.13-7-7-7zM6.03 8.97A6.97 6.97 0 0 0 5 13c0 3.87 3.13 7 7 7v3l4-4-4-4v3c-2.76 0-5-2.24-5-5 0-1.65.8-3.1 2.03-4.03L6.03 8.97z" />
                                                </svg>
                                            </a>
                                        <?php } ?>

                                        <?php if ($company['trash_date']) {
                                            // Calculate days passed since trash_date
                                            $trashDateCompany = strtotime($company['trash_date']);
                                            $currentDate = time();
                                            $daysPassed = ($currentDate - $trashDateCompany) / (60 * 60 * 24); // days difference

                                            // Check if logged-in user owns the brick
                                            if ($company['user_id'] == sessionId('freelancer_id')) {
                                                // If 30 days have passed since trash_date → show Restore button
                                                if ($daysPassed >= 30) {
                                        ?>
                                                    <?php
                                                    redirect(base_url('company/company-delete?id=') . $company['id']);
                                                    ?>
                                                <?php } else { ?>
                                        <?php };
                                            };
                                        }; ?>

                                    </div>
                                </div>

                                <div class="project-grid project-grid-bottom mb-4">
                                    <div class="project-cell" style="display: flex; align-items: center; justify-content: center; padding: 0;">
                                        <span class="project-dot green"></span>
                                    </div>

                                    <div class="project-cell">Founded Year: <?= convertDatedmy($company['founded_year']) ?></div>
                                    <div class="project-cell">TAM: <?= $company['tan_number'] ?></div>
                                    <div class="project-cell">Valuation: <?= $company['valuation'] ?></div>
                                    <div class="project-cell">Equity Dilution: (<?= $company['equity_dilution'] ?> %)</div>
                                    <div class="project-cell">Team: 0 Members</div>
                                </div>
                        <?php endforeach;
                        endif; ?>
                    </div>



                    <!-- TRL PHD DOC TRASH  -->
                    <div style="display: block;">
                        <?php if ($gettrlphdpostdoc):
                            $i = 1;
                            foreach ($gettrlphdpostdoc as $trlphdpostdoc):
                                // echo 'trlphdpostdoc Deleted Date';
                        ?>
                                <div style=" margin-top:30px; margin-bottom: 0px;" class="mb-0"> <strong> Trashed Dated: </strong> <?= $trlphdpostdoc['trash_date']; ?> </div>
                                <div class="project-row">
                                    <div class="project-cell index"><?= $i++; ?></div>
                                    <div class="project-cell"> Publisher Name: <?= $trlphdpostdoc['publishername'] ?? 'No Name' ?></div>
                                    <div class="project-cell"> Publisher Rating: <?= $trlphdpostdoc['publisherrating'] ?> </div>
                                    <div class="project-cell"> Cititation: <?= $trlphdpostdoc['cititation'] ?></div>
                                </div>

                                <div class="project-grid project-grid-bottom mb-4">
                                    <div class="project-cell"> </div>
                                    <div class="project-cell"> Biblography: <?= $trlphdpostdoc['biblography'] ?></div>
                                    <div class="project-cell">
                                        <a href="<?= base_url('company/trlphdpostdoc') ?>" title="View Details">
                                            <i class="bi bi-eye-fill eye-icon"></i>
                                        </a>
                                        <a href="<?= base_url('company/trlphdpostdoc-delete?id=' . $trlphdpostdoc['id']) ?>" title="Delete trlphdpostdoc" class="text-danger" onclick="return confirm('Are you sure you want to delete this trlphdpostdoc?');">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                        <a href="<?= base_url('company/trlphdpostdoc-restore?id=' . $trlphdpostdoc['id']) ?>" title="Restore Deleted trlphdpostdoc" class=" " onclick="return confirm('Are you sure you want to Restore this trlphdpostdoc?');">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 6V3L8 7l4 4V8c2.76 0 5 2.24 5 5 0 1.65-.8 3.1-2.03 4.03l1.42 1.42A6.97 6.97 0 0 0 19 13c0-3.87-3.13-7-7-7zM6.03 8.97A6.97 6.97 0 0 0 5 13c0 3.87 3.13 7 7 7v3l4-4-4-4v3c-2.76 0-5-2.24-5-5 0-1.65.8-3.1 2.03-4.03L6.03 8.97z" />
                                            </svg>
                                        </a>

                                        <?php if ($trlphdpostdoc['trash_date']) {
                                            // Calculate days passed since trash_date
                                            $trashDatetrl = strtotime($trlphdpostdoc['trash_date']);
                                            $currentDate = time();
                                            $daysPassed = ($currentDate - $trashDatetrl) / (60 * 60 * 24); // days difference

                                            // Check if logged-in user owns the brick
                                            if ($trlphdpostdoc['user_id'] == sessionId('freelancer_id')) {
                                                // If 30 days have passed since trash_date → show Restore button
                                                if ($daysPassed >= 30) {
                                        ?>
                                                    <?php
                                                    redirect(base_url('company/trlphdpostdoc-delete?id=') . $trlphdpostdoc['id']);
                                                    ?>
                                                <?php } else { ?>
                                        <?php };
                                            };
                                        }; ?>
                                    </div>
                                </div>
                        <?php endforeach;
                        endif; ?>
                    </div>






                    <!-- TRL LEVEL TRASH  -->
                    <div style="display: block;" id="companyList">
                        <?php if ($gettrllevels):
                            $i = 1;
                            foreach ($gettrllevels as $trllevel):
                                $company = $this->CommonModal->getSingleRowById('tbl_companies', ['id' => $trllevel['company_id']]);
                                $project = $this->CommonModal->getSingleRowById('tbl_projects', ['id' => $trllevel['project_id']]);

                        ?>
                                <div style=" margin-top:30px; margin-bottom: 0px;" class="mb-0"> <strong> Trashed Dated: </strong> <?= $trllevel['trash_date']; ?> </div>
                                <div class="project-row">
                                    <div class="project-cell index"><?= $i++; ?></div>
                                    <div class="project-cell"> Level: <?= $trllevel['level'] ?? 'No Name' ?></div>
                                    <div class="project-cell"> Title: <?= $trllevel['title'] ?> </div>
                                    <div class="project-cell"> Company: <?= $company['company_name'] ?? 'No Name' ?> </div>
                                    <div class="project-cell">
                                        <strong>Docs Link:</strong>
                                        <a href="<?= $trllevel['docslink'] ?>" target="_blank" title="View Docs">
                                            <i class="bi bi-eye-fill eye-icon"></i>
                                        </a>
                                    </div>
                                    <div class="project-cell">
                                        <a href="<?= base_url('company/trllevels-delete?id=' . $trllevel['id']) ?>" title="Delete trllevels" class="text-danger" onclick="return confirm('Are you sure you want to delete this trllevels?');">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="project-row">
                                    <div class="project-cell index"> </div>
                                    <div class="project-cell"> Sub Level: <?= $trllevel['sublevel'] ?></div>
                                    <div class="project-cell"> Sub Title: <?= $trllevel['subtitle'] ?></div>
                                    <div class="project-cell"> Project: <?= $project['project_name'] ?? 'No Name' ?> </div>
                                    <div class="project-cell"> <strong>Excel Link:</strong>
                                        <a href="<?= $trllevel['excellink'] ?>" target="_blank" title="View Docs">
                                            <i class="bi bi-eye-fill eye-icon"></i>
                                        </a>
                                    </div>
                                    <div class="project-cell project-grid-bottom">
                                        <a href="<?= base_url('company/trllevels-restore?id=' . $trllevel['id']) ?>" title="Restore Deleted trllevels" class=" " onclick="return confirm('Are you sure you want to Restore this trllevels?');">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 6V3L8 7l4 4V8c2.76 0 5 2.24 5 5 0 1.65-.8 3.1-2.03 4.03l1.42 1.42A6.97 6.97 0 0 0 19 13c0-3.87-3.13-7-7-7zM6.03 8.97A6.97 6.97 0 0 0 5 13c0 3.87 3.13 7 7 7v3l4-4-4-4v3c-2.76 0-5-2.24-5-5 0-1.65.8-3.1 2.03-4.03L6.03 8.97z" />
                                            </svg>
                                        </a>

                                        <?php if ($trllevel['trash_date']) {
                                            // Calculate days passed since trash_date
                                            $trashDatetrl = strtotime($trllevel['trash_date']);
                                            $currentDate = time();
                                            $daysPassed = ($currentDate - $trashDatetrl) / (60 * 60 * 24); // days difference

                                            // Check if logged-in user owns the brick
                                            if ($trllevel['user_id'] == sessionId('freelancer_id')) {
                                                // If 30 days have passed since trash_date → show Restore button
                                                if ($daysPassed >= 30) {
                                        ?>
                                                    <?php
                                                    redirect(base_url('company/trllevels-delete?id=') . $trllevel['id']);
                                                    ?>
                                                <?php } else { ?>
                                        <?php };
                                            };
                                        }; ?>
                                    </div>
                                </div>
                                <!-- <div class="project-grid project-grid-bottom">
                                    <div class="project-cell index"> </div>
                                    <div class="project-cell">
                                    </div>
                                </div> -->
                        <?php endforeach;
                        endif; ?>
                    </div>


                    <!-- IP TECH TRANSFER TRASH  -->
                    <div style="display: block;" id="companyList">
                        <?php if ($getipTechTransfer):
                            $i = 1;
                            foreach ($getipTechTransfer as $IpTechTransfer):
                        ?>
                                <div style=" margin-top:30px; margin-bottom: 0px;" class="mb-0"> <strong> Trashed Dated: </strong> <?= $IpTechTransfer['trash_date']; ?> </div>
                                <div class="project-row">
                                    <div class="project-cell index"><?= $i++; ?></div>
                                    <div class="project-cell"> Title: <?= $IpTechTransfer['title'] ?> </div>
                                    <div class="project-cell"> Decription: <?= $IpTechTransfer['description'] ?? 'No Description' ?> </div>
                                    <div class="project-cell"> Human Token: <?= $IpTechTransfer['humantoken'] ?? 'No Human Token' ?></div>
                                    <div class="project-cell"> Country: <?= $IpTechTransfer['country'] ?? 'No Country' ?></div>
                                </div>
                                <div class="project-row">
                                    <div class="project-cell index">.</div>
                                    <div class="project-cell"> IP Number: <?= $IpTechTransfer['ipnumber'] ?? 'No IP Number' ?> </div>
                                    <div class="project-cell"> Price Range: <?= $IpTechTransfer['priceminrange'] . ' - ' . $IpTechTransfer['pricemaxrange'] ?? 'No Price Range' ?> </div>
                                    <div class="project-cell"> Potential Market: <?= $IpTechTransfer['potentialmarket'] ?? 'No IP Number' ?> </div>
                                    <div class="project-cell">
                                        <strong>Aggreement:</strong>
                                        <a href="<?= base_url('/') . $IpTechTransfer['agreement'] ?>" target="_blank" title="View Docs">
                                            <i class="bi bi-eye-fill eye-icon"></i>
                                        </a>
                                    </div>
                                    <div class="project-cell">
                                        <a href="<?= base_url('company/ip-tech-transfer-delete?id=' . $IpTechTransfer['id']) ?>" title="Delete IP Tech Transfer" class="text-danger" onclick="return confirm('Are you sure you want to delete this IP Tech Transfer?');">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="project-row">
                                    <div class="project-cell index"> . </div>
                                    <div class="project-cell"> Filling Date: <?= $IpTechTransfer['fillingdate'] ?></div>
                                    <div class="project-cell"> Published Date: <?= $IpTechTransfer['publisheddate'] ?></div>
                                    <div class="project-cell"> Granted Date: <?= $IpTechTransfer['granteddate'] ?? 'No Granted Date' ?> </div>
                                    <div class="project-cell"> Expiry Date: <?= $IpTechTransfer['expirydate'] ?? 'No Expiry Date' ?> </div>
                                    <div class="project-cell project-grid-bottom">
                                        <a href="<?= base_url('company/ip-tech-transfer-restore?id=' . $IpTechTransfer['id']) ?>" title="Restore Deleted IP Tech Transfer" class=" " onclick="return confirm('Are you sure you want to Restore this IP Tech Transfer?');">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 6V3L8 7l4 4V8c2.76 0 5 2.24 5 5 0 1.65-.8 3.1-2.03 4.03l1.42 1.42A6.97 6.97 0 0 0 19 13c0-3.87-3.13-7-7-7zM6.03 8.97A6.97 6.97 0 0 0 5 13c0 3.87 3.13 7 7 7v3l4-4-4-4v3c-2.76 0-5-2.24-5-5 0-1.65.8-3.1 2.03-4.03L6.03 8.97z" />
                                            </svg>
                                        </a>
                                        <?php if ($IpTechTransfer['trash_date']) {
                                            // Calculate days passed since trash_date
                                            $trashDatetrl = strtotime($IpTechTransfer['trash_date']);
                                            $currentDate = time();
                                            $daysPassed = ($currentDate - $trashDatetrl) / (60 * 60 * 24); // days difference

                                            // Check if logged-in user owns the brick
                                            if ($IpTechTransfer['user_id'] == sessionId('freelancer_id')) {
                                                // If 30 days have passed since trash_date → show Restore button
                                                if ($daysPassed >= 30) {
                                        ?>
                                                    <?php
                                                    redirect(base_url('company/ip-tech-transfer-delete?id=') . $IpTechTransfer['id']);
                                                    ?>
                                                <?php } else { ?>
                                        <?php };
                                            };
                                        }; ?>
                                    </div>
                                </div>

                        <?php endforeach;
                        endif; ?>
                    </div>



                    <!-- Idea Pay Trashed File  -->
                    <div style="display: block;" id="companyList">
                        <?php if ($getIdeaPay):
                            $i = 1;
                            foreach ($getIdeaPay as $getIdea):
                        ?>
                                <div style="margin-top:0px; margin-bottom: 0px;" class="mb-0">
                                    <div class="project-row">
                                        <div class="project-cell index"><?= $i++; ?></div>
                                        <div class="project-cell"> Industry: <?= $getIdea['industry'] ?> </div>
                                        <div class="project-cell"> Sector: <?= $getIdea['sector'] ?? 'No Sector' ?> </div>
                                        <div class="project-cell"> Money Making Opportunity: <?= $getIdea['moneymakingopportunity'] ?? 'No Money Making' ?></div>
                                        <div class="project-cell"> Microseduct Investatement: <?= $getIdea['microseductivestatement'] ?? 'No Microseduct Ivestatement' ?></div>
                                        <div class="project-cell">
                                            <a href="<?= base_url('company/ideapay-restore?id=' . $getIdea['id']) ?>" title="Restore Deleted Idea Pay" class=" " onclick="return confirm('Are you sure you want to Restore this Idea Pay?');">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 6V3L8 7l4 4V8c2.76 0 5 2.24 5 5 0 1.65-.8 3.1-2.03 4.03l1.42 1.42A6.97 6.97 0 0 0 19 13c0-3.87-3.13-7-7-7zM6.03 8.97A6.97 6.97 0 0 0 5 13c0 3.87 3.13 7 7 7v3l4-4-4-4v3c-2.76 0-5-2.24-5-5 0-1.65.8-3.1 2.03-4.03L6.03 8.97z" />
                                                </svg>
                                            </a>

                                            <?php if ($getIdea['trash_date']) {
                                                // Calculate days passed since trash_date
                                                $trashDatetrl = strtotime($getIdea['trash_date']);
                                                $currentDate = time();
                                                $daysPassed = ($currentDate - $trashDatetrl) / (60 * 60 * 24); // days difference

                                                // Check if logged-in user owns the brick
                                                if ($getIdea['user_id'] == sessionId('freelancer_id')) {
                                                    // If 30 days have passed since trash_date → show Restore button
                                                    if ($daysPassed >= 30) {
                                            ?>
                                                        <?php
                                                        redirect(base_url('company/ideapay-delete?id=') . $getIdea['id']);
                                                        ?>
                                                    <?php } else { ?>
                                            <?php };
                                                };
                                            }; ?>

                                            <a href="<?= base_url('company/ideapay-delete?id=' . $getIdea['id']) ?>" title="Delete Idea Pay" class="text-danger" onclick="return confirm('Are you sure you want to delete this IdeaPay?');">
                                                <i class="bi bi-trash"></i>
                                            </a>

                                        </div>
                                    </div>
                                    <span style="float:right"> <strong> Trashed Dated: </strong> <?= $getIdea['trash_date']; ?> </span>
                                </div>
                        <?php endforeach;
                        endif; ?>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shiv Web Developer  -->
<?php include('includes/footer-link.php') ?>