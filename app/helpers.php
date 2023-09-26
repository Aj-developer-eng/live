<?php
function customFunction($inputString) {
    $fileName = basename($inputString);

        $folderPath = public_path('images');
        $files = glob($folderPath . '/' . $fileName);
// dd($files);
        if ($files !== false && $files != null) {
            foreach ($files as $filePath) {
                return [
'status'=>"exist",
'statusCode'=>1
                ];
            }
        } else {
            return [
                'status'=>"No files found in the folder.",
                'statusCode'=>0
                                ];

        }

}
