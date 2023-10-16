@extends('layout.main')

@section('content')

    <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">Name : {{$receipt->name}}</li>
        <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">Phone : {{$receipt->phone}}</li>
        <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">Tracking Code : {{$receipt->code}}</li>
        <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">Service : {{$receipt->service->name." | ".
                                                                                               $receipt->service->price." T"}}</li>
        <li class="w-full px-4 py-2 rounded-b-lg">Time : {{$receipt->reservation_time->start_time}}</li>
    </ul>
    <a href="{{route('receipts.edit',compact('receipt'))}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-red-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Edit your reservation
        <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
    </a>
@endsection
