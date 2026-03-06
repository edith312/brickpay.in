<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Vertical Stepper Auto Fill</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f4f6f9;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Card */
.stepper-card{
    max-width: 520px;
    margin: 40px auto;
    background:#fff;
    border-radius: 18px;
    box-shadow: 0 12px 30px rgba(0,0,0,.08);
    overflow:hidden;
}

/* Header */
.stepper-header{
    padding:18px 22px;
    border-bottom:1px solid #eef1f4;
    display:flex;
    align-items:center;
    justify-content:space-between;
}

.status-pill{
    font-size:13px;
    padding:6px 12px;
    border-radius:999px;
    background:#e9f7ef;
    color:#198754;
    font-weight:600;
}

/* Body */
.stepper-body{
    padding:22px;
}

/* Stepper layout */
.v-stepper{
    position:relative;
}

/* Each step */
.v-step{
    display:grid;
    grid-template-columns:40px 1fr;
    gap:14px;
    position:relative;
    min-height:72px;   /* IMPORTANT for full line */
}

/* Left side (dot + line) */
.v-left{
    position:relative;
    display:flex;
    justify-content:center;
}

/* Dot */
.dot{
    width:14px;
    height:14px;
    border-radius:50%;
    background:#adb5bd;
    z-index:2;
}

/* Base gray line */
.line-base{
    position:absolute;
    top:7px;           /* dot center */
    left:50%;
    transform:translateX(-50%);
    width:4px;
    height:100%;
    background:#dee2e6;
    border-radius:999px;
    z-index:1;
}

/* Animated fill line */
.line-fill{
    position:absolute;
    top:7px;           /* dot center */
    left:50%;
    transform:translateX(-50%);
    width:4px;
    height:0%;
    background:#0d6efd;
    border-radius:999px;
    z-index:1;
    transition:height 700ms ease;
}

/* Right content */
.step-title{
    font-weight:600;
    font-size:15px;
    margin:0;
}
.step-desc{
    font-size:13px;
    color:#6c757d;
    margin-top:4px;
}

/* States */
.v-step.active .dot{
    background:#0d6efd;
}

.v-step.completed .dot{
    background:#198754;
}

.v-step.completed .line-fill{
    background:#198754;
}

/* Remove line from last step */
.v-step:last-child .line-base,
.v-step:last-child .line-fill{
    display:none;
}
</style>

<div class="page-body pt-1 px-2">
    <?php $this->load->view('admin/map/header') ?>

    <div class="mt-4">
        <button class="btn btn-primary">Food Processing Materials</button>
        <button class="btn btn-primary">Sensor Technology</button>
        <button class="btn btn-primary">Permutation Combination</button>
    </div>

    <div class="stepper-card">

        <div class="stepper-header">
            <div>
                <h6 class="mb-0 fw-bold">Process</h6>
                <small class="text-muted">Auto fill step-by-step (vertical)</small>
            </div>
            <span class="status-pill" id="status">Starting…</span>
        </div>

        <div class="stepper-body">
            <div class="v-stepper" id="stepper">

                <!-- STEP 1 -->
                <div class="v-step">
                    <div class="v-left">
                        <span class="dot"></span>
                        <span class="line-base"></span>
                        <span class="line-fill"></span>
                    </div>
                    <div>
                        <p class="step-title">Step 1</p>
                        <p class="step-desc">Process initiated</p>
                    </div>
                </div>

                <!-- STEP 2 -->
                <div class="v-step">
                    <div class="v-left">
                        <span class="dot"></span>
                        <span class="line-base"></span>
                        <span class="line-fill"></span>
                    </div>
                    <div>
                        <p class="step-title">Step 2</p>
                        <p class="step-desc">Validation started</p>
                    </div>
                </div>

                <!-- STEP 3 -->
                <div class="v-step">
                    <div class="v-left">
                        <span class="dot"></span>
                        <span class="line-base"></span>
                        <span class="line-fill"></span>
                    </div>
                    <div>
                        <p class="step-title">Step 3</p>
                        <p class="step-desc">Verification in progress</p>
                    </div>
                </div>

                <!-- STEP 4 -->
                <div class="v-step">
                    <div class="v-left">
                        <span class="dot"></span>
                        <span class="line-base"></span>
                        <span class="line-fill"></span>
                    </div>
                    <div>
                        <p class="step-title">Step 4</p>
                        <p class="step-desc">Processing request</p>
                    </div>
                </div>

                <!-- STEP 5 -->
                <div class="v-step">
                    <div class="v-left">
                        <span class="dot"></span>
                        <span class="line-base"></span>
                        <span class="line-fill"></span>
                    </div>
                    <div>
                        <p class="step-title">Step 5</p>
                        <p class="step-desc">Finalizing</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
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
</script>
