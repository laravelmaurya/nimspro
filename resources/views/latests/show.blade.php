@extends('partials.master')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tender Show</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tender Show</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tender Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th>Name</th>
                      <td>{{$tender->name}}</td>
                      <th>Email</th>
                      <td>{{$tender->email}}</td>
                    </tr>
                    <tr>
                      <th>Roles</th>
                      <td>
                      @foreach($tender->roles as $role)
                          <h4 class="d-inline"><span class="badge bg-info">{{ $role->name }}</span></h4>                        
                      @endforeach 
                      </td>                    
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
@endsection