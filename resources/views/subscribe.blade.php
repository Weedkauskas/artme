{{-- Layout extend --}}
@extends('layouts.master')

{{-- page title --}}
@section('title', 'Subscribe')

{{-- page content --}}
@section('content')

    <div class="spoil"></div>

    <div class="side">
        <div class="d-grid gap-2">
            <a href="{{ route('welcome') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center min-vh-100">

            @if ($success)
                <div class="alert alert-success" role="alert">
                    Success! Thanks for subscribing!
                </div>
            @else
                <form method="post" action="{{ route('subscribe_post') }}" class="my-3">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <h3 class="text-center">Subscribe to get notifications for the latest phases</h3>

                    <div class="mb-3">
                        <label for="name" class="form-label">Your name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>

                    @include('parts.errors')

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
