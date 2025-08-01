<div class="bg-white">
    <header class="absolute inset-x-0 top-0 z-50">
        <div class="mx-auto max-w-7xl">
            <div class="px-6 pt-6 lg:max-w-2xl lg:pr-0 lg:pl-8">
                <nav aria-label="Global" class="flex items-center justify-between lg:justify-start">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=amber&shade=600" alt="Your Company" class="h-8 w-auto" />
                    </a>
                    <button type="button" command="show-modal" commandfor="mobile-menu" class="-m-2.5 rounded-md p-2.5 text-gray-700 lg:hidden">
                        <span class="sr-only">Open main menu</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <div class="hidden lg:ml-12 lg:flex lg:gap-x-14">
                        <a href="#" class="text-sm/6 font-semibold text-gray-900">Product</a>
                        <a href="#" class="text-sm/6 font-semibold text-gray-900">Features</a>
                        <a href="#" class="text-sm/6 font-semibold text-gray-900">Marketplace</a>
                        <a href="#" class="text-sm/6 font-semibold text-gray-900">Company</a>
                        <a href="#" class="text-sm/6 font-semibold text-gray-900">Log in</a>
                    </div>
                </nav>
            </div>
        </div>
        <el-dialog>
            <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
                <div tabindex="0" class="fixed inset-0 focus:outline-none">
                    <el-dialog-panel class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                        <div class="flex items-center justify-between">
                            <a href="#" class="-m-1.5 p-1.5">
                                <span class="sr-only">Your Company</span>
                                <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=amber&shade=600" alt="" class="h-8 w-auto" />
                            </a>
                            <button type="button" command="close" commandfor="mobile-menu" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                                <span class="sr-only">Close menu</span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                                    <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-6 flow-root">
                            <div class="-my-6 divide-y divide-gray-500/10">
                                <div class="space-y-2 py-6">
                                    <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Product</a>
                                    <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Features</a>
                                    <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Marketplace</a>
                                    <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Company</a>
                                    <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Log in</a>
                                </div>
                                <div class="py-6">
                                    <a href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Log in</a>
                                </div>
                            </div>
                        </div>
                    </el-dialog-panel>
                </div>
            </dialog>
        </el-dialog>
    </header>

    <div class="relative">
        <div class="mx-auto max-w-7xl">
            <div class="relative z-10 pt-14 lg:w-full lg:max-w-2xl">
                <svg viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true" class="absolute inset-y-0 right-8 hidden h-full w-80 translate-x-1/2 transform fill-white lg:block">
                    <polygon points="0,0 90,0 50,100 0,100" />
                </svg>

                <div class="relative px-6 py-32 sm:py-40 lg:px-8 lg:py-56 lg:pr-0">
                    <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl">
                        <div class="hidden sm:mb-10 sm:flex">
                            <div class="relative rounded-full px-3 py-1 text-sm/6 text-gray-500 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                                Welcome to freshly opened Restaurant Experiment <a href="#" class="font-semibold whitespace-nowrap text-primary-600"><span aria-hidden="true" class="absolute inset-0"></span>Reserve your seat <span aria-hidden="true">&rarr;</span></a>
                            </div>
                        </div>
                        <h1 class="text-5xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-7xl">Restaurant Experiment</h1>
                        <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">Welcome to Restaurant Experiment. You can easily reservate your table here.</p>
                        <div class="mt-10 flex items-center gap-x-6">
                            <a href="#" class="rounded-md bg-primary-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-primary-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Reservate</a>
                            <a href="#" class="text-sm/6 font-semibold text-gray-900">Create an account <span aria-hidden="true">→</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img src="{{ Vite::asset('resources/img/restaurant.webp') }}" alt="Restaurant image" class="aspect-3/2 object-cover lg:aspect-auto lg:size-full" />
        </div>
    </div>
</div>
