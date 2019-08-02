<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Expense;

class HomeController extends Controller
{
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index');
    }

    public function getExpensesData($start_date = null, $end_date = null)
    {
        ($start_date == null) ? $start_date = Carbon::now()->startOfMonth()->toDateString() : $start_date;
        ($end_date == null) ? $end_date = Carbon::now()->endOfMonth()->toDateString() : $end_date;

        if ( $start_date > $end_date )
        {
            $data = [
                'result' => false,
                'error_message' => 'Please enter a valid date range.'
            ];
        }
        else
        {
            $user = auth()->user();
            $exp = $user->expenses->where('status', 1)  
                        ->where('entry_date', '>=', $start_date)
                        ->where('entry_date', '<=', $end_date);
            $total_exp = $exp->sum('amount');
            $per_category = $exp->groupBy('category_id');
                      
            $expenses_per_category = [];
            foreach ($per_category as $category) {
                $sum = 0;
                foreach ($category as $key => $value) {
                    $sum = $sum + $value->amount;
                    // $categoryData= $value->category->getAttributes();
                    $categoryData = [$value->category->name];
                }

                $percentage = ($sum / $total_exp) * 100;
                array_push($categoryData, $sum);
                array_push($categoryData, $percentage);
                // $categoryData['amount'] = $sum; //total
                // $categoryData['percentage'] = round($percentage, 2); //total
                array_push($expenses_per_category, $categoryData);
            }
            $data = [
                'total_expenses' => $total_exp,
                'expenses' => $expenses_per_category,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'result' => true
            ];
        }
        return $data;
    }

    public function notAllowed()
    {
        return view('partials.not_allowed');
    }


}
