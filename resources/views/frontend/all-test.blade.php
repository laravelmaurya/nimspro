@extends('frontend.partials.master')

@section('content')

<center>
    <div class="w-75 h-100 mt-4 mb-4">
    <div class="theme-bg-color text-white fw-bold p-1"><p>{{$title}}</p></div>
        <div class="table-responsive mt-1">
        <table class="table border border-start border-primary-subtle  data-table  w-100">
            <thead>
            <tr>
                <th class="th-serial-no">No</th>
                <th>Department Name</th>
                <th>Laboratory Name</th>
                <th>Test Name</th>
                <th>Test Code</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </div>
    </div>
</center>

@php 
$addPublic = config('app.url').'public/frontend';
@endphp

@endsection

@push('scripts')

<script>
    $(document).ready(function () {
       window.table = $('.data-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: "{{ route('all-tests.page') }}",
            columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'dept_name', name: 'dept_name' },
        { data: 'lab_name', name: 'lab_name' },
        { data: 'test_name', name: 'test_name' },
        { data: 'test_code', name: 'test_code' },
    ]
            // order: [[1, 'desc']] // Initial sorting on the Title column
        });
     
    });

 
</script>
<script>
        $(document).ready(function () {
            $('.dataTables_length').addClass('float-start');
        $('#DataTables_Table_0_info').addClass('float-start');
    });
</script>

@endpush