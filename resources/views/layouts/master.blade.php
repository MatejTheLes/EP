<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/app.css') }}" >

    @yield('styles')
</head>
<body>
<?php
    /*

if(DB::connection()->getDatabaseName())
{
    echo "Yes! successfully connected to the DB: " . DB::connection()->getDatabaseName();

    try {
        // localhost/netbeans/sale
        // nastavitve za povezavo do PB
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_PERSISTENT => true,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        );

        // objekt PDO


        $db = new PDO("mysql:host=localhost;dbname=bookstoreDB", "root", "ep", $options);

        # priprava poizvedbe SQL
        $statement = $db->prepare("SELECT * FROM KNJIGA");

        // izvedba poizvedbe
        $statement->execute();

        // zapis rezultata poizvedbe v spremenljivko
        $allJokes = $statement->fetchAll();

        // Rezultat ,ki ga vrne PDO, lahko vidimo, če odkomentiramo spodnjo vrstico
        var_dump($allJokes);
        // exit();
    } catch (PDOException $e) {
        echo "Prišlo je do napake: {$e->getMessage()}";
        exit();
    }



}
*/
?>
@include('partials.header')

<div class="container-fluid" >
    @yield('content')
</div>

<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>


@yield('scripts')

</body>
</html>
