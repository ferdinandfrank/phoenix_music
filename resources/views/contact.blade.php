@extends('layout')

@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1>Contact</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h2 class="heading-primary mt-lg">Get in <strong>Touch</strong></h2>
                <p class="lead">Feel free to contact us, if you have any questions or requests about our music. We are also happy for every feedback from your side.</p>

                <ul class="list list-icons list-icons-style-3 mt-xlg">
                    <li><i class="fa fa-envelope"></i> <strong class="text-color-light">Information and Licensing:</strong><br/><a href="mailto:{{ \App\Models\Settings::emailContact() }}">{{ \App\Models\Settings::emailContact() }}</a></li>
                    <li><i class="fa fa-envelope"></i> <strong class="text-color-light">Website and Server Issues:</strong><br/><a href="mailto:{{ \App\Models\Settings::emailAdmin() }}">{{ \App\Models\Settings::emailAdmin() }}</a></li>
                    @foreach(\App\Models\User::all() as $user)
                        <li><i class="fa fa-envelope"></i> <strong class="text-color-light">{{ $user->name }}</strong><br/><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
@stop