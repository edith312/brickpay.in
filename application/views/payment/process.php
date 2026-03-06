<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Payment</div>
                    <div class="card-body">
                        <h4>Amount: ₹<?php echo $transaction->amount; ?></h4>
                        <p>Type: <?php echo ucfirst($transaction->type); ?></p>
                        <button id="rzp-button1" class="btn btn-primary">Pay Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shiv Web Developer    -->
    <script>
        var options = {
            "key": "<?php echo $key_id; ?>",
            "amount": <?php echo $transaction->amount * 100; ?>,
            "currency": "<?php echo $currency_code; ?>",
            "name": "Business Suite",
            "description": "<?php echo ucfirst($transaction->type); ?> Payment",
            "image": "https://example.com/your_logo",
            "handler": function(response) {
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                document.razorpay_form.submit();
            },
            "prefill": {
                "name": "<?php echo $user->name; ?>",
                "email": "<?php echo $user->email; ?>",
                "contact": "<?php echo $user->mobile; ?>"
            },
            "theme": {
                "color": "#3399cc"
            }
        };

        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button1').onclick = function(e) {
            rzp1.open();
            e.preventDefault();
        }
    </script>
    <!-- Shiv Web Developer    -->
    <form name="razorpay_form" id="razorpay_form" action="<?php echo $callback_url; ?>" method="POST">
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    </form>
</body>

</html>