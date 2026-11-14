
@extends('layouts.admin')

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Donation Management</h2>

    <a href="{{ route('admin.donations.create') }}"
       style="background:#176b45; color:white; padding:10px 16px; text-decoration:none; border-radius:5px;">
        + Add Donation
    </a>
</div>

@if(session('success'))
    <div style="background:#d1e7dd; color:#0f5132; padding:12px; border-radius:5px; margin-bottom:15px;">
        {{ session('success') }}
    </div>
@endif

<div style="background:white; padding:20px; border-radius:10px; overflow-x:auto;">

    <form method="GET" action="{{ route('admin.donations.index') }}" style="margin-bottom:20px;">
        <input type="text" name="search"
            value="{{ request('search') }}"
            placeholder="Search receipt or donor/member..."
            style="padding:10px; width:280px; max-width:100%;">

        <button type="submit"
            style="padding:10px 16px; background:#176b45; color:white; border:none; border-radius:5px;">
            Search
        </button>

        <a href="{{ route('admin.donations.index') }}"
            style="padding:12px 15px;background:#eee;color:#333;border-radius:7px;text-decoration:none;">
            Reset
        </a>
    </form>

    <table style="width:100%; border-collapse:collapse; min-width:750px;">
        <thead>
            <tr style="background:#f1f4f2; text-align:left;">
                <th style="padding:12px;">Date</th>
                <th style="padding:12px;">Donor / Member</th>
                <th style="padding:12px;">Category</th>
                <th style="padding:12px;">Amount</th>
                <th style="padding:12px;">Payment</th>
                <th style="padding:12px;">Status</th>
                <th style="padding:12px;">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($donations as $donation)
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:12px;">
                        {{ $donation->donation_date->format('d M Y') }}
                    </td>

                    <td style="padding:12px;">
                        {{ $donation->donor?->name ?? $donation->member?->full_name ?? 'Anonymous' }}
                    </td>

                    <td style="padding:12px;">
                        {{ $donation->category?->name ?? 'N/A' }}
                    </td>

                    <td style="padding:12px;">
                        ৳{{ number_format((float) $donation->amount, 2) }}
                    </td>

                    <td style="padding:12px;">
                        {{ ucfirst($donation->payment_method) }}
                    </td>

                    <td style="padding:12px;">
                        @if($donation->status === 'verified')
                            <span style="color:green; font-weight:bold;">Verified</span>
                        @elseif($donation->status === 'rejected')
                            <span style="color:red; font-weight:bold;">Rejected</span>
                        @else
                            <span style="color:#b7791f; font-weight:bold;">Pending</span>
                        @endif
                    </td>

                    <td style="padding:12px;">
                        <a href="{{ route('admin.donations.show', $donation) }}"
                        style="color:#23754d;text-decoration:none;">
                            View
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="padding:20px; text-align:center;">
                        No donations found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:20px;">
        {{ $donations->links() }}
    </div>

</div>

@endsection
