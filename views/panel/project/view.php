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
                <th>Date d'ajout</th>
                <th>Modification</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($tabProjet as $k => $projet): ?>
                <?php 
                    $projet['CREATED_AT'] = new DateTime($projet['CREATED_AT']);
                    $projet['CREATED_AT_FORMATED'] = date('d/m/Y', $projet['CREATED_AT']->getTimestamp());
                ?>

                <tr id="Project-<?= $projet['ID_PROJET'] ?>">
                    <td class="text-center"><?= $projet['LIBEL_PROJET'] ?></td>
                    <td class="text-center"><?= $projet['CREATED_AT_FORMATED'] ?></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-secondary btn-table" onClick="openModal('modal-project-<?= $projet['ID_PROJET'] ?>')">
                            <span class="iconify" data-icon="fa6-solid:pen-to-square"></span>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>



    
    <?php foreach($tabProjet as $k => $projet): ?>
        <div id="modal-project-<?= $projet['ID_PROJET'] ?>" class="modal">
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
    <?php endforeach; ?>

    <div id="modal-shadow" onClick="closeModal()"></div>

<?php else: ?>
    <p class="text-center">Vous n'avez ajouté aucun projet.</p>
<?php endif; ?>