<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\User;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with(['prodi', 'jurusan'])->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        $jurusans = Jurusan::all();
        return view('admin.users.create', compact('prodis', 'jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nip' => 'required|unique:users,nip',
            'nohp' => 'required|unique:users,nohp|min:6|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,wadir1,tim,kaprodi,kajur',
            'status' => 'required|in:approved,pending'
        ]);

        if (in_array($request->role, ['kaprodi', 'tim']) && !$request->kode_prodi) {
            return back()->withErrors(['kode_prodi' => 'Prodi wajib dipilih untuk role ini.'])->withInput();
        }

        if ($request->role === 'kajur' && !$request->id_jurusan) {
            return back()->withErrors(['id_jurusan' => 'Jurusan wajib dipilih untuk role ini.'])->withInput();
        }

        if (in_array($request->role, ['admin', 'wadir1'])) {
            $request->merge(['kode_prodi' => null]);
        }

        User::create($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $prodis = Prodi::all();
        $jurusans = Jurusan::all();
        return view('admin.users.edit', compact('user', 'prodis', 'jurusans'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'nip' => ['required', Rule::unique('users', 'nip')->ignore($user->id)],
            'nohp' => ['required', 'min:6', 'max:15', Rule::unique('users', 'nohp')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,wadir1,tim,kaprodi,kajur',
            'status' => 'required|in:approved,pending'
        ]);

        $data = [
            'name' => $request->name,
            'nip' => $request->nip,
            'nohp' => $request->nohp,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if (in_array($request->role, ['kaprodi', 'tim'])) {
            if (!$request->kode_prodi) {
                return back()->withErrors(['kode_prodi' => 'Prodi wajib dipilih untuk role ini.'])->withInput();
            }
            $data['kode_prodi'] = $request->kode_prodi;
        }

        if ($request->role === 'kajur') {
            if (!$request->id_jurusan) {
                return back()->withErrors(['id_jurusan' => 'Jurusan wajib dipilih untuk role ini.'])->withInput();
            }
            $data['id_jurusan'] = $request->id_jurusan;
            $data['kode_prodi'] = null;
        }

        if (in_array($request->role, ['admin', 'wadir1'])) {
            $data['kode_prodi'] = null;
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function details($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.detail', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('sukses', 'User berhasil dihapus');
    }

    public function pendingUsers()
    {
        $pendingUsers = User::where('status', 'pending')->get();
        return view('admin.pendingusers.index', compact('pendingUsers'));
    }


    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();
        return redirect()->route('admin.pendingusers.index')->with('success', 'Pengguna berhasil disetujui');
    }

    public function rejectUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.pendingusers.index')->with('sukses', 'Pengguna berhasil ditolak');
    }
}
