<?php declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Spaceship;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpaceshipTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @return void
     */
    public function testListSpaceships(): void
    {
        $response = $this->get('/api/spaceships');
        $response->assertStatus(200);
        $this->assertCount(2, $response['data']);
        $this->assertSame(2, $response['meta']['per_page']);
    }


    public function testCanRetrieveSpaceship(): void
    {
        $spaceship = Spaceship::factory()->create([
            'name' => 'Test Name',
        ]);

        $response = $this->get('/api/spaceships/' . $spaceship->id);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => 'Test Name',
        ]);
    }

    public function testCanCreateSpaceship(): void
    {
        $data = [
            'name'      => 'Name',
            'class'     => 'CLASS',
            'crew'      => '100',
            'image'     => 'https://via.placeholder.com/640x480.png/004411?text=TEXT',
            'value'     => '999.99',
            'status_id' => '1',
        ];

        $response = $this->post('/api/spaceships/', $data);
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertDatabaseHas('spaceships', $data);
    }

    public function testCanEditSpaceship(): void
    {
        $spaceship = Spaceship::factory()->create([
            'name' => 'Test Name BAD',
        ]);

        $response = $this->put('/api/spaceships/' . $spaceship->id, [
            'name'      => 'Test Name GOOD',
            'class'     => $spaceship->class,
            'crew'      => $spaceship->crew,
            'image'     => $spaceship->image,
            'value'     => $spaceship->value,
            'status_id' => $spaceship->status_id,
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertSame('Test Name GOOD', $spaceship->refresh()->name);
    }

    public function testCanDeleteSpaceship(): void
    {
        $spaceship = Spaceship::factory()->create([
            'name' => 'Test Name BAD',
        ]);

        $response = $this->delete('/api/spaceships/' . $spaceship->id);
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $response = $this->get('/api/spaceships/' . $spaceship->id);
        $response->assertStatus(404);
        $response->assertJson(['message' => 'Not Found']);

    }
}
