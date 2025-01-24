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
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i data-feather="home"></i></a></li>
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
                {{-- <h4>All Advertisement</h4> --}}
                <div class="text-end d-flex mx-3 justify-content-between align-items-center mb-4">
                  <h4>All Advertisement</h4>
                  <a href="{{route('admin.adds.create')}}" class="btn btn-primary mb-3">Create Advertisement</a>
                 
              </div>
              </div>
            </div>
            {{-- <p class="mb-0">Body contants.</p> --}}
            <div class="container mt-5">
                <table id="data-table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            {{-- <th>Status</th> --}}
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
            ajax: '{{ route('show.all.advertisement') }}',
            columns: [
                { data: 'image', name: 'photo' },
                // { data: 'email', name: 'email' },
                { data: 'action', name: 'action',  }
            ]
        });
    });

</script>
{{-- <script>
    function showDeleteConfirm(id) {
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    deleteItem(id);
                }
            });
        };

        function deleteItem(id) {
    // Generate the URL dynamically using the route() helper in Blade
    var url = '{{ route('advertisement.destroy', ':id') }}'.replace(':id', id);

      $.ajax({
          type: "DELETE",
          url: url,
          data: {
              _token: '{{ csrf_token() }}'
          },
                success: function(resp) {
                    // Reload the DataTable
                    $('#data-table').DataTable().ajax.reload();

                    if (resp.success === true) {
                        // Show success toast message
                        toastr.success(resp.message);
                    } else if (resp.errors) {
                        toastr.error(resp.errors[0]);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    toastr.error('Something went wrong. Please try again.');
                }
            });
        }

</script> --}}
@endpush