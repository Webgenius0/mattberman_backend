@extends('backend.app')

@section('title','Dashboard')

@section('content')
<div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item"> Apps</li>
            <li class="breadcrumb-item active">DocuDriver</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid jkanban-container">
    <div class="row">
      <div class="col-12">
        <div class="card custom-board">
          <div class="card-header pb-0">
            <div class="d-flex"> 
              <div class="flex-grow-1"> 
                <h4>Drivers</h4>
              </div>
            </div>
            <div class="container mt-5">
                <table id="data-table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Carrier</th>
                            <th>Address</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Tractor Category</th>
                            <th>Tractor No</th>
                            <th>Odometer Reading</th>
                            <th>Trailer Category</th>
                            <th>Trailer No</th>
                            <th>Remark</th>
                            <th>Get PDF
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($allInspections as $inspection)
                      <tr>
                        <td>{{$driverName->name}}</td>
                        <td>{{$inspection->carrier}}</td>
                        <td>{{$inspection->address}}</td>
                        <td>{{$inspection->date}}</td>
                        <td>{{$inspection->start_time}}</td>
                        <td>{{$inspection->end_time}}</td>
                        <td>{{$inspection->tractor_category}}</td>
                        <td>{{$inspection->truck_no}}</td>
                        <td>{{$inspection->odometer_reading}}</td>
                        <td>{{$inspection->trailer_category}}</td>
                        <td>{{$inspection->trailer_no}}</td>
                        <td>{{$inspection->remark}}</td>
                        <td>
                          <a href="{{route('pdfInspection.web', ['id'=> $inspection->id])}}" class="btn btn-sm btn-primary"><i class="">Download</i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
          </div>
          <div class="card-body pb-0">                   
            <div id="demo2"></div>
          </div>
        </div>
      </div>
     
    </div>
  </div>
    <script class="result-template" type="text/x-handlebars-template">
      <div class="ProfileCard u-cf">
      <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
      <div class="ProfileCard-details">
      </div>
      </div>
    </script>
    <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your Docu Driver!</div></script>
@endsection

@push('script')

@endpush