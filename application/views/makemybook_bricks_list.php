<style>
    /* Card */
    .stepper-card {
        max-width: 520px;
        margin: 40px auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, .08);
        overflow: hidden;
    }

    /* Header */
    .stepper-header {
        padding: 18px 22px;
        border-bottom: 1px solid #eef1f4;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .status-pill {
        font-size: 13px;
        padding: 6px 12px;
        border-radius: 999px;
        background: #e9f7ef;
        color: #198754;
        font-weight: 600;
    }

    /* Body */
    .stepper-body {
        /* padding: 22px; */
        padding-top: 45px;
    }

    /* Stepper layout */
    .v-stepper {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Each step */
    .v-step {
        display: grid;
        grid-template-columns: 40px 1fr;
        gap: 14px;
        position: relative;
        min-height: 200px;
        /* IMPORTANT for full line */
    }

    /* Left side (dot + line) */
    .v-left {
        position: relative;
        display: flex;
        justify-content: center;
    }

    /* Dot */
    .dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #adb5bd;
        z-index: 2;
    }

    /* Base gray line */
    .line-base {
        position: absolute;
        top: 7px;
        /* dot center */
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 100%;
        background: #dee2e6;
        border-radius: 999px;
        z-index: 1;
    }

    /* Animated fill line */
    .line-fill {
        position: absolute;
        top: 7px;
        /* dot center */
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 0%;
        background: #0d6efd;
        border-radius: 999px;
        z-index: 1;
        transition: height 700ms ease;
    }

    .line-fill-helper {
        position: absolute;
        top: 25%;
        left: 0px;
        width: 80px;
        transform: translate(-83px, 0px);
        height: 3px;
        background: #198754;
        border-radius: 999px;
        z-index: 1;
        transition: height 700ms ease;
    }

    /* Right content */
    .step-title {
        font-weight: 600;
        font-size: 15px;
        margin: 0;
    }

    .step-desc {
        font-size: 13px;
        color: #6c757d;
        margin-top: 4px;
    }

    /* States */
    .v-step.active .dot {
        background: #0d6efd;
    }

    .v-step.completed .dot {
        background: #198754;
    }

    .v-step.completed .line-fill {
        background: #198754;
    }

    /* Remove line from last step */
    .v-step:last-child .line-base,
    .v-step:last-child .line-fill {
        display: none;
    }
    .add-40-margin{
        margin-top: 43px !important;
    }
</style>
<div class="row align-items-start">
    <div class="col-md-1">
        
            <div class="stepper-body">
                <div class="v-stepper" id="stepper">
                <?php if($getBricks) :?>
                    <!-- STEPS -->
                    <?php foreach($getBricks as $key => $bricks): ?>
                        <div class="v-step <?= $key == 0 ? 'completed' : '' ?>">
                            <div class="v-left">
                                <span class="dot"></span>
                                <span class="line-base"></span>
                                <span class="line-fill <?= $key == 0 ? 'h-100' : '' ?>"></span>
                            </div>
                        </div>
                    <?php endforeach;?>
                    
                        <div class="v-step">
                            <div class="v-left">
                                <span class="dot"></span>
                                <span class="line-base"></span>
                                <span class="line-fill"></span>
                            </div>
                        </div>
                        
                    <?php endif; ?>
                </div>
            </div>
    </div>
    <div class="col-md-11">
        <div id="companyList">
            <h5> Bricks Already Added</h5>
            <?php
                if ($getBricks) {
                    $brickCount = 1;
                    $last_key = count($getBricks) - 1;
                    foreach ($getBricks as $key => $bricks) {
                        $brickFunding = $this->CommonModal->getSingleRowById('tbl_brick_funding', 'brick_id = ' . $bricks['id']);
                    ?>

                        <p class="step-title text-start mt-md-3 <?= $key != 0 ? 'add-40-margin' : ''?>">Step <?= $key + 1?></p>

                        <div class="project-row rounded-0"
                            style="border-left: 4px solid <?php echo brickColor($bricks['brick_type']) ?>">
                            <span class="brickStatus
                            <?php
                                if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] == null) {
                                            echo 'bg-markascompleted';
                                        } else if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] != null) {
                                            echo 'bg-artificialbrickartificial';
                                        } else if ($bricks['artificialdate'] != null) {
                                            echo 'bg-artificialbrick';
                                    } else {?>
                                        bg-<?php echo($bricks['brick_status'] == 'draft' ? 'warning' : 'success') ?> text-white <?php }?>
                                        text-white  text-capitalize">
                                <?php
                                    if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] == null) {
                                                echo 'Completed';
                                            } else if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] != null) {
                                                echo 'Artificial Brick - Completed';
                                            } else if ($bricks['artificialdate'] != null) {
                                            echo 'Artificial Brick'; ?>
                                <?php echo($bricks['brick_status'] == 'draft' ? 'Draft' : ' - Live'); ?>
                                <?php } else {?>
                                <?php echo($bricks['brick_status'] == 'draft' ? 'Draft' : 'Live');} ?>
                            </span>
                            <div class="project-cell" style="width:100px;">
                                <?php echo $brickCount++ ?>
                            </div>
                            <div class="project-cell">Brick:
                                <?php echo $bricks['brick_title'] ?>
                            </div>
                            <div class="project-cell">Company:
                                <?php echo companyName($bricks['company_id']) ?>
                            </div>
                            <div class="project-cell">
                                Project:
                                <?php echo projectName($bricks['project_id']) ?>
                            </div>
                            <div class="project-cell">
                                Type:
                                <?php echo brickType($bricks['brick_type']) ?>
                            </div>
                            <div class="project-cell text-center" style="padding: 2px;">
                                <a href="<?php echo base_url('company/preview_brick?id=' . $bricks['id']) ?>" target="_blank"
                                    title="View Details">
                                    <i class="bi bi-eye-fill eye-icon"></i>
                                </a>
                            </div>
                        </div>

                        <div class="project-grid project-grid-bottom-1 rounded-0 position-relative"
                            style="border-left: 4px solid <?php echo brickColor($bricks['brick_type']) ?>">
                            <div class="project-cell"
                                style="display: flex; align-items: center; justify-content: center; padding: 0;">
                                <span class="project-dot green"></span>
                                <span class="line-fill-helper"></span>
                            </div>
                            <div class="project-cell">Reward:
                                <?php echo $bricks['reward_disclosed'] ?>
                            </div>
                            <div class="project-cell">Fund Required:
                                <?php echo $brickFunding['fund_required'] ?>
                            </div>
                            <div class="project-cell">Privacy : <span class="text-capitalize">
                                    <?php echo $bricks['brick_privacy'] ?>
                                </span></div>
                            <div class="project-cell">Brick Id:
                                <?php echo generateBrickId($bricks['id']) ?>
                            </div>
                            <div class="project-cell" style="width:30px;"></div>
                            <div class="project-cell"> Date: <span class="text-capitalize">
                                    <?php echo $bricks['create_date'] ?>
                                </span></div>
                            <div class="project-cell" style="width:300px;"> Artificial Date: <span class="text-capitalize">
                                    <?php
                                    if ($bricks['artificialdate'] != null) {?>
                                    <?php echo $bricks['artificialdate'] ?>
                                    <?php } else {
                                                    echo '...';
                                            }?>
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
    </div>


    <!-- <script>
        const steps = document.querySelectorAll(".v-step");
        const status = document.getElementById("status");

        let index = 0;
        const delay = 900;

        function runStep() {
            if (index >= steps.length) {
                status.innerHTML = "Completed ✅";
                return;
            }

            const step = steps[index];
            step.classList.add("active");

            const fill = step.querySelector(".line-fill");
            if (fill) fill.style.height = "100%";

            setTimeout(() => {
                step.classList.remove("active");
                step.classList.add("completed");
                index++;
                runStep();
            }, delay);
        }

        runStep();
    </script> -->
<script>

    function initSteps(modal) {
        const steps = modal.find('.v-step');

        steps.each(function () {
            const step = $(this);
            const dot = step.find('.dot');
            const lineFill = step.find('.line-fill');

            // avoid duplicate bindings
            dot.off('click.step').on('click.step', function (e) {
                e.stopPropagation();
                step.addClass('completed');
                lineFill.addClass('h-100');
            });
        });
    }


</script>