<?php
$settings = require_once '../settings.php';
use Yandex\Metrika\MetrikaClient;
use Yandex\Common\Exception\ForbiddenException;

$errorMessage = false;

$isAuth = isset($_COOKIE['yaAccessToken']);
// Is auth
if ($isAuth) {
    $metrika = new MetrikaClient($_COOKIE['yaAccessToken']);

    try {
        $counters = $metrika->getCounterList();
    } catch (ForbiddenException $ex) {
        $errorMessage = $ex->getMessage();
        $errorMessage .= '<p>Возможно, у приложения нет прав на доступ к ресурсу. Попробуйте '
            . '<a href="/examples/OAuth/">авторизироваться</a> и повторить.</p>';

    } catch (Exception $ex) {
        $errorMessage = $ex->getMessage();
    }
}
?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Yandex PHP Library: Metrika Demo</title>
    <link rel="stylesheet" href="//yandex.st/bootstrap/3.0.0/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="/examples/Disk/css/style.css">
</head>
<body>
<div class="container">
    <div class="jumbotron">
        <h2><span class="glyphicon glyphicon-signal"></span> Пример работы с Яндекс Метрикой</h2>
    </div>
    <?php if (!$isAuth) :
        ?>
        <div class="alert alert-info">
            Для просмотра этой страници вам необходимо авторизироваться.
            <a id="goToAuth" href="/examples/OAuth/" class="alert-link">Перейти на страницу авторизации</a>.
        </div>
    <?php elseif ($errorMessage): ?>
        <div class="alert alert-danger">
            <?= $errorMessage ?>
        </div>
    <?php elseif (isset($metrika, $counters)): ?>
        <div class="col-md-8">
            <h2>Счетчики пользователя</h2>
            <h3>Запрос:</h3>
            <p>
                <a href="http://api.yandex.ru/metrika/doc/ref/reference/get-counter-list.xml">
                    GET /counters
                </a>
            </p>

            <h3>Ответ:</h3>
            <?php
                echo '<pre>';
                print_r($counters);
                echo '</pre>';

                $firstCounter = array_shift($counters['counters']);
                $trafficSummary = $metrika->getStat('traffic/summary', $firstCounter['id'])
            ?>

            <h2>Отчет посещаемости для счетчика "<?php echo $firstCounter["name"]; ?>"</h2>
            <h3>Запрос:</h3>
            <p>
                <a href="http://api.yandex.ru/metrika/doc/ref/stat/traffic-summary.xml">
                    GET stat/traffic/summary?id=<?php echo $firstCounter['id']; ?>
                </a>
            </p>

            <h3>Ответ:</h3>
            <pre>
                <?php print_r($trafficSummary); ?>
            </pre>
        </div>
    <?php
    endif;
    ?>
</div>
<script src="http://yandex.st/jquery/2.0.3/jquery.min.js"></script>
<script src="http://yandex.st/jquery/cookie/1.0/jquery.cookie.min.js"></script>
<script>
    $(function () {
        $('#goToAuth').click(function (e) {
            $.cookie('back', location.href, { expires: 256, path: '/' });
        });
    });
</script>
</body>
</html>