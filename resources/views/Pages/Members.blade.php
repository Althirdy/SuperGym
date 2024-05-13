@extends('DefaultLayout')
@section('content')
    <div class="p-4  lg:w-[70%] md:mx-auto rounded-lg dark:border-gray-700">
        <div class="mb-5">
            <h1 class="text-[1.3rem] font-medium">Daily Logs</h1>
            <p class="text-[1rem] mt-[-3px] text-gray-600 ">Lorem ipsum dolor sit amet.</p>
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
        @php
            $table_head = ['Client Name', 'Category', 'Price', 'Coach', 'Date'];

        @endphp
        <div class="lg:grid lg:grid-cols-5 gap-2">
            <div class="col-span-3 mb-5 lg:mb-0">
                {{-- @include('Dashboard_Comp.Chart',
                    [
                        'islogs' => false
                    ]
                ) --}}
            </div>
            <div class="col-span-2">
                @include('Dashboard_Comp.pie_chart',
                [
                    'Title'=>'Program'

                ]

                )
            </div>

        </div>

        @include('Dashboard_Comp.Dash_Table', [
            'table_head' => $table_head,
            'isManage' => false,
            'Title' => "Members",
            'isSearch' => true,
            'table_subhead' => "Track and manage member activity with ease – Member Log",
            'isDate'=>true
        ])
    </div>
@endSection
