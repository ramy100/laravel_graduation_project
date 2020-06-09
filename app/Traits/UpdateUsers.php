<?php

namespace App\Traits;

use App\User;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait UpdateUsers
{
    use RedirectsUsers;

    protected function update_validator(array $data,$company)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'
        ,Rule::unique('users', 'email')->ignore($company->id)
        ],
            'phone' => ['sometimes','nullable', 'starts_with:011,012,010','digits:11'],
            'address' => ['sometimes','nullable','string', 'max:255' , 'min:10'],
            'image'=>['sometimes','nullable','image']
        ]);
    }
    
    protected function update_user(array $data,User $user)
    {
        DB::beginTransaction();
        try {
            if(array_key_exists("image",$data))
            $image = $data['image']->store('uploads', 'public');
            else
                $image=$user->image;
            if($user->profile){
                $user->profile->update([
                    'about' => $data['about'],
                    'website' => $data['website'],
                ]);    
            }
            $updated =  $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'image' => $image,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $updated;
        }
        DB::commit();
    }

    protected function updated(Request $request, $is_updated,$user)
    {
        return redirect()->route($user->role.'.show', [$user->id]);
    }
}
