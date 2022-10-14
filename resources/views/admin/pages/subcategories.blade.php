@extends('admin.layout.master')
@section('content')
    
    <main class="content">
        <div class="container-fluid w-50 p-0">

            <h1 class="h3 mb-3"><strong>SubCategories</h1>

            <div class="row-12">
                <div class="card">
                    <div class="d-flex justify-content-between mt-3">
                    <div class="card-title ms-3" style="text-transform:capitalize;"> Category Name -> {{$category->name}}</div>
                    <div>
                        <a href="{{ route('category.index') }}" class="btn btn-primary btn-sm me-3"><i
                                class="fa fa-plus-circle" aria-hidden="true"></i> All Categories</a>
                    </div>
                   </div>
                    <div class="card-body">
                        <h3 style="text-transform:capitalize">Subcatgories of {{$category->name}} :</h3>
                        <ol>
                            @foreach($subcategories as $subcat)
                            <li style="font-size:17px;text-transform:capitalize">{{json_decode($subcat->name)}}</li>
                            @endforeach
                        </ol>
                     

                    </div>
                </div>
            </div>


        </div>
    </main>
@endsection

