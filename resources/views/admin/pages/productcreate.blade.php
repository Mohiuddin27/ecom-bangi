@extends('admin.layout.master')
@section('content')
    <style>
        label {
            font-weight: 700;
        }
        .show_image{
            flex-wrap: wrap!important;
            max-width: 100%!important;
        }
       
    </style>
    <main class="content">
        <div class="container-fluid p-0">
            <h3><Strong>Product</strong></h3>

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Add New Product</h4>
                                            <div></div>
                                            <div>
                                                <a href="{{ route('product.index') }}"
                                                    class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus-circle"
                                                        aria-hidden="true"></i> All Product's</a>
                                            </div>
                                        </div>
                                        <br>


                                        <form action="{{ route('product.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="" class="mb-2">Product name</label>
                                                        <input name="name" class="form-control" id="name"
                                                            type="text" @error('name') is-invalid @enderror"
                                                            placeholder="Name">
                                                        @error('name')
                                                            <div class="text-danger">* {{ $message }}</div>
                                                        @enderror
                                                    </div>


                                                    <div class="form-group mt-2">
                                                        <label for="" class="mb-2">Price</label>
                                                        <input name="price" class="form-control" id="regular_price"
                                                            @error('price') is-invalid @enderror" type="number"
                                                            placeholder="Price">
                                                        @error('price')
                                                            <div class="text-danger">* {{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mt-2">
                                                        <label for="" class="mb-2">Discount</label>
                                                        <input name="discount" class="form-control"
                                                            id="discount" type="number" placeholder="Discount">

                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="" class="mb-2">Stock</label>
                                                        <input name="stock" class="form-control" id="quantity"
                                                            type="number" @error('quantity') is-invalid @enderror"
                                                            placeholder="Stock">
                                                        @error('stock')
                                                            <div class="text-danger">* {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="" class="mb-2">Product Short
                                                            Description</label><br>
                                                        <textarea id="short_description" row="3" cols="52" @error('short_description') is-invalid @enderror"
                                                            name="short_description"></textarea>
                                                        @error('short_description')
                                                            <div class="text-danger">* {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mt-2">
                                                        <label for="" class="mb-2">Color</label>

                                                        <select name="color_id[]" class="form-control"
                                                            @error('short_description') is-invalid @enderror" id="color"
                                                            multiple>
                                                            <option value="">Select Color</option>
                                                            @foreach ($colors as $color)
                                                                <option value="{{ $color->id }}"> {{ $color->name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                        @error('color_id')
                                                            <div class="text-danger">* {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="mb-2">Size</label>

                                                        <select name="size_id[]" class="form-control"
                                                            @error('short_description') is-invalid @enderror" id="size"
                                                            multiple>
                                                            <option>Select Size</option>
                                                            @foreach ($sizes as $size)
                                                                <option value="{{ $size->id }}"> {{ $size->name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                        @error('size_id')
                                                            <div class="text-danger">* {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="" class="mb-2">Category</label>

                                                        <select name="category_id" class="form-control category"
                                                            @error('category_id') is-invalid @enderror" id="category_id">
                                                            <option value="">Select Category</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"> {{ $category->name }}
                                                                </option>
                                                            @endforeach


                                                        </select>
                                                        @error('category_id')
                                                            <div class="text-danger">* {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="" class="mb-2">SubCategory</label>

                                                        <select name="subcategory_id" class="form-control subcategory"
                                                            id="subcategory_id">

                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mt-2">
                                                        <label for="" class="mb-2">Product Description</label>
                                                        <textarea id="description" @error('description') is-invalid @enderror" name="description"></textarea>
                                                        @error('description')
                                                            <div class="text-danger">* {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <div>
                                                            Product Image's
                                                        </div>
                                                        <label style="font-size:70px;cursor: pointer;" for="images"><i
                                                                class="fa fa-file-image-o mb-2"></i></label>
                                                        <input type="file" name="image[]" id="images"
                                                            style="display:none" multiple>
                                                        <div class="show_image row mt-3">

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="float-end">
                                                <button type="submit" class="btn btn-primary float-end mt-4 pr-4 pl-4"><i
                                                        class="fa fa-check" aria-hidden="true"></i> Save</button>

                                            </div>


                                        </form>

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
        $(document).ready(function() {
            $('#color').select2();
        });
        $(document).ready(function() {
            $('#size').select2();
        });
        CKEDITOR.replace('description');

        //category change
        $(document).on('change', '.category', function() {
            let cat_id = $(this).val();
            $('.subcategory').html('');
            $.ajax({
                type: 'get',
                url: 'findsubcategory',
                data: {
                    'id': cat_id
                },
                dataType: 'json', //return data will be json
                success: function(data) {
                    $('.subcategory').html('<option value="">Select SubCategory</option>');
                    for (let i = 0; i < data.length; i++) {
                        $('.subcategory').append('<option value="' + data[i]
                            .id + '">' + JSON.parse(data[i].name) + '</option>');
                    }
                },
                error: function() {

                }
            });


        });
    </script>
    <script>
        //product image load
        $(document).on('change', "input#images", function(e) {
            e.preventDefault();
            $('.show_image').html(' ');
            for (let i = 0; i < e.target.files.length; i++) {
                let product_image_url = URL.createObjectURL(e.target.files[i]);
                $('.show_image').append(
                    `
                    <div class="col-md-3" d-flex flex-column mb-2>
                   
               <img style="width:150px;height:100px" class="me-4 product_images" src="${product_image_url}">
                   </div> 
                    `

                );
            }

        });
        //
      
    </script>
@endsection
