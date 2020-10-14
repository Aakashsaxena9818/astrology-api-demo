<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Thirumana Porutham | Prokerala API</title>

    <link rel="stylesheet" href="/build/style.css">

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
                        <span class="font-weight-thin">Thirumana Porutham</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container demo-container">
        <?php if (!empty($result)): ?>
            <h3 class="text-black text-center">Porutham Result</h3>
            <table class="mb-5 table table-bordered">

                <?php if ('advanced' === $result_type):?>
                    <tr>
                        <th>#</th>
                        <th>Porutham</th>
                        <th>Status</th>
                        <th>Obtained Point</th>
                    </tr>
                    <?php $count = 1; ?>
                    <?php foreach ($compatibilityResult['porutham'] as $key => $data):?>
                        <tr><td><?=$count++?></td><td><?=ucwords($key)?></td><td><?=$data['hasPorutham'] ? 1 : 0?></td><td><?=$data['point']?></td></tr>
                    <?php endforeach; ?>
                <?php endif; ?>

                <tr>
                    <th colspan="2"></th>
                    <th>Maximum Point</th>
                    <th>Obtained Point</th>
                </tr>
                <tr>
                    <td colspan="2">Total Points</td>
                    <td><?=$compatibilityResult['maximumPoint']?></td>
                    <td><?=$compatibilityResult['ObtainedPoint']?></td>
                </tr>
            </table>

            <?php if ('advanced' === $result_type):?>
                <?php foreach ($compatibilityResult['porutham'] as $key => $data):?>
                    <h3><?=ucwords($key)?></h3>
                    <p><?=$data['description']?></p>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php elseif (!empty($errors)):?>
            <?php foreach ($errors as $error):?>
                <div class="alert alert-danger text-small">
                    <?=$error->title; ?>:
                    <?=$error->detail?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <section>

            <div class="card contact-form-wrapper box-shadow mx-auto rounded-2 mb-5">
                <form class="p-5 text-default"  action="" method="POST">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <legend class="col-form-label text-black py-4 text-xlarge">Enter Girl's Details</legend>
                            <div class="form-group row">
                                <label class="col-sm-3 col-md-4 col-form-label  text-md-right text-xs-left">Girl Nakshatra</label>
                                <div class="col-sm-9 col-md-6">
                                    <select name="girl_nakshatra" class="form-control form-control-lg rounded-1">
                                        <?php foreach ($nakshatraList as $nakshatraId => $nakshatra):?>
                                            <option value="<?=$nakshatraId?>" <?= $nakshatraId === $girl_nakshatra ? 'selected' : ''?>><?=$nakshatra?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-md-4 col-form-label  text-md-right text-xs-left">Girl Nakshatra Pada</label>
                                <div class="col-sm-9 col-md-6">
                                    <select name="girl_nakshatra_pada" class="form-control form-control-lg rounded-1">
                                        <?php foreach ($nakshatraPadaList as $nakshatraPadaId => $nakshatraPada):?>
                                            <option value="<?=$nakshatraPadaId?>" <?= $nakshatraPadaId === $girl_nakshatra_pada ? 'selected' : ''?>><?=$nakshatraPada?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <legend class="col-form-label text-black py-4 text-xlarge">Enter Boy's Details</legend>
                            <div class="form-group row">
                                <label class="col-sm-3 col-md-4 col-form-label  text-md-right text-xs-left">Boy Nakshatra</label>
                                <div class="col-sm-9 col-md-6">
                                    <select name="boy_nakshatra" class="form-control form-control-lg rounded-1">
                                        <?php foreach ($nakshatraList as $nakshatraId => $nakshatra):?>
                                            <option value="<?=$nakshatraId?>" <?= $nakshatraId === $boy_nakshatra ? 'selected' : ''?>><?=$nakshatra?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-md-4 col-form-label  text-md-right text-xs-left">Girl Nakshatra Pada</label>
                                <div class="col-sm-9 col-md-6">
                                    <select name="boy_nakshatra_pada" class="form-control form-control-lg rounded-1">
                                        <?php foreach ($nakshatraPadaList as $nakshatraPadaId => $nakshatraPada):?>
                                            <option value="<?=$nakshatraPadaId?>" <?= $nakshatraPadaId === $boy_nakshatra_pada ? 'selected' : ''?>><?=$nakshatraPada?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-md-4 col-form-label  text-md-right text-xs-left">Result Type: </label>
                        <div class="col-sm-9 col-md-6 ">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="result_type" id="result_type1" value="basic" <?='basic' === $result_type ? 'checked' : ''?>>
                                <label class="form-check-label" for="result_type1">Basic</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="result_type" id="result_type2" value="advanced" <?='advanced' === $result_type ? 'checked' : ''?>>
                                <label class="form-check-label" for="result_type2">Advanced</label>
                            </div>
                        </div>
                    </div>
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
