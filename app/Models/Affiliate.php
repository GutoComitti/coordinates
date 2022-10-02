<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'latitude',
        'affiliate_id',
        'name',
        'longitude',
    ];

    public function location(): Attribute
    {
        return new Attribute(
            get: function ()
            {
                return new Location($this->latitude, $this->longitude);
            }
        );
    }
}
