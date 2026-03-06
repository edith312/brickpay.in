<!DOCTYPE html>
<html>

<head>
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body>
    <h1 style="visibility: hidden;">Complete Your Payment</h1>
    <button id="rzp-button" style="visibility: hidden;">Pay Now</button>
    <!-- Shiv Web Developer  -->
    <script>
        var options = {
            "key": "<?php echo $razorpay_key; ?>",
            "amount": "<?php echo $amount * 100; ?>", // Amount in paise
            "currency": "INR",
            "name": "My Digital Bricks",
            "description": "Project Payment",
            "order_id": "<?php echo $order_id; ?>",
            "handler": async function(response) {
                // Handle payment success
                const verifyResponse = await fetch('<?= base_url() ?>/CompanyAuth/project_handle_payment_response', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(response),
                });
                const verifyData = await verifyResponse.json();
                alert(verifyData.message);
                if (verifyData.success) {
                    window.location.href = "<?= base_url() ?>project/payment/success?id=" + response.razorpay_order_id;
                }
            },
            "theme": {
                "color": "#0b5ed7"
            }
        };

        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button').onclick = function(e) {
            rzp1.open();
            e.preventDefault();
        }
        document.querySelector("#rzp-button").click();
    </script>
</body>

</html>
<!-- Shiv Web Developer  -->