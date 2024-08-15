@extends('admins.master')
@section('title', 'dashbord')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Add New Category</h1>
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admins.products._form')
</form>
@endsection

