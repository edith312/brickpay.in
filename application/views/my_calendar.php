<?php include('includes/header.php') ?>



<style>
    /* General Page Styling */

    /* Centered Container */
    .myCalendarBrick .container {
        max-width: 500px;
        margin: 50px auto;
        background: #fff;
        padding: 25px 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Heading */
    .myCalendarBrick .container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    /* Alerts */
    .myCalendarBrick .alert {
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 14px;
    }

    .myCalendarBrick .alert.success {
        background: #e8f9e9;
        color: #2f8a3e;
        border: 1px solid #9edba7;
    }

    .myCalendarBrick .alert.error {
        background: #fde8e8;
        color: #c0392b;
        border: 1px solid #f5b7b1;
    }

    /* Form Styling */
    .myCalendarBrick .brick-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .myCalendarBrick .form-group {
        display: flex;
        flex-direction: column;
    }

    .myCalendarBrick .form-group label {
        margin-bottom: 6px;
        font-weight: 600;
        color: #444;
    }

    .myCalendarBrick .form-group input {
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
        transition: all 0.3s ease;
    }

    .myCalendarBrick .form-group input:focus {
        border-color: #007bff;
        box-shadow: 0 0 4px rgba(0, 123, 255, 0.4);
    }

    /* Button */
    .myCalendarBrick .btn {
        background: #007bff;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 15px;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .myCalendarBrick .btn:hover {
        background: #0056b3;
    }
</style>
<!-- Shiv Web Developer.  -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="card border-0" style="width: 100%;">
        <div class="card-body row">
            <div class="table-resonsive col-md-6 myCalendarBrick card px-4 py-3">
                <div class="container">

                    <?php
                    $user_id = sessionId('freelancer_id'); // or any user ID you have
                    // Fetch token + user info
                    $google_userData = $this->GoogleTokenModel->getTokenAndUserInfo($user_id);
                    ?>

                    <table>
                        <tr>
                            <td>
                                <?php if (!empty($google_userData['picture'])): ?>
                                    <img src="<?= $google_userData['picture'] ?>" style="height: 50px;" alt="Profile Picture">
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                            <td><?= $google_userData['name'] ?? 'N/A' ?></td>
                            <!-- <td><//?= $google_userData['email'] ?? 'N/A' ?></td> -->
                            <!-- <td><//?= $google_userData['phone'] ?? 'N/A' ?></td> -->
                            <!-- <td><//?= $google_userData['access_token'] ?? 'N/A' ?></td>
                            <td><//?= $google_userData['refresh_token'] ?? 'N/A' ?></td>
                            <td><//?= $google_userData['token_expiry'] ?? 'N/A' ?></td> -->
                        </tr>
                    </table>


                    <h2>Create a Brick in Google Calendar</h2>
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert success"><?php echo $this->session->flashdata('success'); ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert error"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>
                    <form action="<?php echo site_url('calendar/create_brick'); ?>" method="post" class="brick-form">
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" name="title" value="My First Bricks" required>
                        </div>
                        <div class="form-group">
                            <label>Start Time (ISO):</label>
                            <input type="text" name="startTime" value="2025-09-20T18:00:00+05:30" placeholder="2025-09-20T18:00:00+05:30" required>
                        </div>
                        <div class="form-group">
                            <label>End Time (ISO):</label>
                            <input type="text" name="endTime" value="2025-09-20T19:00:00+05:30" placeholder="2025-09-20T19:00:00+05:30" required>
                        </div>
                        <button type="submit" class="btn">Create Brick</button>
                    </form>
                </div>
            </div>
            <div class="table-resonsive col-md-6 myCalendarBrick card px-4 py-3">
                <div class="artificial_date">
                    <input type="datetime-local" name="artificialdate" id="datetime-local" value="<?= isset($task['artificialdate']) ? htmlspecialchars($task['artificialdate']) : set_value('artificialdate'); ?>" class="form-control mt-3" placeholder="Date & Time" style="width:210px;" />
                </div>

                <iframe src="https://calendar.google.com/calendar/embed?src=your_calendar_id&ctz=Asia/Kolkata"
                    style="border: 0" width="100%" height="500" frameborder="0" scrolling="no"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- Shiv Web Developer.  -->

<?php include('includes/footer.php') ?>
<?php include('includes/footer-link.php') ?>