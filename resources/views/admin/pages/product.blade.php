@extends('admin.layout.master')
@section('content')
<style>
   
     .partyy .dropdown-menu{
        min-width: 80px!important;
        margin-top:40px!important;
        margin-left:-15px!important;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse; 
        }
        thead{
            background-color:rgba(128, 128, 128, 0.144);
        }
    .dataTables_length label{
        margin-bottom:30px;
    }
  </style>
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3"><strong>Product</h1>

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Product</h4>
                                            <div></div>
                                            <div>

                                                <a href="{{route('product.create')}}"
                                                    class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus-circle"
                                                        aria-hidden="true"></i> Add New Product</a>
                                            </div>
                                        </div>
                                       <br>
                                       
                                        @include('sweetalert::alert')

                                    </div>
                                    <div class="card-body" style="margin-top:-55px!important;">
                                        <table class="table table-data">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                  
                                                    <th style="width:15%">Product Name</th>
                                                    <th>Stock Status</th>
                                                    <th>Category</th>
                                                    <th>SubCategory</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $data)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $data->name }}</td>
                                                        <td>{{ $data->stock_status }}</td>
                                                        <td>{{ $data->category->name }}</td>
                                                        <td>{{ json_decode($data->subcategory->name) }}</td>


                                                        <td>

                                                            @if($data->status == 'Active')
                                                            <span class="badge bg-success">{{ $data->status }}</span>
                                                            @else
                                                            <span class="badge bg-warning">{{ $data->status }}</span>
                                                            @endif


                                                        </td>

                                                        <td>
                                                            <div class="dropdown partyy text-center">
                                                                <button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu" style="text-align: center" aria-labelledby="dropdownMenuButton1">
                                                                  <li>  <a class="btn btn-warning btn-sm dropdown-item text-center" href="{{route('product.edit',$data->id)}}" 
                                                                ><i
                                                                        class="fa fa-pencil-square-o  text-dark"
                                                                        style="font-size:20px" aria-hidden="true"> Edit</i>
                                                                </a></li>
                                                                  <li> <a class="btn btn-light btn-sm dropdown-item text-center" id="delete_product"
                                                                    delete_id="{{ $data->id }}" href=""><i
                                                                        class="fa fa-trash text-dark" style="font-size:20px"
                                                                        aria-hidden="true"> Delete</i>
                                                                </a></li>
                                                                </ul>
                                                              </div>
 
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


            </div>

@endsection
@section('script')
<script>
    
    $(document).ready(function() {
        $('table.table-data').DataTable();

    });

     //product  temporary delete
     $(document).on('click', 'a#delete_product', function(e) {
        e.preventDefault();
        let id = $(this).attr('delete_id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'product-delete/' + id,
                    success: function(data) {
                        Swal.fire(
                            'Delete',
                            'Product  Deleted Successfully!',
                            'success'
                        )
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);


                    }
                });
            }
        })
    });
</script>
@endsection
