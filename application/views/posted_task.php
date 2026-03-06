<?php include('includes/header.php') ?>
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <?php
    if ($myBricks):
    ?>
        <!-- Shiv Web Developer -->
        <ul class="row g-3 li_animate list-unstyled">
            <?php foreach ($myBricks as $row): ?>
                <li class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-header d-block">
                            <a href="#" class="card-title mb-0 text-primary fw-bold" style="font-size: 18px; text-decoration: none;">
                                <?= $row['project_name'] ?>
                            </a>
                            <div>
                                <?php
                                echo printCategories($row['category']);
                                ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-1">
                                <i class="fa fa-building me-3"></i>
                                <span class="pe-2">Director Name: </span>
                                <a href="#"><?= $myCompany['director_name'] ?></a>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fa fa-credit-card me-3"></i>
                                <span class="pe-2">Budget: </span>
                                <a href="javascript: void(0);">₹<?= $row['min_budget'] . ' - ' . $row['max_budget'] ?><span class="text-secondary">/<?= ucwords($row['project_type']) ?></span></a>
                            </div>
                            <div class="hstack gap-3 mb-2">
                                <div>
                                    <p class="mb-1 text-muted small">Skills Required:</p>
                                    <?php
                                    echo printSkills($row['skills'])
                                    ?>
                                </div>
                            </div>
                            <div class="hstack gap-3 mb-4">
                                <div>
                                    <p class="mb-1 text-muted small">Posted:</p>
                                    <?= convertDatedmy($row['created_at']) ?>
                                </div>
                                <div class="ms-auto">
                                    <p class="mb-1 text-muted small">Deadline:</p>
                                    <?= convertDatedmy($row['brick_deadline']) ?>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <a href="<?= base_url('company/brick/' . $row['id'] . '/' . url_title($row['project_name'])) ?>" class="btn" style="width: 100px; font-size: 10px; font-weight: bold; padding: 8px 4px; border-radius: 5px; text-align: center; display: inline-block;">
                                    View Task
                                </a>
                                <a href="<?= base_url('company/brick/' . $row['id'] . '/' . url_title($row['project_name'])) ?>" class="btn btn-success btn-sm" style="width: 100px; font-size: 10px; font-weight: bold; padding: 8px 4px; border-radius: 5px; text-align: center; display: inline-block;">
                                    Bidders
                                </a>
                            </div>

                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php
    else:
    ?>
        <div class="emptyWrapper">
            <div class="emptyIcon">
                <i class="bi bi-briefcase fs-4"></i>
            </div>
            <h5>No posted Tasks found</h5>
            <p class="text-muted">You have not posted any Tasks yet. Click the button below to post a Task.</p>
            <div class="w-50 mx-auto">
                <a href="<?= base_url('company/create-brick') ?>" class="btn btn-primary justify-content-center">Post a Task</a>
            </div>
        </div>
    <?php endif; ?>


</div>
<!-- Shiv Web Developer -->
<?php include('includes/footer.php') ?>
<?php include('includes/footer-link.php') ?>