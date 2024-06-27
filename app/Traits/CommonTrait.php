<?php
namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


trait CommonTrait{
    
   
    // Helper function to upload and sanitize a file
    // private function uploadAndSanitizeFile($number, $path, $file)
    // {
    //     $fileName = time() . '_' . Str::slug($file->getClientOriginalName());
    //     $file->storeAs($path, $fileName, 'public');
    //     Log::info('File uploaded: ' . $fileName . ' to path: ' . $path);
    //     return $fileName;
    // }

    // Helper function to sanitize input
    // private function sanitizeInput($data)
    // {
    //     return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    // }
        // Helper function to upload and sanitize a file
    public function uploadAndSanitizeFile($numberData,$path,$file) {
        
        // dd($filename);
         // Generate a unique file name
        //  $fileName = time() . '_'.$numberData.'_' . Str::slug($file->getClientOriginalName());       
       
         $fileName = time() . '_'.$numberData.'_' .trim(str_replace(" ","_",$file->getClientOriginalName())) ;        

         // Store the file in the storage/app/uploads directory
         //  3rd parameter is local or public
         $storage_path = $file->storeAs($path, $fileName, 'local');
         Log::info('File uploaded: ' . $fileName . ' to path: ' . $path);
        //  dd($storage_path);
        return $storage_path;
    }
    // Helper function to sanitize input
    function sanitizeInput($data) {  
        $data = trim($data);  
        $data = stripslashes($data);  
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');  
        return $data;  
      } 

      function dataTamper($value,$base64EncodedValue){
         if($value === base64_decode($base64EncodedValue)){
            return 1;        
        }
        return 0;
        
      }
      function dataTamperDes($value,$matchValue){

        // echo'compare='. stripos($value,$matchValue);die;    
        $stripos = stripos($value,$matchValue);
        if($stripos ==0 && $stripos !=''){
           return 1;        
       }
       return 0;
       
     }
}
