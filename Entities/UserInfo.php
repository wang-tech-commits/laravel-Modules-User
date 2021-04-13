<?php

namespace Modules\User\Entities;

use App\Models\Model;
use App\Traits\HasCovers;
use Modules\User\Entities\Traits\BelongsToUser;

class UserInfo extends Model
{
    use BelongsToUser, HasCovers;

    const GENDERS = [
        0 => '保密',
        1 => '男',
        2 => '女',
    ];

    protected $primaryKey = 'user_id';

    protected $guarded = [];

    /**
     * Notes: 获取性别文字
     * @Author: <Mr.wang>
     * @Date  : 2020/11/24 11:15
     * @return mixed|string
     */
    public function getGenderTextAttribute(): string
    {
        return self::GENDERS[$this->gender];
    }
}
