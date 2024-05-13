@extends('DefaultLayout')
@section('content')
    <div class="p-4  lg:w-[70%] md:mx-auto rounded-lg dark:border-gray-700">
        <div class="mb-5">
            <h1 class="text-[1.3rem] font-medium">Daily Logs</h1>
            <p class="text-[1rem] mt-[-3px] text-gray-600 ">Time for insights! Your daily Logs are here.</p>
        </div>

        <div class="grid md:grid-cols-4 grid-cols-2 gap-4 mb-4">
            {{-- @php
            $card = [
                [
                    'title' => 'Total Members',
                    'icons' => 'member.png',
                    'value' => 5120,
                ],
                [
                    'title' => 'Total Coaches',
                    'icons' => 'coach.png',
                    'value' => 130,
                ],
                [
                    'title' => "Today's Revenue",
                    'icons' => 'coins.png',
                    'value' => 5330,
                ],
                [
                    'title' => "Today's Log",
                    'icons' => 'verify.png',
                    'value' => 130,
                ],
            ];
        @endphp --}}

            {{-- @foreach ($card as $card_item)
            <div class="p-5 flex items-start  space-x-5 rounded bg-white h-28 dark:bg-gray-800">


                <img src="{{ url('assets/' . $card_item['icons']) }}" alt=""
                    class="h-10 p-[5px] bg-blue-200 rounded-full">
                <div>
                    <h3 class="font-medium md:text-[1.1rem] text-gray-700 ">{{ $card_item['title'] }}</h3>
                    <p class="text-[1.5rem] font-bold">{{ $card_item['value'] }}</p>
                </div>

            </div>
        @endforeach --}}

        </div>
        <div class="lg:grid lg:grid-cols-5 gap-3 ">
            <div class="col-span-4 mb-4 lg:mb-0">
                @include('Dashboard_Comp.Daily_chart',[
                    'total_count' => 3
                ]
                    
                )
            </div>
            <div class="lg:col-span-1 grid-cols-3 lg:grid-cols-1 grid lg:grid-rows-3 gap-1">
                @php
                    $card_item = [
                        ['title' => 'Student', 'icon' => 'member.png', 'value' => $student],
                        ['title' => 'Regular', 'icon' => 'member.png', 'value' => $regular],
                        ['title' => 'Revenue', 'icon' => 'coins.png', 'value' => "Php ".$daily_revenue],
                    ];
                @endphp

                @foreach ($card_item as $card_item)
                    <div
                        class="p-5 flex items-center h-full rounded-lg  shadow-sm shadow-gray-200 space-x-5 rounded bg-white h-28 dark:bg-gray-800">
                        <img src="{{ url('assets/' . $card_item['icon']) }}" alt=""
                            class="h-10 p-[3px] bg-blue-200 rounded-full">
                        <div>
                            <h3 class="font-medium md:text-[1.1rem] text-[.8rem] text-gray-700 ">{{ $card_item['title'] }}</h3>
                            <p class="md:text-[1.1rem] font-bold">{{ $card_item['value'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @php
            $table_head = ['Client Name', 'Category', 'Price', 'Time', 'Date'];

        @endphp
        @include('Dashboard_Comp.Dash_Table', [
            'table_head' => $table_head,
            'isManage' => false,
            'Title' => "Today's Record",
            'isSearch' => false,
            'table_subhead' =>
                "The latest entry in our Daily Logs provides additional insight into today's activities.",
            'table_data' => $table_data,
            'isDate'=>true
        ])
        <div class="m-4">
            {{ $table_data->links() }}
        </div>


    </div>
@endSection
