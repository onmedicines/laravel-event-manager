<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $fillable = [
        "user_id",
        "title",
        "category",
        "description",
        "start_time",
        "end_time",
        "location",
        "landmark",
        "latitude",
        "longitude",
        "capacity",
        "price",
        "publish",
        "archived",
        "is_cancelled",
        "contact_email",
        "contact_contact",
    ];

    protected $casts = [
        "start_time" => "datetime",
        "end_time" => "datetime",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
