<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        h1 {
            color: darkblue;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .text-center {
            text-align: center;
        }

        .row {
            display: block;
            width: 100%;
        }

        .col-6 {
            width: 50%;
            float: left;
        }

        .table {
            width: 100%;
        }

        tr {
            width: 100%;
            border: 2px solid grey;
        }

        td {
            width: 50%;
        }
    </style>
</head>
<!-- Shiv Web Developer  -->

<body>

    <?php if (!empty($userDetails['image_base64'])): ?>
        <img src="<?= $userDetails['image_base64'] ?>" height="90px" width="90px" style="border-radius: 100%;" alt="Profile Picture" />
    <?php else: ?>
        <p>No Image Found</p>
    <?php endif; ?>



    <!-- <div class="container">
        <div class="text-center"></div>
        <div class="row">
            <div class="col-6">Left Column</div>
            <div class="col-6">Right Column</div>
        </div>
    </div> -->


    <table width="100%" cellspacing="0" cellpadding="0" style="border:1px solid #ddd; margin-top:20px; font-family: DejaVu Sans; font-size:12px;">
    
        <!-- PROFILE HEADER -->
        <tr>
            <td colspan="2" style="background:#f5f5f5; padding:8px; font-weight:bold; font-size:14px;">
                Profile
            </td>
        </tr>

        <!-- BASIC INFO -->
        <tr>
            <td style="border:1px solid #ddd; padding:6px; width:50%;">
                <strong>Name:</strong> <?= $userDetails['name']; ?>
            </td>
            <td style="border:1px solid #ddd; padding:6px; width:50%;">
                <strong>Date of Birth:</strong> <?= $userDetails['dob']; ?>
            </td>
        </tr>

        <tr>
            <td style="border:1px solid #ddd; padding:6px;">
                <strong>Mobile:</strong> <?= $userDetails['phone']; ?>
            </td>
            <td style="border:1px solid #ddd; padding:6px;">
                <strong>Email:</strong> <?= $userDetails['email']; ?>
            </td>
        </tr>

        <tr>
            <td style="border:1px solid #ddd; padding:6px;">
                <strong>Address:</strong> <?= $userDetails['address']; ?>
            </td>
            <td style="border:1px solid #ddd; padding:6px;">
                <strong>Country:</strong> <?= $country['name']; ?>
            </td>
        </tr>

        <tr>
            <td style="border:1px solid #ddd; padding:6px;">
                <strong>State:</strong> <?= $state['name']; ?>
            </td>
            <td style="border:1px solid #ddd; padding:6px;">
                <strong>City:</strong> <?= $userDetails['city']; ?>
            </td>
        </tr>

        <tr>
            <td style="border:1px solid #ddd; padding:6px;">
                <strong>Zip Code:</strong> <?= $userDetails['zipcode']; ?>
            </td>
            <td style="border:1px solid #ddd; padding:6px;">
                <strong>Summary:</strong> <?= $userDetails['summary']; ?>
            </td>
        </tr>

        <!-- SKILLS / EDUCATION -->
        <tr>
            <td style="border:1px solid #ddd; padding:6px;">
                <strong>Skills:</strong> <?= $userDetails['skills']; ?>
            </td>
            <td style="border:1px solid #ddd; padding:6px;">
                <strong>Education:</strong> <?= $userDetails['education']; ?>
            </td>
        </tr>

        <!-- EXPERIENCE -->
        <tr>
            <td colspan="2" style="background:#f5f5f5; padding:8px; font-weight:bold; font-size:14px;">
                Experience
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border:1px solid #ddd; padding:6px;">
                <?= $userDetails['experience']; ?>
            </td>
        </tr>

        <!-- AGE BLOCKS -->
        <tr>
            <td colspan="2" style="background:#f5f5f5; padding:8px; font-weight:bold; font-size:14px;">
                Timeline / Age Blocks
            </td>
        </tr>

        <?php if (!empty($AgeBlocks) && is_array($AgeBlocks)): ?>
            <?php
                $groupedBlocks = [];
                foreach ($AgeBlocks as $block) {
                    $groupedBlocks[$block['year_range']][] = $block['description'];
                }
            ?>

            <?php foreach ($groupedBlocks as $yearRange => $descriptions): ?>
                <tr>
                    <td colspan="2" style="padding:6px; font-weight:bold;">
                        <?= $yearRange ?>
                    </td>
                </tr>

                <?php foreach ($descriptions as $i => $desc): ?>
                    <tr>
                        <td colspan="2" style="border:1px solid #ddd; padding:6px;">
                            <?= ($i + 1) ?>. <?= $desc ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2" style="padding:6px;">
                    No Age Blocks found!
                </td>
            </tr>
        <?php endif; ?>

    </table>





</body>

</html>