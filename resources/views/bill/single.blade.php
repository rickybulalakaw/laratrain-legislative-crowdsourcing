@extends('layouts.app2')

@section('content')
<div class="flex justify-center">
    <div class="bg-white p-6 rounded-lg w-8/12 m-6">

        <h1 class="text-4xl  text-lime-900 mb-6">{{ config('app.name', 'Laravel') }}</h1> 

        <div class="card m-6 px-1 py-3 bg-sky-300 rounded">
            <div class="card-header m-6 "><h3 class="text-3xl font-bold ">{{$bill->title}}</h3></div>
            <hr>
            <div class="card-body m-6">

                <p class="mb-3 text-lg">Sponsor: {{$bill->user->name}} {{$bill->user->lastname}}</p>
                <p class="mb-3 text-lg">Bill Number: {{$bill->bill_no}}</p>
                <p class="mb-3 text-lg">Year Filed: {{$bill->year}}</p>
                <p class="mb-3 text-lg">
                {{$bill->summary}}
                </p>
                <p class="mb-3 text-lg">65 Likes | 22 Unlikes</p>

                <p class="text-sm mb-3">Posted {{ $bill->created_at->diffForHumans() }} </p>
                @auth
                <div class="flex items-center">
                    <form action="/like" method="post">
                        @csrf
                        <input type="hidden" name="bill_id" value="{{$bill->id}}">
    
                        
                        <button type="submit" class="bg-green-500  p-3 mx-1 border-cyan-100  text-white text-lg font-semibold rounded-md ">Like</button>
                    </form>
    
                    <form action="/unlike" method="post">
                        @csrf
                        <input type="hidden" name="bill_id" value="{{$bill->id}}">
                        <button type="submit" class="bg-red-500 p-3 mx-1 border-red-50 text-white text-lg font-semibold rounded-md ">Unlike</button>
                    </form>

                    <!-- This should be available only to owner of the posted bill  -->
                        <a href="" class="bg-blue-500 p-3 mx-1 border-red-50 text-white text-lg font-semibold rounded-md ">Edit Details</a>
                        <!-- <a href="" class="bg-yellow-500 p-3 mx-1 border-red-50 text-white text-lg font-semibold rounded-md ">Upload bill</a> -->
                        <a href="{{ route('download-bill', $bill->id) }}" class="bg-yellow-500 p-3 mx-1 border-red-50 text-white text-lg font-semibold rounded-md ">Download bill</a>

                    
                </div>
                @endauth
            </div>

            @auth
            <div class="mb-3 mx-6">
                <form action="{{ route('add-comment') }}" method="post">
                    @csrf
                    <input type="hidden" name="bill_id" value="{{$bill->id}}">
                <div class="col-span-6 sm:col-span-4 mb-3">
                    <x-label for="comment" value="{{ __('Comment') }}" />
                    <x-input id="comment" name="comment" type="text" class="mt-1 block w-full" wire:model.defer="state.comment" autocomplete="comment" />
                    <x-input-error for="comment" class="mt-2" />
                </div>
                <x-button class="text-lg p-3">
                    {{ __('Submit comment') }}
                </x-button>
                </form>
            </div>
            @endauth

        </div>

        <!-- Comments for this bill  -->
        @if(count($comments) >= 1)
            @foreach($comments as $comment) 
                <div class="bg-blue-100 p-3 mb-5 mx-6 border-red-200">
                    <p class="text-lg mb-3 mx-6">{{ $comment->comment }}</p>
                    <p class="text-sm mb-3 mx-6">Commented {{$comment->created_at->diffForHumans()}} by {{$comment->user->name }} {{$comment->user->lastname}} .</p>
                </div>
            @endforeach
            {{$comments->links()}}
        @else 
            <p class="py-3 text-lg mb-3 mx-6">No comments yet for this bill.</p>
        @endif
       
        
    </div>

</div>


 <!-- <h1>Legislative</h1> -->
@endsection