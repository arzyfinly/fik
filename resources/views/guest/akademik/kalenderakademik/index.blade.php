@extends('layouts.app')
@section('active-akademik', 'current')
@section('content')
    <section class="breadcrumb-style9-area">
        <div class="breadcrumb-style9-area-bg"
            style="background-image: url('{{ asset('images/kalender-akademik-fakultas/'. $akademik->image_header) }}')">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title">
                            <h2>Kalender Akademik FIK</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home &nbsp;</a></li>
                                <li class="breadcrumb-item">Kalender Akademik FIK</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="register-accommodation-area">
        <div class="register-accommodation-area__bg"
            style="background-image: url('{{ asset('images/uniba/MODEL-NEW.JPG') }}')">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="register-accommodation-content">
                        <div class="sec-title">
                            <h2>Download<br> Kalender Akademik FIK</h2>
                        </div>
                        <div class="text">
                            <p>Dibawah ini ialah beberapa Kalender Akademik, bisa langsung di klik untuk mendownload
                            </p>
                            <h3><span class="icon-diagonal-arrow"></span> Download !!</h3>
                            <ul>
                                @foreach ($kalenderAkademik as $item)
                                    <li> <small>{{ $loop->iteration }}.  <a href="{{ asset('files/akademik/'.$item->content) }}">{{ $item->title }}</a></small> <small style="color:darkgray"> - uploaded at {{$item->date}}</small></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
