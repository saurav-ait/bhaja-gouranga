
@extends('layouts.admin')

@section('title', 'Edit Member')

@section('content')

<h1 class="page-title">Edit Member</h1>
<p class="subtitle">Update member information.</p>

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

    <form method="POST" action="{{ route('admin.members.update', $member) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.members.form')

        <button type="submit"
                style="background:#27845e;color:white;border:0;padding:12px 22px;border-radius:7px;cursor:pointer;">
            Update Member
        </button>

        <a href="{{ route('admin.members.index') }}"
           style="margin-left:12px;color:#555;text-decoration:none;">
            Cancel
        </a>
    </form>

</div>

@endsection
