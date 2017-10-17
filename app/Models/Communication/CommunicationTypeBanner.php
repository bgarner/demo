<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;

class CommunicationTypeBanner extends Model
{
    protected $table = 'communication_type_banner';
    protected $fillable = ['communication_type_id', 'banner_id'];
}
