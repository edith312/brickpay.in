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
        <p class="text-lg text-gray-700 mb-2">Dear <span id="userName" class="font-semibold">John Doe</span>,</p>
        <p class="text-gray-600 mb-4">We have successfully received your payment.</p>
        <!-- Shiv Web Developer    -->
        <div class="border-t border-b py-4 mb-6">
            <p class="text-gray-700"><span class="font-semibold">Payment Amount:</span> $<span id="paymentAmount">49.99</span></p>
            <p class="text-gray-700"><span class="font-semibold">Transaction ID:</span> <span id="transactionId">TXN123456789</span></p>
            <p class="text-gray-700"><span class="font-semibold">Date:</span> <span id="paymentDate">April 25, 2025</span></p>
        </div>

        <p class="text-gray-600 mb-6">You will receive a confirmation email with further details shortly. If you have any questions, feel free to contact our support team at <a href="mailto:support@example.com" class="text-blue-600 hover:underline">support@example.com</a>.</p>

        <a href="/" class="inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">Return to Home</a>
    </div>

    <script>
        // Simulate dynamic data (replace with actual data from your backend)
        const userData = {
            name: "John Doe",
            amount: "49.99",
            transactionId: "TXN123456789",
            date: "April 25, 2025"
        };
        // <!-- Shiv Web Developer    -->
        document.getElementById("userName").textContent = userData.name;
        document.getElementById("paymentAmount").textContent = userData.amount;
        document.getElementById("transactionId").textContent = userData.transactionId;
        document.getElementById("paymentDate").textContent = userData.date;
    </script>
</body>

</html>