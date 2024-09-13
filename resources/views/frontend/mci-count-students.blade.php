@extends('frontend.partials.master')

@section('content')

<div class="d-flex justify-content-center">
    <div class="col-lg-10 col-md-12 w-100">
        <div class="h-100 mt-4 mb-4 border shadow">
            <!-- Title Section -->
            <div class="theme-bg-color text-white fw-bold p-2 text-center">
                <p class="mb-0">{{$title}}</p>
            </div>
            <!-- Form Section -->
            <form method="post">
                <div class="p-3">
                    <!-- Responsive Table Wrapper -->
                    <div class="table-responsive">
                        <table class="table table-bordered border-primary-subtle mt-4">
                            <tr>
                                <td><b>State Name:</b></td>
                                <td><b>College Name:</b></td>
                                <td>NIMS</td>
                                <td><b>Type (Govt./Pvt.):</b></td>
                                <td>Govt.</td>
                            </tr>
                            <tr>
                                <td>Telangana State</td>
                                <td><b>Type:</b></td>
                                <td></td>
                                <td><b>Course Type:</b></td>
                                <td>
                                    @foreach ($courseTypes as $courseType)
                                        {{ $courseType->coursetype }} -- {{ $courseType->student_count }}<br>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td><b>Course Name:</b></td>
                                <td>
                                    @foreach ($courseNames as $courseName)
                                        {{ $courseName->departmentname }} -- {{ $courseName->student_count }}<br>
                                    @endforeach
                                </td>
                                <td><b>Academic Year:</b></td>
                                <td>{{ $currentYear }}</td>
                                <td><b>Gender:</b><br>(Male/Female)</td>
                            </tr>
                            <tr>
                                <td><b>Category:</b><br>(Government)<br>(Management)<br>(NRI)<br>(Merit)</td>
                                <td>Govt.</td>
                                <td>
                                    <b>Sub Category:</b><br>
                                    (General) -- {{ $subCategories['general'] }}<br>
                                    (SC) -- {{ $subCategories['sc'] }}<br>
                                    (ST) -- {{ $subCategories['st'] }}<br>
                                    (OBC) -- {{ $subCategories['obc'] }}<br>
                                    (Others) -- {{ $subCategories['others'] }}
                                </td>
                                <td>
                                    <b>Physically Handicapped:</b><br>
                                    (Yes) -- {{ $phcCount['yes'] }}<br>
                                    (No) -- {{ $phcCount['no'] }}
                                </td>
                                <td>
                                    M -- {{ $genderCount['M'] }}<br>
                                    F -- {{ $genderCount['F'] }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
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