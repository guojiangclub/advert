<?php

/*
 * This file is part of ibrand/advert.
 *
 * (c) iBrand <https://www.ibrand.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace iBrand\Component\Advert\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class AdvertItem extends Model
{
    use NodeTrait;

    const STATUS_OPEN = 1; // 可用状态

    const STATUS_CLOSE = 0;  // 关闭状态

    protected $guarded = ['id'];

    /**
     * Address constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(config('ibrand.app.database.prefix', 'ibrand_').'advert_item');

        parent::__construct($attributes);
    }

    public function advert()
    {
        return $this->belongsTo(Advert::class);
    }

    public function associate()
    {
        return $this->morphTo();
    }

    public function addChildren(array $attributes = []){

        $attributes['advert_id'] = $this->advert_id;

        $attributes['parent_id'] = $this->id;

        return AdvertItem::create($attributes);

    }

    public function getMetaAttribute($value)
    {
        if (!empty($value)) {
            return json_decode($value,true);
        }
        return $value;
    }

}
