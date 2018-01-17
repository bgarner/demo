<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;

class CommunicationStoreGroup extends Model
{
    protected $table = 'communication_store_group';

    protected $fillable = ['communication_id', 'store_group_id'];
}
