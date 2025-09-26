@extends('layout.app')
@section('title', 'Pendaftaran')
@section('pendaftaran-active', 'active')

@section('content')
    <style>
        .file1 {
            visibility: hidden;
            position: absolute;
        }

        .file2 {
            visibility: hidden;
            position: absolute;
        }

        .big-checkbox {
            width: 30px;
            height: 30px;
        }
    </style>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Web Pendaftaran') }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Pendaftaran') }}</li>
        </ol>
    </div>
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Pendaftaran') }}</h6>
                    {{-- <a href="{{ route('visi-misi-tujuan.create') }}" data-toggle="tooltip" data-original-title="Create" class="btn btn-success  py-0"><b style="font-size: 27px">+</b></a> --}}
                </div>
                <div class="table-responsive p-3">
                    <form action="{{ route('pendaftaran-fik.update', isset($pendaftaran->id)) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col border-right">
                                    <div class="p-3 py-5">
                                        <div class="row mt-3">
                                            <div class="col-md-12 mt-2">
                                                <label class="labels">link website</label>
                                                <input type="text" name="content"
                                                    class="form-control @error('content') is-invalid @enderror"
                                                    placeholder="Input Content" value="{{ $pendaftaran->content }}">
                                                @error('content')
                                                    <small class="text-danger">{{ $message }}</small> <br>
                                                @enderror
                                                <small class="text-warning">Sertakan http:// atau https:// pada inputan link
                                                    website atau kosongkan jika perlu</small> <br>
                                                <small class="text-warning">Contoh : http://fik.unibamadura.ac.id</small>
                                            </div>
                                        </div>
                                        <div class="mt-5 text-center"><button
                                                class="btn btn-primary profile-button"type="submit">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    {{-- @include('admin.master.classes.scriptdatatable') --}}
@endsection
