<?php

namespace App\Http\Controllers;

use App\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaController extends Controller
{
    //get pengguna
    public function index() //deklarasi fungsi index
    {
        $data['status'] = 200; //menampilkan status
        $data['message'] = "Data Admin"; //menampilkan pesan
        $data['data'] = Pengguna::all(); //mengambil semua data dari database
        return $data; //menampilkan data dari $data
    }

    //create pengguna
    public function create(Request $request) //deklarasi fungsi create
    {
        //Generate Kode Admin
        //pilih default id ketika ada kasus belum ada data sama sekali
        $next_id = "ADM" . date('m') . date('Y') . "0001";

        $max_pengguna = DB::table("penggunas")->max('kode_admin'); //mengambil id terbesar

        if ($max_pengguna) { //jika sudah ada sata generate id baru

            $pecah_dulu = str_split($max_pengguna, 9); //misal "ADM01210001" hasilnya jadi ["ADM112021", "0001"]
            $increment_id = $pecah_dulu[1];
            $result = sprintf("%'.04d", $increment_id + 1);

            $next_id = $pecah_dulu[0] . $result;
        }

        $pengguna = new Pengguna; //inisialisasi atau menciptakan object baru
        $pengguna->kode_admin = $next_id; //memanggil perintah next_id yang sudah di buat
        $pengguna->nama_admin = $request->nama_admin; //menset nama admin
        $pengguna->alamat_admin = $request->alamat_admin; //menset alamat admin
        $pengguna->telepon_admin = $request->telepon_admin; //menset telepon admin
        $pengguna->email = $request->email; //menset email
        $pengguna->username = $request->username; //menset username
        $pengguna->password = md5($request->password); //menset password

        $simpan = $pengguna->save(); //menyimpan data pengguna ke database
        if ($simpan) { //jika penyimpanan berhasil
            $data['status'] = true;
            $data['message'] = "Berhasil Menambahkan Admin";
            $data['data'] = $pengguna;
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Admin";
            $data['data'] = null;
        }
        return $data; //menampilkan hasil penyimpanan
    }

    //update pengguna(profile)
    public function update(Request $request, $id) //deklarasi fungsi update
    {
        $pengguna = Pengguna::find($id); //mengambil data berdasarkan id

        if ($pengguna) { //jika data yang diambil 

            //menset nilai yang baru/update
            $pengguna->nama_admin = $request->nama_admin;
            $pengguna->alamat_admin = $request->alamat_admin;
            $pengguna->telepon_admin = $request->telepon_admin;
            $pengguna->email = $request->email;
            $pengguna->username = $request->username;

            $data['data'] = $pengguna; //menampilkan data pengguna
            $update = $pengguna->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil update
                $data['status'] = true;
                $data['message'] = "Berhasil di Update";
                $data['data'] = $pengguna;
            } else { //jika data gagal di update
                $data['status'] = false;
                $data['message'] = "Gagal di Update";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan data (berhasil/gagal)
    }

    //delete pengguna
    public function delete($id) //deklarasi fungsi delete
    {
        $pengguna = Pengguna::find($id); //mengambil data pengguna berdasarkan id

        if ($pengguna) { //mengcek data apakah data ada atau tidak
            $delete = $pengguna->delete(); //menghapus data pengguna

            if ($delete) { //jika fungsi hapus berhasil
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Hapus";
                $data['data'] = $pengguna;
            } else {
                $data['status'] = false;
                $data['message'] = "Data Gagal di Hapus";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data;
    }
}
