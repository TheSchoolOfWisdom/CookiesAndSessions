<?php require 'inc/head.php'; ?>
<?php require 'inc/data/products.php';?>
<section class="cookies container-fluid">
    <div class="row">

        <?php if (isset($_COOKIE['id_cookie']) && isset($_SESSION['nom'])) { ?>

        <section class="cookies container-fluid">

            <div class="row">

                <?php foreach ($_COOKIE['id_cookie'] as $key => $value) { ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <figure class="thumbnail text-center">
                            <img src="assets/img/product-<?= $key ?>.jpg" alt="Pecan nuts" class="img-responsive">
                            <figcaption class="caption">
                                <h3><?= $catalog[$key]['name']; ?></h3>
                                <p><?= $catalog[$key]['description']; ?></p>

                                <div class="btn-group" role="group" aria-label="...">
                                    <a href="?remove_from_cart=<?= $key ?>" class="btn btn-danger btn-number"><span class="glyphicon glyphicon-menu-left"></span></a>
                                    <span class="btn btn-default"><?= $value ?></span>
                                    <a href="?add_to_cart=<?= $key ?>" class="btn btn-success btn-number"><span class="glyphicon glyphicon-menu-right"></span></a>
                                </div>

                                <br><br>

                                <a href="?delete_cookie=<?= $key ?>" class="btn btn-info">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete from cart
                                </a>
                            </figcaption>
                        </figure>
                    </div>
                <?php } ?>

            </div>

        </section>

        <?php } elseif (!isset($_SESSION['nom'])) { ?>

            <h3 style="text-align: center">Your have to sign in for add cookies to cart!</h3>

        <?php } else { ?>

            <h3 style="text-align: center">Your cart is empty!</h3>

        <?php } ?>

    </div>
</section>
<?php require 'inc/foot.php'; ?>