<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('seen', 'promising');
    }

    public function superPromising()
    {
        foreach ($this->users as $user)
        {
            if ($user->pivot->promising == true && $user->pivot->seen == true) { $promising[] = true; } else { $promising[] = false; }
        }

        return (!in_array(false, $promising));
    }
}
