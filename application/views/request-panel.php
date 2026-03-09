<style>
  .nav-tabs {
    border-bottom: 2px solid #dddddd3d;
    margin-bottom: 11px;
  }

  .nav-item .nav-link {
    font-weight: 600;
    color: #333;
    border-radius: 0;
    padding: 2px 37px;
    transition: background-color 0.3s ease;
  }

  .nav-item .nav-link.active {
    background-color: #007bff;
    padding: 5px 43px;
    font-size: 14px;
    color: white;
    border-color: #007bff;
  }

  .nav-item .nav-link:hover {
    background-color: #f0f0f0;
    color: #007bff;
    padding: 4px 37px;
  }

  .tab-content .tab-pane {
    padding: 15px;
    /* border: 1px solid #ddd; */
    /* border-top: none; */
    border-radius: 5px;
    /* /* background-color: #f9f9f9; */
  }

  .tab-content .tab-pane p {
    font-size: 1rem;
    color: #555;
  }

  .nav-item .nav-link i {
    margin-right: 8px;
  }

  .nav-link:hover {
    color: #007bff;
    border-color: #007bff;
  }
</style>
<!-- Shiv Web Developer  -->
<?php $this->load->view('includes/header'); ?>
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body pt-0">
  <div>
    <h4 class="mb-md-5 mb-3 text-center">Request Panels</h4>
  </div>
  <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="channel-request-tab" data-bs-toggle="tab" href="#pass-channel-tab" role="tab" aria-controls="pass-channel-request" aria-selected="false">1. Pass Channel Request</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="work-tab" data-bs-toggle="tab" href="#work" role="tab" aria-controls="work" aria-selected="false">2. Network Marketing Request </a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="network-tab" data-bs-toggle="tab" href="#network" role="tab" aria-controls="network" aria-selected="true">3. Network-connect request</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="teamup-tab" data-bs-toggle="tab" href="#teamup" role="tab" aria-controls="teamup" aria-selected="false">4. Teamup Request</a>
    </li>

    <li class="nav-item" role="presentation">
      <a class="nav-link" id="dialogue-tab" data-bs-toggle="tab" href="#dialogue" role="tab" aria-controls="dialogue" aria-selected="false">5. Dialogue/Meeting Notes Request</a>
    </li>

    <li class="nav-item" role="presentation">
      <a class="nav-link" id="appointment-tab" data-bs-toggle="tab" href="#appointment" role="tab" aria-controls="appointment" aria-selected="false">6. Calendar Appointment Request</a>
    </li>
  </ul>

  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="pass-channel-tab" role="tabpanel" aria-labelledby="channel-request-tab">
      <ul class="row g-1 li_animate list-unstyled" id="request-tab">
        <?php
        if (!empty($getAllBrickRequest)):

          foreach ($getAllBrickRequest as $request):
            if ($request['request_tab_id'] == 'channel-request') {
              $getCompany = $this->CommonModal->getSingleRowById('companies', ['id' => $request['company_id']]);
              $getProjects = $this->CommonModal->getSingleRowById('projects', ['id' => $request['project_id']]);
              $getBrick = $this->CommonModal->getSingleRowById('bricks', ['id' => $request['brick_id']]);
              $getUser = $this->CommonModal->getSingleRowById('freelancer', ['id' => $request['created_by']]);
        ?>

              <li class="col-12">
                <div class="p-3 rounded-4 d-flex align-items-center flex-column flex-md-row" style="background: #eeeeee4f;">
                  <img class="avatar lg rounded-circle img-thumbnail ms-auto me-auto shadow" src="<?= base_url('/uploads/user_profile/') . $getUser['user_image']; ?>" alt="Freelancer Image">
                  <div class="ms-md-2 ms-lg-3 text-md-start text-center w-100 mt-4 mt-md-0">
                    <div class="row g-0 align-items-center">
                      <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 mb-3 mb-md-0">
                        <h6 class="mb-1"><?= $getUser['name'] ?></h6>
                        <!-- <span class="text-black d-block"><//?= $getUser['address'] ?></span> -->
                        <!-- <span class="badge bg-primary mt-2"><//?= $getCompany['company_name'] ?></span> -->
                      </div>
                      <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 text-center text-md-start">
                        <p class="small text-black mb-1">
                          <strong>Pass Channel Request:</strong> Requested to create pass channal on, <br />
                          <?= $getCompany['company_name'] ?> <br />
                          <?= $getProjects['project_name'] ?> <br />
                          <?= generateBrickId($getBrick['id']) . ' ' . $getBrick['brick_title']; ?>
                        </p>
                        <span class="text-black small">Requested on: <?= convertDatedmy($request['create_date']) ?></span>
                      </div>
                      <?php if ($request['status'] === 'Requested'): ?>
                        <div class="col-xl-3 col-lg-3 col-md-3 justify-content-center justify-content-md-end mt-3 mt-md-0 d-flex">
                          <button type="button" onclick="window.location.href='<?= base_url('Home/teamupRequestUpdate?id=' . $request['id'] . '&status=Accepted') ?>'" class="btn btn-success btn-sm me-1" title="Accept"><i class="fa fa-check"></i> Accepet</button>
                          <button type="button" onclick="window.location.href='<?= base_url('Home/teamupRequestUpdate?id=' . $request['id'] . '&status=Rejected') ?>'" class="btn btn-danger btn-sm" title="Reject"><i class="fa fa-times"></i> Reject</button>
                        </div>
                      <?php else: ?>
                        <div class="col-xl-3 col-lg-3 col-md-3 justify-content-center justify-content-md-end mt-3 mt-md-0 d-flex">
                          <span class="text-<?= $request['status'] === 'Accepted' ? 'success' : 'danger' ?> btn-sm me-1"><i class="fa fa-<?= $request['status'] === 'Accepted' ? 'check' : 'times' ?>"></i> <?= $request['status'] ?></span>
                          <a class="text-danger mx-3" title="Remove Member" href="<?= base_url('Home/deleteAddedMember?id=' . $request['id']) ?>" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></a>

                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </li>

            <?php } ?>

          <?php
          endforeach;
        else:
          ?>
          <li class="col-12">
            <div class="p-3 rounded-4 d-flex align-items-center flex-column flex-md-row border" style="background: #eeeeee4f;">
              <div class="ms-md-2 ms-lg-3 text-md-start text-center w-100 mt-4 mt-md-0">
                <h6 class="mb-1 text-center text-secondary">No Channel Requests</h6>
              </div>
            </div>
          </li>
        <?php endif; ?>

      </ul>
    </div>

    <div class="tab-pane fade" id="work" role="tabpanel" aria-labelledby="work-tab">
      <ul class="row g-1 li_animate list-unstyled" id="WorkRequests">
        <?php
        if (!empty($getAllBrickRequest)):
          foreach ($getAllBrickRequest as $request):
            if ($request['request_tab_id'] == 'network-marketing-request' && $request['member_id'] == sessionId('freelancer_id')) {
              $getCompany = $this->CommonModal->getSingleRowById('companies', ['id' => $request['company_id']]);
              $getDirectorDetails = $this->CommonModal->getSingleRowById('tbl_company_directory', ['company_id' => $getCompany['id']]);
              $getProjects = $this->CommonModal->getSingleRowById('projects', ['id' => $request['project_id']]);
              $getBrick = $this->CommonModal->getSingleRowById('bricks', ['id' => $request['brick_id']]);
              $getUser = $this->CommonModal->getSingleRowById('freelancer', ['id' => $request['created_by']]);
              $getChannelName = $this->CommonModal->getSingleRowById('brick_pass_channel', ['channel_id' => $request['channel_id'], 'created_by' => $request['created_by']]);

        ?>

              <li class="col-12">
                <div class="p-3 rounded-4 d-flex align-items-center flex-column flex-md-row" style="background: #eeeeee4f;">
                  <img class="avatar lg rounded-circle img-thumbnail ms-auto me-auto shadow" src="<?= base_url('/uploads/user_profile/') . $getUser['user_image']; ?>" alt="Freelancer Image">
                  <div class="ms-md-2 ms-lg-3 text-md-start text-center w-100 mt-4 mt-md-0">
                    <div class="row g-0 align-items-center">
                      <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 mb-3 mb-md-0">
                        <h6 class="mb-1"><?= $getUser['name'] ?></h6>
                      </div>
                      <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 text-center text-md-start">
                        <p class="small text-black mb-1">
                          <strong> <?= $getUser['name'] ?> </strong> Invited you join paas channal on <?= $getChannelName['channel_name'] ?> <br />
                          <?= $getCompany['company_name'] ?> <br />
                          <?= $getProjects['project_name'] ?> <br />
                          <?= generateBrickId($getBrick['id']) . ' ' . $getBrick['brick_title']; ?>
                        </p>
                        <span class="text-black small">Requested on: <?= convertDatedmy($request['create_date']) ?></span>
                      </div>
                      <?php if ($request['status'] === 'Requested'): ?>
                        <div class="col-xl-3 col-lg-3 col-md-3 justify-content-center justify-content-md-end mt-3 mt-md-0 d-flex">
                          <button type="button" onclick="window.location.href='<?= base_url('Home/teamupRequestUpdate?id=' . $request['id'] . '&status=Accepted') ?>'" class="btn btn-success btn-sm me-1" title="Accept"><i class="fa fa-check"></i> Accepet</button>
                          <button type="button" onclick="window.location.href='<?= base_url('Home/teamupRequestUpdate?id=' . $request['id'] . '&status=Rejected') ?>'" class="btn btn-danger btn-sm" title="Reject"><i class="fa fa-times"></i> Reject</button>
                        </div>
                      <?php else: ?>
                        <div class="col-xl-3 col-lg-3 col-md-3 justify-content-center justify-content-md-end mt-3 mt-md-0 d-flex">
                          <span class="text-<?= $request['status'] === 'Accepted' ? 'success' : 'danger' ?> btn-sm me-1"><i class="fa fa-<?= $request['status'] === 'Accepted' ? 'check' : 'times' ?>"></i> <?= $request['status'] ?></span>
                          <a class="text-danger mx-3" title="Remove Member" href="<?= base_url('Home/deleteAddedMember?id=' . $request['id']) ?>" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></a>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </li>
            <?php } ?>
          <?php
          endforeach;
        else:
          ?>
          <li class="col-12">
            <div class="p-3 rounded-4 d-flex align-items-center flex-column flex-md-row border" style="background: #eeeeee4f;">
              <div class="ms-md-2 ms-lg-3 text-md-start text-center w-100 mt-4 mt-md-0">
                <h6 class="mb-1 text-center text-secondary">No Network Marketing Channel Requests</h6>
              </div>
            </div>
          </li>
        <?php endif; ?>
      </ul>
    </div>

    <div class="tab-pane fade" id="teamup" role="tabpanel" aria-labelledby="teamup-tab">
      <ul class="row g-1 li_animate list-unstyled" id="TeamRequests">
        <?php
        if (!empty($getTeamRequest)):
          foreach ($getTeamRequest as $request):
            $getCompany = $this->CommonModal->getSingleRowById('companies', ['id' => $request['company_id']]);
            $getProject = $this->CommonModal->getSingleRowById('projects', ['id' => $request['project_id']]);
            $getBricks = $this->CommonModal->getSingleRowById('bricks', ['id' => $request['brick_id']]);
            $getDirectorDetails = $this->CommonModal->getSingleRowById('tbl_company_directory', ['company_id' => $getCompany['id']]);

        ?>
            <li class="col-12">
              <div class="p-3 rounded-4 d-flex align-items-center flex-column flex-md-row" style="background: #eeeeee4f;">
                <img class="avatar lg rounded-circle img-thumbnail ms-auto me-auto shadow" src="<?= base_url() ?>assets/images/img/user.png" alt="Priya Sharma">
                <div class="ms-md-2 ms-lg-3 text-md-start text-center w-100 mt-4 mt-md-0">
                  <div class="row g-0 align-items-center">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 mb-3 mb-md-0">
                      <h6 class="mb-1">
                        <?php if ($request['department_id'] == null) {
                          echo '<span class="p-1 bg-primary" style="color:white;">1D</span>';
                        } else {
                          echo '<span class="p-1 bg-primary" style="color:white;">2D</span>';
                        } ?>
                        <?= $getDirectorDetails['director_name'] ?? 'NO Name' ?>
                      </h6>
                      <span class="text-black d-block"><?= $getCompany['location'] ?></span>
                      <span class="badge bg-primary mt-2"> <?= $getCompany['company_name']; ?></span>
                      <span class="badge bg-primary mt-2"> <strong> Project: </strong> <?php if ($getProject['project_name'] == null) {
                                                                                          echo 'Null';
                                                                                        } else {
                                                                                          echo $getProject['project_name'];
                                                                                        }; ?></span>
                      <span class="badge bg-primary mt-2"> <strong> Brick: </strong> <?php if ($getBricks['brick_title'] == null) {
                                                                                        echo 'Null';
                                                                                      } else {
                                                                                        echo $getBricks['brick_title'];
                                                                                      }; ?> </span>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 text-center text-md-start">
                      <p class="small text-black mb-1"><strong>Team-Up Request:</strong> "We are looking for a member to join our company to contribute"</p>
                      <span class="text-black small">Requested on: <?= convertDatedmy($request['create_date']) ?></span>
                    </div>
                    <?php if ($request['status'] === 'Requested'): ?>
                      <div class="col-xl-3 col-lg-3 col-md-3 justify-content-center justify-content-md-end mt-3 mt-md-0 d-flex">
                        <button type="button" onclick="window.location.href='<?= base_url('Home/teamupRequestUpdate?id=' . $request['id'] . '&status=Accepted') ?>'" class="btn btn-success btn-sm me-1" title="Accept"><i class="fa fa-check"></i> Accepet</button>
                        <button type="button" onclick="window.location.href='<?= base_url('Home/teamupRequestUpdate?id=' . $request['id'] . '&status=Rejected') ?>'" class="btn btn-danger btn-sm" title="Reject"><i class="fa fa-times"></i> Reject</button>
                      </div>
                    <?php else: ?>
                      <div class="col-xl-3 col-lg-3 col-md-3 justify-content-center justify-content-md-end mt-3 mt-md-0 d-flex">
                        <span class="text-<?= $request['status'] === 'Accepted' ? 'success' : 'danger' ?> btn-sm me-1"><i class="fa fa-<?= $request['status'] === 'Accepted' ? 'check' : 'times' ?>"></i> <?= $request['status'] ?></span>
                        <a class="text-danger mx-3" title="Remove Member" href="<?= base_url('Home/deleteAddedMember?id=' . $request['id']) ?>" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></a>

                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </li>
          <?php endforeach;
        else: ?>
          <li class="col-12">
            <div class="p-3 rounded-4 d-flex align-items-center flex-column flex-md-row border" style="background: #eeeeee4f;">
              <div class="ms-md-2 ms-lg-3 text-md-start text-center w-100 mt-4 mt-md-0">
                <h6 class="mb-1 text-center text-secondary">No Team-Up Requests</h6>
              </div>
            </div>
          </li>
        <?php endif; ?>
      </ul>
    </div>

    <div class="tab-pane fade" id="network" role="tabpanel" aria-labelledby="network-tab">
      
      <ul class="row g-1 li_animate list-unstyled" id="MyClients">
        <?php if(!empty($getAllNetworkRequest)) : ?>
          <?php foreach ($getAllNetworkRequest as $request): ?>

            <?php function requestButtonUI($status, $request_id) {

              if ($status === 'pending') {
                  return '
                    <button class="btn btn-success btn-sm me-1 accept-btn" data-id="'.$request_id.'">
                      <i class="fa fa-check"></i> Accept
                    </button>
                    <button class="btn btn-warning btn-sm reject-btn" data-id="'.$request_id.'">
                      <i class="fa fa-times"></i> Reject
                    </button>
                  ';
              }

              if ($status === 'accepted') {
                  return '
                    <button class="btn btn-secondary btn-sm" disabled>
                      <i class="fa fa-user-check"></i> Connected
                    </button>
                  ';
              }

              if ($status === 'rejected') {
                  return '
                    <button class="btn btn-danger btn-sm" disabled>
                      <i class="fa fa-ban"></i> Rejected
                    </button>
                  ';
              }

              return '';
            }
          ?>
          

          <li class="col-12">
            <div class="p-3 rounded-4 d-flex flex-column flex-md-row" style="background:#eeeeee4f;">

              <img class="avatar lg rounded-circle img-thumbnail"
                  src="<?= $request['user_image']
                        ? base_url('uploads/user_profile/'.$request['user_image'])
                        : base_url('assets/images/img/user.png') ?>">

              <div class="ms-md-3 w-100 mt-3 mt-md-0">
                <div class="row align-items-center">

                  <div class="col-md-3">
                    <h6><?= $request['name'] ?></h6>
                    <span class="text-black"><?= $request['city'] ?></span>
                    <span class="badge bg-primary mt-2 text-capitalize">
                      <?= $request['status'] ?>
                    </span>
                  </div>

                  <div class="col-md-6">
                    <p class="small mb-1"><?= $request['summary'] ?? 'Sent you a connection request.' ?></p>
                    <small>
                      Requested: <?= date('d M Y', strtotime($request['created_at'])) ?>
                    </small>
                  </div>

                  <div class="col-md-3 d-flex justify-content-end">
                    <?= requestButtonUI($request['status'], $request['request_id']) ?>
                  </div>

                </div>
              </div>
            </div>
          </li>

          <?php endforeach; ?>
        <?php else: ?>

          <li class="col-12 text-center text-muted">
            No pending connection requests.
          </li>

        <?php endif; ?>
        </ul>


    </div>

    <!-- Shiv Web Developer  -->
    <div class="tab-pane fade" id="dialogue" role="tabpanel" aria-labelledby="dialogue-tab">
      <!-- <ul class="row g-1 li_animate list-unstyled" id="DialogueRequests">
        <li class="col-12">
          <div class="p-3 rounded-4 d-flex align-items-center flex-column flex-md-row" style="background: #eeeeee4f;">
            <img class="avatar lg rounded-circle img-thumbnail ms-auto me-auto shadow" src="<?= base_url() ?>assets/images/img/user.png" alt="Ravi Sharma">
            <div class="ms-md-2 ms-lg-3 text-md-start text-center w-100 mt-4 mt-md-0">
              <div class="row g-0 align-items-center">
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 mb-3 mb-md-0">
                  <h6 class="mb-1">Ravi Sharma</h6>
                  <span class="text-black">Mumbai, Maharashtra</span>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 text-center text-md-start">
                  <p class="small text-black mb-1"><strong>Funding Request:</strong> "I am seeking funding to develop a tech-based solution that supports sustainable agriculture and water conservation in rural areas of Maharashtra."</p>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 text-center text-md-center">
                  <p class="small text-black mb-1"><strong>Amount:</strong>₹25,00,000</p>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 text-center text-md-end mt-3 mt-md-0 d-flex">
                  <button type="button" class="btn btn-success btn-sm me-1" title="Activate"><i class="fa fa-check"></i> Activate</button>
                  <button type="button" class="btn btn-warning btn-sm" title="Dispatch"><i class="fa fa-paper-plane"></i> Dispatch</button>
                  <a class="text-danger mx-3" title="Remove Member" href="<?= base_url('Home/deleteAddedMember?id=' . $request['id']) ?>" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></a>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul> -->
      <ul class="row g-1 li_animate list-unstyled" id="DialogueRequests">

      <?php if (!empty($getDialogueRequest)): ?>
          <?php foreach ($getDialogueRequest as $req): ?>
              <li class="col-12" id="request_<?= (int)$req['dialogue_id'] ?>">
                  <div class="p-3 rounded-4 d-flex align-items-center flex-column flex-md-row"
                      style="background: #eeeeee4f;">

                      <!-- Sender Avatars -->
                      <div class="d-flex align-items-center gap-2 me-3">
                          <?php if (!empty($req['senders'])): ?>
                              <?php foreach ($req['senders'] as $sender): ?>
                                  <img class="avatar rounded-circle img-thumbnail shadow"
                                      src="<?= !empty($sender['image']) 
                                              ? base_url('uploads/user_profile/'.$sender['image']) 
                                              : base_url('assets/images/img/user.png') ?>"
                                      title="<?= htmlspecialchars($sender['name']) ?>">
                              <?php endforeach; ?>
                          <?php endif; ?>
                      </div>

                      <div class="ms-md-2 ms-lg-3 text-md-start text-center w-100 mt-4 mt-md-0">
                          <div class="row g-0 align-items-center">

                              <!-- Sender Names -->
                              <div class="col-xxl-3 col-md-3 mb-3 mb-md-0">
                                  <h6 class="mb-1">
                                      <?= !empty($req['senders'])
                                          ? htmlspecialchars(implode(', ', array_column($req['senders'], 'name')))
                                          : 'Unknown Users' ?>
                                  </h6>
                                  <span class="text-muted small">
                                      sent you a dialogue request
                                  </span>
                              </div>

                              <!-- Dialogue -->
                              <div class="col-xxl-5 col-md-5">
                                  <p class="small text-black mb-1">
                                      <strong>Dialogue:</strong>
                                      “<?= nl2br(htmlspecialchars($req['dialogue'])) ?>”
                                  </p>
                              </div>

                              <!-- Status -->
                              <div class="col-xxl-2 col-md-2 text-center">
                                  <?php if ($req['dialogue_status'] == 1): ?>
                                      <span class="badge bg-success status-text">Approved</span>
                                  <?php elseif ($req['dialogue_status'] == 2): ?>
                                      <span class="badge bg-danger status-text">Rejected</span>
                                  <?php else: ?>
                                      <span class="badge bg-info status-text">Pending</span>
                                  <?php endif; ?>
                              </div>

                              <!-- Actions -->
                              <div class="col-xl-2 col-md-2 text-center text-md-end mt-3 mt-md-0 d-flex justify-content-end gap-1">
                                  <?php if ((int)$req['dialogue_status'] === 0): ?>
                                      <button 
                                          type="button"
                                          class="btn btn-success btn-sm approve-dialogue"
                                          data-id="<?= (int)$req['dialogue_id'] ?>">
                                          <i class="fa fa-check"></i>
                                      </button>

                                      <button 
                                          type="button"
                                          class="btn btn-danger btn-sm reject-dialogue"
                                          data-id="<?= (int)$req['dialogue_id'] ?>">
                                          <i class="fa fa-times"></i>
                                      </button>
                                  <?php endif; ?>
                              </div>

                          </div>
                      </div>
                  </div>
              </li>
          <?php endforeach; ?>
      <?php else: ?>
          <li class="col-12 text-center text-muted py-5">
              No dialogue requests found 😴
          </li>
      <?php endif; ?>

      </ul>



    </div>
      
    <div class="tab-pane fade" id="network" role="tabpanel" aria-labelledby="network-tab">
      
      <ul class="row g-1 li_animate list-unstyled" id="MyClients">
        <?php if(!empty($getAllNetworkRequest)) : ?>
          <?php foreach ($getAllNetworkRequest as $request): ?>

          

          <li class="col-12">
            <div class="p-3 rounded-4 d-flex flex-column flex-md-row" style="background:#eeeeee4f;">

              <img class="avatar lg rounded-circle img-thumbnail"
                  src="<?= $request['user_image']
                        ? base_url('uploads/user_profile/'.$request['user_image'])
                        : base_url('assets/images/img/user.png') ?>">

              <div class="ms-md-3 w-100 mt-3 mt-md-0">
                <div class="row align-items-center">

                  <div class="col-md-3">
                    <h6><?= $request['name'] ?></h6>
                    <span class="text-black"><?= $request['city'] ?></span>
                    <span class="badge bg-primary mt-2 text-capitalize">
                      <?= $request['status'] ?>
                    </span>
                  </div>

                  <div class="col-md-6">
                    <p class="small mb-1"><?= $request['summary'] ?? 'Sent you a connection request.' ?></p>
                    <small>
                      Requested: <?= date('d M Y', strtotime($request['created_at'])) ?>
                    </small>
                  </div>

                  <div class="col-md-3 d-flex justify-content-end">
                    <?= requestButtonUI($request['status'], $request['request_id']) ?>
                  </div>

                </div>
              </div>
            </div>
          </li>

            <?php endforeach; ?>
          <?php else: ?>

          <li class="col-12 text-center text-muted">
            No pending connection requests.
          </li>

        <?php endif; ?>
      </ul>

    </div>

    <div class="tab-pane fade" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">
      
      <ul class="row g-1 li_animate list-unstyled" id="AppointmentRequests">

        <?php if(!empty($getAppointmentRequets)) : ?>

        <?php
          function appointmentButtonUI($status, $appointment_id) {

              if ($status === 'pending') {
                  return '
                      <button class="btn btn-success btn-sm me-1 accept-appointment" data-id="'.$appointment_id.'">
                          <i class="fa fa-check"></i> Accept
                      </button>
                      <button class="btn btn-warning btn-sm reject-appointment" data-id="'.$appointment_id.'">
                          <i class="fa fa-times"></i> Reject
                      </button>
                  ';
              }

              if ($status === 'accepted') {
                  return '
                      <button class="btn btn-secondary btn-sm" disabled>
                          <i class="fa fa-calendar-check"></i> Accepted
                      </button>
                  ';
              }

              if ($status === 'rejected') {
                  return '
                      <button class="btn btn-danger btn-sm" disabled>
                          <i class="fa fa-ban"></i> Rejected
                      </button>
                  ';
              }

              return '';
          }
        ?>

        <?php foreach ($getAppointmentRequets as $appointment): ?>

          <li class="col-12">
              <div class="p-4 rounded-4 shadow-sm bg-white border">

                  <div class="row align-items-center">

                      <div class="col-md-3 mb-3 mb-md-0">
                          <div class="d-flex align-items-center">

                              <img class="rounded-circle me-3 shadow"
                                  src="<?= base_url("uploads/user_profile/$appointment[sender_image]") ?>"
                                  alt="User"
                                  width="60" height="60">

                              <div>
                                  <h6 class="mb-1">
                                      <?= !empty($appointment['sender_name']) ? $appointment['sender_name'] : 'No Name' ?>
                                  </h6>
                                  <small class="text-muted">
                                      <?= $appointment['sender_email'] ?>
                                  </small>
                              </div>

                          </div>

                          <div class="mt-3">
                              <span class="badge 
                                  <?= $appointment['status'] == 'pending' ? 'bg-warning text-dark' : 
                                      ($appointment['status'] == 'accepted' ? 'bg-success' : 'bg-danger') ?>">
                                  <?= ucfirst($appointment['status']) ?>
                              </span>
                          </div>
                      </div>

                      <div class="col-md-6 mb-3 mb-md-0">

                          <h6 class="fw-bold mb-2">
                              <?= $appointment['company_name'] ?>
                          </h6>

                          <p class="mb-1">
                              <strong>Note:</strong>
                              <?= $appointment['notes'] ?? 'Appointment request' ?>
                          </p>

                          <?php if($appointment['bid_amount']){ ?>
                              <p class="mb-1">
                                  <strong>Bid:</strong>
                                  <?= explode('|',$appointment['bid_curr'])[0] ?>
                                  <?= $appointment['bid_amount'] ?>
                                  <?= explode('|',$appointment['bid_curr'])[1] ?>
                              </p>
                          <?php } ?>

                          <?php if($appointment['barter_bid']){ ?>
                              <p class="mb-1">
                                  <strong>Barter:</strong>
                                  <?= $appointment['barter_bid'] ?>
                              </p>
                          <?php } ?>

                          <small class="text-muted">
                              <strong>Duration:</strong>
                              <?= date('d M Y, h:i A', strtotime($appointment['start_datetime'])) ?>
                              -
                              <?= date('h:i A', strtotime($appointment['end_datetime'])) ?>
                          </small>

                      </div>

                      <div class="col-md-3 text-md-end">

                          <?php if ($appointment['status'] === 'pending') { ?>
                              <button class="btn btn-success btn-sm me-2 accept-appointment" 
                                  data-id="<?= $appointment['id'] ?>">
                                  <i class="fa fa-check"></i> Accept
                              </button>

                              <button class="btn btn-outline-danger btn-sm reject-appointment" 
                                  data-id="<?= $appointment['id'] ?>">
                                  <i class="fa fa-times"></i> Reject
                              </button>
                          <?php } else { ?>
                              <button class="btn btn-secondary btn-sm" disabled>
                                  <?= ucfirst($appointment['status']) ?>
                              </button>
                          <?php } ?>

                      </div>

                  </div>

              </div>
          </li>

        <?php endforeach; ?>

        <?php else: ?>

          <li class="col-12 text-center text-muted">
              No appointment requests found.
          </li>

        <?php endif; ?>

      </ul>

    </div>

  </div>
</div>
<?php $this->load->view('includes/footer-link'); ?>


<script>
  document.addEventListener('click', async function (e) {

    // ACCEPT
    if (e.target.closest('.accept-btn')) {
      const btn = e.target.closest('.accept-btn');
      const requestId = btn.dataset.id;
      handleRequestAction(requestId, 'accept', btn);
    }

    // REJECT
    if (e.target.closest('.reject-btn')) {
      const btn = e.target.closest('.reject-btn');
      const requestId = btn.dataset.id;
      handleRequestAction(requestId, 'reject', btn);
    }

  });

  async function handleRequestAction(request_id, action, btn) {

    if (!request_id) return;

    try {
      const response = await fetch("<?= base_url('Home/update_connection_status') ?>", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          request_id: request_id,
          action: action
        })
      });

      const result = await response.json();

      if (response.ok && result.status === true) {

        alert(result.message);

         if (actionCol) {
            if (action === 'accept') {
              actionCol.innerHTML = `
                <button class="btn btn-secondary btn-sm" disabled>
                  <i class="fa fa-user-check"></i> Connected
                </button>
              `;
            } else if (action === 'reject') {
              actionCol.innerHTML = `
                <button class="btn btn-danger btn-sm" disabled>
                  <i class="fa fa-ban"></i> Rejected
                </button>
              `;
            }
          }

      } else {
        alert(result.message || 'Action failed');
      }

    } catch (error) {
      console.error(error);
      alert('Network error ❌');
    }
  }
</script>

<script>
  $(document).on('click', '.approve-dialogue, .reject-dialogue', function () {

      const id     = $(this).data('id'); // 🔥 dialogue_id
      const status = $(this).hasClass('approve-dialogue') ? 1 : 2;
      const $row   = $('#request_' + id);          // <li id="request_DIALOGUE_ID">
      const $btns  = $(this).closest('.d-flex');   // wrapper for buttons

      if (!id) {
          alert('Dialogue ID missing!');
          return;
      }

      $.ajax({
          url: "<?= base_url('Calendar/updateDialogueStatus') ?>",
          type: "POST",
          dataType: "json",
          data: {
              id: id,
              status: status
          },
          beforeSend: function () {
              $btns.find('button').prop('disabled', true);
          },
          success: function (res) {
              if (res.success) {

                  const badgeMap = {
                      0: { text: 'Pending',  cls: 'bg-info' },
                      1: { text: 'Approved', cls: 'bg-success' },
                      2: { text: 'Rejected', cls: 'bg-danger' }
                  };

                  // 🔥 Update status badge
                  const badge = badgeMap[status];
                  $row.find('.status-text')
                      .removeClass('bg-info bg-success bg-danger bg-secondary')
                      .addClass(badge.cls)
                      .text(badge.text);

                  // 🔥 Remove buttons after action
                  $btns.remove();

              } else {
                  alert(res.message || 'Failed to update status');
                  $btns.find('button').prop('disabled', false);
              }
          },
          error: function () {
              alert('Server error!');
              $btns.find('button').prop('disabled', false);
          }
      });
  });
</script>

<script>
  $(document).on('click', '.accept-appointment', function () {

      let appointmentId = $(this).data('id');
      let button = $(this);

      $.ajax({
          url: "<?= base_url('home/updateStatus') ?>",
          type: "POST",
          data: {
              id: appointmentId,
              status: 'approved'
          },
          dataType: "json",
          success: function (response) {

              if (response.success) {

                  // Replace buttons with Approved badge
                  button.closest('.col-md-3').html(`
                      <button class="btn btn-secondary btn-sm" disabled>
                          <i class="fa fa-calendar-check"></i> Accepted
                      </button>
                  `);

              } else {
                  alert(response.message);
              }
          }
      });
  });


  $(document).on('click', '.reject-appointment', function () {

      let appointmentId = $(this).data('id');
      let button = $(this);

      $.ajax({
          url: "<?= base_url('home/updateStatus') ?>",
          type: "POST",
          data: {
              id: appointmentId,
              status: 'cancelled'
          },
          dataType: "json",
          success: function (response) {

              if (response.success) {

                  button.closest('.col-md-3').html(`
                      <button class="btn btn-danger btn-sm" disabled>
                          <i class="fa fa-ban"></i> Rejected
                      </button>
                  `);

              } else {
                  alert(response.message);
              }
          }
      });
  });
</script>