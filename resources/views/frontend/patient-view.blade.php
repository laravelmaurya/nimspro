@extends('frontend.partials.master')
@push('style')

@endpush
@section('content')


@php
$newopd        =$resultdep->new_opd;
$revisitopd    =$resultdep->revisit_opd;
$repaidopd     =$resultdep->repaid_opd;
$newemd        =$resultdep->new_emd;
$revisitemd    =$resultdep->revisit_emd;
$repaidemd     =$resultdep->repaid_emd;
$newspecial    =$resultdep->new_special;
$revisitspecial =$resultdep->revisit_special;
$repaidspecial = $resultdep->repaid_special;    
@endphp

    <center>
    <div class="w-75 h-100 mt-4 mb-4">
        <div class="theme-bg-color text-white fw-bold p-1"><p>{{$title}}</p></div>
            <div class="table-responsive">
                @if(($newopd==0)&&($revisitopd==0)&&($repaidopd==0)&&($newemd==0)&&($revisitemd==0)&&($repaidemd==0)&&($newspecial==0)&&($revisitspecial==0)&&($repaidspecial==0))
              
                <b><font class="text-danger">No Registrations Today.</font></b>
    
                @else
                    <table class="table border border-start border-primary-subtle  data-table  w-100">              
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Count</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class=""><span class="badge text-bg-success my-1 mx-2">New OPD Reg.</span></td>
                                    <td><span class="badge text-bg-success my-1 mx-2">{{ $newopd  ?? 0 }}</span></td>
                                </tr>
                                <tr>
                                    <td ><span class="badge text-bg-success my-1 mx-2">OPD Revisit.</span></td>
                                    <td><span class="badge text-bg-success my-1 mx-2">{{ $revisitopd  ?? 0 }}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="badge text-bg-success my-1 mx-2">OPD Repaid.</span></td>
                                    <td><span class="badge text-bg-success my-1 mx-2">{{ $repaidopd ?? 0 }}</span></td>
                                </tr>
                                <tr>
                                    <td ><span class="badge text-bg-danger my-1 mx-2">New Emergency Reg.</span></td>
                                    <td><span class="badge text-bg-danger my-1 mx-2">{{ $newemd ?? 0 }}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="badge text-bg-danger my-1 mx-2">Emergency Repaid.</span></td>
                                    <td><span class="badge text-bg-danger my-1 mx-2">{{ $revisitemd ?? 0 }}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="badge text-bg-primary my-1 mx-2">New Special Clinic Reg.</span></td>
                                    <td><span class="badge text-bg-primary my-1 mx-2">{{ $repaidemd ?? 0 }}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="badge text-bg-primary my-1 mx-2">Special Clinic Revisit.</span></td>
                                    <td><span class="badge text-bg-primary my-1 mx-2">{{ $newspecial ?? 0 }}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="badge text-bg-primary my-1 mx-2">Special Clinic Repaid.</span></td>
                                    <td><span class="badge text-bg-primary my-1 mx-2">{{ $revisitspecial ?? 0 }}</span></td>
                                </tr>
                                </tbody>
                        </table>
                @endif
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
            $('.dataTables_length').addClass('float-start');
        $('#DataTables_Table_0_info').addClass('float-start');
    });
</script>

@endpush