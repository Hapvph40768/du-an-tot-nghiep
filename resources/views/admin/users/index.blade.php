@extends('layout.admin.AdminLayout')

@section('title', 'Quản lý Người dùng')

@section('content-main')
    <div class="top-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <small style="color: #666;">Tổng: {{ $users->total() }} người dùng</small>
        </div>
    </div>

    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.02);">

        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="border-bottom: 2px solid #f0f2f5;">
                    <th style="padding:16px;">ID</th>
                    <th style="padding:16px;">Người dùng</th>
                    <th style="padding:16px;">Vai trò</th>
                    <th style="padding:16px;">Trạng thái</th>
                    <th style="padding:16px;">Email / Phone</th>
                    <th style="padding:16px;">Ngày tạo</th>
                    <th style="padding:16px; text-align:center;">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                    <tr style="border-bottom: 1px solid #f0f2f5;">

                        {{-- ID --}}
                        <td style="padding:16px;">#{{ $user->id }}</td>

                        {{-- User --}}
                        <td style="padding:16px;">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <img src="{{ $user->avatar ?? 'https://via.placeholder.com/40' }}"
                                    style="width:40px; height:40px; border-radius:50%;">
                                <div>
                                    <div style="font-weight:600;">{{ $user->name }}</div>
                                    <small style="color:#999;">ID: {{ $user->id }}</small>
                                </div>
                            </div>
                        </td>

                        {{-- Role --}}
                        <td style="padding:16px;">
                            <span
                                style="
                                padding:4px 10px;
                                border-radius:6px;
                                font-size:12px;
                                font-weight:600;
                                color:white;
                                background:
                                    {{ $user->role === 'admin' ? '#ff4d4f' : ($user->role === 'staff' ? '#faad14' : '#1890ff') }};
                            ">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        {{-- Status --}}
                        <td style="padding:16px;">
                            <span
                                style="
                                padding:4px 10px;
                                border-radius:6px;
                                font-size:12px;
                                font-weight:600;
                                color:white;
                                background:
                                    {{ $user->status === 'active' ? '#52c41a' : '#ff4d4f' }};
                            ">
                                {{ $user->status === 'active' ? 'Hoạt động' : 'Đã chặn' }}
                            </span>
                        </td>

                        {{-- Contact --}}
                        <td style="padding:16px;">
                            {{ $user->email ?? '-' }} <br>
                            <small>{{ $user->phone ?? '-' }}</small>
                        </td>

                        {{-- Created --}}
                        <td style="padding:16px; color:#999;">
                            {{ $user->created_at->diffForHumans() }}
                        </td>

                        {{-- Actions --}}
                        <td style="padding:16px; text-align:center;">

                            {{-- Xem --}}
                            <a href="{{ route('admin.users.show', $user) }}"
                                style="background:#e6f7ff; color:#1890ff; padding:6px 12px; border-radius:6px; font-size:12px; font-weight:600; text-decoration:none; margin-right:6px;">
                                Xem
                            </a>

                            {{-- Toggle status --}}
                            <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                    style="
                                        padding:6px 12px;
                                        border:none;
                                        border-radius:6px;
                                        font-size:12px;
                                        font-weight:600;
                                        cursor:pointer;
                                        background:
                                            {{ $user->status === 'active' ? '#fff1f0' : '#f6ffed' }};
                                        color:
                                            {{ $user->status === 'active' ? '#cf1322' : '#389e0d' }};
                                    ">
                                    {{ $user->status === 'active' ? 'Chặn' : 'Mở' }}
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:32px; text-align:center; color:#999;">
                            Không có người dùng nào
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <div style="margin-top:20px; display:flex; justify-content:center;">
        {{ $users->links() }}
    </div>
@endsection
