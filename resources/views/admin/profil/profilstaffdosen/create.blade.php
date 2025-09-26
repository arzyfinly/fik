<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row">
                <!-- Datatables -->
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __('Create Dosen FIK') }}</h6>
                            {{-- <a href="{{ route('visi-misi-tujuan-fik.create') }}" data-toggle="tooltip" data-original-title="Create" class="btn btn-success  py-0"><b style="font-size: 27px">+</b></a> --}}
                        </div>
                        <div class="table-responsive p-3">
                            <form action="{{ route('staff-dosen-fik.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3 border-right">

                                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                                <label class="labels mt-3"><strong>Foto 4x3</strong></label> <small class="text-danger">*recomended 175px X 155px</small>
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
                                                    class="browse2 btn btn-primary ">Pilih Foto</button>
                                            </div>
                                        </div>

                                        <div class="col border-right">
                                            <div class="p-3 py-5">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h4 class="text-right">Dosen FIK</h4>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-12">
                                                        <label class="labels">Departement</label>
                                                        <select class="form-control" name="title" @error('title') is-invalid @enderror placeholder="judul">
                                                            <option>-- Select Departement --</option>
                                                            <option value="MANAJEMEN">MANAJEMEN</option>
                                                            <option value="AKUNTANSI">AKUNTANSI</option>
                                                        </select>
                                                        @error('title')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    {{-- <div class="col-md-12"> --}}
                                                        <input type="text" hidden name="description" class="form-control" value="-">
                                                    {{-- </div> --}}
                                                    <div class="col-md-12 mt-2">
                                                        <label class="labels">Nama Dosen</label>
                                                        <input type="text" name="content" class="form-control" placeholder="Ex: Joni A.Md.Kom." value="{{ old('content') }}">
                                                        <small class="text-danger"> *Isi nama beserta gelarnya contoh: Muhammad Bagus Raga Maulidi A.Md.Kom. </small> <br>
                                                        @error('content')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
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

