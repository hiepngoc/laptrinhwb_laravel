@extends('dashboard')

@section('content')
<div class="container my-5">
    <a href="{{ url()->previous() }}" class="btn btn-secondary m-3">← Quay lại</a>
    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order Name</th>
                <th>Tên Người Đặt</th>
            </tr>
        </thead>
        <tbody>
            <td>{{ $orders->id }}</td>
            <td>{{ $orders->order_number }}</td>
            <td>{{ $orders->user->name }}</td>
        </tbody>
    </table>
    <table class="table table-bordered table-striped text-center">
        <h1 class="text-center">Danh Sách Sản Phẩm</h1>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->status }}</td>
            
               
            </tr>
            @endforeach

            @if ($products->isEmpty())
            <tr>
                <td colspan="4">Không có sản phẩm nào.</td>
            </tr>
            @endif
        </tbody>
    </table>
 
</div>
@endsection