
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <h1 class="page-title">Dashboard</h1>

    <p class="subtitle">
        Welcome to Bhaja Gouranga Kripa Sangha Management System.
    </p>

    {{-- Dashboard Statistics --}}
    <div class="cards">

        <div class="stat-card">
            <div class="label">Total Members</div>
            <div class="number">{{ number_format($totalMembers) }}</div>
        </div>

        <div class="stat-card">
            <div class="label">Total Donors</div>
            <div class="number">{{ number_format($totalDonors) }}</div>
        </div>

        <div class="stat-card">
            <div class="label">Individual Donors</div>
            <div class="number">{{ number_format($individualDonors) }}</div>
        </div>

        <div class="stat-card">
            <div class="label">Organization Donors</div>
            <div class="number">{{ number_format($organizationDonors) }}</div>
        </div>

        <div class="stat-card">
            <div class="label">Total Donations</div>
            <div class="number">৳ {{ number_format($totalDonations, 2) }}</div>
        </div>

        <div class="stat-card">
            <div class="label">Total Expenses</div>
            <div class="number">
                ৳ {{ number_format($totalExpenses, 2) }}
            </div>
        </div>

        <div class="stat-card">
            <div class="label">Pending Donations</div>
            <div class="number">{{ number_format($pendingDonations) }}</div>
        </div>

        <div class="stat-card">
            <div class="label">Verified Donations</div>
            <div class="number">{{ number_format($verifiedDonations) }}</div>
        </div>

        <div class="stat-card">
            <div class="label">Rejected Donations</div>
            <div class="number">{{ number_format($rejectedDonations) }}</div>
        </div>

    </div>

    {{-- Recent Donations --}}
    <div class="panel">
        <h3>Recent Donations</h3>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Donor Name</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Donation Date</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($recentDonations as $donation)
                        <tr>
                            <td>
                                {{ $donation->donor?->name ?? 'Anonymous' }}
                            </td>

                            <td>
                                {{ $donation->category?->name ?? 'N/A' }}
                            </td>

                            <td>
                                ৳{{ number_format($donation->amount, 2) }}
                            </td>

                            <td>
                                {{ $donation->donation_date?->format('d M Y') }}
                            </td>

                            <td>
                                <span class="status">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;">
                                No donations found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Organization Information --}}
    <div class="panel">
        <h3>Organization Information</h3>

        <p>
            <strong>Organization:</strong>
            Bhaja Gouranga Kripa Sangha
        </p>

        <p style="margin-top: 10px;">
            <strong>System:</strong>
            Management & Administration
        </p>

        <p style="margin-top: 10px;">
            <strong>Currency:</strong>
            BDT (৳)
        </p>
    </div>

@endsection
