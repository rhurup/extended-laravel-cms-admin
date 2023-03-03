@extends('layout.app')

@section('title', \Illuminate\Support\Facades\Auth::user()->name)
@section('content')
    <div class="row">
        <div class="col-12">
            <h3>{{__("Welcome")}} {{ Auth::user()->name }}</h3>
        </div>
    </div>
@endsection
@push('css')
    <style>

    </style>
@endpush
@push('scripts')
    <script type="application/javascript">
    </script>
@endpush
