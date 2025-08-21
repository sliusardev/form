@extends('layouts.site')

@push('meta')
    @php($title = 'TERMS OF SERVICE')
    @section('og_description', 'Terms of Service for our website.')
@endpush

@section('content')
    @if(app()->getLocale() === 'uk')
        @includeIf('partials.pages.terms-uk')
    @else
        @includeIf('partials.pages.terms-en')
    @endif
@endsection
