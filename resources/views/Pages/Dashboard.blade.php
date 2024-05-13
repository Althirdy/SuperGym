@extends('DefaultLayout')
@section('content')
    <div class="p-4  lg:w-[70%] md:mx-auto rounded-lg dark:border-gray-700">
        <div class="mb-5">
            <h1 class="text-[1.3rem] font-medium">Gym Overview</h1>
            <p class="text-[1rem] mt-[-3px] text-gray-600 ">Welcome back admin</p>
        </div>

        <div class="grid md:grid-cols-4 grid-cols-2 gap-4 mb-4">
            @php
                $card = [
                    [
                        'title' => 'Total Members',
                        'icons' => 'member.png',
                        'value' => Str::length($client_count) == 1 ? '0'.$client_count :$client_count ,
                    ],
                    [
                        'title' => 'Total Coaches',
                        'icons' => 'coach.png',
                        'value' => Str::length($coaches_count) == 1 ? '0'.$coaches_count :$coaches_count,
                    ],
                    [
                        'title' => "Today's Revenue",
                        'icons' => 'coins.png',
                        'value' => 'Php '.$today_revenue,
                    ],
                    [
                        'title' => "Today's Log",
                        'icons' => 'verify.png',
                        'value' => Str::length($today_logs) == 1 ? '0'.$today_logs :$today_logs,
                    ],
                ];
            @endphp

            @foreach ($card as $card_item)
                <div class="p-5 flex items-start  space-x-5 rounded bg-white h-28 dark:bg-gray-800">


                    <img src="{{ url('assets/' . $card_item['icons']) }}" alt=""
                        class="h-10 p-[5px] bg-blue-200 rounded-full">
                    <div>
                        <h3 class="font-medium md:text-[1.1rem] text-gray-700 ">{{ $card_item['title'] }}</h3>
                        <p class="text-[1.2rem] font-bold">{{ $card_item['value'] }}</p>
                    </div>

                </div>
            @endforeach
        </div>

        @php
            $table_head = ['Client_Name','Subscription','Price','Registration Date','Coach']
        @endphp

        @include('Dashboard_Comp.Chart',
            [
                'islogs' => true ,
                'total' => $total_traffic,
                'member' => $member,
                'not_member' => $not_member
                ]
        )
        @include('Dashboard_Comp.Dash_Table',[
            'table_head'=>$table_head,
            'isManage' => false,
            'Title' => 'Latest Member',
            'isSearch'=> false,
            'table_subhead'=> "Meet our newest gym buddy, joining us in the pursuit of a healthier, fitter lifestyle",
            'table_data'=> $dash_data,
        ])
    </div>
@endSection
