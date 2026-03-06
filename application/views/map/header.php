<style>
    
body{
    background:#f5f7fb;
    font-family: Arial, sans-serif;
}
.branch-btn{
    width:100%;
    padding:18px 10px;
    font-weight:600;
    text-align:center;
    border-radius:12px;
    border:1px solid #dee2e6;
    background:#fff;
    transition:0.3s;
    text-decoration:none;
    color:#000;
    display:block;
}
.branch-btn:hover{
    background:#0d6efd;
    color:#fff;
    transform:translateY(-3px);
    box-shadow:0 8px 18px rgba(0,0,0,0.15);
}


body{
    font-family: Arial;
    background:#f4f6f8;
}
.my-table{
    display:grid;
    grid-template-columns: repeat(18, 1fr);
    gap:8px;
    max-width:1200px;
    margin:auto;
}
.element{
    background:#fff;
    border-radius:6px;
    padding:10px;
    text-align:center;
    box-shadow:0 2px 5px rgba(0,0,0,.1);
    cursor:pointer;
    transition:0.3s;
}
.element:hover{
    transform:scale(1.05);
    background:#dfefff;
}
.atomic{
    font-size:12px;
    color:#555;
}
.symbol{
    font-size:22px;
    font-weight:bold;
}
.name{
    font-size:12px;
}
a{
    text-decoration:none;
    color:#000;
}

.action-section{
    margin:50px auto;
    text-align:center;
}

.action-section h3{
    margin-bottom:20px;
    font-size:24px;
    color:#333;
}

.action-buttons{
    display:flex;
    justify-content:center;
    gap:20px;
    flex-wrap:wrap;
}

.btn-action{
    padding:14px 30px;
    border-radius:30px;
    text-decoration:none;
    color:#fff;
    font-size:16px;
    font-weight:600;
    transition:0.3s;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

.btn-action:hover{
    transform:translateY(-5px);
    box-shadow:0 8px 20px rgba(0,0,0,0.3);
}

/* Button Colors */
.industry{
    background:linear-gradient(135deg, #007bff, #0056b3);
}

.degree{
    background:linear-gradient(135deg, #28a745, #1e7e34);
}

.research{
    background:linear-gradient(135deg, #fd7e14, #e8590c);
}

/* Basic Menu Styling */
body {
    font-family: Arial, sans-serif;
}

.nav-wrapper nav {
    background-color: #333;
}

.nav-wrapper nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-wrapper nav ul li {
    position: relative;
}

.nav-wrapper nav > ul > li {
    display: inline-block;
}

.nav-wrapper nav ul li a {
    display: block;
    padding: 10px 20px;
    color: #fff;
    text-decoration: none;
}

.nav-wrapper nav ul li a:hover {
    background-color: #555;
}

/* Submenu */
.nav-wrapper nav ul li ul {
    display: none;
    position: absolute;
    background-color: #444;
    top: 100%;
    left: 0;
    min-width: 200px;
    z-index: 1000;
}

.nav-wrapper nav ul li:hover > ul {
    display: block;
}

.nav-wrapper nav ul li ul li {
    display: block;
}

.nav-wrapper nav ul li ul li a:hover {
    background-color: #666;
}

/* Nested submenu */
.nav-wrapper nav ul li ul li ul {
    left: 100%;
    top: 0;
}

#map { height: 90vh; width: 100%; }

.branch-btn{
    width:100%;
    padding:18px 10px;
    font-weight:600;
    text-align:center;
    border-radius:12px;
    border:1px solid #dee2e6;
    background:#fff;
    transition:0.3s;
    text-decoration:none;
    color:#000;
    display:block;
}
.branch-btn:hover{
    background:#0d6efd;
    color:#fff;
    transform:translateY(-3px);
    box-shadow:0 8px 18px rgba(0,0,0,0.15);
}


/* =========================
   MARKET RESEARCH GRID
========================= */
.market-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 16px;

    max-width: 100%;
    overflow-x: hidden;   /* 🔥 unwanted scroll fix */
    box-sizing: border-box;
}

/* Anchor fix */
.market-grid a {
    display: block;
    text-decoration: none;
    color: inherit;
}

/* Card */
.market-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 10px;
    text-align: center;

    max-width: 100%;
    overflow: hidden;
    box-sizing: border-box;

    transition: 0.3s;
}

.market-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 22px rgba(0,0,0,0.15);
}

/* Text wrap fix */
.market-card .name {
    font-size: 12px;
    font-weight: 600;
    line-height: 1;
    word-break: break-word;
    overflow-wrap: break-word;
}
/* 

.population-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(10px, 1fr));
    gap: 2px;
}

.population-block {
    width: 10px;
    height: 10px;
    background: #0d6efd;
    border: 1px solid black;
} */

.population-grid-container {
    display: grid;
    grid-template-columns: 40px repeat(10, 12px); /* 40px for Y-axis + 80 blocks */
}
.population-grid {
    display: grid;
    grid-template-columns: repeat(10, 12px); /* 80 blocks in X-axis */
    gap: 5px;
}
/* .population-block {
    width: 12px;
    height: 12px;
    border: 1px solid black;
    box-sizing: border-box;
} */

/* Axis labels */
/* .x-axis-label, .y-axis-label {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 10px;
}
.y-axis-label {
    width: 40px;
    height: 12px;
}
.x-axis-label {
    height: 20px;
}
.axis-row {
    display: flex;
} */


.page-depth{
    background:#f5f7fa;
    padding:14px;
    margin:15px;
    border-radius:10px;
    box-shadow:0 2px 6px rgba(0,0,0,0.1);
}

.depth-up a{
    display:block;
    font-size:14px;
    color:#0d6efd;
    text-decoration:none;
    margin-bottom:6px;
}

.depth-up a:hover{
    text-decoration:underline;
}

.depth-current{
    margin-top:8px;
    padding-top:8px;
    border-top:1px dashed #ccc;
    font-weight:600;
    font-size:15px;
}
.grid-layout-full{
    grid-column: 2/4;
}
.breadcrumb-item+.breadcrumb-item::before{
    content: '/' !important;
}
/* Mobile */
@media(max-width:600px){
    .page-depth{
        margin:10px;
    }
}

</style>

<?php

$menu = [
    "0.Map" => "company/map",
    "1.School" => "company/school",
    // "School" => [
    //     "Physics" => "school_physics",
    //     "Chemistry" => "school_chemistry",
    //     "Maths" => "school_maths",
    //     "Biology" => "school_biology",
    //     "Evolution and Timeline" => "evolution_and_timeline"
    // ],
    "2.Degrees" => [
        "2.1 Bachelors" => "company/degree/bachelors",
        "2.2 Masters" => "company/degree/masters",
        "2.3 PHD" => "company/degree/phd",
        "2.4 Professional / Diploma / Certificate" => "company/degree/professional"
    ],
    "3.Industries" => [
        "Science" => [
            "Physics" => "industries_science_physics",
            "Chemistry" => "industries_science_chemistry",
            "Maths" => "industries_science_maths",
            "Biology" => "industries_science_biology"
        ],
        "3.1 Department" => "company/industries/department",
    ],
    "4.Market Research" => [
        "Market Research" => "company/market-research"

    ],
    "5.Manufacturing" => [

    ],
    "6.Production" => [
    ],
    "7.Portable Municipality ( City )" => [

    ],
    "8.GOI" => [
        "8.1 Ministry of Education" => "#",
        "8.2 Ministry of Health" => "#",
        "8.3 Ministry of Finance" => "#",
        "8.4 Ministry of Space" => "#",
        "8.5 Ministry of Science and Technology" => "#",
        "8.6 Ministry of Neuclear" => "#",
        "8.7 Ministry of Defence" => "#",
    ],
    "9.Reverse The Process" => "company/reverse-process",
];



?>

<div class="nav-wrapper">
    <nav>
        <ul>
            <?php
            function renderMenu($menu)
            {
                foreach ($menu as $key => $value) {
                    echo "<li>";
                    if (is_array($value)) {
                        // Parent menu item: you can keep href="#" or assign URL if needed
                        echo "<a href='#'>$key</a>";
                        echo "<ul>";
                        renderMenu($value); // recursive call
                        echo "</ul>";
                    } else {
                        // Leaf node: $value is the URL
                        $url = base_url($value);
                        echo "<a href='$url'>$key</a>";
                    }
                    echo "</li>";
                }
            }


            renderMenu($menu);
            ?>
        </ul>
    </nav>

</div>

<?php
// function pageDepth($items){
//     $reverse = array_reverse($items);
//     $total = count($items);

//     echo '<div class="page-depth">';

//     // UP LINKS (PAGE NUMBERS)
//     echo '<div class="depth-up">';
//     foreach ($reverse as $k => $item) {
//         if ($k === 0) continue; // current page skip

//         $pageNo = $total - $k;
//         echo '<a href="'.$item['url'].'">↑ Page '.$pageNo.'</a>';
//     }
//     echo '</div>';

//     // CURRENT PAGE NUMBER
//     echo '<div class="depth-current">';
//     echo 'Page '.$total;
//     echo '</div>';

//     echo '</div>';
// }
?>