<?php

use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    
    private $stores = [
	["store_id" => 339, "store_number" =>'A0339', "is_combo_store" => 1, "name" => 'Gateway Mall', "address" => 'Unit 500, 1403 Central Avenue', "city"=> 'PRINCE ALBERT', "province" => 'SK', "postal_code" => 'S6V 7J4', "lat" => 53.199569,  "long" =>  -105.754274, "sqft" => 25366, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 243, "store_number" =>'A0243', "is_combo_store" => 1, "name" => 'Sherway Gardens',"address" => 'Unit # B1, 167 North Queen Street', "city"=> 'ETOBICOKE', "province" => 'ON', "postal_code" => 'M9C 1A7', "lat" => 43.619040,  "long" =>  -79.555765, "sqft" => 32646, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 357, "store_number" =>'A0357', "is_combo_store" => 1, "name" => 'Masonville', "address" => 'Unit 3, 1735 Richmond Street', "city"=> 'LONDON', "province" => 'ON', "postal_code" => 'N5X 3Y2', "lat" => 43.028366,  "long" =>  -81.283616, "sqft" => 18000, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 259, "store_number" =>'A0259', "is_combo_store" => 1, "name" => 'Guelph',"address" => 'CRU#R1, 435 Stone Road West', "city"=> 'GUELPH', "province" => 'ON', "postal_code" => 'N1G 2X6', "lat" => 43.518705,  "long" =>  -80.237438, "sqft" => 20300, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 274, "store_number" =>'A0274', "is_combo_store" => 1, "name" => 'Halifax Shopping Centre',"address" =>'Unit #1, 7001 Mumford Road', "city"=> 'HALIFAX', "province" => 'NS', "postal_code" => 'B3L 4L9', "lat" => 44.648227,  "long" =>  -63.620527, "sqft" => 51871, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 314, "store_number" =>'A0314', "is_combo_store" => 1, "name" => 'West Edmonton Mall', "address" => 'Suite 1119, 8882 170th Street, Phase I', "city"=> 'EDMONTON', "province" => 'AB', "postal_code" => 'T5T 4M2', "lat" => 53.533333,  "long" =>  -113.500000, "sqft" => 80468, "mall_entrance" => 1, "entrances" => 3, "cashbanks" => 3],

	["store_id" => 419, "store_number" =>'A0419', "is_combo_store" => 1, "name" => 'Georgian Mall', "address" => 'Hwy 26 & 27, 509 Bayfield Street', "city"=> 'BARRIE', "province" => 'ON', "postal_code" => 'L4M 4Z8', "lat" => 44.416661,  "long" =>  -79.713802, "sqft" => 40734, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 277, "store_number" =>'A0277', "is_combo_store" => 1, "name" => 'Edmonton City Centre', "address" => '# 124 Edmonton City Centre, Main Level', "city"=> 'EDMONTON', "province" => 'AB', "postal_code" => 'T5J 2Y9', "lat" => 53.533333,  "long" =>  -113.500000, "sqft" => 35825, "mall_entrance" => 1, "entrances" => 3, "cashbanks" => 2],
	["store_id" => 272, "store_number" =>'A0272', "is_combo_store" => 1, "name" => 'Richmond', "address" => 'Unit # 1140, 6551 No. 3 Road', "city"=> 'RICHMOND', "province" => 'BC', "postal_code" => 'V6Y 2B6', "lat" => 49.166509,  "long" =>  -123.137811, "sqft" => 45494, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 334, "store_number" =>'A0334', "is_combo_store" => 1, "name" => 'Park Royal', "address" => '1000 Park Royal Mall South', "city"=> 'VANCOUVER', "province" => 'BC', "postal_code" => 'V7T 1A1', "lat" => 49.337494,  "long" =>  -123.160123, "sqft" => 51000, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 317, "store_number" =>'A0317', "is_combo_store" => 1, "name" => 'Winston Churchill', "address" => 'Unit 2, 2460 Winston Churchill Blvd E', "city"=> 'OAKVILLE', "province" => 'ON', "postal_code" => 'L6H 6J5', "lat" => 43.521278,  "long" =>  -79.679657, "sqft" => 32281, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 386, "store_number" =>'A0386', "is_combo_store" => 1, "name" => 'Station Mall', "address" => 'Unit 66A, 44 Great Northern Road',"city"=> 'SAULT STE MARIE', "province" => 'ON', "postal_code" => 'P6B 4Y5', "lat" => 46.525067,  "long" =>  -84.319393, "sqft" => 31350, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 5120, "store_number" =>'A5120', "is_combo_store" => 1, "name" => 'Hillside Mall', "address"=>'CRU86 & 89, 1644 Hillside Avenue', "city"=> 'VICTORIA', "province" => 'BC', "postal_code" => 'V8T 2C5', "lat" => 48.445737,  "long" =>  -123.335285, "sqft" => 27477, "mall_entrance" => 1, "entrances" => 3, "cashbanks" => 2],

	["store_id" => 260, "store_number" =>'A0260', "is_combo_store" => 1, "name" => 'Beacon Hill',"address"=>'Unit #D7, 11626 Sarcee Trail NW', "city"=> 'CALGARY', "province" => 'AB', "postal_code" => 'T3R 0A1', "lat" => 51.157538,  "long" =>  -114.162137, "sqft" => 27985, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 345, "store_number" =>'A0345', "is_combo_store" => 1, "name" => 'Pembina',"address"=>'Unit 3, 1910 Pembina Hwy South', "city"=> 'Winnipeg', "province" => 'MB', "postal_code" => 'R3T 4S5', "lat" => 49.821533,  "long" =>  -97.152573, "sqft" => 35170, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 348, "store_number" =>'A0348', "is_combo_store" => 1, "name" => 'Sherwood Park Mall',"address"=>'Unit 15, 2020 Sherwood Place',"city"=>'SHERWOOD PARK', "province" => 'AB', "postal_code" => 'T8A 3H9', "lat" => 53.531150,  "long" =>  -113.295446, "sqft" => 14111, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5134, "store_number" =>'A5134', "is_combo_store" => 1, "name" => 'London',"address"=>'3165 Wonderland Road South', "city"=> 'LONDON', "province" => 'ON', "postal_code" => 'N6L 1R4', "lat" => 42.933384,  "long" =>  -81.283541, "sqft" => 29048, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 5122, "store_number" =>'A5122', "is_combo_store" => 1, "name" => 'Bowmanville',"address"=>'2401 Highway 2, Unit #1&2', "city"=> 'Bowmanville', "province" => 'ON', "postal_code" => 'L1C 4V4', "lat" => 43.908659,  "long" =>  -78.706166, "sqft" => 37873, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 296, "store_number" =>'A0296', "is_combo_store" => 1, "name" => 'New North Bay Mall', "address"=> 'Unit #101, 300 Lakeshore Drive',"city"=>'North Bay', "province" => 'ON', "postal_code" => 'P1A 3V2', "lat" => 46.283148,  "long" =>  -79.448755, "sqft" => 29985, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 320, "store_number" =>'A0320', "is_combo_store" => 1, "name" => 'St. Albert Centre',"address"=>'Unit 103, 375 St. Albert Road',"city"=> 'St.Albert', "province" => 'AB', "postal_code" => 'T8N 3K8', "lat" => 53.640596,  "long" =>  -113.624979, "sqft" => 35093, "mall_entrance" => 1, "entrances" => 3, "cashbanks" => 2],

	["store_id" => 323, "store_number" =>'A0323', "is_combo_store" => 1, "name" => 'Redcliff',"address"=>'Unit #503, 1100 Pembroke Street East', "city"=> 'Pembrooke', "province" => 'ON', "postal_code" => 'K8A 6Y7', "lat" => 45.820550,  "long" =>  -77.083929, "sqft" => 30030, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 5142, "store_number" =>'A5142', "is_combo_store" => 1, "name" => 'Westshore',"address"=>'Unit 109, 2955 Phipps Road', "city"=> 'LANGFORD', "province" => 'BC', "postal_code" => 'V9B 0J9', "lat" => 48.439752,  "long" =>  -123.505100, "sqft" => 25825, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5148, "store_number" =>'A5148', "is_combo_store" => 1, "name" => 'Barrie-South',"address"=>'Unit 4, 80 Concert Way', "city"=> 'Barrie', "province" => 'ON', "postal_code" => 'L4N 6N5', "lat" => 44.365817,  "long" =>  -79.695962, "sqft" => 30423, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 300, "store_number" =>'A0300', "is_combo_store" => 1, "name" => 'Aberdeen Mall',"address"=>'Unit #Y0500, 1320 West Trans Canada Hwy', "city"=> 'KAMLOOPS', "province" => 'BC', "postal_code" => 'V1S 1J2', "lat" => 50.654391,  "long" =>  -120.371092, "sqft" => 28213, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 313, "store_number" =>'A0313', "is_combo_store" => 1, "name" => 'Medicine Hat',"address"=>'Unit 1, 46 Carry Drive S.E.', "city"=> 'MEDICINE HAT', "province" => 'AB', "postal_code" => 'T1B 4E1', "lat" => 50.005412,  "long" =>  -110.649279, "sqft" => 34304, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 5128, "store_number" =>'A5128', "is_combo_store" => 1, "name" => 'Georgetown',"address"=>'Units 70 & 71, 280 Guelph Street', "city"=> 'Georgetown', "province" => 'ON', "postal_code" => 'L7G 4B1', "lat" => 43.649192,  "long" =>  -79.899329, "sqft" => 29508, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5143, "store_number" =>'A5143', "is_combo_store" => 1, "name" => 'Yorkton',"address"=>'Unit 7, 205 Hamilton Road', "city"=> 'YORKTON', "province" => 'SK', "postal_code" => 'S3N 4B9', "lat" => 51.207031,  "long" =>  -102.450445, "sqft" => 29433, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 100, "store_number" =>'0100', "is_combo_store" => 0, "name" => 'Kitsilano', "address"=>'1625 Chestnut Street', "city"=> 'Vancouver', "province" => 'BC', "postal_code" => 'V6J 4M6', "lat" => 49.271557,  "long" =>  -123.146418, "sqft" => 10775, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 102, "store_number" =>'0102', "is_combo_store" => 0, "name" => 'Prince George', "address"=> 'Unit #195, 1600-15 Avenue',"city"=> 'PRINCE GEORGE', "province" => 'BC', "postal_code" => 'V2L 3X3', "lat" => 53.910431,  "long" =>  -122.760715, "sqft" => 7234, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 107, "store_number" =>'0107', "is_combo_store" => 0, "name" => 'Calgary',"address"=>'817-10 Avenue SW', "city"=> 'CALGARY', "province" => 'AB', "postal_code" => 'T2R 0B4', "lat" => 51.043705,  "long" =>  -114.080016, "sqft" => 7229, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 143, "store_number" =>'0143', "is_combo_store" => 0, "name" => 'Kingston',"address"=>'Unit F5, 628 Gardiners Road', "city"=> 'KINGSTON', "province" => 'ON', "postal_code" => 'K7M 3X9', "lat" => 44.245838,  "long" =>  -76.563616, "sqft" => 10130, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 155, "store_number" =>'0155', "is_combo_store" => 0, "name" => 'Deerfoot Meadows', "address"=>'Unit #500, 8180-11 Street SE',"city"=>'CALGARY', "province" => 'AB', "postal_code" => 'T2H 3B5', "lat" =>50.978314,  "long" => -114.041496, "sqft" => 7556.8, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 158, "store_number" =>'0158', "is_combo_store" => 0, "name" => 'Southland Mall', "address"=> 'Unit 1Y1-C, 2715 Gordon Road', "city"=> 'Regina', "province" => 'SK', "postal_code" => 'S4S 6H8', "lat" => 50.403283,  "long" =>  -104.621711, "sqft" => 8879, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 162, "store_number" =>'0162', "is_combo_store" => 0, "name" => 'Langley Power Centre', "address"=>'Unit #60, 20150 Langley By-Pass', "city"=> 'LANGLEY', "province" => 'BC', "postal_code" => 'V3A 9J8', "lat" => 49.098755,  "long" =>  -122.654594, "sqft" => 16040, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 163, "store_number" =>'0163', "is_combo_store" => 0, "name" => 'Coquitlam Centre',"address"=> 'Unit #2860, 2929 Barnett Hwy', "city"=> 'COQUITLAM', "province" => 'BC', "postal_code" => 'V3B 5R5', "lat" => 49.276941,  "long" =>  -122.799472, "sqft" => 9627, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 164, "store_number" =>'0164', "is_combo_store" => 0, "name" => 'Red Deer', "address"=>'#300, 5001 19th Street',"city"=> 'RED DEER', "province" => 'AB', "postal_code" => 'T4R 3R1', "lat" => 52.232876,  "long" =>  -113.813905, "sqft" => 6581, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 171, "store_number" =>'0171', "is_combo_store" => 0, "name" => 'Banff',"address"=>'122 Banff Avenue',"city"=>'BANFF',"province" => 'AB', "postal_code" => 'T0L 0C0',"lat" => 51.175597,"long" =>  -115.570789, "sqft" => 4605.4, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 172, "store_number" =>'0172', "is_combo_store" => 0, "name" => 'South Ed Common',"address"=>'1612-99 Street NW', "city"=> 'EDMONTON', "province" => 'AB', "postal_code" => 'T6N 1M5', "lat" => 53.442523,  "long" =>  -113.482421, "sqft" => 8222, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 185, "store_number" =>'0185', "is_combo_store" => 0, "name" => 'Market Mall',"address"=>'Unit #G008B, 3625 Shaganappi Tr. NW', "city"=> 'CALGARY', "province" => 'AB', "postal_code" => 'T3A 0E2', "lat" => 51.082854,  "long" =>  -114.157360, "sqft" => 7321, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 187, "store_number" =>'0187', "is_combo_store" => 0, "name" => 'Eaton Ctr',"address"=>'2 Queen Street West', "city"=> 'TORONTO', "province" => 'ON', "postal_code" => 'M5H 3X4', "lat" => 43.652402,  "long" =>  -79.379338, "sqft" => 23946, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 195, "store_number" =>'0195', "is_combo_store" => 0, "name" => 'Peter Pond', "address"=>'Unit 1118, 9713 Hardin Street', "city"=> 'FORT MCMURRAY', "province" => 'AB', "postal_code" => 'T9H 1L2', "lat" => 56.724723,  "long" =>  -111.380037, "sqft" => 10724, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 201, "store_number" =>'0201', "is_combo_store" => 0, "name" => 'Corner Brook Plaza',"address"=> 'Unit # M-02A, 54 Maple Valley Road', "city"=> 'CORNERBROOK', "province" => 'NL', "postal_code" => 'A2H 6L8', "lat" => 48.946202,  "long" =>  -57.915439, "sqft" => 13190, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 208, "store_number" =>'0208', "is_combo_store" => 0, "name" => 'Markham',"address"=>'9255 Woodbine Avenue', "city"=> 'Markham', "province" => 'ON', "postal_code" => 'L6C 1Y9', "lat" => 43.868148,  "long" =>  -79.362736, "sqft" => 17043, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 213, "store_number" =>'0213', "is_combo_store" => 0, "name" => 'Woodstock', "address"=> '399 NORWHICH AVENUE', "city"=> 'WOODSTOCK', "province" => 'ON', "postal_code" => 'N4S 3W4', "lat" => 43.118948,  "long" =>  -80.739011, "sqft" => 20118, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 219, "store_number" =>'0219', "is_combo_store" => 0, "name" => 'Bedford',"address"=>'Unit 2, 181 Damascus Road', "city"=> 'Bedford', "province" => 'NS', "postal_code" => 'B4A  0C2', "lat" => 44.750550,  "long" =>  -63.645095, "sqft" => 20987, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 221, "store_number" =>'0221', "is_combo_store" => 0, "name" => 'Boardwalk',"address"=>'Unit #3, 225 The Boardwalk', "city"=> 'Kitchener', "province" => 'ON', "postal_code" => 'N2N  0B1', "lat" => 43.435471,  "long" =>  -80.560586, "sqft" => 21634, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 223, "store_number" =>'0223', "is_combo_store" => 0, "name" => 'Midland',"address"=>'Unit 129, 9226 Highway #93', "city"=> 'Midland', "province" => 'ON', "postal_code" => 'L4R 4K4', "lat" => 43.717348,  "long" =>  -79.250915, "sqft" => 14865, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 224, "store_number" =>'0224', "is_combo_store" => 0, "name" => 'North battleford',"address"=>'11405 Railway Avenue East',"city"=> 'NORTH BATTLEFORD', "province" => 'SK', "postal_code" => 'S9A 3G8', "lat" => 52.776596,  "long" =>  -108.307059, "sqft" => 10061, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 225, "store_number" =>'0225', "is_combo_store" => 0, "name" => 'Miramichi',"address"=>'Unit 49, 2441 King George Highway', "city"=> 'MIRIMICHI', "province" => 'NB', "postal_code" => 'E1V 6W2', "lat" => 47.030143,  "long" =>  -65.491072, "sqft" => 9709, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 227, "store_number" =>'0227', "is_combo_store" => 0, "name" => 'Lindsay',"address"=>'401 Kent Street West, Unit 37', "city"=> 'LINDSAY', "province" => 'ON', "postal_code" => 'K9V 4Z1', "lat" => 44.350148,  "long" =>  -78.759373, "sqft" => 11430, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 228, "store_number" =>'0228', "is_combo_store" => 0, "name" => 'Huntsville',"address"=>'636 Marcove Road', "city"=> 'Huntsville', "province" => 'ON', "postal_code" => 'L5T 2R7', "lat" => 43.649833,  "long" =>  -79.687114, "sqft" => 12847, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 229, "store_number" =>'0229', "is_combo_store" => 0, "name" => 'Salmon Arm',"address"=>'Unit 255, 1151 10 Avenue SW',"city"=>'SALMON ARM', "province" => 'BC', "postal_code" => 'V1E 1T3', "lat" => 50.694310,  "long" =>  -119.298499, "sqft" => 9583, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 230, "store_number" =>'0230', "is_combo_store" => 0, "name" => 'Estevan',"address"=>'Unit 1220, 400 King Street', "city"=> 'ESTEVAN', "province" => 'SK', "postal_code" => 'S4A 2B4 ', "lat" => 49.146720,  "long" =>  -102.977916, "sqft" => 11867, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 231, "store_number" =>'0231', "is_combo_store" => 0, "name" => 'Collingwood',"address"=>'Unit C4, 55 Mountain Road', "city"=> 'Collingwood', "province" => 'ON', "postal_code" => 'L9Y 4M2', "lat" => 44.501489,  "long" =>  -80.242304, "sqft" => 20004, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 232, "store_number" =>'0232', "is_combo_store" => 0, "name" => 'Spruce Grove',"address"=>'100, 151 Century Crossing',"city"=>'SPRUCE GROVE', "province" => 'AB', "postal_code" => 'T7X 0C8', "lat" => 53.543187,  "long" =>  -113.879323, "sqft" => 22534, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 233, "store_number" =>'0233', "is_combo_store" => 0, "name" => 'Crowfoot Crossing',"address"=>'48 Crowfoot Terrace NW', "city"=> 'CALGARY', "province" => 'AB', "postal_code" => 'T3G 4J8', "lat" => 51.127247,  "long" =>  -114.200247, "sqft" => 23930, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 234, "store_number" =>'0234', "is_combo_store" => 0, "name" => 'Deerfoot',"address"=>'901 64th Avenue NE', "city"=> 'CALGARY', "province" => 'AB', "postal_code" => 'T2E 7P4', "lat" => 51.110450,  "long" =>  -114.041114, "sqft" => 46200, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 235, "store_number" =>'0235', "is_combo_store" => 0, "name" => 'Truro',"address"=>'Unit 109, 245 Robie Street', "city"=> 'TRURO', "province" => 'NS', "postal_code" => 'B2N 5N6', "lat" => 45.369398,  "long" =>  -63.303347, "sqft" => 10148, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 2],

	["store_id" => 236, "store_number" =>'0236', "is_combo_store" => 0, "name" => 'Wetaskiwin',"address"=>'Unit 1380-1400, 3725 56 Street', "city"=> 'Wetaskiwin', "province" => 'AB', "postal_code" => 'T9A 2V6', "lat" => 52.952625,  "long" =>  -113.390097, "sqft" => 8373, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 237, "store_number" =>'0237', "is_combo_store" => 0, "name" => 'Cornwall',"address"=>'Unit 2, 501 Tollgate Road West', "city"=> 'CORNWALL', "province" => 'ON', "postal_code" => 'K6H 5R6', "lat" => 45.040395,  "long" =>  -74.760432, "sqft" => 21882, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 238, "store_number" =>'0238', "is_combo_store" => 0, "name" => 'Duncan',"address"=>'Unit D10, 250 Trunk Road', "city"=> 'DUNCAN', "province" => 'BC', "postal_code" => 'V9L 2P2', "lat" => 48.776670,  "long" =>  -123.703445, "sqft" => 20719, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 239, "store_number" =>'0239', "is_combo_store" => 0, "name" => 'Brampton',"address"=>'Unit 112, 80 Great Lakes Drive', "city"=> 'BRAMPTON', "province" => 'ON', "postal_code" => 'L6R 2K7', "lat" => 43.731939,  "long" =>  -79.762821, "sqft" => 20169, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 240, "store_number" =>'0240', "is_combo_store" => 0, "name" => 'Burloak',"address"=>'3465 Wye Croft Road, Unit B Bldg B3', "city"=> 'OAKVILLE', "province" => 'ON', "postal_code" => 'L6L 0B6', "lat" => 43.450000,  "long" =>  -79.683333, "sqft" => 17620, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 241, "store_number" =>'0241', "is_combo_store" => 0, "name" => 'Leaside',"address"=>'Unit # 300, B3 - 147 Laird Drive', "city"=> 'EAST YORK', "province" => 'ON', "postal_code" => 'M4G 4K1', "lat" => 43.708683,  "long" =>  -79.362717, "sqft" => 33047, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 2],

	["store_id" => 242, "store_number" =>'0242', "is_combo_store" => 0, "name" => 'London North',"address"=>'Unit # 101, 1250 Fanshawe Park Road W.', "city"=> 'LONDON', "province" => 'ON', "postal_code" => 'N6G 5B1', "lat" => 43.013171,  "long" =>  -81.328659, "sqft" => 28229, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],
	
	["store_id" => 243, "store_number" =>'0243', "is_combo_store" => 1, "name" => 'Sherway Gardens',"address"=>'Unit # B1, 167 North Queen Street', "city"=> 'ETOBICOKE', "province" => 'ON', "postal_code" => 'M9C 1A7', "lat" => 43.619040,  "long" =>  -79.555765, "sqft" => 32646, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],
	
	["store_id" => 244, "store_number" =>'0244', "is_combo_store" => 0, "name" => 'Durham Centre', "address"=>'Unit # 1, 135 Harwood Ave. N', "city"=> 'AJAX', "province" => 'ON', "postal_code" => 'L1Z 1E8', "lat" => 43.864337,  "long" =>  -79.026010, "sqft" => 25970, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 2],
	
	["store_id" => 245, "store_number" =>'0245', "is_combo_store" => 0, "name" => 'Highland Square Mall',"address"=>'Unit 135, 689 Westville Rd.',"city"=> 'NEW GLASGOW', "province" => 'NS', "postal_code" => 'B2H 2J6', "lat" => 45.578705,  "long" =>  -62.663975, "sqft" => 15789, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],
	
	["store_id" => 246, "store_number" =>'0246', "is_combo_store" => 0, "name" => 'Big Bend Burnaby',"address"=>'Unit # 600, 5771 Marine Way', "city"=> 'BURNABY', "province" => 'BC', "postal_code" => 'V5J 0A6', "lat" => 49.199842,  "long" =>  -122.976599, "sqft" => 28144, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],
	
	["store_id" => 247, "store_number" =>'0247', "is_combo_store" => 0, "name" => 'Shawnessy Town Centre',"address"=>'Unit # 120 - 350R Shawville Blvd. SE', "city"=> 'CALGARY', "province" => 'AB', "postal_code" => 'T2Y 3S4', "lat" => 50.898509,  "long" =>  -114.062689, "sqft" => 33265, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 248, "store_number" =>'0248', "is_combo_store" => 0, "name" => 'Cross Iron Mill\'s Mall',"address"=>'261055 Crossiron Blvd.',"city"=> 'ROCKY VIEW', "province" => 'AB', "postal_code" => 'T4A 0G3', "lat" => 51.200347,  "long" =>  -113.996029, "sqft" => 38990, "mall_entrance" => 1, "entrances" => 3, "cashbanks" => 2],

	["store_id" => 249, "store_number" =>'0249', "is_combo_store" => 0, "name" => 'Stephen Avenue',"address"=>'120 - 8 Ave. SW', "city"=> 'Calgary', "province" => 'AB', "postal_code" => 'T2P 1B3', "lat" => 51.045638,  "long" =>  -114.064454, "sqft" => 24493, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 250, "store_number" =>'0250', "is_combo_store" => 0, "name" => 'Lloydminster',"address"=>'Unit 102, 7501 44 Street', "city"=> 'LLOYDMINSTER', "province" => 'AB', "postal_code" => 'T9V 0X9', "lat" => 53.277992,  "long" =>  -110.036714, "sqft" => 17538, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 251, "store_number" =>'0251', "is_combo_store" => 0, "name" => 'Fairview',"address"=>'Unit #2074, 1800 Sheppard Ave East', "city"=> 'TORONTO', "province" => 'ON', "postal_code" => 'M2J 5A7', "lat" => 43.778779,  "long" =>  -79.344721, "sqft" => 17070, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 252, "store_number" =>'0252', "is_combo_store" => 0, "name" => 'Bolton',"address"=>'Unit #1, 12730 Highway 50', "city"=> 'BOLTON', "province" => 'ON', "postal_code" => 'L7E 4G1', "lat" => 43.860413,  "long" =>  -79.711578, "sqft" => 18268, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 253, "store_number" =>'0253', "is_combo_store" => 0, "name" => 'Whitby',"address"=>'Bldg. G, 320 Taunton Road East', "city"=> 'WHITBY', "province" => 'ON', "postal_code" => 'L1R 0H4', "lat" => 43.917605,  "long" =>  -78.947542, "sqft" => 18557, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 254, "store_number" =>'0254', "is_combo_store" => 0, "name" => 'Cobourg',"address"=>'Unit #M7, 1111 Elgin Street West', "city"=> 'COBOURG', "province" => 'ON', "postal_code" => 'K9A 5H7', "lat" => 43.970664,  "long" =>  -78.202523, "sqft" => 15079, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 255, "store_number" =>'0255', "is_combo_store" => 0, "name" => 'Upper Canada',"address"=>'Unit #HH4, 17600 Yonge Street', "city"=> 'NEWMARKET', "province" => 'ON', "postal_code" => 'L3Y 4Z1', "lat" => 44.054922,  "long" =>  -79.480351, "sqft" => 43541, "mall_entrance" => 1, "entrances" => 3, "cashbanks" => 2],

	["store_id" => 256, "store_number" =>'0256', "is_combo_store" => 0, "name" => 'Sydney',"address"=>'Unit# E57, 800 Grand Lake Road', "city"=> 'SYDNEY', "province" => 'NS', "postal_code" => 'B1P 6S9', "lat" => 46.145691,  "long" =>  -60.138320, "sqft" => 15177, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 257, "store_number" =>'0257', "is_combo_store" => 0, "name" => 'Burlington',"address"=>'Unit #A03, 2445 Appleby Line', "city"=> 'BURLINGTON', "province" => 'ON', "postal_code" => 'L7L 0B6', "lat" => 43.406607,  "long" =>  -79.807895, "sqft" => 15249, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 258, "store_number" =>'0258', "is_combo_store" => 0, "name" => 'Dartmouth',"address"=>'Unit 10-2, 25 Lemlair Row', "city"=> 'DARTMOUTH', "province" => 'NS', "postal_code" => 'B3B 0C6', "lat" => 44.698936,  "long" =>  -63.567273, "sqft" => 18137, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 259, "store_number" =>'0259', "is_combo_store" => 1, "name" => 'Guelph',"address"=>'CRU#R1, 435 Stone Road West', "city"=> 'GUELPH', "province" => 'ON', "postal_code" => 'N1G 2X6', "lat" => 43.518705,  "long" =>  -80.237438, "sqft" => 20300, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 260, "store_number" =>'0260', "is_combo_store" => 1, "name" => 'Beacon Hill',"address"=> 'Unit #D7, 11626 Sarcee Trail NW', "city"=> 'CALGARY', "province" => 'AB', "postal_code" => 'T3R 0A1', "lat" => 51.157538,  "long" =>  -114.162137, "sqft" => 27985, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 262, "store_number" =>'0262', "is_combo_store" => 0, "name" => 'Timmins',"address"=>'Unit #A4, 1500 Riverside Drive', "city"=> 'TIMMINS', "province" => 'ON', "postal_code" => 'P4R 1A1', "lat" => 48.472548,  "long" =>  -81.382284, "sqft" => 17207, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 263, "store_number" =>'0263', "is_combo_store" => 0, "name" => 'Eglington Corners', "address"=>'Unit #B4, 1920 Eglinton Avenue East', "city"=> 'SCARBOROUGH', "province" => 'ON', "postal_code" => 'M1L 2L9', "lat" => 43.727434,  "long" =>  -79.290492, "sqft" => 20385, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 264, "store_number" =>'0264', "is_combo_store" => 0, "name" => 'Barrhaven Chapman Mills',"address"=>'Unit #2, 125 Riocan Avenue', "city"=> 'BARRHAVEN', "province" => 'ON', "postal_code" => 'K2J 5G4', "lat" => 45.269173,  "long" =>  -75.740892, "sqft" => 14996, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 265, "store_number" =>'0265', "is_combo_store" => 0, "name" => 'St. Vital Centre',"address"=>'1225 St. Mary’s Road', "city"=> 'WINNIPEG', "province" => 'MB', "postal_code" => 'R2M 5E5', "lat" => 49.828991,  "long" =>  -97.114766, "sqft" => 15016, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 266, "store_number" =>'0266', "is_combo_store" => 0, "name" => 'Kanata',"address"=>'Unit # Q1, 785 Kanata Avenue', "city"=> 'KANATA', "province" => 'ON', "postal_code" => 'K2T 1H8', "lat" => 45.312032,  "long" =>  -75.911378, "sqft" => 20160, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 267, "store_number" =>'0267', "is_combo_store" => 0, "name" => 'Penticton',"address"=>'Unit # 101, 2701 Skaha Lake Road', "city"=> 'PENTICTON', "province" => 'BC', "postal_code" => 'V2A 9B8', "lat" => 49.464533,  "long" =>  -119.587254, "sqft" => 15310, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 268, "store_number" =>'0268', "is_combo_store" => 0, "name" => 'Southridge',"address"=>'Unit #51, 1933 Regent Street', "city"=> 'SUDBURY', "province" => 'ON', "postal_code" => 'P3E 5R2', "lat" => 46.450085,  "long" =>  -81.001629, "sqft" => 15283, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 270, "store_number" =>'0270', "is_combo_store" => 0, "name" => 'Deerfoot Meadows',"address"=>'Unit #1160, 33 Heritage Meadows Way SE', "city"=> 'CALGARY', "province" => 'AB', "postal_code" => 'T2H 3B8', "lat" => 50.982563,  "long" =>  -114.038871, "sqft" => 19227, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 271, "store_number" =>'0271', "is_combo_store" => 0, "name" => 'St. Catherines',"address"=>'Unit #D6, 285 Geneva Street',"city"=> 'ST. CATHARINES', "province" => 'ON', "postal_code" => 'L2N 2G1', "lat" => 43.178174,  "long" =>  -79.244814, "sqft" => 14912, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 272, "store_number" =>'0272', "is_combo_store" => 1, "name" => 'Richmond',"address"=>'Unit # 1140, 6551 No. 3 Road', "city"=> 'RICHMOND', "province" => 'BC', "postal_code" => 'V6Y 2B6', "lat" => 49.166509,  "long" =>  -123.137811, "sqft" => 45494, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 273, "store_number" =>'0273', "is_combo_store" => 0, "name" => 'Cambridge Centre',"address"=>'Unit # 330, 355 Hespeler Road', "city"=> 'CAMBRIDGE', "province" => 'ON', "postal_code" => 'N1R 6B3', "lat" => 43.393699,  "long" =>  -80.321019, "sqft" => 21536, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 274, "store_number" =>'0274', "is_combo_store" => 1, "name" => 'Halifax Shopping Centre',"address"=>'Unit #1, 7001 Mumford Road', "city"=> 'HALIFAX', "province" => 'NS', "postal_code" => 'B3L 4L9', "lat" => 44.648227,  "long" =>  -63.620527, "sqft" => 51871, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 275, "store_number" =>'0275', "is_combo_store" => 0, "name" => 'West Ridge Place',"address"=>'Unit # 1, 3275 Monarch Drive', "city"=> 'ORILLIA', "province" => 'ON', "postal_code" => 'L3V 7Z4', "lat" => 44.610016,  "long" =>  -79.451096, "sqft" => 15648, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 276, "store_number" =>'0276', "is_combo_store" => 0, "name" => 'Lougheed Mall',"address"=>'Unit #102, 9855 Austin Avenue', "city"=> 'BURNABY', "province" => 'BC', "postal_code" => 'V3J 1N4', "lat" => 49.251699,  "long" =>  -122.896148, "sqft" => 20089, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 277, "store_number" =>'0277', "is_combo_store" => 1, "name" => 'Edmonton City Centre',"address"=>'# 124 Edmonton City Centre, Main Level', "city"=> 'EDMONTON', "province" => 'AB', "postal_code" => 'T5J 2Y9', "lat" => 53.533333,  "long" =>  -113.500000, "sqft" => 35825, "mall_entrance" => 1, "entrances" => 3, "cashbanks" => 2],

	["store_id" => 278, "store_number" =>'0278', "is_combo_store" => 0, "name" => 'Village Green',"address"=>'Unit # 0340, 4900-27Street', "city"=> 'VERNON', "province" => 'BC', "postal_code" => 'V1T 7G7', "lat" => 50.267014,  "long" =>  -119.272011, "sqft" => 15000, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 279, "store_number" =>'0279', "is_combo_store" => 0, "name" => 'Sarnia',"address"=>'595 Murphy Road', "city"=> 'SARNIA', "province" => 'ON', "postal_code" => 'N7S 6K1', "lat" => 42.976700,  "long" =>  -82.366708, "sqft" => 31534, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 280, "store_number" =>'0280', "is_combo_store" => 0, "name" => 'Fort McMurray',"address"=>'Unit #102, 19 Riedel Street',"city"=>'FORT MCMURRAY', "province" => 'AB', "postal_code" => 'T9H 3H8', "lat" => 56.722515,  "long" =>  -111.364260, "sqft" => 47397, "mall_entrance" => 1, "entrances" => 3, "cashbanks" => 2],

	["store_id" => 281, "store_number" =>'0281', "is_combo_store" => 0, "name" => 'Southland Mall',"address"=>'Unit #96, 4307 130 Avenue SE', "city"=> 'CALGARY', "province" => 'AB', "postal_code" => 'T2Z 3V8', "lat" => 50.929350,  "long" =>  -113.972450, "sqft" => 18966, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 282, "store_number" =>'0282', "is_combo_store" => 0, "name" => 'Pine Centre', "address"=>'3115 Massey Drive',"city"=> 'PRINCE GEORGE', "province" => 'BC', "postal_code" => 'V2N 2S9', "lat" => 53.900152,  "long" =>  -122.778170, "sqft" => 29370, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 283, "store_number" =>'0283', "is_combo_store" => 0, "name" => 'Woodbridge',"address"=>'Building B, 7850 Weston Road', "city"=> 'VAUGHAN', "province" => 'ON', "postal_code" => ' L4L 9N8', "lat" => 43.792099,  "long" =>  -79.549301, "sqft" => 20287, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 284, "store_number" =>'0284', "is_combo_store" => 0, "name" => 'Fredericton',"address"=>'Unit #3Y200A (for couriers) 1381 Regent Street', "city"=> 'FREDERICTON', "province" => 'NB', "postal_code" => 'E3C 1A2', "lat" => 45.933601,  "long" =>  -66.662462, "sqft" => 27354, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 285, "store_number" =>'0285', "is_combo_store" => 0, "name" => 'New Minas',"address"=>'9123 Commercial Street',"city"=> 'NEW MINAS', "province" => 'NS', "postal_code" => 'B4N 3E6', "lat" => 45.067279,  "long" =>  -64.451661, "sqft" => 15019, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 288, "store_number" =>'0288', "is_combo_store" => 0, "name" => 'Milton Mall',"address"=>'Unit D18/19, 55 Ontario Street South', "city"=> 'Milton', "province" => 'ON', "postal_code" => 'L9T 2M3', "lat" => 43.517886,  "long" =>  -79.875830, "sqft" => 20097, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 290, "store_number" =>'0290', "is_combo_store" => 0, "name" => 'V.B.C.',"address"=>'Unit #311A, 1150 Douglas Street', "city"=> 'VICTORIA', "province" => 'BC', "postal_code" => 'V8W 3M9', "lat" => 48.425019,  "long" =>  -123.365663, "sqft" => 19372, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 291, "store_number" =>'0291', "is_combo_store" => 0, "name" => 'White Oaks Mall',"address"=>'Unit #93, 1105 Wellington Road', "city"=> 'LONDON', "province" => 'ON', "postal_code" => 'N6E 1V4', "lat" => 42.930705,  "long" =>  -81.226537, "sqft" => 20000, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 292, "store_number" =>'0292', "is_combo_store" => 0, "name" => 'Pen Centre',"address"=>'Unit 119, 221 Glendale Avenue',"city"=> 'ST. Catherines', "province" => 'ON', "postal_code" => 'L2T 2K9', "lat" => 43.133638,  "long" =>  -79.224310, "sqft" => 23245, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 293, "store_number" =>'0293', "is_combo_store" => 0, "name" => 'Argyle',"address"=>'Unit #14, 1925 Dundas Street East', "city"=> 'LONDON', "province" => 'ON', "postal_code" => 'N5V 1P7', "lat" => 43.004886,  "long" =>  -81.175482, "sqft" => 18760, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 294, "store_number" =>'0294', "is_combo_store" => 0, "name" => 'Heartland Town Centre',"address"=>'Unit # 1, 785 Britannia Road West', "city"=> 'MISSISSAUGA', "province" => 'ON', "postal_code" => 'L5V 2Y1', "lat" => 43.610811,  "long" =>  -79.699513, "sqft" => 19739, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 296, "store_number" =>'0296', "is_combo_store" => 1, "name" => 'New North Bay Mall',"address"=>'Unit #101, 300 Lakeshore Drive', "city"=> 'North Bay', "province" => 'ON', "postal_code" => 'P1A 3V2', "lat" => 46.283148,  "long" =>  -79.448755, "sqft" => 29985, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 297, "store_number" =>'0297', "is_combo_store" => 0, "name" => 'Saint John',"address"=>'Unit Y005, 519 Westmoreland Road Place Mall)', "city"=> 'SAINT-JOHN', "province" => 'NB', "postal_code" => 'E2J 3W9', "lat" => 45.273315,  "long" =>  -66.063308, "sqft" => 25795, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 298, "store_number" =>'0298', "is_combo_store" => 0, "name" => 'Lansdowne Place',"address"=>'Unit #L019A, 645 Lansdowne Street West', "city"=> 'PETERBOROUGH', "province" => 'ON', "postal_code" => 'K9J 7Y5', "lat" => 44.283564,  "long" =>  -78.330874, "sqft" => 22855, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 299, "store_number" =>'0299', "is_combo_store" => 0, "name" => 'Limeridge',"address"=>'Unit #0515, 999 Upper Wentworth Street', "city"=> 'HAMILTON', "province" => 'ON', "postal_code" => 'L9A 4X5', "lat" => 43.217355,  "long" =>  -79.861924, "sqft" => 25405, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 300, "store_number" =>'0300', "is_combo_store" => 1, "name" => 'Aberdeen Mall',"address"=>'Unit #Y0500, 1320 West Trans Canada Hwy', "city"=> 'KAMLOOPS', "province" => 'BC', "postal_code" => 'V1S 1J2', "lat" => 50.654391,  "long" =>  -120.371092, "sqft" => 28213, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 303, "store_number" =>'0303', "is_combo_store" => 0, "name" => 'Sunridge',"address"=>'Unit #250A, 2525 36th Street N.E.', "city"=> 'CALGARY', "province" => 'AB', "postal_code" => 'T1Y 5T4', "lat" => 51.073385,  "long" =>  -113.987693, "sqft" => 42000, "mall_entrance" => 1, "entrances" => 3, "cashbanks" => 3],

	["store_id" => 304, "store_number" =>'0304', "is_combo_store" => 0, "name" => 'Town \'N\' Country Mall',"address"=>'Unit #13, 1235 Main Street North',"city"=> 'MOOSE JAW', "province" => 'SK', "postal_code" => 'S6H 6M4', "lat" => 50.404291,  "long" =>  -105.530364, "sqft" => 14908, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 308, "store_number" =>'0308', "is_combo_store" => 0, "name" => 'South Edmonton Common',"address"=>'Unit #190, 3803 Calgary Trail S.', "city"=> 'EDMONTON', "province" => 'AB', "postal_code" => 'T6J 5M8', "lat" => 53.473910,  "long" =>  -113.494418, "sqft" => 25027, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 309, "store_number" =>'0309', "is_combo_store" => 0, "name" => 'Market Mall',"address"=>'Unit #100W, 3625 Shaganappi Tr. NW', "city"=> 'CALGARY', "province" => 'AB', "postal_code" => 'T3A 0E2', "lat" => 51.087864,  "long" =>  -114.157360, "sqft" => 33267, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 310, "store_number" =>'0310', "is_combo_store" => 0, "name" => 'Chinook Centre',"address"=>'Unit L6, 6455 Macleod Trail S.W.', "city"=> 'CALGARY', "province" => 'AB', "postal_code" => 'T2H 0K9', "lat" => 50.996067,  "long" =>  -114.073148, "sqft" => 22988, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 311, "store_number" =>'0311', "is_combo_store" => 0, "name" => 'Lethbridge',"address"=>'Unit BO1, 501 1st Avenue S', "city"=> 'Lethbridge', "province" => 'AB', "postal_code" => 'T1J 4L9', "lat" => 49.698074,  "long" =>  -112.837342, "sqft" => 25177, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 312, "store_number" =>'0312', "is_combo_store" => 0, "name" => 'Londonderry Mall',"address"=>'Unit#2205, 137th Avenue & 66th Street', "city"=> 'Edmonton', "province" => 'AB', "postal_code" => 'T5C 3C8', "lat" => 53.599232,  "long" =>  -113.443074, "sqft" => 35141, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 313, "store_number" =>'0313', "is_combo_store" => 1, "name" => 'Medicine Hat',"address"=>'Unit 1, 46 Carry Drive S.E.',"city"=> 'MEDICINE HAT', "province" => 'AB', "postal_code" => 'T1B 4E1', "lat" => 50.005412,  "long" =>  -110.649279, "sqft" => 34304, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 314, "store_number" =>'0314', "is_combo_store" => 1, "name" => 'West Edmonton Mall',"address"=>'Suite 1119, 8882 170th Street, Phase I', "city"=> 'EDMONTON', "province" => 'AB', "postal_code" => 'T5T 4M2', "lat" => 53.533333,  "long" =>  -113.500000, "sqft" => 80468, "mall_entrance" => 1, "entrances" => 3, "cashbanks" => 3],

	["store_id" => 316, "store_number" =>'0316', "is_combo_store" => 0, "name" => 'Kingsway Garden Mall',"address"=>'109 Street & Princess Elizabeth Ave.', "city"=> 'EDMONTON', "province" => 'AB', "postal_code" => 'T5G 3A6', "lat" => 53.565277,  "long" =>  -113.505575, "sqft" => 20678, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 317, "store_number" =>'0317', "is_combo_store" => 1, "name" => 'Winston Churchill',"address"=>'Unit 2, 2460 Winston Churchill Blvd E', "city"=> 'OAKVILLE', "province" => 'ON', "postal_code" => 'L6H 6J5', "lat" => 43.521278,  "long" =>  -79.679657, "sqft" => 32281, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 318, "store_number" =>'0318', "is_combo_store" => 0, "name" => 'Southcentre',"address"=>'Unit #76, 100 Anderson Rd. S.E.', "city"=> 'CALGARY', "province" => 'AB', "postal_code" => 'T2J 3V1', "lat" => 50.950540,  "long" =>  -114.066584, "sqft" => 24305, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 319, "store_number" =>'0319', "is_combo_store" => 0, "name" => 'Niagara Falls',"address"=>'Unit A-30, 7555 Montrose Road',"city"=> 'NIAGARA FALLS', "province" => 'ON', "postal_code" => 'L2H 2E9', "lat" => 43.067265,  "long" =>  -79.122786, "sqft" => 20161, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 320, "store_number" =>'0320', "is_combo_store" => 1, "name" => 'St. Albert Centre',"address"=>'Unit 103, 375 St. Albert Road',"city"=> 'St.Albert', "province" => 'AB', "postal_code" => 'T8N 3K8', "lat" => 53.640596,  "long" =>  -113.624979, "sqft" => 35093, "mall_entrance" => 1, "entrances" => 3, "cashbanks" => 2],

	["store_id" => 322, "store_number" =>'0322', "is_combo_store" => 0, "name" => 'Cataraqui Town Centre',"address"=>'Unit Y-006, 945 Gardiners Road', "city"=> 'KINGSTON', "province" => 'ON', "postal_code" => 'K7M 7H4', "lat" => 44.257309,  "long" =>  -76.568519, "sqft" => 19126, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 323, "store_number" =>'0323', "is_combo_store" => 1, "name" => 'Redcliff',"address"=>'Unit #503, 1100 Pembroke Street East', "city"=> 'Pembrooke', "province" => 'ON', "postal_code" => 'K8A 6Y7', "lat" => 45.820550,  "long" =>  -77.083929, "sqft" => 30030, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 327, "store_number" =>'0327', "is_combo_store" => 0, "name" => 'Broadway',"address"=>'18 West Broadway', "city"=> 'VANCOUVER', "province" => 'BC', "postal_code" => 'V5Y 1P2', "lat" => 49.263016,  "long" =>  -123.105295, "sqft" => 17757, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 2],

	["store_id" => 328, "store_number" =>'0328', "is_combo_store" => 0, "name" => 'Pitt Meadows',"address"=>'Unit #405, 19800 Lougheed Hwy.',"city"=>'PITT MEADOWS', "province" => 'BC', "postal_code" => 'V3Y 2W1', "lat" => 49.225794,  "long" =>  -122.676237, "sqft" => 18522, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 329, "store_number" =>'0329', "is_combo_store" => 0, "name" => 'Southland Mall',"address"=>'2635 Gordon Road', "city"=> 'Regina', "province" => 'SK', "postal_code" => 'S4S 6H7', "lat" => 50.404468,  "long" =>  -104.619260, "sqft" => 29433, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 330, "store_number" =>'0330', "is_combo_store" => 0, "name" => 'St. Laurent Shopping Centre',"address"=>'Unit# Y005, 1200 St. Laurent Blvd.', "city"=> 'OTTAWA', "province" => 'ON', "postal_code" => 'K1K 3B8', "lat" => 45.420820,  "long" =>  -75.635442, "sqft" => 31373, "mall_entrance" => 1, "entrances" => 4, "cashbanks" => 2],

	["store_id" => 334, "store_number" =>'0334', "is_combo_store" => 1, "name" => 'Park Royal',"address"=>'1000 Park Royal Mall South', "city"=> 'VANCOUVER', "province" => 'BC', "postal_code" => 'V7T 1A1', "lat" => 49.337494,  "long" =>  -123.160123, "sqft" => 51000, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 335, "store_number" =>'0335', "is_combo_store" => 0, "name" => 'Orchard Park',"address"=>'Unit #0300, 2271 Harvey Avenue', "city"=> 'KELOWNA', "province" => 'BC', "postal_code" => 'V1Y 6H2', "lat" => 49.880696,  "long" =>  -119.439577, "sqft" => 43883, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 336, "store_number" =>'0336', "is_combo_store" => 0, "name" => 'Victoria',"address"=>'Suite #104, 805 Cloverdale Avenue', "city"=> 'VICTORIA', "province" => 'BC', "postal_code" => 'V8X 2S9', "lat" => 48.450426,  "long" =>  -123.370463, "sqft" => 17430, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 337, "store_number" =>'0337', "is_combo_store" => 0, "name" => 'Pacific Centre',"address"=>'777 Dunsmuir Street', "city"=> 'VANCOUVER', "province" => 'BC', "postal_code" => 'V7Y 1A1', "lat" => 49.284814,  "long" =>  -123.116387, "sqft" => 36575, "mall_entrance" => 1, "entrances" => 3, "cashbanks" => 3],

	["store_id" => 338, "store_number" =>'0338', "is_combo_store" => 0, "name" => 'Centre at Circle & 8th',"address"=>'3310 - 8th Street East', "city"=> 'SASKATOON', "province" => 'SK', "postal_code" => 'S7H 5M3', "lat" => 52.114573,  "long" =>  -106.603022, "sqft" => 24510, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 339, "store_number" =>'0339', "is_combo_store" => 1, "name" => 'Gateway Mall',"address"=>'Unit 500, 1403 Central Avenue',"city"=>'PRINCE ALBERT', "province" => 'SK', "postal_code" => 'S6V 7J4', "lat" => 53.199569,  "long" =>  -105.754274, "sqft" => 25366, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 340, "store_number" =>'0340', "is_combo_store" => 0, "name" => 'Bramalea City Centre',"address"=>'Unit 0124A and Kiosk 0702K, 25 Peel Centre Drive', "city"=> 'Brampton', "province" => 'ON', "postal_code" => 'L6T 3R5', "lat" => 43.715264,  "long" =>  -79.723781, "sqft" => 21989, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 341, "store_number" =>'0341', "is_combo_store" => 0, "name" => 'Victoria Square',"address"=>'2223 Victoria Avenue East', "city"=> 'REGINA', "province" => 'SK', "postal_code" => 'S4N 6E4', "lat" => 50.446988,  "long" =>  -104.549913, "sqft" => 23145, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 342, "store_number" =>'0342', "is_combo_store" => 0, "name" => 'Midtown Plaza',"address"=>'Unit #T215C, 201-1 Avenue South', "city"=> 'SASKATOON', "province" => 'SK', "postal_code" => 'S7K 1J9', "lat" => 52.127551,  "long" =>  -106.667151, "sqft" => 19432, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 344, "store_number" =>'0344', "is_combo_store" => 0, "name" => 'Strawberry',"address"=>'Units 120, 12101 72 Avenue', "city"=> 'SURREY', "province" => 'BC', "postal_code" => 'V3W 2M1', "lat" => 49.105897,  "long" =>  -122.827956, "sqft" => 20694, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 345, "store_number" =>'0345', "is_combo_store" => 1, "name" => 'Pembina',"address"=>'Unit 3, 1910 Pembina Hwy South', "city"=> 'Winnipeg', "province" => 'MB', "postal_code" => 'R3T 4S5', "lat" => 49.821533,  "long" =>  -97.152573, "sqft" => 35170, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 346, "store_number" =>'0346', "is_combo_store" => 0, "name" => 'Polo Park',"address"=>'Unit 130A, 1485 Portage Avenue', "city"=> 'WINNIPEG', "province" => 'MB', "postal_code" => 'R3G 0W4', "lat" => 49.881293,  "long" =>  -97.199564, "sqft" => 42000, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 347, "store_number" =>'0347', "is_combo_store" => 0, "name" => 'Kildonan',"address"=>'Unit #1, 1570 Regent Avenue', "city"=> 'WINNIPEG', "province" => 'MB', "postal_code" => 'R2C 2Y9', "lat" => 49.897055,  "long" =>  -97.062877, "sqft" => 21522, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 348, "store_number" =>'0348', "is_combo_store" => 1, "name" => 'Sherwood Park Mall',"address"=>'Unit 15, 2020 Sherwood Place',"city"=>'SHERWOOD PARK', "province" => 'AB', "postal_code" => 'T8A 3H9', "lat" => 53.531150,  "long" =>  -113.295446, "sqft" => 14111, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 349, "store_number" =>'0349', "is_combo_store" => 0, "name" => 'Quinte Mall',"address"=>'Unit 200, 390 North Front Street', "city"=> 'BELLEVILLE', "province" => 'ON', "postal_code" => 'K8P 3E1', "lat" => 44.189094,  "long" =>  -77.397458, "sqft" => 24947, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 350, "store_number" =>'0350', "is_combo_store" => 0, "name" => 'Merivale Mall',"address"=>'Unit #0580, 1642 Merivale Road', "city"=> 'OTTAWA', "province" => 'ON', "postal_code" => 'K2G 4A1', "lat" => 45.345781,  "long" =>  -75.730602, "sqft" => 30000, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 351, "store_number" =>'0351', "is_combo_store" => 0, "name" => 'Pickering Town Centre',"address"=>'Unit 120, 1355 Kingston Road', "city"=> 'PICKERING', "province" => 'ON', "postal_code" => 'L1V 1B8', "lat" => 43.837046,  "long" =>  -79.088691, "sqft" => 20306, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 352, "store_number" =>'0352', "is_combo_store" => 0, "name" => 'Burlington Mall',"address"=>'777 Guelph Line', "city"=> 'Burlington', "province" => 'ON', "postal_code" => 'L7R 3N2', "lat" => 43.345380,  "long" =>  -79.794813, "sqft" => 25590, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 353, "store_number" =>'0353', "is_combo_store" => 0, "name" => 'Sudbury',"address"=>'1349 LaSalle Blvd', "city"=> 'SUDBURY', "province" => 'ON', "postal_code" => 'P3A 1Z2', "lat" => 46.522026,  "long" =>  -80.947122, "sqft" => 17073, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 354, "store_number" =>'0354', "is_combo_store" => 0, "name" => 'The Promenade',"address"=>'Unit 117-8, 1 Promenade Circle', "city"=> 'THORNHILL', "province" => 'ON', "postal_code" => 'L4J 4P8', "lat" => 43.809093,  "long" =>  -79.453292, "sqft" => 20379, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 355, "store_number" =>'0355', "is_combo_store" => 0, "name" => 'Square One',"address"=>'199 Rathburn Road', "city"=> 'MISSISSAUGA', "province" => 'ON', "postal_code" => 'L5B 4C1', "lat" => 43.593765,  "long" =>  -79.648040, "sqft" => 36000, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 356, "store_number" =>'0356', "is_combo_store" => 0, "name" => 'Connestoga',"address"=>'550 King Street North', "city"=> 'WATERLOO', "province" => 'ON', "postal_code" => 'N2L 5W6', "lat" => 43.498082,  "long" =>  -80.527497, "sqft" => 20577, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 357, "store_number" =>'0357', "is_combo_store" => 1, "name" => 'Masonville',"address"=>'Unit 3, 1735 Richmond Street', "city"=> 'LONDON', "province" => 'ON', "postal_code" => 'N5X 3Y2', "lat" => 43.028366,  "long" =>  -81.283616, "sqft" => 18000, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 358, "store_number" =>'0358', "is_combo_store" => 0, "name" => 'Erin Mills Town Centre',"address"=>'Unit D, 5100 Erin Mills Parkway', "city"=> 'MISSISSAUGA', "province" => 'ON', "postal_code" => 'L5M 4Z5', "lat" => 43.559467,  "long" =>  -79.707906, "sqft" => 26642, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 359, "store_number" =>'0359', "is_combo_store" => 0, "name" => 'Intercity',"address"=>'1000 Fort William Road',"city"=>'THUNDER BAY', "province" => 'ON', "postal_code" => 'P7B 6B9', "lat" => 48.404654,  "long" =>  -89.243655, "sqft" => 24421, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 361, "store_number" =>'0361', "is_combo_store" => 0, "name" => 'Woodgrove Centre',"address"=>'Unit 126, 6631 Island Hwy. North', "city"=> 'NANAIMO', "province" => 'BC', "postal_code" => 'V9T 4T7', "lat" => 49.235282,  "long" =>  -124.048605, "sqft" => 20632, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 362, "store_number" =>'0362', "is_combo_store" => 0, "name" => 'Oshawa Centre',"address"=>'Unit 1150, 419 King Street West', "city"=> 'OSHAWA', "province" => 'ON', "postal_code" => 'L1J 2K5', "lat" => 43.890529,  "long" =>  -78.879950, "sqft" => 43468, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 363, "store_number" =>'0363', "is_combo_store" => 0, "name" => 'Coquitlam Centre',"address"=>'Unit 1400, 2929 Barnet Highway', "city"=> 'COQUITLAM', "province" => 'BC', "postal_code" => 'V3B 5R5', "lat" => 49.276941,  "long" =>  -122.799472, "sqft" => 21509, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 364, "store_number" =>'0364', "is_combo_store" => 0, "name" => 'Brandon',"address"=>'1570 18th Street', "city"=> 'BRANDON', "province" => 'MB', "postal_code" => 'R7A 5C5', "lat" => 49.826461,  "long" =>  -99.962007, "sqft" => 20345, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 365, "store_number" =>'0365', "is_combo_store" => 0, "name" => 'Northgate Centre',"address"=>'Unit 1, 1375 McPhillips Stree', "city"=> 'WINNIPEG', "province" => 'MB', "postal_code" => 'R2V 3V1', "lat" => 49.940461,  "long" =>  -97.158857, "sqft" => 21750, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 366, "store_number" =>'0366', "is_combo_store" => 0, "name" => 'Cottonwood Shopping Centre',"address"=>'Unit 99, 45585 Luckakuck Way', "city"=> 'CHILLIWACK', "province" => 'BC', "postal_code" => 'V2R 1A1', "lat" => 49.140844,  "long" =>  -121.962284, "sqft" => 23715, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 367, "store_number" =>'0367', "is_combo_store" => 0, "name" => 'Heritage Place',"address"=>'1350 16 Street East',"city"=>'OWEN SOUND', "province" => 'ON', "postal_code" => 'N4K 6N7', "lat" => 44.574466,  "long" =>  -80.918984, "sqft" => 23396, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 368, "store_number" =>'0368', "is_combo_store" => 0, "name" => 'Sevenoaks Shopping Centre',"address"=>'32900 South Fraser Hwy.', "city"=> 'ABBOTSFORD', "province" => 'BC', "postal_code" => 'V2S 5A1', "lat" => 49.056185,  "long" =>  -122.385333, "sqft" => 22000, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 369, "store_number" =>'0369', "is_combo_store" => 0, "name" => 'Guildford',"address"=>'1214 Guildford Town Cntr.', "city"=> 'SURREY', "province" => 'BC', "postal_code" => 'V3R 7B7', "lat" => 49.188825,  "long" =>  -122.804342, "sqft" => 22679, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 370, "store_number" =>'0370', "is_combo_store" => 0, "name" => 'Bayers Lake Centre',"address"=>'Unit F, 215 Chain Lake Drive, Halifax Business Centre', "city"=> 'HALIFAX', "province" => 'NS', "postal_code" => 'B3S 1C9', "lat" => 44.648881,  "long" =>  -63.575312, "sqft" => 16230, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 371, "store_number" =>'0371', "is_combo_store" => 0, "name" => 'The Village Shopping Centre',"address"=>'430 Topsail Road',"city"=>'ST. Johns', "province" => 'NL', "postal_code" => 'A1E 4N1', "lat" => 47.533463,  "long" =>  -52.749552, "sqft" => 40152, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 375, "store_number" =>'0375', "is_combo_store" => 0, "name" => 'Yorkdale Shopping Centre',"address"=>'3401 Dufferin Street', "city"=> 'TORONTO', "province" => 'ON', "postal_code" => 'M6A 2T9', "lat" => 43.725822,  "long" =>  -79.455526, "sqft" => 26701, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 377, "store_number" =>'0377', "is_combo_store" => 0, "name" => 'Kitchener',"address"=>'655 Fairway Road South', "city"=> 'KITCHENER', "province" => 'ON', "postal_code" => 'N2C 1X4', "lat" => 43.418461,  "long" =>  -80.450405, "sqft" => 17330, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 379, "store_number" =>'0379', "is_combo_store" => 0, "name" => 'Champlain Place',"address"=>'477 Paul Street', "city"=> 'DIEPPE', "province" => 'NB', "postal_code" => 'E1A 4X5', "lat" => 46.098242,  "long" =>  -64.760216, "sqft" => 20000, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 380, "store_number" =>'0380', "is_combo_store" => 0, "name" => 'Charlottetown',"address"=>'Unit 1, 670 University Avenue', "city"=> 'CHARLETTETOWN', "province" => 'PE', "postal_code" => 'C1E 1H6', "lat" => 46.264793,  "long" =>  -63.147139, "sqft" => 19204, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 381, "store_number" =>'0381', "is_combo_store" => 0, "name" => 'Westbrook Mall',"address"=>'Unit #54, 1200-37 Street SW', "city"=> 'CALGARY', "province" => 'AB', "postal_code" => 'T3C 1S2', "lat" => 51.043264,  "long" =>  -114.141122, "sqft" => 16650, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 382, "store_number" =>'0382', "is_combo_store" => 0, "name" => 'Stratford',"address"=>'Unit #S2, 1067 Ontario Street', "city"=> 'STRATFORD', "province" => 'ON', "postal_code" => 'N5A 6W6', "lat" => 43.369329,  "long" =>  -80.944717, "sqft" => 20100, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 383, "store_number" =>'0383', "is_combo_store" => 0, "name" => 'St. John\'s NFLD',"address"=>'75 Aberdeen Drive', "city"=> 'St. John\'s', "province" => 'NL', "postal_code" => 'A1A 5N6', "lat" => 47.619113,  "long" =>  -52.717877, "sqft" => 19687, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 384, "store_number" =>'0384', "is_combo_store" => 0, "name" => 'Parkland Mall',"address"=>'Unit #150, 4747-67 Street',"city"=>'RED DEER', "province" => 'AB', "postal_code" => 'T4N 6H3', "lat" => 52.288478,  "long" =>  -113.809116, "sqft" => 16127, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 385, "store_number" =>'0385', "is_combo_store" => 0, "name" => 'Willowbrook Shopping Centre',"address"=> '19705 Fraser Hwy', "city"=> 'LANGLEY', "province" => 'BC', "postal_code" => 'V3A 7E9', "lat" => 49.112983,  "long" =>  -122.677613, "sqft" => 20275, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 386, "store_number" =>'0386', "is_combo_store" => 1, "name" => 'Station Mall',"address"=>'Unit 66A, 44 Great Northern Road',"city"=> 'SAULT STE MARIE', "province" => 'ON', "postal_code" => 'P6B 4Y5', "lat" => 46.525067,  "long" =>  -84.319393, "sqft" => 31350, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 389, "store_number" =>'0389', "is_combo_store" => 0, "name" => 'Meadowlands Power Centre',"address"=>'Unit 2, 14 Martindale Cres', "city"=> 'ANCASTER', "province" => 'ON', "postal_code" => 'L9K 1J9', "lat" => 43.229252,  "long" =>  -79.940920, "sqft" => 19832, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 391, "store_number" =>'0391', "is_combo_store" => 0, "name" => 'Brantford',"address"=>'84 Lynden Road', "city"=> 'BRANTFORD', "province" => 'ON', "postal_code" => 'N3R 6B8', "lat" => 43.173652,  "long" =>  -80.240101, "sqft" => 20048, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 392, "store_number" =>'0392', "is_combo_store" => 0, "name" => 'Metropolis @ Metrotown',"address"=>'Major 1, 4700 Kingsway', "city"=> 'BURNABY', "province" => 'BC', "postal_code" => 'V5H 4M1', "lat" => 49.225919,  "long" =>  -123.002663, "sqft" => 48423, "mall_entrance" => 1, "entrances" => 0, "cashbanks" => 0],

	["store_id" => 393, "store_number" =>'0393', "is_combo_store" => 0, "name" => 'Downtown Chatham Centre',"address"=>'Unit M-1, 100 King Street West', "city"=> 'Chatham', "province" => 'ON', "postal_code" => 'N7M 6A9', "lat" => 42.405016,  "long" =>  -82.182377, "sqft" => 25065, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 394, "store_number" =>'0394', "is_combo_store" => 0, "name" => 'Devonshire Mall',"address"=>'3100 Howard Avenue', "city"=> 'WINDSOR', "province" => 'ON', "postal_code" => 'N8X 3Y8', "lat" => 42.274670,  "long" =>  -83.003556, "sqft" => 47496, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 395, "store_number" =>'0395', "is_combo_store" => 0, "name" => 'Hillcrest Mall',"address"=>'Unit Y-2, 9350 Yonge Street',"city"=>'RICHMOND HILL', "province" => 'ON', "postal_code" => 'L4C 5G2', "lat" => 43.854855,  "long" =>  -79.436087, "sqft" => 19270, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 398, "store_number" =>'0398', "is_combo_store" => 0, "name" => 'Place d\'Orleans',"address"=>'Unit 2400, 110 Place d\'Orleans Drive', "city"=> 'ORLEANS', "province" => 'ON', "postal_code" => 'K1C 2L9', "lat" => 45.478249,  "long" =>  -75.516715, "sqft" => 68499, "mall_entrance" => 1, "entrances" => 4, "cashbanks" => 3],

	["store_id" => 401, "store_number" =>'0401', "is_combo_store" => 0, "name" => 'Eaton Ctr',"address"=>'218 Yonge Street', "city"=> 'TORONTO', "province" => 'ON', "postal_code" => 'M5B 2H6', "lat" => 43.653895,  "long" =>  -79.380187, "sqft" => 15002, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 419, "store_number" =>'0419', "is_combo_store" => 1, "name" => 'Georgian Mall',"address"=>'Hwy 26 & 27, 509 Bayfield Street', "city"=> 'BARRIE', "province" => 'ON', "postal_code" => 'L4M 4Z8', "lat" => 44.416661,  "long" =>  -79.713802, "sqft" => 40734, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 5111, "store_number" =>'5111', "is_combo_store" => 0, "name" => 'Toronto Uptown',"address"=>'2529 Yonge Street', "city"=> 'TORONTO', "province" => 'ON', "postal_code" => 'M4P 2H9', "lat" => 43.712948,  "long" =>  -79.399434, "sqft" => 12817, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5112, "store_number" =>'5112', "is_combo_store" => 0, "name" => 'Welland',"address"=>'Unit R1-11, 800 Niagara Street North', "city"=> 'Welland', "province" => 'ON', "postal_code" => 'L3C 5Z4', "lat" => 43.014210,  "long" =>  -79.249168, "sqft" => 18816, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5113, "store_number" =>'5113', "is_combo_store" => 0, "name" => 'Courtenay',"address"=>'3245 Cliff Avenue, Units 2 & 3, Bldg. D', "city"=> 'Courtenay', "province" => 'BC', "postal_code" => 'V9N 2L9', "lat" => 49.672134,  "long" =>  -124.979199, "sqft" => 19305, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5114, "store_number" =>'5114', "is_combo_store" => 0, "name" => 'Gander',"address"=>'Unit 9, 132 Bennett Drive', "city"=> 'Gander', "province" => 'NL', "postal_code" => 'A1V 2H2', "lat" => 48.951504,  "long" =>  -54.602127, "sqft" => 9339, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 2],

	["store_id" => 5115, "store_number" =>'5115', "is_combo_store" => 0, "name" => 'Yarmouth',"address"=>'76 Starrs Road', "city"=> 'Yarmouth', "province" => 'NS', "postal_code" => 'B5A 2T5', "lat" => 43.844593,  "long" =>  -66.098300, "sqft" => 12000, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5116, "store_number" =>'5116', "is_combo_store" => 0, "name" => 'Steinbach',"address"=>'Unit #12, 178 PTH 12 North', "city"=> 'STEINBACH', "province" => 'MB', "postal_code" => 'R5G 1T7', "lat" => 49.524025,  "long" =>  -96.679969, "sqft" => 11220, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5117, "store_number" =>'5117', "is_combo_store" => 0, "name" => 'Okotoks',"address"=>'Unit 206, 100 Southbank Blvd', "city"=> 'Okotoks', "province" => 'AB', "postal_code" => 'T1S 0L3', "lat" => 50.728199,  "long" =>  -113.967765, "sqft" => 15202, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5118, "store_number" =>'5118', "is_combo_store" => 0, "name" => 'Winnipeg Unicity',"address"=>'Unit H0004, 3673 Portage Avenue', "city"=> 'Winnipeg', "province" => 'MB', "postal_code" => 'R3K 2G6', "lat" => 49.885276,  "long" =>  -97.313406, "sqft" => 20201, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5119, "store_number" =>'5119', "is_combo_store" => 0, "name" => 'Cranbrook',"address"=>'First Mountain Brook Shopping Centre,\r2100K Willowbrook Drive', "city"=> 'CRANBROOK', "province" => 'BC', "postal_code" => 'V1C 7H2', "lat" => 49.528714,  "long" =>  -115.746745, "sqft" => 12083, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],
	["store_id" => 5120, "store_number" =>'5120', "is_combo_store" => 1, "name" => 'Hillside Mall',"address"=>'CRU86 & 89, 1644 Hillside Avenue', "city"=> 'VICTORIA', "province" => 'BC', "postal_code" => 'V8T 2C5', "lat" => 48.445737,  "long" =>  -123.335285, "sqft" => 27477, "mall_entrance" => 1, "entrances" => 3, "cashbanks" => 2],

	["store_id" => 5121, "store_number" =>'5121', "is_combo_store" => 0, "name" => 'Stoney Creek',"address"=>'Unit N1, 75 Centennial Parkway North', "city"=> 'HAMILTON', "province" => 'ON', "postal_code" => 'L8E 2P2', "lat" => 43.230907,  "long" =>  -79.765922, "sqft" => 21062, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5122, "store_number" =>'5122', "is_combo_store" => 1, "name" => 'Bowmanville', "address"=>'2401 Highway 2, Unit 1&2', "city"=> 'Bowmanville', "province" => 'ON', "postal_code" => 'L1C 4V4', "lat" => 43.908659,  "long" =>  -78.706166, "sqft" => 37873, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 5123, "store_number" =>'5123', "is_combo_store" => 0, "name" => 'Cochrane',"address"=>'The Quarry Shopping Centre, 60\rQuarry Street East, Unit #4', "city"=> 'COCHRANE', "province" => 'AB', "postal_code" => 'T4C 0W5', "lat" => 51.179050,  "long" =>  -114.408396, "sqft" => 13009, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],
	["store_id" => 5124, "store_number" =>'5124', "is_combo_store" => 0, "name" => 'Camrose',"address"=>'6703-48 Avenue, Unit #130',"city"=>'Camrose', "province" => 'AB', "postal_code" => 'T4V 3K3', "lat" => 53.016873,  "long" =>  -112.855844, "sqft" => 10961.52, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5125, "store_number" =>'5125', "is_combo_store" => 0, "name" => 'Marine Drive',"address"=>'8125 Ontario Street', "city"=> 'Vancouver', "province" => 'BC', "postal_code" => 'V5X 0A7', "lat" => 49.210704,  "long" =>  -123.107230, "sqft" => 27889, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5126, "store_number" =>'5126', "is_combo_store" => 0, "name" => 'Leduc',"address"=>'5406 Discovery Way, Unit # 104', "city"=> 'LEDUC', "province" => 'AB', "postal_code" => 'T9E 8L9', "lat" => 53.269372,  "long" =>  -113.567116, "sqft" => 18185, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5127, "store_number" =>'5127', "is_combo_store" => 0, "name" => 'Confederation',"address"=>'301 Confederation Drive',"city"=>'SASKATOON',"province" => 'SK',"postal_code" => 'S7L 5C3', "lat" => 52.131128,  "long" => -106.722896, "sqft" => 23747.8, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5128, "store_number" =>'5128', "is_combo_store" => 1, "name" => 'Georgetown',"address"=>'Units 70 & 71, 280 Guelph Street', "city"=> 'Georgetown', "province" => 'ON', "postal_code" => 'L7G 4B1', "lat" => 43.649192,  "long" =>  -79.899329, "sqft" => 29508, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5129, "store_number" =>'5129', "is_combo_store" => 0, "name" => 'Oshawa',"address"=>'Harmony Shopping Centre, 1417\rHarmony Road North', "city"=> 'Oshawa', "province" => 'ON', "postal_code" => 'L1H 7K5', "lat" => 43.957485,  "long" =>  -78.875064, "sqft" => 27539, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5131, "store_number" =>'5131', "is_combo_store" => 0, "name" => 'Simcoe',"address"=>'Unit 2, 140 Queensway East', "city"=> 'Simcoe', "province" => 'ON', "postal_code" => 'N3Y 4Y7', "lat" => 42.847931,  "long" =>  -80.292233, "sqft" => 10400, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5132, "store_number" =>'5132', "is_combo_store" => 0, "name" => 'Stoufville',"address"=>'Unit 3, 1010 Hoover Park Drive', "city"=> 'Stouffville', "province" => 'ON', "postal_code" => 'L4A 0K2', "lat" => 43.955716,  "long" =>  -79.278236, "sqft" => 21627, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5133, "store_number" =>'5133', "is_combo_store" => 0, "name" => 'Terrace',"address"=>'Unit 230, 4741 Lakelse Avenue', "city"=> 'Terrace', "province" => 'BC', "postal_code" => 'V8G 4R9', "lat" => 54.515027,  "long" =>  -128.571697, "sqft" => 12171, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5134, "store_number" =>'5134', "is_combo_store" => 1, "name" => 'London',"address"=>'3165 Wonderland Road South', "city"=> 'LONDON', "province" => 'ON', "postal_code" => 'N6L 1R4', "lat" => 42.933384,  "long" =>  -81.283541, "sqft" => 29048, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 2],

	["store_id" => 5135, "store_number" =>'5135', "is_combo_store" => 0, "name" => 'Orangeville',"address"=>'150 First Street, Unit 142', "city"=> 'Orangeville', "province" => 'ON', "postal_code" => 'L9W 3T7', "lat" => 43.931565,  "long" =>  -80.103074, "sqft" => 22426, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5136, "store_number" =>'5136', "is_combo_store" => 0, "name" => 'Cold Lake',"address"=>'6603-51 Street',"city"=>'COLD LAKE', "province" => 'AB', "postal_code" => 'T9M 1C8', "lat" => 54.431761,  "long" =>  -110.205116, "sqft" => 12000, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 2],

	["store_id" => 5138, "store_number" =>'5138', "is_combo_store" => 0, "name" => 'Oakville',"address"=>'Unit 144, 240 Leighland Avenue', "city"=> 'Oakville', "province" => 'ON', "postal_code" => 'L6H 3H6', "lat" => 43.462368,  "long" =>  -79.687044, "sqft" => 18920, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 5139, "store_number" =>'5139', "is_combo_store" => 0, "name" => 'Summerside',"address"=> 'A005, 475 Granville Street North', "city"=> 'Summerside', "province" => 'PE', "postal_code" => 'C1N 4P7', "lat" => 46.410705,  "long" =>  -63.781754, "sqft" => 13500, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 5140, "store_number" =>'5140', "is_combo_store" => 0, "name" => 'Bridgewater',"address"=>'Unit 3, 421 LaHave Street', "city"=> 'Bridgewater', "province" => 'NS', "postal_code" => 'B4V 3A2', "lat" => 44.377408,  "long" =>  -64.515443, "sqft" => 12800, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5141, "store_number" =>'5141', "is_combo_store" => 0, "name" => 'Stockyards',"address"=>'Building B, Unit 105, 75 Gunns Road', "city"=> 'Toronto', "province" => 'ON', "postal_code" => 'M6N 0A3', "lat" => 43.673185,  "long" =>  -79.487262, "sqft" => 26706, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5142, "store_number" =>'5142', "is_combo_store" => 1, "name" => 'Victoria Square',"address"=>'Unit 109, 2955 Phipps Road', "city"=> 'LANGFORD', "province" => 'BC', "postal_code" => 'V9B 0J9', "lat" => 48.439752,  "long" =>  -123.505100, "sqft" => 25825, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5143, "store_number" =>'5143', "is_combo_store" => 1, "name" => 'Yorkton',"address"=>'Unit 7, 205 Hamilton Road', "city"=> 'YORKTON', "province" => 'SK', "postal_code" => 'S3N 4B9', "lat" => 51.207031,  "long" =>  -102.450445, "sqft" => 29433, "mall_entrance" => 0, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 5144, "store_number" =>'5144', "is_combo_store" => 0, "name" => 'Grand falls',"address"=>'19 Cromer Avenue',"city"=>'Grand Falls', "province" => 'NL', "postal_code" => 'A2A 2K5', "lat" => 48.946680,  "long" =>  -55.654932, "sqft" => 11180, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 5145, "store_number" =>'5145', "is_combo_store" => 0, "name" => 'Alliston',"address"=>'Unit ZB, 130 Young Street', "city"=> 'Alliston', "province" => 'ON', "postal_code" => 'L9R 1P8', "lat" => 44.147692,  "long" =>  -79.883058, "sqft" => 12146, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5148, "store_number" =>'5148', "is_combo_store" => 1, "name" => 'Barrie-South',"address"=>'Unit 4, 80 Concert Way', "city"=> 'Barrie', "province" => 'ON', "postal_code" => 'L4N 6N5', "lat" => 44.365817,  "long" =>  -79.695962, "sqft" => 30423, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5149, "store_number" =>'5149', "is_combo_store" => 0, "name" => 'Smithers',"address"=>'Unit 1440, 3664 Highway 16', "city"=> 'Smithers', "province" => 'BC', "postal_code" => 'V0J 2N0', "lat" => 54.410689,  "long" =>  -127.867952, "sqft" => 10500, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5150, "store_number" =>'5150', "is_combo_store" => 0, "name" => 'Williams Lake',"address"=>'Prosperity Ridge, #710, 1185 Prosperity',"city"=>'Williams Lake', "province" => 'BC', "postal_code" => 'V2G 0A6', "lat" => 52.156647,  "long" =>  -122.101770, "sqft" => 12031, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 5151, "store_number" =>'5151', "is_combo_store" => 0, "name" => 'Maple Leaf Square',"address"=>'15 York Street', "city"=> 'Toronto', "province" => 'ON', "postal_code" => 'M5J 0A3', "lat" => 43.642365,  "long" =>  -79.380873, "sqft" => 14428, "mall_entrance" => 1, "entrances" => 3, "cashbanks" => 1],

	["store_id" => 5154, "store_number" =>'5154', "is_combo_store" => 0, "name" => 'Moncton',"address"=>'Unit 46, 1380 Mountain Rd', "city"=> 'Moncton', "province" => 'NB', "postal_code" => 'E1C 2T8', "lat" => 46.110568,  "long" =>  -64.835793, "sqft" => 8504, "mall_entrance" => 0, "entrances" => 0, "cashbanks" => 0],

	["store_id" => 5155, "store_number" =>'5155', "is_combo_store" => 0, "name" => 'Waterdown',"address"=>'Unit 2, 17 Clappison Avenue', "city"=> 'Waterdown', "province" => 'NB', "postal_code" => 'L0R 2H2', "lat" => 43.313017,  "long" =>  -80.036726, "sqft" => 0, "mall_entrance" => 0, "entrances" => 0, "cashbanks" => 0],

	["store_id" => 5156, "store_number" =>'5156', "is_combo_store" => 0, "name" => 'Swift Current',"address"=>'1705 Memorial Drive NE',"city"=>'Swift Current', "province" => 'SK', "postal_code" => 'S9H 5H7', "lat" => 50.292701,  "long" =>  -107.801697, "sqft" => 0, "mall_entrance" => 0, "entrances" => 0, "cashbanks" => 0],

	["store_id" => 5157, "store_number" =>'5157', "is_combo_store" => 0, "name" => 'Selkirk',"address"=>'1051 Manitoba Avenue', "city"=> 'Selkirk', "province" => 'MB', "postal_code" => 'R1A 3T7', "lat" => 50.155731,  "long" =>  -96.888586, "sqft" => 0, "mall_entrance" => 0, "entrances" => 0, "cashbanks" => 0],

	["store_id" => 7401, "store_number" =>'7401', "is_combo_store" => 0, "name" => 'Thunder Bay',"address"=>'787 Memorial Drive',"city"=>'THUNDER BAY', "province" => 'ON', "postal_code" => 'P7B 3Z7', "lat" => 48.411923,  "long" =>  -89.241434, "sqft" => 7522, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 7402, "store_number" =>'7402', "is_combo_store" => 0, "name" => 'Kelowna',"address"=>'1835 Dilworth Drive', "city"=> 'KELOWNA', "province" => 'BC', "postal_code" => 'V1Y 9T1', "lat" => 49.880925,  "long" =>  -119.436946, "sqft" => 7270, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 7403, "store_number" =>'7403', "is_combo_store" => 0, "name" => 'Nanaimo',"address"=>'3200 Island Highway', "city"=> 'NANAIMO', "province" => 'BC', "postal_code" => 'V9T 1W1', "lat" => 49.206088,  "long" =>  -124.005532, "sqft" => 10973, "mall_entrance" => 1, "entrances" => 2, "cashbanks" => 1],

	["store_id" => 7404, "store_number" =>'7404', "is_combo_store" => 0, "name" => 'Abbotsford',"address"=>'32700 South Fraser Way', "city"=> 'Abbotsford', "province" => 'BC', "postal_code" => 'V2T 4M5', "lat" => 49.050215,  "long" =>  -122.317226, "sqft" => 8382, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 7406, "store_number" =>'7406', "is_combo_store" => 0, "name" => 'Kamloops',"address"=>'Unit 105 -1180 Columbia Street West', "city"=> 'KAMLOOPS', "province" => 'BC', "postal_code" => 'V2C 6R6', "lat" => 50.666295,  "long" =>  -120.355186, "sqft" => 7493, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 7407, "store_number" =>'7407', "is_combo_store" => 0, "name" => 'Signal Hill',"address"=>'5967 Signal Hill Centre', "city"=> 'CALGARY', "province" => 'AB', "postal_code" => 'T3H 3P8', "lat" => 51.019533,  "long" =>  -114.172642, "sqft" => 8133, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 7408, "store_number" =>'7408', "is_combo_store" => 0, "name" => 'Lethbridge',"address"=>'2045 Mayor Magrath Drive S', "city"=> 'Lethbridge', "province" => 'AB', "postal_code" => 'T1K 2S2', "lat" => 49.671723,  "long" =>  -112.798609, "sqft" => 10372, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 7410, "store_number" =>'7410', "is_combo_store" => 0, "name" => 'Polo Park',"address"=>'Unit #0100A, 1440 Jack Blick Avenue', "city"=> 'WINNIPEG', "province" => 'MB', "postal_code" => 'R3G 0L4', "lat" => 49.884797,  "long" =>  -97.197942, "sqft" => 10473, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 7411, "store_number" =>'7411', "is_combo_store" => 0, "name" => 'Surrey',"address"=>'10355 - 152nd Street, Unit 2011', "city"=> 'SURREY', "province" => 'BC', "postal_code" => 'V3R 7C1', "lat" => 49.192888,  "long" =>  -122.803487, "sqft" => 9836, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 7412, "store_number" =>'7412', "is_combo_store" => 0, "name" => 'Vaughan Mills',"address"=>'CRU#705, 1 Bass Pro Mills Drive', "city"=> 'Vaughan', "province" => 'ON', "postal_code" => 'L4K 5W4', "lat" => 43.822552,  "long" =>  -79.536809, "sqft" => 6978, "mall_entrance" => 1, "entrances" => 1, "cashbanks" => 1],

	["store_id" => 7413, "store_number" =>'7413', "is_combo_store" => 0, "name" => 'Circle/8th',"address"=>'Unit 445, 3310 8th Street East', "city"=> 'Saskatoon', "province" => 'SK', "postal_code" => 'S7H 5M3', "lat" => 52.113889,  "long" =>  -106.601656, "sqft" => 10543, "mall_entrance" => 0, "entrances" => 0, "cashbanks" => 0],

	["store_id" => 7414, "store_number" =>'7414', "is_combo_store" => 0, "name" => 'Shops @ Don Mills',"address"=>'Unit B004A, 1090 Don Mills Road', "city"=> 'Toronto', "province" => 'ON', "postal_code" => 'M3C 3R6', "lat" => 43.736692,  "long" =>  -79.343915, "sqft" => 8504, "mall_entrance" => 0, "entrances" => 1, "cashbanks" => 0],

	["store_id" => 5159, "store_number" =>'5159', "is_combo_store" => 0, "name" => 'Tamarack Southeast',"address"=>'Bldg. A2, 3737- 17th street NW', "city"=> 'Edmonton', "province" => 'AB', "postal_code" => 'T6T 1A7', "lat" => 53.472197,  "long" =>  -113.368803, "sqft" => 0, "mall_entrance" => 0, "entrances" => 0, "cashbanks" => 0],

	["store_id" => 5161, "store_number" =>'5161', "is_combo_store" => 0, "name" => 'Lakeshore',"address"=>'1015 Lake Shore Blvd. East', "city"=> 'Toronto', "province" => 'ON', "postal_code" => 'M4M 1B4', "lat" => 43.657548,  "long" =>  -79.330354, "sqft" => 0, "mall_entrance" => 0, "entrances" => 0, "cashbanks" => 0],

	["store_id" => 5153, "store_number" =>'5153', "is_combo_store" => 0, "name" => 'East Hills',"address"=>'Unit F1.3, 8333 – 9 Avenue SE', "city"=> 'Calgary', "province" => 'AB', "postal_code" => 'T2A 7X4', "lat" => 51.057420,  "long" =>  -113.912076, "sqft" => 0, "mall_entrance" => 0, "entrances" => 0, "cashbanks" => 0],

	["store_id" => 5158, "store_number" =>'5158', "is_combo_store" => 0, "name" => 'Tsawwassen Mills',"address"=>'5000 Canoe Pass Way', "city" => 'Tsawwassen First Nation', "province" => 'BC', "postal_code" => 'V4M 4G9', "lat" => 49.033237,  "long" =>  -123.087129, "sqft" => 0, "mall_entrance" => 0, "entrances" => 0, "cashbanks" => 0],

	["store_id" => 7415, "store_number" =>'7415', "is_combo_store" => 0, "name" => 'Park Royal Shopping Centre', "address"=>'1100 Park Royal South',"city"=>'West Vancouver', "province" => 'BC', "postal_code" => 'V7T 1A1', "lat" => 49.326251,  "long" =>  -123.138633, "sqft" => 0, "mall_entrance" => 0, "entrances" => 0, "cashbanks" => 0],

	["store_id" => 5165, "store_number" =>'5165', "is_combo_store" => 0, "name" => 'Rideau', "address" => '', "city"=>'Ottawa',  "province" => 'ON', "postal_code" => '', "lat" => 0.000000, "long" =>  0.000000, "sqft" => 0, "mall_entrance" => 0, "entrances" => 0, "cashbanks" => 0],

	["store_id" => 5166, "store_number" =>'5166', "is_combo_store" => 0, "name" => 'Bayshore',  "city"=> 'Ottawa', "province" => 'ON', "postal_code" => '', "lat" => 0.000000, "long" => 0.000000, "sqft" => 0, "mall_entrance" => 0, "entrances" => 0, "cashbanks" => 0],

	["store_id" => 5167, "store_number" =>'5167', "is_combo_store" => 0, "name" => 'Brockville', "city"=>'Ottawa' , "province" => 'ON', "postal_code" => '',"lat" => 0.000000, "long" => 0.000000, "sqft" => 0, "mall_entrance" => 0, "entrances" => 0, "cashbanks" => 0],

	["store_id" => 940, "store_number" =>'A0940', "is_combo_store" => 1, "name" => 'Head Office', "city"=> 'Calgary', "province" => 'AB', "postal_code" => '', "lat" => 0.000000, "long" => 0.000000, "sqft" => 0, "mall_entrance" => 0, "entrances" => 0, "cashbanks" => 0],

	["store_id" => 940, "store_number" =>'0940', "is_combo_store" => 1, "name" => 'Head Office',  "city"=> 'Calgary',"province" => 'AB', "postal_code" => '', "lat" => 0.000000, "long" => 0.000000, "sqft" => 0, "mall_entrance" => 0, "entrances" => 0, "cashbanks" => 0],

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach($this->stores as $store)
    	{
    		DB::table('stores')->insert($store);
    	}
    	
    

    }
}
