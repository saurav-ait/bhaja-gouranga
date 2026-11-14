
@extends('layouts.admin')

@section('title', 'Add New Donor')

@section('content')

<style>
    .donor-page {
        max-width: 850px;
        margin: 0 auto;
    }

    .donor-heading {
        margin-bottom: 24px;
    }

    .donor-heading h1 {
        font-size: 25px;
        font-weight: 700;
        color: #174b36;
        margin-bottom: 6px;
    }

    .donor-heading p {
        color: #718096;
        margin: 0;
    }

    .donor-card {
        background: #fff;
        border: 1px solid #e5eae7;
        border-radius: 12px;
        padding: 28px;
        box-shadow: 0 4px 15px rgba(0,0,0,.04);
    }

    .donor-section-title {
        font-size: 17px;
        font-weight: 700;
        color: #174b36;
        margin-bottom: 22px;
        padding-bottom: 12px;
        border-bottom: 1px solid #edf0ee;
    }

    .donor-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .donor-field {
        margin-bottom: 20px;
    }

    .donor-field.full {
        grid-column: 1 / -1;
    }

    .donor-field label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #344b40;
        font-size: 14px;
    }

    .donor-field input,
    .donor-field select,
    .donor-field textarea {
        display: block;
        width: 100%;
        padding: 11px 13px;
        border: 1px solid #d8e1db;
        border-radius: 7px;
        background: #fff;
        color: #26382f;
        font-size: 14px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .donor-field input:focus,
    .donor-field select:focus,
    .donor-field textarea:focus {
        border-color: #21845a;
        box-shadow: 0 0 0 3px rgba(33,132,90,.12);
    }

    .donor-field textarea {
        resize: vertical;
        min-height: 100px;
    }

    .donor-error {
        display: block;
        color: #dc2626;
        font-size: 12px;
        margin-top: 5px;
    }

    .donor-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        border-top: 1px solid #edf0ee;
        padding-top: 20px;
        margin-top: 8px;
    }

    .donor-btn {
        display: inline-block;
        padding: 11px 20px;
        border-radius: 7px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
    }

    .donor-btn-primary {
        background: #176b46;
        color: #fff;
    }

    .donor-btn-primary:hover {
        background: #105638;
        color: #fff;
    }

    .donor-btn-secondary {
        background: #edf1ee;
        color: #344b40;
    }

    @media(max-width: 600px) {
        .donor-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .donor-card {
            padding: 18px;
        }

        .donor-actions {
            flex-direction: column-reverse;
        }

        .donor-actions .donor-btn {
            text-align: center;
            width: 100%;
        }
    }
</style>

<div class="donor-page">

    <div class="donor-heading">
        <h1>Add New Donor</h1>
        <p>Register a donor for Bhaja Gouranga Kripa Sangha.</p>
    </div>

    <div class="donor-card">

        <div class="donor-section-title">
            Donor Information
        </div>

        <form action="{{ route('admin.donors.store') }}" method="POST">
            @csrf

            <div class="donor-grid">

                <div class="donor-field">
                    <label for="name">Donor Name *</label>
                    <input type="text" id="name" name="name"
                           value="{{ old('name') }}"
                           placeholder="Enter donor name" required>
                    @error('name')
                        <span class="donor-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="donor-field">
                    <label for="donor_type">Donor Type *</label>
                    <select name="donor_type" id="donor_type" required>
                        <option value="individual"
                            {{ old('donor_type', 'individual') == 'individual' ? 'selected' : '' }}>
                            Individual
                        </option>
                        <option value="organization"
                            {{ old('donor_type') == 'organization' ? 'selected' : '' }}>
                            Organization
                        </option>
                    </select>
                    @error('donor_type')
                        <span class="donor-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="donor-field">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone"
                           value="{{ old('phone') }}"
                           placeholder="Enter phone number">
                    @error('phone')
                        <span class="donor-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="donor-field">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="Enter email address">
                    @error('email')
                        <span class="donor-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="donor-field full">
                    <label for="address">Full Address</label>
                    <textarea id="address" name="address"
                              placeholder="Enter donor address">{{ old('address') }}</textarea>
                    @error('address')
                        <span class="donor-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="donor-actions">
                <a href="{{ route('admin.donors.index') }}"
                   class="donor-btn donor-btn-secondary">
                    Cancel
                </a>

                <button type="submit"
                        class="donor-btn donor-btn-primary">
                    Save Donor
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
