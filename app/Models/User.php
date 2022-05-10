<?php

namespace App\Models;

use App\Models\Administrator\UserRole;
use App\Models\Properties\Property;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
class User extends Authenticatable

{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    //TODO: Creating Password Mutator here
    public function SetPASSWORDATTRIBUTE($password)
    {
        return $this->attributes['password'] = Hash::make($password);
    }

    //TODO: Creating Email Mutator here
    public function SetEMAILATTRIBUTE($email)
    {
        return $this->attributes['email'] = strtolower($email);
    }

    //TODO: Creating LastName Mutator here
    public function SetLNAMEATTRIBUTE($name)
    {
        return $this->attributes['name'] = ucfirst(strtolower($name));
    }

    protected $fillable = [
        'name',
        'email',
        'phone',
        'key_location',
        'password',
        'company_name',
        'designation',
        'mobile',
        'address',
        'user_role',
        'city',
        'state',
        'country',
        'redirect_url',
        'company_id',
        'is_active',
        'is_verified',
        'remember_token',
        'zip',
        'branded_pay_page',
        'branded_email',
        'customer_from',
        'sender_id_by_number',
        'sender_id_by_name',
        'services',
        'sender_id',
        'sms_limit',
        'secrate_key',
        'api_key',
        'active_sms_id',
        'real_password',
        'avatar',
        'role_id',
        'is_company',
        'create_by',
        'modify_by',
        'remaining_sms',
        'about',
        'area_id',
        'brn',
        'languages',
        'nationality',
        'residance_number',
        'residance',
        'age',
        'verification_code',
        'specialities'
    ];


    //TODO: Has many Relationship with transactions
    public function transactions()
    {
        return $this->hasMany('App\Models\Admin\Paylinks\Transaction', 'user_id', 'id');
    }

    public function staff_transactions()
    {
        return $this->hasMany('App\Models\Admin\Paylinks\Transaction', 'create_by', 'id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'company_id');
    }

    public function companies()
    {
        return $this->belongsTo('App\Models\User', 'company_id');
    }

    //TODO: Has many Relationship with transactions
    public function company_transactions()
    {
        return $this->hasMany('App\Models\Admin\Paylinks\Transaction', 'company_id', 'id');
    }

    //TODO: Has many Relationship with transactions
    public function users()
    {
        return $this->hasMany('App\Models\User', 'company_id', 'id');
    }

    public function countries()
    {
        return $this->hasMany('App\Models\CommonModel\Country', 'val', 'country');
    }

    public function states()
    {
        return $this->hasMany('App\Models\CommonModel\State', 'val', 'state');
    }

    //TODO: has many Relationship with paytabs
    public function paytabs()
    {
        return $this->hasOne('App\Models\Admin\Company\Paytab', 'company_id', 'id');
    }
    public function user_roles()
    {
        return $this->belongsTo('\App\Models\Administrator\UserRole', 'role_id', 'id');
    }
    public function company_packages()
    {
        return $this->hasOne('App\Models\Admin\Company\CompanyPackage', 'company_id', 'id');
    }
    public function banks()
    {
        return $this->hasMany('App\Models\Admin\Company\Bank', 'company_id', 'id');
    }
    public function documents()
    {
        return $this->hasMany('App\Models\Document', 'company_id');
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
