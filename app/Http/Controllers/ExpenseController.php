<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon;
use App\Http\Requests;
use App\ExpenseMaster;
use App\Category;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->AuthUser = Auth()->user();
    }

    public function index(Request $request)
    {   
 
        if(isset($request->type) && $request->type == 'json')
        {
            $expenses = ExpenseMaster::join('category_master', 'category_master.id', '=', 'expenses_master.category_id')
                                       ->where('user_id', $this->AuthUser->id)
                                       ->select('expenses_master.*', DB::raw('category_master.name AS cat_name'))->get();

            return response()->json([ 'data' => $expenses]);
        }

        return view('admin.expenses.index');
    }

    public function create(Request $request)
    {

        $categories = Category::get();
        return view('admin.expenses.create',compact('categories'));
    }

    public function edit(Request $request)
    {

        $expense = ExpenseMaster::find($request->id);
        $categories = Category::get();
        

        return view('admin.expenses.edit',compact('expense','categories'));
    }

    public function update(Request $request)
    {
        $expense = ExpenseMaster::find($request->id);
        $expense->category_id = $request->expense_category;
        $expense->description = $request->description;
        $expense->comment = $request->comment;
        $expense->amount = $request->amount;
        $expense->generated_at = Carbon\Carbon::parse($request->expense_date)->format('Y-m-d H:i');
        $expense->save();
        
        return response()->json(true);
        //return redirect('/admin/categoery/get-category');
    }

    public function store(Request $request)
    {

        $category = ExpenseMaster::create([
            'user_id' => $this->AuthUser->id,
            'category_id' => $request->expense_category,
            'description' => $request->description,
            'comment' => $request->comment,
            'amount' => $request->amount,
            'generated_at' => Carbon\Carbon::parse($request->expense_date)->format('Y-m-d H:i')

        ]);
        
        return response()->json(true);
        //return redirect('/admin/categoery/get-category');
    }

    public function delete(Request $request)
    {
        $category = ExpenseMaster::find($request->id)->delete();
        return redirect('/admin/expenses/get-expense');
    }
}
