<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;

class AnalyticsController extends Controller
{
    /**
     * Return the visitors and pageview of the last week for the current user.
     *
     * @param \Spatie\Analytics\Analytics $analytics
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Analytics $analytics)
    {
        $data = $analytics->setViewId(
            auth()->user()->socialMedia->analytics_id
        )->fetchVisitorsAndPageViews($period = Period::days(7));

        $formatted = $data->groupBy(function ($item) {
            return $item['date']->format('Y-m-d');
        })->map(function ($date, $key) {
            return [
                'date' => $key,
                'visitors' => $date->sum('visitors'),
                'pageViews' => $date->sum('pageViews'),
            ];
        });

        $results = [];

        while ($period->startDate->lt($period->endDate)) {
            $date = $period->startDate->format('Y-m-d');

            if (isset($formatted[$date])) {
                $results[] = $formatted[$date];
            } else {
                $results[] = [
                    'date' => $date,
                    'visitors' => 0,
                    'pageViews' => 0,
                ];
            }

            $period->startDate->addDay();
        }

        return response()->json($results);
    }
}
