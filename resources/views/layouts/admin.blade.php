@php
function admin($url = '') {
    return '/admin/dashboard' . $url;
}
@endphp

@include('head')
    <div class="flex h-screen overflow-hidden bg-[#E3E3E3]">
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
<script>
document.addEventListener('DOMContentLoaded', e => {
    const initialWindowHeight = window.innerHeight;
    const main = document.querySelector('main');
    const footer = document.querySelector('footer');
    const header = document.querySelector('header');
    main.style.minHeight = `${initialWindowHeight - (footer.offsetHeight + header.offsetHeight)}px`;
    window.addEventListener('resize', e => {
        main.style.minHeight = `${window.innerHeight - (footer.offsetHeight + header.offsetHeight)}px`;
    });
});
</script>

</body>
</html>
