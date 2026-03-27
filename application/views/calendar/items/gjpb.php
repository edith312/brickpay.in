<?php
    $locations = [
        "GJ-01|380001" => "GJ-01 Ahmedabad (380001)",
        "GJ-02|360001" => "GJ-02 Rajkot (360001)",
        "GJ-03|390001" => "GJ-03 Vadodara (390001)",
        "GJ-05|395003" => "GJ-05 Surat (395003)",
        "GJ-06|364001" => "GJ-06 Bhavnagar (364001)",
        "GJ-18|382021" => "GJ-18 Gandhinagar (382021)",

        "PB-01|143001" => "PB-01 Amritsar (143001)",
        "PB-02|144001" => "PB-02 Jalandhar (144001)",
        "PB-03|147001" => "PB-03 Patiala (147001)",
        "PB-04|151001" => "PB-04 Bathinda (151001)",
        "PB-05|143521" => "PB-05 Gurdaspur (143521)",
        "PB-10|141001" => "PB-10 Ludhiana (141001)",
        "PB-65|160055" => "PB-65 Mohali (160055)"
    ];
    
?>

<?php
    $value = strtoupper(trim($item['gjpb']));
    $display = $locations[$value] ?? $value;
?>

<div class="timeline-output text-output">
    <span><?= nl2br(htmlspecialchars($display)) ?></span>

    <span class="edit-item">
        <i class="bi bi-pencil" title="Edit"></i>
    </span>

    <span class="delete-item">
        <i class="bi bi-trash delete-item" title="Delete"></i>
    </span>
</div>