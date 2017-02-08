@extends('emails.layout')

@section('content')
    <!-- Greeting -->
    <h3>
        @if (!empty($greeting))
            {{ $greeting }},
        @else
            @if ($level == 'error')
                Whoops!
            @else
                {{ trans('email.greeting_plain') }},
            @endif
        @endif
    </h3>

    <!-- Intro -->
    @foreach ($introLines as $line)
        <p>{!! $line !!}</p>
    @endforeach

    <!-- Action Button -->
    @if (isset($actionText))
        <table align="center" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center">
                    <a href="{{ $actionUrl }}" class="btn btn-{{ $level }}" target="_blank">
                        {{ $actionText }}
                    </a>
                </td>
            </tr>
        </table>
    @endif

    <!-- Outro -->
    @foreach ($outroLines as $line)
        <p>{!! $line !!}</p>
    @endforeach
@stop

@section('extra')
    @if (isset($actionText))
        <table>
            <tr>
                <td>
                    <p>
                        {{ trans('email.extra', ['button' => $actionText]) }}:
                        <a href="{{ $actionUrl }}" target="_blank">
                            {{ $actionUrl }}
                        </a>
                    </p>
                </td>
            </tr>
        </table>
    @endif
@stop
