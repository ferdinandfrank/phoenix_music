<li class="item track
                @if ($track->isLicensable())licensable @endif
@if ($track->isBuyable())buyable @endif
@if (!empty($track->audiojungle))audiojungle @endif
@if (!empty($track->stye))stye @endif
@if (!empty($track->cdbaby))cdbaby @endif
@if (!empty($track->amazon))amazon @endif
@if (!empty($track->itunes))itunes @endif
@if (!empty($track->album))album_track @endif
@foreach($track->categories as $trackCategory)
        category-{{ $trackCategory->id }}
@endforeach
        ">
    <a href="{{ $track->getPath() }}">
        <div class="image" style="background-image: url({{ $track->image }})"></div>
        <div class="details">
            <p class="title">{{ $track->title }}</p>
            <div class="categories">
                @if (!empty($track->album))
                    <span>{{ trans('labels.album_track') }}</span>
                @endif
                @foreach($track->categories as $trackCategory)
                    <span>{{ $trackCategory->title }}</span>
                @endforeach
            </div>
        </div>
    </a>
</li>