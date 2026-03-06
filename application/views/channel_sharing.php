<?php include('includes/header-link.php') ?>
<?php include('includes/header.php') ?>
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="card p-md-4 p-2">
        <h4 class="mb-5">Channel Sharing</h4>
        <!-- Shiv Web Developer -->
        <div class="card p-2 d-flex">
            <div class="col-3">
                <img src="<?= base_url('/assets/images/logo.png') ?>" alt="Brick Pay Logo" style="height:80px; width:200px;" />
            </div>
            <div class="col-3">
                Brick Id: <?= generateBrickId($channelDetails['brick_id']) ?>
            </div>
            <div class="col-6">
                Project Name: <?= $projectDetails['project_name']; ?>
            </div>
            <div class="col-6">
                Company Name: <?= $companyDetails['company_name']; ?>
            </div>

        </div>
        <div class="dpofcreators">
            <div class="brickChannelTeamContainer">
                <div class="brickChannelTeamHeader">
                    <div class="chennelNameHeader" id="chennelFirst"> Channel - <?= $channelDetails['channel_name']; ?> </div>
                    <div class="channeltypes" id="chenneltypeFirst"> Type - <?= ucwords(str_replace('-', ' ', $channelDetails['chennel_brick_type'])); ?> </div>
                </div>
                <div class="brickChannelTeamBodyContainer">
                    <?php
                    $brick_id = $channelDetails['brick_id'];

                    $brick_Details = $this->CommonModal->getSingleRowById('bricks', ['id' => $brick_id]);
                    $getChannelName = $this->CommonModal->getRowByMoreId('brick_pass_channel', ['brick_id' => $brick_id]);
                    $getChannelUserProfile = $this->CommonModal->getRowsbyIdForTeam('teamcompanymember', ['brick_id' => $brick_id, 'status' => 'Accepted', 'request_tab_id' => 'network-marketing-request'], 'id', 'ASC');

                    if (!empty($getChannelName)):
                        foreach ($getChannelName as $getChannel):
                            if ($getChannel['id'] == $chid && $getChannel['created_by'] == $getChannel['created_by']) {
                                $createdByUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $getChannel['created_by']], 'id', 'DESC');
                    ?>
                                <div class="MainUser">
                                    <a href="<?= base_url('/company/profile_preview?id=') . $createdByUserDetails['id']; ?>" target="_blank">
                                        <img src="<?= base_url('uploads/user_profile/' . $createdByUserDetails['user_image'] ?? 'assets/images/img/user.png') ?>" alt="profile_av" class="img-fluid rounded-circle" style="width: 50px; height: 50px; margin-right: 5px;">
                                    </a>
                                </div>

                    <?php
                            };
                        endforeach;
                    endif;
                    ?>

                    <!-- Shiv Web Developer -->
                    <div class="BrickChannelTeamListContainer">
                        <?php

                        $shownMembers = [];
                        if (!empty($getChannelUserProfile)):
                            foreach ($getChannelUserProfile as $teamProfile):
                                if ($teamProfile['chid'] == $chid && !in_array($teamProfile['member_id'], $shownMembers)) {

                                    // Mark this member as shown
                                    $shownMembers[] = $teamProfile['member_id'];
                                    $channelTeamUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $teamProfile['member_id']], 'id', 'DESC');
                        ?>
                                    <div class="BrickChannelTeamList">
                                        <a href="<?= base_url('/company/profile_preview?id=') . $channelTeamUserDetails['id']; ?>" target="_blank">
                                            <img src="<?= base_url('uploads/user_profile/' . $channelTeamUserDetails['user_image'] ?? 'assets/images/img/user.png') ?>" alt="profile_av" class="img-fluid rounded-circle" style="width: 50px; height: 50px; margin-right: 5px;">
                                        </a>
                                    </div>

                        <?php
                                };
                            endforeach;
                        endif;
                        ?>

                        <div class="BrickChannelProgresbar"> </div>
                        <div class="AddTeamMember" id="openAddNewUser"> + </div>
                        <!-- <div class="AddTeamMemberShare"> <a href="<//?= base_url('/company/channel-sharing?chid=') . '42' ?>" class="text-white"> Share </a> </div> -->
                    </div>
                </div>

                <!-- Add New User in Channel and Send Requesst for Inviting -->
                <div class="BrickChannelTeamAddNewUser" id="addNewUserForm" style="display: none;">

                    <?php
                    if (sessionId('freelancer_id')) {
                    ?>

                        <form action="<?= base_url('company/network-marketing-chanel-request') ?>" id="channelRequestForm" method="post">
                            <div class="chennel-request-send">
                                <input type="hidden" name="brick_id" value="<?= $channelDetails['brick_id'] ?>">
                                <input type="hidden" name="company_id" value="<?= $channelDetails['company_id'] ?>">
                                <input type="hidden" name="project_id" value="<?= $channelDetails['project_id'] ?>">
                                <input type="hidden" name="created_by" value="<?= $channelDetails['created_by'] ?>">
                                <input type="hidden" id="ChannelFirstId" name="channel_id" value="<?= $channelDetails['channel_id'] ?>">
                                <input type="hidden" id="chidFirstId" name="chid" value="<?= $channelDetails['id'] ?>">
                            </div>
                            <div class="row m-md-3">
                                <div class="col-md-10">
                                    <label for="channelName" class="form-label">Search User</label> <br />
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-search"></i>
                                        </span>
                                        <input class="form-control" id="team-member-input" name='users-list-tags' placeholder='Search user by name' value='' required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary mt-4 px-4" style="text-align: center;">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    <?php  } else { ?>

                        <div class="p-2 bg-danger text-white">
                            You are Not LoggedIn, Please LogIn for More Functionality. <br />
                            Click [ <a href="<?= base_url(); ?>" style="color:lightblue;"> Here For Login..... </a> ]
                        </div>

                    <?php  } ?>
                </div>


                <div class="mt-5">
                    Hey, check this work Opportunity worth "INR <?= $brick_Details['reward_disclosed']; ?>" available for you on Brick Pay.
                </div>
                <div class="py-2">
                    I recommend you to check this out.
                </div>
                <div class="py-2">
                    <a href="<?= base_url('company/preview_brick?id=') . $brick_id; ?>" target="_blank"> View Full Bricks </a>
                    Open Brick - Brick poster - Join work - Bidding Box | Pass on - Join my Chain here.
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .BrickChannelTeamAddNewUser {
        border: 1px solid grey;
        padding: 5px;
    }

    .userchain-text {
        display: flex;
        align-items: center;
        font-weight: bold;
    }

    .userchain-text span {
        display: flex;
        align-items: center;
        gap: 2px;
        flex-wrap: wrap;
    }

    .user-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #fff;
        box-shadow: 0 0 0 1px #ccc;
    }

    .more-btn {
        background-color: #f0f0f0;
        border: none;
        padding: 4px 10px;
        border-radius: 15px;
        cursor: pointer;
        font-size: 12px;
    }


    .user-chain-container {
        width: 100%;
        overflow-x: auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 10px;
        border: 1px solid #ddd;
    }

    .user-chain-line {
        display: flex;
        align-items: center;
        position: relative;
        padding: 20px 0;
    }

    .user-chain-line::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        height: 4px;
        background-color: #ccc;
        width: 100%;
        z-index: 0;
        transform: translateY(-50%);
    }

    .user-block {
        position: relative;
        z-index: 1;
        background: #fff;
        border: 3px solid #ddd;
        border-radius: 50%;
        width: 80px;
        height: 80px;
        margin: 0 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 12px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .user-block img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-block span {
        position: absolute;
        bottom: -20px;
        white-space: nowrap;
    }

    .user-block.add-user {
        background-color: #e0f7fa;
        border: 2px dashed #00796b;
        color: #00796b;
        font-size: 30px;
    }

    .user-block.add-user button {
        background: none;
        border: none;
        color: #00796b;
        font-size: 40px;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }
</style>

<!-- // Channel Section End -->

<style>
    .brickChannelTeamContainer {
        padding: 5px;
    }

    .brickChannelTeamContainer .brickChannelTeamHeader .chennelNameHeader {
        font-size: 16px;
        font-weight: 700;
        color: green;
    }

    .brickChannelTeamContainer .brickChannelTeamBodyContainer {
        display: flex;
        margin-top: 10px;
    }

    .brickChannelTeamContainer .brickChannelTeamBodyContainer .MainUser {
        border-right: 2px solid #070808;
        padding: 5px;
    }

    .brickChannelTeamContainer .brickChannelTeamBodyContainer .BrickChannelTeamListContainer {
        display: flex;
        flex: 1;
        overflow-x: auto;
        padding-left: 10px;
        position: relative;
        overflow-x: scroll;
        padding: 5px;
    }

    /* width */
    .brickChannelTeamContainer .brickChannelTeamBodyContainer .BrickChannelTeamListContainer::-webkit-scrollbar {
        width: 2px;
        height: 2px;
    }

    /* Track */
    .brickChannelTeamContainer .brickChannelTeamBodyContainer .BrickChannelTeamListContainer::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    .brickChannelTeamContainer .brickChannelTeamBodyContainer .BrickChannelTeamListContainer::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    .brickChannelTeamContainer .brickChannelTeamBodyContainer .BrickChannelTeamListContainer::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .brickChannelTeamContainer .brickChannelTeamBodyContainer .BrickChannelProgresbar {
        height: 1px;
        background-color: black;
        width: 100%;
        align-self: center;
        z-index: 1;
        position: absolute;
        left: 0px;
    }

    .brickChannelTeamContainer .brickChannelTeamBodyContainer .BrickChannelTeamList {
        /* position:absolute; */
        z-index: 2;
        margin: 0px 5px;
    }

    .brickChannelTeamContainer .brickChannelTeamBodyContainer .AddTeamMember {
        z-index: 2;
        font-size: 28px;
        font-weight: 700;
        color: white;
        background-color: #00b8d6;
        border-radius: 100%;
        height: 30px;
        width: 30px;
        margin-top: 10px;
        line-height: 1;
        text-align: center;
        cursor: pointer;

    }

    .brickChannelTeamContainer .AddTeamMemberShare {
        position: absolute;
        right: 0px;
        background-color: #00b8d6;
        color: white;
        padding: 10px;
        z-index: 2;
    }
</style>

<?php include('includes/footer.php') ?>
<?php include('includes/footer-link.php') ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $(document).ready(function() {
            // Add New User Form Toggle
            $('#openAddNewUser').on('click', function() {
                $('#addNewUserForm').slideToggle(200); // 200ms animation
            });
        });
    });

    $(document).ready(function() {
        var inputElm = document.querySelector('#team-member-input');

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
                ${ tagData.avatar ? `
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
        var tagify = new Tagify(inputElm, {
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

        // Listen to input event for dynamic search (1D module)
        tagify.on('input', function(e) {
            var value = e.detail.value.trim();
            tagify.loading(true);

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
                    tagify.loading(false);
                    if (data.success && Array.isArray(data.users)) {
                        tagify.settings.whitelist = data.users.map(user => ({
                            value: user.id,
                            name: user.name,
                            label: user.name,
                            email: user.email,
                            avatar: user.avatar || 'assets/user-icon.png'
                        }));
                        tagify.dropdown.show(value);
                    } else {
                        tagify.settings.whitelist = [];
                        tagify.dropdown.hide();
                        alert('No users found or invalid response from server.');
                    }
                })
                .catch(error => {
                    tagify.loading(false);
                    console.error('Error searching users:', error);
                    alert('Failed to search users: ' + error.message);
                });
        });


        // Send Network Marketing Channel Request to User
        $('#channelRequestForm').on('submit', function(e) {
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
                    if (response.success) {
                        // ✅ Show message without page reload
                        alert(response.message);

                        // ✅ Clear the input field after success
                        $('#team-member-input').val(''); // Reset input value

                        // ❌ Remove or comment out this if you don't want to reload
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

    });
</script>

<!-- Shiv Web Developer -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>