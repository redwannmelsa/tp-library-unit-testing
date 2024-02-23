<?php

use App\Model\AdherentModel;
use App\Model\classes\Adherent;
use PHPUnit\Framework\TestCase;

class AdherentModelTest extends TestCase
{
    public function testGetAdherents()
    {
        $adherentModel = new AdherentModel();
        $adherents = $adherentModel->getAdherents();

        $this->assertIsArray($adherents);

        foreach ($adherents as $adherent) {
            $this->assertInstanceOf(Adherent::class, $adherent);
        }
    }

    public function testGetAdherentById()
    {
        $adherentModel = new AdherentModel();
        $adherentModel->addAdherent('Jean', 'Pierre', '2022-01-01');

        $adherents = $adherentModel->getAdherents();
        $firstAdherent = reset($adherents);

        $foundAdherent = $adherentModel->getAdherentById($firstAdherent->getId());

        $this->assertInstanceOf(Adherent::class, $foundAdherent);
        $this->assertEquals($firstAdherent, $foundAdherent);
    }

    public function testAddAdherent()
    {
        $adherentModel = new AdherentModel();
        $initialAdherentsCount = count($adherentModel->getAdherents());

        $adherentModel->addAdherent('Philippe', 'Rousseau', '2022-02-02');

        $adherents = $adherentModel->getAdherents();

        $this->assertCount($initialAdherentsCount + 1, $adherents);
        $this->assertContainsOnlyInstancesOf(Adherent::class, $adherents);
    }

    public function testRemoveAdherent()
    {
        $adherentModel = new AdherentModel();
        $adherentModel->addAdherent('Christine', 'Valls', '2022-01-01');
        $initialAdherentsCount = count($adherentModel->getAdherents());

        $adherents = $adherentModel->getAdherents();
        $firstAdherent = reset($adherents);

        $adherentModel->removeAdherent($firstAdherent->getId());

        $adherentsAfterRemoval = $adherentModel->getAdherents();

        $this->assertCount($initialAdherentsCount - 1, $adherentsAfterRemoval);
        $this->assertNotContains($firstAdherent, $adherentsAfterRemoval);
    }
}
