<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class ManageUsers extends Controller
{
    protected $UserRepository ;
    public function __construct(UserRepositoryInterface $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }
    public function index()
    {
        $paginate = $this->UserRepository->paginate();
        $users = $this->UserRepository->getAll();

        return view('admin.users.index', compact('users','paginate'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $user = $this->UserRepository->create($data);

        return redirect()->route('admin.users.index');
    }

    public function show($id)
    {
        $user = $this->UserRepository->getById($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->UserRepository->getById($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'sometimes|confirmed'
        ]);

        $user = $this->UserRepository->update($data, $id);

        return redirect()->route('admin.users.index', $user->id);
    }

    public function destroy($id)
    {
        $this->UserRepository->delete($id);

        return redirect()->route('admin.users.index');
    }
}
