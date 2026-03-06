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
        min-height: 35px;
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
<style>
    .my-table{
        position: unset;
        transform: unset;
        width: 100%;
        height: unset;
    }
</style>
<div class="row align-items-start">
    <div class="col-md-1">
        
            <div class="stepper-body">
                <div class="v-stepper" id="stepper">
                <?php if($getEvents) :?>
                    <!-- STEPS -->
                    <?php foreach($getEvents as $key => $events): ?>
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
        <table class="table table-bordered my-table">
            <thead>
                <th>Step No.</th>
                <th>Date</th>
                <th>Opening Time</th>
                <th>Closing Time</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach($getEvents as $index => $timeline) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $timeline['date'] ?></td>
                        <td><?= $timeline['opening_time'] ?></td>
                        <td><?= $timeline['closing_time'] ?></td>
                        <td>
                            <a target="_blank" href="<?= base_url("calendar/data-feeding-panel?id=$timeline[id]")?>" title="View Details">
                                <i class="bi bi-eye-fill eye-icon"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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