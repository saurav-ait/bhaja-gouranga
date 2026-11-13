
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <h1 class="page-title">Dashboard</h1>
    <p class="subtitle">
        Welcome to Bhaja Gouranga Kripa Sangha Management System.
    </p>

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
            <div class="label">Total Donations</div>
            <div class="number">৳ 0.00</div>
        </div>

        <div class="stat-card">
            <div class="label">Total Expenses</div>
            <div class="number">৳ 0.00</div>
        </div>

    </div>

    <div class="panel">
        <h3>Recent Activities</h3>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Activity</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>—</td>
                        <td>System Created</td>
                        <td>Admin panel initialized</td>
                        <td><span class="status">Completed</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel">
        <h3>Organization Information</h3>

        <p><strong>Organization:</strong> Bhaja Gouranga Kripa Sangha</p>
        <p style="margin-top: 10px;">
            <strong>System:</strong> Management & Administration
        </p>
        <p style="margin-top: 10px;">
            <strong>Currency:</strong> BDT (৳)
        </p>
    </div>

@endsection
