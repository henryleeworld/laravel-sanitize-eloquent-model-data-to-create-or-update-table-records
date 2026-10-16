<?php

namespace App\Models;

use App\Builder\SanitizableQueryBuilder;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Touhidurabir\ModelSanitize\Sanitizable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, Sanitizable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return TBuilder
     */
    public function newEloquentBuilder($query)
    {
        return new SanitizableQueryBuilder($query);
    }
}
