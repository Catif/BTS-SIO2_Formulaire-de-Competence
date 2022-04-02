<?php
    $req = $db->query('SELECT ID_NOM_BLOC FROM blocs');
    $array_block = $req->fetchAll();
?>

<navbar>
    <div class="nav-profile">
        <u><?= $_SESSION['user-name'] ?></u>

        <div class="nav-icon">
            <a href="<?= HTML_ROOT ?>/panel/setting"><span class="iconify" data-icon="bxs:user"></span></a>
            <a href="<?= HTML_ROOT ?>/logout"><span class="iconify" data-icon="pepicons:leave"></span></a>
        </div>
    </div>

    <div class="nav-bloc">
        <div id="nav-Project" class="nav-categorie">
            <u>Projets :</u>
    
            <div class="nav-items">
                <div class="nav-item">
                    <a href="<?= HTML_ROOT ?>/panel/project/list"><span class="iconify" data-icon="ant-design:folder-open-filled"></span> Liste des projets</a>
                </div>

                <div class="nav-item">
                    <a href="<?= HTML_ROOT ?>/panel/project/create"><span class="iconify" data-icon="ant-design:file-add-filled"></span> Ajouter un projet</a>
                </div>
            </div>
        </div>
    
        <div id="nav-Skills" class="nav-categorie">
            <u>Compétences :</u>
    
            <div class="nav-items gap">
                <div class="nav-item">
                    <a href="<?= HTML_ROOT ?>/panel/skills/block"><span class="iconify" data-icon="mdi:hand-saw"></span> Compétences</a>
                    
                    <div class="nav-list">
                        <?php foreach($array_block as $k => $bloc): ?>
                            <a href="<?= HTML_ROOT ?>/panel/skills/block/<?= $k + 1 ?>"><?= $bloc[0] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
    
    
    
    
                <div class="nav-item">
                    <a href="<?= HTML_ROOT ?>/panel/skills/knowledge"><span class="iconify" data-icon="bxs:book-alt"></span> Savoirs</a>
                    
                    <div class="nav-list">
                        <?php foreach($array_block as $k => $bloc): ?>
                            <a href="<?= HTML_ROOT ?>/panel/skills/knowledge/<?= $k + 1 ?>"><?= $bloc[0] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
    
    
    
    
                <div class="nav-item">
                    <a href="<?= HTML_ROOT ?>/panel/skills/indicator"><span class="iconify" data-icon="ep:warning-filled"></span> Indicateurs</a>
                    
                    <div class="nav-list">
                        <?php foreach($array_block as $k => $bloc): ?>
                            <a href="<?= HTML_ROOT ?>/panel/skills/indicator/<?= $k + 1 ?>"><?= $bloc[0] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</navbar>

<button class="nav-media-button">
    <span class="iconify" data-icon="eva:menu-fill"></span>
</button>

<div class="nav-shadow"></div>