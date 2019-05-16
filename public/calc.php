<?php

require_once __DIR__ . '//../config/config.php';

echo "<pre>";
var_dump($_POST);
echo "</pre><hr>";

$result = '';

$num1 = isset($_POST['num1']) ? (int)$_POST['num1'] : '';
$num2 = isset($_POST['num2']) ? (int)$_POST['num2'] : '';
$operation = isset($_POST['operation']) ? $_POST['operation'] : '';

// $result = mathOperation(5, 0, 'div');
// Не выводится сообщение при делении на 0 при передаче параметров, 
// хотя при при прямом вызове функции все работает как задумано


if($num1&&$num2&&$operation){
    $result = mathOperation($num1, $num2, $operation);
}

var_dump ($result);

?>
<div class='result'>Ответ:<?= $result ?></div>
  <div>
    <h4>Калькулятор 1</h4>
    
    <form method="POST">

        <input type="number" name="num1"><br>
        <select name="operation">
            <option value='sum'>+</option>
            <option value='diff'>-</option>
            <option value='mult'>*</option>
            <option value='div'>/</option>
        </select>

        <input type="number" name="num2"><br>
        <input type="submit">
    </form>
</div>

<div>
    <h4>Калькулятор 2</h4>
    
    <form method="POST">

        <input type="number" name="num1"><br>
        <button name = 'operation' value='sum'>+</button>
        <button name = 'operation' value='diff'>-</button>
        <button name = 'operation' value='mult'>*</button>
        <button name = 'operation' value='div'>/</button>
        <input type="number" name="num2"><br>
        
    </form>
</div>