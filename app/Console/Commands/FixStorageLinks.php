<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixStorageLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:fix-links';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix storage links for product images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $publicPath = public_path('storage');
        $storagePath = storage_path('app/public');

        // Check if the link exists and delete it if it does
        if (is_link($publicPath)) {
            $this->info('Removing existing symbolic link...');
            unlink($publicPath);
        } elseif (file_exists($publicPath)) {
            $this->error("The path {$publicPath} exists but is not a symbolic link.");
            if ($this->confirm('Do you want to delete it and recreate the link?')) {
                File::deleteDirectory($publicPath);
            } else {
                $this->info('Operation canceled.');
                return;
            }
        }

        // Create the symbolic link
        $this->info('Creating new symbolic link...');
        if (symlink($storagePath, $publicPath)) {
            $this->info('Symbolic link created successfully!');
            $this->info('Storage public path: ' . $publicPath);
            $this->info('Linked to: ' . $storagePath);
        } else {
            $this->error('Failed to create symbolic link.');
        }
    }
}
