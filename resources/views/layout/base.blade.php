<!DOCTYPE html>
<!--
Template Name: Rubick - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $dark_mode ? 'dark' : '' }}{{ $color_scheme != 'default' ? ' ' . $color_scheme : '' }}">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="image/svg+xml">
    <link href="{{ asset('dist/images/logo.svg') }}" rel="shortcut icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rubick admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Rubick Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="{{asset('dist/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/datetimepicker.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    @yield('head')

    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}" />
    <!-- END: CSS Assets-->
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;

        }
        /* .dataTables_length select{
            padding:5px: !important;
        } */
    </style>
</head>
<!-- END: Head -->

@yield('body')

</html>
