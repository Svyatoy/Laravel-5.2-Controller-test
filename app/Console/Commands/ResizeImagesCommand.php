<?php

namespace App\Console\Commands;

use App\ResizedPhoto;
use Illuminate\Console\Command;
use Intervention\Image\Facades\Image;

class ResizeImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:resize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Task to resize all the images every minute';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Grab the first unfinished miniature record
        $thumb_photo = ResizedPhoto::where('status', 'new')->first();

        // Check if record present
        if (!$thumb_photo){
            $this->info('Nothing to resize!');
        }else{
            // If we have record
            // Set status 'in_progress' to database
            $thumb_photo->status = 'in_progress';
            $thumb_photo->save();

            // Grab parent photo
            $parent_photo = $thumb_photo->photo();

            // Try to copy image to thumbs location (photos/resized_photos/)
            if (!\File::copy($parent_photo->src, $thumb_photo->src)) {
                // If failed to copy set error status and change comment
                $thumb_photo->status = 'error';
                $thumb_photo->comment = 'can not create thumb';
                $thumb_photo->save();
            }
            
            // If image copied
            // Get the thumb size (100*100 or 400*400)
            $size = (int)(substr(basename($thumb_photo->src), 0, 3));

            // Resize copied photo to $size and save changes
            Image::make($thumb_photo->src)
                ->resize($size, $size)
                ->save($thumb_photo->src);

            //Set completed status and save database record
            $thumb_photo->status = 'complete';
            $thumb_photo->save();
        }
        // Flash message to console
        $this->info('The happy birthday messages were sent successfully!');
    }
}
