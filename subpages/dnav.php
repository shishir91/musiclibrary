<head>
    <style>
        .navigation {
            height: 70px;
            background: black;
            /* background: #262626; */
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        #ml {
            font-family: Algerian;
        }

        .brand {
            display: flex;
            align-items: center;
            margin: 30px;
        }

        .brand a {
            color: #fff;
            font-size: 24px;
            margin-left: 10px;
            text-decoration: none;
        }

        .fa-music,
        .fa-headphones-simple {
            font-size: 24px;
        }

        .nav-list {
            text-decoration: none;
            font-size: 10px;
            display: flex;
            margin: 10px;
            padding: 20px;
            list-style: none;
            justify-content: flex-start;
        }

        .nav-list li {
            font-size: 10px;
            margin-right: 10px;
            justify-content: flex-start;
        }

        .nav-list li a {
            text-decoration: none;
            font-size: medium;
            color: #fff;
        }

        .nav-list li a,
        .nav-list li a:visited {
            display: block;
            padding: 0 20px;
            line-height: 70px;
            background: black;
            color: #ffffff;
            text-decoration: none;
        }

        .nav-list li a:hover,
        .nav-list li a:visited:hover {
            background: #2581dc;
            color: #ffffff;
        }

        .nav-list li:last-child {
            margin-right: 0;
        }
    </style>
</head>

<section class="navigation">
    <div class="brand">
        <i class="fa-solid fa-music" style="color: #ffffff;"></i>
        <a href="dasindex.php" id="ml">Music Library</a>
        <i class="fa-solid fa-headphones-simple" style="color: #ffffff;"></i>

        <ul class="nav-list">
            <li><a href="dasindex.php">Home</a></li>
            <li><a href="#">Upload</a></li>
        </ul>
    </div>
    <ul class="nav-list">
        <li><a href="#">Profile</a></li>
        <li><a href="./subpages/logout.php">Logout</a></li>
    </ul>
</section>