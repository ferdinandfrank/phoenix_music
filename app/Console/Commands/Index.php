<?php

namespace App\Console\Commands;

use App\Console\ConsoleLogger;
use Illuminate\Console\Command;

/**
 * Index
 * -----------------------
 * Console command to build the site index for searching.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Console\Commands
 */
class Index extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'portfolio:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build the site index for searching';

    /**
     * The logger to print information on the console.
     *
     * @var ConsoleLogger
     */
    private $logger;

    /**
     * Executes the console command.
     */
    public function handle() {
        $this->logger = new ConsoleLogger($this, $this->output);
        $this->createTracksIndex();
        $this->createAlbumsIndex();
        $this->createCategoriesIndex();
    }

    /**
     * Creates the search index for the posts table.
     */
    public function createTracksIndex() {
        $this->logger->comment('Indexing tracks table and saving it to /storage/tracks.index...');
        \Artisan::call('scout:import', ['model' => 'App\\Models\\Track']);
        $this->logger->success('The tracks index has been completed.');
    }

    /**
     * Creates the search index for the posts table.
     */
    public function createAlbumsIndex() {
        $this->logger->comment('Indexing albums table and saving it to /storage/albums.index...');
        \Artisan::call('scout:import', ['model' => 'App\\Models\\Album']);
        $this->logger->success('The albums index has been completed.');
    }

    /**
     * Creates the search index for the categories table.
     */
    public function createCategoriesIndex() {
        $this->logger->comment('Indexing categories table and saving it to /storage/categories.index...');
        \Artisan::call('scout:import', ['model' => 'App\\Models\\Category']);
        $this->logger->success('The categories index has been completed.');
    }
}
