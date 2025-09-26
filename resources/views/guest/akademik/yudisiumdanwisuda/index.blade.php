@extends('layouts.app')
@section('active-akademik', 'current')

@section('content')
    <!--Start breadcrumb area paroller-->
    <section class="breadcrumb-area">
        <div class="breadcrumb-area-bg" style="background-image: url({{ asset('images/yudisium-wisuda/'. $akademik->image_header) }});">
        </div>
        <div class="container">
            <div class="row  pt-4">
                <div class="col-xl-12 mt-5">
                    <div class="inner-content">
                        <div class="title">
                            <h2>Yudisium & Wisuda</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home &nbsp;</a></li>
                                <li class="breadcrumb-item">Yudisium & Wisuda</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End breadcrumb area-->
    <div data-elementor-type="wp-page" data-elementor-id="1658" class="elementor elementor-1658">
        <section
            class="elementor-section elementor-top-section elementor-element elementor-element-497c310 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
            data-id="497c310" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-eb0bec2"
                    data-id="eb0bec2" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-f00ed8a elementor-widget elementor-widget-educamb_our_events_v4"
                            data-id="f00ed8a" data-element_type="widget" data-widget_type="educamb_our_events_v4.default">
                            <div class="elementor-widget-container">

                                <!--Start Events page Two-->
                                <section class="events-page-two">
                                    <div class="container">

                                        <div class="row">
                                            <div class="col-xl-12">
                                                @foreach ($yudwis as $row)

                                                <!--Start Single Event Two-->
                                                <div class="single-event-two">
                                                    <div class="single-event-two__inner">
                                                        <div class="row">
                                                            <div class="col-xl-4">
                                                                <div class="single-event-two__info-box">
                                                                    <div class="date-box">
                                                                        <h2>{{ date('d', strtotime($row->date)) }}</h2>
                                                                        <h4>{{ date('M, Y', strtotime($row->date)) }}</h4>
                                                                    </div>
                                                                    <ul>
                                                                        <li><span class="icon-time"></span> {{$row->image_content}} </li>
                                                                        <li><span class="icon-location-1"></span> {{$row->description}}</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-8">
                                                                <div class="single-event-two__text-box">
                                                                    <div class="top">
                                                                        <div class="text-box">

                                                                            <h3>{{$row->title}}</h3>
                                                                            <p>
                                                                                @if (strlen($row->content) <= 200)
                                                                                {{$row->content}}
                                                                                @else
                                                                                {{ substr($row->content, 0, 200)}} &hellip;
                                                                                @endif
                                                                            </p>

                                                                        </div>
                                                                        <div class="price-box">
                                                                            <div class="inner">
                                                                                @if ($row->date < Carbon\Carbon::now())
                                                                                <h3>Finished</h3>
                                                                                @else
                                                                                <h3> <center>Ongoing</center></h3>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="bottom">
                                                                        <div class="btn-box">
                                                                            <a>
                                                                                <span class="fa fa-bookmark-o"></span>University Event</a>
                                                                        </div>
                                                                        <div class="category-box">
                                                                            <span class="fa fa-user"></span>
                                                                            <ul>
                                                                                <li><a>Uploaded by admin </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--End Single Event Two-->
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!--End Events page Two-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section
            class="elementor-section elementor-top-section elementor-element elementor-element-e6bd25f elementor-section-full_width elementor-section-height-default elementor-section-height-default"
            data-id="e6bd25f" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-8ea4953"
                    data-id="8ea4953" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-e7052e8 elementor-widget elementor-widget-educamb_call_to_action"
                            data-id="e7052e8" data-element_type="widget"
                            data-widget_type="educamb_call_to_action.default">
                            <div class="elementor-widget-container">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="clearfix"></div>
@endsection
