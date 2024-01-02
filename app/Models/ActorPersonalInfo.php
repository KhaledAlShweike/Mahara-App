<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\AppAdmin;
use App\Models\ClubManager;
use App\Models\Doctor;
use App\Models\Rule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ActorPersonalInfo extends Model
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
        'b_date'
    ];
    public function AppAdmin()
    {
        return $this->hasOne(AppAdmin::class);
    }
    public function Doctor()
    {
        return $this->hasOne(Doctor::class);
    }
    public function ClubManager()
    {
        return $this->hasOne(ClubManager::class);
    }
    public function Rule()
    {
        return $this->hasMany(Rule::class);
    }
}
