    <x-app-layout>
    <div class="container mt-5">
        <style>
            .payment-box {
                max-width: 500px;
                margin: auto;
                border: none;
            }
            .payment-box input:focus {
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
                border-color: #80bdff;
            }
        </style>

        <div class="card payment-box shadow-lg p-4 rounded-4">
            <h2 class="text-center mb-4 fw-bold">Generate Payment Link</h2>

            <!-- Simple POST Payment Link Form -->
            <form action="{{ route('payment.createLink') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="customerName" class="form-label">Customer Name</label>
                    <input type="text" id="customerName" name="customer_info[name]" class="form-control" placeholder="John Doe" required>
                </div>

                <div class="mb-3">
                    <label for="customerEmail" class="form-label">Customer Email</label>
                    <input type="email" id="customerEmail" name="customer_info[email]" class="form-control" placeholder="johndoe@email.com" required>
                </div>

                <div class="mb-3">
                    <label for="mobileCountryCode" class="form-label">Country Code</label>
                    <input type="text" id="mobileCountryCode" name="customer_info[mobile_country_code]" class="form-control" placeholder="+971" maxlength="5" required>
                </div>

                <div class="mb-3">
                    <label for="mobileNumber" class="form-label">Mobile Number</label>
                    <input type="text" id="mobileNumber" name="customer_info[mobile_number]" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" id="amount" name="transaction_info[amount]" class="form-control" placeholder="1000" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="currency" class="form-label">Currency</label>
                    <select id="currency" name="transaction_info[currency]" class="form-select" required>
                        <option value="AED">AED</option>
                        <option value="USD">USD</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success w-100 rounded-pill py-2">
                    Generate Link
                </button>
            </form>
        </div>
    </div>
    </x-app-layout>
