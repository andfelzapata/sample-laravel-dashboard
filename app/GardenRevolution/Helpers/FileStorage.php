<?php namespace App\GardenRevolution\Helpers;

use File;

use Storage;

class FileStorage {

    /*
     * Moves file from source to target
     * @param $src Full path to source destination
     * @param $target sub path to target destination
     * @return bool 
     */
    public static function move(string $src, string $target)
    {
        if( is_null($src) || is_null($target) )
        {
            return false;
        }       

        if( Storage::getDefaultDriver() === 'local' )
        {
            //Use File facade since Storage facade points to app/storage by default

            $target = sprintf('%s/%s',public_path(),$target);
            
            if( ! File::exists($src) )
            {
                return false;
            }

            return File::move($src,$target);  
        }

        else 
        {
            if( ! Storage::has($src) )
            {
                return false;
            } 

            return Storage::move($src,$target);
        }
    }

    /*
     * Delete file from source 
     * @param $src Source destination to delete
     * @return bool
     */
    public static function delete(string $src)
    {
        if( is_null($src) )
        {
            return false;
        }

        else
        {
            if( Storage::getDefaultDriver() === 'local' )
            {
                //Use File facade since Storage facade points to app/storage by default
    
                $src = sprintf('%s/%s',public_path(),$src);

                if( ! File::exists($src) )
                {
                    return false;
                }

                return File::delete($src);  
            }

            else 
            {
                if( ! Storage::has($src) )
                {
                    return false;
                } 

                return Storage::delete($src);
            }
        }
    }
    
}
