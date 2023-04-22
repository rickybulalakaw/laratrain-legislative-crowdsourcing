<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'], ['except' => ['index']]);
    }
    
    public function index () 
    {
        // dd('abc');
        // dd(auth()->user()->bills);
        $bills = Bill::paginate(3);
        return view('bill.index',[
            'bills' => $bills
        ]);
    }

    public function view(Request $request)
    {
        dd('abc');

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
}
