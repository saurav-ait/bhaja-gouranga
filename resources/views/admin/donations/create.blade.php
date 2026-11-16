
@extends('layouts.admin')

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Record New Donation</h2>
    <a href="{{ route('admin.donations.index') }}"
       style="padding:10px 16px; background:#6c757d; color:white; text-decoration:none; border-radius:5px;">
        Back to Donations
    </a>
</div>

<div style="background:white; padding:25px; border-radius:10px; max-width:850px;">

    @if ($errors->any())
        <div style="background:#f8d7da; color:#842029; padding:12px; border-radius:5px; margin-bottom:20px;">
            <strong>Please correct the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.donations.store') }}" method="POST">
        @csrf

        <div style="margin-bottom:18px;">
            <label>Donation Category *</label>
            <select name="donation_category_id" required style="width:100%; padding:10px; margin-top:6px;">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('donation_category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:18px;">
            <label>Donor</label>
            <select name="donor_id" style="width:100%; padding:10px; margin-top:6px;">
                <option value="">Select Donor (Optional)</option>
                @foreach ($donors as $donor)
                    <option value="{{ $donor->id }}"
                        {{ old('donor_id') == $donor->id ? 'selected' : '' }}>
                        {{ $donor->name }} - {{ $donor->phone }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:18px;">
            <label>Member</label>
            <select name="member_id" style="width:100%; padding:10px; margin-top:6px;">
                <option value="">Select Member (Optional)</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}"
                        {{ old('member_id') == $member->id ? 'selected' : '' }}>
                        {{ $member->member_code }} - {{ $member->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px; margin-bottom:18px;">
            <div>
                <label>Amount (BDT) *</label>
                <input type="number" name="amount" min="1" step="0.01"
                    value="{{ old('amount') }}" required
                    style="width:100%; padding:10px; margin-top:6px;">
            </div>

            <div>
                <label>Donation Date *</label>
                <input type="date" name="donation_date"
                    value="{{ old('donation_date', date('Y-m-d')) }}"
                    max="{{ date('Y-m-d') }}" required
                    style="width:100%; padding:10px; margin-top:6px;">
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px; margin-bottom:18px;">
            <div>
                <label>Payment Method *</label>
                <select name="payment_method" required style="width:100%; padding:10px; margin-top:6px;">
                    <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="bank" {{ old('payment_method') == 'bank' ? 'selected' : '' }}>Bank</option>
                    <option value="bkash" {{ old('payment_method') == 'bkash' ? 'selected' : '' }}>bKash</option>
                    <option value="nagad" {{ old('payment_method') == 'nagad' ? 'selected' : '' }}>Nagad</option>
                    <option value="other" {{ old('payment_method') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div>
                <label>Transaction Reference</label>
                <input type="text" name="transaction_reference"
                    value="{{ old('transaction_reference') }}"
                    placeholder="Transaction ID (if applicable)"
                    style="width:100%; padding:10px; margin-top:6px;">
            </div>
        </div>

        <div style="margin-bottom:20px;">
            <label>Notes</label>
            <textarea name="notes" rows="3"
                style="width:100%; padding:10px; margin-top:6px;">{{ old('notes') }}</textarea>
        </div>

        <button type="submit"
            style="background:#176b45; color:white; border:none; padding:12px 24px; border-radius:5px; cursor:pointer;">
            Save Donation
        </button>

    </form>
</div>

@endsection
