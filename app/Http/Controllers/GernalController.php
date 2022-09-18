<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;

class GernalController extends Controller
{
    public function searchMember(Request $request)
    {
        if($request->search_type_mem_no == 1){
            $member = Member::where('mem_no',$request->search_mem)->first();
            return response()->json(['status' => 1, 'member' => $member]);
        }
        elseif($request->search_type_cnic_no == 2){
            $member = Member::where('cnic_no',$request->search_mem)->first();
            return response()->json(['status' => 1,'member' => $member]);
        }
    }

    public function getMember(Request $request, $id)
    {
        $member = Member::find($id);

        return view('pages.member',compact('member'));
    }
}
