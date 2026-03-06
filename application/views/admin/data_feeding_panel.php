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

<style>
    .borderBoxesAreaContainer {
        border: 2px solid #007bff;
        border-radius: 10px;
        padding: 10px;
        min-height: 50px;
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
    .dot {
        width: 10px;
        height: 10px;
        background-color: #04d6e5;
        border-radius: 50%;
        position: absolute;
        left: 6px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
    }
    .dropped-item:not(:last-child)::after {
        content: "";
        position: absolute;
        left: 10px;          /* center with dot */
        top: 50%;
        width: 2px;
        height: calc(100% + 16px); /* distance to next item */
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
        gap: 10px;
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
            <?php
                $date = $calendar['timeline_details']['date'] ?? '';
                $openingTime = !empty($calendar['timeline_details']['opening_time'])
                    ? substr($calendar['timeline_details']['opening_time'], 0, 5)
                    : '00:00';

                $closingTime = !empty($calendar['timeline_details']['closing_time'])
                    ? substr($calendar['timeline_details']['closing_time'], 0, 5)
                    : '00:00';
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

                </div>
            <div class="bodycontentforModel">
                <div class="actionareaViewCase">
                    <div class="d-flex">
                        <div class="mx-2">
                            <select class="form-select text-white" name="whatyou" id="project_component"
                                style="height:30px; width:160px; margin-right: 10px; background-color: #4772f3;">
                                <option value="">Select</option>
                                <option value="task">Task</option>
                                <option value="milestone">Milestone</option>
                                <option value="strategie">Strategie</option>
                                <option value="scene">Scene</option>
                                <option value="updates">Updates</option>
                                <option value="events">Events</option>
                            </select>
                        </div>
                        <div class="mx-2">
                            <button class="btn btn-primary">Define</button>
                        </div>
                    </div>
                    <div class="d-flex mt-2">
                        <div class="mx-2">
                            <button class="btn btn-primary btn-sm tab-btn draggable-btn" style="background-color: #04d6e5ff !important;" data-url="http://localhost/brickpay.in/Calendar/gettextdata" data-type="text" data-target="#textDataContainer" data-box="#box_textbox"
                            draggable="true"
                            >
                                THOUGHTS
                            </button>
                        </div>
                        <div class="mx-2">
                            <a href="<?= base_url('company/create-brick') ?>" class="btn btn-primary btn-sm draggable-btn" style="background-color: #04d6e5ff !important;" data-url="http://localhost/brickpay.in/Calendar/gettextdata" data-type="text" data-target="#textDataContainer" data-box="#box_textbox"
                            draggable="true"
                            >
                                BRICK PAY
                            </a>
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
                                data-type="other"
                                data-target="#textDataContainer8"
                                data-box="#box_pressReleasebox"
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
                                data-url="<?= base_url('Calendar/getOtherLinksdata') ?>"
                                data-type="coordinates"
                                data-target="#textDataContainer9"
                                data-box="#box_connectionbox"
                                draggable="true"
                            ><a class="text-light" href="<?= base_url('company/coordinates') ?>">3D Coordinates</a></button>
                        </div>
                    </div>
                    <?php
                        $dragButtonMap = [

                            'text' => '
                                <button class="btn btn-sm tab-btn draggable-btn text-white"
                                    style="background-color: #04d6e5ff !important;"
                                    data-type="text"
                                    data-box="#box_textbox"
                                    draggable="true">
                                    TEXT
                                </button>
                            ',

                            'image' => '
                                <button class="btn btn-sm tab-btn draggable-btn"
                                    style="background-color: #04d6e5ff !important;"
                                    data-type="image"
                                    data-box="#box_imagebox"
                                    draggable="true">
                                    <i class="fas fa-image text-white"></i>
                                </button>
                            ',

                            'docs' => '
                                <button class="btn btn-sm tab-btn draggable-btn"
                                    style="background-color: #04d6e5ff !important;"
                                    data-type="docs"
                                    data-box="#box_DocsBox"
                                    draggable="true">
                                    <i class="fas fa-file-alt text-white"></i>
                                </button>
                            ',

                            'video' => '
                                <button class="btn btn-sm tab-btn draggable-btn"
                                    style="background-color: #04d6e5ff !important;"
                                    data-type="video"
                                    data-box="#box_videobox"
                                    draggable="true">
                                    <i class="fas fa-video text-white"></i>
                                </button>
                            ',

                            'audio' => '
                                <button class="btn btn-sm tab-btn draggable-btn"
                                    style="background-color: #04d6e5ff !important;"
                                    data-type="audio"
                                    data-box="#box_audiobox"
                                    draggable="true">
                                    <i class="bi bi-mic-fill text-white"></i>
                                </button>
                            ',

                            'other' => '
                                <button class="btn btn-sm tab-btn draggable-btn"
                                    style="background-color: #04d6e5ff !important;"
                                    data-type="other"
                                    data-box="#box_otherlinksbox"
                                    draggable="true">
                                    <i class="fa-solid fa-link text-white"></i>
                                </button>
                            ',

                            'contact' => '
                                <button class="btn btn-sm tab-btn draggable-btn text-white"
                                    style="background-color: #04d6e5ff !important;"
                                    data-type="contact"
                                    data-box="#box_contactbox"
                                    draggable="true">
                                    Contact
                                </button>
                            ',

                            'user' => '
                                <button class="btn btn-sm tab-btn draggable-btn text-white"
                                    style="background-color: #04d6e5ff !important;"
                                    data-type="user"
                                    data-box="#box_userbox"
                                    draggable="true">
                                    User
                                </button>
                            '
                        ];
                        ?>
                    <div class="content_adding__container borderBoxesAreaContainer mt-4">
                        <?php if (!empty($calendar['timeline'])): ?>
                            <?php foreach ($calendar['timeline'] as $item): ?>

                                <div class="dropped-item mb-2"
                                    data-id="<?= (int)$item['id'] ?>"
                                    data-type="<?= htmlspecialchars($item['content_type']) ?>">

                                    <span class="dot"></span>

                                    <!-- Same fake draggable button used in drop -->
                                    <div class="d-inline w-fill-content">
                                        <?= $dragButtonMap[$item['content_type']] ?? '' ?>
                                    </div>

                                    <!-- 🔥 EXACT SAME dropped-output -->
                                    <div class="dropped-output mt-2" style="display:block">

                                    <?php switch ($item['content_type']):

                                        /* ================= TEXT ================= */
                                        case 'text': ?>
                                            <div class="timeline-output text-output">
                                                <span><?= htmlspecialchars($item['textbox_description']) ?></span>
                                                <span class="edit-item">
                                                    <i class="bi bi-pencil" title="Edit"></i>
                                                </span>
                                                <span class="delete-item">
                                                    <i class="bi bi-trash delete-item" title="Delete"></i>
                                                </span>
                                            </div>
                                        <?php break; ?>

                                        /* ================= IMAGE ================= */
                                        <?php case 'image': ?>
                                            <div class="timeline-output image-output">
                                                <i class="fa-solid fa-image me-1"></i>

                                                <?php if (!empty($item['imagelink'])): ?>

                                                    <!-- IMAGE LINK -->
                                                    <img src="<?= htmlspecialchars($item['imagelink']) ?>"
                                                        width="50" height="50"
                                                        class="rounded border"
                                                        alt="Image">

                                                <?php elseif (!empty($item['image'])): ?>

                                                    <!-- IMAGE FILE -->
                                                    <img src="<?= base_url() . 'uploads/calendar_image/' . $item['image']?>"
                                                        width="50" height="50"
                                                        class="rounded border"
                                                        alt="Image">

                                                <?php else: ?>

                                                    <span>Image uploaded</span>

                                                <?php endif; ?>

                                                <span class="edit-item ms-2">
                                                    <i class="bi bi-pencil" title="Edit"></i>
                                                </span>

                                                <span class="delete-item ms-2">
                                                    <i class="bi bi-trash delete-item" title="Delete"></i>
                                                </span>
                                            </div>
                                        <?php break; ?>

                                        /* ================= VIDEO ================= */
                                        <?php case 'video': ?>
                                        <div class="timeline-output video-output">
                                            <i class="fa-solid fa-video me-1"></i>

                                            <?php if (!empty($item['videolink'])): ?>

                                                <!-- VIDEO LINK -->
                                                <a href="<?= htmlspecialchars($item['videolink']) ?>"
                                                target="_blank"
                                                rel="noopener">
                                                    <?= htmlspecialchars($item['videolink']) ?>
                                                </a>

                                            <?php elseif (!empty($item['video'])): ?>

                                                <!-- VIDEO FILE FROM SERVER -->
                                                <video controls width="200">
                                                    <source src="<?= base_url(htmlspecialchars("uploads/calendar_video/". $item['video'])) ?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>

                                            <?php else: ?>

                                                <span>No video available</span>

                                            <?php endif; ?>

                                            <span class="edit-item ms-2">
                                                <i class="bi bi-pencil" title="Edit"></i>
                                            </span>

                                            <span class="delete-item ms-2">
                                                <i class="bi bi-trash" title="Delete"></i>
                                            </span>
                                        </div>
                                    <?php break; ?>

                                        /* ================= AUDIO ================= */
                                        <?php case 'audio': ?>
                                            <div class="timeline-output audio-output">
                                                <i class="fa-solid fa-music me-1"></i>

                                                <?php if (!empty($item['audiolink'])): ?>

                                                    <!-- AUDIO LINK -->
                                                    <a href="<?= htmlspecialchars($item['audiolink']) ?>"
                                                    target="_blank"
                                                    rel="noopener">
                                                        <?= htmlspecialchars($item['audiolink']) ?>
                                                    </a>

                                                <?php elseif (!empty($item['audio'])): ?>

                                                    <!-- AUDIO FILE -->
                                                    <?php
                                                        $audioPath = base_url() . 'uploads/calendar_audio/' . $item['audio'];
                                                        $ext = pathinfo($item['audio'], PATHINFO_EXTENSION);

                                                        $mimeMap = [
                                                            'mp3' => 'audio/mpeg',
                                                            'wav' => 'audio/wav',
                                                            'ogg' => 'audio/ogg',
                                                            'm4a' => 'audio/mp4',
                                                        ];

                                                        $mimeType = $mimeMap[strtolower($ext)] ?? 'audio/mpeg';
                                                    ?>

                                                    <audio controls>
                                                        <source src="<?= $audioPath ?>" type="<?= $mimeType ?>">
                                                        Your browser does not support the audio element.
                                                    </audio>

                                                <?php else: ?>

                                                    <span>Audio uploaded</span>

                                                <?php endif; ?>

                                                <span class="edit-item ms-2">
                                                    <i class="bi bi-pencil" title="Edit"></i>
                                                </span>

                                                <span class="delete-item ms-2">
                                                    <i class="bi bi-trash delete-item" title="Delete"></i>
                                                </span>
                                            </div>
                                        <?php break; ?>

                                        /* ================= DOCS ================= */
                                        <?php case 'docs': ?>
                                        <div class="timeline-output docs-output">
                                            <i class="fa-solid fa-file-lines me-1"></i>

                                            <?php if (!empty($item['docslink'])): ?>

                                                <!-- DOCUMENT LINK -->
                                                <a href="<?= htmlspecialchars($item['docslink']) ?>"
                                                target="_blank"
                                                rel="noopener">
                                                    <?= htmlspecialchars($item['docslink']) ?>
                                                </a>

                                            <?php elseif (!empty($item['docs'])): ?>

                                                <!-- DOCUMENT FILE -->
                                                <?php
                                                    $docPath = base_url('uploads/calendar_docs/') . $item['docs'];
                                                    $docName = basename($item['docs']);
                                                ?>

                                                <a href="<?= $docPath ?>" target="_blank" rel="noopener">
                                                    <?= htmlspecialchars($docName) ?>
                                                </a>

                                            <?php else: ?>

                                                <span>Document uploaded</span>

                                            <?php endif; ?>

                                            <span class="edit-item ms-2">
                                                <i class="bi bi-pencil" title="Edit"></i>
                                            </span>

                                            <span class="delete-item ms-2">
                                                <i class="bi bi-trash delete-item" title="Delete"></i>
                                            </span>
                                        </div>
                                    <?php break; ?>

                                        /* ================= OTHER ================= */
                                        <?php case 'other': ?>
                                            <div class="timeline-output other-output">
                                                <i class="fa-solid fa-link me-1"></i>
                                                <span><?= htmlspecialchars($item['otherlink']) ?></span>

                                                <?php if (!empty($item['time'])): ?>
                                                    <small class="text-muted ms-2">
                                                        (<?= htmlspecialchars($item['time']) ?>
                                                        <?= htmlspecialchars($item['timeslot'] ?? '') ?>)
                                                    </small>
                                                <?php endif; ?>

                                                <span class="edit-item">
                                                    <i class="bi bi-pencil" title="Edit"></i>
                                                </span>
                                                <span class="delete-item">
                                                    <i class="bi bi-trash delete-item" title="Delete"></i>
                                                </span>
                                            </div>
                                        <?php break; ?>

                                        /* ================= CONTACT ================= */
                                        <?php case 'contact': ?>
                                            <div class="timeline-output contact-output">
                                                <i class="fa-solid fa-phone me-1"></i>
                                                <span><?= htmlspecialchars($item['contact']) ?></span>
                                                <span class="edit-item">
                                                    <i class="bi bi-pencil" title="Edit"></i>
                                                </span>
                                                <span class="delete-item">
                                                    <i class="bi bi-trash delete-item" title="Delete"></i>
                                                </span>
                                            </div>
                                        <?php break; ?>

                                        /* ================= USER ================= */
                                        <?php case 'user': ?>

                                        <?php
                                        $users = $item['users'] ?? [];
                                        if (empty($users)) break;
                                        ?>

                                        <div class="my_timeline py-4">
                                            <span class="my_timeline_line"></span>

                                            <div class="timeline-users d-flex align-items-center gap-4">

                                                <?php foreach ($users as $user): ?>

                                                    <?php
                                                        $userId    = $user['id'] ?? $user['user_id'] ?? '';
                                                        $userName  = $user['name'] ?? $user['email'] ?? 'User';
                                                        $userImage = !empty($user['user_image'])
                                                            ? base_url('uploads/user_profile/' . $user['user_image'])
                                                            : base_url('uploads/user_profile/user.png');
                                                    ?>

                                                    <div class="timeline-user calendar-user"
                                                        draggable="true"
                                                        data-user-id="<?= (int)$userId ?>">

                                                        <a href="<?= base_url('company/user_preview?id=') . (int)$userId ?>"
                                                        class="d-flex flex-column align-items-center text-decoration-none text-dark">

                                                            <img src="<?= htmlspecialchars($userImage) ?>"
                                                                class="user-avatar calendar-user-avatar"
                                                                width="50"
                                                                height="50" />

                                                            <span class="calendar-user-name">
                                                                <?= htmlspecialchars($userName) ?>
                                                            </span>
                                                        </a>
                                                    </div>

                                                <?php endforeach; ?>

                                                <!-- Edit / Delete icons (same as JS) -->
                                                <span class="edit-item ms-3">
                                                    <i class="bi bi-pencil" title="Edit"></i>
                                                </span>

                                                <span class="delete-item ms-2">
                                                    <i class="bi bi-trash" title="Delete"></i>
                                                </span>

                                            </div>
                                        </div>

                                        <?php break; ?>
                                        /* ================= DEFAULT ================= */
                                        <?php default: ?>
                                            <div class="timeline-output">
                                                <span>Saved</span>
                                            </div>

                                    <?php endswitch; ?>

                                    </div>
                                </div>

                            <?php endforeach; ?>
                        <?php endif; ?>
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
                            <input type="file" class="form-control" name="video" id="video" accept="video/*">
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
                            <input type="file" class="form-control" name="image" id="image" style="z-index:999;">
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
        const url  = $(btn).data('url');

        let formData = new FormData();

        if (mode === 'edit' && editId) {
            formData.append('id', editId); // 🔥 send id for update
        }
                
        // ✅ Fixed / Future logic
        formData.append("openingTime", $("#showOpening").val());
        formData.append("closingTime", $("#showClosing").val());

        const finalDateTime = getFinalDateTime();
        formData.append("finaldatetime", finalDateTime);

        formData.append("scheduleType", scheduleType);
        formData.append("date", $('#modalDateName').val().trim());
        const timelineData = getDroppedTimelineData(
            $('.content_adding__container')
        );

        formData.append("timeline", JSON.stringify(timelineData));
        
        // ✅ MODAL-SCOPED DATA COLLECTION
        switch (type) {

            case "text":
                formData.append(
                    "textbox",
                    $("#textbox").val()
                );
                break;

            case "image":
                formData.append(
                    "imagefile",
                    $("#image")[0]?.files[0]
                );
                formData.append(
                    "imagelink",
                    $("#imagelink").val()
                );
                break;

            case "video":
                formData.append(
                    "videofile",
                    $("#video")[0]?.files[0]
                );
                formData.append(
                    "videolink",
                    $("#videolink").val()
                );
                break;

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
            case "user":
                formData.append(
                    "user",
                    $("#searchUserElem").val()
                );
                break;
        }

        // ✅ AJAX
        $.ajax({
            url,
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success(res) {
                console.log(res)
                alert(res.message);
                    // 🔥 Render output below dropped item
                let wrapper = activeDroppedWrapper;

                // 🔥 fallback for edit (find by id)
                if (!wrapper && res.data_id) {
                    wrapper = document.querySelector(
                        `.dropped-item[data-id="${res.data_id}"]`
                    );
                }

                if (wrapper) {
                    wrapper.dataset.type = res.type;
                    wrapper.dataset.id = res.data_id;
                    wrapper.dataset.timeline = res.timeline_id;

                    const output = wrapper.querySelector('.dropped-output');
                    if (output) {
                        output.innerHTML = renderOutputByType(type, res.data_id);
                        output.style.display = 'block';
                    }
                }


                canDropNewItem = true;
                activeDroppedWrapper = null;
                clearInputFieldsByType(type);
            },
            error(xhr) {
                alert("AJAX Error");
                console.error(xhr.responseText);
            }
        });
    });

    function renderOutputByType(type, id) {
        switch (type) {

            case 'text': {
                const text = $('#textbox')?.val() || '';
                return `
                    <div class="timeline-output text-output">
                        <span>${text}</span>
                        <span class="edit-item">
                            <i class="bi bi-pencil" title="Edit"></i>
                        </span>
                        <span class="delete-item">
                            <i class="bi bi-trash delete-item" title="Delete"></i>
                        </span>
                    </div>
                `;
            }

            case 'image': {
                const link = $('#imagelink')?.val()?.trim();
                const uid = `image-${id}`;

                // 1️⃣ Image link → sync render
                if (link) {
                    return `
                        <div class="timeline-output image-output">
                            <img src="${link}" width="50" height="50" class="rounded border">
                            <span class="edit-item ms-2"><i class="bi bi-pencil"></i></span>
                            <span class="delete-item ms-2"><i class="bi bi-trash"></i></span>
                        </div>
                    `;
                }

                // 2️⃣ Async fetch for uploaded image
                setTimeout(async () => {
                    const { image } = await getContentFileName(id, type); // backend returns filename

                    if (!image) {
                        $(`#${uid}`).html('<span>Image not found</span>');
                        return;
                    }

                    const imagePath = '<?= base_url() ?>uploads/calendar_image/' + image;

                    $(`#${uid}`).html(`
                        <img src="${imagePath}" width="75" height="75" class="rounded border">
                    `);
                }, 0);

                // 3️⃣ Initial placeholder
                return `
                    <div class="timeline-output image-output">
                        <span id="${uid}">Image uploaded</span>
                        <span class="edit-item ms-2"><i class="bi bi-pencil"></i></span>
                        <span class="delete-item ms-2"><i class="bi bi-trash"></i></span>
                    </div>
                `;
            }

            case 'video': {
                const link = $('#videolink')?.val()?.trim();
                const uid = `video-${id}`; // unique container id

                // 1️⃣ If video link exists → sync render
                if (link) {
                    return `
                        <div class="timeline-output video-output">
                            <i class="fa-solid fa-video me-1"></i>
                            <a href="${link}" target="_blank" rel="noopener">${link}</a>
                            <span class="edit-item ms-2"><i class="bi bi-pencil"></i></span>
                            <span class="delete-item ms-2"><i class="bi bi-trash"></i></span>
                        </div>
                    `;
                }

                // 2️⃣ Return placeholder FIRST
                setTimeout(async () => {
                    const { video } = await getContentFileName(id, type);

                    if (!video) {
                        $(`#${uid}`).html('<span>Video not found</span>');
                        return;
                    }

                    const videoPath = '<?= base_url() ?>uploads/calendar_video/' + video;

                    $(`#${uid}`).html(`
                        <video controls width="260">
                            <source src="${videoPath}" type="video/mp4">
                        </video>
                    `);
                }, 0);

                // 3️⃣ Initial render (non-blocking)
                return `
                    <div class="timeline-output video-output">
                        <i class="fa-solid fa-video me-1"></i>
                        <span id="${uid}">Loading video...</span>
                        <span class="edit-item ms-2"><i class="bi bi-pencil"></i></span>
                        <span class="delete-item ms-2"><i class="bi bi-trash"></i></span>
                    </div>
                `;
            }

            case 'audio': {
                const link = $('#audiolink')?.val()?.trim();
                const uid = `video-${id}`; // unique container id

                // 1️⃣ If video link exists → sync render
                if (link) {
                    return `
                        <div class="timeline-output audio-output">
                            <i class="fa-solid fa-music me-1"></i>
                            <a href="${link}" target="_blank" rel="noopener">${link}</a>
                            <span class="edit-item ms-2"><i class="bi bi-pencil"></i></span>
                            <span class="delete-item ms-2"><i class="bi bi-trash"></i></span>
                        </div>
                    `;
                }

                // 2️⃣ Return placeholder FIRST
                setTimeout(async () => {
                    const { audio } = await getContentFileName(id, type);

                    if (!audio) {
                        $(`#${uid}`).html('<span>Video not found</span>');
                        return;
                    }

                    const audioPath = '<?= base_url() ?>uploads/calendar_audio/' + audio;

                    const ext = audioPath.split('.').pop().toLowerCase();

                    const mimeMap = {
                        mp3: 'audio/mpeg',
                        wav: 'audio/wav',
                        ogg: 'audio/ogg',
                        m4a: 'audio/mp4'
                    };

                    const mimeType = mimeMap[ext] || 'audio/mpeg';

                    const audioHtml = `
                        <audio controls>
                            <source src="${audioPath}" type="${mimeType}">
                        </audio>
                    `;

                    $(`#${uid}`).html(audioHtml);

                }, 0);

                // 3️⃣ Initial render (non-blocking)
                return `
                    <div class="timeline-output audio-output">
                        <i class="fa-solid fa-music me-1"></i>
                        <span id="${uid}">Loading audio...</span>
                        <span class="edit-item ms-2"><i class="bi bi-pencil"></i></span>
                        <span class="delete-item ms-2"><i class="bi bi-trash"></i></span>
                    </div>
                `;
            }

            case 'docs': {
                const link = $('#docslink')?.val()?.trim();
                const uid = `docs-${id}`;

                // 1️⃣ Docs link exists → sync render
                if (link) {
                    return `
                        <div class="timeline-output docs-output">
                            <i class="fa-solid fa-file-lines me-1"></i>
                            <a href="${link}" target="_blank" rel="noopener">
                                ${link}
                            </a>
                            <span class="edit-item ms-2">
                                <i class="bi bi-pencil"></i>
                            </span>
                            <span class="delete-item ms-2">
                                <i class="bi bi-trash"></i>
                            </span>
                        </div>
                    `;
                }

                // 2️⃣ Async fetch for uploaded document
                setTimeout(async () => {
                    const { docs } = await getContentFileName(id, type); // backend returns filename

                    if (!docs) {
                        $(`#${uid}`).html('<span>Document not found</span>');
                        return;
                    }

                    const docPath = '<?= base_url() ?>uploads/calendar_docs/' + docs;

                    $(`#${uid}`).html(`
                        <a href="${docPath}" target="_blank" rel="noopener">
                            ${docs}
                        </a>
                    `);
                }, 0);

                // 3️⃣ Initial placeholder
                return `
                    <div class="timeline-output docs-output">
                        <i class="fa-solid fa-file-lines me-1"></i>
                        <span id="${uid}">Document uploaded</span>
                        <span class="edit-item ms-2">
                            <i class="bi bi-pencil"></i>
                        </span>
                        <span class="delete-item ms-2">
                            <i class="bi bi-trash"></i>
                        </span>
                    </div>
                `;
            }

            case 'other': {
                const link = $('#otherlink')?.val();
                const time = $('#time')?.val();
                const slot = $('#timeslot')?.val();

                return `
                    <div class="timeline-output other-output">
                        <i class="fa-solid fa-link me-1"></i>
                        <span>${link}</span>
                        ${time ? `<small class="text-muted ms-2">(${time} ${slot})</small>` : ''}
                        <span class="edit-item">
                            <i class="bi bi-pencil" title="Edit"></i>
                        </span>
                        <span class="delete-item">
                            <i class="bi bi-trash delete-item" title="Delete"></i>
                        </span>
                    </div>
                `;
            }

            case 'contact': {
                const contact = $('#contact')?.val();
                return `
                    <div class="timeline-output contact-output">
                        <i class="fa-solid fa-phone me-1"></i>
                        <span>${contact}</span>
                        <span class="edit-item">
                            <i class="bi bi-pencil" title="Edit"></i>
                        </span>
                        <span class="delete-item">
                            <i class="bi bi-trash delete-item" title="Delete"></i>
                        </span>
                    </div>
                `;
            }

            case 'user': {
                const users = JSON.parse($('#searchUserElem').val() || '[]');
                if (!users.length) return '';

                const usersHtml = users.map(user => {
                    const userId    = user.id || user.user_id || user.value || '';
                    const userName  = user.name || user.email || 'User';
                    const userImage = user.avatar
                        ? user.avatar
                        : `<?= base_url('uploads/user_profile/user.png') ?>`;

                    return `
                        <div class="timeline-user calendar-user"
                            draggable="true"
                            data-user-id="${userId}">
                            
                            <a href="<?= base_url('company/user_preview?id=') ?>${userId}"
                            class="d-flex flex-column align-items-center text-decoration-none text-dark">
                            
                                <img 
                                    src="${userImage}"
                                    class="user-avatar calendar-user-avatar"
                                    width="50"
                                    height="50"
                                />
                                <span class="calendar-user-name">${userName}</span>
                            </a>
                        </div>
                    `;
                }).join('');

                return `
                    <div class="my_timeline py-4">
                        <span class="my_timeline_line"></span>
                        <div class="timeline-users d-flex align-items-center gap-4">
                            ${usersHtml}

                            <span class="edit-item ms-3">
                                <i class="bi bi-pencil" title="Edit"></i>
                            </span>
                            <span class="delete-item ms-2">
                                <i class="bi bi-trash" title="Delete"></i>
                            </span>
                        </div>
                    </div>
                `;
            }

            default:
                return `<div class="timeline-output"><span>Saved</span></div>`;
        }
    }

    function clearInputFieldsByType(type) {

        /* =========================
            COMMON (ALL TYPES)
        ========================= */
        $("input[type='text'], input[type='url'], textarea").val("");
        $("select").prop("selectedIndex", 0);

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

        /* =========================
            OPTIONAL UI CLEANUP
        ========================= */
        $(".is-invalid").removeClass("is-invalid");
        $(".error-message").remove();
    }

    async function getContentFileName(id, type){
      let url = "<?= base_url('calendar/getContentFileName') ?>"
      let res = await fetch(url,{
        method: 'POST',
        body: JSON.stringify({
            content_id : id,
            type
        })
      })
      let contentData = await res.json();

      if(contentData){
        return contentData;
      }else{
        return 'Content Data not found';
      }
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

                fetch("<?= base_url('AdminHome/searchUsersNew') ?>", {
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

        fetch('<?php echo base_url('AdminHome/searchUsers'); ?>', {
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

<script>
    let draggedElement = null;
    let canDropNewItem = true;
    let activeDroppedWrapper = null;


    document.addEventListener('dragstart', (e) => {
        if (e.target.classList.contains('draggable-btn')) {
            draggedElement = e.target;
        }
    });

    document.addEventListener('dragover', (e) => {
        const dropContainer = e.target.closest('.content_adding__container');

        if (!dropContainer) return;

        e.preventDefault();

        dropContainer.classList.add('drag-over');
    });

    document.addEventListener('dragleave', (e) => {
        const dropContainer = e.target.closest('.content_adding__container');

        if (!dropContainer) return;

        dropContainer.classList.remove('drag-over');
    });

    document.addEventListener('drop', (e) => {
        const dropContainer = e.target.closest('.content_adding__container');
        if (!dropContainer || !draggedElement) return;

        // ❌ BLOCK if previous item not saved
        if (!canDropNewItem) {
            alert('Please save the current item before adding another.');
            return;
        }

        e.preventDefault();
        dropContainer.classList.remove('drag-over');

        const boxSelector = draggedElement.getAttribute('data-box');
        const inputArea = document.getElementById('borderBoxesInputAreaContainer');
        console.log("boxSelector",boxSelector);
        // console.log("inputArea",inputArea);
        // Show input area & hide others
        if (inputArea) {
            inputArea.style.display = 'block';
            inputArea.querySelectorAll('.tab-box').forEach(b => b.style.display = 'none');
        }

        // Create dropped item
        const clone = draggedElement.cloneNode(true);
        clone.classList.remove('draggable-btn');
        clone.classList.add('d-inline', 'w-fill-content');
        clone.removeAttribute('draggable');

        const wrapper = document.createElement('div');
        wrapper.classList.add('dropped-item', 'mb-2');

        const dot = document.createElement('span');
        dot.classList.add('dot');

        // 🔥 output placeholder
        const output = document.createElement('div');
        output.classList.add('dropped-output', 'mt-2');
        output.style.display = 'none';

        wrapper.appendChild(dot);
        wrapper.appendChild(clone);
        wrapper.appendChild(output);
        dropContainer.appendChild(wrapper);
        
        // ✅ Show related input + RESET SAVE MODE HERE
        if (boxSelector && inputArea) {
            console.log("inputArea",inputArea)
            const box = inputArea.querySelector(boxSelector);
            console.log("box",box)
            if (box) {
                box.style.display = 'block';

                // 🔥 RESET save button to CREATE mode
                const saveBtn = box.querySelector('.save-btn');
                if (saveBtn) {
                    saveBtn.dataset.mode = 'create';
                    delete saveBtn.dataset.id;
                    saveBtn.textContent = 'Save';
                }
            }
        }


        // Show related input
        if (boxSelector && inputArea) {
            const box = inputArea.querySelector(boxSelector);
            if (box) box.style.display = 'block';
        }

        // 🔒 LOCK next drop
        canDropNewItem = false;
        activeDroppedWrapper = wrapper;

        draggedElement = null;
    });
 
    function getDroppedTimelineData($container) {
        console.log('$container', $container)
        return $container.find('.dropped-item button').map(function (index) {
            return {
                type: $(this).data('type'),
                position: index + 1,
                old_id: $(this).closest('.dropped-item').data('id')
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
        if (!box) return;

        box.style.display = 'block';

        // Load data into inputs
        loadItemData(type, id, box);

        e.preventDefault();
        e.stopPropagation();
    });




    function loadItemData(type, id, box) {
        fetch(`<?= base_url('/Calendar/getItem') ?>`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ type, id })
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
                    break;
            }

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
        const id   = item.dataset.id;

        if (!confirm('Delete this item?')) return;

        fetch(`<?= base_url('Calendar/deleteItem') ?>`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ type, id })
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                item.remove();
                canDropNewItem = true;
                activeDroppedWrapper = null;
                document.getElementById('borderBoxesInputAreaContainer').style.display = 'none';
            }
        });

        e.preventDefault();
        e.stopPropagation();
    });


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
