@extends('admin.layout.master')
@section('content')
    <style>
        .partyy .dropdown-menu {
            min-width: 80px !important;
            margin-top: 40px !important;
            margin-left: 10px !important;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        thead {
            background-color: rgba(128, 128, 128, 0.144);
        }

        .dataTables_length label {
            margin-bottom: 30px;
        }
    </style>
    <main class="content">
        <div class="container-fluid w-75 p-0">

            <h1 class="h3 mb-3"><strong>Category Edit</h1>

            <div class="row-12">
                <div class="card">
                    <div class="mt-3 card-title d-flex justify-content-between">
                        <h4 class="ms-3" style="color:#495057">Category Edit</h4>
                        <a href="{{ route('category.index') }}" class="btn btn-primary btn-sm me-3 float-end"><i
                                class="fa fa-plus-circle" aria-hidden="true"></i> All Categories</a>
                    </div>


                    <div class="card-body">
                        <form action="{{ route('category.update', $data->id) }}" method="POST">
                            @csrf

                            <div class="form-group">

                                <label for="" class="mb-2">Category name</label>

                                <input name="name" class="form-control" value="{{ $data->name }}" type="text"
                                    @error('name') is-invalid @enderror" placeholder="Name">
                                @error('name')
                                    <div class="text-danger">* {{ $message }}</div>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label for="" class="mb-2">SubCategory name</label>
                                    @foreach ($subcat as $sub)
                                    <div class="d-flex w-70 justify-content between mb-2">
                                    <input name="subcategoryname[]" id="subcategoryname" class="form-control w-50" type="text" value="{{json_decode($sub->name)}}"></input>

                                    <button  onclick="deleteSubcategory({{$sub->id}})" id="delete_subcat"  class="btn btn-danger btn-sm ms-2"><i
                                        class="fa fa-trash text-dark" style="font-size:20px;color:white!important"
                                        aria-hidden="true"></i></button>
                                    </div>
                                    @endforeach


                            </div><br>
                            <div class="form-group mt-2">
                                <label for="" class="mb-2">Add New SubCategory</label>
                                <div class="subcategory w-50">
                                    <div class="d-flex mb-2">
                                        <input name="subcategory_name[]" class="form-control" id="name" type="text"
                                            placeholder="Name" multiple>
                                        <span id="add" class="btn btn-dark ms-3">+</span>

                                    </div>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="" class="mb-2">Status</label>
                                    <br>
                                    <select name="status" class="form-control" style="width:40%"
                                        @error('status') is-invalid @enderror">
                                        <option value="">--Select Status--</option>

                                        <option value="Active" @if ($data->status == 'Active') selected @endif>Active
                                        </option>
                                        <option value="Inactive" @if ($data->status == 'Inactive') selected @endif>Inactive
                                        </option>
                                    </select>

                                    @error('status')
                                        <div class="text-danger">* {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mt-4 d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-bs-dismiss="modal">Cancel</button>


                                    <input class="btn btn-primary btn-sm"type="submit" value="Update">
                                </div>

                        </form>

                    </div>
                </div>
            </div>


        </div>
    </main>
@endsection
@section('script')
    <script>
        $(document).on('click', 'span#add', function(e) {
            $('.subcategory').append(`
        <div class="d-flex mb-2">
            <input name="subcategory_name[]" class="form-control" id="name" type="text"
              placeholder="Name" multiple>
            <span id="add" class="btn btn-dark ms-3">+</span>

            <span id="remove" class="btn btn-danger ms-3">-</span>
           
        </div>
        
        `);
        });

        $(document).on('click', 'span#remove', function(e) {
            $(this).parent().remove();
        });
      
      
        //subcategory delete
        function deleteSubcategory(id) {
            $.ajax({
                url: '/subcategories-delete/' + id,
                success: function(data) {

                    window.location.reload();
                }

            });
        }
    </script>
@endsection
