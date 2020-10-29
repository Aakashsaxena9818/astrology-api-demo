<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Birth Charts | Astrology API Demo - Prokerala Astrology</title>

    <link rel="stylesheet" href="/build/style.css">

</head>

<body>
<?php include 'common/header.tpl.php'; ?>

<div class="main-content">
    <div class="header-1 mb-0 section-rotate bg-section-secondary">
        <div class="section-inner bg-gradient-violet section-radius-min">
        </div>
        <div class="container top-header-wrapper">
            <div class="row my-auto">
                <div class="col-xl-6 col-lg-7 col-md-12 col-sm-12 text-lg-left top-header-text-content">
                    <h2 class="text-white mb-5">
                        <span class="font-weight-thin">Charts</span>
                    </h2>
                    <p class="text-white">An astrological chart shows the position of the sun, the moon and other planets at the exact time of a person's birth at a particular place on earth. <a class="text-warning" href="https://www.prokerala.com/astrology/birth-chart/" target="_blank">Read More..</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container demo-container">

        <?php include 'common/helper.tpl.php'; ?>
        <?php if (!empty($result)): ?>
            <div class="row">
                <div class="text-center m-auto col-12 overflow-auto">
                    <h3><?=ucwords($chart_type) . ' Chart'?></h3>
                    <?php echo $result; ?>
                </div>
            </div>
        <?php endif; ?>
        <section>
            <div class="card contact-form-wrapper box-shadow mx-auto rounded-2 mb-5">
                <form class="p-5 text-default"  action="chart.php" method="POST">
                    <?php include 'common/basic-form.tpl.php'; ?>
                    <div class="form-group row">
                        <label class="col-sm-3 col-md-4 col-form-label  text-md-right text-xs-left">Chart Type</label>
                        <div class="col-sm-9 col-md-6">
                            <select name="chart_type" class="form-control form-control-lg rounded-1">
                                <?php foreach ($arChartType as $chart):?>
                                    <option value="<?=$chart?>" <?= $chart === $chart_type ? 'selected' : ''?>><?= ucwords($chart)?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-md-4 col-form-label  text-md-right text-xs-left">Chart Style</label>
                        <div class="col-sm-9 col-md-6">
                            <select name="chart_style" class="form-control form-control-lg rounded-1">
                                <option value="south-indian" <?='south-indian' === $chart_style ? 'selected' : ''?>>South Indian</option>
                                <option value="north-indian" <?='north-indian' === $chart_style ? 'selected' : ''?>>North Indian</option>
                                <option value="east-indian" <?='east-indian' === $chart_style ? 'selected' : ''?>>East Indian</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-warning">Get Result</button>
                        <input type="hidden" name="submit" value="1">
                    </div>
                </form>
            </div>
        </section>
        <?php include 'common/calculator-list.tpl.php'; ?>
    </div>
</div>


<?php include 'common/footer.tpl.php'; ?>

</body>
</html>
