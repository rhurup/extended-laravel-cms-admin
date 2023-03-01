@extends('index')

@section('title', $content->title)
@section('content')
 {!! $content->content !!}
@endsection
@push('css')
    <style>

    </style>
@endpush
@push('scripts')
    <script type="application/javascript">
    </script>
@endpush
