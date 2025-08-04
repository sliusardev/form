@extends('layouts.site')

@section('content')
    @if(app()->getLocale() === 'uk')
        @includeIf('partials.pages.terms-uk')
    @else
        @includeIf('partials.pages.terms-en')
    @endif
@endsection
