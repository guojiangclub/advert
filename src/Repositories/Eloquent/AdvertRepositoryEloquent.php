<?php

/*
 * This file is part of ibrand/advert.
 *
 * (c) iBrand <https://www.ibrand.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace iBrand\Component\Advert\Repositories\Eloquent;

use iBrand\Component\Advert\Models\Advert;
use iBrand\Component\Advert\Repositories\AdvertRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;

class AdvertRepositoryEloquent extends BaseRepository implements AdvertRepository
{
    use CacheableRepository;

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Advert::class;
    }

    /**
     * get advert by code.
     *
     * @param $code
     *
     * @return mixed
     */
    public function getByCode($code,$status=1)
    {
        return $this->findByField('code', $code)->where('status',$status)->first();
    }
}
