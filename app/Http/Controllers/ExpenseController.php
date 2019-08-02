<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Category;
use App\Expense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expense_management.expenses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $user = auth()->user();
        $category = Category::findOrFail($data['category_id']);
        $validator = Validator::make($data, [
            'category_id' => 'required|integer',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);
         if($validator->fails() )
        {
            $result['errors'] = $validator->errors()->all();
            $result['result'] = false;
        }
        else
        {
            $save = Expense::create($data);
            $user->expenses()->save($save);
            $category->expenses()->save($save);
            $result['data'] = $save;
            $result['result'] = true;
        }
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::first($id);
        return $expense;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        $user = auth()->user();
        $category = Category::findOrFail($data['category_id']);
        $module = Expense::findOrFail($id);
        $validator = Validator::make($data, [
            'category_id' => 'required|integer',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'entry_date' => 'required|date',
        ]);

        if($validator->fails() )
        {
            $result['errors'] = $validator->errors()->all();
            $result['result'] = false;
        }
        else
        {
            $update = $module->update($data);
            $user->expenses()->save($module);
            $category->expenses()->save($module);
            $result['data'] = $update;
            $result['result'] = true;
        }
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $result ='';
        $update = $expense->update([
            'status' => 0,
        ]);
        ($update == true) ? $result = "Expense has been removed!" : $result = "An error occured. Please try again.";
        return $result;
    }

    public function getExpenses()
    {
        $data = [
            'expenses' => auth()->user()->expenses()->where('status', 1)->paginate(10),
            'categories' =>  Category::where('status', 1)->get(),
        ];
        return $data;
    }
}
