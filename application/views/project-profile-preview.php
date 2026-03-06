  <link
      rel="stylesheet"
      href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

  <!-- ✅ Include jQuery + DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>



  <style>
      .project-row {
          display: grid;
          grid-template-columns: 30px 1fr 1fr 1fr 1fr 50px;
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

      .project-grid-bottom-1 {
          grid-template-columns: 30px repeat(4, 1fr);
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

      /* Modal Styles */
      .team-members-modal .modal-dialog {
          max-width: 90vw;
          /* Use 90% of viewport width for a very large modal */
          width: 1200px;
          /* Fixed width for consistency, adjustable */
      }

      .team-members-modal .modal-content {
          border-radius: 8px;
      }

      .team-members-modal .modal-header {
          background-color: #f8f9fa;
          border-bottom: 1px solid #dee2e6;
      }

      .team-members-modal .modal-body {
          padding: 20px;
          max-height: 80vh;
          /* Limit height to 80% of viewport height */
          overflow-y: auto;
          /* Enable vertical scrolling if content overflows */
      }

      .team-members-modal .team-member-card {
          min-width: 300px;
          /* Ensure cards don't shrink too much */
      }

      .team-members-modal .timeline-container {
          min-height: 200px;
          /* Ensure timeline has enough space */
      }
  </style>

  <?php include('includes/header.php') ?>


  <style>
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

      .custom-table {
          width: 100%;
          border-collapse: collapse;
          margin-top: 10px;
      }

      .custom-table th,
      .custom-table td {
          padding: 10px;
          border: 1px solid #ddd;
      }

      .table-input {
          width: 100%;
          padding: 6px 8px;
          border-radius: 4px;
          border: 1px solid #ccc;
          font-size: 0.95rem;
      }

      .save-btn {
          background: #007bff;
          color: #fff;
          border: none;
          padding: 8px 16px;
          border-radius: 4px;
          cursor: pointer;
      }

      .save-btn:hover {
          background-color: #0056b3;
      }

      #charCount {
          font-size: 0.9em;
          color: gray;
      }

      #charCount.warning {
          color: red;
      }

      .formMsg {
          position: static !important;
          transform: inherit !important;
      }

      /* @ Shiv Web Developer  */

      .UserProfileTable table {
          position: static !important;
          top: auto !important;
          left: auto !important;
          transform: none !important;
          width: 100% !important;
          height: auto !important;
      }
  </style>

  <style>
      .project-row {
          display: grid;
          grid-template-columns: 30px 1fr 1fr 1fr 1fr 50px;
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
          font-size: 16px;
          color: #00a7cc;
      }

      .project-grid-bottom-1 {
          grid-template-columns: 30px repeat(4, 1fr);
      }
  </style>

  <style>
      .assigned-section {
          padding: 20px;
          background: #fff;
          border-radius: 8px;
      }

      .assigned-boxes {
          display: flex;
          justify-content: space-around;
          flex-wrap: wrap;
      }

      .box {
          padding: 15px;
          margin: 10px;
          background: #f1f1f1;
          border-radius: 5px;
          min-width: 150px;
      }
      .project-row-one {
		position: relative;
		display: grid;
		grid-template-columns: auto 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		/* border-radius: 4px; */
		color: #00a7cc;
		font-weight: 600;
		border-bottom: 0;
	}

	.project-row-two {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		/* border-radius: 4px; */
		color: #00a7cc;
		font-weight: 600;
		border-bottom: 0;
	}

	.project-row-three {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		/* border-radius: 4px; */
		color: #00a7cc;
		font-weight: 600;
		border-bottom: 0;
	}

	.project-row-four {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		color: #00a7cc;
		font-weight: 600;
	}

	.project-row-five {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		color: #00a7cc;
		font-weight: 600;
	}
	.project-row-six {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		color: #00a7cc;
		font-weight: 600;
	}
  </style>

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


  <!-- Shiv Web Developer  -->

  <div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
      <?php
        if ($this->session->has_userdata('projectMsg')) {
            echo $this->session->userdata('projectMsg');
            $this->session->unset_userdata('projectMsg');
        }
        ?>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
      <div class="card border-0">
          <div class="card-body p-md-4">
              <div class="container max-width-1470 d-flex gap-3 mt-md-3 align-items-start">
                  <div class="w-100" style="border-right: 1px solid #e0e0e0; padding-right: 10px;">
                      <div class="d-flex justify-content-between align-items-center mb-4">
                          <h4 class="mb-0">Project Details</h4>
                          <div class="d-flex align-items-center">
                              <a href="<?= base_url('company/edit-project?id=' . $getProject['id']) ?>" class="btn btn-warning me-2">
                                  <i class="bi bi-pencil"></i> Edit
                              </a>
                              <a href="<?= base_url('company/project-trash?id=' . $getProject['id']) ?>" title="Delete Project" class="text-danger btn btn-danger me-2" onclick="return confirm('Are you sure you want to delete this project?');">
                                  <i class="bi bi-trash text-white"></i>
                              </a>
                              <a href="<?= base_url("company/project-team-members?id=$getProject[id]") ?>" class="btn btn-dark me-2" id="temmembersBtnWrapper" >
                                  <i class="bi bi-person-plus me-1"></i> Team Members
                              </a>
                              <a href="#" class="btn btn-success me-2">
                                  <i class="bi bi-person-plus me-1"></i> Follow
                              </a>
                              <a href="<?= base_url('/company/download-project-pdf?id=' . $getProject['id']) ?>" class="btn btn-primary me-2">
                                  <i class="bi bi-download me-1"></i> Download Now
                              </a>

                          </div>
                      </div>

                      <div class="row mb-3">
                          <div class="col-md-4">
                              <?php
                                $getCompany = @$this->CommonModal->getSingleRowById('companies', 'id = ' . $getProject['company_id']);
                                $getProjectCount = $this->CommonModal->getNumRows('projects', ['company_id' => $getProject['company_id']]);
                                ?>
                              <span class="label-project-preview">Project Name:</span>
                              <span class="value"><?= $getProject['project_name'] ?></span>
                          </div>
                          <div class="col-md-4">
                              <span class="label-project-preview">Project Leader:</span>
                              <span class="value"><?= $getProject['project_leader'] ?></span>
                          </div>
                          <div class="col-md-4">
                              <span class="label-project-preview">Total Expected Team:</span>
                              <span class="value"><?= $getProject['team_range_from'] . ' - ' . $getProject['team_range_to'] ?> Members</span>
                          </div>
                      </div>

                      <div class="row mb-3">
                          <div class="col-md-4">
                              <span class="label-project-preview">Total Number of Layers:</span>
                              <span class="value"><?= $getProject['layer_range_from'] . ' - ' . $getProject['layer_range_to'] ?> Layers</span>
                          </div>
                          <div class="col-md-4">
                              <span class="label-project-preview">Project Valuation:</span>
                              <span class="value"><?= $getProject['project_valuation'] ?></span>
                          </div>
                          <div class="col-md-4">
                              <span class="label-project-preview">Issued Shares:</span>
                              <span class="value"><?= $getProject['issued_shares'] ?></span>
                          </div>
                      </div>

                      <div class="row mb-3">
                          <div class="col-md-4">
                              <span class="label-project-preview">Face Value:</span>
                              <span class="value"><?= $getProject['face_value'] ?> per share</span>
                          </div>
                          <div class="col-md-4">
                              <span class="label-project-preview">Project Document / Policies:</span>
                              <span class="value"><a href="<?= base_url('Uploads/project_docs/') ?><?= $getProject['project_document'] ?>">Download PDF</a></span>
                          </div>
                          <div class="col-md-4">
                              <span class="label-project-preview">Upload Your Pitch Deck:</span>
                              <span class="value"><a href="<?= base_url('Uploads/project_docs/') ?><?= $getProject['project_pitch'] ?>">Download PDF</a></span>
                          </div>
                      </div>

                      <div class="row mb-3">
                          <div class="col-md-4">
                              <span class="label-project-preview">TAM:</span>
                              <span class="value"><?= $getProject['tam'] ?></span>
                          </div>
                          <div class="col-md-4">
                              <span class="label-project-preview">SAM:</span>
                              <span class="value"><?= $getProject['sam'] ?></span>
                          </div>
                          <div class="col-md-4">
                              <span class="label-project-preview">SOM:</span>
                              <span class="value"><?= $getProject['som'] ?></span>
                          </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-4">
                              <span class="label-project-preview">Money Invested:</span>
                              <span class="value"><?= $getProject['money_invested'] ?></span>
                          </div>
                          <div class="col-md-4">
                            <span class="label-project-preview">Physical World Scale:</span>
                            <span class="value">
                                <?php if(!empty($getProject['physical_scale'])) :?>
                                    10<sup><?= $getProject['physical_scale'] ?></sup>
                                <?php else:?>
                                    <span>NA</span>
                                <?php endif; ?>
                            </span>
                          </div>
                          <div class="col-md-4">
                                <span class="label-project-preview">Project Start Date: </span>
                                <span class="value"><?= $getProject['project_start_date'] ? date('d/m/Y', strtotime($getProject['project_start_date'])) : '' ?></span>
                            </div>
                      </div>
                      <!-- ADDED VALUATION SHOWCASE FUNCTIONALITY  -->

                      <?php
                        $totalValuation = $this->db->select_sum('addedValuation')
                            ->where('project_id', $getProject['id'])
                            ->where('user_id', sessionId('freelancer_id'))
                            ->get('tbl_addedvaluation')
                            ->row()
                            ->addedValuation;

                        // count distinct brick_id
                        $totalBricks = $this->db->select('COUNT(DISTINCT brick_id) as total_bricks')
                            ->where('project_id', $getProject['id'])
                            ->where('user_id', sessionId('freelancer_id'))
                            ->get('tbl_addedvaluation')
                            ->row()
                            ->total_bricks;
                        ?>


                      <div class="mb-3">
                          <div class="d-flex" style="gap: 63px;">
                              <strong>
                                  Added Valuation: Rs. <?= $totalValuation ?> /-
                              </strong>
                              <a href="<?= base_url("company/project-added-valuation?id=$project_id") ?>" class="btn btn-primary px-3 py-0 mx-3" id="getvaluationbyproject"> View Details </a>
                              Total Bricks - <?= $totalBricks ?>
                          </div>
                      </div>

                     <div class="mb-3">
                        <div class="d-flex" style="gap: 186px;">
                            <strong class="">Financial Years:</strong>
                            <a href="<?= base_url("company/project-financial-year-reports?id=$project_id") ?>" class="btn btn-primary px-3 py-0 mx-3 d-inline-block">
                                View Report
                            </a>
                        </div>
                     </div>

                    <div class="mb-3">
                        <div class="d-flex" style="gap: 79px;">
                            <strong class="">Cashflow Projection Booking:</strong>
                        <a href="<?= base_url("company/project-cashflow-projection-booking?id=$project_id") ?>" class="btn btn-primary px-3 py-0 mx-3 d-inline-block">
                            View Details
                        </a>
                        </div>
                     </div>
                    <div class="mb-3">
                        <div class="d-flex" style="gap: 169px;">
                            <strong class="">Bid Over Booking:</strong>
                        <a href="<?= base_url("company/project-bid-over-booking?id=$project_id") ?>" class="btn btn-primary px-3 py-0 mx-3 d-inline-block">
                            View Details
                        </a>
                        </div>
                     </div>
                      <div class="mb-3">
                          <strong>Elevator Pitch: </strong>
                          <div><?= $getProject['project_overview'] ?></div>
                      </div>

                      <div class="mb-3">
                          <strong>Mission:</strong>
                          <div><?= $getProject['mission'] ?></div>
                      </div>

                      <div class="mb-3">
                          <strong>Vision:</strong>
                          <div><?= $getProject['vision'] ?></div>
                      </div>

                      <div class="row g-0">
                          <p>
                              This project is under <b><?= @$getCompany['company_name'] ?></b> company founded in <b><?= convertDatedmy($getCompany['founded_year']) ?></b> year. <b><?= @$getCompany['company_name'] ?></b> has <b><?= @$getProjectCount ?></b> numbers of projects Active on their Portal.
                          </p>
                          <p>
                              This Project is started on <b><?= convertDatedmy($getProject['created_at']) ?></b> year with <b><?= $getProject['project_valuation'] ?> project valuation</b> currently project is at <b><?= $getProject['current_price'] ?></b> valuation with total ABC Bricks. This project unique is <?=  generateProjectId($getProject['id']) ?>.
                              Would you like to see brick be out.
                          </p>

                          <?php
                            $brickTypes = [
                                0 => 'Silver',
                                1 => 'Golden',
                                2 => 'Platinum',
                                3 => 'Titanium',
                                4 => 'Vibranium',
                            ];
                            $brickCounts = array_fill_keys(array_keys($brickTypes), 0);
                            if (!empty($getProject['id'])) {
                                $aProjectId = $getProject['id'];
                                $result = $this->CommonModal->runQuery("SELECT brick_type, COUNT(*) AS brick_count FROM tbl_bricks WHERE project_id = '" . $aProjectId . "' GROUP BY brick_type");
                                foreach ($result as $row) {
                                    $brickCounts[$row['brick_type']] = $row['brick_count'];
                                }
                            }
                            ?>

                          <div class="row">
                              <div class="col-md-6 box">
                                  <?php foreach ($brickTypes as $type) : ?>
                                      <div class="p-2 border rounded text-center fw-bold"><?= $type ?> Brick</div>
                                  <?php endforeach; ?>
                              </div>
                              <div class="col-md-6 box">
                                  <?php foreach ($brickTypes as $key => $type) : ?>
                                      <div class="p-2 border rounded text-center text-muted"><?= $brickCounts[$key] ?></div>
                                  <?php endforeach; ?>
                              </div>
                          </div>

                          <div class="col-md-12 d-flex justify-content-center align-items-center flex-wrap gap-0 mt-md-3 mb-md-3">
                              <button id="viewCompaniesBtn" type="button" class="btn btn-primary">View All Bricks</button>
                              <input type="text" class="form-control form-control-sm w-auto" placeholder="Search...">
                              <button class="btn  btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#filterModal">
                                  <i class="fa fa-filter me-1"></i> Filter Box
                              </button>
                              <div class="text-center mx-2" style="float:right;">
                                  <a href="<?= base_url('/company/create-brick') ?>" style="float:right; width:auto;" class="btn btn-primary text-center py-2 px-3"> Create Brick </a>
                              </div>
                          </div>

                          <div class="col-md-12 d-flex justify-content-center align-items-center flex-wrap gap-0 mt-md-3 mb-md-3">

                              <style>
                                  .bg-artificialbrick {
                                      background-color: silver;
                                      color: black !important;
                                  }

                                  .bg-artificialbrickartificial {
                                      background-color: #ebe306ff;
                                      /* font-weight: 700; */
                                      color: black !important;
                                  }

                                  .bg-markascompleted {
                                      background-color: #ff6501;
                                  }
                              </style>

                              <div id="companyList" style="display: none; width:100% !important;">

                                  <div class="listformate">
                                      <hr>
                                      <button type="button" class="btn bg-primary mx-1 text-white" id="listFormate"> List Formate </button>
                                      <button type="button" class="btn bg-primary mx-1 text-white" id="tableFormate"> Table Formate </button>
                                      <hr>
                                  </div>

                                  <!-- ✅ Include DataTables CSS -->

                                  <div class="table-responsive" style="width:100% !important; height: 700px; display: none;" id="tableFormateview">
                                      <table id="DataTable" class="display table table-bordered" style="width:100%; height: 700px; padding-left:25%;">
                                          <thead>
                                              <tr>
                                                  <th>#</th>
                                                  <th>Brick Title</th>
                                                  <th>Company</th>
                                                  <th>Project</th>
                                                  <th>Type</th>
                                                  <th>Status</th>
                                                  <th>Reward</th>
                                                  <th>Fund Required</th>
                                                  <th>Privacy</th>
                                                  <th>Brick ID</th>
                                                  <th>Date</th>
                                                  <th>Artificial Date</th>
                                                  <th>Action</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php
                                                if (!empty($getBricks)) {
                                                    $brickCount = 1;
                                                    foreach ($getBricks as $bricks) {
                                                        $brickFunding = $this->CommonModal->getSingleRowById('tbl_brick_funding', 'brick_id = ' . $bricks['id']);
                                                            ?>
                                                      <tr style="border-left: 4px solid <?= brickColor($bricks['brick_type']) ?>">
                                                          <td><?= $brickCount++ ?></td>
                                                          <td><?= $bricks['brick_title'] ?></td>
                                                          <td><?= companyName($bricks['company_id']) ?></td>
                                                          <td><?= projectName($bricks['project_id']) ?></td>
                                                          <td><?= brickType($bricks['brick_type']) ?></td>

                                                          <td>
                                                              <span class=" 
                                                                    <?php
                                                                    if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] == NULL) {
                                                                        echo 'bg-markascompleted';
                                                                    } else if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] != NULL) {
                                                                        echo 'bg-artificialbrickartificial';
                                                                    } else if ($bricks['artificialdate'] != NULL) {
                                                                        echo 'bg-artificialbrick';
                                                                    } else { ?>
                                                                                bg-<?= ($bricks['brick_status'] == 'draft' ? 'warning' : 'success') ?> text-white 
                                                                            <?php } ?>  
                                                                            text-white text-capitalize px-2 py-1 rounded-1 d-inline-block">

                                                                  <?php
                                                                    if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] == NULL) {
                                                                        echo 'Completed';
                                                                    } else if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] != NULL) {
                                                                        echo 'Artificial Brick - Completed';
                                                                    } else if ($bricks['artificialdate'] != NULL) {
                                                                        echo 'Artificial Brick ';
                                                                        echo ($bricks['brick_status'] == 'draft' ? 'Draft' : ' - Live');
                                                                    } else {
                                                                        echo ($bricks['brick_status'] == 'draft' ? 'Draft' : 'Live');
                                                                    }
                                                                    ?>
                                                              </span>
                                                          </td>



                                                          <td><?= $bricks['reward_disclosed'] ?></td>
                                                          <td><?= $brickFunding['fund_required'] ?></td>
                                                          <td class="text-capitalize"><?= $bricks['brick_privacy'] ?></td>
                                                          <td><?= generateBrickId($bricks['id']) ?></td>
                                                          <td><?= $bricks['create_date'] ?></td>
                                                          <td><?= ($bricks['artificialdate'] != NULL) ? $bricks['artificialdate'] : '...' ?></td>

                                                          <td class="text-center" style="white-space: nowrap;">
                                                              <a href="<?= base_url('company/preview_brick?id=' . $bricks['id']) ?>" title="View Details">
                                                                  <i class="bi bi-eye-fill eye-icon"></i>
                                                              </a>
                                                              <?php if ($bricks['user_id'] == sessionId('freelancer_id')) { ?>
                                                                  <a href="<?= base_url('company/create-brick?id=' . $bricks['id']) ?>" title="Edit Details">
                                                                      <i class="bi bi-pencil text-primary"></i>
                                                                  </a>
                                                                  <a href="<?= base_url('company/brick-trash?id=' . $bricks['id']) ?>"
                                                                      title="Delete Company"
                                                                      class="text-danger"
                                                                      onclick="return confirm('Are you sure you want to delete this brick?');">
                                                                      <i class="bi bi-trash"></i>
                                                                  </a>
                                                              <?php } ?>
                                                          </td>
                                                      </tr>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                          </tbody>
                                      </table>
                                  </div>

                                  <script>
                                      $(document).ready(function() {
                                          // ✅ Destroy old DataTable instance if exists
                                          if ($.fn.DataTable.isDataTable('#DataTable')) {
                                              $('#DataTable').DataTable().destroy();
                                          }

                                          // ✅ Reinitialize DataTable safely
                                          $('#DataTable').DataTable({
                                              "pageLength": 10,
                                              "ordering": true,
                                              "info": true,
                                              language: {
                                                    emptyTable: "No Bricks Found"
                                                }

                                          });

                                      });
                                  </script>



                                  <div id="listFormateView" style="display:none;">
                                      <?php
                                        if ($getBricks) {
                                            $brickCount = 1;
                                            foreach ($getBricks as $bricks) {
                                                $brickFunding = $this->CommonModal->getSingleRowById('tbl_brick_funding', 'brick_id = ' . $bricks['id']);
                                            ?>
                                                <div class="mt-md-5 rounded-0" style="border-left: 4px solid <?= brickColor($bricks['brick_type']) ?>">
                                                    <div class="project-row-one">
                                                        <span class="brickStatus
                                                            <?php
                                                            if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] == NULL) {
                                                                echo 'bg-markascompleted';
                                                            } else if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] != NULL) {
                                                                echo 'bg-artificialbrickartificial';
                                                            } else if ($bricks['artificialdate'] != NULL) {
                                                                echo 'bg-artificialbrick';
                                                            } else { ?>
                                                                bg-<?= ($bricks['brick_status'] == 'draft' ? 'warning' : 'primary') ?> text-white <?php } ?>  
                                                                text-white  text-capitalize">
                                                                <?php
                                                                if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] == NULL) {
                                                                    echo 'Completed';
                                                                } else if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] != NULL) {
                                                                    echo 'Artificial Brick - Completed';
                                                                } else if ($bricks['artificialdate'] != NULL) {
                                                                    echo 'Artificial Brick'; ?>
                                                                    <?= ($bricks['brick_status'] == 'draft' ? 'Draft' : ' - Live'); ?>
                                                                <?php } else { ?>
                                                                <?= ($bricks['brick_status'] == 'draft' ? 'Draft' : 'Live');
                                                                } ?>
                                                            </span>
                                                            <div class="project-cell"><?= $brickCount++ ?></div>
                                                            <div class="project-cell">Brick Title: <?= $bricks['brick_title'] ?></div>
                                                            <div class="project-cell text-center px-1">
                                                                <a href="<?= base_url('company/preview_brick?id=' . $bricks['id']) ?>" title="View Details">
                                                                    <i class="bi bi-eye-fill eye-icon"></i>
                                                                </a>
                                                            </div>
                                                    </div>
                                                    <div class="project-row-two border-top-0 border-bottom-0">
                                                        <div class="project-cell" style="display: flex; align-items: center; justify-content: center; padding: 0; height: 100%;">
                                                            <span class="project-dot green"></span>
                                                        </div>
                                                        <div class="project-cell">
                                                            Project: <?= projectName($bricks['project_id']) ?></div>
                                                        <div class="project-cell">Company: <?= companyName($bricks['company_id']) ?></div>
                                                        <div class="project-cell">Brick Id: <?= generateBrickId($bricks['id']) ?></div>
                                                        <div class="project-cell">Privacy : <span class="text-capitalize"><?= $bricks['brick_privacy'] ?></span></div>
                                                        <?php if ($bricks['user_id'] == sessionId('freelancer_id')) {?>
                                                                <div class="project-cell h-100 px-1 text-center">
                                                                    <a href="<?= base_url('company/create-brick?id=' . $bricks['id']) ?>" title="Edit Details" class="bg-light">
                                                                        <i class="bi bi-pencil"></i>
                                                                    </a>
                                                                </div>
                                                        <?php } else { ?>
                                                                <div class="project-cell h-100"></div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="project-row-three border-top-0">
                                                        <div class="project-cell h-100"></div>
                                                        <div class="project-cell">Step 1 - Fund Required: <span id="total_amount">
                                                            <?php
                                                                $cur_arr = explode('|',$bricks['currency_symbol']); 
                                                                echo $cur_arr[1]; echo ' - '; echo $cur_arr[0];
                                                            ?>
                                                            <?= $bricksFunding['fund_required'] ?></span>
                                                        </div>
                                                        <div class="project-cell h-100">Step 2 - Reward: <?= $bricks['reward_disclosed'] ?></div>
                                                        <div class="project-cell h-100">Step 3 - Completion Report:</div>
                                                        <div class="project-cell h-100">Step 4 - Voting:</div>
                                                        <div class="project-cell h-100 px-1 text-center">
                                                            <?php
                                                                if ($bricks['user_id'] == sessionId('freelancer_id')) {
                                                                ?>
                                                                    <a href="<?= base_url('company/brick-trash?id=' . $bricks['id']) ?>" title="Delete Company" class="text-danger" onclick="return confirm('Are you sure you want to delete this brick?');">
                                                                        <i class="bi bi-trash"></i>
                                                                    </a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="project-row-five border-top-0">
                                                        <div class="project-cell h-100"></div>
                                                        <div class="project-cell h-100">Step 1.1 - Type: <?= $bricksFunding['funding_type'] ?></div>
                                                        <div class="project-cell h-100">Step 2.1 - Resources: </div>
                                                        <div class="project-cell h-100">Step 3.1 - Updated Valuation:</div>
                                                        <div class="project-cell h-100"></div>
                                                        <div class="project-cell h-100 px-1 text-center">
                                                            <a href="">
                                                                <i class="fa-solid fa-arrow-down"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="project-row-six border-top-0">
                                                        <div class="project-cell h-100"></div>
                                                        <div class="project-cell h-100">Step 1.12 - Network Marketing for Fund : <br> 11111</div>
                                                        <div class="project-cell h-100">Step 2.12 - Network Marketing for Resources : <br> 11111</div>
                                                        <div class="project-cell h-100">Step 3.12 -  :</div>
                                                        <div class="project-cell h-100"></div>
                                                        <div class="project-cell h-100"></div>
                                                    </div>
                                                    <div class="project-row-four border-top-0">
                                                        <div class="project-cell h-100"></div>
                                                        <div class="project-cell h-100">Currency: <?php
                                                            $cur_arr = explode('|',$bricks['currency_symbol']); 
                                                            echo $cur_arr[1]; echo ' - '; echo $cur_arr[0];
                                                            ?></div>
                                                        <div class="project-cell" style=""><?= brickType($bricks['brick_type']) ?></div>
                                                        <div class="project-cell">Date: <span class="text-capitalize"><?= $bricks['create_date'] ?></span></div>
                                                        <div class="project-cell"> Artificial Date: <span class="text-capitalize">
                                                                <?php
                                                                if ($bricks['artificialdate'] != NULL) { ?>
                                                                    <?= $bricks['artificialdate'] ?>

                                                                <?php } else {
                                                                    echo '...';
                                                                } ?>
                                                            </span>
                                                        </div>
                                                        <div class="project-cell h-100"></div>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <?php
                                                    if ($bricks['brick_completed'] == 'completed') {
                                                    ?>
                                                        <!-- <h6>Completed:</h6> -->
                                                        <div class="progress">
                                                            <div style="width: 100%; background-color: #ff6501 !important;" class="progress-bar"></div>
                                                        </div>
                                                        <small class="text-muted">Brick completed in <strong>100%</strong>. Remaining close the Brick.</small>

                                                    <?php } else { ?>
                                                        <!-- <h6>Completed:</h6> -->
                                                        <div class="progress">
                                                            <div style="width: 60%;" class="progress-bar"></div>
                                                        </div>
                                                        <small class="text-muted">Brick completed in <strong>60%</strong>. Remaining close the Brick.</small>
                                                    <?php } ?>
                                                </div>
                                                <!-- <div class="project-grid project-grid-bottom-1 rounded-0 position-relative" style="border-left: 4px solid <?= brickColor($bricks['brick_type']) ?>">
                                                    
                                                    
                                                    <div class="project-cell" style="width:30px;"></div>

                                                </div> -->
                                        <?php
                                            }
                                        } else {
                                            echo '<div class="alert alert-info my-5">No Bricks Found</div>';
                                        }
                                    ?>
                                  </div>
                              </div>


                          </div>
                      </div>
                  </div>

                  <!-- TOGGLE FUNCTION FOR PRESS RELEASE  -->

                  <!-- Filters Section -->
                  <div class="p-2">
                      <i id="toggleFilters" class="fa fa-bars cursor-pointer"></i>
                  </div>
                  <div class="filters" id="filtersSection" style="width:500px; margin-top: 0; display: <?php echo validation_errors() ? 'none' : 'none'; ?>">
                      <div class="justify-content-between align-items-center mb-2">
                          <div class="d-flex justify-content-between align-items-center mb-2">
                              <h6 id="filtersText" class="mb-0 mt-2 d-flex">PRESS RELEASE : 
                                <!-- <a href="<?= base_url('/calendar/index') ?>" class="btn btn-primary mx-2"> Calendar </a>  -->
                              </h6>
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
                              <form action="<?= base_url('/company/project-press-release') ?>" method="post">
                                  <input type="hidden" name="project_id" value="<?= $getProject['id'] ?>">
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
                            $getRelease = $this->CommonModal->getRowByIdInOrder('tbl_project_press_release', ['project_id' => $getProject['id']], 'created_date', 'DESC');

                            if ($getRelease) {
                                foreach ($getRelease as $release) {
                            ?>

                                  <div class="press_release_showcase">

                                      <div> <?= $release['uniq_id']; ?>
                                          <span class="datetime"> <?= $release['created_date']; ?> </span>
                                      </div>
                                      <p>
                                          <?= $release['press_release']; ?>
                                      </p>
                                          <a href="<?= base_url("project/press-release/$release[id]") ?>">
                                        <!-- <span class="px-3 py-0 mx-3 viewgetpressrelease" style="width:5px; height:20px; cursor: pointer;"
                                          data-press-view="<?= $release['id'] ?>">  </span> -->
                                          👁️
                                      </a>
                                      <span class="px-3 py-0 mx-3 getpressreleaseedit" style="width:5px; height:20px; cursor: pointer;"
                                          data-press="<?= $release['id'] ?>"> ✏️ </span>
                                      <a class="text-danger mx-3" title="Remove Member" href="<?= base_url('Home/deletePressRelease?id=' . $release['id']) ?>" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></a>

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
                                          <form action="<?= base_url('/company/project-press-release') ?>" method="post">
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
                                                        <input type="hidden" name="project_id" value="<?= $getProject['id'] ?>">
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


                  <style>
                      #filtersSection {
                          margin-top: 0 !important;
                          position: relative;
                          width: 100px;
                          background-color: white;
                          padding: 10px;
                      }

                      .press-release button {
                          font-size: 12px !important;
                      }

                      .press_release_showcase p {
                          text-align: justify;
                      }

                      #wordCounter {
                          font-size: 12px;
                      }

                      .counter {
                          font-size: 13px;
                          margin-top: 5px;
                          color: #555;
                      }

                      .datetime {
                          float: right;
                          color: grey;
                      }

                      .counter.exceeded {
                          color: red;
                          font-weight: bold;
                      }

                      .press_release_showcase {
                          border-bottom: 1px solid #ccc;
                          padding-top: 10px;
                      }

                      .switch {
                          position: relative;
                          display: inline-block;
                          width: 43px;
                          height: 100%;
                      }

                      .switch input {
                          opacity: 0;
                          width: 0;
                          height: 0;
                      }

                      .slider {
                          position: absolute;
                          cursor: pointer;
                          top: 0;
                          left: 0;
                          right: 0;
                          bottom: 0;
                          background-color: #ccc;
                          transition: 0.4s;
                          border-radius: 34px;
                          height: 17px;
                      }

                      .slider:before {
                          position: absolute;
                          content: "";
                          height: 10px;
                          width: 10px;
                          border-radius: 50%;
                          left: 4px;
                          bottom: 3px;
                          background-color: white;
                          transition: 0.4s;
                      }

                      input:checked+.slider {
                          background-color: #007bff;
                      }

                      input:checked+.slider:before {
                          transform: translateX(26px);
                      }
                  </style>




                  <!-- Team Members Modal -->
                  <div class="modal fade team-members-modal" id="teamMembersModal" tabindex="-1" aria-labelledby="teamMembersModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="teamMembersModalLabel">Team Members</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <div class="team-members-wrapper">


                                      <div class="team-members-wrapper">
                                          <?php if ($bricks['user_id'] == sessionId('freelancer_id')) { ?>
                                              <div class="viewpermissiontocompanyteam">
                                                  <!-- Question 1 -->
                                                  <div>
                                                      <form id="permissionForm" method="post">
                                                          <dl class="d-flex align-items-center" id="questionBox1">
                                                              <dt class="small me-2 mb-0">You want Company Members to be part of this Project ?</dt>
                                                              <dd class="mb-0 d-flex align-items-center gap-3">
                                                                  <label class="switch me-2">
                                                                      <input type="checkbox" class="enableSwitch" data-index="1" value="yes" id="checkyes" name="checkyes">
                                                                      <span class="slider round"></span>
                                                                  </label>
                                                                  <span class="enableDisableLabel" data-index="1">No</span>
                                                              </dd>
                                                              <input type="hidden" value="<?= $brick_id ?>" id="permission_brick_id" required>
                                                              <input type="hidden" value="<?= $bricks['company_id'] ?>" id="permission_company_id" required>
                                                              <select class="form-select ms-5" style="width:200px;" name="permission" required id="selectedval">
                                                                  <option value="" selected disabled> Permission </option>
                                                                  <option value="1"> Viewer </option>
                                                                  <option value="2"> Editor </option>
                                                                  <option value="3"> Comments </option>
                                                              </select>
                                                              <button type="submit" class="btn btn-primary m-0" id="companyPermission"> Update </button>
                                                          </dl>
                                                      </form>
                                                      <div class="mb-2">
                                                        <a href="<?= base_url('company/create-team') ?>" class="btn btn-primary w-auto d-inline-block">Add Team Members</a>
                                                      </div>
                                                      <div id="conditionalForm1" style="display:none;">
                                                          <!-- Your extra form/fields for Q1 -->
                                                          <!-- <input type="text" placeholder="Company Members Form Field"> -->
                                                      </div>
                                                  </div>

                                              <?php } ?>


                                              <div class="d-flex align-items-center mb-3">
                                                  <h5 class="me-3 mb-0">Team Members</h5>
                                                  <ul class="nav nav-tabs">
                                                      <li class="nav-item">
                                                          <a class="nav-link active" id="view-1d-tab" data-bs-toggle="tab" href="#view-1d">1D View</a>
                                                      </li>
                                                      <li class="nav-item">
                                                          <a class="nav-link" id="view-2d-tab" data-bs-toggle="tab" href="#view-2d">2D View</a>
                                                      </li>
                                                      <li class="nav-item">
                                                          <a class="nav-link" id="view-3d-tab" data-bs-toggle="tab" href="#view-3d">3D View</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="view-artificial-family-tab" data-bs-toggle="tab" href="#view-artificial-family">Artificial Family</a>
                                                        </li>
                                                  </ul>
                                              </div>
                                              <div class="tab-content">
                                                  <div class="tab-pane fade show active" id="view-1d">
                                                      <?php if (!empty($getTeamMembers)) : ?>
                                                          <div class="row">
                                                              <?php foreach ($getTeamMembers as $member) :
                                                                    $memberInfo = $this->CommonModal->getSingleRowById('tbl_freelancer', ['id' => $member['member_id']]);
                                                                ?>
                                                                  <div class="col-md-12">
                                                                      <div onclick="window.location.href='<?= base_url('company/user_preview?id=' . $memberInfo['id']) ?>'" class="team-member-card">
                                                                          <img src="<?= !empty($memberInfo['user_image']) ? base_url() . 'uploads/user_profile/' . $memberInfo['user_image'] : base_url() . 'assets/user-icon.png' ?>" alt="Profile Picture">
                                                                          <div class="team-member-info">
                                                                              <h6><?= $memberInfo['name'] ?: 'No Name' ?></h6>
                                                                              <p><strong>Email:</strong> <a href="mailto:<?= $memberInfo['email'] ?: 'N/A' ?>"><?= $memberInfo['email'] ?: 'N/A' ?></a></p>
                                                                              <p><strong>Phone:</strong> <?= $memberInfo['phone'] ?: 'N/A' ?></p>
                                                                          </div>
                                                                          <span class="team-member-status <?= $member['status'] ?>"><?= $member['status'] ?></span> &nbsp;
                                                                          <a class="text-danger" title="Remove Member" href="<?= base_url('Home/deleteAddedMember?id=' . $member['id']) ?>" onclick="return confirm('Are you sure you want to delete this User?');"><i class="fas fa-trash"></i></a>
                                                                      </div>
                                                                  </div>
                                                              <?php endforeach; ?>
                                                          </div>
                                                      <?php else : ?>
                                                          <div class="col-12">
                                                              <p class="text-muted">No team members found.</p>
                                                          </div>
                                                      <?php endif; ?>
                                                  </div>
                                                  <div class="tab-pane fade" id="view-2d">
                                                      <div class="timeline-container position-relative mt-4">
                                                          <div class="timeline mt-md-3" id="timeline"></div>
                                                      </div>
                                                  </div>
                                                  <div class="tab-pane fade" id="view-3d-tab"></div>
                                                  <div class="tab-pane fade" id="view-artificial-family">
                                                        <form action="<?= base_url('/home/create_tree') ?>" method="POST">
                                                            <div class="row w-100">
                                                                <div class="col-auto">
                                                                    <label class="form-label" for="">Tree/Family/Project Nomencleture/Name</label>
                                                                    <input class="form-control" type="text" name="title" min="0">
                                                                </div>
                                                                <div class="col-auto">
                                                                    <label class="form-label" for="">Timeline Count</label>
                                                                    <input class="form-control" type="number" name="count" min="0">
                                                                </div>
                                                                <input type="hidden" value="<?= $project_id ?>" name="type_id">
                                                                <input type="hidden" value="1" name="tree_type">
                                                            </div>
                                                            <button class="btn btn-primary ms-3" type="submit">Create Tree</button>
                                                        </form>
                                                        <hr>
                                                        <div class="row justify-content-center">
                                                            <div class="col-md-12">
                                                                <label for="tree_select" class="form-label">Select Tree</label>
                                                                <select class="form-select" id="tree_select">
                                                                    <?php foreach($trees as $tree) :?>
                                                                        <option value="<?= $tree['id'] ?>"><?= $tree['title']?></option>
                                                                    <?php endforeach;?>
                                                                </select>
                                                                <div class="mt-4">
                                                                    <div id="duplicate_user_alert" class="alert alert-warning d-none" role="alert"></div>
                                                                    <div id="timeline_wrapper">
                                                                        <svg id="connectionLayer"></svg>
                                                                        <div class="mt-md-3 timeline_container" id="timeline_container"></div>
                                                                        <div id="contextMenu" class="context-menu">
                                                                            <div id="menuAddUser" class="menu-item">Add User</div>
                                                                        </div>

                                                                        <div id="userContextMenu" class="context-menu">
                                                                            <ul>
                                                                                <li id="menuAddConnection">➕ Add Connection</li>
                                                                                <li id="menuRemoveUser" class="text-danger">❌ User</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                  </div>
                                              </div>
                                              </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                      <!-- Shiv Web Developer  -->
                      <?php include('includes/footer-link.php') ?>



                      <script>
                          const textarea = document.getElementById("myTextarea");
                          const counter = document.getElementById("wordCounter");
                          const maxWords = 60;

                          textarea.addEventListener("input", () => {
                              // Split words by spaces, filter out empty strings
                              let words = textarea.value.trim().split(/\s+/).filter(Boolean);
                              let wordCount = words.length;

                              // If word count exceeds limit
                              if (wordCount > maxWords) {
                                  // Trim extra words
                                  textarea.value = words.slice(0, maxWords).join(" ");
                                  wordCount = maxWords;
                              }

                              // Update counter display
                              counter.textContent = `${wordCount} / ${maxWords} words`;
                              counter.classList.toggle("exceeded", wordCount >= maxWords);
                          });
                      </script>

                      <!-- Condition 2 -->
                      <script>
                          const textarea2 = document.getElementById("myTextarea2");
                          const counter2 = document.getElementById("wordCounter2");
                          const maxWords2 = 60;

                          textarea2.addEventListener("input", () => {
                              // Split words by spaces, filter out empty strings
                              let words2 = textarea2.value.trim().split(/\s+/).filter(Boolean);
                              let wordCount2 = words2.length;

                              // If word count exceeds limit
                              if (wordCount2 > maxWords2) {
                                  // Trim extra words
                                  textarea2.value = words2.slice(0, maxWords2).join(" ");
                                  wordCount2 = maxWords2;
                              }

                              // Update counter display
                              counter2.textContent = `${wordCount2} / ${maxWords2} words`;
                              counter2.classList.toggle("exceeded", wordCount2 >= maxWords2);
                          });
                      </script>


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


                          document.getElementById("viewCompaniesBtn").addEventListener("click", function() {
                              document.getElementById("companyList").style.display = "block";
                          });



                          document.getElementById("tableFormate").addEventListener("click", function() {
                              document.getElementById("tableFormateview").style.display = "block";
                              document.getElementById("listFormateView").style.display = "none";
                          });

                          document.getElementById("listFormate").addEventListener("click", function() {
                              document.getElementById("listFormateView").style.display = "block";
                              document.getElementById("tableFormateview").style.display = "none";
                          });

                          // OPEN MODEL FOR PRESS RELEASE
                          // Function to open/close modal
                          function openPressReleaseModal() {
                              document.getElementById('pressreleasetionModel').style.display = 'flex';
                          }

                          function closePressReleaseModal() {
                              document.getElementById('pressreleasetionModel').style.display = 'none';
                          }

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
                                  url: "<?= base_url('Home/getpressreleaseedit') ?>",
                                  type: "POST",
                                  data: {
                                      id: id
                                  },
                                  dataType: "json",
                                  success: function(response) {
                                      if (response.success) {
                                          // Fill the modal fields dynamically
                                          $("textarea[name='press_release']").val(response.data.press_release);
                                          $("input[name='id']").val(response.data.id);
                                          // $("textarea[name='editordata']").val(response.data.editordata);
                                          // Fill CKEditor field
                                          if (CKEDITOR.instances['editor1']) {
                                              CKEDITOR.instances['editor1'].setData(response.data.editordata);
                                          }
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
                                  url: "<?= base_url('Home/getpressrelease') ?>",
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
                                          $(".storytime").text(response.data.storytime);

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

        if (!searchValue) {
            console.log('Empty search, ignoring');
            return;
        }

        try {
            console.log('Searching for:', searchValue);

            press_release_search_btn.disabled = true;

            const press_release_res = await get_press_release(searchValue);

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
        let project_id = "<?= $getProject['id'] ?>";
        let type = "project";

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

    async function get_press_release(searchValue = null){
        let project_id = "<?= $getProject['id'] ?>";
        let type = "project";

        const payload = { type, project_id };

        if (searchValue && searchValue.trim() !== "") {
            payload.searchValue = searchValue.trim();
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

                <div> ${press_release['uniq_id']}
                    <span class="datetime"> ${press_release['created_date']} </span>
                </div>
                <p>
                    ${press_release['press_release']}
                </p>

                <span class="px-3 py-0 mx-3 viewgetpressrelease" style="width:5px; height:20px; cursor: pointer;"
                    data-press-view=" ${press_release['id']}"> 👁️ </span>

                <a href="<?= base_url("project/press-release/$release[id]") ?>">👁️</a>

                <span class="px-3 py-0 mx-3 getpressreleaseedit" style="width:5px; height:20px; cursor: pointer;"
                    data-press="${press_release['id']}"> ✏️ </span>
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