@component('mail::message')

@slot('title')
    {{ trans('email.test.title') }}
@endslot

@slot('subtitle')
    {{ \Carbon\Carbon::now()->formatLocalized('%d %B %Y') }}
@endslot

{{-- Greeting --}}
# {{ trans('email.greeting_plain') }},

{{-- Content --}}
{{ trans('email.test.content', ['title' => Settings::pageTitle()]) }}

{{-- Action Button --}}
@component('mail::button', ['url' => $link, 'color' => 'success'])
    {{ trans('action.to_website') }}
@endcomponent

<!-- Salutation -->
{{ trans('email.salutation') }}<br>{{ Settings::pageTitle() }}

<!-- Subcopy -->
@slot('subcopy')
    @component('mail::subcopy')
        {{ trans('email.test.receiving_info', ['title' => Settings::pageTitle()]) }}
    @endcomponent
    @component('mail::subcopy')
        {{ trans('email.button_help', ['button' => trans('action.to_the_blog')]) }}: [{{ $link }}]({{ $link }})
    @endcomponent
@endslot

@endcomponent
