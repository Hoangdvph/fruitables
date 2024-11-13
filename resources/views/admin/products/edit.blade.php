@extends('admin.layouts.master')

@section('title')
    Cập nhật sản phẩm {{ $product->name }}
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

    @if (session()->has('success') && session()->get('success'))
        <div class="alert alert-primary" role="alert">
            thao tháo thanh công
        </div>
    @endif

    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger" role="alert">
            thao tác không thành công
        </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Danh mục sản phẩm:</label>
            <select class="form-control" name="category_id">
                @foreach ($categories as $category)
                    <option
                    @if ( $product->category_id  == $category->id )
                        selected
                    @endif
                     value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Tên sản phẩm:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"
                value="{{ $product->name }}">
        </div>

        <div class="mb-3">
            <label for="pwd" class="form-label">Giá sản phẩm:</label>
            <input type="number" class="form-control" id="price" placeholder="Enter price" name="price"
                value="{{ $product->price }}">
        </div>

        <div class="mb-3">
            <label for="pwd" class="form-label">Giảm giá:</label>
            <input type="number" class="form-control" id="price_sale" placeholder="Enter price_sale" name="price_sale"
                value="{{ $product->price_sale }}">
        </div>

        <div class="mb-3">
            <label for="pwd" class="form-label">Cân nặng:</label>
            <input type="text" class="form-control" id="weight" placeholder="Enter weight" name="weight"
                value="{{ $product->weight }}">
        </div>

        <div class="mb-3">
            <label for="origin" class="form-label">Xuất xứ:</label>
            <input type="text" class="form-control" id="origin" placeholder="Enter origin" name="origin"
                value="{{ $product->origin }}">
        </div>

        <div class="mb-3">
            <label for="quality" class="form-label">Chất lượng:</label>
            <input type="text" class="form-control" id="quality" placeholder="Enter quality" name="quality"
                value="{{ $product->quality }}">
        </div>

        <div class="mb-3">
            <label for="origin" class="form-label">Hình ảnh:</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="{{ Storage::url($product->image) }}" alt="" width="150" class="mt-3">
            <input type="hidden" name="image_url" value={{ $product->image }}>

        </div>

        <div class="mb-3">
            <label for="pwd" class="form-label">Mô tả:</label>
            <textarea class="form-control" rows="5" id="description" name="description" placeholder="Enter description"
            >{{ $product->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('products.index') }}" class="btn btn-warning">Quay về</a>
    </form>
@endsection
