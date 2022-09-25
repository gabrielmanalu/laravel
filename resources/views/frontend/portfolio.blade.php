@extends('frontend.main_master')
@section('main')

@section('title')
Portfolio
@endsection

<main>

    <!-- breadcrumb-area -->
    <section class="breadcrumb__wrap">
        <div class="container custom-container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="breadcrumb__wrap__content">
                        <h2 class="title">Portfolio</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Portfolio</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__wrap__icon">
            <ul>
                @foreach ($allMultiImage as $item)
                <li>
                    <li>
                        <img src="{{ asset($item->multi_image) }}" alt="XD">
                    </li>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- portfolio-area -->
    <section class="portfolio__inner">
        <div class="container">
            <div class="portfolio__inner__active">
                @foreach ($portfolio as $item)
                <div class="portfolio__inner__item grid-item cat-two cat-three">
                    <div class="row gx-0 align-items-center">
                        <div class="col-lg-6 col-md-10">
                            <div class="portfolio__inner__thumb">
                                <a href="{{ route('portfolio.details', $item->id) }}">
                                    <img src="{{ asset($item->portfolio_image) }}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-10">
                            <div class="portfolio__inner__content">
                                <h2 class="title"><a href="{{ route('portfolio.details', $item->id) }}">{{ $item->portfolio_name }}</a></h2>
                                <p>{!! Str::limit($item->portfolio_description, 400) !!}</p>
                                <a href="portfolio-details.html" class="link">View Case Study</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="pagination-wrap">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#"><i class="far fa-long-arrow-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="far fa-long-arrow-right"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <!-- portfolio-area-end -->


    <!-- contact-area -->
    @include('frontend.home_all.home_contact')
    <!-- contact-area-end -->

</main>

@endsection
