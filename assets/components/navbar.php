<navbar>
    <div class="nav-profile">
        <u><?= $_SESSION['user-name'] ?></u>

        <div class="nav-icon">
            <a href="<?= HTML_ROOT ?>/panel/setting"><span class="iconify" data-icon="ci:settings-filled"></span></a>
            <a href="<?= HTML_ROOT ?>/logout"><span class="iconify" data-icon="pepicons:leave"></span></a>
        </div>
    </div>


    <div class="nav-skills">
        <u>Compétences :</u>

        <div class="nav-skills-items">
            <div class="nav-skills-item">
                <a href="<?= HTML_ROOT ?>/panel/skills/block">Bloc</a>
                
                <div class="nav-skills-list">
                    <a href="<?= HTML_ROOT ?>/panel/skills/block/1">Bloc 1</a>
                    <a href="<?= HTML_ROOT ?>/panel/skills/block/2">Bloc 2</a>
                    <a href="<?= HTML_ROOT ?>/panel/skills/block/3">Bloc 3</a>
                    <a href="<?= HTML_ROOT ?>/panel/skills/block/4">Bloc 4</a>
                </div>
            </div>




            <div class="nav-skills-item">
                <a href="<?= HTML_ROOT ?>/panel/skills/knowledge">Savoir</a>
                
                <div class="nav-skills-list">
                    <a href="<?= HTML_ROOT ?>/panel/skills/knowledge/1">Savoir 1</a>
                    <a href="<?= HTML_ROOT ?>/panel/skills/knowledge/2">Savoir 2</a>
                    <a href="<?= HTML_ROOT ?>/panel/skills/knowledge/3">Savoir 3</a>
                    <a href="<?= HTML_ROOT ?>/panel/skills/knowledge/4">Savoir 4</a>
                </div>
            </div>




            <div class="nav-skills-item">
                <a href="<?= HTML_ROOT ?>/panel/skills/indicator">Indicateur</a>
                
                <div class="nav-skills-list">
                    <a href="<?= HTML_ROOT ?>/panel/skills/indicator/1">Indicateur 1</a>
                    <a href="<?= HTML_ROOT ?>/panel/skills/indicator/2">Indicateur 2</a>
                    <a href="<?= HTML_ROOT ?>/panel/skills/indicator/3">Indicateur 3</a>
                    <a href="<?= HTML_ROOT ?>/panel/skills/indicator/4">Indicateur 4</a>
                </div>
            </div>
        </div>
    </div>
</navbar>