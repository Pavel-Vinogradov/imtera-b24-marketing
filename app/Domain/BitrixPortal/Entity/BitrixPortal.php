<?php

namespace App\Domain\BitrixPortal\Entity;

use Illuminate\Database\Eloquent\Model;

class BitrixPortal extends Model
{
    protected function casts(): array
    {
        return [
            'expires_at' => 'timestamp',
        ];
    }
}
