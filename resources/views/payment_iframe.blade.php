<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Embedded Pay Checkout</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .debug-panel {
      background-color: #f8f9fa;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 12px;
      font-family: monospace;
      border: 1px solid #dee2e6;
    }
    .debug-messages {
      max-height: 200px;
      overflow-y: auto;
      margin-top: 10px;
      background-color: #ffffff;
      padding: 10px;
      border-radius: 4px;
      border: 1px solid #ced4da;
    }
    .debug-error {
      color: #dc3545;
    }
  </style>
</head>
<body class="bg-light">

<div class="container my-4">
  <h1 class="mb-4">Embedded Pay Checkout</h1>

  <!-- Debug Panel -->
  <div class="debug-panel">
    <strong style="color: #495057">Debug Information:</strong>
    <div id="debugInfo" class="debug-messages">
      <div style="color: #6c757d">No debug info yet...</div>
    </div>
  </div>

  <!-- Payment Parameters Display -->
  <div class="p-3 mb-4 rounded" style="background-color:#e7f3ff; border:1px solid #b3d9ff">
    <strong style="color:#0066cc">Payment Parameters:</strong>
    <div id="paymentParams" class="mt-2">
      <div><strong>Order ID:</strong> <span id="oidDisplay">Not provided</span></div>
      <div><strong>User ID:</strong> <span id="uidDisplay">Not provided</span></div>
      <div><strong>Timestamp:</strong> <span id="timestampDisplay">Not provided</span></div>
      <div><strong>Script Status:</strong> <span id="scriptStatus">⏳ Loading...</span></div>
      <div><strong>SecurePayment Class:</strong> <span id="secureClass">❌ Not Available</span></div>
    </div>
  </div>

  <!-- Payment Container -->
  <div id="payment-container" class="border rounded p-4 d-flex justify-content-center align-items-center bg-white" style="min-height:300px;">
    <div id="paymentStatus" class="text-center text-muted">
      <div style="font-size:16px; margin-bottom:10px">🔄 Loading payment script...</div>
      <div style="font-size:14px">Please wait while we initialize the payment system</div>
    </div>
  </div>

  <!-- Error Display -->
  <div id="errorBox" class="alert alert-danger mt-3 d-none">
    <strong>❌ Payment Error:</strong>
    <div id="errorMessage" class="mt-1"></div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // ====== CONFIG VARIABLES (Laravel se inject honge) ======
  const oid = "{{$oid}}"; 
  const uid = "{{$uid}}"; 
  const timestamp = "{{$timestamp}}"; 

  // ====== Debug Info ======
  const debugInfoEl = document.getElementById('debugInfo');
  function addDebugInfo(message, isError = false) {
    const ts = new Date().toLocaleTimeString();
    const div = document.createElement('div');
    div.textContent = `${ts}: ${message}`;
    if (isError) div.classList.add('debug-error');
    debugInfoEl.appendChild(div);
    debugInfoEl.scrollTop = debugInfoEl.scrollHeight;
    console.log(`[EmbeddedPayment] ${ts}: ${message}`);
  }

  function handleError(error) {
    const msg = error instanceof Error ? error.message :
                typeof error === 'string' ? error : JSON.stringify(error);
    document.getElementById('errorBox').classList.remove('d-none');
    document.getElementById('errorMessage').textContent = msg;
    addDebugInfo(`ERROR: ${msg}`, true);
  }

  // ====== Update Payment Params ======
  document.getElementById('oidDisplay').textContent = oid || 'Not provided';
  document.getElementById('uidDisplay').textContent = uid || 'Not provided';
  document.getElementById('timestampDisplay').textContent = timestamp || 'Not provided';

  // ====== Load Payment Script ======
  addDebugInfo('Component mounted, loading payment script...');
  const script = document.createElement('script');
  script.src = 'https://pgapi.mbme.org/scripts/payment_handler.js';
  script.async = true;

  script.onload = () => {
    addDebugInfo('Payment script loaded');
    document.getElementById('scriptStatus').textContent = '✅ Loaded';

    setTimeout(() => {
      if (window.SecurePayment) {
        document.getElementById('secureClass').textContent = '✅ Available';
        addDebugInfo('SecurePayment class available, starting initialization...');
        initPayment();
      } else {
        document.getElementById('secureClass').textContent = '❌ Not Available';
        handleError('SecurePayment class not found');
      }
    }, 100);
  };

  script.onerror = () => {
    document.getElementById('scriptStatus').textContent = '❌ Failed';
    handleError('Failed to load payment script - please check your internet connection');
  };

  document.head.appendChild(script);

  // ====== Initialize Payment ======
  function initPayment() {
    if (!oid || !uid || !timestamp) {
      handleError('Missing required payment parameters');
      return;
    }

    const container = document.getElementById('payment-container');
    container.innerHTML = '<div id="paymentStatus" class="text-center text-muted"></div>'; // ✅ fresh div create

    try {
      const paymentConfig = {
        elementId: 'payment-container',
        oid: oid,
        uid: uid,
        baseUrl: 'https://pgapi.mbme.org',
        timestamp: timestamp,
        styles: {
          container: { backgroundColor: '#ffffff', borderRadius: '12px', boxShadow: '0 1px 3px rgba(0,0,0,0.12)', padding: '20px', maxWidth: '400px', margin: '0 auto' },
          title: { fontSize: '20px', fontWeight: '600', color: '#844693', marginBottom: '12px' },
          subtitle: { fontSize: '14px', color: '#6a3776', marginBottom: '20px' },
          input: { height: '38px', padding: '0 12px', fontSize: '14px', borderWidth: '1px', borderColor: '#dddddd', borderRadius: '4px', backgroundColor: '#ffffff', color: '#333333', marginBottom: '8px' },
          label: { fontSize: '14px', color: '#844693', fontWeight: '500', marginBottom: '6px' },
          button: { height: '40px', backgroundColor: '#844693', color: '#ffffff', fontSize: '14px', fontWeight: '500', borderRadius: '4px', padding: '0 16px', width: '100%', marginTop: '20px', cursor: 'pointer' }
        }
      };

      addDebugInfo('Creating SecurePayment instance...');
      const payment = new window.SecurePayment(paymentConfig);

      payment.initialize()
        .then(() => {
          addDebugInfo('Payment initialized successfully!');
          document.getElementById('paymentStatus').innerHTML =
            '<div class="text-success"><div style="font-size:16px;margin-bottom:10px">⚡ Payment Initialized</div><div style="font-size:14px">Secure payment form is ready</div></div>';
        })
        .catch((err) => {
          handleError(`Payment initialization failed: ${err.message || err}`);
        });
    } catch (err) {
      handleError(`Failed to create payment instance: ${err.message}`);
    }
  }
</script>

</body>
</html>
