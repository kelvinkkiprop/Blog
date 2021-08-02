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
        // Log::info('saveVisitor endpoint hit');
        // Log::info($request->all());

         //Check
         $IPv4_address = $request->input('IPv4');
        //  return $IPv4_address;

        // return $today;
         $visitor_exists = Visitor::where('IPv4_address', $IPv4_address)->first();
        // return $visitor_exists;
         if($visitor_exists){
             //New visit
            $saved_date =  Carbon::parse($visitor_exists->created_at)->format('d/m/Y');
            $today = Carbon::parse(Carbon::today())->format('d/m/Y');
            // return $today.' '.$saved_date;
            //Date visited
            if($saved_date!=$today){
                $visitor = new Visitor;
                $visitor->country_code = $request->input('country_code');
                $visitor->country_name = $request->input('country_name');
                $visitor->state = $request->input('state');
                $visitor->city = $request->input('city');
                $visitor->postal = $request->input('postal');
                $visitor->latitude = $request->input('latitude');
                $visitor->longitude = $request->input('longitude');
                $visitor->IPv4_address = $IPv4_address;
                $visitor->visits = $visitor->visits+1;
                $visitor->save();
                return 'Visit saved successfully!';
            }
         }else{
            $visitor = new Visitor;
            $visitor->country_code = $request->input('country_code');
            $visitor->country_name = $request->input('country_name');
            $visitor->state = $request->input('state');
            $visitor->city = $request->input('city');
            $visitor->postal = $request->input('postal');
            $visitor->latitude = $request->input('latitude');
            $visitor->longitude = $request->input('longitude');
            $visitor->IPv4_address = $IPv4_address;
            $visitor->visits = $visitor->visits+1;
            $visitor->save();
            return 'Visit saved successfully!';

        }

    }


}
