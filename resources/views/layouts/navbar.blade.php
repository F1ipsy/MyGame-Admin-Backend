

<nav class="bg-green-300 border-b-2 border-green-400">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <div class="font-medium flex flex-col p-4 md:p-0 mt-4 rounded-lg md:flex-row md:space-x-4 rtl:space-x-reverse md:mt-0">
                <a href="{{route("home")}}" class="block rounded-lg py-2 px-6 rounded text-white {{request()->routeIs("home") ? "bg-green-600" : "bg-green-500/60"}}">Игры</a>
                <a href="{{route("styles")}}" class="block rounded-lg py-2 px-6 rounded text-white {{request()->routeIs("styles") ? "bg-green-600" : "bg-green-500/60"}}">Стили</a>
            </div>
        </div>
        <a href="{{route("home")}}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{asset("logo.png")}}" class="h-8" alt="Logo" />
        </a>
    </div>
</nav>
