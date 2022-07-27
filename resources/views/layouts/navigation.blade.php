<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 ">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- ユーザーでログインしている場合 -->
            @can('user-higher')
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('products')" :active="request()->routeIs('products')" class="text-xl hover:no-underline">
                        {{ __('SHOP A') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->            
            <div class="hidden sm:flex sm:items-center sm:ml-6 ">
                <a class="px-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-300" href="{{ route('cart.index') }}">Cart</a>
                <a class="px-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-300" href="{{ route('contact.add') }}">Contact</a>
        
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="px-4 flex items-center font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>My page</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <!-- History -->
                        <x-dropdown-link :href="route('order.history')" class="hover:no-underline">
                            {{ __('History') }}
                        </x-dropdown-link>
                        <!-- Edit -->
                        <x-dropdown-link :href="route('user.edit')" class="hover:no-underline">
                            {{ __('Edit') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>


    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('products')" :active="request()->routeIs('products')">
                {{ __('SHOP A') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('cart.index')">
                        {{ __('Cart') }}
                    </x-responsive-nav-link>
            </div>
            <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('contact.add')">
                        {{ __('Contact') }}
                    </x-responsive-nav-link>
            </div>

            <div class="mt-3 space-y-1">
                <!-- 要変更 -->
                    <x-responsive-nav-link :href="route('order.history')">
                        {{ __('History') }}
                    </x-responsive-nav-link>
            </div>
            <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('user.edit')">
                        {{ __('Edit') }}
                    </x-responsive-nav-link>
            </div>
            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

            <!-- 管理者でログインしている場合 -->
            @elsecan('admin-higher')
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('admin')" :active="request()->routeIs('admin')" class="text-xl hover:no-underline">
                        {{ __('SHOP A') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->            
            <div class="hidden sm:flex sm:items-center sm:ml-6 ">
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="px-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-300" :href = "route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>            
            </form>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin')" :active="request()->routeIs('admin')">
                {{ __('SHOP A') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('order.index')">
                        {{ __('Order List') }}
                    </x-responsive-nav-link>
            </div>
            <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('contact.index')">
                        {{ __('Contact') }}
                    </x-responsive-nav-link>
            </div>

            <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('index')">
                        {{ __('Products') }}
                    </x-responsive-nav-link>
            </div>
            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

            <!-- ログインしていない場合 -->
            @else
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('products')" :active="request()->routeIs('products')" class="text-xl hover:no-underline">
                        {{ __('SHOP A') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->            
            <div class="hidden sm:flex sm:items-center sm:ml-6 ">
                <a href="{{ route('login') }}" class="px-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-300">Log in</a>
                <a href="{{ route('register') }}" class="px-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-300">Register</a>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('products')" :active="request()->routeIs('products')">
                        {{ __('SHOP A') }}
                    </x-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('login')">
                                {{ __('Log In') }}
                            </x-responsive-nav-link>
                    </div>
                    <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('register')">
                                {{ __('Register') }}
                            </x-responsive-nav-link>
                    </div>
                </div>
            </div>
            @endcan

        </div>
    </div>

</nav>
