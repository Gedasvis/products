<?php
use Migrations\AbstractSeed;

/**
 * Products seed.
 */
class ProductsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'          => 'Phone',
                'price'         => '209.99',
                'description'   => 'Great phone',
                'photo'	        => '',
                'modified'      => date('Y-m-d H:i:s'),
                'created'       => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'Computer',
                'price'         => '1499.99',
                'description'   => 'Best computer',
                'photo'	        => '',
                'modified'      => date('Y-m-d H:i:s'),
                'created'       => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'Camera',
                'price'         => '499.99',
                'description'   => 'Awesome camera',
                'photo'	        => '',
                'modified'      => date('Y-m-d H:i:s'),
                'created'       => date('Y-m-d H:i:s'),
            ]
            
        ];

        $table = $this->table('products');
        $table->insert($data)->save();
    }
}
