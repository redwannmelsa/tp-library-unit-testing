<div class="container mt-5">
    <h2 class="text-center mb-4">Liste des Adhérents</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date d'inscription</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($adherents as $adherent): ?>
                <tr>
                    <td><?php echo $adherent->getNom(); ?></td>
                    <td><?php echo $adherent->getPrenom(); ?></td>
                    <td><?php echo $adherent->getDateInscription(); ?></td>
                    <td>
                        <a href="<?= host ?>remove-adherent-action/<?php echo $adherent->getId(); ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>