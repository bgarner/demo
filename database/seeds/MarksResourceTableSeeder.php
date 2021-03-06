<?php

use Illuminate\Database\Seeder;

class MarksResourceTableSeeder extends Seeder
{
    private $resources = [
        ['id' => 1, 'resource_type_id' => 1, 'resource_id' => '0012'],
        ['id' => 2, 'resource_type_id' => 1, 'resource_id' => '0013'],
        ['id' => 3, 'resource_type_id' => 1, 'resource_id' => '0015'],
        ['id' => 4, 'resource_type_id' => 1, 'resource_id' => '0016'],
        ['id' => 5, 'resource_type_id' => 1, 'resource_id' => '0017'],
        ['id' => 6, 'resource_type_id' => 1, 'resource_id' => '0018'],
        ['id' => 7, 'resource_type_id' => 1, 'resource_id' => '0019'],
        ['id' => 8, 'resource_type_id' => 1, 'resource_id' => '0020'],
        ['id' => 9, 'resource_type_id' => 1, 'resource_id' => '0021'],
        ['id' => 10, 'resource_type_id' => 1, 'resource_id' => '0022'],
        ['id' => 11, 'resource_type_id' => 1, 'resource_id' => '0023'],
        ['id' => 12, 'resource_type_id' => 1, 'resource_id' => '0024'],
        ['id' => 13, 'resource_type_id' => 1, 'resource_id' => '0025'],
        ['id' => 14, 'resource_type_id' => 1, 'resource_id' => '0026'],
        ['id' => 15, 'resource_type_id' => 1, 'resource_id' => '0027'],
        ['id' => 16, 'resource_type_id' => 1, 'resource_id' => '0028'],
        ['id' => 17, 'resource_type_id' => 1, 'resource_id' => '0029'],
        ['id' => 18, 'resource_type_id' => 1, 'resource_id' => '0030'],
        ['id' => 19, 'resource_type_id' => 1, 'resource_id' => '0031'],
        ['id' => 20, 'resource_type_id' => 1, 'resource_id' => '0032'],
        ['id' => 21, 'resource_type_id' => 1, 'resource_id' => '0033'],
        ['id' => 22, 'resource_type_id' => 1, 'resource_id' => '0034'],
        ['id' => 23, 'resource_type_id' => 1, 'resource_id' => '0035'],
        ['id' => 24, 'resource_type_id' => 1, 'resource_id' => '0036'],
        ['id' => 25, 'resource_type_id' => 1, 'resource_id' => '0037'],
        ['id' => 26, 'resource_type_id' => 1, 'resource_id' => '0041'],
        ['id' => 27, 'resource_type_id' => 1, 'resource_id' => '0042'],
        ['id' => 28, 'resource_type_id' => 1, 'resource_id' => '0044'],
        ['id' => 29, 'resource_type_id' => 1, 'resource_id' => '0046'],
        ['id' => 30, 'resource_type_id' => 1, 'resource_id' => '0047'],
        ['id' => 31, 'resource_type_id' => 1, 'resource_id' => '0048'],
        ['id' => 32, 'resource_type_id' => 1, 'resource_id' => '0049'],
        ['id' => 33, 'resource_type_id' => 1, 'resource_id' => '0050'],
        ['id' => 34, 'resource_type_id' => 1, 'resource_id' => '0054'],
        ['id' => 35, 'resource_type_id' => 1, 'resource_id' => '0056'],
        ['id' => 36, 'resource_type_id' => 1, 'resource_id' => '0057'],
        ['id' => 37, 'resource_type_id' => 1, 'resource_id' => '0059'],
        ['id' => 38, 'resource_type_id' => 1, 'resource_id' => '0060'],
        ['id' => 39, 'resource_type_id' => 1, 'resource_id' => '0061'],
        ['id' => 40, 'resource_type_id' => 1, 'resource_id' => '0062'],
        ['id' => 41, 'resource_type_id' => 1, 'resource_id' => '0063'],
        ['id' => 42, 'resource_type_id' => 1, 'resource_id' => '0064'],
        ['id' => 43, 'resource_type_id' => 1, 'resource_id' => '0066'],
        ['id' => 44, 'resource_type_id' => 1, 'resource_id' => '0068'],
        ['id' => 45, 'resource_type_id' => 1, 'resource_id' => '0069'],
        ['id' => 46, 'resource_type_id' => 1, 'resource_id' => '0070'],
        ['id' => 47, 'resource_type_id' => 1, 'resource_id' => '0072'],
        ['id' => 48, 'resource_type_id' => 1, 'resource_id' => '0073'],
        ['id' => 49, 'resource_type_id' => 1, 'resource_id' => '0074'],
        ['id' => 50, 'resource_type_id' => 1, 'resource_id' => '0075'],
        ['id' => 51, 'resource_type_id' => 1, 'resource_id' => '0076'],
        ['id' => 52, 'resource_type_id' => 1, 'resource_id' => '0077'],
        ['id' => 53, 'resource_type_id' => 1, 'resource_id' => '0078'],
        ['id' => 54, 'resource_type_id' => 1, 'resource_id' => '0079'],
        ['id' => 55, 'resource_type_id' => 1, 'resource_id' => '0080'],
        ['id' => 56, 'resource_type_id' => 1, 'resource_id' => '0081'],
        ['id' => 57, 'resource_type_id' => 1, 'resource_id' => '0082'],
        ['id' => 58, 'resource_type_id' => 1, 'resource_id' => '0083'],
        ['id' => 59, 'resource_type_id' => 1, 'resource_id' => '0084'],
        ['id' => 60, 'resource_type_id' => 1, 'resource_id' => '0085'],
        ['id' => 61, 'resource_type_id' => 1, 'resource_id' => '0086'],
        ['id' => 62, 'resource_type_id' => 1, 'resource_id' => '0087'],
        ['id' => 63, 'resource_type_id' => 1, 'resource_id' => '0090'],
        ['id' => 64, 'resource_type_id' => 1, 'resource_id' => '0091'],
        ['id' => 65, 'resource_type_id' => 1, 'resource_id' => '0092'],
        ['id' => 66, 'resource_type_id' => 1, 'resource_id' => '0093'],
        ['id' => 67, 'resource_type_id' => 1, 'resource_id' => '0095'],
        ['id' => 68, 'resource_type_id' => 1, 'resource_id' => '0096'],
        ['id' => 69, 'resource_type_id' => 1, 'resource_id' => '0097'],
        ['id' => 70, 'resource_type_id' => 1, 'resource_id' => '0098'],
        ['id' => 71, 'resource_type_id' => 1, 'resource_id' => '0100'],
        ['id' => 72, 'resource_type_id' => 1, 'resource_id' => '0101'],
        ['id' => 73, 'resource_type_id' => 1, 'resource_id' => '0103'],
        ['id' => 74, 'resource_type_id' => 1, 'resource_id' => '0104'],
        ['id' => 75, 'resource_type_id' => 1, 'resource_id' => '0105'],
        ['id' => 76, 'resource_type_id' => 1, 'resource_id' => '0106'],
        ['id' => 77, 'resource_type_id' => 1, 'resource_id' => '0107'],
        ['id' => 78, 'resource_type_id' => 1, 'resource_id' => '0108'],
        ['id' => 79, 'resource_type_id' => 1, 'resource_id' => '0109'],
        ['id' => 80, 'resource_type_id' => 1, 'resource_id' => '0111'],
        ['id' => 81, 'resource_type_id' => 1, 'resource_id' => '0113'],
        ['id' => 82, 'resource_type_id' => 1, 'resource_id' => '0114'],
        ['id' => 83, 'resource_type_id' => 1, 'resource_id' => '0115'],
        ['id' => 84, 'resource_type_id' => 1, 'resource_id' => '0117'],
        ['id' => 85, 'resource_type_id' => 1, 'resource_id' => '0118'],
        ['id' => 86, 'resource_type_id' => 1, 'resource_id' => '0119'],
        ['id' => 87, 'resource_type_id' => 1, 'resource_id' => '0120'],
        ['id' => 88, 'resource_type_id' => 1, 'resource_id' => '0121'],
        ['id' => 89, 'resource_type_id' => 1, 'resource_id' => '0122'],
        ['id' => 90, 'resource_type_id' => 1, 'resource_id' => '0123'],
        ['id' => 91, 'resource_type_id' => 1, 'resource_id' => '0124'],
        ['id' => 92, 'resource_type_id' => 1, 'resource_id' => '0125'],
        ['id' => 93, 'resource_type_id' => 1, 'resource_id' => '0126'],
        ['id' => 94, 'resource_type_id' => 1, 'resource_id' => '0127'],
        ['id' => 95, 'resource_type_id' => 1, 'resource_id' => '0128'],
        ['id' => 96, 'resource_type_id' => 1, 'resource_id' => '0129'],
        ['id' => 97, 'resource_type_id' => 1, 'resource_id' => '0131'],
        ['id' => 98, 'resource_type_id' => 1, 'resource_id' => '0132'],
        ['id' => 99, 'resource_type_id' => 1, 'resource_id' => '0133'],
        ['id' => 100, 'resource_type_id' => 1, 'resource_id' => '0134'],
        ['id' => 101, 'resource_type_id' => 1, 'resource_id' => '0136'],
        ['id' => 102, 'resource_type_id' => 1, 'resource_id' => '0137'],
        ['id' => 103, 'resource_type_id' => 1, 'resource_id' => '0138'],
        ['id' => 104, 'resource_type_id' => 1, 'resource_id' => '0139'],
        ['id' => 105, 'resource_type_id' => 1, 'resource_id' => '0141'],
        ['id' => 106, 'resource_type_id' => 1, 'resource_id' => '0142'],
        ['id' => 107, 'resource_type_id' => 1, 'resource_id' => '0143'],
        ['id' => 108, 'resource_type_id' => 1, 'resource_id' => '0144'],
        ['id' => 109, 'resource_type_id' => 1, 'resource_id' => '0145'],
        ['id' => 110, 'resource_type_id' => 1, 'resource_id' => '0146'],
        ['id' => 111, 'resource_type_id' => 1, 'resource_id' => '0147'],
        ['id' => 112, 'resource_type_id' => 1, 'resource_id' => '0149'],
        ['id' => 113, 'resource_type_id' => 1, 'resource_id' => '0150'],
        ['id' => 114, 'resource_type_id' => 1, 'resource_id' => '0151'],
        ['id' => 115, 'resource_type_id' => 1, 'resource_id' => '0153'],
        ['id' => 116, 'resource_type_id' => 1, 'resource_id' => '0154'],
        ['id' => 117, 'resource_type_id' => 1, 'resource_id' => '0156'],
        ['id' => 118, 'resource_type_id' => 1, 'resource_id' => '0157'],
        ['id' => 119, 'resource_type_id' => 1, 'resource_id' => '0158'],
        ['id' => 120, 'resource_type_id' => 1, 'resource_id' => '0159'],
        ['id' => 121, 'resource_type_id' => 1, 'resource_id' => '0160'],
        ['id' => 122, 'resource_type_id' => 1, 'resource_id' => '0161'],
        ['id' => 123, 'resource_type_id' => 1, 'resource_id' => '0162'],
        ['id' => 124, 'resource_type_id' => 1, 'resource_id' => '0163'],
        ['id' => 125, 'resource_type_id' => 1, 'resource_id' => '0164'],
        ['id' => 126, 'resource_type_id' => 1, 'resource_id' => '0165'],
        ['id' => 127, 'resource_type_id' => 1, 'resource_id' => '0166'],
        ['id' => 128, 'resource_type_id' => 1, 'resource_id' => '0167'],
        ['id' => 129, 'resource_type_id' => 1, 'resource_id' => '0168'],
        ['id' => 130, 'resource_type_id' => 1, 'resource_id' => '0169'],
        ['id' => 131, 'resource_type_id' => 1, 'resource_id' => '0170'],
        ['id' => 132, 'resource_type_id' => 1, 'resource_id' => '0172'],
        ['id' => 133, 'resource_type_id' => 1, 'resource_id' => '0173'],
        ['id' => 134, 'resource_type_id' => 1, 'resource_id' => '0175'],
        ['id' => 135, 'resource_type_id' => 1, 'resource_id' => '0176'],
        ['id' => 136, 'resource_type_id' => 1, 'resource_id' => '0177'],
        ['id' => 137, 'resource_type_id' => 1, 'resource_id' => '0178'],
        ['id' => 138, 'resource_type_id' => 1, 'resource_id' => '0179'],
        ['id' => 139, 'resource_type_id' => 1, 'resource_id' => '0180'],
        ['id' => 140, 'resource_type_id' => 1, 'resource_id' => '0181'],
        ['id' => 141, 'resource_type_id' => 1, 'resource_id' => '0182'],
        ['id' => 142, 'resource_type_id' => 1, 'resource_id' => '0183'],
        ['id' => 143, 'resource_type_id' => 1, 'resource_id' => '0184'],
        ['id' => 144, 'resource_type_id' => 1, 'resource_id' => '0185'],
        ['id' => 145, 'resource_type_id' => 1, 'resource_id' => '0186'],
        ['id' => 146, 'resource_type_id' => 1, 'resource_id' => '0187'],
        ['id' => 147, 'resource_type_id' => 1, 'resource_id' => '0189'],
        ['id' => 148, 'resource_type_id' => 1, 'resource_id' => '0190'],
        ['id' => 149, 'resource_type_id' => 1, 'resource_id' => '0192'],
        ['id' => 150, 'resource_type_id' => 1, 'resource_id' => '0193'],
        ['id' => 151, 'resource_type_id' => 1, 'resource_id' => '0194'],
        ['id' => 152, 'resource_type_id' => 1, 'resource_id' => '0196'],
        ['id' => 153, 'resource_type_id' => 1, 'resource_id' => '0197'],
        ['id' => 154, 'resource_type_id' => 1, 'resource_id' => '0198'],
        ['id' => 155, 'resource_type_id' => 1, 'resource_id' => '0199'],
        ['id' => 156, 'resource_type_id' => 1, 'resource_id' => '0201'],
        ['id' => 157, 'resource_type_id' => 1, 'resource_id' => '0202'],
        ['id' => 158, 'resource_type_id' => 1, 'resource_id' => '0203'],
        ['id' => 159, 'resource_type_id' => 1, 'resource_id' => '0208'],
        ['id' => 160, 'resource_type_id' => 1, 'resource_id' => '0209'],
        ['id' => 161, 'resource_type_id' => 1, 'resource_id' => '0212'],
        ['id' => 162, 'resource_type_id' => 1, 'resource_id' => '0214'],
        ['id' => 163, 'resource_type_id' => 1, 'resource_id' => '0216'],
        ['id' => 164, 'resource_type_id' => 1, 'resource_id' => '0218'],
        ['id' => 165, 'resource_type_id' => 1, 'resource_id' => '0220'],
        ['id' => 166, 'resource_type_id' => 1, 'resource_id' => '0222'],
        ['id' => 167, 'resource_type_id' => 1, 'resource_id' => '0223'],
        ['id' => 168, 'resource_type_id' => 1, 'resource_id' => '0224'],
        ['id' => 169, 'resource_type_id' => 1, 'resource_id' => '0225'],
        ['id' => 170, 'resource_type_id' => 1, 'resource_id' => '0226'],
        ['id' => 171, 'resource_type_id' => 1, 'resource_id' => '0228'],
        ['id' => 172, 'resource_type_id' => 1, 'resource_id' => '0229'],
        ['id' => 173, 'resource_type_id' => 1, 'resource_id' => '0230'],
        ['id' => 174, 'resource_type_id' => 1, 'resource_id' => '0231'],
        ['id' => 175, 'resource_type_id' => 1, 'resource_id' => '0233'],
        ['id' => 176, 'resource_type_id' => 1, 'resource_id' => '0234'],
        ['id' => 177, 'resource_type_id' => 1, 'resource_id' => '0235'],
        ['id' => 178, 'resource_type_id' => 1, 'resource_id' => '0236'],
        ['id' => 179, 'resource_type_id' => 1, 'resource_id' => '0237'],
        ['id' => 180, 'resource_type_id' => 1, 'resource_id' => '0238'],
        ['id' => 181, 'resource_type_id' => 1, 'resource_id' => '0239'],
        ['id' => 182, 'resource_type_id' => 1, 'resource_id' => '0240'],
        ['id' => 183, 'resource_type_id' => 1, 'resource_id' => '0243'],
        ['id' => 184, 'resource_type_id' => 1, 'resource_id' => '0244'],
        ['id' => 185, 'resource_type_id' => 1, 'resource_id' => '0245'],
        ['id' => 186, 'resource_type_id' => 1, 'resource_id' => '0246'],
        ['id' => 187, 'resource_type_id' => 1, 'resource_id' => '0247'],
        ['id' => 188, 'resource_type_id' => 1, 'resource_id' => '0248'],
        ['id' => 189, 'resource_type_id' => 1, 'resource_id' => '0249'],
        ['id' => 190, 'resource_type_id' => 1, 'resource_id' => '0250'],
        ['id' => 191, 'resource_type_id' => 1, 'resource_id' => '0251'],
        ['id' => 192, 'resource_type_id' => 1, 'resource_id' => '0252'],
        ['id' => 193, 'resource_type_id' => 1, 'resource_id' => '0257'],
        ['id' => 194, 'resource_type_id' => 1, 'resource_id' => '0258'],
        ['id' => 195, 'resource_type_id' => 1, 'resource_id' => '0259'],
        ['id' => 196, 'resource_type_id' => 1, 'resource_id' => '0261'],
        ['id' => 197, 'resource_type_id' => 1, 'resource_id' => '0262'],
        ['id' => 198, 'resource_type_id' => 1, 'resource_id' => '0264'],
        ['id' => 199, 'resource_type_id' => 1, 'resource_id' => '0265'],
        ['id' => 200, 'resource_type_id' => 1, 'resource_id' => '0267'],
        ['id' => 201, 'resource_type_id' => 1, 'resource_id' => '0269'],
        ['id' => 202, 'resource_type_id' => 1, 'resource_id' => '0272'],
        ['id' => 203, 'resource_type_id' => 1, 'resource_id' => '0276'],
        ['id' => 204, 'resource_type_id' => 1, 'resource_id' => '0279'],
        ['id' => 205, 'resource_type_id' => 1, 'resource_id' => '0280'],
        ['id' => 206, 'resource_type_id' => 1, 'resource_id' => '0281'],
        ['id' => 207, 'resource_type_id' => 1, 'resource_id' => '0282'],
        ['id' => 208, 'resource_type_id' => 1, 'resource_id' => '0283'],
        ['id' => 209, 'resource_type_id' => 1, 'resource_id' => '0285'],
        ['id' => 210, 'resource_type_id' => 1, 'resource_id' => '0287'],
        ['id' => 211, 'resource_type_id' => 1, 'resource_id' => '0291'],
        ['id' => 212, 'resource_type_id' => 1, 'resource_id' => '0292'],
        ['id' => 213, 'resource_type_id' => 1, 'resource_id' => '0294'],
        ['id' => 214, 'resource_type_id' => 1, 'resource_id' => '0295'],
        ['id' => 215, 'resource_type_id' => 1, 'resource_id' => '0296'],
        ['id' => 216, 'resource_type_id' => 1, 'resource_id' => '0297'],
        ['id' => 217, 'resource_type_id' => 1, 'resource_id' => '0300'],
        ['id' => 218, 'resource_type_id' => 1, 'resource_id' => '0301'],
        ['id' => 219, 'resource_type_id' => 1, 'resource_id' => '0302'],
        ['id' => 220, 'resource_type_id' => 1, 'resource_id' => '0303'],
        ['id' => 221, 'resource_type_id' => 1, 'resource_id' => '0304'],
        ['id' => 222, 'resource_type_id' => 1, 'resource_id' => '0305'],
        ['id' => 223, 'resource_type_id' => 1, 'resource_id' => '0306'],
        ['id' => 224, 'resource_type_id' => 1, 'resource_id' => '0307'],
        ['id' => 225, 'resource_type_id' => 1, 'resource_id' => '0308'],
        ['id' => 226, 'resource_type_id' => 1, 'resource_id' => '0309'],
        ['id' => 227, 'resource_type_id' => 1, 'resource_id' => '0311'],
        ['id' => 228, 'resource_type_id' => 1, 'resource_id' => '0312'],
        ['id' => 229, 'resource_type_id' => 1, 'resource_id' => '0313'],
        ['id' => 230, 'resource_type_id' => 1, 'resource_id' => '0314'],
        ['id' => 231, 'resource_type_id' => 1, 'resource_id' => '0315'],
        ['id' => 232, 'resource_type_id' => 1, 'resource_id' => '0316'],
        ['id' => 233, 'resource_type_id' => 1, 'resource_id' => '0317'],
        ['id' => 234, 'resource_type_id' => 1, 'resource_id' => '0318'],
        ['id' => 235, 'resource_type_id' => 1, 'resource_id' => '0319'],
        ['id' => 236, 'resource_type_id' => 1, 'resource_id' => '0320'],
        ['id' => 237, 'resource_type_id' => 1, 'resource_id' => '0321'],
        ['id' => 238, 'resource_type_id' => 1, 'resource_id' => '0322'],
        ['id' => 239, 'resource_type_id' => 1, 'resource_id' => '0323'],
        ['id' => 240, 'resource_type_id' => 1, 'resource_id' => '0325'],
        ['id' => 241, 'resource_type_id' => 1, 'resource_id' => '0326'],
        ['id' => 242, 'resource_type_id' => 1, 'resource_id' => '0329'],
        ['id' => 243, 'resource_type_id' => 1, 'resource_id' => '0330'],
        ['id' => 244, 'resource_type_id' => 1, 'resource_id' => '0331'],
        ['id' => 245, 'resource_type_id' => 1, 'resource_id' => '0335'],
        ['id' => 246, 'resource_type_id' => 1, 'resource_id' => '0336'],
        ['id' => 247, 'resource_type_id' => 1, 'resource_id' => '0337'],
        ['id' => 248, 'resource_type_id' => 1, 'resource_id' => '0338'],
        ['id' => 249, 'resource_type_id' => 1, 'resource_id' => '0339'],
        ['id' => 250, 'resource_type_id' => 1, 'resource_id' => '0340'],
        ['id' => 251, 'resource_type_id' => 1, 'resource_id' => '0341'],
        ['id' => 252, 'resource_type_id' => 1, 'resource_id' => '0343'],
        ['id' => 253, 'resource_type_id' => 1, 'resource_id' => '0345'],
        ['id' => 254, 'resource_type_id' => 1, 'resource_id' => '0346'],
        ['id' => 255, 'resource_type_id' => 1, 'resource_id' => '0347'],
        ['id' => 256, 'resource_type_id' => 1, 'resource_id' => '0348'],
        ['id' => 257, 'resource_type_id' => 1, 'resource_id' => '0349'],
        ['id' => 258, 'resource_type_id' => 1, 'resource_id' => '0351'],
        ['id' => 259, 'resource_type_id' => 1, 'resource_id' => '0352'],
        ['id' => 260, 'resource_type_id' => 1, 'resource_id' => '0360'],
        ['id' => 261, 'resource_type_id' => 1, 'resource_id' => '0361'],
        ['id' => 262, 'resource_type_id' => 1, 'resource_id' => '0363'],
        ['id' => 263, 'resource_type_id' => 1, 'resource_id' => '0364'],
        ['id' => 264, 'resource_type_id' => 1, 'resource_id' => '0365'],
        ['id' => 265, 'resource_type_id' => 1, 'resource_id' => '0366'],
        ['id' => 266, 'resource_type_id' => 1, 'resource_id' => '0367'],
        ['id' => 267, 'resource_type_id' => 1, 'resource_id' => '0368'],
        ['id' => 268, 'resource_type_id' => 1, 'resource_id' => '0369'],
        ['id' => 269, 'resource_type_id' => 1, 'resource_id' => '0370'],
        ['id' => 270, 'resource_type_id' => 1, 'resource_id' => '0371'],
        ['id' => 271, 'resource_type_id' => 1, 'resource_id' => '0372'],
        ['id' => 272, 'resource_type_id' => 1, 'resource_id' => '0373'],
        ['id' => 273, 'resource_type_id' => 1, 'resource_id' => '0374'],
        ['id' => 274, 'resource_type_id' => 1, 'resource_id' => '0376'],
        ['id' => 275, 'resource_type_id' => 1, 'resource_id' => '0377'],
        ['id' => 276, 'resource_type_id' => 1, 'resource_id' => '0378'],
        ['id' => 277, 'resource_type_id' => 1, 'resource_id' => '0379'],
        ['id' => 278, 'resource_type_id' => 1, 'resource_id' => '0380'],
        ['id' => 279, 'resource_type_id' => 1, 'resource_id' => '0381'],
        ['id' => 280, 'resource_type_id' => 1, 'resource_id' => '0383'],
        ['id' => 281, 'resource_type_id' => 1, 'resource_id' => '0385'],
        ['id' => 282, 'resource_type_id' => 1, 'resource_id' => '0386'],
        ['id' => 283, 'resource_type_id' => 1, 'resource_id' => '0388'],
        ['id' => 284, 'resource_type_id' => 1, 'resource_id' => '0389'],
        ['id' => 285, 'resource_type_id' => 1, 'resource_id' => '0390'],
        ['id' => 286, 'resource_type_id' => 1, 'resource_id' => '0391'],
        ['id' => 287, 'resource_type_id' => 1, 'resource_id' => '0392'],
        ['id' => 288, 'resource_type_id' => 1, 'resource_id' => '0393'],
        ['id' => 289, 'resource_type_id' => 1, 'resource_id' => '0395'],
        ['id' => 290, 'resource_type_id' => 1, 'resource_id' => '0505'],
        ['id' => 291, 'resource_type_id' => 1, 'resource_id' => '0506'],
        ['id' => 292, 'resource_type_id' => 1, 'resource_id' => '0515'],
        ['id' => 293, 'resource_type_id' => 1, 'resource_id' => '0516'],
        ['id' => 294, 'resource_type_id' => 1, 'resource_id' => '0517'],
        ['id' => 295, 'resource_type_id' => 1, 'resource_id' => '0518'],
        ['id' => 296, 'resource_type_id' => 1, 'resource_id' => '0519'],
        ['id' => 297, 'resource_type_id' => 1, 'resource_id' => '0520'],
        ['id' => 298, 'resource_type_id' => 1, 'resource_id' => '0521'],
        ['id' => 299, 'resource_type_id' => 1, 'resource_id' => '0522'],
        ['id' => 300, 'resource_type_id' => 1, 'resource_id' => '0523'],
        ['id' => 301, 'resource_type_id' => 1, 'resource_id' => '0525'],
        ['id' => 302, 'resource_type_id' => 1, 'resource_id' => '0526'],
        ['id' => 303, 'resource_type_id' => 1, 'resource_id' => '0527'],
        ['id' => 304, 'resource_type_id' => 1, 'resource_id' => '0529'],
        ['id' => 305, 'resource_type_id' => 1, 'resource_id' => '0530'],
        ['id' => 306, 'resource_type_id' => 1, 'resource_id' => '0532'],
        ['id' => 307, 'resource_type_id' => 1, 'resource_id' => '0534'],
        ['id' => 308, 'resource_type_id' => 1, 'resource_id' => '0536'],
        ['id' => 309, 'resource_type_id' => 1, 'resource_id' => '0537'],
        ['id' => 310, 'resource_type_id' => 1, 'resource_id' => '0538'],
        ['id' => 311, 'resource_type_id' => 1, 'resource_id' => '0539'],
        ['id' => 312, 'resource_type_id' => 1, 'resource_id' => '0540'],
        ['id' => 313, 'resource_type_id' => 1, 'resource_id' => '0541'],
        ['id' => 314, 'resource_type_id' => 1, 'resource_id' => '0544'],
        ['id' => 315, 'resource_type_id' => 1, 'resource_id' => '0545'],
        ['id' => 316, 'resource_type_id' => 1, 'resource_id' => '0547'],
        ['id' => 317, 'resource_type_id' => 1, 'resource_id' => '0555'],
        ['id' => 318, 'resource_type_id' => 1, 'resource_id' => '0560'],
        ['id' => 319, 'resource_type_id' => 1, 'resource_id' => '0562'],
        ['id' => 320, 'resource_type_id' => 1, 'resource_id' => '0563'],
        ['id' => 321, 'resource_type_id' => 1, 'resource_id' => '0564'],
        ['id' => 322, 'resource_type_id' => 1, 'resource_id' => '0565'],
        ['id' => 323, 'resource_type_id' => 1, 'resource_id' => '0566'],
        ['id' => 324, 'resource_type_id' => 1, 'resource_id' => '0567'],
        ['id' => 325, 'resource_type_id' => 1, 'resource_id' => '0568'],
        ['id' => 326, 'resource_type_id' => 1, 'resource_id' => '0569'],
        ['id' => 327, 'resource_type_id' => 1, 'resource_id' => '0570'],
        ['id' => 328, 'resource_type_id' => 1, 'resource_id' => '0571'],
        ['id' => 329, 'resource_type_id' => 1, 'resource_id' => '0572'],
        ['id' => 330, 'resource_type_id' => 1, 'resource_id' => '0573'],
        ['id' => 331, 'resource_type_id' => 1, 'resource_id' => '0574'],
        ['id' => 332, 'resource_type_id' => 1, 'resource_id' => '0576'],
        ['id' => 333, 'resource_type_id' => 1, 'resource_id' => '0577'],
        ['id' => 334, 'resource_type_id' => 1, 'resource_id' => '0578'],
        ['id' => 335, 'resource_type_id' => 1, 'resource_id' => '0579'],
        ['id' => 336, 'resource_type_id' => 1, 'resource_id' => '0580'],
        ['id' => 337, 'resource_type_id' => 1, 'resource_id' => '0581'],
        ['id' => 338, 'resource_type_id' => 1, 'resource_id' => '0582'],
        ['id' => 339, 'resource_type_id' => 1, 'resource_id' => '0584'],
        ['id' => 340, 'resource_type_id' => 1, 'resource_id' => '0585'],
        ['id' => 341, 'resource_type_id' => 1, 'resource_id' => '0586'],
        ['id' => 342, 'resource_type_id' => 1, 'resource_id' => '0588'],
        ['id' => 343, 'resource_type_id' => 1, 'resource_id' => '0589'],
        ['id' => 344, 'resource_type_id' => 1, 'resource_id' => '0590'],
        ['id' => 345, 'resource_type_id' => 1, 'resource_id' => '0591'],
        ['id' => 346, 'resource_type_id' => 1, 'resource_id' => '0592'],
        ['id' => 347, 'resource_type_id' => 1, 'resource_id' => '0593'],
        ['id' => 348, 'resource_type_id' => 1, 'resource_id' => '0594'],
        ['id' => 349, 'resource_type_id' => 1, 'resource_id' => '0597'],
        ['id' => 350, 'resource_type_id' => 1, 'resource_id' => '0598'],
        ['id' => 351, 'resource_type_id' => 1, 'resource_id' => '0703'],
        ['id' => 352, 'resource_type_id' => 1, 'resource_id' => '0710'],
        ['id' => 353, 'resource_type_id' => 1, 'resource_id' => '0711'],
        ['id' => 354, 'resource_type_id' => 1, 'resource_id' => '0713'],
        ['id' => 355, 'resource_type_id' => 1, 'resource_id' => '0714'],
        ['id' => 356, 'resource_type_id' => 1, 'resource_id' => '0730'],
        ['id' => 357, 'resource_type_id' => 1, 'resource_id' => '0740'],
        ['id' => 358, 'resource_type_id' => 1, 'resource_id' => '0745'],
        ['id' => 359, 'resource_type_id' => 1, 'resource_id' => '0747'],
        ['id' => 360, 'resource_type_id' => 1, 'resource_id' => '0751'],
        ['id' => 361, 'resource_type_id' => 1, 'resource_id' => '0753'],
        ['id' => 362, 'resource_type_id' => 1, 'resource_id' => '0756'],
        ['id' => 363, 'resource_type_id' => 1, 'resource_id' => '0760'],
        ['id' => 364, 'resource_type_id' => 1, 'resource_id' => '0761'],
        ['id' => 365, 'resource_type_id' => 1, 'resource_id' => '0762'],
        ['id' => 366, 'resource_type_id' => 1, 'resource_id' => '0780'],
        ['id' => 367, 'resource_type_id' => 1, 'resource_id' => '0781'],
        ['id' => 368, 'resource_type_id' => 1, 'resource_id' => '0792'],
        ['id' => 369, 'resource_type_id' => 1, 'resource_id' => '0794'],
        ['id' => 370, 'resource_type_id' => 1, 'resource_id' => '0795'],
        ['id' => 371, 'resource_type_id' => 1, 'resource_id' => '0796'],
        ['id' => 372, 'resource_type_id' => 1, 'resource_id' => '0797'],
        ['id' => 373, 'resource_type_id' => 1, 'resource_id' => '0798'],
        ['id' => 374, 'resource_type_id' => 1, 'resource_id' => '0822'],
        ['id' => 375, 'resource_type_id' => 1, 'resource_id' => '0823'],
        ['id' => 376, 'resource_type_id' => 1, 'resource_id' => '0824'],
        ['id' => 377, 'resource_type_id' => 1, 'resource_id' => '0825'],
        ['id' => 378, 'resource_type_id' => 1, 'resource_id' => '0827'],
        ['id' => 379, 'resource_type_id' => 1, 'resource_id' => '0829'],
        ['id' => 380, 'resource_type_id' => 1, 'resource_id' => '0833'],
        ['id' => 381, 'resource_type_id' => 1, 'resource_id' => '0838'],
        ['id' => 382, 'resource_type_id' => 1, 'resource_id' => '0511'],
        ['id' => 383, 'resource_type_id' => 1, 'resource_id' => '0875'],
        ['id' => 384, 'resource_type_id' => 1, 'resource_id' => '0357'],
        ['id' => 385, 'resource_type_id' => 1, 'resource_id' => '0358'],
        ['id' => 386, 'resource_type_id' => 1, 'resource_id' => '0382'],
        ['id' => 387, 'resource_type_id' => 1, 'resource_id' => '0774'],
        ['id' => 388, 'resource_type_id' => 2 , 'resource_id' => '1' ],
        ['id' => 389, 'resource_type_id' => 2 , 'resource_id' => '2' ],
        ['id' => 390, 'resource_type_id' => 2 , 'resource_id' => '3' ],
        ['id' => 391, 'resource_type_id' => 2 , 'resource_id' => '4' ],
        ['id' => 392, 'resource_type_id' => 2 , 'resource_id' => '5' ],
        ['id' => 393, 'resource_type_id' => 2 , 'resource_id' => '6' ],
        ['id' => 394, 'resource_type_id' => 2 , 'resource_id' => '7' ],
        ['id' => 395, 'resource_type_id' => 2 , 'resource_id' => '8' ],
        ['id' => 396, 'resource_type_id' => 2 , 'resource_id' => '9' ],
        ['id' => 397, 'resource_type_id' => 2 , 'resource_id' => '10' ],
        ['id' => 398, 'resource_type_id' => 2 , 'resource_id' => '11' ],
        ['id' => 399, 'resource_type_id' => 2 , 'resource_id' => '12' ],
        ['id' => 400, 'resource_type_id' => 2 , 'resource_id' => '13' ],
        ['id' => 401, 'resource_type_id' => 2 , 'resource_id' => '14' ],
        ['id' => 402, 'resource_type_id' => 2 , 'resource_id' => '15' ],
        ['id' => 403, 'resource_type_id' => 2 , 'resource_id' => '16' ],
        ['id' => 404, 'resource_type_id' => 2 , 'resource_id' => '17' ],
        ['id' => 405, 'resource_type_id' => 2 , 'resource_id' => '18' ],
        ['id' => 406, 'resource_type_id' => 2 , 'resource_id' => '19' ],
        ['id' => 407, 'resource_type_id' => 2 , 'resource_id' => '20' ],
        ['id' => 408, 'resource_type_id' => 2 , 'resource_id' => '21' ],
        ['id' => 409, 'resource_type_id' => 2 , 'resource_id' => '22' ],
        ['id' => 410, 'resource_type_id' => 2 , 'resource_id' => '23' ],
        ['id' => 411, 'resource_type_id' => 2 , 'resource_id' => '24' ],
        ['id' => 412, 'resource_type_id' => 2 , 'resource_id' => '25' ],
        ['id' => 413, 'resource_type_id' => 2 , 'resource_id' => '26' ],
        ['id' => 414, 'resource_type_id' => 2 , 'resource_id' => '27' ],
        ['id' => 415, 'resource_type_id' => 2 , 'resource_id' => '28' ],
        ['id' => 416, 'resource_type_id' => 2 , 'resource_id' => '29' ],
        ['id' => 417, 'resource_type_id' => 2 , 'resource_id' => '30' ],
        ['id' => 418, 'resource_type_id' => 2 , 'resource_id' => '31' ],
        ['id' => 419, 'resource_type_id' => 2 , 'resource_id' => '32' ],
        ['id' => 420, 'resource_type_id' => 2 , 'resource_id' => '33' ],
        ['id' => 421, 'resource_type_id' => 2 , 'resource_id' => '34' ],
        ['id' => 422, 'resource_type_id' => 2 , 'resource_id' => '35' ],
        ['id' => 423, 'resource_type_id' => 3 , 'resource_id' => '1' ],
        ['id' => 424, 'resource_type_id' => 3 , 'resource_id' => '2' ],
        ['id' => 425, 'resource_type_id' => 3 , 'resource_id' => '3' ],
        ['id' => 426, 'resource_type_id' => 3 , 'resource_id' => '4' ],
        ['id' => 427, 'resource_type_id' => 3 , 'resource_id' => '5' ],
        ['id' => 428, 'resource_type_id' => 3 , 'resource_id' => '6' ],
        ['id' => 429, 'resource_type_id' => 4,  'resource_id' => null]
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
