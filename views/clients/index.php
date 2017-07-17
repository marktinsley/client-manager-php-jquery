<!doctype html>
<html class="no-js" lang="">
<head>
    <?php require __DIR__ . '/../partials/head.php' ?>
</head>
<body>
<div class="container">
    <?php require __DIR__ . '/../partials/nav-bar.php' ?>
    <?php require __DIR__ . '/../partials/flash-message.php' ?>

    <div class="row clients-list-container">
        <div class="col-sm-12">
            <div class="progress loading" style="display: none;">
                <div class="progress-bar progress-bar-striped active"
                     role="progressbar"
                     aria-valuenow="100"
                     aria-valuemin="0"
                     aria-valuemax="100"
                     style="width: 100%"
                ></div>
            </div>

            <div class="panel panel-default filter-container">
                <div class="panel-heading">Filter</div>
                <div class="panel-body">
                    <form class="form-inline">
                        <div class="form-group">
                            <label>Id</label>
                            <input type="text" class="form-control id">
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control name">
                        </div>

                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-filter"></span>
                            Filter
                        </button>
                        <a href="/clients" class="btn btn-default">
                            <span class="glyphicon glyphicon-ban-circle"></span>
                            Reset
                        </a>
                    </form>
                </div>
            </div>

            <div class="alert alert-warning not-found-message">
                No clients found.
            </div>

            <table class="table list">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/tail.php' ?>
<script src="/static/js/clients.js"></script>
</body>
</html>
