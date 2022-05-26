<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface RowImportRepositoryInterface
{
    public function import(Request $request);
}
