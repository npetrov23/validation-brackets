<?include "vendor/db.php"; 

// Db::get_instance()->create_table("bracket_info", 
//     [
//     "id" => ["type" => Db::T_INT, "null" => Db::T_NOT_NULL, "primary" => Db::T_PRIMARY_KEY, "a_i" => Db::A_I], 
//     "value" => ["type" => Db::T_VARCHAR, "null" => Db::T_NULL], 
//     "success" => ["type" => Db::T_VARCHAR, "null" => Db::T_NULL],
//     ]
// );

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Валидация скобок</title>
</head>
<body>
    <div class="container">
        <div class="brackets">
            <input type="text" class="form-control bracket_input" placeholder="Введите выражение со скобками" aria-label="Username" aria-describedby="addon-wrapping">
            <input type="submit" class="button btn btn-primary">
        </div>
        <div class="answer"></div>
        <div class="warning"></div>
        <div class="history">
            <?$history = Db::get_instance()->select("bracket_info");?>
            <table class="table table-bordered">
            <thead>            
                <tr>
                    <th scope="col">Выражение</th>
                    <th scope="col" >Результат</th>
                </tr>
            </thead>
                <tbody class="test">
                <?while ($row = $history->fetch(PDO::FETCH_LAZY)) {?>
                    <tr>
                        <td><?=$row['value']?></td>
                        <td><?=$row['success'] ? "true" : "false"?></td>
                    </tr>
                <?}?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="static/js/ajax.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>