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
            [   'id'=>1,
                'user_id'=>'10',
                'parent_id'=>null,
                'description'=>'Описание мероприятия1',
                'name' => 'Название мероприятия1',
                'is_remind' => true,
                'time_start' => '01:00',
                'time_end' => '03:00',
                'date_start' => '2020-5-12',
                'date_end' => '2020-5-15',
            ],
            [   'id'=>2,
                'parent_id'=>'1',
                'user_id'=>'10',
                'description'=>'Описание мероприятия2',
                'name' => 'Название мероприятия2',
                'is_remind' => false,
                'time_start' => '01:00',
                'time_end' => '08:00',
                'date_start' => '2020-5-13',
                'date_end' => '2020-5-15',
            ],
            [
                'id'=>3,
                'parent_id'=>'1',
                'user_id'=>'10',
                'name' => 'Название мероприятия3',
                'description'=>'Описание мероприятия2',
                'is_remind' => true,
                'time_start' => '17:00',
                'time_end' => '20:00',
                'date_start' => '2020-5-14',
                'date_end' => '2020-5-15',
            ],

        ];
        \App\Models\Task::insert($values);
    }
}
