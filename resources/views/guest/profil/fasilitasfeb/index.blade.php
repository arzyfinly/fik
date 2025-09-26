@extends('layouts.app')
@section('active-profil', 'current')

@section('content')
    <!--Start breadcrumb area paroller-->
    <section class="breadcrumb-area">
        <div class="breadcrumb-area-bg"
            style="background-image: url({{ asset('images/fasilitas-fakultas/' . $profil->image_header) }})">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title">
                            <h2> Fasilitas FIK</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home &nbsp;</a></li>
                                <li class="breadcrumb-item">Fasilitas FIK</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End breadcrumb area-->

    <!--Start Teaching Area-->
    <section class="teaching-area">
        <div class="auto-container">
            <div class="row">
                @foreach ($fasilitas as $row)
                    <div class="col-xl-6">
                        <div class="teaching-content">
                            <div class="sec-title">
                                <div class="text-justify">
                                    <center>
                                        <h2>{{ $row->title }}</h2>
                                    </center>
                                    {!! $row->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6" style="border: 3px; padding: 10px; margin: auto; width: 50%;">
                            <center>
                                <img src="{{ asset('images/fasilitas-fakultas/' . $row->image_content) }}" alt="{{ $row->title }}">
                            </center>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--End Teaching Area-->

@endsection
