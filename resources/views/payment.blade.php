<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white text-center rounded-top-4">
                        <h3 class="mb-0">Make a Secure Payment</h3>
                    </div>

                    <div class="card-body p-4">
                        <!-- Single Payment Form -->
                        <form action="{{ route('payment.createOrder') }}" method="POST">
                            @csrf

                            <!-- Customer Info -->
                            <h5 class="mb-3 text-secondary">Customer Information</h5>
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="customer_info[name]" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="customer_info[email]" class="form-control" required>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Country Code</label>
                                    <input type="text" name="customer_info[mobile_country_code]" class="form-control" placeholder="+971" required>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="text" name="customer_info[mobile_number]" class="form-control" required>
                                </div>
                            </div>

                            <!-- Transaction Info -->
                            <h5 class="mt-4 mb-3 text-secondary">Transaction Details</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Amount (AED)</label>
                                    <input type="number" step="0.01" name="transaction_info[amount]" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Currency</label>
                                    <select name="transaction_info[currency]" class="form-select" required>
                                        <option value="AED">AED</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Payment Info -->
                            <h5 class="mt-4 mb-3 text-secondary">Payment Method</h5>
                            <div class="mb-3">
                                <label class="form-label">Payment Method ID</label>
                                <input type="text" name="payment_info[payment_method_id]" class="form-control" placeholder="e.g. 1" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Pay Now</button>
                            
                            </div>
                        </form>
                    </div>

                    <div class="card-footer text-center text-muted small">
                        <i class="bi bi-shield-lock"></i> Secured by MBME Payment Gateway
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
