
@extends('layouts.admin')

@section('title', 'Donors')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; gap:15px; flex-wrap:wrap;">
    <div>
        <h1>Donors</h1>
        <p>Manage Sangha donors and their contributions.</p>
    </div>

    @can('donors.create')
        <a href="{{ route('admin.donors.create') }}"
            style="background:#27845e;color:white;padding:12px 18px;border-radius:7px;text-decoration:none;"
            class="btn btn-primary">
            + Add New Donor
        </a>
    @endcan
</div>

@if(session('success'))
    <div class="alert alert-success"
    style="background:#e3f5eb;color:#23754d;padding:13px;border-radius:7px;margin-bottom:20px;">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger"
    style="background:#fef2f2;color:#7f1d1d;padding:13px;border-radius:7px;margin-bottom:20px;">{{ session('error') }}</div>
@endif

<div class="card">
    <form method="GET" action="{{ route('admin.donors.index') }}"
          style="display:flex;gap:10px;margin-bottom:20px;flex-wrap:wrap;">

        <input type="text" name="search"
               value="{{ request('search') }}"
               placeholder="Search name or phone..."
               style="flex:1;min-width:200px;padding:12px;border:1px solid #ddd;border-radius:7px;">

        <button type="submit"
                style="padding:12px 20px;background:#173c32;color:white;border:0;border-radius:7px;cursor:pointer;">
            Search
        </button>

        <a href="{{ route('admin.donors.index') }}"
           style="padding:12px 15px;background:#eee;color:#333;border-radius:7px;text-decoration:none;">
            Reset
        </a>
    </form>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Donor Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Donor Type</th>
                    <th>Donations</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($donors as $donor)
                    <tr>
                        <td>{{ $donors->firstItem() + $loop->index }}</td>
                        <td>{{ $donor->name }}</td>
                        <td>{{ $donor->phone ?? 'N/A' }}</td>
                        <td>{{ $donor->email ?? 'N/A' }}</td>
                        <td>{{ ucfirst($donor->donor_type) }}</td>
                        <td>{{ $donor->donations_count }}</td>
                        <td>
                            <a href="{{ route('admin.donors.show', $donor) }}"
                            class="btn btn-sm btn-info"
                            style="color:#2463a6;text-decoration:none;margin-right:10px;">View</a>

                            @can('donors.edit')
                                <a href="{{ route('admin.donors.edit', $donor) }}"
                                    style="color:#23754d;text-decoration:none;"
                                   class="btn btn-sm btn-warning">Edit</a>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;">
                            No donors found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        {{ $donors->links() }}
    </div>
</div>
@endsection
