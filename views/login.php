<!doctype html>
<html class="no-js" lang="">
<head>
    <?php require __DIR__ . '/partials/head.php' ?>
</head>
<body>
<div class="container">
    <?php require __DIR__ . '/partials/nav-bar.php' ?>
    <?php require __DIR__ . '/partials/flash-message.php' ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Login</h3>
        </div>
        <div class="panel-body">
            <form method="post" action="/login">
                <div class="form-group">
                    <label class="control-label">Username</label>
                    <input type="text" class="form-control" name="username">
                </div>

                <div class="form-group">
                    <label class="control-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/partials/tail.php' ?>
</body>
</html>
