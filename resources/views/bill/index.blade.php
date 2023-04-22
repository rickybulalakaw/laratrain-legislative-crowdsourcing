@extends('layouts.app2')

@section('content')
<div class="flex justify-center">
    <div class="bg-white p-6 rounded-lg w-8/12 m-6">

        <h1 class="text-4xl  text-lime-900 mb-6">{{ config('app.name', 'Laravel') }}</h1> 
        <p class="text-neutral-900 ">Below are proposed legislative measures for review of the public.</p>

        @if($bills->count())
         @foreach($bills as $bill)
        <div class="card m-6 p-1 bg-sky-300 rounded">
            <div class="card-header m-6">{{$bill->title}}</div>
            <div class="card-body m-6">
                <p class="mb-3">Bill Number: {{$bill->bill_no}}</p>
                <p class="mb-3">Year Filed: {{$bill->year}}</p>
                <p class="mb-3">
                {{$bill->summary}}
                </p>
                <p class="mb-3">Filed by: {{ $bill->user->name }} {{ $bill->user->lastname }}</p>
                <p>Posted {{ $bill->created_at->diffForHumans() }}</p>
            </div>
            @auth
            <div class="mb-3 mx-3">
                <a href="" class="bg-blue-500 text-white px-3 py-3 rounded font-medium inline">Read and Discuss</a>
            </div>
            @endauth
        </div>
         @endforeach

         {{$bills->links()}}

        @else
        <p>There is  no draft bill for comment as of this time. Thank you for participating in democracy!</p>
        @endif 
        
        <!-- <div class="card m-6 p-3 bg-sky-300 rounded">
            <div class="card-header m-6">Bill Number 2</div>
            <div class="card-body m-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit amet, deserunt necessitatibus similique aut, ipsam cum doloremque hic aliquid sint optio natus inventore iusto magnam accusamus architecto vero, neque debitis?</div>
            <a href="">Like</a> <a href="">Unlike</a> <a href="">Discuss</a>
        </div>
        
        <div class="card m-6 p-3 bg-sky-300 rounded">
            <div class="card-header m-6">Bill Number 3</div>
            <div class="card-body m-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit amet, deserunt necessitatibus similique aut, ipsam cum doloremque hic aliquid sint optio natus inventore iusto magnam accusamus architecto vero, neque debitis?</div>
            <a href="">Like</a> <a href="">Unlike</a> <a href="">Discuss</a>
        </div> -->
        
    </div>

</div>


 <!-- <h1>Legislative</h1> -->
@endsection