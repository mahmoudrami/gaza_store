@extends('admins.master')
@section('title', 'dashbord')
@section('content')
<h1 class="h3 mb-4 text-gray-800">All Category</h1>
<table class="table table-hover table-borderd">
    <tr class="bd-dark">
        <th>id</th>
        <th>iamge</th>
        <th>name</th>
        <th>Roducts Count</th>
        <th>Actions</th>
    </tr>
    @foreach ($items as $item)
        <tr>
            <th>{{ @$item->id }}</th>
            <th><img width="100" src="{{ @$item->img_path }}"></th>
            {{-- <th>{{ json_decode(@$item->name, true)['en'] }}</th> --}}
            <th>{{ @$item->trans_name }}</th>
            <th></th>
            <th>
                <a href="{{ route('admin.categories.edit', @$item->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                <form action="{{ route('admin.categories.destroy', @$item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </form>
            </th>
        </tr>
    @endforeach

</table>
@endsection
