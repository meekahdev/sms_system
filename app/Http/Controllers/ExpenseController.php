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



    public function expensesLimitation(Request $request){


        if(isset($request->type) && $request->type == 'json')
        {
            $expenseslimit = \App\ExpensesLimit::join('category_master', 'category_master.id', '=', 'expenses_limit.category_id')
                                       ->where('user_id', $this->AuthUser->id)
                                       ->select('expenses_limit.*', DB::raw('category_master.name AS cat_name'))->get();

            return response()->json([ 'data' => $expenseslimit]);
        }

        return view('admin.limitation.index');

    }

    public function addLimitation(Request $request){

             $categories = Category::get();
        return view('admin.limitation.create',['categories'=>$categories]);

    }


    public function EditLimitation(Request $request){


             $categories = Category::get();

             $expenses=\App\ExpensesLimit::where('id','=',$request->id)
                                         ->where('user_id','=',$this->AuthUser->id)
                                         ->first();



        return view('admin.limitation.edit',['categories'=>$categories,'expenses'=>$expenses]);

    }


    public function storeLimitation(Request $request){

           if($request->expense_category){

                $limit=\App\ExpensesLimit::where('category_id','=',$request->expense_category)
                                         ->where('user_id','=',$this->AuthUser->id)
                                         ->first();
                if($limit){
                     return response()->json(['status'=>false,'msg'=>' Limitation for the selected category is already added']);
                }else{

                    $expenses_limit=\App\ExpensesLimit::create([
                    'category_id'=>$request->expense_category,
                    'user_id'=>$this->AuthUser->id,
                    'amount'=>$request->amount,
                    'from_date'=>Carbon\Carbon::parse($request->from)->format('Y-m-d H:i'),
                    'to_date'=>Carbon\Carbon::parse($request->to)->format('Y-m-d H:i')
                    ]);

                    if($expenses_limit){
                     return response()->json(['status'=>true,'msg'=>'Expenses Limitation was added successfully']);
                    }
                  return response()->json(['status'=>false,'msg'=>'Oops something went wrong']);

                }

           }


    }

    public function updateLimitation(Request $request,$id){


        if($request->id){

            $expenses_limit=\App\ExpensesLimit::find($request->id);
            $expenses_limit->category_id=$request->expense_category;
            $expenses_limit->user_id=$this->AuthUser->id;
            $expenses_limit->amount=$request->amount;
            $expenses_limit->from_date=Carbon\Carbon::parse($request->from)->format('Y-m-d H:i');
            $expenses_limit->to_date=Carbon\Carbon::parse($request->to)->format('Y-m-d H:i');

            if($expenses_limit){
                return response()->json(['status'=>true,'msg'=>'Expenses Limitation was updated successfully']);
            }

            return response()->json(['status'=>false,'msg'=>'Oops something went wrong']);

        }


       return response()->json(['status'=>false,'msg'=>'Oops something went wrong']);

    }

    public function deleteLimitation(Request $request){
           $expenses=\App\ExpensesLimit::where('id','=',$request->id)
                                         ->where('user_id','=',$this->AuthUser->id)
                                         ->delete();

        return redirect('/admin/expenses/limitation');
    }


    public function ValidateExpenses(Request $request){


        if($request->expense_category){

            $expenses=\App\ExpensesLimit::where('category_id','=',$request->expense_category)
                                        ->where('amount','<',$request->amount)
                                        ->where('user_id','=',$this->AuthUser->id)
                                        ->whereRaw('? between from_date and to_date', [Carbon\Carbon::parse($request->date)->format('Y-m-d H:i')])
                                        ->first();

            if($expenses){
                  return \response()->json(false);

            }

            return \response()->json(true);

        }

    }

    public function Analytics(Request $request){



        if($request->type && $request->type=='ajax'){
             $categories = ExpenseMaster::join('category_master','category_id','=','category_master.id')
                                        ->select(
                                            'category_master.name',
                                            DB::raw("SUM(amount) as value")
                                        )

                                        ->where('expenses_master.user_id','=',$this->AuthUser->id);


                                        if(!empty($request->category) && count($request->category)>0){

                                            $categories->whereIn('category_master.id',$request->category);
                                        }

                                        if (isset($request->from, $request->to)&& !empty($request->from) && !empty($request->to)) {

                                            $start=date("Y-m-d", strtotime($request->from));
                                            $end=date("Y-m-d", strtotime($request->to));

                                            $categories->where(function ($q) use ($start,$end) {
                                                $q->whereBetween('expenses_master.generated_at', [$start, $end]);
                                            });

                                        }


                                        $categories=$categories->groupBy('category_id')
                                        ->get();



             //get()->pluck('name')->toArray();
             return \response()->json(

                        [
                            'categories'=>$categories->pluck('name')->toArray(),
                            'count'=>$categories->pluck('value')->toArray(),
                            'pie_data' => $categories->toArray()
                        ]

                );

        }else{
            $categories =  Category::get();
        return view('admin.dashboard.index', compact('categories'));
        }

    }



}
