@component('mail::message')

@slot('title')
    {{ trans('email.registration.title') }}
@endslot

@slot('subtitle')
    {{ \Carbon\Carbon::now()->formatLocalized('%d %B %Y') }}
@endslot

{{-- Greeting --}}
# {{ trans('email.greeting', ['name' => $user->display_name]) }},

{{-- Content --}}
@foreach ($introLines as $line)
{{ $line }}
@endforeach
<br/>
**{{ trans('input.email') }}:** {{ $user->email }}<br/>
**{{ trans('input.password') }}:** {{ $password }}<br/>

{{-- Action Button --}}
@component('mail::button', ['url' => $actionUrl, 'color' => 'success'])
    {{ $actionText }}
@endcomponent

<!-- Salutation -->
{{ trans('email.salutation') }}<br>{{ Settings::pageTitle() }}

<!-- Subcopy -->
@slot('subcopy')
    @component('mail::subcopy')
        {{ trans('email.registration.receiving_info', ['title' => Settings::pageTitle()]) }}
    @endcomponent
    @component('mail::subcopy')
        {{ trans('email.button_help', ['button' => $actionText]) }}: [{{ $actionUrl }}]({{ $actionUrl }})
    @endcomponent
@endslot

@endcomponent


