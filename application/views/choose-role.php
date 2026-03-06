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
        box-shadow: 0 3px 5px #4aa09f;
        width: 500px;
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
        width: 70rem;
        margin: 20px auto;
    }

    @media (max-width: 991px) {
        .selection-box {
            width: 100%;
        }
    }
</style>
<!-- Shiv Web Developer -->

<body>
    <div class="container-fluid vh-100">
        <h3 class="heading text-center mt-5">Welcome to My Digital Bricks</h3>
        <p class="text-center text-muted mb-5">Every user is a Project Consultant for us !</p>
        <div class="selection-box">
            <div class="selection-wrapper d-flex justify-content-center align-items-center">
                <div class="login-container form-inner position-relative">
                    <h3 class="heading text-center">Create User Profile</h3>
                    <p class="text-center text-muted">Project Consultant</p>
                    <div class="progress"></div>
                    <!-- <form id="login-form">
                        <div class="formMsg"></div>
                        <div class="mb-4 form ">
                            <label for="phone" class="form-label">Phone Number</label>
                            <div class="input-group">
                                <input type="tel" id="phone" class="form-control" name="phone" placeholder="Enter phone number" required>
                                <button type="button" class="otp-button" id="send-otp">Send OTP</button>
                            </div>
                            <small class="text-muted">You'll receive a 6-digit OTP on this number.</small>
                        </div>

                        <div class="mb-3" id="otp-section" style="display:none;">
                            <label for="otp" class="form-label">Enter OTP</label>
                            <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP" required>
                        </div>

                        <div class="other-option">
                            <div class="">
                                <label id="resendOtpTimer" style="display:none;">Resend OTP in <span id="timerValue">30</span>s</label>
                            </div>
                            <button class="forgot-password text-danger" id="resendOtpBtn" style="display:none; text-decoration: underline;" onclick="sendOtp()">Resend OTP</button>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="button" class="otp-button" id="sendOtpBtn" onclick="sendOtp()">Sent OTP</button>
                            <button type="submit" class="otp-button" id="submitBtn" style="display:none;">Log In</button>
                            <a class="google-btn" href="javascript: void(0)" onclick="alert('module is under development')">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png" alt="Google Icon">
                                Sign in with LinkedIn
                            </a>
                        </div>
                    </form> -->

                    <form id="login-form">
                        <div class="formMsg"></div>
                        <div class="mb-4 form">
                            <label for="phone" class="form-label">Email ID</label>
                            <div class="input-group">
                                <input type="email" id="phone" class="form-control" name="phone" placeholder="Enter Email Id" required>
                            </div>
                            <small class="text-muted">You'll receive a 6-digit OTP on this number.</small>
                        </div>

                        <div class="mb-3" id="otp-section" style="display:none;">
                            <label for="otp" class="form-label">Enter OTP</label>
                            <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP" required>
                        </div>

                        <div class="other-option mb-4 d-flex justify-content-end">
                            <label id="resendOtpTimer" style="display:none;">Resend OTP in <span id="timerValue">30</span>s</label>
                            <button class="forgot-password text-danger" id="resendOtpBtn" style="all: unset; display:none;  cursor: pointer; text-decoration: underline;" onclick="sendOtp()">Resend OTP</button>
                        </div>
                        <div class="password-wrapper" id="password-wrapper" style="display: none;">

                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="button" class=" btn btn-primary" id="sendOtpBtn" onclick="sendOtp()">Sent OTP</button>
                            <button type="submit" class=" btn btn-primary" id="submitBtn" style="display:none;">Verify OTP</button>
                            <button type="button" class=" btn btn-primary" id="registerBtn" style="display:none;" onclick="submitPassword();">Submit</button>
                        </div>
                        <!-- <a class="google-btn" href="javascript:void(0)" onclick="alert('module is under development')">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png" alt="Google Icon">
                            Sign in with LinkedIn
                        </a> -->
                    </form>

                </div>

            </div>
            <div class="text-center mt-5">Already have an account? <a href="<?= base_url('user/login') ?>">Login</a></div>
        </div>
    </div>
    <!-- Shiv Web Developer -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        let resendOtpTimeout;
        let resendOtpInterval;
        let timerDuration = 30;
        let formMsgEl = document.querySelector(".formMsg");
        let formLoadingEl = document.querySelector('.form-inner');
        let passwordWrapper = document.querySelector("#password-wrapper");
        let submitBtn = document.querySelector("#submitBtn");
        let registerBtn = document.querySelector("#registerBtn");

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


        function sendOtp() {
            console.log("Function called")
            const phone = document.getElementById('phone').value;

            formLoading(true);

            fetch('<?= base_url('CompanyAuth/send_company_otp') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        phone
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("OTP", data.otp)
                        showFormMsg('success', data.message)
                        document.getElementById('otp-section').style.display = 'block';
                        // document.querySelector("#otp").value = data.otp;
                        document.getElementById('sendOtpBtn').style.display = 'none';
                        document.getElementById('submitBtn').style.display = 'inline-block';
                        document.getElementById('resendOtpBtn').style.display = 'none';

                        startResendOtpTimer();
                    } else {
                        showFormMsg('danger', data.message)
                        throw new Error('Error sending OTP.');
                    }
                    formLoading(false);
                })
                .catch(error => {
                    formLoading(false);
                    console.log(error)
                });
        }

        function startResendOtpTimer() {
            clearTimeout(resendOtpTimeout);
            clearInterval(resendOtpInterval);

            timerDuration = 30;
            document.getElementById('resendOtpTimer').style.display = 'block';
            document.getElementById('timerValue').innerText = timerDuration;

            resendOtpInterval = setInterval(() => {
                timerDuration--;
                document.getElementById('timerValue').innerText = timerDuration;

                if (timerDuration <= 0) {
                    clearInterval(resendOtpInterval);
                    document.getElementById('resendOtpTimer').style.display = 'none';
                    document.getElementById('resendOtpBtn').style.display = 'inline-block';
                }
            }, 1000);
        }

        document.getElementById('login-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const phone = document.getElementById('phone').value;
            const otp = document.getElementById('otp').value;
            formLoading(true);
            fetch('<?= base_url('CompanyAuth/verify_company_otp') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        phone: phone,
                        otp: otp
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        passwordWrapper.style.display = 'block';
                        passwordWrapper.innerHTML = `<div class="password-field mb-3" id="password-field">
                                <label for="password" class="form-label">Enter Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
                            </div>
                            <div class="confirm-password-field mb-3" id="confirm-password-field">
                                <label for="confirm-password" class="form-label">Enter Confirm Password</label>
                                <input type="password" id="confirm-password" name="confirm_password" class="form-control" placeholder="Enter Confirm Password" required>
                            </div>`;
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
                        submitBtn.style.display = 'none';
                        registerBtn.style.display = 'block';
                        showFormMsg('success', data.message)
                        // window.location.href = data.redirect;
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


        function submitPassword() {
            const phone = document.getElementById('phone').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            formLoading(true);

            fetch('<?= base_url('CompanyAuth/complete_registration') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        phone: phone,
                        password: password,
                        confirm_password: confirmPassword
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showFormMsg('success', data.message);
                        window.location.href = data.redirect;
                    } else {
                        showFormMsg('danger', data.message);
                    }
                    formLoading(false);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an issue submitting the form.');
                });
        }
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


</body>
<!-- Shiv Web Developer -->

</html>