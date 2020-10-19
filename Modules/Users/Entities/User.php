<?php

namespace Modules\Users\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
     * Get the user's `permission` value and set it either Active/ Inactive as `status`.
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusAttribute()
    {
        return ($this->permission < 1) ? 'Inactive' : 'Active';
    }

    public function account_setting()
    {
        return $this->hasOne(AccountSetting::class);
    }

    public function hasSocialMedia()
    {
        $social_media_links = [
            $this->account_setting->twitter_link,
            $this->account_setting->facebook_link,
            $this->account_setting->instagram_link
        ];

        $has = false;

        foreach($social_media_links as $social_media_link){
            if(!is_null($social_media_link)){
                $has = true;
            }
        }

        return $has;
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(448)
            ->height(448);
    }

    public function getCoverPhoto()
    {
        if(is_null($this->cover_photo)){
            return asset('assets/img/gray.jpg');
        }

        return asset('storage/users-images/cover') . '/' . $this->cover_photo;
    }

    public function hasCoverPhoto()
    {
        return (is_null($this->cover_photo)) ? false : true;
    }
}
