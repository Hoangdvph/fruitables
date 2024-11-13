@extends('admin.layouts.master')

@section('title')
    Chi tiết sản phẩm {{ $product->name }}
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($product->toArray() as $field => $value)
                            <tr>
                                <td>{{ $field }}</td>
                                
                                <td>
                                    @php
                                        switch ($field) {
                                            case 'image':
                                                # code...
                                                $url = Storage::url($product->image);
                                                echo "<img src=\"$url\" width=\"50\" alt=\"\">";
                                                break;
                                            default:
                                                # code...
                                                echo $value;
                                                break;
                                        }
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
