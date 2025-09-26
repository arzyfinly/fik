<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row">
                <!-- Datatables -->
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __('Create Sejarah FIK') }}</h6>
                            {{-- <a href="{{ route('visi-misi-tujuan-fik.create') }}" data-toggle="tooltip" data-original-title="Create" class="btn btn-success  py-0"><b style="font-size: 27px">+</b></a> --}}
                        </div>
                        <div class="table-responsive p-3">
                            <form action="{{ route('sejarah-fik.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3 border-right">

                                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                                <label class="labels mt-3"><strong>Gambar Content</strong></label>
                                                <input type="file" name="image_content" hidden
                                                    class="file2 @error('image_content') is-invalid @enderror"
                                                    id="file2" accept="image/*" onchange="loadFile2(event)">
                                                <div class="col-sm">
                                                    <div id="msg"></div>
                                                    <div class="input-group my-3 text-center">
                                                        <img id="output2" class="img-thumbnail" />
                                                    </div>
                                                </div>
                                                @error('image_content')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                <button type="button" id="browse2"
                                                    class="browse2 btn btn-primary ">Pilih Gambar</button>
                                            </div>
                                        </div>

                                        <div class="col border-right">
                                            <div class="p-3 py-5">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h4 class="text-right">Sejarah Fakultas</h4>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-12">
                                                        <label class="labels">Judul</label>
                                                        <input type="text" name="title"
                                                            class="form-control @error('title') is-invalid @enderror"
                                                            placeholder="judul" value="{{ old('title') }}">
                                                        @error('title')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <label class="labels">Diskripsi</label>
                                                        <input type="text" name="description"
                                                            class="form-control @error('description') is-invalid @enderror"
                                                            placeholder="diskripsi singkat konten" value="{{ old('description') }}">
                                                        @error('description')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12 mt-2">

                                                        <label class="labels">Konten</label>
                                                        <input type="hidden" name="content" id="content" value="{{ old('content') }}">
                                                        <div id="editor">{!! old('content') !!}</div>
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
                                                    </div>
                                                    <div class="col-md-12 mt-2">
                                                        <label class="labels">Tanggal Post</label>
                                                        <input type="date" name="date"
                                                            class="form-control @error('date') is-invalid @enderror"
                                                            placeholder="" value="{{ old('date') }}">
                                                        @error('date')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <label class="labels">Publish</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="publish"
                                                                type="checkbox" value="1" id="checkbox-1" />
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
        </div>
    </div>
</div>

