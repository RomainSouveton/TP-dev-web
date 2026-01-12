<?php $this->layout('template', ['title' => $title]) ?>

<div class="home-container">
    
    <h1>Collection Mihoyo</h1>

    <div class="char-grid" role="list">
<?php foreach ($listPersonnage as $perso): ?>
    <div class="char-card" role="listitem">
        <div class="char-img-wrapper">
            <img src="<?= $this->e($perso->getUrlImg()) ?>" alt="<?= $this->e($perso->getName()) ?>">
        </div>
        <h3><?= $this->e($perso->getName()) ?></h3>
        <div class="char-details">
            <strong>Élément:</strong> <?= $this->e($perso->getElement()?->getName()) ?><br>
            <strong>Classe:</strong> <?= $this->e($perso->getUnitclass()?->getName()) ?><br>
            <strong>Rareté:</strong> <span><?= str_repeat('★', $perso->getRarity()) ?></span>
        </div>
        <div class="char-actions">
            <a href="index.php?action=edit-perso&id=<?= $perso->getId() ?>" class="btn btn-primary" aria-label="Modifier le personnage <?= $this->e($perso->getName()) ?>">Modifier</a>
            <a href="index.php?action=del-perso&id=<?= $perso->getId() ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?');" aria-label="Supprimer le personnage <?= $this->e($perso->getName()) ?>">Supprimer</a>
        </div>
    </div>
<?php endforeach; ?>
</div>
</div>