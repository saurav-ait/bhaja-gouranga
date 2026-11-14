
@extends('layouts.admin')

@section('title', 'Expense Details')

@section('content')

<style>
    .expense-details-card {
        background: #fff;
        padding: 28px;
        border-radius: 12px;
        border: 1px solid #e8eee9;
        box-shadow: 0 3px 12px rgba(23,60,50,.06);
        max-width: 850px;
    }

    .expense-details-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .expense-detail-item {
        border-bottom: 1px solid #edf1ee;
        padding-bottom: 14px;
    }

    .expense-detail-label {
        color: #77838a;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .expense-detail-value {
        color: #173c32;
        font-size: 15px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    @media(max-width: 600px) {
        .expense-details-grid {
            grid-template-columns: 1fr;
        }

        .expense-details-card {
            padding: 18px;
        }
    }
</style>

<div style="margin-bottom:25px;">
    <h1 class="page-title">Expense Details</h1>
    <p class="subtitle">Complete information about this expense.</p>
</div>

<div class="expense-details-card">

    <div class="expense-details-grid">

        <div class="expense-detail-item">
            <div class="expense-detail-label">Expense Category</div>
            <div class="expense-detail-value">
                {{ $expense->category->name }}
            </div>
        </div>

        <div class="expense-detail-item">
            <div class="expense-detail-label">Amount</div>
            <div class="expense-detail-value">
                ৳{{ number_format($expense->amount, 2) }}
            </div>
        </div>

        <div class="expense-detail-item">
            <div class="expense-detail-label">Expense Date</div>
            <div class="expense-detail-value">
                {{ $expense->expense_date->format('d M Y') }}
            </div>
        </div>

        <div class="expense-detail-item">
            <div class="expense-detail-label">Payment Method</div>
            <div class="expense-detail-value">
                {{ ucfirst($expense->payment_method) }}
            </div>
        </div>

        <div class="expense-detail-item">
            <div class="expense-detail-label">Transaction Reference</div>
            <div class="expense-detail-value">
                {{ $expense->transaction_reference ?: '—' }}
            </div>
        </div>

        <div class="expense-detail-item">
            <div class="expense-detail-label">Recorded By</div>
            <div class="expense-detail-value">
                {{ $expense->recorder?->name ?? 'N/A' }}
            </div>
        </div>

    </div>

    <div style="margin-top:25px;">
        <div class="expense-detail-label">Description</div>
        <div class="expense-detail-value">
            {{ $expense->description ?: 'No description provided.' }}
        </div>
    </div>

    <div style="margin-top:22px;">
        <div class="expense-detail-label">Additional Notes</div>
        <div class="expense-detail-value">
            {{ $expense->notes ?: 'No additional notes.' }}
        </div>
    </div>

    <div style="margin-top:25px; display:flex; gap:12px; flex-wrap:wrap;">
        <a href="{{ route('admin.expenses.index') }}"
                style="padding:11px 16px;background:#eee;color:#333;text-decoration:none;border-radius:7px;"
           class="btn btn-primary">
            Back to Expenses
        </a>
    </div>

</div>

@endsection
