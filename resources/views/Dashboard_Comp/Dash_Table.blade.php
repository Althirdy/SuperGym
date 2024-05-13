<div class="relative my-5 overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <caption
            class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            {{ $Title }}
            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">{{ $table_subhead }}</p>
            @if ($isSearch)
                <div class="lg:flex justify-between lg:space-x-10 items-center">
                    <form class=" w-[50%] font-normal my-3" action="{{ url('/' . request()->path()) }}">
                        <label for="default-search"
                            class="mb-2 text-sm text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" name="search" id="default-search"
                                class="block w-full p-2 ps-10 text-sm  text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search client..." required />

                        </div>


                    </form>

                </div>
              
                <button type="button" id="all_btn" data-value="{{ request()->path() }}"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 me-2  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">All</button>
            @endif
            <button type="button" id="btn" data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-2 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 lg:me-2 my-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add
                Client</button>
                @include('Dashboard_Comp.Modal', [
                    'client_category' => $client_category ?? [],
                    'subs' => $subs ?? [],
                    'goal' => $goal ?? [],
                    'coach' => $coach ?? [],
                ])
            @if (isset($isDate))
                @php
                (request()->is('Daily_Logs')) ? $url = '/Daily_Logs' : $url = '/Members_Logs';
                @endphp
                <form action="{{ url($url) }}" method="get" class="mt-2">
                    <div class="relative flex items-center space-x-2">
                        <input type="date" name="date"
                            value="{{ request()->input('date', now()->format('Y-m-d')) }}"
                            class="block px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 placeholder-gray-500"
                            placeholder="Select a date">
                        <button type="submit"
                            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Filter</button>
                    </div>
                </form>
            @endif
        </caption>

        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                @foreach ($table_head as $head)
                    <th scope="col" class="px-6 py-3">
                        {{ $head }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @if ($table_data)
                @foreach ($table_data as $data)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ Str::upper($data['col1']) }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $data['col2'] }}

                        </td>
                        <td class="px-6 py-4">
                            @if (request()->is('Members') || request()->is('Coaches'))
                                {{ $data['col3'] }}
                            @else
                                Php {{ $data['col3'] }}
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $data['col4'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $data['col5'] }}
                        </td>
                        @if ($isManage)
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                    title="Manage"><button type="button"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-2 focus:ring-blue-300 font-medium rounded-md text-sm px-3 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Manage</button>
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach


            @endif

        </tbody>
    </table>
</div>
