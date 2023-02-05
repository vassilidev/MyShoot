<?php

namespace App\Jobs\Panel\People;

use App\Imports\PeopleImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportPeopleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly string $filePath) {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Excel::import(new PeopleImport, $this->filePath);

        if (Storage::fileExists($this->filePath)) {
            Storage::delete($this->filePath);
        }
    }
}
