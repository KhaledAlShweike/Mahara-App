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

class ActorPersonalInfos extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table ="ActorPersonalInfos";
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
    public function AppAdmins()
    {
        return $this->hasOne(AppAdmin::class);
    }
    public function Doctors()
    {
        return $this->hasOne(Doctor::class);
    }
    public function ClubManagers()
    {
        return $this->hasOne(ClubManager::class);
    }
    public function Rules()
    {
        return $this->hasMany(Rule::class);
    }
}
