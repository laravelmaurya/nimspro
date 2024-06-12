@extends('partials.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Home') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @role('admin')
                        {{ __('You are admin') }}                       
                    @endrole
                    @role('user')
                   
                        {{ __('You are user') }}
                       
                    @endrole

                    @can('create-user')
                    {{ __('You are create-user') }}    
                    @endcan
                   
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
