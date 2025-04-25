<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách địa điểm</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo-info">
            <img src="{{ asset('images/logo.png') }}" alt="Discovery Logo">
            <div>
                <p>39 Nguyễn Huệ, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh</p>
                <p>0924 242 424 | discovery@mailtour.com</p>
            </div>
        </div>
        <div class="nav-links">
            <a href="{{ route('home') }}">Trang chủ</a>
            <a href="#">Giới thiệu</a>
            <a href="#">Dịch vụ</a>
            <a href="{{ route('admin.tours.list') }}">Tours</a>
            <a href="{{ route('admin.locations.list') }}">Địa điểm</a>
            <a href="#">Danh mục</a>
            <a href="#">Liên hệ</a>
        </div>
        <div class="auth-buttons">
            @auth
                <span>{{ Auth::user()->name }}</span>
                <a href="{{ route('logout') }}">Đăng xuất</a>
            @else
                <a href="{{ route('login') }}">Đăng nhập</a>
                <a href="{{ route('register') }}">Đăng ký</a>
            @endauth
        </div>
    </header>
    <div class="container">
        <h1>Danh sách địa điểm</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên địa điểm</th>
                    <th>Hình ảnh</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($locations as $location)
                    <tr>
                        <td>{{ $location->id }}</td>
                        <td>{{ $location->location_name }}</td>
                        <td>
                            @if($location->location_image)
                                <img src="{{ asset('storage/' . $location->location_image) }}" alt="{{ $location->location_name }}" width="50">
                            @else
                                Không có hình ảnh
                            @endif
                        </td>
                        <td>{{ $location->created_at }}</td>
                        <td>{{ $location->updated_at }}</td>
                        <td>
                            <a href="#">Sửa</a> | <a href="#">Xóa</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">Không có địa điểm nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <footer>
        <div style="text-align: center; padding: 1rem; background-color: #f0f0f0; color: #718096; font-size: 0.9rem;">
            &copy; {{ date('Y') }} Discovery. All rights reserved.
        </div>
    </footer>
</body>
</html>