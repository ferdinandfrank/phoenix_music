@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.min.css') }}">
@stop

@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="../">Home</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1>Library</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <ul class="nav nav-pills sort-source" data-sort-id="portfolio" data-option-key="filter" data-plugin-options='{"layoutMode": "fitRows", "filter": "*"}'>
                    <li><span>Sort by category:</span></li>
                    <li data-option-value="*" class="active"><a href="#">Show All</a></li>
                    <li data-option-value=".TrailerMusic"><a href="#">Trailer Music</a></li>
                    <li data-option-value=".AlbumTrack"><a href="#">Album Tracks</a></li>
                    <li data-option-value=".MenuTheme"><a href="#">Menu Themes</a></li>
                    <li data-option-value=".Logo"><a href="#">Logos</a></li>
                    <li data-option-value=".Sound"><a href="#">Sounds</a></li>
                    <li data-option-value=".licensable"><a href="#">Licensable</a></li>
                    <li data-option-value=".buyable"><a href="#">Buyable</a></li>
                    <li data-option-value=".audiojungle"><a href="#">On AudioJungle</a></li>
                    <li data-option-value=".stye"><a href="#">On SongsToYourEyes</a></li>
                    <li data-option-value=".cdbaby"><a href="#">On CDBaby</a></li>
                    <li data-option-value=".amazon"><a href="#">On Amazon</a></li>
                    <li data-option-value=".itunes"><a href="#">On iTunes</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <input class="form-control" id="search_input" placeholder="Type to search">
            </div>
        </div>
        <hr>
        <div class="row">

            <ul class="portfolio-list sort-destination popup-gallery-ajax" data-sort-id="portfolio">
                @foreach($tracks as $track)
                    <li class="col-md-3 col-sm-6 col-xs-12 isotope-item {{ $track->category->title }}
                            @if (!empty($track->audiojungle) || !empty($track->stye))
                                licensable
                            @endif
                            @if (!empty($track->audiojungle))
                                audiojungle
                            @endif
                            @if (!empty($track->stye))
                                stye
                            @endif
                            @if (!empty($track->cdbaby) || !empty($track->amazon) || !empty($track->itunes))
                                buyable
                            @endif
                            @if (!empty($track->cdbaby))
                                cdbaby
                            @endif
                            @if (!empty($track->amazon))
                                amazon
                            @endif
                            @if (!empty($track->itunes))
                                itunes
                            @endif
                            ">
                        <div class="portfolio-item">
                            <a href="{{ route('tracks.show', $track) }}" data-ajax-on-modal>
                                <span class="thumb-info thumb-info-hide-wrapper-bg">
                                    <span class="thumb-info-wrapper">
                                        <img src="{{ $track->image }}" class="img-responsive" alt="">
                                        <span class="thumb-info-title">
                                            <span class="thumb-info-inner">{{ $track->title }}</span>
                                            <span class="thumb-info-type">{{ $track->category->title }}</span>
                                        </span>
                                    </span>
                                    <span class="thumb-info-action">
                                        <span class="thumb-info-action-icon"><i class="fa fa-play-circle"></i></span>
                                    </span>
                                </span>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('assets/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope/jquery.isotope.min.js') }}"></script>
    <script src="{{ asset('assets/js/library.js') }}"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#search_input').fastLiveFilter('.portfolio-list');
        });

    </script>
@stop