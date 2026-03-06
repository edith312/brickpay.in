<?php include('template/header-link.php') ?>
<?php include('template/header.php') ?>
<style>
    tr {
        border-width: 1px !important;
    }
</style>


<?php
if ($this->session->has_userdata('projectConsultation')) {
    echo $this->session->userdata('projectConsultation');
    $this->session->unset_userdata('projectConsultation');
}
?>


<!-- Shiv Web Developer -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">

    <div class="card border-0 bg-transparent">
        <div class="card-header mb-4 border-bottom px-2">
            <h5 class="card-title mb-0 text-primary">Project Consultants</h5>
            <div class="dropdown card-action">
                <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full Screen">
                    <svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 16m0 1a1 1 0 0 1 1 -1h3a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1z"></path>
                        <path d="M4 12v-6a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-6"></path>
                        <path d="M12 8h4v4"></path>
                        <path d="M16 8l-5 5"></path>
                    </svg>
                </a>

            </div>
        </div>
        <div class="card-body p-2">
            <div class="row g-xl-4 g-3 mb-4">
                <div class="col-12">
                    <table class="table dataTable table-hover mb-0 w-100" style="position: static !important; transform: inherit !important;">
                        <thead>
                            <tr>
                                <th>S. No.</th>
                                <th>Consultant Info</th>
                                <th>Consultant Profile</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($projectConsultants) {
                                $i = 1;
                                foreach ($projectConsultants as $row) { ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td class="sorting_1">
                                            <b>Name:</b> <?= $row['name'] ?? 'No Name' ?> <br>
                                            <b>Email:</b> <?= $row['email'] ?? 'No mentioned' ?> <br>
                                            <b>Password:</b> <?= $row['unhased_password'] ?? 'No mentioned' ?> <br>
                                            <!--<b>Contact Number:</b> <?= $row['phone'] ?? 'Not mentioned' ?> <br>-->
                                            <!--<b>DOB:</b> <?= $row['dob'] ?? 'No mentioned' ?> <br>-->
                                            <!--<b>Address:</b> <?= $row['address'] ?? 'No mentioned' ?> <br>-->
                                            <!--<b>Country:</b> <?= getCountryName($row['country']) ?? 'No mentioned' ?> <br>-->
                                            <!--<b>State:</b> <?= getStateName($row['state']) ?? 'No mentioned' ?> <br>-->
                                            <!--<b>City:</b> <?= $row['city'] ?? 'No mentioned' ?> <br>-->
                                            <!--<b>Zipcode:</b> <?= $row['zipcode'] ?? 'No mentioned' ?> <br>-->
                                        </td>
                                        <td>
                                            <?php
                                            if (!empty($row['user_image'])) {
                                            ?>
                                                <a href="#" class="btn btn-sm btn-success">
                                                    <img src="<?= base_url('uploads/user_profile/' . $row['user_image'] ?? 'assets/images/img/user.png') ?>" width="50" height="50" />
                                                </a>
                                            <?php
                                            } else {
                                            ?>
                                                <span>Profile Picture not found</span>
                                            <?php } ?>

                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-success">Active</a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-warning">View Details</a>
                                            <a href="<?= base_url('admin/deleteFreelancerUser?id=' . $row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to Delete this User?');">Delete</a>
                                        </td>
                                    </tr>
                            <?php }
                            }
                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<!-- Shiv Web Developer -->
<?php $this->load->view('admin/template/footer-link'); ?>