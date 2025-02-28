<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\Laravel\Facades\Image;

class GenerateSocialImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social:generate-image 
                            {title : The title text for the image} 
                            {--subtitle= : Optional subtitle for the image} 
                            {--output=public/img/social-share-image.jpg : Output path for the generated image}
                            {--width=1200 : Width of the image} 
                            {--height=630 : Height of the image}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a social media sharing image with text';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // You'll need to install intervention/image package for this to work
        // composer require intervention/image
        
        $title = $this->argument('title');
        $subtitle = $this->option('subtitle');
        $output = $this->option('output');
        $width = $this->option('width');
        $height = $this->option('height');
        
        $this->info('Generating social media image...');
        
        try {
            // Create image with blue background
            $img = Image::canvas($width, $height, '#3A84F3');
            
            // Add a subtle pattern or gradient
            // ... (additional image manipulations)
            
            // Add logo (assuming you have a logo file)
            $logo = public_path('img/logo.png');
            if (file_exists($logo)) {
                $logoImg = Image::make($logo);
                $logoImg->resize(null, 80, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->insert($logoImg, 'top-left', 50, 50);
            }
            
            // Add title
            $img->text($title, $width/2, $height/2 - 30, function($font) {
                $font->file(public_path('fonts/PlusJakartaSans-Bold.ttf'));
                $font->size(60);
                $font->color('#FFFFFF');
                $font->align('center');
                $font->valign('middle');
            });
            
            // Add subtitle if provided
            if ($subtitle) {
                $img->text($subtitle, $width/2, $height/2 + 60, function($font) {
                    $font->file(public_path('fonts/PlusJakartaSans-Regular.ttf'));
                    $font->size(32);
                    $font->color('#FFFFFF');
                    $font->align('center');
                    $font->valign('middle');
                });
            }
            
            // Add URL at the bottom
            $img->text(config('app.url'), $width/2, $height - 40, function($font) {
                $font->file(public_path('fonts/PlusJakartaSans-SemiBold.ttf'));
                $font->size(24);
                $font->color('#FFFFFF');
                $font->align('center');
                $font->valign('bottom');
            });
            
            // Save the image
            $img->save($output);
            
            $this->info("Image generated successfully at: {$output}");
            return 0;
        } catch (\Exception $e) {
            $this->error("Error generating image: {$e->getMessage()}");
            return 1;
        }
    }
}