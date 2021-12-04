<header>
    <nav class="bg-white flex justify-between p-6 mx-48">
        <ul class="flex items-center">
            <li>
                <a href="/" class="p-3 pr-6 font-lobster text-2xl text-yellow-600 hover:text-yellow-700">Best-Recipes</a>
            </li>
            <li>
                <a href="/recipes" class="p-3">Receptek</a>
            </li>
            <li>
                <a href="/posts" class="p-3">Blog</a>
            </li>
        </ul>

        <ul class="flex items-center">
            @auth
                <li class="mr-6 nav-item dropdown">
                    {{ auth()->user()->name }}
                </li>
                <li class="mr-6">

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="p-3 border border-yellow-600 hover:border-yellow-700 hover:bg-yellow-700 hover:text-white rounded-full text-yellow-600">Kijelentkezés</button>
                    </form>
                </li>
            @endauth

            @guest
                <li class="mr-6">
                    <a href="/login" class="p-3 border border-yellow-600 hover:border-yellow-700 hover:bg-yellow-700 hover:text-white rounded-full text-yellow-600">Belépés</a>
                </li>
                <li>
                    <a href="/register" class="p-3 border border-yellow-600 bg-yellow-600 rounded-full text-white hover:border-yellow-700 hover:bg-yellow-700">Regisztráció</a>
                </li>
            @endguest

        </ul>
    </nav>
</header>
