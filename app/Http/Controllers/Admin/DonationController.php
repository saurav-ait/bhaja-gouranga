<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationCategory;
use App\Models\Donor;
use App\Models\Member;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $donations = Donation::with(['category', 'donor', 'member'])
            ->when($request->search, function ($query, $search) {
                $query->where('receipt_no', 'like', "%{$search}%")
                    ->orWhereHas('donor', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('member', function ($q) use ($search) {
                        $q->where('full_name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.donations.index', compact('donations'));
    }

    public function create()
    {
        $categories = DonationCategory::where('is_active', true)
            ->orderBy('name')
            ->get();

        $donors = Donor::orderBy('name')->get();
        $members = Member::orderBy('full_name')->get();

        return view('admin.donations.create', compact(
            'categories',
            'donors',
            'members'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'donation_category_id' => [
                'required',
                'exists:donation_categories,id',
            ],
            'donor_id' => ['nullable', 'exists:donors,id'],
            'member_id' => ['nullable', 'exists:members,id'],
            'amount' => ['required', 'numeric', 'min:1'],
            'payment_method' => [
                'required',
                'in:cash,bank,bkash,nagad,other',
            ],
            'transaction_reference' => ['nullable', 'string', 'max:255'],
            'donation_date' => ['required', 'date', 'before_or_equal:today'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $validated['status'] = 'pending';

        Donation::create($validated);

        return redirect()
            ->route('admin.donations.index')
            ->with('success', 'Donation recorded successfully. Pending verification.');
    }

    public function show(Donation $donation)
    {
        $donation->load([
            'category',
            'donor',
            'member',
            'verifier'
        ]);

        return view('admin.donations.show', compact('donation'));
    }

    public function edit(Donation $donation)
    {
        // We will add safe editing rules in a later step.
        abort(404);
    }

    public function update(Request $request, Donation $donation)
    {
        abort(404);
    }

    public function destroy(Donation $donation)
    {
        // Financial records should not be deleted through this screen.
        abort(403);
    }

    public function verify(Donation $donation)
    {
        if ($donation->status !== 'pending') {
            return back()->with('error', 'Only pending donations can be verified.');
        }

        DB::transaction(function () use ($donation) {

            $donation = Donation::whereKey($donation->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($donation->status !== 'pending') {
                throw new \RuntimeException('Donation is no longer pending.');
            }

            $donation->update([
                'status' => 'verified',
                'receipt_no' => 'BGKS-' . now()->format('Y') . '-' .
                    str_pad($donation->id, 6, '0', STR_PAD_LEFT),
                'verified_by' => auth()->id(),
                'verified_at' => now(),
            ]);
        });

        return back()->with('success', 'Donation verified successfully.');
    }

    public function receipt(Donation $donation)
    {
        if ($donation->status !== 'verified' || !$donation->receipt_no) {
            return back()->with('error', 'Receipt is available only for verified donations.');
        }

        $donation->load([
            'category',
            'donor',
            'member',
            'verifier'
        ]);

        return view('admin.donations.receipt', compact('donation'));
    }
}