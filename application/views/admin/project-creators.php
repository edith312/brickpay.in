<?php include('template/header-link.php') ?>
<?php include('template/header.php') ?>
<!-- Shiv Web Developer -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">

    <div class="card border-0 bg-transparent">
        <div class="card-header mb-4 border-bottom px-2">
            <h5 class="card-title mb-0 text-primary">Project Creators</h5>
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
            <?php
            if ($this->session->has_userdata('deleteMsg')) {
                echo $this->session->userdata('deleteMsg');
                $this->session->unset_userdata('deleteMsg');
            }
            ?>
            <div class="row g-xl-4 g-3 mb-4">
                <div class="col-12 my-0">
                    <table class="table dataTable table-hover mb-0 w-100" style="position: static !important; transform: inherit !important;">
                        <thead>
                            <tr>
                                <th>S. No.</th>
                                <th>Company Info</th>
                                <th>Director Infor</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if ($projectCreators) {
                                $projectSno = 1;
                                foreach ($projectCreators as $row) { ?>
                                    <tr>
                                        <td><?= $projectSno++; ?></td>
                                        <td class="sorting_1">
                                            <b>Name:</b> <?= $row['company_name'] ?? 'No Name' ?> <br>
                                            <b>Company Type:</b> <?= $row['company_type'] ?? 'No Type' ?> <br>
                                            <b>CIN Number:</b> <?= $row['ciin_number'] ?? 'No Type' ?> <br>
                                            <b>DIPP Number:</b> <?= $row['dipp_number'] ?? 'No Type' ?> <br>
                                            <b>Location:</b> <?= $row['location'] ?? 'No Type' ?> <br>
                                        </td>
                                        <td>
                                            <b>Name:</b> <?= $row['director_name'] ?? 'No Name' ?> <br>
                                            <b>Contact Number:</b> <?= $row['director_number'] ?? 'No Number' ?> <br>
                                            <b>Email:</b> <?= $row['director_email'] ?? 'No Email' ?> <br>
                                            <b>DIPP Number:</b> <?= $row['dipp_number'] ?? 'No Type' ?> <br>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-success">Active</a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-warning">View Details</a>
                                            <a href="<?= base_url('AdminHome/deleteCompany?id=' . $row['id']) ?>" class="btn btn-sm btn-danger">Delete</a>
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


<?php $this->load->view('admin/template/footer-link'); ?>
<!-- Shiv Web Developer -->