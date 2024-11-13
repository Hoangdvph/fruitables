@extends('admin.layouts.master')

@section('title')
    Thêm mới sản phẩm
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

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Danh mục sản phẩm:</label>
            <select class="form-control" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Tên sản phẩm:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" 
            value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="pwd" class="form-label">Giá sản phẩm:</label>
            <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" 
            value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label for="pwd" class="form-label">Giảm giá:</label>
            <input type="number" class="form-control" id="price_sale" placeholder="Enter price_sale" name="price_sale" 
            value="{{ old('price_sale') }}">
        </div>

        <div class="mb-3">
            <label for="pwd" class="form-label">Cân nặng:</label>
            <input type="text" class="form-control" id="weight" placeholder="Enter weight" name="weight" 
            value="{{ old('weight') }}">
        </div>

        <div class="mb-3">
            <label for="origin" class="form-label">Xuất xứ:</label>
            <input type="text" class="form-control" id="origin" placeholder="Enter origin" name="origin" 
            value="{{ old('origin') }}">
        </div>

        <div class="mb-3">
            <label for="quality" class="form-label">Chất lượng:</label>
            <input type="text" class="form-control" id="quality" placeholder="Enter quality" name="quality" 
            value="{{ old('quality') }}">
        </div>

        <div class="mb-3">
            <label for="origin" class="form-label">Hình ảnh:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <div class="mb-3">
            <label for="pwd" class="form-label">Mô tả:</label>
            <textarea class="form-control" rows="5" id="description" name="description" placeholder="Enter description" 
            value="{{ old('description') }}"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
