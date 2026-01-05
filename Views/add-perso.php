<?php $this->layout('template', ['title' => 'Ajouter un personnage']) ?>

<div class="form-container">
    <h2>Nouveau Personnage</h2>
    
    <form action="index.php?action=add-perso" method="POST">
        
        <div class="form-group">
            <label for="name" class="form-label">Nom :</label>
            <input type="text" name="name" id="name" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="element" class="form-label">Élément :</label>
            <input type="text" name="element" id="element" class="form-input" placeholder="Ex: Fire, Ice..." required>
        </div>

        <div class="form-group">
            <label for="unitclass" class="form-label">Classe :</label>
            <input type="text" name="unitclass" id="unitclass" class="form-input" placeholder="Ex: Attack, Support..." required>
        </div>

        <div class="form-group">
            <label for="origin" class="form-label">Origine :</label>
            <input type="text" name="origin" id="origin" class="form-input">
        </div>

        <div class="form-group">
            <label for="rarity" class="form-label">Rareté (1-5) :</label>
            <input type="number" name="rarity" id="rarity" class="form-input" min="1" max="5" value="4" required>
        </div>

        <div class="form-group">
            <label for="url_img" class="form-label">URL de l'image :</label>
            <input type="url" name="url_img" id="url_img" class="form-input" required>
        </div>

        <button type="submit" class="btn btn-primary">
            Enregistrer le personnage
        </button>

    </form>
</div>