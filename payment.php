<html>

<head>
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
</head>

<body>

    <!-- Place this where you need payment button -->
    <button id="payment-button">Pay with Khalti</button>
    <div id="success-message" style="display: none;">
        <h2>Payment Successful!</h2>
        <p>Thank you for your payment. Your appointment has been confirmed.</p>
    </div>
<!-- Paste this code anywhere in your body tag -->
<script>
    var config = {
        // replace the publicKey with yours
        "publicKey": "test_public_key_f5d5b56d3d174f3188fa75168b38766f",
        "productIdentity": "Payment",
        "productName": "Minimal Payment",
        "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
        "paymentPreference": [
            "KHALTI",
            "EBANKING",
            "MOBILE_BANKING",
            "CONNECT_IPS",
            "SCT"
        ],
        "eventHandler": {
            onSuccess(payload) {
                // Send the payment details to the PHP script using AJAX
                console.log(payload);
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "save-payment.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Handle the response from the PHP script if needed
                        console.log(xhr.responseText);
                    }
                };
                var data = "token=" + encodeURIComponent(payload.token) +
                    "&amount=" + encodeURIComponent(payload.amount) +
                    "&transcation_id=" + encodeURIComponent(payload.transcation_id) +
                    // "&product_name=" + encodeURIComponent(payload.purchase_order_name);
                xhr.send(data);
            },
            onError(error) {
                console.log(error);
            },
            onClose() {
                console.log('widget is closing');
            }
        }
    };

    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("payment-button");
    btn.onclick = function () {
        // minimum transaction amount must be 10, i.e 1000 in paisa.
        checkout.show({ amount: 1000 });
    }
</script>

</body>

</html>