
@extends('layouts.configLayout')
@section('title',"No Access")
@section('main')
<style>
    .access-mess{
        display:flex;
        justify-content:center;
        align-items:center;
        width:100%;
        height:100%;
        color:gray;
        font-weight:400;
        font-size:20px;
    }
 
</style>


<div class="access-mess ">
    <h1>You have no access to this page <a href="{{route('home_page')}}">Go to home page</a></h1>
</div>
@endsection