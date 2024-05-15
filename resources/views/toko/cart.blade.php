@auth
<a target="_blank" href="/cart/{id}">
@else
<a href="/login">
@endauth
    <div class="rounded-full px-2 py-1 mr-4 md:mr-0 text-lg text-gray-500 hover:text-gray-800 bg-white hover:bg-gray-300">
        <div class="pt-1 pr-1">
             <i class="fa-solid fa-cart-shopping"></i>
        </div>
        <span class="absolute ml-[1.25rem] mt-[-.75rem] rounded-full px-1 text-xs text-white bg-orange-600">1</span>
    </div>
</a>
