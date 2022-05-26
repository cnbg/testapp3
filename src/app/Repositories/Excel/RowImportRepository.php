<?php

namespace App\Repositories\Excel;

use App\Events\RowImportErrorEvent;
use App\Imports\RowsImport;
use App\Repositories\RowImportRepositoryInterface;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class RowImportRepository implements RowImportRepositoryInterface
{
    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function import(Request $request)
    {
        /* Clear table before inserting */
        DB::table('rows')->truncate();

        $errors = [];

        try {
            /* Import uploaded file */
            Excel::import(new RowsImport(), $request->file('file'));
        } catch(ValidationException $e) {
            $errors = $e->failures();
        } catch(QueryException $e) {
            $errors[] = $e->errorInfo[2] ?? $e->getMessage();
        } catch(Exception $e) {
            $errors[] = $e->getMessage();
        }

        return $errors;
    }
}
