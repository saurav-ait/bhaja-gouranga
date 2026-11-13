
@extends('layouts.admin')

@section('title', 'Member Profile')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap;margin-bottom:25px;">
    <div>
        <h1 class="page-title">Member Profile</h1>
        <p class="subtitle" style="margin-bottom:0;">View complete member information.</p>
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <a href="{{ route('admin.members.index') }}"
           style="padding:11px 16px;background:#eee;color:#333;text-decoration:none;border-radius:7px;">
            Back to Members
        </a>

        <a href="{{ route('admin.members.edit', $member) }}"
           style="padding:11px 16px;background:#27845e;color:white;text-decoration:none;border-radius:7px;">
            Edit Member
        </a>
    </div>
</div>

<div class="panel">

    <div style="display:flex;align-items:center;gap:20px;flex-wrap:wrap;margin-bottom:25px;">

        @if($member->photo_path)
            <img src="{{ asset('storage/'.$member->photo_path) }}"
                alt="{{ $member->full_name }}"
                style="width:100px;height:100px;object-fit:cover;border-radius:50%;border:3px solid #e3f5eb;">
        @else
            <div style="width:100px;height:100px;border-radius:50%;background:#e3f5eb;color:#23754d;display:flex;align-items:center;justify-content:center;font-size:35px;font-weight:bold;">
                {{ strtoupper(substr($member->full_name, 0, 1)) }}
            </div>
        @endif

        <div>
            <h2 style="font-size:22px;margin-bottom:8px;">
                {{ $member->full_name }}
            </h2>

            <p style="color:#77838a;">
                Member ID: {{ $member->member_code }}
            </p>

            <div style="margin-top:10px;">
                <span class="status"
                      style="{{ $member->status === 'inactive' ? 'background:#fce8e6;color:#b3261e;' : '' }}">
                    {{ ucfirst($member->status) }}
                </span>
            </div>
        </div>

    </div>

    <hr style="border:0;border-top:1px solid #eee;margin-bottom:22px;">

    <h3 style="margin-bottom:20px;">Personal Information</h3>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:25px;">

        <div>
            <small style="color:#77838a;">Full Name</small>
            <p style="margin-top:7px;">{{ $member->full_name }}</p>
        </div>

        <div>
            <small style="color:#77838a;">Member Code</small>
            <p style="margin-top:7px;">{{ $member->member_code }}</p>
        </div>

        <div>
            <small style="color:#77838a;">Phone Number</small>
            <p style="margin-top:7px;">{{ $member->phone }}</p>
        </div>

        <div>
            <small style="color:#77838a;">Email Address</small>
            <p style="margin-top:7px;">{{ $member->email ?: 'Not provided' }}</p>
        </div>

        <div>
            <small style="color:#77838a;">Joining Date</small>
            <p style="margin-top:7px;">
                {{ $member->joining_date?->format('d F Y') ?? 'Not provided' }}
            </p>
        </div>

        <div>
            <small style="color:#77838a;">Member Status</small>
            <p style="margin-top:7px;">{{ ucfirst($member->status) }}</p>
        </div>

    </div>

    <hr style="border:0;border-top:1px solid #eee;margin:25px 0;">

    <h3 style="margin-bottom:15px;">Address</h3>
    <p>{{ $member->address ?: 'No address provided.' }}</p>

    <hr style="border:0;border-top:1px solid #eee;margin:25px 0;">

    <h3 style="margin-bottom:15px;">Additional Notes</h3>
    <p>{{ $member->notes ?: 'No notes available.' }}</p>

    <hr style="border:0;border-top:1px solid #eee;margin:25px 0;">

    <div style="color:#77838a;font-size:12px;">
        Created: {{ $member->created_at?->format('d M Y, h:i A') ?? '—' }}
        <br>
        Last Updated: {{ $member->updated_at?->format('d M Y, h:i A') ?? '—' }}
    </div>

</div>

@endsection
