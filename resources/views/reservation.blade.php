@extends('layout.blank')
@php
$time = \App\Models\ReservationTime::find(@request('time'))
    @endphp
@section('content')
    <div class="h-screen bg-indigo-100 flex justify-center items-center">
        <div class="lg:w-2/5 md:w-1/2 w-2/3">
            <form class="bg-white p-10 rounded-lg shadow-lg min-w-full" method="post"
                  action="{{route('receipts.store')}}">
                <h1 class="text-center text-2xl mb-6 text-gray-600 font-bold font-sans">Reservation Form</h1>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="confirm">Time Selection</label>
                    <a class="bg-blue-400 rounded-lg px-4 py-2" href="{{route('times')}}">Select Time</a>
                    <span>Current Time Selected : {{@$time->start_time}}</span>
                    @error('times')
                        {{$message}}
                    @enderror
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="username">Name</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="name"
                           id="name" placeholder="name" value="{{request()->old('name')}}"/>
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="email">phone number</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="phone"
                           id="phone" placeholder="phone" value="{{request()->old('phone')}}"/>
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

                <input type="text" name="reservation_time_id" hidden value="{{request('time')}}">
                <button type="submit"
                        class="w-full mt-6 bg-indigo-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans">
                    Reserve
                </button>
                @csrf
            </form>
        </div>
    </div>
@endsection

