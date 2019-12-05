<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>resources/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?=base_url()?>resources/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="<?=base_url()?>resources/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template -->
	<link href="<?=base_url()?>resources/css/sb-admin.css?v=1" rel="stylesheet">
	
	<script src="<?=base_url()?>resources/vendor/jquery/jquery.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar static-top navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Admin Panel</a>
        <div class="collapse navbar-collapse" id="navbarExample">
            <ul class="sidebar-nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url()?>admin">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url()?>categories">Manage Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url()?>articles">Manage Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url()?>comments">Manage Comments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url()?>users">Manage Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url()?>settings/admins">Manage Admins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url()?>settings/groups">Manage Admins Group</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url()?>logout"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-wrapper py-3">

        <div class="container-fluid">

        