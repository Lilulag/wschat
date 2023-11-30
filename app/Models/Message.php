<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function getTimeAttribute() {
        // return $this->created_at->diffForHumans();
        return Carbon::parse($this->created_at)->format('d-m-Y H:i');
    }

    public function getIsOwnerAttribute() {
        return (int)$this->user_id === (int)auth()->id();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
