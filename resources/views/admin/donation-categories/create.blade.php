
@extends('layouts.admin')

@section('content')

<h2>Add Donation Category</h2>

<div style="background:white;padding:25px;border-radius:10px;max-width:700px;">

    @if($errors->any())
        <div style="background:#f8d7da;padding:12px;margin-bottom:15px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.donation-categories.store') }}">
        @csrf

        @include('admin.donation-categories.form')

        <button type="submit"
            style="background:#176b45;color:white;padding:12px 22px;border:0;border-radius:5px;">
            Save Category
        </button>

        <a href="{{ route('admin.donation-categories.index') }}">Cancel</a>
    </form>

</div>

@endsection
