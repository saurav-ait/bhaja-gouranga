<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'member_code',
        'full_name',
        'phone',
        'email',
        'address',
        'joining_date',
        'status',
        'notes',
        'photo_path',
    ];

    protected function casts(): array
    {
        return [
            'joining_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
