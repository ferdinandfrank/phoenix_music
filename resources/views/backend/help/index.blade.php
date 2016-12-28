@extends('backend.layout')

@section('title', trans('labels.help'))

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ route('help') }}">{{ trans('labels.help') }}</a></li>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <panel id="codearea" title="{{ trans('help.codearea.title') }}" subtitle="{{ trans('help.codearea.subtitle') }}">
                {!! trans('help.codearea.description') !!}
            </panel>
        </div>
    </div>
@stop

@push('js')
<script>
    $(document).ready(function () {
        new VueModel({
            el: '#content-wrapper'
        });
    });
</script>
@endpush