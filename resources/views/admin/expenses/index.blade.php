
@extends('layouts.admin')

@section('title', 'Expense Management')

@section('content')

    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px; margin-bottom:25px;">
        <div>
            <h1 class="page-title">Expense Management</h1>
            <p class="subtitle">Manage Sangha expenses and expenditure records.</p>
        </div>

        @can('finance.manage')
            <a href="{{ route('admin.expenses.create') }}"
                style="background:#27845e;color:white;padding:12px 18px;border-radius:7px;text-decoration:none;"
               class="btn btn-primary">
                + Add New Expense
            </a>
        @endcan
    </div>

    <div class="panel">

        @if(session('success'))
            <div style="background:#dcfce7; color:#166534; padding:12px 16px; border-radius:8px; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        <h3>Expense Records</h3>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Recorded By</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($expenses as $expense)
                        <tr>
                            <td>
                                {{ $expense->expense_date->format('d M Y') }}
                            </td>

                            <td>
                                {{ $expense->category->name }}
                            </td>

                            <td>
                                {{ $expense->description ?: '—' }}
                            </td>

                            <td>
                                {{ ucfirst($expense->payment_method) }}
                            </td>

                            <td>
                                <strong>
                                    ৳{{ number_format($expense->amount, 2) }}
                                </strong>
                            </td>

                            <td>
                                {{ $expense->recorder?->name ?? 'N/A' }}
                            </td>

                            <td>
                                <a href="{{ route('admin.expenses.show', $expense) }}"
                                   class="btn btn-primary"
                                   style="color:#2463a6;text-decoration:none;margin-right:10px;">
                                    View
                                </a>

                                @can('finance.manage')
                                    <form action="{{ route('admin.expenses.destroy', $expense) }}"
                                          method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm('Are you sure you want to move this expense to trash?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger"
                                        style="border:0;background:none;color:#c0392b;cursor:pointer;margin-left:10px;">
                                            Delete
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; padding:25px;">
                                No expense records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;">
            {{ $expenses->links() }}
        </div>

    </div>

@endsection
