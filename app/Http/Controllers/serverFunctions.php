<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class serverFunctions extends Controller {

    public function payments(Request $request) {

        //if (Request::ajax()) {//only return data to ajax calls
        $principal = 5000; //$request->principal;
        $interest_rate = 0.05; //request->interest_rate;
        $term_value = 60; //$request->term_value;
        $term_type = 1; // $request->term_type;
        $payments_number = 5; //$request->payments_number;
        $initial_date = date('2016-01-01');

        $schedule = $this->getSchedule($principal, //$request->principal;
                $interest_rate, //request->interest_rate;
                $term_value, //$request->term_value;
                $term_type, // $request->term_type;
                $payments_number, //$request->payments_number;
                $initial_date);

        return response()->json($schedule);
        /* } else {
          return Response::make("Unable to comply request", 404);
          } */
    }

    private function getSchedule($principal, //$request->principal;
            $interest_rate, //request->interest_rate;
            $term_value, //$request->term_value;
            $term_type, // $request->term_type;
            $payments_number, //$request->payments_number;
            $initial_date) {

        switch ($term_type) {

            case 1:   //term_value is days
                $end_date = date('Y-m-d', strtotime($initial_date . '+ ' . $term_value . ' days'));
                break;
            case 2: //term_value is weeks
                $end_date = date('Y-m-d', strtotime($initial_date . '+ ' . $term_value . ' weeks'));
                break;
            case 3:
                $end_date = date('Y-m-d', strtotime($initial_date . '+ ' . $term_value . ' months'));
                break;
            case 4:
                $end_date = date('Y-m-d', strtotime($initial_date . '+ ' . $term_value . ' years'));
                break;
            default: // error?
        }

        $initial_date = new \DateTime($initial_date);
        $end_date = new \DateTime($end_date);
        $schedule = array();

        $principal_remaining = $principal;

        $delta_date = date_diff($end_date, $initial_date);

        $time_lapse = round($delta_date->days / $payments_number,0);

        //get an initial aproximation of periodic payment

        $interest_rate_period = $interest_rate / 360 * $delta_date->days;

        $payment = round($interest_rate_period * $principal / (1 - (1 + $interest_rate_period) ** -$payments_number), 2);

        $nCount = 0;

        for ($nCount = 0; $nCount < $payments_number - 1; $nCount++) {

            $interest_to_date = round($principal_remaining * $interest_rate_period, 2);

            $principal_remaining = round($principal_remaining - ($payment - $interest_to_date), 2);

            //add row to schedule
            $schedule[] = array(
                'count' => $nCount + 1,
                'date' => date('Y-m-d', strtotime($initial_date->format('Y-m-d') . '+ ' . $delta_date->days * $nCount . ' days')),
                'payment' => $payment,
                'principal'=>$payment - $interest_to_date,
                'interest' => $interest_to_date
            );
        }

        $interest_to_date = round($principal_remaining * $interest_rate_period, 2);

        $last_payment = $principal_remaining + $interest_to_date;

        $schedule[] = array(
            'count' => $nCount + 1,
            'date' => date('Y-m-d', strtotime($initial_date->format('Y-m-d') . '+ ' . $delta_date->days * $nCount . ' days')),
            'payment' => $last_payment,
            'principal'=>$last_payment - $interest_to_date,
            'interest' => $interest_to_date
        );

        return $schedule;
    }

}
