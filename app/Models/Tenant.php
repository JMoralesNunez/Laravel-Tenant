<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    /**
     * Fields that should be stored directly on the tenants table
     */
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'business_type',
            'status',
        ];
    }

    protected $fillable = [
        'name',
        'business_type',
        'status',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Get the admins for this tenant
     */
    public function admins()
    {
        return $this->hasMany(TenantAdmin::class);
    }

    /**
     * Check if tenant is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
