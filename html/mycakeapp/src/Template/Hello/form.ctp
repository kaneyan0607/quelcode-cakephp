<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
    <style>
        h1 {
            font-size: 48pt;
            margin: 0px 0px 10px 0px;
            padding: 0px 20px;
            color: white;
            background: linear-gradient(to right, #aaa, #fff);
        }

        p {
            font-size: 14pt;
            color: #666;
        }
    </style>
</head>

<body>
    <header class="row">
        <h1><?= h($title) ?></h1>
    </header>
    <div class="row">
        <p><?= h($message) ?></p>
    </div>
</body>

</html>
