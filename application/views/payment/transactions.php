<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<!-- Shiv Web Developer -->

<body>
    <div class="container mt-5">
        <h2>Transaction History</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Transaction ID</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?php echo ucfirst($transaction->type); ?></td>
                        <td>₹<?php echo $transaction->amount; ?></td>
                        <td><?php echo ucfirst($transaction->status); ?></td>
                        <td><?php echo $transaction->razorpay_payment_id ?: '-'; ?></td>
                        <td><?php echo $transaction->created_at; ?></td>
                        <td>
                            <?php if ($transaction->status == 'failed' || $transaction->status == 'pending'): ?>
                                <a href="<?php echo base_url('payment/process/' . $transaction->type . '/' . $transaction->id); ?>" class="btn btn-sm btn-primary">Retry</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</body>

</html>