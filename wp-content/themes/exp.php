<?php
/*
Template Name: exp
*/
?>
<!DOCTYPE html>
<html>
<head>
<?php include 'pagecss.php'; ?>

<style>

    @media only screen and (max-width: 1024px)
    {


        body {
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        .row > .column {
            padding: 0 8px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .column {
            float: left;
            width: 25%;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            margin: auto;
            padding: 0;
            width: 90%;
            max-width: 1200px;
        }

        /* The Close Button */
        .close {
            color: white;
            position: absolute;
            top: 120px;
            right: 80px;
            font-size: 35px;
            font-weight: bold;
            z-index:999;
        }

        .close:hover,
        .close:focus {
            color: #999;
            text-decoration: none;
            cursor: pointer;
        }

        .mySlides {
            display: none;
        }

        .cursor {
            cursor: pointer;
        }



        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 30%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            -webkit-user-select: none;

        }

        .mobilbg
        {
            background-color:#F7A645;
            border-radius:50%;
            height:60px;
            width:60px;

        }


        .next {
            right: 100px;
        }

        .prev {
            left: 100px;
        }



        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            color: #F7A645;
            cursor: pointer;
        }

        .start:hover {
            display: none;
        }

        .end:hover {
            display: none;
        }
    }

    @media only screen and (max-width: 768px)
    {


        body {
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        .row > .column {
            padding: 0 8px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .column {
            float: left;
            width: 25%;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            margin: auto;
            padding: 0;
            width: 90%;
            max-width: 1200px;
        }

        /* The Close Button */
        .close {
            color: white;
            position: absolute;
            top: 140px;
            right: 100px;
            font-size: 35px;
            font-weight: bold;
            z-index:999;
        }

        .close:hover,
        .close:focus {
            color: #999;
            text-decoration: none;
            cursor: pointer;
        }

        .mySlides {
            display: none;
        }

        .cursor {
            cursor: pointer;
        }



        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 35%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            -webkit-user-select: none;

        }

        .mobilbg
        {
            background-color:#F7A645;
            border-radius:50%;
            height:60px;
            width:60px;

        }


        .next {
            right: 100px;
        }

        .prev {
            left: 100px;
        }



        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            color: #F7A645;
            cursor: pointer;
        }

        .start:hover {
            display: none;
        }

        .end:hover {
            display: none;
        }
    }

    @media only screen and (max-width: 414px)
    {


        body {
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        .row > .column {
            padding: 0 8px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .column {
            float: left;
            width: 25%;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            margin: auto;
            padding: 0;
            width: 90%;
            max-width: 1200px;
        }

        /* The Close Button */
        .close {
            color: white;
            position: absolute;
            top: 120px;
            right: 30px;
            font-size: 35px;
            font-weight: bold;
            z-index:999;
        }

        .close:hover,
        .close:focus {
            color: #999;
            text-decoration: none;
            cursor: pointer;
        }

        .mySlides {
            display: none;
        }

        .cursor {
            cursor: pointer;
        }



        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 35%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            -webkit-user-select: none;

        }

        .mobilbg
        {
            background-color:#F7A645;
            border-radius:50%;
            height:60px;
            width:60px;

        }


        .next {
            right: 30px;
        }

        .prev {
            left: 30px;
        }



        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            color: #F7A645;
            cursor: pointer;
        }

        .start:hover {
            display: none;
        }

        .end:hover {
            display: none;
        }

        .MobilePadding
        {

            padding-top:10px;
        }

    }

</style>
<?php include 'connect.php';?>
</head>
<body>
<?php include 'pageheader.php';?>
<div class="pb-4"></div>


<?php

$TagsSum = 0;
$TagsSum2 = 0;
foreach ($data as $ArrayData)
{
    foreach ($ArrayData as $UnlockData)
    {
            if($_GET["page"])
            {
                $Pageurl = $_GET["page"];
                echo $Pageurl;
            if($UnlockData['nickname'] ==  $Pageurl )
            {
                ?>
                <!-- TITLE-->
                <?php include 'pagetitle.php';?>
                <!-- TITLE-->

                <!--  HIGHLINE  -->
                <?php include 'pagehighline.php'; ?>
                <!--  HIGHLINE  -->

                <!--  USER  -->
                <?php include 'pageuser.php'; ?>
                <!--  USER  -->

                <!--  TAGS & DESCRIPTION-->
                <?php include 'pagetags.php'; ?>
                <!--  TAGS & DESCRIPTION-->

                <!--VIDEO SLIDER-->
               <div hidden> <?php include 'pageslider.php'; ?></div>
                <!--VIDEO SLIDER-->

                <!--INFO-->
                <?php include 'pageinfo.php'; ?>
                <!--3 PART SECTION-->

                <!--SKILL BAR-->
                <?php include 'pageskillbar.php'; ?>
                <!--SKILL BAR-->

                <!--COMMENTS-->
                <?php include 'pagecomments.php'; ?>
                <!--COMMENTS-->

                <!--USER COMMENTS-->
                <?php include 'pagefootertop.php'; ?>
                <!--USER COMMENTS-->
            <?php }?>
        <?php }  ?>
    <?php }  ?>
<?php }  ?>
<?php include 'pagefooter.php';?>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="https://phoenix-cdn.azureedge.net/phoenix-blob-public-website/slick/slick.js" type="text/javascript" charset="utf-8"></script>
<?php include  'pagescript.php'?>


<style>
    /*DESKTOP DEVICE*/
    @media screen and (min-width: 1440px)
    {
        .pt-xl-12
        {
            padding-top: 6.5rem!important;
        }
        .pt-xl-11
        {
            padding-top: 6rem!important;
        }
        .pt-xl-10
        {
            padding-top: 5.5rem!important;
        }
        .pt-xl-9
        {
            padding-top: 5rem!important;
        }
        .pt-xl-8
        {
            padding-top: 4.5rem!important;
        }
        .pt-xl-7
        {
            padding-top: 4rem!important;
        }
        .pt-xl-6
        {
            padding-top: 3.5rem!important;
        }
        .pt-xl-5
        {
            padding-top: 3rem!important;
        }
        .pt-xl-4
        {
            padding-top: 2.5rem!important;
        }
        .pt-xl-3
        {
            padding-top: 2rem!important;
        }
        .pt-xl-2
        {
            padding-top: 1.5rem!important;
        }
        .pt-xl-1
        {
            padding-top: 0.5rem!important;
        }
    }
    /*TABLET DEVICE*/
    @media screen and (max-width: 1024px)
    {


        .pt-md-12
        {
            padding-top: 6.5rem!important;
        }
        .pt-md-11
        {
            padding-top: 6rem!important;
        }
        .pt-md-10
        {
            padding-top: 5.5rem!important;
        }
        .pt-md-9
        {
            padding-top: 5rem!important;
        }
        .pt-md-8
        {
            padding-top: 4.5rem!important;
        }
        .pt-md-7
        {
            padding-top: 4rem!important;
        }
        .pt-md-6
        {
            padding-top: 3.5rem!important;
        }
        .pt-md-5
        {
            padding-top: 3rem!important;
        }
        .pt-md-4
        {
            padding-top: 2.5rem!important;
        }
        .pt-md-3
        {
            padding-top: 2rem!important;
        }
        .pt-md-2
        {
            padding-top: 1.5rem!important;
        }
        .pt-md-1
        {
            padding-top: 0.6rem!important;
        }

        /*COL SM*/
        .col-md-12
        {
            width: 100%;
        }
        .col-md-11
        {
            width:91.67%;
        }
        .col-md-10
        {
            width: 83.33%;
        }
        .col-md-9
        {
            width: 75%;
        }
        .col-md-8
        {
            width: 66.66%;
        }
        .col-md-7
        {
            width: 58.33%;
        }
        .col-md-6
        {
            width: 50%;
        }
        .col-md-5
        {
            width: 41.66%;
        }
        .col-md-4
        {
            max-width: 33.33%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-md-3
        {
            max-width: 25%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;

        }
        .col-md-2
        {
            width: 16.66%;
        }
        .col-md-1
        {
            width: 8.33%;
        }
    }
    /*MOBILE DEVICE*/
    @media screen and (max-width: 768px)
    {
        /*PT SM*/
        .pt-mnt-12
        {
            padding-top: 6.5rem!important;
        }
        .pt-mnt-11
        {
            padding-top: 6rem!important;
        }
        .pt-mnt-10
        {
            padding-top: 5.5rem!important;
        }
        .pt-mnt-9
        {
            padding-top: 5rem!important;
        }
        .pt-mnt-8
        {
            padding-top: 4.5rem!important;
        }
        .pt-mnt-7
        {
            padding-top: 4rem!important;
        }
        .pt-mnt-6
        {
            padding-top: 3.5rem!important;
        }
        .pt-mnt-5
        {
            padding-top: 3rem!important;
        }
        .pt-mnt-4
        {
            padding-top: 2.5rem!important;
        }
        .pt-mnt-3
        {
            padding-top: 2rem!important;
        }
        .pt-mnt-2
        {
            padding-top: 1.5rem!important;
        }
        .pt-mnt-1
        {
            padding-top: 1rem!important;
        }
        .pt-mnt-0
        {
            padding-top: 0rem!important;
        }



        /*COL SM*/
        .col-mnt-12
        {
            max-width: 100%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-mnt-11
        {
            max-width:91.67%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-mnt-10
        {
            max-width: 83.33%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-mnt-9
        {
            max-width: 75%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-mnt-8
        {
            max-width: 66.66%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-mnt-7
        {
            max-width: 58.33%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-mnt-6
        {
            max-width: 50%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-mnt-5
        {
            max-width: 41.66%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-mnt-4
        {
            max-width: 33.33%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-mnt-3
        {
            max-width: 25%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-mnt-2
        {
            max-width: 16.66%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-mnt-1
        {
            max-width: width: 8.33%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }



    }
    @media screen and (max-width: 600px)
    {

        /*PT SM*/
        .pt-msm-12
        {
            padding-top: 6.5rem!important;
        }
        .pt-msm-11
        {
            padding-top: 6rem!important;
        }
        .pt-msm-10
        {
            padding-top: 5.5rem!important;
        }
        .pt-msm-9
        {
            padding-top: 5rem!important;
        }
        .pt-msm-8
        {
            padding-top: 4.5rem!important;
        }
        .pt-msm-7
        {
            padding-top: 4rem!important;
        }
        .pt-msm-6
        {
            padding-top: 3.5rem!important;
        }
        .pt-msm-5
        {
            padding-top: 3rem!important;
        }
        .pt-msm-4
        {
            padding-top: 2.5rem!important;
        }
        .pt-msm-3
        {
            padding-top: 2rem!important;
        }
        .pt-msm-2
        {
            padding-top: 1.5rem!important;
        }
        .pt-msm-1
        {
            padding-top: 1rem!important;
        }



        /*COL SM*/
        .col-msm-12
        {
            max-width: 100%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-msm-11
        {
            max-width:91.67%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-msm-10
        {
            max-width: 83.33%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-msm-9
        {
            max-width: 75%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-msm-8
        {
            max-width: 66.66%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-msm-7
        {
            max-width: 58.33%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-msm-6
        {
            max-width: 50%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-msm-5
        {
            max-width: 41.66%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-msm-4
        {
            max-width: 33.33%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-msm-3
        {
            max-width: 25%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-msm-2
        {
            max-width: 16.66%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
        .col-msm-1
        {
            max-width: 8.33%;
            position: relative;
            padding-left: 15px;
            padding-right: 15px;
            flex: 0 0 100%;
        }
    }
    @media screen and (max-width: 414px)
    {
        .pt-xs-12
        {
            padding-top: 6.5rem!important;
        }
        .pt-xs-11
        {
            padding-top: 6rem!important;
        }
        .pt-xs-10
        {
            padding-top: 5.5rem!important;
        }
        .pt-xs-9
        {
            padding-top: 5rem!important;
        }
        .pt-xs-8
        {
            padding-top: 4.5rem!important;
        }
        .pt-xs-7
        {
            padding-top: 4rem!important;
        }
        .pt-xs-6
        {
            padding-top: 3.5rem!important;
        }
        .pt-xs-5
        {
            padding-top: 3rem!important;
        }
        .pt-xs-4
        {
            padding-top: 2.5rem!important;
        }
        .pt-xs-3
        {
            padding-top: 2rem!important;
        }
        .pt-xs-2
        {
            padding-top: 1.5rem!important;
        }
        .pt-xs-1
        {
            padding-top: 1rem!important;
        }


        /*COL XS*/
        .col-xs-12
        {
            width: 100%;
        }
        .col-xs-11
        {
            width:91.67%;
        }
        .col-xs-10
        {
            width: 83.33%;
        }
        .col-xs-9
        {
            width: 75%;
        }
        .col-xs-8
        {
            width: 66.66%;
        }
        .col-xs-7
        {
            width: 58.33%;
        }
        .col-xs-6
        {
            width: 50%;
        }
        .col-xs-5
        {
            width: 41.66%;
        }
        .col-xs-4
        {
            width: 33.33%;
        }
        .col-xs-3
        {
            width: 25%;
        }
        .col-xs-2
        {
            width: 16.66%;
        }
        .col-xs-1
        {
            width: 8.33%;
        }
    }
    @media screen and (max-width: 375px)
    {
        /*PT XS*/
        .pt-xs-12
        {
            padding-top: 6.5rem!important;
        }
        .pt-xs-11
        {
            padding-top: 6rem!important;
        }
        .pt-xs-10
        {
            padding-top: 5.5rem!important;
        }
        .pt-xs-9
        {
            padding-top: 5rem!important;
        }
        .pt-xs-8
        {
            padding-top: 4.5rem!important;
        }
        .pt-xs-7
        {
            padding-top: 4rem!important;
        }
        .pt-xs-6
        {
            padding-top: 3.5rem!important;
        }
        .pt-xs-5
        {
            padding-top: 3rem!important;
        }
        .pt-xs-4
        {
            padding-top: 2.5rem!important;
        }
        .pt-xs-3
        {
            padding-top: 2rem!important;
        }
        .pt-xs-2
        {
            padding-top: 1.5rem!important;
        }
        .pt-xs-1
        {
            padding-top: 1rem!important;
        }


        /*COL XS*/
        .col-xs-12
        {
            width: 100%;
        }
        .col-xs-11
        {
            width:91.67%;
        }
        .col-xs-10
        {
            width: 83.33%;
        }
        .col-xs-9
        {
            width: 75%;
        }
        .col-xs-8
        {
            width: 66.66%;
        }
        .col-xs-7
        {
            width: 58.33%;
        }
        .col-xs-6
        {
            width: 50%;
        }
        .col-xs-5
        {
            width: 41.66%;
        }
        .col-xs-4
        {
            width: 33.33%;
        }
        .col-xs-3
        {
            width: 25%;
        }
        .col-xs-2
        {
            width: 16.66%;
        }
        .col-xs-1
        {
            width: 8.33%;
        }
    }
</style>
</body>
</html>



