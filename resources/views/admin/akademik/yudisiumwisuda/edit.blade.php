@extends('layout.app')
@section('title', 'Yudisium & WIsuda FIK')
@section('yudisium-wisuda-active', 'active')
@section('profile-active', 'active')

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
        <h1 class="h3 mb-0 text-gray-800">{{ __('Yudisium & WIsuda FIK') }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Akademik') }}</li>
            <li class="breadcrumb-item">{{ __('Yudisium & WIsuda FIK') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Edit') }}</li>
        </ol>
    </div>
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit Yudisium & WIsuda FIK') }}</h6>
                    {{-- <a href="{{ route('yudisium-wisuda.create') }}" data-toggle="tooltip" data-original-title="Create" class="btn btn-success  py-0"><b style="font-size: 27px">+</b></a> --}}
                </div>
                <div class="table-responsive p-3">
                    <form action="{{ route('yudisium-wisuda-fik.update', $yudisiumwisuda->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col border-right">
                                    <div class="p-3 py-1">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right">Yudisium atau Wisuda</h4>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <label class="labels">Judul</label>
                                                <input type="text" name="title"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    placeholder="judul" value="{{ $yudisiumwisuda->title }}">
                                                @error('title')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label class="labels">Konten</label>
                                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="exampleFormControlTextarea1"
                                                    rows="4" style="font-size: 10pt">{{ $yudisiumwisuda->content }}</textarea>
                                                @error('content')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <label class="labels">Tempat</label>
                                                <input type="text" name="description"
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    placeholder="Tempat" value="{{ $yudisiumwisuda->description }}">
                                                @error('description')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label class="labels">Mulai Jam</label>
                                                <input type="time" name="start"
                                                    class="form-control @error('start') is-invalid @enderror"
                                                    placeholder="" value="{{ substr($yudisiumwisuda->image_content, 0, 5) }}">
                                                @error('start')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div><div class="col-md-6">
                                                <label class="labels">Berakhir Jam</label>
                                                <input type="time" name="end"
                                                    class="form-control @error('end') is-invalid @enderror"
                                                    placeholder="" value="{{ substr($yudisiumwisuda->image_content, 8, 12) }}">
                                                @error('end')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label class="labels">Tanggal</label>
                                                <input type="date" name="date"
                                                    class="form-control @error('date') is-invalid @enderror"
                                                    placeholder="" value="{{ $yudisiumwisuda->date }}">
                                                @error('date')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label class="labels">Publish</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="publish" @if ($yudisiumwisuda->publish == '1') checked @endif
                                                        type="checkbox" value="1" id="checkbox-1" />
                                                    <input hidden name="category_profile_id" type="text"
                                                        value="2" />
                                                    <label class="form-check-label" for="checkbox-1">Checklist
                                                        kotak
                                                        disamping untuk mempublish konten ini !! <br>
                                                    </label>
                                                </div>
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
