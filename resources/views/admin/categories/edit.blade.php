@extends('admin.layouts.master')

@section('title')
    Danh sách danh mục
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-primary" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST" >

        @csrf
        
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Tên danh mục:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"
                value="{{ $category->name }}">
        </div>

        

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
