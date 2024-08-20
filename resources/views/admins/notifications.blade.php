@extends('admins.master')
@section('title', 'dashbord')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Blank Page</h1>
<div class="list-group">
    @foreach ($notifications as $item)
        <a href="#" class="list-group-item list-group-item-action
        {{ $item->read_at ? '' : 'bg-dark text-white' }}" aria-current="true">
            {{ $item->data['msg'] }}
        </a>
    @endforeach
  </div>
@endsection
