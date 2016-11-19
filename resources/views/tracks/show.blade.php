<div class="ajax-container">
    <div class="row">
        <div class="col-md-12">
            <div class="portfolio-title">
                <div class="row">
                    <div class="portfolio-nav-all col-md-1">
                        <a href="#" data-ajax-portfolio-close data-tooltip data-original-title="Close"><i class="fa fa-th"></i></a>
                    </div>
                    <div class="col-md-10 center">
                        <h2 class="mb-none heading-dark">{{ $track->title }}</h2>
                    </div>
                    <div class="portfolio-nav col-md-1">
                        <a href="#" data-ajax-portfolio-prev class="portfolio-nav-prev" data-tooltip data-original-title="Previous"><i class="fa fa-chevron-left"></i></a>
                        <a href="#" data-ajax-portfolio-next class="portfolio-nav-next" data-tooltip data-original-title="Next"><i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <hr class="tall">
        </div>
    </div>

    <div class="row mb-xl">
        <div class="col-md-4">
                <span class="img-thumbnail">
                    <img alt="{{ $track->title }}" class="img-responsive" src="{{ $track->image }}">
                    <audio preload="metadata" controls class="library_audio">
                      <source src="{{ $track->file }}" type="audio/mpeg">
                    Sorry, your browser can not handle the epicness of this audio file...
                    </audio>
                </span>
        </div>
        <div class="col-md-8">
            <div class="portfolio-info">
                <div class="row">
                    <div class="col-md-12 center">
                        <ul><li><i class="fa fa-calendar"></i>{{ $track->published_at->toDateString() }}</li></ul>
                    </div>
                </div>
            </div>
            @if(!empty($track->description))
                <h5 class="mt-sm text-color-dark">Description</h5>
                <p class="text-color-dark">{!! $track->description !!}</p>
            @endif
            <h5 class="mt-sm text-color-dark">Details</h5>

            <p class="text-color-dark mb-none">
                <b>Composer: </b>{{ $track->composer->name }}
            </p>
            <p class="text-color-dark mb-none">
                <b>Category: </b>{{ $track->category->title }}
            </p>
            @if(!empty($track->album))
            <p class="text-color-dark mb-none">
                <b>Album: </b>{{ $track->album->title }}
            </p>
            @endif

            <p class="text-color-dark mb-none">
                <b>Length: </b>{{ $track->length }}
            </p>
            <p class="text-color-dark mb-none">
                <b>BPM: </b>{{ $track->bpm }}
            </p>

            <h5 class="mt-sm mb-xs text-color-dark">Tags</h5>
            <p class="text-color-dark">{{ $track->tags }}</p>

            <h5 class="mt-sm mb-xs text-color-dark">Get it now!</h5>
            @if (!empty($track->stye))
                <a href="{{ \App\Utils\UrlGenerator::stye($track->stye) }}" target="_blank"><img class="available_button" alt="SongsToYourEyes" src="{{ asset('assets/images/logos/available_on_stye.png') }}" /></a>
            @endif

            @if (!empty($track->cdbaby))
                <a href="{{ \App\Utils\UrlGenerator::cdbaby($track->cdbaby) }}" target="_blank"><img class="available_button" alt="CDBaby" src="{{ asset('assets/images/logos/available_on_cdbaby.png') }}" /></a>
            @endif

            @if (!empty($track->amazon))
                <a href="{{ \App\Utils\UrlGenerator::amazon($track->amazon) }}" target="_blank"><img class="available_button" alt="Amazon" src="{{ asset('assets/images/logos/available_on_amazon.png') }}" /></a>
            @endif

            @if (!empty($track->audiojungle))
                <a href="{{ \App\Utils\UrlGenerator::audiojungle($track->audiojungle) }}" target="_blank"><img class="available_button" alt="Audiojungle" src="{{ asset('assets/images/logos/available_on_audiojungle.png') }}" /></a>
            @endif

            @if (!empty($track->iTunes))
                <a href="{{ \App\Utils\UrlGenerator::iTunes($track->iTunes) }}" target="_blank"><img class="available_button" alt="iTunes" src="{{ asset('assets/images/logos/available_on_itunes.png') }}" /></a>
            @endif
        </div>
    </div>
</div>