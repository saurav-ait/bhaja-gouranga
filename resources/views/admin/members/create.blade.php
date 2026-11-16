
@extends('layouts.admin')

@section('title', 'Add Member')

@section('content')

<h1 class="page-title">Add New Member</h1>
<p class="subtitle">Enter the member's information below.</p>

<div class="panel">

    @if($errors->any())
        <div style="background:#fce8e6;color:#b3261e;padding:12px;border-radius:7px;margin-bottom:20px;">
            <ul style="padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.members.store') }}" enctype="multipart/form-data>
        @csrf

        @include('admin.members.form')

        <button type="submit"
                style="background:#27845e;color:white;border:0;padding:12px 22px;border-radius:7px;cursor:pointer;">
            Save Member
        </button>

        <a href="{{ route('admin.members.index') }}"
           style="margin-left:12px;color:#555;text-decoration:none;">
            Cancel
        </a>
    </form>

</div>

@endsection
