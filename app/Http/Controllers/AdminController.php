<?php

namespace App\Http\Controllers;

use App\Models\artikels;
use App\Models\ulasans;
use App\Models\user;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class AdminController extends Controller
{

//Menampilkan Data Dashboard Admin
    function dashboard(){
    $totalArtikel = artikels::count();
    $totalUser = user::count();
    $totalUlasan = ulasans::count();
    return view('admin.dashboard', compact('totalArtikel','totalUser','totalUlasan'));
}

//Menampilkan Data Artikel pada Tabel Admin
function dataArtikel(){
    $data = artikels::paginate(5);
    return view('admin.tables', compact('data'));
}

    function deleteArtikel($id){
        $data=artikels::find($id);
        $data->delete();
        return redirect('/artikelAdmin');
    }

    function formTambahArtikel(){
        return view('admin.formTambahArtikel');
    }

    function storeTbhArtikel(Request $request)
    {
        $tbhArtikel = artikels::create($request->all());
        if($request->hasFile('gambar')){
            $request->file('gambar')->move('gambarArtikel/', $request->file('gambar')->getClientOriginalName());
            $tbhArtikel->gambar = $request->file('gambar')->getClientOriginalName();
            $tbhArtikel->save();
            return redirect('/artikelAdmin')->with('success', 'Data Berhasil Ditambahkan');
        }
        
        $validated = $request->validate([
            'gambar'=>'required',
            'judulArtikel'=>'required', 
            'penulis'=>'required', 
            'deskripsi'=>'required'
        ]);

        artikels::create($validated);
        return redirect('/artikelAdmin');
    }

    //Edit Data Tabel
    function tampilDataEditArtikel($id){
        $data = artikels::find($id);
        //dd($data);
        return view('admin.formEditArtikel', compact('data'));
    }
    function updateDataIdArtikel(Request $request, $id){
        $data = artikels::find($id);
        $data->update($request->all());
    
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
    
            $filename = $image->getClientOriginalName();
        
            $image->move(public_path('gambar'), $filename);
        
            $data->gambarArtikel = $filename;
            $data->save();
        }
    
        return redirect()->route('dataArtikel')->with('success','Data Berhasil di Update');
    }    

    //Menampilkan Data User yang sudah register pada tabel Admin
    function listUserTerdaftar(){
        $role = request()->input('roles');
        $data = user::query();
    
        if ($role) {
            $data = $data->where('role', $role);
        }
    
        $users = $data->get();
    
        return view('admin.pengguna', ['users' => $users]);
    }

    function formTambahUserAdm(){
        return view('admin.formTambahUserAdm');
    }

    function registerAdmin(Request $req){
            user::create([
                 'name' => $req->name,
                 'email' => $req->email,
                 'password' => bcrypt($req->password),
                 'role' => 'admin',
            ]);
                 return redirect('pengguna');
         }

    function deleteUserTerdaftar($id)
    {
        $data=user::find($id);
        $data->delete();
        return redirect('pengguna');
    }

    //Menampilkan Data Ulasan pada Tabel Admin
    function ulasanAdmin(){
        $data1=ulasans::all();
        return view('admin.ulasans', compact('data1'));
    }

    //Delete data ulasan pada Tabel Admin
    function deleteUlasan($id){
        $data1=ulasans::find($id);
        $data1->delete();
        return redirect('ulasans');
    }

    //Profile
    public function profileAdmin()
    {
        return view('Admin.profileA');
    }  
  

    public function updateAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'alamat' => $request->input('alamat'),
            'instagram' => $request->input('instagram'),
            'facebook' => $request->input('facebook'),
            'aboutme' => $request->input('aboutme'),
        ]);
    
        // Handle profile picture upload
        if ($request->hasFile('fotoProfil')) {
            $image = $request->file('fotoProfil');
    
            // Create a filename that includes spaces and user information
            $filename = 'fotoProfil.' . $user->name . ' ' . $user->username . '.' . $image->getClientOriginalExtension();
    
            // Save the image in the public directory
            $image->move(public_path('fotoProfil'), $filename);
    
            // Update the user's fotoProfil attribute with the filename
            $user->fotoProfil = $filename;
            $user->save();
        }
    
        return redirect('/profileAdmin');
    }
}
