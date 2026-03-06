<style>
    tr {
        border-width: 1px !important;
    }
</style>


<!-- <?php
if ($this->session->has_userdata('projectConsultation')) {
    echo $this->session->userdata('projectConsultation');
    $this->session->unset_userdata('projectConsultation');
}
?> -->


<!-- Shiv Web Developer -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">

    <div class="card border-0 bg-transparent">
        <div class="card-header mb-4 border-bottom px-2">
            <h5 class="card-title mb-0 text-primary">Projects</h5>
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
                    <div class="mb-3 col-4">
                        <label for="physicalScale">
                            Physical World Scale
                        </label>
                        <select id="physicalScale" class="form-select" name="physical_scale">
                            <option value="" selected disabled>Select scale</option>
                                <!-- NA option -->
                                <option value="NA" <?= (empty($getProject['physical_scale'])) ? 'selected' : '' ?>>
                                    NA (<?= $scaleCounts['NA'] ?>)
                                </option>
                            <?php
                                for ($i = -15; $i <= 15; $i++) {
                                    $selected = ($getProject['physical_scale'] == $i) ? 'selected' : '';
                                    
                                    // Superscript formatting
                                    $sup = str_replace(
                                    ['-','0','1','2','3','4','5','6','7','8','9'],
                                    ['⁻','⁰','¹','²','³','⁴','⁵','⁶','⁷','⁸','⁹'],
                                    (string)$i
                                    );

                                    $count = $scaleCounts[$i] ?? 0;
                                    
                                    echo "<option value=\"$i\" $selected>
                                            10$sup" . ($count ? " ($count)" : "") . "
                                          </option>";
                                }
                            ?>
                        </select>
                    </div>
                    <table class="table dataTable table-hover mb-0 w-100" style="position: static !important; transform: inherit !important;">
                        <thead>
                            <tr>
                                <th>S. No.</th>
                                <th>Project Name</th>
                                <th>Project Leader:</th>
                                <th>Company Name:</th>
                                <th>TAM:</th>
                                <th>SAM:</th>
                                <th>SOM:</th>
                                <th>Project Valuation:</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($projects) {
                                $i = 1;
                                foreach ($projects as $row) { ?>
                                    <tr data-physical-scale="<?= $row['physical_scale'] ?? 'NA' ?>">
                                        <td><?= $i++; ?></td>
                                        <td class="sorting_1">
                                            <?= $row['project_name'] ?? 'No Name' ?>
                                        </td>
                                        <td>
                                            <?= $row['project_leader'] ?? 'No mentioned' ?>
                                        </td>
                                        <td>
                                            <?= $row['company_details'][0]['company_name'] ?? 'No mentioned' ?>
                                        </td>
                                        <td>
                                            <?= $row['tam'] ?? 'Not mentioned' ?>
                                        </td>
                                        <td>
                                            <?= $row['sam'] ?? 'No mentioned' ?>
                                        </td>
                                        <td>
                                            <?= $row['som'] ?? 'No mentioned' ?>
                                        </td>
                                        <td>
                                            <?= $row['project_valuation'] ?? 'No mentioned' ?>
                                        </td>
                                        <td>
                                            <?= $row['project_status'] ?>
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

<script>
$(document).ready(function () {

    var table;

    if ($.fn.DataTable.isDataTable('.dataTable')) {
        table = $('.dataTable').DataTable(); // reuse existing
    } else {
        table = $('.dataTable')
            .addClass('nowrap')
            .DataTable({
                responsive: true
            });
    }

    // External physical_scale filter
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {

        var selectedScale = $('#physicalScale').val();
        if (!selectedScale) return true;

        var row = table.row(dataIndex).node();
        var rowScale = $(row).data('physical-scale');

        if (selectedScale === 'NA') {
            return rowScale === 'NA' || rowScale === '' || rowScale === null;
        }

        return String(rowScale) === String(selectedScale);
    });

    $('#physicalScale').on('change', function () {
        table.draw();
    });

});
</script>