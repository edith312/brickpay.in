<style>

    table[role='grid'] thead {
        display: none;
    }

    table[role='grid'] tbody {
        height: 500px;
    }

    table[role='presentation'] tr {
        display: flex;
        flex-direction: column;
    }

    .fc-daygrid-day-top {
        justify-content: start;
    }

    .fc .fc-scroller-liquid-absolute {
        position: relative;
    }

    .fc-header-toolbar {
        flex-direction: column-reverse;
        gap: 18px;
    }

    .fc-theme-standard td {
        width: 82vw;
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
        justify-content: start;
    }
    .my_timeline_line{
        position: absolute;
        height: 1px;
        width: 100%;
        background: #e3e3e3;
        top: 18px;
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
        position: relative;
        gap: 20px;
        height: 50px;
        /* width: 100%; */
        /* justify-content: center; */
        /* position: absolute; */
        /* transform: translate(0px, -50%); */
        align-items: center;
        flex-direction: row;
        padding-right: 4px;
    }

    .timeline-users-wrapper {
        display: inline-flex;
        gap: 20px;
        height: 50px;
        width: 100%;
        justify-content: space-between;
        position: absolute;
        margin-top: 10px;
        transform: translate(0px, -50%);
        top: 20px;
        align-items: center;
        flex-direction: row;
        padding-right: 4px;
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

<style>
    .borderBoxesAreaContainer {
        border: 2px solid #007bff;
        border-radius: 10px;
        padding: 10px;
        min-height: 100px;
        margin-bottom: 10px;
    }

    .content_adding__container {
        position: relative;
    }

    #borderBoxesInputAreaContainer{
        display: none;
    }
</style>

<style>
    .dot-wrapper .dot {
        width: 10px;
        height: 10px;
        background-color: #04d6e5;
        border-radius: 50%;
        position: absolute;
        left: -20px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
    }
    .dot-wrapper{
        position: relative;
    }

    .dot-wrapper .dot-line{
        position: absolute;
        left: -16px;          /* center with dot */
        top: 50%;
        width: 2px;
        height: 0; /* distance to next item */
        background-color: #04d6e5;
        z-index: 1;
    }

    .content_adding__container {
        position: relative;
    }
    .dropped-item{
        position: relative;
        display: grid;
        grid-template-rows: 1;
        grid-template-columns: 2;
        align-items: center;
        gap: 6px;
        padding-left: 25px;
    }
    .w-fill-content{
        width: fit-content !important;
    }
    .timeline-output{
        display: flex;
        gap: 3px;
    }
    .edit-item{
        z-index: 50;
    }
    .calender-user{
        display: flex;
        flex-direction: row;
    }
    .calendar-user-avatar {
        width: 35px;
        height: 35px;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 50%;
    }
    .calendar-users-row {
        display: flex;
        align-items: center;
        gap: 28px; /* spacing between users */
    }

    .calendar-user-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: #000;
        font-size: 14px;
    }

    .calendar-user-name {
        white-space: nowrap;
        font-weight: 500;
    }

    .drop-placeholder {
        height: 60px;
        border: 2px dashed #aaa;
        margin-bottom: 10px;
        border-radius: 8px;
    }

    .tabbed {
        padding-left: 2rem;   /* acts like a tab */
    }

    .dialogue_box{
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .dialogue_textbox{
        width: 40vw;
    }

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

    #companyList > div{
        gap: 10px;
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

    .dropped-item.drag-over {
        border: 2px dashed #04d6e5;
    }

    .content_adding__container.drag-allow {
        outline: 1px dashed #ccc;
    }

</style>

<style>
    .press_release_showcase p {
		text-align: justify;
	}

	.press_release_showcase {
		border-bottom: 1px solid #ccc;
		padding-top: 10px;
	}

    .press_release_profile_pic{
		width: 30px;
		height: 30px;
		aspect-ratio: 1;
		object-fit: cover;
		border-radius: 50%;
	}

    #new-timeline-dropzone {
        display: none;              /* hidden by default */
        border: 2px dashed #04d6e5;
        border-radius: 8px;
        padding: 16px;
        text-align: center;
        color: #04d6e5;
        margin: 12px 0;
        background: #f6feff;
        transition: all 0.2s ease;
    }

    #new-timeline-dropzone.drag-over {
        background: #e6fbff;
        border-color: #0bbcd6;
    }

    .black_line_btn{
        height: 28px;
        width: 50px !important;
    }

    .black_line{
        display: block;
        height: 2px;
        width: 100%;
        background: black;
    }
    .black-line-wide {
        width: 10vw !important;
    }
    .timeline-wrapper{
        margin-top: 14px;
    }

    /* default: hidden */
    .timeline-output .edit-item,
    .timeline-output .delete-item {
        display: none;
    }

    /* when edit mode is ON */
    .edit-mode .timeline-output .edit-item,
    .edit-mode .timeline-output .delete-item {
        display: inline-flex;
        cursor: pointer;
    }

    /* default */
    #toggleEditMode {
        transition: all 0.2s ease;
    }

    /* highlighted when edit mode is ON */
    #toggleEditMode.active {
        background-color: #04d6e5ff;   /* Bootstrap warning */
        color: #000;
        border-color: #04d6e5ff;
        box-shadow: 0 0 0 0.2rem #04d6e5ff;
        border-radius: 25%;
    }

    .viewer-mode {
        cursor: not-allowed;
    }
</style>

<div class="page-body">

    <!-- <form action="<?= base_url('/AdminHome/create_tree') ?>" method="POST">
        <div class="row w-100">
            <div class="col-auto">
                <label class="form-label" for="">Tree/Family/Project Nomencleture/Name</label>
                <input class="form-control" type="text" name="title" min="0">
            </div>
            <div class="col-auto">
                <label class="form-label" for="">Timeline Count</label>
                <input class="form-control" type="number" name="count" min="0">
            </div>
            <input type="hidden" value="4" name="tree_type">
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
    </div> -->


    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    <?php if($project_id) { ?>
                        <h5 class="card-title mb-3 text-primary fw-bold">
                            Project Overview
                        </h5>

                        <div class="mb-2">
                            <h6 class="text-muted mb-1">Company Name</h6>
                            <h4 class="fw-semibold"><?= $company_details['company_name'] ?></h4>
                        </div>

                        <div>
                            <h6 class="text-muted mb-1">Project Name</h6>
                            <h4 class="fw-semibold"><?= $project_details['project_name'] ?></h4>
                        </div>

                    <?php } elseif($company_id) { ?>

                        <h5 class="card-title mb-3 text-primary fw-bold">
                            Company Overview
                        </h5>

                        <div>
                            <h6 class="text-muted mb-1">Company Name</h6>
                            <h4 class="fw-semibold"><?= $company_details['company_name'] ?></h4>
                        </div>

                    <?php } ?>

                </div>
            </div>
            
            <?php
                $date = $calendar['timeline_details']['date']
                    ?? $this->input->post('date')
                    ?? '';

                // Opening time (HH:MM)
                $openingTime = !empty($calendar['timeline_details']['opening_time'])
                    ? substr($calendar['timeline_details']['opening_time'], 0, 5)
                    : ($this->input->post('openingTime') ?? '');

                // Closing time (HH:MM)
                $closingTime = !empty($calendar['timeline_details']['closing_time'])
                    ? substr($calendar['timeline_details']['closing_time'], 0, 5)
                    : ($this->input->post('closingTime') ?? '');
                ?>

                <div class="d-flex gap-2 my-3">

                    <div class="input-box">
                        <label>Date</label>
                        <input type="date"
                            name="artificialdate"
                            id="modalDateName"
                            class="form-control"
                            value="<?= htmlspecialchars($date) ?>">
                    </div>

                    <div class="input-box">
                        <label>Opening</label>
                        <input type="time"
                            id="showOpening"
                            class="time-input form-control"
                            value="<?= htmlspecialchars($openingTime) ?>"
                            autocomplete="off">
                    </div>

                    <div class="input-box">
                        <label>Closing</label>
                        <input type="time"
                            id="showClosing"
                            class="time-input form-control"
                            value="<?= htmlspecialchars($closingTime) ?>"
                            autocomplete="off">
                    </div>

                    <div class="d-flex align-items-end">
                        <div class="mx-2">
                            <label for="">Type</label>
                            <select class="form-select text-white" name="timeline_type" id="timeline_type"
                                style=" background-color: #4772f3;">
                                <option value="" disabled selected>Select</option>
                                <option value="7" <?= $calendar['timeline_details']['timeline_type'] == '7' ? 'selected' : ''?>>Timeline</option>
                                <option value="6" <?= $calendar['timeline_details']['timeline_type'] == '6' ? 'selected' : ''?>>Task</option>
                                <option value="1" <?= $calendar['timeline_details']['timeline_type'] == '1' ? 'selected' : ''?>>Milestone</option>
                                <option value="2" <?= $calendar['timeline_details']['timeline_type'] == '2' ? 'selected' : ''?>>Strategie</option>
                                <option value="3" <?= $calendar['timeline_details']['timeline_type'] == '3' ? 'selected' : ''?>>Scene</option>
                                <option value="4" <?= $calendar['timeline_details']['timeline_type'] == '4' ? 'selected' : ''?>>Updates</option>
                                <option value="5" <?= $calendar['timeline_details']['timeline_type'] == '5' ? 'selected' : ''?>>Events</option>
                            </select>
                        </div>
                        <div class="mx-2">
                            <button id="create_timeline" class="btn btn-primary">Define</button>
                        </div>
                        <div class="me-2" style="margin-left: 83px;">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/location') ?>"
                                data-type="location"
                                data-target="#textDataContainer9"
                                data-box="#box_locationbox"
                                draggable="true"
                            >Location</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/satellite_coord') ?>"
                                data-type="satellite_coord"
                                data-target="#textDataContainer9"
                                data-box="#box_satellite_coordbox"
                                draggable="true"
                            >Satellite Coordinates</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/getCoordinates') ?>"
                                data-type="coordinates"
                                data-target="#textDataContainer9"
                                data-box="#box_coordinatesbox"
                                draggable="true"
                            ><a class="text-light" href="<?= base_url('company/coordinates') ?>">3D Coordinates</a></button>
                        </div>
                    </div>

                </div>
            <div class="bodycontentforModel">
                <div class="actionareaViewCase">
                    
                    <div class="d-flex flex-wrap mt-2 align-items-center gap-2">
                        <div class="mx-2">
                            <button class="btn btn-primary btn-sm tab-btn draggable-btn" style="background-color: #04d6e5ff !important;" data-url="http://localhost/brickpay.in/Calendar/gettextdata" data-type="text" data-target="#textDataContainer" data-box="#box_textbox"
                            draggable="true"
                            >
                                THOUGHTS
                            </button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn text-white draggable-btn" style="background-color: #04d6e5ff !important;"
                                    data-url="<?= base_url('Calendar/gettextdata') ?>"
                                    data-target="#brickSearchContainer"
                                    data-type="brick"
                                    data-box="#box_brickbox"
                                    draggable="true"
                                    >
                                BRICK PAY
                            </button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn text-white draggable-btn" style="background-color: #04d6e5ff !important;"
                                    data-url="<?= base_url('Calendar/gettextdata') ?>"
                                    data-target="#textDataContainer"
                                    data-type="text"
                                    data-box="#box_textbox"
                                    draggable="true"
                                    >
                                TEXT
                            </button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn" style="background-color: #04d6e5ff !important;"
                                    data-url="<?= base_url('Calendar/getImagesdata') ?>"
                                    data-type="image"
                                    data-target="#textDataContainer2"
                                    data-box="#box_imagebox"
                                    draggable="true"
                                    >
                                <i class="fas fa-image text-white"></i>
                            </button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn" style="background-color: #04d6e5ff !important;"
                                    data-url="<?= base_url('Calendar/getDocsdata') ?>"
                                    data-type="docs"
                                    data-target="#textDataContainer3"
                                    data-box="#box_DocsBox"
                                    draggable="true"
                                    >
                                <i class="fas fa-file-alt text-white"></i>
                            </button>
                        </div>
                        <div class="mx-2 d-flex">
                            <button class="btn btn-sm tab-btn draggable-btn" style="background-color: #04d6e5ff !important;"
                                    data-url="<?= base_url('Calendar/getVideodata') ?>"
                                    data-type="video"
                                    data-target="#textDataContainer4"
                                    data-box="#box_videobox"
                                    draggable="true"
                                    >
                                <i class="fas fa-video text-white"></i>
                            </button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn" style="background-color: #04d6e5ff !important;"
                                    data-url="<?= base_url('Calendar/getAudiodata') ?>"
                                    data-type="audio"
                                    data-target="#textDataContainer5"
                                    data-box="#box_audiobox"
                                    draggable="true"
                                    >
                                <i class="bi bi-mic-fill text-white"></i>
                            </button>
                        </div>

                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn" style="background-color: #04d6e5ff !important;"
                                    data-url="<?= base_url('Calendar/getOtherLinksdata') ?>"
                                    data-type="other"
                                    data-target="#textDataContainer6"
                                    data-box="#box_otherlinksbox"
                                    draggable="true"
                                    >
                                <i class="fa-solid fa-link text-white"></i>
                            </button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white"
                                    style="background-color: #04d6e5ff !important;"
                                    data-type="contact"
                                    data-box="#box_contactbox"
                                    draggable="true">
                                Contact
                            </button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/getOtherLinksdata') ?>"
                                data-type="press_release"
                                data-target="#textDataContainer8"
                                data-box="#box_press_releasebox"
                                draggable="true"
                            >Press Release</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/getOtherLinksdata') ?>"
                                data-type="user"
                                data-target="#textDataContainer9"
                                data-box="#box_userbox"
                                draggable="true"
                            >User</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/getOtherLinksdata') ?>"
                                data-type="connection"
                                data-target="#textDataContainer9"
                                data-box="#box_connectionbox"
                                draggable="true"
                            >Connection</button>
                        </div>
                        
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/to_user') ?>"
                                data-type="to_user"
                                data-target="#textDataContainer9"
                                data-box="#box_to_userbox"
                                draggable="true"
                            ><a class="text-light">To</a></button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/to_user') ?>"
                                data-type="from_user"
                                data-target="#textDataContainer9"
                                data-box="#box_from_userbox"
                                draggable="true"
                            ><a class="text-light">From</a></button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/dialogue') ?>"
                                data-type="dialogue"
                                data-target="#textDataContainer9"
                                data-box="#box_dialoguebox"
                                draggable="true"
                            ><a class="text-light">:Dialogue</a></button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/to_user') ?>"
                                data-type="arrow_right"
                                data-target="#textDataContainer9"
                                data-box="#"
                                draggable="true"
                            ><i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/to_user') ?>"
                                data-type="arrow_left"
                                data-target="#textDataContainer9"
                                data-box="#"
                                draggable="true"
                            ><i class="fa-solid fa-arrow-left"></i></button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white black_line_btn" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/black_line') ?>"
                                data-type="black_line"
                                data-target="#textDataContainer9"
                                data-box="#"
                                draggable="true"
                            ><span class="black_line"></span></button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/travel') ?>"
                                data-type="travel"
                                data-target="#textDataContainer9"
                                data-box="#box_travelbox"
                                draggable="true"
                            >Travel</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/population_count') ?>"
                                data-type="arrow_left"
                                data-target="#textDataContainer9"
                                data-box="#"
                                draggable="true"
                            >Population Count</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/country') ?>"
                                data-type="country"
                                data-target="#textDataContainer9"
                                data-box="#box_countrybox"
                                draggable="true"
                            >Country</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/character') ?>"
                                data-type="character"
                                data-target="#textDataContainer9"
                                data-box="#box_characterbox"
                                draggable="true"
                            >Character</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/religion') ?>"
                                data-type="religion"
                                data-target="#textDataContainer9"
                                data-box="#box_religionbox"
                                draggable="true"
                            >Religion</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/language') ?>"
                                data-type="language"
                                data-target="#textDataContainer9"
                                data-box="#box_languagebox"
                                draggable="true"
                            >Language</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/emotion') ?>"
                                data-type="emotion"
                                data-target="#textDataContainer9"
                                data-box="#box_emotionbox"
                                draggable="true"
                            >Emotion</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/level') ?>"
                                data-type="level"
                                data-target="#textDataContainer9"
                                data-box="#box_levelbox"
                                draggable="true"
                            >Level</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/resources') ?>"
                                data-type="resources"
                                data-target="#textDataContainer9"
                                data-box="#box_resourcesbox"
                                draggable="true"
                            >Resources</button>
                        </div>
                        
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/Ethnicity') ?>"
                                data-type="Ethnicity"
                                data-target="#textDataContainer9"
                                data-box="#box_ethnicitybox"
                                draggable="true"
                            >Ethnicity</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/body_part') ?>"
                                data-type="body_part"
                                data-target="#textDataContainer9"
                                data-box="#box_body_partbox"
                                draggable="true"
                            >Body Parts</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/age') ?>"
                                data-type="age"
                                data-target="#textDataContainer9"
                                data-box="#box_agebox"
                                draggable="true"
                            >Age</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/') ?>"
                                data-type=""
                                data-target="#textDataContainer9"
                                data-box="#"
                                draggable="true"
                            >Speech to text</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/') ?>"
                                data-type=""
                                data-target="#textDataContainer9"
                                data-box="#"
                                draggable="true"
                            >Text to speech</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/') ?>"
                                data-type=""
                                data-target="#textDataContainer9"
                                data-box="#"
                                draggable="true"
                            >Screen Cropper</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/') ?>"
                                data-type="ministry"
                                data-target="#textDataContainer9"
                                data-box="#box_ministrybox"
                                draggable="true"
                            >Ministry</button>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap mt-4 align-items-center gap-1">
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/cashflow') ?>"
                                data-type="cashflow"
                                data-target="#textDataContainer9"
                                data-box="#box_cashflowbox"
                                draggable="true"
                            >CashFlow</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/condition') ?>"
                                data-type="condition"
                                data-target="#textDataContainer9"
                                data-box="#box_conditionbox"
                                draggable="true"
                            >Condition</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/probability') ?>"
                                data-type="probability"
                                data-target="#textDataContainer9"
                                data-box="#box_probabilitybox"
                                draggable="true"
                            >Probability</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/finance_box') ?>"
                                data-type="finance"
                                data-target="#textDataContainer9"
                                data-box="#box_financebox"
                                draggable="true"
                            >Associated Finance</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/currency_box') ?>"
                                data-type="currency"
                                data-target="#textDataContainer9"
                                data-box="#box_currencybox"
                                draggable="true"
                            >Currency</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/deal') ?>"
                                data-type="deal"
                                data-target="#textDataContainer9"
                                data-box="#box_dealbox"
                                draggable="true"
                            >Deal</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/differentiation') ?>"
                                data-type="differentiation"
                                data-target="#textDataContainer9"
                                data-box="#box_differentiationbox"
                                draggable="true"
                            >Differentiation</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/integration') ?>"
                                data-type="integration"
                                data-target="#textDataContainer9"
                                data-box="#box_integrationbox"
                                draggable="true"
                            >Integration</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/permAndComb') ?>"
                                data-type="permAndComb"
                                data-target="#textDataContainer9"
                                data-box="#box_permAndCombbox"
                                draggable="true"
                            >Permutation & Combination</button>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-sm tab-btn draggable-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                                data-url="<?= base_url('Calendar/timestamp') ?>"
                                data-type="timestamp"
                                data-target="#textDataContainer9"
                                data-box="#box_timestampbox"
                                draggable="true"
                            >Timestamps</button>
                        </div>
                    </div>
                    <div class="content_adding__container borderBoxesAreaContainer mt-4">
                        <?php if($permission['permission_type'] != 'viewer') {?>
                            <div class="d-flex flex-column align-items-center justify-content-center position-absolute end-0 gap-2 top-0 p-2" style="z-index: 10;">
                                <i id="deleteEvent" class="bi bi-trash delete-item" title="Delete" data-timeline-id="<?= $timeline_id ?>"></i>
                                <i id="toggleEditMode" class="bi bi-pencil" title="Edit"></i>
                                <a href="<?= base_url("calendar/print_event?id=$timeline_id") ?>"><i class="fa-solid fa-arrow-down"></i></a>
                            </div>
                        <?php }?>

                        <!-- Header can be conditional -->
                        <?php if (!empty($calendar['timeline'])): ?>
                            <div class="">
                                <div class="d-flex align-items-center">
                                    <span>
                                        Date: <?= htmlspecialchars(date('d-m-Y', strtotime($date))) ?>
                                        <span class="tabbed">
                                            Opening Time: <?= htmlspecialchars($openingTime) ?> |
                                            Closing Time: <?= htmlspecialchars($closingTime) ?>
                                        </span>
                                    </span>

                                    <span class="text-white btn btn-primary" style="margin-left: 10%">
                                        <?php
                                            $timeline_type_map = [
                                                '6' => 'Task',
                                                '1' => 'Milestone',
                                                '2' => 'Strategies',
                                                '3' => 'Scene',
                                                '4' => 'Updates',
                                                '5' => 'Events'
                                            ];
                                            echo $timeline_type_map[$calendar['timeline_details']['timeline_type']] ?? 'Timeline';
                                        ?>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- 🔥 ALWAYS render wrapper so drop works -->
                        <div class="timeline-wrapper">

                            <div id="new-timeline-dropzone" class="new-timeline-dropzone">
                                ➕ Drop here to add a new timeline item
                            </div>

                            <div id="timeline-container">
                                <?php
                                if (!empty($calendar['timeline'])) {
                                    $this->load->view('calendar/timeline', $calendar);
                                }
                                ?>
                            </div>

                        </div>
                    </div>

                    
                    <div id="borderBoxesInputAreaContainer" class="borderBoxesAreaContainer mt-2">

                        <div class="box_textbox tab-box " id="box_textbox">
                            <h6> TEXT BOX</h6>
                            <textarea class="form-control" name="textbox" id="textbox"
                                placeholder="Enter Your Description"></textarea>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="text"
                                        data-url="<?= base_url('Calendar/saveTextbox') ?>">
                                    Update
                                </button>
                            </div>

                            <div id="textDataContainer" style="overflow-y:scroll;"></div>

                        </div>

                        <div class="box_videobox tab-box" id="box_videobox">
                            <h6> VIDEO <span style="font-size:12px; float:right; color:red"> only "mp4|mov|avi|mkv|webm"
                                    format allowed </span></h6>
                            <input type="file" class="form-control" name="videofile[]" id="video" accept="video/*" multiple>
                            <input type="text" class="form-control mt-2" name="videolink" placeholder="Paste link"
                                id="videolink">
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="video"
                                        data-url="<?= base_url('Calendar/saveVideo') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainer4" style="overflow-y:scroll;"></div>
                        </div>

                        <div class="box_audiobox tab-box" id="box_audiobox">
                            <h6> AUDIO <span style="font-size:12px; float:right; color:red"> only "mp3|mav|aac|m4a|ogg"
                                    format allowed </span></h6>
                            <input type="file" class="form-control" name="audio" id="audio">
                            <input type="text" class="form-control mt-2" name="audiolink" placeholder="Paste link"
                                accept="audio/*" id="audiolink">
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="audio"
                                        data-url="<?= base_url('Calendar/saveAudio') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainer5" style="overflow-y:scroll;"></div>
                        </div>

                        <div class="box_imagebox tab-box" id="box_imagebox">
                            <h6> IMAGE <span style="font-size:12px; float:right; color:red"> only "jpg/jpeg/png/webp" format
                                    allowed </span> </h6>
                            <input type="file" class="form-control" name="imagefile[]" id="image" style="z-index:999;" multiple>
                            <input type="text" class="form-control mt-2" name="imagelink" placeholder="Paste link"
                                id="imagelink">
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="image"
                                        data-url="<?= base_url('Calendar/saveImage') ?>">
                                    Update
                                </button>

                            </div>
                            <div id="textDataContainer2" style="overflow-y:scroll;"></div>
                        </div>

                        <div class="box_DocsBox tab-box" id="box_DocsBox">
                            <h6> DOCUMENTS <span style="font-size:12px; float:right; color:red"> only
                                    "pdf|html|avi|mkv|webm" format allowed </span> </h6>
                            <input type="file" class="form-control" name="docs" id="docs">
                            <input type="text" class="form-control mt-2" name="docslink" placeholder="Paste link"
                                id="docslink">
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="docs"
                                        data-url="<?= base_url('Calendar/saveDocsLink') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainer3" style="overflow-y:scroll;"></div>
                        </div>

                        <div class="box_otherlinksbox tab-box" id="box_otherlinksbox">
                            <h6> LINKS </h6>
                            <input type="text" class="form-control" name="otherlink" placeholder="Paste link"
                                id="otherlink">
                            <div class="d-flex">
                                <input type="text" class="form-control my-2" name="time" placeholder="Time" id="time">
                                <select class="form-select my-2" id="timeslot" name="timeslot">
                                    <option value="min"> Min</option>
                                    <option value="hour"> Hours</option>
                                </select>
                            </div>
                            <select class="form-select" name="linkcategory" id="linkcategory">
                                <option value="" disabled> Select Category </option>
                                <option value="Videos"> Videos </option>
                                <option value="Images"> Images </option>
                                <option value="Docs"> Docs </option>
                                <option value="Audios"> Audios </option>
                                <option value="Websites"> Websites </option>
                                <option value="Others"> Others </option>
                            </select>

                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="other"
                                        data-url="<?= base_url('Calendar/saveCategory') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainer6" style=" overflow-y:scroll;"></div>
                        </div>

                        <div class="box_contactbox tab-box" id="box_contactbox">
                            <h6> Contact </h6>

                            <input type="tel" class="form-control"
                                name="contact"
                                id="contact"
                                placeholder="Enter contact number">

                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="contact"
                                        data-url="<?= base_url('Calendar/saveContact') ?>">
                                    Update
                                </button>
                            </div>

                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>

                        <div class="box_userbox tab-box" id="box_userbox">
                            <h6> User </h6>
                            <input class="form-control" id="searchUserElem" name="user_search" placeholder="Search user by name" value="" tabindex="-1">                            
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="user"
                                        data-url="<?= base_url('Calendar/saveUser') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>

                        <div class="box_brickbox tab-box" id="box_brickbox">
                            <h6> Brick </h6>
                            <form method="GET" action="<?php echo base_url('/company/tree-making-search-filter') ?>"
                                class="global-search-filters" id="globalSearchForm">
                                <div class="filter-box mt-1" style="width:90%;">
                                    <div style="text-align: left !important;"> Search Bricks </div>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="globally_search_filter"
                                        id="globally_search_filter" required placeholder="Search...."
                                        style="border-radius:0px;">
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary btn-sm border"
                                        style="border-radius:0px; padding:5.5px 20px"
                                        data-type="brick"
                                        data-url="<?= base_url('Calendar/saveBrick') ?>"
                                        >Search</button>
                                    </div>
                                    <div class="col-12">
                                        <div id="searchResult" style="margin-top:20px;"></div>
                                    </div>
                                </div>
                            </form>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>

                        <div class="box_dialoguebox tab-box" id="box_dialoguebox">
                            <h6> :Dialogue </h6>
                            <div class="dialogue_box">
                                <textarea placeholder="Enter Dialogue" class="form-control dialogue_textbox" name="dialogue" id="dialogue"></textarea>
                                <input type="hidden" name="dialogue_sender_id[]" id="dialogue_sender_id">
                                <!-- <div class="d-flex flex-column gap-1">
                                    <button class="btn btn-sm btn-success rounded-circle">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger rounded-circle">
                                        <i class="fa-solid fa-x"></i>
                                    </button>
                                </div> -->
                            </div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="dialogue"
                                        data-url="<?= base_url('Calendar/saveDialogue') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>

                        <div class="box_press_releasebox tab-box" id="box_press_releasebox">
                            <h6> Press Release </h6>
                            <div class="position-relative search-bar">
                                <input type="text" name="text_search" id="text_search_press_release" class="form-control mt-3" placeholder="Search Press Release">
                                <button id="press_release_search_btn" type="button" class="btn btn-outline-secondary position-absolute search-btn">
                                    <i class="fa fa-search" style="color: #555;"></i>
                                </button>
                            </div>
                            <div id="press_release_container" style="overflow-y: auto; max-height: 500px;"></div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="press_release"
                                        data-url="<?= base_url('Calendar/savePressRelease') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>

                        <div class="box_financebox tab-box" id="box_financebox">
                            <h6> Finance Box </h6>
                            <div class="position-relative">
                                <input type="number" class="form-control mt-3" name="finance" placeholder="Enter Amount">
                            </div>
                            <div id="press_release_container" style="overflow-y: auto; max-height: 500px;"></div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="finance"
                                        data-url="<?= base_url('Calendar/saveFinance') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>

                        <div class="box_countrybox tab-box" id="box_countrybox">
                            <h6> Country Box </h6>
                            <div class="position-relative">
                                <select class="form-control" name="country" id="country" style="border-radius:0px;" required >
                                    <option disabled="" selected="">Choose Country</option>
                                    <option value="1">Afghanistan</option>
                                    <option value="2">Aland Islands</option>
                                    <option value="3">Albania</option>
                                    <option value="4">Algeria</option>
                                    <option value="5">American Samoa</option>
                                    <option value="6">Andorra</option>
                                    <option value="7">Angola</option>
                                    <option value="8">Anguilla</option>
                                    <option value="9">Antarctica</option>
                                    <option value="10">Antigua and Barbuda</option>
                                    <option value="11">Argentina</option>
                                    <option value="12">Armenia</option>
                                    <option value="13">Aruba</option>
                                    <option value="14">Australia</option>
                                    <option value="15">Austria</option>
                                    <option value="16">Azerbaijan</option>
                                    <option value="18">Bahrain</option>
                                    <option value="19">Bangladesh</option>
                                    <option value="20">Barbados</option>
                                    <option value="21">Belarus</option>
                                    <option value="22">Belgium</option>
                                    <option value="23">Belize</option>
                                    <option value="24">Benin</option>
                                    <option value="25">Bermuda</option>
                                    <option value="26">Bhutan</option>
                                    <option value="27">Bolivia</option>
                                    <option value="155">Bonaire, Sint Eustatius and Saba</option>
                                    <option value="28">Bosnia and Herzegovina</option>
                                    <option value="29">Botswana</option>
                                    <option value="30">Bouvet Island</option>
                                    <option value="31">Brazil</option>
                                    <option value="32">British Indian Ocean Territory</option>
                                    <option value="33">Brunei</option>
                                    <option value="34">Bulgaria</option>
                                    <option value="35">Burkina Faso</option>
                                    <option value="36">Burundi</option>
                                    <option value="37">Cambodia</option>
                                    <option value="38">Cameroon</option>
                                    <option value="39">Canada</option>
                                    <option value="40">Cape Verde</option>
                                    <option value="41">Cayman Islands</option>
                                    <option value="42">Central African Republic</option>
                                    <option value="43">Chad</option>
                                    <option value="44">Chile</option>
                                    <option value="45">China</option>
                                    <option value="46">Christmas Island</option>
                                    <option value="47">Cocos (Keeling) Islands</option>
                                    <option value="48">Colombia</option>
                                    <option value="49">Comoros</option>
                                    <option value="50">Congo</option>
                                    <option value="52">Cook Islands</option>
                                    <option value="53">Costa Rica</option>
                                    <option value="54">Cote D'Ivoire (Ivory Coast)</option>
                                    <option value="55">Croatia</option>
                                    <option value="56">Cuba</option>
                                    <option value="249">Curaçao</option>
                                    <option value="57">Cyprus</option>
                                    <option value="58">Czech Republic</option>
                                    <option value="51">Democratic Republic of the Congo</option>
                                    <option value="59">Denmark</option>
                                    <option value="60">Djibouti</option>
                                    <option value="61">Dominica</option>
                                    <option value="62">Dominican Republic</option>
                                    <option value="64">Ecuador</option>
                                    <option value="65">Egypt</option>
                                    <option value="66">El Salvador</option>
                                    <option value="67">Equatorial Guinea</option>
                                    <option value="68">Eritrea</option>
                                    <option value="69">Estonia</option>
                                    <option value="212">Eswatini</option>
                                    <option value="70">Ethiopia</option>
                                    <option value="71">Falkland Islands</option>
                                    <option value="72">Faroe Islands</option>
                                    <option value="73">Fiji Islands</option>
                                    <option value="74">Finland</option>
                                    <option value="75">France</option>
                                    <option value="76">French Guiana</option>
                                    <option value="77">French Polynesia</option>
                                    <option value="78">French Southern Territories</option>
                                    <option value="79">Gabon</option>
                                    <option value="81">Georgia</option>
                                    <option value="82">Germany</option>
                                    <option value="83">Ghana</option>
                                    <option value="84">Gibraltar</option>
                                    <option value="85">Greece</option>
                                    <option value="86">Greenland</option>
                                    <option value="87">Grenada</option>
                                    <option value="88">Guadeloupe</option>
                                    <option value="89">Guam</option>
                                    <option value="90">Guatemala</option>
                                    <option value="91">Guernsey</option>
                                    <option value="92">Guinea</option>
                                    <option value="93">Guinea-Bissau</option>
                                    <option value="94">Guyana</option>
                                    <option value="95">Haiti</option>
                                    <option value="96">Heard Island and McDonald Islands</option>
                                    <option value="97">Honduras</option>
                                    <option value="98">Hong Kong S.A.R.</option>
                                    <option value="99">Hungary</option>
                                    <option value="100">Iceland</option>
                                    <option value="101" selected="">India</option>
                                    <option value="102">Indonesia</option>
                                    <option value="103">Iran</option>
                                    <option value="104">Iraq</option>
                                    <option value="105">Ireland</option>
                                    <option value="106">Israel</option>
                                    <option value="107">Italy</option>
                                    <option value="108">Jamaica</option>
                                    <option value="109">Japan</option>
                                    <option value="110">Jersey</option>
                                    <option value="111">Jordan</option>
                                    <option value="112">Kazakhstan</option>
                                    <option value="113">Kenya</option>
                                    <option value="114">Kiribati</option>
                                    <option value="248">Kosovo</option>
                                    <option value="117">Kuwait</option>
                                    <option value="118">Kyrgyzstan</option>
                                    <option value="119">Laos</option>
                                    <option value="120">Latvia</option>
                                    <option value="121">Lebanon</option>
                                    <option value="122">Lesotho</option>
                                    <option value="123">Liberia</option>
                                    <option value="124">Libya</option>
                                    <option value="125">Liechtenstein</option>
                                    <option value="126">Lithuania</option>
                                    <option value="127">Luxembourg</option>
                                    <option value="128">Macau S.A.R.</option>
                                    <option value="130">Madagascar</option>
                                    <option value="131">Malawi</option>
                                    <option value="132">Malaysia</option>
                                    <option value="133">Maldives</option>
                                    <option value="134">Mali</option>
                                    <option value="135">Malta</option>
                                    <option value="136">Man (Isle of)</option>
                                    <option value="137">Marshall Islands</option>
                                    <option value="138">Martinique</option>
                                    <option value="139">Mauritania</option>
                                    <option value="140">Mauritius</option>
                                    <option value="141">Mayotte</option>
                                    <option value="142">Mexico</option>
                                    <option value="143">Micronesia</option>
                                    <option value="144">Moldova</option>
                                    <option value="145">Monaco</option>
                                    <option value="146">Mongolia</option>
                                    <option value="147">Montenegro</option>
                                    <option value="148">Montserrat</option>
                                    <option value="149">Morocco</option>
                                    <option value="150">Mozambique</option>
                                    <option value="151">Myanmar</option>
                                    <option value="152">Namibia</option>
                                    <option value="153">Nauru</option>
                                    <option value="154">Nepal</option>
                                    <option value="156">Netherlands</option>
                                    <option value="157">New Caledonia</option>
                                    <option value="158">New Zealand</option>
                                    <option value="159">Nicaragua</option>
                                    <option value="160">Niger</option>
                                    <option value="161">Nigeria</option>
                                    <option value="162">Niue</option>
                                    <option value="163">Norfolk Island</option>
                                    <option value="115">North Korea</option>
                                    <option value="129">North Macedonia</option>
                                    <option value="164">Northern Mariana Islands</option>
                                    <option value="165">Norway</option>
                                    <option value="166">Oman</option>
                                    <option value="167">Pakistan</option>
                                    <option value="168">Palau</option>
                                    <option value="169">Palestinian Territory Occupied</option>
                                    <option value="170">Panama</option>
                                    <option value="171">Papua New Guinea</option>
                                    <option value="172">Paraguay</option>
                                    <option value="173">Peru</option>
                                    <option value="174">Philippines</option>
                                    <option value="175">Pitcairn Island</option>
                                    <option value="176">Poland</option>
                                    <option value="177">Portugal</option>
                                    <option value="178">Puerto Rico</option>
                                    <option value="179">Qatar</option>
                                    <option value="180">Reunion</option>
                                    <option value="181">Romania</option>
                                    <option value="182">Russia</option>
                                    <option value="183">Rwanda</option>
                                    <option value="184">Saint Helena</option>
                                    <option value="185">Saint Kitts and Nevis</option>
                                    <option value="186">Saint Lucia</option>
                                    <option value="187">Saint Pierre and Miquelon</option>
                                    <option value="188">Saint Vincent and the Grenadines</option>
                                    <option value="189">Saint-Barthelemy</option>
                                    <option value="190">Saint-Martin (French part)</option>
                                    <option value="191">Samoa</option>
                                    <option value="192">San Marino</option>
                                    <option value="193">Sao Tome and Principe</option>
                                    <option value="194">Saudi Arabia</option>
                                    <option value="195">Senegal</option>
                                    <option value="196">Serbia</option>
                                    <option value="197">Seychelles</option>
                                    <option value="198">Sierra Leone</option>
                                    <option value="199">Singapore</option>
                                    <option value="250">Sint Maarten (Dutch part)</option>
                                    <option value="200">Slovakia</option>
                                    <option value="201">Slovenia</option>
                                    <option value="202">Solomon Islands</option>
                                    <option value="203">Somalia</option>
                                    <option value="204">South Africa</option>
                                    <option value="205">South Georgia</option>
                                    <option value="116">South Korea</option>
                                    <option value="206">South Sudan</option>
                                    <option value="207">Spain</option>
                                    <option value="208">Sri Lanka</option>
                                    <option value="209">Sudan</option>
                                    <option value="210">Suriname</option>
                                    <option value="211">Svalbard and Jan Mayen Islands</option>
                                    <option value="213">Sweden</option>
                                    <option value="214">Switzerland</option>
                                    <option value="215">Syria</option>
                                    <option value="216">Taiwan</option>
                                    <option value="217">Tajikistan</option>
                                    <option value="218">Tanzania</option>
                                    <option value="219">Thailand</option>
                                    <option value="17">The Bahamas</option>
                                    <option value="80">The Gambia </option>
                                    <option value="63">Timor-Leste</option>
                                    <option value="220">Togo</option>
                                    <option value="221">Tokelau</option>
                                    <option value="222">Tonga</option>
                                    <option value="223">Trinidad and Tobago</option>
                                    <option value="224">Tunisia</option>
                                    <option value="225">Turkey</option>
                                    <option value="226">Turkmenistan</option>
                                    <option value="227">Turks and Caicos Islands</option>
                                    <option value="228">Tuvalu</option>
                                    <option value="229">Uganda</option>
                                    <option value="230">Ukraine</option>
                                    <option value="231">United Arab Emirates</option>
                                    <option value="232">United Kingdom</option>
                                    <option value="233">United States</option>
                                    <option value="234">United States Minor Outlying Islands</option>
                                    <option value="235">Uruguay</option>
                                    <option value="236">Uzbekistan</option>
                                    <option value="237">Vanuatu</option>
                                    <option value="238">Vatican City State (Holy See)</option>
                                    <option value="239">Venezuela</option>
                                    <option value="240">Vietnam</option>
                                    <option value="241">Virgin Islands (British)</option>
                                    <option value="242">Virgin Islands (US)</option>
                                    <option value="243">Wallis and Futuna Islands</option>
                                    <option value="244">Western Sahara</option>
                                    <option value="245">Yemen</option>
                                    <option value="246">Zambia</option>
                                    <option value="247">Zimbabwe</option>
                                </select>
                            </div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="country"
                                        data-url="<?= base_url('Calendar/saveCountry') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                        <div class="box_probabilitybox tab-box" id="box_probabilitybox">
                            <h6> Probability Box </h6>
                            <div class="position-relative">
                                <div class="col-4">
                                    <div class="input-group">
                                        <input type="number"
                                            id="probability"
                                            class="form-control"
                                            name="probability"
                                            min="0"
                                            max="100"
                                            step="0.01"
                                            placeholder="Enter value">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="probability"
                                        data-url="<?= base_url('Calendar/saveProbability') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                        <div class="box_religionbox tab-box" id="box_religionbox">
                            <h6> Religion Box </h6>
                            <div class="position-relative">
                                <div class="col-4">
                                    <div class="input-group">
                                        <select class="form-select" id="religion" name="religion">
                                            <option value="">Select Religion</option>
                                            <option value="Christianity">Christianity</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Hinduism">Hinduism</option>
                                            <option value="Buddhism">Buddhism</option>
                                            <option value="Sikhism">Sikhism</option>
                                            <option value="Judaism">Judaism</option>
                                            <option value="Baháʼí Faith">Baháʼí Faith</option>
                                            <option value="Jainism">Jainism</option>
                                            <option value="Shinto">Shinto</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="religion"
                                        data-url="<?= base_url('Calendar/saveReligion') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                        <div class="box_languagebox tab-box" id="box_languagebox">
                            <h6> Language Box </h6>
                            <div class="position-relative">
                                <div class="col-4">
                                    <div class="input-group">
                                        <select class="form-select" id="language" name="language">
                                            <option value="">Select Language</option>
                                            <option value="English">English</option>
                                            <option value="Mandarin Chinese">Mandarin Chinese</option>
                                            <option value="Hindi">Hindi</option>
                                            <option value="Spanish">Spanish</option>
                                            <option value="French">French</option>
                                            <option value="Arabic">Arabic</option>
                                            <!-- <option value="Bengali">Bengali</option> -->
                                            <option value="Portuguese">Portuguese</option>
                                            <option value="Russian">Russian</option>
                                            <option value="Urdu">Urdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="language"
                                        data-url="<?= base_url('Calendar/saveLanguage') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                        <div class="box_emotionbox tab-box" id="box_emotionbox">
                            <h6> Emotion Box </h6>
                            <div class="position-relative">
                                <div class="col-4">
                                    <div class="input-group">
                                        <select class="form-select" id="emotion" name="emotion">
                                            <option value="">Select Emotion</option>
                                            <option value="Happiness">Happiness</option>
                                            <option value="Sadness">Sadness</option>
                                            <option value="Anger">Anger</option>
                                            <option value="Fear">Fear</option>
                                            <option value="Surprise">Surprise</option>
                                            <option value="Disgust">Disgust</option>
                                            <option value="Contempt">Contempt</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="emotion"
                                        data-url="<?= base_url('Calendar/saveEmotion') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                        <div class="box_levelbox tab-box" id="box_levelbox">
                            <h6> Level Box </h6>
                            <div class="position-relative">
                                <div class="col-4">
                                    <div class="input-group">
                                        <input type="number"
                                            id="level"
                                            class="form-control"
                                            name="level"
                                            min="0"
                                            max="100"
                                            step="0.01"
                                            placeholder="Enter value">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="level"
                                        data-url="<?= base_url('Calendar/saveLevel') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                        <div class="box_currencybox tab-box" id="box_currencybox">
                            <h6> Currency Box </h6>
                            <div class="position-relative">
                                <div class="col-4">
                                    <div class="input-group">
                                        <select class="form-select" name="currency" id="currency" value="" style="margin-right:=10px;">
                                            <option value="">Currency</option>
                                            <option value="USD|$">$ – US Dollar</option>
                                            <option value="EUR|€">€ – Euro</option>
                                            <option value="GBP|£">£ – British Pound</option>
                                            <option value="INR|₹">₹ – Indian Rupee</option>
                                            <option value="AUD|$">$ – Australian Dollar</option>
                                            <option value="CAD|$">$ – Canadian Dollar</option>
                                            <option value="SGD|$">$ – Singapore Dollar</option>
                                            <option value="NZD|$">$ – New Zealand Dollar</option>
                                            <option value="JPY|¥">¥ – Japanese Yen</option>
                                            <option value="CNY|¥">¥ – Chinese Yuan</option>
                                            <option value="CHF|CHF">CHF – Swiss Franc</option>
                                            <option value="HKD|$">$ – Hong Kong Dollar</option>
                                            <option value="AED|د.إ">د.إ – UAE Dirham</option>
                                            <option value="SAR|﷼">﷼ – Saudi Riyal</option>
                                            <option value="QAR|﷼">﷼ – Qatari Riyal</option>
                                            <option value="OMR|﷼">﷼ – Omani Rial</option>
                                            <option value="KWD|KD">KD – Kuwaiti Dinar</option>
                                            <option value="BHD|BD">BD – Bahraini Dinar</option>
                                            <option value="TRY|₺">₺ – Turkish Lira</option>
                                            <option value="RUB|₽">₽ – Russian Ruble</option>
                                            <option value="ZAR|R">R – South African Rand</option>
                                            <option value="THB|฿">฿ – Thai Baht</option>
                                            <option value="MYR|RM">RM – Malaysian Ringgit</option>
                                            <option value="IDR|Rp">Rp – Indonesian Rupiah</option>
                                            <option value="PKR|₨">₨ – Pakistani Rupee</option>
                                            <option value="BDT|৳">৳ – Bangladeshi Taka</option>
                                            <option value="KRW|₩">₩ – South Korean Won</option>
                                            <option value="NGN|₦">₦ – Nigerian Naira</option>
                                            <option value="PHP|₱">₱ – Philippine Peso</option>
                                            <option value="VND|₫">₫ – Vietnamese Dong</option>
                                            <option value="ILS|₪">₪ – Israeli Shekel</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="currency"
                                        data-url="<?= base_url('Calendar/saveCurrency') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                        <div class="box_travelbox tab-box" id="box_travelbox">
                            <h6> Travel Box </h6>
                            <div class="position-relative">
                                <div class="col-4">
                                    <div class="input-group">
                                        <select class="form-select" id="travel" name="travel">
                                            <option value="">Select Mode</option>
                                            <option value="Metro">Metro</option>
                                            <option value="Flight">Flight</option>
                                            <option value="Walk">Walk</option>
                                            <option value="Car">Car</option>
                                            <option value="Bike">Bike</option>
                                            <option value="Bus">Bus</option>
                                            <option value="Train">Train</option>
                                            <option value="Bicycle">Bicycle</option>
                                            <option value="Truck">Truck</option>
                                            <option value="Tempo/Pickup">Tempo/Pickup</option>
                                            <option value="Rickshow/PedleRickshow">Rickshow/PedleRickshow</option>
                                            <option value="Boat/Cruse">Boat/Cruse</option>
                                            <option value="Helicopter/PrivateJet">Helicopter/PrivateJet</option>
                                            <option value="Rocket">Rocket</option>
                                            <option value="Sumberin/Navy">Sumberin/Navy</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="travel"
                                        data-url="<?= base_url('Calendar/saveTravel') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                        <div class="box_dealbox tab-box" id="box_dealbox">
                            <h6> Deal Box </h6>
                            <div class="position-relative">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="form-label" for="">Ask</label>
                                        <textarea class="form-control" name="deal_ask" id="deal_ask"></textarea>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="">Give</label>
                                        <textarea class="form-control" name="deal_give" id="deal_give"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="deal"
                                        data-url="<?= base_url('Calendar/saveDeal') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                        <div class="box_agebox tab-box" id="box_agebox">
                            <h6> Age Box </h6>
                            <div class="position-relative">
                                <div class="row">
                                    <div class="col-4">
                                        <input class="form-control" type="number" name="age" id="age" min="1" max="100">
                                    </div>
                                </div>
                            </div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="age"
                                        data-url="<?= base_url('Calendar/saveAge') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                        <div class="box_body_partbox tab-box" id="box_body_partbox">
                            <h6> Body Parts Box </h6>
                            <div class="position-relative">
                                <div class="row">
                                    <div class="col-4">
                                        <select class="form-select" name="body_part" id="body_part">
                                            <option value="head">Head</option>
                                            <option value="eyes">Eyes</option>
                                            <option value="ears">Ears</option>
                                            <option value="nose">Nose</option>
                                            <option value="mouth">Mouth</option>
                                            <option value="neck">Neck</option>
                                            <option value="shoulder">Shoulder</option>
                                            <option value="chest">Chest</option>
                                            <option value="back">Back</option>
                                            <option value="arm">Arm</option>
                                            <option value="elbow">Elbow</option>
                                            <option value="hand">Hand</option>
                                            <option value="finger">Finger</option>
                                            <option value="abdomen">Abdomen</option>
                                            <option value="hip">Hip</option>
                                            <option value="thigh">Thigh</option>
                                            <option value="knee">Knee</option>
                                            <option value="leg">Leg</option>
                                            <option value="ankle">Ankle</option>
                                            <option value="foot">Foot</option>
                                            <option value="toe">Toe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="body_part"
                                        data-url="<?= base_url('Calendar/save_body_part') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                        <div class="box_ethnicitybox tab-box" id="box_ethnicitybox">
                            <h6> Ethnicity Box </h6>
                            <div class="position-relative">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">Ethnicity</label>
                                            <select class="form-select" name="ethnicity" id="ethnicity">
                                                <option value="">Select Ethnicity</option>
                                                <option value="asian">Asian</option>
                                                <option value="african">African</option>
                                                <option value="african_american">African American</option>
                                                <option value="caucasian">Caucasian / White</option>
                                                <option value="hispanic">Hispanic / Latino</option>
                                                <option value="middle_eastern">Middle Eastern</option>
                                                <option value="native_american">Native American / Indigenous</option>
                                                <option value="pacific_islander">Pacific Islander</option>
                                                <option value="mixed">Mixed / Multiracial</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="ethnicity"
                                        data-url="<?= base_url('Calendar/saveEthnicity') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                        <div class="box_characterbox tab-box" id="box_characterbox">
                            <h6> Character Box </h6>
                            <div class="position-relative">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <select class="form-select" name="character" id="character">
                                                <option value="">Select Personality</option>

                                                <!-- Scientists -->
                                                <option value="albert_einstein">Albert Einstein</option>
                                                <option value="isaac_newton">Isaac Newton</option>
                                                <option value="nikola_tesla">Nikola Tesla</option>
                                                <option value="marie_curie">Marie Curie</option>
                                                <option value="stephen_hawking">Stephen Hawking</option>

                                                <!-- Leaders -->
                                                <option value="mahatma_gandhi">Mahatma Gandhi</option>
                                                <option value="nelson_mandela">Nelson Mandela</option>
                                                <option value="martin_luther_king">Martin Luther King Jr.</option>
                                                <option value="abraham_lincoln">Abraham Lincoln</option>
                                                <option value="winston_churchill">Winston Churchill</option>

                                                <!-- Entrepreneurs -->
                                                <option value="elon_musk">Elon Musk</option>
                                                <option value="steve_jobs">Steve Jobs</option>
                                                <option value="bill_gates">Bill Gates</option>
                                                <option value="jeff_bezos">Jeff Bezos</option>
                                                <option value="mark_zuckerberg">Mark Zuckerberg</option>

                                                <!-- Artists / Creators -->
                                                <option value="leonardo_da_vinci">Leonardo da Vinci</option>
                                                <option value="pablo_picasso">Pablo Picasso</option>
                                                <option value="william_shakespeare">William Shakespeare</option>
                                                <option value="vincent_van_gogh">Vincent van Gogh</option>

                                                <!-- Sports -->
                                                <option value="michael_jordan">Michael Jordan</option>
                                                <option value="pele">Pelé</option>
                                                <option value="lionel_messi">Lionel Messi</option>
                                                <option value="cristiano_ronaldo">Cristiano Ronaldo</option>
                                                <option value="usain_bolt">Usain Bolt</option>

                                                <!-- Entertainment -->
                                                <option value="charlie_chaplin">Charlie Chaplin</option>
                                                <option value="jackie_chan">Jackie Chan</option>
                                                <option value="michael_jackson">Michael Jackson</option>
                                                <option value="bruce_lee">Bruce Lee</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="character"
                                        data-url="<?= base_url('Calendar/saveCharacter') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                        <div class="box_timestampbox tab-box" id="box_timestampbox">
                            <h6> Timestamps Box </h6>
                            <div class="position-relative">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="s_time" class="form-lable">Start Time</label>
                                        <input id="s_time" type="time" class="form-control mt-3" name="s_timestamp" placeholder="">
                                    </div>
                                    <div class="col-6">
                                        <label for="e_time" class="form-lable">End Time</label>
                                        <input id="e_time" type="time" class="form-control mt-3" name="e_timestamp" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div id="press_release_container" style="overflow-y: auto; max-height: 500px;"></div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="timestamp"
                                        data-url="<?= base_url('Calendar/saveTimestamp') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                        <div class="box_coordinatesbox tab-box" id="box_coordinatesbox">
                            <h6> Coordinates Box </h6>
                            <div class="position-relative">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="x_cord" class="form-lable">X</label>
                                        <input id="x_cord" type="number" class="form-control mt-3" name="x_cord" placeholder="">
                                    </div>
                                    <div class="col-2">
                                        <label for="y_cord" class="form-lable">Y</label>
                                        <input id="y_cord" type="number" class="form-control mt-3" name="y_cord" placeholder="">
                                    </div>
                                    <div class="col-2">
                                        <label for="z_cord" class="form-lable">Z</label>
                                        <input id="z_cord" type="number" class="form-control mt-3" name="z_cord" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div id="press_release_container" style="overflow-y: auto; max-height: 500px;"></div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="coordinates"
                                        data-url="<?= base_url('Calendar/saveCoordinates') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                        <div class="box_ministrybox tab-box" id="box_ministrybox">
                            <h6> Ministry Box </h6>
                            <div class="position-relative">
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label">Select Ministry</label>
                                        <select class="form-select" name="ministry" id="ministry">
                                            <option value="">-- Select Ministry --</option>

                                            <option>Ministry of Home Affairs</option>
                                            <option>Ministry of Finance</option>
                                            <option>Ministry of Defence</option>
                                            <option>Ministry of External Affairs</option>
                                            <option>Ministry of Education</option>
                                            <option>Ministry of Health and Family Welfare</option>
                                            <option>Ministry of Road Transport and Highways</option>
                                            <option>Ministry of Railways</option>
                                            <option>Ministry of Commerce and Industry</option>
                                            <option>Ministry of Agriculture and Farmers Welfare</option>
                                            <option>Ministry of Housing and Urban Affairs</option>
                                            <option>Ministry of Power</option>
                                            <option>Ministry of Environment, Forest and Climate Change</option>
                                            <option>Ministry of Labour and Employment</option>
                                            <option>Ministry of Information and Broadcasting</option>
                                            <option>Ministry of Electronics and Information Technology</option>
                                            <option>Ministry of Tourism</option>
                                            <option>Ministry of Women and Child Development</option>
                                            <option>Ministry of MSME</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="press_release_container" style="overflow-y: auto; max-height: 500px;"></div>
                            <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="ministry"
                                        data-url="<?= base_url('Calendar/saveMinistry') ?>">
                                    Update
                                </button>
                            </div>
                            <div id="textDataContainerContact" style="overflow-y:scroll;"></div>
                        </div>
                    </div>
                   <div class="fw-semibold">
                        Total Finance: <span class="text-success">₹ <?= number_format($calendar['finance_total'], 2) ?></span>
                    </div>
                    <div class="text-center">
                    <?php if($permission['permission_type'] != 'viewer'){ ?>
                        <button class="btn btn-sm btn-dark mx-auto" onclick="alert('Data saved successfully!')">
                            Save
                        </button>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const calendarPermission = <?= json_encode($permission ?? null); ?>;
    $(document).ready(function () {

    if (typeof calendarPermission !== 'undefined' &&
        calendarPermission &&
        calendarPermission.permission_type === 'viewer') {

        console.log("Viewer mode enabled — everything locked.");

        //////////////////////////////////////////////////////
        // 🔒 Hide save buttons
        //////////////////////////////////////////////////////
        $('.save-btn').hide();

        //////////////////////////////////////////////////////
        // 🔒 Disable all form elements
        //////////////////////////////////////////////////////
        $('input, textarea, select, button').prop('disabled', true);
        $('input[type="file"]').prop('disabled', true);
        $('input[type="checkbox"], input[type="radio"]').prop('disabled', true);

        //////////////////////////////////////////////////////
        // 🔒 Disable contenteditable areas
        //////////////////////////////////////////////////////
        $('[contenteditable="true"]').attr('contenteditable', 'false');

        //////////////////////////////////////////////////////
        // 🔒 Disable jQuery UI draggable elements
        //////////////////////////////////////////////////////
        if ($.fn.draggable) {
            $('.draggable, .drag-item, .dropped-item').draggable('disable');
        }

        //////////////////////////////////////////////////////
        // 🔒 Disable native draggable elements
        //////////////////////////////////////////////////////
        $('[draggable="true"]').attr('draggable', 'false');

        //////////////////////////////////////////////////////
        // 🔒 Disable your custom drop logic
        //////////////////////////////////////////////////////
        if (typeof canDropNewItem !== 'undefined') {
            canDropNewItem = false;
        }

        //////////////////////////////////////////////////////
        // 🔒 Block dragstart event completely
        //////////////////////////////////////////////////////
        $(document).on('dragstart', function (e) {
            e.preventDefault();
            return false;
        });

        //////////////////////////////////////////////////////
        // 🔒 Add visual lock indicator
        //////////////////////////////////////////////////////
        $('body').addClass('viewer-mode');

    }

});
</script>

<script>
    // 🔹 Hide all tabs inside this modal
    document.querySelectorAll('.tab-box').forEach(tab => {
        tab.style.display = "none";
    });
    
    function getFinalDateTime() {

        // 🔥 get date FROM THIS MODAL only
        const dateText = $('#modalDateName').val().trim();
        console.log("dateText", dateText);
        if (!dateText) return null;

        const d = new Date(dateText);
        if (isNaN(d)) return null;

        const year = d.getFullYear();
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const day = String(d.getDate()).padStart(2, '0');

        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }

    $(document).on('click', '.save-btn', function (e) {

        e.preventDefault();  

        const btn = this;
        const mode = btn.dataset.mode || 'create';
        const editId = btn.dataset.id || null;
        
        // const modal = btn.closest('.calendar-modal');
        // const $modal = $(modal);

        const scheduleType = 0; // 0 or 1
        const type = $(btn).data('type');

        if (type === 'user' && btn.dataset.userMode === 'receiver') {
            btn.dataset.url = "<?= base_url('Calendar/updateDialogueReceivers') ?>";
        }

        const url  = $(btn).data('url');

        let formData = new FormData();

        if (mode === 'edit' && editId) {
            formData.append('id', editId); // 🔥 send id for update
        }
                
        let wrapper = activeDroppedWrapper || document.querySelector('.dropped-item.active');

        const timelineItemId = wrapper?.dataset?.timelineItemId || null;
        console.log("wrapper",wrapper)
        console.log("timelineItemId", timelineItemId);

        const allowedTypes = ['video', 'image', 'user', 'finance', 'audio', 'timestamp'];

        if (allowedTypes.includes(type) && timelineItemId) {
            formData.append('timeline_item_id', timelineItemId);
        } else {
            console.log("timelineItemId", timelineItemId);
            console.log("type", type);
        }



        // ✅ Fixed / Future logic
        formData.append("openingTime", $("#showOpening").val());
        formData.append("closingTime", $("#showClosing").val());
        formData.append("timeline_type", $("#timeline_type").val())
        const finalDateTime = getFinalDateTime();
        formData.append("finaldatetime", finalDateTime);

        formData.append("scheduleType", scheduleType);
        formData.append("date", $('#modalDateName').val().trim());
        const timelineData = getDroppedTimelineData(
            $('#timeline-container')
        );

        formData.append("timeline", JSON.stringify(timelineData));

        let company_id = "<?= $company_id ?>";
        if(company_id != ''){
            formData.append("company_id", company_id);
        }

        let project_id = "<?= $project_id ?>";
        if(project_id != ''){
            formData.append("project_id", project_id);
        }
        
        // ✅ MODAL-SCOPED DATA COLLECTION
        switch (type) {

            case "text":
                formData.append(
                    "textbox",
                    $("#textbox").val()
                );
                break;

           case "image": {
                const files = $("#image")[0]?.files || [];

                for (let i = 0; i < files.length; i++) {
                    formData.append("imagefile[]", files[i]); // 🔥 IMPORTANT: [] 
                }

                formData.append("imagelink", $("#imagelink").val() || "");
                break;
            }


            case "video":{
                const files = $("#video")[0]?.files || [];

                for (let i = 0; i < files.length; i++) {
                    formData.append("videofile[]", files[i]);
                }
                
                formData.append(
                    "videolink",
                    $("#videolink").val()
                );

                break;
            }

            case "audio":
                formData.append(
                    "audiofile",
                    $("#audio")[0]?.files[0]
                );
                formData.append(
                    "audiolink",
                    $("#audiolink").val()
                );
                break;

            case "docs":
                formData.append(
                    "docsfile",
                    $("#docs")[0]?.files[0]
                );
                formData.append(
                    "docslink",
                    $("#docslink").val()
                );
                break;

            case "other":
                formData.append(
                    "otherlink",
                    $("#otherlink").val()
                );
                formData.append(
                    "time",
                    $("#time").val()
                );
                formData.append(
                    "timeslot",
                    $("#timeslot").val()
                );
                formData.append(
                    "linkcategory",
                    $("#linkcategory").val()
                );
                break;
            case "contact":
                formData.append(
                    "contact",
                    $("#contact").val()
                );
                break;
            case "user": {
                const $boxUser = $('#box_userbox');
                const mode = $boxUser.data('mode') || 'create-user';

                formData.append("user", $("#searchUserElem").val());

                // 🧠 Tell backend what we’re doing
                formData.append("user_mode", mode);

                break;
            }
            case "brick":
                let selectedBricks = [];
                
                $('input[name="mybookbricks[]"]:checked').each(function () {
                    selectedBricks.push($(this).val());
                });

                if (selectedBricks.length === 0) {
                    alert('Please select at least one brick before saving.');
                    return;
                }

                formData.append(
                    "brick",
                    selectedBricks
                )
            case "dialogue":
                formData.append(
                    "dialogue",
                    $("#dialogue").val()
                );
                formData.append(
                    "sender_ids",
                    $("#dialogue_sender_id").val()
                );
                formData.append(
                    "timeline_item_id",
                    $('#box_dialoguebox').data('timeline-item-id')
                );
                break;
            case "press_release":

                let selectedPressRelease = [];

                $('input[name="press_release[]"]:checked').each(function () {
                    const id = $(this).val();
                    const type = $(this)
                        .closest('.press-release-item')
                        .find('.press-release-type')
                        .val();

                    selectedPressRelease.push({
                        id: id,
                        type: type
                    });
                });

                if (selectedPressRelease.length === 0) {
                    alert('Please select at least one press release before saving.');
                    return;
                }
                
                formData.append(
                    'press_release',
                    JSON.stringify(selectedPressRelease)
                )

                break;

            case "finance": {
                const amount = $("#box_financebox input[name='finance']").val();

                if (!amount || Number(amount) <= 0) {
                    alert('Please enter a valid finance amount');
                    return;
                }

                formData.append("finance", amount);
                break;
            }
            case "country": {
                const country_code = $("#country").val();
                
                formData.append("country", country_code);
                break;
            }
            case "probability": {
                const probability = $("#probability").val();
                
                formData.append("probability", probability);
                break;
            }
            case "religion": {
                const religion = $("#religion").val();
                
                formData.append("religion", religion);
                break;
            }
            case "language": {
                const language = $("#language").val();
                
                formData.append("language", language);
                break;
            }
            case "emotion": {
                const emotion = $("#emotion").val();
                
                formData.append("emotion", emotion);
                break;
            }
            case "level": {
                const level = $("#level").val();
                
                formData.append("level", level);
                break;
            }
            case "travel": {
                const travel = $("#travel").val();
                
                formData.append("travel", travel);
                break;
            }
            case "currency": {
                const currency = $("#currency").val();
                
                formData.append("currency", currency);
                break;
            }
            case "deal": {
                const deal_ask = $("#deal_ask").val();
                const deal_give = $("#deal_give").val();
                formData.append("deal_ask", deal_ask);
                formData.append("deal_give", deal_give);
                break;
            }
            case "age": {
                const age = $("#age").val();
                
                formData.append("age", age);
                break;
            }
            case "body_part": {
                const body_part = $("#body_part").val();
                
                formData.append("body_part", body_part);
                break;
            }
            case "ethnicity": {
                const ethnicity = $("#ethnicity").val();
                
                formData.append("ethnicity", ethnicity);
                break;
            }
            case "character": {
                const character = $("#character").val();
                
                formData.append("character", character);
                break;
            }
            case "timestamp": {
                const s_timestamp = $("#box_timestampbox input[name='s_timestamp']").val();
                const e_timestamp = $("#box_timestampbox input[name='e_timestamp']").val();

                if (!s_timestamp && !e_timestamp) {
                    alert('Please enter start and end timestamp');
                    return;
                }

                formData.append("s_timestamp", s_timestamp);
                formData.append("e_timestamp", e_timestamp);
                break;
            }
            case "coordinates": {
                const x_cord = $("#x_cord").val();
                const y_cord = $("#y_cord").val();
                const z_cord = $("#z_cord").val();

                formData.append("x_cord", x_cord);
                formData.append("y_cord", y_cord);
                formData.append("z_cord", z_cord);
            }
            case "ministry": {
                const ministry = $("#ministry").val();

                formData.append("ministry", ministry);
            }

        }
        // console.table([...formData.entries()]);

        // ✅ AJAX
        $.ajax({
            url,
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success(res) {
                console.log(res);
                alert(res.message);

                if (res.html) {
                    $('#timeline-container').html(res.html); // 🔥 PHP re-renders everything
                }

                canDropNewItem = true;
                activeDroppedWrapper = null;
                clearInputFieldsByType(type);
                $('.add_more_btn').removeClass("d-none");
                updateTimelineLines($('#timeline-container'));

            },
            error(xhr) {
                alert("AJAX Error");
                console.error(xhr.responseText);
            }
        });
    });

    function clearInputFieldsByType(type) {

        /* =========================
            COMMON (ALL TYPES)
        ========================= */
        $("input[type='text'], input[type='url'], textarea").val("");

        // Clear time / date UI
        $("#showOpening").text("");
        $("#showClosing").text("");
        $(".time-slot, .date-slot").removeClass("active");

        /* =========================
            TYPE-SPECIFIC CLEARING
        ========================= */
        switch (type) {

            /* -------- TEXT -------- */
            case "text":
            $("#textbox").val("");
            break;

            /* -------- IMAGE -------- */
            case "image":
            $("#image").val(null);
            $("#imagelink").val("");
            $(".image-preview, .file-preview").empty();
            break;

            /* -------- VIDEO -------- */
            case "video":
            $("#video").val(null);
            $("#videolink").val("");
            $(".video-preview, .file-preview").empty();
            break;

            /* -------- AUDIO -------- */
            case "audio":
            $("#audio").val(null);
            $("#audiolink").val("");
            $(".audio-preview, .file-preview").empty();
            break;

            /* -------- DOCS -------- */
            case "docs":
            $("#docs").val(null);
            $("#docslink").val("");
            $(".docs-preview, .file-preview").empty();
            break;

            /* -------- OTHER -------- */
            case "other":
            $("#otherlink").val("");
            $("#time").val("");
            $("#timeslot").val("");
            $("#linkcategory").prop("selectedIndex", 0);
            break;

            case "user":
            userSearch.removeAllTags();
            break;

        }
        $('#borderBoxesInputAreaContainer').hide()
        /* =========================
            OPTIONAL UI CLEANUP
        ========================= */
        $(".is-invalid").removeClass("is-invalid");
        $(".error-message").remove();
    }

</script>

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
    let searchUserElem = document.getElementById('searchUserElem');

    function tagTemplate(tagData) {
        return `
        <tag title="${tagData.email || ''}" 
                contenteditable='false' 
                spellcheck='false' 
                tabIndex="-1" 
                class="tagify__tag" 
                value="${tagData.value}">
            <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
            <div class="d-flex align-items-center">
                <img src="${tagData.avatar || 'assets/user-icon.png'}" 
                        class="rounded-circle me-2" 
                        style="width: 24px; height: 24px;">
                <div>
                    <div class="fw-bold">${tagData.label || tagData.value}</div>
                    <small class="text-muted">${tagData.email || ''}</small>
                </div>
            </div>
        </tag>
    `;
    }

    function suggestionItemTemplate(tagData) {
        return `
        <div ${this.getAttributes(tagData)}
            class='tagify__dropdown__item d-flex align-items-center ${tagData.class ? tagData.class : ""}'
            tabindex="0"
            role="option">
            ${tagData.avatar ? `
            <div class='tagify__dropdown__item__avatar-wrap'>
                <img onerror="this.style.visibility='hidden'" class="avatar rounded me-2" src="${tagData.avatar}">
            </div>` : ''
            }
            <div>
                <div class="fw-bold">${tagData.label || tagData.value}</div>
                <small class="text-muted">${tagData.email || ''}</small>
            </div>
        </div>
    `;
    }

    function dropdownHeaderTemplate(suggestions) {
        return `
        <div class="${this.settings.classNames.dropdownItem} ${this.settings.classNames.dropdownItem}__addAll">
            <strong>${this.value.length ? `Add remaining ${suggestions.length}` : 'Add All'}</strong>
            <span>${suggestions.length} members</span>
        </div>
    `;
    }

    // console.log("searchUserElem",searchUserElem)

    var userSearch = new Tagify(searchUserElem, {
        tagTextProp: 'name',
        enforceWhitelist: true,
        skipInvalid: true,
        dropdown: {
            closeOnSelect: false,
            enabled: 0,
            classname: 'users-list',
            searchKeys: ['name', 'email']
        },
        templates: {
            tag: tagTemplate,
            dropdownItem: suggestionItemTemplate,
            dropdownHeader: dropdownHeaderTemplate
        },
        whitelist: []
    });

    userSearch.on('input', function(e) {
        var value = e.detail.value.trim();
        userSearch.loading(true);

        fetch('<?php echo base_url('Home/searchUsers'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    search: value
                })
            })
            .then(response => response.json())
            .then(data => {
                userSearch.loading(false);
                if (data.success && Array.isArray(data.users)) {
                    userSearch.settings.whitelist = data.users.map(user => ({
                        value: user.id,
                        name: user.name,
                        label: user.name,
                        email: user.email,
                        avatar: user.avatar || 'assets/user-icon.png'
                    }));
                    userSearch.dropdown.show(value);
                } else {
                    userSearch.settings.whitelist = [];
                    userSearch.dropdown.hide();
                    alert('No users found or invalid response from server.');
                }
            })
            .catch(error => {
                userSearch.loading(false);
                console.error('Error searching users:', error);
                alert('Failed to search users: ' + error.message);
            });
    });

    function preloadUsersToTagify(users) {
        // console.log('preloadUsers called');
        // console.log('users', users);
        userSearch.removeAllTags(); // 🔥 reset

        const tagifyUsers = users.map(u => ({
            value: u.id,
            name: u.name,
            label: u.name,
            email: u.email,
            avatar: u.user_image
                ? `<?= base_url('uploads/user_profile/') ?>${u.user_image}`
                : 'assets/user-icon.png'
        }));
        
        userSearch.settings.whitelist = tagifyUsers.map(u => ({
            value: String(u.value),
            name: u.name,
            label: u.label,
            email: u.email,
            avatar: u.avatar
        }));

        // console.log('users', tagifyUsers);
        userSearch.addTags(tagifyUsers);
    }
</script>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script>
    let draggedElement = null;
    let canDropNewItem = true;
    let activeDroppedWrapper = null;
    const NO_NEW_WRAPPER_TYPES = ['black_line','dialogue','finance','timestamp'];
    

    document.addEventListener('dragstart', (e) => {
        if (!e.target.classList.contains('draggable-btn')) return;
        
        draggedElement = e.target;

        const dropZone = document.getElementById('new-timeline-dropzone');
        
        const type = e.target.dataset.type;

        if (!dropZone) return;

        const isRestricted = NO_NEW_WRAPPER_TYPES.includes(type);

        // ❌ Don't show new drop box for restricted types (black_line etc.)
        if (isRestricted) {
            console.log('item is restricted to drop');
            dropZone.style.display = 'none';
        } 
        // ✅ Show for normal types
        else {
            dropZone.style.display = 'block';
        }
    });

    // document.addEventListener('dragover', (e) => {
    //     const dropContainer = e.target.closest('#timeline-container');

    //     if (!dropContainer) return;

    //     e.preventDefault();

    //     dropContainer.classList.add('drag-over');
    // });

    // document.addEventListener('dragleave', (e) => {
    //     const dropContainer = e.target.closest('#timeline-container');

    //     if (!dropContainer) return;

    //     dropContainer.classList.remove('drag-over');
    // });
    
    // document.addEventListener('dragover', (e) => {
    //     const droppedItem = e.target.closest('.dropped-item');
    //     const dropContainer = e.target.closest('#timeline-container');
    //     const newDropZone = e.target.closest('#new-timeline-dropzone');

    //     if (droppedItem || dropContainer || newDropZone) e.preventDefault();

    //     // reset styles
    //     document.querySelectorAll('#timeline-container, #new-timeline-dropzone')
    //         .forEach(c => c.classList.remove('drag-allow'));

    //     document.querySelectorAll('.dropped-item')
    //         .forEach(item => item.classList.remove('drag-over'));

    //     // highlight container
    //     if (dropContainer && !droppedItem) {
    //         dropContainer.classList.add('drag-allow');
    //     }

    //     // highlight existing item
    //     if (droppedItem) {
    //         droppedItem.classList.add('drag-over');
    //     }

    //     // 🔥 highlight new-item drop zone
    //     if (newDropZone) {
    //         newDropZone.classList.add('drag-over');
    //     }
    // });

    document.addEventListener('dragover', (e) => {
        const droppedItem = e.target.closest('.dropped-item');
        const dropContainer = e.target.closest('#timeline-container');
        const newDropZone = e.target.closest('#new-timeline-dropzone');

        const dragType = draggedElement?.dataset?.type;
        const isRestricted = NO_NEW_WRAPPER_TYPES.includes(dragType);

        // ✅ Allow drop:
        // - restricted items → only on existing dropped-item
        // - normal items → anywhere valid
        if (
            (droppedItem) ||
            (!isRestricted && (dropContainer || newDropZone))
        ) {
            e.preventDefault();
        }

        // reset styles
        document.querySelectorAll('#timeline-container, #new-timeline-dropzone')
            .forEach(c => c.classList.remove('drag-allow'));

        document.querySelectorAll('.dropped-item')
            .forEach(item => item.classList.remove('drag-over'));

        // 🔥 highlight existing item (always allowed)
        if (droppedItem) {
            droppedItem.classList.add('drag-over');
        }

        // 🔥 highlight container only for allowed types
        if (!isRestricted && dropContainer && !droppedItem) {
            dropContainer.classList.add('drag-allow');
        }

        // 🔥 highlight new-item drop zone only for allowed types
        if (!isRestricted && newDropZone) {
            newDropZone.classList.add('drag-over');
        }
    });




    // document.addEventListener('dragleave', (e) => {
    //     const droppedItem = e.target.closest('.dropped-item');
    //     const related = e.relatedTarget?.closest?.('.dropped-item');

    //     if (!droppedItem || droppedItem === related) return;

    //     droppedItem.classList.remove('drag-over');

    //     const newDropZone = e.target.closest('#new-timeline-dropzone');
    //     if (newDropZone) {
    //         newDropZone.classList.remove('drag-over');
    //     }
    // });

    document.addEventListener('dragleave', (e) => {
        const droppedItem = e.target.closest('.dropped-item');
        const relatedItem = e.relatedTarget?.closest?.('.dropped-item');

        // 🔥 If still inside same dropped-item, ignore
        if (!droppedItem || droppedItem === relatedItem) return;

        droppedItem.classList.remove('drag-over');

        const newDropZone = e.target.closest('#new-timeline-dropzone');
        const relatedZone = e.relatedTarget?.closest?.('#new-timeline-dropzone');

        if (newDropZone && newDropZone !== relatedZone) {
            newDropZone.classList.remove('drag-over');
        }
    });

    
    // document.addEventListener('drop', (e) => {

    //     const dropZone = document.getElementById('new-timeline-dropzone');

    //     if (dropZone) {
    //         dropZone.style.display = 'none';
    //         dropZone.classList.remove('drag-over');
    //     }

    //     document.querySelectorAll('.dropped-item.drag-over')
    //         .forEach(el => el.classList.remove('drag-over'));

    //     const newDropZone = e.target.closest('#new-timeline-dropzone');

    //     // 🔥 Always resolve timeline container safely
    //     const dropContainer = document.getElementById('timeline-container');
    //     const existingWrapper = e.target.closest('.dropped-item');

    //     // ❗ Allow drop on NEW drop zone as well
    //     if ((!dropContainer && !existingWrapper && !newDropZone) || !draggedElement) return;

    //     e.preventDefault();

    //     if (!canDropNewItem && !existingWrapper) {
    //         alert('Please save the current item before adding another.');
    //         return;
    //     }

    //     const boxSelector = draggedElement.getAttribute('data-box');
    //     const inputArea = document.getElementById('borderBoxesInputAreaContainer');

    //     const clone = draggedElement.cloneNode(true);
    //     clone.classList.remove('draggable-btn');
    //     clone.classList.add('d-inline', 'w-fill-content');
    //     clone.removeAttribute('draggable');

    //     let add_more_btn = null;
    //     if (clone.dataset.type == 'video' || clone.dataset.type == 'image' || clone.dataset.type == 'user') {
    //         add_more_btn = document.createElement('a');
    //         add_more_btn.classList.add('btn','btn-secondary','btn-sm','ms-2','d-none','add_more_btn');
    //         add_more_btn.innerHTML = `<i class="fa-solid fa-plus"></i>`;
    //     }else if(clone.dataset.type == 'black_line'){
    //         const timelineItemId = wrapper?.dataset?.timelineItemId;

    //         if (!timelineItemId) {
    //             alert('Please drop the black line on an existing timeline item.');
    //             draggedElement = null;
    //             return;
    //         }

    //         // 🔥 Save to DB
    //         saveBlackLine(timelineItemId)
    //             .done(res => {
    //                 if (res?.success && res?.html) {
    //                     // Re-render timeline from PHP (recommended)
    //                     $('#timeline-container').html(res.html);
    //                     updateTimelineLines($('#timeline-container'));
    //                 } else if (res?.success) {
    //                     clone.style.backgroundColor = 'white';
    //                     clone.classList.add('black-line-wide');
    //                 } else {
    //                     alert(res?.message || 'Failed to save black line');
    //                 }
    //             })
    //             .fail(() => alert('Failed to save black line'));

    //     }

    //     let wrapper;

    //     // ✅ If dropped on existing timeline node → attach inside it
    //     if (existingWrapper) {
    //         wrapper = existingWrapper;
    //     } 
    //     // ✅ If dropped on NEW drop zone → create new timeline node
    //     else if (newDropZone) {
    //         wrapper = document.createElement('div');
    //         wrapper.classList.add('dropped-item', 'mb-2');

    //         const dot_wrapper = document.createElement('div');
    //         dot_wrapper.classList.add('dot-wrapper');

    //         const dot = document.createElement('span');
    //         dot.classList.add('dot');

    //         const dot_line = document.createElement('span');
    //         dot_line.classList.add('dot-line');

    //         dot_wrapper.appendChild(dot);
    //         dot_wrapper.appendChild(dot_line);

    //         const output = document.createElement('div');
    //         output.classList.add('dropped-output', 'mb-2');
    //         output.style.display = 'none';

    //         wrapper.appendChild(dot_wrapper);
    //         wrapper.appendChild(output);

    //         // 🔥 Insert at top or bottom as you prefer
    //         dropContainer.append(wrapper); // or append
    //     }
    //     // ✅ Else dropped inside timeline container (empty space)
    //     else {
    //         wrapper = document.createElement('div');
    //         wrapper.classList.add('dropped-item', 'mb-2');

    //         const dot_wrapper = document.createElement('div');
    //         dot_wrapper.classList.add('dot-wrapper');

    //         const dot = document.createElement('span');
    //         dot.classList.add('dot');

    //         const dot_line = document.createElement('span');
    //         dot_line.classList.add('dot-line');

    //         dot_wrapper.appendChild(dot);
    //         dot_wrapper.appendChild(dot_line);

    //         const output = document.createElement('div');
    //         output.classList.add('dropped-output', 'mb-2');
    //         output.style.display = 'none';

    //         wrapper.appendChild(dot_wrapper);
    //         wrapper.appendChild(output);

    //         dropContainer.appendChild(wrapper);
    //     }

    //     // 🔥 Attach new button inside node
    //     const dotWrapper = wrapper.querySelector('.dot-wrapper');
    //     dotWrapper.appendChild(clone);
    //     if (add_more_btn) dotWrapper.appendChild(add_more_btn);

    //     // ✅ Show related input box
    //     if (boxSelector && inputArea) {
    //         inputArea.style.display = 'block';
    //         inputArea.querySelectorAll('.tab-box').forEach(b => b.style.display = 'none');

    //         const box = inputArea.querySelector(boxSelector);
    //         if (box) {
    //             box.style.display = 'block';

    //             const saveBtn = box.querySelector('.save-btn');
    //             if (saveBtn) {
    //                 saveBtn.dataset.mode = 'create';
    //                 delete saveBtn.dataset.id;
    //                 saveBtn.textContent = 'Save';
    //             }
    //         }
    //     }

    //     canDropNewItem = false;
    //     activeDroppedWrapper = wrapper;
    //     draggedElement = null;
    // });
    
    document.addEventListener('drop', (e) => {

        const dropZone = document.getElementById('new-timeline-dropzone');
        if (dropZone) {
            dropZone.style.display = 'none';
            dropZone.classList.remove('drag-over');
        }

        document.querySelectorAll('.dropped-item.drag-over')
            .forEach(el => el.classList.remove('drag-over'));

        const newDropZone = e.target.closest('#new-timeline-dropzone');

        const dropContainer = document.getElementById('timeline-container');
        const existingWrapper = e.target.closest('.dropped-item');

        if ((!dropContainer && !existingWrapper && !newDropZone) || !draggedElement) return;
        e.preventDefault();

        if (!canDropNewItem && !existingWrapper) {
            alert('Please save the current item before adding another.');
            return;
        }

        const boxSelector = draggedElement.getAttribute('data-box');
        const inputArea = document.getElementById('borderBoxesInputAreaContainer');

        const clone = draggedElement.cloneNode(true);
        clone.classList.remove('draggable-btn');
        clone.classList.add('d-inline', 'w-fill-content');
        clone.removeAttribute('draggable');

        let add_more_btn = null;
        if (clone.dataset.type == 'video' || clone.dataset.type == 'image' || clone.dataset.type == 'user') {
            add_more_btn = document.createElement('a');
            add_more_btn.classList.add('btn','btn-secondary','btn-sm','ms-2','d-none','add_more_btn');
            add_more_btn.innerHTML = `<i class="fa-solid fa-plus"></i>`;
        }

        let wrapper;

        // ✅ Resolve wrapper FIRST
        if (existingWrapper) {
            wrapper = existingWrapper;
        } else if (newDropZone) {
            wrapper = document.createElement('div');
            wrapper.classList.add('dropped-item', 'mb-2');

            const dot_wrapper = document.createElement('div');
            dot_wrapper.classList.add('dot-wrapper');

            const dot = document.createElement('span');
            dot.classList.add('dot');

            const dot_line = document.createElement('span');
            dot_line.classList.add('dot-line');

            dot_wrapper.appendChild(dot);
            dot_wrapper.appendChild(dot_line);

            const output = document.createElement('div');
            output.classList.add('dropped-output', 'mb-2');
            output.style.display = 'none';

            wrapper.appendChild(dot_wrapper);
            wrapper.appendChild(output);

            dropContainer.append(wrapper);
        } else {
            wrapper = document.createElement('div');
            wrapper.classList.add('dropped-item', 'mb-2');

            const dot_wrapper = document.createElement('div');
            dot_wrapper.classList.add('dot-wrapper');

            const dot = document.createElement('span');
            dot.classList.add('dot');

            const dot_line = document.createElement('span');
            dot_line.classList.add('dot-line');

            dot_wrapper.appendChild(dot);
            dot_wrapper.appendChild(dot_line);

            const output = document.createElement('div');
            output.classList.add('dropped-output', 'mb-2');
            output.style.display = 'none';

            wrapper.appendChild(dot_wrapper);
            wrapper.appendChild(output);

            dropContainer.append(wrapper);
        }

        // 🔥 Special case: black_line (now wrapper exists)
        if (clone.dataset.type === 'black_line') {
            const timelineItemId = wrapper?.dataset?.timelineItemId;

            if (!timelineItemId) {
                alert('Please drop the black line on an existing timeline item.');
                draggedElement = null;
                return;
            }

            saveBlackLine(timelineItemId)
                .done(res => {
                    if (res?.success && res?.html) {
                        $('#timeline-container').html(res.html);
                        updateTimelineLines($('#timeline-container'));
                    } else if (res?.success) {
                        // fallback: add class to wrapper so CSS can show line
                        wrapper.classList.add('has-black-line');
                    } else {
                        alert(res?.message || 'Failed to save black line');
                    }
                })
                .fail(() => alert('Failed to save black line'));

            // ❌ Do NOT append button into UI
            canDropNewItem = true;
            activeDroppedWrapper = null;
            draggedElement = null;
            return; // stop further processing
        }

        // 🔥 Attach normal buttons inside node
        const dotWrapper = wrapper.querySelector('.dot-wrapper');
        dotWrapper.appendChild(clone);
        if (add_more_btn) dotWrapper.appendChild(add_more_btn);

        // ✅ Show related input box
        if (boxSelector && inputArea) {
            inputArea.style.display = 'block';
            inputArea.querySelectorAll('.tab-box').forEach(b => b.style.display = 'none');

            const box = inputArea.querySelector(boxSelector);
            if (box) {
                box.style.display = 'block';

                const saveBtn = box.querySelector('.save-btn');
                if (saveBtn) {
                    saveBtn.dataset.mode = 'create';
                    delete saveBtn.dataset.id;
                    saveBtn.textContent = 'Save';
                }
            }
        }

        canDropNewItem = false;
        activeDroppedWrapper = wrapper;
        draggedElement = null;
    });


    function saveBlackLine(timelineItemId) {
        return $.ajax({
            url: "<?= base_url('Calendar/saveBlackLine') ?>",
            type: "POST",
            dataType: "json",
            data: {
                timeline_item_id: timelineItemId,
                is_black_line: 1
            }
        });
    }

 
    // function getDroppedTimelineData($container) {
    //     console.log('$container', $container)
    //     return $container.find('.dropped-item button').map(function (index) {
    //         return {
    //             type: $(this).data('type'),
    //             position: index + 1,
    //             old_id: $(this).closest('.dropped-item').data('id')
    //         };
    //     }).get();
    // }
    
    function getDroppedTimelineData($container) {
        return $container.find('.dropped-item').map(function (index) {

            const id = $(this).data('id');

            // ❌ Skip items that are NOT saved yet (no id)

            return {
                type: $(this).find('button').data('type'),
                position: index + 1,
                old_id: id
            };
        }).get();
    }


    
    document.addEventListener('click', function (e) {

        const editIcon = e.target.closest('.edit-item');
        if (!editIcon) return;

        const droppedItem = editIcon.closest('.dropped-item');
        if (!droppedItem) return;

        activeDroppedWrapper = droppedItem;
        canDropNewItem = false;

        const type = droppedItem.dataset.type;
        const id   = droppedItem.dataset.id;

        // 🔥 GLOBAL selector instead of modal scope
        const inputArea = document.querySelector('#borderBoxesInputAreaContainer');
        if (!inputArea) return;

        // Highlight active item (global)
        document.querySelectorAll('.dropped-item')
            .forEach(i => i.classList.remove('active'));

        droppedItem.classList.add('active');

        inputArea.style.display = 'block';

        // Hide all input boxes
        inputArea.querySelectorAll('.tab-box')
            .forEach(b => b.style.display = 'none');
        
        // Show correct input box
        const box = inputArea.querySelector(`#box_${type}box`);
        console.log('box', box)
        console.log('type', type)
        if (!box) return;

        box.style.display = 'block';

        // Load data into inputs
        loadItemData(type, id, box, editIcon);

        e.preventDefault();
        e.stopPropagation();
    });

    function loadItemData(type, id, box, editIcon) {

        let userMode = '';
        let timelineItemId = '';
        console.log("editIcon",editIcon)
        if(type == 'user'){
            userMode = editIcon?.dataset.userMode || 'sender';
            droppedItem = editIcon.closest('.dropped-item');
            console.log('droppedItem', droppedItem.dataset.timelineItemId);
            timelineItemId = droppedItem?.dataset?.timelineItemId || null;
        }

        fetch(`<?= base_url('/Calendar/getItem') ?>`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ type, id, user_mode: userMode, timeline_item_id: timelineItemId })
        })
        .then(res => res.json())
        .then(res => {
            if (!res.success) return alert('Failed to load data');

            const data = res.data;

            switch (type) {
                case 'text':
                    box.querySelector('#textbox').value = data.textbox_description;
                    break;

                case 'image':
                    box.querySelector('#imagelink').value = data.imagelink;
                    break;

                case 'video':
                    box.querySelector('#videolink').value = data.videolink;
                    break;

                case 'audio':
                    box.querySelector('#audiolink').value = data.audiolink;
                    break;

                case 'contact':
                    box.querySelector('#contact').value = data.contact;
                    break;

                case 'user':
                    preloadUsersToTagify(res.data.users);
                    box.querySelector('.save-btn').dataset.mode = 'edit';
                    box.querySelector('.save-btn').dataset.id = res.data.id;
                    box.querySelector('.save-btn').dataset.userMode = res.data.mode;
                    break;

                case 'brick':
                    box.querySelector('#searchResult').innerHTML = res.html;
                    $('#searchResult input[name="mybookbricks[]"]').prop('checked', true);
                    $('#searchResult').append(`
                        <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="brick"
                                        data-url="<?= base_url('Calendar/saveBrick') ?>"
                                        data-mode="edit"
                                        data-id="${res.id}"
                                        >
                                    Update
                                </button>
                            </div>
                    `)
                    break;
                case 'dialogue':
                    break;
                case 'press_release':
                    box.querySelector('#press_release_container').innerHTML = res.html;
                    $('.search-bar').hide()
                    $('#press_release_container input[name="press_release[]"]').prop('checked', true);
                    break;
                case 'country':
                    box.querySelector('#contact').value = data.contact;
                    break;
                case 'probability':
                    box.querySelector('#probability').value = data.probability;
                    break;
                case 'religion':
                    box.querySelector('#religion').value = data.religion;
                    break;
                case 'emotion':
                    box.querySelector('#emotion').value = data.emotion;
                    break;
                case 'level':
                    box.querySelector('#level').value = data.level;
                    break;
                case 'currency':
                    box.querySelector('#currency').value = data.currency;
                    break;
                case 'travel':
                    box.querySelector('#travel').value = data.travel;
                    break;
                case 'deal':
                    box.querySelector('#deal_ask').value = data.deal_ask;
                    box.querySelector('#deal_give').value = data.deal_give;
                    break;
                case 'age':
                    box.querySelector('#age').value = data.age;
                    break;
                case 'body_part':
                    box.querySelector('#body_part').value = data.body_part;
                    break;
                case 'ethnicity':
                    box.querySelector('#ethnicity').value = data.ethnicity;
                    break;
                case 'character':
                    box.querySelector('#character').value = data.character;
                    break;
            }
            console.log("box",box.querySelector('.save-btn'))
            // Store edit id
            box.querySelector('.save-btn').dataset.id = data.id;
            box.querySelector('.save-btn').dataset.mode = 'edit';
        });
    }
    
    document.addEventListener('click', function (e) {

        const deleteIcon = e.target.closest('.delete-item');
        if (!deleteIcon) return;

        const item = deleteIcon.closest('.dropped-item');
        if (!item) return;

        const type = item.dataset.type;
        let id   = item.dataset.id;
        
        let single_item;
        let json = {};
        if(type == 'image' || type == 'video' || type == 'audio'){
            single_item = deleteIcon.closest(`.${type}-item`)
            // console.log("item selector",`${type}-item`)
            // console.log("single_item",single_item)
            let key = `${type}Id`
            let single_item_id = single_item.dataset[key];

            json = {
                type, 
                id: single_item_id
            }

        }else{
            json = {
                type, 
                id
            }
        }

        if (!confirm('Delete this item?')) return;
            // console.log("payload",json)
        
        fetch(`<?= base_url('Calendar/deleteItem') ?>`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(json)
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                if(type == 'image' || type == 'video' || type == 'audio'){
                    let output = item.querySelector('.dropped-output')
                    let item_count = output.querySelectorAll(`.${type}-item`).length;
                    // console.log("output", output)
                    // console.log("item_count", item_count)
                    // console.log("item selector for count", `.${type}-item`)
                    if(item_count > 1){
                        // if there is more items
                        single_item.remove();
                    }else{
                        item.remove();
                    }
                }else{
                    item.remove();
                }
                canDropNewItem = true;
                activeDroppedWrapper = null;
                document.getElementById('borderBoxesInputAreaContainer').style.display = 'none';
                updateTimelineLines($('#timeline-container'));
            }
        });

        e.preventDefault();
        e.stopPropagation();
    });

    $('#timeline-container').sortable({
        items: '.dropped-item',
        placeholder: 'drop-placeholder',
        tolerance: 'pointer',

        stop: function (event, ui) {
            const timelineData = getDroppedTimelineData($(this));
            console.log('Updated Order:', timelineData);

            saveTimelineOrder(timelineData);
        }
    });

    function saveTimelineOrder(data) {
        $.ajax({
            url: "<?= base_url('Calendar/saveTimelineOrder') ?>",
            type: "POST",
            data: {
                timeline: JSON.stringify(data)
            },
            success: function (res) {
                console.log('Saved successfully', res);
            },
            error: function (err) {
                console.error('Save failed', err);
            }
        });
    }

    
    function updateTimelineLines(container) {
        console.log('update timeline called')
        const items = container.find('.dropped-item');
        
        items.each(function (index) {
            const currentDot = this.querySelector('.dot');
            const currentLine = this.querySelector('.dot-line');

            if (!currentDot || !currentLine) return;

            const nextItem = items[index + 1];

            if (!nextItem) {
                currentLine.style.height = '0px'; // last item: no line
                return;
            }

            const nextDot = nextItem.querySelector('.dot');
            if (!nextDot) return;

            const currentRect = currentDot.getBoundingClientRect();
            const nextRect = nextDot.getBoundingClientRect();

            const distance = nextRect.top - currentRect.bottom + 5;

            currentLine.style.height = distance + 'px';
        });
    }

    const $container = $('#timeline-container');

    // After initial render
    updateTimelineLines($container);

    // After drag & drop reorder
    $container.on('sortstop', function () {
        updateTimelineLines($container);
    });

    // After dynamically adding items
    $(document).on('content:added', function () {
        updateTimelineLines($container);
    });

    // After video/image loads (height changes!)
    $container.on('loadeddata load', 'video, img', function () {
        updateTimelineLines($container);
    });

    // On window resize (optional polish)
    window.addEventListener('resize', () => updateTimelineLines($container));

    $(document).trigger('content:added');

</script>

<script>
    function getUserName(user) {
        if (user.name) return user.name;
        if (user.email) return user.email;
        return "Anonymous";
    }

    function getUserImage(user) {
        return user.user_image
            ? `<?= base_url('uploads/user_profile/') ?>${user.user_image}`
            : `<?= base_url('assets/images/img/user.png') ?>`;
    }
    
    function getEventType(schedule){
        if(schedule === '0'){
            return 'Fixed'
        }else{
            return 'Future'
        }
    }

</script> 

<script>
    // $(document).on('click', '.add_more_btn', function (e) {
    //     e.preventDefault();

    //     const $btn  = $(this);
    //     const $item = $btn.closest('.dropped-item');  // jQuery object

    //     const item_type = $item.data('type') || $item.find('[data-type]').data('type');
    //     const item_id   = $item.data('id')   || $item.find('[data-id]').data('id');

    //     console.log('btn clicked');
    //     console.log('item_type', item_type);
    //     console.log('item_id', item_id);

    //     // 🔥 mark this wrapper as active (so save-btn can find it)
    //     $('.dropped-item').removeClass('active');
    //     $item.addClass('active');

    //     // 🔥 store DOM element, not jQuery object
    //     activeDroppedWrapper = $item[0];

    //     // 🔥 Unhide input area (same behavior as drop)
    //     const $modal = $btn.closest('.calendar-modal');
    //     const $inputArea = $modal.length 
    //         ? $modal.find('#borderBoxesInputAreaContainer')
    //         : $('#borderBoxesInputAreaContainer');

    //     $inputArea.removeClass('d-none').show();
    //     $inputArea.find('.tab-box').hide();

    //     // Show only video box
    //     const box = $inputArea.find('#box_videobox');
    //     box.show();

    //     // Allow adding another video to SAME position
    //     canDropNewItem = true;
    // });

    $(document).on('click', '.add_more_btn', function (e) {
        e.preventDefault();

        const $btn  = $(this);
        const $item = $btn.closest('.dropped-item');  // jQuery object

        const item_type = $item.data('type') || $item.find('[data-type]').data('type');
        const item_id   = $item.data('id')   || $item.find('[data-id]').data('id');

        console.log('btn clicked');
        console.log('item_type', item_type);
        console.log('item_id', item_id);

        // 🔥 mark this wrapper as active (so save-btn can find it)
        $('.dropped-item').removeClass('active');
        $item.addClass('active');

        // 🔥 store DOM element, not jQuery object
        activeDroppedWrapper = $item[0];

        // 🔥 Unhide input area (same behavior as drop)
        const $modal = $btn.closest('.calendar-modal');
        const $inputArea = $modal.length 
            ? $modal.find('#borderBoxesInputAreaContainer')
            : $('#borderBoxesInputAreaContainer');

        $inputArea.removeClass('d-none').show();
        $inputArea.find('.tab-box').hide();

        // 🔥 Show correct input box based on type
        if (item_type === 'video') {
            $inputArea.find('#box_videobox').show();
        } 
        else if (item_type === 'image') {
            $inputArea.find('#box_imagebox').show();
        }
        // (optional) future-proof
        else if (item_type === 'audio') {
            $inputArea.find('#box_audiobox').show();
        }
        else if (item_type === 'docs') {
            $inputArea.find('#box_docsbox').show();
        }
        else if (item_type === 'user') {

            const $boxDialogue = $inputArea.find('#box_dialoguebox');
            const $boxUser     = $inputArea.find('#box_userbox');   // 👈 your user picker box

            // 🔥 Collect existing users (senders)
            let senderIds = [];
            $item.find('.calendar-user').each(function () {
                let uid = $(this).data('user-id');
                if (uid) senderIds.push(uid);
            });

            const hasDialogue = $item.find('.timeline-dialogues').length > 0;
            const timelineItemId = $item.data('timeline-item-id');

            // store common data
            $boxDialogue.find('#dialogue_sender_id').val(senderIds.join(','));
            $boxDialogue.data('timeline-item-id', timelineItemId);

            if (hasDialogue) {
                // 🧠 Dialogue already exists → user picker = add RECEIVERS
                $boxDialogue.hide();
                $boxUser.show();
                $boxUser.data('mode', 'add-receiver');   // 👈 ADD HERE
            } else {
                // 🧠 No dialogue yet → create first dialogue
                $boxUser.hide();
                $boxDialogue.show();
                $boxDialogue.data('mode', 'create-dialogue');
            }
        }






        // ✅ Allow adding another item to SAME position
        canDropNewItem = true;
    });
    
    function onUserAdded(newUserIds) {
        const $box = $('#box_dialoguebox');

        const senderIds = ($box.find('#dialogue_sender_id').val() || '')
            .split(',')
            .filter(Boolean);

        const receiverIds = newUserIds.filter(id => !senderIds.includes(String(id)));

        $box.data('receiver-ids', receiverIds.join(','));
    }


</script>

<script>
    $(document).on('click', '.dialogue_submit', function (e) {
        e.preventDefault();

        const $btn   = $(this);
        const $box   = $btn.closest('.timeline-dialogues'); // wrapper you render
        const dialogueId = $btn.data('id'); // 🔥 data-id="dialogue_id"

        if (!dialogueId) {
            alert('Dialogue ID missing!');
            return;
        }

        // UI: disable button while sending
        $btn.prop('disabled', true).addClass('opacity-50');

        $.ajax({
            url: "<?= base_url('Calendar/requestDialogue') ?>", // 🔥 new endpoint
            type: "POST",
            dataType: "json",
            data: {
                id: dialogueId
            },
            success: function (res) {
                if (res.success) {
                    // 🔥 Update UI
                    $box.find('.dialogue_submit, .dialogue_cancel').remove();
                    $box.append('<span class="badge bg-info">Requested</span>');
                    alert('Dialogue request sent ✅');
                } else {
                    alert(res.message || 'Failed to send request');
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Server error!');
            },
            complete: function () {
                $btn.prop('disabled', false).removeClass('opacity-50');
            }
        });
    });

</script>

<script>
    $(document).ready(function () {
        $('#globalSearchForm').on('submit', function (e) {
            e.preventDefault(); // Stop page refresh

            let form = $(this);
            let actionUrl = form.attr('action'); // Controller URL
            let searchValue = $('#globally_search_filter').val();

            if (searchValue.trim() === "") {
                $('#searchResult').html('<p style="color:red;">Please enter something to search.</p>');
                return;
            }

            $.ajax({
                url: actionUrl,
                type: 'GET',
                data: {
                    globally_search_filter: searchValue
                },
                beforeSend: function () {
                    $('#searchResult').html('<p>Searching...</p>');
                },
                success: function (response) {
                    // If controller returns HTML
                    $('#searchResult').html(response);
                    $('#searchResult').append(`
                        <div class="mx-2 text-center mt-5">
                                <button class="btn btn-dark btn-sm save-btn"
                                        data-type="brick"
                                        data-url="<?= base_url('Calendar/saveBrick') ?>">
                                    Update
                                </button>
                            </div>
                    `)

                    // If controller returns JSON (optional)
                    // let data = JSON.parse(response);
                    // $('#searchResult').html('<pre>' + JSON.stringify(data, null, 2) + '</pre>');
                },
                error: function (xhr, status, error) {
                    console.log(error);
                    $('#searchResult').html('<p style="color:red;">Something went wrong!</p>');
                }
            });
        });
    });
</script>


<script>

    const press_release_search_btn = document.getElementById('press_release_search_btn');
    let press_release_container = document.getElementById('press_release_container');

    press_release_search_btn.addEventListener('click', async function () {
      const searchValue = text_search_press_release.value.trim();

      if (!searchValue) {
        console.log('Empty search, ignoring');
        return;
      }

      try {

        press_release_search_btn.disabled = true;

        const press_release_res = await get_press_release(searchValue);

        press_release_search_btn.disabled = false;

        if (press_release_res.success) {
          const { html } = press_release_res;
          press_release_container.innerHTML = html;
        } else {
          press_release_container.innerHTML = '';
      }

      } catch (err) {
        console.error('Search failed:', err);
      }
    });

    async function get_press_release(searchValue = null) {

      let payload = {};

      if (searchValue && searchValue.trim() !== "") {
        payload.searchValue = searchValue.trim();
      }

      const res = await fetch("<?= base_url('Home/search_press_release') ?>", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
      });

      const json = await res.json();
      return json;
    }
    
    $(document).on('click', '#create_timeline', function () {
        let modalDateName = $('#modalDateName').val();
        let showOpening   = $('#showOpening').val();
        let showClosing   = $('#showClosing').val();
        let timeline_type = $('#timeline_type').val();
        let company_id = "<?= $company_id ?>";
        let project_id = "<?= $project_id ?>";

        // console.log("timeline_type",timeline_type);
        // return;
        if (!modalDateName || !showOpening || !showClosing || !timeline_type) {
            alert('Please fill all fields');
            return;
        }

        let finaldatetime = null;

        // if (!finaldatetime) {
        //     alert('Invalid date');
        //     return;
        // }

        $.ajax({
            url: '<?= base_url() ?>' + 'calendar/createTimeline',  // adjust path if needed
            type: 'POST',
            dataType: 'json',
            data: {
                date: modalDateName,
                openingtime: showOpening,
                closingtime: showClosing,
                timeline_type: timeline_type,
                finaldatetime: finaldatetime,
                company_id: company_id,
                project_id: project_id,
                schedule_type: 0
            },
            beforeSend: function () {
                $('#create_timeline').prop('disabled', true).text('Saving...');
            },
            success: function (res) {

                if (res.success) {
                    alert('✅ Timeline created successfully');

                    // optional redirect if backend sends it
                    if (res.redirect) {
                        window.location.href = res.redirect;
                    }

                } else {
                    alert(res.message || '❌ Failed to create timeline');
                }
            },
            error: function () {
                alert('❌ Server error while creating timeline');
            },
            complete: function () {
                $('#create_timeline').prop('disabled', false).text('Save');
            }
        });
    });
    
    let isEditMode = false;

    $(document).on('click', '#toggleEditMode', function () {
        isEditMode = !isEditMode;

        $('body').toggleClass('edit-mode', isEditMode);

        $(this).toggleClass('active', isEditMode);
        
        // $(this).text(isEditMode ? 'Disable Edit Mode' : 'Enable Edit Mode');
    });

</script>

<script>
    $(document).on('click', '#deleteEvent', function () {
        const timelineId = $(this).data('timeline-id');

        if (!timelineId) return alert('Invalid event');

        if (!confirm('Delete this event and all its items? This cannot be undone.')) return;

        $.ajax({
            url: "<?= base_url('calendar/deleteTimelineEvent') ?>",
            type: 'POST',
            dataType: 'json',
            data: { timeline_id: timelineId },
            success: function (res) {
                if (res.success) {
                    alert('✅ Event deleted');
                    // Refresh calendar/panel UI
                    window.location.href = "<?= base_url('calendar/index') ?>";
                } else {
                    alert(res.message || '❌ Failed to delete event');
                }
            },
            error: function () {
                alert('❌ Server error while deleting event');
            }
        });
    });

    $(document).on('click', '.download_bulk', function () {

        let dropped_item = $(this).closest('.dropped-item');

        let type = dropped_item.attr('data-type');
        let timeline_item_id = dropped_item.attr('data-timeline-item-id');

        let url = `/calendar/bulk_download?timeline_item_id=${timeline_item_id}&timeline_type=${type}`;
        let base_url = "<?= base_url() ?>";

        window.location.href = base_url + url;

    });
</script>