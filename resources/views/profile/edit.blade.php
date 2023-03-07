@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layout.app')

@section('title', Auth::user()->name)
@section('content')
    <div class="row">
        <div class="col-12">

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
