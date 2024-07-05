<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class stocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => 1,
            'price_id' => 'price_1PZ9VCBxqwjkh0QxnRLLy2q2',
            'course_name' => '松',
            'price' => 5000,
        ];
        DB::table('stocks')->insert($param);

        $param = [
            'id' => 2,
            'price_id' => 'price_1PZ9VYBxqwjkh0QxTidHs1dt',
            'course_name' => '竹',
            'price' => 7000,
        ];
        DB::table('stocks')->insert($param);

        $param = [
            'id' => 3,
            'price_id' => 'price_1PZ9VoBxqwjkh0Qxyh4L54oc',
            'course_name' => '梅',
            'price' => 10000,
        ];
        DB::table('stocks')->insert($param);
    }
}
