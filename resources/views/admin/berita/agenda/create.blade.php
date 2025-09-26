<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row">
                <!-- Datatables -->
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __('Create Agenda FIK') }}</h6>
                            {{-- <a href="{{ route('visi-misi-tujuan-fik.create') }}" data-toggle="tooltip" data-original-title="Create" class="btn btn-success  py-0"><b style="font-size: 27px">+</b></a> --}}
                        </div>
                        <div class="table-responsive p-3">
                            <form action="{{ route('agenda-fik.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col border-right">
                                            <div class="p-3 py-5">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h4 class="text-right">Berita Agenda</h4>
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
                                                    <div class="col-md-12 mt-2">
                                                        <label class="labels">Konten</label>
                                                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="exampleFormControlTextarea1"
                                                            rows="4" style="font-size: 10pt">{{ old('content') }}</textarea>
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
                                                            placeholder="Tempat" value="{{ old('description') }}">
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
                                                            placeholder="" value="{{ old('start') }}">
                                                        @error('start')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div><div class="col-md-6">
                                                        <label class="labels">Berakhir Jam</label>
                                                        <input type="time" name="end"
                                                            class="form-control @error('end') is-invalid @enderror"
                                                            placeholder="" value="{{ old('end') }}">
                                                        @error('end')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12 mt-2">
                                                        <label class="labels">Tanggal</label>
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
                                                        class="btn btn-primary berita-button"type="submit">Simpan</button>
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

