<?php $this->layout('template', ['title' => 'Logs']) ?>
<h1>Logs du système</h1>

<div class="logs-wrapper">
    <div class="logs-sidebar">
        <h3>Fichiers</h3>
        <ul>
            <?php if(isset($files)): foreach($files as $f): ?>
                <li>
                    <a href="index.php?action=logs&file=<?= $this->e($f) ?>" 
                       class="<?= (isset($selectedFile) && $selectedFile === $f) ? 'active' : '' ?>">
                        <?= $this->e($f) ?>
                    </a>
                </li>
            <?php endforeach; endif; ?>
        </ul>
    </div>
    
    <div class="logs-content">
        <h3>Contenu</h3>
        <?php if(isset($content) && $content): ?>
            <pre><?= $this->e($content) ?></pre>
        <?php else: ?>
            <p>Sélectionnez un fichier pour voir les logs.</p>
        <?php endif; ?>
    </div>
</div>