@php
    $user = auth()->user();
    $isAdmin = $user ? $user->role === 'admin' : request()->is('admin*');

    if ($isAdmin) {
        $menus = [
            [
                'url'         => url('/admin/dashboard'),
                'active'      => request()->is('admin/dashboard*'),
                'icon'        => 'images/icons/dashboard-1.png',
                'icon_active' => 'images/icons/dashboard-2.png',
                'alt'         => 'Dashboard Admin',
            ],
            [
                'url'         => url('/admin/reports'),
                'active'      => request()->is('admin/reports*', 'admin/payments*'),
                'icon'        => 'images/icons/report-1.png',
                'icon_active' => 'images/icons/report-2.png',
                'alt'         => 'Laporan Keuangan',
            ],
            [
                'url'         => url('/admin/notification'),
                'active'      => request()->is('admin/notification*'),
                'icon'        => 'images/icons/notification-1.png',
                'icon_active' => 'images/icons/notification-2.png',
                'alt'         => 'Notifikasi',
            ],
            [
                'url'         => url('/admin/profile'),
                'active'      => request()->is('admin/profile*'),
                'icon'        => 'images/icons/profile-1.png',
                'icon_active' => 'images/icons/profile-2.png',
                'alt'         => 'Profil Admin',
            ],
        ];
    } else {
        $studentId = $user?->student?->id ?? request()->route('id') ?? $user?->id ?? 1;

        $menus = [
            [
                'url'         => url("/students/{$studentId}"),
                'active'      => request()->is("students/{$studentId}"),
                'icon'        => 'images/icons/dashboard-1.png',
                'icon_active' => 'images/icons/dashboard-2.png',
                'alt'         => 'Dashboard Siswa',
            ],
            [
                'url'         => url("/students/{$studentId}/payments"),
                'active'      => request()->is("students/{$studentId}/payments*"),
                'icon'        => 'images/icons/report-1.png',
                'icon_active' => 'images/icons/report-2.png',
                'alt'         => 'Riwayat Pembayaran',
            ],
            [
                'url'         => url("/students/{$studentId}/notifications"),
                'active'      => request()->is("students/{$studentId}/notifications*"),
                'icon'        => 'images/icons/notification-1.png',
                'icon_active' => 'images/icons/notification-2.png',
                'alt'         => 'Notifikasi Siswa',
            ],
            [
                'url'         => url("/students/{$studentId}/profile"),
                'active'      => request()->is("students/{$studentId}/profile*"),
                'icon'        => 'images/icons/profile-1.png',
                'icon_active' => 'images/icons/profile-2.png',
                'alt'         => 'Profil Siswa',
            ],
        ];
    }
@endphp

<sidebar class="bg-white relative z-10 shadow-lg">
    <div class="mx-auto flex flex-col gap-14 px-4 py-8">
        @foreach ($menus as $menu)
            <a href="{{ $menu['url'] }}" title="{{ $menu['alt'] }}" class="flex items-center transition hover:scale-105">
                <img
                    src="{{ asset($menu['active'] ? $menu['icon_active'] : $menu['icon']) }}"
                    alt="{{ $menu['alt'] }}"
                    class="w-auto h-10"
                >
            </a>
        @endforeach
    </div>
</sidebar>