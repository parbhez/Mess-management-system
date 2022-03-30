<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Member;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    public function addMember()
    {
        return view('backend.member.addMember');
    }

    public function saveMember(Request $request)
    {
        $validated = $request->validate([
            'member_name' => 'required|unique:members|max:255',
            ]);

            try{
                $saveMember = Member::insertGetId([
                    'member_name'        => $request->member_name,
                    'created_at'         => date('Y-m-d'),
                    'created_by'         => 1
                    ]);

                echo $saveMember;
                exit();

                //create a row size
                if($saveMember){
                    if ($request->hasFile('profile_image')) {
                        $pimage = $request->file('profile_image');
                        $fileName = $saveMember. '-' .time() . '.' . $pimage->getClientOriginalExtension();
                        Image::make($pimage)->resize(350, 350)->save(public_path('images/' . $fileName));
                    if($fileName != null){
                            $uploadImage = Member::where('member_id',$saveMember)
                                ->update([
                                    'profile_image' => $fileName,
                                    'updated_by'    => 1,
                                    'updated_at'    => date('Y-m-d'),
                                ]);
                    }
                }
                Session::flash('member_success', 'User Added Successfully !!');
            }else{
                Session::flash('member_error', 'Something Went Wrong');
            }
            }catch(QueryException $e){
                //return $e;
                //Session::flash('error', $e->getMessage());
                Session::flash('member_error', 'Server Error');
            }
            return redirect()->route('add-member');

    }


}
