<?php

use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values=[
            [
            'user_id'=>'10',
            'description'=>'Описание мероприятия1',
            'name' => 'Название мероприятия1',
            'guests' => 'Гость1,Гость2,Гость3',
            'location' => 'г.Краматорск',
            'time_start' => '1:00',
            'time_end' => '2:00',
            'date_start' => '2020-5-12',
            'date_end' => '2020-5-12',
        ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия2',
                'name' => 'Название мероприятия2',
                'guests' => 'Гость6,Гость2,Гость8',
                'location' => 'г.Краматорск',
                'time_start' => '14:00',
                'time_end' => '18:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия3',
                'name' => 'Название мероприятия3',
                'guests' => 'Гость1,Гость8,Гость6',
                'location' => 'г.Краматорск',
                'time_start' => '00:00',
                'time_end' => '12:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия4',
                'name' => 'Название мероприятия4',
                'guests' => 'Гость1,Гость7,Гость9',
                'location' => 'г.Краматорск',
                'time_start' => '03:00',
                'time_end' => '09:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия5',
                'name' => 'Название мероприятия5',
                'guests' => 'Гость9,Гость7,Гость8',
                'location' => 'г.Краматорск',
                'time_start' => '20:00',
                'time_end' => '20:30',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия6',
                'name' => 'Название мероприятия6',
                'guests' => 'Гость1,Гость2,Гость3',
                'location' => 'г.Краматорск',
                'time_start' => '17:00',
                'time_end' => '23:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия7',
                'name' => 'Название мероприятия7',
                'guests' => 'Гость9,Гость2,Гость8',
                'location' => 'г.Краматорск',
                'time_start' => '00:00',
                'time_end' => '01:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия8',
                'name' => 'Название мероприятия8',
                'guests' => 'Гость5,Гость2,Гость8',
                'location' => 'г.Краматорск',
                'time_start' => '07:00',
                'time_end' => '08:30',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия9',
                'name' => 'Название мероприятия9',
                'guests' => 'Гость5,Гость1Гость3',
                'location' => 'г.Краматорск',
                'time_start' => '12:00',
                'time_end' => '17:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия10',
                'name' => 'Название мероприятия10',
                'guests' => 'Гость8,Гость2,Гость3',
                'location' => 'г.Краматорск',
                'time_start' => '04:00',
                'time_end' => '05:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ]
        ];
        \App\Models\Activity::insert($values);
    }
}
