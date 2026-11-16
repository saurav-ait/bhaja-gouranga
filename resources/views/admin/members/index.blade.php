
@extends('layouts.admin')

@section('title', 'Members')

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; gap:15px; flex-wrap:wrap;">
    <div>
        <h1 class="page-title">Members Management</h1>
        <p class="subtitle" style="margin-bottom:0;">Manage organization members.</p>
    </div>

    <a href="{{ route('admin.members.create') }}"
       style="background:#27845e;color:white;padding:12px 18px;border-radius:7px;text-decoration:none;">
        + Add New Member
    </a>
</div>

@if(session('success'))
    <div style="background:#e3f5eb;color:#23754d;padding:13px;border-radius:7px;margin-bottom:20px;">
        {{ session('success') }}
    </div>
@endif

<div class="panel">

    <form method="GET" action="{{ route('admin.members.index') }}"
          style="display:flex;gap:10px;margin-bottom:20px;flex-wrap:wrap;">

        <input type="text" name="search"
               value="{{ request('search') }}"
               placeholder="Search name, member code or phone..."
               style="flex:1;min-width:200px;padding:12px;border:1px solid #ddd;border-radius:7px;">

        <button type="submit"
                style="padding:12px 20px;background:#173c32;color:white;border:0;border-radius:7px;cursor:pointer;">
            Search
        </button>

        <a href="{{ route('admin.members.index') }}"
           style="padding:12px 15px;background:#eee;color:#333;border-radius:7px;text-decoration:none;">
            Reset
        </a>
    </form>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Member Code</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Joining Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($members as $member)
                    <tr>
                        <td>
                            @if($member->photo_path)
                                <img
                                    src="{{ asset('storage/' . $member->photo_path) }}"
                                    alt="{{ $member->full_name }}"
                                    width="45"
                                    height="45"
                                    style="object-fit: cover; border-radius: 50%;"
                                >
                            @else
                                <div style="
                                    width: 45px;
                                    height: 45px;
                                    border-radius: 50%;
                                    background: #e8f0eb;
                                    color: #176b45;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-weight: bold;
                                ">
                                    {{ strtoupper(substr($member->full_name, 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td>{{ $member->member_code }}</td>
                        <td>{{ $member->full_name }}</td>
                        <td>{{ $member->phone }}</td>
                        <td>{{ $member->joining_date?->format('d M Y') ?? '—' }}</td>
                        <td>
                            <span class="status"
                                  style="{{ $member->status === 'inactive' ? 'background:#fce8e6;color:#b3261e;' : '' }}">
                                {{ ucfirst($member->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.members.show', $member) }}"
                            style="color:#2463a6;text-decoration:none;margin-right:10px;">
                                View
                            </a>
                            <a href="{{ route('admin.members.edit', $member) }}"
                               style="color:#23754d;text-decoration:none;">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.members.destroy', $member) }}"
                                  style="display:inline;"
                                  onsubmit="return confirm('Move this member to trash?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    style="border:0;background:none;color:#c0392b;cursor:pointer;margin-left:10px;">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:30px;">
                            No members found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        {{ $members->links() }}
    </div>

</div>

@endsection
