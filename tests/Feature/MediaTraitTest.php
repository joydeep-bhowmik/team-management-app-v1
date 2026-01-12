<?php

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JoydeepBhowmik\LaravelMediaLibary\Models\Media;


class MediaTraitTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Setting up the fake storage for public disk
        Storage::fake('public');
    }

    public function testShouldAddMediaToCollection()
    {
        $user = User::factory()->create(); // Assuming you have a User factory

        // Simulate file upload
        $file = UploadedFile::fake()->image('test.jpg');

        // Add media to the user's collection
        $user->addMedia($file)->toCollection('images');

        // Check if the media is stored
        $media = Media::first();


        dd($user->addMedia($file)->toCollection('images'));

        $this->assertNotNull($media);
        $this->assertEquals($file->getClientOriginalName(), $media->file_name);
        $this->assertEquals('images', $media->collection_name); // Use collection_name instead of collection

        // Use Storage::fake and check for existence in fake public storage
        $filePath = 'uploads/images/' . $media->file_name; // Check if the file exists in the expected path
        $this->assertTrue(Storage::disk('public')->exists($filePath));
    }
}
