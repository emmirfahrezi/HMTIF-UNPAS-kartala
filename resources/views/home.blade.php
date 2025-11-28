<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Home</title>
    @vite('resources/css/app.css')
  </head>

  <body>
    <header
      id="navbar"
      class="fixed top-0 left-0 w-full z-50 transition-all duration-300 bg-transparent"
    >
      <nav
        aria-label="Global"
        class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8"
      >
        <div class="flex lg:flex-1">
          <a href="#" class="flex items-center gap-2">
            <img
              src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
              alt=""
              class="h-8 w-auto"
            />
            <h1 class="font-bold text-white">HMTIF-UNPAS</h1>
          </a>
        </div>

        <div class="flex lg:hidden">
          <button
            type="button"
            command="show-modal"
            commandfor="mobile-menu"
            class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
          >
            <span class="sr-only">Open main menu</span>
            <svg
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="1.5"
              data-slot="icon"
              aria-hidden="true"
              class="size-6"
            >
              <path
                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </button>
        </div>

        <el-popover-group class="hidden lg:flex lg:gap-x-12">
          <a href="#" class="text-sm/6 font-semibold text-white">Features</a>
          <a href="#" class="text-sm/6 font-semibold text-white">Marketplace</a>
          <a href="#" class="text-sm/6 font-semibold text-white">Company</a>
          <div class="relative">
            <button
              popovertarget="desktop-menu-product"
              class="flex items-center gap-x-1 text-sm/6 font-semibold text-white"
            >
              Product
              <svg
                viewBox="0 0 20 20"
                fill="currentColor"
                data-slot="icon"
                aria-hidden="true"
                class="size-5 flex-none text-gray-400"
              >
                <path
                  d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                  clip-rule="evenodd"
                  fill-rule="evenodd"
                />
              </svg>
            </button>

            <el-popover
              id="desktop-menu-product"
              anchor="bottom"
              popover
              class="w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg outline-1 outline-gray-900/5 transition transition-discrete [--anchor-gap:--spacing(3)] backdrop:bg-transparent open:block data-closed:translate-y-1 data-closed:opacity-0 data-enter:duration-200 data-enter:ease-out data-leave:duration-150 data-leave:ease-in"
            >
              <div class="p-4">
                <div
                  class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50"
                >
                  <div
                    class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white"
                  >
                    <svg
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.5"
                      data-slot="icon"
                      aria-hidden="true"
                      class="size-6 text-gray-600 group-hover:text-indigo-600"
                    >
                      <path
                        d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                  <div class="flex-auto">
                    <a href="#" class="block font-semibold text-gray-900">
                      Analytics
                      <span class="absolute inset-0"></span>
                    </a>
                    <p class="mt-1 text-gray-600">
                      Get a better understanding of your traffic
                    </p>
                  </div>
                </div>
                <div
                  class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50"
                >
                  <div
                    class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white"
                  >
                    <svg
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.5"
                      data-slot="icon"
                      aria-hidden="true"
                      class="size-6 text-gray-600 group-hover:text-indigo-600"
                    >
                      <path
                        d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                  <div class="flex-auto">
                    <a href="#" class="block font-semibold text-gray-900">
                      Engagement
                      <span class="absolute inset-0"></span>
                    </a>
                    <p class="mt-1 text-gray-600">
                      Speak directly to your customers
                    </p>
                  </div>
                </div>
                <div
                  class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50"
                >
                  <div
                    class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white"
                  >
                    <svg
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.5"
                      data-slot="icon"
                      aria-hidden="true"
                      class="size-6 text-gray-600 group-hover:text-indigo-600"
                    >
                      <path
                        d="M7.864 4.243A7.5 7.5 0 0 1 19.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 0 0 4.5 10.5a7.464 7.464 0 0 1-1.15 3.993m1.989 3.559A11.209 11.209 0 0 0 8.25 10.5a3.75 3.75 0 1 1 7.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 0 1-3.6 9.75m6.633-4.596a18.666 18.666 0 0 1-2.485 5.33"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                  <div class="flex-auto">
                    <a href="#" class="block font-semibold text-gray-900">
                      Security
                      <span class="absolute inset-0"></span>
                    </a>
                    <p class="mt-1 text-gray-600">
                      Your customers’ data will be safe and secure
                    </p>
                  </div>
                </div>
                <div
                  class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50"
                >
                  <div
                    class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white"
                  >
                    <svg
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.5"
                      data-slot="icon"
                      aria-hidden="true"
                      class="size-6 text-gray-600 group-hover:text-indigo-600"
                    >
                      <path
                        d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                  <div class="flex-auto">
                    <a href="#" class="block font-semibold text-gray-900">
                      Integrations
                      <span class="absolute inset-0"></span>
                    </a>
                    <p class="mt-1 text-gray-600">
                      Connect with third-party tools
                    </p>
                  </div>
                </div>
                <div
                  class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50"
                >
                  <div
                    class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white"
                  >
                    <svg
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.5"
                      data-slot="icon"
                      aria-hidden="true"
                      class="size-6 text-gray-600 group-hover:text-indigo-600"
                    >
                      <path
                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                  <div class="flex-auto">
                    <a href="#" class="block font-semibold text-gray-900">
                      Automations
                      <span class="absolute inset-0"></span>
                    </a>
                    <p class="mt-1 text-gray-600">
                      Build strategic funnels that will convert
                    </p>
                  </div>
                </div>
              </div>
              <div
                class="grid grid-cols-2 divide-x divide-gray-900/5 bg-gray-50"
              >
                <a
                  href="#"
                  class="flex items-center justify-center gap-x-2.5 p-3 text-sm/6 font-semibold text-gray-900 hover:bg-gray-100"
                >
                  <svg
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    data-slot="icon"
                    aria-hidden="true"
                    class="size-5 flex-none text-gray-400"
                  >
                    <path
                      d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm6.39-2.908a.75.75 0 0 1 .766.027l3.5 2.25a.75.75 0 0 1 0 1.262l-3.5 2.25A.75.75 0 0 1 8 12.25v-4.5a.75.75 0 0 1 .39-.658Z"
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                    />
                  </svg>
                  Watch demo
                </a>
                <a
                  href="#"
                  class="flex items-center justify-center gap-x-2.5 p-3 text-sm/6 font-semibold text-gray-900 hover:bg-gray-100"
                >
                  <svg
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    data-slot="icon"
                    aria-hidden="true"
                    class="size-5 flex-none text-gray-400"
                  >
                    <path
                      d="M2 3.5A1.5 1.5 0 0 1 3.5 2h1.148a1.5 1.5 0 0 1 1.465 1.175l.716 3.223a1.5 1.5 0 0 1-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 0 6.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 0 1 1.767-1.052l3.223.716A1.5 1.5 0 0 1 18 15.352V16.5a1.5 1.5 0 0 1-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 0 1 2.43 8.326 13.019 13.019 0 0 1 2 5V3.5Z"
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                    />
                  </svg>
                  Contact sales
                </a>
              </div>
            </el-popover>
          </div>
        </el-popover-group>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
          <a href="#" class="text-sm/6 font-semibold text-white">
            Log in
            <span aria-hidden="true">&rarr;</span>
          </a>
        </div>
      </nav>
      <el-dialog>
        <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
          <div tabindex="0" class="fixed inset-0 focus:outline-none">
            <el-dialog-panel
              class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
            >
              <div class="flex items-center justify-between">
                <a href="#" class="-m-1.5 p-1.5">
                  <span class="sr-only">Your Company</span>
                  <img
                    src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                    alt=""
                    class="h-8 w-auto"
                  />
                </a>
                <button
                  type="button"
                  command="close"
                  commandfor="mobile-menu"
                  class="-m-2.5 rounded-md p-2.5 text-gray-700"
                >
                  <span class="sr-only">Close menu</span>
                  <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    data-slot="icon"
                    aria-hidden="true"
                    class="size-6"
                  >
                    <path
                      d="M6 18 18 6M6 6l12 12"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                </button>
              </div>
              <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                  <div class="space-y-2 py-6">
                    <div class="-mx-3">
                      <button
                        type="button"
                        command="--toggle"
                        commandfor="products"
                        class="flex w-full items-center justify-between rounded-lg py-2 pr-3.5 pl-3 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                      >
                        Product
                        <svg
                          viewBox="0 0 20 20"
                          fill="currentColor"
                          data-slot="icon"
                          aria-hidden="true"
                          class="size-5 flex-none in-aria-expanded:rotate-180"
                        >
                          <path
                            d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd"
                            fill-rule="evenodd"
                          />
                        </svg>
                      </button>
                      <el-disclosure
                        id="products"
                        hidden
                        class="mt-2 block space-y-2"
                      >
                        <a
                          href="#"
                          class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50"
                        >
                          Analytics
                        </a>
                        <a
                          href="#"
                          class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50"
                        >
                          Engagement
                        </a>
                        <a
                          href="#"
                          class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50"
                        >
                          Security
                        </a>
                        <a
                          href="#"
                          class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50"
                        >
                          Integrations
                        </a>
                        <a
                          href="#"
                          class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50"
                        >
                          Automations
                        </a>
                        <a
                          href="#"
                          class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50"
                        >
                          Watch demo
                        </a>
                        <a
                          href="#"
                          class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50"
                        >
                          Contact sales
                        </a>
                      </el-disclosure>
                    </div>
                    <a
                      href="#"
                      class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                    >
                      Features
                    </a>
                    <a
                      href="#"
                      class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                    >
                      Marketplace
                    </a>
                    <a
                      href="#"
                      class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                    >
                      Company
                    </a>
                  </div>
                  <div class="py-6">
                    <a
                      href="#"
                      class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold !text-white hover:bg-gray-50"
                    >
                      Log in
                    </a>
                  </div>
                </div>
              </div>
            </el-dialog-panel>
          </div>
        </dialog>
      </el-dialog>
    </header>

    <!-- Hero section -->

    <div
      class="relative isolate px-6 pt-14 mt-0 lg:px-8 min-h-screen flex items-center bg-[url('https://images.unsplash.com/photo-1503264116251-35a269479413')] bg-cover bg-center bg-no-repeat z-0"
    >
      <div class="absolute inset-0 bg-black/40 z-0"></div>
      <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56 z-20">
        <div class="text-center">
          <h1
            class="text-5xl font-semibold tracking-tight text-balance text-white sm:text-7xl"
          >
            Data to enrich your online business
          </h1>
          <p
            class="mt-8 text-lg font-medium text-pretty text-white sm:text-xl/8"
          >
            Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui
            lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat.
          </p>
        </div>
      </div>
    </div>

    <!-- about HMTIF -->
    <div class="h-[650px] flex items-center justify-center p-5">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-[950px] h-[400px]">
        <!-- BAGIAN KIRI (BACKGROUND FOTO BESAR) -->
        <div
          id="bigPhoto"
          class="grid place-items-center bg-center bg-cover transition-all duration-500"
          style="
            background-image: url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=60');
          "
        >
          <div class="grid grid-cols-3 gap-4 w-fit">
            <!-- Foto Kecil 1 -->
            <div
              class="swap-box bg-white p-3 w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center rounded-lg cursor-pointer transform transition duration-300 hover:scale-105"
              data-img="https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixlib=rb-4.0.3&q=80&w=600"
            >
              <img
                src="https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixlib=rb-4.0.3&q=80&w=600"
                class="w-full h-full object-cover rounded-md"
              />
            </div>

            <!-- Foto Kecil 2 -->
            <div
              class="swap-box bg-white p-3 w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center rounded-lg cursor-pointer transform transition duration-300 hover:scale-105"
              data-img="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&q=80&w=600"
            >
              <img
                src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&q=80&w=600"
                class="w-full h-full object-cover rounded-md"
              />
            </div>

            <!-- Foto Kecil 3 -->
            <div
              class="swap-box bg-white p-3 w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center rounded-lg cursor-pointer transform transition duration-300 hover:scale-105"
              data-img="https://images.unsplash.com/photo-1519681393784-d120267933ba?ixlib=rb-4.0.3&q=80&w=600"
            >
              <img
                src="https://images.unsplash.com/photo-1519681393784-d120267933ba?ixlib=rb-4.0.3&q=80&w=600"
                class="w-full h-full object-cover rounded-md"
              />
            </div>
          </div>
        </div>

        <!-- BAGIAN ABOUT HMTIF -->
        <div
          class="flex flex-col items-center justify-center text-center text-3xl font-bold space-y-4"
        >
          <h1>ABOUT HMTIF</h1>
          <p class="text-base font-normal max-w-xl">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum
            dolor sit amet consectetur, adipisicing elit. Natus laboriosam,
            labore officiis illo tempora voluptatum molestias neque at ea
            repellendus.
          </p>
        </div>
      </div>
    </div>

    <!-- ABOUT KABINET -->
    <div
      class="min-h-[550px] flex flex-col items-center justify-center bg-gray-100 px-4 py-10"
    >
      <!-- JUDUL SECTION -->
      <h1 class="text-3xl md:text-4xl font-bold mb-8 text-center">
        ABOUT KABINET
      </h1>

      <!-- GRID SECTION -->
      <div
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-6xl"
      >
        <!-- Box 1 -->
        <div class="flex flex-col gap-6">
          <div class="text-black text-justify font-bold">
            <h1 class="text-3xl md:text-4xl">31+ Pengurus</h1>
            <p class="text-xs md:text-sm mt-3">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque
              neque tempore repudiandae velit animi tempora amet corporis labore
              doloribus assumenda!
            </p>
          </div>

          <div class="text-black text-justify font-bold">
            <h1 class="text-3xl md:text-4xl">300+ Anggota</h1>
            <p class="text-xs md:text-sm mt-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
              neque tempore repudiandae velit animi tempora amet corporis
              labore!
            </p>
          </div>

          <div class="text-black text-justify font-bold">
            <h1 class="text-3xl md:text-4xl">5 KMPS</h1>
            <p class="text-xs md:text-sm mt-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
              neque tempore repudiandae velit animi tempora amet corporis
              labore!
            </p>
          </div>
        </div>

        <!-- Box 2 -->
        <div
          class="flex items-center justify-center rounded-xl overflow-hidden h-60 md:h-auto"
        >
          <img
            src="https://images.unsplash.com/photo-1519681393784-d120267933ba?ixlib=rb-4.0.3&q=80&w=600"
            alt="gambarlogo"
            class="w-full h-full object-cover"
          />
        </div>

        <!-- Box 3 -->
        <div class="flex flex-col text-lg md:text-3xl font-bold space-y-4">
          <p class="text-sm md:text-base font-normal">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum
            dolor sit amet consectetur, adipisicing elit. Natus laboriosam,
            labore officiis illo tempora voluptatum molestias neque at ea
            repellendus.
          </p>
        </div>
      </div>
    </div>

    <!-- SCRIPT UNTUK SWAP GAMBAR -->
    <script>
      const bigBox = document.getElementById('bigPhoto');
      const smallBoxes = document.querySelectorAll('.swap-box');

      smallBoxes.forEach((box) => {
        box.addEventListener('click', () => {
          const smallImg = box.getAttribute('data-img');
          const oldBigImg = bigBox.style.backgroundImage.slice(5, -2);

          bigBox.style.backgroundImage = `url('${smallImg}')`;

          box.setAttribute('data-img', oldBigImg);
          box.querySelector('img').src = oldBigImg;
        });
      });
    </script>

    <!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
    <script
      src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1"
      type="module"
    ></script>

    <script>
      const navbar = document.getElementById('navbar');

      window.addEventListener('scroll', () => {
        const navElements = document.querySelectorAll(
          '#navbar a, #navbar button, #navbar div, #navbar span, #navbar h1',
        );

        if (window.scrollY > 50) {
          navbar.classList.remove('bg-transparent');
          navbar.classList.add('bg-white', 'shadow-md');

          // Ubah semua elemen text menjadi hitam
          navElements.forEach((el) => {
            el.classList.remove('text-white');
            el.classList.add('text-gray-900');
          });
        } else {
          navbar.classList.add('bg-transparent');
          navbar.classList.remove('bg-white', 'shadow-md');

          // Kembalikan warna putih
          navElements.forEach((el) => {
            el.classList.add('text-white');
            el.classList.remove('text-gray-900');
          });
        }
      });
    </script>
  </body>
</html>
