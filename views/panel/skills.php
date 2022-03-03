<?php


  switch($match['params']['category']){
    case 'block':
      $tbl = '`item competences`';
      $title = 'blocs';
      break;
    case 'knowledge':
      $tbl = '`savoir`';
      $title = 'savoir';
      $construct = true;
      break;
    case 'indicator':
      $tbl = '`indicateur`';
      $title = 'indicateur';
      $construct = true;
      break;
    default:
      $tbl = '';
  }

  if($tbl === ''){
    header('Location: ' . HTML_ROOT . '/404');
    die();
  }
  if(!isset($construct)){
    if(isset($match['params']['id'])){
      $sql = "SELECT N_ITEM.Acquerir";
      $req = $db->query($sql);
      $skills = $req->fetchAll();
    } else{
      $req = $db->query("SELECT * FROM $tbl");
      $skills = $req->fetchAll();
    }
  }
?>



<h1 class="title">Compétence : <?= ucfirst(strtolower($title)) ?><?= isset($match['params']['id']) ? ' n°' . $match['params']['id'] : '' ?></h1>

<br><br>

<?php if(!isset($construct)): ?>
  <table class="skills">
    <thead>
      <tr>
        <th>Identifiant</th>
        <th>Libelé</th>
        <!-- <th>Mise en Œuvre</th>
        <th>En cours d'Acquisition</th>
        <th>Acquise</th> -->
      </tr>
    </thead>
    <tbody>
      <?php foreach($skills as $skill): ?>
        <tr>
          <td class="N_Item"><?= $skill['N_Item'] ?></td>
          <td class="Libel_Item"><?= $skill['Libel_Item'] ?></td>
          <!-- <td><?= $skill['N_Item'] ?></td>
          <td><?= $skill['N_Item'] ?></td>
          <td><?= $skill['N_Item'] ?></td> -->
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>

  <p class="text-center">Cette partie n'est pas encore disponible.</p>

<?php endif; ?>

