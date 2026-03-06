<?php $this->load->view('includes/header'); ?>
<!-- Shiv Web Developer  -->

<?php
if ($this->session->has_userdata('taskMsg')) {
    echo $this->session->userdata('taskMsg');
    $this->session->unset_userdata('taskMsg');
}
?>

<!-- Shiv Web Developer -->
<style>
    /* Team Member Card Styles */
    .team-member-card {
        display: flex;
        align-items: center;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 8px;
        /* margin-bottom: 15px; */
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.2s;
        cursor: pointer;
        font-size: 12px;
    }

    .team-member-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .team-member-card img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
        border: 2px solid #e9ecef;
    }

    .team-member-info {
        flex-grow: 1;
    }
</style>


<style>
    .tables {
        width: 95% !important;
        height: auto !important;
        background: #ffff;
        border-radius: 10px;
        padding: 20px;
    }

    .tables .thead {
        width: 100% !important;
    }

    .tables .thead .tr {
        width: 100% !important;
        display: flex;
        border: 1px solid grey;
    }

    .tables .thead .tr .th1 {
        width: 35% !important;
        border-left: 1px solid grey;
        padding: 5px !important;
        font-weight: 700;
    }

    .tables .thead .tr .th2 {
        width: 65% !important;
        border-left: 1px solid grey;
        padding: 5px !important;
        font-weight: 700;
    }

    .tables .tbody {
        width: 100% !important;
    }

    .tables .tbody .tr {
        width: 100% !important;
        display: flex;
        border: 1px solid grey;
        margin-top: 5px;
    }

    .tables .tbody .tr .td1 {
        width: 35% !important;
        border-left: 1px solid grey;
        padding: 5px !important;
    }

    .tables .tbody .tr .td2 {
        width: 65% !important;
        border-left: 1px solid grey;
        padding: 5px !important;
    }
</style>


<!-- Shiv Web Developer -->
<style>
    @media (min-width: 1200px) {
        main .page-body {
            height: calc(100vh - 30px) !important;
        }
    }

    #filtersSection {
        margin-top: 0 !important;
    }

    .filters .filter-box {
        padding-bottom: 12px;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 43px;
        height: 100%;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 34px;
        height: 17px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 10px;
        width: 10px;
        border-radius: 50%;
        left: 4px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
    }

    input:checked+.slider {
        background-color: #007bff;
    }

    input:checked+.slider:before {
        transform: translateX(26px);
    }

    .custom-search-input {
        padding-left: 2.2rem;
    }

    .custom-search-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: gray;
        pointer-events: none;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .container {
            padding: 10px;
        }

        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-8 {
            margin-bottom: 15px;
        }

        .mt--48 {
            margin-top: 15px !important;
        }
    }

    @media (max-width: 768px) {
        .form-unique {
            width: 25px !important;
            height: 25px;
            font-size: 12px !important;
        }

        .d-flex.gap-3 {
            flex-direction: column;
        }

        .top-right-btns {
            display: flex;
            flex-direction: row;
            width: 100%;
        }

        .top-right-btns button {
            flex: 1;
        }

        .ps-md-3 {
            padding-left: 10px !important;
        }

        .p-md-5 {
            padding: 15px !important;
        }
    }

    @media (max-width: 576px) {
        .container {
            padding: 5px;
        }

        .form-unique {
            width: 20px !important;
            height: 20px;
            font-size: 10px !important;
            margin: 0 1px;
        }

        .custom-upload-btn {
            font-size: 12px;
            padding: 5px 8px;
        }

        h4 {
            font-size: 18px;
        }

        label {
            font-size: 14px;
        }
    }

    /* New styles for modals and upload icons */
    .upload-modal .modal-content {
        border-radius: 10px;
    }

    .upload-modal .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }

    .upload-modal .modal-body {
        padding: 20px;
    }

    .textarea-upload-container {
        position: relative;
    }

    .mic-icon,
    .video-icon,
    .upload-icon {
        position: absolute;
        cursor: pointer;
        font-size: 18px;
        color: rgb(0, 127, 230);
    }

    .mic-icon {
        right: 19px;
        top: 10px;
    }

    .video-icon {
        left: 12px;
        bottom: 12px;
    }

    .upload-icon {
        right: 12px;
        bottom: 12px;
    }
</style>

<div class="ps-md-4 pe-md-3 px-2 py-3 page-body pt-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header py-3 p-0 pt-0 bg-transparent border-bottom-0 m-auto">
                    <div>
                        <div class="tables table-bordered">
                            <div class="thead">
                                <div class="tr">
                                    <div class="card-body" style="text-align: center !important;">
                                        <div>
                                            <h4 class="mb-md-5 mb-3 text-center"> Edit - S6 - Technology Readiness Levels (TRLs) </h4>
                                        </div>

                                        <!-- Section Enabled Disable -->
                                        <div id="questionBox2" class="p-md-5 pt-md-3 pb-md-3 dotted-bottom ps-md-3" style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                                            <div class="d-flex align-items-center">
                                                <label class="me-2">S<sub>6</sub> - <span style="font-size:12px; color:red;">*</span> Technology Readiness Levels (TRLs) </label>
                                                <label class="switch me-2">
                                                    <input type="checkbox" class="enableSwitch" data-index="2" name="show_form_2" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                                <span class="enableDisableLabel" data-index="1">Yes</span> <br />
                                            </div>
                                        </div>

                                    </div>
                                    <!-- <div style="text-align: center !important; margin-left:38%;"> <strong> S5 - Technology readiness levels (TRLs) </strong></div> -->
                                </div>
                            </div>
                            <div id="conditionalForm2" style="display: block;">
                                <form action="<?= base_url('/company/trllevelsupdate') ?>" method="post" enctype="multipart/form-data" id="trllevelform">
                                    <div class="tbody">
                                        <div class="tr">
                                            <div class="td2">
                                                <div class="row g-0 p-0">
                                                    <div class="col-6">
                                                        <div class="position-relative me-1">
                                                            <label class="mb-md-2">Select Company</label>
                                                            <select class="form-control" name="company_id" id="company_id">
                                                                <?php if ($getCompanies) {
                                                                    foreach ($getCompanies as $company) { ?>
                                                                        <option value="<?= $company['id']; ?>" <?= (isset($trlleveledit['company_id']) && $trlleveledit['company_id'] == $company['id']) ? 'selected' : (set_value('company_id') == $company['id'] ? 'selected' : '') ?>><?= $company['company_name']; ?> (CIN: <?= $company['ciin_number']; ?>)</option>
                                                                <?php }
                                                                } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="position-relative">
                                                            <label class="mb-md-2">Select Project</label>
                                                            <select class="form-control" name="project_id" id="project_id">
                                                                <option value=""><?= isset($trlleveledit['project_id']) ? $trlleveledit['project_id'] : ''; ?></option>
                                                            </select>
                                                        </div>
                                                        <!-- Hidden input to store the pre-selected value from database -->
                                                        <input type="hidden" id="selected_project_id" value="<?= isset($trlleveledit['project_id']) ? $trlleveledit['project_id'] : ''; ?>">
                                                        <input type="hidden" name="id" id="id" value="<?= isset($trlleveledit['id']) ? $trlleveledit['id'] : ''; ?>">
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group mt-2">
                                                            <label class="mb-md-2"> Industry</label>
                                                            <select class="form-select" name="industry" required>
                                                                <option value=""> Select </option>
                                                                <option value="Analytics" <?= ($trlleveledit['industry'] ?? '') == "Analytics" ? 'selected' : '' ?>>Analytics</option>
                                                                <option value="Advertising" <?= ($trlleveledit['industry'] ?? '') == "Advertising" ? 'selected' : '' ?>>Advertising</option>
                                                                <option value="Architecture Interior Design" <?= ($trlleveledit['industry'] ?? '') == "Architecture Interior Design" ? 'selected' : '' ?>>Architecture Interior Design</option>
                                                                <option value="AR VR (Augmented + Virtual Reality)" <?= ($trlleveledit['industry'] ?? '') == "AR VR (Augmented + Virtual Reality)" ? 'selected' : '' ?>>AR VR (Augmented + Virtual Reality)</option>
                                                                <option value="Automotive" <?= ($trlleveledit['industry'] ?? '') == "Automotive" ? 'selected' : '' ?>>Automotive</option>
                                                                <option value="Art & Photography" <?= ($trlleveledit['industry'] ?? '') == "Art & Photography" ? 'selected' : '' ?>>Art & Photography</option>
                                                                <option value="Animation" <?= ($trlleveledit['industry'] ?? '') == "Animation" ? 'selected' : '' ?>>Animation</option>
                                                                <option value="Chemicals" <?= ($trlleveledit['industry'] ?? '') == "Chemicals" ? 'selected' : '' ?>>Chemicals</option>
                                                                <option value="Computer Vision" <?= ($trlleveledit['industry'] ?? '') == "Computer Vision" ? 'selected' : '' ?>>Computer Vision</option>
                                                                <option value="Telecommunication & Networking" <?= ($trlleveledit['industry'] ?? '') == "Telecommunication & Networking" ? 'selected' : '' ?>>Telecommunication & Networking</option>
                                                                <option value="Construction" <?= ($trlleveledit['industry'] ?? '') == "Construction" ? 'selected' : '' ?>>Construction</option>
                                                                <option value="Agriculture" <?= ($trlleveledit['industry'] ?? '') == "Agriculture" ? 'selected' : '' ?>>Agriculture</option>
                                                                <option value="Aeronautics Aerospace & Defence" <?= ($trlleveledit['industry'] ?? '') == "Aeronautics Aerospace & Defence" ? 'selected' : '' ?>>Aeronautics Aerospace & Defence</option>
                                                                <option value="AI" <?= ($trlleveledit['industry'] ?? '') == "AI" ? 'selected' : '' ?>>AI</option>
                                                                <option value="Green Technology" <?= ($trlleveledit['industry'] ?? '') == "Green Technology" ? 'selected' : '' ?>>Green Technology</option>
                                                                <option value="Events" <?= ($trlleveledit['industry'] ?? '') == "Events" ? 'selected' : '' ?>>Events</option>
                                                                <option value="Fashion" <?= ($trlleveledit['industry'] ?? '') == "Fashion" ? 'selected' : '' ?>>Fashion</option>
                                                                <option value="Finance Technology" <?= ($trlleveledit['industry'] ?? '') == "Finance Technology" ? 'selected' : '' ?>>Finance Technology</option>
                                                                <option value="Enterprise Software" <?= ($trlleveledit['industry'] ?? '') == "Enterprise Software" ? 'selected' : '' ?>>Enterprise Software</option>
                                                                <option value="Food & Beverages" <?= ($trlleveledit['industry'] ?? '') == "Food & Beverages" ? 'selected' : '' ?>>Food & Beverages</option>
                                                                <option value="Design" <?= ($trlleveledit['industry'] ?? '') == "Design" ? 'selected' : '' ?>>Design</option>
                                                                <option value="Dating Matrimonial" <?= ($trlleveledit['industry'] ?? '') == "Dating Matrimonial" ? 'selected' : '' ?>>Dating Matrimonial</option>
                                                                <option value="Education" <?= ($trlleveledit['industry'] ?? '') == "Education" ? 'selected' : '' ?>>Education</option>
                                                                <option value="Renewable Energy" <?= ($trlleveledit['industry'] ?? '') == "Renewable Energy" ? 'selected' : '' ?>>Renewable Energy</option>
                                                                <option value="Technology Hardware" <?= ($trlleveledit['industry'] ?? '') == "Technology Hardware" ? 'selected' : '' ?>>Technology Hardware</option>
                                                                <option value="Healthcare & Lifesciences" <?= ($trlleveledit['industry'] ?? '') == "Healthcare & Lifesciences" ? 'selected' : '' ?>>Healthcare & Lifesciences</option>
                                                                <option value="Internet of Things" <?= ($trlleveledit['industry'] ?? '') == "Internet of Things" ? 'selected' : '' ?>>Internet of Things</option>
                                                                <option value="IT Services" <?= ($trlleveledit['industry'] ?? '') == "IT Services" ? 'selected' : '' ?>>IT Services</option>
                                                                <option value="Human Resources" <?= ($trlleveledit['industry'] ?? '') == "Human Resources" ? 'selected' : '' ?>>Human Resources</option>
                                                                <option value="Marketing" <?= ($trlleveledit['industry'] ?? '') == "Marketing" ? 'selected' : '' ?>>Marketing</option>
                                                                <option value="Nanotechnology" <?= ($trlleveledit['industry'] ?? '') == "Nanotechnology" ? 'selected' : '' ?>>Nanotechnology</option>
                                                                <option value="Non- Renewable Energy" <?= ($trlleveledit['industry'] ?? '') == "Non- Renewable Energy" ? 'selected' : '' ?>>Non- Renewable Energy</option>
                                                                <option value="Pets & Animals" <?= ($trlleveledit['industry'] ?? '') == "Pets & Animals" ? 'selected' : '' ?>>Pets & Animals</option>
                                                                <option value="Media & Entertainment" <?= ($trlleveledit['industry'] ?? '') == "Media & Entertainment" ? 'selected' : '' ?>>Media & Entertainment</option>
                                                                <option value="Retail" <?= ($trlleveledit['industry'] ?? '') == "Retail" ? 'selected' : '' ?>>Retail</option>
                                                                <option value="House-Hold Services" <?= ($trlleveledit['industry'] ?? '') == "House-Hold Services" ? 'selected' : '' ?>>House-Hold Services</option>
                                                                <option value="Professional & Commercial Services" <?= ($trlleveledit['industry'] ?? '') == "Professional & Commercial Services" ? 'selected' : '' ?>>Professional & Commercial Services</option>
                                                                <option value="Sports" <?= ($trlleveledit['industry'] ?? '') == "Sports" ? 'selected' : '' ?>>Sports</option>
                                                                <option value="Social Impact" <?= ($trlleveledit['industry'] ?? '') == "Social Impact" ? 'selected' : '' ?>>Social Impact</option>
                                                                <option value="Social Network" <?= ($trlleveledit['industry'] ?? '') == "Social Network" ? 'selected' : '' ?>>Social Network</option>
                                                                <option value="Textiles & Apparel" <?= ($trlleveledit['industry'] ?? '') == "Textiles & Apparel" ? 'selected' : '' ?>>Textiles & Apparel</option>
                                                                <option value="Indic Language Startups" <?= ($trlleveledit['industry'] ?? '') == "Indic Language Startups" ? 'selected' : '' ?>>Indic Language Startups</option>
                                                                <option value="Transportation & Storage" <?= ($trlleveledit['industry'] ?? '') == "Transportation & Storage" ? 'selected' : '' ?>>Transportation & Storage</option>
                                                                <option value="Logistics" <?= ($trlleveledit['industry'] ?? '') == "Logistics" ? 'selected' : '' ?>>Logistics</option>
                                                                <option value="Travel & Tourism" <?= ($trlleveledit['industry'] ?? '') == "Travel & Tourism" ? 'selected' : '' ?>>Travel & Tourism</option>
                                                                <option value="Security Solutions" <?= ($trlleveledit['industry'] ?? '') == "Security Solutions" ? 'selected' : '' ?>>Security Solutions</option>
                                                                <option value="Airport Operations" <?= ($trlleveledit['industry'] ?? '') == "Airport Operations" ? 'selected' : '' ?>>Airport Operations</option>
                                                                <option value="Real Estate" <?= ($trlleveledit['industry'] ?? '') == "Real Estate" ? 'selected' : '' ?>>Real Estate</option>
                                                                <option value="Other Specialty Retailers" <?= ($trlleveledit['industry'] ?? '') == "Other Specialty Retailers" ? 'selected' : '' ?>>Other Specialty Retailers</option>
                                                                <option value="Safety" <?= ($trlleveledit['industry'] ?? '') == "Safety" ? 'selected' : '' ?>>Safety</option>
                                                                <option value="Robotics" <?= ($trlleveledit['industry'] ?? '') == "Robotics" ? 'selected' : '' ?>>Robotics</option>
                                                                <option value="Passenger Experience" <?= ($trlleveledit['industry'] ?? '') == "Passenger Experience" ? 'selected' : '' ?>>Passenger Experience</option>
                                                                <option value="Biotechnology" <?= ($trlleveledit['industry'] ?? '') == "Biotechnology" ? 'selected' : '' ?>>Biotechnology</option>
                                                                <option value="Waste Management" <?= ($trlleveledit['industry'] ?? '') == "Waste Management" ? 'selected' : '' ?>>Waste Management</option>
                                                                <option value="Toys and Games" <?= ($trlleveledit['industry'] ?? '') == "Toys and Games" ? 'selected' : '' ?>>Toys and Games</option>
                                                                <option value="Robotics Technology" <?= ($trlleveledit['industry'] ?? '') == "Robotics Technology" ? 'selected' : '' ?>>Robotics Technology</option>
                                                                <option value="Others" <?= ($trlleveledit['industry'] ?? '') == "Others" ? 'selected' : '' ?>>Others</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group mt-2">
                                                            <label class="mb-md-2"> Sector </label>
                                                            <select class="form-select" name="sector" required>
                                                                <option value=""> Select </option>
                                                                <option value="Big Data" <?= ($trlleveledit['sector'] ?? '') == "Big Data" ? 'selected' : '' ?>>Big Data</option>
                                                                <option value="Business Intelligence" <?= ($trlleveledit['sector'] ?? '') == "Business Intelligence" ? 'selected' : '' ?>>Business Intelligence</option>
                                                                <option value="Data Science" <?= ($trlleveledit['sector'] ?? '') == "Data Science" ? 'selected' : '' ?>>Data Science</option>
                                                                <option value="Others" <?= ($trlleveledit['sector'] ?? '') == "Others" ? 'selected' : '' ?>>Others</option>
                                                                <option value="AdTech" <?= ($trlleveledit['sector'] ?? '') == "AdTech" ? 'selected' : '' ?>>AdTech</option>
                                                                <option value="Online Classified" <?= ($trlleveledit['sector'] ?? '') == "Online Classified" ? 'selected' : '' ?>>Online Classified</option>
                                                                <option value="Auto & Truck Manufacturers" <?= ($trlleveledit['sector'] ?? '') == "Auto & Truck Manufacturers" ? 'selected' : '' ?>>Auto & Truck Manufacturers</option>
                                                                <option value="Auto, Truck & Motorcycle Parts" <?= ($trlleveledit['sector'] ?? '') == "Auto, Truck & Motorcycle Parts" ? 'selected' : '' ?>>Auto, Truck & Motorcycle Parts</option>
                                                                <option value="Electric Vehicles" <?= ($trlleveledit['sector'] ?? '') == "Electric Vehicles" ? 'selected' : '' ?>>Electric Vehicles</option>
                                                                <option value="Tires & Rubber Products" <?= ($trlleveledit['sector'] ?? '') == "Tires & Rubber Products" ? 'selected' : '' ?>>Tires & Rubber Products</option>
                                                                <option value="Art" <?= ($trlleveledit['sector'] ?? '') == "Art" ? 'selected' : '' ?>>Art</option>
                                                                <option value="Handicraft" <?= ($trlleveledit['sector'] ?? '') == "Handicraft" ? 'selected' : '' ?>>Handicraft</option>
                                                                <option value="Photography" <?= ($trlleveledit['sector'] ?? '') == "Photography" ? 'selected' : '' ?>>Photography</option>
                                                                <option value="Agricultural Chemicals" <?= ($trlleveledit['sector'] ?? '') == "Agricultural Chemicals" ? 'selected' : '' ?>>Agricultural Chemicals</option>
                                                                <option value="Commodity Chemicals" <?= ($trlleveledit['sector'] ?? '') == "Commodity Chemicals" ? 'selected' : '' ?>>Commodity Chemicals</option>
                                                                <option value="Diversified Chemicals" <?= ($trlleveledit['sector'] ?? '') == "Diversified Chemicals" ? 'selected' : '' ?>>Diversified Chemicals</option>
                                                                <option value="Specialty Chemicals" <?= ($trlleveledit['sector'] ?? '') == "Specialty Chemicals" ? 'selected' : '' ?>>Specialty Chemicals</option>
                                                                <option value="Integrated Communication Services" <?= ($trlleveledit['sector'] ?? '') == "Integrated Communication Services" ? 'selected' : '' ?>>Integrated Communication Services</option>
                                                                <option value="Network Technology Solutions" <?= ($trlleveledit['sector'] ?? '') == "Network Technology Solutions" ? 'selected' : '' ?>>Network Technology Solutions</option>
                                                                <option value="Wireless" <?= ($trlleveledit['sector'] ?? '') == "Wireless" ? 'selected' : '' ?>>Wireless</option>
                                                                <option value="Construction & Engineering" <?= ($trlleveledit['sector'] ?? '') == "Construction & Engineering" ? 'selected' : '' ?>>Construction & Engineering</option>
                                                                <option value="Construction Materials" <?= ($trlleveledit['sector'] ?? '') == "Construction Materials" ? 'selected' : '' ?>>Construction Materials</option>
                                                                <option value="Construction Supplies & Fixtures" <?= ($trlleveledit['sector'] ?? '') == "Construction Supplies & Fixtures" ? 'selected' : '' ?>>Construction Supplies & Fixtures</option>
                                                                <option value="Homebuilding" <?= ($trlleveledit['sector'] ?? '') == "Homebuilding" ? 'selected' : '' ?>>Homebuilding</option>
                                                                <option value="New-age Construction Technologies" <?= ($trlleveledit['sector'] ?? '') == "New-age Construction Technologies" ? 'selected' : '' ?>>New-age Construction Technologies</option>
                                                                <option value="Agri-Tech" <?= ($trlleveledit['sector'] ?? '') == "Agri-Tech" ? 'selected' : '' ?>>Agri-Tech</option>
                                                                <option value="Animal Husbandry" <?= ($trlleveledit['sector'] ?? '') == "Animal Husbandry" ? 'selected' : '' ?>>Animal Husbandry</option>
                                                                <option value="Dairy Farming" <?= ($trlleveledit['sector'] ?? '') == "Dairy Farming" ? 'selected' : '' ?>>Dairy Farming</option>
                                                                <option value="Fisheries" <?= ($trlleveledit['sector'] ?? '') == "Fisheries" ? 'selected' : '' ?>>Fisheries</option>
                                                                <option value="Food Processing" <?= ($trlleveledit['sector'] ?? '') == "Food Processing" ? 'selected' : '' ?>>Food Processing</option>
                                                                <option value="Horticulture" <?= ($trlleveledit['sector'] ?? '') == "Horticulture" ? 'selected' : '' ?>>Horticulture</option>
                                                                <option value="Organic Agriculture" <?= ($trlleveledit['sector'] ?? '') == "Organic Agriculture" ? 'selected' : '' ?>>Organic Agriculture</option>
                                                                <option value="Aviation & Others" <?= ($trlleveledit['sector'] ?? '') == "Aviation & Others" ? 'selected' : '' ?>>Aviation & Others</option>
                                                                <option value="Defence Equipment" <?= ($trlleveledit['sector'] ?? '') == "Defence Equipment" ? 'selected' : '' ?>>Defence Equipment</option>
                                                                <option value="Drones" <?= ($trlleveledit['sector'] ?? '') == "Drones" ? 'selected' : '' ?>>Drones</option>
                                                                <option value="Space Technology" <?= ($trlleveledit['sector'] ?? '') == "Space Technology" ? 'selected' : '' ?>>Space Technology</option>
                                                                <option value="Machine Learning" <?= ($trlleveledit['sector'] ?? '') == "Machine Learning" ? 'selected' : '' ?>>Machine Learning</option>
                                                                <option value="NLP" <?= ($trlleveledit['sector'] ?? '') == "NLP" ? 'selected' : '' ?>>NLP</option>
                                                                <option value="Clean Tech" <?= ($trlleveledit['sector'] ?? '') == "Clean Tech" ? 'selected' : '' ?>>Clean Tech</option>
                                                                <option value="Waste Management" <?= ($trlleveledit['sector'] ?? '') == "Waste Management" ? 'selected' : '' ?>>Waste Management</option>
                                                                <option value="Event Management" <?= ($trlleveledit['sector'] ?? '') == "Event Management" ? 'selected' : '' ?>>Event Management</option>
                                                                <option value="Weddings" <?= ($trlleveledit['sector'] ?? '') == "Weddings" ? 'selected' : '' ?>>Weddings</option>
                                                                <option value="Apparel" <?= ($trlleveledit['sector'] ?? '') == "Apparel" ? 'selected' : '' ?>>Apparel</option>
                                                                <option value="Fan Merchandise" <?= ($trlleveledit['sector'] ?? '') == "Fan Merchandise" ? 'selected' : '' ?>>Fan Merchandise</option>
                                                                <option value="Fashion Technology" <?= ($trlleveledit['sector'] ?? '') == "Fashion Technology" ? 'selected' : '' ?>>Fashion Technology</option>
                                                                <option value="Jewellery" <?= ($trlleveledit['sector'] ?? '') == "Jewellery" ? 'selected' : '' ?>>Jewellery</option>
                                                                <option value="Lifestyle" <?= ($trlleveledit['sector'] ?? '') == "Lifestyle" ? 'selected' : '' ?>>Lifestyle</option>
                                                                <option value="Accounting" <?= ($trlleveledit['sector'] ?? '') == "Accounting" ? 'selected' : '' ?>>Accounting</option>
                                                                <option value="Advisory" <?= ($trlleveledit['sector'] ?? '') == "Advisory" ? 'selected' : '' ?>>Advisory</option>
                                                                <option value="Billing and Invoicing" <?= ($trlleveledit['sector'] ?? '') == "Billing and Invoicing" ? 'selected' : '' ?>>Billing and Invoicing</option>
                                                                <option value="Bitcoin and Blockchain" <?= ($trlleveledit['sector'] ?? '') == "Bitcoin and Blockchain" ? 'selected' : '' ?>>Bitcoin and Blockchain</option>
                                                                <option value="Business Finance" <?= ($trlleveledit['sector'] ?? '') == "Business Finance" ? 'selected' : '' ?>>Business Finance</option>
                                                                <option value="Crowdfunding" <?= ($trlleveledit['sector'] ?? '') == "Crowdfunding" ? 'selected' : '' ?>>Crowdfunding</option>
                                                                <option value="Foreign Exchange" <?= ($trlleveledit['sector'] ?? '') == "Foreign Exchange" ? 'selected' : '' ?>>Foreign Exchange</option>
                                                                <option value="Insurance" <?= ($trlleveledit['sector'] ?? '') == "Insurance" ? 'selected' : '' ?>>Insurance</option>
                                                                <option value="Microfinance" <?= ($trlleveledit['sector'] ?? '') == "Microfinance" ? 'selected' : '' ?>>Microfinance</option>
                                                                <option value="Mobile wallets Payments" <?= ($trlleveledit['sector'] ?? '') == "Mobile wallets Payments" ? 'selected' : '' ?>>Mobile wallets Payments</option>
                                                                <option value="P2P Lending" <?= ($trlleveledit['sector'] ?? '') == "P2P Lending" ? 'selected' : '' ?>>P2P Lending</option>
                                                                <option value="Payment Platforms" <?= ($trlleveledit['sector'] ?? '') == "Payment Platforms" ? 'selected' : '' ?>>Payment Platforms</option>
                                                                <option value="Personal Finance" <?= ($trlleveledit['sector'] ?? '') == "Personal Finance" ? 'selected' : '' ?>>Personal Finance</option>
                                                                <option value="Point of Sales" <?= ($trlleveledit['sector'] ?? '') == "Point of Sales" ? 'selected' : '' ?>>Point of Sales</option>
                                                                <option value="Trading" <?= ($trlleveledit['sector'] ?? '') == "Trading" ? 'selected' : '' ?>>Trading</option>
                                                                <option value="CXM" <?= ($trlleveledit['sector'] ?? '') == "CXM" ? 'selected' : '' ?>>CXM</option>
                                                                <option value="Cloud" <?= ($trlleveledit['sector'] ?? '') == "Cloud" ? 'selected' : '' ?>>Cloud</option>
                                                                <option value="Collaboration" <?= ($trlleveledit['sector'] ?? '') == "Collaboration" ? 'selected' : '' ?>>Collaboration</option>
                                                                <option value="Customer Support" <?= ($trlleveledit['sector'] ?? '') == "Customer Support" ? 'selected' : '' ?>>Customer Support</option>
                                                                <option value="ERP" <?= ($trlleveledit['sector'] ?? '') == "ERP" ? 'selected' : '' ?>>ERP</option>
                                                                <option value="Enterprise Mobility" <?= ($trlleveledit['sector'] ?? '') == "Enterprise Mobility" ? 'selected' : '' ?>>Enterprise Mobility</option>
                                                                <option value="Location Based" <?= ($trlleveledit['sector'] ?? '') == "Location Based" ? 'selected' : '' ?>>Location Based</option>
                                                                <option value="SCM" <?= ($trlleveledit['sector'] ?? '') == "SCM" ? 'selected' : '' ?>>SCM</option>
                                                                <option value="Food Technology/Food Delivery" <?= ($trlleveledit['sector'] ?? '') == "Food Technology/Food Delivery" ? 'selected' : '' ?>>Food Technology/Food Delivery</option>
                                                                <option value="Microbrewery" <?= ($trlleveledit['sector'] ?? '') == "Microbrewery" ? 'selected' : '' ?>>Microbrewery</option>
                                                                <option value="Restaurants" <?= ($trlleveledit['sector'] ?? '') == "Restaurants" ? 'selected' : '' ?>>Restaurants</option>
                                                                <option value="Industrial Design" <?= ($trlleveledit['sector'] ?? '') == "Industrial Design" ? 'selected' : '' ?>>Industrial Design</option>
                                                                <option value="Web Design" <?= ($trlleveledit['sector'] ?? '') == "Web Design" ? 'selected' : '' ?>>Web Design</option>
                                                                <option value="Coaching" <?= ($trlleveledit['sector'] ?? '') == "Coaching" ? 'selected' : '' ?>>Coaching</option>
                                                                <option value="E-learning" <?= ($trlleveledit['sector'] ?? '') == "E-learning" ? 'selected' : '' ?>>E-learning</option>
                                                                <option value="Education Technology" <?= ($trlleveledit['sector'] ?? '') == "Education Technology" ? 'selected' : '' ?>>Education Technology</option>
                                                                <option value="Skill Development" <?= ($trlleveledit['sector'] ?? '') == "Skill Development" ? 'selected' : '' ?>>Skill Development</option>
                                                                <option value="Manufacture of Electrical Equipment" <?= ($trlleveledit['sector'] ?? '') == "Manufacture of Electrical Equipment" ? 'selected' : '' ?>>Manufacture of Electrical Equipment</option>
                                                                <option value="Manufacture of Machinery and Equipment" <?= ($trlleveledit['sector'] ?? '') == "Manufacture of Machinery and Equipment" ? 'selected' : '' ?>>Manufacture of Machinery and Equipment</option>
                                                                <option value="Renewable Energy Solutions" <?= ($trlleveledit['sector'] ?? '') == "Renewable Energy Solutions" ? 'selected' : '' ?>>Renewable Energy Solutions</option>
                                                                <option value="Renewable Nuclear Energy" <?= ($trlleveledit['sector'] ?? '') == "Renewable Nuclear Energy" ? 'selected' : '' ?>>Renewable Nuclear Energy</option>
                                                                <option value="Renewable Solar Energy" <?= ($trlleveledit['sector'] ?? '') == "Renewable Solar Energy" ? 'selected' : '' ?>>Renewable Solar Energy</option>
                                                                <option value="Renewable Wind Energy" <?= ($trlleveledit['sector'] ?? '') == "Renewable Wind Energy" ? 'selected' : '' ?>>Renewable Wind Energy</option>
                                                                <option value="3d printing" <?= ($trlleveledit['sector'] ?? '') == "3d printing" ? 'selected' : '' ?>>3d printing</option>
                                                                <option value="Electronics" <?= ($trlleveledit['sector'] ?? '') == "Electronics" ? 'selected' : '' ?>>Electronics</option>
                                                                <option value="Embedded" <?= ($trlleveledit['sector'] ?? '') == "Embedded" ? 'selected' : '' ?>>Embedded</option>
                                                                <option value="Manufacturing" <?= ($trlleveledit['sector'] ?? '') == "Manufacturing" ? 'selected' : '' ?>>Manufacturing</option>
                                                                <option value="Semiconductor" <?= ($trlleveledit['sector'] ?? '') == "Semiconductor" ? 'selected' : '' ?>>Semiconductor</option>
                                                                <option value="Biotechnology" <?= ($trlleveledit['sector'] ?? '') == "Biotechnology" ? 'selected' : '' ?>>Biotechnology</option>
                                                                <option value="Health & Wellness" <?= ($trlleveledit['sector'] ?? '') == "Health & Wellness" ? 'selected' : '' ?>>Health & Wellness</option>
                                                                <option value="Healthcare IT" <?= ($trlleveledit['sector'] ?? '') == "Healthcare IT" ? 'selected' : '' ?>>Healthcare IT</option>
                                                                <option value="Healthcare Services" <?= ($trlleveledit['sector'] ?? '') == "Healthcare Services" ? 'selected' : '' ?>>Healthcare Services</option>
                                                                <option value="Healthcare Technology" <?= ($trlleveledit['sector'] ?? '') == "Healthcare Technology" ? 'selected' : '' ?>>Healthcare Technology</option>
                                                                <option value="Medical Devices Biomedical" <?= ($trlleveledit['sector'] ?? '') == "Medical Devices Biomedical" ? 'selected' : '' ?>>Medical Devices Biomedical</option>
                                                                <option value="Pharmaceutical" <?= ($trlleveledit['sector'] ?? '') == "Pharmaceutical" ? 'selected' : '' ?>>Pharmaceutical</option>
                                                                <option value="Manufacturing & Warehouse" <?= ($trlleveledit['sector'] ?? '') == "Manufacturing & Warehouse" ? 'selected' : '' ?>>Manufacturing & Warehouse</option>
                                                                <option value="Smart Home" <?= ($trlleveledit['sector'] ?? '') == "Smart Home" ? 'selected' : '' ?>>Smart Home</option>
                                                                <option value="Wearables" <?= ($trlleveledit['sector'] ?? '') == "Wearables" ? 'selected' : '' ?>>Wearables</option>
                                                                <option value="Application Development" <?= ($trlleveledit['sector'] ?? '') == "Application Development" ? 'selected' : '' ?>>Application Development</option>
                                                                <option value="BPO" <?= ($trlleveledit['sector'] ?? '') == "BPO" ? 'selected' : '' ?>>BPO</option>
                                                                <option value="IT Consulting" <?= ($trlleveledit['sector'] ?? '') == "IT Consulting" ? 'selected' : '' ?>>IT Consulting</option>
                                                                <option value="IT Management" <?= ($trlleveledit['sector'] ?? '') == "IT Management" ? 'selected' : '' ?>>IT Management</option>
                                                                <option value="KPO" <?= ($trlleveledit['sector'] ?? '') == "KPO" ? 'selected' : '' ?>>KPO</option>
                                                                <option value="Product Development" <?= ($trlleveledit['sector'] ?? '') == "Product Development" ? 'selected' : '' ?>>Product Development</option>
                                                                <option value="Project Management" <?= ($trlleveledit['sector'] ?? '') == "Project Management" ? 'selected' : '' ?>>Project Management</option>
                                                                <option value="Testing" <?= ($trlleveledit['sector'] ?? '') == "Testing" ? 'selected' : '' ?>>Testing</option>
                                                                <option value="Web Development" <?= ($trlleveledit['sector'] ?? '') == "Web Development" ? 'selected' : '' ?>>Web Development</option>
                                                                <option value="Internships" <?= ($trlleveledit['sector'] ?? '') == "Internships" ? 'selected' : '' ?>>Internships</option>
                                                                <option value="Recruitment Jobs" <?= ($trlleveledit['sector'] ?? '') == "Recruitment Jobs" ? 'selected' : '' ?>>Recruitment Jobs</option>
                                                                <option value="Skills Assessment" <?= ($trlleveledit['sector'] ?? '') == "Skills Assessment" ? 'selected' : '' ?>>Skills Assessment</option>
                                                                <option value="Talent Management" <?= ($trlleveledit['sector'] ?? '') == "Talent Management" ? 'selected' : '' ?>>Talent Management</option>
                                                                <option value="Training" <?= ($trlleveledit['sector'] ?? '') == "Training" ? 'selected' : '' ?>>Training</option>
                                                                <option value="Branding" <?= ($trlleveledit['sector'] ?? '') == "Branding" ? 'selected' : '' ?>>Branding</option>
                                                                <option value="Digital Marketing (SEO Automation)" <?= ($trlleveledit['sector'] ?? '') == "Digital Marketing (SEO Automation)" ? 'selected' : '' ?>>Digital Marketing (SEO Automation)</option>
                                                                <option value="Discovery" <?= ($trlleveledit['sector'] ?? '') == "Discovery" ? 'selected' : '' ?>>Discovery</option>
                                                                <option value="Loyalty" <?= ($trlleveledit['sector'] ?? '') == "Loyalty" ? 'selected' : '' ?>>Loyalty</option>
                                                                <option value="Market Research" <?= ($trlleveledit['sector'] ?? '') == "Market Research" ? 'selected' : '' ?>>Market Research</option>
                                                                <option value="Sales" <?= ($trlleveledit['sector'] ?? '') == "Sales" ? 'selected' : '' ?>>Sales</option>
                                                                <option value="Oil & Gas Drilling" <?= ($trlleveledit['sector'] ?? '') == "Oil & Gas Drilling" ? 'selected' : '' ?>>Oil & Gas Drilling</option>
                                                                <option value="Oil & Gas Exploration and Production" <?= ($trlleveledit['sector'] ?? '') == "Oil & Gas Exploration and Production" ? 'selected' : '' ?>>Oil & Gas Exploration and Production</option>
                                                                <option value="Oil & Gas Transportation Services" <?= ($trlleveledit['sector'] ?? '') == "Oil & Gas Transportation Services" ? 'selected' : '' ?>>Oil & Gas Transportation Services</option>
                                                                <option value="Oil Related Services and Equipment" <?= ($trlleveledit['sector'] ?? '') == "Oil Related Services and Equipment" ? 'selected' : '' ?>>Oil Related Services and Equipment</option>
                                                                <option value="Digital Media" <?= ($trlleveledit['sector'] ?? '') == "Digital Media" ? 'selected' : '' ?>>Digital Media</option>
                                                                <option value="Digital Media Blogging" <?= ($trlleveledit['sector'] ?? '') == "Digital Media Blogging" ? 'selected' : '' ?>>Digital Media Blogging</option>
                                                                <option value="Digital Media News" <?= ($trlleveledit['sector'] ?? '') == "Digital Media News" ? 'selected' : '' ?>>Digital Media News</option>
                                                                <option value="Digital Media Publishing" <?= ($trlleveledit['sector'] ?? '') == "Digital Media Publishing" ? 'selected' : '' ?>>Digital Media Publishing</option>
                                                                <option value="Digital Media Video" <?= ($trlleveledit['sector'] ?? '') == "Digital Media Video" ? 'selected' : '' ?>>Digital Media Video</option>
                                                                <option value="Entertainment" <?= ($trlleveledit['sector'] ?? '') == "Entertainment" ? 'selected' : '' ?>>Entertainment</option>
                                                                <option value="Movies" <?= ($trlleveledit['sector'] ?? '') == "Movies" ? 'selected' : '' ?>>Movies</option>
                                                                <option value="OOH Media" <?= ($trlleveledit['sector'] ?? '') == "OOH Media" ? 'selected' : '' ?>>OOH Media</option>
                                                                <option value="Social Media" <?= ($trlleveledit['sector'] ?? '') == "Social Media" ? 'selected' : '' ?>>Social Media</option>
                                                                <option value="Comparison Shopping" <?= ($trlleveledit['sector'] ?? '') == "Comparison Shopping" ? 'selected' : '' ?>>Comparison Shopping</option>
                                                                <option value="Retail Technology" <?= ($trlleveledit['sector'] ?? '') == "Retail Technology" ? 'selected' : '' ?>>Retail Technology</option>
                                                                <option value="Social Commerce" <?= ($trlleveledit['sector'] ?? '') == "Social Commerce" ? 'selected' : '' ?>>Social Commerce</option>
                                                                <option value="Baby Care" <?= ($trlleveledit['sector'] ?? '') == "Baby Care" ? 'selected' : '' ?>>Baby Care</option>
                                                                <option value="Home Care" <?= ($trlleveledit['sector'] ?? '') == "Home Care" ? 'selected' : '' ?>>Home Care</option>
                                                                <option value="Laundry" <?= ($trlleveledit['sector'] ?? '') == "Laundry" ? 'selected' : '' ?>>Laundry</option>
                                                                <option value="Personal Care" <?= ($trlleveledit['sector'] ?? '') == "Personal Care" ? 'selected' : '' ?>>Personal Care</option>
                                                                <option value="Business Support Services" <?= ($trlleveledit['sector'] ?? '') == "Business Support Services" ? 'selected' : '' ?>>Business Support Services</option>
                                                                <option value="Business Support Supplies" <?= ($trlleveledit['sector'] ?? '') == "Business Support Supplies" ? 'selected' : '' ?>>Business Support Supplies</option>
                                                                <option value="Commercial Printing Services" <?= ($trlleveledit['sector'] ?? '') == "Commercial Printing Services" ? 'selected' : '' ?>>Commercial Printing Services</option>
                                                                <option value="Employment Services" <?= ($trlleveledit['sector'] ?? '') == "Employment Services" ? 'selected' : '' ?>>Employment Services</option>
                                                                <option value="Environmental Services & Equipment" <?= ($trlleveledit['sector'] ?? '') == "Environmental Services & Equipment" ? 'selected' : '' ?>>Environmental Services & Equipment</option>
                                                                <option value="Professional Information Services" <?= ($trlleveledit['sector'] ?? '') == "Professional Information Services" ? 'selected' : '' ?>>Professional Information Services</option>
                                                                <option value="Fantasy Sports" <?= ($trlleveledit['sector'] ?? '') == "Fantasy Sports" ? 'selected' : '' ?>>Fantasy Sports</option>
                                                                <option value="Sports Promotion and Networking" <?= ($trlleveledit['sector'] ?? '') == "Sports Promotion and Networking" ? 'selected' : '' ?>>Sports Promotion and Networking</option>
                                                                <option value="Corporate Social Responsibility" <?= ($trlleveledit['sector'] ?? '') == "Corporate Social Responsibility" ? 'selected' : '' ?>>Corporate Social Responsibility</option>
                                                                <option value="NGO" <?= ($trlleveledit['sector'] ?? '') == "NGO" ? 'selected' : '' ?>>NGO</option>
                                                                <option value="Apparel & Accessories" <?= ($trlleveledit['sector'] ?? '') == "Apparel & Accessories" ? 'selected' : '' ?>>Apparel & Accessories</option>
                                                                <option value="Leather Footwear" <?= ($trlleveledit['sector'] ?? '') == "Leather Footwear" ? 'selected' : '' ?>>Leather Footwear</option>
                                                                <option value="Leather Textiles Goods" <?= ($trlleveledit['sector'] ?? '') == "Leather Textiles Goods" ? 'selected' : '' ?>>Leather Textiles Goods</option>
                                                                <option value="Non- Leather Footwear" <?= ($trlleveledit['sector'] ?? '') == "Non- Leather Footwear" ? 'selected' : '' ?>>Non- Leather Footwear</option>
                                                                <option value="Non- Leather Textiles Goods" <?= ($trlleveledit['sector'] ?? '') == "Non- Leather Textiles Goods" ? 'selected' : '' ?>>Non- Leather Textiles Goods</option>
                                                                <option value="E-Commerce" <?= ($trlleveledit['sector'] ?? '') == "E-Commerce" ? 'selected' : '' ?>>E-Commerce</option>
                                                                <option value="Education" <?= ($trlleveledit['sector'] ?? '') == "Education" ? 'selected' : '' ?>>Education</option>
                                                                <option value="Media and Entertainment" <?= ($trlleveledit['sector'] ?? '') == "Media and Entertainment" ? 'selected' : '' ?>>Media and Entertainment</option>
                                                                <option value="Natural Language Processing" <?= ($trlleveledit['sector'] ?? '') == "Natural Language Processing" ? 'selected' : '' ?>>Natural Language Processing</option>
                                                                <option value="Utility Services" <?= ($trlleveledit['sector'] ?? '') == "Utility Services" ? 'selected' : '' ?>>Utility Services</option>
                                                                <option value="Freight & Logistics Services" <?= ($trlleveledit['sector'] ?? '') == "Freight & Logistics Services" ? 'selected' : '' ?>>Freight & Logistics Services</option>
                                                                <option value="Passenger Transportation Services" <?= ($trlleveledit['sector'] ?? '') == "Passenger Transportation Services" ? 'selected' : '' ?>>Passenger Transportation Services</option>
                                                                <option value="Traffic Management" <?= ($trlleveledit['sector'] ?? '') == "Traffic Management" ? 'selected' : '' ?>>Traffic Management</option>
                                                                <option value="Transport Infrastructure" <?= ($trlleveledit['sector'] ?? '') == "Transport Infrastructure" ? 'selected' : '' ?>>Transport Infrastructure</option>
                                                                <option value="Experiential Travel" <?= ($trlleveledit['sector'] ?? '') == "Experiential Travel" ? 'selected' : '' ?>>Experiential Travel</option>
                                                                <option value="Facility Management" <?= ($trlleveledit['sector'] ?? '') == "Facility Management" ? 'selected' : '' ?>>Facility Management</option>
                                                                <option value="Holiday Rentals" <?= ($trlleveledit['sector'] ?? '') == "Holiday Rentals" ? 'selected' : '' ?>>Holiday Rentals</option>
                                                                <option value="Hospitality" <?= ($trlleveledit['sector'] ?? '') == "Hospitality" ? 'selected' : '' ?>>Hospitality</option>
                                                                <option value="Hotel" <?= ($trlleveledit['sector'] ?? '') == "Hotel" ? 'selected' : '' ?>>Hotel</option>
                                                                <option value="Ticketing" <?= ($trlleveledit['sector'] ?? '') == "Ticketing" ? 'selected' : '' ?>>Ticketing</option>
                                                                <option value="Wayside Amenities" <?= ($trlleveledit['sector'] ?? '') == "Wayside Amenities" ? 'selected' : '' ?>>Wayside Amenities</option>
                                                                <option value="Cyber Security" <?= ($trlleveledit['sector'] ?? '') == "Cyber Security" ? 'selected' : '' ?>>Cyber Security</option>
                                                                <option value="Home Security solutions" <?= ($trlleveledit['sector'] ?? '') == "Home Security solutions" ? 'selected' : '' ?>>Home Security solutions</option>
                                                                <option value="Public Citizen Security Solutions" <?= ($trlleveledit['sector'] ?? '') == "Public Citizen Security Solutions" ? 'selected' : '' ?>>Public Citizen Security Solutions</option>
                                                                <option value="Coworking Spaces" <?= ($trlleveledit['sector'] ?? '') == "Coworking Spaces" ? 'selected' : '' ?>>Coworking Spaces</option>
                                                                <option value="Housing" <?= ($trlleveledit['sector'] ?? '') == "Housing" ? 'selected' : '' ?>>Housing</option>
                                                                <option value="Auto Vehicles, Parts & Service Retailers" <?= ($trlleveledit['sector'] ?? '') == "Auto Vehicles, Parts & Service Retailers" ? 'selected' : '' ?>>Auto Vehicles, Parts & Service Retailers</option>
                                                                <option value="Computer & Electronics Retailers" <?= ($trlleveledit['sector'] ?? '') == "Computer & Electronics Retailers" ? 'selected' : '' ?>>Computer & Electronics Retailers</option>
                                                                <option value="Home Furnishings Retailers" <?= ($trlleveledit['sector'] ?? '') == "Home Furnishings Retailers" ? 'selected' : '' ?>>Home Furnishings Retailers</option>
                                                                <option value="Home Improvement Products & Services Retailers" <?= ($trlleveledit['sector'] ?? '') == "Home Improvement Products & Services Retailers" ? 'selected' : '' ?>>Home Improvement Products & Services Retailers</option>
                                                                <option value="Personal Security" <?= ($trlleveledit['sector'] ?? '') == "Personal Security" ? 'selected' : '' ?>>Personal Security</option>
                                                                <option value="Robotics Application" <?= ($trlleveledit['sector'] ?? '') == "Robotics Application" ? 'selected' : '' ?>>Robotics Application</option>
                                                                <option value="Robotics Technology" <?= ($trlleveledit['sector'] ?? '') == "Robotics Technology" ? 'selected' : '' ?>>Robotics Technology</option>
                                                                <option value="Physical Toys and Games" <?= ($trlleveledit['sector'] ?? '') == "Physical Toys and Games" ? 'selected' : '' ?>>Physical Toys and Games</option>
                                                                <option value="Virtual Games" <?= ($trlleveledit['sector'] ?? '') == "Virtual Games" ? 'selected' : '' ?>>Virtual Games</option>
                                                                <option value="Agnostic Sector" <?= ($trlleveledit['sector'] ?? '') == "Agnostic Sector" ? 'selected' : '' ?>>Agnostic Sector</option>
                                                                <option value="Deep Tech" <?= ($trlleveledit['sector'] ?? '') == "Deep Tech" ? 'selected' : '' ?>>Deep Tech</option>
                                                                <option value="Smart City" <?= ($trlleveledit['sector'] ?? '') == "Smart City" ? 'selected' : '' ?>>Smart City</option>
                                                                <option value="Blockchain" <?= ($trlleveledit['sector'] ?? '') == "Blockchain" ? 'selected' : '' ?>>Blockchain</option>
                                                                <option value="Digital Health" <?= ($trlleveledit['sector'] ?? '') == "Digital Health" ? 'selected' : '' ?>>Digital Health</option>
                                                                <option value="Water and Sanitation" <?= ($trlleveledit['sector'] ?? '') == "Water and Sanitation" ? 'selected' : '' ?>>Water and Sanitation</option>
                                                                <option value="Circular Economy" <?= ($trlleveledit['sector'] ?? '') == "Circular Economy" ? 'selected' : '' ?>>Circular Economy</option>
                                                                <option value="Technology" <?= ($trlleveledit['sector'] ?? '') == "Technology" ? 'selected' : '' ?>>Technology</option>
                                                                <option value="FMCG" <?= ($trlleveledit['sector'] ?? '') == "FMCG" ? 'selected' : '' ?>>FMCG</option>
                                                                <option value="Data Analysis" <?= ($trlleveledit['sector'] ?? '') == "Data Analysis" ? 'selected' : '' ?>>Data Analysis</option>
                                                                <option value="IOT" <?= ($trlleveledit['sector'] ?? '') == "IOT" ? 'selected' : '' ?>>IOT</option>
                                                                <option value="Legal-Tech" <?= ($trlleveledit['sector'] ?? '') == "Legal-Tech" ? 'selected' : '' ?>>Legal-Tech</option>
                                                                <option value="Unmanned Aerial Vehicles" <?= ($trlleveledit['sector'] ?? '') == "Unmanned Aerial Vehicles" ? 'selected' : '' ?>>Unmanned Aerial Vehicles</option>
                                                                <option value="Infrastructure" <?= ($trlleveledit['sector'] ?? '') == "Infrastructure" ? 'selected' : '' ?>>Infrastructure</option>
                                                                <option value="Edge Computing" <?= ($trlleveledit['sector'] ?? '') == "Edge Computing" ? 'selected' : '' ?>>Edge Computing</option>
                                                                <option value="Child protection" <?= ($trlleveledit['sector'] ?? '') == "Child protection" ? 'selected' : '' ?>>Child protection</option>
                                                                <option value="Sustainable Blue Economy" <?= ($trlleveledit['sector'] ?? '') == "Sustainable Blue Economy" ? 'selected' : '' ?>>Sustainable Blue Economy</option>
                                                                <option value="Ocean Engineering" <?= ($trlleveledit['sector'] ?? '') == "Ocean Engineering" ? 'selected' : '' ?>>Ocean Engineering</option>
                                                                <option value="Marine Tourism" <?= ($trlleveledit['sector'] ?? '') == "Marine Tourism" ? 'selected' : '' ?>>Marine Tourism</option>
                                                                <option value="Coastal Protection" <?= ($trlleveledit['sector'] ?? '') == "Coastal Protection" ? 'selected' : '' ?>>Coastal Protection</option>
                                                                <option value="Ships and Ports Infrastructure" <?= ($trlleveledit['sector'] ?? '') == "Ships and Ports Infrastructure" ? 'selected' : '' ?>>Ships and Ports Infrastructure</option>
                                                                <option value="Manufacturing and Allied Engineering Sectors" <?= ($trlleveledit['sector'] ?? '') == "Manufacturing and Allied Engineering Sectors" ? 'selected' : '' ?>>Manufacturing and Allied Engineering Sectors</option>
                                                                <option value="Assistive Technology" <?= ($trlleveledit['sector'] ?? '') == "Assistive Technology" ? 'selected' : '' ?>>Assistive Technology</option>
                                                                <option value="Assistance Technology" <?= ($trlleveledit['sector'] ?? '') == "Assistance Technology" ? 'selected' : '' ?>>Assistance Technology</option>
                                                                <option value="IOT Machine Learning" <?= ($trlleveledit['sector'] ?? '') == "IOT Machine Learning" ? 'selected' : '' ?>>IOT Machine Learning</option>
                                                                <option value="Smart Home Space Technology Wearables" <?= ($trlleveledit['sector'] ?? '') == "Smart Home Space Technology Wearables" ? 'selected' : '' ?>>Smart Home Space Technology Wearables</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="td1" style="width:100px;">
                                                <label class="mb-md-2">Level 1</label>
                                                <select class="form-select" name="level" id="level" required>
                                                    <option value="">-- Select --</option>
                                                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                                                        <option value="<?= $i ?>" <?= (isset($trlleveledit['level']) && $trlleveledit['level'] == $i) ? 'selected' : (set_value('level') == $i ? 'selected' : '') ?>><?= $i ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="mt-2">
                                                    <label class="mb-md-2">Title</label>
                                                    <input type="text" placeholder="Enter Title" value="<?= $trlleveledit['title'] ?? '' ?>" name="title" class="form-control" maxlength="300">
                                                </div>
                                            </div>
                                            <div class="td1">
                                                <label class="mb-md-2">Sub Levels/Categories</label>
                                                <select class="form-select" name="sublevel" id="sublevel" required>
                                                    <option value="">-- Select --</option>
                                                    <?php for ($i = 1; $i <= 100; $i++) { ?>
                                                        <option value="<?= $i ?>" <?= (isset($trlleveledit['sublevel']) && $trlleveledit['sublevel'] == $i) ? 'selected' : (set_value('sublevel') == $i ? 'selected' : '') ?>><?= $i ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="mt-2">
                                                    <label class="mb-md-2">Title</label>
                                                    <input type="text" placeholder="Enter Title" value="<?= $trlleveledit['subtitle'] ?? '' ?>" name="subtitle" class="form-control" maxlength="300">
                                                </div>
                                            </div>


                                            <div class="td1">
                                                <div class="form-group mb-2">
                                                    <label class="mb-md-2"> Budgeted (Projected) </label>
                                                    <input type="text" class="form-control" value="<?= $trlleveledit['budgeted'] ?? '' ?>" placeholder="Budgeted" name="budgeted">
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label class="mb-md-2"> Timeline </label>
                                                    <input type="text" class="form-control" placeholder="Budgetd Timeline" name="budgetdtimeline" value="<?= $trlleveledit['budgetdtimeline'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="td1">
                                                <div class="form-group mb-2">
                                                    <label class="mb-md-2"> Expenditure (As per actuals) </label>
                                                    <input type="text" class="form-control" placeholder="Expenditure" name="expenditure" value="<?= $trlleveledit['expenditure'] ?? '' ?>">
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label class="mb-md-2"> Timeline </label>
                                                    <input type="text" class="form-control" placeholder="Expenditure Timeline" name="expendituretimeline" value="<?= $trlleveledit['expendituretimeline'] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tr">
                                            <div class="td2">
                                                <div class="form-group my-2">
                                                    <label class="mb-md-2"> Docs Link </label>
                                                    <input type="text" class="form-control" placeholder="Docs Link" name="docslink" value="<?= $trlleveledit['docslink'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="td2">
                                                <div class="form-group my-2">
                                                    <label class="mb-md-2"> Excel Link </label>
                                                    <input type="text" class="form-control" placeholder="Excel Link" name="excellink" value="<?= $trlleveledit['excellink'] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tr">
                                            <div class="td2" style="width:100% !important;">
                                                <div class="form-group my-2">
                                                    <label class="mb-md-2"> Description </label>
                                                    <textarea class="form-control" placeholder="Description/Remark/Note" name="description"><?= $trlleveledit['description'] ?? '' ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <div class="tr">
                                <div class="text-center" style="padding-left:0%; padding-top:10px; padding-bottom:10px;">
                                    <button type="submit" class="btn bg-primary text-white"> Submit </button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>
</div>
</div>


<!-- Shiv Web Developer  -->

<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>

<script>
    $(document).ready(function() {

        var input = document.querySelector('input[name=filter_skills]');
        new Tagify(input);
        // Fetch projects based on company_id
        function fetchProjects(companyId) {
            console.log("Fetching projects");

            // Get preselected project ID (from hidden input)
            const selectedProjectId = $('#selected_project_id').val();

            $.ajax({
                url: '<?= base_url('Home/fetchProjectsForBricks') ?>',
                type: 'POST',
                data: {
                    company_id: companyId
                },
                dataType: 'json',
                success: function(response) {
                    console.log("response", response);
                    $('#project_id').empty();
                    $('#project_id').append('<option value="">Select a project</option>');

                    if (response.success && response.projects.length > 0) {
                        $.each(response.projects, function(index, project) {
                            // Check if this project should be selected
                            const selected = (project.id == selectedProjectId) ? 'selected' : '';
                            $('#project_id').append(
                                '<option value="' + project.id + '" ' + selected + '>' + project.project_name + '</option>'
                            );
                        });
                    } else {
                        $('#project_id').append('<option value="">No projects found</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + error);
                    $('#project_id').empty();
                    $('#project_id').append('<option value="">Error fetching projects</option>');
                }
            });
        }


        $('#company_id').on('change', function() {
            var companyId = $(this).val();
            if (companyId) {
                fetchProjects(companyId);
            } else {
                $('#project_id').empty();
                $('#project_id').append('<option value="">Select a project</option>');
            }
        });

        if ($('#company_id').val()) {
            fetchProjects($('#company_id').val());
        }
    });
</script>