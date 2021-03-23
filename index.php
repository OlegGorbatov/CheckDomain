<?php
    include ("libraries/d_validation.php");
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8" />
        <meta name="title" content="Проверка вхождения домена А в домен B" />
        <title>Проверка вхождения домена А в домен B</title>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <style type="text/css">
            .none {
                display: none;
            }
            .mess {
                margin: 25px 15px 25px 15px;
                text-align: center;
                font-weight: bold;
            }
            .inpForm {
                margin-top: 30px;
                padding-left: 15px;
                padding-right: 15px;
            }
        </style>
    </head>


    <body style="margin-left: 50px; margin-right: 50px;">
    <div class="container-fluid">
        <h3>Задание:</h3>
        <p>Напишите на PHP функцию, определяющую, входит ли доменное имя A в домен,
            идентифицируемый доменным именем B в соответствии с RFC 1034 (DNS):</p>
        <p>A domain is identified by a domain name, and consists of that part of the domain name space that is at or
        below the domain name which specifies the domain.
            https://tools.ietf.org/html/rfc1034</p>
        <p>Например, доменные имена x.foo.com, x.y.foo.com и foo.com входят в домен foo.com, а
        доменные имена bar.com и x.baz.com не входят.
        Считать, что в функцию всегда передаются валидные доменные имена относительно корневого
        домена. Формат входных и выходных данных свободный. </p>
    </div>

    <?php
    if (isset($_POST['mainDomain']) AND isset($_POST['subDomain'])) {
        $main = $_POST['mainDomain'];
        $sub = $_POST['subDomain'];
        $data = domainValidate($main, $sub);

        if (!empty($data['error'])) {
            $class = ' alert-danger';
            $message = $data['message'];
            //
        } elseif (isDomainApartB($sub, $main)) {
            $class = ' alert-success';
            $message = 'Домен ' . $sub . ' входит в домен, ' . $main;
        } else {
            $class = ' alert-secondary';
            $message = 'Домен ' . $sub . ' НЕ входит в домен, ' . $main;
        }
    } else {
        $class = 'none';
        $message = 'Ошибка отправки формы';
    }
    ?>

    <div class="mess alert <?= $class ?>" role="alert">
        <?= $message ?>
    </div>

    <form class="inpForm" action="index.php" method="post" >
        <h3>Решение:</h3>
        <div class="form-group" >
            <label for="mainDomainInput">Введите основной домен, проверка на вхождение в который будет осуществлена:</label>
            <input name="mainDomain" type="text" class="form-control" id="mainDomainInput" placeholder="Введите имя основного домена">
            <small id="emailHelp" class="form-text text-muted">Всегда передаётся валидное доменное имя</small>
        </div>
        <div class="form-group">
            <label for="subDomainInput">Password</label>
            <input name="subDomain" type="text" class="form-control" id="subDomainInput" placeholder="Введите имя проверяемого домена">
            <small id="emailHelp" class="form-text text-muted">Всегда передаются валидные доменные имена относительно корневого
                домена</small>
        </div>
        <button type="submit" class="btn btn-primary">Проверить</button>
    </form>

    </body>
</html>


