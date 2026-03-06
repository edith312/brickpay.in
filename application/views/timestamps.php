<?php include('includes/header-link.php') ?>
<?php include('includes/header.php') ?>
<!-- Shiv Web Developer  -->
<style>
    .project-row {
        display: grid;
        grid-template-columns: 30px 1fr 1fr 1fr 50px;
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

    .form-group {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .form-label {
        width: 250px;
        margin-right: 10px;
    }

    .form-control {
        width: 250px;
        margin-right: 10px;
    }

    .day-label {
        font-style: italic;
        color: #555;
    }
</style>
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="card p-4">
        <h4 class="mb-0">TimeStamps</h4>
        <div class="row mb-3 align-items-center">
            <div class="container">
                <div class="row align-items-center g-3">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="brickCreation" class="form-label">1. Brick Creation Started Date & Time</label>
                            <input type="text" id="brickCreation" value="<?= $timeStamp_bricks['create_date'] ?>" class="form-control" readonly>
                            <span class="day-label">Day 1</span>
                        </div>

                        <div class="form-group">
                            <label for="brickPosted" class="form-label">2. Brick Posted date & time</label>
                            <input type="text" id="brickPosted" value="<?= $timeStamp_bricks['create_date'] ?>" class="form-control" readonly>
                            <span class="day-label">Day 2</span>
                        </div>

                        <div class="form-group">
                            <label for="brickPosted" class="form-label">3. Mark as Completed - Date & Time </label>
                            <input type="text" id="brickPosted" class="form-control">
                            <span class="day-label">Day 2</span>
                        </div>

                        <div class="form-group">
                            <label for="brickPosted" class="form-label">4. 100% of Fund Required Amount applications - Date & Time</label>
                            <input type="text" id="brickPosted" class="form-control">
                            <span class="day-label">Day 10</span>
                        </div>

                        <div class="form-group">
                            <label for="brickPosted" class="form-label">5. Fund Credited to Task Owner - Date & Time </label>
                            <input type="text" id="brickPosted" class="form-control">
                            <span class="day-label">Day 13</span>
                        </div>

                        <div class="form-group">
                            <label for="brickPosted" class="form-label">6. Human Resourses Agreement Send - Date & Time </label>
                            <input type="text" id="brickPosted" class="form-control">
                            <span class="day-label">Day 15</span>
                        </div>

                        <!-- Shiv Web Developer  -->
                        <div class="form-group">
                            <label for="brickPosted" class="form-label">7. Human Resourses Agreement Received - Date & Time </label>
                            <input type="text" id="brickPosted" class="form-control">
                            <span class="day-label">Day 25</span>
                        </div>

                        <div class="form-group">
                            <label for="brickPosted" class="form-label">8. Human Resourses Agreement Duly Signed Legal - Date & Time </label>
                            <input type="text" id="brickPosted" class="form-control">
                            <span class="day-label">Day 28 </span>
                        </div>

                        <div class="form-group">
                            <label for="brickPosted" class="form-label">9. Partial Funds Send to executer - Date & Time </label>
                            <input type="text" id="brickPosted" class="form-control">
                            <span class="day-label">Day 29 </span>
                        </div>

                        <div class="form-group">
                            <label for="brickPosted" class="form-label">10. Completed Funds Transfer to freelancers - Date & Time </label>
                            <input type="text" id="brickPosted" class="form-control">
                            <span class="day-label">Day 30 </span>
                        </div>

                        <div class="form-group">
                            <label for="brickPosted" class="form-label">11. Task Completion Updated - Date & Time </label>
                            <input type="text" id="brickPosted" class="form-control">
                            <span class="day-label">Day 31 </span>
                        </div>

                        <div class="form-group">
                            <label for="brickPosted" class="form-label">11. Valuation Updated - Date & Time </label>
                            <input type="text" id="brickPosted" class="form-control">
                            <span class="day-label">Day 32 </span>
                        </div>

                        <div class="form-group">
                            <label for="brickPosted" class="form-label">12. First Voting Reminder to all members - Date & Time </label>
                            <input type="text" id="brickPosted" class="form-control">
                            <span class="day-label">Day 33 </span>
                        </div>

                        <div class="form-group">
                            <label for="brickPosted" class="form-label">13 Voting Completed - Date & Time </label>
                            <input type="text" id="brickPosted" class="form-control">
                            <span class="day-label">Day 34 </span>
                        </div>

                    </div>

                </div>
            </div>


        </div>

    </div>
</div>


<?php include('includes/footer.php') ?>
<?php include('includes/footer-link.php') ?>