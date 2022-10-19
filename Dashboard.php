<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        table, th, td {
            border-bottom: 1px solid gray;
    }
    th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: black;
        color: white;
    }
    td{
        padding: 6px;
        text-align: center;
    }
    
    tr:hover {
        background-color: #ddd;
    }
    tr:nth-child(even){
        background-color: #f2f2f2;
    }
    table{
        width: 50%;
        margin-top: 15px;
    }
    body{
        display: flex;
        justify-content: center;
    }

    </style>
</head>
<body>

    <table>
            <tr >
                <th>id</th>
                <th>Name</th>
                <th>Pass</th>
            </tr>
    
        <?php
            include ("config.php");
            error_reporting(0);
            $query = "SELECT * FROM admins LIMIT 05"; 
            $query = "select * from admin";
            $data = mysqli_query($conn,$query);
            $total = mysqli_num_rows($data);
            // $numberPages=2;
            // $totalPages = ceil($total/$numberPages);
            // echo $totalPages;

            // // creating pagination button 
            // for($btn=1;$btn<=$totalPages;$btn++){
            //     echo ' <button class="btn btn-dark"><a href="paginatin.
            //     php?page='.$btn.'"></a></button>'
            // }

            // echo $result['id']." ".$result['Name']." ".$result['Pass'];
            // echo "$total";
            if($total!=0)
            {
                while($result=mysqli_fetch_assoc($data))
                {
                    echo "
                    <tr>
                        <td>".$result['id']."</td>
                        <td>".$result['Name']."</td>
                        <td>".$result['Pass']."</td> 
                    </tr>";
                }
            } else{
                echo "no record found";
            }

        ?>
  </table>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>
</html>