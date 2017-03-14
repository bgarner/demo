<?php

use Illuminate\Database\Seeder;

class ResourcesTableSeeder extends Seeder
{
    private $resources = [
        ['id' => 1, 'resource_name' => 'store',    'resource_id' => '0100'],
        ['id' => 2, 'resource_name' => 'store',    'resource_id' => '0102'],
        ['id' => 3, 'resource_name' => 'store',    'resource_id' => '0107'],
        ['id' => 4, 'resource_name' => 'store',    'resource_id' => '0143'],
        ['id' => 5, 'resource_name' => 'store',    'resource_id' => '0155'],
        ['id' => 6, 'resource_name' => 'store',    'resource_id' => '0158'],
        ['id' => 7, 'resource_name' => 'store',    'resource_id' => '0162'],
        ['id' => 8, 'resource_name' => 'store',    'resource_id' => '0163'],
        ['id' => 9, 'resource_name' => 'store',    'resource_id' => '0164'],
        ['id' => 10, 'resource_name' => 'store',    'resource_id' => '0171'],
        ['id' => 11, 'resource_name' => 'store',    'resource_id' => '0172'],
        ['id' => 12, 'resource_name' => 'store',    'resource_id' => '0185'],
        ['id' => 13, 'resource_name' => 'store',    'resource_id' => '0187'],
        ['id' => 14, 'resource_name' => 'store',    'resource_id' => '0195'],
        ['id' => 15, 'resource_name' => 'store',    'resource_id' => '0201'],
        ['id' => 16, 'resource_name' => 'store',    'resource_id' => '0208'],
        ['id' => 17, 'resource_name' => 'store',    'resource_id' => '0213'],
        ['id' => 18, 'resource_name' => 'store',    'resource_id' => '0219'],
        ['id' => 19, 'resource_name' => 'store',    'resource_id' => '0221'],
        ['id' => 20, 'resource_name' => 'store',    'resource_id' => '0223'],
        ['id' => 21, 'resource_name' => 'store',    'resource_id' => '0224'],
        ['id' => 22, 'resource_name' => 'store',    'resource_id' => '0225'],
        ['id' => 23, 'resource_name' => 'store',    'resource_id' => '0227'],
        ['id' => 24, 'resource_name' => 'store',    'resource_id' => '0228'],
        ['id' => 25, 'resource_name' => 'store',    'resource_id' => '0229'],
        ['id' => 26, 'resource_name' => 'store',    'resource_id' => '0230'],
        ['id' => 27, 'resource_name' => 'store',    'resource_id' => '0231'],
        ['id' => 28, 'resource_name' => 'store',    'resource_id' => '0232'],
        ['id' => 29, 'resource_name' => 'store',    'resource_id' => '0233'],
        ['id' => 30, 'resource_name' => 'store',    'resource_id' => '0234'],
        ['id' => 31, 'resource_name' => 'store',    'resource_id' => '0235'],
        ['id' => 32, 'resource_name' => 'store',    'resource_id' => '0236'],
        ['id' => 33, 'resource_name' => 'store',    'resource_id' => '0237'],
        ['id' => 34, 'resource_name' => 'store',    'resource_id' => '0238'],
        ['id' => 35, 'resource_name' => 'store',    'resource_id' => '0239'],
        ['id' => 36, 'resource_name' => 'store',    'resource_id' => '0240'],
        ['id' => 37, 'resource_name' => 'store',    'resource_id' => '0241'],
        ['id' => 38, 'resource_name' => 'store',    'resource_id' => '0242'],
        ['id' => 39, 'resource_name' => 'store',    'resource_id' => '0243'],
        ['id' => 40, 'resource_name' => 'store',    'resource_id' => '0244'],
        ['id' => 41, 'resource_name' => 'store',    'resource_id' => '0245'],
        ['id' => 42, 'resource_name' => 'store',    'resource_id' => '0246'],
        ['id' => 43, 'resource_name' => 'store',    'resource_id' => '0247'],
        ['id' => 44, 'resource_name' => 'store',    'resource_id' => '0248'],
        ['id' => 45, 'resource_name' => 'store',    'resource_id' => '0249'],
        ['id' => 46, 'resource_name' => 'store',    'resource_id' => '0250'],
        ['id' => 47, 'resource_name' => 'store',    'resource_id' => '0251'],
        ['id' => 48, 'resource_name' => 'store',    'resource_id' => '0252'],
        ['id' => 49, 'resource_name' => 'store',    'resource_id' => '0253'],
        ['id' => 50, 'resource_name' => 'store',    'resource_id' => '0254'],
        ['id' => 51, 'resource_name' => 'store',    'resource_id' => '0255'],
        ['id' => 52, 'resource_name' => 'store',    'resource_id' => '0256'],
        ['id' => 53, 'resource_name' => 'store',    'resource_id' => '0257'],
        ['id' => 54, 'resource_name' => 'store',    'resource_id' => '0258'],
        ['id' => 55, 'resource_name' => 'store',    'resource_id' => '0259'],
        ['id' => 56, 'resource_name' => 'store',    'resource_id' => '0260'],
        ['id' => 57, 'resource_name' => 'store',    'resource_id' => '0262'],
        ['id' => 58, 'resource_name' => 'store',    'resource_id' => '0263'],
        ['id' => 59, 'resource_name' => 'store',    'resource_id' => '0264'],
        ['id' => 60, 'resource_name' => 'store',    'resource_id' => '0265'],
        ['id' => 61, 'resource_name' => 'store',    'resource_id' => '0266'],
        ['id' => 62, 'resource_name' => 'store',    'resource_id' => '0267'],
        ['id' => 63, 'resource_name' => 'store',    'resource_id' => '0268'],
        ['id' => 64, 'resource_name' => 'store',    'resource_id' => '0270'],
        ['id' => 65, 'resource_name' => 'store',    'resource_id' => '0271'],
        ['id' => 66, 'resource_name' => 'store',    'resource_id' => '0272'],
        ['id' => 67, 'resource_name' => 'store',    'resource_id' => '0273'],
        ['id' => 68, 'resource_name' => 'store',    'resource_id' => '0274'],
        ['id' => 69, 'resource_name' => 'store',    'resource_id' => '0275'],
        ['id' => 70, 'resource_name' => 'store',    'resource_id' => '0276'],
        ['id' => 71, 'resource_name' => 'store',    'resource_id' => '0277'],
        ['id' => 72, 'resource_name' => 'store',    'resource_id' => '0278'],
        ['id' => 73, 'resource_name' => 'store',    'resource_id' => '0279'],
        ['id' => 74, 'resource_name' => 'store',    'resource_id' => '0280'],
        ['id' => 75, 'resource_name' => 'store',    'resource_id' => '0281'],
        ['id' => 76, 'resource_name' => 'store',    'resource_id' => '0282'],
        ['id' => 77, 'resource_name' => 'store',    'resource_id' => '0283'],
        ['id' => 78, 'resource_name' => 'store',    'resource_id' => '0284'],
        ['id' => 79, 'resource_name' => 'store',    'resource_id' => '0285'],
        ['id' => 80, 'resource_name' => 'store',    'resource_id' => '0288'],
        ['id' => 81, 'resource_name' => 'store',    'resource_id' => '0290'],
        ['id' => 82, 'resource_name' => 'store',    'resource_id' => '0291'],
        ['id' => 83, 'resource_name' => 'store',    'resource_id' => '0292'],
        ['id' => 84, 'resource_name' => 'store',    'resource_id' => '0293'],
        ['id' => 85, 'resource_name' => 'store',    'resource_id' => '0294'],
        ['id' => 86, 'resource_name' => 'store',    'resource_id' => '0296'],
        ['id' => 87, 'resource_name' => 'store',    'resource_id' => '0297'],
        ['id' => 88, 'resource_name' => 'store',    'resource_id' => '0298'],
        ['id' => 89, 'resource_name' => 'store',    'resource_id' => '0299'],
        ['id' => 90, 'resource_name' => 'store',    'resource_id' => '0300'],
        ['id' => 91, 'resource_name' => 'store',    'resource_id' => '0303'],
        ['id' => 92, 'resource_name' => 'store',    'resource_id' => '0304'],
        ['id' => 93, 'resource_name' => 'store',    'resource_id' => '0308'],
        ['id' => 94, 'resource_name' => 'store',    'resource_id' => '0309'],
        ['id' => 95, 'resource_name' => 'store',    'resource_id' => '0310'],
        ['id' => 96, 'resource_name' => 'store',    'resource_id' => '0311'],
        ['id' => 97, 'resource_name' => 'store',    'resource_id' => '0312'],
        ['id' => 98, 'resource_name' => 'store',    'resource_id' => '0313'],
        ['id' => 99, 'resource_name' => 'store',    'resource_id' => '0314'],
        ['id' => 100, 'resource_name' => 'store',    'resource_id' => '0316'],
        ['id' => 101, 'resource_name' => 'store',    'resource_id' => '0317'],
        ['id' => 102, 'resource_name' => 'store',    'resource_id' => '0318'],
        ['id' => 103, 'resource_name' => 'store',    'resource_id' => '0319'],
        ['id' => 104, 'resource_name' => 'store',    'resource_id' => '0320'],
        ['id' => 105, 'resource_name' => 'store',    'resource_id' => '0322'],
        ['id' => 106, 'resource_name' => 'store',    'resource_id' => '0323'],
        ['id' => 107, 'resource_name' => 'store',    'resource_id' => '0327'],
        ['id' => 108, 'resource_name' => 'store',    'resource_id' => '0328'],
        ['id' => 109, 'resource_name' => 'store',    'resource_id' => '0329'],
        ['id' => 110, 'resource_name' => 'store',    'resource_id' => '0330'],
        ['id' => 111, 'resource_name' => 'store',    'resource_id' => '0334'],
        ['id' => 112, 'resource_name' => 'store',    'resource_id' => '0335'],
        ['id' => 113, 'resource_name' => 'store',    'resource_id' => '0336'],
        ['id' => 114, 'resource_name' => 'store',    'resource_id' => '0337'],
        ['id' => 115, 'resource_name' => 'store',    'resource_id' => '0338'],
        ['id' => 116, 'resource_name' => 'store',    'resource_id' => '0339'],
        ['id' => 117, 'resource_name' => 'store',    'resource_id' => '0340'],
        ['id' => 118, 'resource_name' => 'store',    'resource_id' => '0341'],
        ['id' => 119, 'resource_name' => 'store',    'resource_id' => '0342'],
        ['id' => 120, 'resource_name' => 'store',    'resource_id' => '0344'],
        ['id' => 121, 'resource_name' => 'store',    'resource_id' => '0345'],
        ['id' => 122, 'resource_name' => 'store',    'resource_id' => '0346'],
        ['id' => 123, 'resource_name' => 'store',    'resource_id' => '0347'],
        ['id' => 124, 'resource_name' => 'store',    'resource_id' => '0348'],
        ['id' => 125, 'resource_name' => 'store',    'resource_id' => '0349'],
        ['id' => 126, 'resource_name' => 'store',    'resource_id' => '0350'],
        ['id' => 127, 'resource_name' => 'store',    'resource_id' => '0351'],
        ['id' => 128, 'resource_name' => 'store',    'resource_id' => '0352'],
        ['id' => 129, 'resource_name' => 'store',    'resource_id' => '0353'],
        ['id' => 130, 'resource_name' => 'store',    'resource_id' => '0354'],
        ['id' => 131, 'resource_name' => 'store',    'resource_id' => '0355'],
        ['id' => 132, 'resource_name' => 'store',    'resource_id' => '0356'],
        ['id' => 133, 'resource_name' => 'store',    'resource_id' => '0357'],
        ['id' => 134, 'resource_name' => 'store',    'resource_id' => '0358'],
        ['id' => 135, 'resource_name' => 'store',    'resource_id' => '0359'],
        ['id' => 136, 'resource_name' => 'store',    'resource_id' => '0361'],
        ['id' => 137, 'resource_name' => 'store',    'resource_id' => '0362'],
        ['id' => 138, 'resource_name' => 'store',    'resource_id' => '0363'],
        ['id' => 139, 'resource_name' => 'store',    'resource_id' => '0364'],
        ['id' => 140, 'resource_name' => 'store',    'resource_id' => '0365'],
        ['id' => 141, 'resource_name' => 'store',    'resource_id' => '0366'],
        ['id' => 142, 'resource_name' => 'store',    'resource_id' => '0367'],
        ['id' => 143, 'resource_name' => 'store',    'resource_id' => '0368'],
        ['id' => 144, 'resource_name' => 'store',    'resource_id' => '0369'],
        ['id' => 145, 'resource_name' => 'store',    'resource_id' => '0370'],
        ['id' => 146, 'resource_name' => 'store',    'resource_id' => '0371'],
        ['id' => 147, 'resource_name' => 'store',    'resource_id' => '0375'],
        ['id' => 148, 'resource_name' => 'store',    'resource_id' => '0377'],
        ['id' => 149, 'resource_name' => 'store',    'resource_id' => '0379'],
        ['id' => 150, 'resource_name' => 'store',    'resource_id' => '0380'],
        ['id' => 151, 'resource_name' => 'store',    'resource_id' => '0381'],
        ['id' => 152, 'resource_name' => 'store',    'resource_id' => '0382'],
        ['id' => 153, 'resource_name' => 'store',    'resource_id' => '0383'],
        ['id' => 154, 'resource_name' => 'store',    'resource_id' => '0384'],
        ['id' => 155, 'resource_name' => 'store',    'resource_id' => '0385'],
        ['id' => 156, 'resource_name' => 'store',    'resource_id' => '0386'],
        ['id' => 157, 'resource_name' => 'store',    'resource_id' => '0389'],
        ['id' => 158, 'resource_name' => 'store',    'resource_id' => '0391'],
        ['id' => 159, 'resource_name' => 'store',    'resource_id' => '0392'],
        ['id' => 160, 'resource_name' => 'store',    'resource_id' => '0393'],
        ['id' => 161, 'resource_name' => 'store',    'resource_id' => '0394'],
        ['id' => 162, 'resource_name' => 'store',    'resource_id' => '0395'],
        ['id' => 163, 'resource_name' => 'store',    'resource_id' => '0398'],
        ['id' => 164, 'resource_name' => 'store',    'resource_id' => '0401'],
        ['id' => 165, 'resource_name' => 'store',    'resource_id' => '0419'],
        ['id' => 166, 'resource_name' => 'store',    'resource_id' => '5111'],
        ['id' => 167, 'resource_name' => 'store',    'resource_id' => '5112'],
        ['id' => 168, 'resource_name' => 'store',    'resource_id' => '5113'],
        ['id' => 169, 'resource_name' => 'store',    'resource_id' => '5114'],
        ['id' => 170, 'resource_name' => 'store',    'resource_id' => '5115'],
        ['id' => 171, 'resource_name' => 'store',    'resource_id' => '5116'],
        ['id' => 172, 'resource_name' => 'store',    'resource_id' => '5117'],
        ['id' => 173, 'resource_name' => 'store',    'resource_id' => '5118'],
        ['id' => 174, 'resource_name' => 'store',    'resource_id' => '5119'],
        ['id' => 175, 'resource_name' => 'store',    'resource_id' => '5120'],
        ['id' => 176, 'resource_name' => 'store',    'resource_id' => '5121'],
        ['id' => 177, 'resource_name' => 'store',    'resource_id' => '5122'],
        ['id' => 178, 'resource_name' => 'store',    'resource_id' => '5123'],
        ['id' => 179, 'resource_name' => 'store',    'resource_id' => '5124'],
        ['id' => 180, 'resource_name' => 'store',    'resource_id' => '5125'],
        ['id' => 181, 'resource_name' => 'store',    'resource_id' => '5126'],
        ['id' => 182, 'resource_name' => 'store',    'resource_id' => '5127'],
        ['id' => 183, 'resource_name' => 'store',    'resource_id' => '5128'],
        ['id' => 184, 'resource_name' => 'store',    'resource_id' => '5129'],
        ['id' => 185, 'resource_name' => 'store',    'resource_id' => '5131'],
        ['id' => 186, 'resource_name' => 'store',    'resource_id' => '5132'],
        ['id' => 187, 'resource_name' => 'store',    'resource_id' => '5133'],
        ['id' => 188, 'resource_name' => 'store',    'resource_id' => '5134'],
        ['id' => 189, 'resource_name' => 'store',    'resource_id' => '5135'],
        ['id' => 190, 'resource_name' => 'store',    'resource_id' => '5136'],
        ['id' => 191, 'resource_name' => 'store',    'resource_id' => '5138'],
        ['id' => 192, 'resource_name' => 'store',    'resource_id' => '5139'],
        ['id' => 193, 'resource_name' => 'store',    'resource_id' => '5140'],
        ['id' => 194, 'resource_name' => 'store',    'resource_id' => '5141'],
        ['id' => 195, 'resource_name' => 'store',    'resource_id' => '5142'],
        ['id' => 196, 'resource_name' => 'store',    'resource_id' => '5143'],
        ['id' => 197, 'resource_name' => 'store',    'resource_id' => '5144'],
        ['id' => 198, 'resource_name' => 'store',    'resource_id' => '5145'],
        ['id' => 199, 'resource_name' => 'store',    'resource_id' => '5148'],
        ['id' => 200, 'resource_name' => 'store',    'resource_id' => '5149'],
        ['id' => 201, 'resource_name' => 'store',    'resource_id' => '5150'],
        ['id' => 202, 'resource_name' => 'store',    'resource_id' => '5151'],
        ['id' => 203, 'resource_name' => 'store',    'resource_id' => '5154'],
        ['id' => 204, 'resource_name' => 'store',    'resource_id' => '5155'],
        ['id' => 205, 'resource_name' => 'store',    'resource_id' => '5156'],
        ['id' => 206, 'resource_name' => 'store',    'resource_id' => '5157'],
        ['id' => 207, 'resource_name' => 'store',    'resource_id' => '7401'],
        ['id' => 208, 'resource_name' => 'store',    'resource_id' => '7402'],
        ['id' => 209, 'resource_name' => 'store',    'resource_id' => '7403'],
        ['id' => 210, 'resource_name' => 'store',    'resource_id' => '7404'],
        ['id' => 211, 'resource_name' => 'store',    'resource_id' => '7406'],
        ['id' => 212, 'resource_name' => 'store',    'resource_id' => '7407'],
        ['id' => 213, 'resource_name' => 'store',    'resource_id' => '7408'],
        ['id' => 214, 'resource_name' => 'store',    'resource_id' => '7410'],
        ['id' => 215, 'resource_name' => 'store',    'resource_id' => '7411'],
        ['id' => 216, 'resource_name' => 'store',    'resource_id' => '7412'],
        ['id' => 217, 'resource_name' => 'store',    'resource_id' => '7413'],
        ['id' => 218, 'resource_name' => 'store',    'resource_id' => '7414'],
        ['id' => 219, 'resource_name' => 'store',    'resource_id' => '5159'],
        ['id' => 220, 'resource_name' => 'store',    'resource_id' => '5161'],
        ['id' => 221, 'resource_name' => 'store',    'resource_id' => '5153'],
        ['id' => 222, 'resource_name' => 'store',    'resource_id' => '5158'],
        ['id' => 223, 'resource_name' => 'store',    'resource_id' => '7415'],
        ['id' => 224, 'resource_name' => 'store',    'resource_id' => '5165'],
        ['id' => 225, 'resource_name' => 'store',    'resource_id' => '5166'],
        ['id' => 226, 'resource_name' => 'store',    'resource_id' => '5167'],
        ['id' => 227, 'resource_name' => 'store',    'resource_id' => '0940'],
    	['id' => 228, 'resource_name' => 'district', 'resource_id' => '1' ],
    	['id' => 229, 'resource_name' => 'district', 'resource_id' => '2' ],
    	['id' => 230, 'resource_name' => 'district', 'resource_id' => '3' ],
    	['id' => 231, 'resource_name' => 'district', 'resource_id' => '4' ],
    	['id' => 232, 'resource_name' => 'district', 'resource_id' => '5' ],
    	['id' => 233, 'resource_name' => 'district', 'resource_id' => '6' ],
    	['id' => 234, 'resource_name' => 'district', 'resource_id' => '7' ],
    	['id' => 235, 'resource_name' => 'district', 'resource_id' => '8' ],
    	['id' => 236, 'resource_name' => 'district', 'resource_id' => '9' ],
    	['id' => 237, 'resource_name' => 'district', 'resource_id' => '10' ],
    	['id' => 238, 'resource_name' => 'district', 'resource_id' => '11' ],
    	['id' => 239, 'resource_name' => 'district', 'resource_id' => '12' ],
    	['id' => 240, 'resource_name' => 'district', 'resource_id' => '13' ],
    	['id' => 241, 'resource_name' => 'district', 'resource_id' => '14' ],
    	['id' => 242, 'resource_name' => 'district', 'resource_id' => '15' ],
    	['id' => 243, 'resource_name' => 'district', 'resource_id' => '16' ],
    	['id' => 244, 'resource_name' => 'district', 'resource_id' => '17' ],
    	['id' => 245, 'resource_name' => 'district', 'resource_id' => '18' ],
    	['id' => 246, 'resource_name' => 'district', 'resource_id' => '19' ],
    	['id' => 247, 'resource_name' => 'district', 'resource_id' => '20' ],
    	['id' => 248, 'resource_name' => 'district', 'resource_id' => '21' ],
    	['id' => 249, 'resource_name' => 'district', 'resource_id' => '22' ],
    	['id' => 250, 'resource_name' => 'region',   'resource_id' => '1' ],
    	['id' => 251, 'resource_name' => 'region',   'resource_id' => '2' ],
    	['id' => 252, 'resource_name' => 'region',   'resource_id' => '3' ],
    	['id' => 253, 'resource_name' => 'region',   'resource_id' => '4' ],
        ['id' => 254, 'resource_name' => 'regions',  'resource_id' => null]
    	
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->resources as $resource) {
        	DB::table('resources')->insert($resource);
        }
    }
}
