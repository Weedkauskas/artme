{{-- Layout extend --}}
@extends('layouts.master')

{{-- page title --}}
@section('title', 'Unubscribe')

{{-- page content --}}
@section('content')

    <div class="side">
        <div class="d-grid gap-2">
            <a href="{{ route('welcome') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center min-vh-100">

            @include('parts.errors')

            @if ($success)
                <div class="alert alert-success" role="alert">
                    Unsubscribed successfully :(
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    Something went wrong
                </div>
            @endif

        </div>
    </div>
@endsection
