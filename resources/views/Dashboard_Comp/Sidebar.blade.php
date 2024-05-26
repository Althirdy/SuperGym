<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-[14rem] h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-[#FEFEFE] dark:bg-gray-800">
        <a href="{{url('Dashboard')}}" class="flex items-center ps-2.5 my-5">
            <img src="{{ url('icons/logo.png') }}" class="h-12 me-3 " alt="Flowbite Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">SuperGym</span>
        </a>
        <ul class="space-y-3 mt-10 font-medium">
            @php
                $side_items = [
                    [
                        'icon' => 'home.png',
                        'item_name' => 'Dashboard',
                    ],
                    [
                        'icon' => 'records.png',
                        'item_name' => 'Records',
                    ],
                    [
                        'icon' => 'customers.png',
                        'item_name' => 'Members',
                    ],
                    [
                        'icon' => 'coach.png',
                        'item_name' => 'Coaches',
                    ],
                    [
                        'icon' => 'settings.png',
                        'item_name' => 'Settings',
                    ],
                    [
                        'icon' => 'logout.png',
                        'item_name' => 'Logout',
                    ]
                ];

                $drop_items = [
                    [
                        'Title' => 'Daily',
                        'url' => 'Daily_Logs',
                        'icon' => 'daily.png',
                    ],
                    [
                        'Title' => 'Members',
                        'url' => 'Members_Logs',
                        'icon' => 'monthly.png',
                    ],
                ];
            @endphp
            @foreach ($side_items as $items)
                @if ($items['item_name'] == 'Records')
                    <button aria-controls="record_drop" data-collapse-toggle="record_drop"
                        class="flex items-center w-full {{ request()->is($items['item_name']) ? 'bg-[#F6F6F6] text-[#00000E]' : '' }} text-[1rem] p-2 text-[#4A566E] rounded-lg dark:text-white hover:bg-[#F6F6F6] hover:text-[#00000E] dark:hover:bg-gray-700 group">
                        <img src="{{ url('icons/' . $items['icon']) }}" alt="Home Icon" class="h-5 w-5">
                        <span class="ms-4">{{ $items['item_name'] }}</span>
                        <img src="{{ url('icons/down.png') }}" alt="Drop Chevron" class="h-4 w-4 flex-1 object-contain">
                    </button>


                    <ul id="record_drop" class=" {{ request()->is('Daily_Logs') || request()->is('Members_Logs')  ? '' : 'hidden' }} py-2 space-y-2">
                        @foreach ($drop_items as $drop)
                            <li>
                                <a href="{{ url('/' . $drop['url']) }}"
                                    class="flex items-center {{ request()->is($drop['url']) ? 'bg-[#F6F6F6] text-black' : '' }} text-[.9rem] p-2 px-10 text-[#4A566E] rounded-lg dark:text-white hover:bg-[#F6F6F6] hover:text-[#00000E] dark:hover:bg-gray-700 group">
                                    <img src="{{ url('icons/' . $drop['icon']) }}" alt="Home Icon" class="h-4 w-4">
                                    <span class="ms-4">{{ $drop['Title'] }}</span>

                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <li>
                        <a href="{{ url('/' . $items['item_name']) }}"
                            class="flex items-center {{ request()->is($items['item_name']) ? 'bg-[#F6F6F6] text-black' : '' }} text-[1rem] p-2 text-[#4A566E] rounded-lg dark:text-white hover:bg-[#F6F6F6] hover:text-[#00000E] dark:hover:bg-gray-700 group">
                            <img src="{{ url('icons/' . $items['icon']) }}" alt="Home Icon" class="h-5 w-5">
                            <span class="ms-4">{{ $items['item_name'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</aside>

<div class="p-4 sm:ml-64">
    @yield('content')
</div>
