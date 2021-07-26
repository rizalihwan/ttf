<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogActivity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'log_activity';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
