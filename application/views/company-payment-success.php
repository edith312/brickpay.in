<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full text-center">
        <h1 class="text-3xl font-bold text-green-600 mb-4">Thank You for Your Payment!</h1>
        <p class="text-lg text-gray-700 mb-2">CIN <span id="userName" class="font-semibold"><?= $user['ciin_number'] ?></span>,</p>
        <p class="text-gray-600 mb-4">We have successfully received your payment.</p>

        <div class="border-t border-b py-4 mb-6">
            <p class="text-gray-700"><span class="font-semibold">Payment Amount:</span> ₹<span id="paymentAmount">111.00</span></p>
            <p class="text-gray-700"><span class="font-semibold">Order Id ID:</span> <span id="transactionId"><?= $user['razorpay_order_id'] ?></span></p>
        </div>

        <p class="text-gray-600 mb-6">You will receive a confirmation email with further details shortly. If you have any questions, feel free to contact our support team at <a href="mailto:support@brickpay.in" class="text-blue-600 hover:underline">support@brickpay.in</a>.</p>
        <a href="<?= base_url('company/create-company-profile') ?>" class="inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">Create Company Profile</a>
    </div>

    <!-- Shiv Web Developer -->
</body>

</html>