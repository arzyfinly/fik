@extends('layout.app')
@section('title', 'Fasilitas')
@section('fasilitas-fik-active', 'active')
@section('profile-active', 'active')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Fasilitas') }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Profil') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Fasilitas FIK') }}</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center">
                    <div class="mr-auto p-2">
                        <h6 class="m-0 font-weight-bold text-primary">Header</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('fasilitas-fik.header') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <table class="ml-2" style="width: 100%">
                        <tr>
                            <td>Keyword</td>
                            <td>: &nbsp; &nbsp;</td>
                            <td>
                                <input class="form-control @error('keyword') is-invalid @enderror" type="text"  name="keyword" id="keyword" @isset($profil->keyword)
                                value="{{ $profil->keyword }}"
                                @endisset
                                >
                            </td>
                        </tr>
                        <tr>
                            <td>Image Header</td>
                            <td>: &nbsp; &nbsp;</td>
                            <td class="pt-4">
                                <label for="file1">
                                    <img id="output1" style="width: 100px " class="img-thumbnail" @isset($profil->image_header) src="{{ asset('images/fasilitas-fakultas/'.$profil->image_header) }}" @endisset @empty($profil->image_header) src="{{ asset('images/default/upload-image.png') }}" @endempty>
                                </label> <br>

                                <small class="text-danger">*click to upload image, Warning !! it will be replaced</small>

                                <input type="file" hidden name="image_header" class="file1" id="file1" accept="image/*"
                                onchange="loadFile1(event)">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="d-flex flex-row-reverse pr-2"> <button class="btn btn-success" type="submit"> Save </button> </td>
                        </tr>
                    </table>
                </form>
                </div>
            </div>
        </div>
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center">
                    <div class="mr-auto p-2">
                        <h6 class="m-0 font-weight-bold text-primary">Content</h6>
                    </div>
                    <div class="p-1">
                        <button data-toggle="modal" data-target=".bd-example-modal-lg" data-original-title="Create"
                            class="btn btn-success"><span><i class="fas fa-plus"></i></span></button>
                    </div>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Image Content</th>
                                <th>Publish</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Image Content</th>
                                <th>Publish</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                        </tbody>
                    </table>
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
    <script>
        $(document).ready(function() {
            // var api = "{{ env('API_URL') }}";

            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('fasilitas-fik.index') }}",
                    type: 'GET',
                },
                "responsive": true,
                "language": {
                    "oPaginate": {
                        "sNext": "<i class='fas fa-angle-right'>",
                        "sPrevious": "<i class='fas fa-angle-left'>",
                    },
                    // processing: '<img src="{{ asset('image/loading2.gif') }}">',
                },
                columns: [{
                        data: 'DT_RowIndex',
                    },
                    {
                        data: 'title',
                    },
                    {
                        data: 'content',
                    },
                    {
                        data: 'image-content',
                    },
                    {
                        data: 'status',
                    },
                    {
                        data: 'action',
                    },
                ],
            });
        });
    </script>
    @include('admin.profil.fasilitasfeb.create')
    @include('admin.profil.fasilitasfeb.scriptdelete')
@endsection
