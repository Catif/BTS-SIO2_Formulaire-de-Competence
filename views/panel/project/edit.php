<?php
$req = $db->query(
'SELECT * FROM projet 
INNER JOIN realiser ON realiser.ID_PROJET = projet.ID_PROJET 
WHERE realiser.IDENTIFIANT_ETUD = :idEtud AND realiser.ID_PROJET = :idProjet
', [
    ':idProjet' => $match['params']['id'],
    ':idEtud' => $_SESSION['user-id']
]);
$project = $req->fetch();

if(empty($project)){
    header('Location:' . HTML_ROOT . '/panel/project/list?alerte=notFound');
    die();
}



$req = $db->query('SELECT * FROM item_savoir');
$tabSavoir = $req->fetchAll();

$req = $db->query('SELECT * FROM item_indicateur');
$tabIndicateur = $req->fetchAll();
?>







<?php createAlert($alert) ?>

<h1 class="title">Modification d'un projet</h1>

<form id="edit-project" action="" method="POST">
    <input name="name-Project" type="text" placeholder="Nom du Projet" value="<?= $project['LIBEL_PROJET'] ?>" minlength="3" maxlength="40" required>

    <p class="text-center mt-20">
        Avant de cliquer sur <u>Modifier le projet</u>,<br> vous devez d'abord avoir au moins <u>un Savoir</u> et <u>un Indicateurs</u> de sélectionné dans votre projet.
    </p>
    <div class="list-button">
        <button type="button" class="btn btn-secondary" onClick="openModal('modal-Savoir')">Savoirs</button>
        <button type="button" class="btn btn-secondary" onClick="openModal('modal-Indicateur')">Indicateurs</button>
    </div>





    <div id="modal-Savoir" class="modal">
        <h2 class="text-center">Savoir</h2>
        <div class="overflow">
            <table class="skills">
                <thead>
                    <tr>
                        <th>Identifiant</th>
                        <th>Libelé</th>
                        <th class="checkbox">Mobiliser</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tabSavoir as $k => $savoir): ?>
                        <tr>
                            <td class="text-center"><?= $savoir['N_ITEM_SAVOIR'] ?></td>
                            <td><?= $savoir['LIBEL_ITEM'] ?></td>
                            <td class="checkbox">
                                <input name="Savoir/<?= $savoir['N_ITEM_SAVOIR'] ?>" type="checkbox" <?= isset($savoir['']) ? 'checked' : '' ?>>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-primary btn-modal" onClick="closeModal()">Sauvegarder les Savoirs</button>
    </div>



    <div id="modal-Indicateur" class="modal">

        <h2 class="text-center">Indicateur</h2>
        <div class="overflow">
            <table class="skills">
                <thead>
                    <tr>
                        <th>Identifiant</th>
                        <th>Libelé</th>
                        <th class="checkbox">Indicateur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tabIndicateur as $k => $indicateur): ?>
                        <tr>
                            <td class="text-center"><?= $indicateur['N_ITEM_INDICATEUR'] ?></td>
                            <td><?= $indicateur['LIBEL_ITEM'] ?></td>
                            <td class="checkbox">
                                <input name="Indicateur/<?= $indicateur['N_ITEM_INDICATEUR'] ?>" type="checkbox" <?= isset($savoir['']) ? 'checked' : '' ?>>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-primary btn-modal" onClick="closeModal()">Sauvegarder les indicateurs</button>
    </div>

    <input type="hidden" name="action" value="edit">
    <input type="hidden" name="project" value="<?= $match['params']['id'] ?>">

    <button type="submit" class="btn btn-primary">Modifier le projet</button>
</form>
<form id="delete-project" action="" method="POST">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="project" value="<?= $match['params']['id'] ?>">

    <button type="submit" class="btn btn-danger">Supprimer le projet</button>
</form>

<div id="modal-shadow" onClick="closeModal()"></div>
