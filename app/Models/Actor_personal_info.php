<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\App_admin;
use App\Models\Club_manager;
use App\Models\Doctor;
use App\Models\Rule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Actor_personal_info extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'Rule',
        'phone_number',
        'email',
        'password',
        'code',
        'b_date',
    ];
    public function App_admin()
    {
        return $this->hasOne(App_admin::class);
    }
    public function Doctor()
    {
        return $this->hasOne(Doctor::class);
    }
    public function Club_manager()
    {
        return $this->hasOne(Club_manager::class);
    }
    public function Rule()
    {
        return $this->hasMany(Rule::class);
    }
}
