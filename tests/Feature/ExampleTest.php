<?php

namespace Tests\Feature;

use App\Models\StudentClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
    }

    public function test_only_implemented_resource_routes_are_exposed(): void
    {
        $this->get('/classes/create')->assertMethodNotAllowed();
        $this->get('/classes/1/edit')->assertNotFound();
    }

    public function test_class_input_is_validated_and_persisted(): void
    {
        $this->post('/classes', [
            'class_code' => 'CNTT_K61',
            'class_name' => 'Công nghệ thông tin K61',
            'unexpected' => 'must not be persisted',
        ])->assertRedirect();

        $this->assertDatabaseHas('student_classes', [
            'class_code' => 'CNTT_K61',
            'class_name' => 'Công nghệ thông tin K61',
        ]);
    }

    public function test_invalid_class_code_is_rejected(): void
    {
        $this->from('/classes')->post('/classes', [
            'class_code' => '<script>alert(1)</script>',
            'class_name' => 'Invalid',
        ])->assertRedirect('/classes')->assertSessionHasErrors('class_code');

        $this->assertSame(0, StudentClass::query()->count());
    }
}
