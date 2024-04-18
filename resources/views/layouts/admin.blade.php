@php
function admin($url = '') {
    return '/admin/dashboard/' . $url;
}
@endphp

@include('head')
    <div class="flex">
    @include('admin.sidenav')
        <div class="w-full">
            @include('admin.topnav')
                <main class="px-6">

                @yield('main')

                </main>
        </div>
    </div>
@section('scripts')
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
@show

</body>
</html>
