<!-- resources/views/tenders/partials/tender_table.blade.php -->
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th><a href="#" class="sort" data-sort="nims_wp_tender_id">ID</a></th>
      <th><a href="#" class="sort" data-sort="nims_wp_tender_title">Title</a></th>
      <th><a href="#" class="sort" data-sort="nims_wp_tender_number">Number</a></th>
      <th><a href="#" class="sort" data-sort="nims_wp_tender_start_date">Start Date</a></th>
      <th><a href="#" class="sort" data-sort="nims_wp_tender_end_date">End Date</a></th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($tenders as $tender)
    <tr>
      <td>{{ $tender->nims_wp_tender_id }}</td>
      <td>{{ Str::limit($tender->nims_wp_tender_title, 50) }}</td>
      <td>{{ Str::limit($tender->nims_wp_tender_number, 50) }}</td>
      <td>{{ $tender->nims_wp_tender_start_date }}</td>
      <td>{{ $tender->nims_wp_tender_end_date }}</td>
      <td>
        <a href="{{ route('tenders.edit', $tender->nims_wp_tender_id) }}" class="btn btn-sm btn-primary">Edit</a>
        <a href="{{ route('tenders.show', $tender->nims_wp_tender_id) }}" class="btn btn-sm btn-info">Show</a>
        <form action="{{ route('tenders.destroy', $tender->nims_wp_tender_id) }}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
        {{-- <form action="{{ route('tenders.status', $tender->nims_wp_tender_id) }}" method="POST" style="display:inline;">
          @csrf
          @method('PATCH')
          <button type="submit" class="btn btn-sm {{ $tender->nims_wp_tender_state == 1 ? 'btn-warning' : 'btn-success' }}">
            {{ $tender->nims_wp_tender_state == 1 ? 'Deactivate' : 'Activate' }}
          </button>
        </form> --}}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
