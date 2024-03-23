@include('head')
@include('navbar')
<main>
    <div class="bg-[#1b3c73] py-[20%] md:py-[5%]">
        <div class="w-4/5 md:w-3/5 mx-auto flex">
            <div class="hidden xl:block w-1/2">
                <iframe class="block h-full w-full rounded-l-lg" src="https://www.google.com/maps/embed?pb=!3m2!1sen!2sid!4v1710517244600!5m2!1sen!2sid!6m8!1m7!1sNjqBboXshLNCSfke1ckfmg!2m2!1d-3.758614774602069!2d103.8050211687837!3f80.54837276759902!4f-4.671756631575164!5f0.7820865974627469" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="rounded-lg xl:rounded-none xl:rounded-r-lg bg-white p-6 w-full xl:w-1/2">
                <h1 class="text-xl text-center">Buat Akun</h1>
                <form action="" method="post">
                    <div class="flex-col p-2">
                        <label for="name">Nama Lengkap:</label>
                        <input class="block w-full my-2 p-2 border-2 border-gray-200 rounded-md" id="name" name="name" type="text" placeholder="Masukkan nama lengkap Anda">
                        <label for="email">Email:</label>
                        <input class="block w-full my-2 p-2 border-2 border-gray-200 rounded-md" id="email" name="email" type="email" placeholder="Masukkan e-mail Anda">
                        <label for="password">Password:</label>
                        <input class="block w-full my-2 p-2 border-2 border-gray-200 rounded-md" id="password" name="password" type="password" placeholder="Masukkan kata sandi akun"><label for="password">Ulangi Password:</label>
                        <input class="block w-full my-2 p-2 border-2 border-gray-200 rounded-md" id="password" name="password" type="password" placeholder="Masukkan ulang kata sandi di atas">

                        <p>Sudah mempunyai akun? <a class="text-blue-500 underline" href="/login">Masuk akun</a></p>
                        <div class="flex justify-end">
                           <button class="bg-[#1b3c73] rounded-md my-4 py-2 px-3 text-white" type="submit">DAFTAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@include('footer')
