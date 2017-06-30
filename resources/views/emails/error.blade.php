@component('mail::message')

    @slot('title')
        {{ trans('email.error.title') }}
    @endslot

    @slot('subtitle')
        {{ \Carbon\Carbon::now()->formatLocalized('%d %B %Y') }}
    @endslot

{{-- Greeting --}}
# {{ trans('email.greeting_plain') }},

{{-- Content --}}
@foreach ($introLines as $line)
{{ $line }}
@endforeach

{{-- Action Button --}}
@component('mail::button', ['url' => $actionUrl, 'color' => 'success'])
{{ $actionText }}
@endcomponent

<!-- Salutation -->
{{ trans('email.salutation') }}<br>{{ Settings::pageTitle() }}

<!-- Subcopy -->
@slot('subcopy')
    @component('mail::subcopy')
        {{ trans('email.error.receiving_info', ['title' => Settings::pageTitle()]) }}
    @endcomponent
    @component('mail::subcopy')
        {{ trans('email.button_help', ['button' => $actionText]) }}: [{{ $actionUrl }}]({{ $actionUrl }})
    @endcomponent
@endslot

@endcomponent


