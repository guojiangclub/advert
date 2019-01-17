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

    public function testAddAdvertItem(){

        $Advert = $this->AdvertRepository->create(['name' => 'lwx', 'code' => 'lwx']);

        $Advert->addAdvertItem(['name'=>'test']);

        $Advert->addAdvertItem(['name'=>'test2']);

        $ad = $this->AdvertRepository->getByCode('lwx');

        $ad_item=$ad->addAdvertItem(['name'=>'test3']);

        $ad_item_c=$ad_item->addChildren(['name'=>'children']);

        $this->assertSame($ad_item_c->addChildren(['name'=>'children_c'])->name, 'children_c');

        $this->assertSame($this->AdvertItemRepository->getItemsByCode('lwx')->count(), 3);


    }


}
