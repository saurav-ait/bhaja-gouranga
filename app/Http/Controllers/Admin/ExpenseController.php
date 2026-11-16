<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    // Expense List
    public function index()
    {
        $expenses = Expense::with(['category', 'recorder'])
            ->latest('expense_date')
            ->paginate(10);

        return view('admin.expenses.index', compact('expenses'));
    }

    // Create Expense Form
    public function create()
    {
        $categories = ExpenseCategory::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.expenses.create', compact('categories'));
    }

    // Save Expense
    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_category_id' => 'required|exists:expense_categories,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,bank,bkash,nagad,other',
            'transaction_reference' => 'nullable|string|max:255',
            'expense_date' => 'required|date|before_or_equal:today',
            'description' => 'nullable|string|max:1000',
            'notes' => 'nullable|string|max:2000',
        ]);

        $validated['recorded_by'] = auth()->id();

        Expense::create($validated);

        return redirect()
            ->route('admin.expenses.index')
            ->with('success', 'Expense recorded successfully.');
    }

    // Expense Details
    public function show(Expense $expense)
    {
        $expense->load(['category', 'recorder']);

        return view('admin.expenses.show', compact('expense'));
    }

    // Soft Delete Expense
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()
            ->route('admin.expenses.index')
            ->with('success', 'Expense moved to trash.');
    }
}
