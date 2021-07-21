<?php


namespace App\Repositories;

use App\Models\Post;

class PostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    public function model()
    {
        return Post::class;
    }

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }
}
