<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\Api\PostController;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Set the password attribute after hashing it.
     *
     * @param string $value 
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Define the many-to-many relationship between users and roles.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user')->withTimestamps();
    }

    /**
     * Get the posts of the user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(PostController::class);
    }

    /**
     * Check if the user has a specific role.
     * 
     * @param string $roleName
     * @return bool
     */
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    /**
     * Assign a role to the user.
     * 
     * @param string $roleName
     * @return void
     */
    public function assignRole(string $roleName)
    {
        $role = Role::where('name', $roleName)->firstOrFail();
        $this->roles()->syncWithoutDetaching($role->id);
    }
    // public function assignRole(array $roleNames)
    // {
    //     $roles = Role::whereIn('name', $roleNames)->get();
    //     $this->roles()->syncWithoutDetaching($roles->pluck('id')->toArray());
    // }

    /**
     * Remove a role from the user.
     * 
     * @param string $roleName
     * @return void
     */
    public function removeRole(string $roleName)
    {
        $role = Role::where('name', $roleName)->firstOrFail();
        $this->roles()->detach($role->id);
    }

    /**
     * Check if the user has a specific permission.
     * 
     * @param string $permissionName
     * @return bool
     */
    public function hasPermission(string $permissionName)
    {
        return $this->roles()->whereHas('permissions', function ($q) use ($permissionName) {
            $q->where('name', $permissionName);
        })->exists();
    }
}
