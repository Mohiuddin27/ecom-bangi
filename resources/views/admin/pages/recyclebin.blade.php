@extends('admin.layout.master')
@section('content')
<main class="content">
    <style>
          .partyy .dropdown-menu {
            background-color: rgb(255, 255, 255);
           
            margin-top: 45px !important;
            margin-right: -40px !important;
        }
        .partyy2 .dropdown-menu {
            background-color: rgb(255, 255, 255);
            position:absolute;
           
            margin-top: 45px !important;
            left:-30px!important;
        }
        .dataTables_length label{
            margin-bottom:50px;
        }
      </style>
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"><strong>Recycle Bin</h1>

                    <div class="row">
                        <div class="col-xl-12 col-xxl-12">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title">Product Trash</h4>
                                                    <div></div>

                                                </div>
                                                <div>
                                                </div><br>                                               
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped mb-0 table-data">
                                                    <thead>
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Product Name</th>
                                                            <th>Category Name</th>
                                                            <th>Subcategory Name</th>
                                                        
                                                            <th>Status</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="customercategory">
                                                        @foreach($products as $data)
                                                        <tr>
                                                            <td>{{$loop->index+1}}</td>
                                                            <td>{{$data->name}}</td>
                                                            <td>{{$data->category->name}}</td>
                                                            <td>{{json_decode($data->subcategory->name)}}</td>

                                                            <td>
                                                                
                                                                <span class="badge bg-warning">{{$data->status}}</span>
                                                              
                                                             
                                                            </td>
                                                        
                                                            <td class="text-center">
                                                                <div class="dropdown partyy">
                                                                    <button class="btn btn-primary btn-lg dropdown-toggle"
                                                                        type="button" id="dropdownMenuButton1"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu col-md-4"
                                                                        aria-labelledby="dropdownMenuButton1">
                                                                        <li> <a class="btn btn-info btn-lg text-dark text-center dropdown-item" id="product_restore_data" product_restore_id="{{$data->id}}"><i class="fa fa-window-restore" aria-hidden="true"></i>
                                                                            Restore
                                                                        </a> </li>
                                                                        <li> <a class="btn btn-danger btn-lg dropdown-item text-center text-dark" id="product_permanently_delete" product_delete_id="{{$data->id}}"><i
                                                                            class="fa fa-trash text-danger"
                                                                            style="font-size:20px" aria-hidden="true"></i> Permanently <br> Delete
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

                    
                    
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title">Image Trash</h4>
                                                    <div></div>

                                                </div>
                                                <div>
                                                </div><br>                                               
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped mb-0 table-data">
                                                    <thead>
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Image</th>
                                                            <th>Product Name</th>                                                        
                                                            <th>Status</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="customercategory">
                                                        @foreach($images as $data)
                                                        <tr>
                                                            <td>{{$loop->index+1}}</td>
                                                            <td>
                                                                
                                                                <img style="width:60px;height:60px;"src="{{ URL::to('/') }}/media/products/{{ $data->image }}"
                                                                    alt="">
                                                            </td>
                                                            <td>{{$data->product->name}}</td>

                                                            <td>
                                                                
                                                                <span class="badge bg-warning">{{$data->status}}</span>
                                                              
                                                             
                                                            </td>
                                                        
                                                            <td class="text-center">
                                                                <div class="dropdown partyy">
                                                                    <button class="btn btn-primary btn-lg dropdown-toggle"
                                                                        type="button" id="dropdownMenuButton1"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu col-md-4"
                                                                        aria-labelledby="dropdownMenuButton1">
                                                                        <li> <a class="btn btn-info btn-lg text-dark text-center dropdown-item" id="image_restore_data" image_restore_id="{{$data->id}}"><i class="fa fa-window-restore" aria-hidden="true"></i>
                                                                            Restore
                                                                        </a> </li>
                                                                        <li> <a class="btn btn-danger btn-lg dropdown-item text-center text-dark" id="image_permanently_delete" image_delete_id="{{$data->id}}"><i
                                                                            class="fa fa-trash text-danger"
                                                                            style="font-size:20px" aria-hidden="true"></i> Permanently <br> Delete
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
                     {{-- category trash --}}
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title">Category Trash</h4>
                                                    <div></div>

                                                </div>
                                                <div>
                                                </div><br>                                               
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped mb-0 table-data">
                                                    <thead>
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Category Name</th>
                                                            <th>Subcategory Name</th>                                                        
                                                            <th>Status</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="customercategory">
                                                        @foreach($categories as $data)
                                                        <tr>
                                                            <td>{{$loop->index+1}}</td>
                                                            <td>{{$data->name}}</td>
                                                        <td> 
                                                            <?php
                                                            $subcatories=DB::table('sub_categories')->where('category_id',$data->id)->where('is_deleted','Yes')->get();
                                                           ?>
                                                       @foreach($subcatories as $subcat)
                                                          {{json_decode($subcat->name)}} |
                                                       @endforeach

                                                            </td>

                                                            <td>
                                                                
                                                                <span class="badge bg-warning">{{$data->status}}</span>
                                                              
                                                             
                                                            </td>
                                                        
                                                            <td class="text-center">
                                                                <div class="dropdown partyy">
                                                                    <button class="btn btn-primary btn-lg dropdown-toggle"
                                                                        type="button" id="dropdownMenuButton1"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu col-md-4"
                                                                        aria-labelledby="dropdownMenuButton1">
                                                                        <li> <a class="btn btn-info btn-lg text-dark text-center dropdown-item" id="category_restore_data" category_restore_id="{{$data->id}}"><i class="fa fa-window-restore" aria-hidden="true"></i>
                                                                            Restore
                                                                        </a> </li>
                                                                        <li> <a class="btn btn-danger btn-lg dropdown-item text-center text-dark" id="category_permanently_delete" category_delete_id="{{$data->id}}"><i
                                                                            class="fa fa-trash text-danger"
                                                                            style="font-size:20px" aria-hidden="true"></i> Permanently <br> Delete
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

                    {{-- subcategory Trash --}}
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title">Subcategory Trash</h4>
                                                    <div></div>

                                                </div>
                                                <div>
                                                </div><br>                                               
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped mb-0 table-data">
                                                    <thead>
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Subcategory Name</th>
                                                            <th>Category Name</th>                                                        
                                                            <th>Status</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="customercategory">
                                                        @foreach($subcategories as $data)
                                                        <tr>
                                                            <td>{{$loop->index+1}}</td>
                                                            <td>{{json_decode($data->name)}}</td>
                                                             <td>{{$data->category->name}} </td>

                                                            <td>
                                                                
                                                                <span class="badge bg-warning">{{$data->status}}</span>
                                                              
                                                             
                                                            </td>
                                                        
                                                            <td class="text-center">
                                                                <div class="dropdown partyy">
                                                                    <button class="btn btn-primary btn-lg dropdown-toggle"
                                                                        type="button" id="dropdownMenuButton1"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu col-md-4"
                                                                        aria-labelledby="dropdownMenuButton1">
                                                                        <li> <a class="btn btn-info btn-lg text-dark text-center dropdown-item" id="subcategory_restore_data" subcategory_restore_id="{{$data->id}}"><i class="fa fa-window-restore" aria-hidden="true"></i>
                                                                            Restore
                                                                        </a> </li>
                                                                        <li> <a class="btn btn-danger btn-lg dropdown-item text-center text-dark" id="subcategory_permanently_delete" subcategory_delete_id="{{$data->id}}"><i
                                                                            class="fa fa-trash text-danger"
                                                                            style="font-size:20px" aria-hidden="true"></i> Permanently <br> Delete
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

                    {{-- color trash --}}
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title">Color Trash</h4>
                                                    <div></div>

                                                </div>
                                                <div>
                                                </div><br>                                               
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped mb-0 table-data">
                                                    <thead>
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Color</th>
                                                            <th>Status</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="customercategory">
                                                        @foreach($colors as $data)
                                                        <tr>
                                                            <td>{{$loop->index+1}}</td>
                                                            <td>{{$data->name}}</td>

                                                            <td>
                                                                
                                                                <span class="badge bg-warning">{{$data->status}}</span>
                                                              
                                                             
                                                            </td>
                                                        
                                                            <td class="text-center">
                                                                <div class="dropdown partyy">
                                                                    <button class="btn btn-primary btn-lg dropdown-toggle"
                                                                        type="button" id="dropdownMenuButton1"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu col-md-4"
                                                                        aria-labelledby="dropdownMenuButton1">
                                                                        <li> <a class="btn btn-info btn-lg text-dark text-center dropdown-item" id="color_restore_data" color_restore_id="{{$data->id}}"><i class="fa fa-window-restore" aria-hidden="true"></i>
                                                                            Restore
                                                                        </a> </li>
                                                                        <li> <a class="btn btn-danger btn-lg dropdown-item text-center text-dark" id="color_permanently_delete" color_delete_id="{{$data->id}}"><i
                                                                            class="fa fa-trash text-danger"
                                                                            style="font-size:20px" aria-hidden="true"></i> Permanently <br> Delete
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
                    {{-- size trash --}}
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title">Size Trash</h4>
                                                    <div></div>

                                                </div>
                                                <div>
                                                </div><br>                                               
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped mb-0 table-data">
                                                    <thead>
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Size</th>
                                                            <th>Status</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="customercategory">
                                                        @foreach($sizes as $data)
                                                        <tr>
                                                            <td>{{$loop->index+1}}</td>
                                                            <td>{{$data->name}}</td>

                                                            <td>
                                                                
                                                                <span class="badge bg-warning">{{$data->status}}</span>
                                                              
                                                             
                                                            </td>
                                                        
                                                            <td class="text-center">
                                                                <div class="dropdown partyy">
                                                                    <button class="btn btn-primary btn-lg dropdown-toggle"
                                                                        type="button" id="dropdownMenuButton1"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu col-md-4"
                                                                        aria-labelledby="dropdownMenuButton1">
                                                                        <li> <a class="btn btn-info btn-lg text-dark text-center dropdown-item" id="size_restore_data" size_restore_id="{{$data->id}}"><i class="fa fa-window-restore" aria-hidden="true"></i>
                                                                            Restore
                                                                        </a> </li>
                                                                        <li> <a class="btn btn-danger btn-lg dropdown-item text-center text-dark" id="size_permanently_delete" size_delete_id="{{$data->id}}"><i
                                                                            class="fa fa-trash text-danger"
                                                                            style="font-size:20px" aria-hidden="true"></i> Permanently <br> Delete
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



                       
                        

                    

                </div>
            </main>  
           

    
@endsection
@section('script')
<script>
    //DATATABLE
    $(document).ready(function() {
        $('table.table-data').DataTable();
                // $('#partytype').select2();
    
    });
      //product restore data
      $(document).on('click', 'a#product_restore_data', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('product_restore_id');
        
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You are going  to restore this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Restore it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/product-restore/' + id,
                                success: function(data) {
                                    Swal.fire(
                                        'Success',
                                        'Product Restore Successfully!',
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
     // party permanently delete
    $(document).on('click','a#product_permanently_delete',function(e){
      e.preventDefault();
      let id=$(this).attr('product_delete_id');
      
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if(result.isConfirmed) {
          $.ajax({
            url : 'product-permanently-delete/' + id,
            success:function(data){
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

//image restore
  $(document).on('click', 'a#image_restore_data', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('image_restore_id');
        
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You are going  to restore this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Restore it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/image-restore/' + id,
                                success: function(data) {
                                    Swal.fire(
                                        'Success',
                                        'Image Restore Successfully!',
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

         //image permanently delete

    $(document).on('click','a#image_permanently_delete',function(e){
      e.preventDefault();
      let id=$(this).attr('image_delete_id');
      
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if(result.isConfirmed) {
          $.ajax({
            url : 'image-permanently-delete/' + id,
            success:function(data){
              Swal.fire(
                'Delete',
                'Image  Deleted Successfully!',
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
//category restore data
$(document).on('click', 'a#category_restore_data', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('category_restore_id');
        
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You are going  to restore this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Restore it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/category-restore/' + id,
                                success: function(data) {
                                    Swal.fire(
                                        'Success',
                                        'Category Restore Successfully!',
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

        //category delete
    $(document).on('click','a#category_permanently_delete',function(e){
      e.preventDefault();
      let id=$(this).attr('category_delete_id');
      
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if(result.isConfirmed) {
          $.ajax({
            url : 'category-permanently-delete/' + id,
            success:function(data){
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
     //subcategory restore data
$(document).on('click', 'a#subcategory_restore_data', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('subcategory_restore_id');
        
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You are going  to restore this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Restore it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/subcategory-restore/' + id,
                                success: function(data) {
                                    Swal.fire(
                                        'Success',
                                        'SubCategory Restore Successfully!',
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

        //subcategory delete
    $(document).on('click','a#subcategory_permanently_delete',function(e){
      e.preventDefault();
      let id=$(this).attr('subcategory_delete_id');
      
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if(result.isConfirmed) {
          $.ajax({
            url : 'subcategory-permanently-delete/' + id,
            success:function(data){
              Swal.fire(
                'Delete',
                'SubCategory  Deleted Successfully!',
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
          //color restore data
$(document).on('click', 'a#color_restore_data', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('color_restore_id');
        
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You are going  to restore this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Restore it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/color-restore/' + id,
                                success: function(data) {
                                    Swal.fire(
                                        'Success',
                                        'Color Restore Successfully!',
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

        //color delete
    $(document).on('click','a#color_permanently_delete',function(e){
      e.preventDefault();
      let id=$(this).attr('color_delete_id');
      
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if(result.isConfirmed) {
          $.ajax({
            url : 'color-permanently-delete/' + id,
            success:function(data){
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
               //size restore data
$(document).on('click', 'a#size_restore_data', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('size_restore_id');
        
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You are going  to restore this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Restore it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/size-restore/' + id,
                                success: function(data) {
                                    Swal.fire(
                                        'Success',
                                        'Size Restore Successfully!',
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

        //color delete
    $(document).on('click','a#size_permanently_delete',function(e){
      e.preventDefault();
      let id=$(this).attr('size_delete_id');
      
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if(result.isConfirmed) {
          $.ajax({
            url : 'size-permanently-delete/' + id,
            success:function(data){
              Swal.fire(
                'Delete',
                'Size  Deleted Successfully!',
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