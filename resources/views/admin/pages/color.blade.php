@extends('admin.layout.master')
@section('content')
<style>
   
     .partyy .dropdown-menu{
        min-width: 80px!important;
        margin-top:40px!important;
        margin-left:37px!important;
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

            <h1 class="h3 mb-3"><strong>Color</h1>

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Color</h4>
                                            <div></div>
                                            <div>

                                                <a href="#addColorModal" data-bs-toggle="modal"
                                                    class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus-circle"
                                                        aria-hidden="true"></i> Add New Color</a>
                                            </div>
                                        </div>
                                       <br>
                                      
                                        {{-- @include('sweetalert::alert') --}}

                                    </div>
                                    <div class="card-body" style="margin-top:-55px!important;">
                                        <table class="table table-data">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Color Name</th>
                        
                                                  
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($colors as $data)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        
                                                        <td>{{ $data->name }}</td>
                                                      


                                                      

                                                        <td>
                                                            <div class="dropdown partyy text-center">
                                                                <button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu" style="text-align: center" aria-labelledby="dropdownMenuButton1">
                                                                  <li>  <a class="btn btn-warning btn-sm dropdown-item text-center" edit_id="{{ $data->id }}"
                                                                    data-bs-toggle="modal" id="edit_color"><i
                                                                        class="fa fa-pencil-square-o  text-dark"
                                                                        style="font-size:20px" aria-hidden="true"> Edit</i>
                                                                </a></li>
                                                                  <li> <a class="btn btn-light btn-sm dropdown-item text-center" id="delete_color"
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

            <div id="addColorModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New  Color</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        

                        </div>
                       
                        <div class="modal-body">
                            <div class="mess"></div>
                            <form id="add_color_form" action="" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="mb-2">Color name</label>
                                    <input name="name" class="form-control" id="name" type="text"
                                        placeholder="Name">
                                        <span class="text-danger error-text name_error"></span>
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


            {{-- //edit party type --}}
            <div id="editColor-modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Color</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="mess"></div>

                        </div>
                        <div class="modal-body">
                            <form id="updateData" action="" method="POST">
                               @csrf
                              
                               <div class="form-group">
                                <input name="id" id="edit_id" class="form-control" type="hidden"
                                                placeholder="title">
                                <label for="" class="mb-2">Color name</label>
                                <input name="name" class="form-control" id="edit_name" type="text"
                                    placeholder="Name">
                                    <span class="text-danger error-text name_error"></span>
                            </div>
                          <br>
                                <div class="form-group">
                                    <label for="" class="mb-2">Status</label>
                                    <br>
                                    <select name="status" class="form-control"  id="edit_status"
                                        >
                                        <option value="">--Select Status--</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                    <span class="text-danger error-text status_error"></span>
                                </div>
                                <div class="form-group mt-4 d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                    

                                    <input class="btn btn-primary btn-sm"type="submit" value="Update">
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
    //new product create
    $(document).on('submit', 'form#add_color_form', function(e) {
        e.preventDefault();
        $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
        $.ajax({
            url: 'color-create',
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
                    $('#addColorModal').modal('hide');
                    Swal.fire(
                        'Added',
                        'Color Added Successfully!',
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
    $(document).on('click', '#edit_color', function(e) {
        e.preventDefault();
        $('.subcategory').html('');

        let edit_id = $(this).attr('edit_id');
        $.ajax({
            url: 'color-edit/' + edit_id,
            success: function(data) {
                $('#editColor-modal input[id="edit_id"]').val(data.id);
                $('#editColor-modal input[id="edit_name"]').val(data.name);
                $('#editColor-modal select[id="edit_status"]').val(data.status);
                $('#editColor-modal').modal('show');
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
            url: 'color-update/'+ id,
            type: "post",
            contentType: false,
            processData: false,
            data:new FormData(this),
           
            success: function(res) {
                if (res.status == 200) {
                    $('#editColor-modal').modal('hide');
                    Swal.fire(
                        'Update',
                        'Color Update Successfully!',
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
    //product  temporary delete
    $(document).on('click', 'a#delete_color', function(e) {
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
                    url: 'color-delete/' + id,
                    success: function(data) {
                        Swal.fire(
                            'Delete',
                            'Color  Deleted Successfully!',
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
