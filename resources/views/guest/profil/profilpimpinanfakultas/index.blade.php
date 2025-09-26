@extends('layouts.app')
@section('active-profil', 'current')

@section('content')
<div data-elementor-type="wp-page" data-elementor-id="439" class="elementor elementor-439">
    <section class="breadcrumb-style9-area">
        <div class="breadcrumb-style9-area-bg"
            style="background-image: url('{{ asset('images/pimpinan-fakultas/'. $profil->image_header) }}');">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title">
                            <h2>Pimpinan FIK</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li class="breadcrumb-item"><a href="/home">Home &nbsp;</a></li>
                                <li class="breadcrumb-item">Pimpinan FIK</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        @foreach ($pimpinan as $row)
            <div class="container text-center mt-5 mb-5">
                <img src="{{ asset('images/pimpinan-fakultas/'. $row->image_content) }}" alt="">
            </div>
        @endforeach
    </section>
</div>


@endsection
