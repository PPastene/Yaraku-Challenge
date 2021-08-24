<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->book = Book::factory()->createMany([
            [
                "title" => "Harry Potter and the Philosopher's Stone",
                "author" => "J. K. Rowling"
            ],
            [
                "title" => "Harry Potter and the Chamber of Secrets",
                "author" => "J. K. Rowling"
            ],
            [
                "title" => "The Lion, the Witch and the Wardrobe",
                "author" => "C. S. Lewis"
            ],
            [
                "title" => "Prince Caspian: The Return to Narnia",
                "author" => "C. S. Lewis"
            ],
            [
                "title" => "The Lightning Thief",
                "author" => "Rick Riordan"
            ],
            [
                "title" => "The Sea of Monsters",
                "author" => "Rick Riordan"
            ],
            [
                "title" => "The Hunger Games",
                "author" => "Suzanne Collins"
            ],
            [
                "title" => "Catching Fire",
                "author" => "Suzanne Collins"
            ],
            [
                "title" => "Mockingjay",
                "author" => "Suzanne Collins"
            ],
            [
                "title" => "Brave New World",
                "author" => "Aldous Huxley"
            ]
        ]);
    }

    /** @test */
    public function get_books()
    {
        $response = $this->get('/')
            ->assertInertia(fn ($assert) => $assert
                ->component('Index')
                ->has('books.0', fn ($assert) => $assert
                        ->where("title", "Harry Potter and the Philosopher's Stone")
                        ->where("author", "J. K. Rowling")
                        ->etc()
                    )
                ->has('books.2', fn ($assert) => $assert
                    ->where("title", "The Lion, the Witch and the Wardrobe")
                    ->where("author", "C. S. Lewis")
                    ->etc()
                )
        );

        $response->assertStatus(200);
    }

    /** @test */
    public function add_book()
    {
        $book = [
            'title' => "Harry Potter and the Prisoner of Azkaban",
            'author' => "J. K. Rowling"
        ];
        $response = $this->post('/book', $book);

        $response->assertStatus(302);
    }

    /** @test */
    public function edit_book()
    {
        $response = $this->get('/');
        $book = [
            'id' => "24",
            'title' => "Jurassic Park",
            'author' => "Michael Crichton"
        ];
        $update = $this->put('/book', $book);

        $update->assertStatus(302);
    }

    /** @test */
    public function delete_book()
    {
        $response = $this->get('/');
        $delete = $this->delete("book/32");

        $delete->assertStatus(302);
    }

    /** @test */
    public function search_book()
    {
        $response = $this->get('/?title=Harry')
            ->assertInertia(fn ($assert) => $assert
                ->component('Index')
                ->has('books.0', fn ($assert) => $assert
                    ->where("title", "Harry Potter and the Philosopher's Stone")
                    ->where("author", "J. K. Rowling")
                    ->etc()
                )
                ->has('books.1', fn ($assert) => $assert
                    ->where("title", "Harry Potter and the Chamber of Secrets")
                    ->where("author", "J. K. Rowling")
                    ->etc()
            )
        );

        $response->assertStatus(200);
    }
}
