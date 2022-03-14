{{-- Layout extend --}}
@extends('layouts.master')

{{-- page title --}}
@section('title', 'Fancy phases | ' . $title)

{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" href="<?php echo asset('css/visualise.css')?>" type="text/css">
@endsection

@section('page-script')
    <script src="{{asset('js/app.js')}}"></script>

    <script>
        const MAGIC_ID = '{!! $id !!}';
        const visualise = new app.Visualise({!! $phrases->toJson() !!});
    </script>
@endsection

{{-- page content --}}
@section('content')
    <!-- Sidebar -->
    <div class="side">
        <div class="d-grid gap-2">
            <a href="{{ route('welcome') }}" class="btn btn-secondary">Back</a>

            <button type="button" class="btn btn-primary" id="addPhrase" data-bs-toggle="modal"
                    data-bs-target="#addPhraseModal">Add a new fancy phrase
            </button>
        </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="addPhraseModal" tabindex="-1" aria-labelledby="addPhraseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPhraseModalLabel">Add a new fancy phrase</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="#" class="my-3">
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="alert alert-danger collapse" id="phraseError" role="alert">
                                Phrase is required!
                            </div>

                            <label for="phrase" class="form-label">Phrase</label>
                            <input type="text" name="phrase" id="phrase" class="form-control">

                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submitPhrase">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewPhraseModal" tabindex="-1" aria-labelledby="viewPhraseModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewPhraseModalLabel"></h5>
                </div>

                <form action="#" class="my-3">
                    <div class="modal-body">
                        <div class="mb-3" id="viewPhraseModalBody"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="phraseDelete" data-id="">Delete</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toasts -->

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div id="deleteToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Deleted</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Phrase was deleted
            </div>
        </div>
    </div>

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div id="addedToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Added</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Phrase was added
            </div>
        </div>
    </div>
@endsection
