<?php

namespace Salyam\Permissions\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string label
 * @method static Permission find(int $value)
 * @method static where(string $string, string $value)
 * @method static create($fields)
 */
class Permission extends Model
{
    public function roles() {
        return $this->belongsToMany('Salyam\Permissions\Models\Role');
    }

    public function users() {
        return  $this->belongsToMany('\App\User');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'label'
    ];


}
