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
        width: 70rem;
        margin: 20px auto;
    }

    @media (max-width: 991px) {
        .selection-box {
            width: 18rem;
        }
    }
</style>

<body>
    <div class="container-fluid vh-100">
        <!-- <h3 class="heading text-center mt-5">Welcome to My Digital Bricks</h3>
        <p class="text-center text-muted mb-5">Join as a project consultant or project creator</p> -->
        <div class="selection-box mt-md-5 pt-md-5">
            <div class="selection-wrapper d-flex justify-content-center align-items-center">

                <div class="login-container form-inner position-relative">
                    <h3 class="heading text-center">Project Creator</h3>
                    <div class="progress"></div>
                    <!-- action="<?= base_url('Home/companyLogin') ?>" -->
                    <form id="login-form" method="POST">
                        <?php
                        if ($this->session->has_userdata('cinMsg')) {
                            echo $this->session->userdata('cinMsg');
                            $this->session->unset_userdata('cinMsg');
                        }
                        ?>
                        <div class="formMsg"></div>
                        <div class="mb-0">
                            <label for="country" class="form-label">Select Country</label>
                            <select id="country" class="form-select" name="country" required>
                                <option value="">Choose Country...</option>
                            </select>
                        </div>

                        <div class="mb-1 form ">
                            <label for="phone" class="form-label">Company Type</label>
                            <div class="input-group">
                                <select class="form-select" id="company_type" name="company_type" required="">
                                    <option value="">Choose...</option>
                                    <option>Proprietor </option>
                                    <option>Partnership </option>
                                    <option>LLP </option>
                                    <option>PVT LTD </option>
                                    <option>Section 8 </option>
                                    <option>Trust </option>
                                    <option>One person Company </option>
                                    <option>Government Agency</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 form ">
                            <label for="phone" class="form-label">Verify CIN Number</label>
                            <div class="input-group">
                                <input type="text" id="ciin_number" class="form-control" name="ciin_number" placeholder="Enter CIN Number" required>
                            </div>
                        </div>
                        <div id="cinMsg" style="font-size: 14px; color: green; font-weight: 500; margin-top: 5px;"></div>
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="otp-button" id="submitBtn">Submit</button>
                        </div>
                        <!-- <div class="d-grid gap-2 mb-3">
                            <a href="<?= base_url('company/create-company-profile') ?>" class="otp-button text-center">Create Full Profile</a>
                        </div> -->

                    </form>
                </div>

            </div>
            <!-- <div class="text-center mt-5">Already have an account? <a href="<?= base_url('company/login') ?>">Login</a></div> -->
        </div>
    </div>
    <!-- Shiv Web Developer -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = e.target;
            const formMsg = document.querySelector('.formMsg');
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerText = 'Submitting...';

            const payload = {
                country: form.country.value,
                company_type: form.company_type.value,
                ciin_number: form.ciin_number.value
            };

            try {
                const response = await fetch("<?= base_url('Home/companyLogin') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (data.status === 'success') {
                    console.log("Data", data);
                    if (data.razorpay_order_id) {
                        const options = {
                            key: data.st_razorpay_api_key,
                            amount: data.amount,
                            currency: data.currency,
                            order_id: data.razorpay_order_id,
                            handler: async function(response) {
                                const verifyResponse = await fetch('<?= base_url() ?>/CompanyAuth/compnay_handle_payment_response', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify(response),
                                });
                                const verifyData = await verifyResponse.json();
                                alert(verifyData.message);
                                if (verifyData.success) {
                                    window.location.href = "<?= base_url() ?>company/payment/success?id=" + data.razorpay_order_id;
                                }

                            },
                            theme: {
                                color: '#0b5ed7'
                            },
                        };
                        const razorpay = new Razorpay(options);
                        razorpay.open();
                        // showFormMsg('success', data.message);
                        // window.location.href = "thankyou";
                    } else {
                        showFormMsg('danger', data.message);
                    }
                } else {
                    formMsg.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                }
            } catch (error) {
                formMsg.innerHTML = `<div class="alert alert-danger">An error occurred. Please try again.</div>`;
                console.error('Fetch error:', error);
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerText = 'Submit';
            }
        });
    </script>


    <script>
        let resendOtpTimeout;
        let resendOtpInterval;
        let timerDuration = 30;
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


        function sendOtp() {
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

                        showFormMsg('success', data.message)
                        document.getElementById('otp-section').style.display = 'block';
                        document.querySelector("#otp").value = data.otp;
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
    </script>
    <script>
        const countries = [
            "India", "United States", "United Kingdom", "Canada", "Australia",
            "Germany", "France", "Singapore", "United Arab Emirates", "Japan",
            "China", "Brazil", "South Africa", "Netherlands", "Italy"
        ];

        const countrySelect = document.getElementById("country");

        countries.forEach(country => {
            const option = document.createElement("option");
            option.value = country;
            option.textContent = country;
            countrySelect.appendChild(option);
        });
    </script>
    <!-- Shiv Web Developer -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>