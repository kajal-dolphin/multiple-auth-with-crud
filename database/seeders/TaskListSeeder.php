<?php

namespace Database\Seeders;

use App\Models\TaskList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TaskListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        dump("Start time", now()->format('h:i:s'));
        TaskList::truncate();
        for ($i = 0; $i < 500; $i++) {
            TaskList::factory()->count(200)->create();
        }
        dump("End time",now()->format('h:i:s'));


        // $faker = Faker::create();
        // $no_of_rows = 100000;

        // for( $i=0; $i < $no_of_rows; $i++ ){
            // $task_list_data = array(
            //     'user_id' => User::pluck('id')->random(),
            //     'subject' => $faker->sentence(),
            //     'description' => $faker->paragraph(),
            //     'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
            //     'end_date' => Carbon::now()->format('Y-m-d H:i:s'),
            //     'status' => $faker->randomElement(['new' ,'incomplete', 'complete']),
            //     'priority' => $faker->randomElement(['high' ,'meduim', 'low']),
            //     'is_active' => $faker->randomElement(['0' ,'1']),
            // );

            // TaskList::insert($task_list_data);
        //     // $task_list_data=null;
        // }


        // $no_of_rows = 100000;
        // $range=range( 1, $no_of_rows );
        // $chunksize=1000;

        // foreach( array_chunk( $range, $chunksize ) as $chunk ){
        //     $task_list_data = array();
        //     foreach( $chunk as $i ){
        //         $task_list_data[] = array(
                    // 'user_id' => User::pluck('id')->random(),
                    // 'subject' => $faker->sentence(),
                    // 'description' => $faker->paragraph(),
                    // 'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                    // 'end_date' => Carbon::now()->format('Y-m-d H:i:s'),
                    // 'status' => $faker->randomElement(['new' ,'incomplete', 'complete']),
                    // 'priority' => $faker->randomElement(['high' ,'meduim', 'low']),
                    // 'is_active' => $faker->randomElement(['0' ,'1']),
        //         );      
        //     }
        //     TaskList::insert( $task_list_data );
        // }


        // $no_of_data = 100000;
        // $task_list_data = array();
        // for ($i = 0; $i < $no_of_data; $i++){
        //     $task_list_data[$i]['user_id'] = User::pluck('id')->random();
        //     $task_list_data[$i]['subject'] = $faker->sentence();
        //     $task_list_data[$i]['description'] = $faker->paragraph();
        //     $task_list_data[$i]['start_date'] = Carbon::now()->format('Y-m-d H:i:s');
        //     $task_list_data[$i]['end_date'] = Carbon::now()->format('Y-m-d H:i:s');
        //     $task_list_data[$i]['status'] = $faker->randomElement(['new' ,'incomplete', 'complete']);
        //     $task_list_data[$i]['priority'] = $faker->randomElement(['high' ,'meduim', 'low']);
        //     $task_list_data[$i]['is_active'] = $faker->randomElement(['0' ,'1']);
        // }
        // $chunk_data = array_chunk($task_list_data, 1000);
        // if (isset($chunk_data) && !empty($chunk_data)) {
        //     foreach ($chunk_data as $chunk_data_val) {
        //         DB::table('task_lists')->insert($chunk_data_val);
        //     }
        // 

    //     $taskList = app('db')->table('task_lists');
    //     for($i = 0; $i < 100; $i++){
    //         $task_list_data = [];
    //         for($j = 0; $j < 1000; $j++){
    //             $task_list_data[] = [
    //                 'user_id' => User::pluck('id')->random(),
    //                 'subject' => $faker->sentence(),
    //                 'description' => $faker->paragraph(),
    //                 'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
    //                 'end_date' => Carbon::now()->format('Y-m-d H:i:s'),
    //                 'status' => $faker->randomElement(['new' ,'incomplete', 'complete']),
    //                 'priority' => $faker->randomElement(['high' ,'meduim', 'low']),
    //                 'is_active' => $faker->randomElement(['0' ,'1']),
    //             ];
    //         }
    //         $taskList->insert($task_list_data);
    //    }
    }
}   
