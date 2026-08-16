@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="welcome-container">
    <div class="welcome-card">
        <div class="welcome-content">
            <h1>Selamat Datang,</h1>
            <h2>{{ auth()->user()->name }}</h2>
            <p>{{ auth()->user()->email }}</p>
        </div>
    </div>
</div>

<style>
    .welcome-container {
        padding: 40px 24px;
    }
    
    .welcome-card {
        background: linear-gradient(135deg, #20B2AA 0%, #4169E1 100%);
        color: white;
        border-radius: 12px;
        padding: 32px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .welcome-card::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 200px;
        height: 200px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .welcome-card::after {
        content: '';
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 180px;
        height: 180px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .welcome-content {
        position: relative;
        z-index: 2;
    }
    
    .welcome-content h1 {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    
    .welcome-content h2 {
        font-size: 30px;
        font-weight: 300;
        margin-bottom: 12px;
    }
    
    .welcome-content p {
        font-size: 18px;
        opacity: 0.8;
    }
</style>
@endsection