
@extends('layouts.admin')

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Donation Details</h2>

    <a href="{{ route('admin.donations.index') }}"
       style="padding:11px 16px;background:#eee;color:#333;text-decoration:none;border-radius:7px;">
        Back to Donations
    </a>
</div>

@if(session('success'))
    <div style="background:#d1e7dd; padding:12px; margin-bottom:15px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background:#f8d7da; padding:12px; margin-bottom:15px;">
        {{ session('error') }}
    </div>
@endif

<div style="background:white; padding:25px; border-radius:10px; max-width:800px;">

    <h3>Donation Information</h3>

    <p><strong>Receipt Number:</strong>
        {{ $donation->receipt_no ?? 'Not Generated Yet' }}
    </p>

    <p><strong>Donor:</strong>
        {{ $donation->donor?->name ?? $donation->member?->full_name ?? 'Anonymous' }}
    </p>

    <p><strong>Category:</strong> {{ $donation->category?->name }}</p>

    <p><strong>Amount:</strong>
        ৳{{ number_format((float) $donation->amount, 2) }}
    </p>

    <p><strong>Donation Date:</strong>
        {{ $donation->donation_date->format('d M Y') }}
    </p>

    <p><strong>Payment Method:</strong>
        {{ ucfirst($donation->payment_method) }}
    </p>

    <p><strong>Transaction Reference:</strong>
        {{ $donation->transaction_reference ?? 'N/A' }}
    </p>

    <p><strong>Status:</strong>
        <strong>{{ ucfirst($donation->status) }}</strong>
    </p>

    <p><strong>Verified By:</strong>
        {{ $donation->verifier?->name ?? 'N/A' }}
    </p>

    <p><strong>Notes:</strong> {{ $donation->notes ?? 'N/A' }}</p>

    <hr style="margin:20px 0;">

    @if($donation->status === 'pending')
        <form method="POST"
              action="{{ route('admin.donations.verify', $donation) }}"
              onsubmit="return confirm('Are you sure you want to verify this donation?');">
            @csrf

            <button type="submit"
                style="background:#176b45; color:white; padding:12px 22px; border:0; border-radius:5px; cursor:pointer;">
                Verify Donation
            </button>
        </form>

    @elseif($donation->status === 'verified')
        <a href="{{ route('admin.donations.receipt', $donation) }}"
           style="background:#176b45; color:white; padding:12px 22px; text-decoration:none; border-radius:5px;">
            Print Receipt
        </a>
    @else
        <p>This donation has been rejected.</p>
    @endif

</div>

@endsection
