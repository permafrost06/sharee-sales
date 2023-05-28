<aside id="sidebar-main"
    class="hidden fixed h-full z-10 md:static md:flex max-w-sm w-72 bg-admin-nav flex-col px-3 border-r">
    <div class="h-admin-nav py-3 flex items-center collapsed:md:justify-center">
        <div class="border rounded-lg h-12 w-12 collapsed:md:hidden"></div>
        <div class="flex-grow mx-2 collapsed:md:hidden whitespace-nowrap overflow-hidden">
            <h3 class="text-lg font-medium text-dark">Sharee Sales</h3>
            <p class="text-muted text-xs -mt-1">Some subtitle</p>
        </div>
        <button type="button" id="sidenav-resize"
            class="hidden md:block hover:text-active transition-all duration-100 rounded focus:ring-2 focus:ring-blue-300">
            <div class="sr-only">Expand & Collapse Sidenav</div>
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                class="collapsed:hidden">
                <path fill="currentColor"
                    d="M3 18h13v-2H3v2zm0-5h10v-2H3v2zm0-7v2h13V6H3zm18 9.59L17.42 12L21 8.41L19.59 7l-5 5l5 5L21 15.59z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                class="hidden collapsed:block">
                <path fill="currentColor"
                    d="M3 6h10v2H3V6m0 10h10v2H3v-2m0-5h12v2H3v-2m13-4l-1.42 1.39L18.14 12l-3.56 3.61L16 17l5-5l-5-5Z" />
            </svg>
        </button>
        <button type="button" id="sidenav-closer" class="md:hidden">
            <div class="sr-only">Close sidenav</div>
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="m5 13l4 4l-1.4 1.42L1.18 12L7.6 5.58L9 7l-4 4h16v2H5m16-7v2H11V6h10m0 10v2H11v-2h10Z" />
            </svg>
        </button>
    </div>

    <nav class="flex-grow overflow-y-auto py-4">
        <ul class="collapsed:md:max-w-min mx-auto">
            <x-sidebar-item route="admin.index">
                <x-slot:svg>
                    <path fill="currentColor" d="M13 9V3h8v6h-8ZM3 13V3h8v10H3Zm10 8V11h8v10h-8ZM3 21v-6h8v6H3Z" />
                </x-slot:svg>
                Dashboard
            </x-sidebar-item>
            <li class="p-2 uppercase text-sm text-muted font-medium my-2 collapsed:md:hidden">ITEMS</li>

            <x-sidebar-item-group :routes="['customers.create', 'customers.index']">
                <x-slot:svg viewBox="0 0 32 32">
                    <path fill="currentColor"
                        d="M28.523 23.813c-.518-.51-6.795-2.938-7.934-3.396c-1.133-.45-1.585-1.697-1.585-1.697s-.51.282-.51-.51c0-.793.51.51 1.02-2.548c0 0 1.415-.397 1.134-3.68h-.34s.85-3.51 0-4.698c-.853-1.188-1.187-1.98-3.06-2.548c-1.87-.567-1.19-.454-2.548-.396c-1.36.057-2.492.793-2.492 1.188c0 0-.85.057-1.188.397c-.34.34-.906 1.924-.906 2.32s.283 3.06.566 3.624l-.337.11c-.283 3.284 1.132 3.682 1.132 3.682c.51 3.058 1.02 1.755 1.02 2.548c0 .792-.51.51-.51.51s-.453 1.246-1.585 1.697c-1.132.453-7.416 2.887-7.927 3.396c-.51.52-.453 2.896-.453 2.896h12.036l.878-3.46l-.78-.78l1.343-1.345l1.343 1.344l-.78.78l.878 3.46h12.036s.063-2.378-.453-2.897z" />
                </x-slot:svg>
                <x-slot:label>
                    Customers
                </x-slot:label>

                <x-sidebar-item route="customers.create">
                    <x-slot:svg viewBox="0 0 20 20">
                        <path fill="currentColor"
                            d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20a10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16a8 8 0 0 0 0 16z" />
                    </x-slot:svg>
                    Add Customer
                </x-sidebar-item>
                <x-sidebar-item route="customers.index">
                    <x-slot:svg viewBox="0 0 32 32">
                        <path fill="currentColor"
                            d="M11.5 6A3.514 3.514 0 0 0 8 9.5c0 1.922 1.578 3.5 3.5 3.5S15 11.422 15 9.5S13.422 6 11.5 6zm9 0A3.514 3.514 0 0 0 17 9.5c0 1.922 1.578 3.5 3.5 3.5S24 11.422 24 9.5S22.422 6 20.5 6zm-9 2c.84 0 1.5.66 1.5 1.5s-.66 1.5-1.5 1.5s-1.5-.66-1.5-1.5s.66-1.5 1.5-1.5zm9 0c.84 0 1.5.66 1.5 1.5s-.66 1.5-1.5 1.5s-1.5-.66-1.5-1.5s.66-1.5 1.5-1.5zM7 12c-2.2 0-4 1.8-4 4c0 1.113.477 2.117 1.219 2.844A5.036 5.036 0 0 0 2 23h2c0-1.668 1.332-3 3-3s3 1.332 3 3h2a5.036 5.036 0 0 0-2.219-4.156C10.523 18.117 11 17.114 11 16c0-2.2-1.8-4-4-4zm5 11c-.625.836-1 1.887-1 3h2c0-1.668 1.332-3 3-3s3 1.332 3 3h2a5.024 5.024 0 0 0-1-3c-.34-.453-.75-.84-1.219-1.156C19.523 21.117 20 20.114 20 19c0-2.2-1.8-4-4-4s-4 1.8-4 4c0 1.113.477 2.117 1.219 2.844A5.042 5.042 0 0 0 12 23zm8 0h2c0-1.668 1.332-3 3-3s3 1.332 3 3h2a5.036 5.036 0 0 0-2.219-4.156C28.523 18.117 29 17.114 29 16c0-2.2-1.8-4-4-4s-4 1.8-4 4c0 1.113.477 2.117 1.219 2.844A5.036 5.036 0 0 0 20 23zM7 14c1.117 0 2 .883 2 2s-.883 2-2 2s-2-.883-2-2s.883-2 2-2zm18 0c1.117 0 2 .883 2 2s-.883 2-2 2s-2-.883-2-2s.883-2 2-2zm-9 3c1.117 0 2 .883 2 2s-.883 2-2 2s-2-.883-2-2s.883-2 2-2z" />
                    </x-slot:svg>
                    Customer List
                </x-sidebar-item>

            </x-sidebar-item-group>


            <x-sidebar-item route="sales.create">
                <x-slot:svg viewBox="0 0 16 16">
                    <path fill="currentColor"
                        d="M12.9 2.5C11.3 1.3 11.5 0 11.5 0H2v12.5C2 14.4 4.1 16 6 16h8V3s-.8-.2-1.1-.5zM7 6.3c-.9-.3-2.3-.8-2.3-1.9C4.8 3.6 6 3 6 2.8V2h1v.7c1 .1 1.8.4 1.9.4l-.3.9s-.7-.3-1.5-.3c-.7 0-1.1.3-1.2.8c0 .3.5.6 1.3.9c1.5.5 1.9 1.1 1.9 1.9C9.1 8 9 8.9 7 9.1v.9H6v-.8c0-.1-1.4-.5-1.5-.5l.5-.9s1.1.5 2 .4s1.3-.6 1.3-1c.1-.3-.4-.6-1.3-.9zm6 8.7H6c-1 0-1.8-.6-2-1.3c-.1-.3 0-.7.4-.7H11V2.7c1 .6 2 1.1 2 1.3v11z" />
                </x-slot:svg>
                New Deposit
            </x-sidebar-item>


            <x-sidebar-item route="purchase.create">
                <x-slot:svg viewBox="0 0 48 48">
                    <g fill="none">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                            d="M5 17h38l-4.2 26H9.2L5 17Zm30 0c0-6.627-4.925-12-11-12s-11 5.373-11 12" />
                        <circle cx="17" cy="26" r="2" fill="currentColor" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                            d="M18 33s2 3 6 3s6-3 6-3" />
                        <circle cx="31" cy="26" r="2" fill="currentColor" />
                    </g>
                </x-slot:svg>
                New Purchase
            </x-sidebar-item>


            <x-sidebar-item-group :routes="['stocks.form']">
                <x-slot:svg viewBox="0 0 36 36">
                    <path fill="currentColor"
                        d="M32 6H4a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h28a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2ZM9.63 24.23a.79.79 0 0 1-.81.77a.79.79 0 0 1-.82-.77V11.77a.79.79 0 0 1 .82-.77a.79.79 0 0 1 .81.77Zm6 0a.79.79 0 0 1-.82.77a.79.79 0 0 1-.81-.77V11.77a.79.79 0 0 1 .81-.77a.79.79 0 0 1 .82.77Zm6.21 0a.79.79 0 0 1-.82.77a.79.79 0 0 1-.81-.77V11.77a.79.79 0 0 1 .81-.77a.79.79 0 0 1 .82.77Zm6.12 0a.79.79 0 0 1-.82.77a.79.79 0 0 1-.81-.77V11.77a.79.79 0 0 1 .81-.77a.79.79 0 0 1 .82.77Z"
                        class="clr-i-solid clr-i-solid-path-1" />
                    <path fill="none" d="M0 0h36v36H0z" />
                </x-slot:svg>
                <x-slot:label>
                    Stock
                </x-slot:label>

                <x-sidebar-item :link="route('stocks.form', ['stock' => 'add'])" route="stocks.form">
                    <x-slot:svg viewBox="0 0 20 20">
                        <path fill="currentColor"
                            d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20a10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16a8 8 0 0 0 0 16z" />
                    </x-slot:svg>
                    Add Stock
                </x-sidebar-item>
            </x-sidebar-item-group>

        </ul>
    </nav>
</aside>
