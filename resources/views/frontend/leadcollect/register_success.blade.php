@extends('frontend.include.master')
@section('body')
<div class="container" style="max-width: 600px; margin: 150px auto; background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; text-align: center; font-family: Arial, sans-serif;">
    <span style="color: #4CAF50; font-size: 40px;"><i class="fa-solid fa-check"></i></span>
    <h2>Thank You!</h2>
    <div class="message" style="font-size: 24px; margin-bottom: 20px;">
        আপনার রেজিস্ট্রেশন সফল হয়েছে!
    </div>
    <p style="margin-bottom: 20px;">আপনার তথ্য সংরক্ষিত হয়েছে। আমরা খুব শীঘ্রই আপনার সাথে যোগাযোগ করব।</p>
    <a href="{{route('index')}}" class="back-link" style="display: inline-block; background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; transition: background-color 0.3s ease;">হোম পেজে ফিরে যান</a>
</div>
@endsection