<?php

namespace App\Http\Controllers;

use App\Models\Chamados;
use Illuminate\Http\Request;
use App\Models\Tecnicos;
use App\Models\Categorias;

class ChamadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Chamados::with(['tecnico', 'categoria']);

        if ($request->filled('prioridade')) {
            $query->where('prioridade', $request->prioridade);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $chamados = $query
            ->orderByRaw("CASE prioridade WHEN 'alta' THEN 0 WHEN 'media' THEN 1 ELSE 2 END")
            ->orderBy('data_abertura', 'asc')
            ->get();

        return view('chamados.index', compact('chamados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tecnicos = Tecnicos::all();
        $categorias = Categorias::all();

        return view('chamados.create', compact('tecnicos', 'categorias'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'prioridade' => ['required', 'in:baixa,media,alta'],
            'status' => ['required', 'in:aberto,em_atendimento,resolvido,fechado'],
            'data_abertura' => ['required', 'date'],
            'tecnico_id' => ['required', 'exists:tecnicos,id'],
            'categoria_id' => ['required', 'exists:categorias,id'],
        ]);

        if ($dados['status'] === 'fechado') {
            return back()
                ->withErrors(['status' => 'Um chamado so pode ser fechado apos estar resolvido.'])
                ->withInput();
        }

        Chamados::create($dados);

        return redirect()->route('chamados.index')
            ->with('success', 'Chamado criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chamados $chamado)
    {
        return view('chamados.show', compact('chamado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chamados $chamado)
    {
        $tecnicos = Tecnicos::all();
        $categorias = Categorias::all();
        return view('chamados.edit', compact('chamado', 'tecnicos', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chamados $chamado)
    {
        $dados = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'prioridade' => ['required', 'in:baixa,media,alta'],
            'status' => ['required', 'in:aberto,em_atendimento,resolvido,fechado'],
            'data_abertura' => ['required', 'date'],
            'tecnico_id' => ['required', 'exists:tecnicos,id'],
            'categoria_id' => ['required', 'exists:categorias,id'],
        ]);

        if ($dados['status'] === 'fechado' && $chamado->status !== 'resolvido') {
            return back()
                ->withErrors(['status' => 'Um chamado so pode ser fechado quando estiver resolvido.'])
                ->withInput();
        }

        $chamado->update($dados);

        return redirect()->route('chamados.index')
            ->with('success', 'Chamado atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chamados $chamado)
    {
        $chamado->delete();
        return redirect()->route('chamados.index')->with('success', 'Chamado excluído com sucesso!');
    }
}
