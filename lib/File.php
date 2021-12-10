<?php

namespace Lib;

use SplFileInfo;
use Symfony\Component\HttpFoundation\File\File as FileObject;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager; 
use Intervention\Image\ImageManagerStatic as Image; 
use Illuminate\Support\Str;

class File {
    protected static $filename = NULL;
    protected $manager;
    public function __construct() {
        $this->manager = new ImageManager(array('driver' => 'imagick'));
    }

    public static function getFileName() {
        return self::$filename;
    }

    public static function setFileName($filename) {
        self::$filename = $filename;
    }

    /**
     * Store file on local disk.
     *
     * @param FileObject $file
     * @param string $path
     * @param string $prefix
     * @param string $sufix
     * @param int $minLength
     * @param int $maxLength
     * @return string
     */
    public static function storeLocalFile(FileObject $file, $path, $prefix = '', $sufix = '', $minLength = 10, $maxLength = 100) {
        if( self::getFileName()){
            $filename = self::getFileName().".".File::getFileExtension($file);
        }else{
            $filename = File::generateLocalFilename($path, File::getFileExtension($file), $prefix, $sufix, $minLength, $maxLength);
        }         
        self::setFileName($filename);
        $filepath = File::createLocalDirectory("$path");

        return $file->move($filepath, $filename);
    }  
   
    public static function storeAvatar(FileObject $file, $path, $filename = null, $w = 350, $h = 225)
    {   
        $path = File::createLocalDirectory($path); 
        if (!$filename) {
            $filename = File::generateLocalFilename($path, File::getFileExtension($file));
        } else {
            $filename = $filename . "." . File::getFileExtension($file);
        }  
        $file_path = $path.$filename;
        $image_resize = Image::make($file->getRealPath());
        
        $image_resize->resize($w, $h, function ($constraint) {
            $constraint->aspectRatio();
        });  
        $image_resize->save($file_path);  
         
        return $filename;
    }
  
     

    /**
     * Generate random unique filename on local disk.
     *
     * @param string $path
     * @param string $extension
     * @param string $prefix
     * @param string $sufix
     * @param int $minLength
     * @param int $maxLength
     * @return string
     */
    public static function generateLocalFilename($path, $extension, $prefix = '', $sufix = '', $minLength = 10, $maxLength = 100) {
        $random = Str::random(mt_rand($minLength, $maxLength));
        $filename = "{$prefix}{$random}{$sufix}.{$extension}";

        if (is_file("{$path}/{$filename}")) {
            return File::generateLocalFilename($path, $extension, $prefix, $sufix, $minLength, $maxLength);
        }

        return $filename;
    }

    /**
     * Get local path from a file.
     *
     * @param string $filepath
     * @return string
     */
    public static function getLocalPath($filepath) {
        if ($filepath instanceOf FileObject) {
            $filepath = $filepath->getRealPath();
        }

        if (is_string($filepath)) {
            return substr($filepath, strlen(public_path()));
        }
    }

    /**
     * Get file content.
     *
     * @param mixed $file
     * @return resource
     */
    protected function getFileContent($file) {
        if ($file instanceOf SplFileInfo) {
            return file_get_contents($file);
        }
    }

    /**
     * Get file extension.
     *
     * @param mixed $file
     * @return string
     */
    protected static function getFileExtension($file) {
        if (is_string($file)) {
            return substr($file, strrpos($file, '.') + 1);
        }

        if ($file instanceOf UploadedFile) {
            return $file->getClientOriginalExtension();
        }

        if ($file instanceOf FileObject) {
            return $file->getExtension();
        }
    }

    /**
     * Create directory on local storage.
     *
     * @param string $path
     * @return string
     */
    public static function createLocalDirectory($path) {
        if (!is_dir($path)) {
            @mkdir($path, 0777, true);
        }

        if (!is_writable($path)) {
            @chmod($path, 0777);
        }
        //File::fsmodifyr($path);
        return $path;
    }
     
    
    /**
     * Create and store medium image.
     *
     * @param FileObject $file
     * @param string $path
     * @param FileStorage $fileStorage
     * @return string
     */
    protected static function createMediumImage($file, $filename = null, $w = 350, $h = 225)
    {   
        $path = File::createLocalDirectory(base_path('public/thumb/')); 
        if (!$filename) {
            $filename = time().".".File::getFileExtension($file);
        } else {
            $filename = $filename . "." . File::getFileExtension($file);
        }  
        $file_path = $path.$filename;
        $image_resize = Image::make($file->getRealPath());
        
        $image_resize->resize($w, $h, function ($constraint) {
            $constraint->aspectRatio();
        });  
        $image_resize->save($file_path);  
         
        return $filename;
    }
    
    /**
     * Create and store small image.
     *
     * @param FileObject $file
     * @param string $path
     * @param FileStorage $fileStorage
     * @return string
     */
    protected static function createSmallImage($file, $filename = null, $w = 140, $h = 80)
    {   $path = File::createLocalDirectory(base_path('public/thumb/')); 
        if (!$filename) {
            $filename = time().".".File::getFileExtension($file);
        } else {
            $filename = $filename . "." . File::getFileExtension($file);
        }  
        $file_path = $path.$filename;
        $image_resize = Image::make($file->getRealPath());
        
        $image_resize->resize($w, $h, function ($constraint) {
            $constraint->aspectRatio();
        });  
        $image_resize->save($file_path);  
         
        return $filename;
    }
    
    
    public static function fsmodify($obj) { 
       $chunks = explode('/', $obj);
       chmod($obj, is_dir($obj) ? 0777 : 0644);
       chown($obj, $chunks[2]);
       chgrp($obj, $chunks[2]);
    }


    public static function fsmodifyr($dir) 
    {
       if($objs = glob($dir."/*")) {        
           foreach($objs as $obj) {
               File::fsmodify($obj);
               if(is_dir($obj)) File::fsmodifyr($obj);
           }
       }

       return File::fsmodify($dir);
    }   
    
    public static function saveImage($file, $path){
        $image  = [
            'high'=> File::storeLocalFile($file, $path),
            'medium'=> File::createMediumImage($file, $path),
            'small'=> File::createSmallImage($file, $path),
        ]; 
        return $image;
    }
    
    /**
     * Generate random and unique file name.
     *
     * @param string $path
     * @param string $extension
     * @param string $prefix
     * @param string $sufix
     * @param integer $minLength
     * @param integer $maxLength
     * @param mixed $success
     * @param mixed $fail
     * @return mixed
     * @throws Exception
     */
    public static function generatedRandomFilename($path, $extension, $prefix = '', $sufix = '', $minLength = 5, $maxLength = 10, $success = null, $fail = null)
    {
        try
        {
            if (! is_dir($path)) {
                throw new \Exception('Directory not exist !');
            }
            
            $random = Str::random(mt_rand($minLength, $maxLength));
            $randomFilename = "{$prefix}{$random}{$sufix}.{$extension}";
            
            if (! is_file("{$path}{$randomFilename}")) {
                
                if (is_callable($success)) {
                    return $success($randomFilename);
                }
                
                return $randomFilename;
            }
            
            return self::randomFilename($path, $extension, $prefix, $sufix, $minLength, $maxLength, $success);
            
        } catch(\Exception $e) {
            
            if (is_callable($fail)) {
                return $fail($e);
            }
            
            if (false === $fail) {
                return $e;
            }
            
            throw $e;
        }
    }

    public static function generateImageFromUrl($url, $path,$image_name){
        try {   
            $ch = curl_init($url);
            $path = self::createLocalDirectory($path);
            $fp = fopen($path.'/'.$image_name, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
        
    } 
}
