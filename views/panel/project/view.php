<?php
$req = $db->query('SELECT * FROM projet');
$tabProjet = $req->fetchAll();

?>


<h1 class="title">Liste de vos projets :</h1>

<?php if(!empty($tabProjet)): ?>
    <table class="skills">
        <thead>
            <tr>
                <th>Nom du projet</th>
                <th>Savoir</th>
                <th>Indicateur</th>
                <th>Suppression</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($tabProjet as $k => $projet): ?>
                <tr id="Project-<?= $k ?>">
                    <td class="text-center"><?= $projet['LIBEL_PROJET'] ?></td>
                    <td class="text-center"><button type="button" class="btn btn-secondary" onClick="openModal('modal-Savoir')">Savoirs</button></td>
                    <td class="text-center"><button type="button" class="btn btn-secondary" onClick="openModal('modal-Indicateur')">Indicateurs</button></td>
                    <td class="text-center"><button type="button" class="btn btn-secondary">X</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php foreach($tabProjet as $k => $projet): ?>
        <div id="modal-Savoir" class="modal">
            <h2 class="text-center">Savoir</h2>
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
                        <td class="checkbox"><input name="Savoir/<?= $savoir['N_ITEM_SAVOIR'] ?>" type="checkbox" <?= isset($savoir['']) ? 'checked' : '' ?>></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>



        <div id="modal-Indicateur" class="modal">

            <h2 class="text-center">Indicateur</h2>
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
                            <td class="checkbox"><input name="Indicateur/<?= $indicateur['N_ITEM_INDICATEUR'] ?>" type="checkbox" <?= isset($savoir['']) ? 'checked' : '' ?>></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center">Vous n'avez ajouté aucun projet.</p>
<?php endif; ?>