<?php
/**
 * User: JointSeeker
 * Date: 4/1/2023
 */

use aplikace\core\Aplikace;

//$this->title = 'Profil';
?>

<div class="row justify-content-center">
    <section class="about-profile row">
        <div class="row align-self-center justify-content-center">

                <img src="img/klient.png" class="user-img mx-5 shadow my-3 img-thumbnail col-auto">

            <div class="col-auto">
                <h2><?php echo htmlentities(Aplikace::$aplikace->pojistnik->ziskejJmenoProfilu()); ?></h2>
                <hr>
                <div class="attributes row">
                    <div class="address col-auto">
                        <p><?php echo htmlentities(Aplikace::$aplikace->pojistnik->ziskejUlici()); ?></p>
                        <p><?php echo htmlentities(Aplikace::$aplikace->pojistnik->ziskejMesto()); ?></p>
                        <p><?php echo htmlentities(Aplikace::$aplikace->pojistnik->ziskejPSC()); ?></p>
                    </div>
                    <div class="contact col-auto">
                        <p><?php echo htmlentities(Aplikace::$aplikace->pojistnik->ziskejEmail()); ?></p>
                        <p><?php echo htmlentities(Aplikace::$aplikace->pojistnik->ziskejTelefon()); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="w-100"></div>
    <section class="my-5 mx-5 col-auto align-self-center">
        <h3 class="text-center">Sjednaná pojištění</h3>
        <table class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Pojištění</th>
                        <th scope="col">Částka</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a>Pojištění majetku</a></td>
                        <td>10000000 Kč</td>
                    </tr>
                    <tr>
                        <td class="bg-transparent border-0">
                            <a type="button" class="btn shadow btn-danger">Odstranit</a>
                            <a type="button" class="btn shadow btn-warning">Editovat</a>
                        </td>
                    </tr>
                </tbody>
            </table>
    </section>
    <div class="w-100"></div>
    <section class="update my-5 mx-5 row justify-content-center">
        <a type="button" class="btn shadow col-auto mx-2 my-2 btn-info">Přidat pojištění</a>
        <a type="button" href="/pojistenci" class="btn shadow col-auto mx-2 my-2 btn-warning">Editovat pojištěnce</a>
        <a type="button" class="btn shadow col-auto mx-2 my-2 btn-danger">Odstranit pojištěnce</a>
    </section>
</div>