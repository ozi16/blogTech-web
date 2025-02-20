<?php
use Illuminate\Support\Str;
?>



<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>New Blog Post Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .post-image {
            width: 100%;
            border-radius: 10px;
        }
        .post-title {
            font-size: 20px;
            margin: 15px 0;
            color: #222;
        }
        .post-description {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
        }
        .button {
            display: block;
            width: 200px;
            text-align: center;
            background: #007bff;
            color: #ffffff;
            padding: 10px 15px;
            margin: 20px auto;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">New Blog Post</div>
        <img src="{{asset('images/posts/')}}" alt="Post Image" class="post-image">
        <div class="post-title">{{$post->title}}</div>
        <div class="post-description">{!! Str::ucfirst(Str::words($post->content, 43)) !!}</div>
        <a href="{{route('read_post',$post->slug)}}" class="button">Read More</a>
        <div class="footer">&copy; 2025 Your Website. All rights reserved.</div>
    </div>  
</body>
</html>
