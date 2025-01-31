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

                    <form action="{{route('admin.adds.store')}}" class="" novalidate method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="container">

                            <div class="row">

                                

                                <div class="col-md-12 mb-3">

                                    <label for="photo">Advertisement Photo</label>

                                    <input type="file" name='photo' id='photo' class=" col-md-12 " 

                                    />

                                    @error('photo') <p style="color: red;">{{ $message }}</p> @enderror

                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="detaile">Urls</label>
                                    <input type="text" name="url" class=" col-md-12 " />
                                    @error('detaile') <p style="color: red;">{{ $message }}</p> @enderror
                                </div>

                            </div>

                            <button type="submit">Add</button>

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