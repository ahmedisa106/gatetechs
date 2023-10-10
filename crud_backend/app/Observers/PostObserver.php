<?php

namespace App\Observers;

use App\Models\Post;
use App\traits\Upload;

class PostObserver
{
    use Upload;

    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "created" event.
     */
    public function creating(Post $post): void
    {
        if (is_file($post->photo)) {

            $post->photo = $this->upload($post->photo, 'posts', '');
        }
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updating(Post $post): void
    {
        if (is_file($post->photo)) {
            $post->photo = $this->upload($post->photo, 'posts', $post->getOriginal('photo'));
        }
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {

//        if (file_exists(storage_path('app/public/' . $post->photo))) {
//            unlink(storage_path('app/public/' . $post->photo));
//        }
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
