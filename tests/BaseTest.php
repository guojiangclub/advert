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

use iBrand\Component\Advert\Models\Advert;
use iBrand\Component\Advert\Models\AdvertItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Orchestra\Testbench\TestCase;
use iBrand\Component\Advert\Repositories\AdvertItemRepository;
use iBrand\Component\Advert\Repositories\AdvertRepository;


/**
 * Class BaseTest.
 */
abstract class BaseTest extends TestCase
{
    use DatabaseMigrations;

    protected $AdvertItemRepository;

    protected $AdvertRepository;

    /**
     * set up test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->AdvertRepository=$this->app->make(AdvertRepository::class);

        $this->AdvertItemRepository=$this->app->make(AdvertItemRepository::class);

        $this->loadMigrationsFrom(__DIR__.'/database');

        $this->seedAd();

        $this->seedAdItems();

        $this->seedGoods();
    }

    /**
     * seed some seedAd.
     */
    public function seedAd()
    {
        $data[0] = ['name' => 'ibrand推广图', 'code' => 'ibrand'];

        $data[1] = ['name' => 'test', 'code' => 'test'];

        Advert::create($data[0]);

        Advert::create($data[1]);
    }

    /**
     * seed some seedAdItems.
     */
    public function seedAdItems()
    {
        $advert_id = 1;

        $data[0] = [
            'name' => '女装',
            'advert_id' => $advert_id,
            'sort' => 2,
            'children' => [
                [
                    'name' => '卫衣女装',
                    'advert_id' => $advert_id,
                    'sort' => 1,
                    'children' => [
                        ['name' => '2016卫衣女装', 'advert_id' => $advert_id, 'sort' => 2],
                        ['name' => '2017卫衣女装', 'advert_id' => $advert_id, 'sort' => 1], ],
                ],

                [
                    'name' => '短裤女装',
                    'advert_id' => $advert_id,
                    'sort' => 3,
                    'children' => [
                        ['name' => '2018短裤女装', 'advert_id' => $advert_id, 'sort' => 1], ],
                ],

                [
                    'name' => '短袖女装',
                    'advert_id' => $advert_id,
                    'sort' => 2,
                    'children' => [
                        ['name' => '2018短袖女装', 'advert_id' => $advert_id, 'sort' => 1], ],
                ],
            ],
        ];

        $data[1] = [
            'name' => '男装',
            'advert_id' => $advert_id,
            'sort' => 1,
            'associate_id' => 1,
            'associate_type' => 'goods',
            'children' => [
                [
                    'name' => '卫衣男装',
                    'advert_id' => $advert_id,
                    'sort' => 1,
                    'children' => [
                        ['name' => '2016卫衣男装', 'advert_id' => $advert_id, 'sort' => 2],
                        ['name' => '2017卫衣男装', 'advert_id' => $advert_id, 'sort' => 1], ],
                ],

                [
                    'name' => '短裤男装',
                    'advert_id' => $advert_id,
                    'sort' => 3,
                    'children' => [
                        ['name' => '2018短裤男装', 'advert_id' => $advert_id, 'sort' => 1], ],
                ],

                [
                    'name' => '短袖男装',
                    'advert_id' => $advert_id,
                    'sort' => 2,
                    'children' => [
                        ['name' => '2018短袖男装', 'advert_id' => $advert_id, 'sort' => 1], ],
                ],
            ],
        ];

        $data[2] = [
            'name' => '儿童',
            'advert_id' => 2,
            'sort' => 1,
            'associate_id' => 2,
            'associate_type' => 'goods',
            'children' => [
                [
                    'name' => '儿童卫衣',
                    'advert_id' => 2,
                    'sort' => 1,
                    'children' => [
                        ['name' => '2016儿童卫衣', 'advert_id' => 2, 'sort' => 2],
                        ['name' => '2017儿童卫衣', 'advert_id' => 2, 'sort' => 1], ],
                ],

                [
                    'name' => '短裤儿童',
                    'advert_id' => 2,
                    'sort' => 3,
                    'children' => [
                        ['name' => '2018短裤儿童', 'advert_id' => 2, 'sort' => 1], ],
                ],

                [
                    'name' => '短袖儿童',
                    'advert_id' => 2,
                    'sort' => 2,
                    'children' => [
                        ['name' => '2018短袖儿童', 'advert_id' => 2, 'sort' => 1], ],
                ],
            ],
        ];

        AdvertItem::create($data[0]);

        AdvertItem::create($data[1]);

        AdvertItem::create($data[2]);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
        $app['config']->set('repository.cache.enabled', true);

        $app['config']->set('ibrand.advert', require __DIR__.'/../config/advert.php');

        $models = [
            'goods' => Goods::class,
        ];

        $app['config']->set('ibrand.advert.models', $models);
    }

    /**
     * seed some seedGoods.
     */
    public function seedGoods()
    {
        Goods::create(['name' => 'goods1']);
        Goods::create(['name' => 'goods2']);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Prettus\Repository\Providers\RepositoryServiceProvider::class,
            \Orchestra\Database\ConsoleServiceProvider::class,
            \iBrand\Component\Advert\AdvertServiceProvider::class,
            \Kalnoy\Nestedset\NestedSetServiceProvider::class,
        ];
    }
}
