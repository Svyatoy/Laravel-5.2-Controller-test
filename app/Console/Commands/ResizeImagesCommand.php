<?php

namespace App\Console\Commands;

use App\Photo;
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
    protected $description = 'Command description';

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
        $thumb_photo = ResizedPhoto::where('status', 'new')->first();

        if (!$thumb_photo){
            $this->info('Nothing to resize!');
        }else{
            $thumb_photo->status = 'in_progress';
            $thumb_photo->save();

            $parent_photo = $thumb_photo->photo;

            if (!\File::copy($parent_photo->src, $thumb_photo->src)) {
                $thumb_photo->status = 'error';
                $thumb_photo->comment = 'can not create thumb';
                $thumb_photo->save();
            }

            Image::make($thumb_photo->src)
                ->resize((int)(substr(basename($thumb_photo->src), 0, 3)),
                                (int)(substr(basename($thumb_photo->src), 0, 3)))
                ->save($thumb_photo->src);

            $thumb_photo->status = 'complete';
            $thumb_photo->save();
        }

        $this->info('The happy birthday messages were sent successfully!');
    }
}
