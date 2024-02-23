<div class="container mt-5">
    <h2 class="text-center mb-4">Modifier les détails du livre</h2>

    <?php if ($livreAModifier): ?>
    <form action="<?= host ?>edit-book-action" method="post">
        <div class="form-group">
            <label for="titre">Titre:</label>
            <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $livreAModifier->getTitre(); ?>" required>
        </div>
        <div class="form-group">
            <label for="auteur">Auteur:</label>
            <input type="text" class="form-control" id="auteur" name="auteur" value="<?php echo $livreAModifier->getAuteur(); ?>" required>
        </div>
        <div class="form-group">
            <label for="nombrePages">Nombre de pages:</label>
            <input type="number" class="form-control" id="nombrePages" name="nombrePages" value="<?php echo $livreAModifier->getNombrePages(); ?>" required>
        </div>
        <input type="hidden" name="isbn" value="<?= $livreAModifier->getIsbn() ?>" />
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
    <?php else: ?>
    <p class="alert alert-danger">Le livre demandé n'a pas été trouvé.</p>
    <?php endif; ?>
</div>