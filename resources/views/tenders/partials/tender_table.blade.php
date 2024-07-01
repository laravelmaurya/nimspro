<!-- resources/views/tenders/partials/tender_table.blade.php -->
<table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Number</th>
        <th>Description</th>
        <th>Start Date</th>
        <th>End Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tenders as $tender)
      <tr>
        <td>{{ $tender->tender_id }}</td>
        <td>{{ $tender->nims_wp_tender_title }}</td>
        <td>{{ $tender->nims_wp_tender_number }}</td>
        <td>{{ $tender->nims_wp_tender_description }}</td>
        <td>{{ $tender->nims_wp_tender_start_date }}</td>
        <td>{{ $tender->nims_wp_tender_end_date }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>