<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;
use App\Models\Contact;
use App\Models\Tour;
use App\Models\Tour_member;
use App\Models\Tour_detail;
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
        $today = Carbon::now();

        $data = Auth::user();
        $category = Categories::get();
        $lastexp = Expense::latest()->first();
        $exp = Expense::where('user_id',$data->id)->sum('expense'); 
        $yearexp = DB::table('expenses')
                    ->select(
                    DB::raw('SUM(expense) as total_expense'),
                    DB::raw('MONTHNAME(date) as month_name'),
                    DB::raw('YEAR(date) as year')
                )
                ->where('user_id',  Auth::id())
                ->groupBy('year', 'month_name')
                ->get();
                $limit = Expense::selectRaw('sum(expense) as expense, category')->whereMonth('date', $today->month)->groupBy('category')->where('user_id', Auth::id())->get()->toArray();

        $remain_limit = $data->expense_limit - $exp; 
        return view('dashboard',compact('remain_limit','category','limit','exp','lastexp','yearexp'));
    }

    public function manage() {
        $category = Categories::where('user_id',Auth::id())->get();
        $expense = Expense::where('user_id', Auth::id())->get();
        $total = DB::table('expenses')->where('user_id', Auth::id())->sum('expense');
        return view('manage', compact('expense', 'total','category'));
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
        // return $request->all();
        dd($request);
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

    public function expensedata($id)
    {
        $expense = Expense::find($id);
        return response()->json($expense);

    }

    public function update(Request $request) {
        $expense = Expense::find($request->id);
        $expense->update(['category' => $request->expensecategory, 'date' => $request->expensedate, 'expense' => $request->expenseamount ,'description' => $request->expensedescription]);
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
        $amt = $request->limitamt;
        if($amt > Auth::user()->expense_limit)
        {
            return redirect()->route('category')->with('message', 'invaild Amount Entered');
        }
        else
        {
            $category = Categories::create([
                'user_id'=>$request->uid,
                'name'=>$request->catename,
                'limit'=>$request->limitamt
            ]);
            return redirect()->route('category')->with('success', 'Add Category Successfully');
        }
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
        return view(new exportfile($request), 'users.xlsx');
    }

    public function tour()
    {
        $contact = Contact::where('user_id',Auth::id())->get(); 
        $amount = DB::select("select tour.user_id,sum(`tour_details`.`amount`) as amount, `tour`.`name`, `tour`.tid as tid from `tour_details` right join `tour` on `tour`.`tid` = `tour_details`.`Tour_id` where tour.user_id = ".Auth::id(). " group by `tour`.`tid`");
        $tourconut = count($amount);
        $contactcount = count($contact);
        return view('tour',compact('contact','tourconut','contactcount','amount'));
    }

    public function addContact(Request $request)
    {
        $contact = Contact::create([
            'user_id'=>$request->uid,
            'name'=>$request->cname
        ]);
        return redirect()->route('tour')->with('success', 'Add Contact Successfully');
    }

    public function memberdelete(Request $request, $cid)
    {
        $data = Contact::where('cid',$cid)->delete();
        return redirect()->route('tour')->with('success', 'Delete Member Successfully');
    }
    
    public function addTourMember(Request $request)
    {
        $tour = Tour::create([
            'name'=>$request->cname,
            'user_id'=>$request->uid
        ]);
        if($tour == true)
        {
            $mid = $request->membername;
            for($i = 0; $i < count($mid); $i++)
            {
                $rec[$i] = array(
                    'user_id'=>$request->uid,
                    'member_id'=>$mid[$i],
                    'Tour_id'=>$tour->id
                );
                Tour_member::insert($rec[$i]);
            }
            return redirect()->route('tour')->with('success', 'new Tour Successfully');
        }
    }

    public function tourdetail($tdid)
    {
        $tname = Tour::where('tid',$tdid)->first();
        $tour = DB::select('SELECT * FROM `contact` c join tour_members tm on tm.member_id = c.cid where tm.Tour_id = '.$tdid);
        $data = Tour_detail::where('tour_id',$tdid)->get();
        return view('tourdetail',compact('tour','tname','data'));
    }

    public function Addtourdetail(Request $request)
    {
        $data = Tour_detail::updateOrCreate(['tdid' => $request->tdid],[
            'Tour_id' => $request->tourid,
            'amount' => $request->amount,
            'date' => $request->date,
            'detail' => $request->detail
        ]);
        return back();
    }

    public function Deletetourdetail($tdid)
    {
        $data = Tour_detail::where('tdid', $tdid)->delete();
        return back();
    }
}


