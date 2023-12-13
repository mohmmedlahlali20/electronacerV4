<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha256-hk1J8HZqEW/p7zC0xjYYr4EhGtYszmJdz21pKBC7ROU=" crossorigin="anonymous" />
    <link rel="stylesheet" href="home.css">
    <link rel="icon" href="img/electric.png">
    <title>Electro EL Harba</title>
    <style>
        
body{

background-color: white;
}

.navbar-nav>li>a{

text-transform: uppercase;
font-size: 12px;
margin-right:20px;
color: #000000;
}


.navbar-toggler {
  padding: .20rem .50rem;
  font-size: 1.25rem;
  line-height: 1;
  background-color: transparent;
  border: 1px solid rgb(0, 0, 0);

  }

  .nav-link{

    color: #000000 !important;
  }


.wrapper{
    width: 100%;
  position: absolute;
  height: 100%;
  background-color: #000;
  clip-path: polygon(81% 0, 100% 0, 100% 50%, 100% 100%, 71% 100%);
  transition: 1s all;
}

.navbar-brand{

color:#000000;
font-family: 'Allerta Stencil', sans-serif;
margin-bottom: 4px;
font-size: 27px;
}

.navbar-red:hover .wrapper{

clip-path: polygon(81% 0, 100% 0, 100% 50%, 100% 100%, 65% 100%);

}

.navbar-brand:hover{

color:#000000;

}

.navbar-red{

background-color: red;
color: #000000;

}

.all-show{

z-index: 10;
}
    </style>
</head>
<body>