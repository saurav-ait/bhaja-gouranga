<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DonorController extends Controller
{
    public function index(Request $request)
    {
        $donors = Donor::withCount('donations')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.donors.index', compact('donors'));
    }

    public function create()
    {
        return view('admin.donors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'donor_type' => [
                'required',
                'in:individual,organization',
            ],
        ]);

        Donor::create($validated);

        return redirect()
            ->route('admin.donors.index')
            ->with('success', 'Donor created successfully.');
    }

    public function show(Donor $donor)
    {
        $donor->load([
            'donations' => function ($query) {
                $query->with('category')->latest();
            }
        ]);

        return view('admin.donors.show', compact('donor'));
    }

    public function edit(Donor $donor)
    {
        return view('admin.donors.edit', compact('donor'));
    }

    public function update(Request $request, Donor $donor)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'donor_type' => [
                'required',
                'in:individual,organization',
            ],
        ]);

        $donor->update($validated);

        return redirect()
            ->route('admin.donors.index')
            ->with('success', 'Donor updated successfully.');
    }

    public function destroy(Donor $donor)
    {
        if ($donor->donations()->exists()) {
            return back()->with(
                'error',
                'This donor has donation records and cannot be deleted.'
            );
        }

        $donor->delete();

        return redirect()
            ->route('admin.donors.index')
            ->with('success', 'Donor deleted successfully.');
    }
}
