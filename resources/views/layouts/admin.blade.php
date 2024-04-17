@php
function admin($url = '') {
    return '/admin/dashboard' . $url;
}
@endphp

@include('head')
    <div class="flex">
    @include('admin.sidenav')
        <main>

        @yield('main')

        </main>
    </div>
</body>
</html>
