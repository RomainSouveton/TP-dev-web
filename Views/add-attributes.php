<?php $this->layout('template', ['title' => 'Ajouter un Attribut']) ?>

<div class="form-container" style="background-color: #fff3cd; border: 1px solid #ffeeba;">
    <h2 style="color: #856404;">Ajouter un Attribut (Origine, Élément...)</h2>
    
    <form action="index.php?action=add-perso-element" method="POST">
        
        <div class="form-group">
            <label for="type" class="form-label">Type d'attribut :</label>
            <select name="type" id="type" class="form-input">
                <option value="element">Élément (Feu, Glace, Vent...)</option>
                <option value="unitclass">Classe (Destruction, Chasse...)</option>
                <option value="origin">Origine (Mondstadt, Belobog...)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name" class="form-label">Nom :</label>
            <input type="text" name="name" id="name" class="form-input" placeholder="Ex: Fire" required>
        </div>

        <div class="form-group">
            <label for="url_img" class="form-label">URL de l'icone :</label>
            <input type="url" name="url_img" id="url_img" class="form-input" placeholder="https://..." required>
        </div>

        <button type="submit" class="btn btn-success">
            Enregistrer l'attribut
        </button>

    </form>
</div>