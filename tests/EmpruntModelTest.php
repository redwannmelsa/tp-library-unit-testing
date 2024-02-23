<?php

use App\Model\EmpruntModel;
use App\Model\BookModel;
use App\Model\AdherentModel;
use App\Model\classes\Emprunt;
use PHPUnit\Framework\TestCase;

class EmpruntModelTest extends TestCase
{
    public function testGetEmprunts()
    {
        $empruntModel = new EmpruntModel();
        $bookModel = new BookModel();
        $adherentModel = new AdherentModel();

        $bookModel->addBook('Book1', 'Author', '123-4-56789-012-3', 200);
        $adherentModel->addAdherent('Some', 'Adherent', '2022-01-01');

        $isbn = '123-4-56789-012-3';
        $adherentId = $adherentModel->getAdherents()[0]->getId();
        $dateEmprunt = '2022-02-02';
        $dateRetourPrevu = '2022-02-09';

        $empruntModel->createEmprunt($adherentId, $isbn, $dateEmprunt, $dateRetourPrevu);

        $emprunts = $empruntModel->getEmprunts();

        $this->assertIsArray($emprunts);
        $this->assertNotEmpty($emprunts);

        foreach ($emprunts as $emprunt) {
            $this->assertInstanceOf(Emprunt::class, $emprunt);
            $this->assertEquals($adherentId, $emprunt->getAdherent()->getId());
            $this->assertEquals($isbn, $emprunt->getLivre()->getIsbn());
            $this->assertEquals($dateEmprunt, $emprunt->getDateEmprunt());
            $this->assertEquals($dateRetourPrevu, $emprunt->getDateRetourPrevu());
        }
    }

    public function testCreateEmprunt()
    {
        $empruntModel = new EmpruntModel();
        $bookModel = new BookModel();
        $adherentModel = new AdherentModel();

        $isbn = '456-7-89012-345-6';
        $dateEmprunt = '2022-03-03';
        $dateRetourPrevu = '2022-03-10';

        $bookModel->addBook('Book2', 'insert_author_name', $isbn, 300);
        $adherentModel->addAdherent('Some', 'other adherent', '2022-02-02');
        $adherentId = $adherentModel->getAdherents()[0]->getId();
        
        $empruntModel->createEmprunt($adherentId, $isbn, $dateEmprunt, $dateRetourPrevu);
        $livre = $bookModel->getBookByIsbn($isbn);
      
        $this->assertEquals($dateEmprunt, $livre->getDateEmprunt());
        $this->assertEquals($dateRetourPrevu, $livre->getDateRetourPrevu());
    }

    public function testRemoveEmprunt()
    {
        $empruntModel = new EmpruntModel();
        $bookModel = new BookModel();
        $adherentModel = new AdherentModel();

        $bookModel->addBook('Book3', 'Author', '789-0-12345-678-9', 400);
        $adherentModel->addAdherent('A Fourth', 'Adherent', '2022-03-03');

        $isbn = '789-0-12345-678-9';

        // Create emprunt
        $adherentId = $adherentModel->getAdherents()[0]->getId();
        $dateEmprunt = '2022-04-04';
        $dateRetourPrevu = '2022-04-11';

        $empruntModel->createEmprunt($adherentId, $isbn, $dateEmprunt, $dateRetourPrevu);

        // Remove emprunt
        $empruntModel->removeEmprunt($isbn);

        $livre = $bookModel->getBookByIsbn($isbn);

        $this->assertNull($livre->getDateEmprunt());
        $this->assertNull($livre->getDateRetourPrevu());
    }
}