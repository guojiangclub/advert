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

class AdvertItemRepositoryTest extends BaseTest
{
    public function testGetSubAdItemsByCode()
    {

        $ad_items = $this->AdvertItemRepository->getItemsByCode('ibrandcc');

        $this->assertNull($ad_items);

        $ad_items = $this->AdvertItemRepository->getItemsByCode('ibrand');

        $this->assertSame(2, $ad_items->count());

        $ad_items = $this->AdvertItemRepository->getItemsByCode('test', 1);

        $this->assertSame(1, $ad_items->count());

        $this->assertSame(0, $ad_items[0]->children->count());

        $this->assertSame('儿童', $ad_items[0]->name);
    }

    public function testCreate()
    {
        $ad = $this->AdvertRepository->create(['name' => 'lwx', 'code' => 'lwx']);

        $this->assertSame('iBrand\Component\Advert\Models\Advert', get_class($ad));

        $this->assertSame(3, $ad->id);

        $data = [
            'name' => 'test',
            'advert_id' => 3,
            'sort' => 1,
            'associate_id' => 2,
            'associate_type' => 'goods',
        ];

        $items = $this->AdvertItemRepository->create($data, 0);

        $data_0 = [
            'name' => 'test_0',
            'advert_id' => 3,
            'sort' => 1,
            'associate_id' => 1,
            'associate_type' => 'goods',
        ];

        $items_0 = $this->AdvertItemRepository->create($data_0,$items->id);

        $ad_items = $this->AdvertItemRepository->getItemsByCode('lwx');

        $this->assertSame('test_0', $ad_items[0]->children[0]->name);
    }
}
