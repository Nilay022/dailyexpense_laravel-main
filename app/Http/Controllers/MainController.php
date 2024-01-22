<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;
use App\Exports\exportfile;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class MainController extends Controller {
    public function register() {
        return view('register');
    }

    public function login() {
        return view('login');
    }

    public function dashboard(Request $request) {   
        $data = Auth::user();
        $category = Categories::get();
        $lastexp = Expense::latest()->first();
        $exp = Expense::where('user_id',$data->id)->sum('expense'); 
        $limit = Expense::selectRaw('sum(expense) as expense, category')->groupBy('category')->where('user_id', Auth::id())->get()->toArray();
        $remain_limit = $data->expense_limit - $exp; 
        return view('dashboard',compact('remain_limit','category','limit','exp','lastexp'));
    }

    public function manage() {
        $expense = Expense::where('user_id', Auth::id())->get();
        $total = DB::table('expenses')->where('user_id', Auth::id())->sum('expense');
        return view('manage', compact('expense', 'total'));
    }

    public function add() {
        $data = Categories::where('user_id',Auth::id())->get();
        return view('addexpense', compact('data'));
    }

    public function edit($id) {
        $expense = Expense::find($id);
        $data = Categories::where('user_id',Auth::id())->get();
        return view('updateexpense', compact('expense','data'));
    }

    public function profile() {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function addStore(Request $request) {
        $validate = $request->validate([
            'expenseamount' => 'required',
            'expensedate' => 'required',
            'expensecategory' => 'required',
        ]);

        $user = Expense::create([
            'user_id' => Auth::id(),
            'expense' => $request->expenseamount,
            'date' => $request->expensedate,
            'category' => $request->expensecategory,
            'description' => $request->expensedescription
        ]);
        return redirect()->route('manage')->with('success', 'Add Expense Successfully');
    }

    public function profileStore(Request $request) {
        $validate = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'expenseLimit' => 'required'
        ]);
        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $user->email;
        $user->expense_limit = $request->expenseLimit;
        $user->save();
        return redirect()->route('profile')->with('success', 'Profile Update Successfully');
    }

   public function profileUpload(Request $request) {
        return $request->all();
        // $user = Auth::user();
        // if ($request->hasFile('file')) {
        //     $image = $request->file('file');
        //     $filename = $user->email . '_' . $image->getClientOriginalName();
        //     $path = $image->storeAs('public/profile', $filename);
        //     $user->profile = $filename;
        //     $user->save();
        }
        // return redirect()->route('profile')->with('success', 'Profile Update Successfully');
    // }

    public function update(Request $request, $id) {
        $expense = Expense::find($id);
        $expense->update(['category' => $request->expensecategory, 'date' => $request->expensedate, 'expense' => $request->expenseamount]);
        return redirect()->route('manage')->with('success', 'Update Expense Successfully');
    }

    public function delete(Request $request, $id){
        Expense::find($id)->delete();
        return redirect()->route('manage')->with('success', 'Delete Expense Successfully');
    }

    public function category()
    {
        $data = Categories::where('user_id',Auth::id())->get();
        return view('category',compact('data'));
    }

      public function show($id)
    {
        $post = Categories::find($id);
        return response()->json($post);
    }

    public function updateCategory(Request $request){
        $category = Categories::find($request->cid);
        $category->update(['name'=>$request->catename,'limit'=>$request->limitamt]);
        return redirect()->route('category')->with('success','Update Category successfully');        
    }
      public function deleteCategory(Request $request, $id){
        Categories::find($id)->delete();
        return redirect()->route('category')->with('success', 'Delete Category Successfully');
    }

    public function AddCategory(Request $request)
    {   
        $category = Categories::create([
            'user_id'=>$request->uid,
            'name'=>$request->catename,
            'limit'=>$request->limitamt
        ]);
        return redirect()->route('category')->with('success', 'Add Category Successfully');
    }

    public function report()
    {
        $data = Expense::all();
        return view('report',compact('data'));
    }

    public function reportupdate(Request $request)
    {
        $startdate = Carbon::parse($request->startdate);
        $enddate = Carbon::parse($request->enddate);
        $alldata = Expense::whereBetween('date',[$startdate->format('Y-m-d'),$enddate->format('Y-m-d')])->where('user_id',Auth::id())->get();
         return response()->json($alldata);

    }

    public function exportdata(Request $request)
    {
        // return $request->all();
        return Excel::download(new exportfile($request), 'users.xlsx');
    }
}


