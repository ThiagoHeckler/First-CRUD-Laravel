<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class TarefaController extends Controller
{
    private function getTarefas()
    {
        $tarefas = json_decode(Cookie::get('tarefas', '[]'), true);
        return $tarefas ?? [];
    }

    private function saveTarefas($tarefas)
    {
        // Salva o cookie por 1 dia (1440 minutos)
        Cookie::queue('tarefas', json_encode($tarefas), 1440);
    }

    public function index()
    {
        $tarefas = $this->getTarefas();
        return view('tarefas.index', compact('tarefas'));
    }

    public function create()
    {
        return view('tarefas.create');
    }

    public function store(Request $request)
    {
        $tarefas = $this->getTarefas();

        // Adiciona nova tarefa
        $tarefas[] = ['titulo' => $request->input('titulo')];

        $this->saveTarefas($tarefas);

        return redirect()->route('tarefas.index')->with('success', 'Tarefa criada com sucesso!');
    }

    public function edit($id)
    {
        $tarefas = $this->getTarefas();

        if (!isset($tarefas[$id])) {
            return redirect()->route('tarefas.index')->with('error', 'Tarefa não encontrada!');
        }

        $tarefa = $tarefas[$id];
        return view('tarefas.edit', compact('tarefa', 'id'));
    }

    public function update(Request $request, $id)
    {
        $tarefas = $this->getTarefas();

        if (!isset($tarefas[$id])) {
            return redirect()->route('tarefas.index')->with('error', 'Tarefa não encontrada!');
        }

        // Atualiza o título
        $tarefas[$id]['titulo'] = $request->input('titulo');

        $this->saveTarefas($tarefas);

        return redirect()->route('tarefas.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $tarefas = $this->getTarefas();

        if (isset($tarefas[$id])) {
            unset($tarefas[$id]);
            // Reindexa o array para não quebrar os IDs
            $tarefas = array_values($tarefas);
            $this->saveTarefas($tarefas);
        }

        return redirect()->route('tarefas.index')->with('success', 'Tarefa removida com sucesso!');
    }
}
