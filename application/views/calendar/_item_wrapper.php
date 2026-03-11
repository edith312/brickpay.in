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
                <i class="fas fa-image text-white"></i>
            </button>
            <a href="javascript:void(0)" class="btn btn-secondary btn-sm ms-2 add_more_btn"
            >
                <i class="fa-solid fa-plus"></i>
            </a>
            <a class="download_bulk ms-2 cursor-pointer">
                <i class="fa-solid fa-download"></i>
            </a>
        ',

        'docs' => '
            <button class="btn btn-sm tab-btn"
                style="background-color: #04d6e5ff !important;"
                data-type="docs"
                data-box="#box_DocsBox">
                <i class="fas fa-file-alt text-white"></i>
            </button>
            <a href="javascript:void(0)" class="btn btn-secondary btn-sm ms-2 add_more_btn"
            >
                <i class="fa-solid fa-plus"></i>
            </a>
        ',

        'video' => '
            <button class="btn btn-sm tab-btn"
                style="background-color: #04d6e5ff !important;"
                data-type="video"
                data-box="#box_videobox">
                <i class="fas fa-video text-white"></i>
            </button>
            <a href="javascript:void(0)" class="btn btn-secondary btn-sm ms-2 add_more_btn"
            >
                <i class="fa-solid fa-plus"></i>
            </a>
                <a class="download_bulk ms-2 cursor-pointer">
                <i class="fa-solid fa-download"></i>
            </a>
        ',

        'audio' => '
            <button class="btn btn-sm tab-btn"
                style="background-color: #04d6e5ff !important;"
                data-type="audio"
                data-box="#box_audiobox">
                <i class="bi bi-mic-fill text-white"></i>
            </button>
            <a href="javascript:void(0)" class="btn btn-secondary btn-sm ms-2 add_more_btn"
            >
                <i class="fa-solid fa-plus"></i>
            </a>
            </a>
                <a class="download_bulk ms-2 cursor-pointer">
                <i class="fa-solid fa-download"></i>
            </a>
        ',

        'other' => '
            <button class="btn btn-sm tab-btn"
                style="background-color: #04d6e5ff !important;"
                data-type="other"
                data-box="#box_otherlinksbox">
                <i class="fa-solid fa-link text-white"></i>
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
            <a href="javascript:void(0)" class="btn btn-secondary btn-sm ms-2 add_more_btn"
            >
                <i class="fa-solid fa-plus"></i>
            </a>
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
            ',
        'country' => '
            <button class="btn btn-sm tab-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                data-type="country"
                data-target="#textDataContainer9"
                data-box="#box_countrybox"
            >Country</button>
            ',
        'probability' => '
            <button class="btn btn-sm tab-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                data-type="probability"
                data-target="#textDataContainer9"
                data-box="#box_probabilitybox"
            >Probability</button>
            ',
        'religion' => '
            <button class="btn btn-sm tab-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                data-type="religion"
                data-target="#textDataContainer9"
                data-box="#box_religionbox"
            >Religion</button>
            ',
        'emotion' => '
            <button class="btn btn-sm tab-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                data-type="emotion"
                data-target="#textDataContainer9"
                data-box="#box_emotionbox"
            >Emotion</button>
            ',
        'currency' => '
            <button class="btn btn-sm tab-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                data-type="currency"
                data-target="#textDataContainer9"
                data-box="#box_currencybox"
            >Currency</button>
            ',
        'level' => '
            <button class="btn btn-sm tab-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                data-type="level"
                data-target="#textDataContainer9"
                data-box="#box_levelbox"
            >Level</button>
            ',
        'travel' => '
            <button class="btn btn-sm tab-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                data-type="travel"
                data-target="#textDataContainer9"
                data-box="#box_travelbox"
            >Travel</button>
            ',
        'deal' => '
            <button class="btn btn-sm tab-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                data-type="deal"
                data-target="#textDataContainer9"
                data-box="#box_dealbox"
            >Deal</button>
            ',
        'age' => '
            <button class="btn btn-sm tab-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                data-type="age"
                data-target="#textDataContainer9"
                data-box="#box_agebox"
            >Age</button>
            ',
        'body_part' => '
            <button class="btn btn-sm tab-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                data-type="body_part"
                data-target="#textDataContainer9"
                data-box="#box_body_partbox"
            >Body Part</button>
            ',
        'ethnicity' => '
            <button class="btn btn-sm tab-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                data-type="ethnicity"
                data-target="#textDataContainer9"
                data-box="#box_ethnicitybox"
            >Ethnicity</button>
            ',
        'character' => '
            <button class="btn btn-sm tab-btn text-white" style="background-color: #04d6e5ff !important;" id=""
                data-type="character"
                data-target="#textDataContainer9"
                data-box="#box_characterbox"
            >Character</button>
            ',
    ];
    ?>
<div class="dropped-item mb-2 dropped-item-draggable"
     data-id="<?= (int)$item['id'] ?>"
     data-type="<?= htmlspecialchars($item['content_type']) ?>"
     data-timeline-item-id="<?= (int)$key ?>"
     draggable="true">

    <div class="dot-wrapper">
        <span class="dot"></span>
        <span class="dot-line"></span>

        <div class="d-inline w-fill-content">
            <?= $dragButtonMap[$item['content_type']] ?? '' ?>
        </div>

        <?php if ($item['is_black_line']): ?>
            <button class="btn btn-sm tab-btn text-white black_line_btn d-inline w-fill-content black-line-wide" style="background-color: white;" id="" data-url="http://localhost/brickpay.in/Calendar/black_line" data-type="black_line" data-target="#textDataContainer9" data-box="#"><span class="black_line"></span></button>
        <?php endif; ?>

        <?php if (!empty($item['finance'])): ?>
            <div class="d-inline-flex flex-column align-items-start justify-content-center gap-2 text-center">
                <button class="btn btn-sm tab-btn text-white d-inline w-fill-content" style="background-color: #04d6e5ff !important;" id="" data-url="http://localhost/brickpay.in/Calendar/finance_box" data-type="finance" data-target="#textDataContainer9" data-box="#box_financebox">Associated Finance</button>

                <span class="timeline-finance badge bg-dark mx-auto">
                    ₹ <?= number_format($item['finance']['amount'], 2) ?>
                </span>
            </div>

        <?php endif; ?>
        
        <?php if (!empty($item['timestamp'])): ?>

            <div class="d-inline-flex flex-column align-items-start justify-content-center gap-2 text-center">

                <button 
                    class="btn btn-sm tab-btn text-white d-inline w-fill-content"
                    style="background-color: #04d6e5ff !important;"
                    data-url="<?= base_url('Calendar/timestamp_box') ?>"
                    data-type="timestamp"
                    data-target="#textDataContainer9"
                    data-box="#box_timestampbox">

                    Timestamp
                </button>

                <span class="badge bg-dark mx-auto">

                    <?php
                    $start = !empty($item['timestamp']['s_timestamp']) && $item['timestamp']['s_timestamp'] != '0000-00-00 00:00:00'
                        ? date('h:i A', strtotime($item['s_timestamp']))
                        : '';

                    $end = !empty($item['timestamp']['e_timestamp']) && $item['timestamp']['e_timestamp'] != '0000-00-00 00:00:00'
                        ? date('h:i A', strtotime($item['timestamp']['e_timestamp']))
                        : '';

                    echo trim($start . ' - ' . $end);
                    ?>

                </span>

            </div>

        <?php endif; ?>
    </div>

    <?php
        $isMedia = in_array($item['content_type'], ['video', 'image']);
    ?>
    <div class="dropped-output mb-2 <?= $isMedia ? 'overflow-auto d-flex' : '' ?>" style="display:block">

        <?php
            $viewPath = 'calendar/items/' . $item['content_type'];
            if (file_exists(APPPATH . 'views/' . $viewPath . '.php')) {
                $this->load->view($viewPath, ['item' => $item]);
            } else {
                echo '<div class="timeline-output"><span>Saved</span></div>';
            }
        ?>
    </div>
</div>
