
    <div class="page-body pt-1 px-2">
        <?php $this->load->view('map/header') ?>

        <div class="container py-5">
            <h2 class="text-center mb-4 fw-bold">Bachelor Degrees</h2>

            <div class="row g-3">

                <!-- START BUTTONS -->

                <!-- <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">BA - Bachelor of Arts</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">BSc - Bachelor of Science</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">BCom - Bachelor of Commerce</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">BBA - Bachelor of Business Administration</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">BTech / BE - Bachelor of Technology / Engineering</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">BCA - Bachelor of Computer Applications</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">BFA - Bachelor of Fine Arts</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">BPharm - Bachelor of Pharmacy</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">BDS - Bachelor of Dental Surgery</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">MBBS - Bachelor of Medicine, Bachelor of Surgery</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">BArch - Bachelor of Architecture</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">BVSc - Bachelor of Veterinary Science</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">LLB / BL - Bachelor of Law</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">BPT - Bachelor of Physiotherapy</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">B.Ed - Bachelor of Education</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">BHM / BHMCT - Bachelor of Hotel Management / Catering Technology</a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="branch-btn">BSc Nursing / BN - Bachelor of Nursing</a>
            </div> -->

                <!-- END BUTTONS -->

                <?php
                $bachelorDegrees = [
                    "Bachelor of Arts (Hons./Hons with Research) in Economics",
                    "Bachelor of Arts (Hons./Hons with Research) in International Relations",
                    "Bachelor of Arts (Hons./Hons with Research) in Political Science",
                    "Bachelor of Arts (Hons./Hons with Research) in Sociology",
                    "Bachelor of Pharmacy",
                    "Bachelor of Pharmacy (Practice)",
                    "Bachelor of Ayurvedic Medicine & Surgery",
                    "Bachelor of Science (Hons.) Agriculture",
                    "Bachelor of Dental Surgery (BDS)",
                    "Bachelor of Optometry",
                    "Bachelor in Audiology & Speech - Language Pathology",
                    "Bachelor of Science (Anaesthesia & Operation Theater Technology)",
                    "Bachelor of Science (Biotechnology)",
                    "Bachelor of Science (Cardiac Care Technology)",
                    "Bachelor of Science (Medical Laboratory Technology)",
                    "Bachelor of Science (Microbiology)",
                    "Bachelor of Science (Neuro-physiology Technology)",
                    "Bachelor of Science (Nutrition & Dietetics)",
                    "Bachelor of Science (Perfusion Technology)",
                    "Bachelor of Science (Radio-Imaging Technology)",
                    "Bachelor of Science (Renal Dialysis Technology)",
                    "Bachelor of Arts (Hons. With Research) (English)",
                    "Bachelor of Arts (Hons. with Research) Liberal Arts",
                    "Bachelor of Arts (Hons. with Research) Applied Psychology",
                    "Bachelor of Science (Hons. with Research) Cognitive Science",
                    "Bachelor of Science (Hons. with Research) Psychology (Clinical/Criminal)",
                    "Bachelor of Science Clinical Psychology (Hons.)(RCI)",
                    "Bachelor of Commerce (Hons.)",
                    "Bachelor of Commerce (Hons.) with (International Accounting & Finance)",
                    "Integrated B. Com - M. Com",
                    "Bachelor of Business Administration (General)",
                    "Bachelor of Business Administration (BFSI)",
                    "Bachelor of Business Administration (Business Analytics)",
                    "Bachelor of Business Administration (Global Business Management)",
                    "Bachelor of Business Administration (Logistics & Supply Chain Management)",
                    "Bachelor of Business Administration (Entrepreneurship & Family Business Management)",
                    "Bachelor of Business Administration (Digital Marketing)",
                    "Bachelor of Business Administration (Health Care Management)",
                    "Integrated BBA-MBA",
                    "B. Ed. (Special Education) - Intellectual Disability",
                    "Bachelor of Education",
                    "B.A.B.Ed. Spl.Ed.(Hearing Impairment - Preparatory Stage) ISITEP Integrated Special and Inclusive Teacher Education Programme",
                    "Integrated Bachelor of Education - Master of Education - (Special Education) - Intellectual Disability",
                    "Bachelor of Technology in Civil Engineering (Green Technology and Sustainability Engineering/ Construction Technology)",
                    "Bachelor of Technology in Computer Science & Engineering (Artificial Intelligence and Machine Learning/ Cloud Computing/ iOS & Mobile Applications/ Cyber Security/ Data Science/Blockchain/Gen AI*/ DevOps*/Data Engineering*)",
                    "Bachelor of Technology in Computer Science & Engineering (AI & Future Technologies*)",
                    "Bachelor of Technology in Computer Science [Work Integrated program] (Software Product Engineering*)",
                    "Bachelor of Technology in Computer Science and Engineering with specialization (Industry Collaborations)",
                    "Bachelor of Technology in Electronics & Communication Engineering (General/VLSI)",
                    "Bachelor of Technology in Mechanical Engineering (Robotics/ Electric Vehicle/ Digital Manufacturing)",
                    "Bachelor of Computer Applications (Artificial Intelligence & Machine Learning/ Cloud Computing/ Cyber Security/ Web Development/ Data Science)",
                    "Bachelor of Design (Hons. / Hons. with Research) Animation and VFX Design",
                    "Bachelor of Design (B. Des.)(Hons. / Hons. with Research) Fashion Design",
                    "Bachelor of Design (Hons. / Hons. with Research) Communication Design",
                    "Bachelor of Design (Hons. / Hons. with Research) Furniture and Interior Design",
                    "Bachelor of Design (Hons. / Hons. with Research) Product Design",
                    "BNYS - Bachelor in Naturopathy and Yogic Sciences",
                    "Bachelor of Hotel Management (Hons./Hons. with Research)",
                    "Bachelor of Arts and Bachelor of Legislative Law (Hons.)",
                    "Bachelor of Legislative Law (Hons.)",
                    "Bachelor of Business Administration and Bachelor of Legislative Law (Hons.)",
                    "Bachelor of Arts (Journalism & Mass Communication)[Social Media, SEO & Digital Marketing/Corporate Communications, Event Management & Brand Management/MOJO (Mobile Journalism)/Podcasting, Audiobook Production & Digital Radio Production]",
                    "Bachelor of Medicine and Bachelor of Surgery",
                    "Bachelor of Science (Nursing) (Basic)",
                    "Bachelor of Science (Post Basic Nursing)",
                    "Bachelor of Physiotherapy",
                    "B.Sc. Sports & Exercise Sciences",
                    "Bachelor of Science (Hons. with Research) Forensic Science"
                ];



                // Loop through array to generate buttons
                foreach ($bachelorDegrees  as $degree) {
                    echo '<div class="col-lg-3 col-md-4 col-sm-6">';
                    echo '<a href="#" class="branch-btn">' . $degree . '</a>';
                    echo '</div>';
                }
                ?>

            </div>
        </div>
    </div>