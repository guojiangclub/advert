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

class MicroPageAdvert extends Model
{
    protected $guarded = ['id'];

    /**
     * Address constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {

        $this->setTable(config('ibrand.app.database.prefix', 'ibrand_').'micro_page_advert');

        parent::__construct($attributes);
    }

    public function advert(){

        return $this->belongsTo(Advert::class,'advert_id');
    }
}
