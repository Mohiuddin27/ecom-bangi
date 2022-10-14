@extends('admin.layout.master')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Welcome <strong style="text-transform:capitalize">{{Auth::user()->name}}</strong></h1>
        <h3>Dashboard content goes here</h3>
    </div>
</main>  
@endsection