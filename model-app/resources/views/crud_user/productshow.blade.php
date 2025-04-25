@extends('dashboard')

@section('content')
    <div class="container my-5">
        <h4 class="text-center mb-3">Chi tiết sản phẩm</h4>

      @foreach($product as $item)
      <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $item->name }}</h5>
                <img src="{{ $item->image }}" alt="{{ $item->name }}" class="img-fluid">
                <p class="card-text">Giá: {{ $item->price }}</p>
                <p class="card-text">Số lượng: {{ $item->quantity }}</p>
                <p class="card-text">{{ $item->description }}</p>
            </div>
        </div>
      @endforeach
    </div>
@endsection
