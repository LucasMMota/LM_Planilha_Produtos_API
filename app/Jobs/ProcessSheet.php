<?php

namespace App\Jobs;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        //
        //$product = $request->all();
        $product = new Product();
        $d = new \DateTime('now');
        $product->lm = $d->format('00s');
        $product->name = 'l';
        $product->free_shipping = 1;
        $product->description = 'aaa:' . $this->sheetPath;
        $product->price = 10.00;
        $product->save();
    }
}
