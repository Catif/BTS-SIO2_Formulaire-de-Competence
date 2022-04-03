<?php
  $req = $db->query('SELECT Id_Nom_Bloc FROM blocs'); 
  $arrayBlocs = $req->fetchAll();
  $id = isset($match['params']['id']) ? intval($match['params']['id']) : '';

  switch($match['params']['category']){
    case 'block':
      $tbl = '`item_competence`';
      $conditionPrefix = 'B';
      $N_Item = 'N_ITEM_COMPETENCE';
      $title = 'Compétence';
      break;
    case 'knowledge':
      $tbl = '`item_savoir`';
      $N_Item = 'N_ITEM_SAVOIR';
      $conditionPrefix = 'S';
      $title = 'Savoir';
      break;
    case 'indicator':
      $tbl = '`item_indicateur`';
      $N_Item = 'N_ITEM_INDICATEUR';
      $conditionPrefix = 'P';
      $title = 'Indicateur';
      break;
    default:
      $tbl = '';
  }

  
  

  if($tbl === '' || (isset($match['params']['id']) && !isset($arrayBlocs[$id-1]))){
    header('Location: ' . HTML_ROOT . '/404');
    die();
  }
  if(!isset($construct)){
    if(isset($match['params']['id'])){
      if(intval($match['params']['id'])){
        $like = $conditionPrefix . $id . '%'; // ex : B2% => B2.1.1 B2.1.2 ...
        $sql = "SELECT * FROM $tbl WHERE $N_Item like '$like'";
        $req = $db->query($sql);
        $skills = $req->fetchAll();
      }
    } else{
      $req = $db->query("SELECT * FROM $tbl");
      $skills = $req->fetchAll();
    }
  }
?>



<h1 class="title"><?= $title ?> : <?= isset($match['params']['id']) ? $arrayBlocs[$id - 1][0] : 'Tous les blocs' ?></h1>

<br><br>

<?php if(!isset($construct)): ?>
  <table class="skills">
    <thead>
      <tr>
        <th>Identifiant</th>
        <th>Libelé</th>
        <th>Mise en Œuvre</th>
        <th>En cours d'Acquisition</th>
        <th>Acquise</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($skills as $skill): ?>
        <tr>
          <td class="text-center"><?= $skill[$N_Item] ?></td>
          <td><?= $skill['LIBEL_ITEM'] ?></td>
          <td class="checkbox"><input name="Savoir_Mise-En-Oeuvre_<?= $savoir['N_ITEM_SAVOIR'] ?>" type="checkbox" <?= isset($skill['']) ? 'checked' : '' ?> disabled></td>
          <td class="checkbox"><input name="Savoir_En-Cours_<?= $savoir['N_ITEM_SAVOIR'] ?>" type="checkbox" <?= isset($skill['']) ? 'checked' : '' ?> disabled></td>
          <td class="checkbox"><input name="Savoir_Acquise_<?= $savoir['N_ITEM_SAVOIR'] ?>" type="checkbox" <?= isset($skill['']) ? 'checked' : '' ?> disabled></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>

  <p class="text-center">Cette partie n'est pas encore disponible.</p>

<?php endif; ?>

