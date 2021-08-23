<?php

namespace App\Http\Controllers\MainMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Add
use Illuminate\Support\Facades\Log;
use App\Menu\Visitor;
use Carbon\Carbon;

class VisitorController extends Controller
{

    /**
     * saveVisitor
     */
    public function saveVisitor(Request $request)
    {
        return $request->all();

        $this -> validate($request, [
            'IPv4' => 'required',
        ]);

         //Check
         $IPv4_address = $request->input('IPv4');
        //  return $IPv4_address;
        $today = Carbon::today()->format('Y-m-d');
        // return $today;
        $visitor_exists = Visitor::where('IPv4_address', $IPv4_address)->where('date_created', $today)->get();
        // return $visitor_exists->count();

         if($visitor_exists->count()!=1){
            $visitor = new Visitor;
            $visitor->country_code = $request->input('country_code');
            $visitor->country_name = $request->input('country_name');
            $visitor->state = $request->input('state');
            $visitor->city = $request->input('city');
            $visitor->postal = $request->input('postal');
            $visitor->latitude = $request->input('latitude');
            $visitor->longitude = $request->input('longitude');
            $visitor->IPv4_address = $IPv4_address;
            $visitor->visits = 1;
            $visitor->date_created = $today;
            // return $visitor;
            $visitor->save();
            // return 'Visit saved successfully!';
        }

    }


}
