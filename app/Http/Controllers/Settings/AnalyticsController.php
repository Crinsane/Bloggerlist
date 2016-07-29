<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\ViewErrorBag;
use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;

class AnalyticsController extends Controller
{
    /**
     * Update the user's analytics data.
     *
     * @param \Illuminate\Http\Request    $request
     * @param \Spatie\Analytics\Analytics $analytics
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Analytics $analytics)
    {
        if ($request->analytics_id != '') {
            try {
                $analytics->setViewId($request->analytics_id)->fetchTopBrowsers(Period::days(2));
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()], 422);
            }
        }

        $request->user()->socialMedia->update([
            'analytics_id' => $request->analytics_id ?: null
        ]);
    }
}
