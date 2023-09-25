<?php

namespace App\Jobs;

use App\Models\Item;
use League\Csv\Reader;
use App\Events\MessageSent;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessCsvUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tempFilePath;

    /**
     * Create a new job instance.
     */
    public function __construct($tempFilePath)
    {
        $this->tempFilePath = $tempFilePath;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $csvFilePath = $this->tempFilePath;
        if (!Storage::exists($csvFilePath)) {
            // The file doesn't exist, handle the error accordingly
            Log::error('CSV file not found: ' . $csvFilePath);
            return;
        }
        $fileContents = Storage::get($csvFilePath);
        $csv = Reader::createFromString($fileContents); // Use createFromString to read from a string
        $csv->setHeaderOffset(0); // Assumes the first row is the header
        foreach ($csv->getRecords() as $record) {

            $category_id = $record['Category'] ?? null;
            $subcategory_id = $record['SubCategory'] ?? null;

            if (!empty($category_id) && is_numeric($category_id)) {
                $category_id = (int) $category_id;
            } else {
                $category_id = null;
            }
            if (!empty($subcategory_id) && is_numeric($subcategory_id)) {
                $subcategory_id = (int) $subcategory_id;
            } else {
                $subcategory_id = null;
            }

            $flight = new Item;
            $description = $record['Description'];
            $description = mb_convert_encoding($description, 'UTF-8', 'UTF-8');
            $flight->title = $record['Name'] ?? null;
            $flight->price = $record['Price'] ?? null;
            $flight->original_price = $record['Price'] ?? null;
            $flight->description = $description;
            $flight->phone = $record['Contact Number'] ?? null;
            $flight->category_id = $category_id;
            $flight->subcategory_id = $subcategory_id;
            $flight->currency_id = 1;
            $flight->status = 1;
            $flight->ordering = 1;
            $flight->lat = 31.470120;
            $flight->lng = 74.348230;
            $flight->location_city_id = $record['City'] ?? null;
            $flight->save();
        }
        broadcast(new MessageSent('uploaded!'));


    }
}
