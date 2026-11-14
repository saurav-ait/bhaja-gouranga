
@extends('layouts.admin')

@section('title', 'Add New Expense')

@section('content')

<style>
    .expense-form-card {
        background: #fff;
        padding: 28px;
        border-radius: 12px;
        border: 1px solid #e8eee9;
        box-shadow: 0 3px 12px rgba(23,60,50,.06);
        max-width: 850px;
    }

    .expense-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .expense-form-group {
        margin-bottom: 20px;
    }

    .expense-form-group label {
        display: block;
        font-weight: 600;
        color: #173c32;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .expense-form-group input,
    .expense-form-group select,
    .expense-form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #dce5df;
        border-radius: 7px;
        font-size: 14px;
        background: #fff;
    }

    .expense-form-group input:focus,
    .expense-form-group select:focus,
    .expense-form-group textarea:focus {
        outline: none;
        border-color: #27845e;
    }

    .expense-error {
        color: #dc2626;
        font-size: 13px;
        margin-top: 5px;
    }

    .expense-form-actions {
        display: flex;
        gap: 12px;
        margin-top: 10px;
    }

    .expense-cancel-btn {
        display: inline-block;
        padding: 11px 20px;
        background: #e5e7eb;
        color: #374151;
        text-decoration: none;
        border-radius: 7px;
        font-weight: 600;
    }

    .expense-btn {
        display: inline-block;
        padding: 11px 20px;
        border-radius: 7px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
    }

    .expense-btn-primary {
        background: #176b46;
        color: #fff;
    }

    @media(max-width: 600px) {
        .expense-form-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .expense-form-card {
            padding: 18px;
        }
    }
</style>

<div style="margin-bottom:25px;">
    <h1 class="page-title">Add New Expense</h1>
    <p class="subtitle">Record a new Sangha expense.</p>
</div>

<div class="expense-form-card">

    @if($errors->any())
        <div style="background:#fee2e2; color:#991b1b; padding:14px; border-radius:8px; margin-bottom:20px;">
            <strong>Please correct the following errors:</strong>
            <ul style="margin:8px 0 0 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.expenses.store') }}" method="POST">
        @csrf

        <div class="expense-form-grid">

            <div class="expense-form-group">
                <label>Expense Category *</label>

                <select name="expense_category_id" required>
                    <option value="">Select Category</option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('expense_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                @error('expense_category_id')
                    <div class="expense-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="expense-form-group">
                <label>Amount (BDT) *</label>

                <input type="number"
                       name="amount"
                       step="0.01"
                       min="0.01"
                       value="{{ old('amount') }}"
                       placeholder="Enter amount"
                       required>

                @error('amount')
                    <div class="expense-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="expense-form-group">
                <label>Expense Date *</label>

                <input type="date"
                       name="expense_date"
                       max="{{ now()->toDateString() }}"
                       value="{{ old('expense_date', now()->toDateString()) }}"
                       required>

                @error('expense_date')
                    <div class="expense-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="expense-form-group">
                <label>Payment Method *</label>

                <select name="payment_method" required>
                    <option value="cash" {{ old('payment_method', 'cash') == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="bank" {{ old('payment_method') == 'bank' ? 'selected' : '' }}>Bank</option>
                    <option value="bkash" {{ old('payment_method') == 'bkash' ? 'selected' : '' }}>bKash</option>
                    <option value="nagad" {{ old('payment_method') == 'nagad' ? 'selected' : '' }}>Nagad</option>
                    <option value="other" {{ old('payment_method') == 'other' ? 'selected' : '' }}>Other</option>
                </select>

                @error('payment_method')
                    <div class="expense-error">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="expense-form-group">
            <label>Transaction Reference</label>

            <input type="text"
                   name="transaction_reference"
                   value="{{ old('transaction_reference') }}"
                   placeholder="Transaction ID (if applicable)">

            @error('transaction_reference')
                <div class="expense-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="expense-form-group">
            <label>Description</label>

            <textarea name="description"
                      rows="3"
                      placeholder="Brief description of the expense">{{ old('description') }}</textarea>

            @error('description')
                <div class="expense-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="expense-form-group">
            <label>Additional Notes</label>

            <textarea name="notes"
                      rows="3"
                      placeholder="Additional information (optional)">{{ old('notes') }}</textarea>

            @error('notes')
                <div class="expense-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="expense-form-actions">
            <button type="submit" class="expense-btn expense-btn-primary">
                Save Expense
            </button>

            <a href="{{ route('admin.expenses.index') }}"
               class="expense-cancel-btn">
                Cancel
            </a>
        </div>

    </form>
</div>

@endsection
