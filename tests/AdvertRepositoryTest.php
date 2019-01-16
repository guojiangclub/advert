<?php

/*
 * This file is part of ibrand/advertisement.
 *
 * (c) iBrand <https://www.ibrand.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace iBrand\Component\Advert\Test;

class AdvertRepositoryTest extends BaseTest
{
    public function testGetSubAdItemsByCode()
    {

        $ad= $this->AdvertRepository->getByCode('ibrandcc');

        $this->assertNull($ad);

        $ad = $this->AdvertRepository->getByCode('ibrand');

        $this->assertSame('iBrand\Component\Advert\Models\Advert', get_class($ad));

        $this->assertSame('ibrand', $ad->code);

    }


}
