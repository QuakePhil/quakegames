<!doctype html5>
<html ng-app="app" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>QuakeWorld Game Search</title>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        
        <link rel="stylesheet" href="bower_components/seiyria-bootstrap-slider/css/bootstrap-slider.css">

        <link href="bower_components/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
        <link href="bower_components/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" rel="stylesheet">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <!-- prototypes are commented out -->
        
        <script type="text/javascript" src="js/locations.js"></script>
        <script type="text/javascript" src="js/geo.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <!--
        <script type="text/javascript" src="js/app.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
        -->
        <script type="text/javascript" src="bower_components/seiyria-bootstrap-slider/js/bootstrap-slider.js"></script>
        <script type="text/javascript" src="bower_components/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
        <style>
            html {
              position: relative;
              min-height: 100%;
            }
            body {
              padding-top: 50px;
              /* Margin bottom by footer height */
              margin-bottom: 60px;
            }
            .template {
              padding: 40px 15px;
            }

            .slider-track-high {
              background: red;
            }

            .slider-selection {
              background: yellow;
            }

            .slider-track-low {
              background: green;
            }
  
            .footer {
              position: absolute;
              bottom: 0;
              width: 100%;
              /* Set the fixed height of the footer here */
              height: 60px;
              background-color: #f5f5f5;
            }
            .footer p {
              margin: 20px;
            }
        </style>
    </head>
    <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">QuakeWorld Game Search</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Games</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
    <div class="container">
        <div class="template">
