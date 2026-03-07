<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background-color: #fff;
        font-family: Arial, sans-serif;
    }

    .login-container {
        max-width: 520px;
        padding: 2rem;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 2px 5px #4aa09f;
        width: 100%;
    }

    .bvite {
        color: #1e8d9c
    }

    .heading {
        color: #0d5774;
        font-weight: 700;
        margin-top: 20px;

    }

    .otp-button {
        background-color: #1e8d9c;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: bold;
        transition: background-color 0.3s, color 0.3s;
        cursor: pointer;
    }

    .otp-button:hover {
        background-color: #167382;
        color: #e0e0e0;
    }

    .google-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: white;
        color: #555;
        border: 1px solid #ddd;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s, box-shadow 0.3s;
        width: 100%;
        max-width: 300px;
        margin: 10px auto;
        text-decoration: none;
    }

    .google-btn:hover {
        background-color: #f0f0f0;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .google-btn img {
        margin-right: 8px;
        width: 20px;
        height: 20px;
    }

    .text-muted a {
        text-decoration: none;
        color: #1e8d9c;
    }

    .text-muted a:hover {
        text-decoration: underline;
    }

    .form {
        padding-top: 30px;
    }

    .form-control {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        transition: border-color 0.3s;
        width: 100%;
    }

    .form-control:focus,
    .form-control:hover {
        border-color: #1e8d9c;
        outline: none;
        box-shadow: 0 0 5px rgba(30, 141, 156, 0.2);
    }
</style>
<style>
    .form-inner {
        overflow: hidden;

        &.loading {
            &::after {
                content: '';
                width: 100%;
                height: 100%;
                background: #ffffff70;
                position: absolute;
                inset: 0;
                z-index: 9999999;
                display: block;
            }

            .progress {
                display: block;
            }
        }
    }

    .progress {
        height: 7px;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        right: 0s;
        background: linear-gradient(#d8a600 0 0),
            linear-gradient(#d8a600 0 0),
            #dbdcef;
        background-size: 60% 100%;
        background-repeat: no-repeat;
        animation: progress-7x9cg2 2.4000000000000004s infinite;
        display: none;
    }

    @keyframes progress-7x9cg2 {
        0% {
            background-position: -150% 0, -150% 0;
        }

        66% {
            background-position: 250% 0, -150% 0;
        }

        100% {
            background-position: 250% 0, 250% 0;
        }
    }

    .selection-box {
        /* width: 70rem; */
        margin: 0px auto;
    }

    @media (max-width: 991px) {
        .selection-box {
            width: 100%;
        }
    }


    /* Updated by @Shiv Web Developer */
    .loginPageContainer {
        /* padding: 10px; */
    }

    .loginPageContainer img {
        border-radius: 6px;
        width: 100%;
        /* height:463px; */
    }

    .row {
        display: flex;
        align-items: flex-start !important;
        position: relative;
        margin: 20px 0;
    }

    .contentPresentationContainer h1 {
        font-size: 39px;
        font-weight: 800;
        color: #08c9e2ff;
    }
</style>
<style>
.initiative-content {
    overflow: hidden;
    max-height: 0;
    transition: max-height 0.4s ease;
}

.show-content {
    max-height: 3000px; /* Large enough for content */
}

.active-btn {
    background-color: white !important;
    color: #08c9e2ff !important;
}
</style>
<!-- Shiv Web Developer -->

<body>
    <div class="container">
        <div class="contentPresentationContainer pt-5 mt-5">
            <h1 class="text-center"> Are You Starting From ZERO ? </h1> <br /> <br /> <br />
            <p> Are you solopreneur with no money but great Idea ?</p>
            <p> This is place for you. Come and build your organization Step by Step. </p>
            <p> Here, </p>
            <div> 1. Create "User Profile" </div>
            <div> 2. List your company </div>
            <div> 3. List your projects under company </div>
            <div> 4. Start listing your task with required fund. ( other User can Invest with Crowd Funding feature -
                Allocate work to right human resource - Get your work done - Mark the milestones ) </div>
            <div> 5. Repeat the process & Grow your Organization. </div>
        </div>
        <div class="contentPresentationContainer pt-5 mt-5">
            <h3 class="text-left"> For, Donations & Equvity Investments. </h3> <br />
            <p> 1ST GENERATION HUMAN LIVES MATTER ASSOCIATION</p>
            <p> Bank Name - IDFC FIRST BANK</p>
            <p> Country - INDIA</p>
            <p> Currency - INDIAN RUPPES, USA DOLLAR, CHINESE, RUSSIAN, SWIZERLAND</p>
            <p> AC - 88497479955 </p>
            <p> UCIC - 6765126861 </p>
            <p> IFSC CODE - IDFB0040303</p>
        </div>
        <div class="row g-0">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4"></div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <div class="">
                    <!-- <h3 class="heading text-center mt-5">Welcome to My Digital Bricks</h3> -->
                    <!-- <p class="text-center text-muted mb-3">Every user is a Project Consultant for us !</p> -->
                    <div class="selection-box">
                        <div class="selection-wrapper d-flex justify-content-center align-items-center">
                            <div class="login-container form-inner position-relative">
                                <h3 class="heading text-center p-0 m-0" style="color:#08c9e2ff;">Join us Today - <a href="<?= base_url('/company/login') ?>" style="color:#08c9e2ff;"> Sign up</a> </h3> <br />
                                <p class="text-center text-muted my-1"> <b> Login </b></p>
                                <div class="progress"></div>
                                <form id="login-form" method="POST">
                                    <div class="formMsg"></div>
                                    <div class="mb-4 form">
                                        <label for="phone" class="form-label">Email ID</label>
                                        <div class="input-group">
                                            <input type="email" id="phone" class="form-control" name="phone"
                                                placeholder="Enter Email Id" required>
                                        </div>
                                    </div>
                                    <div class="password-wrapper" id="password-wrapper">
                                        <div class="password-field mb-3" id="password-field">
                                            <label for="password" class="form-label">Enter Password</label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Enter Password" required>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 mb-3">
                                        <button type="submit" class=" btn btn-primary"
                                            style="background-color:#08c9e2ff;">Login</button>
                                    </div>
                                    <!-- <a class="google-btn" href="javascript:void(0)"
                                        onclick="alert('module is under development')">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png"
                                            alt="Google Icon">
                                        Sign in with LinkedIn
                                    </a> -->
                                </form>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            Don't have an account? <a href="<?= base_url('company/login') ?>">Create Account</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4"></div>
        </div>

        <div class="row g-0">
            <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2"></div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <div class="loginPageContainer card">
                    <img src="<?= base_url('/assets/images/brickpay_login.jpg') ?>" class="" alt="Home Page Banner" />
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2"></div>
            <!-- <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">
                 <div class="loginPageContainer card">
                    <img src="<//?= base_url('/assets/images/brickpay_login.jpg') ?>" class=""
                        alt="Home Page Banner" />
                </div>
            </div> -->
        </div>
        <!-- Toggle Buttons -->
         <div class="mt-4 text-center p-2" style="background-color:#08c9e2ff;">
            <button class="initiative-btn btn me-2 text-white"
                data-target="initiativeOne"
                style="border:1px solid white;">
                Members
            </button>
            <button class="initiative-btn btn me-2 text-white"
                data-target="mentors"
                style="border:1px solid white;">
                Mentor
            </button>
            <div id="mentors" class="initiative-content mt-4 show-content">
                <div class="p-4 border rounded bg-light">

                    <h4 class="mb-4 fw-bold text-center">Our Mentors</h4>

                    <div class="row g-4 justify-content-center">

                        <!-- Mentor 1 -->
                        <div class="col-md-3 col-sm-6">
                            <div class="card mentor-card text-center h-100 shadow-sm">
                                <div class="mentor-img-wrapper">
                                    <img src="<?= base_url('uploads/mentor/modi_new.jpg') ?>" class="card-img-top" alt="Narendra Modi">
                                </div>

                                <div class="card-body">
                                    <h6 class="fw-bold mb-1">Narendra Modi</h6>
                                    <small class="text-muted">Prime Minister of India</small>
                                </div>
                            </div>
                        </div>

                        <!-- Mentor 2 -->
                        <div class="col-md-3 col-sm-6">
                            <div class="card mentor-card text-center h-100 shadow-sm">
                                <div class="mentor-img-wrapper">
                                    <img src="<?= base_url('uploads/mentor/mukesh ambani.webp') ?>" class="card-img-top" alt="Mukesh Ambani">
                                </div>

                                <div class="card-body">
                                    <h6 class="fw-bold mb-1">Mukesh Ambani</h6>
                                    <small class="text-muted">Chairman, Reliance Industries</small>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
         </div>
         <h5 style="font-weight: 600; font-size: 30px; text-align: center; margin-top: 14px;">Our Bold Vision is to make our initiatives as united nations goals (i.e. UN SDG 17 Goals)</h5>
        <div class="mt-4 text-center p-2" style="background-color:#08c9e2ff;">

            <button class="initiative-btn btn me-2 text-white active-btn"
                data-target="initiativeOne"
                style="border:1px solid white;">
                1st Initiative
            </button>

            <button class="initiative-btn btn text-white"
                data-target="initiativeTwo"
                style="border:1px solid white;">
                2nd Initiative
            </button>

            <button class="initiative-btn btn text-white"
                data-target="initiativeThree"
                style="border:1px solid white;">
                3rd Initiative
            </button>

            <button class="initiative-btn btn text-white"
                data-target="initiativeFourth"
                style="border:1px solid white;">
                4th Initiative
            </button>

        </div>

        <!-- 1st Initiative -->
        <div id="initiativeOne" class="initiative-content mt-3 show-content">
            <div class="p-3 border rounded">
                <div style="font-family: 'Segoe UI', Arial, sans-serif; line-height:1.8; color:#222; max-width:1100px; margin:auto;">

                    <p style="font-size:22px; font-weight:700;">United Nations Portable Municipality Plans :</p>
                    <p style="font-size:18px; font-weight:600;">( With World's Top 10 Most Powerful National Defence Agencies.)</p>
                    <p style="font-size:18px; font-weight:600;">(Goal - 1 Million Portable Municipality within next 50 years)</p>
                    <div style="height:3px; background:#08c9e2; width:100%; margin:15px 0 25px 0;"></div>

                    <!-- <p style="font-weight:600;">Portable Air Isolation Chamber</p>
                    <p style="font-weight:600;">Portable Gal-Mobile Chamber ( Water )</p>
                    <p style="font-weight:600;">Portable Homes</p>
                    <p style="font-weight:600;">Portable Solar Panels for Green energy ( Mirror Innovations )</p>
                    <p style="font-weight:600;">Starlink - Portable Internet</p>

                    <p style="margin-top:15px;">
                        <a href="https://www.blackridgeresearch.com/blog/top-major-biggest-largest-desalination-plants-projects-cost-in-india?srsltid=AfmBOoqVfw7xSYGpp_pubwiVNVRQbDNHIDoaRvPYQJUQhJm1gRXlREqI&utm_source=chatgpt.com"
                        target="_blank"
                        style="color:#08c9e2; font-weight:600; text-decoration:none;">
                            https://www.blackridgeresearch.com/blog/top-major-biggest-largest-desalination-plants-projects-cost-in-india?srsltid=AfmBOoqVfw7xSYGpp_pubwiVNVRQbDNHIDoaRvPYQJUQhJm1gRXlREqI&utm_source=chatgpt.com
                        </a>
                    </p>

                    <p style="font-weight:600;">Jio Arogya AI ( for Healthcare )</p>

                    <p style="margin-top:25px; font-size:18px; font-weight:700;">1 MW Solar Plant</p>
                    <p style="font-weight:600;">Portable Municipality Concept for Rural Area Development - Make Animated Video</p>

                    <p style="margin-top:20px; font-size:18px; font-weight:700;">Green Energy Sustenance</p>

                    <p style="margin-top:30px; font-size:18px; font-weight:700;">
                        Inventions Responsible for Today’s well being.
                    </p>

                    <p><strong>Artificial Lights</strong> - Edison</p>
                    <p><strong>Electricity</strong> - Tesla</p>
                    <p><strong>Energy Transition</strong> -</p>

                    <p style="margin-top:30px; font-size:18px; font-weight:700;">
                        Humans 24 Hours
                    </p>

                    <p style="font-weight:600;">Basic Functionality Environment Creation.</p>

                    <p>Eye Sighting - Dekhna</p>
                    <p>12 Hours Natural - Day</p>
                    <p>12 Hours Artificial - Night</p>
                    <p>Breathing Inhale-exhale - 24 Hours</p>
                    <p>Clean Air availability & Oxygen availability</p>
                    <p>Bed comes chamber - 6-8 Hours of Sleep</p>
                    <p>Advance Masks - 18-16 Hours of Walk</p>

                    <p style="margin-top:15px; font-weight:600;">Good Desired Body Growth -</p>
                    <p>Genes -  Nutrients ,</p>

                    <p>Hygiene - Water , Bio-degradable wet wipes , Toilets</p>
                    <p>Physical Fitness - Walking Streets, Gyms</p>
                    <p>Colours changing availability - Desired skintone, hight other body feature availability</p>
                    <p>Food & Water - Non-toxic to Homosepian.</p>
                    <p>Emotational Balance Routine.</p>
                    <p>Space Exploration and many other Logitivity based programs.</p> -->

                    <p style="margin-top:40px; font-size:20px; font-weight:700;">
                        Circular Sustainable Life & Economy :
                    </p>

                    <div style="height:2px; background:#08c9e2; width:60px; margin:10px 0 20px 0;"></div>

                    <!-- <p>Electricity</p>
                    <p>Sustainable Electricity - Solar, Seawater to Electricity , Wind</p>
                    <p>Artificial Light , All Advanced Techno gadgets</p>
                    <p>Computer System</p>
                    <p>Internet</p>
                    <p>Clean Air Initiatives</p>
                    <p>Portable Washroom - Biodegradable ( Closed Loop Solutions )</p>
                    <p>Anti Stabbing/Anti Water Clothes</p>
                    <p>All type of Ethnicity Desired with body features and availability of reproduction rooms</p>
                    <p>Logistics with personal flying machine, Swimming Machine</p>
                    <p>( DST Matsya 6000M Depth in Sea Water )</p> -->

                    <!-- <p style="margin-top:30px; font-size:18px; font-weight:700;">
                        Digital School -
                    </p>

                    <p style="margin-left:20px;">1. Availability of Human Body 3D</p>
                    <p style="margin-left:20px;">2. Finance Knowledge</p>

                    <p style="margin-top:30px; font-size:18px; font-weight:700;">
                        Digital Hospital -
                    </p>

                    <p>All Medical Branch consultation</p>
                    <p>Availability of Robotic Surgery</p>
                    <p>Nursing & Medical Device Equipments</p>

                    <p style="margin-top:30px; font-size:18px; font-weight:700;">
                        Central Control Room -
                    </p>

                    <p style="margin-top:30px; font-size:18px; font-weight:700;">
                        Visualization of City with no crime -
                    </p>

                    <p>Life planning as everyone is global leaders - u study the best & then design it best.</p>
                    <p>Study all things & become everything & fuck everyone. So no crimes at all.</p> -->

                </div>
            </div>
        </div>

        <!-- 2nd Initiative -->
        <div id="initiativeTwo" class="initiative-content mt-3">
            <div class="p-3 border rounded">
                <div style="font-family:'Segoe UI', Arial, sans-serif; line-height:1.8; color:#222; max-width:1100px; margin:auto;">

                    <p style="font-size:24px; font-weight:700;">
                        Let's Reverse the Human Body ( 1M $ Pree-Seed )
                    </p>
                    <div style="height:3px; background:#08c9e2; width:100%; margin:15px 0 25px 0;"></div>
                    
                    <p style="font-size:18px; font-weight:600;">
                        Global Public Sector Health Initiative
                    </p>
                    <p style="font-size:18px; font-weight:600;">
                        World’s First 3D interactive human body intelligence platform combining anatomy, Physiology, Medical Device Market Trends.
                    </p>

                    <p style="font-size:20px; font-weight:700; margin-top:30px;">Vision</p>
                    <div style="height:3px; background:#08c9e2; width:80px; margin:10px 0 20px 0;"></div>

                    <p>
                        To become the global standard platform for human body intelligence — just as Bloomberg is for financial intelligence.
                    </p>

                    <p>
                        The Bloomberg Terminal type of the Virtual Artificial Human Body development, Medical Device Market Reports, All Human Digital Health Record. And material science level decoding of the human body..
                    </p>

                    <p style="font-size:20px; font-weight:700; margin-top:40px;">Phase – 1</p>
                    <div style="height:3px; background:#08c9e2; width:80px; margin:10px 0 20px 0;"></div>

                    <p><strong>1.</strong> Hosting World Wide Show - Associating people worldwide for establishment of standard methods for the reverse of the human body.</p>

                    <p>Rented Shop(Red Room) – i.e Saket Mall, New Delhi ( Apple India Official ) & Branches Podcast in India’s Tier-1 Cities.</p>

                    <p>Hosting Podcast with Mr. Shubham Shah tracing India’s Science & Technology Evolution.</p>

                    <p style="font-weight:700; margin-top:20px;">Speakers List Top 10 India : Opening Remarks: =</p>

                    <p>1. Office of PSA – Ajay Sood</p>
                    <p>2. DST Secretary – Abhay Kantikar</p>
                    <p>3. ANRF – Shivakumar</p>
                    <p>4. AIIMS Delhi – Project Tannu.ai – M. Srinivas</p>
                    <p>5. Prof. Anil Gupta – NIA & Dr. Sudhir Shah – Padma Shree Neuro</p>
                    <p>6. Dr. Rajiv Bhal – ICMR</p>
                    <p>7. Dr. Suchita Marken – ICMR</p>
                    <p>8. Dr. Samir – DRDO</p>
                    <p>9. Mr. Amitabh Kant – NITI Ayog</p>
                    <p>10. Chairman - Biomaterials & Artificial Society India.</p>
                    <p>11. Dr. Jitender Singh – Mos S&T, R&D</p>
                    <p>12. Anupriya Patel – Minister of Health India</p>
                    <p>13. Dr. Jagat Prakash Nadda – Health Minister India</p>
                    <p>14. Prime Minister & President of India</p>

                    <p style="font-weight:700; margin-top:20px;">Planned Episodes with clear Agenda with “WAVES OTT” Scientists</p>

                    <p>Scientist F - Science, Commerce, Arts - Position 500</p>
                    <p>Scientist E - Science, Commerce, Arts - Position 400</p>
                    <p>Scientist D - Science, Commerce, Arts - Position 300</p>
                    <p>Scientist C - Science, Commerce, Arts - Position 400</p>
                    <p>Scientist B - Science, Commerce, Arts - Position 500</p>

                    <p style="font-weight:700; margin-top:30px;">Foundational Departments :</p>

                    <p>1. Concept Visualization</p>
                    <p>2. Budgeting Team</p>
                    <p>3. Investor Relations</p>
                    <p>4. Product Development</p>
                    <p>5. Quality and Standards</p>
                    <p>6. Manufacturing</p>
                    <p>7. Production</p>
                    <p>8. Operations and Logistics</p>
                    <p>9. Sales</p>
                    <p>10. IT Automation</p>
                    <p>11. Research and Development</p>
                    <p>12. Finance and Accounts</p>
                    <p>13. Legal and Compliance</p>
                    <p>14. Administration</p>
                    <p>15. Closed-Loop Feedback and Research Optimization</p>

                    <p style="margin-top:20px;">Operative Expense - 10 Years</p>
                    <p>Labs Setup - 6000 Crores ( Human Bioprinting oriented )</p>
                    <p>Land Purchase - 200 Acres ( 100 % Green Energy )</p>

                    <p style="font-size:20px; font-weight:700; margin-top:40px;">Phase- 2</p>
                    <div style="height:3px; background:#08c9e2; width:80px; margin:10px 0 20px 0;"></div>

                    <p>1. Let's Reverse the Human Body is a web-based 3D interactive human body platform that visualizes organ-level anatomy, physiology and healthcare market trends on a single intelligent interface.</p>

                    <p>2. R&D Institute with optimized Industrial materials based Development of Artificial Organs ( 200 M $ ) & Last mile availability is as simple as chai or plastic bags in India.</p>

                    <p>4. Accelerator for translational deep tech research & development by Ed-tech ( 100 M $ ) Education to Entrepreneurship.</p>

                    <p>5. Human Lives Extensions, Longevity - 800 Years ( 100 B $ ) & Space Explorable Human Spices extension. ( 2054 ) -level anatomy, physiology and healthcare market trends on a single intelligent interface.</p>

                    <p style="font-weight:700; margin-top:30px;">Product Highlights : ( Web App / App / XR Glasses )</p>

                    <p>• Interactive 3D male & female human models</p>
                    <p>• Organ-wise & market research heatmaps for availed products to support human health</p>
                    <p>• Enterprise dashboards & APIs (Roadmap)</p>
                    <p>• Addition of Anatomy, Physiology, Physiotherapy, Human Robotics.</p>

                    <p style="font-weight:700; margin-top:30px;">Futuristic Technologies tracing with financial resources & World Humanities upliftment projection with WHO.</p>

                    <p style="font-weight:700; margin-top:30px;">Target Customers</p>

                    <p>• Pharma & Medical device companies</p>
                    <p>• Hospitals & Clinics</p>
                    <p>• Engineering -Medical colleges & Universities & Smart Schools.</p>
                    <p>• Insurance Companies</p>
                    <p>• Government & public health bodies (Space agencies Worldwide)</p>

                    <p style="font-weight:700; margin-top:30px;">India & Global Market Opportunity</p>

                    <p>India’s healthcare market exceeds ₹9 lakh crore with rapid digitization across medical education, pharma, and insurance. The global digital health visualization market is growing at ~20% CAGR.</p>

                    <p style="font-weight:700; margin-top:30px;">3 billion Dollar+ Worldwide Business Model Hosting Show</p>

                    <p>Start giving dividends who are watching the show</p>
                    <p>Give them sentiment meter, ask for what they want & Tarak Mehata Kind of Reaction with their own comments, from anybody they want.</p>
                    <p>Followed by Campaigns on SDG Goals, world changing initiatives, political parties and movements , science upliftment.</p>

                    <p style="font-weight:700; margin-top:30px;">Annual SaaS subscriptions:</p>

                    <p>• Engineering & Medical colleges- Schools: ₹25 lakh / Year</p>
                    <p>• Pharma & devices: ₹75 lakh / Year</p>
                    <p>• Enterprise Solutions: Custom pricing</p>

                    <p>Additional revenue from custom datasets, white-label licensing, and API access.</p>

                    <p style="font-weight:700; margin-top:30px;">Funding Ask</p>

                    <p>Raising a Pre-Seed / Seed round to build the core 3D engine, validate medical data, launch pilot deployments, and establish enterprise partnerships.</p>

                    <p style="font-weight:700; margin-top:30px;">Founder</p>

                    <p>Shubham Shah, Bhupesh Sood, Bhavesh Parmar, Rakesh Motka, Rakesh Rawal, Aditya Vyas, Col Hemraj Singh, Dr. Purav Gandhi etc.</p>

                    <p style="font-weight:700; margin-top:30px;">Market Research & Phase-1 Collaboration -</p>

                    <p>1. https://digihuman.net/ - China</p>
                    <p>2. https://anatomage.com/distributors/ - Philippines</p>
                    <p>3. https://mavericksimulation.com/ - China Distributor India</p>
                    <p>4. https://surglasses.com/en/ -</p>
                    <p>5. https://pirogov-anatomy.com/ -</p>
                    <p>6. https://3d4medical.com/ -</p>
                    <p>7. https://primalpictures.com/functional-anatomy/ - https://www.instagram.com/primalpictures/</p>
                    <p>8. https://www.biodigital.com/product/human-studio</p>
                    <p>9. https://medical.sectra.com/solutionarea/genomics/</p>
                    <p>10. https://www.visionanatomy.com/products</p>
                    <p>11. https://www.3bscientific.com/</p>
                    <p>12. https://www.trivitron.com/</p>

                    <p style="font-weight:700; margin-top:30px;">Course Module Development with WAVES :</p>

                    <p>1. Anatomy ( 3D AR-XR )</p>
                    <p>2. Physiology</p>
                    <p>3. Physiotherapy/ Acupuncture / Spa ( Human body Force Analysis & Physical structure interaction with environment / physics ) ( NSG-SPG)</p>
                    <p>4. Artificial Organs Evolutions & Human body Material Science ( Labs to Prototype )</p>
                    <p>5. Product Development Course ( Product Shelf Life Design, Materials Selection, SWOT Analysis )</p>
                    <p>6. Mining to Manufacturing ( “N” number of Horizontal & Vertical integration )</p>
                    <p>7. Quality Standards Checks with Production Concepts.</p>
                    <p>8. Compared to Ancient Science.</p>
                    <p>9. Let’s Reverse the Human Body</p>

                </div>
            </div>
        </div>

        <div id="initiativeThree" class="initiative-content mt-3">
            <div class="p-3 border rounded">
                <div style="font-family:'Segoe UI', Arial, sans-serif; line-height:1.8; color:#222; max-width:1100px; margin:auto;">
                    
                    <p style="font-size:24px; font-weight:700; text-align: center;">World Policing and Security Forces and Home Ministry</p>

                    <p style="font-size:18px; font-weight:600; text-align: center;">( For in general crime prevention in world population 50% )</p>
                            
                    <div style="height:3px; background:#08c9e2; width:100%; margin:15px 0 25px 0;"></div>

                    <p style="font-size:22px; font-weight:700; margin-top:20px;">
                        Mission -
                    </p>

                    <div style="height:3px; background:#08c9e2; width:80px; margin:10px 0 20px 0;"></div>

                    <p style="font-size:17px;">
                        To make every citizen's lives matter & make them live at fullest, neglecting family
                        background. "Education to Entrepreneurship" for building deep technology based initiatives for
                        every citizen of the country.
                    </p>

                    <p style="font-size:22px; font-weight:700; margin-top:40px;">
                        Vision -
                    </p>

                    <div style="height:3px; background:#08c9e2; width:80px; margin:10px 0 20px 0;"></div>

                    <p style="font-size:17px;">
                        To uplift each of modern human resources from the education system & making
                        them resource full enough to build the next big breakthrough in their respective field. &
                        enable them to bring the change whatever he/she wants to bring.
                    </p>

                    <div style="height:3px; background:#08c9e2; width:100%; margin:10px 0 20px 0;"></div>
                    
                    <p style="font-size:17px;">
                        Compared to World's deeptech startup ecosystem. Lakhs of people are not able to utilize their knowledge & they are
                        not able to apply their acquired knowledge in practical lives because there is no ecosystem. And everything is made
                        money oriented i.e. pharma drugs which have been researched, synthesized & produced in India by common man
                        who have studied pharma by taking education loans & if they start today on their own achieving 1000 crore sales will
                        take a lifetime. So all science & technology driven businesses report these problems.
                    </p>

                    <p style="font-size:17px; margin-top:20px;">
                        So, same as the right to education, we want to establish the right to entrepreneurship based on the education people
                        have taken & by creating a step by step path towards education to entrepreneurship for the total population & uplift
                        for the better tomorrow.
                    </p>

                    <p style="font-size:17px; margin-top:20px;">
                        We want to establish a central incubation centre which will work under home ministry ( 51% ) & private NGO ( 49% ) so
                        we can take initiative for the total population which will have responsibility to create resources for the under
                        privileged people. Uplift them by providing Education of Entrepreneurship. We will respect every citizen's time based
                        progress & resources creation based on their time.
                    </p>

                    <p style="font-size:17px; margin-top:20px;">
                        We assure you that we have found out / established such a way that educated Indians will never be unresourceful.
                        Making them resourceful will lead to a strong foundation of visit bharat 2047 visionary prime minister goals.
                    </p>

                    <p style="font-size:17px; margin-top:20px;">
                        We want to incorporate section 8 under MOH, along with MOU with respective ministries.
                        ( Example - i hub gujarat which works with the education department of gujarat )
                    </p>

                    <p style="font-size:20px; font-weight:700; margin-top:40px;">
                        Proposed Government Associations(India) :
                    </p>

                    <div style="height:3px; background:#08c9e2; width:80px; margin:10px 0 20px 0;"></div>

                    <p>1. Office of the Registrar General and Census Commissioner of India, Division of Total Population - MOH</p>
                    <p>2. National Human Rights Commission, MOH-GOI</p>
                    <p>3. Ministry of Education, GOI</p>
                    <p>4. Ministry of Corporate Affairs, GOI / Ministry of Finance, GOI</p>
                    <p>5. Ministry of Law and Justice, GOI</p>

                </div>
            </div>
        </div>

        <div id="initiativeFourth" class="initiative-content mt-3">
            <div class="p-3 border rounded">
                <div style="font-family:'Segoe UI', Arial, sans-serif; line-height:1.8; color:#222; max-width:1100px; margin:auto;">

                    <p style="font-size:22px; font-weight:700; margin-top:20px;">
                        1. Global Project - Department of Education(World)
                    </p>

                    <div style="height:3px; background:#08c9e2; width:80px; margin:10px 0 20px 0;"></div>

                    <p style="font-size:17px;">
                        Integration & Differentiation of World with Material Science & Engineering Approach. ( Includes All degreesText by making them Brick Pay AI )
                    </p>

                    <p style="font-size:17px; margin-top:20px;">
                        After officially studying Science & Technology(All Branches) + Biology & Biotechnology(All Branches) +Engineering(All Branches) + Commerce (All Branches) We have reached a common integrated knowledge panel which can make 1 human understand actual knowledge which has been divided since the British Era (Since India Independence). (Total divided knowledge across all degrees can at least take 1000 years for each human in the traditional way.) With the help of the internet we are able to achieve faster knowledge gain around the world.
                    </p>

                    <p style="font-size:17px; margin-top:20px;">
                        Hence , We proposed project where world all Knowledge has been integrated & compressed in such way so we can deliver in the hand of World Population 6 billion who is not participating national progress apart from first 2 billion. Integrating them with digital identity &
                    </p>

                    <p style="font-size:17px; margin-top:20px;">
                        We have invested 30 lakhs INR of our Own & Created Portal called -
                        <a href="https://brickpay.in/" target="_blank" style="color:#08c9e2; font-weight:600; text-decoration:none;">
                            https://brickpay.in/
                        </a>
                        , with Brick Pay we canintegrate the knowledge & Share it worldwide. We want to pitch it to Education & Health Ministry or Global tech giantslike Alphabets in partnership with AIIMS )
                    </p>

                </div>
            </div>
        </div>
        
        <div class="mt-4 text-center p-2" style="background-color:#08c9e2ff;">
            <a href="<?= base_url('contact-us') ?>" class="btn  me-2 text-white" style="border:1px solid white;">Contact
                Us</a>
            <a href="<?= base_url('terms-condition') ?>" class="btn text-white" style="border:1px solid white;">Terms &
                Conditions</a>
            <a href="<?= base_url('privacy-policy') ?>" class="btn text-white" style="border:1px solid white;">Privacy
                Policy</a>
            <a href="<?= base_url('refund') ?>" class="btn text-white" style="border:1px solid white;">Refund Policy</a>
            <a href="<?= base_url('disclaimer') ?>" class="btn text-white"
                style="border:1px solid white;">Disclaimer</a>
        </div>
        <p class="text-center"> © 2025 Brickpay. All rights reserved. </p>
    </div>
    <!-- Shiv Web Developer -->
    <script>
        document.querySelectorAll('input[type="password"]').forEach((input) => {
            // Create the eye button
            const toggleBtn = document.createElement('button');
            toggleBtn.type = 'button';
            toggleBtn.innerHTML = '<i class="fa fa-eye"></i>';
            toggleBtn.classList.add('password-eye-icon')
            input.insertAdjacentElement('afterend', toggleBtn);

            // Toggle functionality
            toggleBtn.addEventListener('click', () => {
                input.type = input.type === 'password' ? 'text' : 'password';
                toggleBtn.classList.toggle('show')
            });
        });
    </script>

    <script>
        let formMsgEl = document.querySelector(".formMsg");
        let formLoadingEl = document.querySelector('.form-inner');

        function formLoading(loading) {
            loading ? formLoadingEl.classList.add('loading') : formLoadingEl.classList.remove('loading')
        }

        function showFormMsg(type, message) {
            if (!formMsgEl) {
                console.error("Element with class 'formMsg' not found.");
                return;
            }
            formMsgEl.innerHTML = `<p class="alert alert-${type} p-1 px-2">${message}</p>`;
            setTimeout(() => {
                formMsgEl.innerHTML = '';
            }, 20000);
        }



        document.getElementById('login-form').addEventListener('submit', function(event) {
            console.log("button click");
            event.preventDefault();
            const phone = document.getElementById('phone').value;
            const password = document.getElementById('password').value;
            formLoading(true);
            fetch('<?= base_url('CompanyAuth/user_Login') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        phone: phone,
                        password: password
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showFormMsg('success', data.message)
                        window.location.href = data.redirect;
                    } else {
                        showFormMsg('danger', data.message)
                    }
                    formLoading(false);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an issue verifying the OTP. Please try again later.');
                });
        });
    </script>
    <!-- <script>
        function sendOtp() {
            // Show OTP input field
            document.getElementById("otp-section").style.display = "block";

            // Hide send OTP button, show login button
            document.getElementById("sendOtpBtn").style.display = "none";
            document.getElementById("submitBtn").style.display = "block";

            // Simulate OTP success (for demo purpose)
            setTimeout(() => {
                showPasswordSection();
            }, 2000); // after 2 sec assume OTP is correct
        }

        function showPasswordSection() {
            // Show password fields after OTP is verified
            document.getElementById("password-section").style.display = "block";
        }
    </script> -->
    <script>
        // function sendOtp() {
        //     // Step 1: Show OTP input field
        //     document.getElementById("otp-section").style.display = "block";

        //     // Step 2: Hide "Send OTP" button, show "Sign up" button
        //     document.getElementById("sendOtpBtn").style.display = "none";
        //     document.getElementById("submitBtn").style.display = "block";

        //     // Step 3: Simulate OTP verification (you can replace this with real API check)
        //     setTimeout(() => {
        //         showSuccessMessage("✅ OTP verified successfully");
        //         showPasswordSection();
        //     }, 1500); // Simulating delay
        // }

        function showSuccessMessage(msg) {
            const msgBox = document.querySelector(".formMsg");
            msgBox.innerText = msg;
            msgBox.style.color = "green";
            msgBox.style.fontWeight = "500";
            msgBox.style.marginBottom = "10px";
        }

        function showPasswordSection() {
            document.getElementById("password-section").style.display = "block";
        }
    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function(){

            const buttons = document.querySelectorAll(".initiative-btn");
            const contents = document.querySelectorAll(".initiative-content");

            buttons.forEach(button => {

                button.addEventListener("click", function(){

                    const targetId = this.getAttribute("data-target");
                    const targetContent = document.getElementById(targetId);

                    // Close all sections
                    contents.forEach(content => {
                        content.classList.remove("show-content");
                    });

                    // Remove active class from all buttons
                    buttons.forEach(btn => btn.classList.remove("active-btn"));

                    // Open selected section
                    targetContent.classList.add("show-content");
                    this.classList.add("active-btn");

                });

            });

        });
        </script>

</body>
<!-- Shiv Web Developer -->

</html>