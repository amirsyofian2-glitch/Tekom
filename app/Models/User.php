<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'organization_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

      public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->email, '@gmail.com') && $this->hasVerifiedEmail();
    }
    // Relationships
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_user');
    }

    public function userActivities(): HasMany
    {
        return $this->hasMany(UserActivity::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    // Permission methods
    public function hasRole(string|Role $role): bool
    {
        if (is_string($role)) {
            return $this->roles()->where('slug', $role)->exists();
        }

        return $this->roles()->where('id', $role->id)->exists();
    }

    public function hasPermission(string|Permission $permission): bool
    {
        if (is_string($permission)) {
            // Check direct permission
            if ($this->permissions()->where('slug', $permission)->exists()) {
                return true;
            }

            // Check role permissions
            return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
                $query->where('slug', $permission);
            })->exists();
        }

        // Check direct permission
        if ($this->permissions()->where('id', $permission->id)->exists()) {
            return true;
        }

        // Check role permissions
        return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('id', $permission->id);
        })->exists();
    }

    public function assignRole(string|Role $role): self
    {
        if (is_string($role)) {
            $role = Role::where('slug', $role)->firstOrFail();
        }

        $this->roles()->syncWithoutDetaching($role);

        return $this;
    }

    public function removeRole(string|Role $role): self
    {
        if (is_string($role)) {
            $role = Role::where('slug', $role)->firstOrFail();
        }

        $this->roles()->detach($role);

        return $this;
    }

    public function givePermissionTo(string|Permission $permission): self
    {
        if (is_string($permission)) {
            $permission = Permission::where('slug', $permission)->firstOrFail();
        }

        $this->permissions()->syncWithoutDetaching($permission);

        return $this;
    }

    public function revokePermissionTo(string|Permission $permission): self
    {
        if (is_string($permission)) {
            $permission = Permission::where('slug', $permission)->firstOrFail();
        }

        $this->permissions()->detach($permission);

        return $this;
    }

    // Accessors
    public function getRoleNamesAttribute(): array
    {
        return $this->roles->pluck('name')->toArray();
    }

    public function getStatusBadgeAttribute(): string
    {
        return $this->email_verified_at ? 'success' : 'warning';
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->email_verified_at ? 'Verified' : 'Unverified';
    }
}
