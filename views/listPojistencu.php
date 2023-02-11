<?php foreach (Aplikace::$aplikace->pojistenci as $pojistenec):?>
<div class="row justify-content-center align-items-center pojistnik">
    <section class="about-profile col-auto">
        <div class="row align-self-center justify-content-center">

            <img src="img/klient.png" class="user-img mx-5 shadow my-3 img-thumbnail col-auto">

            <div class="col-auto">
                <h2><?php echo htmlentities($pojistenec->ziskejJmenoProfilu()); ?></h2>
                <hr>
                <div class="attributes row">
                    <div class="address col-auto">
                        <p><?php echo htmlentities($pojistenec->ziskejUlici()); ?></p>
                        <p><?php echo htmlentities($pojistenec->ziskejMesto()); ?></p>
                        <p><?php echo htmlentities($pojistenec->ziskejPSC()); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                <td class="bg-transparent border-0">
                    <a href="#" class="btn shadow btn-danger">Odstranit</a>
                    <a href="#" class="btn shadow btn-warning">Editovat</a>
                </td>
            </tr>
            <tr>
                <td><a>Pojištění majetku</a></td>
                <td>10000000 Kč</td>
                <td class="bg-transparent border-0">
                    <a href="#" class="btn shadow btn-danger">Odstranit</a>
                    <a href="#" class="btn shadow btn-warning">Editovat</a>
                </td>
            </tr>
            <tr>
                <td><a>Pojištění majetku</a></td>
                <td>10000000 Kč</td>
                <td class="bg-transparent border-0">
                    <a href="#" class="btn shadow btn-danger">Odstranit</a>
                    <a href="#" class="btn shadow btn-warning">Editovat</a>
                </td>
            </tr>
            <tr>
                <td><a>Pojištění majetku</a></td>
                <td>10000000 Kč</td>
                <td class="bg-transparent border-0">
                    <a href="#" class="btn shadow btn-danger">Odstranit</a>
                    <a href="#" class="btn shadow btn-warning">Editovat</a>
                </td>
            </tr>
            </tbody>
        </table>
    </section>
</div>
<?php endforeach; ?>