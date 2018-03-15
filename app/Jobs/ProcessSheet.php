<?php

namespace App\Jobs;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProcessSheet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sheetPath;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($sheetPath)
    {
        $this->sheetPath = $sheetPath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $spreadsheet = IOFactory::load($this->sheetPath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $intProdCategory = $sheetData[1]['B'];

        $i = 4;
        while (isset($sheetData[$i])) { // se o código for vazio, assume-se que acabou a lista de produtos
            $product = new Product;
            $product->lm = $sheetData[$i][ProductsController::PROD_COL_KEYS['lm']];
            $product->name = $sheetData[$i][ProductsController::PROD_COL_KEYS['name']];
            $product->free_shipping = $sheetData[$i][ProductsController::PROD_COL_KEYS['free_shipping']];
            $product->description = $sheetData[$i][ProductsController::PROD_COL_KEYS['description']];
            $product->price = $sheetData[$i][ProductsController::PROD_COL_KEYS['price']];
            // todo add category
            $product->save();
            $i++;
        }
    }
}
