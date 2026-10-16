<?php

namespace App\Http\Controllers;
feature/edicao-usuarios

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

main
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        if ($busca) {
feature/edicao-usuarios
            $usuarios = User::where('name', 'like', "%{$busca}%", 'and')
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $usuarios = User::orderBy('name', 'asc')->get();
        }

        return view('admin.dashboard', compact('usuarios', 'busca'));
    }

            // select * from users where name = 'ana'
            // select * from users where name = '%ana%'
            $usuarios = User::where('name', 'like', "%{$busca}%", 'and')
            ->orderBy('name', 'ASC')
            ->get();
        }
        else {
            $usuarios = User::orderby('name', 'ASC') -> get();
        }

        return view('admin.dashboard', compact('usuarios', 'busca'));

    }

    // Exibe o formulario de cadastro de usuarios
main
    public function create()
    {
        return view('users.create');
    }

feature/edicao-usuarios
    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
    // Salva no banco de dados
    public function store(Request $request)
    {
        $dadosValidados = $request -> validate([
main
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

feature/edicao-usuarios
        User::create($dadosValidados);

        return redirect('/admin')->with('sucesso', 'Usuário cadastrado com sucesso');
    }

    /**
     * Localiza o usuário pelo ID e exibe o formulário de edição preenchido.
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);

        return view('users.edit', compact('usuario'));
    }

    /**
     * Valida os novos dados e atualiza o registro no banco de dados.
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        // Validação garantindo que o e-mail continue único, ignorando o próprio ID do usuário
        $dadosValidados = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($usuario->id),
            ],
            'password' => 'nullable|min:6',
        ]);

        // Se o campo de senha não foi preenchido, remove do array para não sobrescrever com valor vazio
        if (empty($dadosValidados['password'])) {
            unset($dadosValidados['password']);
        }

        // Atualiza os dados no banco de dados
        $usuario->update($dadosValidados);

        return redirect('/admin')->with('sucesso', 'Usuário atualizado com sucesso');
    }
}
        // Persistencia no banco usando o ORM Eloquent
        User::create($dadosValidados);

        // Redireciona para o painel adm com mensagem de sucesso
        return redirect('/admin') -> with('sucesso', 'Usuario cadastrado com sucesso.');
    }
}
main
