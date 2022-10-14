@extends('admin.layout.master')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h3><strong>Settings</strong></h3>


            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">

                                        <br>

                                        <div class="card-body">
                                            @include('sweetalert::alert')

                                            <form action="{{ route('setting.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-2">
                                                            <label for="" class="text-dark mb-2 fs-3"><Strong>
                                                                    Name</Strong></label>
                                                            <input type="text" name="name" class="form-control"
                                                                value="{{ $setting->name }}" placeholder="Enter Name">

                                                        </div>
                                                        <div class="form-group mb-2 mt-4">
                                                            <label for="" class="text-dark mb-2 fs-3"><Strong>
                                                                    Logo</Strong></label><br>
                                                            <label style="font-size:40px;cursor: pointer;" for="logoedit"><i
                                                                    class="fa fa-file-image-o mb-2"></i></label>
                                                            <input type="file" name="logo" id="logoedit"
                                                                style="display:none">
                                                            <img style="max-width:50%;display:block" id="logo_edit"
                                                                src="{{ URL::to('/') }}/media/settings/{{ $setting->logo }}"
                                                                alt="">
                                                        </div>
                                                        <div class="form-group mb-2 mt-4">
                                                            <label for="" class="text-dark mb-2 fs-3"><Strong>
                                                                    Icon</Strong></label><br>
                                                            <label style="font-size:40px;cursor: pointer;" for="iconedit"><i
                                                                    class="fa fa-file-image-o mb-2"></i></label>
                                                            <input type="file" name="icon" id="iconedit"
                                                                style="display:none">
                                                            <img style="max-width:30%;display:block"id="icon_edit"
                                                                src="{{ URL::to('/') }}/media/settings/{{ $setting->icon }}"
                                                                alt="">
                                                        </div>
                                                        <div class="form-group mb-2 mt-4">
                                                            <label for="" class="text-dark mb-2 fs-3"><Strong>
                                                                    FavIcon</Strong></label><br>
                                                            <label style="font-size:40px;cursor: pointer;"
                                                                for="faviconedit"><i
                                                                    class="fa fa-file-image-o mb-2"></i></label>
                                                            <input type="file" name="fav_icon" id="faviconedit"
                                                                style="display:none">
                                                            <img style="max-width:30%;display:block"id="favicon_edit"
                                                                src="{{ URL::to('/') }}/media/settings/{{ $setting->fav_icon }}"
                                                                alt="">
                                                        </div>
                                                     

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-2">
                                                            <label for="" class="text-dark mb-2 fs-3"><Strong>
                                                                    Number one</Strong></label>
                                                            <input type="text" name="number1" class="form-control"
                                                                value="{{ $setting->number1 }}" placeholder="Enter Name">

                                                        </div>
                                                        <div class="form-group mb-2 mt-2">
                                                            <label for="" class="text-dark mb-2 fs-3"><Strong>
                                                                    Number two</Strong></label>
                                                            <input type="text" name="number2" class="form-control"
                                                                value="{{ $setting->number2 }}" placeholder="Enter Name">

                                                        </div>
                                                        <div class="form-group mb-2 mt-2">
                                                            <label for="" class="text-dark mb-2 fs-3"><Strong>
                                                                    Email one</Strong></label>
                                                            <input type="email" name="email1" class="form-control"
                                                                value="{{ $setting->email1 }}" placeholder="Enter Name">

                                                        </div>
                                                        <div class="form-group mb-2 mt-2">
                                                            <label for="" class="text-dark mb-2 fs-3"><Strong>
                                                                    Email two</Strong></label>
                                                            <input type="email" name="email2" class="form-control"
                                                                value="{{ $setting->email2 }}" placeholder="Enter Name">

                                                        </div>
                                                        <div class="form-group mb-2 mt-2">
                                                            <label for="" class="text-dark mb-2 fs-3"><Strong>
                                                                    Address</Strong></label><br>

                                                            <textarea  name="address" rows="2" cols="50">{{$setting->address}}</textarea>
                                                         
                                                            
                                                        </div>
                                                        <div class="form-group mb-2 mt-2">
                                                            <label for="" class="text-dark mb-2 fs-3"><Strong>
                                                                    Facebook</Strong></label>
                                                            <input type="text" name="facebook" class="form-control"
                                                                value="{{ $setting->facebook }}" placeholder="Enter Name">

                                                        </div>
                                                        <div class="form-group mb-2 mt-2">
                                                            <label for="" class="text-dark mb-2 fs-3"><Strong>
                                                                    Youtube</Strong></label>
                                                            <input type="text" name="youtube" class="form-control"
                                                                value="{{ $setting->youtube }}" placeholder="Enter Name">

                                                        </div>
                                                        <div class="form-group mb-2 mt-2">
                                                            <label for="" class="text-dark mb-2 fs-3"><Strong>
                                                                    Instagram</Strong></label>
                                                            <input type="text" name="instagram" class="form-control"
                                                                value="{{ $setting->instagram }}" placeholder="Enter Name">

                                                        </div>
                                                        <div class="form-group mb-2 mt-2">
                                                            <label for="" class="text-dark mb-2 fs-3"><Strong>
                                                                    Twitter</Strong></label>
                                                            <input type="text" name="twitter" class="form-control"
                                                                value="{{ $setting->twitter }}" placeholder="Enter Name">

                                                        </div>
                                                    </div>
                                                    </div>
                                                    
                                                   
                                                    <button type="submit" class="btn btn-primary float-end mt-4 pr-4 pl-4"><i class="fa fa-check" aria-hidden="true"></i>Update</button>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
           </div>
        </main>
@endsection
@section('script')
    <script>
        //logo edit
        $(document).on('change', "input#logoedit", function(e) {
            e.preventDefault();
            let image_url = URL.createObjectURL(e.target.files[0]);
            $('img#logo_edit').attr('src', image_url);
        });

        //icon edit
        $(document).on('change', "input#iconedit", function(e) {
            e.preventDefault();
            let image_url = URL.createObjectURL(e.target.files[0]);
            $('img#icon_edit').attr('src', image_url);
        });

        //favicon edit
        $(document).on('change', "input#faviconedit", function(e) {
            e.preventDefault();
            let image_url = URL.createObjectURL(e.target.files[0]);
            $('img#favicon_edit').attr('src', image_url);
        });
    </script>
@endsection
