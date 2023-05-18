<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $comments = Comment::with(['user'])->where('bill_id', $bill->id)->paginate(3);

        // $comments = Comment::with(['user'])->paginate(3);



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
        // function shows the edit form with old values

        // check first user to confirm password
        
        $status = [
            ['value' => 'active', 'label' => 'Active'],
            ['value' => 'inactive', 'label' => 'Inactive'],
            ['value' => 'pending', 'label' => 'Pending']
        ];

        return view('bill.edit', [
            'bill' => $bill,
            'status' => $status
        ]);       
   }

   public function update(Request $request, Bill $bill){
    $updatedBill = $this->validate($request, [
        'title' => ['required', 'max:255'],
        'bill_no' => 'required|max:255',
        'year' => 'required|integer|max:3000',
        'summary' => 'required|max:1000',
        'status' => 'required|max:10'
    ]);
    
    // save into database with current user authentication 

    // $request->user()->bills()->update($bill);

    // update the bill record in the database
    DB::table('bills')->where('id', $bill->id)->update($updatedBill);

    // $request->user()->bills()->create($bill);
    

    return redirect()->route('show-bill', $bill->id);

   }

    public function create()
    {

        // check first user to confirm password 

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

        // save uploaded file to AWS S3
        // $path = $request->file('filename')->store('bills', 's3');

        // save uploaded file to local storage
        $path = $request->file('file')->store('bills');

        // save in database without uploading file 
        // $request->user()->bills()->create($bill);
        

        // save in database with current user's id
        $upload = $request->user()->bills()->create([
            'bill_no' => $request->bill_no,
            'year' => $request->year,
            'summary' => $request->summary,
            'filename' => basename($path),
            // 'url' => Storage::disk('s3')->url($path),
            'url' => $path
        ]);

        
        // return to home 
        return redirect()->route('home');

    }

    public function likeBill(Bill $bill, Request $request)
    {

        $like = $this->validate($request, [
            'bill_id' => 'required',
            'like' => 'required'
        ]);

        // $request->user->likes($bill)->create($like);

        // save to database like linked to bill based on this user 
        DB::table('likes')->insert([
            'bill_id' => $like['bill_id'],
            'user_id' => $request->user()->id,
            'like' => $like['like']
        ]);

        return redirect()->route('show-bill', $request->bill_id);
        

    }

    public function downloadBill(Bill $bill){

        // Download the uploaded file 
        // function for AWS S3
        // return Storage::disk('s3')->response('bills/' . $bill->filename);

        // function to download file from local storage
        // return Storage::download('bills/' . $bill->filename);

        // alternative that uses the url column 
        return Storage::download($bill->url);

    }

    public function destroy(Bill $bill){
        // function to delete bill
        $bill->delete();

        // delete the bill record in the database using Query Builder
        // DB::table('bills')->where('id', $bill->id)->delete();


        // redirect to index 
        return redirect()->route('home');
    }

}
