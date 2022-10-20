<?php
require "vendor/autoload.php";

use GuzzleHttp\Client;

function getBooks() {
    $token = 'bc54db77e94fc1d5dd80daf129c75c3b2b3eb24bf61fa1db8b08b5faa926af890dac311a6ab543c2144ee43cf147defd1edb926f378d3d0cfd8c875e3bdc7ce1805bc59c3ae72a7d50be13b984a8373dc24c28492529bab83971308d572adc2bd3b8d84f2ccfb28538307567b5a0e33a797bc674c2a6ea4cd3d2f6a0d8ec83e4';

    try {
        $client = new Client([
            'base_uri' => 'http://localhost:1337/api/'
        ]);
    
        $headers = [
          'Authorization' => 'Bearer ' . $token,        
          'Accept'        => 'application/json',
      ];
  
      $response = $client->request('GET', 'books?pagination[pageSize]=66', [
          'headers' => $headers
      ]);
    
        $body = $response->getBody();
        $decoded_response = json_decode($body);
        return $decoded_response;
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo '<pre>';
        var_dump($e);
    }
    return null; 
}

$books = getBooks();
?>

<html>
    <head>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>BOOKS IN THE BIBLE</title>
    </head>
    <body style="background-color:black">
        <div class = "container">
            <h1 style = "padding-bottom: 20px; color:white"> <center> <marquee> SCRIPTURE BOOK LIST</h1> </center> </marquee>
            <div class = "row">
                <div class = "col-10">
                    <table class="table table-hover table-dark">
                        <tr class="table-danger">
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Category</th>
                        </tr>
                        <?php
                            foreach($books->data as $bookData) {
                            $book = $bookData->attributes;
                        ?>
                        <tr>
                            <th scope="row"><?php echo $bookData->id; ?></td>
                            <td><?php echo $book->name; ?></td>
                            <td><?php echo $book->author; ?></td>
                            <td><?php echo $book->category; ?></td>
                        </tr>
                        
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>