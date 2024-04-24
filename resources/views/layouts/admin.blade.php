@php
function admin($url = '') {
    return '/admin/dashboard/' . $url;
}
@endphp

@include('head')
    <div class="flex h-screen overflow-hidden">
    @include('admin.sidenav')
        <div class="w-full relative flex flex-1 flex-col">
            @include('admin.topnav')
                <main class="px-6 relative overflow-y-auto">

                @yield('main')

                </main>
            @include('admin.footer')
        </div>
    </div>

@stack('scripts')
@prepend('scripts')

    <script>
        const profilePic = document.querySelector('nav #profile');
        const profileOpts = document.querySelector('nav + div');


        function toggleProfileOpts() {
            if (profileOpts.classList.contains("hidden")){
                profileOpts.classList.remove("hidden");
            }
            else {
                profileOpts.classList.add("hidden")
            }
        }

        profilePic?.addEventListener("click", toggleProfileOpts);
    </script>
@endprepend

</body>
</html>
