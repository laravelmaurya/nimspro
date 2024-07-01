<!-- resources/views/tenders/partials/tender_table.blade.php -->

<table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th class="th-serial-no">ID</th>
        <th class="th-status">
        <th>Title</th>
        <th>Number</th>
        <th class="th-publishes-on">Published On</th>
        <th class="th-start-date">Start Date</th>
        <th class="th-end-date">End Date</th>
        <th class="th-action">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tenders as $tender)
      <tr>
        <td>{{ $tender->nims_wp_tender_id }}</td>
        <td>
          <input data-id="{{$tender->nims_wp_tender_id}}" class="toggle-class" type="checkbox" data-onstyle="success"
           data-offstyle="danger" data-toggle="toggle" data-size="xs" data-on="Active"
           data-off="InActive" {{ $tender->status ? 'checked' : '' }}>
        </td>
        <td>{{ $tender->nims_wp_tender_title }}</td>
        <td>{{ $tender->nims_wp_tender_number }}</td>
        <td>{{ $tender->nims_wp_tender_submit_date }}</td>
        <td>{{ $tender->nims_wp_tender_start_date }}</td>
        <td>{{ $tender->nims_wp_tender_end_date }}</td>
        <td>
          <a href="{{route('tenders.edit', $tender->nims_wp_tender_id)}}"><i class="fas fa-edit"></i></a>
           {{-- <form method="GET" action="{{route('tenders.show', $tender)}}">
               @csrf
               <button class="btn btn-sm bg-warning"><i class="fas fa-eye"></i></button>
           </form>
           <a href="{{route('tenders.destroy', $tender->id)}}" class="delete-confirm">
             <i class="text-danger fas fa-trash"></i>
           </a>  --}}
           <!-- <form method="POST" action="{{route('tenders.destroy', $tender)}}">
               @method('delete')
               @csrf
               <button class="btn btn-sm bg-danger"><i class="fas fa-trash"></i></button>
           </form> -->
            
           </td>
      </tr>
      @endforeach
    </tbody>
  </table>
