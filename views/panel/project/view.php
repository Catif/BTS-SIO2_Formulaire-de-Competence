<?php
$req = $db->query('SELECT * FROM projet');
$tabProjet = $req->fetchAll();

?>


<h1 class="title">Liste de vos projets :</h1>

<?php if(!empty($tabProjet)): ?>
    <table class="skills">
        <thead>
            <tr>
                <th>Identifiant</th>
                <th>Nom du projet</th>
                <th>Savoir</th>
                <th>Indicateur</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($tabProjet as $k => $projet): ?>
                <tr>
                    <td class="text-center"><?= $k ?></td>
                    <td><?= $projet['LIBEL_PROJET'] ?></td>
                    <td class="text-center"><button type="button" class="btn btn-secondary" onClick="openModal('modal-Savoir')">Savoirs</button></td>
                    <td class="text-center"><button type="button" class="btn btn-secondary" onClick="openModal('modal-Indicateur')">Indicateurs</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="text-center">Vous n'avez ajouté aucun projet.</p>
<?php endif; ?>