<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DonationCategoryController extends Controller
{
    public function index()
    {
        $categories = DonationCategory::withCount('donations')
            ->latest()
            ->paginate(10);

        return view('admin.donation-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.donation-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:donation_categories,name'],
            'description' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
        ]);

        DonationCategory::create($validated);

        return redirect()
            ->route('admin.donation-categories.index')
            ->with('success', 'Donation category created successfully.');
    }

    public function edit(DonationCategory $donation_category)
    {
        return view('admin.donation-categories.edit', [
            'category' => $donation_category,
        ]);
    }

    public function update(Request $request, DonationCategory $donation_category)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('donation_categories', 'name')->ignore($donation_category->id),
            ],
            'description' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
        ]);

        $donation_category->update($validated);

        return redirect()
            ->route('admin.donation-categories.index')
            ->with('success', 'Donation category updated successfully.');
    }

    public function destroy(DonationCategory $donation_category)
    {
        if ($donation_category->donations()->exists()) {
            return back()->with('error', 'This category has donations and cannot be deleted.');
        }

        $donation_category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }
}