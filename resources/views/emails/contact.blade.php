@component('mail::message')

@slot('title')
    {{ trans('email.contact.title') }}
@endslot

@slot('subtitle')
    {{ \Carbon\Carbon::now()->formatLocalized('%d %B %Y') }}
@endslot

{{-- Greeting --}}
# {{ trans('email.greeting_plain') }},

{{-- Content --}}
{{ trans('email.contact.content', ['title' => Settings::pageTitle()]) }}<br/>
**{{ trans('input.name') }}:** {{ $name }}<br/>
**{{ trans('input.email') }}:** {{ $email }}<br/>

*{{ $content }}*

{{-- Action Button --}}
@component('mail::button', ['url' => route('home'), 'color' => 'success'])
    {{ trans('action.to_the_blog') }}
@endcomponent

<!-- Salutation -->
{{ trans('email.salutation') }}<br>{{ Settings::pageTitle() }}

<!-- Subcopy -->
@slot('subcopy')
    @component('mail::subcopy')
        {{ trans('email.contact.receiving_info', ['title' => Settings::pageTitle()]) }}
    @endcomponent
    @component('mail::subcopy')
        {{ trans('email.button_help', ['button' => trans('action.to_website')]) }}: [{{ route('home') }}]({{ route('home') }})
    @endcomponent
@endslot

@endcomponent


