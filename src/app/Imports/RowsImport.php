<?php

namespace App\Imports;

use App\Events\RowImportErrorEvent;
use App\Events\RowImportProgressEvent;
use App\Models\Row;
use App\My;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Redis;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Validators\Failure;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Throwable;

class RowsImport implements ToModel, WithChunkReading, WithBatchInserts, WithHeadingRow,
                            WithCalculatedFormulas, WithValidation, WithEvents, ShouldQueue
{
    use RemembersRowNumber, RegistersEventListeners, SkipsErrors, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $rowNumber = $this->getRowNumber() - 1; /* deduct first heading row */

        Redis::set(My::ROW_IMPORT_ROW_NUMBER, $rowNumber);

        return new Row([
            'id'   => $rowNumber, /* row number is used, $row[id] gives empty row at next chunk because of formula */
            'name' => $row['name'],
            'date' => ExcelDate::excelToDateTimeObject($row['date']),
        ]);
    }

    public function chunkSize(): int
    {
        return config('excel.exports.chunk_size', 1000);
    }

    public function batchSize(): int
    {
        return config('excel.exports.batch_size', 1000);
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function rules(): array
    {
        return [
            //            'id'   => 'required|integer|between:1,' . PHP_INT_MAX, /* id is calculated, so after chunking it throws error */
            'name' => 'required',
            'date' => 'required',
        ];
    }

    public static function afterImport(AfterImport $event): void
    {
        event(new RowImportProgressEvent('Finished importing all'));
    }

    public static function afterSheet(AfterSheet $event)
    {
        event(new RowImportProgressEvent(__('Finished importing') . ' ' . Redis::get(My::ROW_IMPORT_ROW_NUMBER)));
    }

    public function onError(Throwable $e): void
    {
        $this->errors[] = $e;

        event(new RowImportErrorEvent($this->errors()));
    }

    public function onFailure(Failure ...$failures): void
    {
        $this->failures = array_merge($this->failures, $failures);

        event(new RowImportErrorEvent($this->failures()));
    }
}
