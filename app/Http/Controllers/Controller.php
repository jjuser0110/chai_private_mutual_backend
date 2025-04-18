<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    public function getReferral()
    {
        $length = 8;
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $random = '';

        for ($i = 0; $i < $length; $i++) {
            $random .= $characters[rand(0, strlen($characters) - 1)];
        }

        // Check if referral code already exists
        $user = User::where('invitation_code', $random)->first();

        if ($user) {
            return $this->getReferral(); // Recursive call with $this-> if inside a class
        } else {
            return $random;
        }
    }
    
    public function upload($file, $module, $moduleId){
	    if (!empty($file)) {
            $filenameWithExt = $file->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $file->getClientOriginalExtension();

            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            $latest_filename = $moduleId."/".$fileNameToStore;

            $path = $file->storeAs($module,$latest_filename,'public');

            return [
                'file_name' => $fileNameToStore,
                'file_path' => $path,
                'file_type' => $extension
            ];
	    }
    }
}
