<?php
/** @var $model \aplikace\models\Pojistnik */
?>
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto my-auto">
            <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                <div class="card-img-left d-none d-md-flex">
                    <!-- Background image for card set in CSS! -->
                </div>
                <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title text-center mb-5 fw-light fs-2">Registrace</h5>
                    <?php $formular = \aplikace\core\formulare\Formular::zacatek('', 'post') ?>
                    <div class="form-group row">
                        <div class="form-floating col mb-3">
                        <?php echo $formular->pole($model, 'jmeno')->poleTextu() ?>
                        </div>
                        <div class="form-floating col mb-3">
                        <?php echo $formular->pole($model, 'prijmeni')->poleTextu() ?>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <?php echo $formular->pole($model, 'email')->poleEmailu() ?>
                    </div>
                    <div class="form-floating mb-3">
                        <?php echo $formular->pole($model, 'ulice') ?>
                    </div>
                    <div class="form-group row">
                        <div class="form-floating col mb-3">
                        <?php echo $formular->pole($model, 'mesto')->smisenePole() ?>
                        </div>
                        <div class="form-floating col mb-3">
                        <?php echo $formular->pole($model, 'psc') ?>
                        </div>
                    </div>
                    <div class="form-floating tel mb-3">
                        <?php echo $formular->pole($model, 'tel')->poleTelefonu() ?>
                    </div>
                    <div class="form-floating  mb-3">
                        <?php echo $formular->pole($model, 'heslo')->poleHesla() ?>
                    </div>
                    <div class="form-floating  mb-3">
                        <?php echo $formular->pole($model, 'hesloZnovu')->poleHesla() ?>
                    </div>
                    <div class="d-grid mb-2">
                        <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Registrovat</button>
                    </div>
                    <hr class="my-4">
                    <a class="d-block text-center mt-2 small" href="/prihlaseni">Již máte účet? Přihlašte se</a>
                    <?php \aplikace\core\formulare\Formular::konec() ?>
                   <!-- <form action="" method="post">
                        <div class="form-group row">
                            <div class="form-floating col mb-3">
                                <input type="text" name="firstname" class="form-control ml-2" id="floatingInputFirstname" placeholder="Jméno" autofocus>
                                <label for="floatingInputFirstname" class="ml-2">Jméno</label>
                            </div>
                            <div class="form-floating col mb-3">
                                <input type="text" name="lastname" class="form-control" id="floatingInputLastname" placeholder="Příjmení">
                                <label for="floatingInputLastname">Příjmení</label>
                            </div>
                        </div>
                        <div class="form-floating col mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInputEmail" placeholder="name@example.com">
                            <label for="floatingInputEmail">Emailová adresa</label>
                        </div>
                        <hr>
                        <div class="form-floating col mb-3">
                            <input type="text" name="street" class="form-control ml-2" id="floatingInputStreet" placeholder="Ulice a č. p.">
                            <label for="floatingInputStreet" class="ml-2">Ulice a č. p.</label>
                        </div>
                        <div class="form-group row">
                            <div class="form-floating col mb-3">
                                <input type="text" name="city" class="form-control ml-2" id="floatingInputCity" placeholder="Město">
                                <label for="floatingInputCity" class="ml-2">Město</label>
                            </div>
                            <div class="form-floating col mb-3">
                                <input type="text" name="postal" class="form-control" id="floatingInputPostal" placeholder="PSČ">
                                <label for="floatingInputPostal">PSČ</label>
                            </div>
                        </div>
                        <div class="form-floating col tel mb-3 d-flex">
                            <span class="input-group-text">+420</span>
                            <input type="tel" name="tel" class="form-control ml-2" id="floatingInputTel" placeholder="Telefon">
                            <label for="floatingInputTel" class="ml-2">Telefon</label>
                        </div>
                        <hr>
                        <div class="form-floating col mb-3">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Heslo</label>
                        </div>

                        <div class="form-floating col mb-3">
                            <input type="password" name="passwordConfirm" class="form-control" id="floatingPasswordConfirm" placeholder="Confirm Password">
                            <label for="floatingPasswordConfirm">Zadejte heslo znovu</label>
                        </div>

                        <div class="d-grid mb-2">
                            <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Registrovat</button>
                        </div>
                        <hr class="my-4">
                        <a class="d-block text-center mt-2 small" href="/prihlaseni">Již máte účet? Přihlašte se</a>
                    </form> -->
                </div>
            </div>
        </div>
    </div>
</div>
