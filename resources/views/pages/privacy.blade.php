@extends('layouts.site')

@push('meta')
    @php($title = 'PRIVACY POLICY')
    @section('og_description', 'Privacy Policy for our website.')
@endpush

@section('content')
    @if(app()->getLocale() === 'uk')
        @includeIf('partials.pages.privacy-uk')
    @else
        @includeIf('partials.pages.privacy-en')
    @endif
@endsection
