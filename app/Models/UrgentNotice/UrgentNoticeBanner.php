<?php

namespace App\Models\UrgentNotice;

use Illuminate\Database\Eloquent\Model;

class UrgentNoticeBanner extends Model
{
    protected $table = 'urgent_notice_banner';
    protected $fillable = ['urgent_notice_id', 'banner_id'];
}
