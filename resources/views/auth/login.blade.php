@include('head')
@include('navbar')
<main>
    <div class="bg-[#1b3c73] py-[20%] md:py-[5%]">
        <div class="w-4/5 md:w-3/5 mx-auto flex">
             <div class="swiper hidden xl:block rounded-l-lg w-1/2">
                  <div class="swiper-wrapper">
                      <div class="swiper-slide">
                          <img class="h-full object-cover" src="/images/koki_redcap.jpg" alt="">
                      </div>
                      <div class="swiper-slide">
                          <img class="h-full object-cover" src="/images/komet.jpg" alt="">
                      </div>
                      <div class="swiper-slide">
                          <img class="h-full object-cover" src="/images/koi.jpg" alt="">
                      </div>
                  </div>
             </div>
             <div class="rounded-lg xl:rounded-none xl:rounded-r-lg bg-white p-6 w-full xl:w-1/2">
                 <h1 class="text-xl text-center">Masuk Akun</h1>
                 <form action="" method="post">
                     <div class="flex-col">
                         <label for="email">Email:</label>
                            <input class="block w-full my-2 p-2 border-2 border-gray-200 rounded-md" id="email" name="email" type="email" placeholder="Masukkan e-mail Anda">
                         <label for="password">Password:</label>
                            <input class="block w-full my-2 p-2 border-2 border-gray-200 rounded-md" id="password" name="password" type="password" placeholder="Masukkan kata sandi akun">
                         <p>Belum mempunyai akun? <a class="text-blue-500 underline" href="/register">Buat akun</a></p>
                         <div class="flex justify-end">
                            <button class="bg-[#1b3c73] rounded-md my-4 py-2 px-3 text-white" type="submit">MASUK</button>
                         </div>
                     </div>
                 </form>
             </div>
        </div>
    </div>
</main>
@include('partials.swiperjs')
@include('footer')
