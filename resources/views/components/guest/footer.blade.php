<footer class="footer w-full mt-auto">
    <div class="bg-gray-700 mx-auto py-6 mt-6">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 min-h-full min-w-[500px] text-white text-sm py-3">
            <div class="px-4 lg:px-6 py-2.5 flex flex-row gap-10 justify-between">
                <div class="min-w-[250px] max-w-[350px] flex flex-col gap-3">
                    <div class="flex gap-2 text-white pb-3 border-b-2 border-dashed border-gray-600">
                        <img src="{{ url('/assets/images/icon/money.png') }}" class="h-5" alt="Money Logo" />
                        <h3 class="font-bold uppercase">{{ config('app.name') }}</h3>
                    </div>
                    <p class="text-sm text-justify">Elevate your gifting and collecting experience with <strong class="font-semibold">{{ config('app.name') }}</strong>. Explore our curated range of fresh, rare banknotes, perfect for any occasion. Enjoy the convenience of online shopping with a focus on authenticity and quality.</p>
                </div>
                <div class="flex items-center">
                    <div class="inline-flex space-x-3 justify-center">
                        <!-- Facebook -->
                        <a href="https://facebook.com" target="_blank"
                           class="flex items-center justify-center w-6 h-6  rounded-full bg-white text-gray-700 hover:bg-blue-600 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f text-xs"></i>
                        </a>

                        <!-- Twitter -->
                        <a href="https://twitter.com" target="_blank"
                           class="flex items-center justify-center w-6 h-6  rounded-full bg-white text-gray-700 hover:bg-blue-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter text-xs"></i>
                        </a>

                        <!-- Instagram -->
                        <a href="https://instagram.com" target="_blank"
                           class="flex items-center justify-center w-6 h-6  rounded-full bg-white text-gray-700 hover:bg-pink-500 hover:text-white transition-colors">
                            <i class="fab fa-instagram text-xs"></i>
                        </a>

                        <!-- LinkedIn -->
                        <a href="https://linkedin.com" target="_blank"
                           class="flex items-center justify-center w-6 h-6  rounded-full bg-white text-gray-700 hover:bg-blue-700 hover:text-white transition-colors">
                            <i class="fab fa-linkedin text-xs"></i>
                        </a>

                        <!-- YouTube -->
                        <a href="https://youtube.com" target="_blank"
                           class="flex items-center justify-center w-6 h-6  rounded-full bg-white text-gray-700 hover:bg-red-600 hover:text-white transition-colors">
                            <i class="fab fa-youtube text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <aside class="bg-gray-800 mx-auto">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 text-center text-white text-sm font-semibold py-3">
            <div class="px-4 lg:px-6 py-2.5 flex flex-row justify-between">
                <p>Copyright © {{ date('Y') }} - All right reserved by {{ config('app.name') }}</p>
                <span>Developed by <a href="https://github.com/naiemofficial" target="_blank" class="text-blue-400 hover:text-blue-300 hover:underline">Naiem</a></span>
            </div>
        </div>
    </aside>
</footer>
