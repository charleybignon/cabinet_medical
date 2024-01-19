<?php
$title = "Page de connexion";
$bsIcons = true;
?>
<?php ob_start(); ?>

<div class="container">
    <?= App\Class\Feedback::getMessage() ?>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="sessions-tab" data-bs-toggle="tab" data-bs-target="#users"
                type="button" role="tab" aria-controls="sessions" aria-selected="true">Répartition usagers</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="eleves-tab" data-bs-toggle="tab" data-bs-target="#doctors" type="button"
                role="tab" aria-controls="eleves" aria-selected="false">Consultations par médecin</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="sessions-tab">
            <h2 class="my-5">Répartition des usagers selon leur sexe et leur âge</h2>
            <table class="table table-bordered border-dark">
                <tr>
                    <th></th>
                    <th class="text-center col-4">Homme</th>
                    <th class="text-center col-4">Femme</th>
                </tr>
                <tr>
                    <th class="text-center col-4">Moins de 25 ans</th>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                </tr>
                <tr>
                    <th class="text-center">Entre 25 et 50 ans</th>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                </tr>
                <tr>
                    <th class="text-center">Plus de 50 ans</th>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                </tr>
            </table>
        </div>
        <div class="tab-pane fade" id="doctors" role="tabpanel" aria-labelledby="eleves-tab">

            <table>
                <tr>
                    <th></th>
                    <th>Hom</th>
                    <th>Femme</th>
                </tr>
                <tr>
                    <th>Moins de 25 ans</td>
                    <td><?=htmlentities($MUnder25)?></td>
                    <td><?=htmlentities($WUnder25)?></td>
                </tr>
                <tr>
                    <th>Entre 25 et 50 ans</td>
                    <td><?=htmlentities($MBetween25_50)?></td>
                    <td><?=htmlentities($WBetween25_50)?></td>
                </tr>
                <tr>
                    <th>Plus de 50 ans</td>
                    <td><?=htmlentities($MOver50)?></td>
                    <td><?=htmlentities($WOver50)?></td>
                </tr>
            </table>
        </div>
    </div>
    
</div>

<?php 
$content = ob_get_clean();
require("../app/views/layout.php");
?>
