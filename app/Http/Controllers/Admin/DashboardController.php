<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Donor;
use App\Models\Donation;
use App\Models\Expense;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = Member::count();

        $totalDonors = Donor::count();

        $individualDonors = Donor::where(
            'donor_type',
            'individual'
        )->count();

        $organizationDonors = Donor::where(
            'donor_type',
            'organization'
        )->count();

        $totalDonations = Donation::where('status', 'verified')
        ->sum('amount');

        $recentDonations = Donation::with(['donor', 'category'])
        ->latest('donation_date')
        ->take(5)
        ->get();

        $pendingDonations = Donation::where('status', 'pending')->count();

        $verifiedDonations = Donation::where('status', 'verified')->count();

        $rejectedDonations = Donation::where('status', 'rejected')->count();

        $totalExpenses = Expense::sum('amount');

        return view('admin.dashboard', compact(
            'totalMembers',
            'totalDonors',
            'individualDonors',
            'organizationDonors',
            'totalDonations',
            'recentDonations',
            'pendingDonations',
            'verifiedDonations',
            'rejectedDonations',
            'totalExpenses'
        ));
    }
}
