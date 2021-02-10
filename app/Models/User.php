<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;


/**
 * Class User
 * @package int $hidden
 * @property string $name
 * @property string $email
 * @property Carbon $created_at
 */

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    use HasRoles;


    protected $with = ["roles"];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'persona_id',
    ];

    protected $appends = [
        'roles', 'permissions','profile_photo_url',
    ];

    public function getPermissionsAttribute() {
        $permissions = Cache::rememberForever('permissions_cache', function() {
            return Permission::select('permissions.*', 'model_has_permissions.*')
                ->join('model_has_permissions', 'permissions.id', '=', 'model_has_permissions.permission_id')
                ->get();
        });

        return $permissions->where('model_id', $this->id);
    }

    public function getRolesAttribute() {
        $roles = Cache::rememberForever('roles_cache', function () {
            return Role::select('roles.*', 'model_has_roles.*')
                ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->get();
        });

        return $roles->where('model_id', $this->id);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */


    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function stores(){
        return $this->belongsToMany(Store::class);
    }

}
