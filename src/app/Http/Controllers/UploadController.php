<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\My;
use App\Repositories\RowImportRepositoryInterface;
use App\Repositories\RowRepositoryInterface;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    private RowRepositoryInterface $rowRepository;
    private RowImportRepositoryInterface $rowImportRepository;

    public function __construct(
        RowRepositoryInterface $rowRepository,
        RowImportRepositoryInterface $rowImportRepository
    )
    {
        $this->rowRepository = $rowRepository;
        $this->rowImportRepository = $rowImportRepository;
    }

    public function list()
    {
        return view('upload.list', [
            'rows' => $this->rowRepository->paginate(),
        ]);
    }

    public function show(Request $request)
    {
        return view('upload.show');
    }

    public function store(UploadRequest $request)
    {
        $errors = $this->rowImportRepository->import($request);

        return redirect()->route('upload.show')->withErrors($errors);
    }
}
