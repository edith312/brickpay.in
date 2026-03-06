<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Movie' ?></title>

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
            top: 10px;
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

        }

        .content_adding__container {
            position: relative;
        }

        #borderBoxesInputAreaContainer{
            display: none;
        }
    </style>

    <style>
        .dot-wrapper-pdf {
            display: table;
            width: 100%;
            height: 100%;
        }

        .dot-wrapper-pdf .dot-col {
            display: table-cell;
            width: 20px;
            height: 100%;
            vertical-align: top;
            position: relative;
        }

        .dot-wrapper-pdf .dot {
            display: block;
            width: 10px;
            height: 10px;
            background-color: #04d6e5;
            border-radius: 50%;
            margin: 2px auto 0 auto;
        }

        .dot-wrapper-pdf .dot-line {
            display: block;
            width: 2px;
            height: 100%;   /* spacing between dots */
            background-color: #04d6e5;
            margin: 0 auto;
        }

        .dot-wrapper-pdf .dot-content {
            display: table-cell;
            padding-left: 6px;
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
            grid-template-columns: auto 1fr;
            align-items: center;
            border: 1px solid #dce3e8;
            /* border-radius: 4px; */
            color: #00a7cc;
            font-weight: 600;
            border-bottom: 0;
        }

        .project-row-two {
            display: grid;
            grid-template-columns: 30px 1fr 1fr 1fr 1fr;
            align-items: center;
            border: 1px solid #dce3e8;
            /* border-radius: 4px; */
            color: #00a7cc;
            font-weight: 600;
            border-bottom: 0;
        }

        .project-row-three {
            display: grid;
            grid-template-columns: 30px 1fr 1fr 1fr 1fr;
            align-items: center;
            border: 1px solid #dce3e8;
            /* border-radius: 4px; */
            color: #00a7cc;
            font-weight: 600;
            border-bottom: 0;
        }

        .project-row-four {
            display: grid;
            grid-template-columns: 30px 1fr 1fr 1fr 1fr;
            align-items: center;
            border: 1px solid #dce3e8;
            color: #00a7cc;
            font-weight: 600;
        }

        .project-row-five {
            display: grid;
            grid-template-columns: 30px 1fr 1fr 1fr 1fr;
            align-items: center;
            border: 1px solid #dce3e8;
            color: #00a7cc;
            font-weight: 600;
        }
        .project-row-six {
            display: grid;
            grid-template-columns: 30px 1fr 1fr 1fr 1fr;
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
        
        @media print {
            body * {
                visibility: hidden;
            }
            .print-area, .print-area * {
                visibility: visible;
            }
        }
    </style>
    <link rel="stylesheet" href="http://localhost/brickpay.in/assets/css/style.min.css">
</head>
<body onload="window.print()" class="print-area">
    <?php
        $dragButtonMap = [

            'text' => '
                <button class="btn btn-sm tab-btn text-white"
                    style="background-color: #04d6e5ff !important;"
                    data-type="text"
                    data-box="#box_textbox">
                    TEXT
                </button>
            ',

            'image' => '
                <button class="btn btn-sm tab-btn"
                    style="background-color: #04d6e5ff !important;"
                    data-type="image"
                    data-box="#box_imagebox">
                    IMAGE
                </button>
            ',

            'docs' => '
                <button class="btn btn-sm tab-btn"
                    style="background-color: #04d6e5ff !important;"
                    data-type="docs"
                    data-box="#box_DocsBox">
                    DOCS
                </button>
            ',

            'video' => '
                <button class="btn btn-sm tab-btn"
                    style="background-color: #04d6e5ff !important;"
                    data-type="video"
                    data-box="#box_videobox">
                    VIDEO
                </button>
            ',

            'audio' => '
                <button class="btn btn-sm tab-btn"
                    style="background-color: #04d6e5ff !important;"
                    data-type="audio"
                    data-box="#box_audiobox">
                    AUDIO
                </button>
            ',

            'other' => '
                <button class="btn btn-sm tab-btn"
                    style="background-color: #04d6e5ff !important;"
                    data-type="other"
                    data-box="#box_otherlinksbox">
                    OTHER
                </button>
            ',

            'contact' => '
                <button class="btn btn-sm tab-btn text-white"
                    style="background-color: #04d6e5ff !important;"
                    data-type="contact"
                    data-box="#box_contactbox">
                    Contact
                </button>
            ',

            'user' => '
                <button class="btn btn-sm tab-btn text-white"
                    style="background-color: #04d6e5ff !important;"
                    data-type="user"
                    data-box="#box_userbox">
                    User
                </button>
            ',
            'brick' => '
                <button class="btn btn-sm tab-btn text-white" 
                    style="background-color: #04d6e5ff !important;" 
                    data-target="#brickSearchContainer" 
                    data-type="brick" data-box="#box_brickbox">
                        BRICK PAY
                </button>
                '
            ,
            'dialogue' => '
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm tab-btn text-white" style="background-color: #04d6e5ff !important;" 
                    id="" 
                    data-type="dialogue"
                    data-target="#textDataContainer9" 
                    >:Dialogue</button>
                    <div class="d-flex justify-content-center gap-2">
                        <span class="edit-item">
                            <i class="bi bi-pencil" title="Edit"></i>
                        </span>

                        <span class="delete-item">
                            <i class="bi bi-trash" title="Delete"></i>
                        </span>
                    </div>
                </div>
                ',
            'press_release' => '                                
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm tab-btn text-white" 
                        style="background-color: #04d6e5ff !important;" 
                        id="" 
                        data-type="press_release" 
                        data-target="#textDataContainer8" 
                        data-box="#box_press_releasebox">Press Release</button>
                        <div class="d-flex flex-row justify-content-center align-items-center gap-2">
                            <span class="edit-item">
                                <i class="bi bi-pencil" title="Edit"></i>
                            </span>

                            <span class="delete-item">
                                <i class="bi bi-trash" title="Delete"></i>
                            </span>
                        </div>
                </div>
                '
        ];
    ?>
    <h3 class="my-2">Title: <?= $movie['makemymoviename'] ?></h3>
    <?php 
        $eventKeys = array_keys($movie['events']);
        $lastEventKey = end($eventKeys);
    ?>
    <?php foreach ($movie['events'] as $key => $event): 
        $isLastEvent = ($lastEventKey == $key);
        ?>
        <div class="content_adding__container borderBoxesAreaContainer" style="">
        <?php if (!empty($event)): ?>
            <div class="" style="margin-bottom: 0.3cm;">
                <div class="d-flex align-items-center">
                    <?php
                        $date = $event['date'] ?? '';
                        $openingTime = !empty($event['opening_time'])
                            ? substr($event['opening_time'], 0, 5)
                            : '00:00';

                        $closingTime = !empty($event['closing_time'])
                            ? substr($event['closing_time'], 0, 5)
                            : '00:00';
                    ?>
                    <span>Date: <?= htmlspecialchars(date('d-m-Y', strtotime($date))) ?>   <span class="tabbed">Opening Time: <?= htmlspecialchars($openingTime) ?> | Closing Time: <?= htmlspecialchars($closingTime) ?></span></span>
                    <span class="text-white" style="margin-left: 1cm;">
                    <?php
                        $timeline_type_map = [
                            '0' => 'Task',
                            '1' => 'Milestone',
                            '2' => 'Strategies',
                            '3' => 'Scene',
                            '4' => 'Updates',
                            '5' => 'Events'
                        ];
                        echo $timeline_type_map[$event['timeline_type']];
                    ?>
                    </span>
                </div>
            </div>
            <?php foreach ($event['timeline_items'] as $key => $item): 
                   $isLast = (count($event['timeline_items']) - 1) == $key;
                ?>

                <div class="dropped-item dropped-item-draggable" style="height: fit-content;"
                    data-id="<?= (int)$item['id'] ?>"
                    data-type="<?= htmlspecialchars($item['content_type']) ?>"
                    draggable="true"
                    >
                    <div class="dot-wrapper-pdf" style="">
                        <div class="dot-col">
                            <span class="dot"></span>
                            <span class="dot-line" style="<?= $isLast ? 'display: none;' : ''?>"></span>
                        </div>

                        <div class="dot-content">
                            <?= $dragButtonMap[$item['content_type']] ?? '' ?>
                            <!-- 🔥 EXACT SAME dropped-output -->
                <div class="dropped-output" style="display:block; margin-left: 0.7cm; margin-top: 0.5cm; margin-bottom: 0.7cm;">

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

                                </div>
                            </div>
                            <?php case 'brick': ?>
                                <?php if (!empty($item['bricks'])): ?>
                                <?php $brickCount = 1; ?>
                                <?php foreach ($item['bricks'] as $bricks): ?>

                                    <?php
                                        $bricksFunding = $this->CommonModal->getSingleRowById(
                                            'tbl_brick_funding',
                                            'brick_id = ' . $bricks['id']
                                        );
                                    ?>

                                    <table width="100%" cellpadding="0" cellspacing="0"
                                        style="border-collapse: collapse;
                                                margin-top:20px;
                                                border-left: 4px solid <?= brickColor($bricks['brick_type']) ?>;
                                                page-break-inside: avoid;
                                                font-size: 12px;
                                                ">

                                        <!-- ROW 1 -->
                                        <tr>
                                            <td colspan="4"
                                                style="border:1px solid #dce3e8; padding:6px 10px; font-weight:600; color:#00a7cc;">
                                                <span class="brickStatus
                                                    <?php
                                                    if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] == NULL) {
                                                        echo 'bg-markascompleted';
                                                    } else if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] != NULL) {
                                                        echo 'bg-artificialbrickartificial';
                                                    } else if ($bricks['artificialdate'] != NULL) {
                                                        echo 'bg-artificialbrick';
                                                    } else {
                                                        echo 'bg-' . ($bricks['brick_status'] == 'draft' ? 'warning' : 'primary') . ' text-white';
                                                    }
                                                    ?>">
                                                    <?php
                                                    if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] == NULL) {
                                                        echo 'Completed';
                                                    } else if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] != NULL) {
                                                        echo 'Artificial Brick - Completed';
                                                    } else if ($bricks['artificialdate'] != NULL) {
                                                        echo 'Artificial Brick ' . ($bricks['brick_status'] == 'draft' ? 'Draft' : '- Live');
                                                    } else {
                                                        echo ($bricks['brick_status'] == 'draft' ? 'Draft' : 'Live');
                                                    }
                                                    ?>
                                                </span>

                                                &nbsp; #<?= $brickCount++ ?> |
                                                Brick Title: <?= $bricks['brick_title'] ?>

                                                <span style="float:right;">
                                                    <a href="<?= base_url('company/preview_brick?id=' . $bricks['id']) ?>">
                                                        <i class="bi bi-eye-fill eye-icon"></i>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>

                                        <!-- ROW 2 -->
                                        <tr>
                                            <td style="border:1px solid #dce3e8; border-right:1px solid #dce3e8;">
                                                Project: <?= projectName($bricks['project_id']) ?>
                                            </td>
                                            <td style="border:1px solid #dce3e8; border-right:1px solid #dce3e8;">
                                                Company: <?= companyName($bricks['company_id']) ?>
                                            </td>
                                            <td style="border:1px solid #dce3e8; border-right:1px solid #dce3e8;">
                                                Brick Id: <?= generateBrickId($bricks['id']) ?>
                                            </td>
                                            <td style="border:1px solid #dce3e8;">
                                                Privacy: <span class="text-capitalize"><?= $bricks['brick_privacy'] ?></span>
                                            </td>
                                        </tr>

                                        <!-- ROW 3 -->
                                        <tr>
                                            <td style="border:1px solid #dce3e8; border-right:1px solid #dce3e8;">
                                                Step 1 - Fund Required:
                                                <?php
                                                    $cur_arr = explode('|', $bricks['currency_symbol']);
                                                    echo $cur_arr[1] . ' - ' . $cur_arr[0] . ' ' . $bricksFunding['fund_required'];
                                                ?>
                                            </td>
                                            <td style="border:1px solid #dce3e8; border-right:1px solid #dce3e8;">
                                                Step 2 - Reward: <?= $bricks['reward_disclosed'] ?>
                                            </td>
                                            <td style="border:1px solid #dce3e8; border-right:1px solid #dce3e8;">
                                                Step 3 - Completion Report:
                                            </td>
                                            <td style="border:1px solid #dce3e8;">
                                                Step 4 - Voting:
                                            </td>
                                        </tr>

                                        <!-- ROW 4 -->
                                        <tr>
                                            <td style="border:1px solid #dce3e8; border-right:1px solid #dce3e8;">
                                                Step 1.1 - Type: <?= $bricksFunding['funding_type'] ?>
                                            </td>
                                            <td style="border:1px solid #dce3e8; border-right:1px solid #dce3e8;">
                                                Step 2.1 - Resources:
                                            </td>
                                            <td style="border:1px solid #dce3e8; border-right:1px solid #dce3e8;">
                                                Step 3.1 - Updated Valuation:
                                            </td>
                                            <td style="border:1px solid #dce3e8;"></td>
                                        </tr>

                                        <!-- ROW 5 -->
                                        <tr>
                                            <td style="border:1px solid #dce3e8; border-right:1px solid #dce3e8;">
                                                Step 1.12 - Network Marketing for Fund: 11111
                                            </td>
                                            <td style="border:1px solid #dce3e8; border-right:1px solid #dce3e8;">
                                                Step 2.12 - Network Marketing for Resources: 11111
                                            </td>
                                            <td style="border:1px solid #dce3e8; border-right:1px solid #dce3e8;">
                                                Step 3.12 -
                                            </td>
                                            <td style="border:1px solid #dce3e8;"></td>
                                        </tr>

                                        <!-- ROW 6 -->
                                        <tr>
                                            <td style="border:1px solid #dce3e8; border-right:1px solid #dce3e8;">
                                                Currency:
                                                <?php
                                                    $cur_arr = explode('|', $bricks['currency_symbol']);
                                                    echo $cur_arr[1] . ' - ' . $cur_arr[0];
                                                ?>
                                            </td>
                                            <td style="border:1px solid #dce3e8; border-right:1px solid #dce3e8;">
                                                <?= brickType($bricks['brick_type']) ?>
                                            </td>
                                            <td style="border:1px solid #dce3e8; border-right:1px solid #dce3e8;">
                                                Date: <?= $bricks['create_date'] ?>
                                            </td>
                                            <td style="border:1px solid #dce3e8;">
                                                Artificial Date: <?= $bricks['artificialdate'] ?? '...' ?>
                                            </td>
                                        </tr>

                                    </table>

                                    <!-- Progress -->
                                    <div style="margin:6px 0;">
                                        <?php if ($bricks['brick_completed'] == 'completed') { ?>
                                            <div class="progress">
                                                <div style="width: 100%; background-color:#ff6501;" class="progress-bar"></div>
                                            </div>
                                            <small class="text-muted">Brick completed in <strong>100%</strong>.</small>
                                        <?php } else { ?>
                                            <div class="progress">
                                                <div style="width: 60%;" class="progress-bar"></div>
                                            </div>
                                            <small class="text-muted">Brick completed in <strong>60%</strong>.</small>
                                        <?php } ?>
                                    </div>

                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php break; ?>
                            
                            <?php case 'dialogue': ?>
                                <div class="dialogue_box">
                                    <p><?= $item['dialogue'] ?></p>
                                    <?php if($item['dialogue_status'] === '1'): ?>
                                        <span class="badge bg-success">Approved</span>
                                    <?php elseif($item['dialogue_status'] === '0'): ?>
                                        <span class="badge bg-info">Requested</span>
                                    <?php else: ?>
                                        <div class="d-flex flex-row gap-1">
                                            <button class="btn btn-sm btn-success rounded-circle dialogue_submit">
                                                    <i class="fa-solid fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger rounded-circle">
                                                <i class="fa-solid fa-x"></i>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php break;?>

                            <?php case 'press_release' :?>
                                <div class="SocialMediaFeedContainer">
                                    <?php foreach ($item['press_releases'] as $release) { ?>

                                        <div class="press_release_showcase">

                                            <!-- HEADER -->
                                            <div class="d-flex align-items-center gap-3 mb-2">

                                                <img
                                                    class="press_release_profile_pic"
                                                    src="<?= !empty($release['user']['user_image'])
                                                        ? base_url('uploads/user_profile/' . $release['user']['user_image'])
                                                        : base_url('assets/images/img/user.png'); ?>"
                                                    alt="User"
                                                >

                                                <div class="flex-grow-1">
                                                    <?php if (!empty($release['user']['name'])) { ?>

                                                        <div class="fw-semibold">
                                                            <?= $release['user']['name']; ?>
                                                        </div>

                                                    <?php } elseif (!empty($release['user']['email'])) { ?>

                                                        <div class="fw-semibold text-muted">
                                                            <?= $release['user']['email']; ?>
                                                        </div>

                                                    <?php } else { ?>

                                                        <div class="fw-semibold text-muted">
                                                            Anonymous
                                                        </div>

                                                    <?php } ?>
                                                </div>

                                                <div class="text-muted small">
                                                    <?= date('d M Y · h:i A', strtotime($release['created_date'])); ?>
                                                </div>

                                            </div>

                                            <!-- CONTEXT -->
                                            <div class="mb-2 text-muted small d-flex flex-column">

                                                <?php if (in_array($release['type'], ['company', 'project']) && !empty($release['company']['company_name'])) { ?>
                                                    <span class="ms-2">
                                                        Company: <strong><?= $release['company']['company_name']; ?></strong>
                                                    </span>
                                                <?php } ?>

                                                <?php if ($release['type'] === 'project' && !empty($release['project']['project_name'])) { ?>
                                                    <span class="ms-2">
                                                        Project: <strong><?= $release['project']['project_name']; ?></strong>
                                                    </span>
                                                <?php } ?>

                                            </div>

                                            <!-- CONTENT -->
                                            <p class="press_release_content">
                                                <?= nl2br($release['press_release']); ?>
                                            </p>

                                            <!-- FOOTER -->
                                            <div class="mt-2 small text-muted">
                                                ID: <?= $release['uniq_id']; ?>
                                                <span class="badge bg-light text-dark border">
                                                    <?= ucfirst($release['type']); ?>
                                                </span>
                                            </div>

                                        </div>

                                    <?php } ?>
                                </div>  
                            <?php break;?>

                        <?php break; ?>
                        /* ================= DEFAULT ================= */
                        <?php default: ?>
                            <div class="timeline-output">
                                <span>Saved</span>
                            </div>

                    <?php endswitch; ?>

                    </div>
                </div>
                        </div>
                    </div>

            <?php endforeach; ?>
        <?php endif; ?>
        </div>
        <?php if(!$isLastEvent): ?>
            <div style="text-align:center;">
                <!-- Vertical line -->
                <div style="width:2px; height:50px; background:black; margin:0 auto;"></div>
            </div>
        <?php endif; ?>

    <?php endforeach; ?>
</body>
</html>