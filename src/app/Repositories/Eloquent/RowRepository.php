<?php

namespace App\Repositories\Eloquent;

use App\Models\Row;
use App\Repositories\RowRepositoryInterface;

class RowRepository implements RowRepositoryInterface
{
    /**
     * @return mixed
     */
    public function paginate()
    {
        return Row::paginate(config('app.per_page', 20));
    }
}
