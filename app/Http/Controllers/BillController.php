<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BillController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified'], ['except' => ['index', 'show']]);
    }
    
    public function index () 
    {
        // function that shows bills ordered by date in descending order 
        // $bills = Bill::orderBy('created_at', 'asc')->paginate(5);
        
        // dd('abc');
        // dd(auth()->user()->bills);
        // $bills = Bill::paginate(5);
        // $bills = Bill::with(['user'])->paginate(5);

        // function that shows bills ordered by date in descending orde paginate 5 per page
        $bills = Bill::orderBy('id', 'desc')->with(['user'])->paginate(15);
        return view('bill.index',[
            'bills' => $bills
        ]);
    }

    public function show(Bill $bill)
    {
        // function that shows one bill 

        // function that gets comments for one bill 
        // $comments = Comment::with(['user'])->where('bill_id', $bill->id)->paginate(3);

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
        $bill = $this->validate($request, [
            'title' => 'required|max:255',
            'bill_no' => 'required|unique:bills|max:25',
            'year' => 'required|max:4',
            'summary' => 'required|max:1000',
            // 'filename' => 'required',
            // 'sector' => 'required|int',
            // 'sponsor' => 
           
        ]);

        // save in database using Model method without user
        // Bill::create($bill);


        // $path = $request->file(key:'filename')->store('bills', 's3');
        // $path = $request->file('filename')->store('bills');
        

        // save in database without uploading file 
        $request->user()->bills()->create($bill);
        

        // save in database with current user's id
        // $upload = $request->user()->bills()->create([
        //     'title' => $request->title,
        //     'bill_no' => $request->bill_no,
        //     'year' => $request->year,
        //     'summary' => $request->summary,
        //     'filename' => basename($path),
        //     'url' => Storage::disk('s3')->url($path),
        //     'url' => Storage::disk('')
        // ]);



        // return to home 
        return redirect()->route('home');

        // redirect()->route('bills');
        // return back(); 

        // Return details of upload 
        // return $upload;


    }

    public function likeBill(Bill $bill, Request $request)
    {
        if($bill->likedBy($request->user())){
            return response(null, 409);
        }

        

    }

    public function downloadBill(Bill $bill){

        return Storage::disk('s3')->response('bills/' . $bill->filename);


    }

}
