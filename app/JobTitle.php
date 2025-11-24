<?php

namespace App;

use App;
use App\Models\User;
use App\Traits\Lang;
use App\Traits\Active;
use App\Traits\Sorted;
use App\Traits\IsDefault;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{

    use Lang;
    use IsDefault;
    use Active;
    use Sorted;

    protected $table = 'job_titles';
    public $timestamps = true;
    protected $guarded = ['id'];
    //protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at'];
    public function jobtitlewithuser()
    {
        return $this->hasMany(User::class);
    }
}
