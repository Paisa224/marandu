<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Follower extends Model implements AuditableContract
{
    use Auditable;

    protected $fillable = ['following_id', 'follower_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'following_id');
    }

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }
}
