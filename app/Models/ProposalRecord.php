<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalRecord extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function report()
    {
      return $this->hasOne(Report::class)->orDoesntHave();
    }
}
