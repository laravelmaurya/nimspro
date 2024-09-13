@extends('frontend.partials.master')

@section('content')


    <div class="container h-auto mt-4 mb-4" style="width:62%">
        <center>
        <nav>          
            <div id="tabsData" class="nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">@if(!empty($title)){{{$title}}}@endif</button>
              @if(!empty($columnTabs2)){
              <button class="nav-link" id="nav-two-tab" data-bs-toggle="tab" data-bs-target="#nav-two" type="button" role="tab" aria-controls="nav-two" aria-selected="false">@if(!empty($title2)){{{$title2}}}@endif</button>
              }
              @endif
              @if(!empty($columnTabs2)){
              <button class="nav-link" id="nav-tree-tab" data-bs-toggle="tab" data-bs-target="#nav-tree" type="button" role="tab" aria-controls="nav-tree" aria-selected="false">@if(!empty($title3)){{{$title3}}}@endif</button>              
              }
              @endif
              @if(!empty($columnTabs2)){
              <button class="nav-link" id="nav-four-tab" data-bs-toggle="tab" data-bs-target="#nav-four" type="button" role="tab" aria-controls="nav-four" aria-selected="false">@if(!empty($title4)){{{$title4}}}@endif</button>              
              }
              @endif
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                <textarea rows="10" name="description" id="" class="ckeditor_frontend @error('description') is-invalid @enderror">@if(!empty($columnTabs)){{{$columnTabs}}}@endif</textarea>
            </div>
            @if(!empty($columnTabs2)){
            <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab" tabindex="0">
                <textarea rows="10" name="description" id="" class="ckeditor_frontend @error('description') is-invalid @enderror">@if(!empty($columnTabs2)){{{$columnTabs2}}}@endif</textarea>
            </div>
            }
            @endif
            @if(!empty($columnTabs3)){
            <div class="tab-pane fade" id="nav-tree" role="tabpanel" aria-labelledby="nav-tree-tab" tabindex="0">
                <textarea rows="10" name="description" id="" class="ckeditor_frontend @error('description') is-invalid @enderror">@if(!empty($columnTabs3)){{{$columnTabs3}}}@endif</textarea>
            </div> 
            }
            @endif 
            @if(!empty($columnTabs4)){          
            <div class="tab-pane fade" id="nav-four" role="tabpanel" aria-labelledby="nav-four-tab" tabindex="0">
                <textarea rows="10" name="description" id="" class="ckeditor_frontend @error('description') is-invalid @enderror">@if(!empty($columnTabs4)){{{$columnTabs4}}}@endif</textarea>
            </div>
            }
            @endif             
          </div>
        </center>
    </div>


@php 
$addPublic = config('app.url').'public/frontend';
@endphp

@endsection

@push('scripts')