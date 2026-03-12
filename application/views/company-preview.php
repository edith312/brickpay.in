<?php include('includes/header-link.php') ?>
<?php include('includes/header.php') ?>

<style>
    .timeline_container{
        /* border: 1px solid #e3e3e3; */
        /* background: #f8f9fa; */
        padding: 28px 48px;
        position: relative;
        z-index: 2;
        background: transparent !important;
    }
    .timeline_wrapper{
        position: relative;
        min-height: 500px;
        background: #f8f9fa;
        z-index: 0;
    }
    #connectionLayer{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
        overflow: visible;  
    }
    .my_timeline{
        position: relative;
        height: 1px;
        display: flex;
        justify-content: space-evenly;
    }
    .my_timeline_line{
        position: absolute;
        height: 1px;
        width: 100%;
        background: #e3e3e3;
    }
    .context-menu {
        position: absolute;
        background: #fff;
        border: 1px solid #ccc;
        display: none;
        z-index: 1000;
        width: 200px;
    }
    .context-menu ul {
        list-style: none;
        margin: 0;
        padding: 5px 0;
    }

    .context-menu li {
        padding: 6px 12px;
        cursor: pointer;
    }

    .context-menu li:hover {
        background: #f1f1f1;
    }

    .menu-item {
        padding: 8px 12px;
        cursor: pointer;
    }

    .menu-item:hover {
        background: #f0f0f0;
    }

    .timeline-users {
        display: inline-flex;
        gap: 20px;
        height: 50px;
        width: 100%;
        justify-content: center;
        position: absolute;
        top: 35px;
        transform: translate(0px, -50%);
        align-items: center;
        flex-direction: row;
    }

    .timeline-user {
        position: relative;
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        max-width: 75px;
        min-width: 75px;
        padding: 4px 8px;
        /* background: #fff; */
        border-radius: 20px;
        cursor: grab;
    }

    .timeline-user a {
        text-align: center;
        text-decoration: none;
        color: black;
    }

    .timeline-user a .user-avatar {
        width: 35px;
        height: 35px;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 50%;
        /* border: 1px solid blue; */
    }

    .timeline-user a span {
        font-size: 12px;
        text-align: center;
        white-space: nowrap;
    }

    .tagify__input {
        background: gainsboro;
        min-width: 150px;
    }

    .timeline-user.dragging {
        opacity: 0.5;
    }

    .connection-source {
        border: 3px solid #0d6efd !important; /* Blue border */
        box-shadow: 0 0 10px rgba(13, 110, 253, 0.5);
        background-color: #e9ecef;
        transform: scale(1.05);
        transition: all 0.2s ease;
    }
    .search-btn{
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      border-radius: 50%;
      background-color: transparent;
      border: none;
      cursor: pointer;
    }
    .search-btn:hover{
      background-color: white; 
    }
</style>

<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <?php
        if ($this->session->has_userdata('projectMsg')) {
            echo $this->session->userdata('projectMsg');
            $this->session->unset_userdata('projectMsg');
        }
    ?>
    <div class="d-flex flex-row">
        <div class="card p-md-4 p-2">
            <h4 class="mb-md-0 mb-4">Company Preview</h4>
            <div class="d-flex justify-content-center justify-content-md-end align-items-center mb-4 gap-2">
                <?php if($is_owner == 1): ?>
                    <a href="<?= base_url('company/company-edit?id=' . $getProfile['id']) ?>" class="btn btn-primary">
                        Edit
                    </a>
                <?php endif; ?>
                <a href="#" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Follow
                </a>
                <a href="#" class="btn btn-primary">
                    <i class="bi bi-download me-1"></i>Download Now
                </a>
                <a href="<?= base_url("company/company-team-members?id=$getProfile[id]") ?>" class="btn btn-dark me-2" id="temmembersBtnWrapper" >
                    <i class="bi bi-person-plus me-1"></i> 
                    Team Members
                </a>
            </div>
            <!-- Shiv Web Developer -->
            <?php
            if ($this->session->has_userdata('memberDelete')) {
                echo $this->session->userdata('memberDelete');
                $this->session->unset_userdata('memberDelete');
            }
            ?>

            <div class="row mb-3">
                <div class="col-md-4">
                    <span class="label-project-preview">CIN Number:</span>
                    <span class="value"><?= $getProfile['ciin_number'] ?></span>
                </div>
                <div class="col-md-4">
                    <span class="label-project-preview">DIPP Number:</span>
                    <span class="value"><?= $getProfile['dipp_number'] ?></span>
                </div>
                <div class="col-md-4">
                    <span class="label-project-preview">PAN:</span>
                    <span class="value"><?= $getProfile['pan_number'] ?></span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <span class="label-project-preview">TAN:</span>
                    <span class="value"><?= $getProfile['tan_number'] ?></span>
                </div>
                <div class="col-md-4">
                    <span class="label-project-preview">GST:</span>
                    <span class="value"><?= $getProfile['gst_number'] ?></span>
                </div>
                <div class="col-md-4">
                    <span class="label-project-preview">Company Name:</span>
                    <span class="value"><?= $getProfile['company_name'] ?></span>
                </div>
            </div>
            <div class="border p-3 rounded">
                <?php if (!empty($getDirectors)) : ?>
                    <h5>Directors</h5>
                    <?php foreach ($getDirectors as $director) : ?>
                        <div class="row mb-3 rounded" style="border-left: 1px solid rgba(0,0,0,0.4);">
                            <div class="col-md-4">
                                <span class="label-project-preview">Director Name:</span>
                                <span class="value"><?= htmlspecialchars($director['director_name']) ?></span>
                            </div>
                            <div class="col-md-4">
                                <span class="label-project-preview">DIN Number:</span>
                                <span class="value"><a href="#"><?= htmlspecialchars($director['director_din_number']) ?></a></span>
                            </div>
                            <div class="col-md-4">
                                <span class="label-project-preview">Mobile Number:</span>
                                <span class="value"><a href="#"><?= htmlspecialchars($director['director_mobile_number']) ?></a></span>
                            </div>
                            <div class="col-md-4">
                                <span class="label-project-preview">E-mail:</span>
                                <span class="value"><a href="mailto:<?= htmlspecialchars($director['director_email']) ?>"><?= htmlspecialchars($director['director_email']) ?></a></span>
                            </div>
                            <div class="col-md-4">
                                <span class="label-project-preview">Permanent Address:</span>
                                <span class="value"><?= htmlspecialchars($director['director_address']) ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col-12">
                        <p class="text-muted">No directors found.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="border p-3 mt-3 rounded">
                <?php if (!empty($getBanks)) : ?>
                    <h5>Accounts</h5>
                    <?php foreach ($getBanks as $bank) : ?>
                        <div class="row mb-3 rounded" style="border-left: 1px solid rgba(0,0,0,0.4);">
                            <div class="col-md-4">
                                <span class="label-project-preview">Account Holder Name:</span>
                                <span class="value"><?= htmlspecialchars($bank['account_holder_name']) ?></span>
                            </div>
                            <div class="col-md-4">
                                <span class="label-project-preview">Account Number:</span>
                                <span class="value"><a href="#"><?= htmlspecialchars($bank['account_number']) ?></a></span>
                            </div>
                            <div class="col-md-4">
                                <span class="label-project-preview">Bank Name:</span>
                                <span class="value"><a href="#"><?= htmlspecialchars($bank['bank_name']) ?></a></span>
                            </div>
                            <div class="col-md-4">
                                <span class="label-project-preview">IFSC Code:</span>
                                <span class="value"><a href="#"><?= htmlspecialchars($bank['bank']) ?></a></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col-12">
                        <p class="text-muted">No accounts found.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <span class="label-project-preview">Permanent Employer count at the time of Account creation:</span>
                    <span class="value"><?= $getProfile['employercount'] ?></span>
                </div>
                <div class="col-md-3">
                    <span class="label-project-preview">Current Employer Count:</span>
                    <span class="value"><?= $getProfile['currentemployercount'] ?></span>
                </div>
                <div class="col-md-3">
                    <span class="label-project-preview">Lifetime Revenue Generated at the Time of Account Creation:</span>
                    <span class="value"><?= $getProfile['lifetimerevenue'] ?></span>
                </div>
                <div class="col-md-3">
                    <span class="label-project-preview">Current Revenue Generated at the Time of Account Creation:</span>
                    <span class="value"><?= $getProfile['currentlifetimerevenue'] ?></span>
                </div>
            </div> <!-- Shiv Web Developer -->

            <div class="row">
                <div class="col-md-12 mb-3">
                    <strong>About Us:</strong>
                    <div><?= $getProfile['about_us'] ?></div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Mission:</strong>
                    <div><?= $getProfile['mission'] ?></div>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>Vision:</strong>
                    <div><?= $getProfile['vision'] ?></div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Company Valuation:</strong>
                    <div class="d-flex flex-row">
                        <?= $getProfile['valuation'] ?>
                        <a href="<?= base_url("company/company-added-valuation?id=$company_id") ?>" class="btn btn-primary px-3 py-0 mx-3" id="getvaluationbyproject"> View Details </a>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Equity Dilution (%):</strong>
                    <div><?= $getProfile['equity_dilution'] ?>%</div>
                </div>
                <div class="mb-3">
                    <div class="d-flex" style="gap: 121px;">
                        <strong class="">Financial Years:</strong>
                        <a href="<?= base_url("company/company-financial-year-reports?id=$company_id") ?>" class="btn btn-primary px-3 py-0 mx-3 d-inline-block">
                            View Report
                        </a>
                    </div>
                    </div>

                <div class="mb-3">
                    <div class="d-flex" style="gap: 14px;">
                        <strong class="">Cashflow Projection Booking:</strong>
                    <a href="<?= base_url("company/company-cashflow-projection-booking?id=$company_id") ?>" class="btn btn-primary px-3 py-0 mx-3 d-inline-block">
                        View Details
                    </a>
                    </div>
                    </div>
                <div class="mb-3">
                    <div class="d-flex" style="gap: 105px;">
                        <strong class="">Bid Over Booking:</strong>
                    <a href="<?= base_url("company/company-bid-over-booking?id=$company_id") ?>" class="btn btn-primary px-3 py-0 mx-3 d-inline-block">
                        View Details
                    </a>
                </div>
            </div>

            <div class="row d-none">
                <div class="col-md-6 mb-3">
                    <strong>Permanent Employer count at the time of account creation:</strong>
                    <div>10.</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Current Employer Count:</strong>
                    <div>10</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong> Lifetime Revenue generated at the time of account creation:</strong>
                    <div>50 million</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong> Current Revenue generated at <br> the time of account creation:</strong>
                    <div>15%</div>
                </div>
            </div>

            <div class="d-flex justify-content-between flex-wrap gap-3 mt-3">
                <div class="d-flex gap-3 flex-wrap align-items-center"></div>
                <div class="d-flex gap-3 align-items-center">
                    <a href="<?= base_url("company/project-profile?company_id=$company_id") ?>" class="custom-btn text-decoration-none">
                        <i class="fa fa-list"></i> Total Projects
                    </a>
                    <button class="btn btn-warning shadow-sm text-dark">
                        <i class="fa fa-hourglass-half me-2"></i> Projects Pending Request
                    </button>
                </div>
            </div>
            </div>
        </div>
        <div class="">
            <!-- TOGGLE FUNCTION FOR PRESS RELEASE  -->

                <!-- Filters Section -->
                <div class="p-2">
                    <i id="toggleFilters" class="fa fa-bars cursor-pointer"></i>
                </div>
                <div class="filters" id="filtersSection" style="width: 400px; margin-top: 0; display: <?php echo validation_errors() ? 'none' : 'none'; ?>">
                        <div class="justify-content-between align-items-center mb-2">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 id="filtersText" class="mb-0 mt-2 d-flex">PRESS RELEASE : </h6>
                                <input type="date" name="date_filter" id="date_filter_press_release" class="form-control mt-3" placeholder="Date &amp; Time" style="width:180px;">
                            </div>
                            <div class="ps-0 form-check form-switch d-flex justify-content-between my-4">
                                <button class="btn btn-primary" style="width:180px;">Context AI</button>
                                <input class="form-check-input " type="checkbox" role="switch" id="context_ai_switch" name="context_ai">
                            </div>
                            <div class="position-relative">
                                <input type="text" name="text_search" id="text_search_press_release" class="form-control mt-3" placeholder="Search Press Release">
                                <button id="press_release_search_btn" type="button" class="btn btn-outline-secondary position-absolute search-btn">
                                    <i class="fa fa-search" style="color: #555;"></i>
                                </button>
                            </div>
                            <div class="pb-2 mb-3 mt-4">
                                <form action="<?= base_url('/company/company-press-release') ?>" method="post">
                                    <input type="hidden" name="company_id" value="<?= $getProfile['id'] ?>">
                                    <div class="press-release">
                                        <textarea class="form-control" name="press_release" id="myTextarea" placeholder="Description" required><?= !empty($task['press_release']) ? htmlspecialchars($task['press_release']) : set_value('press_release', ''); ?></textarea>
                                        <small class="text-danger"><?= form_error('press_release'); ?></small>
                                        <div id="wordCounter" class="counter">0 / 60 words</div>
                                    </div>
                                    <div class="text-end mt-2">
                                        <button type="submit" class="btn btn-success" style="font-size:12px;"> Submit </button>
                                    </div>
                                </form>
                            </div>
                            <div id="press_release_container">
                            
                            <?php
                                $getRelease = $this->CommonModal->getRowByIdInOrder('tbl_company_press_release', ['company_id' => $getProfile['id']], 'created_date', 'DESC');
                                // print_r($getRelease);
                                if ($getRelease) {
                                    foreach ($getRelease as $release) {
                                ?>

                                    <div class="press_release_showcase">

                                        <div class="d-flex justify-content-between"> <?= $release['uniq_id']; ?>
                                            <span class="datetime"> <?= $release['created_date']; ?> </span>
                                        </div>
                                        <p>
                                            <?= $release['press_release']; ?>
                                        </p>
                                            <a href="<?= base_url("company/press-release/$release[id]") ?>">
                                                👁️
                                            </a>
                                        <span class="px-3 py-0 mx-3 getpressreleaseedit" style="width:5px; height:20px; cursor: pointer;"
                                            data-press="<?= $release['id'] ?>"> ✏️ </span>
                                        <a class="text-danger mx-3" title="Remove Member" href="<?= base_url('Home/deletePressReleaseCompany?id=' . $release['id']) ?>" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></a>

                                    </div>

                            <?php
                                    };
                                }
                                ?>
                                </div>
                            <div class="modal-overlay" id="pressreleasetionModel" style="width:100% !important">
                                <div class="modal-box" style="max-width:90% !important; height: 90%; overflow-y: scroll;">
                                    <span class="modal-close" onclick="closePressReleaseModal()">&times;</span>
                                    <h3>Write About Press Release </h3>
                                    <table class="custom-table">
                                        <tbody>
                                            <form action="<?= base_url('/company/company-press-release') ?>" method="post">
                                                <div class="row h-100 align-items-start">
                                                    <div id="press_release_edit_container" class="col-8">
                                                        <div class="form-group my-5" style="width:300px;">
                                                            <label> Story Time </label>
                                                            <select class="form-select" name="storytime">
                                                                <!-- <option value="24H"> 24 Hours </option> -->
                                                                <option value="1Day"> 24 Hours </option>
                                                                <option value="1Week"> 1 Week </option>
                                                                <option value="1Month"> 1 Month </option>
                                                                <option value="6Months"> 6 Months </option>
                                                                <option value="1Year"> 1 Year </option>
                                                                <option value="5Year"> 5 Year </option>
                                                                <option value="10Year"> 10 Year </option>
                                                                <option value="lifetime"> Lifetime </option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group my-5">
                                                            <label> Short Description</label>
                                                            <textarea name="press_release" class="form-control" id="myTextarea2" placeholder="Enter" for="" class="form-control form-control-rounded" required></textarea>
                                                            <div id="wordCounter2" class="counter2">0 / 60 words</div>
                                                            <input type="hidden" name="id" value="" placeholder="Press Release Id" />
                                                            <input type="hidden" name="company_id" value="<?= $getProfile['id'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea id="editor1" rows="10" cols="80" name="editordata" class="from-control" placeholder="Enter" for="" class="form-control form-control-rounded" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-1 w-auto p-2">
                                                        <i id="toggle_press_release_tag_container" class="fa fa-bars cursor-pointer"></i>
                                                    </div>
                                                    <div id="press_release_tag_container" class="col-3 h-100">
                                                    <textarea name="press_release_tags" id="" class="form-control mt-4" placeholder="Enter Press Release Tags" rows="8"></textarea>
                                                    </div>
                                                    </div>
                                                <div class="text-center mt-2">
                                                    <button type="submit" class="btn btn-success" style="font-size:12px;"> Publish </button>
                                                </div>
                                            </form>


                                            <!-- Container where details will be loaded -->
                                            <div class="pressRelease_Container"></div>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <!-- VIEW FUNCTIIONALITY  -->
                            <div class="modal-overlay" id="viewpressreleasetionModel" style="width:100% !important">
                                <div class="modal-box" style="max-width:90% !important; height: 90%; overflow-y: scroll;">
                                    <span class="modal-close" onclick="viewclosePressReleaseModal()">&times;</span>
                                    <h3>Read Press Release </h3>
                                    <table class="custom-table">
                                        <tbody>
                                            <p class="statusmsg"> </p>
                                            <p class="storytime"> </p>
                                            <label class="short_descriptiontitle"></label>
                                            <p class="press_release_view"> </p>
                                            <div class="editordata_view"></div>
                                            </form>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- End of Filters Section -->
                        </div>


                </div>
        </div>
    </div>
</div>

<?php include('includes/footer-link.php') ?>

<style>
    body {
        margin: 0px !important;
    }
    .label-project-preview {
        font-size: 14px;
        color: #070808;
        font-weight: 600;
        margin-right: 0;
    }

    .card div {
        font-size: 16px;
    }

    .custom-btn {
        background-color: #28a745;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        font-size: 16px;
    }

    .custom-btn i {
        margin-right: 8px;
    }

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

    .team-member-info h6 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        color: #070808;
    }

    .team-member-info p {
        margin: 2px 0;
        font-size: 14px;
        color: #555;
    }

    .team-member-status {
        font-size: 12px;
        font-weight: 500;
        padding: 5px 10px;
        border-radius: 12px;
        text-transform: uppercase;
    }

    .Accepted {
        background-color: #d4edda;
        color: #155724;
    }

    .Rejected {
        background-color: #f8d7da;
        color: #721c24;
    }

    .Requested {
        background-color: #fff3cd;
        color: #856404;
    }

    /* Timeline Styles */
    .timeline-container {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        position: relative;
    }

    .timeline {
        position: relative;
        margin: 20px 0;
    }

    .row.timeline-row {
        display: flex;
        align-items: center;
        margin-bottom: 40px;
    }

    .label {
        width: 200px;
        font-weight: bold;
        color: #333;
    }

    .line {
        flex-grow: 1;
        height: 2px;
        background: #007bff;
        position: relative;
        margin: 0 20px;
        min-width: 100px;
    }

    .circle {
        width: 40px;
        height: 40px;
        background: #fff;
        border: 3px solid #007bff;
        border-radius: 50%;
        position: absolute;
        top: -19px;
        transform: translateX(-50%);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background-size: cover;
        background-position: center;
    }

    .circle-name {
        position: absolute;
        top: 45px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 12px;
        color: #333;
        white-space: nowrap;
    }

    .active-status {
        width: 10px;
        height: 10px;
        background: #28a745;
        border-radius: 50%;
        position: absolute;
        top: -5px;
        right: -5px;
    }

    .doc-icon {
        position: absolute;
        left: -20px;
        top: -12px;
        font-size: 24px;
        color: #fd7e14;
        cursor: pointer;
        background: #fff;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: all 0.2s ease;
    }

    .doc-icon:hover {
        color: #e65c00;
        transform: scale(1.1) translateY(-12px) translateX(-20px);
    }

    .tooltip {
        display: none;
        position: absolute;
        background: #333;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        top: 60px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 20;
        font-size: 12px;
        max-width: 300px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .doc-tooltip {
        display: none;
        position: absolute;
        background: #333;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        z-index: 20;
        font-size: 12px;
        max-width: 300px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        margin-bottom: 5px;
    }

    .circle:hover .tooltip,
    .doc-icon:hover .doc-tooltip {
        display: block;
    }

    .modal-overlay {
     position: fixed;
     top: 0;
     left: 0;
     width: 100vw;
     height: 100vh;
     background-color: rgba(0, 0, 0, 0.7);
     display: none;
     align-items: center;
     justify-content: center;
     z-index: 1000;
   }

   .modal-box {
     background: #fff;
     border-radius: 10px;
     padding: 20px 30px;
     width: 90%;
     max-width: 600px;
     box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
     position: relative;
   }

   .modal-close {
     position: absolute;
     top: 10px;
     right: 15px;
     font-size: 22px;
     cursor: pointer;
   }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const timeline = document.getElementById("timeline");
        const companyId = <?= json_encode($getProfile['id'] ?? '') ?>;
        const agreeMentbaseUrl = '<?= base_url('uploads/agreements') ?>';

        if (!timeline) {
            console.error("Element with id 'timeline' not found.");
            return;
        }

        if (!companyId) {
            console.error("Company ID is not available.");
            timeline.innerHTML = "<p class='text-muted'>Company ID not found.</p>";
            return;
        }

        // Function to extract file name from URL or path
        function getFileName(path) {
            if (!path) return '';
            // Extract the last part after the last '/'
            return path.split('/').pop();
        }

        // Fetch team structure for the company
        fetch('<?= base_url() ?>Home/get_team_structure', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    company_id: companyId
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(text => {
                if (text.trim().startsWith('<')) {
                    console.error("Received HTML instead of JSON:", text.substring(0, 100));
                    throw new Error("Server returned HTML instead of JSON. Check backend endpoint.");
                }
                return JSON.parse(text);
            })
            .then(data => {
                console.log("Fetched data:", data); // Log response for debugging
                if (data.status === 'success') {
                    renderTimeline(data.departments);
                } else {
                    console.error("Backend error:", data.message);
                    alert(`Error: ${data.message}`);
                    timeline.innerHTML = "<p class='text-muted'>No team structure data available.</p>";
                }
            })
            .catch(error => {
                console.error('Fetch error:', error.message);
                alert('Failed to load team structure. Please try again later.');
                timeline.innerHTML = "<p class='text-muted'>Error loading team structure: " + error.message + "</p>";
            });

        function renderTimeline(departments) {
            timeline.innerHTML = "";

            if (!departments || !Array.isArray(departments) || departments.length === 0) {
                timeline.innerHTML = "<p class='text-muted'>No departments found.</p>";
                return;
            }

            departments.forEach(dept => {
                const row = document.createElement("div");
                row.className = "row timeline-row";

                const shortId = dept.id.replace("dept-", "D");
                const label = document.createElement("div");
                label.className = "label";
                label.innerText = `${dept.name}`;
                row.appendChild(label);

                const line = document.createElement("div");
                line.className = "line agreement-start";

                const docIcon = document.createElement("div");
                docIcon.className = "doc-icon";
                docIcon.innerHTML = '<i class="fas fa-file-alt"></i>';

                const agreements = Array.isArray(dept.agreements) ? dept.agreements : [];
                const tooltip = document.createElement("div");
                tooltip.className = "doc-tooltip";
                tooltip.innerHTML = agreements.length > 0 ?
                    agreements.map(agreement => {
                        const fileName = getFileName(agreement.file_path);
                        const filePath = fileName ? `${agreeMentbaseUrl}/${fileName}` : '#';
                        return `
                    <div>
                        <a href="${filePath}" target="_blank">${agreement.file_name || 'Unnamed File'}</a>
                        <br>Uploaded: ${new Date(agreement.uploaded_at).toLocaleString()}
                    </div>`;
                    }).join('') :
                    'No agreements available';
                docIcon.appendChild(tooltip);
                docIcon.addEventListener("mouseenter", () => tooltip.style.display = "block");
                docIcon.addEventListener("mouseleave", () => tooltip.style.display = "none");

                if (agreements.length > 0 && agreements[0].file_path) {
                    docIcon.addEventListener("click", () => {
                        const fileName = getFileName(agreements[0].file_path);
                        if (fileName) {
                            const filePath = `${agreeMentbaseUrl}/${fileName}`;
                            window.open(filePath, '_blank');
                        } else {
                            console.warn("Invalid file path for agreement:", agreements[0].file_path);
                        }
                    });
                }

                line.appendChild(docIcon);

                let membersArray = dept.members || [];
                if (!Array.isArray(membersArray) && typeof membersArray === 'object') {
                    membersArray = Object.values(membersArray);
                }
                if (!Array.isArray(membersArray)) {
                    console.warn(`Invalid members format for department ${dept.id}:`, membersArray);
                    membersArray = [];
                }

                const totalCircles = membersArray.length;

                membersArray.forEach((member, index) => {
                    const circle = document.createElement("div");
                    circle.className = "circle";
                    circle.dataset.memberId = member.id;
                    circle.style.backgroundImage = `url(${member.avatar || '<?= base_url() ?>assets/user-icon.png'})`;

                    const position = totalCircles <= 1 ? 50 : (index / (totalCircles - 1)) * (100 - 10) + 5;
                    circle.style.left = `${position}%`;

                    const onlineDiv = document.createElement("div");
                    onlineDiv.className = "active-status";
                    circle.appendChild(onlineDiv);

                    const nameSpan = document.createElement("span");
                    nameSpan.className = "circle-name";
                    nameSpan.innerText = `${member.name || 'Unknown'} (${member.nickname || 'N/A'})`;
                    circle.appendChild(nameSpan);

                    const tooltip = document.createElement("div");
                    tooltip.className = "tooltip";
                    tooltip.innerHTML = `<div>${member.name || 'Unknown'} (${member.email || 'N/A'})</div>`;
                    circle.appendChild(tooltip);
                    circle.addEventListener("mouseenter", () => tooltip.style.display = "block");
                    circle.addEventListener("mouseleave", () => tooltip.style.display = "none");

                    // ✅ Create <a> wrapper
                    const link = document.createElement("a");
                    link.href = "<?= base_url('company/user_preview?id=') ?>" + member.id;
                    link.target = "_blank"; // optional

                    // Circle ko link ke andar daalo
                    link.appendChild(circle);

                    // Finally append link to line
                    line.appendChild(link);
                });

                row.appendChild(line);
                timeline.appendChild(row);
            });
        }

        // Existing script for appeal and docThumb
        document.getElementById('appealYes')?.addEventListener('change', function() {
            document.getElementById('appealContent')?.classList.remove('d-none');
        });

        document.getElementById('appealNo')?.addEventListener('change', function() {
            document.getElementById('appealContent')?.classList.add('d-none');
        });

        document.getElementById('docThumb')?.addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('docModal'));
            modal.show();
        });
    });
</script>
<!-- Shiv Web Developer -->

<script>
    // TOOGLE FUNCTION FOR PRESS RELEASE
    document.getElementById("toggleFilters").addEventListener("click", function() {
        var filters = document.getElementById("filtersSection");
        if (filters.style.display === "none" || filters.style.display === "") {
            filters.style.display = "block";
        } else {
            filters.style.display = "none";
        }
    });

    // Open modal when any button is clicked
    document.querySelectorAll('.getpressreleaseedit').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            let pressId = this.getAttribute('data-press');
            console.log("Press Release ID:", pressId); // you can use this for AJAX

            // TO DO: load AJAX data here if needed

            openPressReleaseModal();
        });
    });

    // Close modal when clicking outside modal content
    window.addEventListener('click', function(e) {
        const modal = document.getElementById('pressreleasetionModel');
        if (e.target === modal) {
            closePressReleaseModal();
        }
    });

    $(".getpressreleaseedit").on("click", function() {
        let id = $(this).data("press"); // get the id from data-project
        $.ajax({
            url: "<?= base_url('Home/getpressreleaseeditcompany') ?>",
            type: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // Fill the modal fields dynamically
                    $("#pressreleasetionModel textarea[name='press_release']").val(response.data.press_release);
                    $("#pressreleasetionModel input[name='id']").val(response.data.id);
                    // $("textarea[name='editordata']").val(response.data.editordata);
                    // Fill CKEditor field
                    if (CKEDITOR.instances['editor1']) {
                        CKEDITOR.instances['editor1'].setData(response.data.editordata);
                    }

                    $("#pressreleasetionModel textarea[name='press_release_tags']").val(response.data.press_release_tags);

                    // Open the modal
                    $("#pressReleaseModal").modal("show");
                } else {
                    alert("No data found for this record.");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });


    // PRESS RELEASE VIEW FUNCTIONALIY 
    function viewopenPressReleaseModal() {
        document.getElementById('viewpressreleasetionModel').style.display = 'flex';
    }

    function viewclosePressReleaseModal() {
        document.getElementById('viewpressreleasetionModel').style.display = 'none';
    }

    // Open modal when any button is clicked
    document.querySelectorAll('.viewgetpressrelease').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            let pressId = this.getAttribute('data-press-view');
            console.log("Press Release ID:", pressId); // you can use this for AJAX

            // TO DO: load AJAX data here if needed

            viewopenPressReleaseModal();
        });
    });

    // Close modal when clicking outside modal content
    window.addEventListener('click', function(e) {
        const modal = document.getElementById('viewpressreleasetionModel');
        if (e.target === modal) {
            viewclosePressReleaseModal();
        }
    });

    $(".viewgetpressrelease").on("click", function() {
        let id = $(this).data("press-view"); // Get press release ID

        $.ajax({
            url: "<?= base_url('Home/getpressreleasecompany') ?>",
            type: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // Fill the modal dynamically
                    $(".short_descriptiontitle").text('Short Description');
                    $(".press_release_view").text(response.data.press_release);
                    $(".storytime").val(response.data.storytime);


                    // If editordata contains HTML content
                    $(".editordata_view").html(response.data.editordata);

                    // Show modal
                    $("#viewpressreleasetionModel").css("display", "flex");
                } else {
                    // alert("No data found for this record.");
                    // $(".statusmsg").html(response.message);
                    $(".statusmsg").html(
                        `<p style="background-color:red; color:white; padding:0px 10px; width:300px;">
                        ${response.message}
                    </p>`
                    );
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });
    // OPEN MODEL FOR PRESS RELEASE
    // Function to open/close modal
    function openPressReleaseModal() {
        document.getElementById('pressreleasetionModel').style.display = 'flex';
    }

    function closePressReleaseModal() {
        document.getElementById('pressreleasetionModel').style.display = 'none';
    }
    
</script>

<!--CK EDITOR-->
<script src="<?= base_url('/assets/ckeditor/ckeditor.js') ?>"></script>


<!--CK EDITOR   -->
<script>
    CKEDITOR.replace('editor1');
</script>

<style>
    #cke_notifications_area_editor1 {
        display: none;
    }
</style>

<!-- Artificial Tree -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.35.4/tagify.min.js" integrity="sha512-sKkyJJpMbq+xZRQwXCksuVx5g4JuYQK7c3+65dF3CAx3Gcn67+BPC2PyJkJEugtRRAeDBLPfcsULXbEZ5iqYjg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {

        let activeTimeline = null;
        const timelineContainer = document.getElementById("timeline_container");
        const menu = document.getElementById("contextMenu");
        const menuAddUser = document.getElementById("menuAddUser");
        let treeId = $('#tree_select').val();
        let draggedUser = null;
        let selectedUser = null;
        let connectionStartUser = null;
        let connections = [];
        let activeUser = null;
        const userMenu = document.getElementById("userContextMenu");
        const menuRemoveUser = document.getElementById("menuRemoveUser");


        /* ===============================
        RENDER TIMELINES
        =============================== */
        function renderTimeLineNew(branches) {

            timelineContainer.innerHTML = '';

            const row = document.createElement("div");
            row.className = "d-flex flex-column";

            branches.forEach(branch => {

                const timeline = document.createElement("div");
                timeline.className = "my_timeline my-2 py-4";
                timeline.dataset.id = branch.id;

                const line = document.createElement("span");
                line.className = "my_timeline_line";

                // 🔥 ALWAYS create users wrapper
                const usersWrapper = document.createElement("div");
                usersWrapper.className = "timeline-users";

                timeline.appendChild(line);
                timeline.appendChild(usersWrapper);

                row.appendChild(timeline);
            });

            timelineContainer.appendChild(row);
        }


        /* ===============================
        RIGHT CLICK (EVENT DELEGATION)
        =============================== */
        document.addEventListener("contextmenu", function (e) {
            if (connectionStartUser) {
                e.preventDefault();
                return;
            }

            if (e.target.closest(".timeline-user")) return;

            const timeline = e.target.closest(".my_timeline");
            if (!timeline) return;

            e.preventDefault();
            activeTimeline = timeline;

            const wrapper = document.getElementById("timeline_wrapper");
            const rect = wrapper.getBoundingClientRect();

            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            // Prevent overflow
            const menuWidth = contextMenu.offsetWidth;
            const menuHeight = contextMenu.offsetHeight;

            let left = x;
            let top = y + 50;

            if (left + menuWidth > rect.width) {
                left = rect.width - menuWidth - 5;
            }
            if (top + menuHeight > rect.height) {
                top = rect.height - menuHeight - 5;
            }

            contextMenu.style.left = left + "px";
            contextMenu.style.top = top + "px";
            contextMenu.style.display = "block";

            userContextMenu.style.display = "none";
        });



        /* ===============================
        ADD USER (TAGIFY)
        =============================== */
        menuAddUser.addEventListener("click", function (e) {

            e.stopPropagation();

            if (!activeTimeline) return;

            // Prevent duplicate input
            if (activeTimeline.querySelector(".tagify")) return;

            const input = document.createElement("input");
            input.placeholder = "Add users...";
            input.className = "user-input";

            activeTimeline.appendChild(input);

            initTagify(input, activeTimeline.dataset.id);

            menu.style.display = "none";
        });

        /* ===============================
        INIT TAGIFY WITH DB SEARCH
        =============================== */
        function initTagify(inputElm, timelineId) {

            const tagify = new Tagify(inputElm, {
                tagTextProp: "name",
                enforceWhitelist: true,
                skipInvalid: true,
                dropdown: {
                    enabled: 1,
                    searchKeys: ["name", "email"]
                },
                whitelist: [],
                templates: {
                    dropdownItem: suggestionItemTemplate,
                }
            });

            // 🔍 Search users from DB
            tagify.on("input", function (e) {
                const value = e.detail.value.trim();
                if (!value) return;

                tagify.loading(true);

                fetch("<?= base_url('Home/searchUsersNew') ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ search: value })
                })
                .then(res => res.json())
                .then(res => {
                    tagify.loading(false);

                    if (!res.success || !Array.isArray(res.users)) {
                        tagify.settings.whitelist = [];
                        return;
                    }

                    const safeUsers = res.users
                        .filter(u => u && u.name) // ✅ REMOVE BAD DATA
                        .map(u => ({
                            value: String(u.value),   // must be string
                            name: String(u.name),     // must be string
                            email: u.email || '',
                            avatar: u.avatar || ''
                        }));

                    tagify.settings.whitelist = safeUsers;

                    if (safeUsers.length) {
                        if (value && safeUsers.length) {
                            tagify.dropdown.show(value);
                        }
                    }

                });
            });

            // ➕ Save user to timeline
            tagify.on("add", function (e) {
                saveUserToTimeline(timelineId, e.detail.data, function (status, json) {
                    // console.log('status:', status);
                    if (status === 'success') {
                        // ✅ 1. Render user immediately
                        renderUserOnTimeline(json.user, timelineId);

                        // ✅ 2. Destroy Tagify instance
                        tagify.destroy();

                        // ✅ 3. Remove input from DOM
                        inputElm.remove();

                    }else if(status === 'duplicate') {
                        $('#duplicate_user_alert').text('⚠️ This user is already added to the timeline.')
                            .removeClass('d-none')
                            .fadeIn();


                        // ✅ 2. Destroy Tagify instance
                        tagify.destroy();

                        // ✅ 3. Remove input from DOM
                        inputElm.remove()

                        // ✅ 4. Auto hide alert after 3 seconds (optional)
                        setTimeout(() => {
                            $('#duplicate_user_alert').fadeOut();
                        }, 4000);
                    }
                });
            });

        }

        /* ===============================
        SAVE USER ↔ TIMELINE
        =============================== */
        function saveUserToTimeline(timelineId, user, callback) {
            $.ajax({
                url: "<?= base_url('Home/add_user_to_timeline') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    "tree_id" : treeId,
                    "timeline_id" : timelineId,
                    "user_id" : user.value
                },
                success: (json)=>{
                    callback(json.status, json);
                },
                error: (e)=>{
                    callback(false, null);
                }
            })
        }

        /* ===============================
        RENDER USER ON TIMELINE
        =============================== */

        function renderUserOnTimeline(user, timelineId) {

            const timeline = document.querySelector(
                `.my_timeline[data-id="${timelineId}"]`
            );
            if (!timeline) return;

            const usersWrapper = timeline.querySelector(".timeline-users");
            if (!usersWrapper) return;

            const div = document.createElement("div");
            div.className = "timeline-user";
            div.draggable = true;
            div.dataset.userId = user.id || user.user_id;
            div.dataset.timelineId = timelineId;
            // console.log('user.id', user.id);
            
            div.innerHTML = `
            <a href="<?= base_url('company/user_preview?id=') ?>${user.id}">
                <img src="${user.user_image 
                    ? "<?= base_url('uploads/user_profile/') ?>" + user.user_image 
                    : "<?= base_url('uploads/user_profile/user.png') ?>"}"
                    class="user-avatar">
                <span>${user.name ? user.name : user.email}</span>
            </a>
            `;

            usersWrapper.appendChild(div);
        }
        
        document.addEventListener("click", function (e) {

            if (!connectionStartUser) return;

            const link = e.target.closest("a");
            if (!link) return;

            // Only block anchor navigation during connection mode
            e.preventDefault();

        }, true); // capture phase


        /* ===============================
        CLOSE MENU
        =============================== */
        document.addEventListener("click", function () {
            menu.style.display = "none";
        });

        function suggestionItemTemplate(tagData) {
            return `
            <div ${this.getAttributes(tagData)}
                class="tagify__dropdown__item d-flex align-items-center"
                tabindex="0"
                role="option">

                ${tagData.avatar ? `
                <div class="tagify__dropdown__item__avatar-wrap me-2">
                    <img class="rounded-circle"
                        src="${tagData.avatar}"
                        style="width:28px;height:28px"
                        onerror="this.style.display='none'">
                </div>` : ''}

                <div>
                    <div class="fw-bold">${tagData.name || 'Unknown User'}</div>
                    <small class="text-muted">${tagData.email || ''}</small>
                </div>
            </div>
            `;
        }
        
        function renderUsersOnTimelines(users) {

            users.forEach(user => {
                renderUserOnTimeline(user, user.timeline_id);
            });
        }


        $('#tree_select').on('change', function () {

            resetConnectionMode();

            treeId = $(this).val(); // 🔥 update global treeId

            connections = [];

            // 2. 🔥 CLEAR OLD SVG LINES (DOM)
            document.getElementById("connectionLayer").innerHTML = '';

            if (!treeId) {
                timelineContainer.innerText = 'No Tree Selected';
                return;
            }
            
            $.ajax({
                url: '<?= base_url('home/get_branches')?>',
                type: 'POST',
                datatype: 'json',
                data:{
                    tree_id: treeId
                },
                success: (res)=>{
                    json = JSON.parse(res);
                    renderTimeLineNew(json.branches);
                    renderUsersOnTimelines(json.users);
                    loadConnections(treeId)
                },
                error: (e)=>{
                    console.log(e);

                }

            })
        })

        $('#tree_select').trigger('change');

        document.addEventListener("contextmenu", function (e) {

            // Disable menu if connecting users
            if (connectionStartUser) {
                e.preventDefault();
                return;
            }

            const userEl = e.target.closest(".timeline-user");
            if (!userEl) return;

            e.preventDefault();
            e.stopPropagation();

            activeUser = userEl;

            const wrapper = document.getElementById("timeline_wrapper");
            const rect = wrapper.getBoundingClientRect();

            // Mouse position relative to wrapper
            let x = e.clientX - rect.left;
            let y = e.clientY - rect.top;

            // Prevent overflow
            const menuWidth = userMenu.offsetWidth;
            const menuHeight = userMenu.offsetHeight;

            if (x + menuWidth > rect.width) {
                x = rect.width - menuWidth - 5;
            }

            if (y + menuHeight > rect.height) {
                y = rect.height - menuHeight - 5;
            }

            userMenu.style.position = "absolute";
            userMenu.style.left = x + "px";
            userMenu.style.top = y + "px";
            userMenu.style.display = "block";
        });


        menuRemoveUser.addEventListener("click", function () {

            if (!activeUser) return;

            const userId = activeUser.dataset.userId;
            const timelineId = activeUser.dataset.timelineId;

            if (!confirm("Are you sure you want to remove this user?")) {
                return;
            }

            $.ajax({
                url: "<?= base_url('Home/remove_user_from_timeline') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    tree_id: treeId,
                    timeline_id: timelineId,
                    user_id: userId
                },
                success: function (res) {

                    if (res.status === 'success') {
                        activeUser.remove(); // 🔥 UI update
                    }
                }
            });

            userMenu.style.display = "none";
        });

        document.addEventListener("click", function () {
            userMenu.style.display = "none";
        });

        document.addEventListener("dragstart", function (e) {

            const user = e.target.closest(".timeline-user");
            if (!user) return;

            draggedUser = user;
            e.dataTransfer.effectAllowed = "move";
            user.classList.add("dragging");
        });

        document.addEventListener("dragend", function (e) {
            if (draggedUser) {
                draggedUser.classList.remove("dragging");
                requestAnimationFrame(() => {
                    updateAllLines();
                });
                draggedUser = null;
            }
        });

        function updateLinesForUser(userEl) {
            // Loop through all existing connections
            connections.forEach(conn => {
                // If this connection involves the moved user, update coordinates
                if (conn.from === userEl || conn.to === userEl) {
                    updateLinePosition(conn);
                }
            });
        }

        document.addEventListener("dragover", function (e) {

            const usersWrapper = e.target.closest(".timeline-users");
            if (!usersWrapper) return;

            e.preventDefault();

            if (draggedUser) {
                updateLinesForUser(draggedUser);
            }
        });

        document.addEventListener("drop", function (e) {

            const usersWrapper = e.target.closest(".timeline-users");
            if (!usersWrapper || !draggedUser) return;

            e.preventDefault();

            const timeline = usersWrapper.closest(".my_timeline");
            if (!timeline) return;

            const oldTimelineId = draggedUser.dataset.timelineId;
            const newTimelineId = timeline.dataset.id;

            // 🔥 Append to wrapper (move user)
            usersWrapper.appendChild(draggedUser);

            // 🔥 Update dataset
            draggedUser.dataset.timelineId = newTimelineId;

            requestAnimationFrame(() => {
                updateAllLines(); // Better than just updating the single user
            });

            // 🔥 Save change in DB
            updateUserTimeline(
                draggedUser.dataset.userId,
                oldTimelineId,
                newTimelineId
            );
        });

        function updateUserTimeline(userId, oldTimelineId, newTimelineId) {

            $.ajax({
                url: "<?= base_url('Home/update_user_timeline') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    tree_id: treeId,
                    user_id: userId,
                    from_timeline: oldTimelineId,
                    to_timeline: newTimelineId
                },
                success: function (res) {
                    console.log("User moved");
                }
            });
        }
        
        const menuAddConnection = document.getElementById("menuAddConnection");

        menuAddConnection.addEventListener("click", function (e) {

            e.stopPropagation();

            if (!activeUser) return;

            connectionStartUser = activeUser;

            activeUser.classList.add("connection-source");

            userMenu.style.display = "none";
            menu.style.display = "none";

            // alert("Now click on another user to connect");
        });
        
        document.addEventListener("click", function (e) {

            // If we are NOT in connection mode, do nothing
            if (!connectionStartUser) return;

            const targetUser = e.target.closest(".timeline-user");

            // If clicked on empty space (and not the menu), cancel mode
            if (!targetUser) {
                // We add a small check to ensure we didn't just click the menu 
                // (Double safety, though e.stopPropagation in step 1 handles this)
                if(!e.target.closest('#menuAddConnection')){
                    console.log("Clicked outside, resetting mode");
                    resetConnectionMode();
                }
                return;
            }

            e.preventDefault();
            e.stopPropagation();

            // Prevent connecting to self
            if (targetUser === connectionStartUser) {
                console.log("Cannot connect to self");
                resetConnectionMode();
                return;
            }

            // 🔥 Create connection
            createConnection(connectionStartUser, targetUser);

            resetConnectionMode();
        });


        
        function createConnection(userA, userB) {

            if (connectionExists(userA, userB)) return;

            const svg = document.getElementById("connectionLayer");

            const line = document.createElementNS("http://www.w3.org/2000/svg", "line");

            line.setAttribute("stroke", "#0d6efd");
            line.setAttribute("stroke-width", "2");
            line.setAttribute("data-from", userA.dataset.userId);
            line.setAttribute("data-to", userB.dataset.userId);

            svg.appendChild(line);

            const connection = { from: userA, to: userB, line };
            connections.push(connection);

            updateLinePosition(connection);

            // 🔥 Save to DB (optional)
            saveConnection(userA.dataset.userId, userB.dataset.userId);
        }
        
        function updateLinePosition(connection) {
            // 🔥 FIX: Select the image specifically, not the whole div
            const imgA = connection.from.querySelector('.user-avatar');
            const imgB = connection.to.querySelector('.user-avatar');

            // Get rect of the Image (if image is missing, fall back to the div)
            const rectA = (imgA || connection.from).getBoundingClientRect();
            const rectB = (imgB || connection.to).getBoundingClientRect();
            
            const svgRect = document.getElementById("connectionLayer").getBoundingClientRect();

            // Calculate center based on the IMAGE dimensions
            const x1 = rectA.left + rectA.width / 2 - svgRect.left;
            const y1 = rectA.top + rectA.height / 2 - svgRect.top;

            const x2 = rectB.left + rectB.width / 2 - svgRect.left;
            const y2 = rectB.top + rectB.height / 2 - svgRect.top;

            connection.line.setAttribute("x1", x1);
            connection.line.setAttribute("y1", y1);
            connection.line.setAttribute("x2", x2);
            connection.line.setAttribute("y2", y2);
        }

        function saveConnection(fromUser, toUser) {
            $.post("<?= base_url('Home/save_connection') ?>", {
                tree_id: treeId,
                from_user: fromUser,
                to_user: toUser
            });
        }

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape" && connectionStartUser) {
                connectionStartUser.classList.remove("connection-source");
                connectionStartUser = null;
            }
        });

        function resetConnectionMode() {
            if (connectionStartUser) {
                connectionStartUser.classList.remove("connection-source");
                connectionStartUser = null;
            }
        }

        function loadConnections(treeId) {
            $.get("<?= base_url('Home/get_connections') ?>", { tree_id: treeId }, function (res) {
                // Ensure res is an object if jQuery didn't parse it automatically
                if (typeof res === 'string') res = JSON.parse(res); 

                if (!res.success) return;

                res.connections.forEach(conn => {
                    // 🔥 Select by the attribute directly to be safe
                    const userA = document.querySelector(
                        `.timeline-user[data-user-id="${conn.from_user}"]`
                    );
                    const userB = document.querySelector(
                        `.timeline-user[data-user-id="${conn.to_user}"]`
                    );

                    // Debugging check
                    // console.log(`Connecting ${conn.from_user} to ${conn.to_user}`, userA, userB);

                    if (userA && userB) {
                        createConnection(userA, userB);
                    }
                });
            }, "json");
        }
        
        function connectionExists(a, b) {
            return connections.some(c =>
                (c.from === a && c.to === b) ||
                (c.from === b && c.to === a)
            );
        }

        function updateAllLines() {
            connections.forEach(conn => {
                updateLinePosition(conn);
            });
        }
        

        function updateAllConnections() {
            connections.forEach(connection => {
                updateLinePosition(connection);
            });
        }

        const artificialFamilyTab = document.getElementById('view-artificial-family-tab');

        artificialFamilyTab.addEventListener('shown.bs.tab', function (event) {
            console.log('Artificial Family tab activated');

            // 🔥 Run ONLY for this tab
            updateAllConnections();
        });
    });

</script>

<script>
    press_release_date = document.getElementById('date_filter_press_release');
    press_release_container = document.getElementById('press_release_container');
    let text_search_press_release = document.getElementById('text_search_press_release');
    const press_release_search_btn = document.getElementById('press_release_search_btn');

    press_release_date.addEventListener('change', async function () {
        let selected_date = this.value;
        let press_release_data = {};

        if(selected_date !== '' && selected_date !== null) {
            press_release_res = await get_press_realease_date_wise(selected_date)                                                                    
            // console.log(press_release_data)
            if(press_release_res.success){
                let { data } = press_release_res;
                render_press_release(data);
            }
        }else{
            press_release_container.innerHTML = '';
            press_release_res = await get_press_release()                                                                    
            // console.log(press_release_data)
            if(press_release_res.success){
                let { data } = press_release_res;
                render_press_release(data);
            }
        }
    })
    
    press_release_search_btn.addEventListener('click', async function () {
        const searchValue = text_search_press_release.value.trim();
        const isContextAI = context_ai_switch.checked;
        
        if (!searchValue) {
            console.log('Empty search, ignoring');
            return;
        }

        try {
            console.log('Searching for:', searchValue, 'Context AI:', isContextAI);

            press_release_search_btn.disabled = true;

            const press_release_res = await get_press_release(searchValue, isContextAI);

            press_release_search_btn.disabled = false;

            if (press_release_res.success) {
                const { data } = press_release_res;
                render_press_release(data);
            } else {
                render_press_release([]); // optional: clear UI
            }

        } catch (err) {
            console.error('Search failed:', err);
        }
    });
    
    async function get_press_realease_date_wise(selected_date) {
        let project_id = "<?= $company_id ?>";
        let type = "company";

        // console.log(selected_date);
        // console.log(project_id);
        // console.log(type);
       
       let res = await fetch("<?= base_url("Home/get_press_release_date_wise") ?>", {
          method: 'POST',
          body: JSON.stringify({
              'type_id' : project_id,
              type,
              selected_date
          })
       })

       let json = await res.json();
       return json;
    }

    async function get_press_release(searchValue = null, contextAI = false){
        let type_id = "<?= $company_id ?>";
        let type = "company";
        
        const payload = { type, type_id };

        if (searchValue && searchValue.trim() !== "") {
            payload.searchValue = searchValue.trim();
        }
        
        if (contextAI) {
            payload.context_ai = 1;
        }

        // console.log(selected_date);
        // console.log(project_id);
        // console.log(type);
       
       let res = await fetch("<?= base_url("Home/get_press_release_date_wise") ?>", {
          method: 'POST',
          body: JSON.stringify(payload)
       })

       let json = await res.json();
       return json;
    }

    function render_press_release(data) {
        press_release_container.innerHTML = '';

        data.forEach((press_release)=>{
            let html = `

                <div class="d-flex justify-content-between"> ${press_release['uniq_id']}
                    <span class="datetime"> ${press_release['created_date']} </span>
                </div>
                <p>
                    ${press_release['press_release']}
                </p>

                <span class="px-3 py-0 mx-3 viewgetpressrelease" style="width:5px; height:20px; cursor: pointer;"
                    data-press-view=" ${press_release['id']}"> 👁️ </span>

                <a href="<?= base_url("company/press-release/$release[id]") ?>">👁️</a>

                <a class="text-danger mx-3" title="Remove Member" href="<?= base_url('Home/deletePressRelease?id=') ?>${press_release['id']}" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></a>

            `;
            let press_release_showcase = document.createElement('div');
            press_release_showcase.classList.add('press_release_showcase');
            press_release_showcase.innerHTML = html;
            press_release_container.appendChild(press_release_showcase)
        })
    }
</script>

<script>
  const press_release_tag_container = document.getElementById('press_release_tag_container');
  const press_release_edit_container = document.getElementById('press_release_edit_container');
  const toggle_press_release_tag_container = document.getElementById('toggle_press_release_tag_container');

  toggle_press_release_tag_container.addEventListener('click', function () {
    const isHidden = press_release_tag_container.classList.contains('d-none');

    // toggle sidebar
    press_release_tag_container.classList.toggle('d-none');

    // toggle editor width
    press_release_edit_container.classList.toggle('col-11', !isHidden);
    press_release_edit_container.classList.toggle('col-8', isHidden);
  });
</script>