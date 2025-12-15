<?php $this->layout('template', ['title' => $title]) ?>

<div style="font-family: sans-serif; max-width: 900px; margin: 0 auto;">
    
    <h1>Collection Mihoyo</h1>

    <?php if(isset($persoVedette) && $persoVedette): ?>
        <div style="background-color: #d1e7dd; padding: 15px; border-radius: 8px; margin-bottom: 30px; border: 1px solid #badbcc;">
            <h2 style="margin-top: 0; color: #0f5132;">Test getByID (Perso Vedette)</h2>
            <div style="display: flex; align-items: center; gap: 20px;">
                <img src="<?= $this->e($persoVedette->getUrlImg()) ?>" alt="Vedette" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                <div>
                    <strong><?= $this->e($persoVedette->getName()) ?></strong><br>
                    <small>ID: <?= $this->e($persoVedette->getId()) ?></small>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        <?php foreach ($listPersonnage as $perso): ?>
            <div style="border: 1px solid #ddd; padding: 15px; border-radius: 12px; width: 220px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); background: white;">
                <div style="text-align: center; margin-bottom: 10px;">
                    <img src="<?= $this->e($perso->getUrlImg()) ?>" alt="<?= $this->e($perso->getName()) ?>" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                </div>
                
                <h3 style="margin: 5px 0; text-align: center;"><?= $this->e($perso->getName()) ?></h3>
                <p style="font-size: 0.9em; margin: 5px 0;">
                    <strong>Élément:</strong> <?= $this->e($perso->getElement()) ?><br>
                    <strong>Classe:</strong> <?= $this->e($perso->getUnitclass()) ?><br>
                    <strong>Rareté:</strong> <span style="color: orange;"><?= str_repeat('★', $perso->getRarity()) ?></span>
                </p>

                <div style="margin-top: 15px; padding-top: 10px; border-top: 1px solid #eee; display: flex; justify-content: space-between;">
                    <a href="#" style="text-decoration: none; color: white; background-color: #0d6efd; padding: 5px 10px; border-radius: 4px; font-size: 0.8em;">Modifier</a>
                    <a href="#" style="text-decoration: none; color: white; background-color: #dc3545; padding: 5px 10px; border-radius: 4px; font-size: 0.8em;">Supprimer</a>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>