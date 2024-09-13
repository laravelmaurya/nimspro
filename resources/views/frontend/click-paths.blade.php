@extends('frontend.partials.master')

@section('content')

<div class="d-flex justify-content-center">
    <div class="w-75 h-100 mt-4 mb-4 border shadow">
        <div class="theme-bg-color text-white fw-bold p-1 text-center">
            <p>{{$title}}</p>
        </div>
        <div class="p-3">
            <p class="text-wrap"><a class="fw-bolder text-decoration-none float-start m-1" href="javascript:void(0)" download="" onclick="downloadImageByPath('/public/frontend/click-paths/1.pdf','clickpath_1.pdf')">1. Click Path for Teleconsultation-Mobile App.</a><br></p>
            <p class="text-wrap"><a class="fw-bolder text-decoration-none float-start m-1" href="javascript:void(0)" download="" onclick="downloadImageByPath('/public/frontend/click-paths/2.pdf','clickpath_2.pdf')">2. Click Path for Teleconsultation Appointment over phone (Enquiry counter).</a><br></p>
            <p class="text-wrap"><a class="fw-bolder text-decoration-none float-start m-1" href="javascript:void(0)" download="" onclick="downloadImageByPath('/public/frontend/click-paths/3.pdf','clickpath_3.pdf')">3. Click Path for Doctor Appointment - Teleconsultation over Webportal (Patients).</a></p>
        </div>
    </div>
</div>


@php 
$addPublic = config('app.url').'public/frontend';
@endphp

@endsection

@push('scripts')