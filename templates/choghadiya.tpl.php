<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Choghadiya | Prokerala API</title>

    <link rel="stylesheet" href="/build/style.css">
    <style>
        .table>tbody>tr>th,
        .table>tbody>tr>td {
            height: 50px;
            border: 1px solid #fff;
        }
    </style>
</head>

<body>
<?php include 'common/header.tpl.php'; ?>

<div class="main-content">
    <div class="header-1 section-rotate bg-section-secondary">
        <div class="section-inner bg-gradient-violet section-radius-min">
        </div>
        <div class="container top-header-wrapper">
            <div class="row my-auto">
                <div class="col-xl-6 col-lg-7 col-md-12 col-sm-12 text-lg-left top-header-text-content">
                    <h2 class="text-white mb-5">
                        <span class="font-weight-thin">Choghadiya</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container demo-container">
        <?php if (!empty($result)): ?>
        <div class="row">
            <?php foreach ($choghadiyaResult as $type => $choghadiya): ?>
            <div class="col-12 col-md-6">
                <table class="table table-bordered text-small border-white" style="margin-right: 10px">
                    <tr class="bg-secondary text-white">
                        <th colspan="4" class="text-center"><?= ($type ? 'Day' : 'Night')?> Choghadiya</th>
                    </tr>
                    <tr><th>Name</th><th>Type</th><th>Start</th><th>End</th></tr>

                <?php foreach ($choghadiya as $data):?>
                    <tr class="<?= 'Good' === $data['type'] ? 'table-warning' : ('Inauspicious' === $data['type'] ? 'table-danger' : 'table-success')?>">
                        <td><?=$data['name']?><br><i><?= $data['vela'] ?: ''?></i></td>
                        <td><?= $data['type']?></td>
                        <td><?= $data['start']->format('h:i:A')?></td>
                        <td><?= $data['end']->format('h:i:A')?></td>
                    </tr>

                <?php endforeach; ?>
                </table>
            </div>
            <?php endforeach?>

        </div>

        <?php elseif (!empty($errors)) : ?>
            <?php foreach ($errors as $key => $error):?>
                <div class="alert alert-danger text-small">
                    <?php if ('message' === $key):?>
                        <?=$error?>
                    <?php else:?>
                        <?=$error->title ?? ''; ?>:
                        <?=$error->detail ?? ''?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
            <section>
                <div class="card contact-form-wrapper box-shadow mx-auto rounded-2 mb-5">
                    <form class="p-5 text-default"  action="choghadiya.php" method="POST">
                        <?php include 'common/basic-form.tpl.php'; ?>
                        <div class="text-right">
                            <button type="submit" class="btn btn-warning">Get Result</button>
                            <input type="hidden" name="submit" value="1">
                        </div>
                    </form>
                </div>
            </section>

    </div>
</div>


<?php include 'common/footer.tpl.php'; ?>

</body>
</html>
