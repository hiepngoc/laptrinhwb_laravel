@extends('dashboard')

@section('content')
    <div class="container my-5">
        <a href="{{ url()->previous() }}" class="btn btn-secondary m-3">← Quay lại</a>
        <h4 class="text-center mb-4">Danh sách người dùng</h4>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Đơn hàng</th>
                        <th>Vai trò</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr>
                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @forelse ($user->orders as $order)
                                    <a href="{{ route('order', $order->id) }}" class="badge bg-info text-white">
                                        {{ $order->order_number }}
                                    </a>
                                    @if (!$loop->last)
                                        <br>
                                    @endif
                                @empty
                                    <span class="text-muted">Không có</span>
                                @endforelse
                            </td>
                            <td>
                                @forelse ($user->roles as $role)
                                    <a href="{{ route('role', $role->id) }}" class="badge bg-secondary">
                                        {{ $role->name }}
                                    </a>
                                    @if (!$loop->last), @endif
                                @empty
                                    <span class="text-muted">Không có</span>
                                @endforelse
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('user.readUser', ['id' => $user->id]) }}" class="btn btn-sm btn-primary">Xem</a>
                                    <a href="{{ route('user.updateUser', ['id' => $user->id]) }}" class="btn btn-sm btn-warning">Sửa</a>
                                    <form action="{{ route('user.deleteUser', ['id' => $user->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xoá?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Không có người dùng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
