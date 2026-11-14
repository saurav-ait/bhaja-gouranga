@extends('layouts.admin')

@section('title', 'Edit Donor')

@section('content')
<style>
    .donor-page { max-width: 950px; margin: auto; }
    .donor-heading { margin-bottom: 22px; }
    .donor-heading h2 { color: #14532d; margin-bottom: 6px; }
    .donor-card {
        background: #fff; padding: 28px; border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,.06);
    }
    .donor-section-title {
        color: #166534; font-size: 17px; font-weight: 600;
        margin-bottom: 20px; border-bottom: 1px solid #e5e7eb;
        padding-bottom: 12px;
    }
    .donor-grid {
        display: grid; grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    .donor-field { margin-bottom: 18px; }
    .donor-field label {
        display: block; font-weight: 600; margin-bottom: 7px;
        color: #374151;
    }
    .donor-field input, .donor-field select, .donor-field textarea {
        width: 100%; padding: 11px 13px; border: 1px solid #d1d5db;
        border-radius: 7px; font-size: 14px; box-sizing: border-box;
    }
    .donor-field input:focus, .donor-field select:focus,
    .donor-field textarea:focus {
        outline: none; border-color: #15803d;
        box-shadow: 0 0 0 3px rgba(21,128,61,.10);
    }
    .donor-actions { display: flex; gap: 10px; margin-top: 12px; }
    .donor-btn {
        padding: 11px 20px; border: none; border-radius: 7px;
        cursor: pointer; text-decoration: none; font-weight: 600;
    }
    .donor-btn-primary { background: #166534; color: white; }
    .donor-btn-secondary { background: #e5e7eb; color: #374151; }
    .donor-error { color: #dc2626; font-size: 13px; margin-top: 5px; }
    @media(max-width: 650px) {
        .donor-grid { grid-template-columns: 1fr; }
        .donor-card { padding: 18px; }
    }
</style>

<div class="donor-page">
    <div class="donor-heading">
        <h2>Edit Donor</h2>
        <p>Update donor information.</p>
    </div>

    <div class="donor-card">
        <div class="donor-section-title">Donor Information</div>

        <form action="{{ route('admin.donors.update', $donor) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="donor-grid">
                <div class="donor-field">
                    <label>Donor Name *</label>
                    <input type="text" name="name"
                        value="{{ old('name', $donor->name) }}" required>
                    @error('name') <div class="donor-error">{{ $message }}</div> @enderror
                </div>

                <div class="donor-field">
                    <label>Donor Type *</label>
                    <select name="donor_type" required>
                        <option value="individual"
                            {{ old('donor_type', $donor->donor_type) == 'individual' ? 'selected' : '' }}>
                            Individual
                        </option>
                        <option value="organization"
                            {{ old('donor_type', $donor->donor_type) == 'organization' ? 'selected' : '' }}>
                            Organization
                        </option>
                    </select>
                    @error('donor_type') <div class="donor-error">{{ $message }}</div> @enderror
                </div>

                <div class="donor-field">
                    <label>Phone Number</label>
                    <input type="text" name="phone"
                        value="{{ old('phone', $donor->phone) }}">
                    @error('phone') <div class="donor-error">{{ $message }}</div> @enderror
                </div>

                <div class="donor-field">
                    <label>Email Address</label>
                    <input type="email" name="email"
                        value="{{ old('email', $donor->email) }}">
                    @error('email') <div class="donor-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="donor-field">
                <label>Address</label>
                <textarea name="address" rows="3">{{ old('address', $donor->address) }}</textarea>
                @error('address') <div class="donor-error">{{ $message }}</div> @enderror
            </div>

            <div class="donor-actions">
                <button type="submit" class="donor-btn donor-btn-primary">
                    Update Donor
                </button>

                <a href="{{ route('admin.donors.index') }}"
                    class="donor-btn donor-btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection