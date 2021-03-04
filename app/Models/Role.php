<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (Role $role) {
            if (!$role->permissions()->get()->contains(2)) {
                $role->permissions()->attach(2);
            }
        });
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
