<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ToDoList;

class ToDoListTest extends TestCase
{
    public function test_task_create()
    {
        $task = [
            'task' => "Tarefa teste",
            'description' => "Tarefa teste",
            'status' => "Pendente",
            'due_date' => "2024-12-12",
            'user_id' => 1
        ];

        $response = $this->post("/store", $task);

        $response->assertStatus(302);
        $response->assertRedirect('/');

        $this->assertDatabaseHas('task_list', $task);
    }

    public function test_task_update()
    {
        $task = ToDoList::create([
            'task' => "Tarefa teste",
            'description' => "Tarefa teste",
            'status' => "Pendente",
            'due_date' => "2024-12-12",
            'user_id' => 1
        ]);

        $response = $this->put("/update/" . $task->id, [
            'task' => "Tarefa teste update",
            'description' => "Tarefa teste update",
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertInvalid(['task', 'description']);
    }

    public function test_task_delete()
    {
        $task = ToDoList::create([
            'task' => "Tarefa teste",
            'description' => "Tarefa teste",
            'status' => "Pendente",
            'due_date' => "2024-12-12",
            'user_id' => 1
        ]);

        $response = $this->delete("/delete", $task->id);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertDatabaseMissing('task_list', $task);
    }
}
