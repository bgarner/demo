<?php

use Illuminate\Database\Seeder;
use App\Models\UrgentNotice\UrgentNotice;

class UrgentNoticeBannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $urgentnotices = UrgentNotice::get();

        foreach ($urgentnotices as $urgentnotice) {

            \DB::table('urgent_notice_banner')->insert([
                'urgent_notice_id' => $urgentnotice->id,
                'banner_id' => $urgentnotice->banner_id
            ]);
            
        }
    }
}
