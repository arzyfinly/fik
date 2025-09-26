@extends('layouts.app')
@section('active-profil', 'current')

@section('content')
    <div data-elementor-type="wp-page" data-elementor-id="439" class="elementor elementor-439">
        <section class="breadcrumb-style9-area">
            <div class="breadcrumb-style9-area-bg"
                style="background-image: url('{{ asset('images/visi-misi-fakultas/' . $profil->image_header) }}');">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="inner-content">
                            <div class="title">
                                <h2>Visi Misi & Tujuan Fakultas</h2>
                            </div>
                            <div class="breadcrumb-menu">
                                <ul>
                                    <li class="breadcrumb-item"><a href="/home">Home &nbsp;</a></li>
                                    <li class="breadcrumb-item">Visi Misi & Tujuan Fakultas</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

            <div class="container">
                <div class="row mx-5">
                    <div class="blog-details-page__content">
                        <div class="thm-unit-test">
                            <div class="blog-details-page__content__inner">
                                <div class="text-justify">
                                    <div class="blog-details-page__top-text">
                                        <div class="big-text">
                                            <h2>B</h2>
                                        </div>
                                        <div class="text">ermula dari gagasan Pendiri sekaligus Ketua Yayasan Kudsiyah
                                            Bahaudin Mudhary yaitu Bapak Dr. Achsanul Qosasi demi menciptakan Sumber Daya
                                            Manusia yang unggul di Madura. Berdasarkan tujuan serta cita-cita KH. Bahaudin
                                            Mudhary yang merupakan ulama serta tokoh Madura, maka didirikanlah sebuah
                                            perguruan tinggi yang dinamakan Sekolah Tinggi Ilmu Ekonomi KH. Bahaudin Mudhary
                                            Madura yang terdiri dua departemen yaitu Akuntansi dan Manajemen.
                                        </div>
                                    </div>
                                    <div class="blog-details-page__text-1"> Sejak diresmikan sebagai Universitas yang
                                        sebelumnya Sekolah Tinggi oleh Menteri Riset Teknologi dan Pendidikan Tinggi,
                                        kemudian berdasarkan keputusan senat Universitas menetapkan berdirinya Fakultas
                                        Ekonomi dan Bisnis (FIK) Universitas Bahaudin Mudhary Madura. FIK UNIBA MADURA
                                        terdiri dari dua departemen yaitu manajemen dan akuntansi. Dua departemen itulah
                                        yang sampai saat ini ada di FIK. </div>
                                    <div class="blog-details-page__quote-box">
                                            <div class="icon"></div>
                                            <div class="text-center">
                                                <h2>"FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS BAHAUDIN MUDHARY MADURA"</h2>
                                            </div>
                                    </div>
                                    <div class="ql-editor">
                                        @foreach ($visimisitujuan as $row)
                                            <?php echo $row->content; ?>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!--End post-details-->
                            <!--End thm-unit-test-->
                        </div>
                        <!--End blog-content-->
                    </div>
                    <!--Start Thm Sidebar Box-->
                </div>
            </div>
    </div>
@endsection
