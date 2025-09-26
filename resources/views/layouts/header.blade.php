<header class="main-header header-style-nine">
    <!--Start Header Top style9-->
    <div class="header-top-style9">
        <div class="container">
            <div class="outer-box">
                <div class="header-top-style9-left">
                    <div class="social-link-box-style1">
                        <div class="icon">
                            <span class="icon-share"></span>
                        </div>
                        <p>Follow</p>
                        <ul class="clearfix">
                            <li><a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="https://www.linkedin.com/"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a></li>

                        </ul>
                    </div>
                </div>
                <div class="header-top-style9-right">
                    <div class="quick-link-box">
                        <div class="link-box">
                            <ul>
                                {{-- <li id="menu-item-5444" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5444">
                                    <a title="Student Registration" href="../student-registration/index.html" class="hvr-underline-from-left1" data-scroll
                                        data-options="easing: easeOutQuart" onClick="return true">Student
                                        Registration</a>
                                </li>
                                <li id="menu-item-5443" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5443">
                                    <a title="Instructor Registration"
                                        href="../instructor-registration/index.html" class="hvr-underline-from-left1" data-scroll
                                        data-options="easing: easeOutQuart" onClick="return true">Instructor
                                        Registration</a>
                                </li>
                                <li id="menu-item-5441" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5441">
                                    <a title="Dashboard" href="../dashboard/index.html" class="hvr-underline-from-left1" data-scroll
                                        data-options="easing: easeOutQuart" onClick="return true">Dashboard</a>
                                </li> --}}
                                <li id="menu-item-5440" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5440">
                                    <a title="Contact" href="{{route('home')}}" class="hvr-underline-from-left1" data-scroll data-options="easing: easeOutQuart" onClick="return true">FIK &#8211; UNIBA MADURA</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Header Top style9-->
    <!--Start Header Style9-->
    <div class="header-style9">
        <div class="container">
            <div class="outer-box">

                <!--Start Header Style9 Left-->
                <div class="header-style9-left">
                    <div class="nav-outer style9 clearfix">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler">
                            <div class="inner">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </div>
                        </div>
                        <!-- Main Menu -->
                        <nav class="main-menu style9 navbar-expand-md navbar-light">

                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li id="menu-item-1604" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1604 @yield('active-home')">
                                        <a title="Home" href="{{ route('home') }}" class="hvr-underline-from-left1" aria-expanded="false" data-scroll data-options="easing: easeOutQuart" onClick="return true">Home</a>
                                    </li>
                                    <li id="menu-item-2089" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2089 dropdown @yield('active-profil')">
                                        <a title="Profil" href="#" data-toggle="dropdown1" class="hvr-underline-from-left1" aria-expanded="false" data-scroll data-options="easing: easeOutQuart" onClick="return true">Profil</a>
                                        <ul role="menu" class="submenu">
                                            <li id="menu-item-2099" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2099 @yield('active-sejarah-fakultas')">
                                                <a title="Sejarah Fakultas" href="{{ route('guest.sejarah') }}" onClick="return true">Sejarah Fakultas</a>
                                            </li>
                                            <li id="menu-item-4124" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4124 @yield('active-visi-misi')">
                                                <a title="Visi, Misi, dan Tujuan Fakultas" href="{{ route('guest.visi-misi') }}" onClick="return true">Visi, Misi, dan Tujuan Fakultas</a>
                                            </li>
                                            <li id="menu-item-4125" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4125 @yield('active-pimpinan')">
                                                <a title="Profil Pimpinan Fakultas" href="{{ route('guest.pimpinan') }}" onClick="return true">Profil Pimpinan Fakultas</a>
                                            </li>
                                            <li id="menu-item-4126" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4125 @yield('active-dosen')">
                                                <a title="Profil Dosen FIK" href="{{ route('guest.staff-dosen-fik') }}" onClick="return true">Profil Dosen FIK</a>
                                            </li>
                                            <li id="menu-item-1593" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1593 @yield('active-fasilitas')">
                                                <a title="Fasilitas FIK" href="{{ route('guest.fasilitas-fik') }}"onClick="return true">Fasilitas FIK</a>
                                            </li>
                                            <li id="menu-item-1593" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1593 @yield('active-akreditasi')">
                                                <a title="Akreditasi FIK" href="{{ route('guest.akreditasi-fik') }}" onClick="return true">Akreditasi FIK</a>
                                            </li>
                                            {{-- <li id="menu-item-1593" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1593 @yield('active-rencana-strategis')">
                                                <a title="Rencana Strategis" href="{{ route('guest.rencana-strategis-fik') }}" onClick="return true">Rencana Strategis</a>
                                            </li> --}}
                                            {{-- <li id="menu-item-4125" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4125">
                                                <a title="College Programs Details"
                                                    href="../college-programs-details/index.html"
                                                    onClick="return true">Identitas FIK</a>
                                            </li> --}}
                                            {{-- <li id="menu-item-4125" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4125">
                                                <a title="College Programs Details"
                                                    href="{{ route('guest.struktur-organisasi-fik') }}"
                                                    onClick="return true">Struktur Organisasi</a>
                                            </li> --}}
                                            {{-- <li id="menu-item-4125" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4125">
                                                <a title="College Programs Details"
                                                    href="../college-programs-details/index.html"
                                                    onClick="return true">Booklet FIK</a>
                                            </li> --}}
                                        </ul>
                                    </li>
                                    <li id="menu-item-2089" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2089 dropdown @yield('active-akademik')">
                                        <a title="Akademik" href="#" data-toggle="dropdown1" class="hvr-underline-from-left1" aria-expanded="false" data-scroll data-options="easing: easeOutQuart" onClick="return true">Akademik</a>
                                        <ul role="menu" class="submenu">
                                            {{-- <li id="menu-item-2099" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2099 @yield('active-buku-pedoman-skripsi')">
                                                <a title="Buku Pedoman Skripsi"href="#"onClick="return true">Buku Pedoman Skripsi</a>
                                            </li> --}}
                                            <li id="menu-item-2099" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2099 @yield('active-panduan-pendidikan')">
                                                <a title="Panduan Pendidikan FIK"href="{{route('guest.panduan-pendidikan-fik')}}"onClick="return true">Panduan Pendidikan FIK</a>
                                            </li>
                                            <li id="menu-item-2089" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2089 dropdown @yield('active-prodi')">
                                                <a title="Program Studi" href="#" data-toggle="dropdown1" class="hvr-underline-from-left1" aria-expanded="false" data-scrolldata-options="easing: easeOutQuart" onClick="return true">Program Studi</a>
                                                <ul role="menu" class="submenu">
                                                        @foreach (\App\Models\ContentAcademic::where('akademik_id', '2')->where('publish', '1')->get() as $row)
                                                    <li id="menu-item-2099" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2099 @yield('active-akuntansi')">
                                                        <a title="{{$row->title}}"href="{{ $row->content }}"onClick="return true">{{$row->title}}</a>
                                                    </li>
                                                        @endforeach
                                                </ul>
                                            </li>
                                            <li id="menu-item-2099" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2099 @yield('active-kalender-akadmeik')">
                                                <a title="Kalender Akademik" href="{{route('guest.kalender-akademik-fik')}}"onClick="return true">Kalender Akademik</a>
                                            </li>
                                            <li id="menu-item-2099" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2099 @yield('active-yudisium-wisuda')">
                                                <a title="Yudisium & Wisuda" href="{{route('guest.yudisium-dan-wisuda-fik')}}"onClick="return true">Yudisium & Wisuda</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li id="menu-item-2089" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2089 dropdown @yield('active-kemahasiswaan')">
                                        <a title="Kemahasiswaan" href="#" data-toggle="dropdown1" class="hvr-underline-from-left1" aria-expanded="false" data-scrolldata-options="easing: easeOutQuart"onClick="return true">Kemahasiswaan</a>
                                        <ul role="menu" class="submenu">
                                            <li id="menu-item-2089" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2089 dropdown @yield('active-info-kemahasiswaan')">
                                                <a title="Info Kemahasiswaan" href="#" data-toggle="dropdown1" class="hvr-underline-from-left1" aria-expanded="false"data-scroll data-options="easing: easeOutQuart"onClick="return true">Info Kemahasiswaan</a>
                                                <ul role="menu" class="submenu">
                                                    <li id="menu-item-2099" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2099 @yield('active-beasiswa')">
                                                        <a title="Beasiswa"href="{{route('guest.beasiswa-fik')}}"onClick="return true">Beasiswa</a>
                                                    </li>
                                                    <li id="menu-item-2099" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2099 @yield('active-prestasi-mahasiswa')">
                                                        <a title="Prestasi Mahasiswa"href="{{route('guest.prestasi-mahasiswa-fik')}}"onClick="return true">Prestasi Mahasiswa</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li id="menu-item-2089" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2089 dropdown @yield('active-ormawa')">
                                                <a title="Academics" href="#" data-toggle="dropdown1" class="hvr-underline-from-left1" aria-expanded="false"data-scroll data-options="easing: easeOutQuart"onClick="return true">Ormawa</a>
                                                <ul role="menu" class="submenu">
                                                    <?php $ormawa = \App\Models\ContentKemahasiswaan::where('kemahasiswaan_id', '3')->get(); ?>
                                                    @foreach ($ormawa as $row)
                                                    <li id="menu-item-2099" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2099 @yield('active-ormawa-{{ $row->id }}')">
                                                        <a title="{{ $row->description }}"href="{{ route('ormawa-fik.show', $row->id) }}" onClick="return true">{{ $row->description }}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <?php $pendaftaran = \App\Models\ContentKemahasiswaan::where('kemahasiswaan_id', '4')->first(); ?>
                                            <li id="menu-item-1593" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1593 @yield('active-pendaftaran')">
                                                <a title="Pendaftaran" href="{!! $pendaftaran->content !!}"onClick="return true">Pendaftaran</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li id="menu-item-1605" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-1605 dropdown @yield('active-berita')">
                                        <a title="Berita" href="#" data-toggle="dropdown1" class="hvr-underline-from-left1" aria-expanded="false" data-scrolldata-options="easing: easeOutQuart" onClick="return true">Berita</a>
                                        <ul role="menu" class="submenu">
                                            <li id="menu-item-1593" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1593 @yield('active-informasi')">
                                                <a title="Informasi" href="{{ route('guest.informasi-fik') }}"onClick="return true">Informasi</a>
                                            </li>
                                            <li id="menu-item-1591" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1591 @yield('active-pengumuman')">
                                                <a title="Pengumuman" href="{{route('guest.pengumuman-fik')}}"onClick="return true">Pengumuman</a>
                                            </li>
                                            <li id="menu-item-1606" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1606 @yield('active-agenda')">
                                                <a title="Agenda"href="{{ route('guest.agenda-fik') }}"onClick="return true">Agenda</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li id="menu-item-1605" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-1605 dropdown @yield('active-alumni')">
                                        <a title="Alumni" href="#" data-toggle="dropdown1" class="hvr-underline-from-left1" aria-expanded="false" data-scrolldata-options="easing: easeOutQuart" onClick="return true">Alumni</a>
                                        <ul role="menu" class="submenu">
                                            <li id="menu-item-1594" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1594 @yield('active-tentang-alumni')">
                                                <a title="Tentang Alumni FIK" href="{{ route('guest.tentang-alumni-fik') }}"onClick="return true">Tentang Alumni FIK</a>
                                            </li>
                                            <li id="menu-item-1594" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1594 @yield('active-ikatan-alumni')">
                                                <a title="Ikatan Alumni FIK" href="{{ route('guest.ikatan-alumni-fik') }}"onClick="return true">Ikatan Alumni FIK</a>
                                            </li>
                                            <?php $tracerstudy = \App\Models\ContentAlumni::where('alumni_id', '3')->first(); ?>
                                            <li id="menu-item-1594" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1594 @yield('active-tracer-study')">
                                                <a title="Tracer Study" href="{!! $tracerstudy->content !!}"onClick="return true">Tracer Study</a>
                                            </li>
                                            <li id="menu-item-1594" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1594 @yield('active-peluang-kerja')">
                                                <a title="Peluang Kerja" href="{{ route('guest.peluang-kerja-fik') }}"onClick="return true">Peluang Kerja</a>
                                            </li>
                                        </ul>
                                    </li>
                                    {{-- <li id="menu-item-1605" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-1605 dropdown @yield('active-informasi-publik')">
                                        <a title="Informasi Publik" href="#" data-toggle="dropdown1" class="hvr-underline-from-left1" aria-expanded="false" data-scrolldata-options="easing: easeOutQuart" onClick="return true">Informasi Publik</a>
                                        <ul role="menu" class="submenu">
                                            <li id="menu-item-2089" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2089 dropdown @yield('active-zona-integritas')">
                                                <a title="Zona Integritas" href="#" data-toggle="dropdown1" class="hvr-underline-from-left1" aria-expanded="false" data-scrolldata-options="easing: easeOutQuart" onClick="return true">Zona Integritas</a>
                                                <ul role="menu" class="submenu">
                                                    <li id="menu-item-2099" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2099 @yield('active-pakta-integritas')">
                                                        <a title="Pakta Integritas"href="#"onClick="return true">Pakta Integritas</a>
                                                    </li>
                                                    <li id="menu-item-2099" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2099 @yield('active-aturan-grafikasi')">
                                                        <a title="College"href="#"onClick="return true">Aturan Gratifikasi</a>
                                                    </li>
                                                    <li id="menu-item-2099" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2099 @yield('active-dokumen-zona-integritas')">
                                                        <a title="Dokumen Zona Integritas"href="#"onClick="return true">Dokumen Zona Integritas</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li id="menu-item-2089" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2089 dropdown @yield('active-download-document')">
                                                <a title="Download Document" href="#" data-toggle="dropdown1" class="hvr-underline-from-left1" aria-expanded="false" data-scrolldata-options="easing: easeOutQuart" onClick="return true">Download Document</a>
                                                <ul role="menu" class="submenu">
                                                    <li id="menu-item-2099" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2099 @yield('active-expo')">
                                                        <a title="UNIBA Madura Expo"href="#"onClick="return true">UNIBA Madura Expo</a>
                                                    </li>
                                                    <li id="menu-item-2099" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2099 @yield('active-sop')">
                                                        <a title="SOP"href="#"onClick="return true">SOP</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li> --}}
                                </ul>
                            </div>
                        </nav>
                        <!-- Main Menu End-->
                    </div>
                </div>
                <!--End Header Style9 Left-->

                <!--Start Header Right-->
                <div class="header-style9-right">
                    <ul class="clearfix">
                        {{-- <li>
                            <a href="../my-account/index.html">
                                <span class="flaticon-user"></span>
                            </a>
                        </li> --}}

                        <li>
                            <button type="button" class="search-toggler">
                                <span class="icon-zoom"></span>
                            </button>
                        </li>
                    </ul>
                </div>
                <!--End Header Right-->

            </div>
        </div>
    </div>
    <!--End header-->

    <!--Start Header Bottom Style9-->
    <div class="header-bottom-style9">
        <div class="container">
            <div class="outer-box">
                <div class="header-bottom-style9-right">
                    {{-- <div class="logo-box-style9"> --}}
                        <a href="{{ route('home') }}" title="UNIBA Madura"><img src="{{ asset('images/default/logo-text.png') }}" alt="logo" style=" width:285px" /></a>
                    {{-- </div> --}}
                </div>
                <div class="header-bottom-style9-middle">
                    <div class="header-contact-info-style9">
                        <ul>
                            <li>

                            </li>
                            <li>
                                <div class="icon">
                                    <span class="flaticon-map"></span>
                                </div>
                                <div class="text">
                                    <p>Jl. Raya Lenteng, Aredake, Batuan, Kec. Batuan, <br> Kabupaten Sumenep, JawaTimur 69451</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="flaticon-telephone"></span>
                                </div>
                                <div class="text">
                                    <p>
                                        <a href="tel:03280771010">(0328) 6771010</a><br>
                                        <a href="mailto:admin@unibamadura.ac.id">admin@unibamadura.ac.id</a>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- <div class="header-bottom-style9-right">
                    <div class="btns-box">
                        <a class="btn-one" href="../contact-08/index.html">
                            <span class="txt">Apply Now</span>
                        </a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!--End Header Bottom Style9-->

    <!--Sticky Header-->
    <div class="sticky-header">
        <div class="container">
            <div class="sticky-header__inner clearfix">
                <!--Logo-->
                <div class="logo float-left">
                    <div class="img-responsive">
                        <a href="{{ route('home') }}" title="UNIBA Madura"><img src="{{ asset('images/default/logo-text.png') }}"
                                alt="UNIBA Madura" style="height:40px;  width:285px"/></a>
                    </div>
                </div>
                <!--Right Col-->
                <div class="right-col float-right">
                    <!-- Main Menu -->
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--End Sticky Header-->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon fa fa-times-circle"></span></div>
        <nav class="menu-box">
            <div class="nav-logo">
                <a href="{{ route('home') }}" title="FIK-UNIBA Madura"><img src="{{ asset('images/default/logo-text.png') }}"
                        alt="logo" style="width:285px" /></a>
            </div>
            <div class="menu-outer">
                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            </div>
            <!--Social Links-->
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="https://www.facebook.com/"><span class="fab fa-facebook"></span></a></li>
                    <li><a href="https://www.googleplus.com/"><span class="fab fa-google-plus"></span></a></li>
                    <li><a href="https://www.pinterest.com/"><span class="fab fa-pinterest"></span></a></li>
                    <li><a href="https://www.twitter.com/"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="https://www.youtube.com/"><span class="fab fa-youtube"></span></a></li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- End Mobile Menu -->

</header>
