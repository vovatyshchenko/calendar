<?php

use Illuminate\Database\Seeder;

class BirthdaySeeder extends Seeder
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
                'name' => 'Название мероприятия1',
                'is_remind' => true,
                'is_remind_year'=>true,
                'time_start' => '00:00',
                'date' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'name' => 'Название мероприятия2',
                'is_remind' => true,
                'is_remind_year'=>true,
                'time_start' => '00:00',
                'date' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'name' => 'Название мероприятия3',
                'is_remind' => true,
                'is_remind_year'=>true,
                'time_start' => '04:00',
                'date' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'name' => 'Название мероприятия4',
                'is_remind' => true,
                'is_remind_year'=>true,
                'time_start' => '07:00',
                'date' => '2020-5-12',
            ],
            [
                'user_id'=>'10',
                'name' => 'Название мероприятия4',
                'is_remind' => true,
                'is_remind_year'=>true,
                'time_start' => '07:00',
                'date' => '2020-5-17',
            ],

        ];
        \App\Models\Birthday::insert($values);
    }
}
