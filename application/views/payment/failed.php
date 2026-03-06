<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- Shiv Web Developer    -->
    <div class="container mt-5">
        <div class="alert alert-danger">
            <h4>Payment Failed!</h4>
            <p>Transaction ID: <?php echo $transaction->razorpay_payment_id; ?></p>
            <p>Amount: ₹<?php echo $transaction->amount; ?></p>
            <p>Type: <?php echo ucfirst($transaction->type); ?></p>
            <a href="<?php echo base_url('payment/process/' . $transaction->type . '/' . $transaction->id); ?>" class="btn btn-primary">Retry Payment</a>
            <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-secondary">Go to Dashboard</a>
        </div>
    </div>
</body>

</html>