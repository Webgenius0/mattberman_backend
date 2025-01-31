@extends('backend.app')

@section('title','Dashboard')

@push('style')
    
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}"/>
    <style type="text/css">
        /* editor css  */
        .ck-editor__editable[role="textbox"] {
            min-height: 150px;
        }

        .select2-results { background-color: #000; }

        .select2-search input { background-color: #0000; }

       .select2-search { background-color: #0000; }

    </style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid jkanban-container">
    <div class="row mt-5">
        <div class="col-12">
            <!-- card -->
            <div class="card mb-4 mx-5">
                <!-- card body -->
                <div class="card-body">
                    <form action="{{ route('admin.update.profile') }}" class="" novalidate method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="col-md-4 " for="name">Name</label>
                                    <input class="col-md-12 " type="text" name="name" id="name" value="{{ $admin ? $admin->name : 'Unknown' }}" >
                                    @error('name') <p style="color: red;">{{ $message }}</p> @enderror
                                </div>
                                {{-- <div class="col-md-12 mb-3">
                                    <label for="phone">Phone</label>
                                    <textarea name="phone" id="phone" rows="10" required>{{ $page ? $page->body : 'set phone number' }}</textarea>
                                    @error('phone') <p style="color: red;">{{ $message }}</p> @enderror
                                </div> --}}
                                {{-- <div class="col-md-12 mb-3">
                                    <label for="body">Bio</label>
                                    <textarea name="body" id="body" rows="10" required>{{ $page ? $page->body : old('body') }}</textarea>
                                    @error('body') <p style="color: red;">{{ $message }}</p> @enderror
                                </div> --}}
                                <div class="col-md-12 mb-3">
                                    <label for="photo">Profile Photo</label>
                                    {{-- <textarea name="photo" id="photo" rows="10" required>{{ $admin ? $admin->body : 'set profile photo' }}</textarea> --}}
                                    <input type="file" name='photo' id='photo' class=" col-md-12 " 
                                    data-default-file="{{ $admin ? asset('upload/' . $admin->image) : '' }}"
                                    />
                                    @error('photo') <p style="color: red;">{{ $message }}</p> @enderror
                                    <img src="{{asset('upload/'.$admin->image)}}" alt="photo" width="200px" height="auto"/>
                                </div>
                            </div>
                            <button type="submit">Update profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection

@push('script')
<script src="{{ asset('backend/js/form-validation.js') }}"></script>

<script src="{{ asset('https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.dropify').dropify();
    });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#body'), {
            removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle',
                'ImageToolbar', 'ImageUpload', 'MediaEmbed'
            ],
        })
        .catch(error => {
            console.error(error);
        });
</Script>
@endpush