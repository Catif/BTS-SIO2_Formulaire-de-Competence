<?php
$req = $db->query('SELECT * FROM projet 
INNER JOIN realiser ON realiser.ID_PROJET = projet.ID_PROJET 
WHERE realiser.IDENTIFIANT_ETUD = :idEtud', [
    ':idEtud' => $_SESSION['user-id']
]);
$tabProjet = $req->fetchAll();
?>

<?php createAlert($alert) ?>

<h1 class="title">Liste de vos projets :</h1>


<?php if(!empty($tabProjet)): ?>


    <table class="skills">
        <thead>
            <tr>
                <th>Nom du projet</th>
                <th>Date d'ajout</th>
                <th>Modifier</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($tabProjet as $k => $projet): ?>
                <?php 
                    $projet['CREATED_AT'] = new DateTime($projet['CREATED_AT']);
                    $projet['CREATED_AT_FORMATED'] = date('d/m/Y', $projet['CREATED_AT']->getTimestamp());
                ?>

                <tr id="Project-<?= $projet['ID_PROJET'] ?>">
                    <td class="text-center"><b><?= $projet['LIBEL_PROJET'] ?></b></td>
                    <td class="text-center"><?= $projet['CREATED_AT_FORMATED'] ?></td>
                    <td class="text-center">
                        <a href="<?= HTML_ROOT ?>/panel/project/edit/<?= $projet['ID_PROJET'] ?>" class="btn btn-secondary btn-table">
                            <span class="iconify" data-icon="fa6-solid:pen-to-square"></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


<?php else: ?>
    <p class="text-center">Vous n'avez ajouté aucun projet.</p>
    <a class="btn btn-primary" href="<?= HTML_ROOT ?>/panel/project/create">Ajouter un projet</a>
<?php endif; ?>