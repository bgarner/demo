<?php

use Illuminate\Database\Seeder;

class DistrictStorePivotSeeder extends Seeder
{


    private $districtsStores  = [

    	["store_id"=> 1, "district_id" => 15],["store_id"=> 2, "district_id" => 8],["store_id"=> 3, "district_id" => 4],["store_id"=> 4, "district_id" => 6],["store_id"=> 5, "district_id" => 1],
    	["store_id"=> 6, "district_id" => 16],["store_id"=> 7, "district_id" => 9],["store_id"=> 8, "district_id" => 17],["store_id"=> 9, "district_id" => 21],["store_id"=> 10, "district_id" => 22],
    	["store_id"=> 11, "district_id" => 6],["store_id"=> 12, "district_id" => 10],["store_id"=> 13, "district_id" => 21],["store_id"=> 14, "district_id" => 19],["store_id"=> 15, "district_id" => 14],
    	["store_id"=> 16, "district_id" => 17],["store_id"=> 17, "district_id" => 4],["store_id"=> 18, "district_id" => 11],["store_id"=> 19, "district_id" => 7],["store_id"=> 20, "district_id" => 16],
    	["store_id"=> 21, "district_id" => 3],["store_id"=> 22, "district_id" => 21],["store_id"=> 23, "district_id" => 9],["store_id"=> 24, "district_id" => 20],["store_id"=> 25, "district_id" => 18],
    	["store_id"=> 26, "district_id" => 10],["store_id"=> 27, "district_id" => 15],["store_id"=> 28, "district_id" => 13],["store_id"=> 29, "district_id" => 13],["store_id"=> 30, "district_id" => 12],
    	["store_id"=> 31, "district_id" => 3],["store_id"=> 32, "district_id" => 12],["store_id"=> 33, "district_id" => 12],["store_id"=> 34, "district_id" => 13],["store_id"=> 35, "district_id" => 13],
    	["store_id"=> 36, "district_id" => 12],["store_id"=> 37, "district_id" => 12],["store_id"=> 38, "district_id" => 12],["store_id"=> 39, "district_id" => 12],["store_id"=> 40, "district_id" => 8],
    	["store_id"=> 41, "district_id" => 12],["store_id"=> 42, "district_id" => 1],["store_id"=> 43, "district_id" => 7],["store_id"=> 44, "district_id" => 4],["store_id"=> 45, "district_id" => 2],
    	["store_id"=> 46, "district_id" => 5],["store_id"=> 47, "district_id" => 9],["store_id"=> 48, "district_id" => 15],["store_id"=> 49, "district_id" => 2],["store_id"=> 50, "district_id" => 11],
    	["store_id"=> 51, "district_id" => 9],["store_id"=> 52, "district_id" => 20],["store_id"=> 53, "district_id" => 15],["store_id"=> 54, "district_id" => 9],["store_id"=> 55, "district_id" => 16],
    	["store_id"=> 56, "district_id" => 19],["store_id"=> 57, "district_id" => 19],["store_id"=> 58, "district_id" => 1],["store_id"=> 59, "district_id" => 17],["store_id"=> 60, "district_id" => 3],
    	["store_id"=> 61, "district_id" => 22],["store_id"=> 62, "district_id" => 10],["store_id"=> 63, "district_id" => 6],["store_id"=> 64, "district_id" => 8],["store_id"=> 65, "district_id" => 4],
    	["store_id"=> 66, "district_id" => 8],["store_id"=> 67, "district_id" => 11],["store_id"=> 68, "district_id" => 1],["store_id"=> 69, "district_id" => 20],["store_id"=> 70, "district_id" => 18],
    	["store_id"=> 71, "district_id" => 19],["store_id"=> 72, "district_id" => 19],["store_id"=> 73, "district_id" => 16],["store_id"=> 74, "district_id" => 7],["store_id"=> 75, "district_id" => 10],
    	["store_id"=> 76, "district_id" => 11],["store_id"=> 77, "district_id" => 11],["store_id"=> 78, "district_id" => 9],["store_id"=> 79, "district_id" => 1],["store_id"=> 80, "district_id" => 6],
    	["store_id"=> 81, "district_id" => 1],["store_id"=> 82, "district_id" => 6],["store_id"=> 83, "district_id" => 19],["store_id"=> 84, "district_id" => 11],["store_id"=> 85, "district_id" => 7],
    	["store_id"=> 86, "district_id" => 3],["store_id"=> 87, "district_id" => 14],["store_id"=> 88, "district_id" => 3],["store_id"=> 89, "district_id" => 20],["store_id"=> 90, "district_id" => 7],
    	["store_id"=> 91, "district_id" => 18],["store_id"=> 92, "district_id" => 5],["store_id"=> 93, "district_id" => 21],["store_id"=> 94, "district_id" => 6],["store_id"=> 95, "district_id" => 1],
    	["store_id"=> 96, "district_id" => 9],["store_id"=> 97, "district_id" => 22],["store_id"=> 98, "district_id" => 17],["store_id"=> 99, "district_id" => 20],["store_id"=> 100, "district_id" => 4],
    	["store_id"=> 101, "district_id" => 17],["store_id"=> 102, "district_id" => 18],["store_id"=> 103, "district_id" => 22],["store_id"=> 104, "district_id" => 9],["store_id"=> 105, "district_id" => 2],
    	["store_id"=> 106, "district_id" => 2],["store_id"=> 107, "district_id" => 6],["store_id"=> 108, "district_id" => 21],["store_id"=> 109, "district_id" => 4],["store_id"=> 110, "district_id" => 5],
    	["store_id"=> 111, "district_id" => 4],["store_id"=> 112, "district_id" => 10],["store_id"=> 113, "district_id" => 7],["store_id"=> 114, "district_id" => 2],["store_id"=> 115, "district_id" => 11],
    	["store_id"=> 116, "district_id" => 5],["store_id"=> 117, "district_id" => 20],["store_id"=> 118, "district_id" => 19],["store_id"=> 119, "district_id" => 15],["store_id"=> 120, "district_id" => 16],
    	["store_id"=> 121, "district_id" => 18],["store_id"=> 122, "district_id" => 18],["store_id"=> 123, "district_id" => 18],["store_id"=> 124, "district_id" => 17],["store_id"=> 125, "district_id" => 18],
    	["store_id"=> 126, "district_id" => 16],["store_id"=> 127, "district_id" => 17],["store_id"=> 128, "district_id" => 6],["store_id"=> 129, "district_id" => 18],["store_id"=> 130, "district_id" => 5],
    	["store_id"=> 131, "district_id" => 16],["store_id"=> 132, "district_id" => 3],["store_id"=> 133, "district_id" => 3],["store_id"=> 134, "district_id" => 22],["store_id"=> 135, "district_id" => 21],
    	["store_id"=> 136, "district_id" => 15],["store_id"=> 137, "district_id" => 3],["store_id"=> 138, "district_id" => 22],["store_id"=> 139, "district_id" => 20],["store_id"=> 140, "district_id" => 21],
    	["store_id"=> 141, "district_id" => 22],["store_id"=> 142, "district_id" => 15],["store_id"=> 143, "district_id" => 15],["store_id"=> 144, "district_id" => 10],["store_id"=> 145, "district_id" => 15],
    	["store_id"=> 146, "district_id" => 15],["store_id"=> 147, "district_id" => 21],["store_id"=> 148, "district_id" => 14],["store_id"=> 149, "district_id" => 14],["store_id"=> 150, "district_id" => 14],
    	["store_id"=> 151, "district_id" => 17],["store_id"=> 152, "district_id" => 3],["store_id"=> 153, "district_id" => 3],["store_id"=> 154, "district_id" => 7],["store_id"=> 155, "district_id" => 6],
    	["store_id"=> 156, "district_id" => 7],["store_id"=> 157, "district_id" => 7],["store_id"=> 158, "district_id" => 8],["store_id"=> 159, "district_id" => 5],["store_id"=> 160, "district_id" => 4],
    	["store_id"=> 161, "district_id" => 6],["store_id"=> 162, "district_id" => 10],["store_id"=> 163, "district_id" => 22],["store_id"=> 164, "district_id" => 11],["store_id"=> 165, "district_id" => 22],
    	["store_id"=> 166, "district_id" => 14],["store_id"=> 167, "district_id" => 14],["store_id"=> 168, "district_id" => 20],["store_id"=> 169, "district_id" => 10],["store_id"=> 170, "district_id" => 20],
    	["store_id"=> 171, "district_id" => 21],["store_id"=> 172, "district_id" => 2],["store_id"=> 173, "district_id" => 1],["store_id"=> 174, "district_id" => 8],["store_id"=> 175, "district_id" => 5],
    	["store_id"=> 176, "district_id" => 2],["store_id"=> 177, "district_id" => 2],["store_id"=> 178, "district_id" => 19],["store_id"=> 179, "district_id" => 4],["store_id"=> 180, "district_id" => 1],
    	["store_id"=> 181, "district_id" => 17],["store_id"=> 182, "district_id" => 20],["store_id"=> 183, "district_id" => 10],["store_id"=> 184, "district_id" => 6],["store_id"=> 185, "district_id" => 5],
    	["store_id"=> 186, "district_id" => 20],["store_id"=> 187, "district_id" => 4],["store_id"=> 188, "district_id" => 4],["store_id"=> 189, "district_id" => 7],["store_id"=> 190, "district_id" => 3],
    	["store_id"=> 191, "district_id" => 8],["store_id"=> 192, "district_id" => 9],["store_id"=> 193, "district_id" => 8],["store_id"=> 194, "district_id" => 5],["store_id"=> 195, "district_id" => 22],
    	["store_id"=> 196, "district_id" => 1],["store_id"=> 197, "district_id" => 2],["store_id"=> 198, "district_id" => 14],["store_id"=> 199, "district_id" => 18],["store_id"=> 200, "district_id" => 14],
    	["store_id"=> 201, "district_id" => 21],["store_id"=> 202, "district_id" => 21],["store_id"=> 203, "district_id" => 5],["store_id"=> 204, "district_id" => 11],["store_id"=> 205, "district_id" => 19],
    	["store_id"=> 206, "district_id" => 17],["store_id"=> 207, "district_id" => 21],["store_id"=> 208, "district_id" => 17],["store_id"=> 209, "district_id" => 15],["store_id"=> 210, "district_id" => 10],
    	["store_id"=> 211, "district_id" => 11],["store_id"=> 212, "district_id" => 4],["store_id"=> 213, "district_id" => 7],["store_id"=> 214, "district_id" => 22],["store_id"=> 215, "district_id" => 4],
    	["store_id"=> 216, "district_id" => 10],["store_id"=> 217, "district_id" => 16],["store_id"=> 218, "district_id" => 6],["store_id"=> 219, "district_id" => 2],["store_id"=> 220, "district_id" => 2],
    	["store_id"=> 221, "district_id" => 8],["store_id"=> 222, "district_id" => 21],["store_id"=> 223, "district_id" => 15],["store_id"=> 224, "district_id" => 1],["store_id"=> 225, "district_id" => 9],
    	["store_id"=> 226, "district_id" => 9],["store_id"=> 227, "district_id" => 22],["store_id"=> 228, "district_id" => 21],["store_id"=> 229, "district_id" => 8],["store_id"=> 230, "district_id" => 2],
    	["store_id"=> 231, "district_id" => 6],["store_id"=> 232, "district_id" => 15],["store_id"=> 233, "district_id" => 14],["store_id"=> 234, "district_id" => 10],["store_id"=> 235, "district_id" => 13],
    	["store_id"=> 236, "district_id" => 13],["store_id"=> 237, "district_id" => 13],["store_id"=> 238, "district_id" => 13],["store_id"=> 239, "district_id" => 12],["store_id"=> 240, "district_id" => 12],
    	["store_id"=> 241, "district_id" => 14],["store_id"=> 242, "district_id" => 13],["store_id"=> 243, "district_id" => 9],["store_id"=> 244, "district_id" => 15],["store_id"=> 245, "district_id" => 8],
    	["store_id"=> 246, "district_id" => 17],["store_id"=> 247, "district_id" => 8],["store_id"=> 248, "district_id" => 19],["store_id"=> 249, "district_id" => 21],["store_id"=> 250, "district_id" => 13],
    	["store_id"=> 251, "district_id" => 1],["store_id"=> 252, "district_id" => 1],["store_id"=> 253, "district_id" => 1],["store_id"=> 254, "district_id" => 19],["store_id"=> 255, "district_id" => 19]
];
  

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->districtsStores as $value) {
        	DB::table('district_store')->insert($value);
        }
    }
}
