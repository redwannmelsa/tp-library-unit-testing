<div class="container mt-5">
    <h2 class="text-center mb-4">Liste des Emprunts</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Adhérent</th>
                <th>Livre emprunté</th>
                <th>Date d'emprunt</th>
                <th>Date de retour prévue</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($emprunts as $emprunt): ?>
                <tr>
                    <td><?php echo $emprunt->getAdherent()->getNom() . ' ' . $emprunt->getAdherent()->getPrenom(); ?></td>
                    <td><?php echo $emprunt->getLivre()->getTitre(); ?></td>
                    <td><?php echo $emprunt->getDateEmprunt(); ?></td>
                    <td><?php echo $emprunt->getDateRetourPrevu(); ?></td>
                    <td>
                        <form method="POST" action="<?= host ?>remove-emprunt-action">
                            <input type="hidden" name="isbn" value="<?= $emprunt->getLivre()->getIsbn(); ?>" />
                            <button type="submit" class="btn btn-success btn-sm">Retourner le livre</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>