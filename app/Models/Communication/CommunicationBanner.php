<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;

class CommunicationBanner extends Model
{
    protected $table = 'communication_banner';
    protected $fillable = ['communication_id', 'banner_id'];
}
