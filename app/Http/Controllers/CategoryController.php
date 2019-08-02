<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Category;

class CategoryController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->is_admin)
            return view('expense_management.categories.index');
        else
            return redirect('/not-allowed');
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
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255|unique:categories',
        ]);

        if($validator->fails() )
        {
            $result['errors'] = $validator->errors()->all();
            $result['result'] = false; 
        }
        else
        {
            $save = Category::create($data);
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
        $category = Category::findOrFail($id);
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $module = Category::findOrFail($id);
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255|unique:categories,name,'.$id,
        ]);

        if($validator->fails() )
        {
            $result['errors'] = $validator->errors()->all();
            $result['result'] = false; 
        }
        else
        {
            $update = $module->update($data);
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
        $category = Category::findOrFail($id);
        $result = '';
       
        $update = $category->update([
            'status' => 0
        ]);
        if ($update == true)
            $result = "Expense Category set as inactive";
        else 
            $result = "An error occured. Please try again.";
        return $result;
    }

    // Fetch data for table
    public function getCategories() 
    {
        $data = [
            'categories' => Category::paginate(10),
        ];
        return $data;
    }
}
