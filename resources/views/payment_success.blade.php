<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Transaction Successful</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Manrope', sans-serif;
      background-color: #f8f9fa;
    }
    .bg-background {
      background-color: #f8f9fa;
    }
    .text-primary {
      color: #844693 !important; /* brand color */
    }
    .btn-primary {
      background-color: #844693 !important;
      border-color: #844693 !important;
    }
    .btn-primary:hover {
      background-color: #6a3776 !important;
      border-color: #6a3776 !important;
    }
  </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-background">

  <div class="container d-flex justify-content-center">
    <div class="border border-primary rounded-4 p-5 bg-white shadow-sm" style="max-width: 800px; width:100%;">
      <div class="text-center text-primary">
        <img src="done_icon.svg" alt="success payment icon" class="mb-3" style="max-width:100px;">
        <h2 class="fw-medium mb-2">Payment was successful</h2>
        <p class="text-muted">Payment has been sent successfully. Thank you for using ZAP.</p>
      </div>

      <div class="mt-3">
        <p class="fw-medium mb-1">Reference ID: <span id="mbmeRef">--</span></p>
        <p class="fw-medium">Order ID: <span id="oid">--</span></p>
      </div>

      <div class="d-flex flex-row gap-3 mt-4">
        <button type="button" id="backBtn" class="btn btn-primary w-100">
          Back To Payment Page
        </button>
      </div>
    </div>
  </div>

  <script>
    // Get URL parameters
    const params = new URLSearchParams(window.location.search);
    const oid = params.get("oid");
    const mbmeRef = params.get("mbme_reference_id");

    document.getElementById("oid").textContent = oid || "--";
    document.getElementById("mbmeRef").textContent = mbmeRef || "--";

    // Log params like useEffect
    console.log("PaymentSuccess mounted with URL params:", {
      mbme_reference_id: mbmeRef,
      oid: oid,
      source: document.referrer
    });

    // Button handler
    document.getElementById("backBtn").addEventListener("click", () => {
      window.location.href = "/payment"; // same as navigate(`/payment`)
    });
  </script>

</body>
</html>
