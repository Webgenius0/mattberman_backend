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
            {{-- <p class="mb-0">Body contants.</p> --}}
            <div class="container mt-5">
                <table id="data-table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('show.all.drivers') }}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'action', name: 'action',  }
            ]
        });
    });
   
</script>

{{-- <script>
     function showDriverData(email) {
            event.preventDefault();
            swal({
                title: `Are you sure?`,
                text: "You want to show .",
                buttons: true,
                infoMode: true,
            }).then((willStatusChange) => {
                if (willStatusChange) {
                    driverInspections(email);
                }
            });
        };

        // Status Change
        function driverInspections(id) {
            var url = '{{ route('inspection.details', ':email') }}';
            $.ajax({
                type: "GET",
                url: url.replace(':email', email),
                success: function(resp) {
                    // Reloade DataTable
                    $('#data-table').DataTable().ajax.reload();
                    if (resp.success === true) {
                        // show toast message
                        toastr.success(resp.message);
                    } else if (resp.errors) {
                        toastr.error(resp.errors[0]);
                    } else {
                        toastr.error(resp.message);
                    }
                }, 
                error: function(error) {
                    // location.reload();
                } // Error
            })
        }
</script> --}}

    
@endpush