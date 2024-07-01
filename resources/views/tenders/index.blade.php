<!-- resources/views/tenders/index.blade.php -->
@extends('partials.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tenders</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Tenders</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          
          <div class="card-header">
            <h3 class="card-title">Tenders</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" id="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="card-body  table-responsive">
            <div id="tender-table">
              {{-- @include('tenders.partials.tender_table', ['tenders' => $tenders]) --}}
              @include('tenders.tender_table', ['tenders' => $tenders])
            </div>
          </div>
          <div class="card-footer  table-responsive">
            <div id="pagination-links">
              {{ $tenders->links() }}
            </div>
          </div>

        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@push('scripts')

@endpush
