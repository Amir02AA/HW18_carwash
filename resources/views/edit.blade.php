@extends('layout.blank')
@php $newTime = request('newTime') @endphp
@php $newTime = !is_null($newTime)? \App\Models\ReservationTime::find($newTime):null @endphp
@section('content')
    <div class="h-screen bg-indigo-100 flex justify-center items-center">
        <div class="lg:w-2/5 md:w-1/2 w-2/3 bg-white">
            <form class=" p-10 rounded-lg  min-w-full" method="post"
                  action="{{route('receipts.update',compact('receipt'))}}">
                @method('PATCH')
                <h1 class="text-center text-2xl mb-6 text-gray-600 font-bold font-sans">Edit Reservation</h1>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="confirm">Time Selection</label>
                    <a class="bg-blue-400 rounded-lg px-4 py-2" href="{{route('times.edit',['receipt'=>$receipt->id])}}">Select Time</a>
                    <span>Current Time Selected : {{is_null($newTime)?$time->start_time:$newTime->start_time}}</span>
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="username">Name</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="name"
                           id="name" placeholder="name" value="{{$receipt->name}}"/>
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="email">phone number</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="phone"
                           disabled
                           id="phone" placeholder="phone" value="{{$receipt->phone}}"/>
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md">{{$receipt->code}}</label>
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="service"> Services
                        <select name="service_id"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @forelse($services as $service)
                                <option value="{{$service->id}}">
                                    <div>
                                        {{$service->name ." | "}}
                                        {{$service->price."T | "}}
                                        {{$service->duration."Min"}}
                                    </div>
                                </option>
                            @empty
                                <option>
                                    No Service Available
                                </option>
                            @endforelse
                        </select>
                    </label>

                </div>

                <input type="text" name="reservation_time_id" hidden
                       value="{{is_null($newTime)?$time->id:$newTime->id}}">
                <button type="submit"
                        class="w-full mt-6 bg-indigo-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans">
                    Update
                </button>

                @csrf
            </form>
            <form method="post" action="{{route('receipts.destroy',compact('receipt'))}}">
                @method('delete')
                @csrf
                <button type="submit"
                        class="w-full mt-6 bg-red-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans">
                    Delete
                </button>
            </form>
        </div>
    </div>
@endsection
