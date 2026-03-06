<!DOCTYPE html>
<html>
<head>
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: Georgia, serif;
            font-size: 12pt;
            margin: 0;
        }

        .header img {
            width: 100%;
        }

        .footer img {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        td, th {
            border: 1px solid #999;
            padding: 4px;
        }
        .user_table td{
            border: 0px;
        }
        .print-page {
            page-break-after: always;     /* Old standard */
            break-after: page;            /* New standard */
            page-break-inside: avoid;
        }
        @media print {
            .print-page {
                page-break-after: always;
                break-after: page;
            }
        }
    </style>
</head>
<body>

<?php if (!empty($report_type)): ?>
    <div class="print-page">

        <!-- HEADER -->
        <img src="<?= $header ?>" width="100%">

        <h3 style="text-align:center; margin: 10px 0;">
            Medical Identity Report – <?= strtoupper($report_type) ?>
        </h3>

        <!-- User Details -->
        <div class="user_table" style="margin-left: 2cm; margin-right: 2cm;">
            <table width="100%" cellpadding="6" cellspacing="0" border="0" style="margin-top: 10px;">
                <tr>
                    <td width="85%" style="border:0;">
                        <table width="100%" cellpadding="4" cellspacing="0" border="0">
                            <tr>
                                <td width="25%"><strong>Name</strong></td>
                                <td width="75%"><?= htmlspecialchars($user['name']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Phone</strong></td>
                                <td><?= htmlspecialchars($user['phone']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Date of Birth</strong></td>
                                <td><?= htmlspecialchars($user['dob']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Address</strong></td>
                                <td>
                                    <?= htmlspecialchars($user['address']) ?>,
                                    <?= htmlspecialchars($user['city']) ?> - <?= htmlspecialchars($user['zipcode']) ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="15%" style="border:0; padding-top:20px; vertical-align: top;">
                        <?php if (!empty($user['user_image'])): ?>
                            <img src="<?= base_url('uploads/user_profile/' . $user['user_image']) ?>"
                                width="80" height="80"
                                style="border-radius: 50%;">
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>

        <div style="margin-left: 2cm; margin-right: 2cm; margin-bottom: 1cm;">
            <table>
                <tr>
                    <th>Type</th>
                    <th>Report</th>
                    <th>Date</th>
                </tr>

                <?php
                    $reportMap = [
                        'cbc' => ['CBC', 'cbc', 'cbc_date'],
                        'lft' => ['LFT', 'lft', 'lft_date'],
                        'rft' => ['RFT', 'rft', 'rft_date'],
                        'urine_rm' => ['Urine RM', 'urine_rm', 'urine_rm_date'],
                        'stool_rm' => ['Stool RM', 'stool_rm', 'stool_rm_date'],
                        'diabetes_profile' => ['Diabetes Profile', 'diabetes_profile', 'diabetes_profile_date'],
                        'vitamin_b12_d3' => ['Vitamin B12/D3', 'vitamin_b12_d3', 'vitamin_b12_d3_date'],
                        'thyroid_profile' => ['Thyroid Profile', 'thyroid_profile', 'thyroid_profile_date'],
                        'x_ray' => ['X-Ray', 'x_ray', 'x_ray_date'],
                        'ecg_report' => ['ECG', 'ecg_report', 'ecg_report_date'],
                        'mri_report' => ['MRI', 'mri_report', 'mri_report_date'],
                        'ct_scan_report' => ['CT-Scan', 'ct_scan_report', 'ct_scan_report_date'],
                        'ultra_sound_report' => ['Ultra-Sound', 'ultra_sound_report', 'ultra_sound_report_date'],

                        'physical_params' => ['Physical Parameters', 'physical_params', 'physical_params_date'],
                        'anatomical_params' => ['Anatomical Parameters', 'anatomical_params', 'anatomical_params_date'],
                        'physiological_params' => ['Physiological Parameters', 'physiological_params', 'physiological_params_date'],
                        'physiotherapy_params' => ['Physiotherapy Parameters', 'physiotherapy_params', 'physiotherapy_params_date'],
                        'acupuncture_points_params' => ['Acupuncture Points', 'acupuncture_points_params', 'acupuncture_points_params_date'],
                        'geolocation_coordinates' => ['Geolocation Coordinates', 'geolocation_coordinates', 'geolocation_coordinates_date'],
                        'sea_level_params' => ['Sea Level Parameters', 'sea_level_params', 'sea_level_params_date'],

                        // timestamps
                        'pm_levels' => ['PM 2.5 / 5 / 10', 'pm_levels', 'pm_levels_at'],
                        'o2_level' => ['O2 Level', 'o2_level', 'o2_level_at'],
                        'co2_level' => ['CO2 Level', 'co2_level', 'co2_level_at'],
                        'toxic_gases_level' => ['Toxic Gases Level', 'toxic_gases_level', 'toxic_gases_level_at'],
                        'airflow_changes_per_min' => ['Air Changes / Min (Airflow)', 'airflow_changes_per_min', 'airflow_changes_per_min_at'],
                        'camera_feed' => ['Camera Feed', 'camera_feed', 'camera_feed_at'],
                        'negative_pressure_level' => ['Negative Pressure Level', 'negative_pressure_level', 'negative_pressure_level_at'],
                        'positive_pressure_level' => ['Positive Pressure Level', 'positive_pressure_level', 'positive_pressure_level_at'],
                    ];

                    if (isset($reportMap[$report_type])) {
                        [$label, $valueKey, $timeKey] = $reportMap[$report_type];
                        echo "<tr>
                                <td><b>{$label}</b></td>
                                <td>{$report[$valueKey]}</td>
                                <td>{$report[$timeKey]}</td>
                            </tr>";
                    }
                    ?>


            </table>
        </div>

        <table width="100%" cellpadding="0" cellspacing="0" border='0' style="margin-top:20px; margin-left: 2cm;">
            <tr>
                <td style='border: 0;'>
                    <img src="<?= $signature ?>" width="30%">
                </td>
            </tr>
        </table>
        
        <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 30px; margin-left: 2cm; margin-bottom: 1cm;">
            <tr>
                <td width="40%" style="text-align: left; font-size: 12px; line-height: 1.5; border: 0;">
                    <strong>Thanks &amp; Regards,</strong><br>
                    <strong>Shubham Shah - Director</strong><br>
                    <strong>Edith Robotics Solutions Pvt. Ltd.</strong>
                </td>
                <td width="60%" style="border: 0;"></td>
            </tr>
        </table>

        <!-- FOOTER -->
        <img src="<?= $footer ?>" width="100%">

    </div>
<?php endif; ?>


<!-- HEADER -->
<div class="print-page">

    <!-- HEADER -->
    <table width="100%"><tr><td style="border:0;"><img src="<?= $header ?>" width="100%"></td></tr></table>

    <h3 style="text-align:center; margin: 10px 0;">Medical Identity Report</h3>

    <?= $this->load->view('reports/user_header', compact('user'), true); ?>

    <div style="margin-left: 2cm; margin-right: 2cm;">
        <table>
            <tr><th>S.No</th><th>Type</th><th>Report</th><th>Date</th></tr>

            <?php
            $rows = [
                ['CBC', 'cbc', 'cbc_date'],
                ['LFT', 'lft', 'lft_date'],
                ['RFT', 'rft', 'rft_date'],
                ['Urine RM', 'urine_rm', 'urine_rm_date'],
                ['Stool RM', 'stool_rm', 'stool_rm_date'],
                ['Diabetes Profile', 'diabetes_profile', 'diabetes_profile_date'],
                ['Vitamin B12/D3', 'vitamin_b12_d3', 'vitamin_b12_d3_date'],
                ['Thyroid Profile', 'thyroid_profile', 'thyroid_profile_date'],
                ['X-Ray', 'x_ray', 'x_ray_date'],
                ['ECG', 'ecg_report', 'ecg_report_date'],
            ];

            $i = 1;
            foreach ($rows as [$label, $key, $dateKey]): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><b><?= $label ?></b></td>
                    <td><?= $report[$key] ?></td>
                    <td><?= $report[$dateKey] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>


    <?= $this->load->view('reports/sign_footer', compact('signature', 'footer'), true); ?>

</div>

<div class="print-page">

    <table width="100%"><tr><td style="border:0;"><img src="<?= $header ?>" width="100%"></td></tr></table>

    <h3 style="text-align:center; margin: 10px 0;">Human Physical Parameters</h3>

    <?= $this->load->view('reports/user_header', compact('user'), true); ?>

    <div style="margin-left: 2cm; margin-right: 2cm;">
        <table>
            <tr><th>Type</th><th>Report</th><th>Date</th></tr>

            <?php
            $rows = [
                ['MRI', 'mri_report', 'mri_report_date'],
                ['CT-Scan', 'ct_scan_report', 'ct_scan_report_date'],
                ['Ultra-Sound', 'ultra_sound_report', 'ultra_sound_report_date'],

                ['Physical Parameters', 'physical_params', 'physical_params_date'],
                ['Anatomical Parameters', 'anatomical_params', 'anatomical_params_date'],
                ['Physiological Parameters', 'physiological_params', 'physiological_params_date'],
                ['Physiotherapy Parameters', 'physiotherapy_params', 'physiotherapy_params_date'],
                ['Acupuncture Points', 'acupuncture_points_params', 'acupuncture_points_params_date'],
                ['Geolocation Coordinates', 'geolocation_coordinates', 'geolocation_coordinates_date'],
                ['Sea Level Parameters', 'sea_level_params', 'sea_level_params_date'],
            ];

            foreach ($rows as [$label, $key, $dateKey]): 
                // optional: hide empty rows
                if (empty($report[$key])) continue;
            ?>
                <tr>
                    <td><b><?= $label ?></b></td>
                    <td><?= $report[$key] ?></td>
                    <td><?= $report[$dateKey] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>


    <?= $this->load->view('reports/sign_footer', compact('signature', 'footer'), true); ?>

</div>

<div class="print-page">

    <table width="100%"><tr><td style="border:0;"><img src="<?= $header ?>" width="100%"></td></tr></table>

    <h3 style="text-align:center; margin: 10px 0;">Edith ICU–Isolation Bed Real-Time Sensor Data</h3>

    <?= $this->load->view('reports/user_header', compact('user'), true); ?>

    <div style="margin-left: 2cm; margin-right: 2cm;">
        <table>
            <tr><th>Type</th><th>Report</th><th>Date</th></tr>

            <?php
            $rows = [
                // 🟦 ICU / Sensor data (TIMESTAMP)
                ['PM 2.5 / 5 / 10', 'pm_levels', 'pm_levels_at'],
                ['O2 Level', 'o2_level', 'o2_level_at'],
                ['CO2 Level', 'co2_level', 'co2_level_at'],
                ['Toxic Gases Level', 'toxic_gases_level', 'toxic_gases_level_at'],
                ['Airflow (Changes / Min)', 'airflow_changes_per_min', 'airflow_changes_per_min_at'],
                ['Camera Feed', 'camera_feed', 'camera_feed_at'],
                ['Negative Pressure', 'negative_pressure_level', 'negative_pressure_level_at'],
                ['Positive Pressure', 'positive_pressure_level', 'positive_pressure_level_at'],

                // 🆕 Hospital / Services / Robotics (DATE)
                ['OPD', 'opd', 'opd_date'],
                ['IVF Central Lab', 'ivf_central_lab', 'ivf_central_lab_date'],
                ['General Surgery', 'general_surgery', 'general_surgery_date'],
                ['Robotic Surgery Programming', 'robotic_surgery_programming', 'robotic_surgery_programming_date'],
                ['Robots Building Robot', 'robots_building_robot', 'robots_building_robot_date'],
                ['Hydration & Cell Response', 'hydration_cell_response', 'hydration_cell_response_at'],
                ['Digestion Realtime Monitoring', 'digestion_realtime_monitoring', 'digestion_realtime_monitoring_at'],
                ['Bowel Movement Tracking', 'bowel_movement_tracking', 'bowel_movement_tracking_at'],
            ];


            foreach ($rows as [$label, $key, $timeKey]):
                // optional: hide empty rows
                if (empty($report[$key])) continue;
            ?>
                <tr>
                    <td><b><?= $label ?></b></td>
                    <td><?= $report[$key] ?></td>
                    <td><?= $report[$timeKey] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>


    <?= $this->load->view('reports/sign_footer', compact('signature', 'footer'), true); ?>

</div>


</body>
</html>
