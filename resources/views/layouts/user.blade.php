@include('head')
@include('navbar')
<main>

@yield('main')

@include('footer')
@section('scripts')
    <script>
        const token = document.querySelector('input[name="_token"]').value;
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
