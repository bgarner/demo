<?php

use Illuminate\Database\Seeder;

class SeedCommunityDonationSportsTable extends Seeder
{

	private $sport_categories = [
		['id' => 1, 'sport' => 'Hockey'],
		['id' => 2, 'sport' => 'Ringette'],
		['id' => 3, 'sport' => 'Lacrosse'],
		['id' => 4, 'sport' => 'Golf'],
		['id' => 5, 'sport' => 'Soccer'],
		['id' => 6, 'sport' => 'Basketball'],
		['id' => 7, 'sport' => 'Volleyball'],
		['id' => 8, 'sport' => 'Football'],
		['id' => 9, 'sport' => 'Baseball/Softball'],
		['id' => 10, 'sport' => 'Bike'],
		['id' => 11, 'sport' => 'Run'],
		['id' => 12, 'sport' => 'Youth Programs'],
		['id' => 13, 'sport' => 'Community Associations'],
		['id' => 14, 'sport' => 'School Programs'],
		['id' => 15, 'sport' => 'Ski/Snowboard'],
		['id' => 16, 'sport' => 'Yoga'],
		['id' => 17, 'sport' => 'Fitness'],
		['id' => 18, 'sport' => 'Climbing'],
		['id' => 19, 'sport' => 'Paddlesports'],
		['id' => 20, 'sport' => 'Recreation Organization'],
		['id' => 21, 'sport' => 'Olympics/Special Olympics'],
		['id' => 22, 'sport' => 'Other']
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->sport_categories as $sport) {
        	DB::table('community_donation_sports')->insert($sport);	
        }
    }
}
