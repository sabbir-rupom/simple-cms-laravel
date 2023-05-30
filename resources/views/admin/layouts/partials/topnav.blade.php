<nav class="navbar-top">
  <div class="flex flex-wrap justify-between items-center">
    <div class="flex justify-start items-center">
      <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
        aria-controls="drawer-navigation" class="sidebar-drawer">
        <i class="far fa-bars w-6 h-6"></i>
        <span class="sr-only">Toggle sidebar</span>
      </button>
      <a href="#" class="logo">
        <img src="https://flowbite.s3.amazonaws.com/logo.svg" class="logo-image" alt="Flowbite Logo" />
        <span class="logo-title">Flowbite</span>
      </a>
      {{-- <form action="#" method="GET" class="hidden md:block md:pl-2">
        <label for="topbar-search" class="sr-only">Search</label>
        <div class="relative md:w-64 md:w-96">
          <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z">
              </path>
            </svg>
          </div>
          <input type="text" name="email" id="topbar-search"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Search" />
        </div>
      </form> --}}
    </div>
    <div class="flex items-center lg:order-2">
      {{-- <button type="button" data-drawer-toggle="drawer-navigation" aria-controls="drawer-navigation"
        class="p-2 mr-1 text-gray-500 rounded-lg md:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
        <span class="sr-only">Toggle search</span>
        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path clip-rule="evenodd" fill-rule="evenodd"
            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z">
          </path>
        </svg>
      </button> --}}

      <!-- Notifications -->
      @include('admin.layouts.partials.include.notification')

      <!-- Apps -->
      @include('admin.layouts.partials.include.appbar')

      <button type="button"
        class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full"
          src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gough.png" alt="user photo" />
      </button>
      <!-- Dropdown menu -->
      <div
        class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
        id="dropdown">
        <div class="py-3 px-4">
          <span class="block text-sm font-semibold text-gray-900 dark:text-white">Neil Sims</span>
          <span class="block text-sm text-gray-900 truncate dark:text-white">name@flowbite.com</span>
        </div>
        <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
          <li>
            <a href="#"
              class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">My
              profile</a>
          </li>
          <li>
            <a href="#"
              class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Account
              settings</a>
          </li>
        </ul>
        <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
          <li>
            <a href="#"
              class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign
              out</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
