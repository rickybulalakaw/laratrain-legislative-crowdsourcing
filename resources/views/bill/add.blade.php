@extends('layouts.app2')

@section('content')
<div class="flex justify-center">
    <div class="bg-white p-6 rounded-lg w-8/12 m-6">

        <h1 class="text-4xl  text-lime-900 mb-6">{{ config('app.name', 'Laravel') }}</h1> 
        <form action="{{ route('add-bill') }}" method="post" enctype="multipart/form-data">
            @csrf

            <!-- <div class="mb-4">
                <label for="title">Draft Title</label>
                <input type="text" name="title" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror" placeholder="Enter Title of Draft Ordinance">
                @error('title')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div> -->

             <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="title" value="{{ __('Title') }}" />
                <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="state.title" name="title" autocomplete="title" />
                <x-input-error for="title" class="mt-2" />
            </div>

            <div class="mb-4">
                <label for="bill_no">Bill No.</label>
                <input type="text" name="bill_no" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('bill_no') border-red-500 @enderror" placeholder="Enter Bill No.">
                @error('bill_no')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="year">Year</label>
                <input type="number" name="year" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('year') border-red-500 @enderror" placeholder="Enter year">
                @error('year')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="summary">Summary of Draft Bill</label>
                <textarea  name="summary" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('summary') border-red-500 @enderror" placeholder="Enter brief summary">
                </textarea>
                @error('summary')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="summary">Upload Bill</label>
                <input type="file" name="filename" id="filename" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('filename') border-red-500 @enderror" >
                @error('summary')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="" type="submit">Upload</button>


        </form>

    
        
    </div>

</div>


 <!-- <h1>Legislative</h1> -->
@endsection