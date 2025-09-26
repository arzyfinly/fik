@extends('layouts.app')

@section('content')
    <!--Start breadcrumb area paroller-->
    <section class="breadcrumb-area">
        <div class="breadcrumb-area-bg" style="background-image: url({{ asset('images/peluang-kerja/'. $alumni->image_header) }});">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title">
                            <h2> Peluang Kerja</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home &nbsp;</a></li>
                                <li class="breadcrumb-item">Peluang Kerja</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End breadcrumb area-->

    <<!--Start Blog Page Two -->
    <section class="blog-page-two">
        <div class="thm-pattern-style5"
            style="background-image: url(../wp-content/themes/educamb/assets/images/pattern/thm-pattern-2.png);">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-8 ">
                    <div class="blog-page-two__content">
                        <div class="row">
                            <div class="col-xl-12" id="paginate-list">
                                <!--Start Single Blog Style2-->
                                @foreach($peluang as $row)
                                <div class="single-blog-style2" id="list">
                                    <div class="single-blog-style2__img-holder">
                                        <div class="inner">
                                            <img loading="lazy"
                                                src="{{ asset('images/peluang-kerja/'.$row->image_content) }}"
                                                class="img-fluid"alt="" />
                                        </div>
                                    </div>
                                    <div class="single-blog-style2__text-holder">
                                        <div class="top">
                                            <div class="category-box">
                                                <div class="dot-box"></div>
                                                <p><a rel="category tag">Peluang Kerja</a></p>
                                            </div>
                                        </div>
                                        <h3 class="blog-title">
                                            <a>{{ $row->title }}</a>
                                        </h3>
                                        @if(strlen($row->content) >= 150)
                                            <div class="text">{{ strip_tags(substr($row->content, 0, 150)) }}&hellip;</div>
                                        @else
                                            <div class="text">{!! $row->content !!}</div>
                                        @endif
                                        <div class="bottom-box">
                                            <div class="btn-box">
                                                <a
                                                    href="{{ route('peluang-kerja-fik.show',$row->id) }}">
                                                    <span class="icon-right-arrow-1"></span>Read
                                                    More </a>
                                            </div>
                                            <div class="meta-info">
                                                <ul>
                                                    <li>
                                                        <span class="icon-user"></span>
                                                        <a>admin</a>
                                                    </li>
                                                    <li>
                                                        <span class="icon-calendar"></span>
                                                        <a>{{ date('M d', strtotime($row->date)) }}, {{ date('Y', strtotime($row->date)) }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!--End Single Blog Style2-->

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="styled-pagination clearfix">
                                    {{ $peluang->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Start Thm Sidebar Box-->
                <div class="col-xl-3 col-lg-5">
                    <div class="thm-sidebar-box">
                        <div id="search-2" class="widget sidebar-search-box widget_search">
                            <form action="#" method="post" class="search-form">
                                <input type="search" name="s" value="" placeholder="Search here"
                                    required="">
                                <button type="submit"><i class="icon-zoom"></i></button>
                            </form>
                        </div>
                        <div id="categories-2" class="widget sidebar-search-box widget_categories">
                            <div class="sidebar-title">
                                <div class="dot-box"></div>
                                <h3>Categories</h3>
                            </div>
                            <ul>
                                <li class="cat-item cat-item-35"><a href="{{ route('guest.informasi-fik') }}">Informasi</a>
                                </li>
                                <li class="cat-item cat-item-86"><a href="{{ route('guest.pengumuman-fik') }}">Pengumuman</a>
                                </li>
                                <li class="cat-item cat-item-28"><a href="{{ route('guest.agenda-fik') }}">Agenda</a>
                                </li>
                            </ul>

                        </div>
                        <div id="educamb_recent_posts-2" class="widget sidebar-search-box widget_educamb_recent_posts">
                            <div class="sidebar-title">
                                <div class="dot-box"></div>
                                <h3>Popular Posts</h3>
                            </div>
                            <?php  $informasi  = App\Models\Berita::where('category_berita_id', '1')->first();
                                   $pengumuman = App\Models\Berita::where('category_berita_id', '2')->first();
                                   $berita     = App\Models\ContentBerita::where('publish', '1')->where('berita_id', $informasi->id)->orwhere('berita_id', $pengumuman->id)->limit(3)->get(); ?>
                            @foreach ($berita as $row)
                                <div class="sidebar-blog-post">
                                    <ul class="blog-post">
                                        <!-- Title -->
                                        <li>
                                            <div class="inner">
                                                <div class="img-box"
                                                    style="background-image:url(@if($row->berita->category_berita_id == 1)
                                                                                    {{ asset('images/berita-informasi/'. $row->image_content) }}
                                                                                @elseif($row->berita->category_berita_id == 2)
                                                                                    {{ asset('images/berita-pengumuman/'. $row->image_content) }}
                                                                                @else
                                                                                    {{ asset('images/berita-agenda/'. $row->image_content) }}
                                                                                @endif);">
                                                    <div class="overlay-content">
                                                        <a href=" @if($row->berita->category_berita_id == 1) {{route('berita-informasi-fik.show',$row->id)}} @elseif($row->berita->category_berita_id == 2) {{route('berita-pengumuman-fik.show',$row->id)}} @else # @endif"><i class="fa fa-link" aria-hidden="true"></i>
                                                    </a>
                                                    </div>
                                                </div>
                                                <div class="title-box">
                                                    <div class="post-date">
                                                        <span class="icon-date"></span> {{ date('M d', strtotime($row->date)) }}, {{ date('Y', strtotime($row->date)) }}
                                                    </div>
                                                    <h4>
                                                        <a href=" @if($row->berita->category_berita_id == 1) {{route('berita-informasi-fik.show',$row->id)}} @elseif($row->berita->category_berita_id == 2) {{route('berita-pengumuman-fik.show',$row->id)}} @else # @endif">{{ substr($row->title,0,30) }}&hellip;</a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            @endforeach

                        </div>
                        <div id="educamb_our_team-2" class="widget sidebar-search-box widget_educamb_our_team">

                            <!-- Title -->
                            <div class="sidebar-author-box text-center">
                                <div class="top">
                                    <h3>Alvin Arifin., S.AB, M.M</h3>
                                    <p>Dekan FIK</p>
                                </div>
                                <div class="img-holder"
                                    style="background-image:url({{asset('images/uniba/PAKALVIN.png')}}); ">
                                </div>
                                <div class="info">
                                    <ul>
                                        <li><a href="mailto:alvin@unibamadura.ac.id">alvin@unibamadura.ac.id</a>
                                        </li>
                                        <li><a href="tel:+6282142084106">082142084106</a></li>
                                    </ul>
                                </div>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Thm Sidebar Box-->

            </div>
        </div>
    </section>
@endsection
