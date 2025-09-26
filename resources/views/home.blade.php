@extends('layouts.app')

@section('content')
    <div data-elementor-type="wp-page" data-elementor-id="439" class="elementor elementor-439">
        <section
            class="elementor-section elementor-top-section elementor-element elementor-element-866cf41 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
            data-id="866cf41" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-37221da"
                    data-id="37221da" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-5b9f81d elementor-widget elementor-widget-educamb_banner_v9"
                            data-id="5b9f81d" data-element_type="widget" data-widget_type="educamb_banner_v9.default">
                            <div class="elementor-widget-container">

                                <!-- Start Main Slider -->
                                <section class="main-slider style1 nav-style2 main-slider--style9">
                                    <div class="slider-box">
                                        <!-- Banner Carousel -->
                                        <div class="banner-carousel owl-theme owl-carousel">

                                            @foreach ($fasilitas as $row)
                                            <!-- Slide -->
                                            <div class="slide">
                                                <div class="image-layer"
                                                    style="background-image:url({{ asset('images/fasilitas-fakultas/'. $row->image_content) }} )">
                                                </div>
                                                <div class="auto-container">
                                                    <div class="content">
                                                        <div class="sub-title">
                                                            <h5>Gedung Campaka - FST</h5>
                                                        </div>
                                                        <div class="big-title">
                                                            <h2>{{ $row->title }}</h2>
                                                        </div>
                                                        <div class="text text-white">
                                                            <?php $pos_cache = strpos($row->content,'.');
                                                                  $pos = $pos_cache+1; ?>
                                                            {{ strip_tags(substr($row->content, 0, $pos)) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </section>
                                <!-- End Main Slider -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section
            class="elementor-section elementor-top-section elementor-element elementor-element-73f21b0 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
            data-id="73f21b0" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-c295351"
                    data-id="c295351" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-0c4d5f7 elementor-widget elementor-widget-educamb_our_feature_v7"
                            data-id="0c4d5f7" data-element_type="widget" data-widget_type="educamb_our_feature_v7.default">
                            <div class="elementor-widget-container">

                                <!--Start Essentials Content Area-->
                                <section class="essentials-content-area">
                                    <div class="container">
                                        <ul class="row">
                                            <!--Start Single Essentials Item-->
                                            <li class="col-xl-3 col-lg-3 col-md-6 single-essentials-colum text-center">
                                                <div class="single-essentials-item">
                                                    <div class="static-content">
                                                        <div class="icon">
                                                            <span class="icon-learning"><span class="path1"></span><span
                                                                    class="path2"></span><span class="path3"></span><span
                                                                    class="path4"></span><span class="path5"></span><span
                                                                    class="path6"></span><span class="path7"></span><span
                                                                    class="path8"></span><span class="path9"></span><span
                                                                    class="path10"></span><span class="path11"></span><span
                                                                    class="path12"></span><span class="path13"></span><span
                                                                    class="path14"></span><span class="path15"></span><span
                                                                    class="path16"></span><span class="path17"></span><span
                                                                    class="path18"></span><span class="path19"></span><span
                                                                    class="path20"></span><span
                                                                    class="path21"></span></span>
                                                        </div>

                                                        <h3><a href="{{ isset($pendaftaran->content)}}">Pendaftaran </a></h3>
                                                        <div class="btn-box">
                                                            <a href="{{ isset($pendaftaran->content)}}">
                                                                <span class="icon-right-arrow-1"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--End Single Essentials Item-->
                                            <!--Start Single Essentials Item-->
                                            <li class="col-xl-3 col-lg-3 col-md-6 single-essentials-colum text-center">
                                                <div class="single-essentials-item">
                                                    <div class="static-content">
                                                        <div class="icon">
                                                            <span class="icon-study"><span class="path1"></span><span
                                                                    class="path2"></span><span class="path3"></span><span
                                                                    class="path4"></span><span class="path5"></span><span
                                                                    class="path6"></span><span class="path7"></span><span
                                                                    class="path8"></span><span
                                                                    class="path9"></span><span
                                                                    class="path10"></span><span
                                                                    class="path11"></span><span
                                                                    class="path12"></span><span
                                                                    class="path13"></span><span
                                                                    class="path14"></span><span
                                                                    class="path15"></span><span
                                                                    class="path16"></span><span
                                                                    class="path17"></span><span
                                                                    class="path18"></span><span
                                                                    class="path19"></span><span
                                                                    class="path20"></span><span
                                                                    class="path21"></span><span
                                                                    class="path22"></span><span
                                                                    class="path23"></span><span
                                                                    class="path24"></span><span
                                                                    class="path25"></span><span
                                                                    class="path26"></span><span
                                                                    class="path27"></span><span
                                                                    class="path28"></span><span
                                                                    class="path29"></span><span
                                                                    class="path30"></span></span>
                                                        </div>
                                                        <h3><a href="{{ route('guest.fasilitas-fik') }}">Fasilitas FIK</a></h3>
                                                        <div class="btn-box">
                                                            <a href="{{ route('guest.fasilitas-fik') }}">
                                                                <span class="icon-right-arrow-1"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--End Single Essentials Item-->
                                            <!--Start Single Essentials Item-->
                                            <li class="col-xl-3 col-lg-3 col-md-6 single-essentials-colum text-center">
                                                <div class="single-essentials-item">
                                                    <div class="static-content">
                                                        <div class="icon">
                                                            <span class="icon-speech"><span class="path1"></span><span
                                                                    class="path2"></span><span
                                                                    class="path3"></span><span
                                                                    class="path4"></span><span
                                                                    class="path5"></span><span
                                                                    class="path6"></span><span
                                                                    class="path7"></span><span
                                                                    class="path8"></span><span
                                                                    class="path9"></span><span
                                                                    class="path10"></span><span
                                                                    class="path11"></span><span
                                                                    class="path12"></span><span
                                                                    class="path13"></span><span
                                                                    class="path14"></span><span
                                                                    class="path15"></span><span
                                                                    class="path16"></span><span
                                                                    class="path17"></span><span
                                                                    class="path18"></span><span
                                                                    class="path19"></span><span
                                                                    class="path20"></span><span
                                                                    class="path21"></span><span
                                                                    class="path22"></span></span>
                                                        </div>
                                                        <h3><a href="{{ route('guest.staff-dosen-fik') }}">Dosen FIK</a></h3>
                                                        <div class="btn-box">
                                                            <a href="{{ route('guest.staff-dosen-fik') }}">
                                                                <span class="icon-right-arrow-1"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--End Single Essentials Item-->
                                            <!--Start Single Essentials Item-->
                                            <li class="col-xl-3 col-lg-3 col-md-6 single-essentials-colum text-center">
                                                <div class="single-essentials-item">
                                                    <div class="static-content">
                                                        <div class="icon">
                                                            <span class="icon-career"><span class="path1"></span><span
                                                                    class="path2"></span><span
                                                                    class="path3"></span><span
                                                                    class="path4"></span><span
                                                                    class="path5"></span><span
                                                                    class="path6"></span><span
                                                                    class="path7"></span><span
                                                                    class="path8"></span><span
                                                                    class="path9"></span><span
                                                                    class="path10"></span><span
                                                                    class="path11"></span><span
                                                                    class="path12"></span><span
                                                                    class="path13"></span><span
                                                                    class="path14"></span><span
                                                                    class="path15"></span><span
                                                                    class="path16"></span><span
                                                                    class="path17"></span><span
                                                                    class="path18"></span><span
                                                                    class="path19"></span><span
                                                                    class="path20"></span><span
                                                                    class="path21"></span><span
                                                                    class="path22"></span><span
                                                                    class="path23"></span><span
                                                                    class="path24"></span></span>
                                                        </div>
                                                        <h3><a href="{{ route('guest.akreditasi-fik') }}">Akreditasi</a></h3>
                                                        <div class="btn-box">
                                                            <a href="{{ route('guest.akreditasi-fik') }}">
                                                                <span class="icon-right-arrow-1"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--End Single Essentials Item-->
                                        </ul>
                                    </div>
                                </section>
                                <!--End Essentials Content Area-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section
            class="elementor-section elementor-top-section elementor-element elementor-element-8779d62 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
            data-id="8779d62" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-1f5c277"
                    data-id="1f5c277" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-573aa79 elementor-widget elementor-widget-educamb_excellence_in_teaching"
                            data-id="573aa79" data-element_type="widget"
                            data-widget_type="educamb_excellence_in_teaching.default">
                            <div class="elementor-widget-container">

                                <!--Start Teaching Area-->
                                <section class="teaching-area">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-xl-6 text-center mb-5">
                                                <div class="teaching-img-box-style2">
                                                    <img src="{{ asset('images/uniba/PAKALVIN.png') }}"
                                                        alt="Awesome Image"
                                                        style="border-radius: 140px; width: 300px; height: 400px;">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="teaching-content teaching-content--style2">
                                                    <div class="sec-title">
                                                        <h2>Sambutan Dekan</h2>
                                                        <div class="sub-title">
                                                            <p>Selamat datang di pusat informasi FIK - UNIBA Madura.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!--End Teaching Area-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section
            class="elementor-section elementor-top-section elementor-element elementor-element-0a7b514 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
            data-id="0a7b514" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-38bf9bf"
                    data-id="38bf9bf" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-d2d3f5c elementor-widget elementor-widget-educamb_video_section_v3"
                            data-id="d2d3f5c" data-element_type="widget"
                            data-widget_type="educamb_video_section_v3.default">
                            <div class="elementor-widget-container">

                                <!--Start Video Gallery Style2 Area-->
                                <section class="video-gallery-style2-area">
                                    <div class="video-gallery-style2-area__bg"
                                        style="background-image: url(../wp-content/uploads/2022/06/video-gallery-style2-area__bg.jpg);">
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-xl-12 text-center">
                                                <div class="video-gallery-style2-content">
                                                    <div class="logo-box">
                                                            <img src="{{ asset('admin/images/logo.png') }}"
                                                                alt="Awesome Image">
                                                    </div>
                                                    <h2>Video Profile UNIBA Madura <br> 2023 </h2>
                                                    <div class="video-holder-box">
                                                        <a class="video-popup wow zoomIn" data-wow-delay="300ms"
                                                            data-wow-duration="1500ms" title="Video Gallery"
                                                            href="https://www.youtube.com/watch?v=22bHe05BX8M">
                                                            <span class="icon-play-button"></span>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!--End Video Gallery Style2 Area-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section
            class="elementor-section elementor-top-section elementor-element elementor-element-75c6cfa elementor-section-full_width elementor-section-height-default elementor-section-height-default"
            data-id="75c6cfa" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-87207bc"
                    data-id="87207bc" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-67f5d32 elementor-widget elementor-widget-educamb_our_research"
                            data-id="67f5d32" data-element_type="widget" data-widget_type="educamb_our_research.default">
                            <div class="elementor-widget-container">

                                <!--Start Research Area-->
                                <section class="research-area">
                                    <div class="auto-container">
                                        <div class="sec-title text-center">
                                            <h2>Fasilitas Terbaru</h2>
                                            <div class="sub-title">
                                                <p>Di bawah ini ialah 3 daftar terbaru fasilitas yang dapat di gunakan di
                                                    FIK.</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="theme_carousel research-carousel owl-theme owl-carousel owl-dot-style1"
                                                    data-options='{
                        "loop": true,
                        "margin": 30,
                        "autoheight":true,
                        "lazyload":true,
                        "nav": false,
                        "dots": true,
                        "autoplay": true,
                        "autoplayTimeout": 5000,
                        "smartSpeed": 500,
                        "navText": ["<span class=\"left icon-right-arrow-1\"></span>",
                        "<span class=\"right icon-right-arrow-1\"></span>"],
                        "responsive":{
                        "0" :{ "items": "1" },
                        "600" :{ "items" : "1" },
                        "768" :{ "items" : "1" },
                        "1200":{ "items" : "2" },
                        "1800":{ "items" : "3" }
                    }
                }'>
                                                    @foreach ($fasilitas as $row)

                                                    <!--Start Single Research Box-->
                                                    <div class="single-research-box">
                                                        <div class="img-holder">
                                                            <img loading="lazy" width="550" height="320"
                                                                src="{{ asset('images/fasilitas-fakultas/'. $row->image_content) }}"
                                                                class="attachment-educamb_550x320 size-educamb_550x320 wp-post-image"
                                                                alt="" sizes="(max-width: 550px) 100vw, 550px" />
                                                            <div class="icon">
                                                                <span class="icon-research"></span>
                                                            </div>
                                                            <div class="overlay-icon">
                                                                <span class="icon-research"></span>
                                                            </div>
                                                        </div>
                                                        <div class="overlay-content">
                                                            <div class="inner-title">
                                                                <h3><a>{{ $row->title }}</a></h3>
                                                            </div>
                                                            <div class="text">
                                                                <?php $pos_cache = strpos($row->content,'.');
                                                                  $pos = $pos_cache+1; ?>
                                                            {!! substr($row->content, 0, $pos) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--End Single Research Box-->
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!--End Research Area-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section
            class="elementor-section elementor-top-section elementor-element elementor-element-98d9d7e elementor-section-full_width elementor-section-height-default elementor-section-height-default"
            data-id="98d9d7e" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-7497895"
                    data-id="7497895" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-693ae50 elementor-widget elementor-widget-educamb_our_testimonial_v9"
                            data-id="693ae50" data-element_type="widget"
                            data-widget_type="educamb_our_testimonial_v9.default">
                            <div class="elementor-widget-container">

                                <!--Start Testimonial Style9 Area-->
                                <section class="testimonial-style9-area">
                                    <div class="container">
                                        <div class="sec-title">
                                            <h2>Program Studi</h2>
                                            <div class="sub-title">
                                                <p>Seluruh daftar program studi yang ada dalam Fakultas Ilmu Komunikasi</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="testimonial-style1-content">
                                                    <div class="theme_carousel testimonial-carousel-nine owl-nav-style-one owl-theme owl-carousel"
                                                        data-options='{
                        "loop": true,
                        "margin": 30,
                        "autoheight":true,
                        "lazyload":true,
                        "nav": true,
                        "dots": false,
                        "autoplay": true,
                        "autoplayTimeout": 5000,
                        "smartSpeed": 500,
                        "navText": ["<span class=\"left icon-right-arrow-1\"></span>",
                        "<span class=\"right icon-right-arrow-1\"></span>"],
                        "responsive":{
                        "0" :{ "items": "1" },
                        "600" :{ "items" : "1" },
                        "768" :{ "items" : "2" },
                        "992":{ "items" : "3" },
                        "1200":{ "items" : "3" }
                        }
                    }'>
                                                        <!--Start Single Testimonial Style9-->
                                                        <div class="single-testimonial-style9 text-center">
                                                            <div class="text">
                                                                <p><b>Manajemen</b> adalah program studi yang mempelajari
                                                                    mengenai bagaimana mengelola suatu perusahaan atau organisasi.
                                                                    Manajemen juga termasuk dalam bidang bisnis dan ekonomi,
                                                                    tetapi lebih terfokus pada kegiatan mengelola, merencanakan, dan
                                                                    mengatur (manajemen) semua proses dalam perusahaan untuk mencapai tujuan.</p>
                                                            </div>
                                                            <div class="client-name">
                                                                <h3>Manajemen</h3>
                                                            </div>
                                                                <div class="btn-box">
                                                                    <a href="#">
                                                                        <span class="icon-right-arrow-1"></span>
                                                                    </a>
                                                            </div>
                                                        </div>
                                                        <!--End Single Testimonial Style9-->
                                                        <!--Start Single Testimonial Style9-->
                                                        <div class="single-testimonial-style9 text-center">
                                                            <div class="text">
                                                                <p><b>Akuntansi</b> ialah belajar cara memelihara keuangan.
                                                                    Ini mempersiapkan siswa untuk menjadi akuntan dengan
                                                                    mengajar mereka tentang prinsip-prinsip akuntansi
                                                                    seperti audit, pelaporan, penganggaran dan peraturan pajak.
                                                                </p>
                                                            </div>
                                                            <div class="client-name">
                                                                <h3>Akuntansi</h3>
                                                            </div>
                                                                <div class="btn-box">
                                                                    <a href="#">
                                                                        <span class="icon-right-arrow-1"></span>
                                                                    </a>
                                                            </div>
                                                        </div>
                                                        <!--End Single Testimonial Style9-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!--End Testimonial Style1 Area-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section
            class="elementor-section elementor-top-section elementor-element elementor-element-3af39b3 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
            data-id="3af39b3" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-cb2ef45"
                    data-id="cb2ef45" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-3450658 elementor-widget elementor-widget-educamb_latest_news_v6"
                            data-id="3450658" data-element_type="widget"
                            data-widget_type="educamb_latest_news_v6.default">
                            <div class="elementor-widget-container">

                                <!--Start Blog Style1 Area-->
                                <section class="blog-style1-area">
                                    <div class="container">
                                        <div class="sec-title text-center">
                                            <h2>Berita Terkini</h2>
                                            <div class="sub-title">
                                                <p>Berikut adalah top latest berita terkini !!</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @foreach ($berita as $row)
                                            <!--Start Single Blog Style1-->
                                            <div class="col-xl-4 col-lg-4">
                                                <div class="single-blog-style1">
                                                    <div class="img-holder">
                                                        <div class="inner">
                                                            <img width="370" height="240"
                                                                src="@if($row->berita->category_berita_id == 1)
                                                                        {{ asset('images/berita-informasi/'. $row->image_content) }}
                                                                     @elseif($row->berita->category_berita_id == 2)
                                                                        {{ asset('images/berita-pengumuman/'. $row->image_content) }}
                                                                     @else
                                                                        {{ asset('images/berita-agenda/'. $row->image_content) }}
                                                                     @endif
                                                                "
                                                                class="attachment-educamb_370x240 size-educamb_370x240 wp-post-image"
                                                                alt="" loading="lazy" />
                                                        </div>
                                                        <div class="category-box">
                                                            <div class="dot-box"></div>
                                                            <p> @if($row->berita->category_berita_id == 1)
                                                                Informasi
                                                                @elseif($row->berita->category_berita_id == 2)
                                                                Pengumuman
                                                                @else
                                                                Agenda
                                                                @endif
                                                                </p>
                                                        </div>
                                                    </div>
                                                    <div class="text-holder">
                                                        <h3><a href=" @if($row->berita->category_berita_id == 1) {{route('berita-informasi-fik.show',$row->id)}} @elseif($row->berita->category_berita_id == 2) {{route('berita-pengumuman-fik.show',$row->id)}} @else # @endif">{{ $row->title }}</a></h3>
                                                        <div class="text">
                                                            {!! strip_tags(substr($row->content, 0, 100)) !!}&hellip;
                                                        </div>
                                                        <div class="bottom-box">
                                                            <div class="btn-box">
                                                                <a href="@if($row->berita->category_berita_id == 1) {{route('berita-informasi-fik.show',$row->id)}} @elseif($row->berita->category_berita_id == 2) {{route('berita-pengumuman-fik.show',$row->id)}} @else # @endif">
                                                                    <span class="icon-right-arrow-1"></span>Read
                                                                    More </a>
                                                            </div>
                                                            <div class="meta-info">
                                                                <ul>
                                                                    <li><span class="icon-calendar"></span><a>{{ date('M d', strtotime($row->date)) }}, {{ date('Y', strtotime($row->date)) }}</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Single Blog Style1-->
                                            @endforeach
                                        </div>
                                    </div>
                                </section>
                                <!--End Blog Style1 Area-->


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
