@extends('layout.app')
@section('title', 'Dashboard')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Home</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Admin FIK</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </div>
    @if (Session::has('error'))
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fas fa-exclamation-triangle"></i>
            {{ Session::get('error') }}
        </div>
    @endif

@endsection
