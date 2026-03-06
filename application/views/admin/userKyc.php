<?php include('template/header-link.php') ?>
<?php include('template/header.php') ?>
<style>
    tr {
        border-width: 1px !important;
    }
</style>

<?php
if ($this->session->has_userdata('bricksFundstatus')) {
    echo $this->session->userdata('bricksFundstatus');
    $this->session->unset_userdata('projectMsg');
}
?>
<!-- Shiv Web Developer -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="card border-0 bg-transparent">
        <div class="card-header mb-4 border-bottom px-2">
            <h5 class="card-title mb-0 text-primary">User KYC</h5>
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
                                <th> Name </th>
                                <!-- <th> Email </th> -->
                                <th> Humon Token </th>
                                <th> Country </th>
                                <th> Adharcard </th>
                                <th> Pancard </th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($userKyc) {
                                $i = 1;
                                foreach ($userKyc as $row) {
                                    $getProfile = $this->CommonModal->getSingleRowById('tbl_freelancer', ['id' => $row['user_id']]);
                            ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td>
                                            <?php
                                            if (!empty($getProfile['user_image'])) {
                                            ?>
                                                <a href="#" class="btn btn-sm btn-success">
                                                    <img src="<?= base_url('uploads/user_profile/' . $getProfile['user_image'] ?? 'assets/images/img/user.png') ?>" width="50" height="50" />
                                                </a>
                                            <?php
                                            } else {
                                            ?>
                                                <span>Profile Picture not found</span>
                                            <?php } ?> <br />
                                            <b>Name:</b> <?= $getProfile['name'] ?? 'No Name' ?> <br />
                                            <b>Email:</b> <?= $getProfile['email'] ?? 'No mentioned' ?>
                                        </td>

                                        <td>
                                            <?= $row['token_id'] ?? 'Country Not Found' ?>
                                        </td>
                                        <td>
                                            <?= $row['country_name'] ?? 'Country Not Found' ?>
                                        </td>
                                        <td>
                                            <?= $row['adharcard'] ?? 'Adharcard Not Found' ?>
                                        </td>
                                        <td>
                                            <?= $row['pancard'] ?? 'Pancard Not Found' ?>
                                        </td>
                                        <td class="d-flex">
                                            <?php if ($row['status'] == 'pending') { ?>
                                                <form action="<?= base_url('admin/user_kycStatusUpdate') ?>" method="post" class="me-2">
                                                    <input type="hidden" name="id" value="<?= $row['id']; ?>" />
                                                    <input type="hidden" name="status" value="verified" />
                                                    <button type="submit" class="btn btn-primary py-1 px-3"> Verify</button>
                                                </form>
                                                <form action="<?= base_url('admin/user_kycStatusUpdate') ?>" method="post">
                                                    <input type="hidden" name="id" value="<?= $row['id'];  ?>" />
                                                    <input type="hidden" name="status" value="rejected" />
                                                    <button type="submit" class="btn btn-danger py-0 px-3"> Reject</button>
                                                </form>
                                            <?php } else if ($row['status'] == 'verified') { ?>
                                                <div class="px-4 py-2" style="background: linear-gradient(to right, #00B8D6, #00B8D6); color: white;"> <?= ucfirst($row['status']); ?> </div>
                                            <?php } else { ?>
                                                <div class="px-4 py-2" style="background: linear-gradient(to right, #d60000ff, #d60000ff); color: white;"> <?= ucfirst($row['status']); ?> </div>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a class="text-danger" title="Remove User KYC" href="<?= base_url('AdminHome/deleteUserKyc?id=' . $row['id']) ?>" onclick="return confirm('Are you sure you want to delete this User?');"><i class="fas fa-trash"></i></a>
                                        </td>
                                        <td>
                                            <b> <?= $row['created_at'] ?? 'Date Not Found' ?>
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
    <!-- Shiv Web Developer -->
</div>
</div>


<?php $this->load->view('admin/template/footer-link'); ?>