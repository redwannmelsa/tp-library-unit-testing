<div class="container mt-5">
    <h2 class="text-center mb-4">Emprunter un livre</h2>

    <form action="<?= host ?>create-emprunt-action" method="post">
        <div class="form-group">
            <label for="adherentId">Adhérent:</label>
            <select class="form-control" id="adherentId" name="adherentId" required>
                <?php foreach ($adherents as $adherent): ?>
                    <option value="<?= $adherent->getId() ?>"><?= $adherent->getNom() . ' ' . $adherent->getPrenom() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="livreIsbn">Livre:</label>
            <select class="form-control" id="livreIsbn" name="livreIsbn" required>
                <?php foreach ($livres as $livre): ?>
                    <?= debug($livre) ?>
                    <?php if(empty($livre->getIdAdherent())): ?>
                        <option value="<?= $livre->getIsbn() ?>"><?= $livre->getTitre() ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Emprunter</button>
    </form>
</div>