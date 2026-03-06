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
     align-items: start;
     justify-content: center;
     z-index: 1000;
     overflow-y: auto;
     padding-top: 40px;
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
     font-size: 18px;
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
   .celebrity-wrapper span{
      top: -67%;
      font-size: 13px;
      transform: translateY(67%);
      width: 100%;
      text-align: center;
      z-index: 0;
   }
   @media screen and (min-width: 1820px) {
    .celebrity-wrapper span{
      top: -42px;
      transform: translateY(67%);
    }
  }
 </style>

  <style>
    .my-custom-table {
      width: 100%;
      table-layout: fixed;
      word-wrap: break-word;
    }

    .my-custom-table td small,
    .my-custom-table td strong {
      display: block;
      max-width: 100%;
      word-wrap: break-word;
      overflow-wrap: break-word;
      white-space: normal;
    }

    .my-custom-table img {
      width: 45px;
      height: 45px;
      min-width: 45px;
    }
    .search-btn{
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      border-radius: 50%;
      background-color: transparent;
      border: none;
      cursor: pointer;
      z-index: 10;
    }
    .search-btn:hover{
      background-color: white; 
    }

    .ruler {
        display: flex;
        align-items: flex-end;
        background: white;
        padding-inline: 20px;
        padding-top: 20px;
        border: 1px solid #000;
        position: relative;
    }
    .ruler-line{
      position: absolute;
      bottom: -50px;
      left: 0;
      height: 1px;
      background: black;
      width: 100%;
    }
    .ruler-handle {
      position: absolute;
      top: -49px;            /* keeps icons above line */
      left: 17px;
      cursor: grab;
      user-select: none;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .ruler-handle:active {
      cursor: grabbing;
    }
    .tick {
        width: 1px;
        background: black;
        margin: 0 4px;
        position: relative;
    }
    @media (max-width: 1682px) {
        .tick {
          margin: 0 3px;
          width: 1px;
        }
    }
    @media (max-width: 1379px) {
        .tick {
          margin: 0 2px;
          width: 1px;
        }
    }
    @media (max-width: 826px) {
        .tick {
          margin: 0 1px;
          width: 1px;
        }
    }

    .tick.small {
        height: 20px;
    }

    .tick.medium {
        height: 30px;
    }

    .tick.big {
        height: 50px;
    }

    .label {
        position: absolute;
        top: -38px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 12px;
        font-weight: bold;
        width: unset;
        padding-right: unset;
    }

    .custom-arrow {
      width: 2px;
      height: 38px;
      background: black;
      position: relative;
    }

    .custom-arrow::after {
      content: "";
      position: absolute;
      top: -2%;
      left: 52%;
      transform: translate(-50%, 0%);
      border-left: 6px solid transparent;
      border-right: 6px solid transparent;
      border-bottom: 8px solid black;
    }
  </style>

 <div class="floating-toast">
   <?php
    if ($this->session->has_userdata('profileUpdate')) {
      echo $this->session->userdata('profileUpdate');
      $this->session->unset_userdata('profileUpdate');
    }
    ?>
   <?php
    if ($this->session->has_userdata('bricksFundstatus')) {
      echo $this->session->userdata('bricksFundstatus');
      $this->session->unset_userdata('projectMsg');
    }
    ?>
    <?php
        if ($this->session->has_userdata('projectMsg')) {
            echo $this->session->userdata('projectMsg');
            $this->session->unset_userdata('projectMsg');
        }
      ?>
   <!-- Shiv Web Developer -->
 </div>
 <div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
   <div class="card flex-row border-0" style="width: 100%;">
     <form method="POST" action="" class="card border-0" style="box-shadow: none; margin: auto;">
       <div class="card-body row ">
         <div class="col-6 UserProfileTable my_section">
           <h5 class="fw-semibold">User Profile / Human Token - <?= $getProfile['humontoken'] ?> </h5> <br />
           <div class="position-relative ms-auto mb-3">
             <img src="<?= base_url('uploads/user_profile/' . $getProfile['user_image'] ?? 'assets/images/img/user.png') ?>"
               alt="User" id="profile-picture"
               class="rounded-circle border shadow" style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;">
             <input type="file" id="uploadImage" style="display: none;" accept="image/*">

             <?php

              $kyc = $this->CommonModal->getSingleRowById('tbl_userkyc', ['user_id' => sessionId('freelancer_id')]);
              // print_r($kyc);
              if (!empty($kyc)): ?>
               <?php if ($kyc['status'] == 'verified') { ?>
                 <img src="<?= base_url('/assets/check-mark.png') ?>" alt="User" id="profile-picture"
                   class="rounded-circle border shadow"
                   style="width: 40px; height: 40px; object-fit: cover; margin-top: 50px;">
               <?php } else if ($kyc['status'] == 'pending') { ?>
                 <img src="<?= base_url('/assets/pending.png') ?>" alt="User" id="profile-picture"
                   class="rounded-circle border shadow"
                   style="width: 40px; height: 40px; object-fit: cover; margin-top: 50px;">
               <?php } else if ($kyc['status'] == 'rejected') { ?>
                 <img src="<?= base_url('/assets/failed.png') ?>" alt="User" id="profile-picture"
                   class="rounded-circle border shadow"
                   style="width: 40px; height: 40px; object-fit: cover; margin-top: 50px;">
               <?php } else {
                  echo '';
                } ?>
             <?php endif; ?>


           </div>
           <div class="d-flex mb-3 ">
             <div class="d-flex flex-wrap gap-2">
               <a href="<?= base_url('company/user_preview') ?>" class="btn btn-primary fs-6 d-block">
                 <i class="bi bi-eye me-1"></i><br> Preview
               </a>
               <button class="btn btn-primary px-5 fs-6" type="submit" id="updateButton"> Update</button>
               <button type="button" id="moneyWallet" class="btn fs-6" style="background: linear-gradient(to right, #8B4513, #A0522D); color: white;">
                 <i class="bi bi-wallet2 me-1"></i> Wallet
               </button>
                <div class="celebrity-wrapper d-flex position-relative">
                  <span class="position-absolute text-light rounded-top px-2 py-1 " style="background: linear-gradient(to right, #00B8D6, #00B8D6);" >Help me to become celebrity!</span>
                  <button type="button" class="btn btn-primary rounded-0 rounded-start fs-6 postTaskButtonpersonal" style="z-index: 1;" id="postTaskButton" style="border-radius:6px 0px 0px 6px; background: linear-gradient(to right, #8B4513, #A0522D) !important;" >Personal<br> Tasks</button>
                  <button type="button" class="btn rounded-0 rounded-end fs-6 text-light professionalTaskButtonprofessional" style="z-index: 1; background: linear-gradient(to right, #8B4513, #A0522D) !important" id="professionalTaskButton">Professional<br> Tasks</button>
                </div>
                <button type="button" id="openkycbtn" class="btn" style="background: linear-gradient(to right, #00B8D6, #00B8D6); color: white;">
                  <i class="bi bi-person-lines-fill me-1"></i> KYC
                </button>
                <button type="button" class="btn btn-primary w-4" id="artificial-family" style="border-radius: 6px 6px 6px 6px;">
                  <a href="<?= base_url('company/tree-making') ?>" class="text-white mt-2"> Artificial<br> Family </a>
                </button>
                <button type="button" class="btn btn-primary w-4" id="artificial-family" style="border-radius: 6px 6px 6px 6px;">
                  <a href="<?= base_url('company/mimic-profile') ?>" class="text-white mt-2"> Mimic<br> Profile </a>
                </button>
             </div>
             <!-- <div class="d-flex align-items-center mx-3">
               <a href="https://wa.me/<?= $getProfile['phone'] ?? '' ?>" target="_blank">
                 <i class="bi bi-whatsapp" style="font-size: 25px; color: #25D366;"></i>
               </a>
             </div> -->
             

           </div>

           <table class="table table-bordered table-responsive">
             <thead>
               <!-- <tr>
              <th> User Profile</th>
            </tr> -->
             </thead>
             <tbody>
               <tr>
                 <td>
                   <div class="d-flex  gap-2">
                     <strong>
                       <label class="form-label mb-0 border  px-4 py-2 bg-light text-nowrap" style="width:160px !important;">Name</label>
                     </strong>
                     <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?= $getProfile['name'] ?? '' ?>" style="border-radius:0px;" required>
                     <small class="text-danger"><?= form_error('name'); ?></small>
                   </div>
                 </td>
               </tr>
               <tr>
                 <td>
                   <div class="d-flex  gap-2">
                     <strong>
                       <label class="form-label mb-0 border px-4 py-2 bg-light text-nowrap" style="min-width: 160px;">Mobile Number</label>
                     </strong>
                     <input type="tel" class="form-control" name="phone" placeholder="Mobile Number" value="<?= $getProfile['phone'] ?? '' ?>" maxlength="10" style="border-radius:0px;">
                     <small class="text-danger"><?= form_error('phone'); ?></small>
                   </div>
                 </td>
               </tr>
               <tr>
                 <td>
                   <div class="d-flex gap-2">
                     <strong>
                       <label class="form-label mb-0 border px-4 py-2 bg-light text-nowrap" style="min-width: 160px;">Email Address</label>
                     </strong>
                     <input type="email" class="form-control" name="email" placeholder="Email" value="<?= $getProfile['email'] ?? '' ?>" style="border-radius:0px;" required>
                     <small class="text-danger"><?= form_error('email'); ?></small>

                   </div>
                 </td>
               </tr>
               <tr>
                 <td>
                   <div class="d-flex align-items-center gap-2">
                     <strong>
                       <label class="form-label mb-0 border px-4 py-2 bg-light text-nowrap" style="min-width: 160px;">Date of birth</label>
                     </strong>
                     <input type="date" class="form-control" name="dob" value="<?= $getProfile['dob'] ?? '' ?>" style="border-radius:0px;" required>
                     <small class="text-danger"><?= form_error('dob'); ?></small>
                   </div>
                 </td>
               </tr>
               <tr>
                 <td>
                   <div class="d-flex align-items-center gap-2">
                     <strong>
                       <label class="form-label mb-0 border px-4 py-2 bg-light text-nowrap" style="min-width: 160px;">Address</label>
                     </strong>
                     <input type="text" class="form-control" name="address" placeholder="Home Address" value="<?= $getProfile['address'] ?? '' ?>" style="border-radius:0px;" required>
                     <small class="text-danger"><?= form_error('address'); ?></small>
                   </div>
                 </td>
               </tr>
               <tr>
                 <td>
                   <div class="d-flex align-items-center gap-2">
                     <strong>
                       <label class="form-label mb-0 border px-4 py-2 bg-light text-nowrap" style="min-width: 160px;">Country</label>
                     </strong>
                     <select class="form-control" name="country" id="country" style="border-radius:0px;" required>
                       <option disabled selected>Choose Country</option>
                       <?php
                        if (!empty($getCountries)):
                          foreach ($getCountries as $country):
                        ?>
                           <option value="<?= $country['id'] ?>" <?= $country['id'] === $getProfile['country'] ? 'selected' : '' ?>><?= $country['name'] ?></option>
                       <?php endforeach;
                        endif; ?>
                     </select>
                     <small class="text-danger"><?= form_error('country'); ?></small>
                   </div>
                 </td>
               </tr>
               <tr>
                 <td>
                   <div class="d-flex align-items-center gap-2">
                     <strong>
                       <label class="form-label mb-0 border  px-4 py-2 bg-light text-nowrap" style="min-width:160px;">State</label>
                     </strong>
                     <select class="form-control" name="state" id="state" style="border-radius:0px;" required>
                       <option disabled selected>Choose Country First</option>
                     </select>
                     <small class="text-danger"><?= form_error('state'); ?></small>
                   </div>
                 </td>
               </tr>
               <tr>
                 <td>
                   <div class="d-flex align-items-center gap-2">
                     <strong>
                       <label class="form-label mb-0 border px-4 py-2 bg-light text-nowrap" style="min-width: 160px;">City</label>
                     </strong>
                     <!-- <select class="form-control" name="city" id="city" style="width: 160px;">
                      <option disabled selected>Choose State First</option>
                    </select> -->
                     <input type="text" class="form-control" name="city" id="city" placeholder="City" value="<?= $getProfile['city'] ?>" style="border-radius:0px;" required>
                     <small class="text-danger"><?= form_error('city'); ?></small>
                   </div>
                 </td>
               </tr>
               <tr>
                 <td>
                   <div class="d-flex align-items-center gap-2">
                     <strong>
                       <label class="form-label mb-0 border  px-4 py-2 bg-light text-nowrap" style="min-width: 160px;">Zip Code</label>
                     </strong>
                     <input type="number" class="form-control" name="zipcode" placeholder="ZIP Code" value="<?= $getProfile['zipcode'] ?>" style="border-radius:0px;">
                     <small class="text-danger"><?= form_error('zipcode'); ?></small>
                   </div>
                 </td>
               </tr>
             </tbody>
           </table>
         </div>

         <div class="col-6 my_section">
           <!-- Right Column (Stats Section) -->
           <div class="col-12 col-md-6 col-lg-12 mt-md-0 d-flex flex-column gap-3">
             <div class="my_height" style="height:153px; weidth:100px;"> </div>
             <div class="d-flex align-items-center gap-1">
              <div class="position-relative">
               <div class="d-flex">
                 <button type="button" class="btn btn-primary w-48 m-1">
                   <i class="bi bi-mic-fill m-0 fs-6"></i>
                 </button>
               </div>
             </div>
             <div class="position-relative">
               <div class="d-flex justify-content-end">
                 <button type="button" class="btn btn-primary w-48 m-1">
                   <i class="bi bi-file-earmark-fill m-0 fs-6"></i>
                 </button>
               </div>
             </div>
               <div class="position-relative">
                 <div class="d-flex justify-content-end">
                   <button type="button" class="btn btn-primary">
                     <i class="bi bi-camera-video-fill m-0 fs-6"></i>
                   </button>
                   <input type="text" value="200 INR/Min" class="ms-2 align-self-center" style="font-size: 14px; color: #333; background-color: #fff; padding: 7px 10px; border-radius: 0px; border: 1px solid #ccc; width:120px;">
                 </div>
               </div>
               <button type="button" id="network_btn" class="btn" style="background: linear-gradient(to right, #8B4513, #A0522D); color: white;">
                 <i class="bi bi-person-lines-fill me-1"></i> Network
               </button>
               <a href="<?= base_url('/company/user-profile-resume') ?>" class="btn btn-primary text-white"> Resume PDF </a>
               <button type="button" id="opennetworthbtn" class="btn" style="background: linear-gradient(to right, #00B8D6, #00B8D6); color: white;">
                 <i class="bi bi-person-lines-fill me-1"></i> Networth
               </button>
             </div>
             <?php
              $stats = [
                "Company" => $getCompanyCount ?? 0,
                "Projects" => $getProjectCount ?? 0,
                "Bricks" => $getUserCount ?? 0,
                "Applied Brick for funding" => $total_ventures ?? 0,
                "Allocated brick value" => $total_ventures ?? 0,
                "Brick participated as team members" => $total_ventures ?? 0,
                "Company Following" => $total_ventures ?? 0,
                "Projects Following" => $total_ventures ?? 0
              ];

              foreach ($stats as $label => $value): ?>
               <div class="d-flex align-items-center gap-3">
                 <div class="border rounded px-4 py-2 bg-light text-nowrap" style="width:40%;">
                   <strong><?= $label ?>:</strong>
                 </div>
                 <div class="d-flex align-items-center gap-2">
                   <div class="border rounded px-4 py-2 bg-white text-center shadow-sm" style="min-width: 100px;">
                     <input type="text" class="form-control border-0 p-0 text-center"
                       value="<?= $value ?>" style="font-weight: bold; background: transparent; width: 100%; box-shadow: none; outline: none;">
                   </div>

                   <!-- Filter Buttons -->
                   <?php if ($label === "Company"): ?>
                     <button type="button" class="btn btn-sm btn-outline-secondary" title="Filter 1" data-bs-toggle="modal" data-bs-target="#filterModal">
                       <i class="bi bi-funnel"></i>
                     </button>
                     <button type="button" class="btn btn-sm btn-outline-secondary" title="Filter 2" data-bs-toggle="modal" data-bs-target="#companyFilter2">
                       <i class="bi bi-sliders"></i>
                     </button>
                   <?php elseif ($label === "Projects"): ?>
                     <button type="button" class="btn btn-sm btn-outline-secondary" title="Filter" data-bs-toggle="modal" data-bs-target="#projectFilter">
                       <i class="bi bi-funnel"></i>
                     </button>
                   <?php endif; ?>
                 </div>
               </div>
             <?php endforeach; ?>
           </div> <br /> <br /> <br />
         </div>
          <div class="col-12 mt-3">
            <div class="ruler">
              <?php 
              $totalUnits = 15;
              $subTicks = 10;
              
              for ($i = 0; $i <= $totalUnits; $i++): ?>

                  <!-- Big Tick -->
                  <div class="tick big">
                      <span class="label"><?= $i * 10 ?></span>
                  </div>

                  <!-- Small Ticks -->
                  <?php if ($i < $totalUnits): ?>
                      <?php for ($j = 1; $j <= $subTicks; $j++): ?>
                          <div class="tick small <?= ($j == 5) ? 'medium' : '' ?>"></div>
                      <?php endfor; ?>
                  <?php endif; ?>

              <?php endfor; ?>
            <div class="ruler-line">
              <div class="ruler-handle" id="rulerHandle">
                <i class="custom-arrow"></i>
                <i class="fa-solid fa-hourglass fs-5"></i>
              </div>
            </div>
            </div>
          </div>
     </form>
    </div>
     <div class="card-body row align-content-start">
      <!-- TOGGLE FUNCTION FOR PRESS RELEASE  -->

                  <!-- Filters Section -->
                  <div class="p-2">
                      <i id="toggleFilters" class="fa fa-bars cursor-pointer"></i>
                  </div>
                  <div class="filters" id="filtersSection" style="width:400px; margin-top: 0; display: <?php echo validation_errors() ? 'none' : 'none'; ?>">
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
                          <div class="ps-0 form-check form-switch d-flex justify-content-between my-4">
                              <button class="btn btn-primary" style="" id="publishArticleBtn">Publish/Send My Articles</button>
                          </div>
                          <div class="position-relative">
                              <input type="text" name="text_search" id="text_search_press_release" class="form-control mt-3" placeholder="Search Press Release">
                              <button id="press_release_search_btn" type="button" class="btn btn-outline-secondary position-absolute search-btn">
                                <i class="fa fa-search" style="color: #555;"></i>
                              </button>
                          </div>
                          <div class="pb-2 mb-3 mt-4">
                              <form action="<?= base_url('/company/user-press-release') ?>" method="post">
                                  <input type="hidden" name="user_id" value="<?= sessionId('freelancer_id') ?>">
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
                          <div id="press_release_container" style="overflow-y: auto; max-height: 500px;">

                          <?php
                            $getRelease = $this->CommonModal->getRowByIdInOrder('tbl_user_press_release', ['user_id' => sessionId('freelancer_id')], 'created_date', 'DESC');

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

                                      <a href="<?= base_url("user/press-release/$release[id]") ?>">
                                        <!-- <span class="px-3 py-0 mx-3 viewgetpressrelease" style="width:5px; height:20px; cursor: pointer;"
                                          data-press-view="<?= $release['id'] ?>">  </span> -->
                                          👁️
                                      </a>
                                      <span class="px-3 py-0 mx-3 getpressreleaseedit" style="width:5px; height:20px; cursor: pointer;"
                                          data-press="<?= $release['id'] ?>"> ✏️ </span>
                                      <a class="text-danger mx-3" title="Remove Member" href="<?= base_url('Home/deletePressReleaseUser?id=' . $release['id']) ?>" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></a>

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
                                          <form action="<?= base_url('/company/user-press-release') ?>" method="post">
                                              <div class="row h-100 align-items-start">
                                                <div id="press_release_edit_container" class="col-8">
                                                  <div class="form-group my-5" style="width:300px;">
                                                    <label> Story Time </label>
                                                    <select class="form-select storytime" name="storytime">
                                                        <!-- <option value="24H"> 24 Hours </option> -->
                                                        <option value="lifetime"> Lifetime </option>
                                                        <option value="10Year"> 10 Year </option>
                                                        <option value="5Year"> 5 Year </option>
                                                        <option value="1Year"> 1 Year </option>
                                                        <option value="6Months"> 6 Months </option>
                                                        <option value="1Month"> 1 Month </option>
                                                        <option value="1Week"> 1 Week </option>
                                                        <option value="1Day"> 24 Hours </option>
                                                    </select>
                                                  </div>

                                                <div class="form-group my-5">
                                                    <label> Short Description</label>
                                                    <textarea name="press_release" class="form-control" id="myTextarea2" placeholder="Enter" for="" class="form-control form-control-rounded" required></textarea>
                                                    <div id="wordCounter2" class="counter2">0 / 60 words</div>
                                                    <input type="hidden" name="id" value="" placeholder="Press Release Id" />
                                                    <input type="hidden" name="user_id" value="<?= sessionId('freelancer_id') ?>">
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
     </div>
   </div>
   <div class="row">
      <div class="col-12" style="margin-top: 60px;">
           <label class="form-label small text-muted">Number Boxes</label>
           <div class="d-flex gap-3 flex-wrap align-items-center" id="numberBoxContainer">
             <?php for ($i = 1; $i <= 7; $i++): ?>
               <div class="number-box d-flex justify-content-center align-items-center fw-bold text-center"
                 style="width: 50px; height: 50px; border: 1px solid #ced4da; border-radius: 4px; cursor: pointer;"
                 data-box="<?= $i ?>">
                 <?= $i ?>
               </div>
             <?php endfor; ?>
             <button type="button"
               class="btn d-flex align-items-center justify-content-center fw-bold text-center"
               style="width: 50px; height: 50px; border: 1px solid #ced4da; border-radius: 4px; cursor: pointer;">
               <i class="bi bi-plus-lg"></i>
             </button>
              <button type="button" class="btn btn-primary w-4 " id="mycalendar" style="border-radius: 6px 6px 6px 6px;">
                <a href="<?= base_url('/calendar/index') ?>" class="text-white mt-2"> My<br> Calendar </a>
              </button>
           </div>
         </div>
         <div id="dynamicContent" class="d-flex flex-column  gap-2 mt-3"
           style="max-width: 100%; display: none;">
         </div>
         <div id="outputBlocks" class="outputBlocks"></div>
       </div>
 </div>

 <!-- Money Wallet  -->
 <div class="modal-overlay" id="moneywalletmodel">
   <div class="modal-box">
     <span class="modal-close" onclick="moneywalletcloseModal()">&times;</span>
     <h3> Money Trasfer </h3>

     <form action="<?= base_url('/company/moneywallet_transfer') ?>" id="moneywallet_transfer" method="post">
       <table class="custom-table">
         <thead>
           <tr>
             <td colspan="2">
               <div class="wallet-summary">
                 <h6 style="font-size:16px;">Wallet Summary</h6>
                 <div style="font-size:14px;"><strong>Credit:</strong> ₹<?= number_format($wallet_credit, 2) ?></div>
                 <div style="font-size:14px;"><strong>Debit:</strong> ₹<?= number_format($wallet_debit, 2) ?></div>
                 <div style="font-size:14px;"><strong>Available Balance:</strong> ₹<?= number_format($wallet_balance, 2) ?></div>
               </div>

             </td>
           </tr>
           <tr>
             <th>#</th>
             <th>Amount</th>
           </tr>
         </thead>
         <tbody>
           <tr>
             <td></td>
             <td>
               <input class="table-input" type="number" id="amount" name="amount" placeholder="Enter Amount">
             </td>
           </tr>
         </tbody>
       </table>
       <div class="text-end mt-3">
         <button type="submit" class="save-btn">Transfer</button>
       </div>
     </form>
   </div>
 </div>



<div class="modal-overlay" id="openkyc" style="width:100%">
  <div class="modal-box">
    <span class="modal-close" onclick="kyccloseModal()">&times;</span>

    <h3>USER KYC</h3>

    <!-- STATUS MESSAGE -->
    <?php if (!empty($kyc)): ?>
      <?php $status = strtolower(trim($kyc['status'])); ?>
      <?php if ($status == 'verified'): ?>
        <p class="alert alert-success">Your KYC is Already Verified!</p>
      <?php elseif ($status == 'pending'): ?>
        <p class="alert alert-warning">Your KYC is Under Process</p>
      <?php elseif ($status == 'rejected'): ?>
        <p class="alert alert-danger">Your KYC is Rejected by Department</p>
      <?php endif; ?>
    <?php endif; ?>

    <!-- FORM START -->
    <form action="<?= base_url('/company/user_kyc'); ?>" method="post">

      <?php if (empty($kyc) || $kyc['status'] == 'rejected'): ?>
        <div class="mt-4">
          <h5>Digital Identity</h5>

          <div class="my-3">
            <label>Country Name</label>
            <input type="text" name="kyc_country" class="form-control" required>
          </div>

          <div class="my-3">
            <label>Token Id</label>
            <input type="text" name="kyc_tokenid" class="form-control" required>
          </div>

          <div class="my-3">
            <label>Aadhaar Card</label>
            <input type="text" name="kyc_adharcard" class="form-control" required>
          </div>

          <div class="my-3">
            <label>PAN Card</label>
            <input type="text" name="kyc_pancard" class="form-control" required>
          </div>
        </div>
      <?php endif; ?>
        <a class="btn btn-primary d-inline" href="<?= base_url('company/medical-identity')?>">Medical Identity</a>
  </div>
</div>










 <!-- NETWORTH  -->



 <?php
  // 1. Get all 'plus' networth entries
  $plusRows = $this->CommonModal->getRowsByMultipleWhere('tbl_networth', [
    'networth_type' => 'plus',
    'user_id' => sessionId('freelancer_id')
  ]);

  // 2. Get all 'minus' networth entries
  $minusRows = $this->CommonModal->getRowsByMultipleWhere('tbl_networth', [
    'networth_type' => 'minus',
    'user_id' => sessionId('freelancer_id')
  ]);

  $plustotalAmount = 0;
  $minustotalAmount = 0;

  // 3. Calculate total for plus
  if (!empty($plusRows)) {
    foreach ($plusRows as $row) {
      $plustotalAmount += (float) $row['networth_amount'];
    }
  }

  // 4. Calculate total for minus
  if (!empty($minusRows)) {
    foreach ($minusRows as $row) {
      $minustotalAmount += (float) $row['networth_amount'];
    }
  }

  // 5. Net total
  $netTotal = $plustotalAmount - $minustotalAmount;
  ?>


 <div class="modal-overlay" id="opennetworth" style="width:100% !important">
   <div class="modal-box" style="max-width:90% !important; height: 90%; overflow-y: scroll;">
     <span class="modal-close" onclick="networthcloseModal()">&times;</span>
     <h3>Networth: [ Rs. <?= $netTotal; ?> /- ] </h3>
     <div class="row">
      <div class="col-12">
        <div class="d-flex align-items-center mt-4">
          <span class="fs-5">Company Valuation</span>
          <span class="btn btn-primary px-3 py-0 mx-3" id="getvaluationbyproject"> View Details </span>
        </div>
        <hr>
      </div>
     </div>
     <div class="row">
       <div class="col-6" style="border-right: 2px solid grey; overflow-y: scroll; height:650px;">
         <table style="display: inline-block;">
           <tbody>
             <div>Plus (+) Assets </div> <br />
             <form action="<?= base_url('/company/add_networth'); ?>" method="post">
               <div class="d-flex">
                 <input type="hidden" name="networth_type" value="plus" placeholder="Text" class="form-control" style="border-radius:0px;" required>
                 <div class="d-flex">
                   <input type="text" name="networth_text" placeholder="Text" class="form-control" style="border-radius:0px;" required>
                   <!-- <button type="button" class="btn btn-primary" style="border-radius:0px;"> + </button> -->
                 </div>
                 <div class="d-flex mx-3">
                   <input type="text" name="networth_proof" placeholder="Proof Link" class="form-control" style="border-radius:0px;" required>
                   <!-- <button type="button" class="btn btn-primary" style="border-radius:0px;"> + </button> -->
                 </div>
                 <div class="d-flex">
                   <input type="text" name="networth_amount" placeholder="Number" class="form-control" style="border-radius:0px;" required>
                   <!-- <button type="button" class="btn btn-primary" style="border-radius:0px;"> + </button> -->
                 </div>
               </div>
               <button type="submit" class="btn btn-primary mt-5" style="border-radius:0px;"> Submit </button>
             </form>
             <div class="shownetworth mt-5">
               <div class="d-flex mb-3">
                 <!-- <p class="px-1"> 1</p> -->
                 <div class="" style="width:33%">
                   <div> <strong> TEXT </strong> </div>
                 </div>
                 <div class="mx-3" style="width:30%">
                   <div> <strong> PROOF </strong> </div>
                 </div>
                 <div class="" style="width:33%">
                   <div> <strong> NUMBER </strong> </div>
                 </div>
               </div>

               <?php
                $mynetworth = $this->CommonModal->getRowsByMultipleWhere('tbl_networth', ['networth_type' => 'plus', 'user_id' => sessionId('freelancer_id')]);
                $plustotalAmount = 0; // Initialize total
                if (!empty($mynetworth)):
                  foreach ($mynetworth as $networth):
                    $plustotalAmount += (float)$networth['networth_amount']; // Accumulate total
                ?>

                   <div class="row">
                     <div class="col-lg-4">
                       <p style="overflow-wrap: anywhere;">
                         <?= $networth['networth_text'] ?>
                       </p>
                     </div>
                     <div class="col-lg-4">
                       <div style="overflow-wrap: anywhere;"> <?= $networth['networth_proof'] ?> </div>
                     </div>
                     <div class="col-lg-3">
                       <div style="overflow-wrap: anywhere;"> Rs. <?= $networth['networth_amount'] ?>/- </div>
                     </div>
                     <div class="col-lg-1">
                       <a class="text-danger" title="Remove Member" href="<?= base_url('Home/deleteNeworth?id=' . $networth['id']) ?>" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></a>
                     </div>
                   </div>
                   <hr>
                 <?php
                  endforeach;
                  ?>

                 <div class="d-flex">
                   <div class="" style="width:33%">
                   </div>
                   <div class="mx-3" style="width:33%">
                   </div>
                   <div class="" style="width:33%">
                     <div> <strong> TOTAL NUMBER </strong> </div>
                     <div> Rs. <?= number_format($plustotalAmount, 2) ?>/- </div>
                   </div>
                 </div>
               <?php endif; ?>
               <hr />
             </div>



           </tbody>
           </tbody>
         </table>
       </div>
       <div class="col-6" style="border-right: 2px solid grey; overflow-y: scroll; height:650px;">
         <table style="display: inline-block;">
           <tbody>
             <div>Minus (-) Liabilities </div> <br />
           <tbody>
             <form action="<?= base_url('/company/add_networth'); ?>" method="post">
               <div class="d-flex">
                 <input type="hidden" name="networth_type" value="minus" placeholder="Text" class="form-control" style="border-radius:0px;" required>
                 <div class="d-flex">
                   <input type="text" name="networth_text" placeholder="Text" class="form-control" style="border-radius:0px;" required>
                   <!-- <button type="button" class="btn btn-primary" style="border-radius:0px;"> + </button> -->
                 </div>
                 <div class="d-flex mx-3">
                   <input type="text" name="networth_proof" placeholder="Proof Link" class="form-control" style="border-radius:0px;" required>
                   <!-- <button type="button" class="btn btn-primary" style="border-radius:0px;"> + </button> -->
                 </div>
                 <div class="d-flex">
                   <input type="text" name="networth_amount" placeholder="Number" class="form-control" style="border-radius:0px;" required>
                   <!-- <button type="button" class="btn btn-primary" style="border-radius:0px;"> + </button> -->
                 </div>
               </div>
               <button type="submit" class="btn btn-primary mt-5" style="border-radius:0px;"> Submit </button>
             </form>

             <div class="shownetworth mt-5">
               <div class="d-flex mb-3">
                 <!-- <p class="px-1"> 1</p> -->
                 <div class="" style="width:33%">
                   <div> <strong> TEXT </strong> </div>
                 </div>
                 <div class="mx-3" style="width:30%">
                   <div> <strong> PROOF </strong> </div>
                 </div>
                 <div class="" style="width:33%">
                   <div> <strong> NUMBER </strong> </div>
                 </div>
               </div>

               <?php
                $mynetworth = $this->CommonModal->getRowsByMultipleWhere('tbl_networth', ['networth_type' => 'minus', 'user_id' => sessionId('freelancer_id')]);
                $minustotalAmount = 0; // Initialize total
                if (!empty($mynetworth)):
                  foreach ($mynetworth as $networth):
                    $minustotalAmount += (float)$networth['networth_amount']; // Accumulate total
                ?>

                   <div class="row">
                     <div class="col-lg-4">
                       <p style="overflow-wrap: anywhere;">
                         <?= $networth['networth_text'] ?>
                       </p>
                     </div>
                     <div class="col-lg-4">
                       <div style="overflow-wrap: anywhere;"> <?= $networth['networth_proof'] ?> </div>
                     </div>
                     <div class="col-lg-3">
                       <div style="overflow-wrap: anywhere;"> Rs. <?= $networth['networth_amount'] ?>/- </div>
                     </div>
                     <div class="col-lg-1">
                       <a class="text-danger" title="Remove Member" href="<?= base_url('Home/deleteNeworth?id=' . $networth['id']) ?>" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></a>
                     </div>
                   </div>
                   <hr>
                 <?php
                  endforeach;
                  ?>

                 <div class="d-flex">
                   <div class="" style="width:33%">
                   </div>
                   <div class="mx-3" style="width:33%">
                   </div>
                   <div class="" style="width:33%">
                     <div> <strong> TOTAL NUMBER </strong> </div>
                     <div> Rs. <?= number_format($minustotalAmount, 2) ?>/- </div>
                   </div>
                 </div>
               <?php endif; ?>
               <hr />
             </div>


           </tbody>
           </tbody>
         </table>

       </div>
     </div>
   </div>
 </div>

 <div class="modal-overlay" id="valuationModel" style="width:100% !important">
    <div class="modal-box" style="max-width:90% !important; height: 90%; overflow-y: scroll;">
        <span class="modal-close" onclick="closeValuationModal()">&times;</span>
        <h3>Added Valuation</h3>
        <table class="custom-table">
            <tbody>
                <!-- Container where details will be loaded -->
                <div class="addevValuation_Container"></div>
            </tbody>
        </table>
    </div>
 </div>

 <div class="modal-overlay" id="taskModal" style="width:100% !important">
   <div class="modal-box" style="max-width:90% !important; height: 90%; overflow-y: scroll;">
     <span class="modal-close" onclick="closeModal()">&times;</span>
     <h3>My Brick List</h3>
     <div style="text-align:center; display: flex; justify-content: center">
       <button type="button" class="btn btn-primary w-48 postTaskButtonpersonal" style="border-radius:6px 0px 0px 6px;">Personal Tasks </button>
       <button type="button" class="btn btn-secondary w-48 professionalTaskButtonprofessional" style="border-radius:0px 6px 6px 0px;">Professional Tasks</button>
       <a href="<?= base_url('/company/create-brick') ?>" class="btn btn-primary mx-3"> Create Brick </a>
     </div>
     <table class="custom-table">
       <tbody>
         <div id="companyList"> </div>

       </tbody>
     </table>

   </div>
 </div>



<div class="modal-overlay" id="networkModal" style="width:100% !important">
  <div class="modal-box" style="max-width:90% !important; height: 90%; overflow-y: scroll;">
    <span class="modal-close" onclick="closeNetworkModal()">&times;</span>

    <h3>My Networks</h3>

    <div class="container">
      <div class="row">
        <div class="table-responsive">
          <table class="my-custom-table table-bordered">
            <thead class="text-center">
              <tr>
                <th class="col-1">Profile</th>
                <th class="col-4">Name</th>
                <th class="col-3">Email</th>
                <th class="col-2">Phone</th>
                <th class="col-1">City</th>
                <th class="col-1">Status</th>
              </tr>
            </thead>

            <tbody id="userList" class="text-center">
              <!-- users will be injected here -->
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>




 <!-- Shiv Web Developer -->
 <!-- Image Upload Modal -->
 <div class="modal fade" id="imageUploadModal" tabindex="-1" aria-labelledby="imageUploadModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
     <div class="modal-content p-3">
       <div class="modal-header">
         <h5 class="modal-title">Upload Images</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <input type="file" id="imageInput" multiple accept="image/*" class="form-control mb-3">
         <button class="btn btn-success mb-3" id="uploadImagesBtn">Upload Selected Images</button>
         <div id="uploadedImagesPreview" class="d-flex flex-wrap gap-2"></div>
       </div>
     </div>
   </div>
 </div>

 <!-- Document Upload Modal -->
 <div class="modal fade" id="documentUploadModal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content p-3">
       <h5>Upload Documents</h5>
       <input type="file" id="documentInput" class="form-control mb-2" multiple accept=".pdf,.doc,.docx">
       <div id="uploadedDocsPreview" class="d-flex gap-2 flex-wrap"></div>
       <button class="btn btn-primary mt-3" id="uploadDocsBtn">Upload</button>
     </div>
   </div>
 </div>


 <!-- LINK Docs/Video/Images Modal -->
 <div class="modal fade" id="linksModel" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content p-3">
       <h5>Links</h5>
       <input type="text" id="LinksInput" class="form-control mb-2" placeholder="Paste Link" required>
       <div class="d-flex">
         <input type="number" id="time" class="form-control mb-2" max="5" placeholder="Time" required>
         <select id="timeschedule" class="form-control mb-2" required>
           <option value="Min" selected> Min </option>
           <option value="Hours"> Hours </option>
         </select>
       </div>
       <select id="linkscategory" class="form-control mb-2" required>
         <option value="" selected disabled> Select Category </option>
         <option value="Video"> Videos </option>
         <option value="Image"> Images </option>
         <option value="Docs"> Docs </option>
         <option value="Audio"> Audio </option>
         <option value="Websites"> Websites </option>
         <option value="Other"> Other </option>
       </select>

       <div id="uploadedLinksPreview" class="d-flex gap-2 flex-wrap"></div>
       <button class="btn btn-primary mt-3" id="SaveLinks">Save</button>
     </div>
   </div>
 </div>



 <!-- Video Upload Modal -->
 <div class="modal fade" id="videoUploadModal" tabindex="-1" aria-labelledby="videoUploadModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-scrollable">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="videoUploadModalLabel">Update Video</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>

       <div class="modal-body">
         <!-- Select Videos -->
         <div class="mb-3">
           <label class="form-label">Select Video(s)</label>
           <input type="file" class="form-control" id="videoInput" multiple accept="video/*">
         </div>

         <!-- Camera Recording -->
         <div class="mb-3">
           <label class="form-label">Record Video</label><br>
           <button id="startRecordingBtn" class="btn btn-sm btn-outline-primary me-2">▶️ Start Recording</button>
           <button id="stopRecordingBtn" class="btn btn-sm btn-outline-danger" disabled>⏹️ Stop Recording</button>
           <video id="recordPreview" controls style="display:none; width: 100%; margin-top: 10px; border-radius: 6px;"></video>
         </div>

         <!-- Preview Uploaded Videos -->
         <div class="mb-3">
           <label class="form-label">Previously Uploaded Videos</label>
           <div id="uploadedVideosPreview" class="d-flex flex-wrap gap-2 border rounded p-2 bg-light"></div>
         </div>
       </div>

       <div class="modal-footer">
         <button type="button" id="uploadVideosBtn" class="btn btn-success">Upload Video(s)</button>
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       </div>
     </div>
   </div>
 </div>
 
<div class="modal-overlay" id="PublishModel" style="width:100% !important">
    <div class="modal-box" style="max-width:90% !important; height: 90%; overflow-y: scroll;">
        <span class="modal-close" onclick="closePublishModel()">&times;</span>
        <div class="row">
          <div class="col-6">
            <h3>Publish/Send </h3>
            <form action="">
              <div class="mb-3">
                <label class="form-label">Global Agency</label>
                <select class="form-control" name="global_agency">
                  <option value="">-- Select Agency --</option>

                  <!-- United Nations -->
                  <optgroup label="United Nations (UN)">
                    <option value="UN Secretariat">UN Secretariat</option>
                    <option value="UNDP">UN Development Programme (UNDP)</option>
                    <option value="UNICEF">UNICEF</option>
                    <option value="UNESCO">UNESCO</option>
                    <option value="UNHCR">UN High Commissioner for Refugees (UNHCR)</option>
                    <option value="UNFPA">UN Population Fund (UNFPA)</option>
                    <option value="UNEP">UN Environment Programme (UNEP)</option>
                    <option value="WFP">World Food Programme (WFP)</option>
                    <option value="UNAIDS">UNAIDS</option>
                    <option value="UN Women">UN Women</option>
                  </optgroup>

                  <!-- WHO / Health -->
                  <optgroup label="Health & Medical">
                    <option value="WHO">World Health Organization (WHO)</option>
                    <option value="Global Fund">Global Fund (AIDS, TB, Malaria)</option>
                  </optgroup>

                  <!-- World Bank Group -->
                  <optgroup label="World Bank Group">
                    <option value="World Bank">World Bank (IBRD)</option>
                    <option value="IDA">International Development Association (IDA)</option>
                    <option value="IFC">International Finance Corporation (IFC)</option>
                    <option value="IMF">International Monetary Fund (IMF)</option>
                    <option value="MIGA">Multilateral Investment Guarantee Agency (MIGA)</option>
                  </optgroup>

                  <!-- Development Banks -->
                  <optgroup label="Development Banks">
                    <option value="ADB">Asian Development Bank (ADB)</option>
                    <option value="AfDB">African Development Bank (AfDB)</option>
                    <option value="IDB">Inter-American Development Bank (IDB)</option>
                    <option value="AIIB">Asian Infrastructure Investment Bank (AIIB)</option>
                    <option value="NDB">New Development Bank (BRICS Bank)</option>
                    <option value="EBRD">European Bank for Reconstruction & Development</option>
                  </optgroup>

                  <!-- Trade & Standards -->
                  <optgroup label="Trade & Standards">
                    <option value="WTO">World Trade Organization (WTO)</option>
                    <option value="ISO">International Organization for Standardization (ISO)</option>
                    <option value="WIPO">World Intellectual Property Organization (WIPO)</option>
                    <option value="ILO">International Labour Organization (ILO)</option>
                    <option value="FAO">Food and Agriculture Organization (FAO)</option>
                  </optgroup>

                  <!-- Science, Climate & Energy -->
                  <optgroup label="Science, Climate & Energy">
                    <option value="IAEA">International Atomic Energy Agency (IAEA)</option>
                    <option value="IPCC">Intergovernmental Panel on Climate Change (IPCC)</option>
                    <option value="UNFCCC">UN Framework Convention on Climate Change (UNFCCC)</option>
                    <option value="International Solar Alliance">International Solar Alliance</option>
                  </optgroup>

                  <!-- Other International Bodies -->
                  <optgroup label="Other International Organizations">
                    <option value="OECD">OECD</option>
                    <option value="Commonwealth Secretariat">Commonwealth Secretariat</option>
                    <option value="OPCW">Organisation for the Prohibition of Chemical Weapons (OPCW)</option>
                  </optgroup>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label">Select Country</label>
                <select class="form-control" name="country">
                  <option value="">-- Select Country --</option>
                  <option value="Afghanistan">Afghanistan</option>
                  <option value="Albania">Albania</option>
                  <option value="Algeria">Algeria</option>
                  <option value="Andorra">Andorra</option>
                  <option value="Angola">Angola</option>
                  <option value="Argentina">Argentina</option>
                  <option value="Armenia">Armenia</option>
                  <option value="Australia">Australia</option>
                  <option value="Austria">Austria</option>
                  <option value="Azerbaijan">Azerbaijan</option>
                  <option value="Bangladesh">Bangladesh</option>
                  <option value="Belgium">Belgium</option>
                  <option value="Bhutan">Bhutan</option>
                  <option value="Brazil">Brazil</option>
                  <option value="Canada">Canada</option>
                  <option value="China">China</option>
                  <option value="Colombia">Colombia</option>
                  <option value="Denmark">Denmark</option>
                  <option value="Egypt">Egypt</option>
                  <option value="Finland">Finland</option>
                  <option value="France">France</option>
                  <option value="Germany">Germany</option>
                  <option value="Greece">Greece</option>
                  <option value="Hong Kong">Hong Kong</option>
                  <option value="Iceland">Iceland</option>
                  <option value="India">India</option>
                  <option value="Indonesia">Indonesia</option>
                  <option value="Iran">Iran</option>
                  <option value="Iraq">Iraq</option>
                  <option value="Ireland">Ireland</option>
                  <option value="Israel">Israel</option>
                  <option value="Italy">Italy</option>
                  <option value="Japan">Japan</option>
                  <option value="Kenya">Kenya</option>
                  <option value="Malaysia">Malaysia</option>
                  <option value="Mexico">Mexico</option>
                  <option value="Nepal">Nepal</option>
                  <option value="Netherlands">Netherlands</option>
                  <option value="New Zealand">New Zealand</option>
                  <option value="Nigeria">Nigeria</option>
                  <option value="Norway">Norway</option>
                  <option value="Pakistan">Pakistan</option>
                  <option value="Philippines">Philippines</option>
                  <option value="Poland">Poland</option>
                  <option value="Portugal">Portugal</option>
                  <option value="Qatar">Qatar</option>
                  <option value="Russia">Russia</option>
                  <option value="Saudi Arabia">Saudi Arabia</option>
                  <option value="Singapore">Singapore</option>
                  <option value="South Africa">South Africa</option>
                  <option value="South Korea">South Korea</option>
                  <option value="Spain">Spain</option>
                  <option value="Sri Lanka">Sri Lanka</option>
                  <option value="Sweden">Sweden</option>
                  <option value="Switzerland">Switzerland</option>
                  <option value="Thailand">Thailand</option>
                  <option value="Turkey">Turkey</option>
                  <option value="UAE">United Arab Emirates</option>
                  <option value="UK">United Kingdom</option>
                  <option value="USA">United States</option>
                  <option value="Vietnam">Vietnam</option>
                  <option value="Zimbabwe">Zimbabwe</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Type of Region Specific</label>
                <input type="text" class="form-control">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Tranlational to Local Laungvages</label>
                <input type="text" class="form-control">
              </div>
              <button class="btn btn-primary">Search User</button>
              <pre>
                [3:27 PM, 1/26/2026] SHUBHAM Sir Bricks pay: Apply Research Jounerals .
[3:28 PM, 1/26/2026] SHUBHAM Sir Bricks pay: Connect with Translational Research Paper.
[3:41 PM, 1/26/2026] SHUBHAM Sir Bricks pay: ICMR 
DRDO
[3:43 PM, 1/26/2026] SHUBHAM Sir Bricks pay: ICCA
ICSI
MCA
PMO

Like Social Media - Repost. ( Make Money Making Process 0
[3:44 PM, 1/26/2026] SHUBHAM Sir Bricks pay: Reseach Jounerals
[3:49 PM, 1/26/2026] SHUBHAM Sir Bricks pay: Study The World Real Time = 

1. Global Agency - 
2. Select Country - 
3. Type of Region Specific - 
4. Type of Aera's of Expertize - 
5. Tranlational to Local Laungvages ?
[3:51 PM, 1/26/2026] SHUBHAM Sir Bricks pay: TOP of the mind prb - any relative u say give me food - relative ask u r aera people to deliver u food. 

so u can always stay intouch with your PA, PS & Person u desired , incase of permenent hiring.
[3:54 PM, 1/26/2026] SHUBHAM Sir Bricks pay: Myth Bustor 
Assumtion 
Prediction 


User to User 
User to Agency

network layer 
              </pre>
            </form>
          </div>
        </div>
    </div>
</div>
 <style>
   .boxBorder {
     border: 1px solid #007bff;
   }

   .boxBorder .input-box {
     position: relative;
     width: 100%;
   }

   .boxBorder .input-box input {
     width: 23px;
     padding-right: 0px;
   }

   .boxBorder .input-box i {
     position: absolute;
     right: 10px;
     top: 50%;
     transform: translateY(-50%);
     color: #333;
     pointer-events: none;
   }
 </style>


 <?php include('includes/footer.php') ?>
 <?php include('includes/footer-link.php') ?>

 <script>
   function generateAgeBlocks(dobString, gap) {
     const blockList = [];
     const today = new Date();
     const [day, month, year] = dobString.split(".");
     const dob = new Date(`${year}-${month}-${day}`);
     const currentYear = today.getFullYear();
     const birthYear = dob.getFullYear();

     let startYear = birthYear;
     let ageCounter = 0;

     while (startYear < currentYear) {
       const endYear = Math.min(startYear + gap, currentYear);
       blockList.push({
         yearRange: `${startYear} - ${endYear}`,
         ageRange: `${ageCounter} - ${ageCounter + (endYear - startYear)}`,
         description: ""
       });
       ageCounter += (endYear - startYear);
       startYear = endYear;
     }

     return blockList;
   }

   async function fetchExistingBlocks(gapType) {
     const response = await fetch(`<?= base_url('Home/get_blocks_by_gap') ?>?gap_type=${gapType}`);
     const data = await response.json();
     const map = {};
     if (data === false) return map;
     data.forEach(item => {
       map[item.age_range] = item.description;
     });
     return map;
   }

   function formatDateTime(dateString) {
     const date = new Date(dateString);

     const year = date.getFullYear();
     const month = String(date.getMonth() + 1).padStart(2, '0');
     const day = String(date.getDate()).padStart(2, '0');

     const hours = String(date.getHours()).padStart(2, '0');
     const minutes = String(date.getMinutes()).padStart(2, '0');
     const seconds = String(date.getSeconds()).padStart(2, '0');

     return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
   }


   async function renderBlocks(blocks, gap) {
     const container = document.getElementById("outputBlocks");
     container.innerHTML = `<h5>Gap: ${gap}-Year Blocks</h5>`;
     const gapType = `${gap}_year`
     const existingDescriptions = await fetchExistingBlocks(gapType);

     blocks.forEach((block, index) => {
       const blockDiv = document.createElement("div");
       blockDiv.className = "block-container d-flex gap-3 mb-3 boxBorder";
       const [startYear, endYear] = block.yearRange.split("-").map(y => y.trim());
       const existingDescription = existingDescriptions[block.ageRange] || "";

       blockDiv.innerHTML = `
       <div class="grid-box yearRange" style="width: 160px;">
            ${block.yearRange} <br/> 
            <div class="input-box">
              <input 
                type="datetime-local"
                id="artificialdate"
                class="artificialdate"
                name="artificialdate"
                min="${startYear}-01-01T00:00"
                max="${endYear}-12-31T23:59"
                value="${block.artificialdate}"
              >
            </div>
          </div>
         <div class="grid-box age" style="width: 120px;">${block.ageRange} yrs</div>
        <div class="grid-box flex-grow-1">
          <textarea rows="3" class="form-control mb-2 description" placeholder="Enter your description">${existingDescription}</textarea>
          <div class="d-flex gap-2">
            <button class="btn btn-success btn-sm updateBtn">Update</button>
            <button class="btn btn-primary btn-sm updateVideo"><i class="fas fa-video icon"></i></button>
            <button class="btn btn-warning btn-sm updateImage"><i class="fas fa-image icon"></i></button>
            <button class="btn btn-purple btn-sm updateDocument"><i class="fas fa-file-alt icon"></i></button>
            <button class="btn btn-purple btn-sm linkButton"><i class="fa-solid fa-link"></i></button>
          </div>
        </div>`;

       container.appendChild(blockDiv);
     });

     // Add event listeners to each update button
     const updateButtons = document.querySelectorAll(".updateBtn");

     updateButtons.forEach((btn) => {
       btn.addEventListener("click", function(e) {
         e.preventDefault();
         const block = this.closest(".block-container");

         const yearRange = block.querySelector(".yearRange").innerText;
         let ageRange = block.querySelector(".age").innerText;
         const description = block.querySelector(".description").value;
         //  const artificialDate = block.querySelector(".artificialdate").value;
         let artificialDate = block.querySelector(".artificialdate").value;
         artificialDate = formatDateTime(artificialDate);

         ageRange = ageRange.replace(/ *yrs/i, "")
         const payload = {
           user_id: 1,
           year_range: yearRange,
           age_range: ageRange,
           description: description,
           artificialdate: artificialDate,
           gap_type: `${gap}_year`
         };

         // Send single block to CI3 backend
         fetch("<?= base_url('Home/insert_blocks') ?>", {
             method: "POST",
             headers: {
               "Content-Type": "application/json"
             },
             body: JSON.stringify([payload])
           })
           .then(res => res.json())
           .then(res => {
            console.log(res)
             if (res.status === "success") {
               alert("Block saved successfully!");
             } else {
               alert("Something went wrong.");
             }
           });
       });
     });

     let selectedAgeRange = "";
     let selectedGapType = "";
     let selectedUserId = 1; // Replace dynamically if needed
     let artificialdate = "";

     document.addEventListener("click", function(e) {
       if (e.target.closest(".updateImage")) {
         e.preventDefault();
         const block = e.target.closest(".block-container");
         selectedAgeRange = block.querySelector(".age").innerText.replace(/ *yrs/i, "").trim();
         selectedGapType = `${gap}_year`; // use current gap type

         // Show modal
         const imageModal = new bootstrap.Modal(document.getElementById("imageUploadModal"));
         imageModal.show();

         // Fetch already uploaded images
         fetchUploadedImages();
       }
     });

     function fetchUploadedImages() {
       const preview = document.getElementById("uploadedImagesPreview");
       preview.innerHTML = "Loading...";

       fetch(`<?= base_url('Home/get_uploaded_images') ?>?user_id=${selectedUserId}&age_range=${selectedAgeRange}&gap_type=${selectedGapType}`)
         .then(res => res.json())
         .then(images => {
           preview.innerHTML = "";
           if (images.length > 0) {
             images.forEach(img => {
               const imgEl = document.createElement("img");
               imgEl.src = "<?= base_url() ?>uploads/age_block_images/" + img.image_url; // adjust if your image path is different
               imgEl.style.width = "100px";
               imgEl.style.borderRadius = "8px";
               preview.appendChild(imgEl);
             });
           } else {
             preview.innerHTML = "No images uploaded yet.";
           }
         });
     }

     document.getElementById("uploadImagesBtn").addEventListener("click", () => {
       const files = document.getElementById("imageInput").files;
       if (files.length === 0) return alert("Please select images.");

       const formData = new FormData();
       for (let file of files) {
         formData.append("images[]", file);
       }

       formData.append("user_id", selectedUserId);
       formData.append("age_range", selectedAgeRange);
       formData.append("gap_type", selectedGapType);

       fetch("<?= base_url('Home/upload_block_images') ?>", {
           method: "POST",
           body: formData
         }).then(res => res.json())
         .then(response => {
           if (response.status === "success") {
             alert("Images uploaded successfully!");
             fetchUploadedImages(); // refresh the list
             document.getElementById("imageInput").value = "";
           } else {
             alert("Failed to upload images.");
           }
         });
     });

     // Handle document upload button click
     document.addEventListener("click", function(e) {
       if (e.target.closest(".updateDocument")) {
         e.preventDefault();
         const block = e.target.closest(".block-container");
         selectedAgeRange = block.querySelector(".age").innerText.replace(/ *yrs/i, "").trim();
         selectedGapType = `${gap}_year`;

         const docModal = new bootstrap.Modal(document.getElementById("documentUploadModal"));
         docModal.show();

         fetchUploadedDocuments();
       }
     });

     function fetchUploadedDocuments() {
       const preview = document.getElementById("uploadedDocsPreview");
       preview.innerHTML = "Loading...";

       fetch(`<?= base_url('Home/get_uploaded_documents') ?>?user_id=${selectedUserId}&age_range=${selectedAgeRange}&gap_type=${selectedGapType}`)
         .then(res => res.json())
         .then(docs => {
           preview.innerHTML = "";
           if (docs.length > 0) {
             docs.forEach(doc => {
               const link = document.createElement("a");
               link.href = "<?= base_url() ?>uploads/age_block_documents/" + doc.document_url;
               link.innerText = doc.document_url;
               link.target = "_blank";
               link.className = "badge bg-secondary p-2 me-2";
               preview.appendChild(link);
             });
           } else {
             preview.innerHTML = "No documents uploaded yet.";
           }
         });
     }

     document.getElementById("uploadDocsBtn").addEventListener("click", () => {
       const files = document.getElementById("documentInput").files;
       if (files.length === 0) return alert("Please select documents.");

       const formData = new FormData();
       for (let file of files) {
         formData.append("documents[]", file);
       }

       formData.append("user_id", 1);
       formData.append("age_range", selectedAgeRange);
       formData.append("gap_type", selectedGapType);

       fetch("<?= base_url('Home/upload_block_documents') ?>", {
           method: "POST",
           body: formData
         }).then(res => res.json())
         .then(response => {
           if (response.status === "success") {
             alert("Documents uploaded successfully!");
             fetchUploadedDocuments();
             document.getElementById("documentInput").value = "";
           } else {
             alert("Failed to upload documents.");
           }
         });
     });


     let mediaRecorder;
     let recordedChunks = [];
     let recordedBlob = null;
     let stream = null;

     document.getElementById("startRecordingBtn").addEventListener("click", async () => {
       const videoPreview = document.getElementById("recordPreview");
       videoPreview.style.display = "block";

       try {
         stream = await navigator.mediaDevices.getUserMedia({
           video: true,
           audio: true
         });
         videoPreview.srcObject = stream;
         videoPreview.muted = true; // Prevent echo during live preview
         videoPreview.play(); // 🔥 This is what shows live preview

         recordedChunks = [];
         mediaRecorder = new MediaRecorder(stream);

         mediaRecorder.ondataavailable = e => recordedChunks.push(e.data);
         mediaRecorder.onstop = () => {
           stream.getTracks().forEach(track => track.stop());
           recordedBlob = new Blob(recordedChunks, {
             type: "video/webm"
           });
           videoPreview.srcObject = null;
           videoPreview.src = URL.createObjectURL(recordedBlob);
           videoPreview.controls = true;
           videoPreview.muted = false; // Allow sound on playback
         };

         mediaRecorder.start();
         document.getElementById("stopRecordingBtn").disabled = false;
         document.getElementById("startRecordingBtn").disabled = true;

       } catch (err) {
         alert("Camera access denied or error: " + err.message);
       }
     });


     document.getElementById("stopRecordingBtn").addEventListener("click", () => {
       if (mediaRecorder && mediaRecorder.state === "recording") {
         mediaRecorder.stop();
         document.getElementById("stopRecordingBtn").disabled = true;
         document.getElementById("startRecordingBtn").disabled = false;
       }
     });

     document.getElementById("uploadVideosBtn").addEventListener("click", () => {
       const files = document.getElementById("videoInput").files;
       const formData = new FormData();

       for (let file of files) {
         formData.append("videos[]", file);
       }

       if (recordedBlob) {
         const recordedFile = new File([recordedBlob], `recorded_${Date.now()}.webm`, {
           type: "video/webm"
         });
         formData.append("videos[]", recordedFile);
       }

       formData.append("user_id", selectedUserId);
       formData.append("age_range", selectedAgeRange);
       formData.append("gap_type", selectedGapType);
       formData.append("artificialdate", artificialdate);

       fetch("<?= base_url('Home/upload_block_videos') ?>", {
           method: "POST",
           body: formData
         }).then(res => res.json())
         .then(response => {
           if (response.status === "success") {
             alert("Videos uploaded successfully!");
             document.getElementById("videoInput").value = "";
             recordedBlob = null;
             document.getElementById("recordPreview").style.display = "none";
             fetchUploadedVideos();
           } else {
             alert("Failed to upload videos.");
           }
         });
     });

     function fetchUploadedVideos() {
       const preview = document.getElementById("uploadedVideosPreview");
       preview.innerHTML = "Loading...";

       fetch(`<?= base_url('Home/get_uploaded_videos') ?>?user_id=${selectedUserId}&age_range=${selectedAgeRange}&gap_type=${selectedGapType}`)
         .then(res => res.json())
         .then(videos => {
           preview.innerHTML = "";
           if (videos.length > 0) {
             videos.forEach(vid => {
               const videoEl = document.createElement("video");
               videoEl.src = "<?= base_url() ?>uploads/age_block_videos/" + vid.video_url;
               videoEl.controls = true;
               videoEl.style.width = "150px";
               videoEl.style.borderRadius = "8px";
               preview.appendChild(videoEl);
             });
           } else {
             preview.innerHTML = "No videos uploaded yet.";
           }
         });
     }

     document.addEventListener("click", function(e) {
       if (e.target.closest(".updateVideo")) {
         e.preventDefault();
         const block = e.target.closest(".block-container");
         selectedAgeRange = block.querySelector(".age").innerText.replace(/ *yrs/i, "").trim();
         selectedGapType = `${gap}_year`;

         const videoModal = new bootstrap.Modal(document.getElementById("videoUploadModal"));
         videoModal.show();
         fetchUploadedVideos();
       }
     });


     // Handle Docs/Video/Images links
     document.addEventListener("click", function(e) {
       if (e.target.closest(".linkButton")) {
         e.preventDefault();
         const block = e.target.closest(".block-container");
         selectedAgeRange = block.querySelector(".age").innerText.replace(/ *yrs/i, "").trim();
         selectedGapType = `${gap}_year`;

         const docModal = new bootstrap.Modal(document.getElementById("linksModel"));
         docModal.show();

         fetchUploadedLinks();
       }
     });


     // Fetch Links Details
     function fetchUploadedLinks() {
       const preview = document.getElementById("uploadedLinksPreview");
       preview.innerHTML = "Loading...";
       let sr = 1;

       fetch(`<?= base_url('Home/get_uploaded_links') ?>?user_id=${selectedUserId}&age_range=${selectedAgeRange}&gap_type=${selectedGapType}`)
         .then(res => res.json())
         .then(blocklinks => {
           preview.innerHTML = "";

           if (blocklinks.length > 0) {
             blocklinks.forEach(blocklink => {
               // Create a container for each link item
               const item = document.createElement("div");
               item.className = "link-item mb-2";

               // Create the link element
               const link = document.createElement("a");
               link.href = blocklink.links_url;
               link.target = "_blank";
               link.className = "badge bg-secondary p-2 me-2";

               // limit the link text to 100 characters
               const displayText =
                 blocklink.links_url.length > 40 ?
                 blocklink.links_url.substring(0, 40) + "..." :
                 blocklink.links_url;

               link.innerHTML = `${sr}. <i class="fa-solid fa-link"></i> ${displayText}`;

               // Create a small span for category
               const categorySpan = document.createElement("span");
               categorySpan.className = "badge bg-info p-2 mx-1";
               categorySpan.innerText = blocklink.linkscategory || "No Category";

               // Create a small span for Timing
               const TimingSpan = document.createElement("span");
               TimingSpan.className = "p-2 badge bg-info";
               TimingSpan.innerText = blocklink.time + " " + blocklink.timeschedule || "No Timing Set";

               // Append both link + category to container
               item.appendChild(link);
               item.appendChild(categorySpan);
               item.appendChild(TimingSpan);


               // Add the item to preview container
               preview.appendChild(item);

               sr++;
             });
           } else {
             preview.innerHTML = "No links uploaded yet.";
           }
         })
         .catch(err => {
           console.error("Error fetching links:", err);
           preview.innerHTML = "Error loading links.";
         });
     }




     // Add Links
     document.getElementById("SaveLinks").addEventListener("click", () => {
       const text = document.getElementById("LinksInput").value.trim();
       const time = document.getElementById("time").value.trim();
       const timeschedule = document.getElementById("timeschedule").value.trim();
       const linkscategory = document.getElementById("linkscategory").value.trim();

       if (text.length === 0) {
         alert("Please paste a link");
         return;
       }
       if (time.length === 0) {
         alert("Please enter time");
         return;
       }
       if (timeschedule.length === 0) {
         alert("Please select time schedule");
         return;
       }
       if (linkscategory.length === 0) {
         alert("Please select category");
         return;
       }

       // ✅ If all validations pass, continue here:
       const formData = new FormData();
       formData.append("text", text);
       formData.append("time", time);
       formData.append("timeschedule", timeschedule);
       formData.append("linkscategory", linkscategory);
       formData.append("user_id", selectedUserId);
       formData.append("age_range", selectedAgeRange);
       formData.append("gap_type", selectedGapType);

       fetch("<?= base_url('Home/upload_block_link') ?>", {
           method: "POST",
           body: formData
         })
         .then(res => res.json())
         .then(response => {
           if (response.status === "success") {
             alert("Link Uploaded Successfully!");
             fetchUploadedLinks(); // refresh list
             document.getElementById("LinksInput").value = "";
             document.getElementById("time").value = "";
             document.getElementById("timeschedule").value = "";
             document.getElementById("linkscategory").value = "";
           } else {
             alert("Failed to upload link.");
           }
         })
         .catch(err => {
           console.error(err);
           alert("Error uploading link.");
         });
     });





   }

   document.getElementById("numberBoxContainer").addEventListener("click", function(e) {
     const clicked = e.target.closest(".number-box");
     if (!clicked) return;

     console.log("Clicked box number:", clicked.getAttribute("data-box"));

     const num = parseInt(clicked.getAttribute("data-box"));
     let gap = 0;
     if (num === 1 || num === 2 || num === 3) {
       const container = document.getElementById("outputBlocks").innerHTML = '';
     }
     if (num === 3) gap = 10;
     else if (num === 4) gap = 5;
     else if (num === 5) gap = 3;
     else if (num === 6) gap = 2;
     else if (num === 7) gap = 1;

     if (gap > 0) {
       const dob = "<?= $getProfile['dob'] ?? '' ?>"; // Change this dynamically as needed
       const blocks = generateAgeBlocks(dob, gap);
       renderBlocks(blocks, gap);
     }
   });
 </script>

 <script>
   const profilePic = document.getElementById('profile-picture');
   const imageInput = document.getElementById('uploadImage');

   profilePic.addEventListener('click', () => imageInput.click());

   imageInput.addEventListener('change', function() {
     const file = this.files[0];
     if (file) {
       // Preview
       const reader = new FileReader();
       reader.onload = function(e) {
         profilePic.src = e.target.result;
       };
       reader.readAsDataURL(file);

       // Upload via AJAX
       const formData = new FormData();
       formData.append('user_image', file);

       fetch('<?= base_url("Home/update_profile_image") ?>', {
           method: 'POST',
           body: formData
         })
         .then(response => response.json())
         .then(data => {
           if (data.status === 'success') {
             console.log('Image updated successfully');
           } else {
             alert('Upload failed: ' + data.message);
           }
         })
         .catch(error => console.error('Error:', error));
     }
   });
 </script>


 <script>
   const stateWrapper = document.querySelector("#state")

   function getStatesByCountry(countryId) {
     fetch('<?= base_url('Home/getState') ?>', {
         method: 'POST',
         headers: {
           'Content-Type': 'application/json'
         },
         body: JSON.stringify({
           countryId,
           selectedState: "<?= $getProfile['state'] ?>"
         })
       })
       .then(response => response.text())
       .then(html => {
         stateWrapper.innerHTML = html;
       })
       .catch(error => {
         alert("Something went wrong.");
         console.error(error);
       });
   }
   document.addEventListener('DOMContentLoaded', function() {
     // Trigger the function on load with the selected country ID
     const countrySelect = document.getElementById('country');
     if (countrySelect && countrySelect.value) {
       getStatesByCountry(countrySelect.value);
     }
     countrySelect.addEventListener('change', function() {
       getStatesByCountry(this.value);
     });
   });

   function fetchCitiesByState(stateId) {
     fetch('<?= base_url('Home/getCities') ?>', {
         method: 'POST',
         headers: {
           'Content-Type': 'application/json'
         },
         body: JSON.stringify({
           stateId
         })
       })
       .then(response => response.text()) // since you're returning HTML
       .then(html => {
         document.getElementById('city').innerHTML = html;
       })
       .catch(error => {
         console.error("Error fetching cities:", error);
       });
   }

   //  document.getElementById('state').addEventListener('change', function() {
   //    const stateId = this.value;
   //    if (stateId) {
   //      fetchCitiesByState(stateId);
   //    }
   //  });
 </script>

 <script>
   function updateUserSummary() {
     const textInput = document.getElementById('textInput').value;

     fetch('<?= base_url('Home/update_user_summary') ?>', {
         method: 'POST',
         headers: {
           'Content-Type': 'application/json'
         },
         body: JSON.stringify({
           summary: textInput
         })
       })
       .then(response => response.json())
       .then(data => {
         if (data.status === 'success') {
           alert('User summary updated successfully!');
         } else {
           alert('Failed to update summary: ' + data.message);
         }
       })
       .catch(error => console.error('Error:', error));
   }

   function updateSkillsEducation() {
     const profileEducation = document.getElementById('profile_education').value;
     const profileExperience = document.getElementById('profile_experience').value;
     const profileSkills = document.getElementById('profile_skills').value;

     fetch('<?= base_url('Home/update_user_skills_and_education') ?>', {
         method: 'POST',
         headers: {
           'Content-Type': 'application/json'
         },
         body: JSON.stringify({
           education: profileEducation,
           experience: profileExperience,
           skills: profileSkills
         })
       })
       .then(response => response.json())
       .then(data => {
         if (data.status === 'success') {
           alert('User skills and education updated successfully!');
         } else {
           alert('Failed to update details: ' + data.message);
         }
       })
       .catch(error => console.error('Error:', error));
   }


   document.addEventListener('DOMContentLoaded', function() {
     const boxes = document.querySelectorAll('.number-box');
     const dynamicContent = document.getElementById('dynamicContent');

     boxes.forEach(box => {
       box.addEventListener('click', function() {
         const boxNumber = this.getAttribute('data-box');
         this.style.display = 'none';
         dynamicContent.style.display = 'flex';
         dynamicContent.innerHTML = '';

         switch (boxNumber) {
           case '1':
             dynamicContent.innerHTML = `
<textarea class="form-control" 
  placeholder="Profile Summary" 
  id="textInput" 
  style="width: 500px;" rows="5"><?= $getProfile['summary'] ?? '' ?></textarea>
  <div id="charCount">0/300 characters</div>
<button 
  class="btn btn-success px-4"
  onclick="updateUserSummary();" 
  style="width: 120px;" type="button">
  Update
</button>`;

             const messageField = document.getElementById("textInput");
             const charCount = document.getElementById("charCount");
             const maxLength = 300;

             messageField.addEventListener("input", () => {
               const currentLength = messageField.value.length;

               if (currentLength > maxLength) {
                 messageField.value = messageField.value.substring(0, maxLength);
               }

               const newLength = messageField.value.length;
               const remaining = maxLength - newLength;

               charCount.textContent = `${newLength}/${maxLength} characters used`;
               if (remaining <= 50) {
                 charCount.classList.add("warning");
               } else {
                 charCount.classList.remove("warning");
               }
             });
             break;
           case '2':
             dynamicContent.innerHTML = `
        <div class="w-100 d-flex flex-column gap-2">
            <input type="text" class="form-control" value="<?= $getProfile['education'] ?? '' ?>" id="profile_education" placeholder="Education" style="width: 500px;" />
            <input type="text" class="form-control" value="<?= $getProfile['skills'] ?? '' ?>" id="profile_skills" placeholder="Skills" style="width: 500px;" />
            <input type="text" class="form-control" value="<?= $getProfile['experience'] ?? '' ?>" id="profile_experience" placeholder="Experience" style="width: 500px;" />
            <button type="button" class="btn btn-success" style="width: 120px;" onclick="updateSkillsEducation();" >Save</button>
        </div>
    `;
             break;
           default:
             dynamicContent.innerHTML = '';
         }
       });
     });
   });
 </script>

 <script>
   // KYC
   function kycopenModal() {
     document.getElementById('openkyc').style.display = 'flex';
   }

   function kyccloseModal() {
     document.getElementById('openkyc').style.display = 'none';
   }
   document.getElementById('openkycbtn').addEventListener('click', function(e) {
     e.preventDefault();
     kycopenModal();
   });
   window.addEventListener('click', function(e) {
     const modal = document.getElementById('openkyc');
     if (e.target === modal) {
       kyccloseModal();
     }
   });


   // NETWORTH

   function networthopenModal() {
     document.getElementById('opennetworth').style.display = 'flex';
     getCompanyValuation();
   }

   function networthcloseModal() {
     document.getElementById('opennetworth').style.display = 'none';
   }
   document.getElementById('opennetworthbtn').addEventListener('click', function(e) {
     e.preventDefault();
     networthopenModal();
   });
   window.addEventListener('click', function(e) {
     const modal = document.getElementById('opennetworth');
     if (e.target === modal) {
       networthcloseModal();
     }
   });
    
   function getCompanyValuation() {
      $.ajax({
            url: "<?= base_url("Home/getAddedValuationUser") ?>",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    let html = `
                    <div class="row fw-bold mb-2">
                    <div class="col-2"> Sr No. </div>
                    <div class="col-2">Company Id</div>
                    <div class="col-2">Added Valuation</div>
                    <div class="col-2">Total Projects</div>
                    <div class="col-2">Total Bricks</div>
                    </div>
                    `;
                    let i = 1;
                    response.rows.forEach(function(row) {
                        html += `
                    <div class="row">
                        <div class="col-2">${i++}</div>
                        <div class="col-2">${row.company_id}</div>
                        <div class="col-2">Rs. ${row.addedValuation}/-</div>
                        <div class="col-2">${row.totalProjects}</div>
                        <div class="col-2">${row.totalBricks}</div>
                    </div>
                    `;
                    });

                    // Update total + table
                    $(".addevValuation_Container").html(`
                    <strong>Total Valuation: Rs. ${response.totalValuation}/-</strong>
                    <div class="mt-2">${html}</div>
                    `);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
   }

   // OPEN MODEL FOR TASKMODAL
   function openModal() {
     document.getElementById('taskModal').style.display = 'flex';
   }

   function closeModal() {
     document.getElementById('taskModal').style.display = 'none';
   }
   document.getElementById('postTaskButton').addEventListener('click', function(e) {
     e.preventDefault();
     openModal();
   });
   window.addEventListener('click', function(e) {
     const modal = document.getElementById('taskModal');
     if (e.target === modal) {
       closeModal();
     }
   });


   // OPEN MODEL FOR TASKMODAL
   function openModal() {
     document.getElementById('taskModal').style.display = 'flex';
   }

   function closeModal() {
     document.getElementById('taskModal').style.display = 'none';
   }
   document.getElementById('professionalTaskButton').addEventListener('click', function(e) {
     e.preventDefault();
     openModal();
   });
   window.addEventListener('click', function(e) {
     const modal = document.getElementById('taskModal');
     if (e.target === modal) {
       closeModal();
     }
   });





   // Money Wallet
   function moneywalletopenModal() {
     document.getElementById('moneywalletmodel').style.display = 'flex';
   }

   function moneywalletcloseModal() {
     document.getElementById('moneywalletmodel').style.display = 'none';
   }
   document.getElementById('moneyWallet').addEventListener('click', function(e) {
     e.preventDefault();
     moneywalletopenModal();
   });
   window.addEventListener('click', function(e) {
     const moneymodal = document.getElementById('moneywalletmodel');
     if (e.target === moneymodal) {
       moneywalletcloseModal();
     }
   });



   // Money Wallet Money Transfer 
   $('#moneywallet_transfer').on('submit', function(e) {
     e.preventDefault(); // Prevent default form submission

     let formData = new FormData(this);
     $.ajax({
       url: $(this).attr('action'),
       method: 'POST',
       data: formData,
       processData: false,
       contentType: false,
       dataType: 'json',
       success: function(response) {
         console.log(response); // ✅ Debug output

         if (response.success) {
           alert(response.message);

           $('#amount').val(''); // Reset input value

           // window.location.href = response.redirect_url;
         } else {
           alert("Error: " + (response.message || response.errors));
         }
       },
       error: function(xhr, status, error) {
         alert("AJAX Error: " + error);
         console.log(xhr.responseText);
       }
     });
   });



   // PERSONAL PROFESSION DATA GET ON CLICK 
   $('.postTaskButtonpersonal').on('click', function() {
     $.ajax({
       url: '<?= base_url("Home/getPersonalBricks") ?>',
       method: 'POST',
       dataType: 'json',
       success: function(response) {
         if (response.success) {
           $('#companyList').html(response.html);
         } else {
           $('#companyList').html('<div class="alert alert-info my-5">No Bricks Found</div>');
         }
       },
       error: function(xhr, status, error) {
         console.log("AJAX Error:", error);
         $('#companyList').html('<div class="alert alert-danger my-5">Something went wrong!</div>');
       }
     });
   });


   // PROFESSONAL BRICKS
   $('.professionalTaskButtonprofessional').on('click', function() {
     $.ajax({
       url: '<?= base_url("Home/getProfessionalBricks") ?>',
       method: 'POST',
       dataType: 'json',
       success: function(response) {
         if (response.success) {
           $('#companyList').html(response.html);
         } else {
           $('#companyList').html('<div class="alert alert-info my-5">No Bricks Found</div>');
         }
       },
       error: function(xhr, status, error) {
         console.log("AJAX Error:", error);
         $('#companyList').html('<div class="alert alert-danger my-5">Something went wrong!</div>');
       }
     });
   });

   // TOOGLE FUNCTION FOR PRESS RELEASE
  document.getElementById("toggleFilters").addEventListener("click", function() {
      var filters = document.getElementById("filtersSection");
      if (filters.style.display === "none" || filters.style.display === "") {
          $('.my_section').removeClass('col-6')
          $('.my_section').addClass('col-auto')

          $('.my_height').addClass('d-none')
          $('.my_height').removeClass('d-block')
          $('.ruler').addClass('d-none')
          filters.style.display = "block";
      } else {
          filters.style.display = "none";
          $('.my_section').removeClass('col-auto')
          $('.my_section').addClass('col-6')

          $('.my_height').removeClass('d-none')
          $('.my_height').addClass('d-block')
          $('.ruler').removeClass('d-none')
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

                          $(document).on("click", ".getpressreleaseedit", function() {
                              let id = $(this).data("press"); // get the id from data-project
                              $.ajax({
                                  url: "<?= base_url('Home/getpressreleaseedituser') ?>",
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
                                          $("textarea[name='press_release_tags']").val(response.data.press_release_tags);
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

                          $(document).on("click", ".viewgetpressrelease", function() {
                              let id = $(this).data("press-view"); // Get press release ID

                              $.ajax({
                                  url: "<?= base_url('Home/getpressreleaseuser') ?>",
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

<script>
  // OPEN MODEL FOR Network
   document.addEventListener('DOMContentLoaded', ()=>{
      function openNetworkModal() {
        document.getElementById('networkModal').style.display = 'flex';
      }

      function closeNetworkModal() {
        document.getElementById('networkModal').style.display = 'none';
      }
      document.getElementById('network_btn').addEventListener('click', function(e) {
        e.preventDefault();

        get_network_users().then((users)=>{
          console.log('users', users);
            renderUsers(users)
          })  
            

        openNetworkModal();
      });

      window.addEventListener('click', function(e) {
        const modal = document.getElementById('networkModal');
        if (e.target === modal) {
          closeNetworkModal();
        }
      });

      function get_network_users() {
          return fetch("<?= base_url('Home/network_users') ?>")
            .then((res) => res.json());
        }

      function renderUsers(users) {
        const userList = document.getElementById("userList");
        if (!userList) return;

        userList.innerHTML = "";

        if (!Array.isArray(users) || users.length === 0) {
          userList.innerHTML = `
            <tr>
              <td colspan="6" style="text-align:center;">No users found</td>
            </tr>
          `;
          return;
        }

        users.forEach(user => {
          let btnText = "Connect";
          let btnDisabled = false;

          if (user.connection_status === "accepted") {
            btnText = "Connected";
            btnDisabled = true;
          }
          else if (user.connection_status === "pending") {
            if (user.connection_direction === "sent") {
              btnText = "Requested";
              btnDisabled = true;
            } else if (user.connection_direction === "received") {
              btnText = "Accept";
            }
          }

          const user_image = user.user_image ? "<?= base_url('uploads/user_profile/') ?>" + user.user_image : "<?= base_url('assets/images/img/user.png') ?>";

          const user_name = user.name ? user.name : 'No Name';

          userList.insertAdjacentHTML("beforeend", `
            <tr class="p-2">
              <td>
                <img 
                  src="${user_image}" 
                  alt="${user_name}"
                  width="45"
                  height="45"
                  style="border-radius:50%; object-fit:cover;"
                />
              </td>

              <td class="text-start">
                <strong>${user_name}</strong><br>
                <small>${user.summary ?? ''}</small>
              </td>

              <td>${user.email}</td>
              <td>${user.phone}</td>
              <td>${user.city}</td>

              <td>
                <button 
                  class="btn btn-sm btn-primary bg-primary m-auto connect-btn"
                  data-userId="${user.user_id}"
                  ${btnDisabled ? "disabled" : ""}
                >
                  ${btnText}
                </button>
              </td>
            </tr>
          `);
        });

        bindUserEvents();
      }

  })
  
  function bindUserEvents() {
    document.querySelectorAll('.connect-btn').forEach((btn)=>{
      // console.log('btn', btn);

      btn.addEventListener('click', function () {
        let connect_user_id = btn.dataset.userid;

        connection_request(connect_user_id, btn)
        
      })
      
    })
  }

  async function connection_request(connect_user_id, btn) {

    try {
      const response = await fetch("<?= base_url('Home/send_connect_req') ?>", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ connect_user_id })
      });

      const result = await response.json();

      if (response.ok && result.status === true) {
        alert("Connection request sent successfully ✅");

        btn.textContent = "Requested";
        btn.disabled = true;
        btn.classList.remove("btn-primary");
        btn.classList.add("btn-secondary");

      } else {
        alert(result.message || "Something went wrong ❌");
      }

    } catch (error) {
      console.error(error);
      alert("Network error. Please try again ❌");
    }
  }

</script>

<script>
    let press_release_date = document.getElementById('date_filter_press_release');
    let press_release_container = document.getElementById('press_release_container');
    let text_search_press_release = document.getElementById('text_search_press_release');
    const press_release_search_btn = document.getElementById('press_release_search_btn');
    const context_ai_switch = document.getElementById('context_ai_switch');

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
        let type = "user";

        // console.log(selected_date);
        // console.log(project_id);
        // console.log(type);
       
       let res = await fetch("<?= base_url("Home/get_press_release_date_wise") ?>", {
          method: 'POST',
          body: JSON.stringify({
              type,
              selected_date
          })
       })

       let json = await res.json();
       return json;
    }

    async function get_press_release(searchValue = null, contextAI = false) {
      let type = "user";

      const payload = { type };

      if (searchValue && searchValue.trim() !== "") {
        payload.searchValue = searchValue.trim();
      }

      if (contextAI) {
        payload.context_ai = 1;
      }

      const res = await fetch("<?= base_url('Home/get_press_release_date_wise') ?>", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
      });

      const json = await res.json();
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

                <a href="<?= base_url("user/press-release/$release[id]") ?>">👁️</a>
                
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

<script>
  function openValuationModal() {
        document.getElementById('valuationModel').style.display = 'flex';
    }

    function closeValuationModal() {
        document.getElementById('valuationModel').style.display = 'none';
    }
    document.getElementById('getvaluationbyproject').addEventListener('click', function(e) {
        e.preventDefault();
        openValuationModal();
    });
    window.addEventListener('click', function(e) {
        const modal = document.getElementById('valuationModel');
        if (e.target === modal) {
            closeValuationModal();
        }
    });
</script>

<script>
  function openPublishArticle() {
      document.getElementById('PublishModel').style.display = 'flex';
    }

    function closePublishModel() {
      document.getElementById('PublishModel').style.display = 'none';
    }

    document.getElementById('publishArticleBtn').addEventListener('click', function(e) {
      e.preventDefault();
          
      openPublishArticle();
    });

    window.addEventListener('click', function(e) {
      const modal = document.getElementById('PublishModel');
      if (e.target === modal) {
        closePublishModel();
      }
    });
</script>

<script>
  const handle = document.getElementById('rulerHandle');
  const line = document.querySelector('.ruler-line');

  let isDragging = false;
  let startX = 0;
  let startLeft = 0;

  handle.addEventListener('mousedown', (e) => {
    isDragging = true;
    startX = e.clientX;
    startLeft = handle.offsetLeft;
    document.body.style.userSelect = 'none';
  });

  document.addEventListener('mousemove', (e) => {
    if (!isDragging) return;

    const dx = e.clientX - startX;
    let newLeft = startLeft + dx;

    const min = 17;
    const max = line.offsetWidth - handle.offsetWidth - 16;

    // Clamp movement inside ruler-line
    newLeft = Math.max(min, Math.min(max, newLeft));

    handle.style.left = newLeft + 'px';
  });

  document.addEventListener('mouseup', () => {
    isDragging = false;
    document.body.style.userSelect = '';
  });
</script>
