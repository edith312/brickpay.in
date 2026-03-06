<?php $this->load->view('includes/header'); ?>

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

    #wordCounter {
        font-size: 12px;
    }

    .counter {
        font-size: 13px;
        margin-top: 5px;
        color: #555;
    }
</style>

<style>
    select:disabled {
        background-color: #e9ecef;
        /* light gray blur */
        color: #6c757d;
    }
</style>
<!-- Shiv Web Developer  -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body pt-0 mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header py-3 p-0 pt-0 bg-transparent border-bottom-0 m-auto">
                <div class="card mb-4">
                    <div class="card-body mx-4">
                        <div>
                            <h4 class="mb-md-5 mb-3 text-center"> S1 - Brain Dating - (Idea's Pay!) </h4>
                        </div>
                        <!-- Section Enabled Disable -->
                        <div id="questionBox1" class="p-md-5 pt-md-3 pb-md-3 dotted-bottom ps-md-3" style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                            <div class="d-flex align-items-center">
                                <label class="me-2">S<sub>1</sub> - <span style="font-size:12px; color:red;">*</span> Brain Dating - (Idea's Pay!) </label>
                                <label class="switch me-2">
                                    <input type="checkbox" class="enableSwitch" data-index="1" name="show_form_1" checked>
                                    <span class="slider round"></span>
                                </label>
                                <span class="enableDisableLabel" data-index="1">Yes</span> <br />
                            </div>
                        </div>
                    </div>


                    <div id="conditionalForm1" class="container" style="display: block;">
                        <div id="ideasPaySearchFilter" class="ms-4">
                            <form method="POST" action="" class="flex flex-col gap-4" enctype="multipart/form-data">
                                <input type="hidden" name="edit_id" value="<?= isset($editData['id']) ? $editData['id'] : '' ?>">
                                <div class="bg-white row g-0 p-0 m-0 mt-md-3">
                                    <div class="mb-3 col-md-3">
                                        <div class="form-group">
                                            <label class="mb-md-2"> Industry</label>
                                            <select class="form-select" name="industry" required>
                                                <option value=""> Select </option>
                                                <option value="Analytics" <?= ($editData['industry'] ?? '') == "Analytics" ? 'selected' : '' ?>>Analytics</option>
                                                <option value="Advertising" <?= ($editData['industry'] ?? '') == "Advertising" ? 'selected' : '' ?>>Advertising</option>
                                                <option value="Architecture Interior Design" <?= ($editData['industry'] ?? '') == "Architecture Interior Design" ? 'selected' : '' ?>>Architecture Interior Design</option>
                                                <option value="AR VR (Augmented + Virtual Reality)" <?= ($editData['industry'] ?? '') == "AR VR (Augmented + Virtual Reality)" ? 'selected' : '' ?>>AR VR (Augmented + Virtual Reality)</option>
                                                <option value="Automotive" <?= ($editData['industry'] ?? '') == "Automotive" ? 'selected' : '' ?>>Automotive</option>
                                                <option value="Art & Photography" <?= ($editData['industry'] ?? '') == "Art & Photography" ? 'selected' : '' ?>>Art & Photography</option>
                                                <option value="Animation" <?= ($editData['industry'] ?? '') == "Animation" ? 'selected' : '' ?>>Animation</option>
                                                <option value="Chemicals" <?= ($editData['industry'] ?? '') == "Chemicals" ? 'selected' : '' ?>>Chemicals</option>
                                                <option value="Computer Vision" <?= ($editData['industry'] ?? '') == "Computer Vision" ? 'selected' : '' ?>>Computer Vision</option>
                                                <option value="Telecommunication & Networking" <?= ($editData['industry'] ?? '') == "Telecommunication & Networking" ? 'selected' : '' ?>>Telecommunication & Networking</option>
                                                <option value="Construction" <?= ($editData['industry'] ?? '') == "Construction" ? 'selected' : '' ?>>Construction</option>
                                                <option value="Agriculture" <?= ($editData['industry'] ?? '') == "Agriculture" ? 'selected' : '' ?>>Agriculture</option>
                                                <option value="Aeronautics Aerospace & Defence" <?= ($editData['industry'] ?? '') == "Aeronautics Aerospace & Defence" ? 'selected' : '' ?>>Aeronautics Aerospace & Defence</option>
                                                <option value="AI" <?= ($editData['industry'] ?? '') == "AI" ? 'selected' : '' ?>>AI</option>
                                                <option value="Green Technology" <?= ($editData['industry'] ?? '') == "Green Technology" ? 'selected' : '' ?>>Green Technology</option>
                                                <option value="Events" <?= ($editData['industry'] ?? '') == "Events" ? 'selected' : '' ?>>Events</option>
                                                <option value="Fashion" <?= ($editData['industry'] ?? '') == "Fashion" ? 'selected' : '' ?>>Fashion</option>
                                                <option value="Finance Technology" <?= ($editData['industry'] ?? '') == "Finance Technology" ? 'selected' : '' ?>>Finance Technology</option>
                                                <option value="Enterprise Software" <?= ($editData['industry'] ?? '') == "Enterprise Software" ? 'selected' : '' ?>>Enterprise Software</option>
                                                <option value="Food & Beverages" <?= ($editData['industry'] ?? '') == "Food & Beverages" ? 'selected' : '' ?>>Food & Beverages</option>
                                                <option value="Design" <?= ($editData['industry'] ?? '') == "Design" ? 'selected' : '' ?>>Design</option>
                                                <option value="Dating Matrimonial" <?= ($editData['industry'] ?? '') == "Dating Matrimonial" ? 'selected' : '' ?>>Dating Matrimonial</option>
                                                <option value="Education" <?= ($editData['industry'] ?? '') == "Education" ? 'selected' : '' ?>>Education</option>
                                                <option value="Renewable Energy" <?= ($editData['industry'] ?? '') == "Renewable Energy" ? 'selected' : '' ?>>Renewable Energy</option>
                                                <option value="Technology Hardware" <?= ($editData['industry'] ?? '') == "Technology Hardware" ? 'selected' : '' ?>>Technology Hardware</option>
                                                <option value="Healthcare & Lifesciences" <?= ($editData['industry'] ?? '') == "Healthcare & Lifesciences" ? 'selected' : '' ?>>Healthcare & Lifesciences</option>
                                                <option value="Internet of Things" <?= ($editData['industry'] ?? '') == "Internet of Things" ? 'selected' : '' ?>>Internet of Things</option>
                                                <option value="IT Services" <?= ($editData['industry'] ?? '') == "IT Services" ? 'selected' : '' ?>>IT Services</option>
                                                <option value="Human Resources" <?= ($editData['industry'] ?? '') == "Human Resources" ? 'selected' : '' ?>>Human Resources</option>
                                                <option value="Marketing" <?= ($editData['industry'] ?? '') == "Marketing" ? 'selected' : '' ?>>Marketing</option>
                                                <option value="Nanotechnology" <?= ($editData['industry'] ?? '') == "Nanotechnology" ? 'selected' : '' ?>>Nanotechnology</option>
                                                <option value="Non- Renewable Energy" <?= ($editData['industry'] ?? '') == "Non- Renewable Energy" ? 'selected' : '' ?>>Non- Renewable Energy</option>
                                                <option value="Pets & Animals" <?= ($editData['industry'] ?? '') == "Pets & Animals" ? 'selected' : '' ?>>Pets & Animals</option>
                                                <option value="Media & Entertainment" <?= ($editData['industry'] ?? '') == "Media & Entertainment" ? 'selected' : '' ?>>Media & Entertainment</option>
                                                <option value="Retail" <?= ($editData['industry'] ?? '') == "Retail" ? 'selected' : '' ?>>Retail</option>
                                                <option value="House-Hold Services" <?= ($editData['industry'] ?? '') == "House-Hold Services" ? 'selected' : '' ?>>House-Hold Services</option>
                                                <option value="Professional & Commercial Services" <?= ($editData['industry'] ?? '') == "Professional & Commercial Services" ? 'selected' : '' ?>>Professional & Commercial Services</option>
                                                <option value="Sports" <?= ($editData['industry'] ?? '') == "Sports" ? 'selected' : '' ?>>Sports</option>
                                                <option value="Social Impact" <?= ($editData['industry'] ?? '') == "Social Impact" ? 'selected' : '' ?>>Social Impact</option>
                                                <option value="Social Network" <?= ($editData['industry'] ?? '') == "Social Network" ? 'selected' : '' ?>>Social Network</option>
                                                <option value="Textiles & Apparel" <?= ($editData['industry'] ?? '') == "Textiles & Apparel" ? 'selected' : '' ?>>Textiles & Apparel</option>
                                                <option value="Indic Language Startups" <?= ($editData['industry'] ?? '') == "Indic Language Startups" ? 'selected' : '' ?>>Indic Language Startups</option>
                                                <option value="Transportation & Storage" <?= ($editData['industry'] ?? '') == "Transportation & Storage" ? 'selected' : '' ?>>Transportation & Storage</option>
                                                <option value="Logistics" <?= ($editData['industry'] ?? '') == "Logistics" ? 'selected' : '' ?>>Logistics</option>
                                                <option value="Travel & Tourism" <?= ($editData['industry'] ?? '') == "Travel & Tourism" ? 'selected' : '' ?>>Travel & Tourism</option>
                                                <option value="Security Solutions" <?= ($editData['industry'] ?? '') == "Security Solutions" ? 'selected' : '' ?>>Security Solutions</option>
                                                <option value="Airport Operations" <?= ($editData['industry'] ?? '') == "Airport Operations" ? 'selected' : '' ?>>Airport Operations</option>
                                                <option value="Real Estate" <?= ($editData['industry'] ?? '') == "Real Estate" ? 'selected' : '' ?>>Real Estate</option>
                                                <option value="Other Specialty Retailers" <?= ($editData['industry'] ?? '') == "Other Specialty Retailers" ? 'selected' : '' ?>>Other Specialty Retailers</option>
                                                <option value="Safety" <?= ($editData['industry'] ?? '') == "Safety" ? 'selected' : '' ?>>Safety</option>
                                                <option value="Robotics" <?= ($editData['industry'] ?? '') == "Robotics" ? 'selected' : '' ?>>Robotics</option>
                                                <option value="Passenger Experience" <?= ($editData['industry'] ?? '') == "Passenger Experience" ? 'selected' : '' ?>>Passenger Experience</option>
                                                <option value="Biotechnology" <?= ($editData['industry'] ?? '') == "Biotechnology" ? 'selected' : '' ?>>Biotechnology</option>
                                                <option value="Waste Management" <?= ($editData['industry'] ?? '') == "Waste Management" ? 'selected' : '' ?>>Waste Management</option>
                                                <option value="Others" <?= ($editData['industry'] ?? '') == "Others" ? 'selected' : '' ?>>Others</option>
                                                <option value="Toys and Games" <?= ($editData['industry'] ?? '') == "Toys and Games" ? 'selected' : '' ?>>Toys and Games</option>
                                                <option value="AIAR VR (Augmented + Virtual Reality)" <?= ($editData['industry'] ?? '') == "AIAR VR (Augmented + Virtual Reality)" ? 'selected' : '' ?>>AIAR VR (Augmented + Virtual Reality)</option>
                                                <option value="Robotics Technology" <?= ($editData['industry'] ?? '') == "Robotics Technology" ? 'selected' : '' ?>>Robotics Technology</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-white p-0 g-0 m-0">
                                    <div class="mb-3 col-md-3">
                                        <div class="form-group">
                                            <label class="mb-md-2"> Sector </label>
                                            <select class="form-select" name="sector" required>
                                                <option value=""> Select </option>
                                                <option value="Big Data" <?= ($editData['sector'] ?? '') == "Big Data" ? 'selected' : '' ?>>Big Data</option>
                                                <option value="Business Intelligence" <?= ($editData['sector'] ?? '') == "Business Intelligence" ? 'selected' : '' ?>>Business Intelligence</option>
                                                <option value="Data Science" <?= ($editData['sector'] ?? '') == "Data Science" ? 'selected' : '' ?>>Data Science</option>
                                                <option value="Others" <?= ($editData['sector'] ?? '') == "Others" ? 'selected' : '' ?>>Others</option>
                                                <option value="AdTech" <?= ($editData['sector'] ?? '') == "AdTech" ? 'selected' : '' ?>>AdTech</option>
                                                <option value="Online Classified" <?= ($editData['sector'] ?? '') == "Online Classified" ? 'selected' : '' ?>>Online Classified</option>
                                                <option value="Auto & Truck Manufacturers" <?= ($editData['sector'] ?? '') == "Auto & Truck Manufacturers" ? 'selected' : '' ?>>Auto & Truck Manufacturers</option>
                                                <option value="Auto, Truck & Motorcycle Parts" <?= ($editData['sector'] ?? '') == "Auto, Truck & Motorcycle Parts" ? 'selected' : '' ?>>Auto, Truck & Motorcycle Parts</option>
                                                <option value="Electric Vehicles" <?= ($editData['sector'] ?? '') == "Electric Vehicles" ? 'selected' : '' ?>>Electric Vehicles</option>
                                                <option value="Tires & Rubber Products" <?= ($editData['sector'] ?? '') == "Tires & Rubber Products" ? 'selected' : '' ?>>Tires & Rubber Products</option>
                                                <option value="Art" <?= ($editData['sector'] ?? '') == "Art" ? 'selected' : '' ?>>Art</option>
                                                <option value="Handicraft" <?= ($editData['sector'] ?? '') == "Handicraft" ? 'selected' : '' ?>>Handicraft</option>
                                                <option value="Photography" <?= ($editData['sector'] ?? '') == "Photography" ? 'selected' : '' ?>>Photography</option>
                                                <option value="Agricultural Chemicals" <?= ($editData['sector'] ?? '') == "Agricultural Chemicals" ? 'selected' : '' ?>>Agricultural Chemicals</option>
                                                <option value="Commodity Chemicals" <?= ($editData['sector'] ?? '') == "Commodity Chemicals" ? 'selected' : '' ?>>Commodity Chemicals</option>
                                                <option value="Diversified Chemicals" <?= ($editData['sector'] ?? '') == "Diversified Chemicals" ? 'selected' : '' ?>>Diversified Chemicals</option>
                                                <option value="Specialty Chemicals" <?= ($editData['sector'] ?? '') == "Specialty Chemicals" ? 'selected' : '' ?>>Specialty Chemicals</option>
                                                <option value="Integrated Communication Services" <?= ($editData['sector'] ?? '') == "Integrated Communication Services" ? 'selected' : '' ?>>Integrated Communication Services</option>
                                                <option value="Network Technology Solutions" <?= ($editData['sector'] ?? '') == "Network Technology Solutions" ? 'selected' : '' ?>>Network Technology Solutions</option>
                                                <option value="Wireless" <?= ($editData['sector'] ?? '') == "Wireless" ? 'selected' : '' ?>>Wireless</option>
                                                <option value="Construction & Engineering" <?= ($editData['sector'] ?? '') == "Construction & Engineering" ? 'selected' : '' ?>>Construction & Engineering</option>
                                                <option value="Construction Materials" <?= ($editData['sector'] ?? '') == "Construction Materials" ? 'selected' : '' ?>>Construction Materials</option>
                                                <option value="Construction Supplies & Fixtures" <?= ($editData['sector'] ?? '') == "Construction Supplies & Fixtures" ? 'selected' : '' ?>>Construction Supplies & Fixtures</option>
                                                <option value="Homebuilding" <?= ($editData['sector'] ?? '') == "Homebuilding" ? 'selected' : '' ?>>Homebuilding</option>
                                                <option value="New-age Construction Technologies" <?= ($editData['sector'] ?? '') == "New-age Construction Technologies" ? 'selected' : '' ?>>New-age Construction Technologies</option>
                                                <option value="Agri-Tech" <?= ($editData['sector'] ?? '') == "Agri-Tech" ? 'selected' : '' ?>>Agri-Tech</option>
                                                <option value="Animal Husbandry" <?= ($editData['sector'] ?? '') == "Animal Husbandry" ? 'selected' : '' ?>>Animal Husbandry</option>
                                                <option value="Dairy Farming" <?= ($editData['sector'] ?? '') == "Dairy Farming" ? 'selected' : '' ?>>Dairy Farming</option>
                                                <option value="Fisheries" <?= ($editData['sector'] ?? '') == "Fisheries" ? 'selected' : '' ?>>Fisheries</option>
                                                <option value="Food Processing" <?= ($editData['sector'] ?? '') == "Food Processing" ? 'selected' : '' ?>>Food Processing</option>
                                                <option value="Horticulture" <?= ($editData['sector'] ?? '') == "Horticulture" ? 'selected' : '' ?>>Horticulture</option>
                                                <option value="Organic Agriculture" <?= ($editData['sector'] ?? '') == "Organic Agriculture" ? 'selected' : '' ?>>Organic Agriculture</option>
                                                <option value="Aviation & Others" <?= ($editData['sector'] ?? '') == "Aviation & Others" ? 'selected' : '' ?>>Aviation & Others</option>
                                                <option value="Defence Equipment" <?= ($editData['sector'] ?? '') == "Defence Equipment" ? 'selected' : '' ?>>Defence Equipment</option>
                                                <option value="Drones" <?= ($editData['sector'] ?? '') == "Drones" ? 'selected' : '' ?>>Drones</option>
                                                <option value="Space Technology" <?= ($editData['sector'] ?? '') == "Space Technology" ? 'selected' : '' ?>>Space Technology</option>
                                                <option value="Machine Learning" <?= ($editData['sector'] ?? '') == "Machine Learning" ? 'selected' : '' ?>>Machine Learning</option>
                                                <option value="NLP" <?= ($editData['sector'] ?? '') == "NLP" ? 'selected' : '' ?>>NLP</option>
                                                <option value="Clean Tech" <?= ($editData['sector'] ?? '') == "Clean Tech" ? 'selected' : '' ?>>Clean Tech</option>
                                                <option value="Waste Management" <?= ($editData['sector'] ?? '') == "Waste Management" ? 'selected' : '' ?>>Waste Management</option>
                                                <option value="Event Management" <?= ($editData['sector'] ?? '') == "Event Management" ? 'selected' : '' ?>>Event Management</option>
                                                <option value="Weddings" <?= ($editData['sector'] ?? '') == "Weddings" ? 'selected' : '' ?>>Weddings</option>
                                                <option value="Apparel" <?= ($editData['sector'] ?? '') == "Apparel" ? 'selected' : '' ?>>Apparel</option>
                                                <option value="Fan Merchandise" <?= ($editData['sector'] ?? '') == "Fan Merchandise" ? 'selected' : '' ?>>Fan Merchandise</option>
                                                <option value="Fashion Technology" <?= ($editData['sector'] ?? '') == "Fashion Technology" ? 'selected' : '' ?>>Fashion Technology</option>
                                                <option value="Jewellery" <?= ($editData['sector'] ?? '') == "Jewellery" ? 'selected' : '' ?>>Jewellery</option>
                                                <option value="Lifestyle" <?= ($editData['sector'] ?? '') == "Lifestyle" ? 'selected' : '' ?>>Lifestyle</option>
                                                <option value="Accounting" <?= ($editData['sector'] ?? '') == "Accounting" ? 'selected' : '' ?>>Accounting</option>
                                                <option value="Advisory" <?= ($editData['sector'] ?? '') == "Advisory" ? 'selected' : '' ?>>Advisory</option>
                                                <option value="Billing and Invoicing" <?= ($editData['sector'] ?? '') == "Billing and Invoicing" ? 'selected' : '' ?>>Billing and Invoicing</option>
                                                <option value="Bitcoin and Blockchain" <?= ($editData['sector'] ?? '') == "Bitcoin and Blockchain" ? 'selected' : '' ?>>Bitcoin and Blockchain</option>
                                                <option value="Business Finance" <?= ($editData['sector'] ?? '') == "Business Finance" ? 'selected' : '' ?>>Business Finance</option>
                                                <option value="Crowdfunding" <?= ($editData['sector'] ?? '') == "Crowdfunding" ? 'selected' : '' ?>>Crowdfunding</option>
                                                <option value="Foreign Exchange" <?= ($editData['sector'] ?? '') == "Foreign Exchange" ? 'selected' : '' ?>>Foreign Exchange</option>
                                                <option value="Insurance" <?= ($editData['sector'] ?? '') == "Insurance" ? 'selected' : '' ?>>Insurance</option>
                                                <option value="Microfinance" <?= ($editData['sector'] ?? '') == "Microfinance" ? 'selected' : '' ?>>Microfinance</option>
                                                <option value="Mobile wallets Payments" <?= ($editData['sector'] ?? '') == "Mobile wallets Payments" ? 'selected' : '' ?>>Mobile wallets Payments</option>
                                                <option value="P2P Lending" <?= ($editData['sector'] ?? '') == "P2P Lending" ? 'selected' : '' ?>>P2P Lending</option>
                                                <option value="Payment Platforms" <?= ($editData['sector'] ?? '') == "Payment Platforms" ? 'selected' : '' ?>>Payment Platforms</option>
                                                <option value="Personal Finance" <?= ($editData['sector'] ?? '') == "Personal Finance" ? 'selected' : '' ?>>Personal Finance</option>
                                                <option value="Point of Sales" <?= ($editData['sector'] ?? '') == "Point of Sales" ? 'selected' : '' ?>>Point of Sales</option>
                                                <option value="Trading" <?= ($editData['sector'] ?? '') == "Trading" ? 'selected' : '' ?>>Trading</option>
                                                <option value="CXM" <?= ($editData['sector'] ?? '') == "CXM" ? 'selected' : '' ?>>CXM</option>
                                                <option value="Cloud" <?= ($editData['sector'] ?? '') == "Cloud" ? 'selected' : '' ?>>Cloud</option>
                                                <option value="Collaboration" <?= ($editData['sector'] ?? '') == "Collaboration" ? 'selected' : '' ?>>Collaboration</option>
                                                <option value="Customer Support" <?= ($editData['sector'] ?? '') == "Customer Support" ? 'selected' : '' ?>>Customer Support</option>
                                                <option value="ERP" <?= ($editData['sector'] ?? '') == "ERP" ? 'selected' : '' ?>>ERP</option>
                                                <option value="Enterprise Mobility" <?= ($editData['sector'] ?? '') == "Enterprise Mobility" ? 'selected' : '' ?>>Enterprise Mobility</option>
                                                <option value="Location Based" <?= ($editData['sector'] ?? '') == "Location Based" ? 'selected' : '' ?>>Location Based</option>
                                                <option value="SCM" <?= ($editData['sector'] ?? '') == "SCM" ? 'selected' : '' ?>>SCM</option>
                                                <option value="Food Technology/Food Delivery" <?= ($editData['sector'] ?? '') == "Food Technology/Food Delivery" ? 'selected' : '' ?>>Food Technology/Food Delivery</option>
                                                <option value="Microbrewery" <?= ($editData['sector'] ?? '') == "Microbrewery" ? 'selected' : '' ?>>Microbrewery</option>
                                                <option value="Restaurants" <?= ($editData['sector'] ?? '') == "Restaurants" ? 'selected' : '' ?>>Restaurants</option>
                                                <option value="Industrial Design" <?= ($editData['sector'] ?? '') == "Industrial Design" ? 'selected' : '' ?>>Industrial Design</option>
                                                <option value="Web Design" <?= ($editData['sector'] ?? '') == "Web Design" ? 'selected' : '' ?>>Web Design</option>
                                                <option value="Coaching" <?= ($editData['sector'] ?? '') == "Coaching" ? 'selected' : '' ?>>Coaching</option>
                                                <option value="E-learning" <?= ($editData['sector'] ?? '') == "E-learning" ? 'selected' : '' ?>>E-learning</option>
                                                <option value="Education Technology" <?= ($editData['sector'] ?? '') == "Education Technology" ? 'selected' : '' ?>>Education Technology</option>
                                                <option value="Skill Development" <?= ($editData['sector'] ?? '') == "Skill Development" ? 'selected' : '' ?>>Skill Development</option>
                                                <option value="Manufacture of Electrical Equipment" <?= ($editData['sector'] ?? '') == "Manufacture of Electrical Equipment" ? 'selected' : '' ?>>Manufacture of Electrical Equipment</option>
                                                <option value="Manufacture of Machinery and Equipment" <?= ($editData['sector'] ?? '') == "Manufacture of Machinery and Equipment" ? 'selected' : '' ?>>Manufacture of Machinery and Equipment</option>
                                                <option value="Renewable Energy Solutions" <?= ($editData['sector'] ?? '') == "Renewable Energy Solutions" ? 'selected' : '' ?>>Renewable Energy Solutions</option>
                                                <option value="Renewable Nuclear Energy" <?= ($editData['sector'] ?? '') == "Renewable Nuclear Energy" ? 'selected' : '' ?>>Renewable Nuclear Energy</option>
                                                <option value="Renewable Solar Energy" <?= ($editData['sector'] ?? '') == "Renewable Solar Energy" ? 'selected' : '' ?>>Renewable Solar Energy</option>
                                                <option value="Renewable Wind Energy" <?= ($editData['sector'] ?? '') == "Renewable Wind Energy" ? 'selected' : '' ?>>Renewable Wind Energy</option>
                                                <option value="3d printing" <?= ($editData['sector'] ?? '') == "3d printing" ? 'selected' : '' ?>>3d printing</option>
                                                <option value="Electronics" <?= ($editData['sector'] ?? '') == "Electronics" ? 'selected' : '' ?>>Electronics</option>
                                                <option value="Embedded" <?= ($editData['sector'] ?? '') == "Embedded" ? 'selected' : '' ?>>Embedded</option>
                                                <option value="Manufacturing" <?= ($editData['sector'] ?? '') == "Manufacturing" ? 'selected' : '' ?>>Manufacturing</option>
                                                <option value="Semiconductor" <?= ($editData['sector'] ?? '') == "Semiconductor" ? 'selected' : '' ?>>Semiconductor</option>
                                                <option value="Biotechnology" <?= ($editData['sector'] ?? '') == "Biotechnology" ? 'selected' : '' ?>>Biotechnology</option>
                                                <option value="Health & Wellness" <?= ($editData['sector'] ?? '') == "Health & Wellness" ? 'selected' : '' ?>>Health & Wellness</option>
                                                <option value="Healthcare IT" <?= ($editData['sector'] ?? '') == "Healthcare IT" ? 'selected' : '' ?>>Healthcare IT</option>
                                                <option value="Healthcare Services" <?= ($editData['sector'] ?? '') == "Healthcare Services" ? 'selected' : '' ?>>Healthcare Services</option>
                                                <option value="Healthcare Technology" <?= ($editData['sector'] ?? '') == "Healthcare Technology" ? 'selected' : '' ?>>Healthcare Technology</option>
                                                <option value="Medical Devices Biomedical" <?= ($editData['sector'] ?? '') == "Medical Devices Biomedical" ? 'selected' : '' ?>>Medical Devices Biomedical</option>
                                                <option value="Pharmaceutical" <?= ($editData['sector'] ?? '') == "Pharmaceutical" ? 'selected' : '' ?>>Pharmaceutical</option>
                                                <option value="Manufacturing & Warehouse" <?= ($editData['sector'] ?? '') == "Manufacturing & Warehouse" ? 'selected' : '' ?>>Manufacturing & Warehouse</option>
                                                <option value="Smart Home" <?= ($editData['sector'] ?? '') == "Smart Home" ? 'selected' : '' ?>>Smart Home</option>
                                                <option value="Wearables" <?= ($editData['sector'] ?? '') == "Wearables" ? 'selected' : '' ?>>Wearables</option>
                                                <option value="Application Development" <?= ($editData['sector'] ?? '') == "Application Development" ? 'selected' : '' ?>>Application Development</option>
                                                <option value="BPO" <?= ($editData['sector'] ?? '') == "BPO" ? 'selected' : '' ?>>BPO</option>
                                                <option value="IT Consulting" <?= ($editData['sector'] ?? '') == "IT Consulting" ? 'selected' : '' ?>>IT Consulting</option>
                                                <option value="IT Management" <?= ($editData['sector'] ?? '') == "IT Management" ? 'selected' : '' ?>>IT Management</option>
                                                <option value="KPO" <?= ($editData['sector'] ?? '') == "KPO" ? 'selected' : '' ?>>KPO</option>
                                                <option value="Product Development" <?= ($editData['sector'] ?? '') == "Product Development" ? 'selected' : '' ?>>Product Development</option>
                                                <option value="Project Management" <?= ($editData['sector'] ?? '') == "Project Management" ? 'selected' : '' ?>>Project Management</option>
                                                <option value="Testing" <?= ($editData['sector'] ?? '') == "Testing" ? 'selected' : '' ?>>Testing</option>
                                                <option value="Web Development" <?= ($editData['sector'] ?? '') == "Web Development" ? 'selected' : '' ?>>Web Development</option>
                                                <option value="Internships" <?= ($editData['sector'] ?? '') == "Internships" ? 'selected' : '' ?>>Internships</option>
                                                <option value="Recruitment Jobs" <?= ($editData['sector'] ?? '') == "Recruitment Jobs" ? 'selected' : '' ?>>Recruitment Jobs</option>
                                                <option value="Skills Assessment" <?= ($editData['sector'] ?? '') == "Skills Assessment" ? 'selected' : '' ?>>Skills Assessment</option>
                                                <option value="Talent Management" <?= ($editData['sector'] ?? '') == "Talent Management" ? 'selected' : '' ?>>Talent Management</option>
                                                <option value="Training" <?= ($editData['sector'] ?? '') == "Training" ? 'selected' : '' ?>>Training</option>
                                                <option value="Branding" <?= ($editData['sector'] ?? '') == "Branding" ? 'selected' : '' ?>>Branding</option>
                                                <option value="Digital Marketing (SEO Automation)" <?= ($editData['sector'] ?? '') == "Digital Marketing (SEO Automation)" ? 'selected' : '' ?>>Digital Marketing (SEO Automation)</option>
                                                <option value="Discovery" <?= ($editData['sector'] ?? '') == "Discovery" ? 'selected' : '' ?>>Discovery</option>
                                                <option value="Loyalty" <?= ($editData['sector'] ?? '') == "Loyalty" ? 'selected' : '' ?>>Loyalty</option>
                                                <option value="Market Research" <?= ($editData['sector'] ?? '') == "Market Research" ? 'selected' : '' ?>>Market Research</option>
                                                <option value="Sales" <?= ($editData['sector'] ?? '') == "Sales" ? 'selected' : '' ?>>Sales</option>
                                                <option value="Oil & Gas Drilling" <?= ($editData['sector'] ?? '') == "Oil & Gas Drilling" ? 'selected' : '' ?>>Oil & Gas Drilling</option>
                                                <option value="Oil & Gas Exploration and Production" <?= ($editData['sector'] ?? '') == "Oil & Gas Exploration and Production" ? 'selected' : '' ?>>Oil & Gas Exploration and Production</option>
                                                <option value="Oil & Gas Transportation Services" <?= ($editData['sector'] ?? '') == "Oil & Gas Transportation Services" ? 'selected' : '' ?>>Oil & Gas Transportation Services</option>
                                                <option value="Oil Related Services and Equipment" <?= ($editData['sector'] ?? '') == "Oil Related Services and Equipment" ? 'selected' : '' ?>>Oil Related Services and Equipment</option>
                                                <option value="Digital Media" <?= ($editData['sector'] ?? '') == "Digital Media" ? 'selected' : '' ?>>Digital Media</option>
                                                <option value="Digital Media Blogging" <?= ($editData['sector'] ?? '') == "Digital Media Blogging" ? 'selected' : '' ?>>Digital Media Blogging</option>
                                                <option value="Digital Media News" <?= ($editData['sector'] ?? '') == "Digital Media News" ? 'selected' : '' ?>>Digital Media News</option>
                                                <option value="Digital Media Publishing" <?= ($editData['sector'] ?? '') == "Digital Media Publishing" ? 'selected' : '' ?>>Digital Media Publishing</option>
                                                <option value="Digital Media Video" <?= ($editData['sector'] ?? '') == "Digital Media Video" ? 'selected' : '' ?>>Digital Media Video</option>
                                                <option value="Entertainment" <?= ($editData['sector'] ?? '') == "Entertainment" ? 'selected' : '' ?>>Entertainment</option>
                                                <option value="Movies" <?= ($editData['sector'] ?? '') == "Movies" ? 'selected' : '' ?>>Movies</option>
                                                <option value="OOH Media" <?= ($editData['sector'] ?? '') == "OOH Media" ? 'selected' : '' ?>>OOH Media</option>
                                                <option value="Social Media" <?= ($editData['sector'] ?? '') == "Social Media" ? 'selected' : '' ?>>Social Media</option>
                                                <option value="Comparison Shopping" <?= ($editData['sector'] ?? '') == "Comparison Shopping" ? 'selected' : '' ?>>Comparison Shopping</option>
                                                <option value="Retail Technology" <?= ($editData['sector'] ?? '') == "Retail Technology" ? 'selected' : '' ?>>Retail Technology</option>
                                                <option value="Social Commerce" <?= ($editData['sector'] ?? '') == "Social Commerce" ? 'selected' : '' ?>>Social Commerce</option>
                                                <option value="Baby Care" <?= ($editData['sector'] ?? '') == "Baby Care" ? 'selected' : '' ?>>Baby Care</option>
                                                <option value="Home Care" <?= ($editData['sector'] ?? '') == "Home Care" ? 'selected' : '' ?>>Home Care</option>
                                                <option value="Laundry" <?= ($editData['sector'] ?? '') == "Laundry" ? 'selected' : '' ?>>Laundry</option>
                                                <option value="Personal Care" <?= ($editData['sector'] ?? '') == "Personal Care" ? 'selected' : '' ?>>Personal Care</option>
                                                <option value="Business Support Services" <?= ($editData['sector'] ?? '') == "Business Support Services" ? 'selected' : '' ?>>Business Support Services</option>
                                                <option value="Business Support Supplies" <?= ($editData['sector'] ?? '') == "Business Support Supplies" ? 'selected' : '' ?>>Business Support Supplies</option>
                                                <option value="Commercial Printing Services" <?= ($editData['sector'] ?? '') == "Commercial Printing Services" ? 'selected' : '' ?>>Commercial Printing Services</option>
                                                <option value="Employment Services" <?= ($editData['sector'] ?? '') == "Employment Services" ? 'selected' : '' ?>>Employment Services</option>
                                                <option value="Environmental Services & Equipment" <?= ($editData['sector'] ?? '') == "Environmental Services & Equipment" ? 'selected' : '' ?>>Environmental Services & Equipment</option>
                                                <option value="Professional Information Services" <?= ($editData['sector'] ?? '') == "Professional Information Services" ? 'selected' : '' ?>>Professional Information Services</option>
                                                <option value="Fantasy Sports" <?= ($editData['sector'] ?? '') == "Fantasy Sports" ? 'selected' : '' ?>>Fantasy Sports</option>
                                                <option value="Sports Promotion and Networking" <?= ($editData['sector'] ?? '') == "Sports Promotion and Networking" ? 'selected' : '' ?>>Sports Promotion and Networking</option>
                                                <option value="Corporate Social Responsibility" <?= ($editData['sector'] ?? '') == "Corporate Social Responsibility" ? 'selected' : '' ?>>Corporate Social Responsibility</option>
                                                <option value="NGO" <?= ($editData['sector'] ?? '') == "NGO" ? 'selected' : '' ?>>NGO</option>
                                                <option value="Apparel & Accessories" <?= ($editData['sector'] ?? '') == "Apparel & Accessories" ? 'selected' : '' ?>>Apparel & Accessories</option>
                                                <option value="Leather Footwear" <?= ($editData['sector'] ?? '') == "Leather Footwear" ? 'selected' : '' ?>>Leather Footwear</option>
                                                <option value="Leather Textiles Goods" <?= ($editData['sector'] ?? '') == "Leather Textiles Goods" ? 'selected' : '' ?>>Leather Textiles Goods</option>
                                                <option value="Non- Leather Footwear" <?= ($editData['sector'] ?? '') == "Non- Leather Footwear" ? 'selected' : '' ?>>Non- Leather Footwear</option>
                                                <option value="Non- Leather Textiles Goods" <?= ($editData['sector'] ?? '') == "Non- Leather Textiles Goods" ? 'selected' : '' ?>>Non- Leather Textiles Goods</option>
                                                <option value="E-Commerce" <?= ($editData['sector'] ?? '') == "E-Commerce" ? 'selected' : '' ?>>E-Commerce</option>
                                                <option value="Education" <?= ($editData['sector'] ?? '') == "Education" ? 'selected' : '' ?>>Education</option>
                                                <option value="Media and Entertainment" <?= ($editData['sector'] ?? '') == "Media and Entertainment" ? 'selected' : '' ?>>Media and Entertainment</option>
                                                <option value="Natural Language Processing" <?= ($editData['sector'] ?? '') == "Natural Language Processing" ? 'selected' : '' ?>>Natural Language Processing</option>
                                                <option value="Utility Services" <?= ($editData['sector'] ?? '') == "Utility Services" ? 'selected' : '' ?>>Utility Services</option>
                                                <option value="Freight & Logistics Services" <?= ($editData['sector'] ?? '') == "Freight & Logistics Services" ? 'selected' : '' ?>>Freight & Logistics Services</option>
                                                <option value="Passenger Transportation Services" <?= ($editData['sector'] ?? '') == "Passenger Transportation Services" ? 'selected' : '' ?>>Passenger Transportation Services</option>
                                                <option value="Traffic Management" <?= ($editData['sector'] ?? '') == "Traffic Management" ? 'selected' : '' ?>>Traffic Management</option>
                                                <option value="Transport Infrastructure" <?= ($editData['sector'] ?? '') == "Transport Infrastructure" ? 'selected' : '' ?>>Transport Infrastructure</option>
                                                <option value="Experiential Travel" <?= ($editData['sector'] ?? '') == "Experiential Travel" ? 'selected' : '' ?>>Experiential Travel</option>
                                                <option value="Facility Management" <?= ($editData['sector'] ?? '') == "Facility Management" ? 'selected' : '' ?>>Facility Management</option>
                                                <option value="Holiday Rentals" <?= ($editData['sector'] ?? '') == "Holiday Rentals" ? 'selected' : '' ?>>Holiday Rentals</option>
                                                <option value="Hospitality" <?= ($editData['sector'] ?? '') == "Hospitality" ? 'selected' : '' ?>>Hospitality</option>
                                                <option value="Hotel" <?= ($editData['sector'] ?? '') == "Hotel" ? 'selected' : '' ?>>Hotel</option>
                                                <option value="Ticketing" <?= ($editData['sector'] ?? '') == "Ticketing" ? 'selected' : '' ?>>Ticketing</option>
                                                <option value="Wayside Amenities" <?= ($editData['sector'] ?? '') == "Wayside Amenities" ? 'selected' : '' ?>>Wayside Amenities</option>
                                                <option value="Cyber Security" <?= ($editData['sector'] ?? '') == "Cyber Security" ? 'selected' : '' ?>>Cyber Security</option>
                                                <option value="Home Security solutions" <?= ($editData['sector'] ?? '') == "Home Security solutions" ? 'selected' : '' ?>>Home Security solutions</option>
                                                <option value="Public Citizen Security Solutions" <?= ($editData['sector'] ?? '') == "Public Citizen Security Solutions" ? 'selected' : '' ?>>Public Citizen Security Solutions</option>
                                                <option value="Coworking Spaces" <?= ($editData['sector'] ?? '') == "Coworking Spaces" ? 'selected' : '' ?>>Coworking Spaces</option>
                                                <option value="Housing" <?= ($editData['sector'] ?? '') == "Housing" ? 'selected' : '' ?>>Housing</option>
                                                <option value="Auto Vehicles, Parts & Service Retailers" <?= ($editData['sector'] ?? '') == "Auto Vehicles, Parts & Service Retailers" ? 'selected' : '' ?>>Auto Vehicles, Parts & Service Retailers</option>
                                                <option value="Computer & Electronics Retailers" <?= ($editData['sector'] ?? '') == "Computer & Electronics Retailers" ? 'selected' : '' ?>>Computer & Electronics Retailers</option>
                                                <option value="Home Furnishings Retailers" <?= ($editData['sector'] ?? '') == "Home Furnishings Retailers" ? 'selected' : '' ?>>Home Furnishings Retailers</option>
                                                <option value="Home Improvement Products & Services Retailers" <?= ($editData['sector'] ?? '') == "Home Improvement Products & Services Retailers" ? 'selected' : '' ?>>Home Improvement Products & Services Retailers</option>
                                                <option value="Personal Security" <?= ($editData['sector'] ?? '') == "Personal Security" ? 'selected' : '' ?>>Personal Security</option>
                                                <option value="Robotics Application" <?= ($editData['sector'] ?? '') == "Robotics Application" ? 'selected' : '' ?>>Robotics Application</option>
                                                <option value="Robotics Technology" <?= ($editData['sector'] ?? '') == "Robotics Technology" ? 'selected' : '' ?>>Robotics Technology</option>
                                                <option value="Physical Toys and Games" <?= ($editData['sector'] ?? '') == "Physical Toys and Games" ? 'selected' : '' ?>>Physical Toys and Games</option>
                                                <option value="Virtual Games" <?= ($editData['sector'] ?? '') == "Virtual Games" ? 'selected' : '' ?>>Virtual Games</option>
                                                <option value="Agnostic Sector" <?= ($editData['sector'] ?? '') == "Agnostic Sector" ? 'selected' : '' ?>>Agnostic Sector</option>
                                                <option value="Deep Tech" <?= ($editData['sector'] ?? '') == "Deep Tech" ? 'selected' : '' ?>>Deep Tech</option>
                                                <option value="Smart City" <?= ($editData['sector'] ?? '') == "Smart City" ? 'selected' : '' ?>>Smart City</option>
                                                <option value="Blockchain" <?= ($editData['sector'] ?? '') == "Blockchain" ? 'selected' : '' ?>>Blockchain</option>
                                                <option value="Digital Health" <?= ($editData['sector'] ?? '') == "Digital Health" ? 'selected' : '' ?>>Digital Health</option>
                                                <option value="Water and Sanitation" <?= ($editData['sector'] ?? '') == "Water and Sanitation" ? 'selected' : '' ?>>Water and Sanitation</option>
                                                <option value="Circular Economy" <?= ($editData['sector'] ?? '') == "Circular Economy" ? 'selected' : '' ?>>Circular Economy</option>
                                                <option value="Technology" <?= ($editData['sector'] ?? '') == "Technology" ? 'selected' : '' ?>>Technology</option>
                                                <option value="FMCG" <?= ($editData['sector'] ?? '') == "FMCG" ? 'selected' : '' ?>>FMCG</option>
                                                <option value="Data Analysis" <?= ($editData['sector'] ?? '') == "Data Analysis" ? 'selected' : '' ?>>Data Analysis</option>
                                                <option value="IOT" <?= ($editData['sector'] ?? '') == "IOT" ? 'selected' : '' ?>>IOT</option>
                                                <option value="Legal-Tech" <?= ($editData['sector'] ?? '') == "Legal-Tech" ? 'selected' : '' ?>>Legal-Tech</option>
                                                <option value="Unmanned Aerial Vehicles" <?= ($editData['sector'] ?? '') == "Unmanned Aerial Vehicles" ? 'selected' : '' ?>>Unmanned Aerial Vehicles</option>
                                                <option value="Infrastructure" <?= ($editData['sector'] ?? '') == "Infrastructure" ? 'selected' : '' ?>>Infrastructure</option>
                                                <option value="Edge Computing" <?= ($editData['sector'] ?? '') == "Edge Computing" ? 'selected' : '' ?>>Edge Computing</option>
                                                <option value="Child protection" <?= ($editData['sector'] ?? '') == "Child protection" ? 'selected' : '' ?>>Child protection</option>
                                                <option value="Sustainable Blue Economy" <?= ($editData['sector'] ?? '') == "Sustainable Blue Economy" ? 'selected' : '' ?>>Sustainable Blue Economy</option>
                                                <option value="Ocean Engineering" <?= ($editData['sector'] ?? '') == "Ocean Engineering" ? 'selected' : '' ?>>Ocean Engineering</option>
                                                <option value="Marine Tourism" <?= ($editData['sector'] ?? '') == "Marine Tourism" ? 'selected' : '' ?>>Marine Tourism</option>
                                                <option value="Coastal Protection" <?= ($editData['sector'] ?? '') == "Coastal Protection" ? 'selected' : '' ?>>Coastal Protection</option>
                                                <option value="Ships and Ports Infrastructure" <?= ($editData['sector'] ?? '') == "Ships and Ports Infrastructure" ? 'selected' : '' ?>>Ships and Ports Infrastructure</option>
                                                <option value="Manufacturing and Allied Engineering Sectors" <?= ($editData['sector'] ?? '') == "Manufacturing and Allied Engineering Sectors" ? 'selected' : '' ?>>Manufacturing and Allied Engineering Sectors</option>
                                                <option value="Assistive Technology" <?= ($editData['sector'] ?? '') == "Assistive Technology" ? 'selected' : '' ?>>Assistive Technology</option>
                                                <option value="Assistance Technology" <?= ($editData['sector'] ?? '') == "Assistance Technology" ? 'selected' : '' ?>>Assistance Technology</option>
                                                <option value="IOT Machine Learning" <?= ($editData['sector'] ?? '') == "IOT Machine Learning" ? 'selected' : '' ?>>IOT Machine Learning</option>
                                                <option value="Smart Home Space Technology Wearables" <?= ($editData['sector'] ?? '') == "Smart Home Space Technology Wearables" ? 'selected' : '' ?>>Smart Home Space Technology Wearables</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-white p-0 g-0 m-0">
                                    <div class="mb-3 col-md-3">
                                        <div class="form-group">
                                            <label class="mb-md-2"> Money Making Opportunity </label>
                                            <input type="text" placeholder="Market Opportunity" name="moneymakingopportunity" value="<?= isset($editData['moneymakingopportunity']) ? $editData['moneymakingopportunity'] : '' ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-white p-0 g-0 m-0">
                                    <div class="mb-3 col-md-3">
                                        <div class="form-group">
                                            <!-- <label class="mb-md-2"> Micro Seductive Statment </label> -->
                                            <textarea placeholder="Micro Seductive Statment" name="microseductivestatement" class="form-control" id="myTextarea" required><?= isset($editData['microseductivestatement']) ? $editData['microseductivestatement'] : '' ?></textarea>
                                            <div id="wordCounter" class="counter">0 / 60 words</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-2">
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary bg-primary text-white px-5"> <?= isset($editData['id']) ? 'Update' : 'Post' ?> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>



                    <!-- DATA SHOWCASE HERE -->
                    <div class="card-body mx-4 mt-4">
                        <div>
                            <h4 class="mb-md-5 mb-3 text-center"> S1 - Responses - Brain Dating - (Idea's Pay!) </h4>
                        </div>
                        <!-- Section Enabled Disable -->
                        <div id="questionBox2" class="p-md-5 pt-md-3 pb-md-3 dotted-bottom ps-md-3" style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                            <div class="d-flex align-items-center">
                                <label class="me-2">S<sub>1</sub> - <span style="font-size:12px; color:red;">*</span> Responses - Brain Dating - (Idea's Pay!)</label>
                                <label class="switch me-2">
                                    <input type="checkbox" class="enableSwitch" data-index="2" name="show_form_2">
                                    <span class="slider round"></span>
                                </label>
                                <span class="enableDisableLabel" data-index="2">Yes</span> <br />
                            </div>
                        </div>
                    </div>

                    <div id="conditionalForm2" class="container" style="display:none;">
                        <div class="trlphdpostdoc_listview">
                            <div class="tables table-bordered w-100">
                                <div class="thead">
                                    <div class="tr">
                                        <div style="width:100%; margin-left:35%;"> <strong> S1 - Responses - Brain Dating - (Idea's Pay!) </strong> </div>
                                    </div>
                                </div>
                                <div class="tbody">
                                    <?php
                                    if (!empty($getIdeaPayData)) {
                                        $i = 1;
                                        foreach ($getIdeaPayData as $IdeaPay) {
                                            $brickOwnerDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $IdeaPay['user_id']]);
                                    ?>

                                            <div class="mt-2" style="float: right;"> <strong> Date :</strong> <?= $IdeaPay['created_date'] ?> </div>
                                            <div class="tr">
                                                <div class="td1" style="width:80px !important;"> <?= $i++ ?> </div>
                                                <div class="td2">
                                                    <div class="table-resonsive col-md-6 UserProfileTable card" style="width:460px;">
                                                        <div>
                                                            <?php

                                                            if (!empty($brickOwnerDetails)):
                                                            ?>
                                                                <div class="col-md-12 p-2" style="z-index:5;">
                                                                    <div onclick="window.location.href='<?= base_url('company/user_preview?id=' . $brickOwnerDetails['id']) ?>'" class="team-member-card">
                                                                        <img src="<?= !empty($brickOwnerDetails['user_image']) ? base_url() . 'uploads/user_profile/' . $brickOwnerDetails['user_image'] : base_url() . 'assets/user-icon.png' ?>" alt="Profile Picture">
                                                                        <div class="team-member-info">
                                                                            <h6><?= $brickOwnerDetails['name'] ?: 'No Name' ?></h6>
                                                                            <div><strong>Email:</strong> <a href="mailto:<?= $brickOwnerDetails['email'] ?: 'N/A' ?>" style="width:200px;"><?= $brickOwnerDetails['email'] ?: 'N/A' ?></a></div>
                                                                            <div><strong>Phone:</strong> <?= $brickOwnerDetails['phone'] ?: 'N/A' ?></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="td1">
                                                    <strong>Industry:</strong> <?= $IdeaPay['industry'] ?>
                                                    <hr>
                                                    <strong>Sector:</strong> <?= $IdeaPay['sector'] ?>
                                                </div>

                                                <div class="td1">
                                                    <strong>Money Making Opportunity:</strong> <br /> <?= $IdeaPay['moneymakingopportunity'] ?>
                                                    <hr>
                                                    <strong>Microseductive Statement:</strong> <br /> <?= $IdeaPay['microseductivestatement'] ?>
                                                </div>

                                                <div class="td1" style="width:80px !important;">
                                                    <?php if ($brickOwnerDetails['id'] == sessionId('freelancer_id')) { ?>

                                                        <a href="<?= base_url('company/idea?edit_id=' . $IdeaPay['id']) ?>" class="me-2">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <a href="<?= base_url('company/idea-trash?id=' . $IdeaPay['id']) ?>" title="Delete Brain Dating" class="text-danger" onclick="return confirm('Are you sure you want to delete this Brain Dating?');">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    <?php } else {
                                                        '';
                                                    } ?>
                                                </div>
                                            </div>

                                    <?php };
                                    } else {
                                        echo  ' <p class="text-center"> List Data Not Found! </p>';
                                    }
                                    ?>
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
    const textarea = document.getElementById("myTextarea");
    const counter = document.getElementById("wordCounter");
    const maxWords = 60;

    textarea.addEventListener("input", () => {
        // Split words by spaces, filter out empty strings
        let words = textarea.value.trim().split(/\s+/).filter(Boolean);
        let wordCount = words.length;

        // If word count exceeds limit
        if (wordCount > maxWords) {
            // Trim extra words
            textarea.value = words.slice(0, maxWords).join(" ");
            wordCount = maxWords;
        }

        // Update counter display
        counter.textContent = `${wordCount} / ${maxWords} words`;
        counter.classList.toggle("exceeded", wordCount >= maxWords);
    });
</script>

<!-- Shiv Web Developer  -->
<script>
    // Toggle section visibility
    document.querySelectorAll('.enableSwitch').forEach((switchElement) => {
        switchElement.addEventListener('change', function() {
            const index = this.getAttribute('data-index');
            const label = document.querySelector('.enableDisableLabel[data-index="' + index + '"]');
            const form = document.getElementById('conditionalForm' + index);
            const questionBox = document.getElementById('questionBox' + index);
            if (this.checked) {
                form.style.display = 'block';
                questionBox.style.borderBottom = 'none';
                label.textContent = 'Yes';
            } else {
                form.style.display = 'none';
                questionBox.style.borderBottom = '2px dotted #ccc';
                label.textContent = 'No';
            }
        });
    });

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>