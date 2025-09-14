<aside
  :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
  class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0"
>
  <div
    :class="sidebarToggle ? 'justify-center' : 'justify-between'"
    class="flex items-center gap-2 pt-8 sidebar-header pb-7"
  >
    <a href="index.html">
      <h1 class="font-bold text-4xl">TiketKapal</h1>
      <img
        class="logo-icon"
        :class="sidebarToggle ? 'lg:block' : 'hidden'"
        src=""
        alt="Logo"
      />
    </a>
  </div>

  <div
    class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar"
  >
    <!-- Sidebar Menu -->
    <nav x-data="{selected: $persist('{{$page ?? 'dashboard'}}')}">
      <!-- Menu Group -->
      <div>
        <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
          <span
            class="menu-group-title"
            :class="sidebarToggle ? 'lg:hidden' : ''"
          >
            MENU
          </span>

          <svg
            :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
            class="mx-auto fill-current menu-group-icon"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
              fill=""
            />
          </svg>
        </h3>

        <ul class="flex flex-col gap-4 mb-6">

          <!-- Menu Item Dashboard -->
          <li>
            <a
              href="{{ route('admin.dashboard') }}"
              class="menu-item group"
              :class="page === 'dashboard' ? 'menu-item-active' : 'menu-item-inactive'"
            >
              <i :class="[page === 'dashboard' ? 'menu-item-icon-active' : 'menu-item-icon-inactive', 'fa-solid', 'fa-house']" aria-hidden="true"></i>
              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                Dashboard
              </span>
            </a>
          </li>
          <!-- Menu Item Dashboard -->

          <!-- Menu Item Calendar -->
          <li>
            <a
              href="{{ route('ships.index') }}"
              class="menu-item group"
              :class="page === 'ships' ? 'menu-item-active' : 'menu-item-inactive'"
            >
              <i :class="[page === 'ships' ? 'menu-item-icon-active' : 'menu-item-icon-inactive', 'fa-solid', 'fa-ship']" aria-hidden="true"></i>
              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                Kapal
              </span>
            </a>
          </li>
          <!-- Menu Item Calendar -->

          <!-- Menu Item Profile -->
          <li>
            <a
              href="{{ route('rutes.index') }}"
              class="menu-item group"
              :class="page === 'rutes' ? 'menu-item-active' : 'menu-item-inactive'"
            >
              <i :class="[page === 'rutes' ? 'menu-item-icon-active' : 'menu-item-icon-inactive', 'fa-solid', 'fa-road']" aria-hidden="true"></i>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                Rute
              </span>
            </a>
          </li>
          <!-- Menu Item Profile -->

          <!-- Menu Item Profile -->
          <li>
            <a
              href="{{ route('jadwals.index') }}"
              class="menu-item group"
              :class="page === 'jadwals' ? 'menu-item-active' : 'menu-item-inactive'"
            >
              <i :class="[page === 'jadwals' ? 'menu-item-icon-active' : 'menu-item-icon-inactive', 'fa-solid', 'fa-calendar']" aria-hidden="true"></i>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                Jadwal
              </span>
            </a>
          </li>
          <!-- Menu Item Profile -->

          <!-- Menu Item Profile -->
          <li>
            <a
              href="{{ route('bookings.index') }}"
              class="menu-item group"
              :class="page === 'bookings' ? 'menu-item-active' : 'menu-item-inactive'"
            >
              <i :class="[page === 'bookings' ? 'menu-item-icon-active' : 'menu-item-icon-inactive', 'fa-solid', 'fa-cart-shopping']" aria-hidden="true"></i>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                Booking
              </span>
            </a>
          </li>
          <!-- Menu Item Profile -->

          <!-- Menu Item Profile -->
          <li>
            <a
              href="{{ route('payments.index') }}"
              class="menu-item group"
              :class="page === 'payments' ? 'menu-item-active' : 'menu-item-inactive'"
            >
              <i :class="[page === 'payments' ? 'menu-item-icon-active' : 'menu-item-icon-inactive', 'fa-solid', 'fa-money-bill']" aria-hidden="true"></i>

              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                Payment
              </span>
            </a>
          </li>
          <!-- Menu Item Profile -->

          <!-- Menu Item Profile -->
          <li>
            <a
              href="{{ route('user.index') }}"
              class="menu-item group"
              :class="page === 'users' ? 'menu-item-active' : 'menu-item-inactive'"
            >
              <i :class="[page === 'users' ? 'menu-item-icon-active' : 'menu-item-icon-inactive', 'fa-solid', 'fa-users']" aria-hidden="true"></i>
              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                User
              </span>
            </a>
          </li>
          <!-- Menu Item Profile -->

          <!-- Menu Item Profile -->
          <li>
            <a
              href=""
              class="menu-item group"
              :class="page === 'profile' ? 'menu-item-active' : 'menu-item-inactive'"
            >
              <i :class="[page === 'profile' ? 'menu-item-icon-active' : 'menu-item-icon-inactive', 'fa-solid', 'fa-user']" aria-hidden="true"></i>
              <span
                class="menu-item-text"
                :class="sidebarToggle ? 'lg:hidden' : ''"
              >
                Profile
              </span>
            </a>
          </li>
          <!-- Menu Item Profile -->
        </ul>
      </div>
    </nav>
    <!-- Sidebar Menu -->
  </div>
</aside>
