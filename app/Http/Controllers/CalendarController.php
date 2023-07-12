<?php

namespace App\Http\Controllers;

use App\Jobs\EndBookingJob;
use App\Jobs\StartBookingJob;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function create(){
        $events = array();
        $bookings = Booking::all();
        foreach ($bookings as $booking){
            if ($booking->user_id === Auth::user()->id) {

                $events[] = [
                    'id'   => $booking->id,
                    'title' => $booking->title,
                    'start' => $booking->start_date,
                    'end' => $booking->end_date,
                    'color' => $booking->color,
//                'textColor' => 'red'
                ];
            }
        }

        return view('calendar', ['events' => $events]);
    }

    public function store(Request $request) {
//        $request->validate([
//            'title' => ['required', 'string']
//        ]);
//        $booking = Booking::create([
//            'title' => $request->title,
//            'start_date' => $request->start_date,
//            'end_date' => $request->end_date,
//            'user_id' => Auth::user()->id,
//        ]);
//        $user = Auth::user();
//        dispatch(new StartBookingJob($user->email, $user->name, $request->title, $request->start_date, $request->end_date));
//
//        $color = null;
//        if ($booking->title == 'Test'){
//            $color = '#924ACE';
//        }
//
//        return response()->json([
//            'id' => $booking->id,
//            'title' => $booking->title,
//            'start' => $booking->start_date,
//            'end' => $booking->end_date,
//        ]);
        $request->validate([
            'title' => ['required'],
            'color' => ['required'],
            'start_date' => ['required']
        ]);
        $booking = Booking::create([
            'title' => $request->title,
            'color' => $request->color,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => Auth::user()->id,
        ]);
        $user = Auth::user();
        dispatch(new StartBookingJob($user->email, $user->name, $request->title, $request->color, $request->start_date, $request->end_date));
        dispatch(new EndBookingJob($user->email, $user->name, $request->title, $request->color, $request->start_date, $request->end_date));
        return redirect()->route('calendar.index');
    }
    public function update(Request $request ,$id){
        $booking = Booking::find($id);
        if (!$booking){
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }


        $start_datetime = $request->start_date;
        if ($request->end_date != 'Invalid date')
        {
            $end_datetime = $request->end_date;
            if ($start_datetime > $end_datetime)
            {
                return response()->json([
                    'error' => 'Не можливо щоб кінцева дата була раніше стартової!'
                ], 404);
            }
        }
        else
        {
            $end_datetime = null;
        }


        $booking->update([
            'start_date' => $start_datetime,
            'end_date' => $end_datetime
        ]);
        return response()->json('Event update');
    }
    public function destroy($id){
        $booking = Booking::find($id);
        if (!$booking){
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->delete();
        return $id;
    }
}
