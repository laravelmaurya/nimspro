<?php
namespace App\Traits;

use DateTime;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


trait CommonTrait{
    function unique_code($limit)
    {
      return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

 
       // Helper function to upload and sanitize a file
    public function uploadAndSanitizeFile($i = null,$numberData,$path,$file,$oldFilePath = null) {
         // Check if an old file exists and delete it
        //  dd($file);
        if($oldFilePath != null){
          $oldFilePath = str_replace("public","",$oldFilePath);
          $filePath = public_path('storage/' . $oldFilePath);
          // Check if the file exists
          if (file_exists($filePath)) {
              unlink($filePath);
              Log::info('File deleted: ' . $filePath);            
          } 
        }

          $fileName = time() . '_'.$this->unique_code(9).'_'.$i.'_'.$numberData.'_' .trim(str_replace(" ","_",$file->getClientOriginalName())) ;   
   
         //  $fileName = time() . '_'.$numberData.'_' . Str::slug($file->getClientOriginalName());  
         // Store the file in the storage/app/uploads directory and 3rd parameter is local or public
         $storage_path = $file->storeAs($path, $fileName, 'local');
         Log::info('File uploaded: ' . $fileName . ' to path: ' . $path);       
         return $storage_path;
    }

    
    // Helper function to sanitize input
    function sanitizeInput($data) {  
        $data = trim($data);  
        $data = stripslashes($data);  
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');  
        return $data;  
      } 
    function unsanitizeInput($data) {  
        $data = trim($data);  
        $data = stripslashes($data);  
        $data =  htmlspecialchars_decode($data, ENT_QUOTES);  
        return $data;  
      } 

      function dataTamper($value,$base64EncodedValue){
        // echo $value.'<br>'.$base64EncodedValue.'<br>'.trim(base64_decode($base64EncodedValue));die;
         if($value === trim(base64_decode($base64EncodedValue))){
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

     public function convertTime($originalDate)
    {
        // $originalDate = '2050-04-30 06:00';
        $date = Carbon::createFromFormat('Y-m-d H:i', $originalDate);
        $date->addHours(12);
        $formattedDate = $date->format('Y-m-d H:i');
        return $formattedDate;
    }

    public function convertDateTimeSec($originalDate){
      $formattedDate = date('Y-m-d h:i:s', strtotime(str_replace('/', '-',$originalDate)));        
      return $formattedDate;
    }

    public function convertDateTimeFormateYmd($originalDate){
      return date('Y-m-d', strtotime(str_replace('/', '-', $originalDate)));   
    }

    public function convertDateTimeFormateYmd_hi($originalDate){      
      return date('Y-m-d H:i', strtotime(str_replace('/', '-',$originalDate)));   
      }

    public function convertDateTimeFormateYmd_hisA($originalDate=null){
      return date('Y-m-d h:i:s A', strtotime(str_replace('/', '-', date('d/m/Y h:i:s A'))));   
    }

    function unslug($slug)
    {
    // Replace hyphens with spaces
    $string = str_replace('-', ' ', $slug);
    // Optionally, capitalize the first letter of each word
    $string = ucwords($string);
    return $string;
   }
}
