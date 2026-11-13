<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Donor;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = Member::count();
        $totalDonors = Donor::count();

        return view('admin.dashboard', compact(
            'totalMembers',
            'totalDonors'
        ));
    }
}
