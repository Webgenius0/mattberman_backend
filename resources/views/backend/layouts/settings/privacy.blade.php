{{-- <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Page</title>
</head>
<body>
    <h1>Create a New Page</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <form action="{{ route('page.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
            @error('title') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="content">HTML Content</label>
            <textarea name="content" id="content" rows="10" required>{{ old('content') }}</textarea>
            @error('content') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <button type="submit">Create Page</button>
    </form>
</body>
</html> --}}



{{-- @extends('backend.app')

<!-- Start:Title -->
@section('title', 'Privacy Policey')
<!-- End:Title -->
@push('style')
    
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}"/>
   
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}"/>
    <style type="text/css">
        /* dropify css  */
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }
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
    <div class="app-content-area">
        <div class="container-fluid">
            <!-- row -->
            <div class="row mt-5">
                <div class="col-12">
                    <!-- card -->
                    <div class="card mb-4 mx-5">
                        <!-- card body -->
                        <div class="card-body">
                            <form action="{{ route('admin.privacystore') }}" class="" novalidate method="POST">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="col-md-4 " for="title">Title</label>
                                            <input class="col-md-12 " type="text" name="title" id="title" value="{{  old('title') }}" required >
                                            @error('title') <p style="color: red;">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="body">Body</label>
                                            <textarea name="body" id="body" rows="10" required>{{  old('body') }}</textarea>
                                            @error('body') <p style="color: red;">{{ $message }}</p> @enderror
                                        </div>
                                        <input type="hidden" name='status' value="1">
                                    </div>
                                    <button type="submit"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- Start:Script -->
@push('script')
  
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/js/form-validation.js') }}"></script>
   
    <script src="{{ asset('https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js') }}"></script>
    <script>
        //initialized dropify
        $(document).ready(function () {
            $('.dropify').dropify();
        });
        //initialized editor
        ClassicEditor
            .create(document.querySelector('#body'), {
                removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle',
                    'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                ],
            })
            .catch(error => {
                console.error(error);
            });

          
        
        //module item remove function
        function removeModuleItem(itemmoduleIndex) {
            const itemToRemove = document.getElementById(`accordionItem_${itemmoduleIndex}`);
            if (itemToRemove) {
                itemToRemove.remove();
            }
        }
    </Script>
     
@endpush
--}}


@extends('backend.app')

@section('title','Dashboard')

@push('style')
    
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}"/>
   
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}"/>
    <style type="text/css">
        /* dropify css  */
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }
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
    <div class="row mt-5">
        <div class="col-12">
            <!-- card -->
            <div class="card mb-4 mx-5">
                <!-- card body -->
                <div class="card-body">
                    <form action="{{ route('admin.privacystore') }}" class="" novalidate method="POST">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="col-md-4 " for="title">Title</label>
                                    <input class="col-md-12 " type="text" name="title" id="title" value="{{ $page ? $page->title : old('title') }}" >
                                    @error('title') <p style="color: red;">{{ $message }}</p> @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="body">Body</label>
                                    <textarea name="body" id="body" rows="10" required>{{ $page ? $page->body : old('body') }}</textarea>
                                    @error('body') <p style="color: red;">{{ $message }}</p> @enderror
                                </div>
                                <input type="hidden" name='status' value="1">
                            </div>
                            <button type="submit">Privacy Policy</button>
                        </div>
                    </form>
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

  
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js') }}"></script>
<script src="{{ asset('backend/js/form-validation.js') }}"></script>

<script src="{{ asset('https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js') }}"></script>
<script>
    //initialized dropify
    $(document).ready(function () {
        $('.dropify').dropify();
    });
    //initialized editor
    ClassicEditor
        .create(document.querySelector('#body'), {
            removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle',
                'ImageToolbar', 'ImageUpload', 'MediaEmbed'
            ],
        })
        .catch(error => {
            console.error(error);
        });

      
    
    //module item remove function
    function removeModuleItem(itemmoduleIndex) {
        const itemToRemove = document.getElementById(`accordionItem_${itemmoduleIndex}`);
        if (itemToRemove) {
            itemToRemove.remove();
        }
    }
</Script>
@endpush
<!-- End:Script -->
