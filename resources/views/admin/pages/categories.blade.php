@extends('admin.layout.master')
@section('content')
<style>
   
     .partyy .dropdown-menu{
        min-width: 170px!important;
        margin-top:40px!important;
        margin-left:27px!important;
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

            <h1 class="h3 mb-3"><strong>Category</h1>

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Category</h4>
                                            <div></div>
                                            <div>

                                                <a href="#addCategoryModal" data-bs-toggle="modal"
                                                    class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus-circle"
                                                        aria-hidden="true"></i> Add New Category</a>
                                            </div>
                                        </div>
                                       <br>
                                        <div class="messs"></div>
                                        @if (Session::has('success'))
                                            <p class="alert alert-success d-flex justify-content-between">
                                                {{ Session::get('success') }}<button type="button" class="btn-close"
                                                    data-bs-dismiss="alert" aria-label="Close"></button></p>
                                        @endif
                                        @include('sweetalert::alert')

                                    </div>
                                    <div class="card-body" style="margin-top:-55px!important;">
                                        <table class="table table-data">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Category Name</th>
                                                  
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $data)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $data->name }}</td>
                                                       
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
                                                                <ul class="dropdown-menu text-center"  aria-labelledby="dropdownMenuButton1">
                                                                    <li>  <a href="{{route('subcategories.show',$data->id)}}"><i class="fa fa-eye text-dark" aria-hidden="true" style="font-size:20px">
                                                                        Subcategories</i>
                                                                   </a></li>
                                                                    <li>  <a href="{{route('category.edit',$data->id)}}"><i
                                                                        class="fa fa-pencil-square-o  text-dark mt-2"
                                                                        style="font-size:20px" aria-hidden="true"> Edit</i>
                                                                </a></li>
                                                                  <li> <a class="btn btn-light btn-sm dropdown-item"  id="delete_category"
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
            {{-- add party type --}}

            <div id="addCategoryModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New  Category</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        

                        </div>
                       
                        <div class="modal-body">
                            <div class="mess"></div>
                            <form id="add_category_form" action="" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="mb-2">Category name</label>
                                    <input name="name" class="form-control" id="category_name" type="text"
                                        placeholder="Name">
                                        <span class="text-danger error-text name_error"></span>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="" class="mb-2">SubCategory name</label>
                                    <div class="subcategory w-100">
                                      <div class="d-flex mb-2">
                                        <input name="subcategory_name[]"  class="form-control" id="name" type="text"
                                        placeholder="Name" multiple>
                                        <span id="add" class="btn btn-dark ms-3">+</span>
                                      </div>
                                    </div>
                        
                                        <span class="text-danger error-text subcategory_name_error"></span>
                                </div>
                                <div class="form-group mt-4 d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                    

                                    <input class="btn btn-primary btn-sm"type="submit" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>







        </div>
    </main>
   
    
@endsection
@section('script')
<script>
    
    $(document).on('click','span#add',function(e){
         $('.addd').css('display','none');
        $('.subcategory').append(`
        <div class="d-flex mb-2">
            <input name="subcategory_name[]" class="form-control" id="name" type="text"
                                        placeholder="Name" multiple>
            <span id="add" class="btn btn-dark ms-3">+</span>

            <span id="remove" class="btn btn-danger ms-3">-</span>
        </div>
        
        `);

    });
    $(document).on('click','span#remove',function(e){
       $(this).parent().remove();
    });
   
    //create category

    $(document).on('submit', 'form#add_category_form', function(e) {
        e.preventDefault();
        $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
        $.ajax({
            url: 'categories-create',
            method: "POST",
            contentType: false,
            processData: false,
            data:new FormData(this),
            dataType:"json",
            beforeSend: function() {
                $(document).find('span.error-text').text('');
            },
            success: function(res) {
                if (res.status == 200) {
                    $('#addCategoryModal').modal('hide');
                    Swal.fire(
                        'Added',
                        'Category Added Successfully!',
                        'success'
                    )
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);


                }
                else if (res.status === 400) {
                    $.each(res.errors, function(key, err_value) {
                        $('span.' + key + '_error').text(err_value[0]);
                    });
                }

                }
            });
        
    });

    //select2

    //data table

    $(document).ready(function() {
        $('table.table-data').DataTable();
        // $('#partytype').select2();

    });
    //edit party type
    $(document).on('click', '#edit_category', function(e) {
        e.preventDefault();
         $('.edit_subcat').html(' ');
        let edit_id = $(this).attr('edit_id');
        $.ajax({
            url: 'categories-edit/' + edit_id,
            success: function(data) {
                $('#editCategory-modal input[id="edit_id"]').val(data.id);
                $('#editCategory-modal input[id="edit_name"]').val(data.name);
                $('#editCategory-modal select[id="edit_status"]').val(data.status);
                for(let i=0;i<data.subcat.length;i++){
                    
                    $('.edit_subcat').append('<input name="subcategory_name[]" value="'+ JSON.parse(data.subcat[i].name) +'"><br><br>'
                    );
                }
                  
                $('#editCategory-modal').modal('show');
            }
        })
    });

   //update single data
   $(document).on('submit', 'form#updateData', function(e) {
        e.preventDefault();
        var id=$('#edit_id').val();
        $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'categories-update/'+ id,
            type: "post",
            contentType: false,
            processData: false,
            data:new FormData(this),
           
            success: function(res) {
                if (res.status == 200) {
                    $('#editCategory-modal').modal('hide');
                    Swal.fire(
                        'Update',
                        'Category Update Successfully!',
                        'success'
                    )
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                  }
                  else if (res.status === 400) {
                    $.each(res.errors, function(key, err_value) {
                        $('span.' + key + '_error').text(err_value[0]);
                    });
                }
                }
                
            });      
    });
    //temporary delet
    //product category temporary delete
    $(document).on('click', 'a#delete_category', function(e) {
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
                    url: 'categories-delete/' + id,
                    success: function(data) {
                        Swal.fire(
                            'Delete',
                            'Category  Deleted Successfully!',
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
