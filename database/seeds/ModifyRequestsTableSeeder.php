<?php

use App\Models\Attendance;
use App\Models\ModifyRequest;
use Illuminate\Database\Seeder;

class ModifyRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ModifyRequest::class, 10)->create();
        $attendance = factory(Attendance::class)->create(['user_id' => 26]);
        factory(ModifyRequest::class)->create(
            [
                'user_id' => $attendance->user_id,
                'registration_date' => $attendance->registration_date,
            ]
        );
    }
}
