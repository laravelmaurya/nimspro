@extends('frontend.partials.master')

@section('content')

<div class="d-flex justify-content-center">
    <div class="w-75 h-100 mt-4 mb-4 border shadow">
        <div class="theme-bg-color text-white fw-bold p-1 text-center">
            <p>{{$title}}</p>
        </div>
        <div class="d-flex justify-content-center mx-5">
            {{-- <h5>MCI-Affiliated Broad Speciality(MD/MS) Courses as on {{ date('d.m.Y') }}</h5> --}}
            <h5>MCI-Affiliated Broad Speciality(MD/MS) Courses as on 17.10.2016</h5>
        </div>
        <form method="post">
            <div class="d-flex justify-content-center">
                <table class="table table-bordered border-primary-subtle  w-75">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>No. of Seats</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                           $i=1; 
                        @endphp 
                        @foreach($courses as $course)
                
                        <tr>
                            <td>{{ $course->course_name }} ({{ $course->department_name }})</td>
                            <td>{{ $course->no_of_seats }}</td>
                        </tr>
                        @php
                            $i++; 
                        @endphp
                       
                        @endforeach
                        <tr>
                            <td><b>TOTAL</b></td>
                            <td><b>{{ $total_seats }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

@php 
$addPublic = config('app.url').'public/frontend';
@endphp

@endsection

@push('scripts')


<script>
        $(document).ready(function () {
            $('.dataTables_length').addClass('float-start');
        $('#DataTables_Table_0_info').addClass('float-start');
    });
</script>

@endpush