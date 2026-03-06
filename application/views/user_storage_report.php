<?php include('includes/header.php') ?>


<!-- Shiv Web Developer -->
<style>
    /* Team Member Card Styles */
    .team-member-card {
        display: flex;
        align-items: center;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.2s;
        cursor: pointer;
    }

    .team-member-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .team-member-card img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
        border: 2px solid #e9ecef;
    }

    .team-member-info {
        flex-grow: 1;
    }
</style>

<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="card border-0" style="width: 100%;">
        <div class="card-body row">
            <div class="table-resonsive col-md-6 UserProfileTable card px-4 py-3">
                <div>
                    <?php
                    $brickOwnerDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => sessionId('freelancer_id')]);
                    if (!empty($brickOwnerDetails)):
                    ?>
                        <div class="col-md-12 p-2" style="z-index:5;">
                            <div onclick="window.location.href='<?= base_url('company/user_preview?id=' . $brickOwnerDetails['id']) ?>'" class="team-member-card">
                                <img src="<?= !empty($brickOwnerDetails['user_image']) ? base_url() . 'uploads/user_profile/' . $brickOwnerDetails['user_image'] : base_url() . 'assets/user-icon.png' ?>" alt="Profile Picture">
                                <div class="team-member-info">
                                    <h6><?= $brickOwnerDetails['name'] ?: 'No Name' ?></h6>
                                    <div><strong>Email:</strong> <a href="mailto:<?= $brickOwnerDetails['email'] ?: 'N/A' ?>" style="width:200px;"><?= $brickOwnerDetails['email'] ?: 'N/A' ?></a></div>
                                    <div><strong>Phone:</strong> <?= $brickOwnerDetails['phone'] ?: 'N/A' ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <h5 class="fw-semibold"> Storage Usage </h5>
                <hr>
                <div>Database Usage: <?php echo number_format($db_size / 1024, 2); ?> KB </div>
                <div>File Storage Usage: <?php echo number_format($file_size / 1024, 2); ?> KB</div> <br>
                <div><strong>Total Usage: <?php echo number_format($total_size / 1024, 2); ?> KB</strong></div>
            </div>
        </div>
    </div>
</div>
<!-- Shiv Web Developer -->
<?php include('includes/footer.php') ?>
<?php include('includes/footer-link.php') ?>