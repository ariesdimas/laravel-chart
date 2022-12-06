<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userlog;

class UserlogController extends Controller
{
    public function show()
   {
    $userlog=Userlog::all();
    $arrlog=[];
    $labels=[];
    $users=[];
    for($i=0;$i<count($userlog);$i++){
        $logout="";
        $login="";
        $logintime="";
        $logindate="";
        if($userlog[$i]->status=="login"){
            $login=$userlog[$i]->createdAt->toDateTime()->format("Ymd h:i:s");
            $logindate=$userlog[$i]->createdAt->toDateTime()->format("d M Y");
            $labels[]=$logindate;
            $users[]=$userlog[$i]->email;

            for($j=$i;$j<count($userlog);$j++){

                if($userlog[$j]->status=="logout" && $userlog[$j]->email=$userlog[$i]->email){

                    $logout= $userlog[$j]->createdAt->toDateTime()->format("Ymd h:i:s");
                    $datediff= date_diff(date_create($login), date_create($logout));
                    $logintime=$datediff->i;

                    break;
                }
            }



        $arrlog[]=[
            'email'=>$userlog[$i]->email,

            'logintime'=>$logintime,
            'logindate'=>$logindate
        ];
        }
    }

     $labels=array_values(array_unique($labels));
     $users=array_values(array_unique($users));
     $totaltimedata=[];
      //Get users total time base on date
     for($i=0;$i<count($users);$i++){

        for($j=0;$j<count($labels);$j++){
            $totaltime=0;
            for($k=0;$k<count($arrlog);$k++){
                if($arrlog[$k]['email']==$users[$i] && $arrlog[$k]['logindate']==$labels[$j]){
                    $totaltime=$totaltime+$arrlog[$k]['logintime'];
                }
            }
            $totaltimedata[]=[
                'email'=>$users[$i],
                'total'=>$totaltime
            ];


        }



     }



        return view('userlog', compact('totaltimedata','labels','users') );
   }
}
