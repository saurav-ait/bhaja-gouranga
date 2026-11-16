@extends('layouts.admin')

@section('title', 'Donor Details')

@section('content')
<style>
    .donor-details { max-width: 1100px; margin: auto; }
    .donor-header {
        display: flex; justify-content: space-between;
        align-items: center; flex-wrap: wrap; gap: 12px;
        margin-bottom: 22px;
    }
    .donor-header h2 { color: #14532d; margin-bottom: 5px; }
    .donor-card {
        background: #fff; padding: 24px; border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,.06);
        margin-bottom: 22px;
    }
    .donor-card h3 {
        color: #166534; margin: 0 0 18px;
        padding-bottom: 12px; border-bottom: 1px solid #e5e7eb;
    }
    .donor-info {
        display: grid; grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }
    .info-label { color: #6b7280; font-size: 13px; margin-bottom: 5px; }
    .info-value { color: #111827; font-weight: 600; }
    .donor-btn {
        display: inline-block; padding: 10px 17px;
        border-radius: 7px; text-decoration: none;
        font-weight: 600; border: none; cursor: pointer;
    }
    .btn-primary { background: #166534; color: #fff; }
    .btn-secondary { background: #e5e7eb; color: #374151; }
    .donor-table { width: 100%; border-collapse: collapse; }
    .donor-table th, .donor-table td {
        padding: 12px; text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }
    .donor-table th { background: #f0fdf4; color: #14532d; }
    .status {
        padding: 4px 9px; border-radius: 20px;
        font-size: 12px; font-weight: 600;
    }
    .verified { background: #dcfce7; color: #166534; }
    .pending { background: #fef3c7; color: #92400e; }
    .rejected { background: #fee2e2; color: #991b1b; }
    .table-responsive { overflow-x: auto; }
    @media(max-width: 650px) {
        .donor-info { grid-template-columns: 1fr; }
        .donor-card { padding: 16px; }
    }
</style>

<div class="donor-details">

    <div class="donor-header">
        <div>
            <h2>Donor Details</h2>
            <p>Donor information and donation history</p>
        </div>

        <div>
            @can('donors.edit')
                <a href="{{ route('admin.donors.edit', $donor) }}"
                   class="donor-btn btn-primary">Edit Donor</a>
            @endcan

            <a href="{{ route('admin.donors.index') }}"
               class="donor-btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="donor-card">
        <h3>Personal Information</h3>

        <div class="donor-info">
            <div>
                <div class="info-label">Donor Name</div>
                <div class="info-value">{{ $donor->name }}</div>
            </div>

            <div>
                <div class="info-label">Donor Type</div>
                <div class="info-value">
                    {{ ucfirst($donor->donor_type) }}
                </div>
            </div>

            <div>
                <div class="info-label">Phone Number</div>
                <div class="info-value">{{ $donor->phone ?: 'N/A' }}</div>
            </div>

            <div>
                <div class="info-label">Email Address</div>
                <div class="info-value">{{ $donor->email ?: 'N/A' }}</div>
            </div>

            <div>
                <div class="info-label">Address</div>
                <div class="info-value">{{ $donor->address ?: 'N/A' }}</div>
            </div>

            <div>
                <div class="info-label">Total Donations</div>
                <div class="info-value">{{ $donor->donations->count() }}</div>
            </div>
        </div>
    </div>

    <div class="donor-card">
        <h3>Donation History</h3>

        <div class="table-responsive">
            <table class="donor-table">
                <thead>
                    <tr>
                        <th>Receipt No.</th>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($donor->donations as $donation)
                        <tr>
                            <td>{{ $donation->receipt_no ?: 'Not Issued' }}</td>
                            <td>{{ $donation->donation_date?->format('d M Y') }}</td>
                            <td>{{ $donation->category?->name ?? 'N/A' }}</td>
                            <td>৳{{ number_format((float) $donation->amount, 2) }}</td>
                            <td>
                                <span class="status {{ $donation->status }}">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.donations.show', $donation) }}"
                                class="donor-btn btn-primary">
                                    View Donation
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding:25px;">
                                No donation history found.
                            </td>
                            
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection