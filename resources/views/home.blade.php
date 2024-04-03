@include("head")
<body>
    <style>
        .swiper {
            width: 80%;
            max-width: 1280px;
            z-index: 0;
            margin-left: auto;
            margin-right: auto;
        }

        .swiper * {
            z-index: 0;
        }

        .swiper-slide h1 {
            font-size: 3em;
        }

        .swiper-slide img {
            aspect-ratio: 1280/720;
        }

        .swiper-button-next::after, .swiper-button-prev::after {
            content: "";
        }

        .swiper-button-next svg, .swiper-button-prev svg {
            aspect-ratio: 1;
        }


        .swiper-button-next, .swiper-button-prev {
            height: 8%;
            width: 8%;
        }
    </style>
    @include("navbar")
    <main>
        <section class="lg:flex justify-between mx-auto my-10 w-[80%]">
            <!--Slider-->
            <div class="swiper mx-0">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach ($products as $product)
                        <div class="swiper-slide">
                            <img src="{{ $product["src"] }}" alt="">
                            <div class="absolute bottom-0 w-full px-16 pb-8 text-white bg-gradient-to-t from-black">
                                <h1>{{ $product["name"] }}</h1>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-button-prev">
                    <svg width="63" height="67" viewBox="0 0 63 67" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M31.75 3.19019C15.8738 3.19019 3 16.7521 3 33.4842C3 50.213 15.8738 63.7782 31.75 63.7782C47.6262 63.7782 60.5 50.213 60.5 33.4842C60.5 16.7521 47.6262 3.19019 31.75 3.19019Z" stroke="white" stroke-width="4.66216" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M36.2329 22.116L25.398 33.4836L36.2329 44.8512" stroke="white" stroke-width="4.66216" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="swiper-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="67" viewBox="0 0 64 67" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M32 64.3049C48.0143 64.3049 61 50.6251 61 33.7475C61 16.8732 48.0143 3.19012 32 3.19012C15.9857 3.19012 3 16.8732 3 33.7475C3 50.6251 15.9857 64.3049 32 64.3049Z" stroke="white" stroke-width="4.7027" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M27.4773 45.2144L38.4064 33.7479L27.4773 22.2814" stroke="white" stroke-width="4.7027" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="absolute bottom-0 right-0">
                    <a class="block bg-[#1B3C73] rounded-md font-semibold text-white text-center text-md px-4 py-3 mb-10 mr-20" href="/toko">
                        Beli Sekarang
                    </a>
                </div>
            </div>
        </section>

        <section class="py-11 px-[15%] bg-[#1b3c73] text-white">
            <h1 class="text-center h-[50px] text-3xl font-semibold border-b-[1px] border-b-white">Profil Tan Aquatic</h1>
            <div class="sm:flex justify-around">
                <div class="m-9">
                    <img class="aspect-square w-[128px] m-auto" src="/images/tan.png" alt="Foto pemilik Tan Aquatic, M. Ferdiansyah Tandianus">
                    <p class="text-center">M. Ferdiansyah Tandianus <br/> (Pemilik)</p>
                </div>
                <div class="sm:w-[60%] mt-9">
                    <p>Tan Aquatic adalah toko ikan hias air tawar yang dimiliki oleh Ferdiansyah Tandianus, seorang pemuda asli Tanjung Enim. Selain ikan hias air tawar, Tan Aquatic juga menjual perlengkapan aquarium dan aquascape.</p>
                    <p>Berawal dari kecintaannya terhadap hewan peliharaan, usaha ini berkembang dari hobi menjadi sebuah usaha rumahan yang cukup dikenal di Tanjung, diberi nama sesuai dengan suku kata pertama dari nama belakangnya.</p>
                </div>
            </div>
        </section>
        <section class="pb-11 px-[15%] bg-[#1b3c73] text-white">
           <h1 class="text-center h-[50px] text-3xl font-semibold border-b-[1px] border-b-white">Kunjungi Tan Aquatic</h1>
           <div class="sm:flex justify-around">
              <div class="sm:w-[60%] mt-9">
                  <div class="flex mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 22 22" fill="none">
                            <path d="M18.3605 6.21113C17.9561 5.27845 17.3729 4.43399 16.6439 3.72539C15.9126 3.01039 15.0504 2.4429 14.1045 2.05391C13.1205 1.6457 12.0764 1.43945 11 1.43945C9.92363 1.43945 8.87949 1.6457 7.89551 2.05176C6.94375 2.44492 6.09082 3.00781 5.35605 3.72324C4.62757 4.43224 4.04447 5.2766 3.63945 6.20898C3.22051 7.17578 3.00781 8.20273 3.00781 9.25977C3.00781 10.7766 3.3709 12.2869 4.08418 13.7436C4.65781 14.9145 5.45918 16.0553 6.46895 17.1402C8.19414 18.9922 10.0031 20.1244 10.5166 20.4273C10.6624 20.5134 10.8286 20.5587 10.9979 20.5584C11.1654 20.5584 11.3309 20.5154 11.4791 20.4273C11.9926 20.1244 13.8016 18.9922 15.5268 17.1402C16.5365 16.0574 17.3379 14.9145 17.9115 13.7436C18.6291 12.2891 18.9922 10.7809 18.9922 9.26191C18.9922 8.20488 18.7795 7.17793 18.3605 6.21113ZM11 18.9105C9.58418 18.0104 4.55469 14.4461 4.55469 9.26191C4.55469 7.58828 5.22285 6.01563 6.43672 4.82969C7.65488 3.6416 9.2748 2.98633 11 2.98633C12.7252 2.98633 14.3451 3.6416 15.5633 4.83184C16.7771 6.01562 17.4453 7.58828 17.4453 9.26191C17.4453 14.4461 12.4158 18.0104 11 18.9105ZM11 5.65039C8.91172 5.65039 7.21875 7.34336 7.21875 9.43164C7.21875 11.5199 8.91172 13.2129 11 13.2129C13.0883 13.2129 14.7812 11.5199 14.7812 9.43164C14.7812 7.34336 13.0883 5.65039 11 5.65039ZM12.7016 11.1332C12.4784 11.357 12.2132 11.5345 11.9211 11.6554C11.6291 11.7764 11.3161 11.8384 11 11.8379C10.3576 11.8379 9.75391 11.5865 9.29844 11.1332C9.07462 10.91 8.89714 10.6448 8.7762 10.3528C8.65526 10.0608 8.59326 9.74771 8.59375 9.43164C8.59375 8.78926 8.84512 8.18555 9.29844 7.73008C9.75391 7.27461 10.3576 7.02539 11 7.02539C11.6424 7.02539 12.2461 7.27461 12.7016 7.73008C13.157 8.18555 13.4062 8.78926 13.4062 9.43164C13.4062 10.074 13.157 10.6777 12.7016 11.1332Z" fill="white"/>
                        </svg>
                        <a class="block ml-4 w-[90%] text-balance" href="https://maps.app.goo.gl/igL3pTLTUekftqhb9">Jl. Baturaja no. 650, Tanjung Buhuk, Tanjung Enim, Kabupaten Muara Enim, Provinsi Sumatera Selatan</a>
                    </div>
                    <h4>Jam Buka:</h4>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 23 23" fill="none">
                            <path d="M11.5 1.4375C5.94316 1.4375 1.4375 5.94316 1.4375 11.5C1.4375 17.0568 5.94316 21.5625 11.5 21.5625C17.0568 21.5625 21.5625 17.0568 21.5625 11.5C21.5625 5.94316 17.0568 1.4375 11.5 1.4375ZM11.5 19.8555C6.88652 19.8555 3.14453 16.1135 3.14453 11.5C3.14453 6.88652 6.88652 3.14453 11.5 3.14453C16.1135 3.14453 19.8555 6.88652 19.8555 11.5C19.8555 16.1135 16.1135 19.8555 11.5 19.8555Z" fill="white"/>
                            <path d="M15.4239 14.3436L12.221 12.0278V6.46875C12.221 6.36992 12.1401 6.28906 12.0413 6.28906H10.9609C10.8621 6.28906 10.7812 6.36992 10.7812 6.46875V12.6545C10.7812 12.7129 10.8082 12.7668 10.8554 12.8005L14.5704 15.5093C14.6513 15.5677 14.7636 15.5497 14.822 15.4711L15.4644 14.5951C15.5228 14.512 15.5048 14.3997 15.4239 14.3436Z" fill="white"/>
                        </svg>
                        <p class="block ml-4 w-[90%] text-2xl">09.00-21.00 WIB</p>
                    </div>

               </div>
               <div class="m-9 mr-0">
                   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.2374267719338!2d103.80543709999999!3d-3.758419!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e39f185bd2f6ab3%3A0xa5299171edf97a05!2sTan%20Aquatic!5e0!3m2!1sen!2sid!4v1710311797638!5m2!1sen!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
               </div>

           </div>
       </section>
    </main>
    @include("partials.scripts.swiperjs")
@include("footer")

