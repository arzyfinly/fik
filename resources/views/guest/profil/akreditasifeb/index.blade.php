@extends('layouts.app')
@section('active-profil', 'current')

@section('content')
<!--Start breadcrumb area paroller-->
<section class="breadcrumb-area">
    <div class="breadcrumb-area-bg" style="background-image: url({{ asset('images/akreditasi-fakultas/'. $profil->image_header ) }})">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content">
                    <div class="title">
                        <h2>Akreditasi FIK</h2>
                    </div>
                    <div class="breadcrumb-menu">
                        <ul>
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home &nbsp;</a></li>
                            <li class="breadcrumb-item">Akreditasi FIK</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->

<div class="row justify-content-center pt-5">
<div class="col-lg-8 ">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center">
            <div class="mr-auto p-2">
                <h3>Akreditasi FIK</h3>
            </div>
        </div>
        <div class="table-responsive p-3 text-center">
            <table class="table">
                <thead class="thead-light ">
                    <tr>
                        <th>#</th>
                        <th>Nama Prodi</th>
                        <th>Nomor SK</th>
                        <th>Akreditasi</th>
                        <th>Periode Berlaku</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nama Prodi</th>
                        <th>Nomor SK</th>
                        <th>Akreditasi</th>
                        <th>Periode Berlaku</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($akreditasi as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->title }}</td>
                        <td>{{ $row->image_content }}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ $row->content }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@endsection
