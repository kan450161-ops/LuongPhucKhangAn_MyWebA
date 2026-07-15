<!-- {{-- Hiển thị tất cả lỗi Validation --}} -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Hiển thị lỗi từ session flash --}}
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('message') || session('status'))
    <div class="alert alert-danger">
        {{ session('message') ?? session('status') }}
    </div>
@endif