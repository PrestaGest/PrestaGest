<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Concerns\IsFilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, IsFilamentUser;

    protected $table = 'users';

    public static $filamentAdminColumn = 'is_admin';

    public static $filamentAvatarColumn = 'avatar';

    public static $filamentRolesColumn = 'roles';

    protected $casts = [
        'is_admin' => 'bool',
        'roles' => 'array',
    ];

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
