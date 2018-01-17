<?php

namespace App\Models\UrgentNotice;

use Illuminate\Database\Eloquent\Model;

class UrgentNoticeStoreGroup extends Model
{
    protected $table = 'urgent_notice_store_group';
    protected $fillable = ['urgent_notice_id', 'store_group_id'];
}
