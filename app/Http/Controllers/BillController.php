<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Comment;
use Illuminate\Http\Request;

class BillController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified'], ['except' => ['index', 'show']]);
    }
    
    // show all bills paginated
    public function index () 
    {
        // dd('abc');
        // dd(auth()->user()->bills);
        $bills = Bill::paginate(5);
        return view('bill.index',[
            'bills' => $bills
        ]);
    }

    // show one bill 
    public function show(Bill $bill)
    {

        // get comments with this bill 
        $comments = Comment::with(['user'])->paginate(3);

        // $comments->appends(['sort' => 'id']);

        // dd($bill);
        return view('bill.single', [
            'bill' => $bill,
            'comments' => $comments
        ]);
   }

    public function addComment(Request $request) {
        
        $this->validate($request, [
            'comment' => 'required|max:1000',
            'bill_id' => 'required'
        ]);

        // dd($request);
        // Bill::create(
            
        // );

        
        // save in database 

        $request->user()->comments()->create([
            'comment' => $request->comment,
            'bill_id' => $request->bill_id,
        ]);

        // return to home 

        // redirect()->route('bills');
        return back(); 



   }

    // show form to edit one bill 
    public function edit(Bill $bill)
    {
        // dd($bill);

        return view('bill.single', [
            'bill' => $bill
        ]);


   }

    public function create()
    {
        return view('bill.add');
    }

    public function store(Request $request) 
    {

        // check 

        // dd($request);
        $this->validate($request, [
            'title' => 'required|max:255',
            'bill_no' => 'required|max:25',
            'year' => 'required|max:4',
            'summary' => 'required|max:1000',
            // 'committee' => 'required|int',
            // 'sector' => 'required|int',
            // 'sponsor' => 
           
        ]);

        // Bill::create(
            
        // );

        
        // save in database 

        $request->user()->bills()->create([
            'title' => $request->title,
            'bill_no' => $request->bill_no,
            'year' => $request->year,
            'summary' => $request->summary
        ]);

        // return to home 

        // redirect()->route('bills');
        return back(); 


    }

    public function likeBill(Bill $bill, Request $request)
    {
        if($bill->likedBy($request->user())){
            return response(null, 409);
        }

        

    }
}
