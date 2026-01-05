<?php $this->layout('template', ['title' => 'Ajouter un élément']) ?>

<div class="form-container bg-warning-soft">
    <h2>Nouvel Élément / Attribut</h2>
    
    <form action="index.php?action=add-perso-element" method="POST">
        
        <div class="form-group">
            <label for="name" class="form-label">Nom de l'élément :</label>
            <input type="text" name="name" id="name" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="type" class="form-label">Type :</label>
            <select name="type" id="type" class="form-input">
                <option value="element">Élément (Feu, Glace...)</option>
                <option value="path">Voie/Classe (Chasse, Abondance...)</option>
                <option value="origin">Origine (Mondstadt...)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="url_img" class="form-label">URL de l'icone :</label>
            <input type="url" name="url_img" id="url_img" class="form-input" required>
        </div>

        <button type="submit" class="btn btn-success">
            Ajouter l'élément
        </button>

    </form>
</div>