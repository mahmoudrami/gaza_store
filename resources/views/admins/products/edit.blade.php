@extends('admins.master')
@section('title', 'dashbord')

@section('css')
<style>
    .wrapper-delete{
        position: relative;
    }
    .wrapper-delete span{
        position: absolute;
        height: 20px;
        width: 20px;
        top: 5px;
        right: 5px;
        color: white;
        font-weight: bold;
        font-size: 13px;
        border-radius: 50%;
        background-color: rgb(189, 92, 92);
        /* visibility: hidden; */
        opacity: 0;
        transition: all 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        text-align: center;
    }
    .wrapper-delete:hover{
        opacity: .8;
    }
    .wrapper-delete:hover span{
        display: inline;
        opacity: 1;
        visibility: visible;
    }
</style>
@endsection

@section('content')
<h1 class="h3 mb-4 text-gray-800">Add New Category</h1>
<form action="{{ route('admin.products.update', @$item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    @include('admins.products._form')
</form>
@endsection
@section('js')
    <script>
        function delimg(e,id){
            // alert(id);
            $.ajax({
                url:'{{ route("admin.delete_img") }}/'+ id,
                method: 'GET',
                success:function(){
                    // alert('success');
                    e.target.parentElement.remove();
                }

            });

        }
    </script>
@endsection
