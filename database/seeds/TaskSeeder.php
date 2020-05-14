<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
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
                'is_remind' => true,
                'time_start' => '01:00',
                'time_end' => '03:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия2',
                'name' => 'Название мероприятия2',
                'is_remind' => false,
                'time_start' => '01:00',
                'time_end' => '08:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'name' => 'Название мероприятия3',
                'description'=>'Описание мероприятия2',
                'is_remind' => true,
                'time_start' => '17:00',
                'time_end' => '20:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия4',
                'name' => 'Название мероприятия4',
                'is_remind' => true,
                'time_start' => '10:00',
                'time_end' => '02:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия5',
                'name' => 'Название мероприятия5',
                'is_remind' => true,
                'time_start' => '13:00',
                'time_end' => '23:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия6',
                'name' => 'Название мероприятия6',
                'is_remind' => true,
                'time_start' => '06:00',
                'time_end' => '23:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия7',
                'name' => 'Название мероприятия7',
                'is_remind' => true,
                'time_start' => '00:00',
                'time_end' => '02:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия8',
                'name' => 'Название мероприятия8',
                'is_remind' => true,
                'time_start' => '00:00',
                'time_end' => '03:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия9',
                'name' => 'Название мероприятия9',
                'is_remind' => true,
                'time_start' => '01:00',
                'time_end' => '07:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия10',
                'name' => 'Название мероприятия10',
                'is_remind' => true,
                'time_start' => '01:00',
                'time_end' => '02:00',
                'date_start' => '2020-5-19',
                'date_end' => '2020-5-21',
            ],
            [
                'user_id'=>'10',
                'description'=>'Описание мероприятия11',
                'name' => 'Название мероприятия11',
                'is_remind' => true,
                'time_start' => '01:00',
                'time_end' => '02:00',
                'date_start' => '2020-5-18',
                'date_end' => '2020-5-20',
            ],

        ];
        \App\Models\Task::insert($values);
    }
}
