@extends('frontend.partials.master')

@section('content')

@php 
$addPublic = config('app.url').'public/frontend';
@endphp

@endsection

@push('scripts')