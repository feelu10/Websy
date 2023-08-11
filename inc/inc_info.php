<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #F0F0F0;
        }
        h2, p ,h1{
            color: #fff;
        }
        ul {
            list-style: none;
            padding: 0;
            background-color: wheat;
        }
        ul li {
            background: #FFF;
            padding: 10px;
            width: 20%;
            margin: 0 auto 10px auto;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            color:black;
        }
        table{
            border-radius: 8px;
        }

    </style>
</head>
<body>
    <h2>PHP Version:</h2>
    <p><?php echo PHP_VERSION; ?></p>
    <h2>Loaded Extensions:</h2>
    <ul>
        <?php foreach(get_loaded_extensions() as $extension) : ?>
        <li><?php echo $extension; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
