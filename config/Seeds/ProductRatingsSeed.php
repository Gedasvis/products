<?php
use Migrations\AbstractSeed;

/**
 * ProductRatings seed.
 */
class ProductRatingsSeed extends AbstractSeed
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
                'product_id'    => '2',
                'score'         => '4',
                'created'       => date('Y-m-d H:i:s'),
            ],
            [
                'product_id'    => '3',
                'score'         => '5',
                'created'       => date('Y-m-d H:i:s'),
            ],
            [
                'product_id'    => '4',
                'score'         => '3',
                'created'       => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('product_ratings');
        $table->insert($data)->save();
    }
}
