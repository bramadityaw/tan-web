@include('head')
@include('navbar')

<div class="px-12 py-10 bg-[#1B3C73] text-white lg:flex">
@include('blog.asides.left')

<main class="w-full lg:mx-4">

@yield('main')

</main>

@include('blog.asides.right')
</div>

@include('footer')
@section('scripts')
    <script>
        const token = document.querySelector('input[name="_token"]')?.value;
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
