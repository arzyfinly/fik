@extends('layouts.app')
@section('active-profil', 'current')

@section('content')
        <section class="breadcrumb-style9-area">
            <div class="breadcrumb-style9-area-bg"
                style="background-image: url('{{ asset('images/sejarah-fakultas/'.$profil->image_header) }}');">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="inner-content">
                            <div class="title">
                                <h2>Sejarah Fakultas</h2>
                            </div>
                            <div class="breadcrumb-menu">
                                <ul>
                                    <li class="breadcrumb-item"><a href="/home">Home &nbsp;</a></li>
                                    <li class="breadcrumb-item">Sejarah Fakultas</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End breadcrumb area-->
        <!--
        =============================================
            End College Home Page Banner
        ==============================================
        -->
        <div data-elementor-type="wp-page" data-elementor-id="2086" class="elementor elementor-2086">
            <section
                class="elementor-section elementor-top-section elementor-element elementor-element-b1716ae elementor-section-full_width elementor-section-height-default elementor-section-height-default"
                data-id="b1716ae" data-element_type="section">
                <div class="elementor-container elementor-column-gap-default">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-fff3e76"
                        data-id="fff3e76" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-695382e elementor-widget elementor-widget-educamb_statement_of_educamb_v2"
                                data-id="695382e" data-element_type="widget"
                                data-widget_type="educamb_statement_of_educamb_v2.default">
                                <div class="elementor-widget-container">

                                    <!--Start About Style1 Area-->
                                    <section class="about-style1-area">
                                        <div class="container">
                                            <div class="sec-title text-center">
                                                <h2>{{ $sejarah->title  }}</h2>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="about-style1__inner">
                                                        <div class="row">
                                                            <div class="col-xl-6">
                                                                <div class="about-style1-content text-justify">
                                                                    {!! $sejarah->content !!}
                                                                    <div class="btns-box">
                                                                        <a class="btn-one btn-one--style2"
                                                                            href="{{ route('guest.visi-misi') }}">
                                                                            <span class="txt">Visi, Misi & Tujuan</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-6">
                                                                <div class="about-style1-img-box">
                                                                    <div class="inner">
                                                                        <img src="{{ asset('images/sejarah-fakultas/'. $sejarah->image_content )}}" alt="Sejarah FIK" title="Sejarah FIK">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!--End About Style1 Area-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection
