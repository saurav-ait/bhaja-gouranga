
@extends('layouts.admin')

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Donation Categories</h2>

    <a href="{{ route('admin.donation-categories.create') }}"
       style="background:#176b45;color:white;padding:10px 16px;text-decoration:none;border-radius:5px;">
        + Add Category
    </a>
</div>

@if(session('success'))
    <div style="background:#d1e7dd;color:#0f5132;padding:12px;margin-bottom:15px;border-radius:5px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background:#f8d7da;color:#842029;padding:12px;margin-bottom:15px;border-radius:5px;">
        {{ session('error') }}
    </div>
@endif

<div style="background:white;padding:20px;border-radius:10px;overflow-x:auto;">

    <table style="width:100%;border-collapse:collapse;min-width:650px;">
        <thead>
            <tr style="background:#f1f4f2;text-align:left;">
                <th style="padding:12px;">Category Name</th>
                <th style="padding:12px;">Donations</th>
                <th style="padding:12px;">Status</th>
                <th style="padding:12px;">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($categories as $category)
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:12px;">
                        <strong>{{ $category->name }}</strong>
                        <br>
                        <small>{{ $category->description }}</small>
                    </td>

                    <td style="padding:12px;">
                        {{ $category->donations_count }}
                    </td>

                    <td style="padding:12px;">
                        @if($category->is_active)
                            <span style="color:green;">Active</span>
                        @else
                            <span style="color:red;">Inactive</span>
                        @endif
                    </td>

                    <td style="padding:12px;">
                        <a href="{{ route('admin.donation-categories.edit', $category) }}"
                        style="color:#23754d;text-decoration:none;">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.donation-categories.destroy', $category) }}"
                              style="display:inline;"
                              onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                style="background:none;border:none;color:red;cursor:pointer;margin-left:10px;">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding:20px;text-align:center;">
                        No categories found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:20px;">
        {{ $categories->links() }}
    </div>

</div>

@endsection
