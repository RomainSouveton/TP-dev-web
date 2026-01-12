<?php $this->layout('template', ['title' => $title]) ?>

<div class="form-container">
    
    <h2><?= isset($persoToEdit) ? 'Modifier un Personnage' : 'Nouveau Personnage' ?></h2>
    
    <?php if(isset($message) && $message): ?>
        <div class="message-box">
            <?= $this->e($message) ?>
        </div>
    <?php endif; ?>

    <form action="index.php?action=<?= isset($persoToEdit) ? 'edit-perso' : 'add-perso' ?>" method="POST">
        
        <?php if(isset($persoToEdit)): ?>
            <input type="hidden" name="id" value="<?= $this->e($persoToEdit->getId()) ?>">
        <?php endif; ?>

        <div class="form-group">
            <label for="name" class="form-label">Nom :</label>
            <input type="text" name="name" id="name" class="form-input" required
                   value="<?= isset($persoToEdit) ? $this->e($persoToEdit->getName()) : '' ?>">
        </div>

        <div class="form-group">
            <label for="element" class="form-label">Élément :</label>
            <select name="element" id="element" class="form-input" required>
                <option value="">-- Choisir un élément --</option>
                <?php if(isset($elements)): foreach($elements as $obj): ?>
                    <option value="<?= $obj->getId() ?>" 
                        <?= (isset($persoToEdit) && $persoToEdit->getElement() && $persoToEdit->getElement()->getId() == $obj->getId()) ? 'selected' : '' ?>>
                        <?= $this->e($obj->getName()) ?>
                    </option>
                <?php endforeach; endif; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="unitclass" class="form-label">Classe :</label>
            <select name="unitclass" id="unitclass" class="form-input" required>
                 <option value="">-- Choisir une classe --</option>
                <?php if(isset($unitclasses)): foreach($unitclasses as $obj): ?>
                    <option value="<?= $obj->getId() ?>" 
                        <?= (isset($persoToEdit) && $persoToEdit->getUnitclass() && $persoToEdit->getUnitclass()->getId() == $obj->getId()) ? 'selected' : '' ?>>
                        <?= $this->e($obj->getName()) ?>
                    </option>
                <?php endforeach; endif; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="origin" class="form-label">Origine :</label>
             <select name="origin" id="origin" class="form-input">
                 <option value="">-- Choisir une origine --</option>
                <?php if(isset($origins)): foreach($origins as $obj): ?>
                    <option value="<?= $obj->getId() ?>" 
                        <?= (isset($persoToEdit) && $persoToEdit->getOrigin() && $persoToEdit->getOrigin()->getId() == $obj->getId()) ? 'selected' : '' ?>>
                        <?= $this->e($obj->getName()) ?>
                    </option>
                <?php endforeach; endif; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="rarity" class="form-label">Rareté (1-5) :</label>
            <input type="number" name="rarity" id="rarity" class="form-input" min="1" max="5" required
                   value="<?= isset($persoToEdit) ? $this->e($persoToEdit->getRarity()) : '4' ?>">
        </div>

        <div class="form-group">
            <label for="url_img" class="form-label">URL de l'image :</label>
            <input type="url" name="url_img" id="url_img" class="form-input" required
                   value="<?= isset($persoToEdit) ? $this->e($persoToEdit->getUrlImg()) : '' ?>">
        </div>

        <button type="submit" class="btn btn-primary">
            <?= isset($persoToEdit) ? 'Mettre à jour' : 'Enregistrer le personnage' ?>
        </button>

    </form>
</div>