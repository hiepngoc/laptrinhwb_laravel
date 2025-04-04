
@extends('dashboard')

@section('content')
   

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card p-4 shadow-sm" style="width: 400px;">
            <h4 class="text-center mb-3">Màn hình đăng ký</h4>

            <form method="POST" action="{{ route('user.postUser') }}">
                @csrf

                <div class="mb-3">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Tên" required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Số đt" required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="Địa chỉ" required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Upload Avatar -->
    <div class="mb-3">
        <label for="avatar" class="form-label">Ảnh đại diện</label>
        <input type="file" class="form-control" name="avatar" accept="image/*">
        @error('avatar')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
     <!-- Ô nhập URL bất kỳ -->
     <div class="mb-3">
                    <input type="url" class="form-control" name="website" value="{{ old('website') }}" placeholder="Nhập URL trang web">
                    @error('website')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Đăng ký</button>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">Đã có tài khoản</a>
                </div>
            </form>
        </div>
    </div>
@endsection
