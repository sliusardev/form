@extends('layouts.site')

@section('content')
    @if(app()->getLocale() === 'uk')
        @includeIf('partials.pages.privacy-uk')
    @else
        @includeIf('partials.pages.privacy-en')
    @endif
@endsection
