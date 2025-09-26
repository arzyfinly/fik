@extends('layout.app')
@section('title', 'VIsi Misi Tujuan')
@section('visi-misi-tujuan-active', 'active')
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
        <h1 class="h3 mb-0 text-gray-800">{{ __('VIsi Misi Tujuan') }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Profil') }}</li>
            <li class="breadcrumb-item">{{ __('VIsi Misi Tujuan FIK') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Edit') }}</li>
        </ol>
    </div>
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit VIsi Misi Tujuan FIK') }}</h6>
                    {{-- <a href="{{ route('visi-misi-tujuan.create') }}" data-toggle="tooltip" data-original-title="Create" class="btn btn-success  py-0"><b style="font-size: 27px">+</b></a> --}}
                </div>
                <div class="table-responsive p-3">
                    <form action="{{ route('visi-misi-tujuan-fik.update', $visimisi->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col border-right">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right">Visi Misi & Tujuan Fakultas</h4>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <label class="labels">Judul</label>
                                                <input type="text" name="title"
                                                            class="form-control @error('title') is-invalid @enderror"
                                                            placeholder="Judul" value="{{ $visimisi->title }}">
                                                @error('title')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label class="labels">Diskripsi</label>
                                                <input value="{{ $visimisi->description }}" type="text" name="description"
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    placeholder="diskripsi singkat konten" value="">
                                                @error('description')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mt-2">

                                                <label class="labels">Konten</label>
                                                <input type="hidden" name="content" id="content" value="{{ $visimisi->content }}">
                                                <div id="editor">{!! $visimisi->content !!}</div>
                                                <script>
                                                $(document).ready(function() {
                                                    var quill = new Quill('#editor', {
                                                        theme: 'snow'
                                                    });
                                                    quill.on('text-change', function(delta, oldDelta, source) {
                                                        document.querySelector("input[name='content']").value = quill.root.innerHTML;
                                                    });
                                                });
                                               </script>
                                               <input type="date" name="date" hidden
                                               class="form-control @error('date') is-invalid @enderror"
                                               placeholder="" value="{{ \Carbon\Carbon::now()->toDateString() }}">
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <br><br>
                                                <br><label class="labels">Tanggal Post</label>
                                                <input value="{{ $visimisi->date }}" type="date" name="date"
                                                    class="form-control @error('date') is-invalid @enderror"
                                                    placeholder="" value="">
                                                @error('date')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label class="labels">Publish</label>
                                                <div class="form-check">
                                                    <input @if($visimisi->publish == 1) checked @endif class="form-check-input" name="publish" type="checkbox" value="1" id="checkbox-1" />
                                                    <input value="{{ $visimisi->category_profile_id }}" hidden name="category_profile_id" type="text"
                                                        value="2" />
                                                    <label class="form-check-label" for="checkbox-1">Checklist
                                                        kotak
                                                        disamping untuk mempublish konten ini !! <br>
                                                        <small class="text-danger"> *otomatis menonaktifkan
                                                            konten sebelumnya yang sudah Aktif </small>
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
    <script>
        $(document).on("click", "#browse1", function() {
            var file1 = $(this).parents().find(".file1");
            file1.trigger("click");
        });

        var loadFile1 = function(event) {
            var output1 = document.getElementById('output1');
            output1.src = URL.createObjectURL(event.target.files[0]);
            output1.onload = function() {
                URL.revokeObjectURL(output1.src) // free memory
            }
        };


        $(document).on("click", "#browse2", function() {
            var file2 = $(this).parents().find(".file2");
            file2.trigger("click");
        });

        var loadFile2 = function(event) {
            var output2 = document.getElementById('output2');
            output2.src = URL.createObjectURL(event.target.files[0]);
            output2.onload = function() {
                URL.revokeObjectURL(output2.src) // free memory
            }
        };
    </script>
    {{-- @include('admin.master.classes.scriptdatatable') --}}
@endsection
