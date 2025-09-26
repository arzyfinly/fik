@extends('layout.app')
@section('title', 'Akreditasi FIK')
@section('akreditasi-fik-active', 'active')
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
        <h1 class="h3 mb-0 text-gray-800">{{ __('Akreditasi FIK') }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Profil') }}</li>
            <li class="breadcrumb-item">{{ __('Akreditasi FIK') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Edit') }}</li>
        </ol>
    </div>
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit Akreditasi FIK') }}</h6>
                    {{-- <a href="{{ route('visi-misi-tujuan.create') }}" data-toggle="tooltip" data-original-title="Create" class="btn btn-success  py-0"><b style="font-size: 27px">+</b></a> --}}
                </div>
                <div class="table-responsive p-3">
                    <form action="{{ route('akreditasi-fik.update', $akreditasi->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col border-right">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right">Akreditasi Fakultas</h4>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <label class="labels">Program Studi</label>
                                                        <select class="form-control @error('title') is-invalid @enderror" name="title">
                                                            <option hidden value="">-- Select Prodi --</option>
                                                            <option @if ($akreditasi->title == 'Akuntansi') selected @endif value="Akuntansi">Akuntansi</option>
                                                            <option @if ($akreditasi->title == 'Manajemen') selected @endif value="Manajemen">Manajemen</option>
                                                          </select>
                                                @error('title')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label class="labels">Nomer SK</label>
                                                <input class="form-control @error('no_sk') is-invalid @enderror" type="text" name="no_sk" value="{{ $akreditasi->image_content }}">
                                                @error('no_sk')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label class="labels">Akreditasi</label>
                                                <select class="form-control @error('description') is-invalid @enderror" name="description" id="exampleFormControlSelect1">
                                                    <option hidden value="">-- Select Akreditasi --</option>
                                                    <option @if ($akreditasi->description == 'A') selected @endif value="A">A</option>
                                                    <option @if ($akreditasi->description == 'B') selected @endif value="B">B</option>
                                                    <option @if ($akreditasi->description == 'C') selected @endif value="C">C</option>
                                                    <option @if ($akreditasi->description == 'Baik') selected @endif value="Baik">Baik</option>
                                                    <option @if ($akreditasi->description == 'Baik Sekali') selected @endif value="Baik Sekali">Baik Sekali</option>
                                                    <option @if ($akreditasi->description == 'Unggul') selected @endif value="Unggul">Unggul</option>
                                                  </select>
                                                @error('description')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6 mt-2">
                                                <label class="labels">Tahun Periode dimulai</label>
                                                <input type="number" name="start" max="9999"
                                                    class="form-control @error('start') is-invalid @enderror"
                                                    placeholder="ex:{{ \Carbon\Carbon::now()->format('Y') }}" value="{{ substr($akreditasi->content, 0, 4) }}">
                                                @error('start')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror

                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label class="labels">Tahun Periode Berakhir</label>
                                            <input type="number" name="end" max="9999"
                                                    class="form-control @error('end') is-invalid @enderror"
                                                    placeholder="ex:{{ \Carbon\Carbon::now()->format('Y') }}" value="{{ substr($akreditasi->content, 7, 11) }}">
                                                @error('end')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                <input type="date" name="date" hidden
                                                    class="form-control @error('date') is-invalid @enderror"
                                                    placeholder="" value="{{ \Carbon\Carbon::now()->toDateString() }}">
                                            </div>
                                        </div>
                                                    <input class="form-check-input" name="publish" @if($akreditasi->publish == 1) checked @endif
                                                        type="text" value="1" hidden id="checkbox-1" />
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
