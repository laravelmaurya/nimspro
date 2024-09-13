@extends('frontend.partials.master')

@section('content')

<center>
    <div class="w-75 h-100 mt-4 mb-4">
            <div class="theme-bg-color text-white fw-bold p-2"><p>{{$title}}</p></div>
            <textarea rows="10" name="description" id="" class="ckeditor_frontend @error('description') is-invalid @enderror">{{$column}}</textarea>
    </div>
    
</center>

@php 
$addPublic = config('app.url').'public/frontend';
@endphp

@endsection

@push('scripts')