<footer class="px-md-4 px-2">
	<p class="mb-0 text-muted">© 2025 <a href="" target="_blank" title="pixelwibes">My Digital Bricks</a>, All Rights Reserved.</p>
</footer>

</main><!-- Shiv Web Developer -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas_setting" aria-labelledby="offcanvas_setting">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title">Template Setting</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body">
		<div class="mb-4">
			<h6>Set Theme Color</h6>
			<ul class="choose-skin list-unstyled mb-0">
				<li data-theme="ValenciaRed">
					<div style="--bvite-theme-color: #D63B38;"></div>
				</li>
				<li data-theme="SunOrange">
					<div style="--bvite-theme-color: #F7A614;"></div>
				</li>
				<li data-theme="AppleGreen">
					<div style="--bvite-theme-color: #5BC43A;"></div>
				</li>
				<li data-theme="CeruleanBlue">
					<div style="--bvite-theme-color: #00B8D6;"></div>
				</li>
				<li data-theme="Mariner" class="active">
					<div style="--bvite-theme-color: #0066FE;"></div>
				</li>
				<li data-theme="PurpleHeart">
					<div style="--bvite-theme-color: #6238B3;"></div>
				</li>
				<li data-theme="FrenchRose">
					<div style="--bvite-theme-color: #EB5393;"></div>
				</li>
			</ul>
		</div>
		<div class="layout-option mb-4">
			<h6>Template Layouts</h6>
			<div>
				<label><input name="layout" value="layout-default" type="radio" checked><span class="px-2">Default</span></label>
				<label><input name="layout" value="layout-a" type="radio"><span class="px-2">Layout A</span></label>
				<label><input name="layout" value="layout-b" type="radio"><span class="px-2">Layout B</span></label>

			</div>
		</div>
		<div class="svg-stroke mb-4">
			<h6>Icon Border Stroke</h6>
			<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
				<input type="radio" class="btn-check" name="stroke" id="Stroke_A" value="svgstroke-a" checked>
				<label class="btn btn-outline-primary" for="Stroke_A">Stroke 1</label>

				<input type="radio" class="btn-check" name="stroke" id="Stroke_B" value="svgstroke-b">
				<label class="btn btn-outline-primary" for="Stroke_B">Stroke 2</label>

				<input type="radio" class="btn-check" name="stroke" id="Stroke_C" value="svgstroke-c">
				<label class="btn btn-outline-primary" for="Stroke_C">Stroke 3</label>
			</div>
		</div>
		<div class="mb-4">
			<h6>Layout Section Ligh/Dark</h6>
			<ul class="list-unstyled d-flex flex-wrap">
				<li class="me-2 mb-2 border-toggle">
					<input type="checkbox" class="btn-check" id="boder_layout" checked="">
					<label class="btn btn-outline-primary" for="boder_layout">Layou Border</label>
				</li>
				<li class="me-2 mb-2 brand-toggle">
					<input type="checkbox" class="btn-check" id="brand_dark">
					<label class="btn btn-outline-primary" for="brand_dark">Brand</label>
				</li>
				<li class="me-2 mb-2 sidebar-toggle">
					<input type="checkbox" class="btn-check" id="Sidebar_dark">
					<label class="btn btn-outline-primary" for="Sidebar_dark">Sidebar</label>
				</li>
				<li class="me-2 mb-2 header-toggle">
					<input type="checkbox" class="btn-check" id="Header_dark">
					<label class="btn btn-outline-primary" for="Header_dark">Header</label>
				</li>
				<li class="me-2 mb-2 pheader-toggle">
					<input type="checkbox" class="btn-check" id="pheader_dark">
					<label class="btn btn-outline-primary" for="pheader_dark">breadcrumb</label>
				</li>
				<li class="me-2 mb-2 rightbar-toggle">
					<input type="checkbox" class="btn-check" id="Rightbar_dark">
					<label class="btn btn-outline-primary" for="Rightbar_dark">Rightbar</label>
				</li>
			</ul>
		</div>
		<div class="mb-4">
			<h6>More App Setting</h6>
			<div class="form-check form-switch boxlayout-toggle">
				<input class="form-check-input" type="checkbox" role="switch" id="boxlayout">
				<label class="form-check-label" for="boxlayout">Box Layout</label>
			</div>
			<div class="form-check form-switch monochrome-toggle">
				<input class="form-check-input fs-6" type="checkbox" role="switch" id="monochrome">
				<label class="form-check-label" for="monochrome">Monochrome Mode</label>
			</div>

			<div class="form-check form-switch radius-toggle">
				<input class="form-check-input fs-6" type="checkbox" role="switch" id="radius0">
				<label class="form-check-label" for="radius0">Border Radius none</label>
			</div>
			<div class="form-check form-switch svg-icon-color">
				<input class="form-check-input fs-6" type="checkbox" role="switch" id="IconColor">
				<label class="form-check-label" for="IconColor">Sidebar Icon color</label>
			</div>
			<div class="form-check form-switch cb-shadow">
				<input class="form-check-input fs-6" type="checkbox" role="switch" id="BoxShadow">
				<label class="form-check-label" for="BoxShadow">Card box shadow active</label>
			</div>
		</div>
		<div class="d-flex">
			<button type="button" class="btn w-100 me-1 py-2 btn-primary">Buy Now</button>
			<button type="button" class="btn w-100 ms-1 py-2 btn-dark">View Portfolio</button>
		</div>
	</div>
</div>


<!-- CHAT MODEL START -->

<div id="chatModal" class="chat-modal">
    <div class="chat-modal-content">
        <span id="chatClose" class="chat-close">&times;</span>
        <h4>Chat Support</h4>
        <form action="<?= base_url('/company/chat/chat_with_user') ?>" id="user_add_to_Portfolio" method="post">
            <div class="row m-md-3">
                <div class="col-md-4">
                    <label for="channelName" class="form-label">Search User</label> <br />
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input class="form-control" id="chat-modal-user-search" name='users-list-tags'
                            placeholder='Search user by name' value='' required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4 px-4" style="text-align: center;">Add to Our
                            Portpolio</button>
                    </div>
                </div>
            </div>
        </form>


        <style>
            .chatModuleUserList {
                height: 64vh;
                overflow-y: scroll;
            }

            .theme_chat_module_handler {
                height: auto;
                position: relative;
            }

            #userSingleUserMessagesArea {
                border: 1px solid #dadadaff;
                padding: 5px;
                border-radius: 10px;
            }

            .theme_chat_body_container {
                width: 100%;
				height: 38vh;
                padding: 20px;
                overflow-y: scroll;
            }

            .theme_chat_body_container .messageUniquiId {
                padding: 5px 10px;
                border-radius: 10px;
                font-size: 14px;
                margin-bottom: 10px !important;
            }

            .theme_chat_body_container .UserMessageSender {
                background-color: #b5faffff;
            }

            .theme_chat_body_container .UserMessageReceiver {
                background-color: #f4f3f3ff;
            }

            .UserMessageReceiver {
                float: right;
            }

            .chatmoduleinputsend {
                display: flex;
            }

            .chatmoduleinputsend input {
                width: 90%;
                border: none;
                outline: none;
                border: 1px solid #e9e9e9;
                border-radius: 10px 0px 0px 10px !important;
            }

            .chatmoduleinputsend button {
                width: 10%;
                border: none;
                outline: none;
                border-radius: 0px 10px 10px 0px !important;

            }

            .chat-highlight {
                background-color: #fff3a3 !important;
                transition: background-color 0.5s ease;
            }
        </style>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-5 col-xl-5">
                <!-- ALREADY MESSAGES ON CHAT LIST USER SHOWCASE  -->
                <div class="card border-0 chatModuleUserList" style="width: 100%;">
                    <div class="card-body">
                        <div class="my-3">
                            <button class="btn btn-primary text-white" id="seeAllUsersList">Let's Chat</button>
                        </div>
                        <div class="table-resonsive UserProfileTable" id="userListContainer" style="display:none;">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-7 col-xl-7">
                <div class="theme_chat_module_handler">
                    <!--SINGLE USER CHAT HERE  -->
                    <div class="theme_chat_header">
                        <div class="row p-0 g-0 m-0">
                            <div class="col-6">
                                <!-- CURRENT USER -->
                                <div class="team-member-card theme-user-header me-1">
                                    <?php 
                                    $current_user_id = sessionId('freelancer_id');
                                    $user = $this->CommonModal->getRowById('tbl_freelancer','id',$current_user_id)[0] ?? null;
                                    ?>

                                    <img id="currentUserImg"
                                        src="<?= !empty($user['user_image']) 
                                            ? base_url('uploads/user_profile/'.$user['user_image']) 
                                            : base_url('assets/user-icon.png') ?>">

                                    <div class="team-member-info">
                                        <h6 id="currentUserName"><?= $user['name'] ?? 'Me' ?></h6>
                                    </div>

                                </div>
                            </div>
                            <div class="col-6">
                                <!-- CHAT PARTNER -->
                                <div class="team-member-card theme-user-header">

                                    <img id="chatPartnerImg"
                                        src="<?= base_url('assets/user-icon.png') ?>">

                                    <div class="team-member-info">
                                        <h6 id="chatPartnerName">Select User</h6>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <input type="text" id="chatSearchInput"
                                        class="form-control form-control-sm"
                                        placeholder="Search message...">

                                    <div class="pe-2">
                                        <i class="fa-solid fa-magnifying-glass"
                                        id="searchChatBtn"
                                        style="cursor:pointer;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="userSingleUserMessagesArea">
                        <div class="theme_chat_body_container">

                            <!-- SENDER  / Receiver Chats-->
                            <div class="UserMessageSenderReceiver">

                            </div>
                        </div>
                        <div class="theme-module-chat-input">
                            <div class="form-group chatmoduleinputsend">
                                <input type="text" class="form-control" name="chatsender" placeholder="Type here...">
                                <button type="submit" class="btn-light btn"> Send </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


<!-- CHAT MODEL END -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- CHAT MODEL OPEN FROM THIS  -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const chatOpenHeader = document.getElementById("chatOpenHeader");
        const chatClose = document.getElementById("chatClose");
        const chatModal = document.getElementById("chatModal");

        if (chatOpenHeader && chatModal) {
            chatOpenHeader.addEventListener("click", function () {
                chatModal.style.display = "block";
            });
        }

        if (chatClose && chatModal) {
            chatClose.addEventListener("click", function () {
                chatModal.style.display = "none";
            });
        }

        window.addEventListener("click", function (e) {
            if (chatModal && e.target === chatModal) {
                chatModal.style.display = "none";
            }
        });

    });

</script>

<script>
	
	document.addEventListener('DOMContentLoaded', function () {
		
        // Tagify initialization for Create Channel
        var inputElmSearchUser = document.querySelector('#chat-modal-user-search');

		console.log(inputElmSearchUser)

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

        // Initialize Tagify for 1D module
        if(inputElmSearchUser){
			var tagifyChatUserSearch = new Tagify(inputElmSearchUser, {
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
		}else{
			console.log('element not found');
		}


        // Listen to input event for dynamic search (1D module)
        tagifyChatUserSearch.on('input', function (e) {
            var value = e.detail.value.trim();
            tagifyChatUserSearch.loading(true);

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
                    tagifyChatUserSearch.loading(false);
                    if (data.success && Array.isArray(data.users)) {
                        tagifyChatUserSearch.settings.whitelist = data.users.map(user => ({
                            value: user.id,
                            name: user.name,
                            label: user.name,
                            email: user.email,
                            avatar: user.avatar || 'assets/user-icon.png'
                        }));
                        tagifyChatUserSearch.dropdown.show(value);
                    } else {
                        tagifyChatUserSearch.settings.whitelist = [];
                        tagifyChatUserSearch.dropdown.hide();
                        alert('No users found or invalid response from server.');
                    }
                })
                .catch(error => {
                    tagifyChatUserSearch.loading(false);
                    console.error('Error searching users:', error);
                    alert('Failed to search users: ' + error.message);
                });
        });


        // Add to Our Portfolio
        $('#user_add_to_Portfolio').on('submit', function (e) {
            e.preventDefault();
            // const team_member_input = $('#team-member-input').val();
            const team_member_input = JSON.parse($('#chat-modal-user-search').val());
            const userId = team_member_input[0].value;

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: {
                    chat_with_user: userId,
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        // ✅ Show message without page reload
                        alert(response.message);

                    } else {
                        alert("Error: " + (response.message || response.errors));
                    }
                },
                error: function (xhr, status, error) {
                    alert("AJAX Error: " + error);
                    console.log(xhr.responseText);
                }
            });
        });


    });



    // GET ALREADY ADDED USER LIST IN PORTFOLIO
    document.addEventListener('DOMContentLoaded', function () {

        $('#seeAllUsersList').on('click', function () {

            const container = $('#userListContainer');

            // Toggle if already loaded
            if (container.is(':visible')) {
                container.slideUp();
                return;
            }

            $.ajax({
                url: "<?= base_url('company/chat/get_chat_users') ?>",
                type: "POST",
                dataType: "json",
                beforeSend: function () {
                    container.html('<p class="text-center">Loading users...</p>');
                },
                success: function (response) {

                    if (response.success) {
                        container.html(response.html);
                        container.slideDown();
                    } else {
                        container.html('<p class="text-danger text-center">' + response.message + '</p>');
                        container.slideDown();
                    }
                },
                error: function (xhr) {
                    container.html('<p class="text-danger text-center">Something went wrong</p>');
                    console.log(xhr.responseText);
                    container.slideDown();
                }
            });

        });

    });
</script>
<!-- <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>

<script>
    const socket = io('http://localhost:3000');

    const CURRENT_USER_ID = <?= sessionId('freelancer_id') ?>;
    let currentRoom = null;

    /* ===========================
       USER CLICK → OPEN CHAT
    ============================ */
    $('#userListContainer')
        .off('click', '.chat-user')
        .on('click', '.chat-user', function (e) {

            e.preventDefault();
            e.stopPropagation();

            console.log('chat user clicked ONCE');

            const userId = $(this).data('user-id');
            if (!userId) return;

            $('.chat-user').removeClass('active');
            $(this).addClass('active');

            $.post("<?= base_url('chatController/get_room') ?>", { user_id: userId }, function (res) {

                if (!res.success || !res.room_id) return;

                currentRoom = res.room_id;

                socket.emit('joinRoom', currentRoom);

                $('.theme_chat_header h6').text(res.user?.name || '');

                // 🔥 CALL ONLY ONCE
                loadMessages(currentRoom);

            }, 'json');
        });

    /* ===========================
       SEND MESSAGE (BUTTON)
    ============================ */
    $(document)
        .off('click', '.chatmoduleinputsend button')
        .on('click', '.chatmoduleinputsend button', function (e) {
            e.preventDefault();
            sendChatMessage();
        });

    /* ===========================
       SEND MESSAGE (ENTER KEY)
    ============================ */
    $(document)
        .off('keypress', 'input[name="chatsender"]')
        .on('keypress', 'input[name="chatsender"]', function (e) {
            if (e.which === 13) {
                e.preventDefault();
                sendChatMessage();
            }
        });

    /* ===========================
       SOCKET RECEIVE MESSAGE
    ============================ */
    socket.off('newMessage').on('newMessage', function (data) {

        if (data.room_id !== currentRoom) return;

        const msgClass = data.sender_id == CURRENT_USER_ID
            ? 'UserMessageSender'
            : 'UserMessageReceiver';

        $('.UserMessageSenderReceiver').append(`
            <span class="messageUniquiId ${msgClass}">
                ${escapeHtml(data.message)}
            </span><br><br>
        `);

        scrollToBottom();
    });

    /* ===========================
       FUNCTIONS
    ============================ */
    function sendChatMessage() {

        const input = $('input[name="chatsender"]');
        const message = input.val().trim();

        if (!message || !currentRoom) return;

        socket.emit('sendMessage', {
            room_id: currentRoom,
            sender_id: CURRENT_USER_ID,
            message: message
        });

        input.val('');
    }

    function loadMessages(roomId) {
        $.post("<?= base_url('chatController/get_messages') ?>", { room_id: roomId }, function (res) {

            let html = '';
            res.messages.forEach(msg => {
                html += `
                    <span class="messageUniquiId 
                    ${msg.sender_id == CURRENT_USER_ID ? 'UserMessageSender' : 'UserMessageReceiver'}">
                    ${escapeHtml(msg.message)}
                    </span><br><br>
                `;
            });

            $('.UserMessageSenderReceiver').html(html);
            scrollToBottom();

        }, 'json');
    }

    function scrollToBottom() {
        const el = document.querySelector('.theme_chat_body_container');
        if (el) el.scrollTop = el.scrollHeight;
    }

    function escapeHtml(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
</script> -->

<script>

const CURRENT_USER_ID = <?= sessionId('freelancer_id') ?>;
let currentRoom = null;


/* ===========================
   USER CLICK → OPEN CHAT
=========================== */

$('#userListContainer')
.off('click','.chat-user')
.on('click','.chat-user',function(e){

    e.preventDefault();

    const userId = $(this).data('user-id');
    if(!userId) return;

    $('.chat-user').removeClass('active');
    $(this).addClass('active');

    $.post("<?= base_url('chatController/get_room') ?>",{user_id:userId},function(res){

        if(!res.success) return;

        currentRoom = res.room_id;

        $('#chatPartnerName').text(res.user?.name || 'User');

        if(res.user?.user_image){
            $('#chatPartnerImg').attr(
                'src',
                "<?= base_url('uploads/user_profile/') ?>" + res.user.user_image
            );
        }else{
            $('#chatPartnerImg').attr(
                'src',
                "<?= base_url('assets/user-icon.png') ?>"
            );
        }

        loadMessages(currentRoom);

    },'json');

});



/* ===========================
   SEND MESSAGE
=========================== */

$(document)
.off('click','.chatmoduleinputsend button')
.on('click','.chatmoduleinputsend button',function(e){

    e.preventDefault();
    sendChatMessage();

});


$(document)
.off('keypress','input[name="chatsender"]')
.on('keypress','input[name="chatsender"]',function(e){

    if(e.which===13){

        e.preventDefault();
        sendChatMessage();

    }

});



/* ===========================
   SEND MESSAGE FUNCTION
=========================== */

function sendChatMessage(){

    const input = $('input[name="chatsender"]');
    const message = input.val().trim();

    if(!message || !currentRoom) return;

    $.post("<?= base_url('chatController/send_message') ?>",{

        room_id: currentRoom,
        sender_id: CURRENT_USER_ID,
        message: message

    },function(res){

        if(res.success){

            input.val('');

            // reload messages
            loadMessages(currentRoom);

        }

    },'json');

}



/* ===========================
   LOAD MESSAGES
=========================== */

function loadMessages(roomId){

    $.post("<?= base_url('chatController/get_messages') ?>",{room_id:roomId},function(res){

        let html='';

        res.messages.forEach(msg=>{

            html+=`
            <span class="messageUniquiId
            ${msg.sender_id == CURRENT_USER_ID ? 'UserMessageSender':'UserMessageReceiver'}">
            ${escapeHtml(msg.message)}
            </span><br><br>
            `;

        });

        $('.UserMessageSenderReceiver').html(html);

        scrollToBottom();

    },'json');

}



function scrollToBottom(){

    const el=document.querySelector('.theme_chat_body_container');
    if(el) el.scrollTop=el.scrollHeight;

}


function escapeHtml(text){

    return text
    .replace(/&/g,"&amp;")
    .replace(/</g,"&lt;")
    .replace(/>/g,"&gt;")
    .replace(/"/g,"&quot;")
    .replace(/'/g,"&#039;");

}
$('#searchChatBtn').on('click', function () {

    const searchText = $('#chatSearchInput').val().toLowerCase().trim();
    if (!searchText) return;

    let found = false;

    const messages = $('.messageUniquiId').get().reverse();

    $(messages).each(function () {

        const msg = $(this).text().toLowerCase();

        if (msg.includes(searchText)) {

            const container = $('.theme_chat_body_container');

            container.animate({
                scrollTop: $(this).offset().top 
                    - container.offset().top 
                    + container.scrollTop() - 100
            }, 300);

            $(this).addClass('chat-highlight');

            setTimeout(() => {
                $(this).removeClass('chat-highlight');
            }, 500);

            found = true;
            return false;
        }

    });

    if (!found) {
        alert('Message not found');
    }

});
</script>

<!-- Shiv Web Developer -->