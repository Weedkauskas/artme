{{-- Layout extend --}}
@extends('layouts.master')

{{-- page title --}}
@section('title', 'Welcome programmers')

{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" href="<?php echo asset('css/welcome.css')?>" type="text/css">
@endsection

{{-- page content --}}
@section('content')

    <div class="spoil"></div>

    <div class="subscribeButton">
        <div class="d-grid gap-2">
            <a href="{{ route('subscribe_view') }}" class="btn btn-primary">Subscribe</a>
        </div>
    </div>

    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center min-vh-100 mb-5 mb-lg-0">
            <h1>Choose your magic!</h1>
            <div class="row w-100 mt-5 mb-5">

                @foreach ($magic as $item)
                    <div class="col-12 col-md-6 col-lg-4 my-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $item->title }}</h5>
                                <div class="d-grid gap-2">
                                    <a href="{{ route('visualise', $item->slug) }}" class="btn btn-primary"
                                       type="button">Choose</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <form method="post" action="{{ route('add_magic') }}" class="my-3 magic-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <h3 class="text-center">Or add your own magic</h3>

                <div class="mb-3">
                    <label for="title" class="form-label">Magic title</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>

                @include('parts.errors')

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
@endsection
