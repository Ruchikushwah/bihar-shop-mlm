<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $guarded = [];
    // Relationship for Parent
    public function parent()
    {
        return $this->belongsTo(Membership::class, 'parent_id');
    }

    // Relationship for Left Child
    public function leftMember()
    {
        return $this->belongsTo(Membership::class, 'left_id');
    }

    // Relationship for Right Child
    public function rightMember()
    {
        return $this->belongsTo(Membership::class, 'right_id');
    }
}
