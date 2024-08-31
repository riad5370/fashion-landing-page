@extends('frontend.include.master')
@section('body')
<style>
    .form-container1 {
        background-color: white;
        color: black;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .form-container1 input,
    .form-container1 button {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .form-container1 button {
        background-color: #ff7e5f;
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .form-container1 button:hover {
        background-color: #feb47b;
    }
</style>
<div class="container1">
    <h4 style="font-size: 24px; margin-bottom: 15px;">১০০% ফ্রি! আমাদের বিশেষজ্ঞদের সাথে আপনার ওয়েবসাইট নিয়ে আলোচনা করুন</h4>
    <p style="font-size: 18px; line-height: 1.6;">আপনার ওয়েবসাইটের উন্নয়ন ও বিক্রির জন্য আমাদের কন্ট্যালসির সেবা নিন। এখনই রেজিস্ট্রার করুন এবং ফ্রি কনসালটেশনের সুযোগ নিন!</p>
    <div class="form-container1">
        <form action="{{route('register.store')}}" method="POST">
            @csrf
            <input type="text" name="name" value="{{ old('name') }}" placeholder="আপনার নাম">
            @error('name')
                <strong class="text-danger">{{$message}}</strong>
            @enderror
            <input type="email" name="email" value="{{ old('email') }}" placeholder="আপনার ইমেইল">
            @error('email')
                <strong class="text-danger">{{$message}}</strong>
            @enderror
            <input type="number" name="mobile" value="{{ old('mobile') }}" placeholder="আপনার মোবাইল নাম্বার">
            @error('mobile')
                <strong class="text-danger">{{$message}}</strong>
            @enderror
            <button type="submit">Free Join</button>
        </form>
    </div>
</div>
@endsection