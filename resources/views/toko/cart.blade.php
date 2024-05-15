@auth
<a target="_blank" href="/cart/{id}">
@else
<a href="/login">
@endauth
    <div class="absolute bottom-0 right-8 rounded-full p-4 text-2xl text-gray-500 hover:text-gray-800 bg-white hover:bg-gray-300">
        <div class="mt-1 mr-1">
             <i class="fa-solid fa-cart-shopping"></i>
        </div>
    </div>
</a>
