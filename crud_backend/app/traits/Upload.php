<?php

namespace App\traits;

trait Upload
{
    public function upload($file, $dir, $old)
    {
        if (!empty($old)) {

            if (file_exists(storage_path('app/public/'. $old))) {
                unlink(storage_path('app/public/'. $old));
            }
        }
        if (!file_exists(storage_path('app/public/' . $dir))) {

            mkdir(storage_path('app/public/' . $dir), 0777);
        }

        $file_name = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs($dir, $file_name, 'public');
    }// end of upload function
}
