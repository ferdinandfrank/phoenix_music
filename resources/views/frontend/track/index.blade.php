@extends('frontend.layout')

@section('breadcrumb')
    <li><a href="{{ route('tracks.index') }}">{{ trans('labels.library') }}</a></li>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col xs-12 md-9">
                <ul class="category-list">
                    <li><span>{{ trans('action.sort_by_type') }}:</span></li>
                    <li v-on:click="sortByCategory('item')" class="active sort-item"><a
                                href="#">{{ trans('action.show_all') }}</a></li>
                    <li class="sort-track" v-on:click="sortByCategory('track')"><a
                                href="#">{{ trans('labels.tracks') }}</a></li>
                    <li class="sort-album" v-on:click="sortByCategory('album')"><a
                                href="#">{{ trans('labels.albums') }}</a></li>
                    <li class="sort-buyable" v-on:click="sortByCategory('buyable')"><a
                                href="#">{{ trans('labels.buyable') }}</a></li>
                    <li class="sort-licensable" v-on:click="sortByCategory('licensable')"><a
                                href="#">{{ trans('labels.licensable') }}</a></li>
                </ul>
                <ul class="category-list">
                    <li><span>{{ trans('action.sort_tracks_by_category') }}:</span></li>
                    <li v-on:click="sortByCategory('album_track')" class="sort-album_track"><a
                                href="#">{{ trans('labels.album_track') }}</a></li>
                    @foreach($categories as $trackCategory)
                        <li class="sort-category-{{ $trackCategory->id }}"
                            v-on:click="sortByCategory('category-{{ $trackCategory->id }}')"><a
                                    href="#">{{ $trackCategory->title }}</a></li>
                    @endforeach
                </ul>
                <ul class="category-list">
                    <li><span>{{ trans('action.sort_by_shop') }}:</span></li>
                    <li class="sort-audiojungle" v-on:click="sortByCategory('audiojungle')"><a href="#">AudioJungle</a>
                    </li>
                    <li class="sort-stye" v-on:click="sortByCategory('stye')"><a href="#">SongsToYourEyes</a></li>
                    <li class="sort-cdbaby" v-on:click="sortByCategory('cdbaby')"><a href="#">CDBaby</a></li>
                    <li class="sort-amazon" v-on:click="sortByCategory('amazon')"><a href="#">Amazon</a></li>
                    <li class="sort-itunes" v-on:click="sortByCategory('itunes')"><a href="#">iTunes</a></li>
                </ul>
            </div>
            <div class="col xs-12 md-3">
                <input class="form-control" id="search_input" placeholder="{{ trans('action.search') }}...">
            </div>
        </div>
        <hr>
        <ul id="portfolio-list" class="portfolio-list">
            @foreach($albums as $album)
                <li class="item large-item album
                @if ($album->isLicensable())licensable @endif
                @if ($album->isBuyable())buyable @endif
                @if (!empty($album->audiojungle))audiojungle @endif
                @if (!empty($album->stye))stye @endif
                @if (!empty($album->cdbaby))cdbaby @endif
                @if (!empty($album->amazon))amazon @endif
                @if (!empty($album->itunes))itunes @endif
                        ">
                    <a href="{{ $album->getPath() }}">
                        <div class="image" style="background-image: url({{ $album->image }})"></div>
                        <div class="details">
                            <p class="title">{{ $album->title }}</p>
                            <div class="categories">
                                <span>{{ trans('labels.album')  }}</span>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
            @foreach($tracks as $track)
                @include('frontend.track.portfolio_item')
            @endforeach
        </ul>
    </div>
@stop

@push('js')
<script>
    $(document).ready(function () {
        new VueModel({
            el: '#content-wrapper',

            mounted() {
                $('#search_input').fastLiveFilter('#portfolio-list');
                @if(isset($category))
                    this.sortByCategory('category-{{ $category->id }}');
                @endif
            },

            methods: {
                sortByCategory: function (category) {
                    let portfolioItem = $('#portfolio-list > li');
                    portfolioItem.show();
                    portfolioItem.not('.' + category).hide('slow');
                    $('.category-list > li').removeClass('active');
                    $('.sort-' + category).addClass('active');
                }
            }
        });
    });
</script>
@endpush
