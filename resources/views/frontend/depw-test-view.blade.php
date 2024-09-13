@extends('frontend.partials.master')

@section('content')

<center>
    {{-- {{dd('aaaaaaaaa')}} --}}
    <div class="w-75 h-100 mt-4 mb-4">
    <div class="theme-bg-color text-white fw-bold p-1"><p>{{$title}}</p></div>
   
    <form id="depw-test-view2" action="{{ route('depw-test-view.page') }}" method="POST">                                                      
      @csrf  
        <select id="department" name="department">
            <option selected>Select A Department</option>
            @foreach($departments as $department)
            <?php $dept_code = (int)$department->gnum_dept_code ?>
            <option value="{{ $dept_code }}">{{ $department->gstr_dept_name }}</option>
            @endforeach
          </select>   
          <input type="number"  id="depart_id" name="depart_id" />    
    </form>
      
        <div class="table-responsive mt-1">
        <table class="table border border-start border-primary-subtle  data-table  w-100">
            <thead>
            <tr>               
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
    var base_url = "<?php echo url('')  ?>";
    // var base_url = urlPublic + 'public/';
  </script>
<script>
    $(document).ready(function () {
       window.table = $('.data-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: "{{ route('depw-test-view.page') }}",
            columns: [
                    { data: 'lab_name', name: 'lab_name' },                   
                    { data: 'test_name', name: 'test_name' },
                    { data: 'gnum_user_test_code', name: 'gnum_user_test_code' }
             ]
            // order: [[1, 'desc']] // Initial sorting on the Title column
        });
     
    });

 
</script>
<script>
        $(document).ready(function () {
            $('.dataTables_length').addClass('float-start');
        $('#DataTables_Table_0_info').addClass('float-start');

      
        
        $(document).on('change', '#department', function () {
             var department = Number($("#department").val());
             department = $("#depart_id").val(typeof department);
             alert( department);
      
            document.getElementById('depw-test-view2').submit();
        });

        // $(document).on('change', '#department', function () {
        //     // e.preventDefault(); 
        //     var department = Number($("#department").val());
        //      alert(typeof department);
        //      var depart_id = $("#depart_id").val(department);
        //     var url = "<?php echo route('depw-test-view.page')?>";
        //     alert(url);
        //     $.ajax({
        //         url: url, // Your backend endpoint to handle removal
        //         type: 'POST',
        //         data: {department:department,depart_id:department},
        //         success: function(response) {
        //         // const myJSON1 = JSON.stringify(response);
        //         // console.log('response ='+myJSON1);
        //         alert( response );
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('An error occurred while removing the attachment: ' + error);
        //         }
        //     });
        // });
    });
</script>
@endpush