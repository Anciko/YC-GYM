<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PersonalMealInfo;
use App\Models\PersonalWorkOutInfo;
use App\Models\User;
use App\Models\WaterTracked;
use App\Models\WeightHistory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    public function customerProfile()
    {
        $auth_user = auth()->user();

        $user = User::findOrFail($auth_user->id);

        return response()->json([
            'message' => 'success',
            'user' => $user
        ]);
    }

    public function customerProfileUpdate(Request $request)
    {
        $auth_user = auth()->user();
        $current_date = Carbon::now('Asia/Yangon')->toDateString();

        $user = User::find($auth_user->id);
        $user->update($request->all());

        $weight_history = new WeightHistory();
        $weight_history->user_id = $auth_user->id;
        $weight_history->weight = $request->weight;
        $weight_history->date = $current_date;

        $weight_history->save();

        return response()->json([
            'message' => 'success',
            'user' => $user
        ]);
    }

    // water track
    public function customerWaterTrackForToday()
    {
        $auth_user = auth()->user();
        $current_date = Carbon::now('Asia/Yangon')->toDateString();
        $water = WaterTracked::where('user_id', $auth_user->id)->where('date', $current_date)->first();
        return response()->json([
            'water' => $water
        ]);
    }

    public function customerWaterTrackForLast7Days()
    {
        $auth_user = auth()->user();
        $water_levels = [];
        for ($i = 1; $i < 8; $i++) {
            $current_date = Carbon::now('Asia/Yangon')->subDays($i)->toDateString();
            $water = WaterTracked::where('user_id', $auth_user->id)->where('date', $current_date)->first();
            if ($water != null) {
                array_push($water_levels, $water);
            }
        }
        return response()->json($water_levels);
    }

    public function customerRequestWaterLevel($date)
    {
        $auth_user = auth()->user();
        $water = WaterTracked::where('user_id', $auth_user->id)->where('date', $date)->get();

        return response()->json([
            'water' => $water
        ]);
    }


    // meal
    public function customerMealTrackForTodayBreakfast()
    {
        $auth_user = auth()->user();
        $current_date = Carbon::now('Asia/Yangon')->toDateString();
        $data = PersonalMealInfo::where('client_id', $auth_user->id)->where('date', $current_date)->with('meal')
                ->whereHas('meal', function(Builder $query) {
                    $query->where('meal_plan_type', 'Breakfast');
                })
                ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function customerMealTrackForTodayLunch() {
        $auth_user = auth()->user();
        $current_date = Carbon::now('Asia/Yangon')->toDateString();
        $data = PersonalMealInfo::where('client_id', $auth_user->id)->where('date', $current_date)->with('meal')
                ->whereHas('meal', function(Builder $query) {
                    $query->where('meal_plan_type', 'Lunch');
                })
                ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function customerMealTrackForTodaySnack() {
        $auth_user = auth()->user();
        $current_date = Carbon::now('Asia/Yangon')->toDateString();
        $data = PersonalMealInfo::where('client_id', $auth_user->id)->where('date', $current_date)->with('meal')
                ->whereHas('meal', function(Builder $query) {
                    $query->where('meal_plan_type', 'Snack');
                })
                ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function customerMealTrackForTodayDinner() {
        $auth_user = auth()->user();
        $current_date = Carbon::now('Asia/Yangon')->toDateString();
        $data = PersonalMealInfo::where('client_id', $auth_user->id)->where('date', $current_date)->with('meal')
                ->whereHas('meal', function(Builder $query) {
                    $query->where('meal_plan_type', 'Dinner');
                })
                ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function customerMealTrackForLast7DaysBreakfast()
    {
        $user = auth()->user();
        $meals = [];

        for ($i = 1; $i < 8; $i++) {
            $current_date = Carbon::now('Asia/Yangon')->subDays($i)->toDateString();

            $meal = PersonalMealInfo::where('client_id', $user->id)->where('date', $current_date)->with('meal')
                    ->whereHas('meal', function(Builder $query) {
                        $query->where('meal_plan_type', 'Breakfast');
                    })
                    ->get();

            if(!$meal->isEmpty()) {
                array_push($meals, $meal);
            }
        }
        return response()->json([
            'meals' => $meals
        ]);
    }

    public function customerMealTrackForLast7DaysLunch()
    {
        $user = auth()->user();
        $meals = [];

        for ($i = 1; $i < 8; $i++) {
            $current_date = Carbon::now('Asia/Yangon')->subDays($i)->toDateString();

            $meal = PersonalMealInfo::where('client_id', $user->id)->where('date', $current_date)->with('meal')
                    ->whereHas('meal', function(Builder $query) {
                        $query->where('meal_plan_type', 'Lunch');
                    })
                    ->get();

            if(!$meal->isEmpty()) {
                array_push($meals, $meal);
            }
        }
        return response()->json([
            'meals' => $meals
        ]);
    }

    public function customerMealTrackForLast7DaysSnack()
    {
        $user = auth()->user();
        $meals = [];

        for ($i = 1; $i < 8; $i++) {
            $current_date = Carbon::now('Asia/Yangon')->subDays($i)->toDateString();
            $meal = PersonalMealInfo::where('client_id', $user->id)->where('date', $current_date)->with('meal')
                    ->whereHas('meal', function(Builder $query) {
                        $query->where('meal_plan_type', 'Snack');
                    })
                    ->get();

            if(!$meal->isEmpty()) {
                array_push($meals, $meal);
            }
        }
        return response()->json([
            'meals' => $meals
        ]);
    }

    public function customerMealTrackForLast7DaysDinner()
    {
        $user = auth()->user();
        $meals = [];

        for ($i = 1; $i < 8; $i++) {
            $current_date = Carbon::now('Asia/Yangon')->subDays($i)->toDateString();

            $meal = PersonalMealInfo::where('client_id', $user->id)->where('date', $current_date)->with('meal')
                    ->whereHas('meal', function(Builder $query) {
                        $query->where('meal_plan_type', 'Dinner');
                    })
                    ->get();

            if(!$meal->isEmpty()) {
                array_push($meals, $meal);
            }
        }
        return response()->json([
            'meals' => $meals
        ]);
    }


    // workout
    public function customerTodayWorkout() {
        $auth_user = auth()->user();
        $current_date = Carbon::now('Asia/Yangon')->toDateString();
        $workouts = PersonalWorkOutInfo::where('user_id', $auth_user->id )
                    ->where('date', $current_date)->with('workout')
                    ->get();

        return response()->json([
            'workouts' => $workouts
        ]);
    }

    public function customerLast7daysWorkout() {
        $auth_user = auth()->user();
        $workouts = [];

        for ($i = 1; $i < 8; $i++) {
            $current_date = Carbon::now('Asia/Yangon')->subDays($i)->toDateString();

            $workout = PersonalWorkOutInfo::where('user_id', $auth_user->id)->where('date', $current_date)
                        ->with('workout')->get();

            if(!$workout->isEmpty()) {
                array_push($workouts, $workout);
            }
        }
        return response()->json([
            'workouts' => $workouts
        ]);
    }

    public function customerBetweenDaysWrokout($start_date, $end_date) {
       $workouts = PersonalWorkOutInfo::whereDate('date', '>=' ,$start_date)->whereDate('date', '<=', $end_date)
                    ->with('workout')->get();
       return $workouts;
    }

    public function monthlyWeightLossHistory() {
        // return "01" < "9" ? "True" : "fasle";
        $current_year = Carbon::now('Asia/Yangon')->format('Y');
        $auth_user = auth()->user();

        $weight_histories = [];
        for($i = 1; $i < 13; $i++) {
            $weight_history = WeightHistory::where('user_id', $auth_user->id)
                            ->whereMonth('date', $i)->whereYear('date', $current_year)->get();

            if(!$weight_history->isEmpty()) {
                array_push($weight_histories, $weight_history);
            }
        }

        return response()->json([
            'weight_histories' => $weight_histories
        ]);
    }
}
