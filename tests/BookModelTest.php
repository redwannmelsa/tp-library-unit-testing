<?php

use App\Model\BookModel;
use App\Model\classes\Livre;
use PHPUnit\Framework\TestCase;

class BookModelTest extends TestCase
{
    public function testGetBooks()
    {
        $bookModel = new BookModel();
        $books = $bookModel->getBooks();

        $this->assertIsArray($books);

        foreach ($books as $book) {
            $this->assertInstanceOf(Livre::class, $book);
        }
    }

    public function testGetBookByIsbn()
    {
        $bookModel = new BookModel();
        $isbn = '978-3-16-148410-0';
        $bookModel->addBook('Some title', 'Some author', $isbn, 200);

        $foundBook = $bookModel->getBookByIsbn($isbn);

        $this->assertInstanceOf(Livre::class, $foundBook);
        $this->assertEquals($isbn, $foundBook->getIsbn());
    }

    public function testAddBook()
    {
        $bookModel = new BookModel();
        $initialBooksCount = count($bookModel->getBooks());

        $bookModel->addBook('New Title', 'Another author', '123-4-56789-012-3', 300);

        $books = $bookModel->getBooks();

        $this->assertCount($initialBooksCount + 1, $books);
        $this->assertContainsOnlyInstancesOf(Livre::class, $books);
    }

    public function testEditBook()
    {
        $bookModel = new BookModel();
        $isbn = '123-4-56789-012-3';
        $bookModel->addBook('Old Title', 'Old Author', $isbn, 400);

        $bookModel->editBook('New Title', 'New Author', $isbn, 500);

        $updatedBook = $bookModel->getBookByIsbn($isbn);

        $this->assertInstanceOf(Livre::class, $updatedBook);
        $this->assertEquals('New Title', $updatedBook->getTitre());
        $this->assertEquals('New Author', $updatedBook->getAuteur());
        $this->assertEquals(500, $updatedBook->getNombrePages());
    }

    public function testRemoveBook()
    {
        $bookModel = new BookModel();
        $isbn = '123-4-56789-012-3';
        $bookModel->addBook('To be removed', 'Yet another author', $isbn, 200);
        $initialBooksCount = count($bookModel->getBooks());

        $bookModel->removeBook($isbn);

        $booksAfterRemoval = $bookModel->getBooks();

        $this->assertCount($initialBooksCount - 1, $booksAfterRemoval);
    }
}