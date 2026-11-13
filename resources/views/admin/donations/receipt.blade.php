
<!DOCTYPE html>
<html>
<head>
    <title>Donation Receipt - {{ $donation->receipt_no }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }

        .receipt {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 35px;
            border: 2px solid #176b45;
        }

        .center { text-align: center; }

        .line {
            border-bottom: 1px dashed #999;
            padding: 12px 0;
        }

        .print-button {
            display: block;
            margin: 20px auto;
            padding: 12px 25px;
            background: #176b45;
            color: white;
            border: none;
            cursor: pointer;
        }

        @media print {
            body { background: white; padding: 0; }
            .receipt { border: 2px solid #176b45; }
            .print-button { display: none; }
        }
    </style>
</head>

<body>

<div class="receipt">

    <div class="center">
        <h2>Bhaja Gouranga Kripa Sangha</h2>
        <p>Official Donation Receipt</p>
        <hr>
    </div>

    <div class="line">
        <strong>Receipt No:</strong> {{ $donation->receipt_no }}
    </div>

    <div class="line">
        <strong>Date:</strong> {{ $donation->donation_date->format('d M Y') }}
    </div>

    <div class="line">
        <strong>Received From:</strong>
        {{ $donation->donor?->name ?? $donation->member?->full_name ?? 'Anonymous Donor' }}
    </div>

    <div class="line">
        <strong>Donation Category:</strong> {{ $donation->category?->name }}
    </div>

    <div class="line">
        <strong>Amount:</strong>
        ৳{{ number_format((float) $donation->amount, 2) }}
    </div>

    <div class="line">
        <strong>Payment Method:</strong> {{ ucfirst($donation->payment_method) }}
    </div>

    <div class="line">
        <strong>Verified By:</strong> {{ $donation->verifier?->name ?? 'N/A' }}
    </div>

    <div style="margin-top:50px; display:flex; justify-content:space-between;">
        <div>_________________<br>Received By</div>
        <div>_________________<br>Authorized Signature</div>
    </div>

    <div class="center" style="margin-top:30px;">
        <p>Thank you for your generous contribution.</p>
        <small>Hare Krishna</small>
    </div>

</div>

<button class="print-button" onclick="window.print()">
    Print Receipt
</button>

</body>
</html>
